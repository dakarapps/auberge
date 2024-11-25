@extends('layouts.master_backend')
@section('content')

<div class="">
  {{ Form::open(array('url'=>route('save-settings'),'id'=>"update-setting-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
  
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 text-right">
          <div class="x_panel">
              <div class="x_content">
                <br/>
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                       <button class="btn btn-success" type="submit">
                            {{lang_trans('btn_submit')}}
                        </button>
                    </div>
                </div>
              </div>
          </div>
      </div>
  </div>

  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_site_settings')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label">{{lang_trans('txt_site_page_title')}}</label>
                      {{Form::text('site_page_title',@$data_row['site_page_title'],['class'=>"form-control col-md-7 col-xs-12", "required"=>true])}}
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label">{{lang_trans('txt_site_lang')}}</label>
                      {{Form::select('site_language',getLangages(),@$data_row['site_language'],['class'=>"form-control col-md-7 col-xs-12", "required"=>true])}}
                    </div>
                      
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label">{{lang_trans('txt_hotel_name')}}</label>
                      {{Form::text('hotel_name',@$data_row['hotel_name'],['class'=>"form-control col-md-7 col-xs-12", "required"=>true])}}
                    </div>
                
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label">{{lang_trans('txt_hotel_tagline')}}</label>
                      {{Form::text('hotel_tagline',@$data_row['hotel_tagline'],['class'=>"form-control col-md-7 col-xs-12"])}}
                    </div>
                
                
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label">{{lang_trans('txt_hotel_email')}}</label>
                      {{Form::email('hotel_email',@$data_row['hotel_email'],['class'=>"form-control col-md-7 col-xs-12"])}}
                    </div>
                
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label">{{lang_trans('txt_hotel_phone')}}</label>
                      {{Form::text('hotel_phone',@$data_row['hotel_phone'],['class'=>"form-control col-md-7 col-xs-12"])}}
                    </div>
                
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label">{{lang_trans('txt_hotel_mobile')}}</label>
                      {{Form::text('hotel_mobile',@$data_row['hotel_mobile'],['class'=>"form-control col-md-7 col-xs-12"])}}
                    </div>
                      
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label">{{lang_trans('txt_hotel_website')}}</label>
                      {{Form::text('hotel_website',@$data_row['hotel_website'],['class'=>"form-control col-md-7 col-xs-12"])}}
                    </div>
                
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label">{{lang_trans('txt_hotel_address')}}</label>
                      {{Form::textarea('hotel_address',@$data_row['hotel_address'],['class'=>"form-control col-md-7 col-xs-12",'rows'=>1])}}
                    </div>
              </div>
          </div>
      </div>
  </div>
  
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_gst_settings')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12"> {{lang_trans('txt_gstin')}}</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('gst_num',@$data_row['gst_num'],['class'=>"form-control col-md-7 col-xs-12"])}}
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">{{lang_trans('txt_room_rent_gst')}} (%)</label>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <label class="">{{lang_trans('txt_sgst')}} (%)</label>
                            {{Form::number('gst',@$data_row['gst'],['class'=>"form-control col-md-7 col-xs-12", "required"=>"required","min"=>0, "step"=>"0.01"])}}
                          </div>
                           <div class="col-md-3 col-sm-3 col-xs-12">
                            <label class="">{{lang_trans('txt_cgst')}} (%)</label>
                            {{Form::number('cgst',@$data_row['cgst'],['class'=>"form-control col-md-7 col-xs-12", "required"=>"required","min"=>0, "step"=>"0.01"])}}
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12"> {{lang_trans('txt_food_gst')}} (%)</label>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <label class="">{{lang_trans('txt_sgst')}} (%)</label>
                            {{Form::number('food_gst',@$data_row['food_gst'],['class'=>"form-control col-md-7 col-xs-12", "required"=>"required","min"=>0, "step"=>"0.01"])}}
                          </div>
                           <div class="col-md-3 col-sm-3 col-xs-12">
                            <label class="">{{lang_trans('txt_cgst')}} (%)</label>
                            {{Form::number('food_cgst',@$data_row['food_cgst'],['class'=>"form-control col-md-7 col-xs-12", "required"=>"required","min"=>0, "step"=>"0.01"])}}
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12"> {{lang_trans('txt_laundry_gst')}} (%)</label>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <label class="">{{lang_trans('txt_sgst')}} (%)</label>
                            {{Form::number('laundry_gst',@$data_row['laundry_gst'],['class'=>"form-control col-md-7 col-xs-12", "required"=>"required","min"=>0, "step"=>"0.01"])}}
                          </div>
                           <div class="col-md-3 col-sm-3 col-xs-12">
                            <label class="">{{lang_trans('txt_cgst')}} (%)</label>
                            {{Form::number('laundry_cgst',@$data_row['laundry_cgst'],['class'=>"form-control col-md-7 col-xs-12", "required"=>"required","min"=>0, "step"=>"0.01"])}}
                          </div>
                      </div>
              </div>
          </div>
      </div>
  </div>

  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_currency_settings')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"> {{lang_trans('txt_currency')}}</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::select('currency',getCurrencyList(),@$data_row['currency'],['class'=>'form-control','placeholder'=>lang_trans('ph_select')]) }}  
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">{{lang_trans('txt_currency_symbol')}}</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {{Form::text('currency_symbol',@$data_row['currency_symbol'],['class'=>"form-control col-md-7 col-xs-12"])}}
                      </div>
                  </div> 
              </div>
          </div>
      </div>
  </div>

  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_default_settings')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12"> {{lang_trans('txt_nationality')}}</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::select('default_nationality',config('constants.NATIONALITY_LIST'),@$data_row['default_nationality'],['class'=>'form-control','placeholder'=>lang_trans('ph_select')]) }}  
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">{{lang_trans('txt_country')}}</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::select('default_country',getCountryList(),@$data_row['default_country'],['class'=>'form-control','placeholder'=>lang_trans('ph_select')]) }}
                      </div>
                  </div> 
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">{{lang_trans('txt_default_rec_days')}}</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::number('default_rec_days',@$data_row['default_rec_days'],['class'=>'form-control',"min"=>10, "max"=>90, 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_default_rec_days')]) }}
                      </div>
                  </div> 
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">{{lang_trans('txt_site_favicon')}}</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {{Form::file('site_favicon',['class'=>"form-control"])}}
                      </div>
                  </div> 
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">{{lang_trans('txt_site_logo')}}</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {{Form::file('site_logo',['class'=>"form-control"])}}
                      </div>
                  </div> 
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">{{lang_trans('txt_site_logo_height')}}</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::number('site_logo_height',@$data_row['site_logo_height'],['class'=>'form-control',"min"=>50, "max"=>150, 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_site_logo_height')]) }}
                      </div>
                  </div> 
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">{{lang_trans('txt_site_logo_width')}}</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::number('site_logo_width',@$data_row['site_logo_width'],['class'=>'form-control',"min"=>50, "max"=>150, 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_site_logo_width')]) }}
                      </div>
                  </div> 
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">{{lang_trans('txt_site_favicon')}}</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <img src="{{checkFile(@$data_row['site_favicon'],'uploads/favicon/','default_favicon.png')}}" class="logo-2" />
                      </div>
                  </div> 
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">{{lang_trans('txt_site_logo')}}</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <img src="{{checkFile(@$data_row['site_logo'],'uploads/logo/','default_logo.jpg')}}" class="logo-2" />
                      </div>
                  </div> 
              </div>
          </div>
      </div>
  </div>

  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_bank_settings')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">{{lang_trans('txt_bank_name')}}</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::text('bank_name',@$data_row['bank_name'],['class'=>'form-control', 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_bank_name')]) }}
                      </div>
                  </div> 
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">{{lang_trans('txt_bank_ifsc_code')}}</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::text('bank_ifsc_code',@$data_row['bank_ifsc_code'],['class'=>'form-control', 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_bank_ifsc_code')]) }}
                      </div>
                  </div> 
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">{{lang_trans('txt_bank_acc_name')}}</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::text('bank_acc_name',@$data_row['bank_acc_name'],['class'=>'form-control', 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_bank_acc_name')]) }}
                      </div>
                  </div> 
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">{{lang_trans('txt_bank_acc_num')}}</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::text('bank_acc_num',@$data_row['bank_acc_num'],['class'=>'form-control', 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_bank_acc_num')]) }}
                      </div>
                  </div> 
                  <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">{{lang_trans('txt_bank_branch')}}</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {{ Form::text('bank_branch',@$data_row['bank_branch'],['class'=>'form-control', 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_bank_branch')]) }}
                      </div>
                  </div> 
                  
              </div>
          </div>
      </div>
  </div>
  
  <div class="row hide_elem">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_term_and_conditions')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                 <div class="col-md-12 col-sm-12 col-xs-12">
                    <label class="control-label">{{lang_trans('txt_invoice_tnc')}}</label>
                    {{Form::textarea('invoice_term_condition',@$data_row['invoice_term_condition'],['class'=>"form-control col-md-7 col-xs-12 summernote",'rows'=>10])}}
                  </div>
              </div>
          </div>
      </div>
  </div>

  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 text-right">
          <div class="x_panel">
              <div class="x_content">
                <br/>
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                       <button class="btn btn-success" type="submit">
                            {{lang_trans('btn_submit')}}
                        </button>
                    </div>
                </div>
              </div>
          </div>
      </div>
  </div>
  {{Form::close()}}
</div>
@endsection