<?php 	
require_once 'core.php'; 
$sql = "SELECT tei.trxid,DATE_FORMAT(tei.expensedate, '%d/%m/%Y') as expensedate,tah.accHeadName,tap.payeeName,tei.paymenttype,
tei.amount,tei.remarks,tei.status
FROM tbltrxexpenseinfo tei, tblacchead tah, tblaccpayto tap 
WHERE tei.headname=tah.accHeadId AND tei.payeename=tap.payeeId AND tei.status!=0 ORDER BY tei.trxid DESC";
$result = $connect->query($sql);
$output = array('data' => array());
$count=1;
if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
 	$trxid = $row[0];
	 if($row[7] == 1) 
	 {
		  $status = "Pending";
	} 
 	else if($row[7] == 2) 
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
	    <li><a type="button" data-toggle="modal" data-target="#editExpenseInfoModel" onclick="editExpenseInfo('.$trxid.')"> <i class="glyphicon glyphicon-edit"></i> Edit </a></li>
		<li><a type="button" data-toggle="modal" data-target="#postedExpenseInfoModal" onclick="postedExpenseInfo('.$trxid.')"> <i class="glyphicon glyphicon-ok"></i> Posted </a></li> 
	    <li><a type="button" data-toggle="modal" data-target="#removeExpenseInfoModal" onclick="removeExpenseInfo('.$trxid.')"> <i class="glyphicon glyphicon-trash"></i> Remove </a></li>       
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
		$status,	
 		$button
 		); 	
	   $count++;
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);