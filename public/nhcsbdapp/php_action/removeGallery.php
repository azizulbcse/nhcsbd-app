<?php 	
// ১. ক্যারেক্টার সেট এবং হেডার সিকিউরিটি লক করা
header('Content-Type: application/json; charset=utf-8');
require_once 'core.php';

// ওল্ড রেসপন্স অ্যারে ভেরিয়েবল
$valid = array('success' => false, 'messages' => array());

if($_POST) {
    // আপনার ওল্ড জাভাস্ক্রিপ্ট অনক্লিক (onclick="removeGallery(id)") থেকে আসা পোস্ট আইডি ফিল্টারিং
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if($id > 0) {
        // 🎯 ল্যারাভেল মাইগ্রেশন ও ডাটাবেজ অনুযায়ী আসল টেবিল 'galleries' দিয়ে ডিলিট কুয়েরি ফিক্স করা হলো
        $sql = "DELETE FROM galleries WHERE id = $id";
        
        if($connect->query($sql) === TRUE) {
            $valid['success'] = true;
            $valid['messages'] = "Successfully Removed";	
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while removing: " . $connect->error;
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
