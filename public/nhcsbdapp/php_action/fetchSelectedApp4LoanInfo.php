<?php
require_once 'core.php';

$LoanAppId = $_POST['LoanAppId'];

$sql = "SELECT * FROM tblapplication4loan WHERE loanappid = $LoanAppId AND status!=0";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);