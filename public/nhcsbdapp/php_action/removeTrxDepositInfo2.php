<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$trxdid      = $_POST['trxdid'];
$userid     = $_SESSION['userId']; 
if($trxdid) { 

 $sql = "UPDATE tbltrxdepositinfo SET status = 0,modifier_id='$userid' WHERE trxdid = {$trxdid} AND status=1";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed Deposit Info";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while Removed the Deposit Info";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST