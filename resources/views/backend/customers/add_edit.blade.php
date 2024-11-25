@extends('layouts.master_backend')
@section('content')
@php 
      $flag=0;
      $heading=lang_trans('btn_add');
      if(isset($data_row) && !empty($data_row)){
          $flag=1;
          $heading=lang_trans('btn_update');
      }
  @endphp
<div class="">
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{$heading}} {{lang_trans('txt_customer')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  @if($flag==1)
                      {{ Form::model($data_row,array('url'=>route('save-customer'),'id'=>"customer-form", 'class'=>"form-horizontal form-label-left")) }}
                      {{Form::hidden('id',null)}}
                  @else
                      {{ Form::open(array('url'=>route('save-customer'),'id'=>"customer-form", 'class'=>"form-horizontal form-label-left")) }}
                  @endif
                    <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_firstname')}} <span class="required">*</span></label>
                        {{Form::text('name',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_firstname')])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_surname')}} </label>
                        {{Form::text('surname',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_surname')])}}
                      </div>
                     {{--  <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_middlename')}} <span class="required">*</span></label>
                        {{Form::text('middle_name',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_middlename')])}}
                      </div> --}}
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_email')}} <span class="required">*</span></label>
                        {{Form::email('email',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"email", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_email')])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_mobile_num')}} <span class="required">*</span></label>
                        {{Form::text('mobile',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"mobile", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_mobile_num')])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_address')}} <span class="required">*</span></label>
                        {{Form::textarea('address',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"address", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_address'),"rows"=>1])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_country')}} </label>
                        {{ Form::select('country',getCountryList(),getSettings('default_country'),['class'=>'form-control col-md-6 col-xs-12', "id"=>"country", 'placeholder'=>lang_trans('ph_select')]) }}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_state')}}</label>
                        {{Form::text('state',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"state", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_state')])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_city')}}</label>
                        {{Form::text('city',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"city", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_city')])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                          <label class="control-label"> {{lang_trans('txt_gender')}} <span class="required">*</span></label>
                          {{ Form::select('gender',config('constants.GENDER'),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_age')}} </label>
                        {{Form::number('age',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"age", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_age'),"min"=>10])}}
                      </div>                         
                    </div>
                      <div class="ln_solid"></div>
                      <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                        <button class="btn btn-success" type="submit">{{lang_trans('btn_submit')}}</button>
                      </div>
                  {{Form::close()}}
              </div>
          </div>
      </div>
  </div>
</div>
@endsection