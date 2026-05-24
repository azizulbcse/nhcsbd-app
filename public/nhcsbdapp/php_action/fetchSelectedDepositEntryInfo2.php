<?php 	

require_once 'core.php';

$trxdid = $_POST['trxdid'];

$sql = "SELECT * FROM tbltrxdepositinfo WHERE trxdid = $trxdid AND status=1"; 
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);