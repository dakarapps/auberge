<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
	protected $guarded = ['id'];
	function category(){
	 	return $this->hasOne('App\Models\VendorCategory','id','category_id')->where('is_deleted', 0);
	}
	function country(){
	 	return $this->hasOne('App\Models\Country','id','vendor_country');
	}
}
