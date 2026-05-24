<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$userid = $_POST['userid'];
$userId = $_SESSION['userId'];

if($userid) { 

 $sql = "UPDATE tblapplicantinfo SET status = '0',modifier_id='$userId' WHERE mid = {$userid} AND status=1";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Applicant Posted Successfully";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while Delete this Applicant";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST