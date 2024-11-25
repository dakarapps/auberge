<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RoomPrice extends Model
{
	public $timestamps = false;
	protected $guarded = ['id'];
	protected $with = ['season_info'];
	function room_type(){
	 	return $this->hasOne('App\Models\RoomType','id','room_type_id');
	}
	function season_info(){
	 	return $this->hasOne('App\Models\Season','id','season_id');
	}
}
