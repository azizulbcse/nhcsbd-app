<?php 	
header('Content-Type: text/html; charset=utf-8');
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$editDonateDate   = date('Y-m-d', strtotime($_POST['editDonateDate']));
	$editPaymentType  = $_POST['editPaymentType'];
	$editDonateFrom   = $_POST['editDonateFrom'];
	$editDonateTo     = $_POST['editDonateTo'];
	$editDonateAmount = $_POST['editDonateAmount'];
	$editTrxNo        = $_POST['editTrxNo'];
	$editRemarks      = $_POST['editRemarks'];
	$userid           = $_SESSION['userId']; 
    $trxid            = $_POST['trxid'];

	$sql = "UPDATE tbltrxdonationinfo SET donatedate = '$editDonateDate',payment_type='$editPaymentType',donate_from='$editDonateFrom',
	donate_to='$editDonateTo',donate_amount='$editDonateAmount',trxno='$editTrxNo',remarks='$editRemarks',modifier_id='$userid' 
	WHERE trxdid= '$trxid' AND status=1"; 

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated Donation Info";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Donation Info";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST