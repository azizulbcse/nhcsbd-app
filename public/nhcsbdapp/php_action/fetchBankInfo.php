<?php 	
header('Content-Type: application/json; charset=utf-8');
require_once 'core.php';

// শুধুমাত্র প্রয়োজনীয় কলামগুলো সিলেক্ট করা
$sql = "SELECT bank_id, bank_name, status FROM tblbankinfo WHERE status = 1 ORDER BY bank_name ASC";
$result = $connect->query($sql);

$output = array('data' => array());

if($result && $result->num_rows > 0) { 
    $count = 1;
    // fetch_assoc() ব্যবহার করা স্মার্ট প্র্যাকটিস (নাম দিয়ে ডাটা রিড করা সহজ)
    while($row = $result->fetch_assoc()) {
        $bankId = $row['bank_id'];
        $bankName = $row['bank_name'];
        $currentStatus = $row['status'];

        // স্ট্যাটাস লেবেল জেনারেট
        $status = ($currentStatus == 1) 
            ? "<label class='label label-success'><i class='fa-solid fa-check-circle'></i> Active</label>" 
            : "<label class='label label-danger'>Cancel</label>";

        // অ্যাকশন বাটন (Template Literal স্টাইলে সাজানো)
        $button = '
        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Action <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a type="button" data-toggle="modal" data-target="#editBankInfoModel" onclick="editBankInfo('.$bankId.')" style="cursor:pointer;"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
            <li><a type="button" data-toggle="modal" data-target="#removeBankInfoModel" onclick="removeBankInfo('.$bankId.')" style="cursor:pointer;"> <i class="glyphicon glyphicon-trash"></i> Cancel</a></li>       
          </ul>
        </div>';

        $output['data'][] = array( 	
            $count,
            $bankName,
            $status, 		
            $button
        ); 	
        $count++;
    } 
}

$connect->close();
echo json_encode($output);
