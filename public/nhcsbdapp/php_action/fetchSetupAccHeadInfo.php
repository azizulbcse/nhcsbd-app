<?php 	
require_once 'core.php'; 
$sql = "SELECT tah.accHeadId,tag.AccGroupName,tah.accHeadName,tah.status FROM tblacchead tah, tblaccgroup tag 
WHERE tah.status=1 AND tah.accGroupId=tag.AccGroupId ORDER BY tah.accHeadName ASC";
$result = $connect->query($sql);
$output = array('data' => array());
$count=1;
if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
 	$accHeadId = $row[0];
 	if($row[3] == 1) 
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
	    <li><a type="button" data-toggle="modal" data-target="#editAccHeadInfoModel" onclick="editAccountHeadInfo('.$accHeadId.')"> <i class="glyphicon glyphicon-edit"></i> Edit </a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeAccHeadInfoModal" onclick="removeAccHeadInfo('.$accHeadId.')"> <i class="glyphicon glyphicon-trash"></i> Remove </a></li>       
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