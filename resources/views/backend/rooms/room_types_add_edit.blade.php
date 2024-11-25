@extends('layouts.master_backend')
@section('content')
@php 
      $flag=0;
      $heading=lang_trans('btn_add');
      $expAmenities = [];
      if(isset($data_row) && !empty($data_row)){
          $flag=1;
          $heading=lang_trans('btn_update');
          $expAmenities = explode(',', $data_row->amenities);
      }
  @endphp
<div class="">
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{$heading}} {{lang_trans('txt_room_type')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  @if($flag==1)
                      {{ Form::model($data_row,array('url'=>route('save-room-types'),'id'=>"room-type-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                      {{Form::hidden('id',null)}}
                  @else
                      {{ Form::open(array('url'=>route('save-room-types'),'id'=>"room-type-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                  @endif
                  
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type_title"> {{lang_trans('txt_title')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('title',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"type_title", "required"=>"required"])}}
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">{{lang_trans('txt_type')}}</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::select('status',getConstants('LIST_ROOM_CATEGORY'),null,['class'=>'form-control']) }}    
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type_short_code"> {{lang_trans('txt_short_code')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('short_code',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"type_short_code", "required"=>"required"])}}
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="adult_capacity"> {{lang_trans('txt_adult_capacity')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::number('adult_capacity',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"adult_capacity", "required"=>"required"])}}
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kids_capacity"> {{lang_trans('txt_kids_capacity')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::number('kids_capacity',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"kids_capacity", "required"=>"required"])}}
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="base_price"> {{lang_trans('txt_base_price')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::text('base_price',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"base_price", "required"=>"required"])}}
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="order_num"> {{lang_trans('txt_sort_order_num')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::number('order_num',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"order_num", "required"=>"required"])}}
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="base_price"> {{lang_trans('txt_amenities')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            @if($amenities_list)
                              @foreach($amenities_list as $k=>$val)
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                  <div class="checkbox">
                                    <label>{{Form::checkbox('amenities_ids[]', $val->id, (in_array($val->id, $expAmenities)) ? true : false )}}{{$val->name}}</label>
                                  </div>
                                </div>
                              @endforeach
                            @endif
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">{{lang_trans('txt_status')}}</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{ Form::select('status',config('constants.LIST_STATUS'),1,['class'=>'form-control']) }}    
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="room_images"> {{lang_trans('txt_images')}}</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::file('room_type_images[]',['class'=>"form-control",'id'=>'room_type_images','multiple'=>true])}}
                          </div>
                      </div>
                      @if( $flag==1 && $data_row->attachments->count())
                        <div class="row">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="attachments"> {{lang_trans('txt_uploaded_files')}}</label>
                          <div class="col-sm-6">
                              <table class="table table-bordered">
                                <tr>
                                  <th>{{lang_trans('txt_sno')}}.</th>
                                  <th>{{lang_trans('txt_name')}}.</th>
                                  <th>{{lang_trans('txt_action')}}</th>
                                </tr>
                                @if($data_row->attachments)
                                  @foreach($data_row->attachments as $k=>$val)
                                    @if($val->file!='')
                                      <tr>
                                        <td>{{$k+1}}</td>
                                        <td>{{$val->file}}</td>
                                        <td>
                                          <a href="{{checkFile($val->file,'uploads/room_type_images/','blank_id.jpg')}}" data-toggle="lightbox"  data-title="{{lang_trans('txt_attachment')}}" data-footer="" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> </a>
                                          <a href="{{checkFile($val->file,'uploads/room_type_images/','blank_id.jpg')}}" class="btn btn-sm btn-success" download><i class="fa fa-download"></i> </a>
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
                          <div class="col-sm-3">&nbsp;</div>
                        </div>
                      @endif
                      <div class="ln_solid">
                      </div>
                      <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                              <button class="btn btn-primary" type="reset">{{lang_trans('btn_reset')}}</button>
                              <button class="btn btn-success" type="submit">{{lang_trans('btn_submit')}}</button>
                          </div>
                      </div>
                  {{ Form::close() }}
              </div>
          </div>
      </div>
  </div>
</div>      
@endsection