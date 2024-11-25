@extends('layouts.master_frontend')
@section('content')
<div>
    <!-- ============================ Who We Are Start ================================== -->
    <section class="section-shadow">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-7">
                    <div class="contact-form contact-box text-left">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Create An Account
                            </h5>
                        </div>
                        <div class="modal-body icon-form">
                            <div class="login-form">
                                {{ Form::open(array('url'=>route('do-sign-up'),'id'=>"signup-form", 'class'=>"")) }}
                                <div class="form-group">
                                    <label>Firstname<span class="required-field">*</span></label>
                                    <div class="input-with-no-icon">
                                        {{Form::text('firstname',null,['class'=>"form-control", "id"=>"firstname", "placeholder"=>'Enter Firstame'])}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Lastname<span class="required-field">*</span></label>
                                    <div class="input-with-no-icon">
                                        {{Form::text('lastname',null,['class'=>"form-control", "id"=>"lastname", "placeholder"=>'Enter Firstame'])}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Gender<span class="required-field">*</span></label>
                                    <div class="input-with-no-icon">
                                        {{ Form::select('gender',config('constants.GENDER'),null,['class'=>'form-control','placeholder'=>'--Select--']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email ID<span class="required-field">*</span></label>
                                    <div class="input-with-no-icon">
                                         {{Form::email('email',null,['class'=>"form-control", "id"=>"email", "placeholder"=>'Enter Email ID'])}}
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Password<span class="required-field">*</span></label>
                                    <div class="input-with-no-icon">
                                        {{ Form::password('password',['class'=>'form-control',"id"=>'password','placeholder'=>"Enter Password"]) }}                             
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password<span class="required-field">*</span></label>
                                    <div class="input-with-no-icon">
                                        {{ Form::password('confirm_password',['class'=>'form-control',"id"=>'confirm_password','placeholder'=>"Enter Confirm Password"]) }}                             
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Mobile No.<span class="required-field">*</span></label>
                                    <div class="input-with-no-icon">
                                        {{Form::text('mobile',null,['class'=>"form-control", "id"=>"mobile", "placeholder"=>"Enter Mobile Number"])}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Country<span class="required-field">*</span></label>
                                    <div class="input-with-no-icon">
                                        {{ Form::select('country',getCountryList(),getSettings('default_country'),['class'=>'form-control', "id"=>"userCountry", 'placeholder'=>"--Select Country--"]) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>City</label>
                                    <div class="input-with-no-icon">
                                        {{Form::text('city',null,['class'=>"form-control", "id"=>"city", "placeholder"=>"Enter City"])}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Address<span class="required-field">*</span></label>
                                    <div class="input-with-no-icon">
                                        {{Form::textarea('address',null,['class'=>"form-control", "id"=>"address", "placeholder"=>"Enter Address","rows"=>1])}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-md full-width pop-login" type="submit">Register</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                            <div class="text-center">
                                <p class="mt-3">
                                    Already Have an Account?
                                    <a class="link" href="{{route('sign-in')}}">
                                        Login
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="clearfix">
    </div>
    <!-- ============================ Who We Are End ================================== -->
</div>
@endsection
