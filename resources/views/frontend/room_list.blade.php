@extends('layouts.master_frontend')
@section('content')
  @php
    $selectedRoomNumbers = [];
    if($cart_list){
      foreach ($cart_list as $key => $val) {
        $selectedRoomNumbers[] = $val->room_id;
      }
    }
  @endphp
  <div>
    <!-- ============================ Page Title Start================================== -->
      <div class="image-cover page-title" style="background:url({{checkFile('banner_1.jpg','images/','no-img.png')}}) no-repeat;" data-overlay="6">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <h2 class="ipt-title">Searched Rooms</h2>
            </div>
          </div>
        </div>
      </div>
      <!-- ============================ Page Title End ================================== -->

      <!-- =================== Sidebar Search ==================== -->
      <section class="gray">
        <div class="container">
          <div class="row">
              
            <div class="order-1 content-area col-lg-12 col-md-12 order-md-1 order-lg-2">
              <div class="row">
              
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="shorting-wrap">
                    <h5 class="shorting-title">{{count($room_list)}} Results</h5>
                    <div class="shorting-right">
                      <button class="btn btn-primary book-now {{ count($selectedRoomNumbers) ? '' : 'hide-elem'}}" data-toggle="modal" data-target="#cart_preview">Book Selected Rooms</button>
                       {{-- <a href="{{route('book-rooms')}}" class="btn btn-primary book-now {{ count($selectedRoomNumbers) ? '' : 'hide-elem'}}">Book Selected Rooms</a> --}}
                    </div>
                  </div>
                </div>
                
              </div>
              
              <div class="row m-0">
                
                @if(count($room_list))
                  @foreach($room_list as $k=>$room)
                    @php
                      $roomImg = ($room->attachments && count($room->attachments)) ? $room->attachments[0]['file'] : null;
                      $inCart = in_array($room->id, $selectedRoomNumbers) ? true : false;
                      $isBooked = in_array($room->id, $booked_rooms) ? true : false;
                      $totaAmenities = [];
                      $roomWithPriceInfo = $room_with_price[$room->room_type->id];
                      if($room->room_type && $room->room_type->amenities){
                        $totaAmenities = explode(',', $room->room_type->amenities);
                      } 
                    @endphp
                    <!-- Single List -->
                    <div class="book_list_box rental_item">
                      <div class="row no-gutters">                    
                        <div class="col-lg-4 col-md-5">
                          <figure>
                            <a href="{{route('room-details', ['id'=>$room->id])}}"><img src="{{checkFile($roomImg,'uploads/room_images/','blank_id.jpg')}}" class="img-responsive" alt="" /></a>
                          </figure>
                        </div>
                        
                        <div class="col-lg-8 pl-5 col-md-7">
                          <div class="book_list_full">
                          
                            <div class="book_list_header">
                              <div class="book_list_header_left">
                                <h4 class="book_list_title"><a href="{{route('room-details', ['id'=>$room->id])}}">{{$room->room_name}}</a>
                                </h4>
                                <span class="location"><i class="ti-location-pin"></i>{{($room->room_type) ? $room->room_type->title : ''}}</span>
                              </div>
                              <div class="book_list_header_right">
                                <h4 class="book_list_price">
                                  <sup>{{getCurrencySymbol()}}</sup>
                                  {{$roomWithPriceInfo['total_price']}}
                                  <span class="text-danger booking-time">
                                    <span class="text-per-room">/ {{lang_trans('txt_per_room')}}</span>
                                    <sup><a class="a-text-primary cursor-pointer" data-toggle="modal" data-target="#room_price_model_{{$k}}">{{lang_trans('btn_price_break')}}</a></sup>
                                  </span>
                                </h4>

                                @include('backend/model/room_price_info_model',['list'=>$roomWithPriceInfo['dates_with_price'], 'total'=>$roomWithPriceInfo['total_price'], 'key'=>$k])
                              </div>
                            </div>
                            <div class="book_list_offers">
                              @if($room->room_type && $room->room_type->amenities)
                                @php
                                    $amenities = explode(',', $room->room_type->amenities);
                                @endphp
                                <ul>
                                  @foreach($amenities as $val)
                                    @php
                                      $amenitiesInfo = getAmenitiesById($val);
                                    @endphp
                                    <li><i class="ti-angle-double-right theme-cl"></i>{{$amenitiesInfo->name}}</li>
                                  @endforeach
                                </ul>
                              @endif
                            </div>
                            <div class="book_list_rate text-right">
                              <h5 class="over_all_rate high"></h5>
                              @if($isBooked)
                                <button type="button" class="btn btn-default color-c1 booked-room">Booked</button>
                              @elseif(!Auth::User())
                                <a href="{{route('sign-in')}}" class="btn btn-primary select-room">Select</a>
                              @else
                                <button class="btn {{$inCart ? 'btn-success' : 'btn-primary'}} select-room" type="button" data-roomid="{{$room->id}}" data-userid="{{Auth::User()->id}}">
                                  {{ $inCart ? 'Selected' : 'Select' }}
                                </button>
                              @endif                              
                            </div>
                            
                          </div>  
                        </div>
                        
                      </div>
                    
                    </div>
                  @endforeach
                @endif

                
              </div>
              
            </div>
          </div>
        </div>
      </section>
      <!-- =================== Sidebar Search ==================== -->

      <!-- Model -->
      <div id="cart_preview" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Confirm Information</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
        <div class="modal-body">
            <table class="table table-bordered">
              <tr>
                <td class="text-center color-black" colspan="3">Booking Date</td>
                <td class="text-center color-black">Adults</td>
                <td class="text-center color-black">Kids</td>
              </tr>
              <tr>
                <td class="text-center" id="booking_dates" colspan="3"></td>
                <td class="text-center" id="booking_adults"></td>
                <td class="text-center" id="booking_kids"></td>
              </tr>
              <tr>
                <td class="text-center color-black" width="2%">{{lang_trans('txt_sno')}}.</td>
                <td class="text-center color-black" width="15%">{{lang_trans('txt_room')}}</td>
                <td class="text-center color-black" width="10%">{{lang_trans('txt_duration_of_stay')}}</td>
                <td class="text-center color-black" width="10%"></td>
                <td class="text-center color-black" width="10%">{{lang_trans('txt_total_amount')}} ({{getCurrencySymbol()}})</td>
              </tr>
              <tbody id="selected_rooms_list">
                
              </tbody>
            </table>
            <hr/>
            {{ Form::open(array('url'=>route('book-rooms'), 'id'=>"room-book-form", 'class'=>"icon-frm withlbl")) }}
            <div class="row">
              <div class="col-sm-12">
                <label class="control-label"> {{lang_trans('txt_payment_mode')}}</label>
              </div>
              <div class="col-sm-12">
                {{Form::select('payment_mode',getPaymentOptions('front'),null,['class'=>"form-control", "placeholder"=>"--Select", "required"=>true])}}
              </div>
              <div class="col-sm-12 text-right mt-3">
                <button type="submit" class="btn btn-success">Book & Pay</button>
              </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
  </div>
</div>

  </div>
  <script>
    globalVar.roomWithPriceList = {!! json_encode($room_with_price) !!};
    globalVar.cartList = {!! json_encode($cart_list) !!};
    globalVar.gstPercent = {{$settings['gst']}};
    globalVar.cgstPercent = {{$settings['cgst']}};
  </script>
@endsection