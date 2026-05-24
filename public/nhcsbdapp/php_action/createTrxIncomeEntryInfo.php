<?php 	
header('Content-Type: text/html; charset=utf8');
require_once 'core.php'; 

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$IncomeDate    = date('Y-m-d', strtotime($_POST['IncomeDate']));
	$HeadName      = $_POST['HeadName'];
	$CustomerId    = $_POST['CustomerId'];
	$PaymentType   = $_POST['PaymentType'];
	$Amount        = $_POST['Amount'];
	$Remarks       = $_POST['Remarks'];
	$userid        = $_SESSION['userId']; 

	$sql = "INSERT INTO tbltrxincomeothersinfo (incomedate,headname,payeename,paymenttype,amount,remarks,status,creator_id) 
	VALUES ('$IncomeDate','$HeadName','$CustomerId','$PaymentType','$Amount','$Remarks','1','$userid')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added Income Info";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Income Info";
	}	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST