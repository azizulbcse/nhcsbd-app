<?php 	
require_once 'core.php';

$sql = "SELECT id, title, media_type, file_name, upload_date, status FROM tblgallery ORDER BY id DESC";

$result = $connect->query($sql);
$output = array('data' => array());
$count = 1;

if($result->num_rows > 0) { 
    // fetch_assoc() ব্যবহার করা হয়েছে কোড পরিষ্কার রাখার জন্য
    while($row = $result->fetch_assoc()) {
        $noticeId = $row['id'];
        $fileName = $row['file_name'];
        $statusValue = $row['status'];

        // ২. স্ট্যাটাস লেবেল সেট করা
        if($statusValue == 1) {
            $status = "<label class='label label-warning'> Pending </label>";
        } else if($statusValue == 2) {
            $status = "<label class='label label-success'> Published </label>";
        } else {
            $status = "<label class='label label-danger'> Cancel </label>";
        }

        // ৩. ফাইল ভিউ করার লিঙ্ক
        $fileView = "";
        if(!empty($fileName)) {
            // ফাইলের পাথ সঠিক আছে কি না নিশ্চিত করুন (e.g., uploads ফোল্ডার)
            $fileView = "<a href='uploads/".$fileName."' target='_blank' class='btn btn-xs btn-info'> <i class='glyphicon glyphicon-eye-open'></i> View </a>";
        } else {
            $fileView = "<span class='label label-default'> No File </span>";
        }

        // ৪. অ্যাকশন বাটনসমূহ
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

        // ৫. আউটপুট অ্যারে (DataTable এর কলাম অনুযায়ী সাজানো)
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

// JSON আউটপুট পাঠানো
header('Content-Type: application/json');
echo json_encode($output);
