<!DOCTYPE html>
<html lang="en">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <title>{{getSettings('site_page_title')}}</title>
      <link rel="icon" href="{{checkFile(getSettings('site_favicon'),'uploads/favicon/','default_favicon.png')}}" sizes="16x16" type="image/png">
      
      <link rel="stylesheet" href="{{URL::asset('public/assets_front/css/plugins.css')}}">
      <link rel="stylesheet" href="{{URL::asset('public/assets_front/css/styles.css')}}">
      <link rel="stylesheet" href="{{URL::asset('public/assets_front/css/colors.css')}}">
      <link rel="stylesheet" href="{{URL::asset('public/assets_front/snackbar/snackbar.css')}}">
      <link rel="stylesheet" href="{{URL::asset('public/css/style_front.css')}}">
        
        {{-- this inline script is required: set global access var --}}
        <script>
          var base_url="{{url('/').'/'}}";
          var csrf_token="{{ csrf_token() }}";
          var currency_symbol="{{getCurrencySymbol()}}";
          var current_segment = "";
        </script>

        <script type="text/javascript" src="{{URL::asset('public/js/init.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('public/assets/jquery/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('public/js/jquery.validate.min.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('public/assets/jqueryvalidation/jqueryvalidation.js')}}"></script>
        <script src="{{URL::asset('public/assets_front/snackbar/snackbar.js')}}"></script>

    </head>
    <body class="orange-skin">
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div id="preloader"><div class="preloader"><span></span><span></span></div></div>
         
        <div id="main-wrapper">
    
            <!-- ============================================================== -->
            <!-- Top header  -->
            <!-- ============================================================== -->
            @php
              $currentRoute = Request::route()->getName();
              $authData = Auth::user();
            @endphp
              <!-- Start Navigation -->
                <div class="header header-light">
                  <div class="container">
                    <nav id="navigation" class="navigation navigation-landscape">
                      <div class="nav-header">
                        <a class="nav-brand" href="#">
                          <img src="{{checkFile(getSettings('site_logo'),'uploads/logo/','logo.jpg')}}" class="logo" alt="" />
                        </a>
                        <div class="nav-toggle"></div>
                      </div>
                      <div class="nav-menus-wrapper">
                        <ul class="nav-menu">
                          <li class="{{($currentRoute == 'home') ? 'active' : ''}}">
                            <a href="{{route('home')}}">Home</a>                                 
                          </li>
                          <li class="{{($currentRoute == 'about-us') ? 'active' : ''}}">
                            <a href="{{route('about-us')}}">About</a>                                 
                          </li>
                          <li class="{{($currentRoute == 'contact-us') ? 'active' : ''}}">
                            <a href="{{route('contact-us')}}">Contact</a>                                 
                          </li>                          
                        </ul>
                        
                        <ul class="nav-menu nav-menu-social align-to-right">
                          @if($authData)
                            <li class="login-attri">
                              <div class="btn-group account-drop">
                                <button type="button" class="btn btn-order-by-filt theme-cl" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="fas fa-user-circle text-info mr-1"></i>{{$authData->name}}
                                </button>
                                <div class="dropdown-menu pull-right animated flipInX">
                                  <a href="{{route('user-dashboard')}}"><i class="ti-dashboard"></i>Dashboard</a>
                                  <a href="{{route('user-profile')}}"><i class="ti-user"></i>My Profile</a>                                                   
                                  <a href="{{route('user-logout')}}"><i class="ti-power-off"></i>Logout</a>
                                </div>
                              </div>
                            </li>
                
                          @else
                            <li><a href="{{route('sign-in')}}"><i class="fas fa-user-circle text-info mr-1"></i>Log In</a></li>
                            <li><a href="{{route('sign-up')}}"><i class="fas fa-arrow-alt-circle-right text-warning mr-1"></i>Sign Up</a></li>
                          @endif
                        </ul>
                      </div>
                    </nav>
                  </div>
                </div>
              <!-- End Navigation -->
              <div class="clearfix"></div>
            <!-- ============================================================== -->
            <!-- Top header  -->
            <!-- ============================================================== -->
          
              @include('layouts.flash_msg_frontend')          
              @yield('content')
        
            <!-- ============================ Newsletter Start ================================== -->
            <section class="alert-wrap pt-5 pb-5 subscribe-section">
              <div class="container">
                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <div class="jobalert-sec">
                      <h3 class="mb-1 text-light">Get New Notification!</h3>
                      <p class="text-light">Subscribe & get all related notification.</p>
                    </div>
                  </div>
                  
                  <div class="col-lg-6 col-md-6">
                    {{ Form::open(array('url'=>route('subscribe-notifivations'),'id'=>"subs-form", 'class'=>"")) }}
                    <div class="input-group">
                      <input name="email" type="email" class="form-control" placeholder="Enter Your Email" required> 
                      <div class="input-group-append">
                      <button type="submit" class="btn btn-black black">Subscribe</button>
                      </div>
                    </div>
                    {{ Form::close() }}
                  </div>
                </div>
              </div>
            </section>
            <!-- ============================ Newsletter Start ================================== -->   
            <!-- ============================ Footer Start ================================== -->
            <footer class="dark-footer skin-dark-footer">
              
              <div class="footer-bottom">
                <div class="container">
                  <div class="row align-items-center">
                    
                    <div class="col-lg-6 col-md-6">
                      <p class="mb-0">© {{lang_trans('txt_develop_by')}}</p>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 text-right">
                      <img src="assets/img/payment.svg" class="img-fluid" alt="" />
                    </div>
                    
                  </div>
                </div>
              </div>
            </footer>
            <!-- ============================ Footer End ================================== -->
      
            <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>
        </div>
       
          <script src="{{URL::asset('public/assets_front/js/circleMagic.min.js')}}"></script>
          <script src="{{URL::asset('public/assets_front/js/popper.min.js')}}"></script>
          <script src="{{URL::asset('public/assets_front/js/bootstrap.min.js')}}"></script>
          <script src="{{URL::asset('public/assets_front/js/rangeslider.js')}}"></script>
          <script src="{{URL::asset('public/assets_front/js/select2.min.js')}}"></script>
          <script src="{{URL::asset('public/assets_front/js/aos.js')}}"></script>
          <script src="{{URL::asset('public/assets_front/js/owl.carousel.min.js')}}"></script>
          <script src="{{URL::asset('public/assets_front/js/jquery.magnific-popup.min.js')}}"></script>
          <script src="{{URL::asset('public/assets_front/js/slick.js')}}"></script>
          <script src="{{URL::asset('public/assets_front/js/slider-bg.js')}}"></script>
          <script src="{{URL::asset('public/assets_front/js/lightbox.js')}}"></script> 
          <script src="{{URL::asset('public/assets_front/js/imagesloaded.js')}}"></script>
          <script src="{{URL::asset('public/assets_front/js/isotope.min.js')}}"></script>
          
          <script src="{{URL::asset('public/assets_front/js/custom.js')}}"></script>
         
          <script src="{{URL::asset('public/assets_front/js/moment.min.js')}}"></script>
          <script src="{{URL::asset('public/assets_front/js/daterangepicker.js')}}"></script>

          <script src="{{URL::asset('public/assets/datatables.net/js/jquery.dataTables.min.js')}}"></script>
          <script src="{{URL::asset('public/assets/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
          <script src="{{URL::asset('public/assets/sweetalert2-7.0.0/sweetalert2.all.min.js')}}"></script>

          <script src="{{URL::asset('public/js/custom.js')}}"></script>
          <script src="{{URL::asset('public/js/ajax_call.js')}}"></script>

          @livewireScripts
    </body>
</html>
