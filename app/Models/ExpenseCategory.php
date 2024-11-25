<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
	protected $guarded = ['id'];
	function expenses(){
	 	return $this->hasMany('App\Models\Expense','category_id','id')->where('status',1);
	}
}
