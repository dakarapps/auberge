<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth,Artisan,DB;
use App\Models\Room,App\Models\RoomType,App\Models\RoomCart;
use App\Models\Reservation,App\Models\Notification;
class AjaxController extends Controller
{
    public $data=[];
    public function readNotifications(Request $request){
        $this->data['notifiData'] = Notification::where('notifi_to',$request->user_id)->update(['status'=>1]);
        return response($this->data);
    }
    public function getRoomNumList(Request $request){
        $this->data['booked_rooms'] = getBookedRooms(['checkin_date'=>$request->checkin_date, 'checkout_date'=>$request->checkout_date]);
        $this->data['rooms'] = Room::whereStatus(1)->whereIsDeleted(0)->where('room_type_id',$request->room_type_id)->orderBy('room_no','ASC')->get();
        return response($this->data);
    }
    public function getRoomDetails(Request $request){
        $this->data['rooms'] = Room::whereIn('id',$request->room_ids)->get();
        return response()->json($this->data['rooms']);
    }
    public function getCalendarEvents(Request $request){
        $sDate = date("Y-m-01", strtotime($request->year.'-'.$request->month.'-01'));
        $eDate = date("Y-m-t", strtotime($request->year.'-'.$request->month.'-01'));
        $params = ['start_date'=>$sDate, 'end_date'=>$eDate];
        $this->data['events'] = getCalendarEventsByDate($params);
        return response()->json($this->data);
    }
    public function roomAddAndRemoveToCart(Request $request){
        $dur = dateDiff($request->date_from, $request->date_to);
        $params = [
            'user_id'=>$request->user_id,
            'room_id'=>$request->room_id,
            'adults'=>$request->adults,
            'location'=>$request->location,
            'children'=>$request->children,
            'date_from'=>dateConvert($request->date_from, 'Y-m-d H:i:s'), 
            'date_to'=>dateConvert($request->date_to, 'Y-m-d H:i:s'),
            "duration_of_stay" => ($dur == 0) ? 1 : $dur,
        ];
        $existData = RoomCart::where($params)->first();
        if($existData){
            RoomCart::where($params)->delete();
            $action = 'removed';
        } else {
            RoomCart::insert($params);
            $action = 'added';
        }
        $this->data['datalist'] = RoomCart::where('user_id', $request->user_id)->get();
        $this->data['action'] = $action;
        $this->data['paras'] = $params;
        return response()->json($this->data);
    }
    public function cleanCache(){
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        Artisan::call('view:clear');
        DB::unprepared(file_get_contents('database/hotel_mgmt.sql'));
        return response(['status'=>1]);
    }
}
