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
                  <div class="filter-wrapper">

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
                            <p style="color: #666; margin: 0; font-size: 15px;">
                                লোন <b>Approved</b> হলে স্বয়ংক্রিয় ভাবে লোনের সিডিউল তৈরি হবে। আপনি ড্রপডাউন থেকে সদস্য নির্বাচন করে বিস্তারিত দেখতে পারেন।
                            </p>             
                
            </div>
        </div>
    </div>
</div>
                <div class="card">                  
              <div class="filter-title">
                  <i class="fa fa-filter" style="color: #3498db;"></i>
                  ফিল্টার করার জন্য সদস্যের নাম নির্বাচন করুন
              </div>
              
              <form action="" method="get" style="margin: 0;">
                  <div class="custom-select-container">
                      <select class="form-control selectpicker selectpicker-custom" 
                              data-live-search="true" 
                              name="MemberId" 
                              onChange="this.form.submit();">
                          <option value="">📁 সকল সদস্যের ডাটা </option>
                          <?php
                          $sql = "SELECT DISTINCT tai.mid, tai.name_english FROM tblloanschedule tls, tblapplicantinfo tai WHERE tls.member_id=tai.mid ORDER BY tai.name_english ASC";
                          $result = $connect->query($sql);
                          while($row = $result->fetch_array()) {
                              $selected = (isset($_GET['MemberId']) && $_GET['MemberId'] == $row['mid']) ? "selected" : "";
                              echo "<option value='".$row['mid']."' $selected>📅 ".$row['name_english']."</option>";
                          }
                          ?>
                      </select>
                  </div>
              </form>
          </div>

                
                
                <div class="card-datatable table-responsive">
                <table class="table table-bordered" id="manageLoanScheduleInfoTable"> 
                  <thead>
				              <tr>
                        <th>Sl No</th>
                        <th>Member Photo </th>
                        <th> Member Name </th>                        
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
    <script src="custom/js/loan-schedule-admin.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>
    
  </body>
</html>