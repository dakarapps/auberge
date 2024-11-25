<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth,DB;
use App\Models\HousekeepingItem, App\Models\HousekeepingOrder;
use App\Models\Room;

class HousekeepingController extends Controller
{
    private $core;
    public $data=[];
    public function __construct()
    {
        $this->core=app(\App\Http\Controllers\CoreController::class);
        $this->middleware('auth');
    }
    function getHousekeepingOrder($rec = 'get', $id = ''){
        $userId = Auth::user()->id;
        $roleId = Auth::user()->role_id;
        $records = null;
        $query = HousekeepingOrder::whereStatus(1)->orderBy('order_status','ASC')->orderBy('created_at','DESC');
        if($roleId == 7){
            $query->where('housekeeper_id', $userId);
        }
        if($id > 0){
            $records = $query->whereId($id)->first();
        }
        else if($rec == 'get'){
            $records = $query->paginate(getPaginationNum());
        }
        return $records;
    }
    public function index() {  
        $this->data['datalist']=$this->getHousekeepingOrder('get');
        return view('backend/housekeeping/list',$this->data);
    }
    public function addOrder($room_id = null, $reservation_id = null) {
        $this->setDataForAddEditView();
        $this->data['room_id'] = $room_id;
        $this->data['reservation_id'] = $reservation_id;
        return view('backend/housekeeping/add_edit',$this->data);
    }
    public function viewOrder(Request $request) {
        
    }
    public function editOrder(Request $request){
        $this->data['data_row']=$this->getHousekeepingOrder('get', $request->id);
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        $this->setDataForAddEditView();
        return view('backend/housekeeping/add_edit',$this->data);
    } 
    public function saveOrder(Request $request) {
        $splashMsg = getSplashMsg(['id'=>$request->id, 'type'=>'add_update']);
        $items = (count($request->items)) ? implode(',', $request->items) : '';
        $request->merge(['housekeeping_items'=>$items]);
        $res = HousekeepingOrder::updateOrCreate(['id'=>$request->id],$request->except(['_token','items']));
        
        if($res){
            return redirect()->back()->with(['success' => $splashMsg['success']]);
        }
        return redirect()->back()->with(['error' => $splashMsg['error']]);
    }
    public function updateOrderStatus($order_id, $status){
        if(!isPermission('update-housekeeping-order-status')){
            return redirect()->back()->with(['info' => config('constants.FLASH_PAGE_NOT_ALLOWD')]);
        }
        $splashMsg = getSplashMsg(['id'=>$order_id, 'type'=>'add_update']);
        $newStatus = $status == 0 ? 1 : 2;
        $res = HousekeepingOrder::whereId($order_id)->update(['order_status'=>$newStatus, 'completed_date'=>date('Y-m-d H:i:s')]);
        
        if($res){
            return redirect()->back()->with(['success' => $splashMsg['success']]);
        }
        return redirect()->back()->with(['error' => $splashMsg['error']]);
    }
    public function deleteOrder(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }  
        if(HousekeepingOrder::whereId($request->id)->delete()){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }

    public function addItem() {
        return view('backend/housekeeping/item_add_edit',$this->data);
    }
    public function editItem(Request $request){
        $this->data['data_row']=HousekeepingItem::whereId($request->id)->where('is_deleted', 0)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/housekeeping/item_add_edit',$this->data);
    } 
    public function saveItem(Request $request) {
        $splashMsg = getSplashMsg(['id'=>$request->id, 'type'=>'add_update']);
        if($request->id>0){
            if($this->core->checkWebPortal()==0){
                return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
            } 
        }
        $res = HousekeepingItem::updateOrCreate(['id'=>$request->id],$request->except(['_token']));
        
        if($res){
            return redirect()->back()->with(['success' => $splashMsg['success']]);
        }
        return redirect()->back()->with(['error' => $splashMsg['error']]);
    }
    public function listItem() {
         $this->data['datalist']=HousekeepingItem::where('is_deleted', 0)->orderBy('name','ASC')->get();
        return view('backend/housekeeping/item_list',$this->data);
    }
    public function deleteItem(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }  
        if(HousekeepingItem::whereId($request->id)->update(['is_deleted'=>1])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }

    function getHousekeepingItemList(){
        return HousekeepingItem::select('name AS text')->whereStatus(1)->where('is_deleted', 0)->orderBy('name','ASC')->pluck('text','text');
    }
    function setDataForAddEditView(){
        $this->data['housekeeper_list'] = getHousekeeperList();
        $this->data['room_list'] = getRoomList(2);
        $this->data['item_list']=$this->getHousekeepingItemList();
        $this->data['status_list']=getDynamicDropdownList('housekeeping_status');
    }
}
