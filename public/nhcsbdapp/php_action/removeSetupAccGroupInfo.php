<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$hid      = $_POST['hid'];
$userid   = $_SESSION['userId']; 
if($hid) { 

 $sql = "UPDATE tblaccgroup SET status = 0,modifier_id='$userid' WHERE AccGroupId = {$hid}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed Account Group";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the Account Group";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST