<?php 	
header('Content-Type: text/html; charset=utf-8');
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$editDepositDate   = date('Y-m-d', strtotime($_POST['editDepositDate']));
	$editDepositTo     = $_POST['editDepositTo'];
	$editDepositAmount = $_POST['editDepositAmount'];
	$editRemarks       = $_POST['editRemarks'];
	$editYearlyAmount  = $_POST['editYearlyAmount'];
	$userid            = $_SESSION['userId']; 
    $trxid             = $_POST['trxid'];

	$sql = "UPDATE tbltrxdepositinfo SET depositdate = '$editDepositDate',deposit_to='$editDepositTo',
	deposit_amount='$editDepositAmount',remarks='$editRemarks',fixed_amount='$editYearlyAmount',modifier_id='$userid' WHERE trxdid= '$trxid' AND status=1"; 

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