@extends('layouts.master_backend')
@section('content')
@php 
  $userRole = Auth::user()->role_id;
  $settings = getSettings();

  $calculatedAmount = calcFinalAmount($data_row, 1);
  $gstPerc = $calculatedAmount['totalRoomGstPerc'];
  $cgstPerc = $calculatedAmount['totalRoomCGstPerc'];
  $roomAmountGst = $calculatedAmount['totalRoomAmountGst'];
  $roomAmountCGst = $calculatedAmount['totalRoomAmountCGst'];
  $totalRoomAmount = $calculatedAmount['subtotalRoomAmount'];
  $advancePayment = $calculatedAmount['advancePayment'];
  $roomAmountDiscount = $calculatedAmount['totalRoomAmountDiscount'];
  $finalRoomAmount = $calculatedAmount['finalRoomAmount'];

  $gstPercFood = $calculatedAmount['totalOrderGstPerc'];
  $cgstPercFood = $calculatedAmount['totalOrderCGstPerc'];
  $foodAmountGst = $calculatedAmount['totalOrderAmountGst'];
  $foodAmountCGst = $calculatedAmount['totalOrderAmountCGst'];
  $foodOrderAmountDiscount = $calculatedAmount['totalOrderAmountDiscount'];
  $gstFoodApply = $calculatedAmount['gstFoodApply'];
  $totalOrdersAmount = $calculatedAmount['subtotalOrderAmount'];
  $finalOrderAmount = $calculatedAmount['finalOrderAmount'];

  $additionalAmount = $calculatedAmount['additionalAmount'];
  $additionalAmountReason = $data_row->additional_amount_reason;

  $finalAmount = $finalRoomAmount+$finalOrderAmount+$additionalAmount;
@endphp

<div class="">
      {{ Form::model($data_row,array('url'=>route('check-out'),'id'=>"check-out-form", 'class'=>"form-horizontal form-label-left",'files'=>true,'autocomplete'=>"off")) }}
      {{Form::hidden('id',null)}}
      <div class="row" id="new_guest_section">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <div class="col-sm-4 p-left-0">
                      <h2>{{lang_trans('heading_guest_type')}}</h2>
                  </div>
                  <div class="col-sm-8 text-right">
                      <a href="{{route('edit-customer',['id'=>$data_row->customer_id])}}" class="btn btn-xs btn-success" target="_blank">{{lang_trans('btn_update_customer_info')}}</a>
                  </div>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content"> 
                <div class="row"> 
                  <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <tr>
                              <th>{{lang_trans('txt_fullname')}}</th>
                              <td>{{$data_row->customer->name}}</td>
                              <th>{{lang_trans('txt_father_name')}}</th>
                              <td>{{$data_row->customer->father_name}}</td>
                            </tr>
                            <tr>
                              <th>{{lang_trans('txt_email')}}</th>
                              <td>{{$data_row->customer->email}}</td>
                              <th>{{lang_trans('txt_mobile_num')}}</th>
                              <td>{{$data_row->customer->mobile}}</td>
                            </tr>
                            <tr>
                              <th>{{lang_trans('txt_address')}}</th>
                              <td colspan="3">{{$data_row->customer->address}}, {{$data_row->customer->city}}, {{$data_row->customer->state}}, {{$data_row->customer->country}}</td>
                            </tr>
                          
                          </tbody>
                        </table>
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
                  <h2>{{lang_trans('heading_checkin_info')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_checkin')}} <span class="required">*</span></label>
                        {{Form::text('check_in_date',$data_row->check_in,['class'=>"form-control col-md-6 col-xs-12", "id"=>"check_in_date", "placeholder"=>lang_trans('ph_date'),'readonly'=>true,'disabled'=>true])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_checkout')}} <span class="required">*</span></label>
                        {{Form::text('check_out_date', addSubDate('+', $data_row->duration_of_stay, $data_row->check_in, 'Y-m-d H:i:s') ,['class'=>"form-control col-md-6 col-xs-12", "id"=>"check_out_date", "placeholder"=>lang_trans('ph_date'),'required'=>true,'autocomplete'=>false, "readonly"=>true, 'disabled'=>true])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_duration_of_stay')}} <span class="required">*</span></label>
                        {{Form::number('duration_of_stay',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"duration_of_stay", "placeholder"=>lang_trans('ph_day_night'),"min"=>1,'required'=>true, 'readonly'=>true])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                          <label class="control-label"> {{lang_trans('txt_remark_amount')}} </label>
                          {{Form::number('remark_amount',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"Remark Amount","placeholder"=>lang_trans('ph_enter').lang_trans('txt_remark_amount'),"min"=>0])}}
                      </div> 
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_remark')}}</label>
                        {{Form::textarea('remark',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"remark", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_remark'),"rows"=>1])}}
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
                  <h2>{{lang_trans('heading_idcard_info')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-12">
                          <label class="control-label">{{lang_trans('txt_type_id')}}</label>
                          {{ Form::select('idcard_type',getDynamicDropdownList('type_of_ids'),null,['class'=>'form-control col-md-6 col-xs-12','placeholder'=>lang_trans('ph_select')]) }}                             
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_id_number')}} <span class="required">*</span></label>
                        {{Form::text('idcard_no',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"idcard_no", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_id_number')])}}
                      </div>
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_upload_idcard')}} <sup class="color-ff4">{{lang_trans('txt_multiple')}}</sup> </label>
                        {{Form::file('id_image[]',['class'=>"form-control",'id'=>'idcard_image','multiple'=>true])}}
                      </div>
                  </div>
                  @if($data_row->id_cards->count())
                    <div class="row">
                        <div class="col-sm-12">
                            <br/>
                            <table class="table table-bordered">
                              <tr>
                                <th colspan="2">{{lang_trans('txt_uploaded_files')}}</th>
                              </tr>
                              <tr>
                                <th>{{lang_trans('txt_sno')}}.</th>
                                <th>{{lang_trans('txt_action')}}</th>
                              </tr>
                              @if($data_row->id_cards)
                                @foreach($data_row->id_cards as $k=>$val)
                                  @if($val->file!='')
                                    <tr>
                                      <td>{{$k+1}}</td>
                                      <td>
                                        <a href="{{checkFile($val->file,'uploads/id_cards/','blank_id.jpg')}}" data-toggle="lightbox"  data-title="{{lang_trans('txt_idcard')}}" data-footer="" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> </a>
                                        <a href="{{checkFile($val->file,'uploads/id_cards/','blank_id.jpg')}}" class="btn btn-sm btn-success" download><i class="fa fa-download"></i> </a>
                                       <button type="button" class="btn btn-danger btn-sm delete_btn" data-url="{{route('delete-mediafile',[$val->id])}}" title="{{lang_trans('btn_delete')}}"><i class="fa fa-trash"></i></button>
                                      </td>
                                    </tr>
                                  @endif
                                @endforeach
                              @else
                                <tr>
                                    <td colspan="2">{{lang_trans('txt_no_file')}}</td>
                                </tr>
                              @endif
                            </table>
                        </div>
                    </div>
                  @endif
              </div>
          </div>
      </div>
  </div>
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_payment_info')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th class="text-center" width="2%">{{lang_trans('txt_sno')}}.</th>
                              <th class="text-center" width="20%">{{lang_trans('txt_room')}}</th>
                              {{-- <th class="text-center" width="5%">{{lang_trans('txt_swapped_room')}}</th> --}}
                              <th class="text-center" width="5%">{{lang_trans('txt_duration_of_stay')}}</th>
                              <th class="text-center" width="5%">{{lang_trans('txt_base_price')}}</th>
                              <th class="text-center" width="10%">{{lang_trans('txt_total_amount')}}</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if($data_row->booked_rooms) 
                              @foreach($data_row->booked_rooms as $key=>$roomInfo)
                                @php
                                  $checkIn = dateConvert($roomInfo->check_in, 'Y-m-d');
                                  $checkOut = dateConvert($roomInfo->check_out, 'Y-m-d');
                                  $durOfStayPerRoom = dateDiff($checkIn, $checkOut, 'days');
                                  $durOfStayPerRoom = ($durOfStayPerRoom == 0) ? 1: $durOfStayPerRoom;
                                  //$amountPerRoom = ($durOfStayPerRoom * $roomInfo->room_price);
                                  $priceInfo = getDateWisePriceList($roomInfo->date_wise_price);
                                  $amountPerRoom = $priceInfo[1];

                                @endphp
                                <tr class="per_room_tr">
                                  <td class="text-center">{{$key+1}}</td>
                                  <td>
                                      {{ ($roomInfo->room_type) ? $roomInfo->room_type->title : ""}}<br/>
                                      ({{lang_trans('txt_room_num')}} : {{$roomInfo->room->room_no}})
                                  </td>
                                  {{-- <td class="text-center">{{ config('constants.YES_NO')[($roomInfo->swapped_from_room)?1:0] }}</td> --}}
                                  <th class="text-center">
                                    <span class="duration_of_per_room {{ ($roomInfo->swapped_from_room) ? 'swapped_room' : 'no_swapped_room'}}">{{$durOfStayPerRoom}}</span>
                                  </th>
                                  <td class="text-center">
                                    {{Form::number('amount[per_room_price]',$amountPerRoom,['class'=>'form-control per_room_price hide_elem', 'min'=>$roomInfo->room_price])}}
                                    <span class="error base_price_err_msg"></span>
                                    <button type="button" class="btn btn-xs btn-info cursor-pointer" data-toggle="modal" data-target="#room_price_model_{{$key}}">{{lang_trans('btn_price_break')}}</button>
                                    @include('backend/model/room_price_info_model',['list'=>$priceInfo[0], 'total'=>$priceInfo[1], 'key'=>$key])
                                  </td>
                                  <td class="text-right td_total_per_room_amount">{{getCurrencySymbol()}} {{ $amountPerRoom }}</td>
                                </tr>
                              @endforeach
                            @endif
                          </tbody>
                        </table>


                        <table class="table table-bordered">
                          <tr>
                            <th class="text-right">{{lang_trans('txt_subtotal')}} {{Form::hidden('amount[total_room_amount]',$totalRoomAmount,['id'=>'total_room_amount'])}}</th>
                            <td width="15%" class="text-right td_total_room_amount">{{getCurrencySymbol()}} {{ $totalRoomAmount }}</td>
                          </tr>
                          <tr>
                            <th class="text-right">{{lang_trans('txt_sgst')}} ({{$gstPerc}}%) {{Form::hidden('amount[total_room_amount_gst]',null,['id'=>'total_room_amount_gst'])}}</th>
                            <td width="15%" id="td_total_room_amount_gst" class="text-right">{{getCurrencySymbol()}} {{ $roomAmountGst }}</td>
                          </tr>
                          <tr class="{{$cgstPerc > 0 ? '' : 'hide_elem'}}">
                            <th class="text-right">{{lang_trans('txt_cgst')}} ({{$cgstPerc}}%) {{Form::hidden('amount[total_room_amount_cgst]',null,['id'=>'total_room_amount_cgst'])}}</th>
                            <td width="15%" id="td_total_room_amount_cgst" class="text-right">{{getCurrencySymbol()}} {{ $roomAmountCGst }}</td>
                          </tr>
                          <tr>
                            <th class="text-right">{{lang_trans('txt_advance_amount')}} {{Form::hidden('amount[total_room_advance_amount]',$advancePayment)}}</th>
                            <td width="15%" id="td_room_advance_amount" class="text-right">{{getCurrencySymbol()}} {{ $advancePayment }}</td>
                          </tr>
                          <tr>
                            <th class="text-right">{{lang_trans('txt_discount')}}</th>
                            <td width="15%" id="td_advance_amount" class="text-right">
                              <div class="col-md-12 col-sm-12 col-xs-12 p-left-0 p-right-0">
                                <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0">
                                  {{Form::number('discount_amount',$roomAmountDiscount,['class'=>"form-control", "id"=>"discount", "placeholder"=>lang_trans('ph_any_discount'),"min"=>0])}}
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0">
                                  {{ Form::select('room_discount_in',config('constants.DISCOUNT_TYPES'),'amt',['class'=>'form-control', "id"=>"room_discount_in"]) }}    
                                </div>
                              </div>
                              <span class="error discount_room_err_msg"></span>
                            </td>
                          </tr>
                          <tr class="bg-warning">
                            <th class="text-right">{{lang_trans('txt_total_amount')}} {{Form::hidden('amount[total_room_final_amount]',null,['id'=>'total_room_final_amount'])}}</th>
                            <td width="15%" id="td_room_final_amount" class="text-right">{{getCurrencySymbol()}} {{ $finalRoomAmount }}</td>
                          </tr>
                        </table>


                        <div class="x_title">
                            <h2>{{lang_trans('txt_food_orders')}}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th width="2%">{{lang_trans('txt_sno')}}.</th>
                              <th width="20%">{{lang_trans('txt_item_details')}}</th>
                              <th width="5%">{{lang_trans('txt_date')}}</th>
                              <th width="5%">{{lang_trans('txt_item_qty')}}</th>
                              <th width="5%">{{lang_trans('txt_item_price')}}</th>
                              <th width="10%">{{lang_trans('txt_total_amount')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data_row->orders_items as $k=>$val)
                              <tr>
                                <td>{{$k+1}}</td>
                                <td>{{$val->item_name}}</td>
                                <td>{{dateConvert($val->created_at,'d-m-Y')}}</td>
                                <td>{{$val->item_qty}}</td>
                                <td>{{getCurrencySymbol()}} {{$val->item_price}}</td>
                                <td>{{getCurrencySymbol()}} {{$val->item_qty*$val->item_price}}</td>
                              </tr>
                              @if(count($data_row->orders_items) == ($k+1) )
                                <tr>
                                  <th colspan="5" class="text-right">{{lang_trans('txt_gst_apply')}}</th>
                                  <td>{{ Form::checkbox('food_gst_apply',$gstFoodApply,($gstFoodApply==1) ? true : false,['id'=>'apply_gst']) }}</td>
                                </tr>
                              @endif
                            @empty
                              <tr>
                                <td colspan="6">{{lang_trans('txt_no_orders')}}</td>
                              </tr>
                            @endforelse
                          </tbody>
                        </table>
                        
                        <table class="table table-bordered">
                            <tr>
                              <th class="text-right">{{lang_trans('txt_subtotal')}} {{Form::hidden('amount[order_amount]',$totalOrdersAmount,['id'=>'total_order_amount'])}}</th>
                              <td width="15%" id="td_total_order_amount" class="text-right">{{getCurrencySymbol()}} {{ $totalOrdersAmount }}</td>
                            </tr>
                            <tr>
                              <th class="text-right">{{lang_trans('txt_sgst')}} ({{$gstPercFood}}%) {{Form::hidden('amount[order_amount_gst]',$foodAmountGst,['id'=>'total_order_amount_gst'])}}</th>
                              <td width="15%" id="td_order_amount_gst" class="text-right">{{getCurrencySymbol()}} {{$foodAmountGst}}</td>
                            </tr>
                            <tr class="{{$cgstPercFood > 0 ? '' : 'hide_elem'}}">
                              <th class="text-right">{{lang_trans('txt_cgst')}} ({{$cgstPercFood}}%) {{Form::hidden('amount[order_amount_cgst]',$foodAmountCGst,['id'=>'total_order_amount_cgst'])}}</th>
                              <td width="15%" id="td_order_amount_cgst" class="text-right">{{getCurrencySymbol()}} {{$foodAmountCGst}}</td>
                            </tr>
                            <tr>
                              <th class="text-right">{{lang_trans('txt_discount')}}</th>
                              <td width="15%" id="td_advance_amount" class="text-right">
                                  <div class="col-md-12 col-sm-12 col-xs-12 p-left-0 p-right-0">
                                    <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0">
                                      {{Form::number('discount_order_amount',$foodOrderAmountDiscount,['class'=>"form-control col-md-7 col-xs-12", "id"=>"order_discount", "placeholder"=>lang_trans('ph_any_discount'),"min"=>0])}}
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 p-left-0 p-right-0">
                                      {{ Form::select('order_discount_in',config('constants.DISCOUNT_TYPES'),'amt',['class'=>'form-control', "id"=>"order_discount_in"]) }}    
                                    </div>
                                  </div>
                                  <span class="error discount_order_err_msg"></span>
                              </td>
                            </tr>
                            <tr class="bg-warning">
                              <th class="text-right">{{lang_trans('txt_total_amount')}} {{Form::hidden('amount[order_final_amount]',null,['id'=>'total_order_final_amount'])}}</th>
                              <td width="15%" id="td_order_final_amount" class="text-right">{{getCurrencySymbol()}} {{ $finalOrderAmount }}</td>
                            </tr>
                        </table>

                        <table class="table table-bordered">
                            <tr class="bg-default">
                              <th class="text-right">
                                {{Form::text('additional_amount_reason',$additionalAmountReason,['class'=>"form-control col-md-7 col-xs-12", "id"=>"additional_amount_reason", "placeholder"=>lang_trans('txt_additional_amount_reason')])}}
                              </th>
                              <td width="15%" id="td_additional_amount" class="text-right">
                                {{Form::number('additional_amount',$additionalAmount,['class'=>"form-control col-md-7 col-xs-12", "id"=>"additional_amount", "placeholder"=>lang_trans('txt_additional_amount'),"min"=>0])}}
                              </td>
                            </tr>
                        </table>

                        <table class="table table-bordered">
                            <tr class="bg-success">
                              <th class="text-right">{{lang_trans('txt_grand_total')}} {{Form::hidden('amount[total_final_amount]',null,['id'=>'total_final_amount'])}}</th>
                              <td width="15%" id="td_final_amount" class="text-right">{{getCurrencySymbol()}} {{ $finalAmount }}</td>
                            </tr>
                        </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_content">
                  <div class="row"> 
                    <div class="x_title">
                        <h2>{{lang_trans('heading_additional_info')}}</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                        <label class="col-md-12 col-sm-12 col-xs-12">{{lang_trans('txt_inv_applicable')}}</label>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          {{Form::radio('invoice_applicable',1,true,['class'=>"flat invoice_applicable", 'id'=>'yes_invoice'])}} 
                          <label for="yes_invoice">{{lang_trans('txt_yes')}}</label>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          {{Form::radio('invoice_applicable',0,false,['class'=>"flat invoice_applicable", 'id'=>'no_invoice'])}} 
                          <label for="no_invoice">{{lang_trans('txt_no')}}</label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_company_gst_num')}}</label>
                        {{Form::text('company_gst_num',null,['class'=>"form-control col-md-6 col-xs-12", "id"=>"company_gst_num", "placeholder"=>"Enter GST Number"])}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_payment_status')}}</label>
                        {{Form::select('payment_status',config('constants.PAYMENT_STATUS'),null,['class'=>"form-control col-md-6 col-xs-12", "placeholder"=>"--Select"])}}
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-12">
                        <label class="control-label"> {{lang_trans('txt_payment_mode')}}</label>
                        {{Form::select('payment_mode',config('constants.PAYMENT_MODES'),null,['class'=>"form-control col-md-6 col-xs-12", "placeholder"=>"--Select"])}}
                      </div>
                    </div>
                </div>
              </div>
                  <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                      <button class="btn btn-success btn-submit-form" type="submit">{{lang_trans('btn_submit')}}</button>
                  </div>
              </div>
          </div>
      </div>
  </div>
  {{ Form::close() }}
</div>

{{-- require set php var in js var --}}
<script>
  globalVar.page = 'checkout';
  globalVar.userRole = {{$userRole}};
  globalVar.checkInDate='';
  globalVar.checkOutDate='';
  globalVar.gstPercent = {{$gstPerc}};
  globalVar.cgstPercent = {{$cgstPerc}};
  globalVar.gstPercentFood = {{$gstPercFood}};
  globalVar.cgstPercentFood = {{$cgstPercFood}};
  globalVar.roomQty = 0;
  globalVar.advanceAmount = {{$advancePayment}};
  globalVar.totalOrdersAmount = {{$totalOrdersAmount}};  
  globalVar.subTotalRoomAmount = {{$totalRoomAmount}};  
  globalVar.discount = {{$roomAmountDiscount}};
  globalVar.foodOrderDiscount = {{$foodOrderAmountDiscount}};
  globalVar.gstOrderAmount = 0;
  globalVar.gstRoomAmount = {{$roomAmountGst}};
  globalVar.applyFoodGst = {{$gstFoodApply}};
  globalVar.additionalAmount = {{$additionalAmount}};
  globalVar.isError = false;
  globalVar.startDate = moment("{{$data_row->check_in}}", "YYYY.MM.DD");
</script>  
 <script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js')}}"></script>    
@endsection