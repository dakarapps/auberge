@php 
$permissionsArr = getRoutePermission(); 
@endphp
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <ul class="nav side-menu">
      @if($permissionsArr['dashboard']) <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> {{lang_trans('sidemenu_dashboard')}} </a></li> @endif
      
      @if($permissionsArr['room-reservation'] && $permissionsArr['quick-check-in']) <li><a href="{{route('quick-check-in', ['step'=>1])}}"><i class="fa fa-check-square-o"></i> {{lang_trans('sidemenu_quick_checkin')}} </a></li> @endif
      
      @if($permissionsArr['room-reservation'] && ($permissionsArr['quick-check-in'] || $permissionsArr['room-reservation'] || $permissionsArr['list-reservation'] || $permissionsArr['list-check-outs']) )
        <li><a><i class="fa fa-money"></i>{{lang_trans('sidemenu_checkin')}} <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if($permissionsArr['quick-check-in']) <li><a href="{{route('quick-check-in', ['step'=>1])}}">{{lang_trans('sidemenu_quick_checkin')}} </a></li> @endif
            @if($permissionsArr['room-reservation']) <li><a href="{{route('room-reservation', ['step'=>1])}}">{{lang_trans('sidemenu_checkin_add')}} </a></li> @endif
            @if($permissionsArr['list-reservation']) <li><a href="{{route('list-reservation')}}">{{lang_trans('sidemenu_checkin_all')}} </a></li> @endif
            @if($permissionsArr['list-check-outs']) <li><a href="{{route('list-check-outs')}}">{{lang_trans('sidemenu_checkout_all')}} </a></li> @endif
            @if($permissionsArr['list-cancelled-reservations']) <li><a href="{{route('list-cancelled-reservations')}}">{{lang_trans('sidemenu_cancelled_reservation')}} </a></li> @endif
          </ul>
        </li>
      @endif

      @if($permissionsArr['add-housekeeping-item'] || $permissionsArr['list-housekeeping-item'] || $permissionsArr['add-housekeeping-order'] || $permissionsArr['list-housekeeping-order'])
        <li><a><i class="fa fa-shower"></i>{{lang_trans('sidemenu_housekeeping')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if($permissionsArr['add-housekeeping-item']) <li><a href="{{route('add-housekeeping-item')}}">{{lang_trans('sidemenu_item_add')}} </a></li> @endif
            @if($permissionsArr['list-housekeeping-item']) <li><a href="{{route('list-housekeeping-item')}}">{{lang_trans('sidemenu_item_all')}} </a></li> @endif
            @if($permissionsArr['add-housekeeping-order']) <li><a href="{{route('add-housekeeping-order')}}">{{lang_trans('sidemenu_order_add')}} </a></li> @endif
            @if($permissionsArr['list-housekeeping-order']) <li><a href="{{route('list-housekeeping-order')}}">{{lang_trans('sidemenu_order_all')}} </a></li> @endif
          </ul>
        </li>
      @endif

      @if($permissionsArr['add-laundry-item'] || $permissionsArr['list-laundry-item'] || $permissionsArr['add-laundry-order'] || $permissionsArr['list-laundry-order'])
        <li><a><i class="fa fa-tint"></i>{{lang_trans('sidemenu_laundry')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if($permissionsArr['add-laundry-item']) <li><a href="{{route('add-laundry-item')}}">{{lang_trans('sidemenu_item_add')}} </a></li> @endif
            @if($permissionsArr['list-laundry-item']) <li><a href="{{route('list-laundry-item')}}">{{lang_trans('sidemenu_item_all')}} </a></li> @endif
            @if($permissionsArr['add-laundry-order']) <li><a href="{{route('add-laundry-order')}}">{{lang_trans('sidemenu_order_add')}} </a></li> @endif
            @if($permissionsArr['list-laundry-order']) <li><a href="{{route('list-laundry-order')}}">{{lang_trans('sidemenu_order_all')}} </a></li> @endif
          </ul>
        </li>
      @endif

      @if($permissionsArr['reports'] || $permissionsArr['stock-history'])
        <li><a><i class="fa fa-file-code-o"></i>{{lang_trans('sidemenu_reports')}} <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if($permissionsArr['reports']) <li><a href="{{route('reports', ['type'=>'transactions'])}}">{{lang_trans('sidemenu_transactions_report')}} </a></li> @endif
            @if($permissionsArr['reports']) <li><a href="{{route('reports', ['type'=>'checkouts'])}}">{{lang_trans('sidemenu_checkout_report')}} </a></li> @endif
            @if($permissionsArr['reports']) <li><a href="{{route('reports', ['type'=>'expense'])}}">{{lang_trans('sidemenu_expense_report')}} </a></li> @endif
            @if($permissionsArr['stock-history']) <li><a href="{{route('stock-history')}}">{{lang_trans('sidemenu_stock_report')}} </a></li> @endif
          </ul>
        </li>
      @endif
      
      @if($permissionsArr['add-user'] || $permissionsArr['list-user'])
        <li><a><i class="fa fa-user"></i>{{lang_trans('sidemenu_users')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
             @if($permissionsArr['add-user']) <li><a href="{{route('add-user')}}">{{lang_trans('sidemenu_user_add')}} </a></li> @endif
             @if($permissionsArr['list-user']) <li><a href="{{route('list-user')}}">{{lang_trans('sidemenu_user_all')}} </a></li> @endif
          </ul>
        </li>
      @endif

      @if($permissionsArr['add-customer'] || $permissionsArr['list-customer'])
        <li><a><i class="fa fa-user"></i>{{lang_trans('sidemenu_customers')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
             @if($permissionsArr['add-customer']) <li><a href="{{route('add-customer')}}">{{lang_trans('sidemenu_customer_add')}} </a></li> @endif
             @if($permissionsArr['list-customer']) <li><a href="{{route('list-customer')}}">{{lang_trans('sidemenu_customer_all')}} </a></li> @endif
          </ul>
        </li>
      @endif
      
      @if($permissionsArr['add-food-category'] || $permissionsArr['list-food-category'] || $permissionsArr['add-food-item'] || $permissionsArr['list-food-item'])
        <li><a><i class="fa fa-cutlery"></i>{{lang_trans('sidemenu_fooditems')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if($permissionsArr['add-food-category']) <li><a href="{{route('add-food-category')}}">{{lang_trans('sidemenu_foodcat_add')}} </a></li> @endif
            @if($permissionsArr['list-food-category']) <li><a href="{{route('list-food-category')}}">{{lang_trans('sidemenu_foodcat_all')}} </a></li> @endif
            @if($permissionsArr['add-food-item']) <li><a href="{{route('add-food-item')}}">{{lang_trans('sidemenu_fooditem_add')}} </a></li> @endif
            @if($permissionsArr['list-food-item']) <li><a href="{{route('list-food-item')}}">{{lang_trans('sidemenu_fooditem_all')}} </a></li> @endif
          </ul>
        </li>
      @endif

      @if($permissionsArr['add-product'] || $permissionsArr['list-product'] || $permissionsArr['io-stock'] || $permissionsArr['stock-history'])
        <li><a><i class="fa fa-cart-plus"></i>{{lang_trans('sidemenu_stocks')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if($permissionsArr['add-product']) <li><a href="{{route('add-product')}}">{{lang_trans('sidemenu_product_add')}} </a></li> @endif
            @if($permissionsArr['list-product']) <li><a href="{{route('list-product')}}">{{lang_trans('sidemenu_product_all')}} </a></li> @endif
            @if($permissionsArr['io-stock']) <li><a href="{{route('io-stock')}}">{{lang_trans('sidemenu_stock_add')}} </a></li> @endif
            @if($permissionsArr['stock-history']) <li><a href="{{route('stock-history')}}">{{lang_trans('sidemenu_stock_history')}} </a></li> @endif
          </ul>
        </li>
      @endif

      @if($permissionsArr['add-room'] || $permissionsArr['list-room'] || $permissionsArr['add-room-types'] || $permissionsArr['list-room-types'] || $permissionsArr['add-amenities'] || $permissionsArr['list-amenities'])
        <li><a><i class="fa fa-home"></i>{{lang_trans('sidemenu_rooms')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if($permissionsArr['add-room']) <li class="sub_menu"><a href="{{route('add-room')}}">{{lang_trans('sidemenu_room_add')}} </a></li> @endif
            @if($permissionsArr['list-room']) <li class="sub_menu"><a href="{{route('list-room')}}">{{lang_trans('sidemenu_room_all')}} </a></li> @endif
            @if($permissionsArr['add-room-types']) <li class="sub_menu"><a href="{{route('add-room-types')}}">{{lang_trans('sidemenu_roomtype_add')}} </a></li> @endif
            @if($permissionsArr['list-room-types']) <li class="sub_menu"><a href="{{route('list-room-types')}}">{{lang_trans('sidemenu_roomtype_all')}} </a></li> @endif
            @if($permissionsArr['add-amenities']) <li class="sub_menu"><a href="{{route('add-amenities')}}">{{lang_trans('sidemenu_amenities_add')}} </a></li> @endif
            @if($permissionsArr['list-amenities']) <li class="sub_menu"><a href="{{route('list-amenities')}}">{{lang_trans('sidemenu_amenities_all')}} </a></li> @endif
          </ul>
        </li>
      @endif

      @if($permissionsArr['add-expense-category'] || $permissionsArr['list-expense-category'] || $permissionsArr['add-expense'] || $permissionsArr['list-expense'])
        <li><a><i class="fa fa-hourglass-start"></i>{{lang_trans('sidemenu_expense')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if($permissionsArr['add-expense-category']) <li><a href="{{route('add-expense-category')}}">{{lang_trans('sidemenu_expensecat_add')}} </a></li> @endif
            @if($permissionsArr['list-expense-category']) <li><a href="{{route('list-expense-category')}}">{{lang_trans('sidemenu_expensecat_all')}} </a></li> @endif
            @if($permissionsArr['add-expense']) <li><a href="{{route('add-expense')}}">{{lang_trans('sidemenu_expense_add')}} </a></li> @endif
            @if($permissionsArr['list-expense']) <li><a href="{{route('list-expense')}}">{{lang_trans('sidemenu_expense_all')}} </a></li> @endif
          </ul>
        </li>
      @endif

      @if($permissionsArr['add-vendor-category'] || $permissionsArr['list-vendor-category'] || $permissionsArr['add-vendor'] || $permissionsArr['list-vendor'])
        <li><a><i class="fa fa-handshake-o"></i>{{lang_trans('sidemenu_vendor')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if($permissionsArr['add-vendor-category']) <li><a href="{{route('add-vendor-category')}}">{{lang_trans('sidemenu_vendorcat_add')}} </a></li> @endif
            @if($permissionsArr['list-vendor-category']) <li><a href="{{route('list-vendor-category')}}">{{lang_trans('sidemenu_vendorcat_all')}} </a></li> @endif
            @if($permissionsArr['add-vendor']) <li><a href="{{route('add-vendor')}}">{{lang_trans('sidemenu_vendor_add')}} </a></li> @endif
            @if($permissionsArr['list-vendor']) <li><a href="{{route('list-vendor')}}">{{lang_trans('sidemenu_vendor_all')}} </a></li> @endif
          </ul>
        </li>
      @endif

      @if($permissionsArr['add-season'] || $permissionsArr['list-season'])
        <li><a><i class="fa fa-skyatlas"></i>{{lang_trans('sidemenu_seasons')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if($permissionsArr['add-season']) <li><a href="{{route('add-season')}}">{{lang_trans('sidemenu_season_add')}} </a></li> @endif
            @if($permissionsArr['list-season']) <li><a href="{{route('list-season')}}">{{lang_trans('sidemenu_season_all')}} </a></li> @endif
          </ul>
        </li>
      @endif

      @if($permissionsArr['settings'] || $permissionsArr['dynamic-dropdown-list'] || $permissionsArr['permissions-list'] || $permissionsArr['language-translations'])
        <li><a><i class="fa fa-cog"></i>{{lang_trans('sidemenu_settings')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if($permissionsArr['settings']) <li><a href="{{route('settings')}}">{{lang_trans('sidemenu_general_settings')}} </a></li> @endif
            @if($permissionsArr['permissions-list']) <li><a href="{{route('permissions-list')}}">{{lang_trans('sidemenu_permissions_settings')}} </a></li> @endif
            @if($permissionsArr['language-translations']) <li><a href="{{route('language-translations')}}">{{lang_trans('sidemenu_lang_settings')}} </a></li> @endif
            @if($permissionsArr['dynamic-dropdown-list']) <li><a href="{{route('dynamic-dropdown-list')}}">{{lang_trans('sidemenu_dynamic_dropdowns')}} </a></li> @endif
          </ul>
        </li>
      @endif

      @if($permissionsArr['home-page'] || $permissionsArr['about-page'] || $permissionsArr['contact-page'])
        <li><a><i class="fa fa-globe"></i>{{lang_trans('sidemenu_website')}}<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            @if($permissionsArr['home-page'])<li><a href="{{route('home-page')}}">{{lang_trans('sidemenu_home_page')}}</a></li>@endif
            @if($permissionsArr['about-page'])<li><a href="{{route('about-page')}}">{{lang_trans('sidemenu_aboutus_page')}}</a></li>@endif
            @if($permissionsArr['contact-page'])<li><a href="{{route('contact-page')}}">{{lang_trans('sidemenu_contactus_page')}}</a></li>@endif
          </ul>
        </li>
      @endif
    </ul>
  </div>
</div>