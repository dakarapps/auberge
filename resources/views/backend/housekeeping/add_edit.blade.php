@extends('layouts.master_backend')
@section('content')
@php 
      $flag=0;
      $heading=lang_trans('btn_add');
      $housekeepingItems='';
      if(isset($data_row) && !empty($data_row)){
          $flag=1;
          $heading=lang_trans('btn_update');
          $housekeepingItems=$data_row->housekeeping_items;
      }
      $roomId = (isset($room_id)) ? $room_id : null;
      $reservationId = (isset($reservation_id)) ? $reservation_id : null;
  @endphp
<div class="">
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{$heading}} {{lang_trans('txt_order')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                  @if($flag==1)
                      {{ Form::model($data_row,array('url'=>route('save-housekeeping-order'),'id'=>"housekeeping-order-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                      {{Form::hidden('id',null)}}
                  @else
                      {{ Form::open(array('url'=>route('save-housekeeping-order'),'id'=>"housekeeping-order-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                      {{Form::hidden('reservation_id',$reservationId)}}
                  @endif
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12"> {{lang_trans('txt_housekeeping_item')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              {{ Form::select('items[]',$item_list,null,['class'=>'form-control', 'id'=>'housekeeping_items', 'multiple'=>'multiple', 'required'=>true]) }}    
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12"> {{lang_trans('txt_room')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              {{ Form::select('room_id',$room_list,$roomId,['class'=>'form-control','placeholder'=>lang_trans('ph_select')]) }}    
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12"> {{lang_trans('txt_housekeeping_status')}} <span class="required">*</span></label>
                          <div class="col-md-5 col-sm-5 col-xs-10">
                              {{ Form::select('housekeeping_status_id',$status_list,null,['class'=>'form-control','placeholder'=>lang_trans('ph_select')]) }}    
                          </div>
                          @if(isPermission('dynamic-dropdown-list'))
                            <div class="col-md-1 col-sm-1 col-xs-2">
                                <a class="btn btn-sm btn-success" href="{{route('dynamic-dropdown-list')}}" target="_blank"><i class="fa fa-plus"></i>&nbsp;{{lang_trans('txt_add_new')}}</a>
                            </div>
                          @endif
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12"> {{lang_trans('txt_assigned_to')}} <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              {{ Form::select('housekeeper_id',$housekeeper_list,null,['class'=>'form-control','placeholder'=>lang_trans('ph_select')]) }}    
                          </div>
                      </div>
                     
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="remark"> {{lang_trans('txt_remark')}}</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            {{Form::textarea('remark',null,['class'=>"form-control col-md-7 col-xs-12", "id"=>"remark", "rows"=>2])}}
                          </div>
                      </div>
                      
                      <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                              <button class="btn btn-primary" type="reset">
                                  {{lang_trans('btn_reset')}}
                              </button>
                              <button class="btn btn-success" type="submit">
                                  {{lang_trans('btn_submit')}}
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
{{-- require set var in js var --}}
<script>
  globalVar.page = 'housekeeping_order_add_edit';
  globalVar.selectedHousekeepingItems = "{{$housekeepingItems}}";
</script> 
<script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js')}}"></script>       
@endsection