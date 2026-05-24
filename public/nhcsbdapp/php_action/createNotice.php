<?php 	
// ১. ক্যারেক্টার সেট এবং হেডার সিকিউরিটি লক করা (বাংলা ডাটা সাপোর্ট করার জন্য)
header('Content-Type: text/html; charset=utf-8');

// ২. সেশন শুরু করা
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ৩. কোর কানেকশন ফাইল ইনক্লুড করা
require_once 'core.php'; 

// ওল্ড রেসপন্স অ্যারে ভেরিয়েবল
$valid = array('success' => false, 'messages' => array());

if($_POST) {	

    // ৪. ডাটাবেজ প্রটেকশন সহ ইনপুট ফিল্টারিং
    $NoticeNo      = mysqli_real_escape_string($connect, $_POST['NoticeNo']);
    $noticeTitle   = mysqli_real_escape_string($connect, $_POST['noticeTitle']);
    $noticeDate    = mysqli_real_escape_string($connect, $_POST['noticeDate']);
    $noticeContent = mysqli_real_escape_string($connect, $_POST['noticeContent']);
	
    // সেশন থেকে লগইন করা অ্যাডমিনের আইডি ট্র্যাকিং
    $userid        = isset($_SESSION['userId']) ? $_SESSION['userId'] : 1; 

    // ৫. ফাইল হ্যান্ডলিং ইঞ্জিন (PDF/Image)
    $file_name = $_FILES['noticeFile']['name'];
    $file_tmp  = $_FILES['noticeFile']['tmp_name'];
    $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // ইউনিক ফাইলনেম জেনারেশন (ফাইল ওভাররাইট প্রোটেকশন)
    $new_file_name = "notice_" . uniqid() . "." . $file_ext;
	
    // 🎯 ফ্রন্টএন্ড পাথের সাথে মিল রেখে র-পিএইচপি আপলোড পাথ সাব-ডিরেক্টরি ফিক্স
    // ডাবল ব্যাক ট্র্যাকিং দিয়ে সরাসরি 'notices' সাব-ফোল্ডারে ফাইল পাঠানো হলো
    $upload_dir = "../uploads/notices/";
	
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
	
    $upload_path = $upload_dir . $new_file_name;

    // অনুমোদিত ফাইল ফরম্যাট চেক
    $allowed = array('pdf', 'jpg', 'jpeg', 'png');

    if(in_array($file_ext, $allowed)) {
        if(move_uploaded_file($file_tmp, $upload_path)) {
			
            // 🎯 স্ক্রিনশটের পিওর কলাম নেম ও স্ট্যাটাস (status = 2) অনুযায়ী ইনসার্ট কুয়েরি
            $sql = "INSERT INTO notices (noticeno, title, notice_date, content, file_name, created_by, status, created_at, updated_at) 
                    VALUES ('$NoticeNo', '$noticeTitle', '$noticeDate', '$noticeContent', '$new_file_name', '$userid', 2, NOW(), NOW())";

            if($connect->query($sql) === TRUE) {
                $valid['success'] = true;
                $valid['messages'] = "সফলভাবে নোটিশটি পাবলিশ হয়েছে!";	
            } else {
                $valid['success'] = false;
                $valid['messages'] = "ডাটাবেসে সেভ করতে সমস্যা হয়েছে: " . $connect->error;
            }
        } else {
            $valid['success'] = false;
            $valid['messages'] = "ফাইল আপলোড করতে ব্যর্থ হয়েছে!";
        }
    } else {
        $valid['success'] = false;
        $valid['messages'] = "ভুল ফাইল টাইপ! শুধু PDF বা Image আপলোড করুন।";
    }

    $connect->close();
    echo json_encode($valid);
}
?>
