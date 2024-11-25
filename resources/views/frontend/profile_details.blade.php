@extends('layouts.master_frontend')
@section('content')

<div>
   <!-- ============================ Page Title Start================================== -->
            <div class="image-cover page-title" style="background:url({{checkFile(null,'uploads/banners/','dashboard_banner.jpg')}}) no-repeat;" data-overlay="6">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            
                            <h2 class="ipt-title">Hello, {{Auth::user()->name}}</h2>
                            <span class="ipn-subtitle text-light">Edit & View Your Profile</span>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================ Page Title End ================================== -->
            
            <section class="gray">
                <div class="container-fluid">
                    <div class="row">
                        
                        @include('frontend.includes.sidebar_menu')
                        
                        <div class="col-lg-9 col-md-8 col-sm-12">
                             {{ Form::model($data_row,array('url'=>route('update-profile-details'),'id'=>"customer-form", 'class'=>"form-horizontal form-label-left")) }}
                            <div class="dashboard-wraper">
                            
                                <!-- Basic Information -->
                                <div class="form-submit">   
                                    <h4>My Account</h4>
                                    <div class="submit-section">
                                        <div class="form-row">                                        
                                            <div class="form-group col-md-6">
                                                <label>{{lang_trans('txt_firstname')}} <span class="required">*</span></label>
                                                {{Form::text('name',null,['class'=>"form-control", "id"=>"name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_firstname')])}}
                                            </div>
                                            
                                            <div class="form-group col-md-6">
                                                <label>{{lang_trans('txt_surname')}} <span class="required">*</span></label>
                                                {{Form::text('surname',null,['class'=>"form-control", "id"=>"name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_surname')])}}
                                            </div>
                                            
                                            <div class="form-group col-md-6">
                                                <label>{{lang_trans('txt_email')}} </label>
                                                {{Form::email('email',null,['class'=>"form-control", "id"=>"email", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_email')])}}
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>{{lang_trans('txt_mobile_num')}} <span class="required">*</span></label>
                                                {{Form::text('mobile',null,['class'=>"form-control", "id"=>"mobile", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_mobile_num')])}}
                                            </div>
                                            <div class="form-group col-md-6">
                                                  <label>{{lang_trans('txt_gender')}} <span class="required">*</span></label>
                                                  {{ Form::select('gender',config('constants.GENDER'),null,['class'=>'form-control','placeholder'=>lang_trans('ph_select')]) }}
                                            </div>
                                            <div class="form-group col-md-6">
                                               <label>{{lang_trans('txt_age')}} </label>
                                                {{Form::number('age',null,['class'=>"form-control", "id"=>"age", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_age'),"min"=>10])}}
                                            </div> 
                                            <div class="form-group col-md-6">
                                                <label>{{lang_trans('txt_country')}} </label>
                                                {{ Form::select('country',getCountryList(),getSettings('default_country'),['class'=>'form-control', "id"=>"country", 'placeholder'=>lang_trans('ph_select')]) }}
                                            </div>
                                              {{-- <div class="form-group col-md-6">
                                                <label>{{lang_trans('txt_state')}}</label>
                                                {{Form::text('state',null,['class'=>"form-control", "id"=>"state", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_state')])}}
                                              </div> --}}
                                              <div class="form-group col-md-6">
                                                <label>{{lang_trans('txt_city')}}</label>
                                                {{Form::text('city',null,['class'=>"form-control", "id"=>"city", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_city')])}}
                                              </div>
                                              
                                              <div class="form-group col-md-12">
                                                <label>{{lang_trans('txt_address')}} <span class="required">*</span></label>
                                                {{Form::textarea('address',null,['class'=>"form-control", "id"=>"address", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_address')])}}
                                              </div>                        
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-submit">   
                                    <div class="submit-section">
                                        <div class="form-row">
                                            <div class="form-group col-lg-12 col-md-12 text-right">
                                                <button class="btn btn-theme" type="submit">Update</button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            {{Form::close()}}
                        </div>
                        
                    </div>
                </div>
            </section>
</div>
@endsection
