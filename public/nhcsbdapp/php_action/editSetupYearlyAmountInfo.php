<?php 	
require_once 'core.php';

// রেসপন্স অবজেক্ট
$valid = array('success' => false, 'messages' => '');

if($_POST) {	
    // ১. ইনপুট স্যানিটাইজেশন
    $editDepositDate  = !empty($_POST['editDepositDate']) ? date('Y-m-d', strtotime($_POST['editDepositDate'])) : null;
    $editYearlyAmount = isset($_POST['editYearlyAmount']) ? floatval($_POST['editYearlyAmount']) : 0;
    $userid           = $_SESSION['userId']; 
    $YearlyAmountId   = isset($_POST['YearlyAmountId']) ? intval($_POST['YearlyAmountId']) : 0;

    if($YearlyAmountId > 0 && $editDepositDate && $editYearlyAmount > 0) {
        
        // ২. সিকিউর প্রিপেয়ার্ড স্টেটমেন্ট
        $sql = "UPDATE tblyearlyamount SET yearlastdate = ?, yearlyamount = ?, modifier_id = ? 
                WHERE yid = ? AND status = 1";
        
        if($stmt = $connect->prepare($sql)) {
            // s = string, d = double, i = integer, i = integer
            $stmt->bind_param("sdii", $editDepositDate, $editYearlyAmount, $userid, $YearlyAmountId);

            if($stmt->execute()) {
                // ৩. চেক করা যে আসলে কোনো রো আপডেট হয়েছে কি না
                if($stmt->affected_rows > 0) {
                    $valid['success'] = true;
                    $valid['messages'] = "সফলভাবে ইয়ারলি ডিপোজিট তথ্য আপডেট করা হয়েছে।";
                } else {
                    $valid['success'] = true; // টেকনিক্যালি সাকসেস কিন্তু ডাটা একই ছিল
                    $valid['messages'] = "কোনো পরিবর্তন করা হয়নি বা তথ্যটি ইতিমধ্যে আপডেট করা আছে।";
                }
            } else {
                $valid['success'] = false;
                // ৪. ডুপ্লিকেট এন্ট্রি হ্যান্ডলিং (যেহেতু আপনি ডাটাবেজে Unique করে দিয়েছেন)
                if($connect->errno == 1062) {
                    $valid['messages'] = "দুঃখিত! এই অ্যামাউন্টটি ইতিমধ্যে অন্য একটি এন্ট্রিতে ব্যবহৃত হচ্ছে।";
                } else {
                    $valid['messages'] = "আপডেট করার সময় ত্রুটি হয়েছে: " . $connect->error;
                }
            }
            $stmt->close();
        }
    } else {
        $valid['success'] = false;
        $valid['messages'] = "সবগুলো তথ্য সঠিকভাবে প্রদান করুন।";
    }

    $connect->close();
    echo json_encode($valid);
}
?>
