<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$bankName = $_POST['bankName'];
	$userid   = $_SESSION['userId']; 

	$sql = "INSERT INTO tblresignreasonsinfo (resignresons, status,creator_id) VALUES ('$bankName', '1','$userid')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added Resignation Reasons";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Resignation Reasons";
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST