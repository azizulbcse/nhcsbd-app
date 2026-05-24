<?php 	
require_once 'core.php';
$sql = "SELECT t4r.rid,vb.name_english,vb.userpic,DATE_FORMAT(t4r.resigndate, '%d/%m/%Y') as resigndate,t4r.resign_resons,
t4r.president_status,t4r.sg_status,t4r.acc_status FROM tblapplication4resign t4r, vw_smssentboth vb
WHERE t4r.status=2 and t4r.creator_id=vb.mid ORDER BY t4r.rid DESC";
$result = $connect->query($sql);
$output = array('data' => array());
$count=1;

if($result->num_rows > 0) { 
 while($row = $result->fetch_array()) {
 	$ResignAppId = $row[0];
     if($row[5] == '1') 
	  {
		  $pstatus = "Pending";
	  } 
	  if($row[5] == '2') 
	  {
		  $pstatus = "<label class='label label-success'> Approved </label>";
	  } 
	  if($row[6] == '1') 
	  {
		  $sgstatus = "Pending";
	  }
	  if($row[6] == '2') 
	  {
		  $sgstatus = "<label class='label label-success'> Approved </label>";
	  }
	  if($row[7] == '1') 
	  {
		  $accstatus = "Pending";
	  } 
	  if($row[7] == '2') 
	  {
		  $accstatus = "<label class='label label-success'> Approved </label>";
	  }

 	
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
		<li><a type="button" data-toggle="modal" data-target="#PresidentApprovedResignInfoModel" onclick="PresidentApprovedResignInfo('.$ResignAppId.')"> <i class="glyphicon glyphicon-ok"></i> President Approved </a></li>
		<li><a type="button" data-toggle="modal" data-target="#SGApprovedResignInfoModel" onclick="SGApprovedResignInfo('.$ResignAppId.')"> <i class="glyphicon glyphicon-ok"></i> Secretary General Approved </a></li>
		<li><a type="button" data-toggle="modal" data-target="#ACCApprovedResignInfoModel" onclick="ACCApprovedResignInfo('.$ResignAppId.')"> <i class="glyphicon glyphicon-ok"></i> Accountened Approved </a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeResignInfoModel" onclick="removeResignInfo('.$ResignAppId.')"> <i class="glyphicon glyphicon-trash"></i> Cancel Application</a></li>       
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