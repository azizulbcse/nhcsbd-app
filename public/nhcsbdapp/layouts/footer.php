<!-- FontAwesome আইকনের জন্য এই লিঙ্কটি হেডার বা ফুটারের শুরুতে নিশ্চিত করুন -->
<link rel="stylesheet" href="https://cloudflare.com">

<style>
    /* স্মার্ট ফুটার কার্ড */
    .smart-footer {
        background: #ffffff;
        padding: 15px 30px;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 20px;
        border-bottom: 4px solid #05B262; /* লোগোর সবুজ বর্ডার */
    }

    /* ব্লিংকিং টেক্সট এনিমেশন */
    .blink-text {
        color: #555;
        font-size: 14px;
        animation: smoothFade 2s infinite;
    }

    .heart-icon {
        color: #e74c3c;
        animation: beat 1.2s infinite;
        display: inline-block;
    }

    @keyframes smoothFade {
        0% { opacity: 1; }
        50% { opacity: 0.4; }
        100% { opacity: 1; }
    }

    @keyframes beat {
        0% { transform: scale(1); }
        50% { transform: scale(1.3); }
        100% { transform: scale(1); }
    }

    /* সোশ্যাল আইকন স্টাইল */
    .social-links {
        display: flex;
        list-style: none;
        gap: 12px;
        margin: 0;
        padding: 0;
        align-items: center;
    }

    .social-links li a {
        width: 35px;
        height: 35px;
        background: #f1f3f5;
        color: #1A237E; /* লোগোর নীল */
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        text-decoration: none;
        transition: 0.3s ease-in-out;
        font-size: 16px;
    }

    .social-links li a:hover {
        background: #1A237E;
        color: #ffffff;
        transform: translateY(-3px);
    }

    .copyright-text {
        font-size: 14px;
        color: #444;
    }
    
    .copyright-text a {
        color: #1A237E;
        text-decoration: none;
        font-weight: bold;
    }
</style>

<div class="container-fluid">
    <div class="smart-footer">
        <!-- বাম পাশের টেক্সট -->
        <div class="copyright-text">
            © 2024 <a href="https://nhcsbd.org">Nurses Health Care Society</a> | 
            <span class="blink-text">Developed with <span class="heart-icon">❤️</span> by</span> 
            <a href="http://matriksolutions.com" target="_blank">Matrik Solutions</a>
        </div>
    </div>
</div>
