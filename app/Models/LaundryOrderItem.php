<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LaundryOrderItem extends Model
{
	protected $guarded = ['id'];
	protected $with = ['item_info'];
    function item_info(){
	 	return $this->hasOne('App\Models\LaundryItem','id','item_id');
	}
}
