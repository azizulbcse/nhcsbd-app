<?php 	
require_once 'core.php';

$trxid = $_POST['trxid'];

$sql ="SELECT tdi.trxdid,DATE_FORMAT(tdi.depositdate, '%d/%m/%Y') as depositdate,tai.name_english,tai.mobileno,
tdi.payment_type,tdi.deposit_from,tdi.deposit_to,tdi.deposit_amount,tdi.trxno,tdi.status 
FROM tbltrxloanemipaidinfo tdi, tblapplicantinfo tai WHERE tdi.memberid=tai.mid 
AND tdi.status=2 AND tdi.trxdid= {$trxid}";

$result = $connect->query($sql); 
if($result->num_rows > 0) {
 while($row = $result->fetch_array()) {
	   $depositdate    = $row[1];
	   $name_english   = $row[2];
	   $mobileno       = $row[3];
	   $payment_type   = $row[4];
	   $deposit_amount = $row[7];
	}
}
$message = rawurlencode("Dear: $name_english, Loan Instalment Paid ($payment_type) by BDT $deposit_amount/- on $depositdate \nRegards\nNurses Health Care Society.");

$url = "http://api.greenweb.com.bd/api.php";

$sqlsms = "INSERT INTO tblsmslog (mobile,message,cost) VALUES ('$mobileno','Dear: $name_english, Loan Instalment Paid ($payment_type) by BDT $deposit_amount/- on $depositdate \nRegards\nNurses Health Care Society.','0.63')";
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