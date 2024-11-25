<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeSection;
use App\Models\ContactusSection;
use App\Models\AboutusSection;
use App\Models\Testimonial;
use App\Models\Setting;
use App\Models\MediaFile;

class WebsitePagesController extends Controller
{
    private $paginate=10;
    private $core;
    public $data=[];
    public $settings=[];
    public function __construct()
    {
        $this->core=app(\App\Http\Controllers\CoreController::class);
        $this->data['settings'] = getSettings();
    }

    public function homePage(){
        $this->data['data_row'] = HomeSection::first();
        $this->data['banner_images'] = MediaFile::where('tbl_id', 1)->where('type', 'home_banner')->get();
        $this->data['testimonials_rows'] = Testimonial::all();
        return view('backend/website_pages/home_page',$this->data);
    }
    public function updateHomePage(Request $request){
        $homeSectionData = [];
        $bannerImages = $featuresData = $testimonialsData = $countersData = $ctaData = [];

        // banner section
            $homeSectionData['banner_section_tagline'] = $request->banner_section_tagline;
            $homeSectionData['banner_section_heading'] = $request->banner_section_heading;
            $homeSectionData['banner_section_publish'] = checkboxTickOrNot($request->banner_section_publish);
            $mediaData = [
                'tbl_id'=>1,
                'media_ids'=>$request->selected_banner_ids,
                'files'=>($request->hasFile('banner_images')) ? $request->banner_images : null,
                'folder_path'=>'uploads/banners',
                'type'=>'home_banner',
            ];           
            $this->core->uploadAndUnlinkMediaFile($mediaData);            

        // intro section
            $homeSectionData['intro_section_tagline'] = $request->intro_section_tagline;
            $homeSectionData['intro_section_heading'] = $request->intro_section_heading;
            $homeSectionData['intro_section_publish'] = checkboxTickOrNot($request->intro_section_publish);
            if(isset($request->intro_sect_features['title'])){
                $featuresReqData = $request->intro_sect_features;
                foreach($featuresReqData['title'] as $k=>$val){
                    if($val!=''){
                        $featuresData[] = ['title'=>$val, 'icon'=>$featuresReqData['icon'][$k] , 'short_desc'=>$featuresReqData['short_desc'][$k] ];
                    }
                }
            }
            if(count($featuresData)>0){
                 $homeSectionData['intro_section_features'] = json_encode($featuresData);
            } else {
                $homeSectionData['intro_section_features'] = null;
            }
        
        // testimonials section
            $homeSectionData['testimonial_section_tagline'] = $request->testimonial_section_tagline;
            $homeSectionData['testimonial_section_heading'] = $request->testimonial_section_heading;
            $homeSectionData['testimonial_section_publish'] = checkboxTickOrNot($request->testimonial_section_publish);
           
           //delete records (except requested ids)
            if(isset($request->testimonial_section['ids'])){
                Testimonial::whereNotIn('id',$request->testimonial_section['ids'])->delete();
            } else {
                Testimonial::truncate();
            }

            if(isset($request->testimonial_section['client_name'])){
                $testimonialsReqData = $request->testimonial_section;
                foreach($testimonialsReqData['client_name'] as $k=>$val){
                   //update record if id exist
                    if(isset($testimonialsReqData['ids'][$k]) && $testimonialsReqData['ids'][$k]>0){
                            $updateData = ['client_name'=>$val, 'client_position'=>$testimonialsReqData['client_position'][$k] , 'client_comment'=>$testimonialsReqData['client_comment'][$k] ];
                            if(isset($testimonialsReqData['image'][$k])){
                                if($testimonialsReqData['image'][$k]!=''){
                                    unlinkImg($testimonialsReqData['prv_img'][$k],'uploads/client_images/');
                                    $clientImg=$this->core->fileUpload($testimonialsReqData['image'][$k],'uploads/client_images');
                                    $updateData['client_image'] = $clientImg;
                                }
                            }
                            
                            Testimonial::whereId($testimonialsReqData['ids'][$k])->update($updateData);
                    } else {
                        if($val!=''){
                            $clientImg = '';
                            if(isset($testimonialsReqData['image'][$k])){
                                if($testimonialsReqData['image'][$k]!=''){
                                    $clientImg=$this->core->fileUpload($testimonialsReqData['image'][$k],'uploads/client_images'); 
                                }
                            }
                            $testimonialsData[] = ['client_name'=>$val, 'client_image'=> $clientImg, 'client_position'=>$testimonialsReqData['client_position'][$k] , 'client_comment'=>$testimonialsReqData['client_comment'][$k] ];
                        }
                    }                    
                }
                if(count($testimonialsData)>0){
                    Testimonial::insert($testimonialsData);
                }
            }

        // counter section
            $homeSectionData['counter_section_publish'] = checkboxTickOrNot($request->counter_section_publish);
            if(isset($request->counter_section['title'])){
                $counterSectReqData = $request->counter_section;
                foreach($counterSectReqData['title'] as $k=>$val){
                    if($val!=''){
                        $countersData[] = ['title'=>$val, 'number'=>$counterSectReqData['number'][$k] , 'prefix'=>$counterSectReqData['prefix'][$k] ];
                    }
                }
            } 
            if(count($countersData)>0){
                 $homeSectionData['counter_section_json'] = json_encode($countersData);
            } else {
                $homeSectionData['counter_section_json'] = null;
            }

        //footerCTA section
            $homeSectionData['footer_cta_section_tagline'] = $request->footer_cta_section_tagline;
            $homeSectionData['footer_cta_section_heading'] = $request->footer_cta_section_heading;
            $homeSectionData['footer_cta_section_publish'] = checkboxTickOrNot($request->footer_cta_section_publish);

        //room section
            $homeSectionData['room_section_tagline'] = $request->room_section_tagline;
            $homeSectionData['room_section_heading'] = $request->room_section_heading;
            $homeSectionData['room_section_publish'] = checkboxTickOrNot($request->room_section_publish);

        //roomCategory section
            $homeSectionData['room_category_section_tagline'] = $request->room_category_section_tagline;
            $homeSectionData['room_category_section_heading'] = $request->room_category_section_heading;
            $homeSectionData['room_category_section_publish'] = checkboxTickOrNot($request->room_category_section_publish);

        HomeSection::where('id',1)->update($homeSectionData);
        return redirect()->back()->with(['success' => config('constants.FLASH_REC_UPDATE_1')]);
    }

