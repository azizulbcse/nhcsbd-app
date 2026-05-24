<?php 	
require_once 'core.php'; 
$sql = "SELECT tdi.trxdid,tai.name_english,tai.userpic,DATE_FORMAT(tdi.depositdate, '%d/%m/%Y') as depositdate,tdi.payment_type,tdi.deposit_amount,tdi.remarks
FROM tbltrxdepositinfo tdi, tblapplicantinfo tai WHERE tdi.memberid=tai.mid AND tdi.status=2
UNION ALL
SELECT tdi.trxdid,tai.name_english,tai.userpic,DATE_FORMAT(tdi.depositdate, '%d/%m/%Y') as depositdate,tdi.payment_type,tdi.deposit_amount,tdi.remarks
FROM tbltrxdepositinfo tdi, tblapplicantinfosh tai WHERE tdi.memberid=tai.mid AND tdi.status=2
order by trxdid desc";
$result = $connect->query($sql);
$output = array('data' => array());
$count=1;
if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
	$trxdid=$row[0];

	$imageUrl = substr($row[2], 3);
	$UserPhoto = "<img class='img-round' src='".$imageUrl."' style='height:60px; width:80px;' />";
	//$MemberImagelink = '<a href="member-deposit-details.php?mid='.$mid.'" target="_blank">'.$UserPhoto. '</a>';

 	$output['data'][] = array( 		
		$count,
		//$MemberImagelink,	
		$UserPhoto,				  
 		$row[1], 
		$row[3],
		$row[4],
		$row[5], 
		$row[6] 		
 		); 	
	   $count++;
 } // /while 
} // if num_rows
$connect->close();
echo json_encode($output);