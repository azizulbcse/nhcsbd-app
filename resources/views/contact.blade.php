@extends('layouts.frontend')

@section('title', 'Contact | Nurses Health Care Society Bangladesh')

@section('content')
<main class="main">

    <!-- Page Title Section -->
    <div class="page-title dark-background" style="background: linear-gradient(135deg, #1A237E 0%, #0056b3 100%); padding: 60px 0; color: #fff;">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0 fw-bold"><i class="bi bi-envelope-open-fill me-2"></i>Contact Us</h1>
        <nav class="breadcrumbs">
          <ol class="breadcrumb mb-0" style="background: transparent;">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none"><i class="bi bi-house-door-fill"></i> Home</a></li>
            <li class="breadcrumb-item active text-white" aria-current="page">Contact</li>
          </ol>
        </nav>
      </div>
    </div>

    <!-- Contact Section -->
    <section id="contact" class="contact section py-5" style="background-color: #f8f9fa;">
      <div class="mb-5">
        <!-- Updated Google Map for Sher-e-Bangla Nagar, Dhaka -->
        <iframe 
          style="width: 100%; height: 400px; border:0;" 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29210.644791806168!2d90.35246876384763!3d23.771239033963845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c753368740ed%3A0x427ec30e5841ecfc!2sSher-E-Bangla%20Nagar%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1771681840390!5m2!1sen!2sbd" 
          allowfullscreen="" 
          loading="lazy" 
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div><!-- End Google Maps -->

      <div class="container" data-aos="fade-up">
        <div class="row g-4 g-lg-5">

          <!-- বাম পাশে স্মার্ট কন্টাক্ট কার্ড এবং আইকনস -->
          <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 15px; background: #ffffff;">
              <h3 class="fw-bold" style="color: #1A237E; margin-bottom: 5px;">Get in touch</h3>
              <p class="text-muted mb-4">Send Your Complain or Message</p>

              <!-- Location Item -->
              <div class="d-flex align-items-center mb-4 p-3 rounded-3" style="background: rgba(26, 35, 126, 0.03); border-left: 4px solid #1A237E;">
                <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background: #1A237E; color: #fff; box-shadow: 0 4px 10px rgba(26, 35, 126, 0.2);">
                    <i class="bi bi-geo-alt-fill fs-5"></i>
                </div>
                <div class="ms-3">
                  <h5 class="fw-bold mb-1" style="color: #2d3748; font-size: 15px;">Location:</h5>
                  <p class="text-muted mb-0" style="font-size: 14px;">Sher e Bangla Nagar, Dhaka</p>
                </div>
              </div>

              <!-- Email Item -->
              <div class="d-flex align-items-center mb-4 p-3 rounded-3" style="background: rgba(5, 178, 98, 0.03); border-left: 4px solid #05B262;">
                <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background: #05B262; color: #fff; box-shadow: 0 4px 10px rgba(5, 178, 98, 0.2);">
                    <i class="bi bi-envelope-open-fill fs-5"></i>
                </div>
                <div class="ms-3">
                  <h5 class="fw-bold mb-1" style="color: #2d3748; font-size: 15px;">Email:</h5>
                  <p class="text-muted mb-0" style="font-size: 14px;"><a href="mailto:nhcs.org.bd@gmail.com" class="text-decoration-none text-muted">nhcs.org.bd@gmail.com</a></p>
                </div>
              </div>

              <!-- Phone Item -->
              <div class="d-flex align-items-center p-3 rounded-3" style="background: rgba(0, 210, 255, 0.03); border-left: 4px solid #00d2ff;">
                <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background: #00d2ff; color: #fff; box-shadow: 0 4px 10px rgba(0, 210, 255, 0.2);">
                    <i class="bi bi-telephone-fill fs-5"></i>
                </div>
                <div class="ms-3">
                  <h5 class="fw-bold mb-1" style="color: #2d3748; font-size: 15px;">Call Support:</h5>
                  <p class="text-muted mb-0" style="font-size: 13px; font-weight: 500;">01717288965, 01689597474</p>
                </div>
              </div>
            </div>
          </div>

          <!-- ডান পাশে ইনপুট গ্রুপ আইকন সমৃদ্ধ ফর্ম -->
          <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 p-md-5 h-100" style="border-radius: 15px; background: #ffffff;">
              <h4 class="fw-bold mb-4" style="color: #05B262;"><i class="bi bi-chat-left-text-fill me-2"></i>Send Your Complain / Message</h4>
              
              <!-- মেসেজ ডিসপ্লে এরিয়া -->
              <div class="mb-4">
                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm d-flex align-items-center" style="background: #05B262; color: #fff; border-radius: 10px;">
                        <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger border-0 shadow-sm" style="background: #e74c3c; color: #fff; border-radius: 10px;">
                        <ul class="mb-0" style="list-style: none; padding: 0;">
                            @foreach($errors->all() as $error)
                                <li><i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
              </div>

              <!-- যদি validate.js এর সমস্যা হয়, তবে শুধু নিচের ক্লাসটি পরিবর্তন করুন -->
<form action="{{ route('contact.send') }}" method="post" role="form" class="row g-3">
  @csrf 

                <div class="row g-4">
                  <!-- Name Input With Icon -->
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-text bg-light border-end-0" style="border-radius: 8px 0 0 8px; color: #1A237E;"><i class="bi bi-person-fill"></i></span>
                      <input type="text" name="name" class="form-control bg-light border-start-0 style-control" id="name" placeholder="Your Name" value="{{ old('name') }}" required style="height: 48px; border-radius: 0 8px 8px 0; font-size: 15px;">
                    </div>
                  </div>

                  <!-- Email Input With Icon -->
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-text bg-light border-end-0" style="border-radius: 8px 0 0 8px; color: #1A237E;"><i class="bi bi-envelope-fill"></i></span>
                      <input type="email" class="form-control bg-light border-start-0" name="email" id="email" placeholder="Your Email" value="{{ old('email') }}" required style="height: 48px; border-radius: 0 8px 8px 0; font-size: 15px;">
                    </div>
                  </div>

                  <!-- Subject Input With Icon -->
                  <div class="col-12">
                    <div class="input-group">
                      <span class="input-group-text bg-light border-end-0" style="border-radius: 8px 0 0 8px; color: #1A237E;"><i class="bi bi-bookmark-star-fill"></i></span>
                      <input type="text" class="form-control bg-light border-start-0" name="subject" id="subject" placeholder="Subject" value="{{ old('subject') }}" required style="height: 48px; border-radius: 0 8px 8px 0; font-size: 15px;">
                    </div>
                  </div>

                  <!-- Message Area With Icon -->
                  <div class="col-12">
                    <div class="input-group align-items-start">
                      <span class="input-group-text bg-light border-end-0 py-3" style="border-radius: 8px 0 0 8px; color: #1A237E;"><i class="bi bi-pencil-square"></i></span>
                      <textarea class="form-control bg-light border-start-0" name="message" rows="5" placeholder="Write your message or complain here..." required style="border-radius: 0 8px 8px 0; font-size: 15px; padding-top: 12px;">{{ old('message') }}</textarea>
                    </div>
                  </div>
                </div>
                
                <!-- প্রফেশনাল বাটন উইথ আইকন -->
                <div class="text-center mt-4">
                  <button type="submit" class="btn btn-primary shadow-sm" style="background: linear-gradient(135deg, #1A237E 0%, #0056b3 100%); border: none; padding: 12px 40px; border-radius: 8px; font-weight: 600; transition: 0.3s;">
                    <i class="bi bi-send-fill me-2"></i> Send Message
                  </button>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </section>

</main>
@endsection
