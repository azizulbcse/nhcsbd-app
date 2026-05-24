<?php 	

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$ApplicantNameBangla   = $_POST['ApplicantNameBangla'];
    $ApplicantNameEnglish  = $_POST['ApplicantNameEnglish']; 
	$FathersName           = $_POST['FathersName']; 
	$MothersName           = $_POST['MothersName'];
	$Gender                = $_POST['Gender'];
	$MaritalStatus         = $_POST['MaritalStatus'];
	//$DateofBirth           = $_POST['DateofBirth'];
    $DateofBirth           = date('Y-m-d', strtotime($_POST['$DateofBirth']));
	$Age                   = $_POST['Age'];
	$PresentAddress        = $_POST['PresentAddress'];
	$PermanentAddress      = $_POST['PermanentAddress'];
	$HospitalName          = $_POST['HospitalName'];
	$MobileNo              = $_POST['MobileNo'];
	$AppNID                = $_POST['AppNID'];
	$Email                 = $_POST['Email'];
	$BloodGroup            = $_POST['BloodGroup'];
	$NomineeName           = $_POST['NomineeName'];
	$NomineeRelation       = $_POST['NomineeRelation'];
	$NomineeMobile         = $_POST['NomineeMobile'];
	$NomineeAddress        = $_POST['NomineeAddress'];
	$EmergencyContact      = $_POST['EmergencyContact'];
	$BkashNogod            = $_POST['BkashNogod'];
	$TransactionNo         = $_POST['TransactionNo'];
	
	$sql = "INSERT INTO tblapplicantinfo (userpic,name_bangla,name_english,fathers_name,mothers_name,gender,maritalstatus,dateofbirth,age,presentaddress,permanentaddress,hospitalname,mobileno,nid,email,bloodgroup,nomineepic,nomineename,nomineerelation,nomineemobile,nomineeaddress,emergencycontact,bkashno,trxid,status) VALUES ('../assets/img/user/no pic.jpg','$ApplicantNameBangla','$ApplicantNameEnglish','$FathersName','$MothersName','$Gender','$MaritalStatus','$DateofBirth','$Age','$PresentAddress','$PermanentAddress','$HospitalName','$MobileNo','$AppNID','$Email','$BloodGroup','../assets/img/nominee/no pic.jpg','$NomineeName','$NomineeRelation','$NomineeMobile','$NomineeAddress','$EmergencyContact','$BkashNogod','$TransactionNo','1')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Application Sent Successfully";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Application";
	} 

	$connect->close();
	echo json_encode($valid);
}