<?php 	
header('Content-Type: text/html; charset=utf-8');
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$editDepositDate   = date('Y-m-d', strtotime($_POST['editDepositDate']));
	$editPaymentType   = $_POST['editPaymentType'];
	$editDepositForm   = $_POST['editDepositForm'];
	$editDepositTo     = $_POST['editDepositTo'];
	$editDepositAmount = $_POST['editDepositAmount'];
	$editTrxNo         = $_POST['editTrxNo'];
	$editRemarks       = $_POST['editRemarks'];
	$editYearlyAmount  = $_POST['editYearlyAmount'];
	$userid            = $_SESSION['userId']; 
	$trxid             = $_POST['trxid'];

	$sql = "UPDATE tbltrxdepositinfo SET depositdate = '$editDepositDate',payment_type='$editPaymentType',
	deposit_from='$editDepositForm',deposit_to='$editDepositTo',deposit_amount='$editDepositAmount',fixed_amount='$editYearlyAmount',
	trxno='$editTrxNo',remarks='$editRemarks',
	modifier_id='$userid' WHERE trxdid= '$trxid' AND status=1"; 

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated Deposit Info";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Deposit Info";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST