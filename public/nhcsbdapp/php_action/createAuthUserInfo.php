<?php 	
header('Content-Type: text/html; charset=utf-8');
require_once 'core.php';
require_once 'unicode.php';
$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

    $UserFullName 		= $_POST['UserFullName'];
    $UserDesignation 	= $_POST['UserDesignation'];
    $UserType           = $_POST['UserType'];
	$MobileNo 			= $_POST['MobileNo'];
    $UserPassword 		= md5($_POST['UserPassword']);
	$pcode              = $_POST['UserPassword'];
    $UserEmail 			= $_POST['UserEmail'];
	$userid             = $_SESSION['userId'];

	$type = explode('.', $_FILES['UserPhoto']['name']);
	$type = $type[count($type)-1];		
	$url = '../assets/img/user/'.uniqid(rand()).'.'.$type;
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if(is_uploaded_file($_FILES['UserPhoto']['tmp_name'])) {			
			if(move_uploaded_file($_FILES['UserPhoto']['tmp_name'], $url)) {
				
				$sql = "INSERT INTO tbladminuser (fullname, password, pcode, username, designations, mobileno, usertype, userpic, brandid, role, status,creator_id) 
				VALUES ('$UserFullName', '$UserPassword', '$pcode', '$UserEmail', '$UserDesignation','$MobileNo', '$UserType', '$url','1','1','1','$userid')";

				if($connect->query($sql) === TRUE) {
					$valid['success'] = true;
					$valid['messages'] = "Successfully Added New User";	
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while adding the User";
				}

			}	else {
				return false;
			}	// /else	
		} // if
	} // if in_array 		

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST