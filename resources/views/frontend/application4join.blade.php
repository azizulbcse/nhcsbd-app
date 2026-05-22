@extends('layouts.frontend')

@section('title', 'Membership Application | Nurses Health Care Society Bangladesh')

@section('content')
<main class="main">

    <!-- ১. প্রিমিয়াম গ্রেডিয়েন্ট পেজ ব্যানার -->
    <div class="page-title dark-background" style="background: linear-gradient(135deg, #1A237E 0%, #0056b3 100%); padding: 60px 0; color: #fff;">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0 fw-bold">
                <i class="bi bi-person-plus-fill me-2"></i>Membership Application
            </h1>
            <nav class="breadcrumbs">
                <ol class="breadcrumb mb-0" style="background: transparent;">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none"><i class="bi bi-house-door-fill"></i> Home</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Application Form</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- ২. মেইন ফরম রেপআপ সেকশন -->
    <section class="join-form-section py-5" style="background-color: #f8f9fa;">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    
                    <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 20px; background: #ffffff; border-top: 5px solid #1A237E;">
                        
                        <!-- সোসাইটি লোগো ও হেডার -->
                        <div class="text-center mb-5">
                            <a href="{{ url('/') }}" class="d-inline-block mb-3">
                                <img src="{{ asset('frontend/assets/img/logo.png') }}" alt="NHCS Logo" style="max-height: 80px; border-radius: 8px;">
                            </a>
                            <h3 class="fw-bold text-dark mb-2">Welcome to Nurses Health Care Society!</h3>
                            <div class="mt-3">
                                <a href="{{ url('/login') }}" class="btn btn-outline-info rounded-pill px-4 fw-semibold small shadow-sm">
                                    <i class="bi bi-box-arrow-in-right me-1"></i> Already Account? Please Login
                                </a>
                            </div>
                        </div>

                        <!-- সিকিউর অ্যালার্ট ও এক্সএসএস ভ্যালিডেশন মেসেজ ফিল্টার -->
                        <div class="mb-4 text-start">
                            @if(session('success'))
                                <div class="alert alert-success border-0 shadow-sm d-flex align-items-center" style="border-radius: 10px; background-color: #05B262; color: #fff;">
                                    <i class="bi bi-check-circle-fill fs-4 me-2"></i>
                                    <div>{{ session('success') }}</div>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center" style="border-radius: 10px; background-color: #e74c3c; color: #fff;">
                                    <i class="bi bi-exclamation-triangle-fill fs-4 me-2"></i>
                                    <div>{{ session('error') }}</div>
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger border-0 shadow-sm p-3" style="border-radius: 10px; background-color: rgba(231, 76, 60, 0.05); color: #e74c3c; border-left: 4px solid #e74c3c;">
                                    <p class="fw-bold mb-1"><i class="bi bi-x-circle-fill me-1"></i> অনুগ্রহ করে নিচের ত্রুটিগুলো সমাধান করুন:</p>
                                    <ul class="mb-0 ps-3">
                                        @foreach($errors->all() as $error)
                                            <li class="small">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <!-- লারাভেলের ৪৪ কলাম ম্যাচিং ডাইনামিক সাবমিশন ফর্ম গেটওয়ে -->
                        <form action="{{ route('member.join.submit') }}" method="POST" id="ApplicationForm" autocomplete="off" novalidate>
                            @csrf 

                            <!-- বুটস্ট্র্যাপ গ্রিড লেআউট স্টার্ট -->
                            <div class="row g-4 text-start">

                                <!-- পেমেন্ট কলাম ১: বিকাশ/নগদ নম্বর -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-secondary">আবেদন ফি-১০০/- টাকা (01689597474)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-wallet2"></i></span>
                                            <input type="text" class="form-control bg-light border-start-0" id="BkashNogod" name="bkashno" value="{{ old('bkashno') }}" placeholder="Bkash/Nogod No (১১ ডিজিট)" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1;">
                                        </div>
                                    </div>
                                </div>

                                <!-- পেমেন্ট কলাম ২: ট্রানজেকশন আইডি -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-secondary">ট্রাঞ্জেকশন নং</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-hash"></i></span>
                                            <input type="text" class="form-control bg-light border-start-0" id="TransactionNo" name="trxid" value="{{ old('trxid') }}" placeholder="Transaction ID (যেমন: 8N3M8W7X)" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1;">
                                        </div>
                                    </div>
                                </div>

                                <!-- মেম্বার বায়ো ১: নাম (বাংলা) -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-secondary">আবেদনকারীর নাম (বাংলা)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-person-badge"></i></span>
                                            <input type="text" class="form-control bg-light border-start-0" id="ApplicantNameBangla" name="name_bangla" value="{{ old('name_bangla') }}" placeholder="পূর্ণ নাম বাংলায় লিখুন" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1;">
                                        </div>
                                    </div>
                                </div>

                                <!-- মেম্বার বায়ো ২: নাম (ইংরেজী) -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-secondary">আবেদনকারীর নাম (ইংরেজীতে)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-person-fill"></i></span>
                                            <input type="text" class="form-control bg-light border-start-0" id="ApplicantNameEnglish" name="name_english" value="{{ old('name_english') }}" placeholder="Full Name in English (BLOCK LETTERS)" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1;">
                                        </div>
                                    </div>
                                </div>

                                <!-- মেম্বার বায়ো ৩: পিতার/স্বামীর নাম -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-secondary">পিতার /স্বামীর নাম</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-person-vcard"></i></span>
                                            <input type="text" class="form-control bg-light border-start-0" id="FathersName" name="fathers_name" value="{{ old('fathers_name') }}" placeholder="Father's or Husband's Name" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1;">
                                        </div>
                                    </div>
                                </div>
                                <!-- মাতার নাম -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-secondary">মাতার নাম</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-person-vcard-fill"></i></span>
                                            <input type="text" class="form-control bg-light border-start-0" id="MothersName" name="mothers_name" value="{{ old('mothers_name') }}" placeholder="Mother's Name" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1;">
                                        </div>
                                    </div>
                                </div>

                                <!-- লিঙ্গ বা জেন্ডার ড্রপডাউন -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-secondary">লিঙ্গ</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-gender-ambiguous"></i></span>
                                            <select class="form-select bg-light border-start-0" id="Gender" name="gender" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1; font-weight: 500;">
                                                <option value="" disabled selected>~~ নির্বাচন করুন ~~</option>
                                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male (পুরুষ)</option>
                                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female (নারী)</option>
                                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other (অন্যান্য)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- বৈবাহিক অবস্থা ড্রপডাউন -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-secondary">বৈবাহিক অবস্থা</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-heart-half"></i></span>
                                            <select class="form-select bg-light border-start-0" id="MaritalStatus" name="maritalstatus" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1; font-weight: 500;">
                                                <option value="" disabled selected>~~ নির্বাচন করুন ~~</option>
                                                <option value="Married" {{ old('maritalstatus') == 'Married' ? 'selected' : '' }}>Married (বিবাহিত)</option>
                                                <option value="Unmarried" {{ old('maritalstatus') == 'Unmarried' ? 'selected' : '' }}>Unmarried (অবিবাবিহত)</option>
                                                <option value="Widowed" {{ old('maritalstatus') == 'Widowed' ? 'selected' : '' }}>Widowed (বিপত্নীক/বিধবা)</option>
                                                <option value="Divorced" {{ old('maritalstatus') == 'Divorced' ? 'selected' : '' }}>Divorced (ডিভোর্সড)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- জন্ম তারিখ ইনপুট -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="DateofBirth" class="form-label fw-bold text-secondary">জন্ম তারিখ</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-calendar-date"></i></span>
                                            <input type="date" class="form-control bg-light border-start-0" id="DateofBirth" name="dateofbirth" value="{{ old('dateofbirth') }}" onkeyup="getAgeVal(0)" onblur="getAgeVal(0)" onchange="getAgeVal(0)" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1; font-weight: 600;">
                                        </div>
                                    </div>
                                </div>

                                <!-- বয়স ফিল্ড (অটো-ক্যালকুলেটেড) -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-secondary">বয়স</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-hourglass-split"></i></span>
                                            <input type="text" class="form-control bg-light border-start-0 text-dark fw-bold" id="Age" name="age" value="{{ old('age') }}" readonly placeholder="জন্ম তারিখ দিলে অটো জেনারেট হবে" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1; background-color: #e2e8f0 !important;">
                                        </div>
                                    </div>
                                </div>

                                <!-- রক্তের গ্রুপ ড্রপডাউন -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-secondary">রক্তের গ্রুপ</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-droplet-fill text-danger"></i></span>
                                            <select class="form-select bg-light border-start-0" id="BloodGroup" name="bloodgroup" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1; font-weight: 500;">
                                                <option value="" disabled selected>~~ নির্বাচন করুন ~~</option>
                                                <option value="A+" {{ old('bloodgroup') == 'A+' ? 'selected' : '' }}>A+</option>
                                                <option value="A-" {{ old('bloodgroup') == 'A-' ? 'selected' : '' }}>A-</option>
                                                <option value="B+" {{ old('bloodgroup') == 'B+' ? 'selected' : '' }}>B+</option>
                                                <option value="B-" {{ old('bloodgroup') == 'B-' ? 'selected' : '' }}>B-</option>
                                                <option value="O+" {{ old('bloodgroup') == 'O+' ? 'selected' : '' }}>O+</option>
                                                <option value="O-" {{ old('bloodgroup') == 'O-' ? 'selected' : '' }}>O-</option>
                                                <option value="AB+" {{ old('bloodgroup') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                                <option value="AB-" {{ old('bloodgroup') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- কর্মরত হাসপাতালের নাম ড্রপডাউন -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-secondary">কর্মরত হাসপাতালের নাম</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-building-fill-add"></i></span>
                                            <select class="form-select bg-light border-start-0" id="HospitalName" name="hospitalname" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1; font-weight: 500;">
                                                <option value="" disabled selected>~~ তালিকা থেকে আপনার হাসপাতাল নির্বাচন করুন ~~</option>
                                                @foreach($hospitals as $hospital)
                                                    <option value="{{ $hospital->hid }}" {{ old('hospitalname') == $hospital->hid ? 'selected' : '' }}>
                                                        {{ $hospital->hospitalname }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- আবেদনকারীর নিজ ফোন নং -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-secondary">আবেদনকারীর নিজ ফোন নং</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-telephone-fill"></i></span>
                                            <input type="number" class="form-control bg-light border-start-0" id="MobileNo" name="mobileno" value="{{ old('mobileno') }}" placeholder="Self Mobile No" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1;">
                                        </div>
                                    </div>
                                </div>

                                <!-- আবেদনকারীর জাতীয় পরিচয় পত্রের নং -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-secondary">আবেদনকারীর জাতীয় পরিচয় পত্রের নং</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-card-text"></i></span>
                                            <input type="number" class="form-control bg-light border-start-0" id="AppNID" name="nid" value="{{ old('nid') }}" placeholder="Self National Id No" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1;">
                                        </div>
                                    </div>
                                </div>

                                <!-- আবেদনকারীর ইমেইল আইডি -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-secondary">আবেদনকারীর ইমেইল আইডি</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-envelope-at-fill"></i></span>
                                            <input type="email" class="form-control bg-light border-start-0" id="Email" name="email" value="{{ old('email') }}" placeholder="E.mail Address" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1;">
                                        </div>
                                    </div>
                                </div>

                                <!-- সিকিউরিটি ফিল্ড ১: ল্যারাভেল অ্যাকাউন্ট পাসওয়ার্ড -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-secondary">অ্যাকাউন্ট পাসওয়ার্ড</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-shield-lock-fill"></i></span>
                                            <input type="password" class="form-control bg-light border-start-0" id="Password" name="password" placeholder="নূন্যতম ৬ অক্ষরের পাসওয়ার্ড" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1;">
                                        </div>
                                    </div>
                                </div>

                                <!-- সিকিউরিটি ফিল্ড ২: কনফার্ম পাসওয়ার্ড -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-secondary">কনফার্ম পাসওয়ার্ড</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-shield-lock"></i></span>
                                            <input type="password" class="form-control bg-light border-start-0" id="PasswordConfirmation" name="password_confirmation" placeholder="পাসওয়ার্ডটি পুনরায় লিখুন" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1;">
                                        </div>
                                    </div>
                                </div>

                                <!-- রক্তের গ্রুপ ড্রপডাউন -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-secondary">রক্তের গ্রুপ</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-droplet-fill text-danger"></i></span>
                                            <select class="form-select bg-light border-start-0" id="BloodGroup" name="bloodgroup" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1; font-weight: 500;">
                                                <option value="" disabled selected>~~নির্বাচন করুন~~</option>
                                                <option value="A+" {{ old('bloodgroup') == 'A+' ? 'selected' : '' }}>A+</option>
                                                <option value="A-" {{ old('bloodgroup') == 'A-' ? 'selected' : '' }}>A-</option>
                                                <option value="B+" {{ old('bloodgroup') == 'B+' ? 'selected' : '' }}>B+</option>
                                                <option value="B-" {{ old('bloodgroup') == 'B-' ? 'selected' : '' }}>B-</option>
                                                <option value="O+" {{ old('bloodgroup') == 'O+' ? 'selected' : '' }}>O+</option>
                                                <option value="O-" {{ old('bloodgroup') == 'O-' ? 'selected' : '' }}>O-</option>
                                                <option value="AB+" {{ old('bloodgroup') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                                <option value="AB-" {{ old('bloodgroup') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- নমিনির নাম -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-secondary">নমিনির নাম</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-person-check-fill"></i></span>
                                            <input type="text" class="form-control bg-light border-start-0" id="NomineeName" name="nomineename" value="{{ old('nomineename') }}" placeholder="Nominee Name" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1;">
                                        </div>
                                    </div>
                                </div>

                                <!-- নমিনির সম্পর্ক -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-secondary">নমিনির সম্পর্ক</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-diagram-3-fill"></i></span>
                                            <input type="text" class="form-control bg-light border-start-0" id="NomineeRelation" name="nomineerelation" value="{{ old('nomineerelation') }}" placeholder="Nominee Relation" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1;">
                                        </div>
                                    </div>
                                </div>

                                <!-- নমিনির ফোন নং -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-secondary">নমিনির ফোন নং</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-telephone-plus-fill"></i></span>
                                            <input type="number" class="form-control bg-light border-start-0" id="NomineeMobile" name="nomineemobile" value="{{ old('nomineemobile') }}" placeholder="Nominee Mobile No" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1;">
                                        </div>
                                    </div>
                                </div>

                                <!-- জরুরী প্রয়োজনে যোগাযোগের জন্য ফোন নং -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label fw-bold text-secondary">জরুরী প্রয়োজনে যোগাযোগের জন্য ফোন নং</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 text-primary" style="border-color: #cbd5e1;"><i class="bi bi-telephone-outbound-fill text-danger"></i></span>
                                            <input type="number" class="form-control bg-light border-start-0" id="EmergencyContact" name="emergencycontact" value="{{ old('emergencycontact') }}" placeholder="Emergency Contact No" style="height: 48px; border-radius: 0 8px 8px 0; border-color: #cbd5e1;">
                                        </div>
                                    </div>
                                </div>

                                <!-- ৪৪ কলাম সিকিউরিটি এগ্রিমেন্ট নীতিমালা টিকবক্স উইজেট -->
                                <div class="col-12 mt-3">
                                    <div class="p-3 rounded-3 text-start d-flex align-items-start gap-2" style="background-color: #f8fafc; border: 1px dashed #cbd5e1;">
                                        <input type="checkbox" name="agreement" id="policyAgreement" class="form-check-input mt-1" style="cursor: pointer; transform: scale(1.1);" required>
                                        <label for="policyAgreement" class="form-check-label small text-muted" style="cursor: pointer; line-height: 1.4;">
                                            আমি প্রতিজ্ঞা করছি যে, সোসাইটির সকল নিয়ম-কানুন ও ১৭টি ধারা সতর্কতার সাথে পাঠ করেছি এবং এর সকল নীতিমালার প্রতি শ্রদ্ধা রেখে সম্মতি জ্ঞাপন করছি।
                                        </label>
                                    </div>
                                </div>

                                <!-- ফর্ম সাবমিট ও ক্লিয়ার বাটন গ্রুপ -->
                                <div class="col-12 text-center mt-4">
                                    <button type="submit" class="btn btn-primary rounded-pill px-5 py-2.5 fw-bold shadow-sm" style="background: linear-gradient(135deg, #1A237E 0%, #0056b3 100%); border: none;">
                                        <i class="bi bi-cloud-arrow-up-fill me-1"></i> Submit Application
                                    </button>
                                    <button type="reset" class="btn btn-light rounded-pill px-4 py-2.5 fw-semibold text-secondary border ms-2">
                                        <i class="bi bi-eraser-fill me-1"></i> Clear Form
                                    </button>
                                </div>

                            </div><!-- End Row -->
                        </form>
                    </div><!-- End Card -->

                </div>
            </div>
        </div>
    </section>

</main>

<!-- ========================================== -->
<!-- ৩. আপনার ওল্ড রিয়েল-টাইম বয়স গণনা স্ক্রিপ্ট ইঞ্জিন -->
<!-- ========================================== -->
<!-- ========================================== -->
<!-- ৩. লিপ ইয়ার ও দিন-মাস-বছর সহ নির্ভুল বয়স গণনা স্ক্রিপ্ট ইঞ্জিন -->
<!-- ========================================== -->
<script type="text/javascript">
function calculateAgeExact(dateString) {
    if (!dateString) return '';
    
    var birthDate = new Date(dateString);
    var today = new Date();
    
    // তারিখ সঠিক কিনা তা যাচাই করা
    if (isNaN(birthDate.getTime())) return '';

    var years = today.getFullYear() - birthDate.getFullYear();
    var months = today.getMonth() - birthDate.getMonth();
    var days = today.getDate() - birthDate.getDate();

    // দিনের হিসাব মাইনাসে আসলে আগের মাসের দিন সংখ্যা দিয়ে সমন্বয় (লিপ ইয়ারসহ স্বয়ংক্রিয় হিসাব)
    if (days < 0) {
        months--;
        // আগের মাসের শেষ দিন বের করার লজিক (যা লিপ ইয়ার হলে ফেব্রুয়ারিকে ২৯ দিন ধরবে)
        var previousMonth = new Date(today.getFullYear(), today.getMonth(), 0);
        days += previousMonth.getDate();
    }

    // মাসের হিসাব মাইনাসে আসলে বছরের হিসাব সমন্বয়
    if (months < 0) {
        years--;
        months += 12;
    }

    // ভবিষ্যৎ তারিখ দিলে ইনপুট রিসেট করা
    if (years < 0) {
        return 'Invalid Date';
    }

    // আউটপুট টেক্সট ফরমেটিং (১ এর বেশি হলে বহুবচন 's' যোগ হবে)
    var yearText = years + ' Year' + (years !== 1 ? 's' : '');
    var monthText = months + ' Month' + (months !== 1 ? 's' : '');
    var dayText = days + ' Day' + (days !== 1 ? 's' : '');

    // সুন্দর সিকোয়েন্সে রিটার্ন (যেমন: 25 Years 4 Months 12 Days)
    return yearText + ' ' + monthText + ' ' + dayText;
}

function getAgeVal(pid) {
    var dobInput = document.getElementById("DateofBirth").value;
    var count = dobInput.length;
    
    // স্ট্যান্ডার্ড YYYY-MM-DD ফরম্যাট দৈর্ঘ্য (১০ ক্যারেক্টার) চেক
    if (count == '10') {
        var exactAge = calculateAgeExact(dobInput);
        
        if (exactAge === 'Invalid Date' || exactAge === '') {
            document.getElementById("DateofBirth").value = "";
            document.getElementById("Age").value = "";
            document.getElementById("DateofBirth").focus();
            return false;
        } else {
            // আপনার ওল্ড 'Age' ফিল্ডে নিখুঁত ডাটা পুশ করা হচ্ছে
            document.getElementById("Age").value = exactAge;
        }
    } else {
        document.getElementById("Age").value = "";
        return false;
    }
}
</script>

@endsection


