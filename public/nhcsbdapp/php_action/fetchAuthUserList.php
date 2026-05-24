<?php 	
require_once 'core.php';
$sql = "SELECT user_id,username,userpic,fullname,designations,mobileno,usertype,status FROM tbladminuser 
WHERE status!=0 AND user_id!=1 order by user_id asc";
$result = $connect->query($sql);
$output = array('data' => array());
$count=1;
if($result->num_rows > 0) { 
 $active = ""; 

 while($row = $result->fetch_array()) {
 	$userid = $row[0];
	if($row[7] == 1) 
	{
 		$status = "Pending";
 	} 
	else if($row[7] == 2) 
	{
 		$status = "<label class='label label-success'> Active </label>";
 	} 
	else
	{
 		$status = "<label class='label label-danger'>Cancel</label>";
	}
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editUserModalBtn" data-target="#editUserModal" onclick="editUser('.$userid.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
		<li><a type="button" data-toggle="modal" data-target="#postedUserInfoModal" onclick="postedUserInfo('.$userid.')"> <i class="glyphicon glyphicon-ok"></i> Approved </a></li> 
	    <li><a type="button" data-toggle="modal" data-target="#removeUserModal" id="removeUserModalBtn" onclick="removeUser('.$userid.')"> <i class="glyphicon glyphicon-trash"></i> Remove </a></li>       
	  </ul>
	</div>';
	$imageUrl = substr($row[2], 3);
	$UserPhoto = "<img class='img-round' src='".$imageUrl."' style='height:60px; width:80px;' />";
 	//$UserPhoto = "<img class='img-round' src='".$row[userpic]."' style='height:60px; width:80px;'  />";
	$output['data'][] = array( 		
	$count,
 	$UserPhoto,	
	$row[3], 
	$row[4], 
	$row[1], 
	$row[5], 
	$row[6], 
	$status, 
 	$button 		
 	); 	
	$count++;
 }
}

$connect->close();

echo json_encode($output);