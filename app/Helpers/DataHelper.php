<?php 
use App\Models\Permission;
use App\Models\Setting;
use App\Models\Reservation;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\BookedRoom;
use App\Models\Amenities;
use App\Models\Unit;
use App\Models\Customer;
use App\Models\Country;
use App\Models\PaymentHistory;
use App\Models\DynamicDropdown;
use App\Models\User;
use App\Models\Role;
use App\Models\ExpenseCategory;
use App\Models\Notification;
use App\Models\Language;
use App\Models\LanguageTranslation;
use App\Models\Vendor;
use App\Models\LaundryOrder;

function getPaginationNum($num = 10){
    return $num;
}

function getCacheKey($key){
    $num = Auth::user() ? Auth::user()->id : date('ymd');
    return $key.'_'.$num;
}

function removeCacheKeys($key = null){
    if($key){
        Cache::forget($key);
    } else {
        Cache::flush();
    }
    return true;
}

function getLangages(){
    return Language::where('status', 1)->pluck('lang_name','lang_code');
}

function lang_trans($key){
    $defaultLang = 'en';
    $cacheKey = getCacheKey('langTranslationsCache');
    if(isset(Session::get('settings')['site_language'])){
        $defaultLang = Session::get('settings')['site_language'];
    }
    if (Cache::has($cacheKey)){
       $lang = Cache::get($cacheKey);
    } else {
        $lang = LanguageTranslation::where('pannel', 'backend')->pluck($defaultLang, 'lang_key')->toArray();
        Cache::put($cacheKey, $lang, config('constants.CACHING_TIME'));
    }
    if(isset($lang[$key])){
        return $lang[$key];
    }
    return $key;
}

function getAuthUserInfo($info = 'all'){
    $user = Auth::user() ? Auth::user() : null;
    
    if($info == 'id'){
      return $user->id;  
    }
    
    $user->additional_info = null;
    if($user){
        $customerInfo = Customer::where('user_id', $user->id)->first();
        if($customerInfo) {
            $user->additional_info = $customerInfo;
        }
    }
    return $user;
}
function getCustomerInfo($customerId){
    return Customer::where('id', $customerId)->first();
}
function setSettings(){
    $settings = Setting::pluck('value','name');
    Session::put('settings', $settings);
    return $settings;
}
function getSettings($clm=null){
    // if(Session::get('settings')){
    //     $settings = Session::get('settings');
    // } else {
        $settings = setSettings();
    //}

    if($clm==null){
        return $settings;
    }
    if(isset($settings[$clm])){
        return $settings[$clm];
    }
    return '';
}
function getDynamicDropdownById($id, $clm = 'all'){
    $data = DynamicDropdown::whereId($id)->first();
    if($data){
        if($clm != 'all'){
            return $data->{$clm};
        }
    }
    return $data;
}
function getDynamicDropdownRecord($where){
    return DynamicDropdown::where($where)->first();
}
function getDynamicDropdownList($dropdownName){
    $data = DynamicDropdown::where('dropdown_name', $dropdownName)->where('is_deleted', 0)->where('status', 1)->get();
    $list = [];
    if($data){
        foreach ($data as $key => $value) {
            $list[$value->id] = $value->dropdown_value;
        }
    }
    return $list;
}
function getCountries(){
    return Country::orderBy('name', 'ASC')->pluck('name','id');
}
function getUnits(){
    return getDynamicDropdownList('measurement');
}
function getRoomList($listType = 1){
    if($listType==2){
        $roomList = [];
        $rooms = Room::whereStatus(1)->where('is_deleted', 0)->orderBy('room_name','ASC')->get();
        if($rooms->count()){
            foreach ($rooms as $key => $value) {
                $roomList[$value->id] = $value->room_name.' (RoomNo.: '.$value->room_no.' | Type: '.ucfirst($value->room_type->is_type).')';
            }
        }
        return $roomList;
    }
    return Room::select('id',DB::raw('CONCAT(room_no, " (", room_name,")") AS title'))->whereStatus(1)->whereIsDeleted(0)->orderBy('room_no','ASC')->pluck('title','id');
}
function getRoomByNum($roomNum){
    return Room::where('room_no', $roomNum)->first();
}
function getRoomById($roomId){
    return Room::where('id', $roomId)->first();
}
function getRoomTypeById($id){
    return RoomType::where('id', $id)->first();
}
function getRoomTypesList($listType = 'original'){
    if($listType == 'custom'){
        return RoomType::select('id',DB::raw('CONCAT(title, " (Price: ", base_price,")") AS title'))->whereStatus(1)->whereIsDeleted(0)->orderBy('order_num','ASC')->pluck('title','id');
    }
    if($listType == 'original'){
        return RoomType::whereStatus(1)->whereIsDeleted(0)->orderBy('order_num','ASC')->pluck('title','id');
    }
}
function getRoomTypesListWithRooms(){
    return RoomType::with('rooms')->whereStatus(1)->whereIsDeleted(0)->orderBy('order_num','ASC')->get();
}
function getReservationById($id){
    return Reservation::whereId($id)->first();
}
function getAmenitiesById($id){
    return Amenities::where('id', $id)->first();
}
function getCustomerByUserId($userId){
    return Customer::whereUserId($userId)->first();
}
function getCustomerList($type='pluck'){
    if($type == 'get') return Customer::select('id',DB::raw('CONCAT(name, " (", mobile,")") AS display_text'))->whereNotNull('name')->whereIsDeleted(0)->orderBy('name','ASC')->get();
    else return Customer::select('id',DB::raw('CONCAT(name, " (", mobile,")") AS display_text'))->whereIsDeleted(0)->orderBy('name','ASC')->pluck('display_text','id');
}
function getHousekeeperList($type='pluck'){
    if($type == 'get') return User::select('id',DB::raw('CONCAT(name, " (", mobile,")") AS display_text'))->whereNotNull('name')->whereIsDeleted(0)->where('role_id', 7)->orderBy('name','ASC')->get();
    else return User::select('id',DB::raw('CONCAT(name, " (", mobile,")") AS display_text'))->whereIsDeleted(0)->orderBy('name','ASC')->where('role_id', 7)->pluck('display_text','id');
}
function getVendorList($type='pluck'){
    if($type == 'get') Vendor::with('category', 'country')->where('is_deleted', 0)->orderBy('vendor_name','ASC')->get();
    else return Vendor::where('is_deleted', 0)->orderBy('vendor_name','ASC')->pluck('vendor_name','id');
}
function getExpenseCategoryList(){
    return ExpenseCategory::whereStatus(1)->orderBy('name','ASC')->pluck('name','id');
}
function getRoomsWithPrice($params = []){
    $totalNight = 0;
    if(isset($params['checkin_date']) && isset($params['checkout_date'])){
        $checkinDate = dateConvert($params['checkin_date']);
        $checkoutDate = dateConvert($params['checkout_date']);
        $bookingDateRange = dateRange($checkinDate, $checkoutDate,'+1 day','Y-m-d');
        $totalNight = dateDiff($checkinDate, $checkoutDate);
    }

    $roomTypesQuery=RoomType::with('rooms','room_price')->whereStatus(1)->whereIsDeleted(0)->orderBy('order_num','ASC');
    if(isset($params['room_type_ids'])){
        $roomTypesQuery->whereIn('id', $params['room_type_ids']);
    }
    $roomTypes = $roomTypesQuery->get();
    $datalist = [];
    $seasonsDatesArr = [];
    foreach ($roomTypes as $key => $roomTypeVal) {
        $roomBasePrice = $roomTypeVal->base_price;
        $params = [
            'bookingDateRange'=>$bookingDateRange,
            'roomBasePrice'=>$roomBasePrice,
            'totalNight'=>$totalNight,
            'dateRange'=>[],
            'roomSeasonPrice'=>0,
        ];
        $priceList = getDatesWithPrice($params);
        $dataArr = [
            'title'=> $roomTypeVal->title,
            'is_type'=> $roomTypeVal->is_type,
            'adult_capacity'=> $roomTypeVal->adult_capacity,
            'kids_capacity'=> $roomTypeVal->kids_capacity,
            'base_price'=> $roomBasePrice,
            'rooms'=>$roomTypeVal->rooms,
            'dates_with_price'=> $priceList[0],
            'total_price'=> $priceList[1],
        ];

        
        if($roomTypeVal->room_price->count()){
            foreach ($roomTypeVal->room_price as $roomPriceVal) {
                if($roomPriceVal->season_info){
                    $dateRange = dateRange($roomPriceVal->season_info->start_date, $roomPriceVal->season_info->end_date,'+1 day','Y-m-d');
                    
                    foreach ($dateRange as $sDate) {
                        $dayName = strtolower(date('D', strtotime($sDate)));
                        $daysArr = splitText($roomPriceVal->season_info->days);
                        if(in_array($dayName, $daysArr)){
                            $seasonsDatesArr[$sDate] = $roomPriceVal->price;
                        }
                    }
                }
            }
            $params['dateRange'] = $seasonsDatesArr;
            $priceList = getDatesWithPrice($params);
            $dataArr['dates_with_price'] = $priceList[0];
            $dataArr['total_price'] = $priceList[1];
        }        
        $datalist[$roomTypeVal->id] = $dataArr;
    }
    return $datalist;
}
function getDatesWithPrice($params){
    $dateWisePrice = [];
    $totalPrice = 0;
    foreach ($params['bookingDateRange'] as $bdKey=>$bookingDateVal) {
        $roomPrice = ($bdKey < $params['totalNight']) ? $params['roomBasePrice'] : 0;
        if(isset($params['dateRange'][$bookingDateVal]) && $bdKey < $params['totalNight']){
            $roomPrice = ($bdKey < $params['totalNight']) ? $params['dateRange'][$bookingDateVal] : 0;
        }
        $totalPrice += $roomPrice;
        $dateWisePrice[$bookingDateVal]=['price'=>$roomPrice];
    }
    return [$dateWisePrice, numberFormat($totalPrice)];
}
function getBookedRooms($params = []){
    $bookedRooms = [];
    $query = Reservation::with('booked_rooms')->whereStatus(1)->whereIsDeleted(0)->whereIsCheckout(0)->orderBy('created_at','DESC');
    if(isset($params['reservation_id'])){
        $query->where('id', $params['reservation_id']);
    }
    $reservationData = $query->get();

    $isBooked = true;
    $dateRange = null;
    if(isset($params['checkin_date']) && isset($params['checkout_date'])){
        $dateRange = dateRange(($params['checkin_date']), ($params['checkout_date']),'+1 day','Y-m-d H:i:s');
    }
    if($reservationData->count()>0){
        foreach($reservationData as $val){           
            if($val->booked_rooms){
                foreach($val->booked_rooms as $k=>$v){
                    if($dateRange){
                        $isBooked = false;
                        if(in_array(dateConvert($v->check_in), $dateRange)){
                            $isBooked = true;
                        }
                        if(in_array(dateConvert($v->check_out), $dateRange)){
                            $isBooked = true;
                        } 
                        if(isset($params['checkin_date'])){
                            if(new DateTime($v->check_out) > new DateTime($params['checkin_date'])){
                                $isBooked = true;
                            } else {
                                $isBooked = false; 
                            } 
                        }                     
                    }
                    
                    if($v->is_checkout == 0 && $isBooked){
                        $bookedRooms[$v->room_id] = $v->room_id;
                    }
                }
            }
        }
    }
    return $bookedRooms;
}

function getAllBookedRooms(){
    $bookedRooms = [];
    $reservationData = Reservation::with('booked_rooms')->whereStatus(1)->whereIsDeleted(0)->whereIsCheckout(0)->orderBy('created_at','DESC')->get();
    if($reservationData && $reservationData->count()>0){
        foreach($reservationData as $val){
            if($val->booked_rooms){
                foreach($val->booked_rooms as $k=>$v){

                    $date_1 = new DateTime(date('Y-m-d'));
                    $date_2 = new DateTime($v->check_out);
                    $isValidDate = ($date_1 < $date_2) ? true : false;

                    if($v->is_checkout == 0 && $isValidDate){
                        $bookedRooms[$v->room_id] = $v->room_id;
                    }
                }
            }
        }
    }
    return $bookedRooms;
}

function getCalendarEventsByDate($params){
    $datalist = [];
    $bookedRooms = [];
    $bookedDates = [];
    $paramsDatesRange = $dateRange = dateRange(dateConvert($params['start_date']), dateConvert($params['end_date']));

    $bookedRoomsData = BookedRoom::whereIsCheckout(0)->orderBy('check_in','DESC')->get();
    
    if($bookedRoomsData && $bookedRoomsData->count()>0){
        foreach($bookedRoomsData as $k=>$v){
            $dateRange = dateRange(dateConvert($v->check_in), dateConvert($v->check_out));
            foreach ($dateRange as $key => $date) {
                $bookedRooms[$v->room_id][dateConvert($date, 'Ymd')] = $v->room_id;
            }
            $bookedDates[] = ['roomId'=>$v->room_id, 'dateRange'=>$dateRange];
            $datalist[] = [
                'title'=>$v->room->room_no.' ('.$v->room_type->title.')',
                'start'=>dateConvert($v->check_in).'T01:00:00+05:30',
                'end'=>dateConvert($v->check_out).'T01:00:00+05:30',
                'color'=>'#f56868',
                'url'=>route('check-out-room',[$v->reservation_id]),
                'extendedProps'=>['is_booked'=>1, 'room_info'=>$v->room],
            ];

        }
    }

    $allRooms = Room::whereIsDeleted(0)->whereStatus(1)->get();
    foreach ($allRooms as $key => $room) {
        $dates = (isset($bookedDates[$room->id])) ? $bookedDates[$room->id] : [];
        foreach ($paramsDatesRange as $d) {
            //if(count($bookedRooms) > 0){
                if(!isset($bookedRooms[$room->id][dateConvert($d, 'Ymd')]) ){
                    $datalist[] = [
                        'title'=>$room->room_no.' ('.$room->room_type->title.')',
                        'start'=>$d.'T01:00:00+05:30',
                        'end'=>$d.'T01:00:00+05:30',
                        'color'=>'#02b92e',
                        'url'=>route('quick-check-in', ['step'=>1]),
                        'extendedProps'=>['is_booked'=>0, 'room_info'=>$room]
                    ];
                }
            //}
        }
    }
    return $datalist;
}
function getWeekDaysList($params){
    $list = config('constants.WEEK_DAYS');
    $data = [];
    foreach($list as $key => $val){
        $weekName = ($params['is_name'] == 'full') ? lang_trans('txt_day_full_'.$key) : lang_trans('txt_day_short_'.$key);
        if($params['type'] == 1)
            $data[$key] = $weekName;
    }
    return $data;
}
function getCurrencyList(){
    $list = config('currencies')['CURRENCY_LIST'];
    $currencies = [];
    foreach($list as $val){
        $currencies[$val['code']] = $val['code'].' ('.$val['country'].')';
    }
    return $currencies;
}
function getCurrencySymbol($isCode=false){
    $settings = getSettings();
    if(isset($settings['currency_symbol']) && $settings['currency_symbol']!='' && !$isCode){
        return $settings['currency_symbol'];
    }
    if(isset($settings['currency']) && $settings['currency']!=''){
        return $settings['currency'];
    }
    return ($isCode) ? 'USD' : '$';
}
function getCountryList(){
    $list = config('constants.COUNTRY_LIST');
    foreach($list as $k=>$val){
        $countries[$val['name']] = $val['name'];
    }
    return $countries;
}
function getRoles(){
    $roles = [];
    $cacheKey = getCacheKey('rolesListCache');
    if (Cache::has($cacheKey)){
        $roles = Cache::get($cacheKey);
    } else {
        $roles = Role::pluck('slug','id')->toArray();
        Cache::put($cacheKey, $roles, config('constants.CACHING_TIME'));
    }
    return $roles;
}
function getFormatedPermissionsList($permissions){
    $roles = getRoles();
    $permissionArr = [];
    if($permissions){
        foreach($permissions as $k=>$val){
            $permissionArr[$val->slug] = $val->{$roles[Auth::user()->role_id]};
        }
    }
    return $permissionArr;
}
function getPermissions($type){
    $permissionArr = [];    
    if($type=='menu'){
        $cacheKey = getCacheKey('menuPermissionListCache');
        if (Cache::has($cacheKey)){
            $permissionArr = Cache::get($cacheKey);
        } else {
            $permissions = Permission::where('permission_type','menu')->get();
            $permissionArr = getFormatedPermissionsList($permissions);
            Cache::put($cacheKey, $permissionArr, config('constants.CACHING_TIME'));
        }
    } else if($type=='route'){
        $cacheKey = getCacheKey('routePermissionListCache');
        if (Cache::has($cacheKey)){
            $permissionArr = Cache::get($cacheKey);
        } else {
            $permissions = Permission::where('permission_type','route')->get();
            $permissionArr = getFormatedPermissionsList($permissions);
            Cache::put($cacheKey, $permissionArr, config('constants.CACHING_TIME'));
        }
    }
    return $permissionArr;
}
function getMenuPermission(){
    return getPermissions('menu');
}
function getRoutePermission(){
    return getPermissions('route');
}
function isPermission($route){
    $permissionArr = getRoutePermission();
    if(isset($permissionArr[$route])){
        if($permissionArr[$route]==1){
            return true;
        }
    }
    return false;
}

