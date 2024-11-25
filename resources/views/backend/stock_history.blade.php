@extends('layouts.master_backend')
@section('content')
<div class="">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
            <h2>{{lang_trans('heading_filter_stock_history')}}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            {{ Form::model($search_data,array('url'=>route('search-stocks'),'id'=>"search-stocks", 'class'=>"form-horizontal form-label-left")) }}
              <div class="form-group col-sm-3">
                <label class="control-label"> {{lang_trans('txt_product')}}</label>
                {{Form::select('product_id',$products,null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
              </div>
              <div class="form-group col-sm-3">
                <label class="control-label"> {{lang_trans('txt_room')}}</label>
                {{Form::select('room_id',$rooms,null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
              </div>
              <div class="form-group col-sm-2">
                <label class="control-label"> {{lang_trans('txt_stock')}}</label>
                {{Form::select('is_stock',['add'=>'Add','subtract'=>'Subtract'],null,['class'=>"form-control",'placeholder'=>lang_trans('ph_select')])}}
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
                 <button class="btn btn-success search-btn" name="submit_btn" value="search" type="submit">{{lang_trans('btn_search')}}</button>
                 <button class="btn btn-primary export-btn" name="submit_btn" value="export" type="submit">{{lang_trans('btn_export')}}</button>
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
                  <h2>{{lang_trans('heading_stock_history')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  <table id="datatable" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>{{lang_trans('txt_sno')}}</th>
                      <th>{{lang_trans('txt_product')}}</th>
                      <th>{{lang_trans('txt_room')}}</th>
                      <th>{{lang_trans('txt_stock')}}</th>
                      <th>{{lang_trans('txt_qty')}}</th>
                      <th>{{lang_trans('txt_price')}}</th>
                      <th>{{lang_trans('txt_by')}}</th>
                      <th>{{lang_trans('txt_date')}}</th>
                      <th>{{lang_trans('txt_remark')}}</th>
                      <th>{{lang_trans('txt_action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($datalist->count()>0)
                    @foreach($datalist as $k=>$val)
                      <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$val->product->name}}</td>
                        <td>{{($val->room) ? $val->room->room_no.' ('.$val->room->room_name.')' : ''}}</td>
                        <td>{{ucfirst($val->stock_is)}}</td>
                        <td>{{$val->qty}}</td>
                        <td>@if($val->price>0) {{getCurrencySymbol()}} {{$val->price}} @endif</td>
                        <td>{{ucfirst($val->user->name)}}</td>
                        <td>{{dateConvert($val->stock_date,'d-m-Y')}}</td>
                        <td>{!!$val->remark!!}</td>
                        <td>
                          @if(isPermission('delete-stock-history'))
                            <button class="btn btn-danger btn-sm delete_btn" data-url="{{route('delete-stock-history',[$val->id])}}" title="{{lang_trans('btn_delete')}}"><i class="fa fa-trash"></i></button>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
          </div>
      </div>
  </div>
</div>          
@endsection