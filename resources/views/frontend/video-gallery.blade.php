@extends('layouts.frontend')

@section('title', 'Video Gallery | Nurses Health Care Society Bangladesh')

@section('content')
<main class="main">

    <!-- ========================================== -->
    <!-- ১. প্রিমিয়াম গ্রাডিয়েন্ট পেজ টাইটেল হেডার সেকশন -->
    <!-- ========================================== -->
    <div class="page-title dark-background" style="background: linear-gradient(135deg, #1A237E 0%, #0056b3 100%); padding: 50px 0; color: #fff;">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0 fw-bold"><i class="bi bi-play-btn-fill me-2"></i>Video Gallery</h1>
        <nav class="breadcrumbs">
          <ol class="breadcrumb mb-0" style="background: transparent;">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none"><i class="bi bi-house-door-fill"></i> Home</a></li>
            <li class="breadcrumb-item active text-white" aria-current="page">Video Gallery</li>
          </ol>
        </nav>
      </div>
    </div>

    <!-- ========================================== -->
    <!-- ২. ডাইনামিক ভিডিও গ্যালারি গ্রিড সেকশন -->
    <!-- ========================================== -->
    <section id="video-gallery" class="video-gallery section py-5" style="background-color: #f8f9fa;">
        <div class="container" data-aos="fade-up">
            <div class="row g-4">

                <!-- ডাটাবেজ থেকে আসা ভিডিওর ডাইনামিক লুপ -->
                @forelse($videos as $video)
                    <div class="col-xl-4 col-md-6">
                        <div class="card video-card border-0 shadow-sm h-100 overflow-hidden" style="border-radius: 12px; background: #fff;">
                            
                            <!-- হাইব্রিড ভিডিও প্লেয়ার (ইউটিউব লিংক এবং এমপিফোর ফাইল দুটোই সাপোর্ট করবে) -->
                            <div class="video-wrapper bg-dark position-relative" style="height: 220px;">
                                @if(filter_var($video->file_name, FILTER_VALIDATE_URL))
                                    <!-- যদি অ্যাডমিন সরাসরি ইউটিউব বা অন্য কোনো লাইভ ভিডিও ইউআরএল লিংক দেয় -->
                                    <iframe src="{{ $video->file_name }}" class="w-100 h-100" style="border: none;" allowfullscreen></iframe>
                                @else
                                    <!-- যদি অ্যাডমিন ডিরেক্ট ভিডিও ফাইল আপলোড করে (preload="none" এর কারণে পেজ ফাস্ট লোড হবে) -->
                                    <video controls preload="none" poster="{{ asset('frontend/assets/img/video-placeholder.jpg') }}" class="w-100 h-100" style="object-fit: cover;">
                                        <source src="{{ asset('uploads/video/' . $video->file_name) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif
                            </div>

                            <!-- ভিডিওর শিরোনাম -->
                            <div class="card-body p-3">
                                <h6 class="fw-bold text-dark mb-1" style="font-size: 15px; line-height: 1.4; text-align: justify;">
                                    <i class="bi bi-camera-video-fill text-danger me-1"></i> {{ $video->title }}
                                </h6>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- ভিডিও খালি থাকলে স্মার্ট অ্যালার্ট -->
                    <div class="col-12 text-center py-5">
                        <div class="alert alert-warning border-0 shadow-sm d-inline-block p-4" style="border-radius: 10px; background-color: #fff3cd; color: #664d03;">
                            <i class="bi bi-collection-play fs-2 d-block mb-2 text-warning"></i>
                            বর্তমানে কোনো ভিডিও গ্যালারিতে পাওয়া যায়নি।
                        </div>
                    </div>
                @endforelse

            </div>

            <!-- লারাভেলের বিল্ট-ইন বুটস্ট্র্যাপ পেজিনেটর বাটন লিংক -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $videos->links() }}
            </div>

        </div>
    </section>

</main>

<!-- ========================================== -->
<!-- ৩. হোভার ও ট্রানজিশন সিএসএস স্টাইলিং -->
<!-- ========================================== -->
<style>
.video-card {
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
}
.video-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.08) !important;
}
.video-wrapper video, .video-wrapper iframe {
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    outline: none;
}
</style>
@endsection
