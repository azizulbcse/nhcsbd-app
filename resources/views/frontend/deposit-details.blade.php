@extends('layouts.frontend')

@section('title', 'Deposit Details | Nurses Health Care Society Bangladesh')

@section('content')
<main class="main">

    <!-- পেজ টাইটেল হেডার -->
    <div class="page-title dark-background" style="background: linear-gradient(135deg, #1A237E 0%, #0056b3 100%); padding: 60px 0; color: #fff;">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0 fw-bold">
                <i class="bi bi-bank2 me-2"></i>Deposit Details
            </h1>

            <nav class="breadcrumbs">
                <ol class="breadcrumb mb-0" style="background: transparent;">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}" class="text-white-50 text-decoration-none">
                            <i class="bi bi-house-door-fill"></i> Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Deposit Details</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- ব্যাংক অ্যাকাউন্ট ইনফরমেশন কার্ড -->
    <section id="about" class="about section py-5" style="background-color: #f8f9fa;">
        <div class="container" data-aos="fade-up">

            <!-- Bank Card -->
            <div class="card border-0 shadow-sm p-4 p-md-5 mb-5 text-center"
                style="border-radius: 20px; background: #ffffff; border-top: 5px solid #1A237E;">

                <div class="d-flex align-items-center justify-content-center mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 60px; height: 60px; background: rgba(26, 35, 126, 0.05); color: #1A237E;">
                        <i class="bi bi-building-fill-check fs-3"></i>
                    </div>
                </div>

                <h2 class="fw-bold" style="color: #1A237E; font-size: 26px;">
                    Bank Name: City Bank PLC
                </h2>

                <h5 class="text-muted fw-semibold mb-2">
                    <i class="bi bi-geo-alt-fill text-danger"></i> Branch Name: SHAYMOLI BRANCH
                </h5>

                <h6 class="text-dark fw-bold mb-2">
                    Account Name: HASAN UDDIN TAMAL / RAZIB HOSSAIN / MD SUMON
                </h6>

                <div class="d-inline-block px-4 py-2 mt-2 rounded-pill"
                    style="background: rgba(26, 35, 126, 0.08); border: 1px dashed #1A237E;">
                    <h4 class="mb-0 fw-bold"
                        style="color: #1A237E; font-family: 'Courier New', Courier, monospace; letter-spacing: 1px;">
                        <i class="bi bi-credit-card-2-back-fill me-2"></i>2304110322001
                    </h4>
                </div>

                <!-- Bank QR Code -->
                <div class="text-center mt-4 p-3 rounded-3"
                    style="background: #fafafa; border: 1px solid #f1f5f9;">
                    <div id="qrcode_bank" class="d-flex justify-content-center"></div>
                    <span class="d-block text-muted mt-2" style="font-size: 11px; font-weight: 500;">
                        <i class="bi bi-qr-code-scan"></i> Scan to Copy Bank Account Number
                    </span>
                </div>

            </div>

            <!-- মোবাইল ব্যাংকিং ও হিসাবরক্ষক প্যানেল টাইটেল -->
            <div class="d-flex align-items-center mb-4" style="border-left: 5px solid #05B262; padding-left: 15px;">
                <h4 class="fw-bold mb-0" style="color: #2d3748;">
                    <i class="bi bi-phone-vibrate-fill text-success me-2"></i>
                    Mobile Banking & Accounts Support
                </h4>
            </div>

            <!-- ৩টি কার্ড গ্রিড -->
            <div class="row g-4 justify-content-center">

                <!-- কার্ড ১: হাসান উদ্দিন তামাল -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100 p-4 text-center text-md-start smart-qr-card"
                        style="border-radius: 15px; background: #ffffff; border-left: 4px solid #e91e63;">

                        <h5 class="fw-bold text-uppercase tracking-wide mb-3" style="color: #e91e63;">
                            <i class="bi bi-phone-flip"></i> bKash & Nagad
                        </h5>

                        <hr class="my-2 opacity-10">

                        <div class="d-flex align-items-center mb-3 justify-content-center justify-content-md-start">
                            <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-primary"
                                style="width: 40px; height: 40px; flex-shrink:0;">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div class="ms-3">
                                <a href="tel:01680496808" class="text-decoration-none fw-bold fs-5 text-dark">
                                    01680496808
                                </a>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3 justify-content-center justify-content-md-start">
                            <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-success"
                                style="width: 40px; height: 40px; flex-shrink:0;">
                                <i class="bi bi-person-badge-fill"></i>
                            </div>
                            <div class="ms-3">
                                <span class="fw-bold d-block text-dark" style="font-size: 15px;">Hasan Uddin Tamal</span>
                                <small class="text-muted text-uppercase fw-semibold"
                                    style="font-size: 11px; letter-spacing: 0.5px;">Accountant</small>
                            </div>
                        </div>

                        <!-- QR Code -->
                        <div class="text-center mt-3 p-2 rounded-3" style="background: #fafafa; border: 1px solid #f1f5f9;">
                            <div id="qrcode_tamal" class="d-flex justify-content-center"></div>
                            <span class="d-block text-muted mt-2" style="font-size: 11px; font-weight: 500;">
                                <i class="bi bi-qr-code-scan"></i> Scan to Get Number
                            </span>
                        </div>

                    </div>
                </div>

                <!-- কার্ড ২: মোঃ সৌমিক হাসান -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100 p-4 text-center text-md-start smart-qr-card"
                        style="border-radius: 15px; background: #ffffff; border-left: 4px solid #00d2ff;">

                        <h5 class="fw-bold text-uppercase tracking-wide mb-3" style="color: #00d2ff;">
                            <i class="bi bi-phone-flip"></i> bKash & Nagad
                        </h5>

                        <hr class="my-2 opacity-10">

                        <div class="d-flex align-items-center mb-3 justify-content-center justify-content-md-start">
                            <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-primary"
                                style="width: 40px; height: 40px; flex-shrink:0;">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div class="ms-3">
                                <a href="tel:01934337659" class="text-decoration-none fw-bold fs-5 text-dark">
                                    01934337659
                                </a>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3 justify-content-center justify-content-md-start">
                            <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-success"
                                style="width: 40px; height: 40px; flex-shrink:0;">
                                <i class="bi bi-person-badge-fill"></i>
                            </div>
                            <div class="ms-3">
                                <span class="fw-bold d-block text-dark" style="font-size: 15px;">Md. Soumik Hasan</span>
                                <small class="text-muted text-uppercase fw-semibold"
                                    style="font-size: 11px; letter-spacing: 0.5px;">Asst. Accountant</small>
                            </div>
                        </div>

                        <!-- QR Code -->
                        <div class="text-center mt-3 p-2 rounded-3" style="background: #fafafa; border: 1px solid #f1f5f9;">
                            <div id="qrcode_soumik" class="d-flex justify-content-center"></div>
                            <span class="d-block text-muted mt-2" style="font-size: 11px; font-weight: 500;">
                                <i class="bi bi-qr-code-scan"></i> Scan to Get Number
                            </span>
                        </div>

                    </div>
                </div>

                <!-- কার্ড ৩: Md. Sumon -->
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100 p-4 text-center text-md-start smart-qr-card"
                        style="border-radius: 15px; background: #ffffff; border-left: 4px solid #fd7e14;">

                        <h5 class="fw-bold text-uppercase tracking-wide mb-3" style="color: #fd7e14;">
                            <i class="bi bi-phone-flip"></i> bKash & Nagad
                        </h5>

                        <hr class="my-2 opacity-10">

                        <div class="d-flex align-items-center mb-3 justify-content-center justify-content-md-start">
                            <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-primary"
                                style="width: 40px; height: 40px; flex-shrink:0;">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div class="ms-3">
                                <a href="tel:01717288965" class="text-decoration-none fw-bold fs-5 text-dark">
                                    01717288965
                                </a>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-3 justify-content-center justify-content-md-start">
                            <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-success"
                                style="width: 40px; height: 40px; flex-shrink:0;">
                                <i class="bi bi-person-badge-fill"></i>
                            </div>
                            <div class="ms-3">
                                <span class="fw-bold d-block text-dark" style="font-size: 15px;">Md. Sumon</span>
                                <small class="text-muted text-uppercase fw-semibold"
                                    style="font-size: 11px; letter-spacing: 0.5px;">Support Team</small>
                            </div>
                        </div>

                        <!-- QR Code -->
                        <div class="text-center mt-3 p-2 rounded-3" style="background: #fafafa; border: 1px solid #f1f5f9;">
                            <div id="qrcode_sumon" class="d-flex justify-content-center"></div>
                            <span class="d-block text-muted mt-2" style="font-size: 11px; font-weight: 500;">
                                <i class="bi bi-qr-code-scan"></i> Scan to Get Number
                            </span>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

</main>

<style>
    .smart-qr-card {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .smart-qr-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
    }
</style>

<!-- QR Code Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        // Bank QR Code
        new QRCode(document.getElementById("qrcode_bank"), {
            text: "City Bank PLC | SHAYMOLI BRANCH | Account No: 2304110322001",
            width: 140,
            height: 140,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

        // Tamal QR
        new QRCode(document.getElementById("qrcode_tamal"), {
            text: "tel:01680496808",
            width: 120,
            height: 120,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

        // Soumik QR
        new QRCode(document.getElementById("qrcode_soumik"), {
            text: "tel:01934337659",
            width: 120,
            height: 120,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

        // Sumon QR
        new QRCode(document.getElementById("qrcode_sumon"), {
            text: "tel:01717288965",
            width: 120,
            height: 120,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

    });
</script>

@endsection