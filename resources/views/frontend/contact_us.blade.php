@extends('layouts.master_frontend')
@section('content')
  @php
    $facebookLink = $data_row->facebook_link;
    $twitterLink = $data_row->twitter_link;
    $linkedinLink = $data_row->linkedin_link;
    $instagramLink = $data_row->instagram_link;
  @endphp

  <div>
    <!-- ============================ Page Title Start================================== -->
      <div class="image-cover page-title" style="background:url({{checkFile($data_row->banner_image,'uploads/banners/','no-img.png')}}) no-repeat;" data-overlay="6">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <h2 class="ipt-title">{{$data_row->tagline}}</h2>
              <span class="ipn-subtitle text-light">{{$data_row->heading}}</span>
            </div>
          </div>
        </div>
      </div>
      <!-- ============================ Page Title End ================================== -->
      
      <!-- ============================ Who We Are Start ================================== -->
      <section>
        <div class="container">
        
          <div class="row mb-4">
            
            <div class="col-lg-4 col-md-4">
              <div class="contact-box">
                <i class="ti-map-alt theme-cl"></i>
                <h4>Address</h4>
                {{$settings['hotel_address']}}
              </div>
            </div>
            
            <div class="col-lg-4 col-md-4">
              <div class="contact-box">
                <i class="ti-email theme-cl"></i>
                <h4>Mail Us</h4>
                {{$settings['hotel_email']}}
              </div>
            </div>
            
            <div class="col-lg-4 col-md-4">
              <div class="contact-box">
                <i class="ti-headphone theme-cl"></i>
                <h4>Call Us</h4>
                {{$settings['hotel_mobile']}}
              </div>
            </div>
            
          </div>
          
          <div class="row mt-5 row">
            
            <div class="col-lg-5 col-md-5">
              <img src="{{checkFile($data_row->banner_image,'uploads/banners/','contact_us.jpg')}}" class="img-fluid" alt="" />
              @if($facebookLink || $twitterLink || $instagramLink || $linkedinLink)
                <div class="col-lg-12 col-md-12 mt-3">
                  <div class="contact-box row">
                    @if($facebookLink) <div class="col-sm-3"><a class="contact-social-icons" target="_blank" href="{{$facebookLink}}"><i class="ti-facebook"></i></a></div> @endif
                    @if($instagramLink) <div class="col-sm-3"><a class="contact-social-icons" target="_blank" href="{{$instagramLink}}"><i class="ti-instagram"></i></a></div> @endif
                    @if($linkedinLink) <div class="col-sm-3"><a class="contact-social-icons" target="_blank" href="{{$linkedinLink}}"><i class="ti-linkedin"></i></a></div> @endif
                    @if($twitterLink) <div class="col-sm-3"><a class="contact-social-icons" target="_blank" href="{{$twitterLink}}"><i class="ti-twitter"></i></a></div> @endif
                  </div>
                </div>
              @endif
            </div>
            <div class="col-lg-7 col-md-7 contact-box">
              <div class="contact-form text-left">
                {{ Form::open(array('url'=>route('save-contact-message'),'id'=>"contact-form", 'class'=>"")) }}
                  <div class="row">
                    <div class="col-lg-6 col-md-6">
                      <div class="form-group">
                        <label>Name</label>
                        {{ Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Enter Name', 'required'=>true]) }}
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                      <div class="form-group">
                        <label>Email</label>
                        {{ Form::email('email',null,['class'=>'form-control', 'placeholder'=>'Enter Email Address', 'required'=>true]) }}
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-lg-12 col-md-12">
                      <div class="form-group">
                        <label>Subject</label>
                        {{ Form::text('subject',null,['class'=>'form-control', 'placeholder'=>'Enter Subject', 'required'=>true]) }}
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-lg-12 col-md-12">
                      <div class="form-group">
                        <label>Message</label>
                        <textarea name="message" class="form-control" placeholder="Type Here..." required></textarea>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-lg-12 col-md-12">
                      <button type="submit" class="btn btn-primary">Send Request</button>
                    </div>
                  </div>
                {{ Form::close() }}
              </div>
            </div>
            
          </div>
          
        </div>
      </section>
      <div class="clearfix"></div>
      <!-- ============================ Who We Are End ================================== -->
  </div>
@endsection