function checkFile($filename,$path,$default=null) {
    $src=url('public/images/'.$default);
    $path='public/'.$path;
    if($filename != NULL && $filename !='' && $filename != '0')
    {
        $file_path = app()->basePath($path.$filename);
        if(File::exists($file_path)){
            $src=url($path.$filename);
        } 
    }
    return $src;      
}
function unlinkImg($img,$path) {
    if($img !=null || $img !='')
    {
        $path='public/'.$path;
        $image_path = app()->basePath($path.$img);
        if(File::exists($image_path)) 
            unlink($image_path);
    }       
}

function getNextInvoiceNo($type=null){
    $initNum = 1;
    if($type=='ph'){
        //$data = PaymentHistory::whereNotNull('transaction_id')->orderBy('transaction_id','DESC')->first();
        //return ($data) ? $data->transaction_id + 1 : $initNum;
        $data = genRandomValue(8, 'mix');
        return $data;
    }
    if($type=='orders'){
        $data = Order::whereNotNull('invoice_num')->orderBy('invoice_num','DESC')->first();
        return ($data) ? $data->invoice_num + 1 : $initNum;
    } 
    if($type=='laundry_order'){
        $data = LaundryOrder::whereNotNull('order_num')->orderBy('order_num','DESC')->first();
        return ($data) ? $data->order_num + 1 : $initNum;
    }
    $data = Reservation::whereNotNull('invoice_num')->orderBy('invoice_num','DESC')->first();
    return ($data) ? $data->invoice_num + 1 : $initNum;
}
function getStatusBtn($status, $listType = 1){
    $statusList = config('constants.LIST_STATUS');
    $btnClass = ['btn-default', 'btn-success', 'btn-danger'];
    if($listType == 2){
        $statusList = config('constants.LIST2_STATUS');
    }
    else if($listType == 3){
        $btnClass = ['btn-default', 'btn-primary', 'btn-success'];
        $statusList = config('constants.LIST_HOUSEKEEPING_ORDER_STATUS');
    }
    else if($listType == 4){
        $btnClass = ['btn-default', 'btn-primary', 'btn-info', 'btn-success'];
        $statusList = config('constants.LIST_LAUNDRY_ORDER_STATUS');
    }

    $txt = '';
    if(isset($statusList[$status])){
        $txt = $statusList[$status];
    }
    if($status==1){
        return '<button type="button" class="btn btn-xs '.$btnClass[$status].'">'.$txt.'</button>';
    } if($status==2){
        return '<button type="button" class="btn btn-xs '.$btnClass[$status].'">'.$txt.'</button>';
    } if($status==3){
        return '<button type="button" class="btn btn-xs '.$btnClass[$status].'">'.$txt.'</button>';
    } else {
        return '<button type="button" class="btn btn-xs '.$btnClass[$status].'">'.$txt.'</button>';
    }
}
function getTableNums($excOrderId=0){
    $bookedTablesQuery =  OrderHistory::where('is_book',1);
    if($excOrderId>0){
        $bookedTablesQuery->where('order_id','<>',$excOrderId);
    }
    $bookedTables =  $bookedTablesQuery->pluck('table_num')->toArray();
    $tableNums = [];
    for($i=1; $i<=50; $i++){
        if(!in_array($i,$bookedTables)) $tableNums[$i] = $i;
    }
    return $tableNums;
}

