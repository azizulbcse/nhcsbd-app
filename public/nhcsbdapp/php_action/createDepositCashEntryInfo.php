<?php 	
header('Content-Type: text/html; charset=utf8');
require_once 'core.php'; 

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$DepositDate   = date('Y-m-d', strtotime($_POST['DepositDate']));
	$DepositTo     = $_POST['DepositTo'];
	$DepositAmount = $_POST['DepositAmount'];
	$Remarks       = $_POST['Remarks'];
	$YearlyAmount  = $_POST['YearlyAmount'];
	$userid        = $_SESSION['userId']; 

	$sql = "INSERT INTO tbltrxdepositinfo (depositdate,payment_type,memberid,deposit_to,deposit_amount,remarks,fixed_amount,status,creator_id) 
	VALUES ('$DepositDate','Cash','$userid','$DepositTo','$DepositAmount','$Remarks','$YearlyAmount','1','$userid')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added Deposit Info";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Deposit Info";
	}	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST