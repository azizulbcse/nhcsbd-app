<?php 	
require_once 'core.php';
$user_id = $_SESSION['userId'];
$sql = "SELECT ta4l.loanappid,DATE_FORMAT(ta4l.loanappdate, '%d/%m/%Y') as loanappdate,tai.userpic,tai.name_english,
ta4l.guarantorname,ta4l.loantype,ta4l.loanamount,ta4l.interestrate,ta4l.loantenure,ta4l.monthemi,ta4l.totalinterest,
ta4l.totalpayment,ta4l.status,ta4l.president_status,ta4l.sg_status,ta4l.acc_status FROM tblapplication4loan ta4l, tblapplicantinfo tai 
WHERE ta4l.status!=0 AND ta4l.creator_id=tai.mid ORDER BY ta4l.loanappdate DESC";
$result = $connect->query($sql);
$output = array('data' => array());
$count=1;

if($result->num_rows > 0) { 
 while($row = $result->fetch_array()) {
 	$LoanAppId = $row[0];
     if($row[12] == 1) 
	  {
		  $status = "Not Sent Yet";
	  } 
	  else if($row[12] == 2) 
	  {
		  $status = "<label class='label label-success'> Sent </label>";
	  }
	  if($row[13] == 1) 
	  {
		  $pstatus = "Pending";
	  }
	  if($row[13] == 2) 
	  {
		  $pstatus = "<label class='label label-success'> Approved </label>";
	  }
	  if($row[14] == 1) 
	  {
		  $sgstatus = "Pending";
	  }
	  if($row[14] == 2) 
	  {
		  $sgstatus = "<label class='label label-success'> Approved </label>";
	  }
	  if($row[15] == 1) 
	  {
		  $accstatus = "Pending";
	  }
	  if($row[15] == 2) 
	  {
		  $accstatus = "<label class='label label-success'> Approved </label>";
	  }
	
 	
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#PresidentApprovedResignInfoModel" onclick="PresidentApprovedResignInfo('.$LoanAppId.')"> <i class="glyphicon glyphicon-ok"></i> President Approved </a></li>
		<li><a type="button" data-toggle="modal" data-target="#SGApprovedResignInfoModel" onclick="SGApprovedResignInfo('.$LoanAppId.')"> <i class="glyphicon glyphicon-ok"></i> Secretary General Approved </a></li>
		<li><a type="button" data-toggle="modal" data-target="#ACCApprovedResignInfoModel" onclick="ACCApprovedResignInfo('.$LoanAppId.')"> <i class="glyphicon glyphicon-ok"></i> Accountened Approved </a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeResignInfoModel" onclick="removeResignInfo('.$LoanAppId.')"> <i class="glyphicon glyphicon-trash"></i> Cancel</a></li>       
	  </ul>
	</div>';

	$imageUrl = substr($row[2], 3);
	$UserPhoto = "<img class='img-round' src='".$imageUrl."' style='height:120px; width:90px;' />";

 	$output['data'][] = array( 	
		$count,
		$row[3],
		$UserPhoto,
		$row[1],
		$row[4],
		$row[5],
		$row[6],
		$row[7],
		$row[8],
		$row[9],
		$row[10],
		$row[11],
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