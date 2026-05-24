<?php 	
require_once 'core.php';
$user_id = $_SESSION['userId'];
$sql = "SELECT loanappid,DATE_FORMAT(loanappdate, '%d/%m/%Y') as loanappdate,guarantorname,loantype,loanamount,interestrate,loantenure,monthemi,
totalinterest,totalpayment,status,president_status,sg_status,acc_status FROM tblapplication4loan WHERE status!=0 
AND creator_id = {$user_id} ORDER BY loanappdate DESC";
$result = $connect->query($sql);
$output = array('data' => array());
$count=1;

if($result->num_rows > 0) { 
 while($row = $result->fetch_array()) {
 	$LoanAppId = $row[0];
     if($row[10] == 1) 
	  {
		  $status = "Not Sent Yet";
	  } 
	  else if($row[10] == 2) 
	  {
		  $status = "<label class='label label-success'> Sent </label>";
	  }
	  if($row[11] == 1) 
	  {
		  $pstatus = "Pending";
	  }
	  if($row[11] == 2) 
	  {
		  $pstatus = "<label class='label label-success'> Approved </label>";
	  }
	  if($row[12] == 1) 
	  {
		  $sgstatus = "Pending";
	  }
	  if($row[12] == 2) 
	  {
		  $sgstatus = "<label class='label label-success'> Approved </label>";
	  }
	  if($row[13] == 1) 
	  {
		  $accstatus = "Pending";
	  }
	  if($row[13] == 2) 
	  {
		  $accstatus = "<label class='label label-success'> Approved </label>";
	  }
	
 	
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <!--<li><a type="button" data-toggle="modal" data-target="#editResignInfoModel" onclick="editResignInfo('.$LoanAppId.')"> <i class="glyphicon glyphicon-edit"></i> Edit </a></li>-->
		<li><a type="button" data-toggle="modal" data-target="#postedResignInfoModel" onclick="postedResignInfo('.$LoanAppId.')"> <i class="glyphicon glyphicon-ok"></i> Send </a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeResignInfoModel" onclick="removeResignInfo('.$LoanAppId.')"> <i class="glyphicon glyphicon-trash"></i> Cancel</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 	
		$count,
 		$row[1],
		$row[2],
		$row[3],
		$row[4],
		$row[5],
		$row[6],
		$row[7],
		$row[8],
		$row[9],
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