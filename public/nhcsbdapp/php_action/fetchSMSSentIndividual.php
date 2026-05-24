<?php 	
require_once 'core.php'; 
$sql = "SELECT tisms.smsid,tai.name_english,tai.userpic,tai.mobileno,tisms.sms,tisms.status,tisms.createdate 
FROM tblsms4memberwise tisms, tblapplicantinfo tai WHERE tisms.member_name=tai.mid AND tisms.status!=0 ORDER BY tisms.smsid DESC";
$result = $connect->query($sql);
$output = array('data' => array());
$count=1;
if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
 	$smsid = $row[0];
 	if($row[5] == 1) 
	{
 		$status = "Pending";
 	} 
	else if($row[5] == 2) 
	 {
		  $status = "<label class='label label-success'> Send </label>";
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
	    <li><a type="button" data-toggle="modal" data-target="#editIndividualSMSModel" onclick="editIndividualSMSInfo('.$smsid.')"> <i class="glyphicon glyphicon-edit"></i> Edit </a></li>
		<li><a type="button" data-toggle="modal" data-target="#postSMSIndividualModel" onclick="postSMSIndividualInfo('.$smsid.')"> <i class="glyphicon glyphicon-ok"></i> Send </a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeIndividualSMSModel" onclick="removeIndividualSMSInfo('.$smsid.')"> <i class="glyphicon glyphicon-trash"></i> Remove </a></li>       
	  </ul>
	</div>';
	$imageUrl = substr($row[2], 3);
	$UserPhoto = "<img class='img-round' src='".$imageUrl."' style='height:60px; width:80px;' />";
 	$output['data'][] = array( 		
		$count,		
		$UserPhoto,				  
 		$row[1],
		$row[3], 	
		$row[4], 
		$row[6],	
		$status,
 		$button
 		); 	
	   $count++;
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);