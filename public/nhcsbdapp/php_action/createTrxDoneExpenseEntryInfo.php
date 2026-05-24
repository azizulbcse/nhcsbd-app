<?php 	
header('Content-Type: text/html; charset=utf8');
require_once 'core.php'; 

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$ExpenseDate   = date('Y-m-d', strtotime($_POST['ExpenseDate']));
	$HeadName      = $_POST['HeadName'];
	$PayeeName     = $_POST['PayeeName'];
	$PaymentType   = $_POST['PaymentType'];
	$Amount        = $_POST['Amount'];
	$Remarks       = $_POST['Remarks'];
	$userid        = $_SESSION['userId']; 

	$sql = "INSERT INTO tbltrxdoneexpenseinfo (expensedate,headname,payeename,paymenttype,amount,remarks,status,creator_id) 
	VALUES ('$ExpenseDate','$HeadName','$PayeeName','$PaymentType','$Amount','$Remarks','1','$userid')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added Expense Info";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Expense Info";
	}	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST