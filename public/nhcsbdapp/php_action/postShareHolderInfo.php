<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$userid       = $_POST['userid'];
$userId       = $_SESSION['userId'];

if($userid) { 

 $sql = "UPDATE tblapplicantinfosh SET password=md5(CONCAT(SUBSTRING(mobileno,3,1), SUBSTRING(mobileno,7,4))),pcode=(CONCAT(SUBSTRING(mobileno,3,1), SUBSTRING(mobileno,7,4))),app_amount='100',status = '2',role='2',modifier_id='$userId' WHERE mid = {$userid} AND status=1";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Share Holder Posted Successfully";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while Delete this Share Holder";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST