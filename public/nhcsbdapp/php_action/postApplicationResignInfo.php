<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$ResignAppId = $_POST['ResignAppId'];
$userid      = $_SESSION['userId']; 
if($ResignAppId) { 

 $sql = "UPDATE tblapplication4resign SET status = 2,modifier_id='$userid' WHERE rid = {$ResignAppId} AND status=1";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Send Resign Application";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while Send Resign Application";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST