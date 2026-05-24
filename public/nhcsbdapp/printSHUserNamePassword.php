<?php require_once 'php_action/core.php'; ?>
<!DOCTYPE html>
<html>
<head>

<style type="text/css">
<!--
table tr td div .brc {
	font-size: 18px;
}
-->
</style>
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
  <!-- border-bottom-style: dotted;-->
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
  font-size:2px;
  line-height: 1px;
}
.invoiceheadertext table tr td div .brc {
	font-family: Tahoma, Geneva, sans-serif;
}
.invoiceheadertext table tr td div .brc {
	font-family: "Times New Roman", Times, serif;
}
.invoiceheadertext table tr td div .brc {
	font-size: 24px;
}
.invoiceheadertext table tr td div {
	font-family: Tahoma, Geneva, sans-serif;
}
.invoiceheadertext table tr td div {
	font-size: 14px;
}
</style>

<?php
$orderItemSql ="SELECT mid,email,userpic,name_english,mobileno,pcode,status FROM tblapplicantinfosh 
WHERE status=2 order by mid asc";
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
  <h2> Share Holder Username & Password List </h2>
 </div>

 <table border=1 width="800px" align="center">
			<tr style="text-align:center;">
        <td><b class="deposit">Sl No</b></td>
        <td><b class="deposit">Share Holder Photo</b></td>
				<td><b class="deposit">Share Holder Name</b></td>
				<td><b class="deposit">Mobile No</b></td>
				<td><b class="deposit">Email</b></td>
        <td><b class="deposit">Password</b></td>
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
				<td class="deposit"><?php echo $row['email']; ?></td>						
        <td class="deposit"><?php echo $row['pcode']; ?></td>
			</tr>
			<?php
			 $x++;
				}
			?>            
		</table>
</body>
</html>