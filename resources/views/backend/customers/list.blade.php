@extends('layouts.master_backend')
@section('content')
<div class="">
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
              <h2>{{lang_trans('heading_filter_customer')}}</h2>
              <div class="clearfix"></div>
          </div>
          <div class="x_content">
              {{ Form::model($search_data,array('url'=>route('search-customer'),'id'=>"search-customer", 'class'=>"form-horizontal form-label-left")) }}
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_fullname')}}</label>
                  {{Form::text('customer_id',null,['class'=>"form-", "id"=>"customers", "placeholder"=>lang_trans('ph_select')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_mobile_num')}}</label>
                  {{Form::text('mobile_num',null,['class'=>"form-control", 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_mobile_num')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_city')}}</label>
                  {{Form::text('city',null,['class'=>"form-control", 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_city')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_state')}}</label>
                  {{Form::text('state',null,['class'=>"form-control", 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_state')])}}
                </div>
                <div class="form-group col-sm-2">
                  <label class="control-label">{{lang_trans('txt_country')}}</label>
                  {{Form::text('country',null,['class'=>"form-control", 'placeholder'=>lang_trans('ph_enter').lang_trans('txt_country')])}}
                </div>
                <div class="form-group col-sm-2">
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
                  <h2>{{lang_trans('txt_list_customers')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  <table id="datatable" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>{{lang_trans('txt_sno')}}</th>
                      <th>{{lang_trans('txt_fullname')}}</th>
                      <th>{{lang_trans('txt_father_name')}}</th>
                      <th>{{lang_trans('txt_mobile_num')}}</th>
                      <th>{{lang_trans('txt_email')}}</th>
                      <th>{{lang_trans('txt_gender')}}</th>
                      <th>{{lang_trans('txt_address')}}</th>
                      <th>{{lang_trans('txt_nationality')}}</th>
                      <th>{{lang_trans('txt_country')}}</th>
                      <th>{{lang_trans('txt_state')}}</th>
                      <th>{{lang_trans('txt_city')}}</th>
                      <th>{{lang_trans('txt_action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($datalist as $k=>$val)
                      <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$val->name}}</td>
                        <td>{{$val->father_name}}</td>
                        <td>{{$val->mobile}}</td>
                        <td>{{$val->email}}</td>
                        <td>{{$val->gender}}</td>
                        <td>{{$val->address}}</td>
                        <td>{{@config('constants.NATIONALITY_LIST')[$val->nationality]}}</td>
                        <td>{{$val->country}}</td>
                        <td>{{$val->state}}</td>
                        <td>{{$val->city}}</td>
                        <td>
                          @isPermission('edit-customer')
                            <a class="btn btn-sm btn-info" href="{{route('edit-customer',[$val->id])}}"><i class="fa fa-pencil"></i></a>
                          @endisPermission
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
<script>
  globalVar.customerList = {!! json_encode($customer_list) !!};
</script>              
@endsection