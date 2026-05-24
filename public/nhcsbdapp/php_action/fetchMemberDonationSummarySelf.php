<?php 	
require_once 'core.php'; 
$user_id = $_SESSION['userId'];
$sql = "SELECT mid,name_english,userpic,mobileno,donate_amount FROM vw_memberdonationsummary WHERE donate_amount!=0 AND mid={$user_id}";
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
		<li><a type="button" onclick="PrintMemberDonationDetails('.$mid.')"> <i class="glyphicon glyphicon-print"></i> Donate Details </a></li>     
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
		$button  		
 		); 	
	   $count++;
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);