    public function contactPage(){
        $this->data['data_row'] = ContactusSection::first();
        return view('backend/website_pages/contact_page',$this->data);
    }
    public function updateContactPage(Request $request){
        $dataRow = ContactusSection::first();
        
        $contactUsSectionData = [];
        $contactUsSectionData['tagline'] = $request->tagline;
        $contactUsSectionData['heading'] = $request->heading;
        $contactUsSectionData['facebook_link'] = $request->facebook_link;
        $contactUsSectionData['twitter_link'] = $request->twitter_link;
        $contactUsSectionData['linkedin_link'] = $request->linkedin_link; 
        $contactUsSectionData['instagram_link'] = $request->instagram_link; 
        if($request->hasfile('banner_image')){
            unlinkImg($dataRow->banner_image,'uploads/banners/');
            $filename=$this->core->fileUpload($request->file('banner_image'),'uploads/banners'); 
            $contactUsSectionData['banner_image'] = $filename;
        }
        ContactusSection::where('id',1)->update($contactUsSectionData);        
        return redirect()->back()->with(['success' => config('constants.FLASH_REC_UPDATE_1')]);
    }

    public function aboutPage(){
        $this->data['data_row'] = AboutusSection::first();
       return view('backend/website_pages/about_page',$this->data);
    }
    public function updateAboutPage(Request $request){
        $dataRow = AboutusSection::first();

        $aboutUsSectionData = [];
        // aboutUs section
        $aboutUsSectionData['about_section_tagline'] = $request->about_section_tagline;
        $aboutUsSectionData['about_section_heading'] = $request->about_section_heading;
        $aboutUsSectionData['about_section_publish'] = checkboxTickOrNot($request->about_section_publish);
        $aboutUsSectionData['about_section_desc'] = $request->about_section_desc;
        $aboutUsSectionData['about_section_button'] = checkboxTickOrNot($request->about_section_button);
        $aboutUsSectionData['about_section_btntxt'] = $request->about_section_btntxt;
        $aboutUsSectionData['about_section_publish'] = checkboxTickOrNot($request->about_section_publish);

        if($request->hasfile('about_section_banner')){
            unlinkImg($dataRow->about_section_banner,'uploads/banners/');
            $filename=$this->core->fileUpload($request->file('about_section_banner'),'uploads/banners'); 
            $aboutUsSectionData['about_section_banner'] = $filename;
        }
        if($request->hasfile('about_section_image')){
            unlinkImg($dataRow->about_section_image,'uploads/about_us/');
            $filename=$this->core->fileUpload($request->file('about_section_image'),'uploads/about_us'); 
            $aboutUsSectionData['about_section_image'] = $filename;
        }

        if(isset($request->about_sect_features['title'])){
            $featuresReqData = $request->about_sect_features;
            foreach($featuresReqData['title'] as $k=>$val){
                if($val!=''){
                    $featuresData[] = ['title'=>$val, 'short_desc'=>$featuresReqData['short_desc'][$k] ];
                }
            }
        }
        if(count($featuresData)>0){
            $aboutUsSectionData['about_section_features'] = json_encode($featuresData);
        } else {
            $aboutUsSectionData['about_section_features'] = null;
        }

        AboutusSection::where('id',1)->update($aboutUsSectionData);
        return redirect()->back()->with(['success' => config('constants.FLASH_REC_UPDATE_1')]);
    }
   
}
