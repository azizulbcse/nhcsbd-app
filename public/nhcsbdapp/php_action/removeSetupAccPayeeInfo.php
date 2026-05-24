<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$payeeId = $_POST['payeeId'];
$userid    = $_SESSION['userId']; 
if($payeeId) { 
 $sql = "UPDATE tblaccpayto SET status = 0,modifier_id='$userid' WHERE payeeId = {$payeeId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed Account Payee";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the Account Payee";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST