<?php 
require_once 'php_action/db_connect.php';
?>
<!DOCTYPE html>
<html>
<!-- START HEAD -->
<head>
    <!-- Start title --> 
      <title>Share Holder Application Form | Nurses Health Care Society </title>  
    <!-- End title --> 

    <!-- Start Header Base--> 
      <?php //require_once 'layouts/HeaderDTPage.php'; ?>
      <?php include ('layouts/1-base-head.php') ?>
    <!-- End Header Base --> 
  </head>
  <!-- END HEAD -->

  <!-- BEGIN BODY -->
 <body class="" style="background-color:#042DEE;">
    <div class="container" align="center">
      <div class="" align="center">
        <div class="col-md-7 col-md-offset-2 tiles white no-padding" align="center">
          <div class="p-t-30 p-l-40 p-b-20 xs-p-t-10 xs-p-l-10 xs-p-b-10" align="center">
          <a href="index.php" class="app-brand-link gap-2">
            <img src="assets/img/logo.jpg" alt="Nurses Health Care Society">
          </a>
            <h2 class="normal">
              Welcome to Nurses Health Care Society!
            </h2>

            <!--<div role="">
              <a href="index.php" class="btn btn-info btn-cons">Already Account Please Login</a>
            </div>-->

            <div role="tabpanel" class="tab-pane active" id="tab_login" align="center">
              <form action="php_action/createApplicationFormSH.php" method="post" class="form-horizontal" id="ApplicationForm">              
                <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10" align="center">

                  <div class="col-md-6 col-sm-6"">
                    <label class="form-label"> আবেদন ফি-১০০/- টাকা (01689597474)</label>
                    <input class="form-control" id="BkashNogod" name="BkashNogod" autocomplete="off" placeholder="Bkash/Nogod No"  type="number">
                  </div>

                  <div class="col-md-6 col-sm-6"">
                    <label class="form-label"> ট্রাঞ্জেকশন নং </label>
                    <input class="form-control" id="TransactionNo" name="TransactionNo" autocomplete="off" placeholder="Transaction No"  type="text">
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label class="form-label">আবেদনকারীর নাম (বাংলা)</label>
                    <input class="form-control" id="ApplicantNameBangla" name="ApplicantNameBangla" autocomplete="off" placeholder="Applicant Name (Bangla)" type="text">
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label class="form-label">আবেদনকারীর নাম (ইংরেজীতে)</label>
                    <input class="form-control" id="ApplicantNameEnglish" name="ApplicantNameEnglish" autocomplete="off" placeholder="Applicant Name (English)" type="text">
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label class="form-label">পিতার /স্বামীর নাম</label>
                    <input class="form-control" id="FathersName" name="FathersName" autocomplete="off" placeholder="Father's / Husband Name" type="text">
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label class="form-label">মাতার নাম</label>
                    <input class="form-control" id="MothersName" name="MothersName" autocomplete="off" placeholder="Mother's Name" type="text">
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label class="form-label">লিঙ্গ </label>
                    <select class="form-control selectpicker" data-live-search="true" id="Gender" name="Gender">
				      	      <option value="">~~নির্বাচন করুন~~</option>
				      	      <?php 
				      	      $sql = "SELECT * FROM tbllookup WHERE type='gender' AND status = 1 ORDER BY id ASC";
								      $result = $connect->query($sql);
								      while($row = $result->fetch_array()) {
									    echo "<option value='".$row[1]."'>".$row[1]."</option>";
								      }								
				      	      ?>
				            </select>
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label class="form-label">বৈবাহিক অবস্থা  </label>
                    <select class="form-control selectpicker" data-live-search="true" id="MaritalStatus" name="MaritalStatus">
				      	      <option value="">~~নির্বাচন করুন~~</option>
				      	      <?php 
				      	      $sql = "SELECT * FROM tbllookup WHERE type='maritalstatus' AND status = 1 ORDER BY name ASC";
								      $result = $connect->query($sql);
								      while($row = $result->fetch_array()) {
									    echo "<option value='".$row[1]."'>".$row[1]."</option>";
								      }								
				      	      ?>
				            </select>
                  </div>

                  <div class="col-md-6 col-sm-6">
										<label for="DateofBirth" class="form-label">জন্ম তারিখ</label>
										<input type="date" class="form-control" placeholder="Date of Birth" id="DateofBirth" name="DateofBirth" autocomplete="off" onkeyup="getAgeVal(0)" onblur="getAgeVal(0)"/>
									</div>

                  <div class="col-md-6 col-sm-6">
                    <label class="form-label">বয়স  </label>
                    <input class="form-control" id="Age" name="Age" type="text" readonly="false">
                  </div>

                  <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                    <label class="form-label"> বর্তমান ঠিকানা  </label>
                    <input class="form-control" id="PresentAddress" name="PresentAddress" autocomplete="off" placeholder="Present Address"  type="text">
                  </div>

                  <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                    <label class="form-label"> স্থায়ী ঠিকানা </label>
                    <input class="form-control" id="PermanentAddress" name="PermanentAddress" autocomplete="off" placeholder="Permanent Address"  type="text">
                  </div>

                  <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                    <label class="form-label"> কর্মরত হাসপাতালের নাম  </label>
                    <select class="form-control selectpicker" data-live-search="true" id="HospitalName" name="HospitalName">
				      	      <option value="">~~নির্বাচন করুন~~</option>
				      	      <?php 
				      	      $sql = "SELECT * FROM tblhospitalname WHERE status = 1 ORDER BY hospitalname ASC";
								      $result = $connect->query($sql);
								      while($row = $result->fetch_array()) {
									    echo "<option value='".$row[0]."'>".$row[1]."</option>";
								      }								
				      	      ?>
				            </select>
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label class="form-label">আবেদনকারীর নিজ ফোন নং </label>
                    <input class="form-control" id="MobileNo" name="MobileNo" autocomplete="off" type="number" placeholder="Self Mobile No">
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label class="form-label">আবেদনকারীর জাতীয় পরিচয় পত্রের নং </label>
                    <input class="form-control" id="AppNID" name="AppNID" autocomplete="off" type="number" placeholder="Self National Id No">
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label class="form-label">আবেদনকারীর ইমেইল আইডি </label>
                    <input class="form-control" id="Email" name="Email" type="email" autocomplete="off" placeholder="E.mail Address">
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label class="form-label"> রক্তের গ্রুপ </label>
                    <select class="form-control selectpicker" data-live-search="true" id="BloodGroup" name="BloodGroup">
				      	      <option value="">~~নির্বাচন করুন~~</option>
				      	      <?php 
				      	      $sql = "SELECT * FROM tbllookup WHERE type='bloodgroup' AND status = 1 ORDER BY NAME ASC";
								      $result = $connect->query($sql);
								      while($row = $result->fetch_array()) {
									    echo "<option value='".$row[1]."'>".$row[1]."</option>";
								      }								
				      	      ?>
				            </select>
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label class="form-label">নমিনির নাম </label>
                    <input class="form-control" id="NomineeName" name="NomineeName" autocomplete="off" type="text" placeholder="Nominee Name">
                  </div>
                  

                  <div class="col-md-6 col-sm-6">
                    <label class="form-label">নমিনির সম্পর্ক </label>
                    <input class="form-control" id="NomineeRelation" name="NomineeRelation" autocomplete="off" type="text" placeholder="Nominee Name">
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label class="form-label">নমিনির ফোন নং </label>
                    <input class="form-control" id="NomineeMobile" name="NomineeMobile" autocomplete="off" type="number" placeholder="Nominee Mobile No">
                  </div>

                  <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                    <label class="form-label"> নমিনির ঠিকানা </label>
                    <input class="form-control" id="NomineeAddress" name="NomineeAddress" autocomplete="off" placeholder="Nominee Address"  type="text">
                  </div>

                  <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                    <label class="form-label"> জরুরী প্রয়োজনে যোগাযোগের জন্য ফোন নং </label>
                    <input class="form-control" id="EmergencyContact" name="EmergencyContact" autocomplete="off" placeholder="Emergency Contact No"  type="number">
                  </div>                  

                  </br></br>
                  <button type="submit" class="btn btn-primary btn-cons-md" type="submit"> Submit</button>
                  <button type="reset" class="btn btn-white btn-cons-md" type="reset">Clear</button>
                </div>
                <div class="ApplicationFormMessage"></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Start JS-->
    <?php include ('layouts/5-base-js.php') ?> 
    <script src="custom/js/application-form.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>
    <script type="text/javascript">
function formatDate(date){
var d = new Date(date),
month = '' + (d.getMonth() + 1),
day = '' + d.getDate(),
year = d.getFullYear();

if (month.length < 2) month = '0' + month;
if (day.length < 2) day = '0' + day;

return [year, month, day].join('-');

}

function getAge(dateString){
var birthdate = new Date().getTime();
if (typeof dateString === 'undefined' || dateString === null || (String(dateString) === 'NaN')){
// variable is undefined or null value
birthdate = new Date().getTime();
}
birthdate = new Date(dateString).getTime();
var now = new Date().getTime();
// now find the difference between now and the birthdate
var n = (now - birthdate)/1000;
if (n < 604800){ // less than a week
var day_n = Math.floor(n/86400);
if (typeof day_n === 'undefined' || day_n === null || (String(day_n) === 'NaN')){
// variable is undefined or null
return '';
}else{
return day_n + ' day' + (day_n > 1 ? 's' : '') + ' old';
}
} else if (n < 2629743){ // less than a month
var week_n = Math.floor(n/604800);
if (typeof week_n === 'undefined' || week_n === null || (String(week_n) === 'NaN')){
return '';
}else{
return week_n + ' week' + (week_n > 1 ? 's' : '') + ' old';
}
} else if (n < 31562417){ // less than 24 months
var month_n = Math.floor(n/2629743);
if (typeof month_n === 'undefined' || month_n === null || (String(month_n) === 'NaN')){
return '';
}else{
return month_n + ' month' + (month_n > 1 ? 's' : '') + ' old';
}
}else{
var year_n = Math.floor(n/31556926);
if (typeof year_n === 'undefined' || year_n === null || (String(year_n) === 'NaN')){
return year_n = '';
}else{
return year_n + ' year' + (year_n > 1 ? 's' : '') + ' old';
}
}
}

function getAgeVal(pid){
var birthdate = formatDate(document.getElementById("DateofBirth").value);
var count = document.getElementById("DateofBirth").value.length;
if (count=='10'){
var age = getAge(birthdate);
var str = age;
var res = str.substring(0, 1);
if (res =='-' || res =='0'){
document.getElementById("DateofBirth").value = "";
document.getElementById("Age").value = "";
$('#DateofBirth').focus();
return false;
}else{
document.getElementById("Age").value = age;
}
}else{
document.getElementById("Age").value = "";
return false;
}
}
</script>
    <!-- End JS-->
  </body>
</html>