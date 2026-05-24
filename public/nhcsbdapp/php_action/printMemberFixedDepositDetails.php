<?php require_once 'core.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>.:: Nurses Health Care Society ::.</title>
</head>

<style type="text/css">
<!--
body table tr td {
	font-family: Verdana, Geneva, sans-serif;
	font-size:12px;
}
header
{
	font-family: Verdana, Geneva, sans-serif;
}
.invoiceheadertext {
  margin: auto;
  width: 800px;
  padding: 2px;
  text-align:center;
  border-bottom-style: dotted;
}
.dotted{
  margin: auto;
  width: 800px;
  padding: 2px;
  text-align:center;
  border-bottom-style: dotted;
}
.invoiceheader {
  margin: auto;
  width: 800px;
  padding: 10px;
  text-align:center;
}
brc {
  display: block;
  margin-bottom: 2px; 
  font-size:12px;
  line-height: 1px;
}
.deposit {
	font-family: "Times New Roman", Times, serif;
	font-size: 16px;
}
</style>

<?php
$mid = $_POST['mid']; 
$sql = "SELECT mid,name_bangla,userpic,name_english,fathers_name,mothers_name,gender,maritalstatus,DATE_FORMAT(dateofbirth, '%d/%m/%Y') as dateofbirth,
mobileno,nid,email,bloodgroup,presentaddress,age,permanentaddress FROM tblapplicantinfo WHERE mid = {$mid} AND status=2";

$result = $connect->query($sql);
while($row = $result->fetch_array()) {
$imageUrl = substr($row[2], 3);
$userpic = "<img src='".$imageUrl."' style='height:80px; width:90px;'  />"; 
	 
$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_array();
$mid           = $orderData['mid'];
$name_bangla   = $orderData['name_bangla'];
$name_english  = $orderData['name_english'];
$fathers_name  = $orderData['fathers_name'];
$mothers_name  = $orderData['mothers_name'];
$gender        = $orderData['gender'];
$maritalstatus = $orderData['maritalstatus'];
$dateofbirth   = $orderData['dateofbirth'];
$mobileno      = $orderData['mobileno'];
$nid           = $orderData['nid'];
$email         = $orderData['email'];
$bloodgroup    = $orderData['bloodgroup'];
$presentaddress = $orderData['presentaddress'];
$age            = $orderData['age'];
$permanentaddress = $orderData['permanentaddress'];
$totalamount=0;
$totalfixamount=0;

$orderItemSql ="SELECT trxdid,DATE_FORMAT(depositdate, '%d/%m/%Y') as depositdate,payment_type,fixed_amount,remarks 
FROM tbltrxdepositinfo WHERE memberid = {$mid} AND status=2 and fixed_amount>0";
$orderItemResult = $connect->query($orderItemSql);
?>

<!--<body onLoad="window.print()" onclick="window.close()">-->
<body>
 <div class="invoiceheadertext">
 <table width="800">
  <tr>
  <td width="270">
   <img src="logo.jpg" alt="iamgurdeeposahan"  class="img-responsive" width=90px> </br></br>  
  </td>

  <td width="900">
     <div class="dotted" style="width:100%" align="center"> <b> Nurses Health Care Society </b> </br>
      Dhaka-1206.<br>
      Phone: 01717288965, 01689597474<br>
      Email: nhcs.org.bd@gmail.com</br>
     </div>
  </td>
  <td width="300">
  <div style="width:100%"> </br></br>
   <td width="00" align="center">
    <?php echo $userpic ?>
   </td>
  </div>
  </td>
  <tr>
  </table>
  <h2>Monthly Deposit Statement</h2>
  <table width="800">
  <tr>
  <td width="270">
  <div style="width:100%"> <b>
   Member Name (Bangla) </br></br>
   Father's/Husband Name </br></br>
   Gender  </br></br>
   Date of Birth </br></br>
   National Id No </br></br>
   Present Address </br></br>
   Permanent Address </br></br>
  </div>
  </td>

  <td width="50">
  <div style="width:100%">
  <b> : </b></br></br>
  <b> : </b></br></br>
  <b> : </b></br></br>
  <b> : </b></br></br>
  <b> : </b></br></br>
  <b> : </b></br></br>
  <b> : </b></br></br>
  </div>
  </td>

  <td width="600">
  <div style="width:100%">
   <?php echo $name_bangla;?> </br></br>
   <?php echo $fathers_name;?> </br></br>
   <?php echo $gender;?> </b></br></br>
   <?php echo $dateofbirth;?> </br></br>
   <?php echo $nid;?>  </br></br>
   <?php echo $presentaddress;?>  </br></br>
   <?php echo $permanentaddress;?>  </br></br>
  </div>
  </td>

  <td width="300">
  <div style="width:100%">
   <b> Member Name  : </b> <?php echo $name_english;?></br></br>
   <b> Mother's Name : </b> <?php echo $mothers_name;?></br></br>
   <b> Marital Status : </b> <?php echo $maritalstatus;?></br></br>
   <b> Age : </b> <?php echo $age;?> </br></br>
   <b> Blood Group : </b> <?php echo $bloodgroup;?> </br></br>
   <b> Mobile No : </b> <?php echo $mobileno;?> </br></br>
   <b> Email : </b> <?php echo $email;?> </br></br>
  </div>
  </td>
  <tr>
  </table>  
 </div>

 <table border=1 width="800px" align="center">
			<tr style="text-align:center;">
        <td><b class="deposit">Sl No</b></td>
				<td><b class="deposit">Deposit Date</b></td>
				<td><b class="deposit">Payment Type</b></td>
				<td><b class="deposit">Fixed Amount</b></td>
				<td><b class="deposit">Remarks</b></td>
			</tr>
         <?php
			   $x = 1;
				 while($row = $orderItemResult->fetch_array()) {
			?>
			<tr style="text-align:left;">
				<td class="deposit"><?php echo $x; ?></b></td>
        <td class="deposit"><?php echo $row['depositdate']; ?></td>
				<td class="deposit"><?php echo $row['payment_type']; ?></td>
				<td class="deposit"><?php echo $row['fixed_amount']; ?></td>
				<td class="deposit"><?php echo $row['remarks']; ?></td>		
			</tr>
			<?php
			 $x++;
			 $totalamount+=$row["fixed_amount"];
				}}
			?>

        <tr style="border-bottom: 1px solid black;">
         <td  colspan="2" style=";height: 27px;"></td>
         <td style="border-bottom: 1px solid black;;padding-center: 5px;border-center: 1px solid black"><b>Total Fixed Amount </b></td>
         <td style="border-bottom: 1px solid black;;padding-center: 5px;border-center: 1px solid black"><b><?php echo $totalamount;?> </b></td>
        </tr>
            
		</table>
</body>
</html>