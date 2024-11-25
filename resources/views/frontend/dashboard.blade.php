@extends('layouts.master_frontend')
@section('content')
@php 
    $i = $j = 0; 
    $totalAmount = 0;
@endphp
<div>
   <!-- ============================ Page Title Start================================== -->
            <div class="image-cover page-title" style="background:url({{checkFile(null,'uploads/banners/','dashboard_banner.jpg')}}) no-repeat;" data-overlay="6">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            
                            <h2 class="ipt-title">Hello, {{Auth::user()->name}}</h2>
                            <span class="ipn-subtitle text-light">Edit & View Your Profile</span>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================ Page Title End ================================== -->
            
            <!-- ============================ Dashboard Start ================================== -->
            <section class="gray">
                <div class="container-fluid">
                    <div class="row">
                        @include('frontend.includes.sidebar_menu')
                        <div class="col-lg-9 col-md-8 col-sm-12">
                            <div class="dashboard-wrapers">
                            
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="dashboard-stat widget-4">
                                            <div class="dashboard-stat-content"><h4>{{$totals['today_bookings']}}</h4> <span class="mt-3">Today Bookings</span></div>
                                            <div class="dashboard-stat-icon"><i class="ti-bookmark"></i></div>
                                        </div>  
                                    </div>
                                    
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="dashboard-stat widget-1">
                                            <div class="dashboard-stat-content"><h4>{{$totals['bookings']}}</h4> <span class="mt-3">Total Booking</span></div>
                                            <div class="dashboard-stat-icon"><i class="ti-location-pin"></i></div>
                                        </div>  
                                    </div>
                                    
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="dashboard-stat widget-2">
                                            <div class="dashboard-stat-content"><h4>{{$totals['upcoming_bookings']}}</h4> <span class="mt-3">Upcoming Booking</span></div>
                                            <div class="dashboard-stat-icon"><i class="ti-pie-chart"></i></div>
                                        </div>  
                                    </div>
                                </div>
                                
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="dashboard-gravity-list card-elem">
                                            <h4>Bookings</h4>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Rooms</th>
                                                        <th>Booking Date</th>
                                                        <th>Booking Details</th>
                                                        <th>Price</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                     @foreach($datalist as $k=>$val)
                                                        @php 
                                                            $dateDiff = dateDiff($val->check_in, date('Y-m-d'), 'daysWIthSymbol');
                                                            $calc = calcFinalAmount($val);
                                                            $totalAmount = $totalAmount+$calc['finalRoomAmount']+$calc['finalOrderAmount']+$calc['additionalAmount'];
                                                            $i++; 
                                                            $statusArr = getBookingStatus($val);
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                {{count($val->booked_rooms)}} Rooms / 
                                                                <a class="text-info" data-toggle="modal" data-target="#booked_room_{{$val->id}}"><b>{{lang_trans('btn_view')}}</b></a>
                                                                @include('backend/model/booked_rooms_modal',['val'=>$val])
                                                              </td>
                                                            <td>{{dateConvert($val->check_in,'d-m-Y H:i')}} - {{dateConvert($val->check_out,'d-m-Y H:i')}}</td>
                                                            <td>{{$val->adult}} Adults, {{$val->kids}} Kids</td>
                                                            <td>{{getCurrencySymbol()}} {{numberFormat($calc['finalRoomAmount']+$calc['finalOrderAmount']+$calc['additionalAmount'])}}</td>
                                                            <td><span class="text-{{$statusArr['statusClass']}}">{{$statusArr['status']}}</span></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="">
                                                {{ $datalist->links() }}
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>
            <!-- ============================ Dashboard End ================================== -->
</div>
@endsection
