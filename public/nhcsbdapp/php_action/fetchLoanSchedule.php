<?php 	
require_once 'core.php'; 
$user_id = $_SESSION['userId']; 
$sql = "SELECT schedule_id,loanappid,installment_no,emi_amount,DATE_FORMAT(due_date, '%d/%m/%Y') as due_date,payment_status FROM tblloanschedule 
WHERE member_id={$user_id}";
$result = $connect->query($sql);
$output = array('data' => array());
$count=1;
if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
 	$schedule_id = $row[0];
	if($row[5] == "Unpaid") 
	{
		$status = "<label class='label label-danger'>Unpaid</label>";
	} 
	else	
	{
 		$status = "<label class='label label-success'> Paid </label>";
 	} 
 	$output['data'][] = array( 		
		$count,		
 		$row[1],
		$row[2],
		$row[3],
		$row[4],
		$status
 		); 	
	   $count++;
 } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);