<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	
	$editUserFullName  = $_POST['editUserFullName'];
	$editDesignation   = $_POST['editDesignation'];
	$editUserType      = $_POST['editUserType'];
	$editMobileNo      = $_POST['editMobileNo'];
	$userid            = $_SESSION['userId'];
	$userid            = $_POST['userid'];
	
	$sql = "UPDATE tbladminuser SET fullname = '$editUserFullName', designations = '$editDesignation', usertype='$editUserType',mobileno='$editMobileNo',modifier_id='$userid' WHERE user_id = $userid";
	
	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update User Info";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating User info";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
