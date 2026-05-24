<?php 	
header('Content-Type: application/json; charset=utf-8');
require_once 'core.php'; 

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$bankName = trim($_POST['bankName']); // অতিরিক্ত স্পেস মুছে ফেলার জন্য

	if(empty($bankName)) {
		$valid['success'] = false;
		$valid['messages'] = "ব্যাংকের নাম প্রদান করা বাধ্যতামূলক!";
	} else {
		// ১. ডুপ্লিকেট বা ইউনিক চেক (একই নাম আগে আছে কি না)
		$checkSql = "SELECT * FROM tblbankinfo WHERE bank_name = ? AND status = 1";
		$stmtCheck = $connect->prepare($checkSql);
		$stmtCheck->bind_param("s", $bankName);
		$stmtCheck->execute();
		$result = $stmtCheck->get_result();

		if($result->num_rows > 0) {
			// নাম আগে থেকেই থাকলে এই মেসেজ দেখাবে
			$valid['success'] = false;
			$valid['messages'] = "দুঃখিত! এই ব্যাংকের নাম আগে থেকেই সিস্টেমে যুক্ত আছে।";
		} else {
			// ২. সব ঠিক থাকলে নতুন ডাটা ইনসার্ট করা (Prepared Statement)
			$sql = "INSERT INTO tblbankinfo (bank_name, status) VALUES (?, '1')";
			$stmt = $connect->prepare($sql);
			$stmt->bind_param("s", $bankName);

			if($stmt->execute()) {
				$valid['success'] = true;
				$valid['messages'] = "সফলভাবে ব্যাংকের নাম যুক্ত করা হয়েছে।";	
			} else {
				$valid['success'] = false;
				$valid['messages'] = "তথ্যটি যুক্ত করার সময় কারিগরি ত্রুটি হয়েছে।";
			}
			$stmt->close();
		}
		$stmtCheck->close();
	}

	$connect->close();
	echo json_encode($valid);
 
} // /if $_POST
?>
