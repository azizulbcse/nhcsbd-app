<?php 	
require_once 'core.php'; 
if($_GET['id']==1) 
{ 
$sql = "SELECT tdi.trxdid,DATE_FORMAT(tdi.depositdate, '%d/%m/%Y') as depositdate,tai.userpic,tdi.payment_type,tai.name_english,
tdi.deposit_to,tdi.deposit_amount,tdi.fixed_amount,'Hand to Hand',tdi.remarks,tdi.status FROM tbltrxdepositinfo tdi, tblapplicantinfo tai 
WHERE tdi.payment_type='Cash' AND tdi.memberid=tai.mid AND DATE_FORMAT(depositdate,'%M %Y') =DATE_FORMAT(CURDATE(), '%M %Y') 
ORDER BY trxdid DESC";
}
if($_GET['id']==2) 
{ 
$sql = "SELECT tdi.trxdid,DATE_FORMAT(tdi.depositdate, '%d/%m/%Y') as depositdate,tai.userpic,tdi.payment_type,tai.name_english,
tdi.deposit_to,tdi.deposit_amount,tdi.fixed_amount,tdi.trxno,tdi.remarks,tdi.status FROM tbltrxdepositinfo tdi, tblapplicantinfo tai 
WHERE tdi.payment_type='Online Cash Deposit' AND tdi.memberid=tai.mid AND DATE_FORMAT(depositdate,'%M %Y') =DATE_FORMAT(CURDATE(), '%M %Y') 
ORDER BY trxdid DESC";
}
if($_GET['id']==3) 
{ 
$sql = "SELECT tdi.trxdid,DATE_FORMAT(tdi.depositdate, '%d/%m/%Y') as depositdate,tai.userpic,tdi.payment_type,tai.name_english,
tdi.deposit_to,tdi.deposit_amount,tdi.fixed_amount,tdi.trxno,tdi.remarks,tdi.status FROM tbltrxdepositinfo tdi, tblapplicantinfo tai 
WHERE tdi.payment_type in ('Bkash','Nogod','Rocket','Upay') AND tdi.memberid=tai.mid AND DATE_FORMAT(depositdate,'%M %Y') =DATE_FORMAT(CURDATE(), '%M %Y') 
ORDER BY trxdid DESC";
}
$result = $connect->query($sql);
$output = array('data' => array());
$count=1;
if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
 	$trxid = $row[0];
	 if($row[10] == 1) 
	 {
		  $status = "Pending";
	} 
 	else if($row[10] == 2) 
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
	    <li><a type="button" data-toggle="modal" data-target="#editDepositEntryInfoModel" onclick="editDepositEntryInfo('.$trxid.')"> <i class="glyphicon glyphicon-edit"></i> Edit </a></li>     
	  </ul>
	</div>';

	$imageUrl = substr($row[2], 3);
	$UserPhoto = "<img class='img-round' src='".$imageUrl."' style='height:120px; width:90px;' />";

 	$output['data'][] = array( 		
		$count,	
		$UserPhoto,				  
 		$row[1], 
		$row[3],
		$row[4],
		$row[5],
		$row[6],	
		$row[7],
		$row[8],
		$row[9],
		$status,	
 		$button
 		); 	
	   $count++;
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);