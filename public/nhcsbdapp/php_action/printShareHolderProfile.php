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

  .deposit {
	font-family: "Times New Roman", Times, serif;
	font-size: 16px;
}
}
.deposit {
	font-family: "Times New Roman", Times, serif;
	font-size: 16px;
}
</style>

<?php
$userid = $_POST['userid']; 
$sql = "SELECT tai.mid,tai.name_bangla,tai.userpic,tai.name_english,tai.fathers_name,tai.mothers_name,tai.gender,tai.maritalstatus,
DATE_FORMAT(tai.dateofbirth, '%d/%m/%Y') as dateofbirth,tai.age,tai.presentaddress,tai.permanentaddress,thn.hospitalname,
tai.mobileno,tai.nid,tai.email,tai.bloodgroup,tai.nomineename,tai.nomineerelation,tai.nomineemobile,tai.nomineeaddress,tai.emergencycontact,
tai.bankmname,tai.branchname,tai.acc_no,tai.acc_name,tai.mobilebanktype,tai.mobilebankno
FROM tblapplicantinfosh tai, tblhospitalname thn WHERE tai.hospitalname=thn.hid AND mid = {$userid}";

$result = $connect->query($sql);
while($row = $result->fetch_array()) {
$imageUrl = substr($row[2], 3);
$userpic = "<img src='".$imageUrl."' style='height:80px; width:90px;'  />"; 
	 
$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_array();
$mid = $orderData['mid'];
$name_bangla  = $orderData['name_bangla'];
$name_english = $orderData['name_english'];
$fathers_name = $orderData['fathers_name'];
$mothers_name = $orderData['mothers_name'];
$gender       = $orderData['gender'];
$maritalstatus = $orderData['maritalstatus'];
$dateofbirth  = $orderData['dateofbirth'];
$age          = $orderData['age'];
$presentaddress = $orderData['presentaddress'];
$permanentaddress = $orderData['permanentaddress'];
$hospitalname = $orderData['hospitalname'];
$mobileno = $orderData['mobileno'];
$nid = $orderData['nid'];
$email = $orderData['email'];
$bloodgroup = $orderData['bloodgroup'];
$nomineename  = $orderData['nomineename'];
$nomineerelation = $orderData['nomineerelation'];
$nomineemobile = $orderData['nomineemobile'];
$nomineeaddress = $orderData['nomineeaddress'];
$emergencycontact = $orderData['emergencycontact'];
$bankmname = $orderData['bankmname'];
$branchname = $orderData['branchname'];
$acc_no = $orderData['acc_no'];
$acc_name = $orderData['acc_name'];
$mobilebanktype = $orderData['mobilebanktype'];
$mobilebankno = $orderData['mobilebankno'];
?>

<!--<body onLoad="window.print()" onclick="window.close()">-->
<body>
 <div class="invoiceheadertext">
 <table width="800">
  <tr>
    <td width="270">
      <img src="logo.jpg" alt="nhcsbd"  class="img-responsive" width=90px> </br></br>  
    </td>

    <td width="900">
     <div style="width:100%" align="center"> <b> Nurses Health Care Society </b> </br>
      Dhaka-1206.<br>
      Phone: 01717288965, 01689597474<br>
      Email: nhcs.org.bd@gmail.com</br>
     </div>
    </td>

    <td width="300">
       <div style="width:100%"> </br>
       <td width="00" align="center" >
       <?php echo $userpic ?>
    </td>
  </div>
  </td>
  <tr>
  </table>
 
  <table width="800">
  <tr>
  <td width="270">
  <div style="width:100%"> <b>
  Member Name (Bangla) </br></br>
  Member Name (English) </br></br>
  Father's Name </br></br>
  Mother's Name </br></br>
  Gender </br></br>
  Marital Status </br></br>
  Date of Birth </br></br>
  Age </br></br>
  Present Address </br></br>
  Permanents Address </br></br>
  Hospital Name </br></br>
  Mobile No </br></br>
  National Id </br></br>
  Email </br></br>
  Blood Group </br></br>
  Nominee Name </br></br>
  Nominee Relation </br></br>
  Nominee Mobile </br></br>
  Nominee Address </br></br>
  Emergency Contact No </br></br>
  Bank Name </br></br>
  Branch Name </br></br>
  Account Name </br></br>
  Account No </br></br>
  Mobile Banking </br></br>
  Mobile Banking No </br></br>
  </b>
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
  <b> : </b></br></br>
  <b> : </b></br></br>
  <b> : </b></br></br>
  <b> : </b></br></br>
  <b> : </b></br></br>
  <b> : </b></br></br>
  <b> : </b></br></br>
  <b> : </b></br></br>
  <b> : </b></br></br>
  <b> : </b></br></br>
  <b> : </b></br></br>
  <b> : </b></br></br>
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
   <?php echo $name_english;?> </br></br>
   <?php echo $fathers_name;?> </br></br>
   <?php echo $mothers_name;?> </br></br>
   <?php echo $gender;?> </br></br>
   <?php echo $maritalstatus;?> </br></br>
   <?php echo $dateofbirth;?> </br></br>
   <?php echo $age;?> </br></br>
   <?php echo $presentaddress;?> </br></br>
   <?php echo $permanentaddress;?> </br></br>
   <?php echo $hospitalname;?> </br></br>
   <?php echo $mobileno;?> </br></br>
   <?php echo $nid;?> </br></br>
   <?php echo $email;?> </br></br>
   <?php echo $bloodgroup;?> </br></br>
   <?php echo $nomineename;?> </br></br>
   <?php echo $nomineerelation;?> </br></br>
   <?php echo $nomineemobile;?> </br></br>
   <?php echo $nomineeaddress;?> </br></br>
   <?php echo $emergencycontact;?> </br></br>
   <?php echo $bankmname;?> </br></br>
   <?php echo $branchname;?> </br></br>
   <?php echo $acc_name;?> </br></br>
   <?php echo $acc_no;?> </br></br>
   <?php echo $mobilebanktype;?> </br></br>
   <?php echo $mobilebankno;?> </br></br>
  </div>
  </td>
  </tr>
 </table>  
 </div>

	<?php
		}      
	?>
</body>
</html>