<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$YearlyAmountId = $_POST['YearlyAmountId'];
$userid         = $_SESSION['userId']; 

if($YearlyAmountId) { 
 $sql = "UPDATE tblyearlyamount SET status = 2,modifier_id='$userid' WHERE yid = {$YearlyAmountId} AND status=1";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Posted Yearly Amount Info";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while Posted the Yearly Amount Info";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST