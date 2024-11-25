<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $guarded = ['id'];
	protected $with = ['unit'];
	function unit(){
	 	return $this->hasOne('App\Models\Unit','id','measurement');
	}
}
