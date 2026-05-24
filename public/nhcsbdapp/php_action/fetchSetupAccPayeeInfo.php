<?php 	
require_once 'core.php'; 
$sql = "SELECT payeeId, payeeName,status FROM tblaccpayto WHERE status=1 ORDER BY payeeName ASC";
$result = $connect->query($sql);
$output = array('data' => array());
$count=1;
if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
 	$payeeId = $row[0];
 	if($row[2] == 1) 
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
	  Action<span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editPayeeInfoModel" onclick="editPayeeInfo('.$payeeId.')"> <i class="glyphicon glyphicon-edit"></i> Edit </a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removePayeeInfoModal" onclick="removePayeeInfo('.$payeeId.')"> <i class="glyphicon glyphicon-trash"></i> Remove </a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
		$count,					  
 		$row[1], 	
		$status,	
 		$button
 		); 	
	   $count++;
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);