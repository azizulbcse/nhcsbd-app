<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$ResignAppId = $_POST['ResignAppId'];
$userid      = $_SESSION['userId']; 
if($ResignAppId) { 

 $sql = "UPDATE tblapplication4resign SET acc_status = 2,modifier_id='$userid' WHERE rid = {$ResignAppId} AND status=2 AND president_status=2 AND sg_status=2";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Approved Resign Application";		 
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while Approved Resign Application";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST