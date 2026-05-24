<?php 	
require_once 'core.php'; 
if($_GET['id']==1) 
{ 
$sql = "SELECT tii.trxid,DATE_FORMAT(tii.incomedate, '%d/%m/%Y') as incomedate,tah.accHeadName,tap.name_english,tii.paymenttype,
tii.amount,tii.remarks,tii.status
FROM tbltrxincomeothersinfo tii, tblacchead tah, tblapplicantinfo tap 
WHERE tii.headname=tah.accHeadId AND tii.payeename=tap.mid AND tii.status!=0 ORDER BY tii.trxid DESC";
}
if($_GET['id']==2) 
{ 
$sql = "SELECT tii.trxid,DATE_FORMAT(tii.incomedate, '%d/%m/%Y') as incomedate,tah.accHeadName,tap.payeeName,tii.paymenttype,
tii.amount,tii.remarks,tii.status
FROM tbltrxincomeothersinfo tii, tblacchead tah, tblaccpayto tap 
WHERE tii.headname=tah.accHeadId AND tii.payeename=tap.payeeId AND tii.status!=0 ORDER BY tii.trxid DESC";
}
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
	    <!--<li><a type="button" data-toggle="modal" data-target="#editIncomeInfoModel" onclick="editIncomeInfo('.$trxid.')"> <i class="glyphicon glyphicon-edit"></i> Edit </a></li>-->
		<li><a type="button" data-toggle="modal" data-target="#postedIncomeInfoModal" onclick="postedIncomeInfo('.$trxid.')"> <i class="glyphicon glyphicon-ok"></i> Posted </a></li> 
	    <li><a type="button" data-toggle="modal" data-target="#removeIncomeInfoModal" onclick="removeIncomeInfo('.$trxid.')"> <i class="glyphicon glyphicon-trash"></i> Remove </a></li>       
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