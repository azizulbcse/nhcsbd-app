<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$trxid      = $_POST['trxid'];
$userid     = $_SESSION['userId']; 
if($trxid) { 

 $sql = "UPDATE tbltrxincomeothersinfo SET status = 0,modifier_id='$userid' WHERE trxid = {$trxid} AND status=1";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed Income Info";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the Income Info";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST