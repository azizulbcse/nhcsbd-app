<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html>

<head>
    <!-- Start title --> 
    <title>SMS List | Nurses Health Care Society </title>  
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
                  <h3>SMS Info / SMS Sent List </h3>
                </div>
                
                <div class="card">
                
                <div class="card-datatable table-responsive">
                <table class="table table-bordered" id="manageSMSSentInfoTable"> 
                  <thead>
				               <tr>
                        <th>Sl No</th>
			                  <th>Mobile No</th>    
                        <th>Message</th>      
                        <th>Cost</th>       	
                        <th>Sent Date & Time</th>
			                </tr>              
                  </thead>
                </table>

<!--Start add Item info -->

<!--End add customer info -->

<!--Start edit unit info -->

<!--End edit unit info -->

<!--Start Delete customer info -->

<!--End Delete customer info -->
                  
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
    <script src="custom/js/sms-sent-self-info.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>
  </body>
</html>