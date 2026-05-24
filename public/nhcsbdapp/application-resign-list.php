<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html>

<head>
    <!-- Start title --> 
    <title>Resignation List | Nurses Health Care Society </title>  
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
    <?php include ('layouts/2-base-header.php') ?>
    <!-- END HEADER -->

    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
      <!-- BEGIN SIDEBAR -->
      <?php include ('layouts/4-base-menu.php') ?>
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
                  <h3>Application Info / Resignation List Info</h3>
                </div>
                <div class="card">
                <!--<div class="row small-text">
                  <p class="col-md-12">
                    নোট - সন্মানিত সদস্য, আপনার আবেদন পত্রটি সভাপতির নিকট পাঠাতে হলে Action বাটনে ক্লিক করে Send বাটনে ক্লিক করুন। আর বাদ দিতে চাইলে Cancel বাটনে ক্লিক করুন।
                  </p>
                </div>-->
                <div class="card-datatable table-responsive">
                <table class="table table-bordered" id="manageResignInfoTable"> 
                  <thead>
				               <tr>
                        <th>Sl No</th>
                        <th>Member Photo</th>
                        <th>Member Name</th>
                        <th>Resign Date</th>
			                  <th>Resignation Reasons</th> 
                        <th>President Status</th>   
                        <th>Secretary General Status</th>    
                        <th>Account Status</th>    	
			                  <th style="width:15%;">Option </th>
			                </tr>              
                  </thead>
                </table>
<?php
	$user_id = $_SESSION['userId'];	 
	$sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','President')";
	$result = $connect->query($sql);
	while($row = $result->fetch_array()) {
?>  
<!--Start Post Deposit info -->
<div class="modal fade" tabindex="-1" role="dialog" id="PresidentApprovedResignInfoModel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-ok"></i> Approved Resign Application </h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to Approved this Resign Application?</p>
      </div>
      <div class="modal-footer postedResignInfoFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="postedResignInfoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--End Post Deposit info -->
<?php } ?>

<?php
	$user_id = $_SESSION['userId'];	 
	$sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','Founder & General Secretary')";
	$result = $connect->query($sql);
	while($row = $result->fetch_array()) {
?>  
<!--Start Post Deposit info -->
<div class="modal fade" tabindex="-1" role="dialog" id="SGApprovedResignInfoModel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-ok"></i> Approved Resign Application </h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to Approved this Resign Application?</p>
      </div>
      <div class="modal-footer postedResignInfoFooterSG">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="postedResignInfoBtnSG" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--End Post Deposit info -->
<?php } ?>

<?php
	$user_id = $_SESSION['userId'];	 
	$sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','Accountant','Assistant Accountant')";
	$result = $connect->query($sql);
	while($row = $result->fetch_array()) {
?>  
<!--Start Post Deposit info -->
<div class="modal fade" tabindex="-1" role="dialog" id="ACCApprovedResignInfoModel"> 
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-ok"></i> Approved Resign Application </h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to Approved this Resign Application?</p>
      </div>
      <div class="modal-footer postedResignInfoFooterACC">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="postedResignInfoBtnACC" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--End Post Deposit info -->
<?php } ?>

<!--Start Delete Resignation Reasons info -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeResignInfoModel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Resign Application </h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeResignInfoFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeResignInfoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!--End Delete Resignation Reasons info -->
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
    <script src="custom/js/application-resign-list.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>
  </body>
</html>