<?php 	
require_once 'core.php';

// রেসপন্স অবজেক্ট
$valid = array('success' => false, 'messages' => '');

if($_POST) {	
    // ১. ইনপুট স্যানিটাইজেশন
    $MonthId      = intval($_POST['MonthId']);
    $DepositMonth = trim($_POST['editDepositMonth']);
    $DepositYear  = intval($_POST['editDepositYear']);
    $userid       = $_SESSION['userId'];

    if($MonthId > 0 && !empty($DepositMonth) && $DepositYear > 0) {
        
        // ২. ইউনিক চেক: বর্তমান আইডি বাদে অন্য কোথাও এই নাম ও বছর আছে কি না
        $checkSql = "SELECT mid FROM tblmonthname WHERE mname = ? AND year = ? AND mid != ? AND status != 0";
        $checkStmt = $connect->prepare($checkSql);
        $checkStmt->bind_param("sii", $DepositMonth, $DepositYear, $MonthId);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if($checkResult->num_rows > 0) {
            $valid['success'] = false;
            $valid['messages'] = "দুঃখিত! এই বছরে এই মাসের নাম ইতিমধ্যে অন্য একটি এন্ট্রিতে ব্যবহৃত হচ্ছে।";
        } else {
            // ৩. ডাটা আপডেট (Prepared Statement)
            $sql = "UPDATE tblmonthname SET mname = ?, year = ?, modifier_id = ? WHERE mid = ? AND status = 2";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("siii", $DepositMonth, $DepositYear, $userid, $MonthId);

            if($stmt->execute()) {
                $valid['success'] = true;
                $valid['messages'] = "সফলভাবে ডিপোজিট মাসের তথ্য আপডেট করা হয়েছে।";	
            } else {
                $valid['success'] = false;
                $valid['messages'] = "আপডেট করার সময় কারিগরি ত্রুটি হয়েছে।";
            }
            $stmt->close();
        }
        $checkStmt->close();
    } else {
        $valid['success'] = false;
        $valid['messages'] = "সবগুলো তথ্য সঠিকভাবে প্রদান করুন।";
    }

    $connect->close();
    echo json_encode($valid);
}
?>
