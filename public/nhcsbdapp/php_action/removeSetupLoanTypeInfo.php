<?php 	
require_once 'core.php';  

$valid['success'] = array('success' => false, 'messages' => array());

$BankId = $_POST['BankId'];
$userid = $_SESSION['userId']; 

if($BankId) { 

 $sql = "UPDATE tblloantypeinfo SET status = '0',modifier_id='$userid' WHERE rrid = {$BankId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Canceled Successfully";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while Delete this Loan Type";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST