<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$editResignDate          = date('Y-m-d', strtotime($_POST['editResignDate']));
	$editResignationReasons  = $_POST['editResignationReasons'];
	$userid                  = $_SESSION['userId']; 
    $ResignAppId             = $_POST['ResignAppId'];

	$sql = "UPDATE tblapplication4resign SET editResignDate='$editResignDate',resign_resons='$editResignationReasons',
	modifier_id='$userid' WHERE rid= '$ResignAppId' AND status=1";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated Yor Resign Application";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Yor Resign Application";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST