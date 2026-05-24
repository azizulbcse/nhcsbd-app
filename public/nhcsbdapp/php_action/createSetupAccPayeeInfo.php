<?php 	
header('Content-Type: text/html; charset=utf8');
require_once 'core.php'; 

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$PayeeName = $_POST['PayeeName'];
	$userid       = $_SESSION['userId']; 

	$sql = "INSERT INTO tblaccpayto (payeeName, status,creator_id) VALUES ('$PayeeName', '1','$userid')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added Payee Name";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Payee Name";
	}	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST