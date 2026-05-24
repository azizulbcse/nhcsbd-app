<?php 	
require_once 'core.php';

$smsid = $_POST['smsid'];

$sql = "SELECT tis.smsid,tai.name_english,tai.mobileno,tis.sms,tis.status 
FROM tblsms4memberwise tis, tblapplicantinfo tai WHERE tis.member_name=tai.mid AND tis.status=2 AND tis.smsid={$smsid}";

$result = $connect->query($sql); 
if($result->num_rows > 0) {
 while($row = $result->fetch_array()) {
	   $name_english    = $row[1];
	   $mobileno        = $row[2];
	   $sms             = $row[3];
	}
}
$message = "Dear $name_english, $sms\nRegards\nNurses Health Care Society.";

$url = "http://api.greenweb.com.bd/api.php";

$sqlsms = "INSERT INTO tblsmslog (mobile,message,cost) VALUES ('$mobileno','Dear $name_english, $sms\nRegards\nNurses Health Care Society.','0.63')";
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
?>