function isTableBook($tableNum=0){
    return OrderHistory::where('table_num',$tableNum)->where('is_book',1)->orderBy('id','DESC')->first();
}
function getOrderInfo($id){
    return Order::where('reservation_id',$id)->first();
}

function getNotifications(){
    $where = ['notifi_to'=> Auth::user()->id];
    $totalUnread = Notification::where($where)->whereStatus(0)->count();
    $list = Notification::where($where)->whereStatus(0)->orderBy('notifi_datetime')->orderBy('status', 'ASC')->get();
    return ['totalUnread'=>$totalUnread, 'datalist'=>$list];
}

function gstCalc($amount,$type,$gstPerc=null,$cgstPerc=null){
    $gstAmount = $cgstAmount = 0;
    if($type=='room_amount'){
        $gstAmount = ($gstPerc/100)*$amount;
        $cgstAmount = ($cgstPerc/100)*$amount;
    } else {
        $gstAmount = ($gstPerc/100)*$amount;
        $cgstAmount = ($cgstPerc/100)*$amount;
    }
    
    return ['gst'=>$gstAmount, 'cgst'=>$cgstAmount];
} 
function getDateWisePriceList($data){
    $decodedData = json_decode($data, true);
    $total = 0;
    if($decodedData && count($decodedData)){
        foreach ($decodedData as $key => $value) {
           $total +=  $value['price'];
        }
    }
    return [$decodedData ? $decodedData : [], $total];
}
function calcFinalAmount($val, $isTotalWithGst = 0){
    $settings = getSettings();
    $totalAmount = 0;  
    if($val->booked_rooms){
        foreach($val->booked_rooms as $key=>$roomInfo){
            $durOfStay = dateDiff(dateConvert($roomInfo->check_in), dateConvert($roomInfo->check_out), 'days');
            $durOfStay = ($durOfStay == 0) ? 1 : $durOfStay;

            if($roomInfo->date_wise_price){
                $decodedData = getDateWisePriceList($roomInfo->date_wise_price);
                $totalAmount += $decodedData[1];
            } else {
                $perRoomPrice = ($durOfStay * $roomInfo->room_price);
                $totalAmount = $totalAmount+$perRoomPrice;
            }
        }
    }

    $gstPerc = $val->gst_perc;
    $cgstPerc = $val->cgst_perc;      
    if($val->is_checkout == 0 && $isTotalWithGst == 1){
        $gstPerc = $settings['gst'];
        $cgstPerc = $settings['cgst'];
    }

    $gstCal = gstCalc($totalAmount,'room_amount', $gstPerc, $cgstPerc);
    
    $totalRoomAmountGst = $gstCal['gst'];
    $totalRoomAmountCGst = $gstCal['cgst'];
    $totalRoomAmountDiscount = ($val->discount > 0 ) ? $val->discount : 0;
    $advancePayment = ($val->advance_payment > 0 ) ? $val->advance_payment : 0;
    $additionalAmount = ($val->addtional_amount > 0 ) ? $val->addtional_amount : 0;

    $finalRoomAmount = $totalAmount+$totalRoomAmountGst+$totalRoomAmountCGst-$advancePayment-$totalRoomAmountDiscount;


    //start calculation of order amount
    $totalOrderAmountGst = $totalOrderAmountCGst = $totalOrderAmountDiscount = $orderGstPerc = $orderCGstPerc = 0;
    $gstFoodApply = 1;

    $orderInfo = getOrderInfo($val->id);
    if($orderInfo){
        $orderGstPerc = $orderInfo->gst_perc;
        $orderCGstPerc = $orderInfo->cgst_perc;

        $totalOrderAmountDiscount = $orderInfo->discount;
        $gstFoodApply = ($orderInfo->gst_apply==1) ? 1 : 0;
    }
    

    $totalOrdersAmount = 0;
    if($val->orders_items->count()>0){
        foreach($val->orders_items as $k=>$orderVal){
            $totalOrdersAmount = $totalOrdersAmount + ($orderVal->item_qty*$orderVal->item_price);
        }
    }

    if($isTotalWithGst == 1){
        $orderGstPerc = $settings['food_gst'];
        $orderCGstPerc = $settings['food_cgst'];
    }
    $gst = gstCalc($totalOrdersAmount,'food_amount',$orderGstPerc,$orderCGstPerc);
    $totalOrderAmountGst = $gst['gst'];
    $totalOrderAmountCGst = $gst['cgst'];

    $finalOrderAmount = ($totalOrdersAmount+$totalOrderAmountGst+$totalOrderAmountCGst-$totalOrderAmountDiscount);

    return [
        'totalRoomGstPerc' => checkAmount($gstPerc),
        'totalRoomCGstPerc' => checkAmount($cgstPerc),
        'totalRoomAmountGst' => checkAmount($totalRoomAmountGst),
        'totalRoomAmountCGst' => checkAmount($totalRoomAmountCGst),
        'totalRoomAmountDiscount'=> checkAmount($totalRoomAmountDiscount),
        'subtotalRoomAmount'=> checkAmount($totalAmount),
        'finalRoomAmount'=> checkAmount($finalRoomAmount),

        'totalOrderGstPerc' => checkAmount($orderGstPerc),
        'totalOrderCGstPerc' => checkAmount($orderCGstPerc),
        'totalOrderAmountGst'=> checkAmount($totalOrderAmountGst),
        'totalOrderAmountCGst'=> checkAmount($totalOrderAmountCGst),
        'totalOrderAmountDiscount'=> checkAmount($totalOrderAmountDiscount),
        'subtotalOrderAmount'=> checkAmount($totalOrdersAmount),
        'finalOrderAmount'=> checkAmount($finalOrderAmount),
        'gstFoodApply'=> checkAmount($gstFoodApply),

        'advancePayment'=> checkAmount($advancePayment),
        'additionalAmount'=> checkAmount($additionalAmount),
    ];
}

function calcLaundryAmount($val, $isTotalWithGst = 0){
    $gstApply = 0;
    $gstPerc = $cgstPerc = $gstAmount = $cgstAmount = $totalDiscount = $subtotalAmount = $totalAmount = 0;
    if($val){
        $settings = getSettings();
        $subtotalAmount = 0;  
        if($val->order_items){
            foreach($val->order_items as $key=>$itemInfo){
                $price = ($itemInfo->rcv_item_qty * $itemInfo->item_price);
                $subtotalAmount += $price;
            }
        }

        $gstApply = ($val->gst_apply==1) ? 1 : 0;
        $gstPerc = $val->gst_perc;
        $cgstPerc = $val->cgst_perc;      
        if($isTotalWithGst == 1){
            $gstPerc = $settings['laundry_gst'];
            $cgstPerc = $settings['laundry_cgst'];
        }

        $gstCal = gstCalc($subtotalAmount,'laundry_amount', $gstPerc, $cgstPerc);
        
        $gstAmount = $gstCal['gst'];
        $cgstAmount = $gstCal['cgst'];
        $totalDiscount = ($val->discount > 0 ) ? $val->discount : 0;
        $totalAmount = $subtotalAmount+$gstAmount+$cgstAmount-$totalDiscount;
    }
    
    return [
        'gstApply' => $gstApply,
        'gstPerc' => checkAmount($gstPerc),
        'cgstPerc' => checkAmount($cgstPerc),
        'gstAmount' => checkAmount($gstAmount),
        'cgstAmount' => checkAmount($cgstAmount),
        'totalDiscount'=> checkAmount($totalDiscount),
        'subtotalAmount'=> checkAmount($subtotalAmount),
        'totalAmount'=> checkAmount($totalAmount),
    ];
}

function checkAmount($val){
    return ($val > 0) ? $val : 0;
}

function getMaxDiscount($amount,$perc=100){
    //$maxDiscount = ($perc/100)*$amount;
    $maxDiscount = $amount;
    return $maxDiscount;
}  

function stockInfoColor($stock){
    if($stock < 10) return 'bg-danger';
    if($stock < 50) return 'bg-warning';
    return "";
}
function checkboxTickOrNot($value, $val_from=null){
    if($val_from=='view'){
        if($value == 1) return true; else return false;
    } else {
        if($value == 'on') return 1; else return 0;
    }
}
function getIcon($icon, $defaultIcon='ti-shine'){
    return $icon ? $icon : $defaultIcon;
}
function getPaymentPurpose($type){
    $datalist = config('constants.PAYMENT_PURPOSE');
    if(isset($datalist[$type])){
        return $datalist[$type];
    }
    return '';
}
function getPaymentModeById($id){
    $datalist = config('constants.PAYMENT_MODES');
    if(isset($datalist[$id])){
        return $datalist[$id];
    }
    return 'Cash';
}
function getPaymentOptions($isList = 'admin'){
    $datalist = config('constants.PAYMENT_MODES');
    if($isList == 'admin'){
        return $datalist;
    }
    if($isList == 'front'){
        $excludeIds = [1, 2, 3, 4, 5, 6];
        foreach ($excludeIds as $value) {
            unset($datalist[$value]);
        }
        return $datalist;
    }
}
function getConstants($list, $exclude = []){
    if($list == 'LIST_LAUNDRY_ORDER_STATUS'){
        $datalist = config('constants.LIST_LAUNDRY_ORDER_STATUS');
        if(count($exclude)){
            foreach ($exclude as $value) {
                unset($datalist[$value]);
            }
        }
        return $datalist;
    }
    if($list == 'LIST_ROOM_CATEGORY'){
        return config('constants.LIST_ROOM_CATEGORY');
    }
    if($list == 'PAYMENT_PURPOSE'){
        return config('constants.PAYMENT_PURPOSE');
    }
    return null;
}
function getBookingStatus($data){
    $status = ['Pending', 'Confirmed', 'Completed', 'Expired'];
    $statusText = 'Pending';
    $statusClass = "warning";

    $daysDiff = dateDiff($data->check_out, date('Y-m-d'), 'daysWIthSymbol');

    if($data->is_confirmed == 1){
        $statusText = $status[1];
        $statusClass = "info";

    }
    if($daysDiff < 0 && $data->is_confirmed == 0){
        $statusText = $status[3];
        $statusClass = "danger";

    }
    if($daysDiff < 0){
        $statusText = $status[2];
        $statusClass = "success";

    }
    return ['status'=>$statusText, 'statusClass'=>$statusClass];
}
function getSplashMsg($params){
    $data = ['success'=>'', 'error'=>''];
    if(isset($params['type']) && $params['type'] == 'add_update'){
        if(isset($params['id']) && $params['id'] > 0){
            $data['success'] = config('constants.FLASH_REC_UPDATE_1');
            $data['error'] = config('constants.FLASH_REC_UPDATE_0');
        } else {
            $data['success'] = config('constants.FLASH_REC_ADD_1');
            $data['error'] = config('constants.FLASH_REC_ADD_0');
        }
    }
    return $data;
}
function getLangForUpdateDisable(){
    return ['en', 'hi'];
}