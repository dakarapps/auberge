<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $guarded=['id'];
    function user_info(){
        return $this->hasOne('App\Models\User','id','user_id');
    }
} 