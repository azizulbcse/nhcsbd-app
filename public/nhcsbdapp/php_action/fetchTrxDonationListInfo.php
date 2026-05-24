<?php 	
require_once 'core.php'; 
$sql = "SELECT tdi.trxdid,DATE_FORMAT(tdi.donatedate, '%d/%m/%Y') as donatedate,tdi.depositername,tdi.mobileno,tdi.payment_type,
tdl.name,tdi.donate_amount,tdi.trxno,tdi.remarks,tdi.status FROM tbltrxdonationinfo tdi, tbldonatelist tdl 
WHERE tdi.donate_to=tdl.sysid AND tdi.status!=0 ORDER BY tdi.trxdid DESC";
$result = $connect->query($sql);
$output = array('data' => array());
$count=1;
if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
 	$trxid = $row[0];
	 if($row[9] == 1) 
	 {
		  $status = "Pending";
	} 
 	else if($row[9] == 2) 
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
	    <!--<li><a type="button" data-toggle="modal" data-target="#editDonateEntryInfoModel" onclick="editDonationEntryInfo('.$trxid.')"> <i class="glyphicon glyphicon-edit"></i> Edit </a></li>-->   
		<li><a type="button" data-toggle="modal" data-target="#postedDonationInfoModal" onclick="postedDonationInfo('.$trxid.')"> <i class="glyphicon glyphicon-ok"></i> Posting </a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeDonationInfoModal" onclick="removeDonationInfo('.$trxid.')"> <i class="glyphicon glyphicon-trash"></i> Remove </a></li>  
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
		$status,	
 		$button
 		); 	
	   $count++;
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);