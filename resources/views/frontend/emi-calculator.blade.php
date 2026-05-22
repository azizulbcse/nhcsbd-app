@extends('layouts.frontend')

@section('title', 'Smart Loan EMI Calculator | Nurses Health Care Society Bangladesh')

@section('content')
<main class="main">

    <!-- ========================================== -->
    <!-- ১. সংশোধিত পেজ টাইটেল ও লোন ক্যালকুলেটর ব্যানার -->
    <!-- ========================================== -->
    <div class="page-title dark-background" style="background: linear-gradient(135deg, #1A237E 0%, #0056b3 100%); padding: 60px 0; color: #fff;">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h1 class="mb-2 mb-lg-0 fw-bold">
                <i class="bi bi-calculator me-2"></i>Loan EMI Calculator
            </h1>

            <nav class="breadcrumbs">
                <ol class="breadcrumb mb-0" style="background: transparent;">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}" class="text-white-50 text-decoration-none">
                            <i class="bi bi-house-door-fill"></i> Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-white" aria-current="page">EMI Calculator</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- ========================================== -->
    <!-- ২. মেইন ক্যালকুলেটর ইন্টারফেস সেকশন -->
    <!-- ========================================== -->
    <div class="container my-5" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="card shadow-sm border-0" id="printableArea" style="border-radius: 15px; background: #ffffff;">
                    <div class="card-header bg-light border-0 pt-4 pb-0 px-4">
                        <h4 class="card-title fw-bold text-dark mb-0">
                            <i class="bi bi-calculator-fill me-2 text-primary"></i>Loan <span class="text-primary">EMI Quotation</span>
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        
                        <!-- ইনপুট ফর্ম এরিয়া -->
                        <div class="form-group mb-4 no-print-input">
                            <label class="form-label fw-semibold text-secondary">Loan Amount (টাকা)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-primary fw-bold" style="border-color: #cbd5e1;">৳</span>
                                <input type="number" id="amount" class="form-control bg-light border-start-0 text-dark fw-semibold" placeholder="যেমন: ১০০০০০" oninput="calculateEMI()" style="height: 48px; border-color: #cbd5e1; font-size: 16px;">
                            </div>
                            <p id="amount-in-words" class="small text-info mt-2 mb-0 font-italic fw-bold" style="font-size: 13px; display: block; text-align: left;"></p>
                        </div>

                        <div class="row mb-4 no-print-input">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="form-group">
                                    <label class="form-label fw-semibold text-secondary">Interest Rate (%)</label>
                                    <div class="input-group">
                                        <input type="number" id="interest" step="0.01" class="form-control bg-light border-end-0 text-dark fw-semibold" placeholder="যেমন: ২.৫" oninput="calculateEMI()" style="height: 48px; border-color: #cbd5e1; font-size: 16px;">
                                        <span class="input-group-text bg-light border-start-0 text-muted fw-bold" style="border-color: #cbd5e1;">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold text-secondary">Duration (মাস)</label>
                                    <div class="input-group">
                                        <input type="number" id="months" placeholder="যেমন: ১২" class="form-control bg-light border-end-0 text-dark fw-semibold" oninput="calculateEMI()" style="height: 48px; border-color: #cbd5e1; font-size: 16px;">
                                        <span class="input-group-text bg-light border-start-0 text-muted" style="border-color: #cbd5e1;">মাস</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- ফলাফল এরিয়া (স্মার্ট ডার্ক-ব্লু লুক থিম) -->
                        <div class="emi-result-container p-4 rounded-3 text-white" style="background: #1A237E; border: 1px solid #0d1b40; border-radius: 12px;">
                            
                            <!-- প্রিন্ট কপি রিপোর্ট হেডার (ডিফল্ট হাইড) -->
                            <div id="show-on-print" style="display:none; color: black; margin-bottom: 25px; text-align: left;">
                                <h3 style="margin-top:0; font-weight: 700; color: #1A237E;">Nurses Health Care Society Bangladesh</h3>
                                <h5 class="text-muted fw-bold mb-3"><i class="bi bi-file-earmark-text-fill"></i> Loan Estimate Report</h5>
                                <p id="print-date" style="font-size:12px; color:#555; margin-bottom: 15px;"></p>
                                <div id="print-inputs" style="margin: 15px 0; font-size: 14px; line-height: 1.8; padding: 12px; background: #f8f9fa; border-radius: 8px; border: 1px solid #dee2e6;"></div>
                                <hr style="border-top: 2px solid #000; margin-top: 20px;">
                            </div>
                            
                            <h5 class="text-center emi-title opacity-75 mb-1" style="color: #e2e8f0; font-size: 15px; font-weight: 500;">Monthly EMI</h5>
                            <h1 id="emi-output" class="text-center fw-bold text-warning my-2" style="font-size: 44px; letter-spacing: 0.5px;">0.00</h1>
                            <p id="emi-in-words" class="text-center small opacity-75 text-capitalize font-italic mb-3" style="font-size: 12px; color: #cbd5e1;"></p>
                            
                            <hr class="print-hr my-3" style="border-top: 1px dashed rgba(255,255,255,0.2);">
                            
                            <div class="row text-center">
                                <div class="col-6 border-end border-translucent" style="border-right: 1px solid rgba(255,255,255,0.15) !important;">
                                    <p class="summary-label opacity-75 small mb-1" style="color: #e2e8f0; font-size: 13px;">Total Interest</p>
                                    <span id="total-interest" class="fw-bold fs-5 text-light" style="font-size: 18px;">0.00</span>
                                </div>
                                <div class="col-6">
                                    <p class="summary-label opacity-75 small mb-1" style="color: #e2e8f0; font-size: 13px;">Total Payment</p>
                                    <span id="total-payment" class="fw-bold fs-5 text-light" style="font-size: 18px;">0.00</span>
                                </div>
                            </div>
                        </div>

                        <!-- প্রিন্ট অ্যাকশন বাটন -->
                        <div class="d-flex justify-content-end mt-4 no-print-input">
                            <button type="button" class="btn btn-primary px-4 py-2 fw-semibold shadow-sm" onclick="printQuotation()" style="background: linear-gradient(135deg, #1A237E 0%, #0056b3 100%); border: none; border-radius: 8px;">
                                <i class="bi bi-printer-fill me-2"></i> Print Quotation
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<!-- ========================================== -->
<!-- ৩. রেসপন্সিভ প্রিন্ট ওভাররাইড সিএসএস ইঞ্জিন -->
<!-- ========================================== -->
<style>
.input-group .form-control:focus {
    border-color: #1A237E !important;
    box-shadow: none !important;
}
@media print {
    body * { visibility: hidden; }
    #printableArea, #printableArea * { visibility: visible; }
    #printableArea {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        color: black !important;
        box-shadow: none !important;
    }
    .no-print-input { display: none !important; }
    
    .emi-result-container {
        background: white !important;
        color: black !important;
        border: 2px solid #000 !important;
        padding: 20px !important;
        border-radius: 0 !important;
    }
    #emi-output { color: #000 !important; font-size: 46px !important; text-align: center !important; display: block !important; }
    #total-interest, #total-payment { color: black !important; font-size: 20px !important; }
    .emi-title, .summary-label { color: #333 !important; font-weight: bold !important; text-align: center !important; }
    #emi-in-words { color: #555 !important; text-align: center !important; display: block !important; }
    
    #show-on-print { display: block !important; }
    .print-hr { border-top: 2px solid #000 !important; }
    .border-end { border-right: 2px solid #000 !important; }
}
</style>

<!-- ========================================== -->
<!-- ৪. রিয়েল-টাইম জাভাস্ক্রিপ্ট ম্যাথমেটিকাল লজিক -->
<!-- ========================================== -->
<script>
function convertToTakaWords(number) {
    if (number <= 0) return '';
    number = Math.floor(number);
    const ones = ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
    const tens = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

    function getWords(n) {
        if (n < 20) return ones[n];
        if (n < 100) return tens[Math.floor(n / 10)] + (n % 10 !== 0 ? ' ' + ones[n % 10] : '');
        if (n < 1000) return ones[Math.floor(n / 100)] + ' hundred' + (n % 100 !== 0 ? ' and ' + getWords(n % 100) : '');
        return '';
    }

    let words = '';
    if (Math.floor(number / 10000000) > 0) { words += getWords(Math.floor(number / 10000000)) + ' crore '; number %= 10000000; }
    if (Math.floor(number / 100000) > 0) { words += getWords(Math.floor(number / 100000)) + ' lakh '; number %= 100000; }
    if (Math.floor(number / 1000) > 0) { words += getWords(Math.floor(number / 1000)) + ' thousand '; number %= 1000; }
    if (Math.floor(number) > 0) { words += getWords(Math.floor(number)); }

    return words.trim().replace(/\s+/g, ' ').toUpperCase() + ' TAKA ONLY';
}

function calculateEMI() {
    const principal = parseFloat(document.getElementById('amount').value) || 0;
    const interestRate = parseFloat(document.getElementById('interest').value) || 0;
    const tenure = parseFloat(document.getElementById('months').value) || 0;

    if (principal > 0) {
        document.getElementById('amount-in-words').innerText = "In Words: " + convertToTakaWords(principal);
    } else {
        document.getElementById('amount-in-words').innerText = "";
    }

    if (principal > 0 && interestRate > 0 && tenure > 0) {
        let monthlyInterest = (interestRate / 100) / 12;
        let emi = (principal * monthlyInterest * Math.pow(1 + monthlyInterest, tenure)) / (Math.pow(1 + monthlyInterest, tenure) - 1);
        
        let totalPayment = emi * tenure;
        let totalInterest = totalPayment - principal;

        document.getElementById('emi-output').innerText = Math.round(emi).toLocaleString('en-IN');
        document.getElementById('total-interest').innerText = Math.round(totalInterest).toLocaleString('en-IN');
        document.getElementById('total-payment').innerText = Math.round(totalPayment).toLocaleString('en-IN');
        document.getElementById('emi-in-words').innerText = "(" + convertToTakaWords(emi) + ")";
    } else {
        document.getElementById('emi-output').innerText = "0.00";
        document.getElementById('total-interest').innerText = "0.00";
        document.getElementById('total-payment').innerText = "0.00";
        document.getElementById('emi-in-words').innerText = "";
    }
}

function printQuotation() {
    const amt = document.getElementById('amount').value || 0;
    const intr = document.getElementById('interest').value || 0;
    const mths = document.getElementById('months').value || 0;
    
    document.getElementById('print-inputs').innerHTML = `
        <strong>Loan Amount (আসল টাকা):</strong> ${parseFloat(amt).toLocaleString('en-IN')} Taka <br>
        <strong>Interest Rate (বার্ষিক সুদ):</strong> ${intr}% <br>
        <strong>Duration (ঋণের মেয়াদ):</strong> ${mths} Months (মাস)
    `;
    
    document.getElementById('print-date').innerText = "Quotation Generated on: " + new Date().toLocaleString();
    window.print();
}
</script>
@endsection
