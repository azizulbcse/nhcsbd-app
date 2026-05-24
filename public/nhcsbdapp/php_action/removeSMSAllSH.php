<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$smsid     = $_POST['smsid'];
$userid    = $_SESSION['userId']; 

if($smsid) { 
 $sql = "UPDATE tblsms4allsh SET status = 0,modifier_id='$userid' WHERE smsid = {$smsid} AND status=1";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed SMS";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the SMS";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST