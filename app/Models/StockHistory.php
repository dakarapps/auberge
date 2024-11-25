<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
	protected $table = 'stock_history';
	protected $guarded = ['id'];
	protected $with = ['user','product','room'];
	function user(){
	 	return $this->hasOne('App\Models\User','id','added_by');
	}
	function product(){
	 	return $this->hasOne('App\Models\Product','id','product_id');
	}
	function room(){
	 	return $this->hasOne('App\Models\Room','id','room_id');
	}
}
