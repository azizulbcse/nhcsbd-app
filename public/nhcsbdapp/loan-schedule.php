<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html>

<head>
    <!-- Start title --> 
    <title>Loan Schedule | Nurses Health Care Society </title>  
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
    <?php include ('layouts/2-base-header-member.php') ?>
    <!-- END HEADER -->

    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
      <!-- BEGIN SIDEBAR -->

      <?php include ('layouts/4-base-menu-member.php') ?>

  
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
                  <h3>Loan Management / Loan Schedule</h3>
                </div>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .custom-loan-alert {
        background: #ffffff;
        border-left: 5px solid #0dcaf0; /* সাইড বর্ডার */
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); /* হালকা শ্যাডো */
        padding: 20px;
        transition: transform 0.3s ease;
    }
    
    .custom-loan-alert:hover {
        transform: translateY(-3px); /* হোভার করলে একটু উপরে উঠবে */
    }

    .alert-icon {
        color: #0dcaf0;
        font-size: 1.5rem;
        margin-right: 15px;
    }

    .notice-title {
        color: #084298;
        font-weight: 700;
        display: flex;
        align-items: center;
    }

    .warning-text {
        background: #fff3cd;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.9rem;
        display: inline-block;
    }
    
</style>

<div class="col-md-12 mt-4">
    <div class="custom-loan-alert border shadow-sm">
        <div class="d-flex align-items-start">
            <div class="alert-icon">
                <i class="fas fa-bullhorn animated swing infinite"></i>
            </div>
            <div class="w-100">
                <h4 class="notice-title">সম্মানিত সদস্য!</h4>
                <p class="text-secondary mb-3">
                    আপনার লোন Approved হলে স্বয়ংক্রিয় ভাবে আপনার লোনের সিডিউল তৈরি হবে এবং আপনি দেখতে পারবেন। ধন্যবাদ 
                </p>               
                
            </div>
        </div>
    </div>
</div>
                <div class="card">                  
                <small class="float-right">     
                  <button class="" data-target="#">  </button>                  
                </small>
                
                <div class="card-datatable table-responsive">
                <table class="table table-bordered" id="manageLoanScheduleInfoTable"> 
                  <thead>
				              <tr>
                        <th>Sl No</th>
                        <th>Loan Id</th>
                        <th>Installment No</th>
			                  <th>EMI Amount</th>
                        <th>Due Date</th>
                        <th> Payment Status </th>                        
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
          <div class="copyright"> © 2026, made with ❤️ by Matrik Solutions</div>
        </div>
      </div>  
      <!-- END footer -->
    </div>
    <!-- END CONTAINER -->
    
    <!-- BEGIN CORE JS FRAMEWORK-->
    <?php include ('layouts/5-base-js.php') ?> 
    <!-- END CORE JS FRAMEWORK-->
    <script src="custom/js/loan-schedule.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>
  </body>
</html>