@extends('layouts.frontend')

@section('title', 'Society Constitution | Nurses Health Care Society Bangladesh')

@section('content')
<main class="main">

    <!-- ========================================== -->
    <!-- ১. প্রিমিয়াম গ্রাডিয়েন্ট পেজ টাইটেল হেডার সেকশন -->
    <!-- ========================================== -->
    <div class="page-title dark-background" style="background: linear-gradient(135deg, #1A237E 0%, #0056b3 100%); padding: 60px 0; color: #fff;">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0 fw-bold">
                <i class="bi bi-file-earmark-lock2 me-2"></i>Society Constitution
            </h1>

            <nav class="breadcrumbs">
                <ol class="breadcrumb mb-0" style="background: transparent;">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}" class="text-white-50 text-decoration-none">
                            <i class="bi bi-house-door-fill"></i> Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Constitution</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- ========================================== -->
    <!-- ২. স্মার্ট অ্যাক্সেস কন্ট্রোল ও রেসট্রিকশন সেকশন -->
    <!-- ========================================== -->
    <section class="constitution-section py-5" style="background-color: #f8f9fa;">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    
                    <!-- মেম্বার অথেনটিকেশন চেক কন্ডিশন -->
                    @auth
                        <!-- 🔓 যদি ইউজার অলরেডি লগইন করা থাকে তবে সে আসল গঠনতন্ত্র দেখতে পাবে -->
                        <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 15px; background: #ffffff; border-top: 5px solid #05B262;">
                            <h3 class="fw-bold mb-4 text-success"><i class="bi bi-file-earmark-text-fill me-2"></i>সোসাইটির অফিসিয়াল গঠনতন্ত্র</h3>
                            <div class="constitution-content" style="line-height: 1.8; color: #4a5568; text-align: justify;">
                                <p>এখানে আপনার সোসাইটির অনুমোদিত মূল গঠনতন্ত্রের বিস্তারিত ধারা এবং পিডিএফ ফাইলটি প্রদর্শিত হবে, যা শুধুমাত্র লগইন করা সদস্যরা পড়ার সুযোগ পাচ্ছেন।</p>
                                <!-- আপনার গঠনতন্ত্রের কন্টেন্ট বা পিডিএফ ডাউনলোড বাটন এখানে বসাতে পারেন -->
                            </div>
                        </div>
                    @else
                        <!-- 🔒 যদি ইউজার লগইন করা না থাকে (পাবলিক ভিজিটর) তবে এই স্মার্ট অ্যালার্ট কার্ডটি দেখাবে -->
                        <div class="card border-0 shadow-lg p-5 text-center bg-white" style="border-radius: 20px; border-bottom: 5px solid #e74c3c;">
                            <div class="mb-4">
                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center animate-pulse" 
                                     style="width: 100px; height: 100px; background-color: rgba(231, 76, 60, 0.08); color: #e74c3c;">
                                    <i class="bi bi-shield-lock-fill" style="font-size: 45px;"></i>
                                </div>
                            </div>
                            
                            <h3 class="fw-bold mb-3" style="color: #1A237E;">সংরক্ষিত এলাকা (Restricted Access)</h3>
                            
                            <div class="mx-auto" style="max-width: 550px;">
                                <h5 class="fw-semibold text-secondary mb-4" style="line-height: 1.6; font-size: 16px;">
                                    দুঃখিত, নার্সেস হেলথ কেয়ার সোসাইটির অফিসিয়াল গঠনতন্ত্রটি একটি অভ্যন্তরীণ গোপনীয় নথি। শুধুমাত্র সোসাইটির নিবন্ধিত সাধারণ সদস্যরাই তাদের নিজস্ব পোর্টালে লগইন করে এটি দেখার ইখতিয়ার রাখেন।
                                </h5>
                            </div>

                            <hr class="my-4 opacity-10" style="border-color: #cbd5e1;">

                            <!-- কুইক অ্যাকশন বাটন গ্রুপ -->
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="{{ url('/login') }}" class="btn btn-primary rounded-pill px-4 py-2.5 fw-bold shadow-sm" style="background: linear-gradient(135deg, #1A237E 0%, #0056b3 100%); border: none;">
                                    <i class="bi bi-box-arrow-in-right me-1"></i> মেম্বার লগইন করুন
                                </a>
                                <a href="{{ url('/application4join') }}" class="btn btn-outline-success rounded-pill px-4 py-2.5 fw-bold shadow-sm" style="border-color: #05B262; color: #05B262;">
                                    <i class="bi bi-person-plus-fill me-1"></i> সদস্য পদের আবেদন
                                </a>
                            </div>
                        </div><!-- End Restriction Card -->
                    @endauth

                </div>
            </div>
        </div>
    </section>

</main>

<style>
@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.04); }
}
.animate-pulse {
    animation: pulse 2.5s infinite ease-in-out;
}
</style>
@endsection
