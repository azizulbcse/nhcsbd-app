<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="grid simple" id="printableArea">
            <div class="grid-title no-border">
                <h4>Loan <span class="semi-bold">EMI Quotation</span></h4>
            </div>
            <div class="grid-body no-border">
                <div class="form-group no-print-input">
                    <label class="form-label">Loan Amount (টাকা)</label>
                    <input type="number" id="amount" class="form-control" placeholder="যেমন: ১০০০০০" oninput="calculateEMI()">
                    <p id="amount-in-words" style="font-size: 12px; color: #00adef; margin-top: 8px; font-style: italic; font-weight: bold;"></p>
                </div>

                <div class="row no-print-input">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Interest Rate (%)</label>
                            <input type="number" id="interest" step="0.01" class="form-control" placeholder="যেমন: ২.৫" oninput="calculateEMI()">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Duration (মাস)</label>
                            <input type="number" id="months" placeholder="যেমন: ১২" class="form-control" oninput="calculateEMI()">
                        </div>
                    </div>
                </div>
                
                <div class="emi-result-container" style="background: #1b1e24; color: white; padding: 25px; border-radius: 8px; margin-top: 20px; border: 1px solid #333;">
                    <!-- প্রিন্ট হেডার (ডিফল্ট হাইড) -->
                    <div id="show-on-print" style="display:none; color: black; margin-bottom: 20px;">
                        <h3 style="margin-top:0;">Loan Estimate Report</h3>
                        <p id="print-date" style="font-size:12px; color:#555;"></p>
                        <!-- প্রিন্ট কপিতে ইনপুট ভ্যালু দেখানোর জন্য নতুন সেকশন -->
                        <div id="print-inputs" style="margin: 15px 0; font-size: 14px; line-height: 1.6;"></div>
                        <hr style="border-top: 1px solid #000;">
                    </div>
                    
                    <h5 class="text-center emi-title" style="color: #8b9199; margin-bottom: 5px;">Monthly EMI</h5>
                    <h2 id="emi-output" class="text-center" style="font-weight: bold; color: #00adef; margin-top: 0; font-size: 36px;">0.00</h2>
                    <p id="emi-in-words" class="text-center" style="font-size: 11px; color: #aaa; text-transform: capitalize; font-style: italic;"></p>
                    
                    <hr class="print-hr" style="border-top: 1px dashed #444;">
                    
                    <div class="row text-center">
                        <div class="col-md-6 col-xs-6">
                            <p class="summary-label" style="font-size: 12px; color: #8b9199; margin-bottom: 0;">Total Interest</p>
                            <span id="total-interest" style="font-weight: bold; font-size: 18px;">0.00</span>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <p class="summary-label" style="font-size: 12px; color: #8b9199; margin-bottom: 0;">Total Payment</p>
                            <span id="total-payment" style="font-weight: bold; font-size: 18px;">0.00</span>
                        </div>
                    </div>
                </div>

                <!-- HTML সিনট্যাক্স ঠিক করা হয়েছে (ডাবল কোটেশন এরর) -->
                <div class="text-right" style="margin-top: 15px;">
                    <button type="button" class="btn btn-primary btn-cons" onclick="printQuotation()">
                        <i class="material-icons">print</i> Print Quotation
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    /* পুরো পেজ হাইড করে শুধু নির্দিষ্ট এরিয়া প্রিন্ট করা */
    body * { visibility: hidden; }
    #printableArea, #printableArea * { visibility: visible; }
    #printableArea {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        color: black !important;
    }
    /* ইনপুট ফর্ম ও বাটন প্রিন্ট থেকে বাদ */
    .no-print-input, .btn { display: none !important; }
    
    /* ব্যাকগ্রাউন্ড সাদা এবং বর্ডার কালো করা */
    .emi-result-container {
        background: white !important;
        color: black !important;
        border: 1px solid #000 !important;
        padding: 20px !important;
    }
    #emi-output { color: #000 !important; font-size: 42px !important; }
    #total-interest, #total-payment { color: black !important; }
    .emi-title, .summary-label { color: #333 !important; }
    
    /* লুকানো প্রিন্ট রিপোর্ট অন করা */
    #show-on-print { display: block !important; }
    .print-hr { border-top: 1px solid #000 !important; }
}
</style>

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
    // কোটি, লাখ, হাজার এবং শতর হিসাব (৯৯ কোটি পর্যন্ত নির্ভুল কাজ করবে)
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
        // বার্ষিক সুদের হারকে ১০০০ দিয়ে ভাগ করার পরিবর্তে এখানে মাসিক সুদে কনভার্ট করা হয়েছে
        let monthlyInterest = (interestRate / 100) / 12;
        let emi = (principal * monthlyInterest * Math.pow(1 + monthlyInterest, tenure)) / (Math.pow(1 + monthlyInterest, tenure) - 1);
        
        let totalPayment = emi * tenure;
        let totalInterest = totalPayment - principal;

        document.getElementById('emi-output').innerText = Math.round(emi).toLocaleString('en-IN');
        document.getElementById('total-interest').innerText = Math.round(totalInterest).toLocaleString('en-IN');
        document.getElementById('total-payment').innerText = Math.round(totalPayment).toLocaleString('en-IN');
        document.getElementById('emi-in-words').innerText = "(" + convertToTakaWords(emi) + ")";
    } else {
        // ইনপুট খালি থাকলে জিরো করা
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
    
    // প্রিন্ট কপিতে ইউজার কত লোন এবং কত সুদে ইনপুট দিয়েছিল তা দেখানোর ব্যবস্থা
    document.getElementById('print-inputs').innerHTML = `
        <strong>Loan Amount:</strong> ${parseFloat(amt).toLocaleString('en-IN')} Taka <br>
        <strong>Interest Rate:</strong> ${intr}% (Annual) <br>
        <strong>Duration:</strong> ${mths} Months
    `;
    
    document.getElementById('print-date').innerText = "Generated on: " + new Date().toLocaleString();
    window.print();
}
</script>
