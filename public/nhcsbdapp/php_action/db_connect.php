<?php 	
$localhost = "localhost";
//$username = "nhcs_nhcsbdor";
$username = "root";
//$password = "J!tdhMC6%lzHau+u";
$password = "";
$dbname = "nhcs_nhcsbddb";
// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  	mysqli_query($connect,'SET CHARACTER SET utf8');
}
?>