<?php require_once 'php_action/db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>.:: Nurses Health Care Society ::.</title>
  <link rel="icon" type="image/x-icon" href="assets/img/logo.jpg" />
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
$totaldonateamount=0;

$orderItemSql ="SELECT tdi.trxdid,DATE_FORMAT(tdi.donatedate, '%d/%m/%Y') as donatedate,tdi.depositername,tdi.mobileno,tdi.payment_type,
tdl.name,tdi.donate_amount,tdi.trxno,tdi.remarks,tdi.status FROM tbltrxdonationinfo tdi, tbldonatelist tdl 
WHERE tdi.donate_to=tdl.sysid AND tdi.status=2 ORDER BY tdi.trxdid ASC";
$orderItemResult = $connect->query($orderItemSql);
?>

<body onLoad="window.print()" onclick="window.close()">
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

  </td>
  <tr>
  </table>
  <h2> Donation List </h2>
 </div>

 <table border=1 width="800px" align="center">
			<tr style="text-align:center;">
        <td><b class="deposit">Sl No</b></td>
        <td><b class="deposit">Donate Date</b></td>
				<td><b class="deposit">Name</b></td>
				<td><b class="deposit">Mobile No</b></td>
				<td><b class="deposit">Payment Type</b></td>
				<td><b class="deposit">Donate To</b></td>
        <td><b class="deposit">Donate Amount</b></td>
        <td><b class="deposit">Trx No</b></td>
        <td><b class="deposit">Remarks</b></td>
			</tr>
         <?php
			   $x = 1;
				 while($row = $orderItemResult->fetch_array()) {
			?>
			<tr style="text-align:left;">
				<td class="deposit"><?php echo $x; ?></b></td>
        <td class="deposit"><?php echo $row['donatedate']; ?></td>
        <td class="deposit"><?php echo $row['depositername']; ?></td>
				<td class="deposit"><?php echo $row['mobileno']; ?></td>
				<td class="deposit"><?php echo $row['payment_type']; ?></td>
				<td class="deposit"><?php echo $row['name']; ?></td>		
        <td class="deposit"><?php echo $row['donate_amount']; ?></td>
        <td class="deposit"><?php echo $row['trxno']; ?></td>
        <td class="deposit"><?php echo $row['remarks']; ?></td>
			</tr>
			<?php
			 $x++;
			 $totaldonateamount+=$row["donate_amount"];
				}
			?>

        <tr style="border-bottom: 1px solid black;">
         <td  colspan="5" style=";height: 27px;"></td>
         <td style="border-bottom: 1px solid black;;padding-center: 5px;border-center: 1px solid black"><b>Total Amount </b></td>
         <td style="border-bottom: 1px solid black;;padding-center: 5px;border-center: 1px solid black"><b><?php echo $totaldonateamount;?> </b></td>
        </tr>
            
		</table>
</body>
</html>