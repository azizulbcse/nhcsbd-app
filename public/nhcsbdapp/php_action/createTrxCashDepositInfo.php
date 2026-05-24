<?php 	
header('Content-Type: text/html; charset=utf8');
require_once 'core.php'; 

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$ReceivedDate    = date('Y-m-d', strtotime($_POST['ReceivedDate']));
	$MemberName      = $_POST['MemberName'];
	$ReceivedAmount  = $_POST['ReceivedAmount'];
	$Remarks         = $_POST['Remarks'];
	$userid          = $_SESSION['userId']; 

	$sql = "INSERT INTO  tbltrxdepositinfo (depositdate,payment_type,memberid,deposit_from,deposit_to,deposit_amount,trxno,remarks,status,creator_id) 
	VALUES ('$ReceivedDate','Cash','$MemberName','','','$ReceivedAmount','','$Remarks','1','$userid')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added Deposit Info";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Deposit Info";
	}	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST