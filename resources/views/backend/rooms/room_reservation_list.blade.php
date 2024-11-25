@extends('layouts.master_backend')
@section('content')
@php 
$i = $j = 0; 
$totalAmount = 0;
@endphp
<div class="">
  @if($list=='check_outs')
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
              <h2>{{lang_trans('heading_filter_checkouts')}}</h2>
              <div class="clearfix"></div>
          </div>
          <div class="x_content">
              {{ Form::model($search_data,array('url'=>route('search-checkouts'),'id'=>"search-checkouts", 'class'=>"form-horizontal form-label-left")) }}
                <div class="form-group col-sm-3">
                  <label class="control-label">{{lang_trans('txt_guest')}}</label>
                  {{Form::text('customer_id',null,['class'=>"form-", "id"=>"customers", "placeholder"=>lang_trans('ph_select')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_room_type')}}</label>
                  {{Form::select('room_type_id',$roomtypes_list,null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_payment_status')}}</label>
                  {{Form::select('payment_status',config('constants.PAYMENT_STATUS'),null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
                </div>
                <div class="form-group col-sm-1">
                  <label class="control-label">{{lang_trans('txt_date_from')}}</label>
                  {{Form::text('date_from',null,['class'=>"form-control datepicker", 'placeholder'=>lang_trans('ph_date_from')])}}
                </div>
                <div class="form-group col-sm-1">
                  <label class="control-label">{{lang_trans('txt_date_to')}}</label>
                  {{Form::text('date_to',null,['class'=>"form-control datepicker", 'placeholder'=>lang_trans('ph_date_to')])}}
                </div>
                <div class="form-group col-sm-3">
                  <br/>
                   <button class="btn btn-success search-btn" name="submit_btn" value="search" type="submit">{{lang_trans('btn_search')}}</button>
                   <button class="btn btn-primary export-btn" name="submit_btn" value="export" type="submit">{{lang_trans('btn_export')}}</button>
                </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>
    </div>
  @endif

  @if($list=='check_ins')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{lang_trans('heading_checkin_list')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>{{lang_trans('txt_sno')}}</th>
                        <th>{{lang_trans('txt_guest_name')}}</th>
                        <th>{{lang_trans('txt_mobile_num')}}</th>
                        <th>{{lang_trans('txt_email')}}</th>
                        <th>{{lang_trans('txt_room')}}</th>
                        <th>{{lang_trans('txt_checkin')}}</th>
                        <th>{{lang_trans('txt_checkout')}}</th>
                        <th>{{lang_trans('txt_total_amount')}}</th>
                        <th>{{lang_trans('txt_action')}}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($datalist as $k=>$val)
                        @if($val->is_checkout==0)
                          @php 
                            $dateDiff = dateDiff($val->check_in, date('Y-m-d'), 'daysWIthSymbol');
                            $calc = calcFinalAmount($val);
                            $totalAmount = $totalAmount+$calc['finalRoomAmount']+$calc['finalOrderAmount']+$calc['additionalAmount'];
                            $i++;
                          @endphp
                        <tr>
                          <td>{{$i}}</td>
                          <td>{{($val->customer) ? $val->customer->name : 'NA'}}</td>
                          <td>{{($val->customer) ? $val->customer->mobile : 'NA'}}</td>
                          <td>{{($val->customer) ? $val->customer->email : 'NA'}}</td>
                          <td>
                            <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#booked_room_{{$val->id}}">{{lang_trans('btn_view')}}</button>
                            @include('backend/model/booked_rooms_modal',['val'=>$val])
                          </td>
                          <td>{{dateConvert($val->check_in,'d-m-Y H:i')}}</td>
                          <td>{{dateConvert($val->check_out,'d-m-Y H:i')}}</td>
                          <td>{{getCurrencySymbol()}} {{numberFormat($calc['finalRoomAmount']+$calc['finalOrderAmount']+$calc['additionalAmount'])}}</td>
                          <td>
                            @if(isPermission('add-housekeeping-order') && $val->booked_rooms->count())
                              <a class="btn btn-xs btn-success" href="{{route('add-housekeeping-order',['room_id'=>$val->booked_rooms[0]->room_id, 'reservation_id'=>$val->id])}}" target="_blank">{{lang_trans('sidemenu_housekeeping')}}</a>
                            @endif
                            
                            @isPermission('advance-pay')
                              <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#advance_pay_{{$val->id}}">{{lang_trans('btn_advance_pay')}}</button>
                            @endisPermission

                            @isPermission('advance-slip')
                              <a class="btn btn-xs btn-info" href="{{route('advance-slip',[base64_encode($val->id)])}}" target="_blank">{{lang_trans('btn_advance_slip')}}</a>
                            @endisPermission

                            @isPermission('food-order')
                              <a class="btn btn-xs btn-warning" href="{{route('food-order',[$val->id])}}">{{lang_trans('btn_food_order')}}</a>
                            @endisPermission

                            @isPermission('view-reservation')
                              <a class="btn btn-xs btn-primary" href="{{route('view-reservation',[$val->id])}}">{{lang_trans('btn_view')}}</a>
                            @endisPermission

                            @isPermission('check-out-room')
                              <a class="btn btn-xs btn-danger" href="{{route('check-out-room',[$val->id])}}">{{lang_trans('btn_checkout')}}</a>
                            @endisPermission
                            {{-- @if($dateDiff >= 0) --}}
                            @isPermission('swap-room')
                              <a class="btn btn-xs btn-success" href="{{route('swap-room',[$val->id])}}">{{lang_trans('btn_swap_room')}}</a>
                            @endisPermission
                            {{-- @endif --}}
                            <br/>
                            <a class="btn btn-xs btn-danger" href="{{route('invoice',[$val->id,1,'inv_type'=>'org'])}}" target="_blank">{{lang_trans('btn_invoice_room_org')}}</a>
                            {{-- <a class="btn btn-xs btn-danger" href="{{route('invoice',[$val->id,1,'inv_type'=>'dup'])}}" target="_blank">{{lang_trans('btn_invoice_room_dup')}}</a> --}}
                            <a class="btn btn-xs btn-warning" href="{{route('invoice',[$val->id,2])}}" target="_blank">{{lang_trans('btn_invoice_food')}}</a>
                            
                            @isPermission('cancel-reservation')
                              <a class="btn btn-xs btn-danger" href="{{route('cancel-reservation',[$val->id])}}" onclick="return confirm('{{lang_trans("txt_are_you_sure")}}')">{{lang_trans('btn_cancel')}}</a>
                            @endisPermission

                            @include('backend/model/advance_pay_modal',['val'=>$val])
                          </td>
                        </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                  <table class="table table-striped table-bordered">
                      <tr>
                        <th class="text-right" width="70%">{{lang_trans('txt_grand_total')}}</th>
                        <th width="30%"><b>{{getCurrencySymbol()}} {{numberFormat($totalAmount)}}</b></th>
                      </tr>
                  </table>
                </div>
            </div>
        </div>
    </div>
  
  @elseif($list=='check_outs')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{lang_trans('heading_checkout_list')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    <table id="datatable" class="table table-striped table-bordered data-table">
                    <thead>
                      <tr>
                        <th>{{lang_trans('txt_sno')}}</th>
                        <th>{{lang_trans('txt_guest_name')}}</th>
                        <th>{{lang_trans('txt_mobile_num')}}</th>
                        <th>{{lang_trans('txt_email')}}</th>
                        <th>{{lang_trans('txt_room')}}</th>
                        <th>{{lang_trans('txt_payment_status')}}</th>
                        <th>{{lang_trans('txt_checkin')}}</th>
                        <th>{{lang_trans('txt_checkout')}}</th>
                        <th>{{lang_trans('txt_total_amount')}}</th>
                        <th>{{lang_trans('txt_action')}}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($datalist as $k=>$val)
                        @if($val->is_checkout == 1)
                        @php 
                          $calc = calcFinalAmount($val);
                          $totalAmount = $totalAmount+$calc['finalRoomAmount']+$calc['finalOrderAmount']+$calc['additionalAmount'];
                          $j++; 
                        @endphp
                        <tr>
                          <td>{{$j}}</td>
                          <td>{{($val->customer) ? $val->customer->name : 'NA'}}</td>
                          <td>{{($val->customer) ? $val->customer->mobile : 'NA'}}</td>
                          <td>{{($val->customer) ? $val->customer->email : 'NA'}}</td>
                          <td>
                            <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#booked_room_{{$val->id}}">{{lang_trans('btn_view')}}</button>
                            @include('backend/model/booked_rooms_modal',['val'=>$val])
                          </td>
                          <td class="text-center {{($val->payment_status == 1) ? 'text-success' : 'text-danger'}}">
                            {{config('constants.PAYMENT_STATUS')[$val->payment_status]}}
                            @if($val->payment_status == 0)
                              <button type="button" class="btn btn-xs btn-success confirm_btn" data-url="{{route('mark-as-paid',[$val->id])}}">{{lang_trans('btn_mark_as_paid')}}</button>
                            @endif
                          </td>
                          <td>{{dateConvert($val->check_in,'d-m-Y H:i')}}</td>
                          <td>{{dateConvert($val->check_out,'d-m-Y H:i')}}</td>
                          <td>{{getCurrencySymbol()}} {{numberFormat($calc['finalRoomAmount']+$calc['finalOrderAmount']+$calc['additionalAmount'])}}</td>
                          <td>
                            <a class="btn btn-xs btn-success" href="{{route('view-reservation',[$val->id])}}">{{lang_trans('btn_view')}}</a>
                            <a class="btn btn-xs btn-danger" href="{{route('invoice',[$val->id,1,'inv_type'=>'org'])}}" target="_blank">{{lang_trans('btn_invoice_room_org')}}</a>
                            {{-- <a class="btn btn-xs btn-danger" href="{{route('invoice',[$val->id,1,'inv_type'=>'dup'])}}" target="_blank">{{lang_trans('btn_invoice_room_dup')}}</a> --}}
                            <a class="btn btn-xs btn-warning" href="{{route('invoice',[$val->id,2])}}" target="_blank">{{lang_trans('btn_invoice_food')}}</a>
                          </td>
                        </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                  <table class="table table-striped table-bordered">
                      <tr>
                        <th class="text-right" width="70%">{{lang_trans('txt_grand_total')}}</th>
                        <th width="30%"><b>{{getCurrencySymbol()}} {{numberFormat($totalAmount)}}</b></th>
                      </tr>
                  </table>
                </div>
            </div>
        </div>
    </div>
    <script>
      globalVar.customerList = {!! json_encode($customer_list) !!};
    </script>    
  @elseif($list=='cancelled')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{lang_trans('sidemenu_cancelled_reservation')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>{{lang_trans('txt_sno')}}</th>
                        <th>{{lang_trans('txt_guest_name')}}</th>
                        <th>{{lang_trans('txt_mobile_num')}}</th>
                        <th>{{lang_trans('txt_email')}}</th>
                        <th>{{lang_trans('txt_checkin')}}</th>
                        <th>{{lang_trans('txt_cancelled_date')}}</th>
                        <th>{{lang_trans('txt_total_amount')}}</th>
                        <th>{{lang_trans('txt_action')}}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($datalist as $k=>$val)
                        @php 
                          $calc = calcFinalAmount($val);
                          $totalAmount = $totalAmount+$calc['finalRoomAmount']+$calc['finalOrderAmount']+$calc['additionalAmount'];
                          $j++; 
                        @endphp
                        <tr>
                          <td>{{$k + $datalist->firstItem()}}</td>
                          <td>{{($val->customer) ? $val->customer->name : 'NA'}}</td>
                          <td>{{($val->customer) ? $val->customer->mobile : 'NA'}}</td>
                          <td>{{($val->customer) ? $val->customer->email : 'NA'}}</td>
                          <td>{{dateConvert($val->check_in,'d-m-Y H:i')}}</td>
                          <td>{{dateConvert($val->cancelled_date,'d-m-Y H:i')}}</td>
                          <td>{{getCurrencySymbol()}} {{numberFormat($calc['finalRoomAmount']+$calc['finalOrderAmount']+$calc['additionalAmount'])}}</td>
                          <td>
                            <a class="btn btn-xs btn-success" href="{{route('view-reservation',[$val->id])}}">{{lang_trans('btn_view')}}</a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>

                  <div class="d-flex justify-content-center text-right">
                      {!! $datalist->links('pagination::bootstrap-4') !!}
                  </div>
                </div>
            </div>
        </div>
    </div>
  @endif
</div>       
@endsection