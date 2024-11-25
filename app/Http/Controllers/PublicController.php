<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Artisan;
use App\Models\Language, App\Models\LanguageTranslation;

class PublicController extends Controller
{
    private $core;
    public $data=[];
    public function __construct()
    {
        $this->core=app(\App\Http\Controllers\CoreController::class);
        $this->middleware('auth');
    }

    public function index() {  
        
    }
    public function updateLangTransFromLocalFile(){
        Artisan::call('config:cache');
        $langList = array_reverse(config('lang_admin'));
        $count = 0;
        foreach ($langList as $key => $value) {
            $count+=1;
            LanguageTranslation::updateOrCreate(['lang_key'=>$key], ['en'=>$value['en'], 'hi'=> $value['hi']]); 
            echo $count.': '.$key.'<br/>';
        }
    }
}
