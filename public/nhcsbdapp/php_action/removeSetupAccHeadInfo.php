<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$accHeadId = $_POST['accHeadId'];
$userid    = $_SESSION['userId']; 
if($accHeadId) { 
 $sql = "UPDATE tblacchead SET status = 0,modifier_id='$userid' WHERE accHeadId = {$accHeadId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed Account Head";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the Account Head";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST