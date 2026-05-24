<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html>

<head>
    <!-- Start title --> 
    <title>Share Holder Profile | Nurses Health Care Society </title>  
    <!-- End title --> 

    <!-- Start Header Base-->
    <?php require_once 'layouts/HeaderDTPage.php'; ?>
    <?php include ('layouts/1-base-head.php') ?>
    <!-- End Header Base --> 
  </head>
  <!-- END HEAD -->

  <!-- BEGIN BODY -->
  <body class="">
    <!-- BEGIN HEADER -->
    <?php include ('layouts/2-base-header-sh.php') ?>
    <!-- END HEADER -->

    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
      <!-- BEGIN SIDEBAR -->
      <?php include ('layouts/4-base-menu-sh.php') ?>
      <!-- END SIDEBAR -->

      <!-- BEGIN PAGE CONTAINER-->

      <div class="page-content">
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <div class="clearfix"></div>
        <div class="content">
          <div class="row-fluid">
            <div class="span12">
              <div class="grid simple ">
                <div class="grid-title">
                  <h3>My Profile</h3>
                </div>                
                <div class="card">                
                <div class="card-datatable table-responsive">
                <table class="table table-bordered" id="manageApplicantInfoTable"> 
                  <thead>
				    <tr>
                        <th> Sl No </th>
                        <th> Photo </th>
			            <th> Name (Bangla) </th>     
                        <th> Name (English) </th>   
                        <th> Father's Name </th>
                        <th> Hospital Name </th>   
                        <th> Gender </th> 
                        <th> Age </th>   
                        <th> Mobile No </th>  	
                        <th> Status </th>
			            <th style="width:15%;">Option </th>
			        </tr>              
                  </thead>
                </table>

