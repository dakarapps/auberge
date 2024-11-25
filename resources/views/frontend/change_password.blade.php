@extends('layouts.master_frontend')
@section('content')

<div>
   <!-- ============================ Page Title Start================================== -->
            <div class="image-cover page-title" style="background:url({{checkFile(null,'uploads/banners/','dashboard_banner.jpg')}}) no-repeat;" data-overlay="6">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            
                            <h2 class="ipt-title">Hello, {{Auth::user()->name}}</h2>
                            <span class="ipn-subtitle text-light">Change Password</span>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================ Page Title End ================================== -->
            
            <section class="gray">
                <div class="container">
                    <div class="row">
                        
                       @include('frontend.includes.sidebar_menu')
                        
                        <div class="col-lg-8 col-md-12">
                            <div class="dashboard-wraper">
                            
                                <!-- Basic Information -->
                                <div class="form-submit">   
                                    <h4>Change Your Password</h4>
                                    <div class="submit-section">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        {{ Form::open(array('url'=>route('update-password'),'id'=>"update-password-form", 'class'=>"form-horizontal form-label-left")) }}
                                        <div class="form-row">
                                        
                                            <div class="form-group col-lg-12 col-md-6">
                                                <label>Old Password <span class="required">*</span></label>
                                                {{ Form::password('old_password',['class'=>'form-control',"id"=>'old_password','placeholder'=>lang_trans('ph_enter').lang_trans('Old Password')]) }}                             
                                            </div>
                                            
                                            <div class="form-group col-md-6">
                                                <label class="control-label">{{lang_trans('txt_password')}} <span class="required">*</span></label>
                                                {{ Form::password('new_password',['class'=>'form-control',"id"=>'password','placeholder'=>lang_trans('ph_enter').lang_trans('txt_password')]) }}
                                            </div> 
                                            <div class="form-group col-md-6">
                                                <label class="control-label">{{lang_trans('txt_password_conf')}} <span class="required">*</span> </label>
                                                {{ Form::password('confirm_password',['class'=>'form-control',"id"=>'conf_password','placeholder'=>lang_trans('ph_enter').lang_trans('txt_password_conf')]) }}                             
                                            </div> 

                                            <div class="form-group col-lg-12 col-md-12">
                                                <button class="btn btn-theme" type="submit">Save Changes</button>
                                            </div>
                                            
                                        </div>
                                        {{Form::close()}}
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>
</div>
@endsection
