<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth,DB;
use App\Models\VendorCategory, App\Models\Vendor;

class VendorController extends Controller
{
    private $core;
    public $data=[];
    public function __construct()
    {
        $this->core=app(\App\Http\Controllers\CoreController::class);
        $this->middleware('auth');
    }

    public function index() {  
        $this->data['datalist']=Vendor::with('category', 'country')->where('is_deleted', 0)->orderBy('vendor_name','ASC')->get();
        return view('backend/vendors/list',$this->data);
    }
    public function add() {
        $this->data['category_list']=$this->getVendorCategoryList();
        return view('backend/vendors/add_edit',$this->data);
    }
    public function view(Request $request) {
        $this->data['data_row']=Vendor::with('category', 'country')->whereId($request->id)->where('is_deleted', 0)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/vendors/view_vendor',$this->data);
    }
    public function edit(Request $request){
        $this->data['category_list']=$this->getVendorCategoryList();
        $this->data['data_row']=Vendor::whereId($request->id)->where('is_deleted', 0)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/vendors/add_edit',$this->data);
    } 
    public function save(Request $request) {
        $splashMsg = getSplashMsg(['id'=>$request->id, 'type'=>'add_update']);
        $res = Vendor::updateOrCreate(['id'=>$request->id],$request->except(['_token']));
        
        if($res){
            return redirect()->back()->with(['success' => $splashMsg['success']]);
        }
        return redirect()->back()->with(['error' => $splashMsg['error']]);
    }
    public function delete(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }  
        if(Vendor::whereId($request->id)->update(['is_deleted'=>1])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }
    public function addCategory() {
        return view('backend/vendors/category_add_edit',$this->data);
    }
    public function editCategory(Request $request){
        $this->data['data_row']=VendorCategory::whereId($request->id)->where('is_deleted', 0)->first();
        if(!$this->data['data_row']){
            return redirect()->back()->with(['error' => config('constants.FLASH_REC_NOT_FOUND')]);
        }
        return view('backend/vendors/category_add_edit',$this->data);
    } 
    public function saveCategory(Request $request) {
        $splashMsg = getSplashMsg(['id'=>$request->id, 'type'=>'add_update']);
        if($request->id>0){
            if($this->core->checkWebPortal()==0){
                return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
            } 
        }
        $res = VendorCategory::updateOrCreate(['id'=>$request->id],$request->except(['_token']));
        
        if($res){
            return redirect()->back()->with(['success' => $splashMsg['success']]);
        }
        return redirect()->back()->with(['error' => $splashMsg['error']]);
    }
    public function listCategory() {
         $this->data['datalist']=VendorCategory::where('is_deleted', 0)->orderBy('name','ASC')->get();
        return view('backend/vendors/category_list',$this->data);
    }
    public function deleteCategory(Request $request) {
        if($this->core->checkWebPortal()==0){
            return redirect()->back()->with(['info' => config('constants.FLASH_NOT_ALLOW_FOR_DEMO')]);
        }  
        if(VendorCategory::whereId($request->id)->update(['is_deleted'=>1])){
            return redirect()->back()->with(['success' => config('constants.FLASH_REC_DELETE_1')]);
        }
        return redirect()->back()->with(['error' => config('constants.FLASH_REC_DELETE_0')]);
    }

    function getVendorCategoryList(){
        return VendorCategory::whereStatus(1)->where('is_deleted', 0)->orderBy('name','ASC')->pluck('name','id');
    }
}
