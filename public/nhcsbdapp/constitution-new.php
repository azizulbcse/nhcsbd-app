<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html>

<head>
    <!-- Start title --> 
    <title>Constitution | Nurses Health Care Society </title>  
    <!-- End title --> 

    <!-- Start Header Base--> 
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

        <div class="content sm-gutter">
          <div class="page-title">
          </div>
          <!-- BEGIN DASHBOARD TILES -->
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

  <div class="container" data-aos="fade-up">
    <div class="section-title text-center mb-4">
      <h2>Constitution</h2>
      <p>Nurses Health Care Society Bangladesh-এর গঠনতন্ত্র নিচে সরাসরি পড়তে পারেন।</p>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <!-- PDF Viewer Container -->
        <div class="pdf-container">
          <!-- Google PDF Viewer Link (Replace YOUR_WEBSITE_URL with actual live link) -->
          <embed src="https://nhcsbd.org/public/nhcsbdapp/constitution.pdf" type="application/pdf" width="100%" height="600px" />

        </div>
        
        <!-- Download Button -->
        <div class="text-center mt-4">
          <a href="constitution.pdf" class="btn-download" download>
            <i class="bi bi-file-earmark-pdf"></i> PDF ডাউনলোড করুন
          </a>
        </div>
      </div>
    </div>
  </div>

          <div id="footer">
            <div class="error-container">
              <div class="copyright"> © 2024, made with ❤️ by Matrik Solutions</div>
            </div>
          </div>         
          <!-- END DASHBOARD TILES -->
        </div>
        
      </div>
      
    </div>

    <!-- END CONTAINER -->

    <!-- BEGIN CORE JS FRAMEWORK-->
        <?php include ('layouts/5-base-js.php') ?> 
        <script src="assets/plugins/fullcalendar/fullcalendar.min.js"></script>
        <script src="assets/js/calender.js" type="text/javascript"></script>
    <!-- END CORE JS FRAMEWORK-->
  </body>
</html>

