<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Season;

class SeasonController extends Controller
{
    public $data=[];
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {  
        $this->data['datalist']=Season::where('is_deleted', 0)->orderBy('name','ASC')->get();
        return view('backend/seasons/list',$this->data);
    }
    public function add() {
        return view('backend/seasons/add_edit',$this->data);
    }
    public function edit(Request $request){
        $this->data['data_row']=Season::whereId($request->id)->where('is_deleted', 0)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/seasons/add_edit',$this->data);
    } 
    public function save(Request $request) {
        $splashMsg = getSplashMsg(['id'=>$request->id, 'type'=>'add_update']);
        $weekDays = (count($request->week_days)) ? implode(',', $request->week_days) : '';
        $request->merge(['days'=>$weekDays]);
        $res = Season::updateOrCreate(['id'=>$request->id],$request->except(['_token', 'week_days']));
        if($res){
            return redirect()->back()->with(['success' => $splashMsg['success']]);
        }
        return redirect()->back()->with(['error' => $splashMsg['error']]);
    }
    public function delete(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }  
        if(Season::whereId($request->id)->update(['is_deleted'=>1])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }
}
