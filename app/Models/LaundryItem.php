<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LaundryItem extends Model
{
	protected $guarded = ['id'];
	function vendor_info(){
        return $this->hasOne('App\Models\Vendor','id','vendor_id');
    }
}
