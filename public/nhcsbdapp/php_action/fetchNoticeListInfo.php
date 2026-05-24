<?php 	
// ১. ক্যারেক্টার সেট এবং হেডার সিকিউরিটি লক করা
header('Content-Type: application/json; charset=utf-8');
require_once 'core.php'; 

// 🎯 স্ক্রিনশট অনুযায়ী আসল টেবিল 'notices' দিয়ে কুয়েরি ফিক্স করা হলো
$sql = "SELECT id, noticeno, DATE_FORMAT(notice_date, '%d/%m/%Y') as notice_date, title, content, file_name, status FROM notices ORDER BY id DESC";

$result = $connect->query($sql);
$output = array('data' => array());
$count = 1;

if($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) {
        $noticeId = $row['id'];
        $fileName = $row['file_name'];
        $statusValue = $row['status'];

        // ২. আপনার ডাটাবেজ স্ট্যাটাস কমেন্ট (2 = Published) অনুযায়ী লেবেল সেট করা
        if($statusValue == 1) {
            $status = "<label class='label label-warning'> Pending </label>";
        } else if($statusValue == 2) {
            $status = "<label class='label label-success'> Published </label>";
        } else {
            $status = "<label class='label label-danger'> Cancel </label>";
        }

        // ৩. 🎯 ফ্রন্টএন্ড পাথের সাথে মিল রেখে ওল্ড প্যানেলের জন্য ফাইল ভিউ পাথ ফিক্স
        // ডাবল ব্যাকট্র্যাকিং দিয়ে সরাসরি 'notices' সাব-ফোল্ডার চ্যাপ্টার রিড করবে
        $fileView = "";
        if(!empty($fileName)) {
            $fileView = "<a href='../uploads/notices/".$fileName."' target='_blank' class='btn btn-xs btn-info'> <i class='glyphicon glyphicon-eye-open'></i> View </a>";
        } else {
            $fileView = "<span class='label label-default'> No File </span>";
        }

        // ৪. Action বাটনসমূহ (আপনার অরিジナル এজাক্স মোডাল হুক অক্ষত রাখা হলো)
        $button = '
        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Action <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a type="button" data-toggle="modal" data-target="#publishNoticeModal" onclick="publishNotice('.$noticeId.')"> <i class="glyphicon glyphicon-ok"></i> Publish </a></li>
            <li><a type="button" data-toggle="modal" data-target="#removeNoticeModal" onclick="removeNotice('.$noticeId.')"> <i class="glyphicon glyphicon-trash"></i> Cancel</a></li>       
          </ul>
        </div>';

        // ৫. আউটপুট অ্যারে (আপনার ওল্ড DataTable-এর কলাম ইনডেক্স অনুযায়ী ম্যাপিং)
        $output['data'][] = array( 	
            $count,                // Index 0: SL
            $row['noticeno'],      // Index 1: Notice No
            $row['notice_date'],   // Index 2: Date
            $row['title'],         // Index 3: Title
            $row['content'],       // Index 4: Content
            $fileView,             // Index 5: File View Button
            $status,               // Index 6: Status		
            $button                // Index 7: Action Button
        ); 	
        $count++;
    } 
}

// ডাটাবেজ কানেকশন বন্ধ করা
$connect->close();

// জেসন আউটপুট পাঠানো
echo json_encode($output);
?>
