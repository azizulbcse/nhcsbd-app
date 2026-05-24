<?php 	
require_once 'core.php';

$userid = $_POST['userid'];

$sql = "SELECT mid,mobileno,name_english,email,pcode,status FROM tblapplicantinfosh WHERE status=2 AND mid={$userid}";

$result = $connect->query($sql); 
if($result->num_rows > 0) {
 while($row = $result->fetch_array()) {
	   $mobileno        = $row[1];
	   $name_english    = $row[2];
	   $email           = $row[3];
	   $pcode           = $row[4];
	}
}
$message = "Dear $name_english, Your application has been granted.\nUsername:$email\nPassword:$pcode\nRegards\nNurses Health Care Society.";

$url = "http://api.greenweb.com.bd/api.php";

$sqlsms = "INSERT INTO tblsmslog (mobile,message,cost) VALUES ('$mobileno','Dear $name_english, Your application has been granted.\nUsername:$email\nPassword:$pcode\nRegards\nNurses Health Care Society.','0.63')";
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