<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	protected $guarded = ['id'];
	protected $with = ['from_user','to_user'];
	function from_user(){
        return $this->hasOne('App\Models\User','id','notifi_from');
    }
    function to_user(){
        return $this->hasOne('App\Models\User','id','notifi_to');
    }
}
