<?php 	
require_once 'core.php'; 

$user_id = $_SESSION['userId'];
$sql = "SELECT tai.mid,tai.name_bangla,tai.userpic,tai.name_english,tai.fathers_name,thn.hospitalname,tai.gender,tai.age,
tai.mobileno,tai.status FROM tblapplicantinfo tai, tblhospitalname thn WHERE tai.hospitalname=thn.hid AND tai.mid = {$user_id} AND tai.status=2";
$result = $connect->query($sql);
$output = array('data' => array());
$count=1;
if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
 	$userid = $row[0];
	 if($row[9] == 1) 
	{
		$status = "Pending";
	} 
 	else if($row[9] == 2) 
	{
 		$status = "<label class='label label-success'> Approved </label>";
 	} 
	else
	{
 		$status = "<label class='label label-danger'>Cancel</label>";
	}
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	  Action<span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editApplicantInfoModel" onclick="editApplicantInfo('.$userid.')"> <i class="glyphicon glyphicon-edit"></i> Edit </a></li>  
		<li><a type="button" onclick="PrintMemberProfile('.$userid.')"> <i class="glyphicon glyphicon-print"></i> Print Profile </a></li>    
	  </ul>
	</div>';
	$imageUrl = substr($row[2], 3);
	$UserPhoto = "<img class='img-round' src='".$imageUrl."' style='height:120px; width:90px;' />";

 	$output['data'][] = array( 		
		$count,		
		$UserPhoto,	
 		$row[1],
		$row[3],
		$row[4],
		$row[5],
		$row[6],
		$row[7],
		$row[8],
		$status,	
 		$button
 		); 	
	   $count++;
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);