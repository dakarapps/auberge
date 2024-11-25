<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $guarded = ['id'];
	protected $with = ['reservation_data','orders_items','order_history'];
	function reservation_data(){
	 	return $this->hasOne('App\Models\Reservation','id','reservation_id')->with('booked_rooms');
	}
	function order_history(){
	 	return $this->hasMany('App\Models\OrderHistory','order_id','id')->where('is_book',1);
	}
	function last_order_history(){
	 	return $this->hasOne('App\Models\OrderHistory','order_id','id')->where('is_book',1)->orderBy('id','DESC');
	}
	function orders_items(){
	 	return $this->hasMany('App\Models\OrderItem','order_id','id')->where('status','!=',4);
	}
}