<!--Start edit Application -->
<div class="modal fade" id="editApplicantInfoModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	    	
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Share Holder Info</h4>
	      </div>
	      <div class="modal-body" style="max-height:850px; overflow:auto;">

	      	<div class="div-loading">
	      		<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
	      	</div>

	      	<div class="div-result">

				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#photo" aria-controls="home" role="tab" data-toggle="tab">Share Holder Photo</a></li>
				    <li role="presentation"><a href="#memberInfo" aria-controls="profile" role="tab" data-toggle="tab">Share Holder Info </a></li>    
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">
				  	
				    <div role="tabpanel" class="tab-pane active" id="photo">
				    	<form action="php_action/editShareHolderImage.php" method="POST" id="updateMemberImageForm" class="form-horizontal" enctype="multipart/form-data">
				    	<br />
				    	<div id="edit-memberPhoto-messages"></div>

				    	<div class="form-group">
			        	<label for="editUserImage" class="col-sm-3 control-label">Share Holder Photo </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">							    				   
						      <img src="" id="getUserImage" class="thumbnail" style="width:250px; height:250px;" />
						    </div>
			        </div> <!-- /form-group-->	     	           	       
				    	
			      	<div class="form-group">
			        	<label for="editUserImage" class="col-sm-3 control-label">Select Share Holder Photo </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
							    <!-- the avatar markup -->
									<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
							    <div class="kv-avatar center-block">					        
							        <input type="file" class="form-control" id="editUserImage" placeholder="User Name" name="editUserImage" class="file-loading" style="width:auto;"/>
							    </div>
						      
						    </div>
			        </div> <!-- /form-group-->	     	           	       

			        <div class="modal-footer editMemberPhotoFooter">
				        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>				        
				        <!-- <button type="submit" class="btn btn-success" id="editUserImageBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button> -->
				      </div>
				      <!-- /modal-footer -->
				      </form>
				      <!-- /form -->
				    </div>
				    <!-- product image -->
				    <div role="tabpanel" class="tab-pane" id="memberInfo">
				    	<form accept-charset="utf-8" class="form-horizontal" id="editMemberForm" action="php_action/editShareHolderInfo.php" method="POST">				    
				    	<br />

				    	<div id="edit-applicantinfo-messages"></div>

				    	<div class="form-group">
			        	<label for="editApplicantNameBangla" class="col-sm-3 control-label"> আবেদনকারীর নাম (বাংলা) </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editApplicantNameBangla" placeholder="Applicant Name Bangla" name="editApplicantNameBangla" autocomplete="off">
						    </div>
			        </div>	
              
              <div class="form-group">
			        	<label for="editApplicantNameEnglish" class="col-sm-3 control-label"> আবেদনকারীর নাম (ইংরেজীতে) </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editApplicantNameEnglish" placeholder="Applicant Name English" name="editApplicantNameEnglish" autocomplete="off">
						    </div>
			        </div>

              <div class="form-group">
			        	<label for="editFathersName" class="col-sm-3 control-label"> পিতার /স্বামীর নাম </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editFathersName" placeholder="Fathers Name" name="editFathersName" autocomplete="off">
						    </div>
			        </div>

              <div class="form-group">
			        	<label for="editMothersName" class="col-sm-3 control-label"> মাতার নাম </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editMothersName" placeholder="Mothers Name" name="editMothersName" autocomplete="off">
						    </div>
			        </div>

              <div class="form-group">
                  <label for="editGender" class="col-sm-3 control-label"> লিঙ্গ / Gender </label>
                  <label class="col-sm-1 control-label">: </label>
                   <div class="col-sm-8">
				            <select class="form-control" id="editGender" name="editGender">
				      	    <option value="">~~SELECT~~</option>
				      	    <?php 
				      	      $sql = "SELECT * FROM tbllookup WHERE type='gender' AND status = 1 ORDER BY id ASC";
								      $result = $connect->query($sql);
								      while($row = $result->fetch_array()) {
									    echo "<option value='".$row[1]."'>".$row[1]."</option>";
								      }								
				       	    ?>
				            </select>
				          </div>
			        </div>

                    <div class="form-group">
                     <label for="editMaritalStatus" class="col-sm-3 control-label"> বৈবাহিক অবস্থা </label>
                     <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
				            <select class="form-control" id="editMaritalStatus" name="editMaritalStatus">
				      	    <option value="">~~SELECT~~</option>
				      	    <?php 
				      	      $sql = "SELECT * FROM tbllookup WHERE type='maritalstatus' AND status = 1 ORDER BY id ASC";
								      $result = $connect->query($sql);
								      while($row = $result->fetch_array()) {
									    echo "<option value='".$row[1]."'>".$row[1]."</option>";
								      }								
				       	    ?>
				            </select>
				        </div>
			        </div>

					<div class="form-group">
			        	<label for="editDateofBirth" class="col-sm-3 control-label"> জন্ম তারিখ </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="date" class="form-control" id="editDateofBirth" name="editDateofBirth" placeholder="Date of Birth" onkeyup="getAgeVal(0)" onblur="getAgeVal(0) autocomplete="off">
						    </div>
			        </div>

					<div class="form-group">
			        	<label for="editAge" class="col-sm-3 control-label"> বয়স / Age </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editAge" readonly="false" placeholder="Age" name="editAge" autocomplete="off">
						    </div>
			        </div>

					<div class="form-group">
			        	<label for="editPresentAddress" class="col-sm-3 control-label"> বর্তমান ঠিকানা </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editPresentAddress" placeholder="Present Address" name="editPresentAddress" autocomplete="off">
						    </div>
			        </div>

                    <div class="form-group">
			        	<label for="editPermanentAddress" class="col-sm-3 control-label"> স্থায়ী ঠিকানা </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editPermanentAddress" placeholder="Permanent Address" name="editPermanentAddress" autocomplete="off">
						    </div>
			        </div>

					<div class="form-group">
                     <label for="editHospitalName" class="col-sm-3 control-label"> কর্মরত হাসপাতালের নাম </label>
                     <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
				            <select class="form-control" id="editHospitalName" name="editHospitalName">
				      	    <option value="">~~SELECT~~</option>
				      	    <?php 
				      	      $sql = "SELECT * FROM tblhospitalname WHERE status = 1 ORDER BY hospitalname ASC";
								      $result = $connect->query($sql);
								      while($row = $result->fetch_array()) {
									    echo "<option value='".$row[0]."'>".$row[1]."</option>";
								      }								
				       	    ?>
				            </select>
				        </div>
			        </div>    
					
					<div class="form-group">
			        	<label for="editMobileNo" class="col-sm-3 control-label"> আবেদনকারীর নিজ ফোন নং </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editMobileNo" placeholder="Mobile No" name="editMobileNo" autocomplete="off">
						    </div>
			        </div>

					<div class="form-group">
			        	<label for="editAppNID" class="col-sm-3 control-label"> আবেদনকারীর জাতীয় পরিচয় পত্রের নং </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editAppNID" placeholder="NID" name="editAppNID" autocomplete="off">
						    </div>
			        </div>

					<div class="form-group">
			        	<label for="editEmail" class="col-sm-3 control-label"> আবেদনকারীর ইমেইল আইডি </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="email" class="form-control" id="editEmail" placeholder="Email" name="editEmail" autocomplete="off">
						    </div>
			        </div>

					<div class="form-group">
                     <label for="editBloodGroup" class="col-sm-3 control-label"> রক্তের গ্রুপ </label>
                     <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
				            <select class="form-control" id="editBloodGroup" name="editBloodGroup">
				      	    <option value="">~~SELECT~~</option>
				      	    <?php 
				      	      $sql = "SELECT * FROM tbllookup WHERE type='bloodgroup' AND status = 1 ORDER BY NAME ASC";
								      $result = $connect->query($sql);
								      while($row = $result->fetch_array()) {
									    echo "<option value='".$row[1]."'>".$row[1]."</option>";
								      }								
				       	    ?>
				            </select>
				        </div>
			        </div>

					<div class="form-group">
			        	<label for="editNomineeName" class="col-sm-3 control-label"> নমিনির নাম </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editNomineeName" placeholder="Nominee Name" name="editNomineeName" autocomplete="off">
						    </div>
			        </div>

					<div class="form-group">
			        	<label for="editNomineeRelation" class="col-sm-3 control-label"> নমিনির সম্পর্ক </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editNomineeRelation" placeholder="Nominee Relation" name="editNomineeRelation" autocomplete="off">
						    </div>
			        </div>

					<div class="form-group">
			        	<label for="editNomineeMobile" class="col-sm-3 control-label"> নমিনির ফোন নং </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editNomineeMobile" placeholder="Nominee Mobile" name="editNomineeMobile" autocomplete="off">
						    </div>
			        </div>

					<div class="form-group">
			        	<label for="editNomineeAddress" class="col-sm-3 control-label"> নমিনির ঠিকানা </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editNomineeAddress" placeholder="Nominee Address" name="editNomineeAddress" autocomplete="off">
						    </div>
			        </div>

					<div class="form-group">
			        	<label for="editEmergencyContact" class="col-sm-3 control-label"> জরুরী প্রয়োজনে যোগাযোগের জন্য ফোন নং </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="number" class="form-control" id="editEmergencyContact" placeholder="Emergency Contact" name="editEmergencyContact" autocomplete="off">
						    </div>
			        </div>

					<div class="form-group">
			        	<label for="editBkashNogod" class="col-sm-3 control-label"> আবেদন ফি-১০০/- টাকা (০১৬৮৯৫৯৭৪৭৪) </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="number" class="form-control" id="editBkashNogod" placeholder="Bkash/Nogod" name="editBkashNogod" autocomplete="off">
						    </div>
			        </div>

					<div class="form-group">
			        	<label for="editTransactionNo" class="col-sm-3 control-label"> ট্রাঞ্জেকশন নং </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editTransactionNo" placeholder="Transaction No" name="editTransactionNo" autocomplete="off">
						    </div>
			        </div>

					<div class="form-group">
                     <label for="editBankName" class="col-sm-3 control-label"> ব্যাংকের নাম </label>
                     <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
				            <select class="form-control" id="editBankName" name="editBankName">
				      	    <option value="">~~SELECT~~</option>
				      	    <?php 
				      	      $sql = "SELECT * FROM tblbankinfo WHERE status = 1 ORDER BY bank_name ASC";
								      $result = $connect->query($sql);
								      while($row = $result->fetch_array()) {
									    echo "<option value='".$row[1]."'>".$row[1]."</option>";
								      }								
				       	    ?>
				            </select>
				        </div>
			        </div>

					<div class="form-group">
			        	<label for="editBranchName" class="col-sm-3 control-label"> শাখার নাম </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editBranchName" placeholder="Branch Name" name="editBranchName" autocomplete="off">
						    </div>
			        </div>

					<div class="form-group">
			        	<label for="editAccountNo" class="col-sm-3 control-label"> একাউন্ট নং </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editAccountNo" placeholder="Account Number" name="editAccountNo" autocomplete="off">
						    </div>
			        </div>

					<div class="form-group">
			        	<label for="editAccountName" class="col-sm-3 control-label"> একাউন্টের নাম </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editAccountName" placeholder="Account Name" name="editAccountName" autocomplete="off">
						    </div>
			        </div>

					<div class="form-group">
                     <label for="editMobileBankName" class="col-sm-3 control-label"> মোবাইল ব্যাংকিং </label>
                     <label class="col-sm-1 control-label">: </label>
                        <div class="col-sm-8">
				            <select class="form-control" id="editMobileBankName" name="editMobileBankName">
				      	    <option value="">~~SELECT~~</option>
				      	    <?php 
				      	      $sql = "SELECT * FROM tbllookup WHERE type='MobileBank' AND status = 1 ORDER BY name ASC";
								      $result = $connect->query($sql);
								      while($row = $result->fetch_array()) {
									    echo "<option value='".$row[1]."'>".$row[1]."</option>";
								      }								
				       	    ?>
				            </select>
				        </div>
			        </div>

					<div class="form-group">
			        	<label for="editMobileBankNo" class="col-sm-3 control-label"> মোবাইল ব্যাংকিং নং </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="number" class="form-control" id="editMobileBankNo" placeholder="Mobile Bank No" name="editMobileBankNo" autocomplete="off">
						    </div>
			        </div>

			        <div class="modal-footer editMemberFooter">
				        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>				        
				        <button type="submit" class="btn btn-success" id="editMemberBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
				      </div> <!-- /modal-footer -->				     
			        </form> <!-- /.form -->				     	
				    </div>    
				    <!-- /product info -->
				  </div>
				</div>	      	
	      </div> <!-- /modal-body -->     	      
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- /End edit Application -->

