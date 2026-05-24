<?php 	
header('Content-Type: text/html; charset=utf-8');
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$editDepositDate  = date('Y-m-d', strtotime($_POST['editDepositDate']));
	$editPaymentType  = $_POST['editPaymentType'];
	$editFromNo       = $_POST['editFromNo'];
	$editAmount       = $_POST['editAmount'];
	$editTrxNo        = $_POST['editTrxNo'];
	$editRemarks      = $_POST['editRemarks'];
	$userid           = $_SESSION['userId']; 
    $trxid            = $_POST['trxid'];

	$sql = "UPDATE tbltrxmemberdepositinfo SET deposit_date = '$editDepositDate',deposit_type='$editPaymentType',
	deposit_from='$editFromNo',amount='$editAmount',trx_no='$editTrxNo',remarks='$editRemarks',modifier_id='$userid'
	WHERE mdid= '$trxid' AND status=1"; 

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