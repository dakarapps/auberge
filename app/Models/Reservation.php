<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
	protected $guarded = ['id'];
	protected $with = ['customer','room_type','id_cards'];
	function customer(){
	 	return $this->hasOne('App\Models\Customer','id','customer_id');
	}
	function id_cards(){
	 	return $this->hasMany('App\Models\MediaFile','tbl_id','id')->where('type','id_cards');
	}
	function room_type(){
	 	return $this->hasOne('App\Models\RoomType','id','room_type_id');
	}
	function orders_items(){
	 	return $this->hasMany('App\Models\OrderItem','reservation_id','id')->where('status','!=',4);
	}
	function orders_info(){
	 	return $this->hasOne('App\Models\Order','reservation_id','id');
	}
	function persons(){
	 	return $this->hasMany('App\Models\PersonList','reservation_id','id');
	}
	function booked_rooms(){
	 	return $this->hasMany('App\Models\BookedRoom','reservation_id','id');
	}
}
