<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	
	$editNomineeName            = $_POST['editNomineeName'];
	$editNomineeRelation        = $_POST['editNomineeRelation'];
	$editNomineeMobile          = $_POST['editNomineeMobile'];
	$editNomineeAddress         = $_POST['editNomineeAddress'];
	$editNomineeNID             = $_POST['editNomineeNID'];
	$userid                     = $_POST['userid'];
	
	$sql = "UPDATE tblapplicantinfosh SET nomineename='$editNomineeName',nomineerelation='$editNomineeRelation',nomineemobile='$editNomineeMobile',
	nomineeaddress='$editNomineeAddress',nomineenid='$editNomineeNID' WHERE mid = $userid";
	
	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update Nominee Info";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating Nominee info";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
