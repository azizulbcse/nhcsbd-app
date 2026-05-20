@extends('layouts.frontend')

@section('title', 'Contact | Nurses Health Care Society Bangladesh')

@section('content')
<main class="main">

    <!-- ========================================== -->
    <!-- ১. পেজ টাইটেল ও ব্রেডক্রাম্ব সেকশন -->
    <!-- ========================================== -->
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

    <!-- ========================================== -->
    <!-- ২. কন্টাক্ট মেইন সেকশন -->
    <!-- ========================================== -->
    <section id="contact" class="contact section py-5" style="background-color: #f8f9fa;">
      
      <!-- গুগল ম্যাপস -->
      <div class="mb-5">
        <iframe 
          style="width: 100%; height: 400px; border:0;" 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29210.644791806168!2d90.35246876384763!3d23.771239033963845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c753368740ed%3A0x427ec30e5841ecfc!2sSher-E-Bangla%20Nagar%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1771681840390!5m2!1sen!2sbd" 
          allowfullscreen="" 
          loading="lazy" 
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>

      <div class="container" data-aos="fade-up">
        <div class="row g-4 g-lg-5">

          <!-- বাম পাশে: কন্টাক্ট ইনফো কার্ড -->
          <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 15px; background: #ffffff;">
              <h3 class="fw-bold" style="color: #1A237E; margin-bottom: 5px;">Get in touch</h3>
              <p class="text-muted mb-4">Send Your Complain or Message</p>

              <div class="d-flex align-items-center mb-4 p-3 rounded-3" style="background: rgba(26, 35, 126, 0.03); border-left: 4px solid #1A237E;">
                <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background: #1A237E; color: #fff;">
                    <i class="bi bi-geo-alt-fill fs-5"></i>
                </div>
                <div class="ms-3">
                  <h5 class="fw-bold mb-1" style="color: #2d3748; font-size: 15px;">Location:</h5>
                  <p class="text-muted mb-0" style="font-size: 14px;">Sher e Bangla Nagar, Dhaka</p>
                </div>
              </div>

              <div class="d-flex align-items-center mb-4 p-3 rounded-3" style="background: rgba(5, 178, 98, 0.03); border-left: 4px solid #05B262;">
                <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background: #05B262; color: #fff;">
                    <i class="bi bi-envelope-open-fill fs-5"></i>
                </div>
                <div class="ms-3">
                  <h5 class="fw-bold mb-1" style="color: #2d3748; font-size: 15px;">Email:</h5>
                  <p class="text-muted mb-0" style="font-size: 14px;"><a href="mailto:nhcs.org.bd@gmail.com" class="text-decoration-none text-muted">nhcs.org.bd@gmail.com</a></p>
                </div>
              </div>

              <div class="d-flex align-items-center p-3 rounded-3" style="background: rgba(0, 210, 255, 0.03); border-left: 4px solid #00d2ff;">
                <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="width: 50px; height: 50px; background: #00d2ff; color: #fff;">
                    <i class="bi bi-telephone-fill fs-5"></i>
                </div>
                <div class="ms-3">
                  <h5 class="fw-bold mb-1" style="color: #2d3748; font-size: 15px;">Call Support:</h5>
                  <p class="text-muted mb-0" style="font-size: 13px; font-weight: 500;">01717288965, 01689597474</p>
                </div>
              </div>
            </div>
          </div>

          <!-- ডান পাশে: কাস্টম আইকন ও বাংলা ইনস্ট্যান্ট ভ্যালিডেশন ফর্ম -->
          <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 p-md-5 h-100" style="border-radius: 15px; background: #ffffff;">
              <h4 class="fw-bold mb-4" style="color: #05B262;"><i class="bi bi-chat-left-text-fill me-2"></i>Send Your Complain / Message</h4>
              
              <!-- সার্ভার সাইড সাকসেস মেসেজ -->
              <div class="mb-4">
                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm d-flex align-items-center" style="background: #05B262; color: #fff; border-radius: 10px;">
                        <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif
              </div>

              <!-- 'novalidate' দিয়ে ব্রাউজার পপ-আপ অফ করা হলো এবং 'smart-form' আইডি সেট করা হলো -->
              <form id="smartForm" action="{{ route('contact.send') }}" method="POST" role="form" class="row g-3" autocomplete="off" novalidate>
                @csrf 

                <div class="row g-4">
                  <!-- নাম ইনপুট -->
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-text bg-light border-end-0 icon-span" style="border-radius: 8px 0 0 8px; color: #1A237E; border-color: #cbd5e1;"><i class="bi bi-person-fill"></i></span>
                      <input type="text" name="name" class="form-control bg-light border-start-0" id="name" placeholder="Your Name" value="{{ old('name') }}" style="height: 48px; border-radius: 0 8px 8px 0; font-size: 15px; border-color: #cbd5e1;">
                    </div>
                    <div class="smart-feedback" id="nameError">⚠️ অনুগ্রহ করে আপনার নাম লিখুন।</div>
                  </div>

                  <!-- ইমেইল ইনপুট -->
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-text bg-light border-end-0 icon-span" style="border-radius: 8px 0 0 8px; color: #1A237E; border-color: #cbd5e1;"><i class="bi bi-envelope-fill"></i></span>
                      <input type="email" class="form-control bg-light border-start-0" name="email" id="email" placeholder="Your Email" value="{{ old('email') }}" style="height: 48px; border-radius: 0 8px 8px 0; font-size: 15px; border-color: #cbd5e1;">
                    </div>
                    <div class="smart-feedback" id="emailError">⚠️ অনুগ্রহ করে একটি সঠিক ইমেইল ঠিকানা লিখুন।</div>
                  </div>

                  <!-- মোবাইল নম্বর ইনপুট -->
                  <div class="col-12">
                    <div class="input-group">
                      <span class="input-group-text bg-light border-end-0 icon-span" style="border-radius: 8px 0 0 8px; color: #1A237E; border-color: #cbd5e1;"><i class="bi bi-telephone-fill"></i></span>
                      <input type="text" class="form-control bg-light border-start-0" name="mobileno" id="mobileno" placeholder="Your Mobile Number (যেমন: 017XXXXXXXX)" value="{{ old('mobileno') }}" style="height: 48px; border-radius: 0 8px 8px 0; font-size: 15px; border-color: #cbd5e1;">
                    </div>
                    <div class="smart-feedback" id="mobileError">⚠️ অনুগ্রহ করে আপনার মোবাইল নম্বরটি প্রদান করুন।</div>
                  </div>

                  <!-- সাবজেক্ট ইনপুট -->
                  <div class="col-12">
                    <div class="input-group">
                      <span class="input-group-text bg-light border-end-0 icon-span" style="border-radius: 8px 0 0 8px; color: #1A237E; border-color: #cbd5e1;"><i class="bi bi-bookmark-star-fill"></i></span>
                      <input type="text" class="form-control bg-light border-start-0" name="subject" id="subject" placeholder="Subject" value="{{ old('subject') }}" style="height: 48px; border-radius: 0 8px 8px 0; font-size: 15px; border-color: #cbd5e1;">
                    </div>
                    <div class="smart-feedback" id="subjectError">⚠️ অনুগ্রহ করে বার্তার বিষয় বা শিরোনামটি লিখুন।</div>
                  </div>

                  <!-- মেসেজ টেক্সট এরিয়া -->
                  <div class="col-12">
                    <div class="input-group align-items-start">
                      <span class="input-group-text bg-light border-end-0 py-3 icon-span" style="border-radius: 8px 0 0 8px; color: #1A237E; border-color: #cbd5e1;"><i class="bi bi-pencil-square"></i></span>
                      <textarea class="form-control bg-light border-start-0" name="message" id="message" rows="5" placeholder="Write your message or complain here..." style="border-radius: 0 8px 8px 0; font-size: 15px; padding-top: 12px; border-color: #cbd5e1;">{{ old('message') }}</textarea>
                    </div>
                    <div class="smart-feedback" id="messageError">⚠️ অনুগ্রহ করে আপনার বিস্তারিত বার্তা বা অভিযোগটি লিখুন।</div>
                  </div>
                </div>
                
                <!-- সাবমিট বাটন -->
                <div class="text-center mt-4">
                  <button type="submit" class="btn btn-primary shadow-sm btn-submit-contact" style="background: linear-gradient(135deg, #1A237E 0%, #0056b3 100%); border: none; padding: 13px 45px; border-radius: 8px; font-weight: 600; font-size: 16px; transition: all 0.3s ease-in-out;">
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

<!-- ========================================== -->
<!-- ৩. ইনপুট গ্রুপ ফোকাস এবং বাংলা এরর সিএসএস -->
<!-- ========================================== -->
<style>
  .input-group .form-control:focus {
    border-color: #1A237E !important;
    box-shadow: none !important;
  }
  .input-group .form-control:focus + .input-group-text, 
  .input-group:focus-within .input-group-text {
    border-color: #1A237E !important;
    background-color: #ffffff !important;
  }
  .btn-submit-contact:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(26, 35, 126, 0.3) !important;
  }
  /* স্মার্ট বাংলা নোটিফিকেশন মেসেজ স্টাইল */
  .smart-feedback {
    color: #e74c3c;
    font-size: 12px;
    font-weight: 500;
    margin-top: 6px;
    display: none;
    text-align: left;
    padding-left: 5px;
  }
</style>

<!-- ========================================== -->
<!-- ৪. স্মার্ট জাভাস্ক্রিপ্ট ইন্টারসেপ্টর ইঞ্জিন -->
<!-- ========================================== -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById('smartForm').addEventListener('submit', function (event) {
            let isValid = true;
            
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const mobile = document.getElementById('mobileno');
            const subject = document.getElementById('subject');
            const message = document.getElementById('message');

            // ১. নাম ফিল্ড চেক
            if (!name.value.trim()) {
                document.getElementById('nameError').style.display = 'block';
                name.style.borderColor = '#e74c3c';
                name.parentElement.querySelector('.icon-span').style.borderColor = '#e74c3c';
                isValid = false;
            } else {
                document.getElementById('nameError').style.display = 'none';
                name.style.borderColor = '#cbd5e1';
                name.parentElement.querySelector('.icon-span').style.borderColor = '#cbd5e1';
            }

            // ২. ইমেইল ফিল্ড চেক
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email.value.trim() || !emailRegex.test(email.value)) {
                document.getElementById('emailError').style.display = 'block';
                email.style.borderColor = '#e74c3c';
                email.parentElement.querySelector('.icon-span').style.borderColor = '#e74c3c';
                isValid = false;
            } else {
                document.getElementById('emailError').style.display = 'none';
                email.style.borderColor = '#cbd5e1';
                email.parentElement.querySelector('.icon-span').style.borderColor = '#cbd5e1';
            }

            // ৩. মোবাইল ফিল্ড চেক
            if (!mobile.value.trim()) {
                document.getElementById('mobileError').style.display = 'block';
                mobile.style.borderColor = '#e74c3c';
                mobile.parentElement.querySelector('.icon-span').style.borderColor = '#e74c3c';
                isValid = false;
            } else {
                document.getElementById('mobileError').style.display = 'none';
                mobile.style.borderColor = '#cbd5e1';
                mobile.parentElement.querySelector('.icon-span').style.borderColor = '#cbd5e1';
            }

            // ৪. সাবজেক্ট ফিল্ড চেক
            if (!subject.value.trim()) {
                document.getElementById('subjectError').style.display = 'block';
                subject.style.borderColor = '#e74c3c';
                subject.parentElement.querySelector('.icon-span').style.borderColor = '#e74c3c';
                isValid = false;
            } else {
                document.getElementById('subjectError').style.display = 'none';
                subject.style.borderColor = '#cbd5e1';
                subject.parentElement.querySelector('.icon-span').style.borderColor = '#cbd5e1';
            }

            // ৫. মেসেজ ফিল্ড চেক
            if (!message.value.trim()) {
                document.getElementById('messageError').style.display = 'block';
                message.style.borderColor = '#e74c3c';
                message.parentElement.querySelector('.icon-span').style.borderColor = '#e74c3c';
                isValid = false;
            } else {
                document.getElementById('messageError').style.display = 'none';
                message.style.borderColor = '#cbd5e1';
                message.parentElement.querySelector('.icon-span').style.borderColor = '#cbd5e1';
            }

            // কোনো ফিল্ড ফাঁকা থাকলে সাবমিট ব্লক করে কাস্টম মেসেজ রিটেন করবে
            if (!isValid) {
                event.preventDefault();
                event.stopPropagation();
            }
        });
    });
</script>
@endsection
