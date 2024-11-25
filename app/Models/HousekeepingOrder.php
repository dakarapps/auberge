<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class HousekeepingOrder extends Model
{
	protected $guarded = ['id'];
	protected $with = ['housekeeper','room_info', 'housekeeping_status'];
	function housekeeper(){
        return $this->hasOne('App\Models\User','id','housekeeper_id');
    }
    function room_info(){
        return $this->hasOne('App\Models\Room','id','room_id');
    }
    function housekeeping_status(){
        return $this->hasOne('App\Models\DynamicDropdown','id','housekeeping_status_id');
    }
}
