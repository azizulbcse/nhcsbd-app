<?php 	
require_once 'core.php'; 
if($_GET['id']==1) 
{
$sql = "SELECT trxdid,DATE_FORMAT(depositdate, '%d/%m/%Y') as depositdate,userpic,name_english,payment_type,deposit_from,deposit_to,
deposit_amount,fixed_amount,trxno,remarks,status 
FROM vw_depositsummarymsh WHERE DATE_FORMAT(depositdate,'%M %Y') =DATE_FORMAT(CURDATE(), '%M %Y') AND creator_id<200 ORDER BY trxdid DESC";
}
if($_GET['id']==2) 
{
$sql = "SELECT trxdid,DATE_FORMAT(depositdate, '%d/%m/%Y') as depositdate,userpic,name_english,payment_type,deposit_from,deposit_to,
deposit_amount,fixed_amount,trxno,remarks,status 
FROM vw_depositsummarymsh WHERE DATE_FORMAT(depositdate,'%M %Y') =DATE_FORMAT(CURDATE(), '%M %Y') AND creator_id>1000 ORDER BY trxdid DESC";
}
$result = $connect->query($sql);
$output = array('data' => array());
$count=1;
if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
 	$trxid = $row[0];
	if($row[11] == 1) 
	{
		$status = "Pending";
	} 
 	else if($row[11] == 2) 
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
		<li><a type="button" data-toggle="modal" data-target="#postedDepositInfoModal" onclick="postedDepositInfo('.$trxid.')"> <i class="glyphicon glyphicon-ok"></i> Posting </a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeDepositInfoModal" onclick="removeDepositInfo('.$trxid.')"> <i class="glyphicon glyphicon-trash"></i> Remove </a></li>  
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
		$row[5],
		$row[6],	
		$row[7],
		$row[8],
		$row[9],
		$row[10],
		$status,	
 		$button
 		); 	
	   $count++;
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);