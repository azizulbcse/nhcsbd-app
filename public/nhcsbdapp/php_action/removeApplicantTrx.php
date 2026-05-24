<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$userid = $_POST['userid'];
$userId = $_SESSION['userId'];

if($userid) { 

 $sql = "UPDATE tbltrxdepositinfo SET status = '0',modifier_id='$userId' WHERE memberid = {$userid} AND status=2";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Applicant removed Successfully";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while Delete this Applicant";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST