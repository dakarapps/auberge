@extends('layouts.master_backend')
@section('content')
@php 
  $isEditMode=false;
  $heading=lang_trans('btn_add');
  $calculatedAmount = calcLaundryAmount(null, 1);
  if(isset($data_row) && !empty($data_row)){
      $isEditMode=true;
      $heading=lang_trans('btn_update');
      $calculatedAmount = calcLaundryAmount($data_row, 1);
  }
  $gstApply = $calculatedAmount['gstApply'];
  $gstPerc = $calculatedAmount['gstPerc'];
  $cgstPerc = $calculatedAmount['cgstPerc'];
  $gstAmount = $calculatedAmount['gstAmount'];
  $cgstAmount = $calculatedAmount['cgstAmount'];
  $totalDiscount = $calculatedAmount['totalDiscount'];
  $subtotalAmount = $calculatedAmount['subtotalAmount'];
  $totalAmount = $calculatedAmount['totalAmount'];

  $isShowFinalStepElem = ($isEditMode && $data_row->order_status == 2) ? true : false;
@endphp
@if($isEditMode==1)
    {{ Form::model($data_row,array('url'=>route('save-laundry-order'),'id'=>"laundry-order-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
    {{Form::hidden('id',null)}}
@else
    {{ Form::open(array('url'=>route('save-laundry-order'),'id'=>"laundry-order-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
@endif
  <div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{$heading}} {{lang_trans('txt_order')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content"> 
                  <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_select_vendor')}} <span class="required">*</span></label>
                        {{ Form::select('vendor_id',$vendor_list,null,['class'=>'form-control','placeholder'=>lang_trans('ph_select')]) }}  
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_room')}}</label>
                        {{ Form::select('room_id',$room_list,null,['class'=>'form-control','placeholder'=>lang_trans('ph_select')]) }} 
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_laundry_order_status')}} <span class="required">*</span></label>
                        {{ Form::select('order_status',$status_list,null,['class'=>'form-control','placeholder'=>lang_trans('ph_select'), 'readonly'=>$isEditMode, 'disabled'=>$isEditMode]) }}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_order_date')}} <span class="required">*</span></label>
                        {{Form::text('order_date',date('Y-m-d'),['class'=>"form-control col-md-6 col-xs-12 datepicker", "id"=>"order_date", "placeholder"=>lang_trans('ph_date'), "autocomplete"=>"off"])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_remark')}} </label>
                        {{Form::textarea('remark',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"remark", "rows"=>2])}}
                      </div>
                  </div>
                  @if($isShowFinalStepElem)
                    <div class="row"> 
                      <div class="ln_solid"></div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_rcv_date')}} <span class="required">*</span></label>
                        {{Form::text('received_date',date('Y-m-d'),['class'=>"form-control col-md-6 col-xs-12 datepicker", "id"=>"received_date", "placeholder"=>lang_trans('ph_date'), "autocomplete"=>"off"])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_rcvd_invoice')}}</label>
                        {{Form::file('invoice[]',['class'=>"form-control",'id'=>'received_invoice','multiple'=>true])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_rcvd_invoice_num')}}</label>
                        {{Form::text('invoice_num',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"invoice_num"])}}
                      </div>
                    </div>
                  @endif
                  @if(!$isEditMode)
                    <div class="row"> 
                      <div class="ln_solid"></div>
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          {{Form::radio('guest_type','new',true,['class'=>"flat guest_type", 'id'=>'new_guest'])}} <label for="new_guest">{{lang_trans('txt_new_guest')}}</label>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          {{Form::radio('guest_type','existing',false,['class'=>"flat guest_type", 'id'=>'existing_guest'])}} <label for="existing_guest">{{lang_trans('txt_existing_guest')}}</label>
                        </div>
                      </div>
                    </div>
                  @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row hide_elem" id="existing_guest_section">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{lang_trans('heading_existing_guest_list')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content"> 
                  <div class="row"> 
                   <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label">{{lang_trans('txt_guest')}}</label>
                        {{Form::text('selected_customer_id',null,['class'=>"form-", "id"=>"customers", "placeholder"=>lang_trans('ph_select')])}}
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="new_guest_section">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{lang_trans('heading_guest_info')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content"> 
                  <div class="row"> 
                   
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label"> {{lang_trans('txt_firstname')}} <span class="required">*</span></label>
                      {{Form::text('customer_name',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_firstname')])}}
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label"> {{lang_trans('txt_email')}} </label>
                      {{Form::email('customer_email',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"email", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_email')])}}
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label"> {{lang_trans('txt_mobile_num')}} <span class="required">*</span></label>
                      {{Form::text('customer_mobile',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"mobile", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_mobile_num')])}}
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                      <label class="control-label"> {{lang_trans('txt_address')}}</label>
                      {{Form::textarea('customer_address',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"address", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_address'),"rows"=>1])}}
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_gender')}} <span class="required">*</span></label>
                        {{ Form::select('customer_gender',config('constants.GENDER'),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}
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
                      <h2>{{lang_trans('txt_laundry_item')}}</h2>
                      <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="laundry_item_parent">
                        @if(!$isEditMode)
                          @include('backend/includes/laundry_item_form', ['show_label'=>true, 'show_plus_btn'=>true])
                        @endif
                          
                        @if($isEditMode)
                          @forelse($data_row->order_items as $key=>$item)
                            @php
                              $show_label = ($key == 0) ? true : false;
                              $show_plus_btn = ($key == 0) ? true : false;
                            @endphp
                            @include('backend/includes/laundry_item_form', ['show_label'=>$show_label, 'show_plus_btn'=>$show_plus_btn, 'item'=>$item])  
                          @empty
                            @include('backend/includes/laundry_item_form', ['show_label'=>true, 'show_plus_btn'=>true])
                          @endforelse
                        @endif
                      </div>
                      
                        <div>
                          <table class="table table-bordered {{!$isShowFinalStepElem ? 'hide_elem' : ''}}">
                            <tr>
                              <th class="text-right">{{lang_trans('txt_subtotal')}} {{Form::hidden('amount[subtotal]',$subtotalAmount,['id'=>'subtotal'])}}</th>
                              <td width="25%" class="text-right" id="td_subtotal">{{getCurrencySymbol()}} {{$subtotalAmount}}</td>
                            </tr>
                            <tr>
                              <th class="text-right">{{lang_trans('txt_gst_apply')}}</th>
                              <td width="25%">{{ Form::checkbox('gst_apply',$gstApply,($gstApply==1) ? true : false,['id'=>'apply_gst']) }}</td>
                            </tr>
                            <tr>
                              <th class="text-right">{{lang_trans('txt_sgst')}} ({{$gstPerc}}%) {{Form::hidden('amount[total_gst_amount]',null,['id'=>'total_gst_amount'])}}</th>
                              <td width="25%" id="td_total_gst_amount" class="text-right">{{getCurrencySymbol()}} {{ $gstAmount }}</td>
                            </tr>
                            <tr class="{{$cgstPerc > 0 ? '' : 'hide_elem'}}">
                              <th class="text-right">{{lang_trans('txt_cgst')}} ({{$cgstPerc}}%) {{Form::hidden('amount[total_cgst_amount]',null,['id'=>'total_cgst_amount'])}}</th>
                              <td width="25%" id="td_total_cgst_amount" class="text-right">{{getCurrencySymbol()}} {{ $cgstAmount }}</td>
                            </tr>
                            <tr>
                              <th class="text-right">{{lang_trans('txt_discount')}}</th>
                              <td width="25%" id="td_advance_amount" class="text-right">
                                <div class="col-md-12 col-sm-12 col-xs-12 p-left-0 p-right-0">
                                  <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0">
                                    {{Form::number('amount[discount_amount]',$totalDiscount,['class'=>"form-control", "id"=>"discount", "placeholder"=>lang_trans('ph_any_discount'),"min"=>0])}}
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0">
                                    {{ Form::select('amount[laundry_discount_in]',config('constants.DISCOUNT_TYPES'),'amt',['class'=>'form-control', "id"=>"laundry_discount_in"]) }}    
                                  </div>
                                </div>
                                <span class="error discount_err_msg"></span>
                              </td>
                            </tr>
                            <tr class="bg-warning">
                              <th class="text-right">{{lang_trans('txt_total_amount')}} {{Form::hidden('amount[total_amount]',$totalAmount,['id'=>'total_amount'])}}</th>
                              <td width="25%" id="td_total_amount" class="text-right">{{getCurrencySymbol()}} {{$totalAmount}}</td>
                            </tr>
                          </table>
                        </div>

                      <div class="ln_solid"></div>
                      <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                        <button class="btn btn-success btn-submit-form {{$isShowFinalStepElem ? 'confirm_form' : ''}}" data-form="laundry-order-form" type="submit" disabled_>{{ ($isShowFinalStepElem) ? lang_trans('btn_complete_order') : lang_trans('btn_submit') }}</button>
                      </div> 
                  </div>
              </div>
          </div>
      </div>
  </div>
{{ Form::close() }}
<div class="colne_laundry_item_elem hide_elem">
  @include('backend/includes/laundry_item_form', ['show_label'=>false, 'show_plus_btn'=>false, 'blank_form'=>true]) 
</div>
{{-- require set var in js var --}}
<script>
  globalVar.page = 'laundry_order_add_edit';
  globalVar.customerList = {!! json_encode($customer_list) !!};
  globalVar.applyGst = {{$gstApply}};
  globalVar.gstPercent = {{$gstPerc}};
  globalVar.cgstPercent = {{$cgstPerc}};
  globalVar.gstAmount = {{$gstAmount}};
  globalVar.cgstAmount = {{$cgstAmount}};
  globalVar.subtotalAmount = {{$subtotalAmount}};  
  globalVar.totalAmount = {{$totalAmount}};  
  globalVar.discount = {{$totalDiscount}};
  globalVar.isError = false;
</script> 
<script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js')}}"></script>      
@endsection      
