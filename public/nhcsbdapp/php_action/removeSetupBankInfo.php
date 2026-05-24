<?php 	
header('Content-Type: application/json; charset=utf-8');
require_once 'core.php';  

// ১. রেসপন্স স্ট্রাকচার ঠিক করা (সরাসরি অ্যারে)
$valid = array('success' => false, 'messages' => '');

// ২. আইডি চেক এবং স্যানিটাইজ করা
$BankId = isset($_POST['BankId']) ? intval($_POST['BankId']) : 0;

if($BankId > 0) { 
    // ৩. Prepared Statement ব্যবহার করা (সিকিউরিটির জন্য)
    $sql = "UPDATE tblbankinfo SET status = 0 WHERE bank_id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $BankId);

    if($stmt->execute()) {
        $valid['success'] = true;
        $valid['messages'] = "সফলভাবে বাতিল (Cancel) করা হয়েছে।";		
    } else {
        $valid['success'] = false;
        $valid['messages'] = "বাতিল করার সময় ডাটাবেজ ত্রুটি হয়েছে।";
    }
    
    $stmt->close();
} else {
    $valid['success'] = false;
    $valid['messages'] = "সঠিক আইডি পাওয়া যায়নি!";
}

$connect->close();
echo json_encode($valid);
