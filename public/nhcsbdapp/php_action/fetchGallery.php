<?php 	
require_once 'core.php';

// ১. tblgallery থেকে ডাটা সিলেক্ট
$sql = "SELECT id, title, media_type, file_name, upload_date, status FROM tblgallery ORDER BY id DESC";
$query = $connect->query($sql);

$output = array('data' => array());

if($query->num_rows > 0) { 
    $count = 1;
    while($row = $query->fetch_assoc()) {
        $id = $row['id'];
        $statusValue = $row['status'];
        $fileName = $row['file_name'];
        $mediaType = $row['media_type'];
        
        // ২. আপনার লজিক অনুযায়ী স্ট্যাটাস সেট করা
        if($statusValue == 1) {
            $status = "<label class='label label-warning'> Pending </label>";
        } else if($statusValue == 2) {
            $status = "<label class='label label-success'> Published </label>";
        } else {
            $status = "<label class='label label-danger'> Cancel </label>";
        }

        // ৩. ফাইল প্রিভিউ এবং ভিউ লিঙ্ক
        $filePath = "assets/img/gallery/" . $fileName; 
        
        if($mediaType == 'image') {
            $preview = "<img src='".$filePath."' class='img-thumbnail' style='width:40px; height:40px;' /> ";
            $viewBtn = "<a href='".$filePath."' target='_blank' class='btn btn-xs btn-info'><i class='fa fa-eye'></i> View</a>";
        } else {
            $preview = "<i class='fa fa-video-camera text-primary'></i> ";
            $viewBtn = "<a href='".$filePath."' target='_blank' class='btn btn-xs btn-primary'><i class='fa fa-play'></i> Play</a>";
        }

        // ৪. অ্যাকশন বাটনসমূহ (Publish এবং Cancel লজিকসহ)
        // Action Button Logic
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

        // ৫. DataTable এর কলাম অনুযায়ী আউটপুট (আপনার HTML টেবিলের সাথে মিলিয়ে নিন)
        $output['data'][] = array( 	
            $count,                     // index 0: SL
            $preview . " " . $viewBtn,  // index 1: Preview & View Button
            $row['title'],              // index 2: Title
            ucfirst($mediaType),        // index 3: Media Type (Image/Video)
            $row['upload_date'],        // index 4: Date
            $status,                    // index 5: Status		
            $button                     // index 6: Action
        ); 	
        $count++;
    } 
}

$connect->close();
echo json_encode($output);
