<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LaundryOrder extends Model
{
	protected $guarded = ['id'];
	protected $with = ['vendor_info','room_info',];
	function vendor_info(){
        return $this->hasOne('App\Models\Vendor','id','vendor_id');
    }
    function room_info(){
        return $this->hasOne('App\Models\Room','id','room_id');
    }
	function order_items(){
	 	return $this->hasMany('App\Models\LaundryOrderItem','laundry_order_id','id');
	}
	function invoice(){
	 	return $this->hasOne('App\Models\MediaFile','tbl_id','id')->where('type','laundry_invoice');
	}
}
