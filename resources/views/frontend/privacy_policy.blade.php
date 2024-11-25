@extends('layouts.master_frontend')
@section('content')
<div>
    
      <!-- ============================ Hero Banner  Start================================== -->
      @if($room_details->attachments && count($room_details->attachments))
        <div class="featured-slick">
          <div class="featured-slick-slide">
            @foreach($room_details->attachments as $img)
              <div>
                <a href="#" class="mfp-gallery">
                  <img src="{{checkFile($img['file'],'uploads/room_images/','blank_id.jpg')}}" class="img-fluid mx-auto" alt="" />
                </a>
              </div>
            @endforeach
          </div>
        </div>
      @endif
      
      <section class="spd-wrap">
        <div class="container">
          <div class="row">
            
            <div class="col-lg-12 col-md-12">
            
              <div class="slide-property-detail">
                
                <div class="slide-property-first">
                  <div class="row">
                    <div class="col-lg-8 col-md-8">
                      <div class="row">
                      
                        <!-- Single Items -->
                        <div class="col-xs-6 col-lg-3 col-md-6">
                          <div class="singles_item">
                            <div class="icon">
                              <i class="icofont-stopwatch"></i>
                            </div>
                            <div class="info">
                              <h4 class="name">Duration</h4>
                              <p class="value">7 days</p>
                            </div>
                          </div>
                        </div>
                        
                        <!-- Single Items -->
                        <div class="col-xs-6 col-lg-3 col-md-6">
                          <div class="singles_item">
                            <div class="icon">
                              <i class="icofont-beach"></i>
                            </div>
                            <div class="info">
                              <h4 class="name">Tour Type</h4>
                              <p class="value">Ligula</p>
                            </div>
                          </div>
                        </div>
                        
                        <!-- Single Items -->
                        <div class="col-xs-6 col-lg-3 col-md-6">
                          <div class="singles_item">
                            <div class="icon">
                              <i class="icofont-travelling"></i>
                            </div>
                            <div class="info">
                              <h4 class="name">Members</h4>
                              <p class="value">3-4 Members</p>
                            </div>
                          </div>
                        </div>
                        
                        <!-- Single Items -->
                        <div class="col-xs-6 col-lg-3 col-md-6">
                          <div class="singles_item">
                            <div class="icon">
                              <i class="icofont-island"></i>
                            </div>
                            <div class="info">
                              <h4 class="name">Location</h4>
                              <p class="value">New York, USA</p>
                            </div>
                          </div>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
              
            </div>
          </div>
        </div>
      </section>
      <!-- ============================ Hero Banner End ================================== -->
      
      <!-- ============================ Property Detail Start ================================== -->
      <section class="gray pt-0">
        <div class="container">
          <div class="row">
            
            <!-- property main detail -->
            <div class="col-lg-8 col-md-12 col-sm-12 order-lg-1 order-md-2 order-2">
              
              <!-- Single Block Wrap -->
              <div class="block-wrap mt-4">
                
                <div class="block-header">
                  <h4 class="block-title">Description</h4>
                </div>
                
                <div class="block-body">
                  <p>{!!$room_details->description!!}</p>
                </div>
                
              </div>
              
              <!-- Single Block Wrap -->
              @if($room_details->room_type && $room_details->room_type->amenities)
                @php
                    $amenities = explode(',', $room_details->room_type->amenities);
                @endphp
                <div class="block-wrap">                  
                  <div class="block-header">
                    <h4 class="block-title">Ameneties</h4>
                  </div>
                  
                  <div class="block-body">
                    <ul class="avl-features third">
                      @foreach($amenities as $val)
                        @php
                          $amenitiesInfo = getAmenitiesById($val);
                        @endphp
                        <li>{{$amenitiesInfo->name}}</li>
                      @endforeach
                    </ul>
                  </div>
                  
                </div>
              @endif
             
             
              
            </div>
            
            <!-- property Sidebar -->
            <div class="col-lg-4 col-md-12 col-sm-12 order-lg-2 order-md-1 order-1">
              
              <div class="side-booking-wrap over-top radius-0">
                <div class="side-booking-header">
                  <span>Price</span>
                  <h3 class="price">{{$settings['currency_symbol']}} {{numberFormat($room_details->room_type->base_price)}} <sub>night</sub></h3>
                </div>
                <div class="side-booking-body">
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class="form-group">
                        <label>Check In</label>
                        <div class="cld-box">
                          <i class="ti-calendar"></i>
                          <input type="text" name="checkin" class="form-control" value="10/24/2020" />
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class="form-group">
                        <label>Check Out</label>
                        <div class="cld-box">
                          <i class="ti-calendar"></i>
                          <input type="text" name="checkout" class="form-control" value="10/24/2020" />
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <div class="form-group">
                        <div class="guests">
                          <label for="guests">Adults</label>
                          <div class="guests-box">
                            <button class="counter-btn" type="button" id="cnt-down"><i class="ti-minus"></i></button>
                            <input type="text" id="guestNo" name="guests" value="2"/>
                            <button class="counter-btn" type="button" id="cnt-up"><i class="ti-plus"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <div class="form-group">
                        <div class="guests">
                          <label for="guests">Kids</label>
                          <div class="guests-box">
                            <button class="counter-btn" type="button" id="kcnt-down"><i class="ti-minus"></i></button>
                            <input type="text" id="kidsNo" name="kids" value="0"/>
                            <button class="counter-btn" type="button" id="kcnt-up"><i class="ti-plus"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="stbooking-footer mt-2">
                        <div class="form-group mb-0 pb-0">
                          <a href="#" class="btn full-width btn-theme">Request TO Book</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="page-sidebar">
                            
              
              </div>
            </div>
            
          </div>
        </div>
      </section>
      <!-- ============================ Property Detail End ================================== -->
      
    </div>
@endsection