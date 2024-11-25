<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth,DB;
use App\Models\LaundryItem, App\Models\LaundryOrder, App\Models\LaundryOrderItem;
use App\Models\Room;
use App\Models\Customer;
class LaundryController extends Controller
{
    private $core;
    public $data=[];
    public function __construct()
    {
        $this->core=app(\App\Http\Controllers\CoreController::class);
        $this->middleware('auth');
    }

    public function index() { 
        $startDate = getNextPrevDate('prev'); 
        $this->data['datalist']=LaundryOrder::whereStatus(1)->whereDate('order_date', '>=', $startDate." 00:00:00")->whereDate('order_date', '<=', DB::raw('CURDATE()'))->orderBy('order_status','ASC')->orderBy('order_num','DESC')->get();
        $this->data['vendor_list'] = getVendorList();
        $this->data['room_list'] = getRoomList(2);
        $this->data['status_list']=getConstants('LIST_LAUNDRY_ORDER_STATUS');
        $this->data['search_data'] = ['order_num'=>'','vendor_id'=>'','room_id'=>'','order_status'=>'','date_from'=>$startDate, 'date_to'=>date('Y-m-d')];
        return view('backend/laundry/list',$this->data);
    }
    public function addOrder() {
        $this->setDataForAddEditView();
        $this->data['status_list']=getConstants('LIST_LAUNDRY_ORDER_STATUS', [1,2,3]);
        return view('backend/laundry/add_edit',$this->data);
    }
    public function viewOrder(Request $request) {
        $orderData = LaundryOrder::with('order_items', 'invoice')->whereId($request->id)->where('status', 1)->first();
        if(!$orderData){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        $this->data['data_row']=$orderData;
        return view('backend/laundry/view_order',$this->data);
    }
    public function invoice(Request $request) {
        $orderData = LaundryOrder::with('order_items')->whereId($request->id)->where('order_status', 3)->first();
        if(!$orderData){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        $this->data['data_row']=$orderData;
        return view('backend/laundry/invoice',$this->data);
    }
    public function editOrder(Request $request){
        $orderData = LaundryOrder::with('order_items')->whereId($request->id)->where('status', 1)->first();
        if(!$orderData){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        if($orderData->order_status == 3){
            return redirect()->back()->with(['info' => config('constants.FLASH_ORDER_ALREADY_COMPLETE')]);
        }
        $this->data['data_row']=$orderData;
        $this->setDataForAddEditView();
        return view('backend/laundry/add_edit',$this->data);
    } 
    public function saveOrder(Request $request) {
        if(!$request->item){
            return redirect()->back()->with(['error' => config('constants.FLASH_FILL_REQUIRED_FIELD')]);
        }
        $orderData = LaundryOrder::find($request->id);
        
        $splashMsg = getSplashMsg(['id'=>$request->id, 'type'=>'add_update']);
        $mergeRequestArr = [];

        if($request->guest_type=='existing' && $request->selected_customer_id){
            $custData = Customer::whereId($request->selected_customer_id)->first();
            $mergeRequestArr['customer_name'] = $custData->name.' '.$custData->surname;
            $mergeRequestArr['customer_email'] = $custData->email;
            $mergeRequestArr['customer_mobile'] = $custData->mobile;
            $mergeRequestArr['customer_address'] = $custData->address;
            $mergeRequestArr['customer_gender'] = $custData->gender;
        } 

        // generate order num when create new order only
        if(!$orderData){
            $mergeRequestArr['order_num'] = getNextInvoiceNo('laundry_order');
        }

        // set some valuues for order complete
        $isOrderComplete = false;
        if($orderData && $orderData->order_status == 2 && $request->amount){
            $settings = getSettings();
            $amountArr =  $request->amount;
            $isOrderComplete = true;
            $mergeRequestArr['order_status'] = 3; // completed
            $mergeRequestArr['received_date'] = dateConvert($request->received_date, 'Y-m-d');
            $mergeRequestArr['gst_perc'] = $settings['gst'];
            $mergeRequestArr['cgst_perc'] = $settings['cgst'];
            $mergeRequestArr['total_amount'] = $amountArr['total_amount'];
            $mergeRequestArr['discount'] = $amountArr['discount_amount'];
            $mergeRequestArr['gst_amount'] = $amountArr['total_gst_amount'];
            $mergeRequestArr['cgst_amount'] = $amountArr['total_cgst_amount'];
        }

        $request->merge($mergeRequestArr);
        $res = LaundryOrder::updateOrCreate(['id'=>$request->id],$request->except(['_token','item','guest_type','selected_customer_id','amount']));
        
        if($res){
            $items = [];
            if(count($request->item)){
                // remove all items for save new
                LaundryOrderItem::where('laundry_order_id', $res->id)->delete();

                if(count($request->item['ids'])){
                    foreach ($request->item['ids'] as $key => $value) {
                        $price = (isset($request->item['price'][$key])) ? $request->item['price'][$key] : 0.00;
                        $sentQty = (isset($request->item['sent_qty'][$key])) ? $request->item['sent_qty'][$key] : 0;
                        $rcvQty = (isset($request->item['rcv_qty'][$key])) ? $request->item['rcv_qty'][$key] : 0;
                        if($value == null){
                            continue;
                        }
                        $items[] = [
                            'laundry_order_id'=>$res->id,
                            'item_id'=>$value,
                            'item_name'=>NULL,
                            'item_price'=>$price,
                            'sent_item_qty'=>(int)$sentQty,
                            'rcv_item_qty'=>(int)$rcvQty,
                        ];
                    }
                    if(count($items)){
                        LaundryOrderItem::insert($items);
                    }
                }
            }

            if($isOrderComplete){
                // upload received invoice
                $mediaData = [
                    'tbl_id'=>$request->id,
                    'media_ids'=>[],
                    'files'=>($request->hasFile('invoice')) ? $request->invoice : null,
                    'folder_path'=>'uploads/laundry_invoice',
                    'type'=>'laundry_invoice',
                ];           
                $this->core->uploadAndUnlinkMediaFile($mediaData);

                // update re-calculated amount
                $orderData = LaundryOrder::with('order_items')->find($request->id);
                $calculatedAmount = calcLaundryAmount($orderData, 0);
                $orderData->total_amount = $calculatedAmount['totalAmount'];
                $orderData->discount = $calculatedAmount['totalDiscount'];
                $orderData->gst_amount = $calculatedAmount['gstAmount'];
                $orderData->cgst_amount = $calculatedAmount['cgstAmount'];
                $orderData->save();

                //add ledger
                if($calculatedAmount){   
                    $paymentHistoryData = [];            
                    $where = [
                        'purpose'=>'LAUNDRY_AMOUNT',
                        'tbl_id'=>$res->id,
                        'tbl_name'=>'laundry_orders',
                    ];
                    $paymentHistoryData['purpose'] = $where['purpose'];
                    $paymentHistoryData['tbl_id'] = $where['tbl_id'];
                    $paymentHistoryData['tbl_name'] = $where['tbl_name'];
                    $paymentHistoryData['payment_date'] = date('Y-m-d H:i:s');
                    $paymentHistoryData['customer_id'] = NULL;
                    $paymentHistoryData['user_id'] = NULL;
                    $paymentHistoryData['added_by'] = Auth::user()->id;
                    $paymentHistoryData['payment_amount'] = $calculatedAmount['totalAmount'];
                    $paymentHistoryData['payment_type'] = getPaymentModeById($res->payment_mode);
                    $paymentHistoryData['credit_debit'] = 'Debit';
                    $paymentHistoryData['payment_of'] = 'cr';
                    $paymentHistoryData['transaction_id'] = getNextInvoiceNo('ph');
                    $this->core->updateOrCreatePH($where, $paymentHistoryData);
                }                
            }
            return redirect()->route('list-laundry-order')->with(['success' => $splashMsg['success']]);
        }
        return redirect()->back()->with(['error' => $splashMsg['error']]);
    }
    public function updateOrderStatus($order_id, $status){
        if(!isPermission('update-laundry-order-status')){
            return redirect()->back()->with(['info' => config('constants.FLASH_PAGE_NOT_ALLOWD')]);
        }
        $splashMsg = getSplashMsg(['id'=>$order_id, 'type'=>'add_update']);
        $newStatus = $status + 1;
        $res = LaundryOrder::whereId($order_id)->update(['order_status'=>$newStatus]);
        
        if($res){
            return redirect()->back()->with(['success' => $splashMsg['success']]);
        }
        return redirect()->back()->with(['error' => $splashMsg['error']]);
    }
    public function deleteOrder(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }  
        if(LaundryOrder::whereId($request->id)->where('order_status','<>', 3)->delete()){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }

    public function addItem() {
        return view('backend/laundry/item_add_edit',$this->data);
    }
    public function editItem(Request $request){
        $this->data['data_row']=LaundryItem::whereId($request->id)->where('is_deleted', 0)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/laundry/item_add_edit',$this->data);
    } 
    public function saveItem(Request $request) {
        $splashMsg = getSplashMsg(['id'=>$request->id, 'type'=>'add_update']);
        if($request->id>0){
            if($this->core->checkWebPortal()==0){
                return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
            } 
        }
        $res = LaundryItem::updateOrCreate(['id'=>$request->id],$request->except(['_token']));
        
        if($res){
            return redirect()->back()->with(['success' => $splashMsg['success']]);
        }
        return redirect()->back()->with(['error' => $splashMsg['error']]);
    }
    public function listItem() {
         $this->data['datalist']=LaundryItem::where('is_deleted', 0)->orderBy('name','ASC')->get();
        return view('backend/laundry/item_list',$this->data);
    }
    public function deleteItem(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }  
        if(LaundryItem::whereId($request->id)->update(['is_deleted'=>1])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }

    function getLaundryItemList(){
        return LaundryItem::whereStatus(1)->where('is_deleted', 0)->orderBy('name','ASC')->pluck('name','id');
    }
    function setDataForAddEditView(){
        $this->data['customer_list']=getCustomerList('get');
        $this->data['vendor_list'] = getVendorList();
        $this->data['item_list']=$this->getLaundryItemList();
        $this->data['room_list'] = getRoomList(2);
        $this->data['status_list']=getConstants('LIST_LAUNDRY_ORDER_STATUS');
    }
}
