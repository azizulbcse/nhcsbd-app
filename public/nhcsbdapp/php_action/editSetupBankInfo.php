<?php 	
header('Content-Type: application/json; charset=utf-8');
require_once 'core.php'; 

// ডিফল্ট রেসপন্স স্ট্রাকচার
$response = ['success' => false, 'messages' => 'Invalid Request'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {	
    
    // ইনপুট স্যানিটাইজেশন
    $editbankName = isset($_POST['editbankName']) ? trim($_POST['editbankName']) : '';
    $BankId       = isset($_POST['BankId']) ? intval($_POST['BankId']) : 0;

    if (empty($editbankName) || $BankId <= 0) {
        $response['messages'] = "ব্যাংকের নাম এবং সঠিক আইডি প্রদান করা বাধ্যতামূলক!";
        http_response_code(400); // Bad Request
    } else {
        try {
            // ১. ইউনিক চেক (বর্তমান আইডি বাদে অন্য কোথাও নাম আছে কি না)
            $checkSql = "SELECT bank_id FROM tblbankinfo WHERE bank_name = ? AND bank_id != ? AND status = 1 LIMIT 1";
            $stmtCheck = $connect->prepare($checkSql);
            $stmtCheck->bind_param("si", $editbankName, $BankId);
            $stmtCheck->execute();
            $result = $stmtCheck->get_result();

            if ($result->num_rows > 0) {
                $response['messages'] = "দুঃখিত! এই নাম ইতিমধ্যে অন্য একটি এন্ট্রিতে ব্যবহৃত হচ্ছে।";
            } else {
                // ২. ডাটা আপডেট
                $updateSql = "UPDATE tblbankinfo SET bank_name = ? WHERE bank_id = ?";
                $stmtUpdate = $connect->prepare($updateSql);
                $stmtUpdate->bind_param("si", $editbankName, $BankId);

                if ($stmtUpdate->execute()) {
                    $response['success'] = true;
                    $response['messages'] = "সফলভাবে ব্যাংকের তথ্য আপডেট করা হয়েছে।";
                } else {
                    throw new Exception("Update failed");
                }
                $stmtUpdate->close();
            }
            $stmtCheck->close();
            
        } catch (Exception $e) {
            $response['messages'] = "কারিগরি ত্রুটি হয়েছে, দয়া করে আবার চেষ্টা করুন।";
            // error_log($e->getMessage()); // সার্ভার লগ-এ এরর সেভ করে রাখা স্মার্ট প্র্যাকটিস
        }
    }
    
    $connect->close();
    echo json_encode($response);
    exit;
}
?>
