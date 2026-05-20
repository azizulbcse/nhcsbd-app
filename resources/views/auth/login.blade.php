<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login | Nurses Health Care Society Bangladesh</title>  

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('admin/assets/img/logo.png') }}" /> 

    <!-- Local Core CSS Frameworks -->
    <link href="{{ asset('admin/assets/plugins/bootstrapv3/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/plugins/bootstrapv3/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/plugins/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/plugins/animate.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/webarch/css/webarch.css') }}" rel="stylesheet" type="text/css" />

    <!-- Smartphone Optimized UI Styling -->
    <style>
        :root {
            --nhcs-blue: #2196F3;
            --nhcs-purple: #7B1FA2;
            --nhcs-danger: #f35958;
            --nhcs-bg: #f5f7fb;
        }
        body {
            background-color: var(--nhcs-bg) !important;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            min-height: 100vh !important;
            margin: 0 !important;
            padding: 15px !important;
        }
        .container-fluid {
            width: 100%;
            max-width: 440px;
            padding: 0;
        }
        .login-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.06);
            padding: 35px 30px;
            border-top: 5px solid var(--nhcs-blue);
        }
        @media (max-width: 480px) {
            .login-card {
                padding: 30px 20px;
                border-radius: 16px;
            }
        }
        .brand-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 6px;
            text-align: left;
            display: block;
        }
        .form-label i {
            color: var(--nhcs-blue);
            margin-right: 5px;
            font-size: 14px;
        }
        .form-control {
            height: 48px !important;
            border-radius: 10px !important;
            border: 1.5px solid #e2e8f0 !important;
            padding-left: 15px !important;
            font-size: 15px !important;
            width: 100% !important;
        }
        .password-wrapper {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 14px;
            cursor: pointer;
            color: #a0aec0;
            font-size: 16px;
            z-index: 10;
        }
        .btn-action-group {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }
        .btn-login {
            background-color: var(--nhcs-blue) !important;
            color: #ffffff !important;
            border: none !important;
            height: 48px !important;
            border-radius: 10px !important;
            flex: 1;
            font-weight: 600;
            font-size: 15px;
            transition: background-color 0.2s;
        }
        .btn-login:hover {
            background-color: #1976D2 !important;
        }
        .btn-cancel {
            background-color: #ffffff !important;
            color: #4a5568 !important;
            border: 1.5px solid #e2e8f0 !important;
            height: 48px !important;
            border-radius: 10px !important;
            flex: 1;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-cancel:hover {
            background-color: #f7fafc !important;
            color: #2d3748 !important;
        }
        /* স্মার্ট বাংলা এরর মেসেজ স্টাইলিং */
        .smart-error-msg {
            color: var(--nhcs-danger);
            font-size: 12px;
            margin-top: 6px;
            font-weight: 500;
            display: none;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="login-card animated fadeIn">
            
            <!-- Logo Area -->
            <div class="brand-header">
                <img src="{{ asset('admin/assets/img/logo.png') }}" style="width: 160px;" alt="NHCS Logo">
            </div>
            
            <!-- Welcome Title Area -->
            <div class="text-center" style="text-align: center; margin-bottom: 25px;">
                <h3 style="color: var(--nhcs-purple); font-weight: bold; margin-top: 10px; margin-bottom: 5px;">Welcome to Nurses Health Care Society!</h3>
                <p class="text-muted small" style="margin: 0; font-size: 13px;">Sign up Now!</p>
            </div>

            <!-- Backend Status Alerts -->
            @if (session('status'))
                <div class="alert alert-success" role="alert" style="border-radius: 8px; font-size: 13px; text-align: left;">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Global Backend Validation Messages -->
            @if ($errors->any())
                <div class="alert alert-danger" role="alert" style="background-color: #fdf2f2; border-color: #fde8e8; color: var(--nhcs-danger); padding: 12px; border-radius: 8px; text-align: left;">
                    <ul style="margin: 0; padding-left: 15px; font-size: 13px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <!-- 'novalidate' যুক্ত করার মাধ্যমে ব্রাউজারের ইংলিশ পপ-আপটি বন্ধ করা হলো -->
            <form id="loginForm" action="{{ route('login') }}" method="POST" autocomplete="off" style="text-align: left;" novalidate>
                @csrf
                
                <!-- Email Input Area -->
                <div class="form-group" style="margin-bottom: 16px;">
                    <label for="email" class="form-label">
                        <i class="fa fa-envelope"></i> ইমেইল বা ইউজারনেম <span style="font-size: 11px; color:#a0aec0; font-weight: normal;">(Email / Username)</span>
                    </label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="username@nhcsbd.org" value="{{ old('email') }}" autocomplete="email">
                    <!-- কাস্টম স্মার্ট বাংলা এরর -->
                    <div id="emailError" class="smart-error-msg">
                        <i class="fa fa-exclamation-circle"></i> অনুগ্রহ করে আপনার ইমেইল বা ইউজারনেমটি লিখুন।
                    </div>
                </div>
                
                <!-- Password Input Area -->
                <div class="form-group" style="margin-bottom: 18px;">
                    <label for="password" class="form-label">
                        <i class="fa fa-lock"></i> পাসওয়ার্ড <span style="font-size: 11px; color:#a0aec0; font-weight: normal;">(Password)</span>
                    </label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" autocomplete="current-password">
                        <i class="glyphicon glyphicon-eye-open toggle-password" id="eyeIcon" role="button"></i>
                    </div>
                    <!-- কাস্টম স্মার্ট বাংলা এরর -->
                    <div id="passwordError" class="smart-error-msg">
                        <i class="fa fa-exclamation-circle"></i> অনুগ্রহ করে আপনার পাসওয়ার্ডটি প্রদান করুন।
                    </div>
                </div>

                <!-- Remember Profile Feature -->
                <div style="margin-bottom: 22px; text-align: left; display: flex; align-items: center; gap: 8px; padding-left: 2px;">
                    <input id="remember_me" name="remember" type="checkbox" value="1" style="width: 18px; height: 18px; cursor: pointer; margin: 0; accent-color: var(--nhcs-blue);">
                    <label for="remember_me" style="cursor: pointer; font-size: 14px; color: #718096; margin: 0; user-select: none; font-weight: 500;">
                        আমাকে মনে রাখুন <span style="font-size: 11px; color:#a0aec0; font-weight: normal; margin-left: 3px;">(Remember me)</span>
                    </label>
                </div>
                
                <!-- Fluid Smart Action Buttons Layout -->
                <div class="btn-action-group">
                    <button type="submit" class="btn btn-login">
                        <i class="fa fa-key" style="margin-right: 5px;"></i> প্রবেশ করুন
                    </button>
                    <a href="/" class="btn btn-cancel">
                        <i class="fa fa-times" style="margin-right: 5px;"></i> বাতিল করুন
                    </a>
                </div>
            </form>
            
            <div class="mt-4" style="margin-top: 25px; text-align: center;">
                <a href="/" class="text-muted small text-decoration-none" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; color: #718096;"><i class="fa fa-arrow-left"></i> Back to Home </a>
            </div>
        </div>
    </div>

    <!-- Essential Scripts for Runtime Actions -->
    <script src="{{ asset('admin/assets/plugins/jquery/jquery-1.11.3.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/assets/plugins/bootstrapv3/js/bootstrap.min.js') }}" type="text/javascript"></script>
    
    <script>
        // Eye Toggle Implementation
        document.getElementById('eyeIcon').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.classList.replace('glyphicon-eye-open', 'glyphicon-eye-close');
            } else {
                passwordInput.type = 'password';
                this.classList.replace('glyphicon-eye-close', 'glyphicon-eye-open');
            }
        });

        // স্মার্ট বাংলা ইনস্ট্যান্ট ভ্যালিডেশন লজিক (ব্রাউজার এরর ব্লক করা হয়েছে)
        document.getElementById('loginForm').addEventListener('submit', function (event) {
            let isValid = true;
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');
            
            // ইমেইল বা ইউজারনেম চেক
            if (!email.value.trim()) {
                emailError.style.display = 'block';
                email.style.borderColor = 'var(--nhcs-danger)';
                isValid = false;
            } else {
                emailError.style.display = 'none';
                email.style.borderColor = '#e2e8f0';
            }

            // পাসওয়ার্ড চেক
            if (!password.value.trim()) {
                passwordError.style.display = 'block';
                password.style.borderColor = 'var(--nhcs-danger)';
                isValid = false;
            } else {
                passwordError.style.display = 'none';
                password.style.borderColor = '#e2e8f0';
            }

            // কোনো ফিল্ড ফাঁকা থাকলে সাবমিট হবে না, শুধু কাস্টম বাংলা মেসেজ দেখাবে
            if (!isValid) {
                event.preventDefault();
                event.stopPropagation();
            }
        });
    </script>
</body>
</html>
