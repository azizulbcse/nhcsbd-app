<?php 	
require_once 'core.php';

$ResignAppId = $_POST['ResignAppId'];

$sql ="SELECT ta4r.rid,ta.name_english,DATE_FORMAT(ta4r.loandate, '%d/%m/%Y') as loandate, ta4r.loan_resons,tau.mobileno presidentno 
FROM tblapplication4loan ta4r, tblapplicantinfo ta, tbladminuser tau
where ta4r.status=2 AND ta4r.creator_id=ta.mid and tau.designations in('President','Software Engineer') AND ta4r.rid= {$ResignAppId}";

$result = $connect->query($sql); 
if($result->num_rows > 0) {
 while($row = $result->fetch_array()) {
	   $name_english = $row[1];
	   $loandate     = $row[2];
	   $loan_resons  = $row[3];
	   $presidentno  = $row[4];
	}
}
$message = rawurlencode("$name_english, has applied for $loan_resons from the NHCSBD on ($loandate). \nRegards\nNurses Health Care Society.");

$url = "http://api.greenweb.com.bd/api.php";

$sqlsms = "INSERT INTO tblsmslog (mobile,message,cost) VALUES ('$presidentno','$name_english, has applied for resignation from the NHCSBD on ($resigndate). \nRegards\nNurses Health Care Society.','0.63')";
$connect->query($sqlsms);

$data= array(
//'to'=>"$presidentno",
'to'=>"01728226580",
//'to'=>"01717288965",
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