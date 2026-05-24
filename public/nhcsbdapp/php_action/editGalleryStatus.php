<?php 	
require_once 'core.php';
$valid['success'] = array('success' => false, 'messages' => array());
if($_POST) {
	$id = $_POST['id'];
	$status = $_POST['status'];
	$sql = "UPDATE tblgallery SET status = $status WHERE id = $id";
	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Published";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating";
	}
	$connect->close();
	echo json_encode($valid);
}
