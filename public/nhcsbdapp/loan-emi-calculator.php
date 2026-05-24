<?php require_once 'php_action/core.php'; ?> 

<!DOCTYPE html>
<html>
<head>
    <!-- Start title --> 
    <title>Loan EMI Calculator | Nurses Health Care Society </title>  
    <!-- End title --> 

    <!-- Start Header Base--> 
    <?php include ('layouts/1-base-head.php') ?>
    <link rel="stylesheet" href="https://cloudflare.com">
    <!-- End Header Base --> 
    
    <!-- বুটস্ট্র্যাপ আইকন ব্যাকআপ গেটওয়ে -->
    <link rel="stylesheet" href="https://jsdelivr.net">
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="">
    <!-- BEGIN HEADER -->
    <?php include ('layouts/2-base-header-member.php') ?>
    <!-- END HEADER -->

    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
      
      <!-- BEGIN SIDEBAR -->
      <?php include ('layouts/4-base-menu-member.php') ?>
      <!-- END SIDEBAR -->
      
      <!-- BEGIN PAGE CONTAINER-->
      <div class="page-content">
        <div class="clearfix"></div>

        <div class="content sm-gutter">
          <div class="page-title">
             <h3><i class="fa-solid fa-calculator me-2 text-primary"></i> Loan <span class="semi-bold">EMI Calculator</span></h3>
          </div>
          
          <!-- স্মার্ট ক্যালকুলেটর মেইন ড্যাশবোর্ড গ্রিড -->
          <div class="row">            
              <div class="col-md-12 col-sm-12">
                  <div class="grid simple" id="printableArea" style="border-radius: 12px; background: #ffffff; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                      <div class="grid-title no-border pt-4 px-4">
                          <h4>Loan <span class="semi-bold text-primary">EMI Quotation Generator</span></h4>
                      </div>
                      <div class="grid-body no-border p-4">
                          
                          <div class="row">
                              <!-- বাম পাশ: ইনপুট ফরম কলাম -->
                              <div class="col-md-6 col-sm-12 no-print-input">
                                  <div class="form-group mb-4">
                                      <label class="form-label fw-bold text-secondary">Loan Amount (টাকা)</label>
                                      <div class="input-group">
                                          <span class="input-group-addon bg-light text-primary fw-bold" style="font-weight: bold;">৳</span>
                                          <input type="number" id="amount" class="form-control text-dark fw-semibold" placeholder="যেমন: ১০০০০০" oninput="calculateEMI()" style="height: 45px; font-size: 15px;">
                                      </div>
                                      <p id="amount-in-words" class="small text-info mt-2 mb-0 font-italic fw-bold" style="font-size: 12px; color: #00adef;"></p>
                                  </div>

                                  <div class="row mb-4">
                                      <div class="col-md-6 mb-3 mb-md-0">
                                          <div class="form-group">
                                              <label class="form-label fw-bold text-secondary">Interest Rate (%)</label>
                                              <div class="input-group">
                                                  <input type="number" id="interest" step="0.01" class="form-control text-dark fw-semibold" placeholder="যেমন: ২.৫" oninput="calculateEMI()" style="height: 45px; font-size: 15px;">
                                                  <span class="input-group-addon bg-light text-muted fw-bold">%</span>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label class="form-label fw-bold text-secondary">Duration (মাস)</label>
                                              <div class="input-group">
                                                  <input type="number" id="months" placeholder="যেমন: ১২" class="form-control text-dark fw-semibold" oninput="calculateEMI()" style="height: 45px; font-size: 15px;">
                                                  <span class="input-group-addon bg-light text-muted">মাস</span>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <!-- প্রিন্ট অ্যাকশন বাটন -->
                                  <div class="form-group text-left mt-4">
                                      <button type="button" class="btn btn-primary btn-cons" onclick="printQuotation()" style="background: linear-gradient(135deg, #1A237E 0%, #0056b3 100%); border: none; padding: 10px 24px; border-radius: 6px; font-weight: 600;">
                                          <i class="fa fa-print me-2"></i> Print Quotation
                                      </button>
                                  </div>
                              </div>
                              <!-- ডান পাশ: লাইভ আউটপুট উইজেট -->
                              <div class="col-md-6 col-sm-12">
                                  <div class="emi-result-container p-4 rounded-3 text-white" style="background: #1b1e24; color: white; padding: 25px; border-radius: 10px; border: 1px solid #333; min-height: 250px;">
                                      
                                      <!-- প্রিন্ট কপি রিপোর্ট হেডার (ডিফল্ট হাইড) -->
                                      <div id="show-on-print" style="display:none; color: black; margin-bottom: 20px; text-align: left;">
                                          <h3 style="margin-top:0; font-weight: 700; color: #1A237E;">Nurses Health Care Society Bangladesh</h3>
                                          <h5 class="text-muted fw-bold mb-3"><i class="fa-solid fa-file-invoice-dollar"></i> Member Loan Estimate Report</h5>
                                          <p id="print-date" style="font-size:12px; color:#555; margin-bottom: 15px;"></p>
                                          <div id="print-inputs" style="margin: 15px 0; font-size: 14px; line-height: 1.8; padding: 12px; background: #f8f9fa; border-radius: 8px; border: 1px solid #dee2e6;"></div>
                                          <hr style="border-top: 2px solid #000; margin-top: 20px;">
                                      </div>
                                      
                                      <h5 class="text-center emi-title opacity-75 mb-1" style="color: #8b9199; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;">Monthly EMI</h5>
                                      <h1 id="emi-output" class="text-center fw-bold my-2" style="font-size: 42px; font-weight: bold; color: #00adef !important; margin-top: 0; text-align: center;">0.00</h1>
                                      <p id="emi-in-words" class="text-center small opacity-75 text-capitalize font-italic mb-3" style="font-size: 11px; color: #aaa; text-align: center;"></p>
                                      
                                      <hr class="print-hr my-3" style="border-top: 1px dashed #444;">
                                      
                                      <div class="row text-center" style="display: flex; justify-content: space-between;">
                                          <div class="col-md-6 col-xs-6" style="width: 50%; text-align: center; border-right: 1px solid #333;">
                                              <p class="summary-label opacity-75 small mb-1" style="font-size: 12px; color: #8b9199;">Total Interest</p>
                                              <span id="total-interest" class="fw-bold fs-5 text-light" style="font-weight: bold; font-size: 18px;">0.00</span>
                                          </div>
                                          <div class="col-md-6 col-xs-6" style="width: 50%; text-align: center;">
                                              <p class="summary-label opacity-75 small mb-1" style="font-size: 12px; color: #8b9199;">Total Payment</p>
                                              <span id="total-payment" class="fw-bold fs-5 text-light" style="font-weight: bold; font-size: 18px;">0.00</span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div><!-- End Inner Row -->

                      </div>
                  </div>
              </div>
          </div><!-- End Main Row -->         

          <!-- Footer Copy -->
          <div id="footer">
            <div class="error-container">
              <div class="copyright"> © 2026, made with ❤️ by Matrik Solutions</div>
            </div>
          </div>         
        </div>
      </div>
    </div>
    <!-- END CONTAINER -->

    <!-- BEGIN CORE JS FRAMEWORK-->
    <?php include ('layouts/5-base-js.php') ?> 
    <script src="assets/plugins/fullcalendar/fullcalendar.min.js"></script>
    <script src="assets/js/calender.js" type="text/javascript"></script>
    <!-- END CORE JS FRAMEWORK-->

<!-- ========================================== -->
<!-- ⚙️ রেসপন্সিভ প্রিন্ট সিএসএস ওভাররাইড ইঞ্জিন -->
<!-- ========================================== -->
<style>
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
    .no-print-input, .btn, .page-title, #footer { display: none !important; }
    
    .emi-result-container {
        background: white !important;
        color: black !important;
        border: 2px solid #000 !important;
        padding: 20px !important;
        border-radius: 0 !important;
        width: 100% !important;
    }
    #emi-output { color: #000 !important; font-size: 46px !important; text-align: center !important; }
    #total-interest, #total-payment { color: black !important; font-size: 20px !important; }
    .emi-title, .summary-label { color: #333 !important; font-weight: bold !important; }
    #emi-in-words { color: #555 !important; text-align: center !important; }
    
    #show-on-print { display: block !important; }
    .print-hr { border-top: 2px solid #000 !important; }
}
</style>

<!-- ========================================== -->
<!-- 📐 গ্লোবাল ম্যাথমেটিকাল লোন কোটেশন জাভাস্ক্রিপ্ট -->
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
        <strong>Loan Amount (আসল ঋণের পরিমাণ):</strong> ${parseFloat(amt).toLocaleString('en-IN')} Taka <br>
        <strong>Interest Rate (বার্ষিক সুদের হার):</strong> ${intr}% <br>
        <strong>Duration (ঋণের মেয়াদ):</strong> ${mths} Months (মাস)
    `;
    
    document.getElementById('print-date').innerText = "Quotation Generated on: " + new Date().toLocaleString();
    window.print();
}
</script>
</body>
</html>
