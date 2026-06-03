<?php 	
// ==========================================================================
// ১. ক্যারেক্টার সেট এবং হেডার সিকিউরিটি লক করা (জেসন রেসপন্স ফরমেট এলাইনমেন্ট)
// ==========================================================================
header('Content-Type: application/json; charset=utf-8');
require_once 'core.php'; 

// ডাটাবেজ টেবিল 'notices' থেকে আইডি অনুযায়ী লেটেস্ট ডাটা তুলে আনার কুয়েরি
$sql = "SELECT id, noticeno, DATE_FORMAT(notice_date, '%d/%m/%Y') as notice_date, title, content, file_name, status FROM notices ORDER BY id DESC";

$result = $connect->query($sql);
$output = array('data' => array());
$count = 1;

if($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) {
        $noticeId = $row['id'];
        $fileName = $row['file_name'];
        $statusValue = $row['status'];

        // ২. ডাটাবেজ কমেন্ট (2 = Published, 1 = Pending) অনুযায়ী বুটস্ট্র্যাপ লেবেল সেট করা
        if($statusValue == 1) {
            $status = "<span class='label label-warning'> Pending </span>";
        } else if($statusValue == 2) {
            $status = "<span class='label label-success'> Published </span>";
        } else {
            $status = "<span class='label label-danger'> Cancel </span>";
        }

        // ৩. 🎯 ফাইল ভিউ পাথ টিউনিং ফিক্স
        // যেহেতু এই ফাইলটি php_action ফোল্ডারের ভেতর আছে এবং আপলোড করা ফাইলগুলি public/uploads/notices/ পাথে জমা হচ্ছে, 
        // তাই র-পিএইচপি প্যানেল থেকে সরাসরি দেখতে এখানে পাথ হবে 'uploads/notices/'
        $fileView = "";
        if(!empty($fileName)) {
            $fileView = "<a href='uploads/notices/".$fileName."' target='_blank' class='btn btn-xs btn-info'> <i class='glyphicon glyphicon-eye-open'></i> View </a>";
        } else {
            $fileView = "<span class='label label-default'> No File </span>";
        }

        // ৪. অ্যাকশন বাটনসমূহ (আপনার অরিジナル মোডাল পপ-আপ হুক অক্ষত রাখা হলো)
        $button = '
        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Action <span class="caret"></span>
          </button>
          <ul class="dropdown-menu pull-right">
            <li><a type="button" data-toggle="modal" data-target="#publishNoticeModal" onclick="publishNotice('.$noticeId.')"> <i class="glyphicon glyphicon-ok"></i> Publish </a></li>
            <li><a type="button" data-toggle="modal" data-target="#removeNoticeModal" onclick="removeNotice('.$noticeId.')"> <i class="glyphicon glyphicon-trash"></i> Cancel</a></li>       
          </ul>
        </div>';

        // ৫. আউটপুট অ্যারে (আপনার ওল্ড HTML টেবিলেরthead কলাম ইণ্ডেক্স অনুযায়ী নিখুঁত ম্যাপিং)
        $output['data'][] = array( 	
            $count,                // Index 0: ক্রমিক নং
            $row['noticeno'],      // Index 1: স্মারক নং
            $row['notice_date'],   // Index 2: তারিখ
            $row['title'],         // Index 3: বিষয়
            $row['content'],       // Index 4: বিস্তারিত
            $fileView,             // Index 5: Attachment (View Button)
            $status,               // Index 6: Status		
            $button                // Index 7: Option (Action Button)
        ); 	
        $count++;
    } 
}

// ডাটাবেজ কানেকশন বন্ধ করা
$connect->close();

// ওল্ড ডাটা টেবিল ইঞ্জিনের কাছে ১০০% পিওর জেসন অবজেক্ট রিটার্ন করা
echo json_encode($output);
?>
