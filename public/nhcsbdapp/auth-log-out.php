<?php
// ১. সেশন শুরু করা (যদি আগে থেকে শুরু না হয়ে থাকে)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ২. সেশনের সব ভেরিয়েবল ক্লিয়ার করা
$_SESSION = array();

// ৩. সেশন কুকি ধ্বংস করা (নিরাপত্তার জন্য এটি অনেক জরুরি)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// ৪. সেশন পুরোপুরি ডিস্ট্রয় বা ধ্বংস করা
session_destroy();

// ৫. ল্যারাভেল আর্কিটেকচার মেনে ওল্ড ফোল্ডার থেকে বের হয়ে মেইন রুট হোমপেজে পাঠিয়ে দেওয়া
// যেহেতু ফাইলটি public/nhcsbdapp/ ফোল্ডারের ভেতরে আছে, তাই '/' দিলে সে সরাসরি মূল ডোমেইন বা লোকালহোস্টের হোমে রিডাইরেক্ট করবে
header("Location: /"); 
exit();
?>
