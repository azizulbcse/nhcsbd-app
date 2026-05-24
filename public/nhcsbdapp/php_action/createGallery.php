<?php 	
require_once 'core.php'; 

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

    $title      = $_POST['title'];
    $media_type = $_POST['media_type'];
    $status     = 1; // স্ট্যাটাস অটোমেটিক 1 যাবে

    // ফাইল এক্সটেনশন চেক
    $type = explode('.', $_FILES['mediaFile']['name']);
    $type = strtolower(end($type)); // এক্সটেনশনটি ছোট হাতের অক্ষরে কনভার্ট করা হলো	
    
    // ফাইল সেভ হওয়ার লোকেশন (আপনার ফোল্ডার স্ট্রাকচার অনুযায়ী check করুন)
    $file_name = uniqid(rand()).'.'.$type;
    $url = '../assets/img/gallery/'.$file_name; 

    // অনুমোদিত ফাইল ফরম্যাট
    $allowed_extensions = array('gif', 'jpg', 'jpeg', 'png', 'mp4');

    if(in_array($type, $allowed_extensions)) {
        if(is_uploaded_file($_FILES['mediaFile']['tmp_name'])) {			
            if(move_uploaded_file($_FILES['mediaFile']['tmp_name'], $url)) {
                
                // ডাটাবেজে ইনসার্ট কুয়েরি (টেবিল নাম tblgallery নিশ্চিত করা হয়েছে)
                $sql = "INSERT INTO tblgallery (title, media_type, file_name, status) 
                        VALUES ('$title', '$media_type', '$file_name', '$status')";

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
    echo json_encode($valid);
} 
