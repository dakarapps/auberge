<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSection extends Model
{
    protected $guarded=['id'];
    function banners(){
	 	return $this->hasMany('App\Models\MediaFile','tbl_id','id')->where('type','home_banner')->inRandomOrder();
	}
}
