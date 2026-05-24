<?php 
session_start(); 
require_once 'db_connect.php';

// userId নেই অথবা খালি থাকলে লগইন পেজে পাঠাবে
if(!isset($_SESSION['userId']) || empty($_SESSION['userId'])) {
	header('location: index.php');	
	exit(); // exit দেওয়া জরুরি যাতে নিচের কোড আর কাজ না করে
} 
?>
