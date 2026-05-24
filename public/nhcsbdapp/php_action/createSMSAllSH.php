<?php 	
header('Content-Type: text/html; charset=utf8');
require_once 'core.php'; 

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$MessageDts  = $_POST['MessageDts'];
	$userid      = $_SESSION['userId']; 

	$sql = "INSERT INTO tblsms4allsh (sms,status,creator_id) VALUES ('$MessageDts','1','$userid')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added SMS";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the SMS";
	}	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST