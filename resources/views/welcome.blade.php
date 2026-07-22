@extends('layouts.frontend')

@section('title', 'Home | Nurses Health Care Society Bangladesh')

@section('content')
<main class="main">
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
        <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            
            <!-- Carousel Item 1 -->
            <div class="carousel-item active">
                <img src="{{ asset('frontend/assets/img/hero-carousel/hero-carousel-1.jpg') }}" alt="Nurses Health Care Society Bangladesh" title="Nurses Health Care Society Bangladesh">
            </div>
            
            <!-- Carousel Item 2 -->
            <div class="carousel-item">
                <img src="{{ asset('frontend/assets/img/hero-carousel/hero-carousel-2.jpg') }}" alt="Nurses Health Care Society Bangladesh" title="Nurses Health Care Society Bangladesh">
            </div>
            
            <!-- Carousel Item 3 -->
            <div class="carousel-item">
                <img src="{{ asset('frontend/assets/img/hero-carousel/hero-carousel-3.jpg') }}" alt="Nurses Health Care Society Bangladesh" title="Nurses Health Care Society Bangladesh">
            </div>

            <!-- Carousel Controls -->
            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>
            <ol class="carousel-indicators"></ol>
        </div>
    </section>
    <!-- /Hero Section -->
    
    <br>

    <!-- Call To Action Section -->
    <section id="call-to-action" class="cta-modern section py-0">
        <div class="container-fluid p-0">
            <div class="row g-0">
              
                <!-- Left Image Side (100% Unchanged UI Class) -->
                <div class="col-lg-6 cta-image-side d-none d-lg-block">
                    <div class="image-overlay"></div>
                </div>

                <!-- Right Content Side -->
                <div class="col-lg-6 cta-content-side d-flex align-items-center" style="background-color: #ffffff;">
                    <div class="content-wrapper p-4 p-md-5" style="width: 100%;">
                        <!-- Smart & Premium Badge -->
                        <span class="est-tag" style="background: rgba(0, 123, 255, 0.08); color: #007bff; padding: 6px 16px; border-radius: 50px; font-weight: 600; font-size: 0.85rem; letter-spacing: 1px; display: inline-block; margin-bottom: 20px; border: 1px solid rgba(0, 123, 255, 0.15);">ESTABLISHED 2024</span>
                        
                        <!-- Sharp & Bold Professional Title -->
                        <h2 class="section-title" style="font-weight: 800; font-size: 2.3rem; color: #111111; line-height: 1.3; margin-bottom: 20px; letter-spacing: -0.5px;">Welcome to Nurses Health Care Society - Bangladesh</h2>
                        
                        <div class="main-description" style="margin-bottom: 25px;">
                            <p style="text-align: justify; color: #4a5568; font-size: 1.05rem; line-height: 1.75;">The mission and vision of a nurses health care society insurance typically focus on providing comprehensive and accessible healthcare coverage tailored to the unique needs of nurses.</p>
                        </div>

                        <!-- Modern Border-Styled Goals Container -->
                        <div class="goals-container mt-4" style="display: flex; flex-direction: column; gap: 20px;">
                            <div class="goal-item" style="border-left: 4px solid #007bff; padding-left: 20px; margin-bottom: 5px;">
                                <h6 style="font-weight: 700; color: #007bff; letter-spacing: 0.5px; font-size: 1rem; text-transform: uppercase; margin-bottom: 8px;">MISSION</h6>
                                <p style="text-align: justify; color: #4a5568; font-size: 0.95rem; line-height: 1.65; margin: 0;">To empower nurses by offering affordable, reliable, and specialized health insurance solutions that prioritize their well-being and professional needs.</p>
                            </div>
                            <div class="goal-item" style="border-left: 4px solid #28a745; padding-left: 20px; margin-bottom: 5px;">
                                <h6 style="font-weight: 700; color: #28a745; letter-spacing: 0.5px; font-size: 1rem; text-transform: uppercase; margin-bottom: 8px;">VISION</h6>
                                <p style="text-align: justify; color: #4a5568; font-size: 0.95rem; line-height: 1.65; margin: 0;">To be the leading provider of health insurance for nurses, recognized for our commitment to exceptional service, innovative healthcare solutions, and advocacy for nursing professionals nationwide.</p>
                            </div>
                        </div>

                        <p class="final-note" style="text-align: justify; color: #718096; font-size: 0.95rem; line-height: 1.7; font-style: italic; margin-top: 25px; padding-top: 15px; border-top: 1px dashed #e2e8f0;">Such a company would likely aim to enhance the health and quality of life of nurses through targeted insurance plans, support programs, and advocacy initiatives tailored to the nursing community.</p>

                        <!-- Founder Section (Smart & Corporate Signature Look) -->
                        <div class="founder-badge mt-5">
                            <div class="sign-box" style="border-left: 3px solid #111111; padding-left: 15px; display: inline-block;">
                                <img src="{{ asset('frontend/assets/img/sign.png') }}" alt="Signature" style="max-height: 55px; width: auto; filter: multiply(1.1); margin-bottom: 6px;">
                                <br>
                                <span class="name" style="font-weight: 700; font-size: 1.15rem; color: #111111; letter-spacing: 0.3px;">Razib Hossain</span><br>
                                <span class="title" style="font-size: 0.85rem; color: #718096; text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px;">Secretary General & Founder</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- /Call To Action Section -->
</main>
@endsection
