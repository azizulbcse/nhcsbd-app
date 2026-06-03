<?php 	
// ১. ক্যারেক্টার সেট এবং হেডার সিকিউরিটি লক করা (বাংলা ডাটা সাপোর্ট করার জন্য)
header('Content-Type: application/json; charset=utf-8');
require_once 'core.php'; 

// ওল্ড রেসপন্স অ্যারে ভেরিয়েবল
$valid = array('success' => false, 'messages' => array());

if($_POST) {	

    // ডাটাবেজ প্রটেকশন সহ ইনপুট ফিল্টারিং
    $title      = mysqli_real_escape_string($connect, $_POST['title']);
    $media_type = mysqli_real_escape_string($connect, $_POST['media_type']);
    
    // 🎯 ল্যারাভেল ফ্রন্টএন্ড কন্ডিশন অনুযায়ী সরাসরি লাইভ করার জন্য status = 2 সেট করা হলো
    $status     = 2; 

    // ফাইল এক্সটেনশন চেক
    $type = explode('.', $_FILES['mediaFile']['name']);
    $type = strtolower(end($type)); // এক্সটেনশনটি ছোট হাতের অক্ষরে কনভার্ট করা হলো	
    
    // ইউনিক ফাইলনেম জেনারেশন (ফাইল ওভাররাইট প্রোটেকশন)
    $file_name = uniqid(rand()).'.'.$type;
    
    // 🎯 ফ্রন্টএন্ড পাথের (public/uploads/gallery/) সাথে মিল রেখে র-পিএইচপি আপলোড পাথ সাব-ডিরেক্টরি ফিক্স
    // ডাবল ব্যাক ট্র্যাকিং দিয়ে সরাসরি 'gallery' সাব-ফোল্ডারে ফাইল পাঠানো হলো
    $upload_dir = '../uploads/gallery/';
    
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $url = $upload_dir . $file_name; 

    // অনুমোদিত ফাইল ফরম্যাট
    $allowed_extensions = array('gif', 'jpg', 'jpeg', 'png', 'mp4');

    if(in_array($type, $allowed_extensions)) {
        if(is_uploaded_file($_FILES['mediaFile']['tmp_name'])) {			
            if(move_uploaded_file($_FILES['mediaFile']['tmp_name'], $url)) {
                
                // 🎯 ল্যারাভেল মাইগ্রেশন ও ডাটাবেজ অনুযায়ী আসল টেবিল 'galleries' এবং টাইমস্ট্যাম্প দিয়ে কুয়েরি ফিক্স করা হলো
                $sql = "INSERT INTO galleries (title, media_type, file_name, status, created_at, updated_at) 
                        VALUES ('$title', '$media_type', '$file_name', '$status', NOW(), NOW())";

                if($connect->query($sql) === TRUE) {
                    $valid['success'] = true;
                    $valid['messages'] = "সফলভাবে গ্যালারিতে যুক্ত করা হয়েছে।";	
                } else {
                    $valid['success'] = false;
                    $valid['messages'] = "ডাটাবেজে সেভ করতে সমস্যা হচ্ছে: " . $connect->error;
                }				
            } else {
                $valid['success'] = false;
                $valid['messages'] = "ফাইলটি সার্ভারে আপলোড করা সম্ভব হয়নি।";
            }	
        } 
    } else {
        $valid['success'] = false;
        $valid['messages'] = "ভুল ফাইল ফরম্যাট! শুধু JPG, PNG বা MP4 আপলোড করুন।";
    }		

    $connect->close();
    // ওল্ড এজাক্স হ্যান্ডেলারকে রেসপন্স পাঠানো
    echo json_encode($valid);
}
?>
