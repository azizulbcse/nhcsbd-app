<?php 	
require_once 'core.php'; 
$sql = "SELECT smsid,member_name,sms,status FROM tblindividualsms ORDER BY createdate DESC";
$result = $connect->query($sql);
$output = array('data' => array());
$count=1;
if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
 	$smsid = $row[0];
	 if($row[3] == 1) 
	 {
		  $status = "Pending";
	} 
 	else if($row[3] == 1) 
	{
 		$status = "<label class='label label-success'> Sent </label>";
 	} 
	else
	{
 		$status = "<label class='label label-danger'> Cancel </label>";
	}
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	  Action<span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editHospitalInfoModel" onclick="editHospitalInfo('.$smsid.')"> <i class="glyphicon glyphicon-edit"></i> Edit </a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeHospitalInfoModal" onclick="removeHospitalInfo('.$smsid.')"> <i class="glyphicon glyphicon-trash"></i> Remove </a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
		$count,					  
 		$row[1], 
		$row[2], 	
		$status,	
 		$button
 		); 	
	   $count++;
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);