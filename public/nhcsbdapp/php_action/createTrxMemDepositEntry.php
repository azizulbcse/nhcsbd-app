<?php 	
header('Content-Type: text/html; charset=utf8');
require_once 'core.php'; 

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$DepositDate   = date('Y-m-d', strtotime($_POST['DepositDate']));
	$PaymentType   = $_POST['PaymentType'];
	$FromNo        = $_POST['FromNo'];
	$Amount        = $_POST['Amount'];
	$TrxNo         = $_POST['TrxNo'];
	$Remarks       = $_POST['Remarks'];
	$userid        = $_SESSION['userId']; 

	$sql = "INSERT INTO tbltrxmemberdepositinfo (deposit_date,deposit_type,deposit_from,amount,trx_no,remarks,status,creator_id) 
	VALUES ('$DepositDate','$PaymentType','$FromNo','$Amount','$TrxNo','$Remarks','1','$userid')";

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