<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$editMemberName  = $_POST['editMemberName'];
 	$editMessageDts  = $_POST['editMessageDts'];
	$userid          = $_SESSION['userId'];
    $smsid           = $_POST['smsid'];

	$sql = "UPDATE tblsms4memberwise SET member_name = '$editMemberName',sms='$editMessageDts',modifier_id='$userid' 
	WHERE smsid = '$smsid' AND status=1"; 

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated SMS";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the SMS";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST