<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
	protected $guarded = ['id'];
	function category(){
	 	return $this->hasOne('App\Models\FoodCategory','id','category_id');
	}
}
