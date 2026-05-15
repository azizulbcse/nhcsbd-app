<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Nurses Health Care Society Bangladesh')</title>
    
    <!-- আপনার সেই ওল্ড হেডার এসেট ফাইলটি লোড হবে -->
    @include('layouts.frontend-head')

    <style>
        /* আপনার দেওয়া স্মার্ট ফুটার সিএসএস (মাস্টার লেআউটে রাখায় সব পেজে অটো কাজ করবে) */
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

    <!-- ========================================== -->
    <!-- ১. টপ বার ও মেইন মেনু হেডার সেকশন -->
    <!-- ========================================== -->
    <header id="header" class="header sticky-top">
        <div class="topbar d-flex align-items-center light-background">
            <div class="container d-flex justify-content-center justify-content-md-between">
                <div class="contact-info d-flex align-items-center">
                    <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:nhcs.bd.org@gmail.com">nhcs.bd.org@gmail.com</a></i>
                    <div class="contact-info d-flex align-items-center ms-4">
                        <span>
                            <a href="{{ url('nurses_access_789.php') }}" class="ms-3"><i class="bi bi-shield-lock-fill me-1"></i>Admin Login</a>    
                            <span class="mx-2">|</span>
                            <a href="{{ url('member-login.php') }}"><i class="bi bi-person-circle me-1"></i>Member Login</a>
                        </span>
                    </div>
                </div>
                <div class="social-links d-none d-md-flex align-items-center">
                    <a href="https://facebook.com" class="facebook" target="_blank" rel="noopener"><i class="bi bi-facebook"></i></a>
                    <a href="https://wa.me" class="whatsapp" target="_blank" rel="noopener"><i class="bi bi-whatsapp"></i></a>
                    <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>

        <div class="branding d-flex align-items-center">
            <div class="container position-relative d-flex align-items-center justify-content-between">
                <a href="{{ url('/') }}" class="logo d-flex align-items-center" style="text-decoration: none; display: flex; align-items: center;">
                    <img src="{{ asset('frontend/assets/img/logo.png') }}" alt="NHCS Logo" style="max-height: 65px; margin-right: 15px; filter: drop-shadow(0px 4px 8px rgba(0, 123, 255, 0.2)); transition: 0.3s;">
                    <div style="border-left: 2px solid #007bff33; padding-left: 15px;">
                        <h2 class="sitename" style="font-size: 18px; font-weight: 800; margin: 0; line-height: 1.2; background: linear-gradient(90deg, #0056b3, #00d2ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: 0.3px; text-transform: uppercase; font-family: 'Poppins', sans-serif;">
                            Nurses Health Care Society Bangladesh
                        </h2>
                    </div>
                </a>

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <?php $isHome = Request::is('/') || Request::is('index.php'); ?>
                        <li style="list-style: none;">
                            <a href="{{ url('/') }}" style="display: flex; align-items: center; gap: 8px; font-weight: 600; transition: 0.3s; text-decoration: none; color: {{ $isHome ? '#0077b6' : '#444' }}; background: {{ $isHome ? 'rgba(0, 119, 182, 0.1)' : 'transparent' }}; padding: 5px 10px; border-radius: 5px;">
                                <i class="bi bi-house-heart-fill" style="font-size: 18px; color: #0077b6;"></i> Home
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin-list.php') }}" style="display: flex; align-items: center; gap: 8px; font-weight: 600; transition: 0.3s; text-decoration: none; color: #444; padding: 5px 10px;">
                                <i class="bi bi-person-workspace" style="font-size: 18px; color: #fd7e14;"></i> Administrator List
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('member-list.php') }}" style="display: flex; align-items: center; gap: 8px; font-weight: 600; transition: 0.3s; text-decoration: none; color: #444; padding: 5px 10px;">
                                <i class="bi bi-heart-pulse-fill" style="font-size: 18px; color: #e91e63;"></i> Member List
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('notice.php') }}" style="display: flex; align-items: center; gap: 8px; font-weight: 600; transition: 0.3s; text-decoration: none; color: #444; padding: 5px 10px;">
                                <i class="bi bi-megaphone-fill" style="font-size: 18px; color: #00d2ff;"></i> Notice
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" style="display: flex; align-items: center; gap: 8px; font-weight: 600; transition: 0.3s; text-decoration: none; color: #444; padding: 5px 10px;">
                                <i class="bi bi-collection-play-fill" style="font-size: 18px; color: #ffc107;"></i>
                                <span>Gallery</span> <i class="bi bi-chevron-down toggle-dropdown" style="font-size: 12px; margin-left: auto;"></i>
                            </a>
                            <ul>
                                <li><a href="{{ url('photo-gallery.php') }}">Photo Gallery</a></li>
                                <li><a href="{{ url('video-gallery.php') }}">Video Gallery</a></li>                
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('deposit.details') }}" style="display: flex; align-items: center; gap: 8px; font-weight: 600; transition: 0.3s; text-decoration: none; color: #444; padding: 5px 10px;">
                                <i class="bi bi-bank" style="font-size: 18px; color: #20c997;"></i> Deposit Details
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" style="display: flex; align-items: center; gap: 8px; font-weight: 600; transition: 0.3s; text-decoration: none; color: #444; padding: 5px 10px;">
                                <i class="bi bi-telephone-outbound-fill" style="font-size: 18px; color: #20c997;"></i> Contact
                            </a>
                        </li>
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>
            </div>      
        </div>
    </header>

    <!-- ========================================== -->
    <!-- ২. ডাইনামিক কন্টেন্ট এরিয়া (পেজের কন্টেন্ট এখানে লোড হবে) -->
    <!-- ========================================== -->
    @yield('content')

    <!-- ১. আপনার নতুন প্রফেশনাল ফুটার ইনক্লুড -->
    @include('layouts.frontend-footer')

    <!-- ২. সব জাভাস্ক্রিপ্ট ফাইলের পাথ লারাভেল এসেট মেথডে ফিক্সড (public/frontend ফোল্ডারের সাপেক্ষে) -->
    <script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

    @yield('scripts')
</body>
</html>

