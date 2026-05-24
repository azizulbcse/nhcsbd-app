<?php 	

require_once 'core.php'; // ডাটাবেস কানেকশন এবং সেশন চেক করার জন্য

$valid['success'] = array('success' => false, 'messages' => array());

$noticeId = $_POST['noticeId'];

if($noticeId) {

    // আমরা সরাসরি ডাটা ডিলিট না করে স্ট্যাটাস ০ করে দেব (Soft Delete)
    // এবং নিরাপত্তার জন্য চেক করব যেন শুধুমাত্র status = 1 (Pending) থাকলেই এটি কাজ করে
    $sql = "UPDATE tblnotices SET status = 0 WHERE id = {$noticeId} AND status = 1";

    if($connect->query($sql) === TRUE) {
        
        // affected_rows চেক করে নিশ্চিত হওয়া যে আসলেই কোনো রো আপডেট হয়েছে কি না
        // যদি status ১ না হয়ে ২ (Published) থাকতো, তবে affected_rows ০ হবে
        if($connect->affected_rows > 0) {
            $valid['success'] = true;
            $valid['messages'] = "সফলভাবে নোটিশটি রিমুভ করা হয়েছে।";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "দুঃখিত! নোটিশটি পাবলিশ হয়ে গেছে অথবা অলরেডি রিমুভ করা হয়েছে।";
        }
        
    } else {
        $valid['success'] = false;
        $valid['messages'] = "ডাটাবেস আপডেট করতে সমস্যা হয়েছে: " . $connect->error;
    }
	 
    $connect->close();

    echo json_encode($valid);
 
} // /if $_POST
