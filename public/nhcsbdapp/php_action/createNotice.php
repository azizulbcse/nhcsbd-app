<?php 	
// ১. জেসন রেসপন্স এবং ক্যারেক্টার সেট লক করা
header('Content-Type: application/json; charset=utf-8');

// ২. সেশন ট্র্যাকিং চেক
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'core.php'; 

// ওল্ড রেসপন্স অ্যারে ভেরিয়েবল
$valid = array('success' => false, 'messages' => array());

if($_POST) {	

    // পিএইচপি ফিল্টারিং
    $NoticeNo      = mysqli_real_escape_string($connect, $_POST['NoticeNo']);
    $noticeDate    = mysqli_real_escape_string($connect, $_POST['noticeDate']);
    $noticeTitle   = mysqli_real_escape_string($connect, $_POST['noticeTitle']);
    $noticeContent = mysqli_real_escape_string($connect, $_POST['noticeContent']);
    
    // সেশন থেকে ইউজার আইডি ট্র্যাকিং
    $userid        = isset($_SESSION['userId']) ? intval($_SESSION['userId']) : 1; 

	// ফাইল হ্যান্ডলিং
	$file_name = $_FILES['noticeFile']['name'];
	$file_tmp  = $_FILES['noticeFile']['tmp_name'];
	$file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

	// 🎯 মাস্টার ফিক্স: ইউনিক নাম একবার জেনারেট করে ভেরিয়েবলে লক করা হলো
	// এর ফলে ফাইল এবং ডাটাবেজ উভয়ের নাম সবসময় হুবহু এক থাকবে, ১ অক্ষরেরও অমিল হবে না
	$generated_id = uniqid();
	$new_file_name = "notice_" . $generated_id . "." . $file_ext;
	
	// পাথ ফিক্স: ল্যারাভেলের notices সাব-ফোল্ডার এলাইনমেন্ট
	$upload_dir = "../uploads/notices/";
	
	if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
	
	$upload_path = $upload_dir . $new_file_name;

	// অ্যালাউড ফাইল টাইপ চেক
	$allowed = array('pdf', 'jpg', 'jpeg', 'png');

	if(in_array($file_ext, $allowed)) {
		if(move_uploaded_file($file_tmp, $upload_path)) {
			
			// 🎯 কুয়েরি ফিক্স: একই ভেরিয়েবল $new_file_name এখানেও ব্যবহার করা হলো
			$sql = "INSERT INTO notices (noticeno, title, notice_date, content, file_name, created_by, status, created_at, updated_at) 
					VALUES ('$NoticeNo', '$noticeTitle', '$noticeDate', '$noticeContent', '$new_file_name', '$userid', 2, NOW(), NOW())";

			if($connect->query($sql) === TRUE) {
				$valid['success'] = true;
				$valid['messages'] = "সফলভাবে নোটিশটি পাবলিশ হয়েছে!";	
			} else {
				$valid['success'] = false;
				$valid['messages'] = "ডাটাবেসে সেভ করতে সমস্যা হয়েছে: " . $connect->error;
			}
		} else {
			$valid['success'] = false;
			$valid['messages'] = "ফাইল আপলোড করতে ব্যর্থ হয়েছে!";
		}
	} else {
		$valid['success'] = false;
		$valid['messages'] = "ভুল ফাইল টাইপ! শুধু PDF বা Image আপলোড করুন।";
	}

	$connect->close();
	echo json_encode($valid);
}
?>
