@extends('layouts.frontend')

@section('title', 'Official Notice Board | Nurses Health Care Society Bangladesh')

@section('content')
<main class="main">

    <!-- Page Title (লারাভেল স্ট্যান্ডার্ড ও ডাইনামিক রাউট সহ) -->
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

    <!-- NOTICE BOARD SECTION -->
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

                                <!-- কন্টেন্ট সেকশন -->
                                <div class="col-sm-9 col-md-7 ps-md-4">
                                    <div class="d-flex align-items-center mb-2">
                                        @if($notice->notice_no)
                                            <span class="badge text-primary border border-primary-subtle me-2" style="background-color: #e7f1ff;">
                                                # {{ $notice->notice_no }}
                                            </span>
                                        @endif
                                        <small class="text-muted d-md-none"><i class="bi bi-calendar3 me-1"></i> {{ date('d F, Y', strtotime($notice->notice_date)) }}</small>
                                    </div>
                                    
                                    <h5 class="fw-bold text-dark mb-2 notice-title">{{ $notice->title }}</h5>
                                    <p class="text-secondary mb-0 small line-clamp">
                                        {!! nl2br(e($notice->content)) !!}
                                        {{-- e() ফাংশনটি টপ-ক্লাস XSS প্রোটেকশন নিশ্চিত করে --}}
                                    </p>
                                </div>

                                <!-- ডাউনলোড বাটন সেকশন -->
                                <div class="col-sm-3 col-md-3 text-end mt-3 mt-sm-0">
                                    @if(!empty($notice->file_name))
                                        <!-- ফাইলটি public/uploads/notices/ ফোল্ডারে থাকলে ডাউনলোড হবে -->
                                        <a href="{{ asset('uploads/notices/' . $notice->file_name) }}" target="_blank" rel="noopener" class="btn btn-outline-primary rounded-pill px-4 py-2 transition-all w-100 fw-semibold">
                                            <i class="bi bi-file-earmark-pdf-fill me-2"></i> ডাউনলোড/দেখা
                                        </a>
                                    @else
                                        <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill w-100" style="font-size: 13px;">ফাইল নেই</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- নোটিশ ফোল্ডার খালি থাকলে অ্যালার্ট -->
                        <div class="alert alert-warning text-center border-0 shadow-sm p-4" style="border-radius: 10px; background-color: #fff3cd; color: #664d03;">
                            <i class="bi bi-exclamation-triangle-fill fs-4 d-block mb-2"></i>
                            현재 কোনো সক্রিয় নোটিশ পাওয়া যায়নি।
                        </div>
                    @endforelse
                </div>

                <!-- লারাভেলের বিল্ট-ইন বুটস্ট্র্যাপ পেজিনেশন লিংক -->
                <div class="mt-4 d-flex justify-content-center">
                    {{ $notices->links() }}
                </div>
            </div>
        </div>
    </div>

</main>

<!-- স্মার্ট লুক এবং লাইন ক্ল্যাম্পিংয়ের জন্য সিএসএস (মাস্টার লেআউটের সাথে কনফ্লিক্ট এড়াতে অপ্টিমাইজড) -->
<style>
.notice-card {
    transition: all 0.3s ease;
    background: #fff;
}
.notice-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
}
.transition-all {
    transition: all 0.2s;
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
</style>
@endsection
