<?php 	
require_once 'core.php';

$trxdid = $_POST['trxdid'];

$sql ="SELECT tdi.trxdid,vds.name_english,vds.mobileno,(tdi.deposit_amount+tdi.fixed_amount) as deposit_amount, DATE_FORMAT(tdi.depositdate, '%d/%m/%Y') as depositdate,
vds.tpaida,vds.tduea,tdi.payment_type FROM tbltrxdepositinfo tdi, vw_memberdepositsummary vds
WHERE tdi.memberid=vds.mid AND tdi.trxdid= {$trxdid}";

$result = $connect->query($sql); 
if($result->num_rows > 0) {
 while($row = $result->fetch_array()) {
	   $name_english   = $row[1];
	   $mobileno       = $row[2];
	   $deposit_amount = $row[3];
	   $depositdate    = $row[4];
	   $tpaida         = $row[5];
	   $tduea          = $row[6];
	   $payment_type   = $row[7];
	}
}
$message = rawurlencode("Dear: $name_english, A/C Credited ($payment_type) by BDT $deposit_amount/- on $depositdate C/B BDT $tpaida/-, Due BDT $tduea/- \nRegards\nNurses Health Care Society.");

$url = "http://api.greenweb.com.bd/api.php";

$sqlsms = "INSERT INTO tblsmslog (mobile,message,cost) VALUES ('$mobileno','Dear: $name_english, A/C Credited ($payment_type) by BDT $deposit_amount/- on $depositdate C/B BDT $tpaida/-, Due BDT $tduea/- \nRegards\nNurses Health Care Society.','0.63')";
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