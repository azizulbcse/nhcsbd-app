<?php 
require_once 'core.php';

if($_POST) {

	$valid['success'] = array('success' => false, 'messages' => array());

	$currentPassword  = md5($_POST['password']);
	$newPassword      = md5($_POST['npassword']);
	$conformPassword  = md5($_POST['cpassword']);
	$pcode            = $_POST['npassword'];
	$userId           = $_POST['user_id'];

	$sql ="SELECT * FROM tblapplicantinfosh WHERE mid = {$userId}";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();

	if($currentPassword == $result['password']) {

		if($newPassword == $conformPassword) {

			$updateSql = "UPDATE tblapplicantinfosh SET password = '$newPassword',pcode = '$pcode' WHERE mid = {$userId}";
			if($connect->query($updateSql) === TRUE) {
				$valid['success'] = true;
				$valid['messages'] = "Passowrd Change Successfully";		
			} else {
				$valid['success'] = false;
				$valid['messages'] = "Error while updating the password";	
			}

		} else {
			$valid['success'] = false;
			$valid['messages'] = "New password does not match with Conform password";
		}

	} else {
		$valid['success'] = false;
		$valid['messages'] = "Current password is incorrect";
	}

	$connect->close();

	echo json_encode($valid);

}

?>