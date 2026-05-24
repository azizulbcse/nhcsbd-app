<?php 	
header('Content-Type: application/json; charset=utf-8');
require_once 'core.php';

$sql = "SELECT yid, DATE_FORMAT(yearlastdate, '%d/%m/%Y') as last_date, yearlyamount, status 
        FROM tblyearlyamount 
        WHERE status != 0 
        ORDER BY yid DESC";

$result = $connect->query($sql);
$output = array('data' => array());

if($result && $result->num_rows > 0) { 
    $count = 1;
    while($row = $result->fetch_assoc()) {
        $YearlyAmountId = $row['yid'];
        $currentStatus = $row['status'];
        
        // ২. স্মার্ট স্ট্যাটাস ব্যাজ (লোগোর কালার থিমের সাথে মিল রেখে)
        if($currentStatus == 1) {
            $status = "<label class='label' style='background: #f39c12; color: #fff;'> <i class='fa fa-clock-o'></i> Pending </label>";
        } else if($currentStatus == 2) {
            $status = "<label class='label' style='background: var(--nhcs-green, #00C853); color: #fff;'> <i class='fa fa-check-circle'></i> Posted </label>";
        } else {
            $status = "<label class='label label-danger'> <i class='fa fa-times-circle'></i> Cancelled </label>";
        }

        // ৩. অ্যাকশন বাটন (স্মার্ট ড্রপডাউন)
        $button = '
        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Action <span class="caret"></span>
          </button>
          <ul class="dropdown-menu dropdown-menu-right">
            <li><a type="button" data-toggle="modal" data-target="#editYearlyAmountInfoModel" onclick="editYearlyAmountIdInfo('.$YearlyAmountId.')"> <i class="fa fa-edit"></i> Edit</a></li>';
            
            // শুধুমাত্র পেন্ডিং থাকলেই পোস্টিং অপশন দেখাবে (স্মার্ট লজিক)
            if($currentStatus == 1) {
                $button .= '<li><a type="button" data-toggle="modal" data-target="#postedYearlyAmountInfoModal" onclick="postedYearlyAmountIdInfo('.$YearlyAmountId.')"> <i class="fa fa-send"></i> Posting </a></li>';
            }

            $button .= '<li><a type="button" data-toggle="modal" data-target="#removeYearlyAmountIdModel" onclick="removeYearlyAmountIdInfo('.$YearlyAmountId.')"> <i class="fa fa-trash"></i> Cancel</a></li>       
          </ul>
        </div>';

        $output['data'][] = array( 	
            $count,
            $row['last_date'],
            "<strong>" . number_format($row['yearlyamount'], 2) . " BDT</strong>", // টাকা ফরম্যাট করা
            $status, 		
            $button
        ); 	
        $count++;
    } 
}

$connect->close();
echo json_encode($output);
