<?php
require_once 'core.php';

$ResignAppId = $_POST['ResignAppId'];

$sql = "SELECT * FROM tblapplication4resign WHERE rid = $ResignAppId AND status!=0";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);