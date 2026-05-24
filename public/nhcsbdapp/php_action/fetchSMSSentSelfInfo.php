<?php 	
require_once 'core.php'; 
$user_id = $_SESSION['userId'];
$sql = "SELECT sysid,mobile,message,cost,createdate FROM vw_smssentdetails WHERE mid = {$user_id} ORDER BY createdate DESC";
$result = $connect->query($sql);
$output = array('data' => array());
$count=1;
if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {

 	$output['data'][] = array( 		
		$count,					  
 		$row[1], 
		$row[2],
		$row[3],
		$row[4],   		
 		); 	
	   $count++;
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);