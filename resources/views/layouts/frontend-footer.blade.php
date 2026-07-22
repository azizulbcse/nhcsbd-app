<footer id="footer" class="footer dark-background no-print">
    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                
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

                <!-- Membership (Kept Completely Unchanged + Added Phase-II Dynamic Route Link) -->
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4 class="footer-title">Membership</h4>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ route('member.join') ?? url('/application4join') }}">Application for Join</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ route('phaseii.apply') }}">Phase-II Application</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ route('pages.terms') ?? url('/terms-conditions') }}">Terms & Condition</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ url('/about') }}">Our Visions</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="copyright text-center">
        <div class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">
            <div class="d-flex flex-column align-items-center align-items-lg-start" style="gap: 4px; font-family: 'Poppins', sans-serif;">
    <div style="font-size: 13.5px; color: #a0aec0; font-weight: 400; letter-spacing: 0.3px;">
        &copy; Copyright {{ date('Y') }} 
        <a href="https://nhcsbd.org" style="color: #ffffff; text-decoration: none; font-weight: 600; transition: color 0.2s ease-in-out;" onmouseover="this.style.color='#0077b6'" onmouseout="this.style.color='#ffffff'">
            Nurses Health Care Society
        </a>. All Rights Reserved.
    </div>
    
    <!-- Premium Soft Blink/Glow Animation CSS embedded natively -->
    <style>
        @keyframes softBlinkGlow {
            0% { opacity: 0.7; transform: scale(1); filter: drop-shadow(0 0 0px rgba(49, 130, 206, 0)); }
            50% { opacity: 1; transform: scale(1.02); filter: drop-shadow(0 0 4px rgba(49, 130, 206, 0.6)); color: #63b3ed; }
            100% { opacity: 0.7; transform: scale(1); filter: drop-shadow(0 0 0px rgba(49, 130, 206, 0)); }
        }
        .smart-blink-brand {
            display: inline-block;
            animation: softBlinkGlow 3s infinite ease-in-out;
            font-weight: 700 !important;
        }
    </style>

    <!-- Smart Corporate Credits Tag with Responsive View tracking -->
    <div class="credits" style="font-size: 12px; color: #718096; font-weight: 500; letter-spacing: 0.2px;">
        Technology Partner: 
        <a href="https://web.facebook.com/fringebytetech" target="_blank" rel="noopener" class="smart-blink-brand" style="color: #3182ce; text-decoration: none; transition: all 0.3s ease-in-out;">
            FringeByte Technologies
        </a>
    </div>
</div>

            <div class="social-links order-first order-lg-last mb-3 mb-lg-0">
                <a href="#"><i class="bi bi-twitter-x"></i></a>
                <a href="https://facebook.com" target="_blank" rel="noopener"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div>
</footer>

<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center no-print"><i class="bi bi-arrow-up-short"></i></a>

<div id="preloader" class="no-print">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</div>
<style>
@media print {
    .no-print, #footer, #scroll-top, #preloader {
        display: none !important;
        visibility: hidden !important;
        height: 0 !important;
        padding: 0 !important;
        margin: 0 !important;
    }
}
</style>

<script>
    window.addEventListener('load', function() {
        const preloader = document.getElementById('preloader');
        if (preloader) {
            preloader.style.opacity = '0';
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 300);
        }
    });
    setTimeout(() => {
        const preloader = document.getElementById('preloader');
        if (preloader && preloader.style.display !== 'none') {
            preloader.style.display = 'none';
        }
    }, 5000);
</script>
