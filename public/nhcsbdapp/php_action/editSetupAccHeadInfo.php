<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$editAccGroupName = $_POST['editAccGroupName'];
 	$editAccountHead  = $_POST['editAccountHead'];
	$userid           = $_SESSION['userId'];
    $accHeadId        = $_POST['accHeadId'];

	$sql = "UPDATE tblacchead SET accGroupId = '$editAccGroupName',accHeadName='$editAccountHead',modifier_id='$userid' 
	WHERE accHeadId = '$accHeadId'"; 

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated Account Head";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Account Head";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST