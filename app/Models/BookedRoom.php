<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BookedRoom extends Model
{
	protected $guarded = ['id'];
	protected $with = ['room','room_type'];
	function room(){
	 	return $this->hasOne('App\Models\Room','id','room_id');
	}
	function room_type(){
	 	return $this->hasOne('App\Models\RoomType','id','room_type_id');
	}
}
