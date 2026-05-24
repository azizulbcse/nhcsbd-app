<?php 	
require_once 'core.php';  

$valid['success'] = array('success' => false, 'messages' => array());

$ResignAppId = $_POST['ResignAppId'];
$userid      = $_SESSION['userId']; 

if($ResignAppId) { 

 $sql = "UPDATE tblapplication4resign SET status = '0',modifier_id='$userid' WHERE rid = {$ResignAppId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Canceled Successfully";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while Cancel this Resign Resons";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST