@extends('layouts.frontend')

@section('title', 'Photo Gallery | Nurses Health Care Society Bangladesh')

@section('content')
<main class="main">

    <!-- Page Title Header (লাইটওয়েট গ্রেডিয়েন্ট) -->
    <div class="page-title dark-background" style="background: linear-gradient(135deg, #1A237E 0%, #0056b3 100%); padding: 50px 0; color: #fff;">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0 fw-bold"><i class="bi bi-images me-2"></i>Photo Gallery</h1>
        <nav class="breadcrumbs">
          <ol class="breadcrumb mb-0" style="background: transparent;">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none"><i class="bi bi-house-door-fill"></i> Home</a></li>
            <li class="breadcrumb-item active text-white" aria-current="page">Photo Gallery</li>
          </ol>
        </nav>
      </div>
    </div>

    <!-- Gallery Grid Section -->
    <section id="gallery" class="gallery section py-5" style="background-color: #f8f9fa;">
        <div class="container" data-aos="fade-up">
            <div class="row g-4">

                <!-- ডাটাবেজ থেকে আসা ছবির আসল ডাইনামিক লুপ -->
                @forelse($photos as $photo)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="card gallery-item border-0 shadow-sm h-100 overflow-hidden">
                            <div class="gallery-img-container position-relative bg-light">
                                <!-- আপনার ডাটাবেজের কলাম এবং লাইভ-সার্ভার আপলোড ডিরেক্টরি অনুযায়ী পাথ সেটআপ -->
                                <img src="{{ asset('uploads/gallery/' . $photo->file_name) }}" 
                                     alt="{{ $photo->title }}" 
                                     class="img-fluid w-100 transition-transform" 
                                     loading="lazy" 
                                     decoding="async"
                                     onerror="this.src='https://placehold.co'">
                                <div class="gallery-overlay d-flex align-items-center justify-content-center">
                                    <a href="{{ asset('uploads/gallery/' . $photo->file_name) }}" class="glightbox preview-link text-white fs-4"><i class="bi bi-zoom-in"></i></a>
                                </div>
                            </div>
                            <div class="card-body p-3 text-center">
                                <h6 class="fw-bold text-dark mb-1" style="font-size: 14px; line-height: 1.4;">{{ $photo->title }}</h6>
                                @if($photo->upload_date)
                                    <small class="text-muted" style="font-size: 11px;"><i class="bi bi-calendar-event"></i> {{ date('d/m/Y', strtotime($photo->upload_date)) }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- গ্যালারিতে status = 2 ওয়ালা কোনো ছবি না থাকলে এই স্মার্ট অ্যালার্টটি দেখাবে -->
                    <div class="col-12 text-center py-5">
                        <div class="alert alert-warning border-0 shadow-sm d-inline-block p-4" style="border-radius: 10px; background-color: #fff3cd; color: #664d03;">
                            <i class="bi bi-image-alt fs-2 d-block mb-2 text-warning"></i>
                            বর্তমানে কোনো ছবি গ্যালারিতে পাওয়া যায়নি।
                        </div>
                    </div>
                @endforelse

            </div>

            <!-- লারাভেলের বিল্ট-ইন বুটস্ট্র্যাপ পেজিনেশন বাটন লিংক -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $photos->links() }}
            </div>

        </div>
    </section>

</main>

<style>
.gallery-item { border-radius: 12px; transition: all 0.3s ease; background: #fff; }
.gallery-item:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important; }
.gallery-img-container { overflow: hidden; height: 200px; }
.gallery-img-container img { transition: transform 0.5s ease; height: 100%; object-fit: cover; will-change: transform; }
.gallery-item:hover .gallery-img-container img { transform: scale(1.05); }
.gallery-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(26, 35, 126, 0.6); opacity: 0; transition: all 0.3s ease; }
.gallery-item:hover .gallery-overlay { opacity: 1; }
.preview-link { width: 45px; height: 45px; border: 2px solid #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: 0.3s; }
.preview-link:hover { background: #fff; color: #1A237E !important; }

/* আপনার স্টাইলের ভেতর এই অংশটুকু দেখতে পারেন (মোবাইল ফ্রেন্ডলি ওভারলে টাচ ফিক্স) */
.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(26, 35, 126, 0.6);
    opacity: 0;
    transition: opacity 0.3s ease; /* শুধুমাত্র অপাসিটি অ্যানিমেশন ফাস্ট লোডের জন্য */
    display: flex;
    align-items: center;
    justify-content: center;
}

</style>
@endsection
