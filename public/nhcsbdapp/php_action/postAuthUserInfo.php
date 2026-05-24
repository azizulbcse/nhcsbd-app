<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$userid = $_POST['userid'];
$userId = $_SESSION['userId'];

if($userid) { 

 $sql = "UPDATE tbladminuser SET status = '2',modifier_id='$userId' WHERE user_id = {$userid} AND status=1";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "User Posted Successfully";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while Delete this User";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST