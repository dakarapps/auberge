<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
	protected $guarded = ['id'];
	function category(){
	 	return $this->hasOne('App\Models\ExpenseCategory','id','category_id');
	}
	function attachments(){
	 	return $this->hasMany('App\Models\MediaFile','tbl_id','id')->where('type','expenses');
	}
}
