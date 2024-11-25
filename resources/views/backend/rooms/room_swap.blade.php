@extends('layouts.master_backend')
@section('content')
@php 
  $allBookedRooms = getAllBookedRooms();
@endphp
<div class="">
  {{ Form::open(array('url'=>route('save-swap-room'),'id'=>"swap-room-form", 'class'=>"form-horizontal form-label-left")) }}
  {{Form::hidden('id',$reservation_id,['id'=>'base_price'])}}
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('txt_heading_booked_rooms')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content"> 
                <div class="row"> 
                  @if($booked_rooms)
                    @foreach($booked_rooms as $key=>$roomId)
                      @php 
                        $roomInfo = getRoomById($roomId);
                        $radioBtnValue = $roomInfo->room_type_id.'~'.$roomId;
                      @endphp
                      <div class="col-md-2 col-sm-2 col-xs-12">
                        {{Form::radio('old_room',$radioBtnValue,false,['class'=>"custom-radio", "id"=>"old_room_".$roomId])}} 
                        <label for="old_room_{{$roomId}}">{{$roomInfo->room_no}}</label>
                      </div>
                    @endforeach
                  @endif
                </div>
              </div>
          </div>
      </div>
  </div>
       
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('txt_heading_select_room_for_swap')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row">
                  @php
                    $collapseInFirstCat = 'no';
                  @endphp
                  @foreach($roomtypes_list as $k=>$roomType)
                    @php
                      $i = 0;
                      if($collapseInFirstCat == 'yes'){
                        $collapseInFirstCat = '';
                      }
                      if($roomType->rooms && $roomType->rooms->count() && $collapseInFirstCat == 'no'){
                        foreach($roomType->rooms as $key=>$room){
                          if(!in_array($room->id, $allBookedRooms)){
                            $collapseInFirstCat = 'yes';
                          }
                        }
                      }
                    @endphp
                    <div class="panel-group">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <i class="fa fa-list"></i>
                            <a class="room_type_by_rooms" data-roomtypeid="{{$k}}" data-toggle="collapse" href="#collapse{{$k}}">{{$roomType->title}} (Price: {{$roomType->base_price}})</a>
                          </h4>
                        </div>
                        <div id="collapse{{$k}}" class="panel-collapse collapse {{ ($collapseInFirstCat == 'yes') ? 'in' : "" }}">
                          <table class="table table-striped table-bordered">
                            @if($roomType->rooms && $roomType->rooms->count())
                              <thead>
                                <tr>
                                  <th class="text-center">{{lang_trans('txt_sno')}}</th>
                                  <th class="text-center">{{lang_trans('txt_select')}}</th>
                                  <th>{{lang_trans('txt_room_num')}}</th>
                                </tr>
                              </thead>
                              <tbody class="rooms_list">
                                   @foreach($roomType->rooms as $key=>$room)
                                    @if(!in_array($room->id, $allBookedRooms))
                                      @php
                                        $i++;
                                        $radioBtnValue = $room->room_type_id.'~'.$room->id;
                                      @endphp
                                      <tr>
                                        <td class="text-center" width="5%">{{$i}}</td>
                                        <td class="text-center" width="15%">{{Form::radio('new_room',$radioBtnValue,false,['class'=>"custom-radio", "id"=>"new_room_".$room->id])}} </td>
                                        <td>{{$room->room_no}}</td>
                                      </tr>
                                    @endif
                                   @endforeach
                              </tbody>
                            @else
                              <tr>
                                <td>{{lang_trans('txt_no_rooms')}}</td>
                              </tr>
                            @endif
                          </table>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
          </div>
      </div>
  </div>


  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">             
              <div class="x_content">
                  
                   <div class="ln_solid"></div>
                  <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                      <button class="btn btn-success btn-submit-form" type="submit">{{lang_trans('btn_submit')}}</button>
                  </div>
              </div>
          </div>
      </div>
  </div>

  
  {{ Form::close() }}
</div>   
@endsection