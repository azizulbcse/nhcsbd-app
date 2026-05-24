<?php 	
header('Content-Type: application/json; charset=utf8');
require_once 'core.php'; 

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$HospitalName = trim($_POST['HospitalName']);
	$userid       = $_SESSION['userId']; 

    if(empty($HospitalName)) {
        $valid['success'] = false;
        $valid['messages'] = "হসপিটালের নাম প্রদান করা বাধ্যতামূলক!";
    } else {
        // ১. স্মার্ট চেক: এই হসপিটালের নাম আগে থেকেই ডাটাবেসে আছে কি না
        $checkSql = "SELECT * FROM tblhospitalname WHERE hospitalname = ?";
        $checkStmt = $connect->prepare($checkSql);
        $checkStmt->bind_param("s", $HospitalName);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if($checkResult->num_rows > 0) {
            // যদি নাম আগেই থাকে
            $valid['success'] = false;
            $valid['messages'] = "দুঃখিত! এই হসপিটালের নাম আমাদের সিস্টেমে আগে থেকেই রয়েছে।";
        } else {
            // ২. নতুন নাম হিসেবে সেভ করা (Prepared Statement)
            $sql = "INSERT INTO tblhospitalname (hospitalname, status, creator_id) VALUES (?, '1', ?)";
            $stmt = $connect->prepare($sql);
            $stmt->bind_param("si", $HospitalName, $userid);

            if($stmt->execute()) {
                $valid['success'] = true;
                $valid['messages'] = "সফলভাবে হসপিটালের নাম যুক্ত করা হয়েছে।";	
            } else {
                $valid['success'] = false;
                $valid['messages'] = "তথ্যটি যুক্ত করার সময় কারিগরি ত্রুটি হয়েছে।";
            }	 
            $stmt->close();
        }
        $checkStmt->close();
    }

	$connect->close();
	echo json_encode($valid);
}
?>
