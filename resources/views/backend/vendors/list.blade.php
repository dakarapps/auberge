@extends('layouts.master_backend')
@section('content')
<div class="">
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_vendor_list')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  <table id="datatable" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>{{lang_trans('txt_sno')}}</th>
                      <th>{{lang_trans('txt_category')}}</th>
                      <th>{{lang_trans('txt_name')}}</th>
                      <th>{{lang_trans('txt_email')}}</th>
                      <th>{{lang_trans('txt_mobile_num')}}</th>
                      <th>{{lang_trans('txt_address')}}</th>
                      <th>{{lang_trans('txt_country')}}</th>
                      <th>{{lang_trans('txt_city')}}</th>
                      <th>{{lang_trans('txt_action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($datalist as $k=>$val)
                      <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$val->category->name}}</td>
                        <td>{{$val->vendor_name}}</td>
                        <td>{{$val->vendor_email}}</td>
                        <td>{{$val->vendor_mobile}}</td>
                        <td>{!!$val->vendor_address!!}</td>
                        <td>{{$val->country->name}}</td>
                        <td>{{$val->vendor_city}}</td>
                        <td>
                          @isPermission('view-vendor')
                            <a class="btn btn-sm btn-primary" href="{{route('view-vendor',[$val->id])}}"><i class="fa fa-eye"></i></a>
                          @endisPermission

                          @isPermission('edit-vendor')
                            <a class="btn btn-sm btn-info" href="{{route('edit-vendor',[$val->id])}}"><i class="fa fa-pencil"></i></a>
                          @endisPermission

                          @isPermission('delete-vendor')
                            <button class="btn btn-danger btn-sm delete_btn" data-url="{{route('delete-vendor',[$val->id])}}" title="{{lang_trans('btn_delete')}}"><i class="fa fa-trash"></i></button>
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
@endsection