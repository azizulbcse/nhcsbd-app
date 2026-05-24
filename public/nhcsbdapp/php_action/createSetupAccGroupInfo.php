<?php 	
header('Content-Type: text/html; charset=utf8');
require_once 'core.php'; 

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$HospitalName = $_POST['HospitalName'];
	$userid       = $_SESSION['userId']; 

	$sql = "INSERT INTO tblaccgroup (AccGroupName, status,creator_id) VALUES ('$HospitalName','1','$userid')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added Account Group";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Account Group";
	}	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST