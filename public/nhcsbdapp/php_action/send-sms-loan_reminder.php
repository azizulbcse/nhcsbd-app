<?php 	
require_once 'core.php';

$tomorrow = date('Y-m-d', strtotime('+1 day')); 

$sql = "SELECT ai.mobileno, ls.emi_amount, ai.name_english 
        FROM tblloanschedule ls
        JOIN tblapplicantinfo ai ON ls.member_id = ai.mid 
        WHERE ls.due_date = '$tomorrow' AND ls.payment_status = 'Unpaid'";

$result = $connect->query($sql); 

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $name_english = $row['name_english'];
        $mobileno     = $row['mobileno'];
        $emi_amount   = $row['emi_amount'];
        $formatted_date = date('d/m/Y', strtotime($tomorrow));

        // ৩. মেসেজ ফরম্যাট করা
        $message = "Dear $name_english, Tomorrow ($formatted_date) is the last date for your loan installment of BDT $emi_amount. Please pay on time. Regards, Nurses Health Care Society.";

        // ৪. গ্রিনওয়েব API সেটআপ
        $url = "http://api.greenweb.com.bd/api.php";
        $token = "877211362917176521899a1a14eadabdaf39e41cc93bbedc5a02";

        $data = array(
            'to'      => "$mobileno",
            'message' => "$message",
            'token'   => "$token"
        );

        // ৫. এসএমএস পাঠানো (cURL)
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        curl_close($ch);

        // ৬. লগ ইনসার্ট করা
        $sqlsms = "INSERT INTO tblsmslog (mobile, message, cost) VALUES ('$mobileno', '$message', '0.63')";
        $connect->query($sqlsms);

        echo "SMS sent to: $mobileno <br>";
    }
} else {
    echo "No installments due for tomorrow ($tomorrow).";
}
?>
