<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$bankName = $_POST['bankName'];
	$userid   = $_SESSION['userId']; 

	$sql = "INSERT INTO tblloantypeinfo (loantype, status,creator_id) VALUES ('$bankName', '1','$userid')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added Loan Type";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Loan Type";
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST