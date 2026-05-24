<?php 	
// ১. ক্যারেক্টার সেট এবং হেডার সিকিউরিটি লক করা
header('Content-Type: application/json; charset=utf-8');
require_once 'core.php';

// ওল্ড রেসপন্স অ্যারে ভেরিয়েবল
$valid = array('success' => false, 'messages' => array());

// আপনার ওল্ড জাভাস্ক্রিপ্ট অনক্লিক (onclick="publishNotice(id)") থেকে আসা পোস্ট আইডি
$noticeId = isset($_POST['noticeId']) ? intval($_POST['noticeId']) : 0;

if($noticeId > 0) {
    
    // 🎯 স্ক্রিনশট অনুযায়ী টেবিল নাম 'notices' দিয়ে আপডেট কুয়েরি ফিক্স করা হলো
    // স্ট্যাটাস ১ (Pending) থেকে ২ (Published) এ রূপান্তর এবং ল্যারাভেলের updated_at টাইমস্ট্যাম্প আপডেট
    $sql = "UPDATE notices SET status = 2, updated_at = NOW() WHERE id = {$noticeId}";

    if($connect->query($sql) === TRUE) {
        if($connect->affected_rows > 0) {
            $valid['success'] = true;
            $valid['messages'] = "অভিনন্দন! নোটিশটি সফলভাবে পাবলিশ হয়েছে।";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "দুঃখিত! এই নোটিশটি ইতিমধ্যে পাবলিশ করা হয়েছে বা কোনো পরিবর্তন করা হয়নি।";
        }
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error while publishing the notice: " . $connect->error;
    }
	 
    $connect->close();
    // ওল্ড এজাক্স হ্যান্ডেলারকে রেসপন্স পাঠানো
    echo json_encode($valid);
} else {
    $valid['success'] = false;
    $valid['messages'] = "ভুল নোটিশ আইডি পাঠানো হয়েছে।";
    echo json_encode($valid);
}
?>
