<?php 	
header('Content-Type: text/html; charset=utf-8');
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$editReceivedDate   = date('Y-m-d', strtotime($_POST['editReceivedDate']));
	$editMemberName     = $_POST['editMemberName'];
	$editReceivedAmount = $_POST['editReceivedAmount'];
	$editRemarks        = $_POST['editRemarks'];
	$userid             = $_SESSION['userId']; 
    $trxid              = $_POST['trxid'];

	$sql = "UPDATE tbltrxdepositinfo SET depositdate = '$editReceivedDate',memberid='$editMemberName',deposit_amount='$editReceivedAmount',
	remarks='$editRemarks',modifier_id='$userid' WHERE trxdid= '$trxid' AND status=1"; 

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