<?php 	
require_once 'core.php'; 
$user_id = $_SESSION['userId'];
$sql = "SELECT trxdid,DATE_FORMAT(donatedate, '%d/%m/%Y') as donatedate,payment_type,donate_from,donate_to,donate_amount,trxno,remarks,status
FROM tbltrxdonationinfo WHERE creator_id = {$user_id} ORDER BY trxdid DESC";
$result = $connect->query($sql);
$output = array('data' => array());
$count=1;
if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
 	$trxid = $row[0];
	 if($row[8] == 1) 
	 {
		  $status = "Pending";
	} 
 	else if($row[8] == 2) 
	{
 		$status = "<label class='label label-success'> Posted </label>";
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
	    <li><a type="button" data-toggle="modal" data-target="#editDonateEntryInfoModel" onclick="editDonationEntryInfo('.$trxid.')"> <i class="glyphicon glyphicon-edit"></i> Edit </a></li>     
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
		$status,	
 		$button
 		); 	
	   $count++;
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);