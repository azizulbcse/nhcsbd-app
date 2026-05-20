@extends('layouts.frontend')

@section('title', 'Official Administrator List | Nurses Health Care Society Bangladesh')

@section('content')
<main class="main">

    <!-- ========================================== -->
    <!-- ১. প্রিমিয়াম গ্রাডিয়েন্ট পেজ টাইটেল হেডার সেকশন -->
    <!-- ========================================== -->
    <div class="page-title dark-background" style="background: linear-gradient(135deg, #1A237E 0%, #0056b3 100%); padding: 60px 0; color: #fff;">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0 fw-bold"><i class="bi bi-person-workspace me-2"></i>Administrator List</h1>
        <nav class="breadcrumbs">
          <ol class="breadcrumb mb-0" style="background: transparent;">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none"><i class="bi bi-house-door-fill"></i> Home</a></li>
            <li class="breadcrumb-item active text-white" aria-current="page">Administrator</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- ========================================== -->
    <!-- ২. ডাইনামিক অ্যাডমিনিস্ট্রেটর কার্ড গ্রিড সেকশন -->
    <!-- ========================================== -->
    <section id="administrator-team" class="administrator-team section py-5" style="background-color: #f8f9fa;">
        <div class="container" data-aos="fade-up">
            
            <div class="text-center mb-5">
                <h3 class="fw-bold" style="color: #1A237E;"><i class="bi bi-award-fill text-warning me-2"></i> সোসাইটির পরিচালনা পর্ষদ</h3>
                <p class="text-muted small">Welcome to Our Society - Nurses Health Care Society Bangladesh</p>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- ডাটাবেজ থেকে আসা এডমিনদের আসল ডাইনামিক লুপ (সিরিয়াল sl ক্রমানুসারে) -->
                @forelse($admins as $admin)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="card admin-card border-0 shadow-sm h-100 text-center overflow-hidden">
                            
                            <!-- মেম্বার ইমেজ কন্টেইনার (সব ছবির ব্যাকগ্রাউন্ড এবং ফ্রেম সাইজ এক রাখার ম্যাজিক উইজেট) -->
                            <div class="admin-img-box position-relative d-flex align-items-center justify-content-center pt-4">
                                <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm" 
                                     style="width: 135px; height: 135px; background-color: #f1f5f9; border: 4px solid #ffffff; overflow: hidden;">
                                     
                                    @if(!empty($admin->userpic))
                                        <img src="{{ asset('uploads/user/' . $admin->userpic) }}" 
                                             alt="{{ $admin->name }}" 
                                             class="w-100 h-100 object-fit-cover" 
                                             loading="lazy"
                                             style="mix-blend-mode: multiply;"
                                             onerror="this.src='https://placehold.co{{ urlencode($admin->name) }}'">
                                    @else
                                        <img src="https://placehold.co{{ urlencode(Str::substr($admin->name, 0, 1)) }}" 
                                             alt="NHCS Member" 
                                             class="w-100 h-100">
                                    @endif
                                    
                                </div>
                            </div>

                            <!-- মেম্বার কন্টেন্ট এরিয়া (XSS প্রোটেকশন সহ) -->
                            <div class="card-body p-3 d-flex flex-column justify-content-between">
                                <div class="mb-2">
                                    <h5 class="fw-bold text-dark mb-1 admin-name" style="font-size: 16px; line-height: 1.4;">{{ $admin->name }}</h5>
                                    <!-- designations কলামের ডাটা ডাইনামিক রেন্ডারিং -->
                                    <span class="badge text-success rounded-pill px-3 py-1 mb-2" style="background-color: rgba(5, 178, 98, 0.08); font-size: 12px; font-weight: 600;">
                                        {{ $admin->designations ?? 'Executive Member' }}
                                    </span>
                                </div>
                                
                                <hr class="my-2 opacity-10">
                                
                                <!-- কাস্টম ৩-ডিজিট মোবাইল মাস্কিং কোড ফুটার -->
                                <div class="mt-auto pt-1">
                                    @if(!empty($admin->mobileno))
                                        @php
                                            // পিএইচপি দিয়ে স্মার্টলি প্রথম ৫ ডিজিট এবং শেষ ৩ ডিজিট রেখে মাঝখানের ৩টি ডিজিট মাস্ক (***) করা হলো
                                            $cleanPhone = trim($admin->mobileno);
                                            $maskedPhone = (strlen($cleanPhone) >= 11) 
                                                ? substr($cleanPhone, 0, 5) . '***' . substr($cleanPhone, -3) 
                                                : $cleanPhone;
                                        @endphp
                                        <div class="text-muted fw-semibold" style="font-size: 14px; letter-spacing: 0.5px;">
                                            <i class="bi bi-telephone-fill text-primary me-1"></i> {{ $maskedPhone }}
                                        </div>
                                    @else
                                        <div class="text-muted small italic" style="font-size: 12px;">
                                            <i class="bi bi-telephone-x-fill me-1"></i> No Contact Provided
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <!-- ডাটাবেজে ওল্ড ডাটা ট্র্যাকিং খালি থাকলে এই অ্যালার্টটি দেখাবে -->
                    <div class="col-12 text-center py-5">
                        <div class="alert alert-warning border-0 shadow-sm d-inline-block p-4" style="border-radius: 12px; background-color: #fff3cd; color: #664d03;">
                            <i class="bi bi-people-fill fs-2 d-block mb-2 text-warning"></i>
                            বর্তমানে পরিচালনা পর্ষদের কোনো তালিকা পাওয়া যায়নি।
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

</main>

<!-- ========================================== -->
<!-- ৩. প্রিমিয়াম ইউআই হোভার ও ট্রানজিশন সিএসএস -->
<!-- ========================================== -->
<style>
.admin-card {
    border-radius: 16px;
    background: #ffffff;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
}
.admin-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.07) !important;
}
.admin-img-box img {
    transition: transform 0.3s ease;
}
.admin-card:hover .admin-img-box img {
    transform: scale(1.04);
}
.admin-name {
    transition: color 0.2s ease;
}
.admin-card:hover .admin-name {
    color: #1A237E !important;
}
</style>
@endsection
