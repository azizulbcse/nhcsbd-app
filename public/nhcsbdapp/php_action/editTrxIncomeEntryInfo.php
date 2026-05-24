<?php 	
header('Content-Type: text/html; charset=utf-8');
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$editIncomeDate   = date('Y-m-d', strtotime($_POST['editIncomeDate']));
	$editHeadName     = $_POST['editHeadName'];
	$editPayeeName    = $_POST['editPayeeName'];
	$editPaymentType  = $_POST['editPaymentType'];
	$editAmount       = $_POST['editAmount'];
	$editRemarks      = $_POST['editRemarks'];
	$userid           = $_SESSION['userId']; 
    $trxid            = $_POST['trxid'];

	$sql = "UPDATE tbltrxincomeothersinfo SET incomedate = '$editIncomeDate',headname='$editHeadName',payeename='$editPayeeName',
	paymenttype='$editPaymentType',amount='$editAmount',remarks='$editRemarks',modifier_id='$userid' WHERE trxid= '$trxid' AND status=1"; 

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated Income Info";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Income Info";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST