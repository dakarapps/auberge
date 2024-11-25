@extends('layouts.master_frontend')
@section('content')
  @php
      $countTestimonials = count($testimonials_rows);

      $countCounter = ($data_row->counter_section_json!=null) ? 1 : 0;
      $counterDecodeJson = json_decode($data_row->counter_section_json);

      $countFeatures = ($data_row->intro_section_features!=null) ? 1 : 0;
      $featuresDecodeJson = json_decode($data_row->intro_section_features); 

      $banners = ['banner.jpg','banner_1.jpg','banner_2.jpg','pgk1.jpg','pgk2.jpg','pgk3.jpg'];
      if($data_row->banners){
        $banners = [];
        foreach ($data_row->banners as $key => $value) {
          $banners[] = $value->file;
        }
      }
      $startDate = dateConvert(null, 'Y/m/d');
      $endDate = dateConvert(getNextPrevDate('next', 1), 'Y/m/d');
    @endphp
<!-- ======================= Start Banner ===================== -->
      <div class="main-banner home-banner" data-overlay="5">
        <div class="container">
          <div class="col-md-12 col-sm-12">
          
            <div class="caption text-center cl-white">
              <h2>{{$data_row->banner_section_heading}}</h2>
              <p>{{$data_row->banner_section_tagline}}</p>
            </div>
            
            {{ Form::open(array('url'=>route('search-rooms'), 'method'=>'GET', 'id'=>"room-search-form", 'class'=>"st-search-form-tour icon-frm withlbl")) }}
              <input type="hidden" id="startTimestamp" class="date-picker" value="{{$startDate}}">
              <input type="hidden" id="endTimestamp" class="date-picker" value="{{$endDate}}">
              <div class="g-field-search">
                <div class="row">
                  <div class="col-lg-4 col-md-4 border-right mxnbr">
                    <div class="form-group">
                      <i class="ti-location-pin field-icon"></i>
                      <label>Location</label>
                      <input name="location" type="text" class="form-control" placeholder="Where are you going?" value="{{'Port moresby, '.getSettings('default_country')}}">
                    </div>
                  </div>
                  
                  <div class="col-lg-3 col-md-4 border-right mxnbr">
                    <div class="form-group">
                      <i class="ti-calendar field-icon"></i>
                      <label>From - To</label>
                      <input type="text" class="form-control check-in-out" name="dates" value="{{$startDate. ' - '. $endDate}}" />
                    </div>
                  </div>
                  
                  <div class="col-lg-3 col-md-4 border-right dropdown form-select-guests mnbr">
                    <div class="form-group">
                      <i class="ti-user field-icon"></i>
                      <div class="form-content dropdown-toggle" data-toggle="dropdown">
                        <div class="wrapper-more">
                          <label>Guests</label>
                          <div class="render">
                            <span class="adults"><span class="one ">1 Adult</span> <span class=" d-none  multi" data-html=":count Adults">1 Adults</span></span>-
                            <span class="children">
                              <span class="one " data-html=":count Child">0 Child</span>
                              <span class="multi  d-none" data-html=":count Children">0 Children</span>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-menu select-guests-dropdown">
                        <input type="hidden" name="adults" value="1" min="1" max="20">
                        <input type="hidden" name="children" value="0" min="0" max="20">
                        <div class="dropdown-item-row">
                          <div class="label">Adults</div>
                          <div class="val">
                            <span class="btn-minus" data-input="adults"><i class="ti-minus"></i></span>
                            <span class="count-display">1</span>
                            <span class="btn-add" data-input="adults"><i class="ti-plus"></i></span>
                          </div>
                        </div>
                        <div class="dropdown-item-row">
                          <div class="label">Children</div>
                          <div class="val">
                            <span class="btn-minus" data-input="children"><i class="ti-minus"></i></span>
                            <span class="count-display">0</span>
                            <span class="btn-add" data-input="children"><i class="ti-plus"></i></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                
                  <div class="col-lg-2 p-0 mp-15">
                    <div class="form-group  search">
                      <button class="btn btn-theme btn-search" type="submit" name="booknow" value="1">Book Now</button>
                    </div>
                  </div>
                </div>
              </div>
            {{ Form::close() }}
            
          </div>
        </div>
      </div>
      <!-- ======================= End Banner ===================== -->
      
      <!-- ================= fetures start ========================= -->
        @if($data_row->intro_section_publish)
          <section class="facts">
            <div class="container">
              <div class="row">
                @if($countFeatures)
                  @foreach($featuresDecodeJson as $k=>$val)
                    <div class="col-lg-4 col-md-4">
                      <div class="facts-wrap">
                        <div class="facts-icon">
                          <i class="theme-cl {{getIcon($val->icon)}}"></i>
                        </div>
                        <div class="facts-detail">
                          <h4>{{limit_text($val->title, 35)}}</h4>
                          <p>{{limit_text($val->short_desc,35)}}</p>
                        </div>
                      </div>
                    </div>
                  @endforeach
                @endif            
              </div>
            </div>
          </section>
        @endif
      <!-- ================= End fetures ========================= -->
      
      
      <!-- ================= Room start ========================= -->
        @if($data_row->room_section_publish)
          <section>
              <div class="container">                
                  <div class="row">
                      <div class="col-lg-12 col-md-12">
                          <div class="sec-heading center">
                              <h2>{{$data_row->room_section_heading}}</h2>
                              <p>{{$data_row->room_section_tagline}}</p>
                          </div>
                      </div>
                  </div>
                  
                  <div class="row">
                      @php
                        $populatedTypesArr = [];
                      @endphp
                      @if(count($room_list))
                        @foreach($room_list as $k=>$room)
                          @php
                            if (in_array($room->room_type_id, $populatedTypesArr)) {
                              continue;
                            }
                            $populatedTypesArr[] = $room->room_type_id;
                            $roomImg = ($room->attachments && count($room->attachments)) ? $room->attachments[0]['file'] : null;
                            $totaAmenities = [];
                            if($room->room_type && $room->room_type->amenities){
                              $totaAmenities = explode(',', $room->room_type->amenities);
                            } 
                          @endphp
                          <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="tour-simple-wrap">
                                <div class="tour-simple-thumb">
                                    <a href="{{route('room-details', ['id'=>$room->id])}}"><img src="{{checkFile($roomImg,'uploads/room_images/','blank_id.jpg')}}" class="img-fluid img-responsive" alt="" /></a>
                                </div>
                                <div class="tour-simple-caption">
                                    <div class="ts-caption-left">
                                        <h4 class="ts-title"><a href="{{route('room-details', ['id'=>$room->id])}}">{{$room->room_name}}</a></h4>
                                        <span>{{count($totaAmenities)}} Amenities</span>
                                    </div>
                                    <div class="ts-caption-right">
                                        <h5 class="ts-price">{{$settings['currency_symbol']}} {{numberFormat($room->room_type->base_price)}}</h5>
                                    </div>
                                </div>
                            </div>
                          </div>

                        @endforeach
                      @endif
                      
                  </div>
              
              </div>
          </section>
        @endif
      <!-- ========================= End room Section ============================ -->

      <!-- ================= room categories start ========================= -->
        @if($data_row->room_category_section_publish)
          <section class="gray">
            <div class="container">
              
              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <div class="sec-heading center">
                    <h2>{{$data_row->room_category_section_heading}}</h2>
                    <p>{{$data_row->room_category_section_tagline}}</p>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <div class="owl-carousel owl-theme" id="lists-slide">
                    
                    @if(count($roomtypes_list))
                      @foreach($roomtypes_list as $k=>$rt)
                        @php
                          $categoryImg = ($rt->attachments && count($rt->attachments)) ? $rt->attachments[0]['file'] : null;
                        @endphp
                        <div class="single-item">
                          <div class="single-room-item">
                            {{-- <span class="theme-bg discount-off">Discount 40%</span> --}}
                            <figure class="single-roomimg-wrap">
                              <a class="single-roomlink">
                                <img class="cover" src="{{checkFile($categoryImg,'uploads/room_type_images/','blank_id.jpg')}}" alt="room">
                              </a>
                            </figure>
                            <div class="single-roomdetails">
                              <h4 class="title">{{$rt->title}}</h4>
                              <div class="single-roomprice">{{$settings['currency_symbol']}} {{numberFormat($rt->base_price)}}<span> Night</span></div>
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
        @endif
      <!-- ========================= End room categories Section ============================ -->
      
      
      <!-- ================= counter start ========================= -->
        @if($data_row->counter_section_publish)
          <section class="theme-bg counter-section">
            <div class="container">
              <div class="row">
                @if($countCounter)
                  @foreach($counterDecodeJson as $k=>$val)
                    <div class="col-lg-3 col-md-3 col-sm-6">
                      <div class="facts-wrap light">
                        <div class="facts-icon">
                          <i class="{{getIcon(null)}}"></i>
                        </div>
                        <div class="facts-detail">
                          <h2>{{$val->number}}{{$val->prefix}}</h2>
                          <p>{{limit_text($val->title, 20)}}</p>
                        </div>
                      </div>
                    </div>
                  @endforeach
                @endif    
                
              </div>
            </div>
          </section>
        @endif
      <!-- ================= End counter section ========================= -->
      
      <!-- ================= testimonial start ========================= -->
        @if($data_row->testimonial_section_publish)
          <section class="min">
            <div class="container">

              <div class="row">
                <div class="col-lg-12 col-md-12">
                  <div class="sec-heading center">
                    <h2>{{$data_row->testimonial_section_heading}}</h2>
                    <p>{{$data_row->testimonial_section_tagline}}</p>
                  </div>
                </div>
              </div>
              
              <div class="row">
                 @if($countTestimonials>0)
                    @foreach($testimonials_rows as $testimonial)
                      <div class="col-lg-4 col-md-4">
                        <div class="testimonial-wrap">
                          <div class="testimonial-icon">
                            <img src="{{checkFile($testimonial->client_image,'uploads/client_images/','no-img.png')}}" class="img-fluid" alt="" />
                            <h5>{{$testimonial->client_name}}</h5>
                            <div class="testi-rate">{{$testimonial->client_position}}</div>
                          </div>
                          <div class="facts-detail">
                            <p>{{limit_text($testimonial->client_comment, 135)}}</p>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  @endif
                
              </div>
            </div>
          </section>
        @endif
      <!-- ================= End testimonial ========================= -->
{{-- require set var in js var --}}
<script>
  globalVar.page = 'front_home';
  globalVar.banners = {!!json_encode($banners)!!};
</script> 
@endsection