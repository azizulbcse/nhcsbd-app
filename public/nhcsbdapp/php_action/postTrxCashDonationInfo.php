<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$trxid      = $_POST['trxid'];
$userid     = $_SESSION['userId']; 
if($trxid) { 

 $sql = "UPDATE tbltrxdonationinfo SET status = 2,modifier_id='$userid' WHERE trxdid = {$trxid} AND status=1";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Posted Donation Info";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while Posted the Donation Info";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST