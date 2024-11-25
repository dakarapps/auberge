@extends('layouts.master_backend')
@section('content')
  @php
    $countFeatures = ($data_row->about_section_features!=null) ? 1 : 0;
    $featuresDecodeJson = json_decode($data_row->about_section_features);
  @endphp
      <div class="row">
        {{Form::model($data_row,['route'=>'update-about-page','id'=>'home-page-form','files'=>true])}}
        <div class="col-md-6">
          
          <div class="x_panel">
            <div class="x_title">
              <h2>Banner Image</h2>
              <div class="clearfix"></div>
            </div>
              <div class="x_content">
                <div class="form-group">
                  <label>Image</label>
                  <input type="file" name="about_section_banner">
                </div>
                @if($data_row->about_section_banner!='' && $data_row->about_section_banner!=null)
                <img height="150" width="50%" src="{{checkFile($data_row->about_section_banner,'uploads/banners/','no-img.png')}}"/>
                @endif
              </div>
          </div>
          
        </div>
        
        <div class="col-md-6">
           <!-- ==========* Start AboutUs Section *========== -->
          <div class="x_panel">
            <div class="x_title">
              <h2>Introduction</h2>
              <div class="clearfix"></div>
            </div>
              <div class="x_content">
                <div class="form-group">
                  <label>Tagline</label>
                  {{ Form::text('about_section_tagline',null,['class'=>'form-control', 'placeholder'=>'Enter Tagline']) }}
                </div>
                <div class="form-group">
                  <label>Heading</label>
                  {{ Form::text('about_section_heading',null,['class'=>'form-control', 'placeholder'=>'Enter Heading']) }}
                </div>
                 <div class="form-group">
                  <label>Description</label>
                  {{ Form::textarea('about_section_desc',null,['class'=>'form-control', 'placeholder'=>'Enter Description','rows'=>2]) }}
                </div>
                <div class="form-group">
                  <label>Image</label>
                  <input type="file" name="about_section_image">
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <img width="100" src="{{checkFile($data_row->about_section_image,'uploads/about_us/','no-img.png')}}"/>
                  </div>
                </div>
                <div class="form-group">
                  <h4>Features</h4><hr/>
                </div>
                <div class="features-elem">
                  @if($countFeatures==1)
                    @foreach($featuresDecodeJson as $key=>$features_data)
                      <div class="row features-row border-btm pad-top-10">
                         <div class="col-lg-6">
                          <div class="form-group">
                            <label>Title</label>{{ Form::text('about_sect_features[title][]',$features_data->title,['class'=>'form-control', 'placeholder'=>'Enter Title']) }}
                          </div>
                        </div>
                         <div class="col-lg-12">
                          <div class="form-group">
                            <label>Short Description</label>{{ Form::textarea('about_sect_features[short_desc][]',$features_data->short_desc,['class'=>'form-control', 'placeholder'=>'Enter Short Description','rows'=>2]) }}
                          </div>
                        </div>
                        <div class="col-lg-12 text-right">
                          <button type="button" class="btn btn-danger delete-row"><i class="fa fa-minus"></i></button><br/>
                        </div>
                      </div>
                    @endforeach
                  @endif
                </div>
                
                <br/>
                <div class="row">
                  <div class="col-lg-12 text-right">
                    <button type="button" class="btn btn-success add-new-row"><i class="fa fa-plus"></i></button>
                  </div>
               </div>
                <div class="checkbox">
                  <label>
                    {{ Form::checkbox('about_section_publish',null) }} Show this Section
                  </label>
                </div>
              </div>
          </div>
          <!-- ==========* End AboutUs Section *========== -->
        </div>

        <div class="col-md-12 text-right">
          <input type="submit" value="Submit" class="btn btn-primary"/>
        </div>
        {{ Form::close() }}
      </div>

<!-- ==========* Start Clone Elements Section *========== -->
 
  <div class="clone_features_elem hide_elem">
    <div class="row features-row border-btm pad-top-10">
       <div class="col-lg-6">
        <div class="form-group">
          <label>Title</label>
          {{ Form::text('about_sect_features[title][]',null,['class'=>'form-control', 'placeholder'=>'Enter Title']) }}
        </div>
      </div>
       <div class="col-lg-12">
        <div class="form-group">
          <label>Short Description</label>
          {{ Form::textarea('about_sect_features[short_desc][]',null,['class'=>'form-control', 'placeholder'=>'Enter Short Description','rows'=>2]) }}
        </div>
      </div>
      <div class="col-lg-12 text-right">
        <button type="button" class="btn btn-danger delete-row"><i class="fa fa-minus"></i></button><br/>
      </div>
    </div>
  </div>

  <div class="clone_ourteam_elem hide_elem">
    <div class="row testimonial-sect-row border-btm pad-top-10">
      {{ Form::hidden('ourteam_section[ids][]',0) }}
      {{ Form::hidden('ourteam_section[prv_img][]','') }}
      <div class="col-lg-12">
        <div class="form-group row">
          <div class="col-sm-8"><label>Name</label>{{ Form::text('ourteam_section[name][]',null,['class'=>'form-control', 'placeholder'=>'Enter Name']) }}</div>
          <div class="col-sm-4"><label>Position</label>{{ Form::text('ourteam_section[position][]',null,['class'=>'form-control', 'placeholder'=>'Enter Position']) }}</div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group row">
          <div class="col-sm-6"><label>Facebook Link</label>{{ Form::text('ourteam_section[facebook_link][]',null,['class'=>'form-control', 'placeholder'=>'Enter Facebook Link']) }}</div>
          <div class="col-sm-6"><label>Twitter Link</label>{{ Form::text('ourteam_section[twitter_link][]',null,['class'=>'form-control', 'placeholder'=>'Enter Twitter Link']) }}</div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group row">
          <div class="col-sm-6"><label>Instagram Link</label>{{ Form::text('ourteam_section[instagram_link][]',null,['class'=>'form-control', 'placeholder'=>'Enter Instagram Link']) }}</div>
          <div class="col-sm-6"><label>Linkedin Link</label>{{ Form::text('ourteam_section[linkedin_link][]',null,['class'=>'form-control', 'placeholder'=>'Enter Linkedin Link']) }}</div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="form-group">
          <label>Profile Image</label>
          <input type="file" name="ourteam_section[image][]">
        </div>
      </div>
    <div class="col-lg-12 text-right">
      <button type="button" class="btn btn-danger delete-row-ourteam"><i class="fa fa-minus"></i></button><br/>
    </div>
    </div>
  </div>

<!-- ==========* End Clone Elements Section *========== -->
{{-- require set var in js var --}}
  <script>
    globalVar.page = 'website_about_page';
    globalVar.featuresCount = {{$countFeatures}};
  </script> 
  <script type="text/javascript" src="{{URL::asset('public/js/page_js/page.js')}}"></script> 
@endsection