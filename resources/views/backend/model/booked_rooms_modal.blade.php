<div id="booked_room_{{$val->id}}" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{lang_trans('txt_heading_booked_rooms')}}</h4>
      </div>
        <div class="modal-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center" width="2%">{{lang_trans('txt_sno')}}.</th>
                  <th class="text-center" width="10%">{{lang_trans('txt_room')}}</th>
                  <th class="text-center" width="5%">{{lang_trans('txt_duration_of_stay')}}</th>
                  <th class="text-center" width="20%">{{lang_trans('txt_base_price')}}</th>
                </tr>
              </thead>
              <tbody>
                @if($val->booked_rooms) 
                  @foreach($val->booked_rooms as $key=>$roomInfo)
                    @php
                      $checkIn = dateConvert($roomInfo->check_in, 'Y-m-d');
                      $checkOut = dateConvert($roomInfo->check_out, 'Y-m-d');
                      $durOfStayPerRoom = dateDiff($checkIn, $checkOut, 'days');
                      //$amountPerRoom = ($durOfStayPerRoom * $roomInfo->room_price);
                      $priceInfo = getDateWisePriceList($roomInfo->date_wise_price);
                      $amountPerRoom = $priceInfo[1];
                    @endphp
                    <tr class="per_room_tr">
                      <td class="text-center">{{$key+1}}</td>
                      <td>
                          {{ ($roomInfo->room_type) ? $roomInfo->room_type->title : ""}}<br/>
                          ({{lang_trans('txt_room_num')}} : {{$roomInfo->room->room_no}})
                      </td>
                      <th class="text-center">
                        <span class="duration_of_per_room {{ ($roomInfo->swapped_from_room) ? 'swapped_room' : 'no_swapped_room'}}">{{$durOfStayPerRoom}}</span>
                      </th>
                      <td>
                        <div class="scrolable-elem">
                          <table class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th width="20%" class="text-center">{{lang_trans('txt_date')}}</th>
                                <th width="20%" class="text-center">{{lang_trans('txt_price')}}</th>
                              </tr>
                            </thead>
                            <tbody class="">
                              @forelse($priceInfo[0] as $dt=>$rs)
                                <tr>
                                  <td class="text-center">{{dateConvert($dt)}}</td>
                                  <td class="text-right">{{getCurrencySymbol()}} {{numberFormat($rs['price'])}}</td>
                                </tr>
                              @empty
                              @endforelse
                              <tr>
                                <td></td>
                                <td class="text-right"><b>{{getCurrencySymbol()}} {{($amountPerRoom)}}</b></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
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
