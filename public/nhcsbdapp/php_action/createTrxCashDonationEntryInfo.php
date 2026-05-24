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

	$sql = "INSERT INTO  tbltrxdonationinfo (donatedate,payment_type,memberid,donate_from,donate_to,donate_amount,trxno,remarks,status,creator_id) 
	VALUES ('$ReceivedDate','Cash','$MemberName','','','$ReceivedAmount','','$Remarks','1','$userid')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added Donation Info";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Donation Info";
	}	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST