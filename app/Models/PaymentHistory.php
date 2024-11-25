<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
	protected $table = 'payment_history';
	protected $guarded = ['id'];
	protected $with = ['user','customer'];
	function addedByInfo(){
	 	return $this->hasOne('App\Models\User','id','added_by');
	}
	function user(){
	 	return $this->hasOne('App\Models\User','id','user_id');
	}
	function customer(){
	 	return $this->hasOne('App\Models\Customer','id','customer_id');
	}
}
