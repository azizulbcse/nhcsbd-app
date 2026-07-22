<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Nurses Health Care Society Bangladesh')</title>
    
    @include('layouts.frontend-head')

    <style>
        .smart-footer {
            background: #ffffff; padding: 15px 30px; border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05); display: flex;
            align-items: center; justify-content: space-between; margin-top: 20px;
            border-bottom: 4px solid #05B262;
        }
        .blink-text { color: #555; font-size: 14px; animation: smoothFade 2s infinite; }
        .heart-icon { color: #e74c3c; animation: beat 1.2s infinite; display: inline-block; }
        @keyframes smoothFade { 0% { opacity: 1; } 50% { opacity: 0.4; } 100% { opacity: 1; } }
        @keyframes beat { 0% { transform: scale(1); } 50% { transform: scale(1.3); } 100% { transform: scale(1); } }
        
        .social-links { display: flex; list-style: none; gap: 12px; margin: 0; padding: 0; align-items: center; }
        .social-links li a {
            width: 35px; height: 35px; background: #f1f3f5; color: #1A237E;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%; text-decoration: none; transition: 0.3s ease-in-out; font-size: 16px;
        }
        .social-links li a:hover { background: #1A237E; color: #ffffff; transform: translateY(-3px); }
        
        .copyright-text { font-size: 14px; color: #444; }
        .copyright-text a { color: #1A237E; text-decoration: none; font-weight: bold; }
    </style>
    @yield('styles')
</head>

<body class="index-page">

<header id="header" class="header sticky-top">
    <div class="topbar d-flex align-items-center light-background">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:nhcs.org.bd@gmail.com">nhcs.org.bd@gmail.com</a></i>
                <div class="contact-info d-flex align-items-center ms-4">
                    <a href="{{ route('auth.admin') }}" class="ms-3"><i class="bi bi-shield-lock-fill me-1"></i>Admin Login</a><span class="mx-2">|</span>
                    <a href="{{ route('auth.member') }}"><i class="bi bi-person-circle me-1"></i>Member Login</a>
                </div>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="https://facebook.com" class="facebook" target="_blank" rel="noopener"><i class="bi bi-facebook"></i></a>
                <a href="https://wa.me" class="whatsapp" target="_blank" rel="noopener"><i class="bi bi-whatsapp"></i></a>
                <a href="#" class="twitter" style="text-decoration: none;"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="instagram" style="text-decoration: none;"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin" style="text-decoration: none;"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div>

    <div class="branding d-flex align-items-center">
        <div class="container position-relative d-flex align-items-center justify-content-between w-100 py-1">
            
            <a href="{{ url('/') }}" class="logo d-flex align-items-center" style="text-decoration: none; flex-shrink: 0;">
                <img src="{{ asset('frontend/assets/img/logo.png') }}" alt="NHCS Logo" style="max-height: 58px; margin-right: 12px; filter: drop-shadow(0px 4px 8px rgba(0, 123, 255, 0.2));">
                <div style="border-left: 2px solid #007bff33; padding-left: 12px;">
                    <h2 class="sitename" style="font-size: 16px; font-weight: 800; margin: 0; line-height: 1.25; background: linear-gradient(90deg, #0056b3, #00d2ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: 0.3px; text-transform: uppercase; font-family: 'Poppins', sans-serif; white-space: nowrap;">
                        Nurses Health Care <br> Society Bangladesh
                    </h2>
                </div>
            </a>
            
            <nav id="navmenu" class="navmenu" style="margin-left: auto;">
                <ul style="gap: 1px; display: flex; align-items: center;">
                    <?php 
                        $currentRoute = Request::route() ? Request::route()->getName() : '';
                        $isHome = Request::is('/') || Request::is('index.php');
                    ?>
                    
                    <!-- Home -->
                    <li style="list-style: none;">
                        <a href="{{ url('/') }}" style="display: flex; align-items: center; gap: 4px; font-weight: 600; font-size: 12.5px; transition: 0.3s; text-decoration: none; color: {{ $isHome ? '#0077b6' : '#444' }}; background: {{ $isHome ? 'rgba(0, 119, 182, 0.08)' : 'transparent' }}; padding: 5px 8px; border-radius: 5px; white-space: nowrap;">
                            <i class="bi bi-house-heart-fill" style="font-size: 15px; color: #0077b6;"></i> Home
                        </a>
                    </li>
                    
                    <?php $isAdminActive = ($currentRoute == 'administrator.list'); ?>
                    <li>
                        <a href="{{ route('administrator.list') }}" style="display: flex; align-items: center; gap: 4px; font-weight: 600; font-size: 12.5px; transition: 0.3s; text-decoration: none; color: {{ $isAdminActive ? '#0077b6' : '#444' }}; background: {{ $isAdminActive ? 'rgba(0, 119, 182, 0.08)' : 'transparent' }}; padding: 5px 8px; border-radius: 5px; white-space: nowrap;">
                            <i class="bi bi-person-workspace" style="font-size: 15px; color: {{ $isAdminActive ? '#0077b6' : '#fd7e14' }};"></i> Administrator List
                        </a>
                    </li>
                    
                    <?php $isMemberActive = ($currentRoute == 'member.list'); ?>
                    <li>
                        <a href="{{ route('member.list') }}" style="display: flex; align-items: center; gap: 4px; font-weight: 600; font-size: 12.5px; transition: 0.3s; text-decoration: none; color: {{ $isMemberActive ? '#0077b6' : '#444' }}; background: {{ $isMemberActive ? 'rgba(0, 119, 182, 0.08)' : 'transparent' }}; padding: 5px 8px; border-radius: 5px; white-space: nowrap;">
                            <i class="bi bi-heart-pulse-fill" style="font-size: 15px; color: {{ $isMemberActive ? '#0077b6' : '#e91e63' }};"></i> Member List
                        </a>
                    </li>
                    
                    <?php $isNoticeActive = ($currentRoute == 'notice'); ?>
                    <li>
                        <a href="{{ route('notice') }}" style="display: flex; align-items: center; gap: 4px; font-weight: 600; font-size: 12.5px; transition: 0.3s; text-decoration: none; color: {{ $isNoticeActive ? '#0077b6' : '#444' }}; background: {{ $isNoticeActive ? 'rgba(0, 119, 182, 0.08)' : 'transparent' }}; padding: 5px 8px; border-radius: 5px; white-space: nowrap;">
                            <i class="bi bi-megaphone-fill" style="font-size: 15px; color: {{ $isNoticeActive ? '#0077b6' : '#00d2ff' }};"></i> Notice
                        </a>
                    </li>
                    
                    <?php $isGalleryActive = str_contains($currentRoute, 'gallery'); ?>
                    <li class="dropdown">
                        <a href="#" style="display: flex; align-items: center; gap: 4px; font-weight: 600; font-size: 12.5px; transition: 0.3s; text-decoration: none; color: {{ $isGalleryActive ? '#0077b6' : '#444' }}; background: {{ $isGalleryActive ? 'rgba(0, 119, 182, 0.08)' : 'transparent' }}; padding: 5px 8px; border-radius: 5px; white-space: nowrap;">
                            <i class="bi bi-collection-play-fill" style="font-size: 15px; color: {{ $isGalleryActive ? '#0077b6' : '#ffc107' }};"></i>
                            <span>Gallery</span> <i class="bi bi-chevron-down toggle-dropdown" style="font-size: 10px; margin-left: auto;"></i>
                        </a>
                        <ul>
                            <li><a href="{{ route('gallery.photo') }}">Photo Gallery</a></li>
                            <li><a href="{{ route('gallery.video') }}">Video Gallery</a></li>                
                        </ul>
                    </li>
                    
                    <?php $isDepositActive = ($currentRoute == 'deposit.details'); ?>
                    <li>
                        <a href="{{ route('deposit.details') }}" style="display: flex; align-items: center; gap: 4px; font-weight: 600; font-size: 12.5px; transition: 0.3s; text-decoration: none; color: {{ $isDepositActive ? '#0077b6' : '#444' }}; background: {{ $isDepositActive ? 'rgba(0, 119, 182, 0.08)' : 'transparent' }}; padding: 5px 8px; border-radius: 5px; white-space: nowrap;">
                            <i class="bi bi-bank" style="font-size: 15px; color: {{ $isDepositActive ? '#0077b6' : '#20c997' }};"></i> Deposit Details
                        </a>
                    </li>

                    <?php $isPhaseII = Request::is('phase-ii/*') || Request::is('phase-ii/apply'); ?>
                    <li>
                        <a href="{{ route('phaseii.apply') }}" style="font-weight: 700; font-size: 12.5px; transition: 0.3s; text-decoration: none; color: #0077b6; background: {{ $isPhaseII ? 'rgba(0, 119, 182, 0.12)' : 'rgba(0, 119, 182, 0.04)' }}; padding: 5px 12px; border-radius: 5px; border: 1px dashed rgba(0, 119, 182, 0.6); display: inline-block; white-space: nowrap; box-shadow: {{ $isPhaseII ? '0 0 10px rgba(0,119,182,0.1)' : 'none' }};">
                            Phase-II Apply
                        </a>
                    </li>

                    <?php $isContactActive = ($currentRoute == 'contact'); ?>
                    <li>
                        <a href="{{ route('contact') }}" style="display: flex; align-items: center; gap: 4px; font-weight: 600; font-size: 12.5px; transition: 0.3s; text-decoration: none; color: {{ $isContactActive ? '#0077b6' : '#444' }}; background: {{ $isContactActive ? 'rgba(0, 119, 182, 0.08)' : 'transparent' }}; padding: 5px 8px; border-radius: 5px; white-space: nowrap;">
                            <i class="bi bi-telephone-outbound-fill" style="font-size: 15px; color: {{ $isContactActive ? '#0077b6' : '#20c997' }};"></i> Contact
                        </a>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>      
    </div>
</header>

    <main>
        @yield('content')
    </main>

    @include('layouts.frontend-footer')

    <script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

    @stack('scripts')
    @yield('scripts')
</body>
</html>
