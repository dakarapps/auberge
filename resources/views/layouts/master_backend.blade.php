<!DOCTYPE html>
<html lang="en">
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>{{getSettings('site_page_title')}}</title>
      <link rel="icon" href="{{checkFile(getSettings('site_favicon'),'uploads/favicon/','default_favicon.png')}}" sizes="16x16" type="image/png">

      <link href="{{URL::asset('public/assets/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{URL::asset('public/assets/sweetalert2-7.0.0/sweetalert2.min.css')}}" rel="stylesheet">
      <link href="{{URL::asset('public/assets/select2/dist/css/select2.min.css')}}" rel="stylesheet">
      <link href="{{URL::asset('public/assets/selectize/selectize.css')}}" rel="stylesheet">
      <link href="{{URL::asset('public/assets/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{URL::asset('public/assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
      <link href="{{URL::asset('public/assets/nprogress/nprogress.css')}}" rel="stylesheet">
      <link href="{{URL::asset('public/assets/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
      <link href="{{URL::asset('public/assets/iCheck/skins/flat/green.css')}}" rel="stylesheet">
      <link href="{{URL::asset('public/assets/bootstrap-datetimepicker/css/datetimepicker.css')}}" rel="stylesheet">
      <link href="{{URL::asset('public/assets/bootstrap-datepicker/css/datepicker.css')}}" rel="stylesheet">
      <link href="{{URL::asset('public/assets/summernote-0.8.8/dist/summernote-bs4.css')}}" rel="stylesheet">
      <link href="{{URL::asset('public/assets/custom.min.css')}}" rel="stylesheet">
      <link href="{{URL::asset('public/css/style_backend.css')}}" rel="stylesheet">
        
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
        <script type="text/javascript" src="{{URL::asset('public/assets/moment/min/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('public/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('public/assets/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('public/assets/select2/dist/js/select2.full.min.js')}}"></script>
        <script src="{{URL::asset('public/assets/selectize/selectize.js')}}"></script>

        <link href="{{URL::asset('public/assets/ekko-lightbox/ekko-lightbox.css')}}" rel="stylesheet">
        <script src="{{URL::asset('public/assets/ekko-lightbox/ekko-lightbox.js')}}"></script>

        @livewireStyles

    </head>
    @php
      $notificationsData = getNotifications();
      $activeLang = getSettings('site_language');
    @endphp
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title">
                            <a class="site_title" href="#">
                                <i class="fa fa-paw">
                                </i>
                                <span>
                                    {{getSettings('site_page_title')}}
                                </span>
                            </a>
                        </div>
                        <div class="clearfix">
                        </div>
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <img alt="{{Auth::user()->name}}" class="img-circle profile_img" src="{{url('public/images/user_img.png')}}">
                                </img>
                            </div>
                            <div class="profile_info">
                                <span>
                                    {{lang_trans('txt_welcome')}},
                                </span>
                                <h2>
                                    {{ (Auth::user()) ? Auth::user()->name : '' }}
                                </h2>
                            </div>
                            <div class="clearfix">
                            </div>
                        </div>
                        <br/>
                        @include('layouts.sidebar_backend')
                    </div>
                </div>
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>
                            <div class="nav toggle">
                                <a id="menu_toggle">
                                    <i class="fa fa-bars">
                                    </i>
                                </a>
                            </div>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a aria-expanded="false" class="user-profile dropdown-toggle" data-toggle="dropdown" href="javascript:;">
                                        <img alt="" src="{{url('public/images/user_img.png')}}">
                                          {{ (Auth::user()) ? Auth::user()->name : 'NA' }}
                                          <span class=" fa fa-angle-down"></span>
                                        </img>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li>
                                            <a href="{{route('profile')}}">
                                              {{lang_trans('txt_profile')}}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('logout')}}">
                                              <i class="fa fa-sign-out pull-right"></i>
                                              {{lang_trans('txt_logout')}}
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                {{-- notification list --}}
                                <li role="presentation" class="dropdown">
                                 <a href="javascript:;" class="dropdown-toggle info-number notifi-list" data-userid="{{Auth::user()->id}}" data-toggle="dropdown" aria-expanded="false">
                                  <i class="fa fa-bell-o"></i>
                                  @if($notificationsData['totalUnread'])
                                    <span class="badge bg-red">{{$notificationsData['totalUnread']}}</span>
                                  @endif
                                 </a>
                                 <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                    @if($notificationsData['datalist']->count())
                                      @foreach($notificationsData['datalist'] as $val)
                                        <li>
                                         <a>
                                           <span class="image"><img src="{{url('public/images/user_img.png')}}" alt="Profile Image" /></span>
                                           <span>
                                            <span>{{$val['from_user']['name']}}</span>
                                            <span class="time">{{timeAgo($val['notifi_datetime'])}}</span>
                                           </span>
                                           <span class="message">
                                            {{limit_text($val['notifi_msg'], 100)}}
                                           </span>
                                         </a>
                                        </li>
                                      @endforeach
                                    @else
                                      <li>
                                         <a>
                                           <span class="message text-danger">
                                              {{lang_trans('txt_no_notifi')}}
                                           </span>
                                         </a>
                                        </li>
                                    @endif
                                 </ul>
                              </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="right_col {{ $activeLang == 'ar' ? 'rtl-lang' : 'ltr-lang'}}" role="main">
                    @yield('rightColContent')
                    <div class="clearfix">
                    </div>
                    @include('layouts.flash_msg')          
                    @yield('content')
                </div>
                <footer>
                    <div class="pull-right">
                        <span>
                            © {{date('Y')}}
                            <a>
                                {{getSettings('hotel_name')}}
                            </a>
                            . {{lang_trans('txt_rights_res')}}.
                        </span>
                    </div>
                    <div class="clearfix">
                    </div>
                </footer>
            </div>
        </div>
         <script src="{{URL::asset('public/assets/bootstrap/dist/js/bootstrap.min.js')}}"></script>
          <script src="{{URL::asset('public/assets/fastclick/lib/fastclick.js')}}"></script>
          <script src="{{URL::asset('public/assets/nprogress/nprogress.js')}}"></script>
          <script src="{{URL::asset('public/assets/DateJS/build/date.js')}}"></script>
          <script src="{{URL::asset('public/assets/iCheck/icheck.min.js')}}"></script>

          <script src="{{URL::asset('public/assets/datatables.net/js/jquery.dataTables.min.js')}}"></script>
          <script src="{{URL::asset('public/assets/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
          <script src="{{URL::asset('public/assets/sweetalert2-7.0.0/sweetalert2.all.min.js')}}"></script>
          <script src="{{URL::asset('public/assets/summernote-0.8.8/dist/summernote-bs4.min.js')}}"></script>
          @yield('jquery')

          <script src="{{URL::asset('public/assets/js/custom.min.js')}}"></script>
          <script src="{{URL::asset('public/js/custom.js')}}"></script>
          <script src="{{URL::asset('public/js/ajax_call.js')}}"></script>
          <script src="{{URL::asset('public/vendor/livewire/livewire.js?id=de3fca26689cb5a39af4')}}"></script>

    </body>
</html>
