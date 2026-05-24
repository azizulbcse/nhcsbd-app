<?php 	

require_once 'core.php';

$userid = $_GET['i'];

$sql = "SELECT userpic FROM tblapplicantinfo WHERE mid = {$userid}";
$data = $connect->query($sql);
$result = $data->fetch_row();

$connect->close();

echo "stock/" . $result[0];
