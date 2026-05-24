<?php 	
header('Content-Type: text/html; charset=utf8');
require_once 'core.php'; 

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$DepositDate   = date('Y-m-d', strtotime($_POST['DepositDate']));
	$InstalmentNo  = $_POST['InstalmentNo'];
	$DepositTo     = $_POST['DepositTo'];
	//$DepositAmount = $_POST['DepositAmount'];
	$DepositAmount = floatval($_POST['DepositAmount']); 
	$userid        = $_SESSION['userId']; 

	$sql = "INSERT INTO tbltrxloanemipaidinfo (depositdate,payment_type,memberid,schedule_id,deposit_to,deposit_amount,status,creator_id) 
	VALUES ('$DepositDate','Cash','$userid','$InstalmentNo','$DepositTo','$DepositAmount','1','$userid')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added Your Loan Deposit";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Your Loan Deposit";
	}	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST