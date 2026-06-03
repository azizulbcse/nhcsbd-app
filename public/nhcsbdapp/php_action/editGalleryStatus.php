<?php 	
// ১. ক্যারেক্টার সেট এবং হেডার সিকিউরিটি লক করা
header('Content-Type: application/json; charset=utf-8');
require_once 'core.php';

// ওল্ড রেসপন্স অ্যারে ভেরিয়েবল
$valid = array('success' => false, 'messages' => array());

if($_POST) {
    // আপনার ওল্ড জাভাস্ক্রিপ্ট অনক্লিক থেকে আসা পোস্ট আইডি ও স্ট্যাটাস ফিল্টারিং
    $id     = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $status = isset($_POST['status']) ? intval($_POST['status']) : 2; // ২ = Published হিসেবে ফিক্সড ট্র্যাকিং

    if($id > 0) {
        // 🎯 ল্যারাভেল মাইগ্রেশন ও ডাটাবেজ অনুযায়ী আসল টেবিল 'galleries' এবং টাইমস্ট্যাম্প দিয়ে কুয়েরি ফিক্স করা হলো
        $sql = "UPDATE galleries SET status = $status, updated_at = NOW() WHERE id = $id";
        
        if($connect->query($sql) === TRUE) {
            $valid['success'] = true;
            $valid['messages'] = "Successfully Published";	
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while updating: " . $connect->error;
        }
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Invalid Media ID provided.";
    }

    $connect->close();
    // ওল্ড এজাক্স হ্যান্ডেলারকে রেসপন্স পাঠানো
    echo json_encode($valid);
}
?>
