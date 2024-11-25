<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session, DB, Auth, Hash;
use App\Models\User, App\Models\Customer, App\Models\Role;
use App\Models\RoomCart,App\Models\BookedRoom;
use App\Models\Reservation;
use App\Models\Order, App\Models\OrderItem, App\Models\OrderHistory;
use App\Models\Setting;
use App\Models\Enquiry, App\Models\UserEmail;
use App\Models\ContactusSection, App\Models\AboutusSection, App\Models\HomeSection;
use App\Models\Testimonial;

class UserController extends Controller
{
    private $paginate=10;
    private $core;
    public $data=[];
    public $settings=[];
    public function __construct()
    {
        $this->core=app(\App\Http\Controllers\CoreController::class);
        $this->middleware('auth');
        $this->data['settings'] = getSettings();
    }

    public function dashboard(){
        $userInfo = getAuthUserInfo();
        $customerId = $userInfo->additional_info->id;
        $currDateRaw = DB::raw('CURDATE()');

        $reservationData = Reservation::where('customer_id', $customerId)->whereIsDeleted(0)->orderBy('check_in','DESC')->paginate(20);

        $totalBookings = Reservation::where('customer_id', $customerId)->whereIsDeleted(0)->count();
        $todayBookings = Reservation::where('customer_id', $customerId)->whereIsDeleted(0)->whereDate('check_in', '=', $currDateRaw)->count();
        $upComingBookings = Reservation::where('customer_id', $customerId)->whereIsDeleted(0)->whereDate('check_in', '>', $currDateRaw)->count();

        $this->data['datalist'] = $reservationData;
        $this->data['userInfo'] = $userInfo;
        $this->data['totals'] = [
            'bookings'=>$totalBookings,
            'today_bookings'=>$todayBookings,
            'upcoming_bookings'=>$upComingBookings,
        ];
        return view('frontend/dashboard', $this->data);
    }
    public function bookRooms(Request $request){

        $paymentModes = config('constants.PAYMENT_MODES_FRONT');
        if(!$request->payment_mode && !in_array($request->payment_mode, $paymentModes)){
            return redirect()->back()->with(['error' => config('constants.FLASH_INVALID_PARAMS')]);
        }
        $selectedRooms = RoomCart::where('user_id', Auth::user()->id)->whereDate('created_at', '=', DB::raw('CURDATE()'))->get();
        $roomNumbers = [];
        $resInfo = null;
        if($selectedRooms && $selectedRooms->count()){
            $resInfo = $selectedRooms[0];
            foreach ($selectedRooms as $key => $value) {
                $roomInfo = $value->room;
                $roomNumbers[] = $roomInfo->room_type_id.'~'.$roomInfo->id;
            }
            $userInfo = getAuthUserInfo();
            
            $durationOfStay = dateDiff($resInfo->date_from, $resInfo->date_to);
            $reservationData = [
                "customer_id" => $userInfo->additional_info->id,
                "check_in" => dateConvert($resInfo->date_from, 'Y-m-d H:i'),
                "check_out" => dateConvert($resInfo->date_to, 'Y-m-d H:i'),
                "duration_of_stay" => ($durationOfStay == 0) ? 1 : $durationOfStay,
                "adult" => $resInfo->adults,
                "kids" => $resInfo->children,
                "guest_type" => 'existing',
                "booking_type" => 'Online',
                "booked_by" => 'self',
                "payment_status" => 0,
                "payment_mode" => $request->payment_mode,
                "created_at_checkin"=>date('Y-m-d H:i:s'),
            ];
             
            $reservationId = Reservation::insertGetId($reservationData);
            if($reservationId){
                //add rooms
                $this->addReservationRoom($reservationId, $roomNumbers);

                //update gst amount
                $dataQuery = Reservation::whereId($reservationId);
                $dataRow = $dataQuery->first();
                $calculatedAmount = calcFinalAmount($dataRow, 1);
                $gstPerc = $calculatedAmount['totalRoomGstPerc'];
                $cgstPerc = $calculatedAmount['totalRoomCGstPerc'];
                $roomAmountGst = $calculatedAmount['totalRoomAmountGst'];
                $roomAmountCGst = $calculatedAmount['totalRoomAmountCGst'];
                $totalRoomAmount = $calculatedAmount['subtotalRoomAmount'];
                $finalRoomAmount = $calculatedAmount['finalRoomAmount'];

                $reservationData = [
                    "discount"=>0,
                    "sub_total"=>$totalRoomAmount,
                    "gst_perc"=>$gstPerc,
                    "cgst_perc"=>$cgstPerc,
                    "gst_amount"=>$roomAmountGst,
                    "cgst_amount"=>$roomAmountCGst,
                    "grand_total"=>$finalRoomAmount,
                ];
                $dataQuery->update($reservationData);

                //remove cart
                $this->core->removeRoomCartData();
            }
            return redirect()->route('user-dashboard')->with(['success' => config('constants.FLASH_ROOM_BOOK_SUCCESS')]);
        }
        return redirect()->route('home')->with(['error' => config('constants.FLASH_NOT_ALLOW_URL')]);
    }
    public function logout(Request $request) {
        $request->session()->flush();
        Auth::logout();
        return redirect()->route('sign-in');
    }

    public function profileDetails(){
        $userInfo = getAuthUserInfo();
        $this->data['data_row']=Customer::whereId($userInfo->additional_info->id)->where('is_deleted',0)->first();
        return view('frontend/profile_details', $this->data);
    }
    public function updateProfileDetails(Request $request){
        $userInfo = getAuthUserInfo();
        $res = Customer::whereId($userInfo->additional_info->id)->update($request->except(['_token']));
        if($res){            
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_UPDATE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_UPDATE_0')]);
    }
    public function changePassword(){
        return view('frontend/change_password', $this->data);
    }
    public function updatePassword(Request $request){
        $userInfo = getAuthUserInfo();
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'min:6|max:8|same:new_password',
        ]);
        if (!Hash::check($request->old_password, $userInfo->password)) { 
            return redirect()->back()->with(['error' => config('constants.FLASH_INVALID_OLD_PASS')]);
        }
       
        $res = User::whereId($userInfo->additional_info->id)->update(['password' => Hash::make($request->new_password)]);
        if($res){            
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_UPDATE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_UPDATE_0')]);
    }

    //other functions
    function addReservationRoom($reservationId, $roomNumbers){
        $reservationData = Reservation::whereId($reservationId)->first();
        $roomData = [];
        $res = null;
        if($roomNumbers && count($roomNumbers) > 0){
            foreach($roomNumbers as $val){
                $exp = explode('~', $val);
                $roomTypeDetails = getRoomTypeById($exp[0]);

                // get datewise price list
                $priceInfo = getRoomsWithPrice([ 'checkin_date'=>$reservationData->check_in, 'checkout_date'=>$reservationData->check_out, 'room_type_ids'=>[$exp[0]] ]);
                $roomData[] = [
                    'reservation_id'=>$reservationData->id,
                    'room_type_id'=>$exp[0],
                    'room_id'=>$exp[1],
                    'room_price'=>$roomTypeDetails->base_price,
                    'check_in' =>dateConvert($reservationData->check_in, 'Y-m-d H:i'),
                    'check_out' =>dateConvert($reservationData->check_out, 'Y-m-d H:i'),
                    'date_wise_price'=>json_encode($priceInfo[$exp[0]]['dates_with_price'])
                ];
            }
            $res = BookedRoom::insert($roomData);
        }
        return $res;
    }
}
