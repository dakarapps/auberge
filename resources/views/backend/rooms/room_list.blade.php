@extends('layouts.master_backend')
@section('content')
<div class="">
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('txt_list_room')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  <table id="datatable" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>{{lang_trans('txt_sno')}}</th>
                      <th>{{lang_trans('txt_room_type')}}</th>
                      <th>{{lang_trans('txt_name')}}</th>
                      <th>{{lang_trans('txt_room_num')}}</th>
                      <th>{{lang_trans('txt_floor')}}</th>
                      <th>{{lang_trans('txt_sort_order_num')}}</th>
                      <th>{{lang_trans('txt_status')}}</th>
                      <th>{{lang_trans('txt_action')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($datalist as $k=>$val)
                      <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$val->room_type->title}}</td>
                        <td>{{$val->room_name}}</td>
                        <td>{{$val->room_no}}</td>
                        <td>{{getDynamicDropdownById($val->floor, 'dropdown_value')}}</td>
                        <td>{{ $val->order_num }}</td>
                        <td>{!! getStatusBtn($val->status) !!}</td>
                        <td>
                          @isPermission('edit-room')
                            <a class="btn btn-sm btn-info" href="{{route('edit-room',[$val->id])}}"><i class="fa fa-pencil"></i></a>
                          @endisPermission
                          @isPermission('delete-room')
                            <button class="btn btn-danger btn-sm delete_btn" data-url="{{route('delete-room',[$val->id])}}" title="{{lang_trans('btn_delete')}}"><i class="fa fa-trash"></i></button>
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