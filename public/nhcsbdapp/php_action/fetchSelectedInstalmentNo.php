<?php 	
require_once 'core.php';
$schedule_id = $_POST['schedule_id'];
$sql = "SELECT schedule_id, loanappid,member_id,installment_no,emi_amount as currentdue,due_date,payment_status 
FROM tblloanschedule WHERE schedule_id= $schedule_id and payment_status='Unpaid'";
//echo $sql;
$result = $connect->query($sql);
if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows
$connect->close();
echo json_encode($row);