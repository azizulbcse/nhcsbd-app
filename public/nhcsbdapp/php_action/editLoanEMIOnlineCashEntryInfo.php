<?php 	
header('Content-Type: text/html; charset=utf-8');
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$editDepositDate   = date('Y-m-d', strtotime($_POST['editDepositDate']));
	$editDepositForm   = $_POST['editDepositForm'];
	$editDepositTo     = $_POST['editDepositTo'];
	$editTrxNo         = $_POST['editTrxNo'];
	$editDepositAmount = floatval($_POST['editDepositAmount']);
	$editInstalmentNo  = $_POST['editInstalmentNo'];
	$userid            = $_SESSION['userId']; 
	$trxid             = $_POST['trxid'];
	
	$sql = "UPDATE tbltrxloanemipaidinfo SET depositdate = '$editDepositDate',memberid='$userid',deposit_from='$editDepositForm',
	deposit_to='$editDepositTo',trxno='$editTrxNo',deposit_amount='$editDepositAmount',schedule_id='$editInstalmentNo',
	modifier_id='$userid' WHERE trxdid= '$trxid' AND status=1"; 

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated Loan Instalment Paid Info";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Loan Instalment Paid Info";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST