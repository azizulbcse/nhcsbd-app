<?php
require_once 'core.php';

$MonthId = $_POST['MonthId'];

$sql = "SELECT mid,mname,year,creator_id,modifier_id FROM tblmonthname WHERE mid = $MonthId AND status=2"; 
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);