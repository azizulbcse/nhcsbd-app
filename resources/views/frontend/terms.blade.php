@extends('layouts.frontend')

@section('title', 'Terms & Conditions | Nurses Health Care Society Bangladesh')

@section('content')
<main class="main">

    <!-- ========================================== -->
    <!-- ১. প্রিমিয়াম গ্রাডিয়েন্ট পেজ টাইটেল হেডার সেকশন -->
    <!-- ========================================== -->
    <div class="page-title dark-background" style="background: linear-gradient(135deg, #1A237E 0%, #0056b3 100%); padding: 60px 0; color: #fff;">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0 fw-bold">
                <i class="bi bi-file-earmark-text me-2"></i>Terms & Conditions
            </h1>

            <nav class="breadcrumbs">
                <ol class="breadcrumb mb-0" style="background: transparent;">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}" class="text-white-50 text-decoration-none">
                            <i class="bi bi-house-door-fill"></i> Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Terms & Conditions</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- ========================================== -->
    <!-- ২. শর্তাবলী কন্টেন্ট সেকশন -->
    <!-- ========================================== -->
    <section class="terms-section py-5" style="background-color: #f8f9fa;">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    
                    <div class="card border-0 shadow-sm p-4 p-md-5" style="border-radius: 15px; background: #ffffff; border-top: 5px solid #05B262;">
                        <div class="text-start">
                            <h3 class="fw-bold mb-4" style="color: #1A237E;">
                                <i class="bi bi-shield-check text-success me-2"></i>ব্যবহারের শর্তাবলী ও নীতিমালা
                            </h3>
                            
                            <p class="text-muted mb-4" style="font-size: 14px;"><i class="bi bi-clock-history"></i> সর্বশেষ আপডেট: {{ date('F d, Y') }}</p>
                            
                            <!-- প্রফেশনাল মডার্ন লিস্ট এবং ডাটাবেজ প্রটেকশন ভিউ -->
                            <div class="terms-content" style="line-height: 1.8; color: #4a5568;">
                                <ul class="list-unstyled">
                                    
                                    <li class="mb-3 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">১)</span>
                                        <span class="fw-medium">“নার্সেস হেলথ কেয়ার সোসাইটি” একটি (নিজস্ব) সেবামূলক সোসাইটি।</span>
                                    </li>

                                    <li class="mb-3 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">২)</span>
                                        <span class="fw-medium">প্রতিষ্ঠা কমিটির পদ-পদবী ৩ (তিন) বছর বলবৎ থাকিবে এবং পরবর্তীতে প্রতি ০১ (এক) বছর অন্তর অন্তর (পরিচালন দক্ষতা/যোগ্যতার ভিত্তিতে) সকল সদস্যের স্বতঃস্ফূর্ত অংশগ্রহণের (নির্বাচনের) মাধ্যমে নির্ধারণ করা হইবে।</span>
                                    </li>

                                    <li class="mb-3 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">৩)</span>
                                        <span class="fw-medium">বার্ষিক সাধারণ সম্মেলনে কমিটি হস্তান্তরের পূর্বে বলবৎ কমিটিকে তাদের পূর্ণাঙ্গ কার্যক্রম উপস্থাপন করিবে।</span>
                                    </li>

                                    <li class="mb-3 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">৪)</span>
                                        <span class="fw-medium">সোসাইটি সকল সদস্যের পরিচালনা/নীতি-নির্ধারনী/মূল কমিটির প্রতি আস্থা ও বিশ্বাস থাকা বাঞ্চনীয়।</span>
                                    </li>

                                    <li class="mb-3 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">৫)</span>
                                        <span class="fw-medium">সোসাইটির অর্থ সংরক্ষণ এবং উত্তোলনের জন্য সোসাইটির সদস্যবৃন্দের সমন্বয়ে গঠিত যৌথ ব্যাংক একাউন্ট ব্যবহার করা হইবে এবং সংরক্ষিত অর্থের মুনাফা সহায়তা তহবিল এ সংরক্ষণ থাকিবে। যাহা অসহায় হতদরিদ্র পুনর্বাসন/জনকল্যাণমূলক কাজে ব্যয় করা হইবে।</span>
                                    </li>
                                    <li class="mb-3 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">৬)</span>
                                        <span class="fw-medium">সোসাইটি সদস্য প্রাপ্ত হওয়ার পর ১০ (দশ) বছরের মধ্যে সোসাইটির সদস্য পদ বাতিল করতে পারিবে না।</span>
                                    </li>

                                    <li class="mb-3 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">৭)</span>
                                        <span class="fw-medium">সোসাইটির সদস্য ১০ (দশ) বছর পূর্ণ হইবার পূর্বে সদস্য পদ বাতিল করিতে চাহিলে কার্যনির্বাহী কমিটি প্রধানের বরাবর আবেদন করিতে হইবে এবং কার্যনির্বাহী কমিটির সিদ্ধান্ত মোতাবেক ০৫% কর্তন সাপেক্ষে সদস্যপদ বাতিল করিবেন। সদস্য পদ বাতিল হওয়ার ১৫ (পনের) কর্মদিবসের মধ্যে সদস্যের টাকা পরিশোধ করা হইবে।</span>
                                    </li>

                                    <li class="mb-3 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">৮)</span>
                                        <span class="fw-medium">সোসাইটি সদস্য ও তার পরিবারের (স্বামী/স্ত্রী/ছেলে/মেয়ে/মা/বাবা) স্বাস্থ্য সেবা নিশ্চিতকরণের লক্ষ্যে অত্র সোসাইটি হতে একটি নির্দিষ্ট পরিমান আর্থিক সহায়তা মুনাফাবিহীন প্রদান করা হইবে যা নিদির্ষ্ট সময়ের মধ্যে (কিস্তি) এর মাধ্যমে পরিশোধ করিতে হইবে।</span>
                                    </li>

                                    <li class="mb-3 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">৯)</span>
                                        <span class="fw-medium">সোসাইটি সম্পূর্ণ সুদ মুক্তভাবে পরিচালিত হওয়ায় চিকিৎসা বাবদ গ্রহণকৃত আর্থিক সহায়তার জন্য সদস্যের নিকট হইতে কোন প্রকার মুনাফা গ্রহণ করা হইবে না।</span>
                                    </li>

                                    <li class="mb-3 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">১০)</span>
                                        <span class="fw-medium">সোসাইটির কোন সদস্য মৃত/দেওলিয়া/পাগল হইলে সেক্ষেত্রে ঐ সদস্যের নমিনিকে কমিটির সিদ্ধান্ত মোতাবেক সম্পুর্ণ টাকা বুঝিয়ে দেওয়া হইবে।</span>
                                    </li>

                                    <li class="mb-3 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">১১)</span>
                                        <span class="fw-medium">সোসাইটি কতৃর্ক ধর্মীয় অনুভুতিতে আঘাত হানে এ ধরনের কোন কাজ/সিদ্ধান্ত/কার্যক্রম সংঘঠিত করা হইবে না।</span>
                                    </li>
                                    <li class="mb-3 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">১২)</span>
                                        <span class="fw-medium">আবেদনকারীর বয়স অনধিক ৪০ (চল্লিশ) বছর।</span>
                                    </li>

                                    <li class="mb-3 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">১৩)</span>
                                        <span class="fw-medium">প্রাথমিক ভাবে ১০০০/- (এক হাজার) টাকা করে মাসিক চাঁদা প্রদান করিতে হইবে।</span>
                                    </li>

                                    <li class="mb-3 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">১৪)</span>
                                        <span class="fw-medium">সোসাইটির স্বার্থকে সর্বোচ্চ অগ্রাধিকার দিয়ে পরিচালনা/নীতি-নির্ধারনী/সংশ্লিষ্ট কমিটির সকল সিদ্ধান্ত গৃহীত হইবে।</span>
                                    </li>

                                    <li class="mb-3 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">১৫)</span>
                                        <span class="fw-medium">সোসাইটির সকল সদস্যবৃন্দ একে অন্যের প্রতি সৌজন্যমূলক ও সৌহার্দপূর্ণ আচরণ করিতে বাধ্য থাকিবেন। সর্বাবস্থায় সোসাইটির শৃঙ্খলা বজায় রাখার চেষ্টা করিবেন।</span>
                                    </li>

                                    <li class="mb-3 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">১৬)</span>
                                        <span class="fw-medium">সোসাইটিতে কোন সমস্যার উদ্ভব হলে সম্মিলিতভাবে তা সমাধানের চেষ্টা করতে হবে এবং কোন অবস্থাতেই সমালোচনা/ দোষারোপ, দায় এড়ানোর প্রবণতা পরিহার করতে হবে। কোন অবস্থাতেই সোসাইটির ভাবমূর্তি নষ্ট/ক্ষুণ্ন করা যাইবেনা।</span>
                                    </li>

                                    <li class="mb-3 d-flex align-items-start gap-2" style="text-align: justify;">
                                        <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1" style="font-size: 12px; font-weight: bold; min-width: 45px;">১৭)</span>
                                        <span class="fw-medium">যে কোন জরুরী परिस्थितिতে/বিষয়ে সোসাইটি পরিচালনা কমিটি সোসাইটির স্বার্থ রক্ষার্থে যেকোন সিদ্ধান্ত গ্রহণ করার ইখতিয়ার বহন করিবেন।</span>
                                    </li>

                                </ul>
                            </div><!-- End Terms Content -->

                            <!-- সমাপনী মন্তব্য ও সাধারণ আলোচনা নির্দেশিকা -->
                            <div class="alert alert-info border-0 shadow-sm p-3 mt-4" style="border-radius: 10px; background-color: rgba(26, 35, 126, 0.04); color: #2d3748; line-height: 1.6; text-align: justify; font-size: 14px;">
                                <i class="bi bi-info-circle-fill text-primary me-2"></i>
                                নীতিসমূহ অত্র সোসাইটির সকল সদস্যের উপস্থিতি ও সদয় সম্মতিক্রমে গৃহীত হয়েছে। উপরিউক্ত নীতিমালার বহির্ভূত কোন সমস্যা উদ্ভব হলে তা কার্যনির্বাহী কমিটি অথবা সকল সদস্যগণের মতামত/পরামর্শ/আলোচনার মাধ্যমে নিষ্পত্তি করা হইবে।
                            </div>

                            <!-- বিশেষ দ্রষ্টব্য নোটিশ ব্যাজ -->
                            <div class="p-3 my-3 rounded-3" style="background-color: #fff8e1; border: 1px dashed #ffb300; font-size: 14px; text-align: justify;">
                                <span class="fw-bold text-warning-dark"><i class="bi bi-exclamation-triangle-fill"></i> বিশেষ দ্রষ্টব্যঃ</span> 
                                <span class="text-secondary fw-medium">উপরিউক্ত নীতিমালার সংযোজন/বিয়োজন/সংশোধন/পরিমার্জন অত্র সোসাইটির নিকট সংরক্ষিত।</span>
                            </div>

                            <!-- মেম্বার রেডি অঙ্গীকারনামা কার্ড -->
                            <div class="p-4 rounded-3 text-white mt-4" style="background: linear-gradient(135deg, #1A237E 0%, #0d1b40 100%); border-radius: 12px; text-align: justify;">
                                <h5 class="fw-bold mb-0" style="line-height: 1.6; font-size: 16px; color: #fff;">
                                    <i class="bi bi-vector-pen text-warning me-2"></i> এতদ্বার্থে আমি এই মর্মে অঙ্গীকার করিতেছি যে, নার্সেস হেলথ কেয়ার সোসাইটির সকল নিয়ম কানুন/বিধি, শর্তসমুহ পড়িয়া ও মর্ম অনুধাবন করিয়া স্বেচ্ছায়, স্বজ্ঞানে, অন্যের বিনা প্ররোচনায় অত্র সোসাইটির সদস্য হওয়ার জন্য আবেদন করিতেছি।
                                </h5>
                            </div>

                            <!-- অ্যাকশন বাটন সেকশন -->
                            <div class="text-center mt-5">
                                <a href="{{ url('/application4join') }}" class="btn btn-primary rounded-pill px-5 py-2.5 fw-bold shadow-sm" style="background: linear-gradient(135deg, #05B262 0%, #007a43 100%); border: none;">
                                    <i class="bi bi-file-earmark-medical-fill me-1"></i> সম্মতি দিয়ে আবেদনে এগিয়ে যান
                                </a>
                            </div>

                        </div>
                    </div><!-- End Card -->

                </div>
            </div>
        </div>
    </section>

</main>
@endsection
