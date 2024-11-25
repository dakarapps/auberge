<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
	protected $guarded = ['id'];
	protected $with = ['attachments'];
	function rooms(){
	 	return $this->hasMany('App\Models\Room','room_type_id','id')->whereStatus(1)->whereIsDeleted(0)->orderBy('order_num','ASC');
	}
	function attachments(){
	 	return $this->hasMany('App\Models\MediaFile','tbl_id','id')->where('type','room_type_image');
	}
	function room_price(){
	 	return $this->hasMany('App\Models\RoomPrice','room_type_id','id');
	}
}
