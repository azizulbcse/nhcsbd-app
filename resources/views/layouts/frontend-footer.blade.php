<footer id="footer" class="footer dark-background no-print">
    {{-- 'no-print' ক্লাসটি যোগ করায় লোন কোটেশন প্রিন্ট করার সময় এই ফুটারটি কাগজে আসবে না --}}
    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                
                <!-- About & Contact Info -->
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="{{ url('/') }}" class="logo d-flex align-items-center mb-3">
                        <span class="sitename fw-bold text-primary" style="font-size: 2rem; letter-spacing: 1px;">NHCS</span>
                    </a>
                    <div class="footer-contact">
                        <div class="d-flex mb-3">
                            <i class="bi bi-geo-alt text-primary me-3 fs-5"></i>
                            <p class="mb-0">Sher-e-Bangla Nagar, <br> Dhaka-1207, Bangladesh</p>
                        </div>
                        <div class="d-flex mb-3 align-items-center">
                            <i class="bi bi-telephone text-primary me-3 fs-5"></i>
                            <div>
                                <a href="tel:01717288965" class="text-decoration-none text-reset">01717288965</a>, 
                                <a href="tel:01689597474" class="text-decoration-none text-reset">01689597474</a>
                            </div>
                        </div>
                        <div class="d-flex mb-3 align-items-center">
                            <i class="bi bi-envelope text-primary me-3 fs-5"></i>
                            <a href="mailto:nhcs.org.bd@gmail.com" class="text-decoration-none text-reset">nhcs.org.bd@gmail.com</a>
                        </div>
                    </div>
                </div>

                <!-- Useful Links -->
                                <!-- Useful Links -->
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4 class="footer-title">Useful Links</h4>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ route('home') ?? url('/') }}">Home</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ route('pages.constitution') }}">Constitution</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ route('administrator.list') ?? url('/administrator-list') }}">Administrator List</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ route('member.list') ?? url('/member-list') }}">Member List</a></li>
                    </ul>
                </div>

                <!-- Our Services -->
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4 class="footer-title">Our Services</h4>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ url('/login') }}">Admin Login</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ url('/login') }}">Member Login</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ url('/deposit-details') }}">Deposit Details</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ route('loan.calculator') ?? url('/emi-calculator') }}">EMI Calculator</a></li>
                    </ul>
                </div>

                <!-- Quick Support -->
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4 class="footer-title">Quick Support</h4>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ url('/notice') }}">Official Notice</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ url('/gallery/photo') }}">Photo Gallery</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ url('/gallery/video') }}">Video Gallery</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ route('contact') ?? url('/contact') }}">Complain / Support</a></li>
                    </ul>
                </div>

                <!-- Membership -->
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4 class="footer-title">Membership</h4>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ route('member.join') ?? url('/application4join') }}">Application for Join</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ route('pages.terms') ?? url('/terms-conditions') }}">Terms & Condition</a></li>
                        {{-- ডামি লিংক বাদ দিয়ে এগুলোকে একটি সিঙ্গেল প্রফেশনাল স্ট্যাটিক পেজে এসাইন করার জন্য রেডি রাখা হলো --}}
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ url('/about') }}">Our Visions</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ url('/about') }}">Our Missions</a></li>
                    </ul>
                </div>


            </div>
        </div>
    </div>

    <!-- Copyright & Social Links -->
    <div class="copyright text-center">
        <div class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">
            <div class="d-flex flex-column align-items-center align-items-lg-start">
                <div>
                    © Copyright {{ date('Y') }} <a href="https://nhcsbd.org/">Nurses Health Care Society</a>
                </div>
                <div class="credits">
                    Designed & Developed by <a href="https://it.matrik.com.bd/" target="_blank" rel="noopener">Matrik</a>
                </div>
            </div>
            <div class="social-links order-first order-lg-last mb-3 mb-lg-0">
                <a href="#"><i class="bi bi-twitter-x"></i></a>
                <a href="https://www.facebook.com/nhcsorg.bd" target="_blank" rel="noopener"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div>
</footer>

<!-- Scroll Top (প্রিন্ট কপি থেকে সুরক্ষিত করা হলো) -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center no-print"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader (অফলাইন ব্লকিং রিমুভাল সেফটি লক সহ) -->
<div id="preloader" class="no-print">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</div>

<!-- ========================================== -->
<!-- ৩. গ্লোবাল মাস্টার প্রিন্ট প্রোটেকশন সিএসএস -->
<!-- ========================================== -->
<style>
@media print {
    /* প্রিন্ট করার সময় এই ফুটার স্ক্রিনের কোনো এলিমেন্ট যেন কুৎসিত জটলা না পাকায় */
    .no-print, #footer, #scroll-top, #preloader {
        display: none !important;
        visibility: hidden !important;
        height: 0 !important;
        padding: 0 !important;
        margin: 0 !important;
    }
}
</style>

<!-- ========================================== -->
<!-- ৪. প্রি-লোডার ডিফেন্সিভ জাভাস্ক্রিপ্ট ফেইলসেফ -->
<!-- ========================================== -->
<script>
    // কোনো কারণে মেইন স্ক্রিপ্ট লোড হতে লেট হলেও প্রি-লোডার যেন ইউজার স্ক্রিনকে ব্লক না করে
    window.addEventListener('load', function() {
        const preloader = document.getElementById('preloader');
        if (preloader) {
            preloader.style.opacity = '0';
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 300);
        }
    });
    // ফেইলসেফ ব্যাকআপ: ৫ সেকেন্ডের বেশি প্রি-লোডার স্ক্রিনে কোনোভাবেই থাকবে না
    setTimeout(() => {
        const preloader = document.getElementById('preloader');
        if (preloader && preloader.style.display !== 'none') {
            preloader.style.display = 'none';
        }
    }, 5000);
</script>
