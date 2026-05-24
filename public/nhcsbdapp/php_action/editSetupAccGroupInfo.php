<?php 	
header('Content-Type: text/html; charset=utf-8');
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$editHospitalName = $_POST['editHospitalName'];
	$userid           = $_SESSION['userId']; 
    $hid              = $_POST['hid'];

	$sql = "UPDATE tblaccgroup SET AccGroupName = '$editHospitalName',modifier_id='$userid' WHERE AccGroupId= '$hid'"; 

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated Account Group";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Account Group";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST