<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$editbankName = $_POST['editbankName'];
	$userid       = $_SESSION['userId']; 
    $BankId       = $_POST['BankId'];

	$sql = "UPDATE tblresignreasonsinfo SET resignresons = '$editbankName',modifier_id='$userid' WHERE rrid = '$BankId'"; 

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Resign Resons Info";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST