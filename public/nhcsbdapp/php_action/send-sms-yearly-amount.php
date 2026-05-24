<?php 	
require_once 'core.php';

$YearlyAmountId = $_POST['YearlyAmountId'];

$sql = "SELECT tya.yid,tya.yearlastdate,tya.yearlyamount,ta.name_english,ta.mobileno
FROM tblyearlyamount tya, tblapplicantinfo ta where tya.status=2 and ta.status=2 AND tya.yid={$YearlyAmountId}";

$result = $connect->query($sql); 
if($result->num_rows > 0) {
 while($row = $result->fetch_array()) {
	   $yearlastdate    = $row[1];
	   $yearlyamount    = $row[2];
	   $name_english    = $row[3];
	   $mobileno        = $row[4];

$message = "Dear $name_english, Your Yearly Amount Tk-$yearlyamount/- is due on $yearlastdate. Pls pay on time to avoid interest.\nRegards\nNurses Health Care Society.";

$url = "http://api.greenweb.com.bd/api.php";

$sqlsms = "INSERT INTO tblsmslog (mobile,message,cost) VALUES ('$mobileno','Dear $name_english, Your Yearly Amount Tk-$yearlyamount/- is due on $yearlastdate. Pls pay on time to avoid interest.\nRegards\nNurses Health Care Society.','0.63')";
$connect->query($sqlsms);

$data= array(
'to'=>"$mobileno",
'message'=>"$message",
'token'=>"877211362917176521899a1a14eadabdaf39e41cc93bbedc5a02"
); // Add parameters in key value
$ch = curl_init(); // Initialize cURL
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_ENCODING, '');
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$smsresult = curl_exec($ch);

//Result
echo $smsresult;

//Error Display
echo curl_error($ch);
}
}
?>