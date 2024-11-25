<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
	protected $guarded = ['id'];
	protected $with = ['orders_items'];
	function order(){
	 	return $this->hasOne('App\Models\Order','id','order_id');
	}
	function orders_items(){
	 	return $this->hasMany('App\Models\OrderItem','order_history_id','id')->where('status','!=',4);
	}
}
