<?php 	
header('Content-Type: application/json; charset=utf-8');
require_once 'core.php';

// ১. শুধুমাত্র অ্যাক্টিভ ডাটা লোড করা (status = 2)
$sql = "SELECT mid, mname, year, status FROM tblmonthname WHERE status = 2 ORDER BY mid DESC";
$result = $connect->query($sql);

$output = array('data' => array());

if($result && $result->num_rows > 0) { 
    $count = 1;
    // fetch_assoc() ব্যবহার করা স্মার্ট প্র্যাকটিস
    while($row = $result->fetch_assoc()) {
        $MonthId = $row['mid'];
        $currentStatus = $row['status'];

        // ২. স্ট্যাটাস ব্যাজ (ব্র্যান্ড গ্রিন কালারে)
        $status = ($currentStatus == 2) 
            ? "<label class='label' style='background: var(--nhcs-green, #00C853); color: #fff;'> <i class='fa fa-check-circle'></i> Active </label>" 
            : "<label class='label label-danger'> <i class='fa fa-times-circle'></i> Cancel </label>";

        // ৩. অ্যাকশন বাটন (স্মার্ট ড্রপডাউন)
        $button = '
        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Action <span class="caret"></span>
          </button>
          <ul class="dropdown-menu dropdown-menu-right">
            <li>
                <a type="button" data-toggle="modal" data-target="#editDepositMonthInfoModel" onclick="editDepositMonthInfo('.$MonthId.')" style="cursor:pointer;"> 
                    <i class="fa fa-edit"></i> Edit 
                </a>
            </li>
          </ul>
        </div>';

        $output['data'][] = array( 	
            $count,
            "<strong>" . $row['mname'] . "</strong>", // মাসের নাম বোল্ড করা
            $row['year'],
            $status, 		
            $button
        ); 	
        $count++;
    } 
}

$connect->close();
echo json_encode($output);
