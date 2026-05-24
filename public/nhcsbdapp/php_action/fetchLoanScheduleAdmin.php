<?php 	
require_once 'core.php'; 

// URL theke MemberId receive kora (Jodi select kora hoy)
$member_id = isset($_GET['MemberId']) ? $_GET['MemberId'] : "";

$sql = "SELECT tls.schedule_id, tls.loanappid, tai.userpic, tai.name_english, tls.installment_no, tls.emi_amount,
DATE_FORMAT(tls.due_date, '%d/%m/%Y') as due_date, tls.payment_status 
FROM tblloanschedule tls, tblapplicantinfo tai 
WHERE tls.member_id = tai.mid";

// Jodi MemberId thake, tobe SQL-e filter jog hobe
if($member_id != "") {
    $sql .= " AND tls.member_id = '$member_id'";
}

$result = $connect->query($sql);
$output = array('data' => array());
$count = 1;

if($result->num_rows > 0) { 
    while($row = $result->fetch_array()) {
        $schedule_id = $row[0];
        if($row[7] == "Unpaid") {
            $status = "<label class='label label-danger'>Unpaid</label>";
        } else {
            $status = "<label class='label label-success'> Paid </label>";
        } 
        
        $imageUrl = substr($row[2], 3);
        $UserPhoto = "<img class='img-round' src='".$imageUrl."' style='height:60px; width:60px;' />";

        $output['data'][] = array( 		
            $count,
            $UserPhoto,		
            $row[3],
            $row[4],
            $row[5],
            $row[6],
            $status
        ); 	
        $count++;
    } 
}

$connect->close();
header('Content-Type: application/json');
echo json_encode($output);
