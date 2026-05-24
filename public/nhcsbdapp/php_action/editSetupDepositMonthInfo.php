<?php 	
require_once 'core.php';

// রেসপন্স অবজেক্ট (সরাসরি ফ্ল্যাট অ্যারে ব্যবহার করা ক্লিন)
$valid = ['success' => false, 'messages' => ''];

if($_POST) {	
    // ১. ইনপুট স্যানিটাইজেশন
    $editDepositMonth = trim($_POST['editDepositMonth']);
    $editDepositYear  = intval($_POST['editDepositYear']);
    $userid           = $_SESSION['userId'];
    $MonthId          = intval($_POST['MonthId']);

    if($MonthId > 0 && !empty($editDepositMonth) && $editDepositYear > 0) {
        
        // ২. সিকিউর প্রিপেয়ার্ড স্টেটমেন্ট (SQL Injection সুরক্ষা)
        $sql = "UPDATE tblmonthname SET mname = ?, year = ?, modifier_id = ? WHERE mid = ?";
        
        if($stmt = $connect->prepare($sql)) {
            // s = string, i = integer, i = integer, i = integer
            $stmt->bind_param("siii", $editDepositMonth, $editDepositYear, $userid, $MonthId);

            if($stmt->execute()) {
                $valid['success'] = true;
                $valid['messages'] = "সফলভাবে তথ্য আপডেট করা হয়েছে।";	
            } else {
                $valid['success'] = false;
                // ৩. ডুপ্লিকেট এন্ট্রি হ্যান্ডলিং (MySQL Error 1062)
                if($connect->errno == 1062) {
                    $valid['messages'] = "দুঃখিত! এই বছরে এই মাসের নাম ইতিমধ্যে ডাটাবেজে রয়েছে।";
                } else {
                    $valid['messages'] = "আপডেট করার সময় ত্রুটি হয়েছে: " . $connect->error;
                }
            }
            $stmt->close();
        }
    } else {
        $valid['success'] = false;
        $valid['messages'] = "দয়া করে সবগুলো ঘর সঠিকভাবে পূরণ করুন।";
    }

    $connect->close();
    echo json_encode($valid);
}
?>
