<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	
	$editApplicantNameBangla    = $_POST['editApplicantNameBangla'];
	$editApplicantNameEnglish   = $_POST['editApplicantNameEnglish'];
	$editFathersName            = $_POST['editFathersName'];
	$editMothersName            = $_POST['editMothersName'];
	$editGender                 = $_POST['editGender'];
	$editMaritalStatus          = $_POST['editMaritalStatus'];
	$editDateofBirth            = date('Y-m-d', strtotime($_POST['editDateofBirth']));
	$editAge                    = $_POST['editAge'];
	$editPresentAddress         = $_POST['editPresentAddress'];
	$editPermanentAddress       = $_POST['editPermanentAddress'];
	$editHospitalName           = $_POST['editHospitalName'];
	$editMobileNo               = $_POST['editMobileNo'];
	$editAppNID                 = $_POST['editAppNID'];
	$editEmail                  = $_POST['editEmail'];
	$editBloodGroup             = $_POST['editBloodGroup'];
	$editNomineeName            = $_POST['editNomineeName'];
	$editNomineeRelation        = $_POST['editNomineeRelation'];
	$editNomineeMobile          = $_POST['editNomineeMobile'];
	$editNomineeAddress         = $_POST['editNomineeAddress'];
	$editEmergencyContact       = $_POST['editEmergencyContact'];
	$editBkashNogod             = $_POST['editBkashNogod'];
	$editTransactionNo          = $_POST['editTransactionNo'];
	$editBankName               = $_POST['editBankName'];
	$editBranchName             = $_POST['editBranchName'];
	$editAccountNo              = $_POST['editAccountNo'];
	$editAccountName            = $_POST['editAccountName'];
	$editMobileBankName         = $_POST['editMobileBankName'];
	$editMobileBankNo           = $_POST['editMobileBankNo'];
	//$userId                     = $_SESSION['userId'];
	$userid                     = $_POST['userid'];
	
	$sql = "UPDATE tblapplicantinfosh SET name_bangla='$editApplicantNameBangla',name_english='$editApplicantNameEnglish',
	fathers_name='$editFathersName',mothers_name='$editMothersName',gender='$editGender',maritalstatus='$editMaritalStatus',
	dateofbirth='$editDateofBirth',age='$editAge',presentaddress='$editPresentAddress',permanentaddress='$editPermanentAddress',
	hospitalname='$editHospitalName',mobileno='$editMobileNo',nid='$editAppNID',email='$editEmail',bloodgroup='$editBloodGroup',
	nomineename='$editNomineeName',nomineerelation='$editNomineeRelation',nomineemobile='$editNomineeMobile',
	nomineeaddress='$editNomineeAddress',emergencycontact='$editEmergencyContact',bkashno='$editBkashNogod',
	trxid='$editTransactionNo',bankmname='$editBankName',branchname='$editBranchName',acc_no='$editAccountNo',
	acc_name='$editAccountName',mobilebanktype='$editMobileBankName',mobilebankno='$editMobileBankNo' WHERE mid = $userid";
	
	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update Share Holder Info";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating Share Holder info";
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
