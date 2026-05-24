<?php  
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {		

$userid = $_POST['userid'];
 
$type = explode('.', $_FILES['editUserImage']['name']);
	$type = $type[count($type)-1];		
	$url = '../assets/img/nominee/'.uniqid(rand()).'.'.$type;
	if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
		if(is_uploaded_file($_FILES['editUserImage']['tmp_name'])) {			
			if(move_uploaded_file($_FILES['editUserImage']['tmp_name'], $url)) {
				$sql = "UPDATE tblapplicantinfo SET nomineepic = '$url' WHERE mid = $userid";				

				if($connect->query($sql) === TRUE) {									
					$valid['success'] = true;
					$valid['messages'] = "Successfully Updated Nominee Photo";	
				} else {
					$valid['success'] = false;
					$valid['messages'] = "Error while updating Nominee Photo";
				}
			}	else {
				return false;
			}	// /else	
		} // if
	} // if in_array 		
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST