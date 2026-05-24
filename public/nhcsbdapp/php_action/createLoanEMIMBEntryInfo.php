<?php 	
header('Content-Type: text/html; charset=utf8');
require_once 'core.php'; 

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$DepositDate   = date('Y-m-d', strtotime($_POST['DepositDate']));
	$PaymentType   = $_POST['PaymentType'];
	$DepositForm   = $_POST['DepositForm'];
	$DepositTo     = $_POST['DepositTo'];
	$DepositAmount = floatval($_POST['DepositAmount']);
	$TrxNo         = $_POST['TrxNo'];
	$InstalmentNo  = $_POST['InstalmentNo'];
	$userid        = $_SESSION['userId']; 

	$sql = "INSERT INTO tbltrxloanemipaidinfo (depositdate,payment_type,memberid,deposit_from,deposit_to,deposit_amount,trxno,schedule_id,status,creator_id) 
	VALUES ('$DepositDate','$PaymentType','$userid','$DepositForm','$DepositTo','$DepositAmount','$TrxNo','$InstalmentNo','1','$userid')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added Loan Instalment Paid Info";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Loan Instalment Paid Info";
	}	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST