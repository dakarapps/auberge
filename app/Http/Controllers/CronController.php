<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User, App\Models\Product, App\Models\Notification;

class CronController extends Controller
{
    public $data=[];
    public function checkProductExpiry(){
        $datalist=Product::whereDate('expiry_date', '<', dateConvert(date('Y-m-d')))->whereIn('status',[1])->whereIsDeleted(0)->get();
        if($datalist && $datalist->count()){
            $users = User::whereIn('role_id',[2,3,4])->where('status', 1)->get();
            foreach ($datalist as $key => $value) {
                $res = Product::updateOrCreate(['id'=>$value->id], ['status'=> 2]);

                //send notifications
                foreach ($users as $k => $val) {
                    Notification::insert([
                        'json_data'=> json_encode($res),
                        'notifi_from'=> config('constants.SUPER_ADMIN_ID'),
                        'notifi_to'=> $val->id,
                        'notifi_type'=> 'product',
                        'notifi_msg'=> 'Product ('.$res->name.') is expired.',
                        'notifi_datetime'=> date('Y-m-d H:i:s'),
                        'status'=> 0,
                    ]);
                }
            }
        }
        return response('Total Update Records: '.$datalist->count());
    }
}
