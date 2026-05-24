<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html>

<head>
    <!-- Start title --> 
    <title>Deposit List | Nurses Health Care Society </title>  
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
                  <h3>Deposit Info / Deposit List </h3>
                </div>                
                <div class="card">                
                <div class="card-datatable table-responsive">
                <table class="table table-bordered" id="manageTraxDepositInfoTable"> 
                  <thead>
				            <tr>
                      <th>Sl No</th>
						          <th>Member </br> Photo</th>
			                <th>Deposit </br> Date</th>
						          <th>Depositor </br> Name</th>  
                      <th>Payment </br> Type</th> 
						          <th>Payment </br> From</th> 
                      <th>Payment </br> To</th> 
                      <th>Monthly </br> Amount</th>  
                      <th>Fixed </br> Amount</th>
						          <th>Trx </br> No</th>     
                      <th>Month Name</th> 
                      <th>Status</th>
			                <th style="width:15%;">Option </th>
			              </tr>              
                  </thead>
                </table>

<!--Start add Deposit info -->
<!--End add Deposit info -->

<!--Start edit Deposit info -->
<!--End edit Deposit info -->
<?php
	$user_id = $_SESSION['userId'];	 
	$sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','Founder & General Secretary','Accountant','Assistant Accountant')";
	$result = $connect->query($sql);
	while($row = $result->fetch_array()) {
?>  
<!--Start Post Deposit info -->
<div class="modal fade" tabindex="-1" role="dialog" id="postedDepositInfoModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-ok"></i> Posted Deposit Info</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to Posting this Deposit?</p>
      </div>
      <div class="modal-footer postedDepositInfoFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="postedDepositInfoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--End Post Deposit info -->

<!--Start Delete Deposit info -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeDepositInfoModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Deposit Info </h4>
      </div>
      <div class="modal-body">
        <p>Do you want to delete this Deposit info?</p>
      </div>
      <div class="modal-footer removeDepositInfoFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeDepositInfoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Change</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!--End Delete Deposit info -->
<?php } ?>             
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
    <?php if($_GET['id']==1) { ?>
    <script src="custom/js/transection-deposit-list-info.js"></script>
    <?php } ?>
    <?php if($_GET['id']==2) { ?>
    <script src="custom/js/transection-sh-deposit-list-info.js"></script>
    <?php } ?>
    <?php include ('layouts/FooterDTPage.php') ?>
  </body>
</html>