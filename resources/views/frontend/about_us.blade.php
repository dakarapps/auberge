@extends('layouts.master_frontend')
@section('content')
  @php
    $countFeatures = ($data_row->about_section_features!=null) ? 1 : 0;
    $featuresDecodeJson = json_decode($data_row->about_section_features);
  @endphp
<div>
    
     <!-- ============================ Page Title Start================================== -->
      <div class="image-cover page-title" style="background:url({{checkFile($data_row->about_section_banner,'uploads/banners/','no-img.png')}}) no-repeat;" data-overlay="6">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <h2 class="ipt-title">{{$data_row->about_section_heading}}</h2>
              <span class="ipn-subtitle text-light">{{$data_row->about_section_tagline}}</span>
            </div>
          </div>
        </div>
      </div>
      <!-- ============================ Page Title End ================================== -->
      
      <!-- ============================ Our Story Start ================================== -->
      <section>
      
        <div class="container">
        
          <!-- row Start -->
          <div class="row align-items-center">
            <div class="col-lg-8 col-md-8">
              <div class="story-wrap explore-content">
                <p>{!!$data_row->about_section_desc!!}</p>
              </div>
            </div>
            
            <div class="col-lg-4 col-md-4">
              <img src="{{checkFile($data_row->about_section_image,'uploads/about_us/','no-img.png')}}" class="img-fluid" alt="" />
            </div>

          </div>
          <!-- /row --> 
          <hr/>
          <div class="row align-items-center">
            @if($countFeatures)
              @foreach($featuresDecodeJson as $val)
                <div class="col-lg-6 col-md-6">
                  <div class="story-wrap explore-content contact-box">
                    <h2>{{$val->title}}</h2>
                    <p>{!!$val->short_desc!!}</p>
                  </div>
                </div>
              @endforeach
            @endif
          </div>        
          
        </div>
            
      </section>
      <!-- ============================ Our Story End ================================== -->
      
    </div>
@endsection