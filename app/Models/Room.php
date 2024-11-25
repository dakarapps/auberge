<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
	protected $guarded = ['id'];
	protected $with = ['room_type', 'attachments'];
	function room_type(){
	 	return $this->hasOne('App\Models\RoomType','id','room_type_id');
	}
	function attachments(){
	 	return $this->hasMany('App\Models\MediaFile','tbl_id','id')->where('type','room_image');
	}
}
