@extends('layouts.master_backend')
@section('content')
<div class="">
  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_title">
                  <h2>{{lang_trans('heading_language_translations')}}</h2>
                  <div class="clearfix"></div>
              </div>
                <div class="x_content">
                  <table id="datatable__" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th class="text-center">{{lang_trans('txt_sno')}}</th>
                          @foreach($languages as $lang_code=>$lang_name)
                            <th class="text-center">
                              {{strtoupper($lang_code)}}
                              <sub>{{$lang_name}}</sub>
                            </th>
                          @endforeach
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($datalist as $key=>$value)
                          {{Form::open(array('url'=>route('save-language-translations')))}}
                          @foreach($value as $k=>$val)
                              <tr>
                                <td class="text-center" width="2%">{{$key+1}}.{{$k+1}}</td>
                                @foreach($languages as $lang_code=>$lang_name)
                                  @php
                                    $disabled = (in_array($lang_code, getLangForUpdateDisable())) ? true : false;
                                  @endphp
                                  <td>
                                    {{Form::text('lang['.$val['id'].']['.$lang_code.']',$val[$lang_code],['class'=>"form-control col-xs-12", 'title'=>$val['lang_key'].': '.$val[$lang_code], 'placeholder'=>$lang_name, 'disabled'=>$disabled])}}
                                  </td>
                                @endforeach                                
                              </tr>
                            @endforeach
                           <tr>
                            <td colspan="{{count($languages)+1}}" class="text-right">
                              <input type="submit" value="{{lang_trans('btn_update')}}" class="btn btn-primary"/>
                            </td>
                          </tr>
                          {{ Form::close() }}
                          @endforeach
                      </tbody>
                  </table>
                </div>
              
          </div>
      </div>
  </div>
</div>        
@endsection