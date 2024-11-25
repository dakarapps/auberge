<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Models\Language, App\Models\LanguageTranslation;

class LanguageController extends Controller
{
    private $paginate=10;
    private $core;
    public $data=[];
    public function __construct()
    {
        $this->core=app(\App\Http\Controllers\CoreController::class);
        $this->middleware('auth');
    }

    public function index() {
        $langDatalist = LanguageTranslation::where('pannel', 'backend')->orderBy('en','ASC')->orderBy('lang_key','ASC')->get()->toArray();
        $this->data['languages']=getLangages();
        $this->data['datalist']=array_chunk($langDatalist,10);
        return view('backend/languages/list',$this->data);
    }   
    public function saveTranslations(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }  
        $languages=getLangages();
        $postData = [];
        $totalUpdateRec = 0;
        foreach ($request->lang as $key => $value) {
            foreach($languages as $lang_code=>$lang_name){
                if(in_array($lang_code, getLangForUpdateDisable())) continue;
                $postData[$lang_code] = $value[$lang_code];
            }
            $res = LanguageTranslation::where('id', $key)->update($postData);
            if($res) $totalUpdateRec += 1;
        }
        if($totalUpdateRec == count($request->lang)){            
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_UPDATE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_UPDATE_0')]);
    }
}
