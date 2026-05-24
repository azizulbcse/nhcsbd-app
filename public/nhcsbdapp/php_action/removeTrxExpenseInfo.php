<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

$trxid      = $_POST['trxid'];
$userid     = $_SESSION['userId']; 
if($trxid) { 

 $sql = "UPDATE tbltrxexpenseinfo SET status = 0,modifier_id='$userid' WHERE trxid = {$trxid} AND status=1";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed Expense Info";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the Expense Info";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST