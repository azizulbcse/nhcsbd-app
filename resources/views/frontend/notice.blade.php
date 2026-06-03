@extends('layouts.frontend')

@section('title', 'Official Notice Board | Nurses Health Care Society Bangladesh')

@section('content')
<main class="main">

    <!-- ========================================== -->
    <!-- ১. প্রিমিয়াম গ্রাডিয়েন্ট পেজ টাইটেল হেডার সেকশন -->
    <!-- ========================================== -->
    <div class="page-title dark-background" style="background: linear-gradient(135deg, #1A237E 0%, #0056b3 100%); padding: 60px 0; color: #fff;">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0 fw-bold"><i class="bi bi-megaphone-fill me-2"></i>Notice Board</h1>
        <nav class="breadcrumbs">
          <ol class="breadcrumb mb-0" style="background: transparent;">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none"><i class="bi bi-house-door-fill"></i> Home</a></li>
            <li class="breadcrumb-item active text-white" aria-current="page">Notice</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- ========================================== -->
    <!-- ২. মেইন নোটিশ বোর্ড ডাটা লিস্ট সেকশন -->
    <!-- ========================================== -->
    <div class="container my-5" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3 class="text-center mb-5 fw-bold" style="color: #1A237E;"><i class="bi bi-bell-fill text-danger me-2 animate-bounce"></i> অফিসিয়াল নোটিশ বোর্ড</h3>

                <div class="list-group">
                    <!-- লারাভেল ব্লেড লুপ দিয়ে ডাইনামিক ডাটা রেন্ডার (নতুন notices টেবিল স্ট্রাকচার অনুযায়ী) -->
                    @forelse($notices as $notice)
                        <div class="list-group-item notice-card mb-4 p-4 shadow-sm border-0 rounded-3 position-relative overflow-hidden">
                            <!-- স্টাইলিশ সাইড ব্র্যান্ড গ্রিন বর্ডার -->
                            <div class="position-absolute top-0 start-0 h-100" style="width: 5px; background-color: #05B262;"></div>

                            <div class="row align-items-center">
                                <!-- তারিখ এবং আইকন সেকশন (কম্পিউটার স্ক্রিনের জন্য স্মার্ট বক্স) -->
                                <div class="col-md-2 text-center border-end d-none d-md-block">
                                    <div class="date-box">
                                        <h3 class="fw-bold mb-0" style="color: #1A237E;">{{ date('d', strtotime($notice->notice_date)) }}</h3>
                                        <small class="text-uppercase text-muted fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">{{ date('M Y', strtotime($notice->notice_date)) }}</small>
                                    </div>
                                </div>

                                <!-- কন্টেন্ট বিবরণ সেকশন -->
                                <div class="col-sm-9 col-md-7 ps-md-4 text-start">
                                    <div class="d-flex align-items-center mb-2">
                                        @if($notice->noticeno)
                                            <span class="badge text-primary border border-primary-subtle me-2" style="background-color: #e7f1ff; font-size: 12px; border-radius: 6px; font-weight: 600;">
                                                # {{ $notice->noticeno }}
                                            </span>
                                        @endif
                                        <small class="text-muted d-md-none"><i class="bi bi-calendar3 me-1"></i> {{ date('d F, Y', strtotime($notice->notice_date)) }}</small>
                                    </div>
                                    
                                    <h5 class="fw-bold text-dark mb-2 notice-title" style="font-size: 17px; line-height: 1.4;">{{ $notice->title }}</h5>
                                    <p class="text-secondary mb-0 small line-clamp" style="text-align: justify; line-height: 1.6;">
                                        {!! nl2br(e($notice->content)) !!}
                                    </p>
                                </div>

                                <!-- ডাউনলোড বাটন সেকশন (ডান পাশ) -->
                                <div class="col-sm-3 col-md-3 text-sm-end mt-3 mt-sm-0">
                                                                                                        @if(!empty($notice->file_name))
                                    <!-- 🎯 পাথ ফিক্স: লাইভ হোস্টিং ডকুমেন্ট রুট অনুযায়ী 'nhcsbdapp/' কেটে দিয়ে পিউর আপলোড পাথে ম্যাপিং করা হলো -->
                                    <a href="{{ asset('uploads/notices/' . $notice->file_name) }}" target="_blank" rel="noopener" class="btn btn-outline-primary rounded-pill px-4 py-2 transition-all w-100 fw-semibold">
                                        <i class="bi bi-file-earmark-pdf-fill me-2"></i> ডাউনলোড/দেখা
                                    </a>
                                @else

    <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill w-100 fw-medium" style="font-size: 13px; border-color: #e2e8f0 !important;">
                                            <i class="bi bi-info-circle me-1"></i> শুধুমাত্র নোটিশ
                                        </span>
                                    @endif
                                </div>

                            </div><!-- End Row -->
                        </div><!-- End List Group Item -->
                    @empty
                        <!-- নোটিশ টেবিল সম্পূর্ণ খালি থাকলে এই স্মার্ট অ্যালার্টটি দেখাবে -->
                        <div class="alert alert-warning text-center border-0 shadow-sm p-4 w-100" style="border-radius: 12px; background-color: #fff3cd; color: #664d03;">
                            <i class="bi bi-exclamation-triangle-fill fs-4 d-block mb-2"></i>
                            বর্তমানে কোনো সক্রিয় নোটিশ পাওয়া যায়নি।
                        </div>
                    @endforelse
                </div>

                <!-- ৩. লারাভেলের বিল্ট-ইন বুটস্ট্র্যাপ পেজিনেটর লিংক উইথ কাস্টম স্মার্ট ওভাররাইড ক্লাস -->
                <div class="mt-5 d-flex justify-content-center smart-pagination-wrapper">
                    {{ $notices->links() }}
                </div>
            </div>
        </div>
    </div>

</main>

<!-- ========================================== -->
<!-- ৪. হোভার অ্যানিমেশন এবং স্মার্ট পেজিনেশন সিএসএস -->
<!-- ========================================== -->
<style>
.notice-card {
    transition: all 0.3s ease;
    background: #fff;
}
.notice-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.06) !important;
}
.notice-title {
    transition: color 0.2s ease;
}
.notice-card:hover .notice-title {
    color: #1A237E !important;
}
.transition-all {
    transition: all 0.2s ease-in-out;
    border-color: #1A237E !important;
    color: #1A237E !important;
}
.transition-all:hover {
    background-color: #1A237E !important;
    color: #fff !important;
}
.line-clamp {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-3px); }
}
.animate-bounce {
    animation: bounce 2s infinite;
}

/* 🎯 লারাভেল বুটস্ট্র্যাপ পেজিনেশনের টেক্সট ও এরর ক্লিয়ারেন্স সহ প্রিমিয়াম গোল বাটন ইউআই */
.smart-pagination-wrapper nav .flex.justify-between.flex-1 {
    display: none !important; /* মোবাইলের ডিফল্ট ডামি টেক্সট ব্লক হাইড করা হলো */
}
.smart-pagination-wrapper nav div:first-child p.text-sm {
    display: none !important; /* 'Showing 1 to 10...' টেক্সট ব্লক চিরতরে উধাও করা হলো */
}
.smart-pagination-wrapper nav div:last-child,
.smart-pagination-wrapper .pagination {
    display: flex !important;
    justify-content: center !important;
    width: 100% !important;
    gap: 8px !important;
    margin-bottom: 0 !important;
    padding-left: 0 !important;
    list-style: none !important;
}
.smart-pagination-wrapper .page-item .page-link {
    border-radius: 50% !important; /* বাটনগুলোকে শতভাগ নিখুঁত গোল করার ট্রিকস */
    width: 42px !important;
    height: 42px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-weight: 700 !important;
    font-size: 15px !important;
    color: #1A237E !important;
    border: 1px solid #dee2e6 !important;
    background-color: #ffffff !important;
    transition: all 0.2s ease-in-out;
    text-decoration: none !important;
}
.smart-pagination-wrapper .page-item.active .page-link,
.smart-pagination-wrapper .page-item .page-link:hover {
    background-color: #1A237E !important;
    border-color: #1A237E !important;
    color: #ffffff !important;
}
.smart-pagination-wrapper .page-item.disabled .page-link {
    color: #6c757d !important;
    background-color: #f8f9fa !important;
    border-color: #dee2e6 !important;
    opacity: 0.6;
}
</style>
@endsection
