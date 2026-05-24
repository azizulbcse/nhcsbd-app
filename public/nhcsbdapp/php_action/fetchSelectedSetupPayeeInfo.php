<?php 	

require_once 'core.php';

$payeeId = $_POST['payeeId'];

$sql = "SELECT payeeId, payeeName FROM tblaccpayto WHERE payeeId = $payeeId"; 
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);