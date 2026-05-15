<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<!-- টপ ক্লাস মেটা সিকিউরিটি এবং এসইও (SEO) -->
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="description" content="Nurses Health Care Society, www.nhcsbd.org, nhcsbd.org, nhcsbd">
<meta name="keywords" content="Nurses Health Care Society, www.nhcsbd.org, nhcsbd.org, nhcsbd">
<meta name="author" content="Nurses Health Care Society">

<!-- Favicons (লারাভেল এসেট পাথ মেথড) -->
<link rel="icon" type="image/x-icon" href="{{ asset('frontend/assets/img/favicon.ico?v=' . time()) }}">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/img/favicon.ico?v=' . time()) }}">


<!-- Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect">
<link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

<!-- Main CSS File -->
<link href="{{ asset('frontend/assets/css/main.css') }}" rel="stylesheet">

<style> 
  /* হোভার করলে আইকনগুলোর রঙ পরিবর্তন */
  .social-links a.facebook:hover i { color: #1877F2 !important; }
  .social-links a.whatsapp:hover i { color: #25D366 !important; }
  .social-links a.twitter:hover i { color: #000000 !important; }
  .social-links a.instagram:hover i { color: #E4405F !important; }
  .social-links a.linkedin:hover i { color: #0077B5 !important; }

  /* ট্রানজিশন যোগ করা যাতে রঙ পরিবর্তনটা স্মুথ হয় */
  .social-links a i { transition: 0.3s; }

  .nav-link-custom.active {
    color: #05BFDB !important; 
    background-color: rgba(8, 131, 149, 0.1);
    border-bottom: 2px solid #05BFDB;
    font-weight: 700;
  }

  .cta-modern { background: #ffffff; overflow: hidden; }

  /* বাম পাশের ইমেজের জন্য ডাইনামিক লারাভেল পাথ */
  .cta-image-side {
    background: url("{{ asset('frontend/assets/img/index-pic.jpg') }}") center/cover no-repeat; 
    min-height: 100vh;
    position: relative;
  }

  .image-overlay {
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: linear-gradient(to right, rgba(0,0,0,0.4), transparent);
  }

  /* কন্টেন্ট সাইড */
  .cta-content-side { background: #f8faff; min-height: 100vh; }
  .content-wrapper { max-width: 650px; }
  .est-tag { color: #007bff; font-weight: 700; font-size: 13px; letter-spacing: 2px; display: block; margin-bottom: 10px; }
  .section-title { font-size: 2.5rem; font-weight: 800; color: #1a202c; line-height: 1.2; margin-bottom: 25px; }

  .main-description p {
    font-size: 1.1rem; color: #4a5568;
    border-left: 4px solid #007bff; padding-left: 20px; margin-bottom: 30px;
  }

  .goal-item { margin-bottom: 25px; }
  .goal-item h6 { font-weight: 800; color: #2d3748; font-size: 0.9rem; margin-bottom: 8px; letter-spacing: 1px; }
  .goal-item p { color: #718096; font-size: 0.95rem; line-height: 1.6; }
  .final-note { font-size: 0.95rem; color: #718096; font-style: italic; }

  /* Founder Badge */
  .founder-badge { display: flex; align-items: center; gap: 20px; border-top: 1px solid #e2e8f0; padding-top: 30px; }
  .sign-box img { height: 50px; filter: grayscale(1) contrast(1.2); }
  .founder-info .name { display: block; font-weight: 700; color: #1a202c; font-size: 1.1rem; }
  .founder-info .title { color: #a0aec0; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; }

  .footer-about .logo span { font-family: 'Poppins', sans-serif; }
  .footer-contact p, .footer-contact a { font-size: 15px; line-height: 1.6; transition: 0.3s; }
  .footer-contact a:hover { color: #007bff !important; }
  .footer-contact i { flex-shrink: 0; }
  .social-links a:hover { color: #007bff !important; transform: translateY(-3px); display: inline-block; }
</style>
