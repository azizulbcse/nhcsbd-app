<?php 	
require_once 'core.php'; 

$sql = "SELECT hid, hospitalname, status FROM tblhospitalname WHERE status != 0 ORDER BY hospitalname ASC";
$result = $connect->query($sql);

$output = array('data' => array());
$count = 1;

if($result->num_rows > 0) { 
    while($row = $result->fetch_array()) {
        $hid = $row[0];
        
        // ১. স্মার্ট স্ট্যাটাস ব্যাজ (লোগোর সবুজ)
        if($row[2] == 1) {
            $status = "<span class='label label-success' style='background-color: #05B262; border-radius: 12px; padding: 4px 12px;'> Active </span>";
        } else {
            $status = "<span class='label label-danger' style='border-radius: 12px; padding: 4px 12px;'> Cancel </span>";
        }

        // ২. স্মার্ট অ্যাকশন বাটন (Glyphicon ব্যবহার করা হয়েছে যাতে ১০০% শো করে)
        $button = '
        <div class="btn-group">
            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-radius: 6px; font-weight: bold;">
                Action <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" style="border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                <li>
                    <a type="button" data-toggle="modal" data-target="#editHospitalInfoModel" onclick="editHospitalInfo('.$hid.')" style="padding: 8px 15px; cursor:pointer;"> 
                        <i class="glyphicon glyphicon-edit" style="color: #1a4d6d;"></i> Edit 
                    </a>
                </li>
                <li>
                    <a type="button" data-toggle="modal" data-target="#removeHospitalInfoModal" onclick="removeHospitalInfo('.$hid.')" style="padding: 8px 15px; cursor:pointer;"> 
                        <i class="glyphicon glyphicon-trash" style="color: #d9534f;"></i> Remove 
                    </a>
                </li>       
            </ul>
        </div>';

        $output['data'][] = array( 		
            "<center>".$count."</center>",					  
            "<b>".$row[1]."</b>", 	
            "<center>".$status."</center>",	
            "<center>".$button."</center>"
        ); 	
        $count++;
    } 
} 

$connect->close();
echo json_encode($output);
?>
