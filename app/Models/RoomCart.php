<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class RoomCart extends Model
{
	protected $guarded=['id'];
	protected $with=['room'];
	function room(){
	 	return $this->hasOne('App\Models\Room','id','room_id');
	}
}
