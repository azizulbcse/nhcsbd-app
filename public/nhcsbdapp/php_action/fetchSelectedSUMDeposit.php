<?php 	

require_once 'core.php';

$customerid = $_POST['customerid'];

//$sql = "SELECT mid,tpaida FROM vw_memberdepositsummary WHERE mid = $customerid"; 
$sql = "SELECT memberid mid,sum(deposit_amount+fixed_amount)tpaida FROM tbltrxdepositinfo WHERE memberid=$customerid AND status=2"; 
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);