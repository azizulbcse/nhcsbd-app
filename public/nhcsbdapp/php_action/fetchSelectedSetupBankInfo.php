<?php
header('Content-Type: application/json; charset=utf-8'); // JSON ডাটা হিসেবে ডিফাইন করা
require_once 'core.php';

$response = null; // ডিফল্ট রেসপন্স

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['BankId'])) {
    
    // ১. সিকিউরিটি: ইনপুটকে ইন্টিজারে রূপান্তর করা (SQL Injection ঠেকাবে)
    $bankId = intval($_POST['BankId']);

    if ($bankId > 0) {
        // ২. সিকিউর কুয়েরি: Prepared Statement ব্যবহার
        $sql = "SELECT bank_id, bank_name FROM tblbankinfo WHERE bank_id = ? AND status = 1 LIMIT 1";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("i", $bankId); // "i" মানে ইন্টিজার
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $response = $result->fetch_assoc(); // fetch_array এর চেয়ে assoc বেশি ক্লিন
        } else {
            $response = ['error' => 'কোনো তথ্য পাওয়া যায়নি!'];
        }
        $stmt->close();
    } else {
        $response = ['error' => 'ভুল আইডি প্রদান করা হয়েছে!'];
    }
}

$connect->close();

// ৩. রেসপন্স পাঠানো
echo json_encode($response);
exit;
?>
