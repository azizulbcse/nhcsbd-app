<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html>

<head>
    <!-- Start title --> 
    <title>Member Deposit Summary | Nurses Health Care Society </title>  
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
                  <h3> Share Holder Fixed Deposit Summary </h3>
                </div>
                
                <div class="card">   
                <small class="float-right">      
                  <a href="printSHFixedDepositSummary.php" target="_blank" class="btn btn-default button1"><i class="glyphicon glyphicon-print"></i> Print Share Holder Fixed Deposit Summary  </a>
                </small>  
                <div class="row small-text">
                  <p class="col-md-12">
                    নোট - সদস্যদের টাকা জমা দেয়ার বিস্তারিত দেখার বা প্রিন্ট করার জন্য Action বাটনে ক্লিক করে Deposit Details এ ক্লিক করুন।
                  </p>
                </div>           
                <div class="card-datatable table-responsive">
                <table class="table table-bordered" id="MemberDepositSummaryTable"> 
                  <thead>
				               <tr>
                        <th>Sl No</th>
                        <th>Member </br> Photo</th> 
                        <th>Member </br> Name</th>
                        <th>Fixed Payable Amount </th>
                        <th>Fixed Paid Amount</th>
                        <th>Fixed Due Amount</th>
                        <th style="width:15%;">Option</th>
			                </tr>              
                  </thead>
                </table>
                  
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
    <script src="custom/js/sh-fixed-deposit-summary.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>
  </body>
</html>