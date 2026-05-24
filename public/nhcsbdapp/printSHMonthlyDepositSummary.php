<?php require_once 'php_action/core.php'; ?>
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
$tmpaya=0;
$tmpaida=0;
$tmduea=0;

$orderItemSql ="SELECT mid,name_english,userpic,mobileno,tmpaya,tmpaida,tmduea
FROM vw_memberdepositsummary WHERE mid>1000 ORDER BY mid ASC";
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
  <h2> Share Holder Monthly Deposit Summary </h2>
 </div>

 <table border=1 width="800px" align="center">
			<tr style="text-align:center;">
        <td><b class="deposit">Sl No</b></td>
        <td><b class="deposit">Member Photo</b></td>
				<td><b class="deposit">Member Name</b></td>
				<td><b class="deposit">Mobile No</b></td>
				<td><b class="deposit">Monthly Payable Amount</b></td>
				<td><b class="deposit">Monthly Paid Amount</b></td>
        <td><b class="deposit">Monthly Due Amount</b></td>
			</tr>
         <?php
			   $x = 1;
				 while($row = $orderItemResult->fetch_array()) {
         $imageUrl = substr($row[2], 3);
         $userpic = "<img src='".$imageUrl."' style='height:80px; width:90px;'  />"; 
			?>
			<tr style="text-align:left;">
				<td class="deposit"><?php echo $x; ?></b></td>
        <td class="deposit"><?php echo $userpic ?></td>
        <td class="deposit"><?php echo $row['name_english']; ?></td>
				<td class="deposit"><?php echo $row['mobileno']; ?></td>
				<td class="deposit"><?php echo $row['tmpaya']; ?></td>
				<td class="deposit"><?php echo $row['tmpaida']; ?></td>		
        <td class="deposit"><?php echo $row['tmduea']; ?></td>
			</tr>
			<?php
			 $x++;
			 $tmpaya+=$row["tmpaya"];
       $tmpaida+=$row["tmpaida"];
       $tmduea+=$row["tmduea"];
				}
			?>

        <tr style="border-bottom: 1px solid black;">
         <td  colspan="3" style=";height: 27px;"></td>
         <td style="border-bottom: 1px solid black;;padding-center: 5px;border-center: 1px solid black"><b>Total Amount </b></td>
         <td style="border-bottom: 1px solid black;;padding-center: 5px;border-center: 1px solid black"><b><?php echo $tmpaya;?> </b></td>
         <td style="border-bottom: 1px solid black;;padding-center: 5px;border-center: 1px solid black"><b><?php echo $tmpaida;?> </b></td>
         <td style="border-bottom: 1px solid black;;padding-center: 5px;border-center: 1px solid black"><b><?php echo $tmduea;?> </b></td>
        </tr>
            
		</table>
</body>
</html>