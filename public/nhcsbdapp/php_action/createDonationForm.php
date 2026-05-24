<?php 	

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$DonateDate     = $_POST['DonateDate'];
    $DonateName     = $_POST['DonateName']; 
	$MobileNo       = $_POST['MobileNo']; 
	$DonationAmount = $_POST['DonationAmount'];
	$PaymentType    = $_POST['PaymentType'];
	$DepositTo      = $_POST['DepositTo'];
	$TransactionNo  = $_POST['TransactionNo'];
	$Remarks        = $_POST['Remarks'];	
	
	$sql = "INSERT INTO tbltrxdonationinfo (donatedate,depositername,mobileno,payment_type,donate_to,donate_amount,trxno,remarks,status) 
	VALUES ('$DonateDate','$DonateName','$MobileNo','$PaymentType','$DepositTo','$DonationAmount','$TransactionNo','$Remarks','1')";
	//echo $sql;

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Donation Sent Successfully";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Donation";
	} 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST