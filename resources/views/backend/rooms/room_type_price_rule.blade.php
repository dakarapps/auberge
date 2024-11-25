@extends('layouts.master_backend')
@section('content')

<div class="">
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('txt_price_rules')}}</h2>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <br/>
                    {{ Form::open(array('url'=>route('save-room-types-price-rule'),'id'=>"set-room-type-price-form", 'class'=>"form-horizontal form-label-left", "files"=>true)) }}
                    {{ Form::hidden('room_type_id', $room_type_id)}}
                    <div class="row">
                      <div class="col-sm-6">
                          <table class="table table-bordered">
                            <tr>
                              <th class="text-center">{{lang_trans('txt_sno')}}.</th>
                              <th class="text-center">{{lang_trans('txt_select')}}</th>
                              <th class="text-center">{{lang_trans('txt_season_name')}}</th>
                              <th class="text-center">{{lang_trans('txt_price')}}</th>
                            </tr>
                            @forelse($seasons_list as $k=>$val)
                              @php
                                $priceId = $price = null;
                                $isChecked = false;
                                if(isset($price_list[$val->id])){
                                  $priceId = $price_list[$val->id]['id'];
                                  $price = $price_list[$val->id]['price'];
                                  $isChecked = true;
                                } 
                              @endphp
                              <tr>
                                <td>{{$k+1}}.</td>
                                <td class="text-center">
                                  {{ Form::hidden('ids['.$val->id.']', $priceId) }}
                                  {{ Form::checkbox('season_ids[]', $val->id, $isChecked,['class'=>""] ) }}
                                </td>
                                <td>
                                  <b>{{$val->name}}</b><br/>
                                  {{lang_trans('txt_start_date')}}: {{dateConvert($val->start_date)}} | {{lang_trans('txt_end_date')}}: {{dateConvert($val->end_date)}}
                                </td>
                                <td>
                                  {{Form::text('amount['.$val->id.']',$price,['class'=>"form-control col-md-7 col-xs-12", "id"=>"base_price"])}}
                                </td>
                              </tr>
                              @empty
                                <tr>
                                    <td colspan="4">
                                    {{lang_trans('txt_no_record')}}
                                    <a class="btn btn-xs btn-success" href="{{route('add-season')}}">{{lang_trans('sidemenu_season_add')}}</a>
                                  </td>
                                </tr>
                              @endforelse
                          
                          </table>
                      </div>
                      <div class="col-sm-3">&nbsp;</div>
                    </div>

                      <div class="ln_solid">
                      </div>
                      <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
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