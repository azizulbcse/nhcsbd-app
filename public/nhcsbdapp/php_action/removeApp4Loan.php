<?php 	
require_once 'core.php';  

$valid['success'] = array('success' => false, 'messages' => array());

$LoanAppId = $_POST['LoanAppId'];
$userid      = $_SESSION['userId']; 

if($LoanAppId) { 

 $sql = "UPDATE tblapplication4loan SET status = '0',modifier_id='$userid' WHERE loanappid = {$LoanAppId} AND status=1";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Canceled Successfully";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while Cancel this Loan Application";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST