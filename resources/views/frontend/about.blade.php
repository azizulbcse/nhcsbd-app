@extends('layouts.frontend')

@section('title', 'About Us | Nurses Health Care Society Bangladesh')

@section('content')
<main class="main">

    <!-- ========================================== -->
    <!-- ১. প্রিমিয়াম গ্রাডিয়েন্ট পেজ টাইটেল হেডার সেকশন -->
    <!-- ========================================== -->
    <div class="page-title dark-background" style="background: linear-gradient(135deg, #1A237E 0%, #0056b3 100%); padding: 60px 0; color: #fff;">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0 fw-bold">
                <i class="bi bi-info-circle-fill me-2"></i>About Us
            </h1>

            <nav class="breadcrumbs">
                <ol class="breadcrumb mb-0" style="background: transparent;">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}" class="text-white-50 text-decoration-none">
                            <i class="bi bi-house-door-fill"></i> Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-white" aria-current="page">About Us</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- ========================================== -->
    <!-- ২. আমাদের সম্পর্কে কন্টেন্ট সেকশন -->
    <!-- ========================================== -->
    <section class="about-section py-5" style="background-color: #f8f9fa;">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    
                    <!-- ক. প্রধান পরিচয় ও পরিচিতি কার্ড -->
                    <div class="card border-0 shadow-sm p-4 p-md-5 mb-5" style="border-radius: 15px; background: #ffffff; border-left: 5px solid #1A237E;">
                        <div class="text-start">
                            <h3 class="fw-bold mb-4" style="color: #1A237E;">
                                <i class="bi bi-bookmark-star-fill text-warning me-2"></i>পরিচয় ও পরিচিতি
                            </h3>
                            
                            <h6 class="text-secondary fw-semibold mb-0" style="line-height: 1.8; text-align: justify; font-size: 15px;">
                                <strong>“নার্সেস হেলথ কেয়ার সোসাইটি”</strong> ঢাকাস্থ বিভিন্ন সরকারি হাসপাতালে কর্মরত নার্সিং কর্মকর্তাবৃন্দের সমন্বয়ে গঠিত একটি সোসাইটি। উক্ত সোসাইটি পরিচালনা/নীতি-নির্ধারক কমিটি সোসাইটি পরিচালনার সুবিধার্থে (লক্ষ্য অর্জন ও শৃঙ্খলা রক্ষার নিমিত্তে) নিন্মোক্ত পয়েন্ট/ধারা/নীতিমালা/সংবিধান এর উপর ভিত্তি করে সোসাইটি পরিচালনা করার সিদ্ধান্ত গ্রহণ করা হইয়াছে।
                            </h6>
                        </div>
                    </div><!-- End Intro Card -->

                    <!-- খ. ভিশন সাব-সেকশন কার্ড -->
                    <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 15px; background: #ffffff; border-top: 5px solid #05B262;">
                        <div class="text-start">
                            
                            <div class="text-center mb-4">
                                <h3 class="fw-bold d-inline-block px-4 py-2 rounded-pill" style="color: #05B262; background-color: rgba(5, 178, 98, 0.06); font-size: 22px;">
                                    <i class="bi bi-eye-fill me-2"></i>ভিশন (Vision)
                                </h3>
                            </div>
                            
                            <!-- ভিশন পয়েন্টগুলোর মডার্ন অ্যাপ-লাইক লেআউট লুপ -->
                            <div class="vision-content" style="line-height: 1.8; color: #4a5568;">
                                <ul class="list-unstyled mb-0">
                                    
                                    <li class="mb-4 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-success-subtle text-success rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">১)</span>
                                        <span class="fw-semibold text-dark fs-6" style="letter-spacing: 0.2px;">সোসাইটির নিজস্ব হাসপাতাল প্রতিষ্ঠা করা যেখানে বিনামূল্যে সোসাইটির সদস্য ও তার পরিবারবর্গদের বিনামূল্যে চিকিৎসা সেবা প্রদান করা হবে।</span>
                                    </li>

                                    <li class="mb-4 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-success-subtle text-success rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">২)</span>
                                        <span class="fw-semibold text-dark fs-6" style="letter-spacing: 0.2px;">দেশের স্বনামধন্য প্রতিষ্ঠান হতে চিকিৎসা সেবা নেওয়ার জন্য হেলথ কার্ড প্রদান করা হবে।</span>
                                    </li>

                                    <li class="mb-4 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-success-subtle text-success rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">৩)</span>
                                        <span class="fw-semibold text-dark fs-6" style="letter-spacing: 0.2px;">সোসাইটির নিজস্ব ভবন (আবাসিক এলাকা) স্থাপন করা।</span>
                                    </li>

                                    <li class="mb-4 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-success-subtle text-success rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">৪)</span>
                                        <span class="fw-semibold text-dark fs-6" style="letter-spacing: 0.2px;">সোসাইটির নিজস্ব শপিং মল স্থাপন করা।</span>
                                    </li>

                                    <li class="mb-0 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-success-subtle text-success rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">৫)</span>
                                        <span class="fw-semibold text-dark fs-6" style="letter-spacing: 0.2px;">সোসাইটির নিজস্ব ব্র্যান্ড তৈরি করা।</span>
                                    </li>

                                </ul>
                            </div><!-- End Vision Content -->
                        </div>
                    </div><!-- End Vision Card -->

                    <!-- গ. কুইক অ্যাকশন জয়েনিং বাটন -->
                    <div class="text-center mt-5">
                        <a href="{{ url('/application4join') }}" class="btn btn-primary rounded-pill px-5 py-2.5 fw-bold shadow-sm" style="background: linear-gradient(135deg, #1A237E 0%, #0056b3 100%); border: none;">
                            <i class="bi bi-person-plus-fill me-1"></i> সোসাইটির সদস্য হোন
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

</main>
@endsection
