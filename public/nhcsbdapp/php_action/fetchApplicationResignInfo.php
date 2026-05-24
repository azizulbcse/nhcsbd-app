<?php 	
require_once 'core.php';
$user_id = $_SESSION['userId'];
$sql = "SELECT rid,DATE_FORMAT(resigndate, '%d/%m/%Y') as resigndate,resign_resons,status,president_status,sg_status,acc_status 
FROM tblapplication4resign WHERE status!=0 AND creator_id = {$user_id} ORDER BY resigndate ASC";
$result = $connect->query($sql);
$output = array('data' => array());
$count=1;

if($result->num_rows > 0) { 
 while($row = $result->fetch_array()) {
 	$ResignAppId = $row[0];
     if($row[3] == 1) 
	  {
		  $status = "Not Sent Yet";
	  } 
	  else if($row[3] == 2) 
	  {
		  $status = "<label class='label label-success'> Sent </label>";
	  }
	  if($row[4] == 1) 
	  {
		  $pstatus = "Pending";
	  }
	  if($row[4] == 2) 
	  {
		  $pstatus = "<label class='label label-success'> Approved </label>";
	  }
	  if($row[5] == 1) 
	  {
		  $sgstatus = "Pending";
	  }
	  if($row[5] == 2) 
	  {
		  $sgstatus = "<label class='label label-success'> Approved </label>";
	  }
	  if($row[6] == 1) 
	  {
		  $accstatus = "Pending";
	  }
	  if($row[6] == 2) 
	  {
		  $accstatus = "<label class='label label-success'> Approved </label>";
	  }
	
 	
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <!--<li><a type="button" data-toggle="modal" data-target="#editResignInfoModel" onclick="editResignInfo('.$ResignAppId.')"> <i class="glyphicon glyphicon-edit"></i> Edit </a></li>-->
		<li><a type="button" data-toggle="modal" data-target="#postedResignInfoModel" onclick="postedResignInfo('.$ResignAppId.')"> <i class="glyphicon glyphicon-ok"></i> Send </a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeResignInfoModel" onclick="removeResignInfo('.$ResignAppId.')"> <i class="glyphicon glyphicon-trash"></i> Cancel</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 	
		$count,
 		$row[1],
		$row[2],
		$status,
		$pstatus,
		$sgstatus,
		$accstatus,	
 		$button
 		); 	
	$count++;
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);