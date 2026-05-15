@extends('layouts.frontend')

@section('title', 'Deposit Details | Nurses Health Care Society Bangladesh')

@section('content')
<main class="main">

    <!-- Page Title Header (স্মার্ট গ্রেডিয়েন্ট লুক) -->
    <div class="page-title dark-background" style="background: linear-gradient(135deg, #1A237E 0%, #0056b3 100%); padding: 60px 0; color: #fff;">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0 fw-bold"><i class="bi bi-bank2 me-2"></i>Deposit Details</h1>
        <nav class="breadcrumbs">
          <ol class="breadcrumb mb-0" style="background: transparent;">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none"><i class="bi bi-house-door-fill"></i> Home</a></li>
            <li class="breadcrumb-item active text-white" aria-current="page">Deposit Details</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Main Section -->
    <section id="about" class="about section py-5" style="background-color: #f8f9fa;">
      <div class="container" data-aos="fade-up">
        
        <!-- অফিশিয়াল ব্যাংক অ্যাকাউন্ট কার্ড -->
        <div class="card border-0 shadow-sm p-4 p-md-5 mb-5 text-center" style="border-radius: 20px; background: #ffffff; border-top: 5px solid #1A237E;">
            <div class="d-flex align-items-center justify-content-center mb-3">
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: rgba(26, 35, 126, 0.05); color: #1A237E;">
                    <i class="bi bi-building-fill-check fs-3"></i>
                </div>
            </div>
            <h2 class="fw-bold" style="color: #1A237E;">Bank Name: City Bank PLC</h2>
            <h5 class="text-muted fw-semibold mb-2"><i class="bi bi-geo-alt-fill text-danger"></i> Branch Name: SHAYMOLI BRANCH</h5>
            <h6 class="text-dark fw-bold mb-2">Account Name: HASAN UDDIN TAMAL / RAZIB HOSSAIN / MD SUMON</h6>
            <div class="d-inline-block px-4 py-2 mt-2 rounded-pill" style="background: rgba(26, 35, 126, 0.08); border: 1px dashed #1A237E;">
                <h4 class="mb-0 fw-extrabold" style="color: #1A237E; font-family: 'Courier New', Courier, monospace; letter-spacing: 1px;">
                    <i class="bi bi-credit-card-2-back-fill me-2"></i>2304110322001
                </h4>
            </div>
        </div>

        <!-- মোবাইল ব্যাংকিং ও হিসাবরক্ষক প্যানেল টাইটেল -->
        <div class="d-flex align-items-center mb-4" style="border-left: 5px solid #05B262; padding-left: 15px;">
            <h4 class="fw-bold mb-0" style="color: #2d3748;"><i class="bi bi-phone-vibrate-fill text-success me-2"></i>Mobile Banking & Accounts Support</h4>
        </div>

        <!-- ৩টি ডাইনামিক রেসপন্সিভ কার্ড গ্রিড -->
        <div class="row g-4 justify-content-center">
            
            <!-- কার্ড ১: হাসান উদ্দিন তামাল -->
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 p-4 text-center text-md-start" style="border-radius: 15px; background: #ffffff; transition: 0.3s; border-left: 4px solid #e91e63;">
                    <h5 class="fw-bold text-uppercase tracking-wide mb-3" style="color: #e91e63;"><i class="bi bi-phone-flip"></i> bKash & Nagad</h5>
                    <hr class="my-2 opacity-10">
                    <div class="d-flex align-items-center mb-3 justify-content-center justify-content-md-start">
                        <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-primary" style="width: 40px; height: 40px;">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <div class="ms-3">
                            <a href="tel:01680496808" class="text-decoration-none fw-bold fs-5 text-dark hover-primary">01680496808</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                        <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-success" style="width: 40px; height: 40px;">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <div class="ms-3">
                            <span class="fw-bold d-block text-dark" style="font-size: 15px;">Hasan Uddin Tamal</span>
                            <small class="text-muted text-uppercase fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">Accountant</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- কার্ড ২: মোঃ সৌমিক হাসান -->
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 p-4 text-center text-md-start" style="border-radius: 15px; background: #ffffff; transition: 0.3s; border-left: 4px solid #00d2ff;">
                    <h5 class="fw-bold text-uppercase tracking-wide mb-3" style="color: #00d2ff;"><i class="bi bi-phone-flip"></i> bKash & Nagad</h5>
                    <hr class="my-2 opacity-10">
                    <div class="d-flex align-items-center mb-3 justify-content-center justify-content-md-start">
                        <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-primary" style="width: 40px; height: 40px;">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <div class="ms-3">
                            <a href="tel:01934337659" class="text-decoration-none fw-bold fs-5 text-dark">01934337659</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                        <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-success" style="width: 40px; height: 40px;">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <div class="ms-3">
                            <span class="fw-bold d-block text-dark" style="font-size: 15px;">Md. Soumik Hasan</span>
                            <small class="text-muted text-uppercase fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">Asst. Accountant</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- কার্ড ৩: মোঃ সুমন -->
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100 p-4 text-center text-md-start" style="border-radius: 15px; background: #ffffff; transition: 0.3s; border-left: 4px solid #fd7e14;">
                    <h5 class="fw-bold text-uppercase tracking-wide mb-3" style="color: #fd7e14;"><i class="bi bi-phone-flip"></i> bKash & Nagad</h5>
                    <hr class="my-2 opacity-10">
                    <div class="d-flex align-items-center mb-3 justify-content-center justify-content-md-start">
                        <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-primary" style="width: 40px; height: 40px;">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <div class="ms-3">
                            <a href="tel:01717288965" class="text-decoration-none fw-bold fs-5 text-dark">01717288965</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                        <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-success" style="width: 40px; height: 40px;">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <div class="ms-3">
                            <span class="fw-bold d-block text-dark" style="font-size: 15px;">Md. Sumon</span>
                            <small class="text-muted text-uppercase fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">Support Team</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
      </div>
    </section>

</main>
@endsection
