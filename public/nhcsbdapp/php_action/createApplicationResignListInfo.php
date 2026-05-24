<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$ResignDate          = date('Y-m-d', strtotime($_POST['ResignDate']));
	$ResignationReasons  = $_POST['ResignationReasons'];
	$userid              = $_SESSION['userId']; 

	$sql = "INSERT INTO tblapplication4resign (resigndate,resign_resons,status,president_status,sg_status,acc_status,creator_id) 
	VALUES ('$ResignDate','$ResignationReasons','1','1','1','1','$userid')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added Resignation Application";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Resignation Application";
	}	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST