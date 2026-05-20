<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Webarch - Responsive Admin Dashboard') | NHCSBD</title>
    
    <!-- BEGIN PLUGIN CSS (admin/ যুক্ত করা হয়েছে) -->
    <link href="{{ asset('admin/assets/plugins/pace/pace-theme-flash.css') }}" rel="stylesheet" type="text/css" media="screen" />
    <link href="{{ asset('admin/assets/plugins/bootstrapv3/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/plugins/bootstrapv3/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://googleapis.com" rel="stylesheet">
    <link href="{{ asset('admin/assets/plugins/animate.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/plugins/jquery-scrollbar/jquery.scrollbar.css') }}" rel="stylesheet" type="text/css" />
    
    <!-- BEGIN CORE CSS FRAMEWORK (admin/ যুক্ত করা হয়েছে) -->
    <link href="{{ asset('admin/webarch/css/webarch.css') }}" rel="stylesheet" type="text/css" />
    @stack('styles')
</head>

<body class="">
    <!-- BEGIN HEADER -->
    <div class="header navbar navbar-inverse ">
      <div class="navbar-inner">
        <div class="header-seperation">
          <ul class="nav pull-left notifcation-center visible-xs visible-sm">
            <li class="dropdown">
              <a href="#main-menu" data-webarch="toggle-left-side"><i class="material-icons">menu</i></a>
            </li>
          </ul>
          <a href="{{ route('admin.dashboard') }}">
            <!-- লোগোর পাথে admin/ যুক্ত করা হয়েছে -->
            <img src="{{ asset('admin/assets/img/logo.png') }}" class="logo" alt="Logo" width="106" height="21" />
          </a>
        </div>
        
        <div class="header-quick-nav">
          <div class="pull-left">
            <ul class="nav quick-section">
              <li class="quicklinks"><a href="#" id="layout-condensed-toggle"><i class="material-icons">menu</i></a></li>
            </ul>
          </div>
          
          <div class="pull-right">
            <ul class="nav quick-section ">
              <li class="quicklinks">
                <a data-toggle="dropdown" class="dropdown-toggle pull-right" href="#" id="user-options">
                  <i class="material-icons">tune</i>
                </a>
                <ul class="dropdown-menu pull-right" role="menu">
                  <li><a href="#">My Account ({{ Auth::user()->name ?? 'User' }})</a></li>
                  <li class="divider"></li>
                  <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                       <i class="material-icons">power_settings_new</i>&nbsp;&nbsp;Log Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- END HEADER -->

    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
      <!-- BEGIN SIDEBAR -->
      <div class="page-sidebar" id="main-menu">
        <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
          <div class="user-info-wrapper sm">
            <div class="profile-wrapper sm">
              <!-- অবতার ইমেজে admin/ যুক্ত করা হয়েছে -->
              <img src="{{ asset('admin/assets/img/profiles/avatar.jpg') }}" alt="Avatar" width="69" height="69" />
            </div>
            <div class="user-info sm">
              <div class="username">{{ Auth::user()->name ?? 'User' }}</div>
              <div class="status">Online</div>
            </div>
          </div>
          
          <p class="menu-title sm">BROWSE</p>
          <ul>
            <li class="start active"><a href="{{ route('admin.dashboard') }}"><i class="material-icons">home</i> <span class="title">Dashboard</span></a></li>
            <li>
              <a href="javascript:;"><i class="material-icons">people</i> <span class="title">মেম্বার তালিকা</span> <span class="arrow"></span></a>
              <ul class="sub-menu">
                <li><a href="#">সকল মেম্বার লিস্ট</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <!-- END SIDEBAR -->

      <!-- BEGIN PAGE CONTAINER-->
      <div class="page-content">
        <div class="content">
            @yield('content')
        </div>
      </div>
      <!-- END PAGE CONTAINER -->
    </div>

    <!-- BEGIN JS DEPENDECENCIES (admin/ যুক্ত করা হয়েছে) -->
    <script src="{{ asset('admin/assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/assets/plugins/jquery/jquery-1.11.3.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/assets/plugins/bootstrapv3/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}" type="text/javascript"></script>
    
    <!-- BEGIN CORE TEMPLATE JS (admin/ যুক্ত করা হয়েছে) -->
    <script src="{{ asset('admin/webarch/js/webarch.js') }}" type="text/javascript"></script>
    @stack('scripts')
  </body>
</html>
