@extends('layouts.frontend')

@section('title', 'Registered Member List | Nurses Health Care Society Bangladesh')

@section('content')
<main class="main">

    <!-- ========================================== -->
    <!-- ১. পেজ টাইটেল ও প্রিমিয়াম গ্রাডিয়েন্ট ব্যানার সেকশন -->
    <!-- ========================================== -->
    <div class="page-title dark-background" style="background: linear-gradient(135deg, #1A237E 0%, #0056b3 100%); padding: 50px 0; color: #fff;">
      <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0 fw-bold"><i class="bi bi-person-hearts me-2"></i>Member List</h1>
        <nav class="breadcrumbs">
          <ol class="breadcrumb mb-0" style="background: transparent;">
            <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-white-50 text-decoration-none"><i class="bi bi-house-door-fill"></i> Home</a></li>
            <li class="breadcrumb-item active text-white" aria-current="page">Member List</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- ========================================== -->
    <!-- ২. ডাইনামিক মেম্বার লিস্ট গ্রিড সেকশন -->
    <!-- ========================================== -->
    <section id="member-directory" class="member-directory section py-5" style="background-color: #f8f9fa;">
        <div class="container" data-aos="fade-up">
            
            <div class="text-center mb-5">
                <h3 class="fw-bold" style="color: #1A237E;"><i class="bi bi-patch-check-fill text-primary me-2"></i> Registered Members</h3>
                <p class="text-muted small">Proud members of Nurses Health Care Society Bangladesh</p>
            </div>

            <!-- মেম্বার ডাটা রেন্ডারিং এরিয়া (পার্শিয়াল ভিউ ইনক্লুড করা হলো) -->
            <div class="row g-4 justify-content-center" id="member-data-container">
                @include('frontend.partials.member-cards')
            </div>

            <!-- স্ক্রল করার সময় ব্যাকগ্রাউন্ড লোডিং এনিমেশন উইজেট -->
            <div class="text-center mt-5" id="ajax-loading-spinner" style="display: none;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="text-muted small mt-2">নতুন সদস্যদের তালিকা লোড হচ্ছে, অনুগ্রহ করে অপেক্ষা করুন...</p>
            </div>

            <!-- তালিকা শেষ হওয়ার নোটিফিকেশন ব্যাজ -->
            <div class="text-center mt-5" id="no-more-members" style="display: none;">
                <span class="badge bg-secondary rounded-pill px-4 py-2" style="font-size: 13px; font-weight: 600; letter-spacing: 0.3px;">
                    <i class="bi bi-check-all me-1"></i> সদস্য তালিকার শেষ প্রান্তে পৌঁছেছেন
                </span>
            </div>

        </div>
    </section>

</main>

<!-- ========================================== -->
<!-- ৩. অ্যাপ-লাইক কার্ড হোভার এবং সার্কেল জুম সিএসএস -->
<!-- ========================================== -->
<style>
.member-card {
    border-radius: 20px;
    background: #ffffff;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
}
.member-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(26, 35, 126, 0.08) !important;
    border-bottom-color: #05B262 !important; /* হোভার করলে নিচের বর্ডার থিম গ্রিন হবে */
}
.member-name {
    transition: color 0.2s ease;
}
.member-card:hover .member-name {
    color: #1A237E !important;
}
/* ১০০ পিক্সেলের ছবিকে হোভার করলে হালকা বড় করার স্মার্ট ইফেক্ট */
.member-card:hover .avatar-wrapper {
    transform: scale(1.05);
    border-color: #05B262 !important; /* চারপাশের বর্ডার লাইন থিম গ্রিন হবে */
}
</style>

<!-- ========================================== -->
<!-- ৪. পিওর হাই-স্পিড জাভাস্ক্রিপ্ট স্ক্রলিং ইন্টারসেপ্টর ইঞ্জিন -->
<!-- ========================================== -->
<script>
    let nextPageUrl = "{{ $members->nextPageUrl() }}";
    let isLoading = false;

    window.addEventListener("scroll", function () {
        // ইউজার স্ক্রিনের একদম নিচের দিকে পৌঁছেছেন কি না তা ট্র্যাক করা হচ্ছে
        if ((window.innerHeight + window.scrollY) >= (document.documentElement.scrollHeight - 150)) {
            if (nextPageUrl && !isLoading) {
                loadMoreMembers();
            }
        }
    });

    function loadMoreMembers() {
        isLoading = true;
        document.getElementById('ajax-loading-spinner').style.display = 'block';

        // লারাভেলের ব্যাকগ্রাউন্ড AJAX রিকোয়েস্ট মেথড
        fetch(nextPageUrl, {
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        })
        .then(response => response.text())
        .then(html => {
            if (html.trim() === "") {
                nextPageUrl = null;
                document.getElementById('ajax-loading-spinner').style.display = 'none';
                document.getElementById('no-more-members').style.display = 'block';
                return;
            }

            // নতুন ডাটা কার্ডগুলো মেইন কন্টেইনারের নিচে একটার পর একটা যুক্ত হচ্ছে
            document.getElementById('member-data-container').insertAdjacentHTML('beforeend', html);
            
            // লারাভেলের নেক্সট পেজ পাথ ফাইন্ডিং লজিক ট্র্যাক আপডেট
            let currentUrl = new URL(nextPageUrl);
            let pageNum = parseInt(currentUrl.searchParams.get('page')) + 1;
            currentUrl.searchParams.set('page', pageNum);
            
            // যদি মোট পেজ সংখ্যা শেষ হয়ে যায় তবে স্ক্রলিং স্টপ হবে
            if(pageNum > {{ $members->lastPage() }}) {
                nextPageUrl = null;
                document.getElementById('no-more-members').style.display = 'block';
            } else {
                nextPageUrl = currentUrl.toString();
            }

            isLoading = false;
            document.getElementById('ajax-loading-spinner').style.display = 'none';
        })
        .catch(error => {
            console.error("Error loading members:", error);
            isLoading = false;
            document.getElementById('ajax-loading-spinner').style.display = 'none';
        });
    }
</script>
@endsection