<!--Start Post Applicant info -->
<div class="modal fade" tabindex="-1" role="dialog" id="postedApplicantInfoModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-ok"></i> Approved Applicant Info</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to Approved ?</p>
      </div>
      <div class="modal-footer postedApplicantInfoFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="postedApplicantInfoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--End Post Applicant info -->

<!--Start Delete Applicant info -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeApplicantInfoModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Applicant Info </h4>
      </div>
      <div class="modal-body">
        <p>Do you want to delete this info?</p>
      </div>
      <div class="modal-footer removeApplicantInfoFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeApplicantInfoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Change</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!--End Delete Applicant info -->
                  
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
      <!-- BEGIN footer -->
      <div id="footer">
        <div class="error-container">
          <div class="copyright"> © 2024, made with ❤️ by Matrik Solutions</div>
        </div>
      </div>  
      <!-- END footer -->
    </div>
    <!-- END CONTAINER -->
    
    <!-- BEGIN CORE JS FRAMEWORK-->
    <?php include ('layouts/5-base-js.php') ?> 
    <!-- END CORE JS FRAMEWORK-->
    <script src="custom/js/sh-profile.js"></script>
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
var birthdate = formatDate(document.getElementById("editDateofBirth").value);
var count = document.getElementById("editDateofBirth").value.length;
if (count=='10'){
var age = getAge(birthdate);
var str = age;
var res = str.substring(0, 1);
if (res =='-' || res =='0'){
document.getElementById("editDateofBirth").value = "";
document.getElementById("editAge").value = "";
$('#editDateofBirth').focus();
return false;
}else{
document.getElementById("editAge").value = age;
}
}else{
document.getElementById("editAge").value = "";
return false;
}
}
</script>
  </body>
</html>