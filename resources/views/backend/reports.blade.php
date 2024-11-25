@extends('layouts.master_backend')
@section('content')
@php 
  $i = $j = 0; 
  $totalAmount = 0;
  $totalNetAmoun = 0;
  $totalIncomeAmount = 0;
  $totalExpenseAmount = 0;
@endphp
<div class="">
   @if($report_of == 'transactions')
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('txt_transactions_report')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                {{ Form::model($search_data,array('url'=>route('search-payment-history'),'id'=>"search-payment-history", 'class'=>"form-horizontal form-label-left")) }}
                  {{-- <div class="form-group col-sm-3">
                    <label class="control-label">{{lang_trans('txt_guest')}}</label>
                    {{Form::text('customer_id',null,['class'=>"form-", "id"=>"customers", "placeholder"=>lang_trans('ph_select')])}}
                  </div> --}}
                  <div class="form-group col-sm-2">
                    <label class="control-label">{{lang_trans('txt_transaction_id')}}</label>
                    {{Form::text('transaction_id',null,['class'=>"form-control", "id"=>"transaction_id", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_transaction_id')])}}
                  </div>
                  <div class="form-group col-sm-2">
                    <label class="control-label"> {{lang_trans('txt_activity')}}</label>
                    {{Form::select('purpose',$payment_purpose,null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
                  </div>
                  <div class="form-group col-sm-2">
                    <label class="control-label">{{lang_trans('txt_date_from')}}</label>
                    {{Form::text('date_from',null,['class'=>"form-control datepicker", 'placeholder'=>lang_trans('ph_date_from')])}}
                  </div>
                  <div class="form-group col-sm-2">
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
              <div class="x_content">
                    <br/>
                    <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>{{lang_trans('txt_sno')}}</th>
                        {{-- <th>{{lang_trans('txt_user_name')}}</th>
                        <th>{{lang_trans('txt_customer_name')}}</th> --}}
                        <th>{{lang_trans('txt_transaction_id')}}</th>
                        <th>{{lang_trans('txt_activity')}}</th>
                        <th>{{lang_trans('txt_payment_mode')}}</th>
                        <th>{{lang_trans('txt_date')}}</th>
                        <th>{{lang_trans('txt_total_amount')}}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($datalist as $k=>$val)
                        @if($val->is_checkout==0)
                          @php 
                            if($val->payment_of=='cr') {
                              $totalIncomeAmount += $val->payment_amount;
                            }
                            else if($val->payment_of=='dr') {
                              $totalExpenseAmount += $val->payment_amount;
                            }
                            $totalAmount += $val->payment_amount;
                            $i++; 
                          @endphp
                        <tr>
                          <td>{{$i}}</td>
                          {{-- <td>{{($val->user) ? $val->user->name : ''}}</td>
                          <td>{{($val->customer) ? $val->customer->name : ''}}</td> --}}
                          <td>{{$val->transaction_id}}</td>
                          <td>{{getPaymentPurpose($val->purpose)}}</td>
                          <td>{{$val->payment_type}}</td>
                          <td>{{dateConvert($val->payment_date  ,'d-m-Y H:i')}}</td>
                          <td class="text-right {{($val->payment_of=='cr' ? 'text-success' : 'text-danger')}}">
                            {{getCurrencySymbol()}} {{numberFormat($val->payment_amount)}} {{ucfirst($val->payment_of)}}
                          </td>
                        </tr>
                        @endif
                      @endforeach
                    </tbody>
                  </table>
                  @php
                    $totalNetAmoun = $totalIncomeAmount-$totalExpenseAmount;
                  @endphp
                  <table class="table table-striped table-bordered">
                      <tr>
                        <th class="text-right" width="20%">{{lang_trans('txt_total_income')}}</th>
                        <th width="70%" class=""><b>{{getCurrencySymbol()}} {{numberFormat($totalIncomeAmount)}}</b></th>
                      </tr>
                      <tr>
                        <th class="text-right" width="20%">{{lang_trans('txt_total_expense')}}</th>
                        <th width="70%" class=""><b>{{getCurrencySymbol()}} {{numberFormat($totalExpenseAmount)}}</b></th>
                      </tr>
                      <tr>
                        <th class="text-right" width="20%">{{lang_trans('txt_total_netamount')}}</th>
                        <th width="70%" class="{{($totalNetAmoun > 0 ? 'text-success' : 'text-danger')}}"><b>{{getCurrencySymbol()}} {{numberFormat($totalNetAmoun)}}</b></th>
                      </tr>
                  </table>
                </div>
          </div>
      </div>
    </div>
  @endif

  @if($report_of == 'checkouts')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{lang_trans('txt_checkout_report')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
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
                    <a class="btn btn-success search-btn" href="{{route('list-check-outs')}}">{{lang_trans('btn_search')}}</a>
                    <button class="btn btn-primary export-btn" name="submit_btn" value="export" type="submit">{{lang_trans('btn_export')}}</button>
                  </div>
                {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
  @endif

  @if($report_of == 'expense')
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
              <h2>{{lang_trans('txt_expense_report')}}</h2>
              <div class="clearfix"></div>
          </div>
          <div class="x_content">
              {{ Form::model($search_data,array('url'=>route('search-expenses'),'id'=>"search-expense", 'class'=>"form-horizontal form-label-left")) }}
                <div class="form-group col-sm-3">
                  <label class="control-label"> {{lang_trans('txt_category')}}</label>
                  {{Form::select('category_id',$category_list,null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label"> {{lang_trans('txt_date_from')}}</label>
                  {{Form::text('date_from',null,['class'=>"form-control datepicker", 'placeholder'=>lang_trans('ph_date_from')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label"> {{lang_trans('txt_date_to')}}</label>
                  {{Form::text('date_to',null,['class'=>"form-control datepicker", 'placeholder'=>lang_trans('ph_date_to')])}}
                </div>
                <div class="form-group col-sm-3">
                  <br/>
                    <a class="btn btn-success search-btn" href="{{route('list-expense')}}">{{lang_trans('btn_search')}}</a>
                   <button class="btn btn-primary export-btn" name="submit_btn" value="export" type="submit">{{lang_trans('btn_export')}}</button>
                </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>
    </div>
  @endif

</div>
<script>
      globalVar.customerList = {!! json_encode($customer_list) !!};
    </script>    
@endsection