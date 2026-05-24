<?php 	
require_once 'core.php'; 
$sql = "SELECT sysid,name_english,userpic,mobile,message,cost,createdate FROM vw_smssentdetails ORDER BY createdate DESC";
$result = $connect->query($sql);
$output = array('data' => array());
$count=1;
if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {

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
 		); 	
	   $count++;
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);