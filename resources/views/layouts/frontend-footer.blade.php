<footer id="footer" class="footer dark-background">
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
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4 class="footer-title">Useful Links</h4>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ url('/') }}">Home</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ url('constitution.php') }}">Constitution</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ url('admin-list.php') }}">Administrator List</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ url('member-list.php') }}">Member List</a></li>
                    </ul>
                </div>

                <!-- Our Services -->
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4 class="footer-title">Our Services</h4>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ url('admin-login.php') }}">Admin Login</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ url('member-login.php') }}">Member Login</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ url('contact-payment.php') }}">Deposit Details</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ url('emi-calculator.php') }}">EMI Calculator</a></li>
                    </ul>
                </div>

                <!-- Quick Support -->
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4 class="footer-title">Quick Support</h4>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="#">Help Center</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="#">How it Works</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="#">F.A.Qs</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="#">Complain</a></li>
                    </ul>
                </div>

                <!-- Membership -->
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4 class="footer-title">Membership</h4>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ url('application4join.php') }}">Application for Join</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ url('terms&condition.php') }}">Terms & Condition</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ url('vision.php') }}">Visions</a></li>
                        <li><i class="bi bi-chevron-right me-1"></i> <a href="{{ url('mision.php') }}">Missions</a></li>
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

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</div>
