@extends('layouts.master_backend')
@section('content')
@php
  $i = 0;
@endphp
<div class="">
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_list_permission')}}</h2>
                  <div class="clearfix"></div>
              </div>
                <div class="x_content">
                  <table id="datatable__" class="table table-striped table-bordered">
                      <tbody>
                        @foreach($category_list as $cat)
                          @if(isset($datalist[$cat]))
                            @php
                              $i++;
                            @endphp
                            {{Form::open(array('url'=>route('save-permissions')))}}
                              <tr>
                                <th class="bg-success" colspan="2">{{lang_trans('txt_perm_'.$cat)}}</th>
                                <th class="text-center">{{lang_trans('txt_superadmin')}}</th>
                                <th class="text-center">{{lang_trans('txt_admin')}}</th>
                                <th class="text-center">{{lang_trans('txt_receptionist')}}</th>
                                <th class="text-center">{{lang_trans('txt_store_manager')}}</th>
                                <th class="text-center">{{lang_trans('txt_financial_manager')}}</th>
                                <th class="text-center">{{lang_trans('txt_housekeeper')}}</th>
                              </tr>
                              @foreach($datalist[$cat] as $k=>$val)
                                <tr>
                                  <td class="text-center" width="10%">{{$i}}.{{$k+1}}</td>
                                  <td>{{$val->description}}</span></td>
                                  <td class="text-center" width="10%">
                                    {{Form::hidden('ids[]',$val->id)}}
                                    {{ Form::checkbox('super_admin['.$val->id.']',null, ($val->super_admin==1) ? true: false,['class'=>"disable-checkbox"] ) }}
                                  </td>
                                  <td class="text-center" width="10%">{{ Form::checkbox('admin['.$val->id.']',null, ($val->admin==1) ? true: false ) }}</td>
                                  <td class="text-center" width="10%">{{ Form::checkbox('receptionist['.$val->id.']',null, ($val->receptionist==1) ? true: false ) }}</td>
                                  <td class="text-center" width="10%">{{ Form::checkbox('store_manager['.$val->id.']',null, ($val->store_manager==1) ? true: false ) }}</td>
                                  <td class="text-center" width="10%">{{ Form::checkbox('financial_manager['.$val->id.']',null, ($val->financial_manager==1) ? true: false ) }}</td>
                                  <td class="text-center" width="10%">{{ Form::checkbox('housekeeper['.$val->id.']',null, ($val->housekeeper==1) ? true: false ) }}</td>
                                </tr>
                              @endforeach
                              <tr>
                                <th colspan="7">&nbsp;</th>
                                <th>
                                  <div class="col-md-12 text-right p-right-0">
                                    <input type="submit" value="{{lang_trans('btn_update')}}" class="btn btn-primary"/>
                                  </div>
                                </th>
                              </tr>
                            {{ Form::close() }}
                          @endif
                        @endforeach
                      </tbody>
                  </table>
                </div>
          </div>
      </div>
  </div>
</div>        
@endsection