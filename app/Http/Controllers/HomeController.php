<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session, DB, Auth, Hash;
use App\Models\User, App\Models\Customer, App\Models\Role;
use App\Models\Room, App\Models\RoomType, App\Models\BookedRoom, App\Models\RoomCart;
use App\Models\Reservation;
use App\Models\Order, App\Models\OrderItem, App\Models\OrderHistory;
use App\Models\Setting;
use App\Models\Enquiry, App\Models\UserEmail;
use App\Models\ContactusSection, App\Models\AboutusSection, App\Models\HomeSection;
use App\Models\Testimonial;

class HomeController extends Controller
{
    private $paginate=10;
    private $core;
    private $mailCtlr;
    public $data=[];
    public $settings=[];
    public function __construct()
    {
        $this->core=app(\App\Http\Controllers\CoreController::class);
        $this->mailCtlr=app(\App\Http\Controllers\MailController::class);
        $this->data['settings'] = getSettings();
    }

    public function index(){
        $this->core->syncUserAndCustomer();
        $this->data['data_row']=HomeSection::with('banners')->first();
        $this->data['testimonials_rows'] = Testimonial::all();
        $this->data['roomtypes_list']=RoomType::whereStatus(1)->whereIsDeleted(0)->orderBy('order_num','ASC')->get();
        $this->data['room_list']=Room::whereStatus(1)->whereIsDeleted(0)->orderBy('order_num','ASC')->get();
        return view('frontend/index', $this->data);
    }
    public function signIn(){
        if(Auth::user()){
             return redirect()->route('user-dashboard');
        }
        return view('frontend/sign_in');
    }
    public function doSignIn(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id'=>6, 'status' => 1])) {
            $this->core->removeRoomCartData();
            return redirect()->route('user-dashboard')->with(['success' => config('constants.FLASH_SUCCESS_LOGIN')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_INVALID_CREDENTIAL')]);
    }
    public function signUp(){
        if(Auth::user()){
            return redirect()->route('user-dashboard');
        }
        return view('frontend/sign_up');
    }
    public function doSignUp(Request $request){
        if(!$request->firstname || !$request->lastname || !$request->email || !$request->mobile || !$request->address || !$request->country || !$request->password){
            return redirect()->back()->with(['error' => config('constants.FLASH_FILL_REQUIRED_FIELD')]);
        }
        if($this->core->isUserEmailExist($request->email)){
            return redirect()->back()->with(['error' => config('constants.FLASH_EMAIL_ADDRESS_EXIST')]);
        }
        $postData = [
            'name'=> $request->firstname,
            'surname'=> $request->lastname,
            'email'=> $request->email,
            'mobile'=> $request->mobile,
            'address'=> $request->address,
            'country'=> $request->country,
            'city'=> $request->city,
            'zipcode'=> $request->zipcode,
            'password'=> Hash::make($request->password)
        ];

        $lastId = Customer::insertGetId($postData);
        if($lastId){
            //sync user and customer
            $this->core->syncUserAndCustomer();

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id'=>6, 'status' => 1])) {
                return redirect()->route('user-dashboard')->with(['success' => config('constants.FLASH_ACC_CREATE_1')]);
            }
            return redirect()->route('sign-in')->with(['success' => config('constants.FLASH_ACC_CREATE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_ACC_CREATE_0')]);
    }
    public function roomDetails(Request $request){
        $this->data['room_details']=Room::where('id', $request->id)->whereStatus(1)->whereIsDeleted(0)->first();
        if($this->data['room_details']){
            return view('frontend/room_details', $this->data);
        }
        return view('frontend/error_404', $this->data);
    }
    public function searchRooms(Request $request) {
        if(!$request->dates || !$request->adults){
            return redirect()->route('home')->with(['error' => config('constants.FLASH_INVALID_PARAMS')]);
        }
        $this->core->removeRoomCartData($request->booknow ? 'user' : 'previous');
        $expDates = explode(' / ', $request->dates);
        $this->data['room_with_price']=getRoomsWithPrice(['checkin_date'=>$expDates[0], 'checkout_date'=>$expDates[1]]);
        $this->data['booked_rooms'] = getBookedRooms(['checkin_date'=>$expDates[0], 'checkout_date'=>$expDates[1]]);
        $this->data['room_list'] = Room::whereStatus(1)->whereIsDeleted(0)->orderBy('room_no','ASC')->get();
        $this->data['cart_list'] = (Auth::user()) ? RoomCart::where('user_id',Auth::user()->id)->get() : null;
        //dd($this->data);
        return view('frontend/room_list', $this->data);
    }

    public function advanceRoomSlip(Request $request){
        $this->data['type']=1;
        $this->data['data_row']=Reservation::with('orders_items','orders_info')->whereId(base64_decode($request->id))->first();
        if($this->data['data_row']){
            return view('backend/rooms/advance_slip',$this->data);
        } else {
            echo config('constants.FLASH_NOT_ALLOW_URL'); 
        }
    }
    public function aboutUs(){
        $this->data['data_row']=AboutusSection::first();
        return view('frontend/about_us', $this->data);
    }
    public function privacyPolicy(){
        $this->data['data_row']=[];
        return view('frontend/privacy_policy', $this->data);
    }
    public function termsConditions(){
        $this->data['data_row']=[];
        return view('frontend/terms_and_conditions', $this->data);
    }
    public function contactUs(){
        $this->data['data_row']=ContactusSection::first();
        //dd($this->data);
        return view('frontend/contact_us', $this->data);
    }
    public function contactUsMessage(Request $request) {
        if($request->email=='' || $request->name=='' || $request->subject=='' || $request->message==''){
            return redirect()->back()->with(['error' => config('constants.FLASH_INVALID_PARAMS')]);
        }
        $postData = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'subject' =>  $request->subject,
            'query' => $request->message,
            'ip_addr' => $request->ip(),
        ];

        $enq = Enquiry::whereDate('created_at', DB::raw('CURDATE()'))->get();
        $recordExist = false;
        $counts = 0;
        if($enq){
            foreach ($enq as $key => $value) {
                if($value->name === $postData['name'] || $value->email === $postData['email'] || $value->ip_addr === $postData['ip_addr']){
                    $counts = $counts + 1;
                    $recordExist = ($counts > 5) ? true : false;
                }
            }
        }
        if($recordExist){
            return redirect()->back()->with(['success' => config('constants.FLASH_CONTACT_US_0') ]);
        }
        $res = Enquiry::insertGetId($postData);

        // send contactus mail
        $mailData = [
            'to'=> env('MAIL_TO_ADDRESS', 'quickbuzzin@gmail.com'),
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'subject' => $request->subject,
            'body' => $request->message,
        ];
        $this->mailCtlr->sendContactUsMail($mailData);
        return redirect()->back()->with(['success' => config('constants.FLASH_CONTACT_US_1') ]);
    }
    public function subscribeNotifications(Request $request) {
        if($request->email==''){
            return redirect()->back()->with(['error' => config('constants.FLASH_INVALID_PARAMS')]);
        }
        $postData = [
            'email' => $request->email,
            'ip_addr' => $request->ip(),
        ];
        $exist = UserEmail::where('email', $request->email)->first();
        if($exist){
            return redirect()->back()->with(['success' => config('constants.FLASH_EMAIL_ADDRESS_EXIST') ]);
        }
        if(UserEmail::whereDate('created_at', DB::raw('CURDATE()'))->count() > 20){
            return redirect()->back()->with(['success' => config('constants.FLASH_EMAIL_SUBS_LIMIT') ]);
        }
        $res = UserEmail::insertGetId($postData);
        return redirect()->back()->with(['success' => config('constants.FLASH_EMAIL_SUBS_1') ]);
    }
}
