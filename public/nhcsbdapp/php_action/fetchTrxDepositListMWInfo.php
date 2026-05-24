<?php 	
require_once 'core.php';
$month = isset($_POST['month']) ? $_POST['month'] : "";
$sql = "SELECT trxdid, DATE_FORMAT(depositdate, '%d/%m/%Y') as depositdate, userpic, name_english, payment_type, deposit_from,
        deposit_to, deposit_amount, fixed_amount, trxno, remarks, status  
        FROM vw_depositsummarymsh";
if (!empty($month)) {
    $safe_month = $connect->real_escape_string($month);
    $sql .= " WHERE remarks = '$safe_month'";
}

$sql .= " ORDER BY trxdid DESC";

$result = $connect->query($sql);
$output = array('data' => array());
$count = 1;

if($result->num_rows > 0) { 

    while($row = $result->fetch_array()) {
    $trxdid = $row[0];    
        // স্ট্যাটাস লেবেল তৈরি (index 11)
        if($row[11] == 1) {
            $status = "Pending";
        } else if($row[11] == 2) {
            $status = "<label class='label label-success'> Posted </label>";
        } else {
            $status = "<label class='label label-danger'>Cancel</label>";
        }
$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	  Action<span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">  
		<li><a type="button" data-toggle="modal" data-target="#postedDepositInfoModal" onclick="postedDepositInfo('.$trxdid.')"> <i class="glyphicon glyphicon-ok"></i> Posting </a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeDepositInfoModal" onclick="removeDepositInfo('.$trxdid.')"> <i class="glyphicon glyphicon-trash"></i> Remove </a></li>  
	  </ul>
	</div>';
	
        // ছবি প্রসেসিং (index 2)
        $imageUrl = substr($row[2], 3);
        $UserPhoto = "<img class='img-round' src='".$imageUrl."' style='height:60px; width:60px;' />";

        // টেবিল আউটপুট ফরম্যাট
        $output['data'][] = array( 		
            $count,		
            $UserPhoto,				  
            $row[1], // depositdate
            $row[3], // name_english
            $row[4], // payment_type
            $row[5], // deposit_from
            $row[6], // deposit_to	
            $row[7], // deposit_amount
            $row[8], // fixed_amount
            $row[9], // trxno
            $row[10], // remarks (যা আপনার মাসের নাম)
            $status,
            $button
        ); 	
        $count++;
    }
}

$connect->close();
echo json_encode($output);
