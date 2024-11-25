<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
	protected $guarded = ['id'];
	function food_items(){
	 	return $this->hasMany('App\Models\FoodItem','category_id','id')->where('status',1)->where('is_deleted',0)->orderBy('name','ASC');
	}
}
