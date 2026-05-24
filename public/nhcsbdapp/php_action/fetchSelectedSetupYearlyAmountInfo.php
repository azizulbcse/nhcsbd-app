<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'core.php';

$response = null;

// ১. আইডি চেক এবং সিকিউরিটি (Integer Casting)
$YearlyAmountId = isset($_POST['YearlyAmountId']) ? intval($_POST['YearlyAmountId']) : 0;

if($YearlyAmountId > 0) {
    // ২. সিকিউর প্রিপেয়ার্ড স্টেটমেন্ট (SQL Injection সুরক্ষা)
    $sql = "SELECT yid, yearlastdate, yearlyamount FROM tblyearlyamount WHERE yid = ? AND status = 1 LIMIT 1";
    
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $YearlyAmountId);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        // ৩. fetch_assoc() ব্যবহার করা স্মার্ট (কলামের নাম দিয়ে ডাটা পাওয়া যায়)
        $response = $result->fetch_assoc();
    }
    
    $stmt->close();
}

$connect->close();

// ৪. JSON হিসেবে আউটপুট পাঠানো
echo json_encode($response);
exit;
