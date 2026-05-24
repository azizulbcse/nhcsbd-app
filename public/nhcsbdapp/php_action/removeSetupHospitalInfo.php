<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$hid      = $_POST['hid'];
$userid   = $_SESSION['userId']; 
if($hid) { 

 $sql = "UPDATE tblhospitalname SET status = 0,modifier_id='$userid' WHERE hid = {$hid}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed Hospital Name";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the Hospital Name";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST