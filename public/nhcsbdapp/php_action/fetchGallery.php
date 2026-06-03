<?php 	
// ১. ক্যারেক্টার সেট এবং হেডার সিকিউরিটি লক করা
header('Content-Type: application/json; charset=utf-8');
require_once 'core.php'; 

// 🎯 ল্যারাভেল মাইগ্রেশন ও ডাটাবেজ অনুযায়ী আসল টেবিল 'galleries' দিয়ে কুয়েরি ফিক্স করা হলো
// আপনার ওল্ড upload_date কলামটি ল্যারাভেলের created_at কলামের সাথে ডাইনামিকালি অ্যালাইন করা হলো
$sql = "SELECT id, title, media_type, file_name, DATE_FORMAT(created_at, '%d/%m/%Y') as upload_date, status FROM galleries ORDER BY id DESC";
$query = $connect->query($sql);

$output = array('data' => array());

if($query->num_rows > 0) { 
    $count = 1;
    while($row = $query->fetch_assoc()) {
        $id = $row['id'];
        $statusValue = $row['status'];
        $fileName = $row['file_name'];
        $mediaType = $row['media_type'];
        
        // ২. আপনার কাস্টম লজিক অনুযায়ী (২ = Published) স্ট্যাটাস লেবেল সেট করা
        if($statusValue == 1) {
            $status = "<label class='label label-warning'> Pending </label>";
        } else if($statusValue == 2) {
            $status = "<label class='label label-success'> Published </label>";
        } else {
            $status = "<label class='label label-danger'> Cancel </label>";
        }

        // 🎯 ৩. ফ্রন্টএন্ড পাথের (public/uploads/gallery/) সাথে মিল রেখে র-পিএইচপি পাথ ফিক্স
        // ডাবল ব্যাক ট্র্যাকিং দিয়ে ওল্ড প্যানেলের জন্য নিখুঁত ডিরেক্টরি গেটওয়ে
        $filePath = "../uploads/gallery/" . $fileName; 
        
        if($mediaType == 'image' || $mediaType == 'Photo' || $mediaType == 'photo') {
            $preview = "<img src='".$filePath."' class='img-thumbnail' style='width:40px; height:40px; object-fit: cover;' /> ";
            $viewBtn = "<a href='".$filePath."' target='_blank' class='btn btn-xs btn-info'><i class='fa fa-eye'></i> View</a>";
        } else {
            // ভিডিও টাইপের জন্য ওল্ড আইকন ও প্লে বাটন গেটওয়ে
            $preview = "<i class='fa fa-video-camera text-primary' style='font-size:20px; padding:10px;'></i> ";
            $viewBtn = "<a href='".$filePath."' target='_blank' class='btn btn-xs btn-primary'><i class='fa fa-play'></i> Play</a>";
        }

        // ৪. অ্যাকশন বাটনসমূহ (আপনার অরিジナル ওল্ড মোডাল হুক অক্ষত রাখা হলো)
        $button = '
        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Action <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a type="button" data-toggle="modal" data-target="#publishGalleryModal" onclick="publishMedia('.$id.')"> <i class="glyphicon glyphicon-ok"></i> Publish </a></li>
            <li><a type="button" data-toggle="modal" data-target="#removeGalleryModal" onclick="removeGallery('.$id.')"> <i class="glyphicon glyphicon-trash"></i> Delete </a></li>       
          </ul>
        </div>';

        // ৫. আউটপুট অ্যারে (আপনার ওল্ড DataTable এর কলাম অনুযায়ী ডাটা পুশ)
        $output['data'][] = array( 	
            $count,                                     // index 0: SL
            "<div style='display:flex; align-items:center; gap:5px;'>" . $preview . " " . $viewBtn . "</div>",  // index 1: Preview & View Button
            $row['title'],                              // index 2: Title
            ucfirst($mediaType),                        // index 3: Media Type (Image/Video)
            $row['upload_date'],                        // index 4: Date
            $status,                                    // index 5: Status		
            $button                                     // index 6: Action
        ); 	
        $count++;
    } 
}

// ডাটাবেজ কানেকশন বন্ধ করা
$connect->close();

// জেসন আউটপুট রেন্ডার
echo json_encode($output);
?>
