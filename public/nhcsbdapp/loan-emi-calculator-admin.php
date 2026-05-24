<?php require_once 'php_action/core.php'; ?> 

<!DOCTYPE html>
<html>
<head>
    <!-- Start title --> 
    <title>Loan EMI Calculator | Nurses Health Care Society </title>  
    <!-- End title --> 

    <!-- Start Header Base--> 
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

        <div class="content sm-gutter">
          <div class="page-title">
          </div>
          <!-- BEGIN DASHBOARD TILES -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
          <div class="row">            
 
          <?php include ('layouts/emi-calculator.php') ?>

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

