<?php 	

require_once 'core.php';

$accHeadId = $_POST['accHeadId'];

$sql = "SELECT accHeadId,accGroupId,accHeadName FROM tblacchead WHERE accHeadId = $accHeadId"; 
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);