<?php 	
require_once 'core.php'; 
$sql = "SELECT vmds.mid,vmds.name_english,vmds.userpic,vmds.tmpaya,vmds.tmpaida,vmds.tmduea,vmds.tpayfixeda,vmds.tpaidfixeda,
vmds.tfixeduea,vmds.tpaya,vmds.tpaida,vmds.tduea FROM vw_memberdepositsummary vmds, tblapplicantinfosh tai 
WHERE vmds.mid=tai.mid AND tai.status=2 ORDER BY tai.mid ASC";
$result = $connect->query($sql);
$output = array('data' => array());
$count=1;
if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
	$mid=$row[0];

	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
		<li><a type="button" onclick="PrintSHDepositDetails('.$mid.')"> <i class="glyphicon glyphicon-print"></i> Deposit Details </a></li>     
	  </ul>
	</div>';

	$imageUrl = substr($row[2], 3);
	$UserPhoto = "<img class='img-round' src='".$imageUrl."' style='height:60px; width:80px;' />";
	$MemberImagelink = '<a href="member-deposit-details.php?mid='.$mid.'" target="_blank">'.$UserPhoto. '</a>';

 	$output['data'][] = array( 		
		$count,
		//$MemberImagelink,	
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
		$row[11],
		$button  		
 		); 	
	   $count++;
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);