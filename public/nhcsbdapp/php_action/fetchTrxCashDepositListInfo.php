<?php 	
require_once 'core.php'; 
$sql = "SELECT tdi.trxdid,DATE_FORMAT(tdi.depositdate, '%d/%m/%Y') as depositdate,tai.userpic,tai.name_english,tdi.payment_type,
tdi.deposit_from,tdi.deposit_to,tdi.deposit_amount,tdi.trxno,tdi.remarks,tdi.status FROM tbltrxdepositinfo tdi, tblapplicantinfo tai 
WHERE tdi.memberid=tai.mid AND tdi.payment_type='Cash' AND tdi.status!=0 ORDER BY tdi.trxdid DESC";
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
		   <li><a type="button" data-toggle="modal" data-target="#editCashReceivedEntryInfoModel" onclick="editCashReceivedEntryInfo('.$trxid.')"> <i class="glyphicon glyphicon-edit"></i> Edit </a></li>   
		   <li><a type="button" data-toggle="modal" data-target="#postedCashReceivedInfoModel" onclick="postedCashReceivedInfo('.$trxid.')"> <i class="glyphicon glyphicon-ok"></i> Posting </a></li>
		   <li><a type="button" data-toggle="modal" data-target="#removeCashReceivedInfoModel" onclick="removeCashReceivedInfo('.$trxid.')"> <i class="glyphicon glyphicon-trash"></i> Remove </a></li>  
		 </ul>
	   </div>';
	   $imageUrl = substr($row[2], 3);
	   $UserPhoto = "<img class='img-round' src='".$imageUrl."' style='height:60px; width:60px;' />";
   
		
	   $output['data'][] = array( 		
		$count,		
		$UserPhoto,				  
 		$row[1], 
		$row[3],
		$row[4],
		//$row[5],
		//$row[6],	
		$row[7],
		//$row[8],
		$row[9],
		$status,	
 		$button
 		); 	
	   $count++;
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);