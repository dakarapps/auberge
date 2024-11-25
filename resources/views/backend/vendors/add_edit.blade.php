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
                  <h2>{{$heading}} {{lang_trans('heading_vendor')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  @if($flag==1)
                      {{ Form::model($data_row,array('url'=>route('save-vendor'),'id'=>"vendor-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                      {{Form::hidden('id',null)}}
                  @else
                      {{ Form::open(array('url'=>route('save-vendor'),'id'=>"vendor-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                  @endif
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12"> {{lang_trans('txt_category')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              {{ Form::select('category_id',$category_list,null,['class'=>'form-control','placeholder'=>lang_trans('ph_select')]) }}    
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vendor_name"> {{lang_trans('txt_name')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('vendor_name',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"vendor_name", "required"=>"required"])}}
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vendor_email"> {{lang_trans('txt_email')}} </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('vendor_email',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"vendor_email"])}}
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vendor_mobile"> {{lang_trans('txt_mobile_num')}} </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('vendor_mobile',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"vendor_mobile"])}}
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vendor_phone"> {{lang_trans('txt_phone_num')}} </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('vendor_phone',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"vendor_phone"])}}
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vendor_address"> {{lang_trans('txt_address')}}</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::textarea('vendor_address',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"vendor_address", "rows"=>1])}}
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12"> {{lang_trans('txt_country')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              {{ Form::select('vendor_country',getCountries(),null,['class'=>'form-control','placeholder'=>lang_trans('ph_select')]) }}    
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vendor_state"> {{lang_trans('txt_state')}} </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('vendor_state',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"vendor_state"])}}
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vendor_city"> {{lang_trans('txt_city')}} </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('vendor_city',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"vendor_city"])}}
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vendor_gst_num"> {{lang_trans('txt_gst_num')}}</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('vendor_gst_num',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"vendor_gst_num"])}}
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact_person_name"> {{lang_trans('txt_contact_person_name')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('contact_person_name',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"contact_person_name", "required"=>"required"])}}
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact_person_mobile"> {{lang_trans('txt_contact_person_mobile')}}</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('contact_person_mobile',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"contact_person_mobile"])}}
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact_person_email"> {{lang_trans('txt_contact_person_email')}}</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('contact_person_email',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"contact_person_email"])}}
                          </div>
                      </div>
                      
                      <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                              <button class="btn btn-primary" type="reset">
                                  {{lang_trans('btn_reset')}}
                              </button>
                              <button class="btn btn-success" type="submit">
                                  {{lang_trans('btn_submit')}}
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection