<?php 	
require_once 'core.php';

// রেসপন্স অবজেক্ট (সরাসরি ফ্ল্যাট অ্যারে ব্যবহার করা ভালো)
$valid = array('success' => false, 'messages' => '');

if($_POST) {	
    // ১. ইনপুট স্যানিটাইজেশন
    $DepositDate   = !empty($_POST['DepositDate']) ? date('Y-m-d', strtotime($_POST['DepositDate'])) : null;
    $YearlyAmount  = isset($_POST['YearlyAmount']) ? floatval($_POST['YearlyAmount']) : 0;
    $userid        = $_SESSION['userId']; 

    if($DepositDate && $YearlyAmount > 0) {
        // ২. সিকিউর কুয়েরি (Prepared Statement)
        $sql = "INSERT INTO tblyearlyamount (yearlastdate, yearlyamount, status, creator_id) VALUES (?, ?, ?, ?)";
        
        if($stmt = $connect->prepare($sql)) {
            $status = 1;
            // s = string, d = double (decimal), i = integer
            $stmt->bind_param("sdii", $DepositDate, $YearlyAmount, $status, $userid);

            if($stmt->execute()) {
                $valid['success'] = true;
                $valid['messages'] = "সফলভাবে ইয়ারলি ডিপোজিট তথ্য সংরক্ষণ করা হয়েছে।";	
            } else {
                $valid['success'] = false;
                // ৩. ডুপ্লিকেট এন্ট্রি হ্যান্ডলিং (MySQL Error 1062)
                if($connect->errno == 1062) {
                    $valid['messages'] = "দুঃখিত! এই অ্যামাউন্টটি ইতিমধ্যে ডাটাবেজে সংরক্ষিত আছে।";
                } else {
                    $valid['messages'] = "ডাটাবেজে ত্রুটি: " . $connect->error;
                }
            }
            $stmt->close();
        } else {
            $valid['success'] = false;
            $valid['messages'] = "কুয়েরি প্রিপেয়ার করতে সমস্যা হয়েছে।";
        }
    } else {
        $valid['success'] = false;
        $valid['messages'] = "সবগুলো ঘর সঠিকভাবে পূরণ করুন।";
    }

    $connect->close();
    echo json_encode($valid);
}
?>
