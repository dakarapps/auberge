@php 
  $userInfo = getAuthUserInfo();
  $img = ($userInfo->additional_info) ? $userInfo->additional_info : null;
@endphp
<div class="col-lg-3 col-md-4 col-sm-12">
    <div class="dashboard-navbar">
        
        <div class="d-user-avater">
            <img src="{{checkFile($img,'uploads/user/','user_img.png')}}" class="img-fluid avater" alt="">
            <h4>{{$userInfo->name}}</h4>
            <span>{{$userInfo->address}}</span>
        </div>
        
        <div class="d-navigation">
            <ul>
                <li class="active"><a href="{{route('user-dashboard')}}"><i class="ti-dashboard"></i>Dashboard</a></li>
                <li><a href="{{route('user-profile')}}"><i class="ti-user"></i>My Profile</a></li>
                {{-- <li><a href="#"><i class="ti-layers"></i>My Booking</a></li> --}}
                <li><a href="{{route('change-password')}}"><i class="ti-unlock"></i>Change Password</a></li>
                <li><a href="{{route('user-logout')}}"><i class="ti-power-off"></i>Log Out</a></li>
            </ul>
        </div>
        
    </div>
</div>