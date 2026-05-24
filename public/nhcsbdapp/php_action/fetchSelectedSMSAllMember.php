<?php 	

require_once 'core.php';

$smsid = $_POST['smsid'];

$sql = "SELECT smsid,sms FROM tblsms4allmember WHERE smsid = $smsid AND status=1"; 
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);