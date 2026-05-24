<?php 	

require_once 'core.php';

$hid = $_POST['hid'];

$sql = "SELECT AccGroupId, AccGroupName FROM tblaccgroup WHERE AccGroupId = $hid"; 
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);