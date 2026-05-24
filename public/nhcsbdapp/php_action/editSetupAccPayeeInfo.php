<?php 	
header('Content-Type: text/html; charset=utf-8');
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$editPayeeName = $_POST['editPayeeName'];
	$userid        = $_SESSION['userId']; 
    $payeeId       = $_POST['payeeId'];

	$sql = "UPDATE tblaccpayto SET payeeName = '$editPayeeName',modifier_id='$userid' WHERE payeeId = '$payeeId'"; 

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated Payee Name";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Payee Name";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST