<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Excel;
use App\Models\StockHistory;
use App\Models\Reservation;
use App\Models\Order, App\Models\OrderItem, App\Models\OrderHistory;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Expense, App\Models\ExpenseCategory;
use App\Models\PaymentHistory;
use App\Models\LaundryOrder;
use App\Exports\CheckoutExport;
use App\Exports\StockHistoryExport;
use App\Exports\ExpenseExport;
use App\Exports\CustomerExport;
use App\Exports\OrderExport;
use App\Exports\PaymentHistoryExport;
use App\Exports\LaundryOrderExport;

class ReportController extends Controller
{
    private $core;
    public $data=[];
    public function __construct()
    {
        $this->core=app(\App\Http\Controllers\CoreController::class);
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $startDate = getNextPrevDate('prev');
        $searcData = ['date_from'=>$startDate, 'date_to'=>date('Y-m-d')];

        $this->data['report_of'] = $request->get('type');
        $this->data['customer_list']=getCustomerList('get');

        if($this->data['report_of'] == 'checkouts'){
            $this->data['roomtypes_list']=getRoomTypesList();
            $searcData['customer_id'] = '';
            $searcData['room_type_id'] = '';
        }
        else if($this->data['report_of'] == 'expense'){
            $this->data['category_list']=getExpenseCategoryList();
            $searcData['category_id'] = '';
        } else {
            $this->data['report_of'] = 'transactions';
            $this->data['roomtypes_list']=getRoomTypesList();
            $this->data['datalist'] = PaymentHistory::orderBy('payment_date', 'DESC')->get();
            $this->data['payment_purpose']=getConstants('PAYMENT_PURPOSE');
        }
        
        $this->data['search_data'] = $searcData;

        return view('backend/reports',$this->data);
    }

    public function searchCheckins(Request $request) {
        $this->data['list'] = 'check_ins';
         $this->data['datalist']=Reservation::whereStatus(1)->whereIsDeleted(0)->whereIsCheckout(0)->orderBy('created_at','DESC')->get();
         return view('backend/rooms/room_reservation_list',$this->data);
    }
    public function searchCheckouts(Request $request) {
        $this->data['list'] = 'check_outs';
        $query = Reservation::whereStatus(1)->whereIsDeleted(0)->whereIsCheckout(1)->orderBy('created_at','DESC');
        if($request->customer_id){
            $query->where('customer_id', $request->customer_id);
        }
        if($request->date_from){
            $query->whereDate('check_out', '>=', dateConvert($request->date_from,'Y-m-d'));
        }
        if($request->date_to){
            $query->whereDate('check_out', '<=', dateConvert($request->date_to,'Y-m-d'));
        }
        if($request->room_type_id){
            $query->where('room_type_id', $request->room_type_id);
        }
        if($request->payment_status == 0 || $request->payment_status == 1){
            //$query->where('payment_status', $request->payment_status);
        }
        $this->data['datalist']=$query->get();
        $this->data['roomtypes_list']=getRoomTypesList();
        $this->data['customer_list']=getCustomerList();
        $this->data['search_data'] = $request->all();
        if($request->submit_btn=='export'){
            $params=['data'=>$this->data['datalist'],'view'=>'excel_view.checkouts_excel'];
            $filename='check_outs.xlsx';
            return Excel::download(new CheckoutExport($params), $filename);
        } else {
            return view('backend/rooms/room_reservation_list',$this->data);
        }
    }
    public function searchStockHistory(Request $request) {
        $query = StockHistory::orderBy('id','DESC');
        if($request->product_id){
            $query->where('product_id', $request->product_id);
        }
        if($request->room_id){
            $query->where('room_id', $request->room_id);
        }
        if($request->date_from){
            $query->whereDate('stock_date', '>=', dateConvert($request->date_from,'Y-m-d'));
        }
        if($request->date_to){
            $query->whereDate('stock_date', '<=', dateConvert($request->date_to,'Y-m-d'));
        }
        if($request->is_stock){
            $query->where('stock_is', $request->is_stock);
        }
        $this->data['datalist']=$query->get();
        $this->data['products']=Product::where('is_deleted',0)->pluck('name','id');
        $this->data['rooms']=getRoomList();
        $this->data['search_data'] = $request->all();
        
        if($request->submit_btn=='export'){
            $params=['data'=>$this->data['datalist'],'view'=>'excel_view.stock_history_excel'];
            $filename='stock_history.xlsx';
            return Excel::download(new StockHistoryExport($params), $filename);
        } else {
            return view('backend/stock_history',$this->data);
        }
    }
    public function searchExpense(Request $request) {
        $query = Expense::orderBy('datetime','DESC');
        if($request->category_id){
            $query->where('category_id', $request->category_id);
        }
        if($request->date_from){
            $query->whereDate('datetime', '>=', dateConvert($request->date_from,'Y-m-d'));
        }
        if($request->date_to){
            $query->whereDate('datetime', '<=', dateConvert($request->date_to,'Y-m-d'));
        }
        $this->data['datalist']=$query->get();
        $this->data['category_list']=ExpenseCategory::whereStatus(1)->orderBy('name','ASC')->pluck('name','id');
        $this->data['search_data'] = $request->all();
        
        if($request->submit_btn=='export'){
            $params=['data'=>$this->data['datalist'],'view'=>'excel_view.expense_excel'];
            $filename='expenses.xlsx';
            return Excel::download(new ExpenseExport($params), $filename);
        } else {
            return view('backend/expenses/list',$this->data);
        }
    }
    public function searchOrders(Request $request) {
        $query=Order::where('status','!=',4)->orderBy('created_at','DESC');
        if($request->order_type=='roomOrders'){
            $query->whereNotNull('reservation_id');
        } else if($request->order_type=='tableOrders'){
            $query->whereNotNull('table_num');
        }
        if($request->date_from){
            $query->whereDate('created_at', '>=', dateConvert($request->date_from,'Y-m-d'));
        }
        if($request->date_to){
            $query->whereDate('created_at', '<=', dateConvert($request->date_to,'Y-m-d'));
        }
       
        $this->data['datalist']=$query->get();
        $this->data['search_data'] = $request->all();
        if($request->submit_btn=='export'){
            $params=['data'=>$this->data,'view'=>'excel_view.orders_excel'];
            $filename='orders.xlsx';
            return Excel::download(new OrderExport($params), $filename);
        } else {
            return view('backend/orders_list',$this->data);
        }        
    }
    public function searchCustomer(Request $request) {
        $query = Customer::where('is_deleted',0)->orderBy('name','ASC');
        if($request->customer_id){
            $query->where('id', $request->customer_id);
        }
        if($request->mobile_num){
            $query->where('mobile', $request->mobile_num);
        }
        if($request->city){
            $query->where('city', $request->city);
        }
        if($request->state){
            $query->where('state', $request->state);
        }
        if($request->country){
            $query->where('country', $request->country);
        }
        
        $this->data['datalist']=$query->get();
        $this->data['customer_list']=getCustomerList('get');
        $this->data['search_data'] = $request->all();

        if($request->submit_btn=='export'){
            $params=['data'=>$this->data['datalist'],'view'=>'excel_view.customer_excel'];
            $filename='customers.xlsx';
            return Excel::download(new CheckoutExport($params), $filename);
        } else {
            return view('backend/customers/list',$this->data);
        }
    }
    public function searchPaymentHistory(Request $request) {
        $query = PaymentHistory::orderBy('created_at','DESC');
        if($request->customer_id){
            $query->where('customer_id', $request->customer_id);
        }
        if($request->user_id){
            $query->where('user_id', $request->user_id);
        }
        if($request->transaction_id){
            $query->where('transaction_id', $request->transaction_id);
        }
        if($request->payment_type!=null && $request->payment_type>=0){
            $query->where('payment_type', $request->payment_type);
        }
        if($request->purpose){
            $query->where('purpose', $request->purpose);
        }
        if($request->date_from){
            $query->whereDate('payment_date', '>=', dateConvert($request->date_from,'Y-m-d'));
        }
        if($request->date_to){
            $query->whereDate('payment_date', '<=', dateConvert($request->date_to,'Y-m-d'));
        }
        if($request->payment_of){
            $query->where('payment_of', $request->payment_of);
        }
        
        $this->data['datalist']=$query->get();
        $this->data['search_data'] = $request->all();
        $this->data['customer_list']=getCustomerList('get');
        $this->data['payment_purpose']=getConstants('PAYMENT_PURPOSE');
        $this->data['report_of'] = 'transactions';
        if($request->submit_btn=='export'){
            $params=['data'=>$this->data['datalist'],'view'=>'excel_view.payment_history_excel'];
            $filename='payment_history.xlsx';
            return Excel::download(new CheckoutExport($params), $filename);
        } else {
            return view('backend/reports',$this->data);
        }
    }
    public function searchLaundryOrder(Request $request) {
        $query = LaundryOrder::orderBy('id','DESC');
        if($request->order_num){
            $query->where('order_num', $request->order_num);
        }
        if($request->order_status!=null && $request->order_status>=0){
            $query->where('order_status', $request->order_status);
        }
        if($request->vendor_id){
            $query->where('vendor_id', $request->vendor_id);
        }
        if($request->room_id){
            $query->where('room_id', $request->room_id);
        }
        if($request->date_from){
            $query->whereDate('order_date', '>=', dateConvert($request->date_from,'Y-m-d H:i:s'));
        }
        if($request->date_to){
            $query->whereDate('order_date', '<=', dateConvert($request->date_to,'Y-m-d H:i:s'));
        }
        $this->data['datalist']=$query->get();
        $this->data['vendor_list']=getVendorList();
        $this->data['room_list'] =getRoomList(2);
        $this->data['status_list']=getConstants('LIST_LAUNDRY_ORDER_STATUS');
        $this->data['search_data'] = $request->all();
        
        if($request->submit_btn=='export'){
            $params=['data'=>$this->data['datalist'],'view'=>'excel_view.laundry_order_excel'];
            $filename='laundry_orders.xlsx';
            return Excel::download(new LaundryOrderExport($params), $filename);
        } else {
            return view('backend/laundry/list',$this->data);
        }
    }
  
}