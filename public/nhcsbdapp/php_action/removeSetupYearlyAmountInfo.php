<?php 	
require_once 'core.php';  

$valid['success'] = array('success' => false, 'messages' => array());

$YearlyAmountId = $_POST['YearlyAmountId'];
$userid         = $_SESSION['userId']; 

if($YearlyAmountId) { 

 $sql = "UPDATE tblyearlyamount SET status = '0',modifier_id='$userid' WHERE yid= {$YearlyAmountId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Canceled Successfully";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while Cancel this Yearly AMount";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST