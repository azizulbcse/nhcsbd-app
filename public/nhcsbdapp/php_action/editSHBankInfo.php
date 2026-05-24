<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	
	$editBankName            = $_POST['editBankName'];
	$editBranchName          = $_POST['editBranchName'];
	$editAccountNo           = $_POST['editAccountNo'];
	$editAccName             = $_POST['editAccName'];
	$editMobileBankType      = $_POST['editMobileBankType'];
	$editMobileBankNo        = $_POST['editMobileBankNo'];
	$userid                  = $_POST['userid'];
	
	$sql = "UPDATE tblapplicantinfosh SET bankmname='$editBankName',branchname='$editBranchName',acc_no='$editAccountNo',
	acc_name='$editAccName',mobilebanktype='$editMobileBankType',mobilebankno='$editMobileBankNo' WHERE mid = $userid";
	
	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update Bank Account Info";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating Bank Account info";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
