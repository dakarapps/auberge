@extends('layouts.master_backend')
@section('content')
<div class="">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
            <h2>{{lang_trans('heading_filter_laundry_orders')}}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            {{ Form::model($search_data,array('url'=>route('search-laundry-order'),'id'=>"search-laundry-order", 'class'=>"form-horizontal form-label-left")) }}
              <div class="form-group col-sm-3">
                <label class="control-label"> {{lang_trans('txt_order_num')}}</label>
                {{Form::text('order_num',null,['class'=>"form-control", "id"=>"name", "placeholder"=>lang_trans('ph_enter').lang_trans('txt_order_num')])}}
              </div>
              <div class="form-group col-sm-3">
                <label class="control-label"> {{lang_trans('txt_order_status')}}</label>
                {{Form::select('order_status',$status_list,null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
              </div>
              <div class="form-group col-sm-3">
                <label class="control-label"> {{lang_trans('txt_vendor')}}</label>
                {{Form::select('vendor_id',$vendor_list,null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
              </div>
              <div class="form-group col-sm-3">
                <label class="control-label"> {{lang_trans('txt_room')}}</label>
                {{Form::select('room_id',$room_list,null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
              </div>
              <div class="form-group col-sm-3">
                <label class="control-label"> {{lang_trans('txt_date_from')}}</label>
                {{Form::text('date_from',null,['class'=>"form-control datepicker", 'placeholder'=>lang_trans('ph_date_from')])}}
              </div>
              <div class="form-group col-sm-3">
                <label class="control-label"> {{lang_trans('txt_date_to')}}</label>
                {{Form::text('date_to',null,['class'=>"form-control datepicker", 'placeholder'=>lang_trans('ph_date_to')])}}
              </div>
              <div class="form-group col-sm-3">
                <br/>
                 <button class="btn btn-success search-btn" name="submit_btn" value="search" type="submit">{{lang_trans('btn_search')}}</button>
                @if(isPermission('export-laundry-order'))
                  <button class="btn btn-primary export-btn" name="submit_btn" value="export" type="submit">{{lang_trans('btn_export')}}</button>
                @endif
              </div>
            {{ Form::close() }}
          </div>
        </div>
    </div>
  </div>
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('txt_order_list')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  <table id="datatable" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>{{lang_trans('txt_sno')}}</th>
                      <th>{{lang_trans('txt_vendor')}}</th>
                      <th>{{lang_trans('txt_order_num')}}</th>
                      <th>{{lang_trans('txt_date')}}</th>
                      <th>{{lang_trans('txt_room')}}</th>
                      <th>{{lang_trans('txt_order_status')}}</th>
                      <th>{{lang_trans('txt_total_amount')}}</th>
                      <th>{{lang_trans('txt_action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($datalist as $k=>$val)
                      @php
                        $btnText = isset($status_list[$val->order_status+1]) ? $status_list[$val->order_status+1] : null;

                        $calculatedAmount = calcLaundryAmount($val, 1);
                        $gstApply = $calculatedAmount['gstApply'];
                        $gstPerc = $calculatedAmount['gstPerc'];
                        $cgstPerc = $calculatedAmount['cgstPerc'];
                        $gstAmount = $calculatedAmount['gstAmount'];
                        $cgstAmount = $calculatedAmount['cgstAmount'];
                        $totalDiscount = $calculatedAmount['totalDiscount'];
                        $subtotalAmount = $calculatedAmount['subtotalAmount'];
                        $totalAmount = $calculatedAmount['totalAmount'];
                      @endphp
                      <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$val->vendor_info->vendor_name}}</td>
                        <td>{{$val->order_num}}</td>
                        <td>{{dateConvert($val->order_date, 'Y-m-d')}}</td>
                        <td>{{ ($val->room_info) ? $val->room_info->room_no.' | '.$val->room_info->room_name : '' }}</td>
                        <td>{!!getStatusBtn($val->order_status,4)!!}</td>
                        <td class="text-right">{{numberFormat($totalAmount)}}</td>
                        <td>                          
                          @if(isPermission('view-laundry-order'))
                            <a class="btn btn-sm btn-primary" href="{{route('view-laundry-order',[$val->id])}}"><i class="fa fa-eye"></i></a>
                          @endif
                
                          @if(isPermission('edit-laundry-order') && in_array($val->order_status, [0, 1]))
                            <a class="btn btn-sm btn-info" href="{{route('edit-laundry-order',[$val->id])}}"><i class="fa fa-pencil"></i></a>
                          @endif

                          @if(isPermission('delete-laundry-order') && in_array($val->order_status, [0]))
                            <button class="btn btn-danger btn-sm delete_btn" data-url="{{route('delete-laundry-order',[$val->id])}}" title="{{lang_trans('btn_delete')}}"><i class="fa fa-trash"></i></button>
                          @endif
                          
                          @if(isPermission('update-laundry-order-status') && $btnText && in_array($val->order_status, [0, 1]))
                            <button class="btn btn-warning btn-sm confirm_btn laundry_order_status_btn" data-url="{{route('update-laundry-order-status',['order_id'=>$val->id, 'status'=>$val->order_status])}}" title="{{$btnText}}">{{lang_trans('txt_set')}} {{$btnText}}</button>
                          @endif

                          @if(isPermission('edit-laundry-order') && $val->order_status == 2)
                              <a class="btn btn-sm btn-success" href="{{route('edit-laundry-order',[$val->id])}}">{{lang_trans('txt_set')}} {{$btnText}}</a>
                          @endif

                          @if(isPermission('invoice-laundry-order') && $val->order_status == 3)
                            <a class="btn btn-sm btn-danger" href="{{route('invoice-laundry-order',[$val->id])}}">{{lang_trans('txt_invoice')}}</a>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
          </div>
      </div>
  </div>
</div>      
@endsection