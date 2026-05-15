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
              
                <!-- Left Image Side -->
                <div class="col-lg-6 cta-image-side d-none d-lg-block">
                    <div class="image-overlay"></div>
                </div>

                <!-- Right Content Side -->
                <div class="col-lg-6 cta-content-side d-flex align-items-center">
                    <div class="content-wrapper p-4 p-md-5">
                        <span class="est-tag">ESTABLISHED 2024</span>
                        <h2 class="section-title">Welcome to Nurses Health Care Society - Bangladesh</h2>
                        
                        <div class="main-description">
                            <p style="text-align: justify;">The mission and vision of a nurses health care society insurance typically focus on providing comprehensive and accessible healthcare coverage tailored to the unique needs of nurses.</p>
                        </div>

                        <div class="goals-container mt-4">
                            <div class="goal-item">
                                <h6>MISSION</h6>
                                <p style="text-align: justify;">To empower nurses by offering affordable, reliable, and specialized health insurance solutions that prioritize their well-being and professional needs.</p>
                            </div>
                            <div class="goal-item">
                                <h6>VISION</h6>
                                <p style="text-align: justify;">To be the leading provider of health insurance for nurses, recognized for our commitment to exceptional service, innovative healthcare solutions, and advocacy for nursing professionals nationwide.</p>
                            </div>
                        </div>

                        <p class="final-note">Such a company would likely aim to enhance the health and quality of life of nurses through targeted insurance plans, support programs, and advocacy initiatives tailored to the nursing community.</p>

                        <!-- Founder Section -->
                        <div class="founder-badge mt-5">
                            <div class="sign-box">
                                <img src="{{ asset('frontend/assets/img/sign.png') }}" alt="Signature">
                                <br>
                                <span class="name">Razib Hossain</span><br>
                                <span class="title">Secretary General & Founder</span>
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
