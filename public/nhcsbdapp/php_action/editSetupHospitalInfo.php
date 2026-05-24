<?php 	
header('Content-Type: application/json; charset=utf-8');
require_once 'core.php'; 

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
    // ইনপুট গ্রহণ
	$editHospitalName = trim($_POST['editHospitalName']);
	$userid           = $_SESSION['userId']; 
    $hid              = $_POST['hid'];

    if(empty($editHospitalName) || empty($hid)) {
        $valid['success'] = false;
        $valid['messages'] = "সবগুলো তথ্য প্রদান করা বাধ্যতামূলক!";
    } else {
        // ১. ইউনিক চেক: এই নামটি অন্য কোনো হসপিটালে (অন্য hid-তে) ব্যবহার করা হয়েছে কি না
        $checkSql = "SELECT * FROM tblhospitalname WHERE hospitalname = ? AND hid != ?";
        $checkStmt = $connect->prepare($checkSql);
        $checkStmt->bind_param("si", $editHospitalName, $hid);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if($checkResult->num_rows > 0) {
            $valid['success'] = false;
            $valid['messages'] = "দুঃখিত! এই হসপিটালের নাম আগে থেকেই অন্য একটি এন্ট্রিতে ব্যবহৃত হচ্ছে।";
        } else {
            // ২. সব ঠিক থাকলে আপডেট করা (Prepared Statement ব্যবহার করে)
            $sql = "UPDATE tblhospitalname SET hospitalname = ?, modifier_id = ? WHERE hid = ?";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("sii", $editHospitalName, $userid, $hid);

            if($stmt->execute()) {
                $valid['success'] = true;
                $valid['messages'] = "সফলভাবে হসপিটালের তথ্য আপডেট করা হয়েছে।";	
            } else {
                $valid['success'] = false;
                $valid['messages'] = "আপডেট করার সময় কারিগরি ত্রুটি হয়েছে।";
            }
            $stmt->close();
        }
        $checkStmt->close();
    }
	 
	$connect->close();
	echo json_encode($valid);
 
} // /if $_POST
?>
