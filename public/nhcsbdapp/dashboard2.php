<?php require_once 'php_action/core.php'; ?> 
<?php
//Payable member deposit
$totalpayable = "0";
$cashQuery = $connect->query("SELECT tpaya FROM vw_memberdepositsummary vmds, tblapplicantinfo tai WHERE vmds.mid=tai.mid");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totalpayable += $cashResult['tpaya'];
}

//Payable share holder deposit
$totalpayablesh = "0";
$cashQuery = $connect->query("SELECT tpaya FROM vw_memberdepositsummary vmds, tblapplicantinfosh tai WHERE vmds.mid=tai.mid AND tai.status=2");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totalpayablesh += $cashResult['tpaya'];
}

//paid member deposit
$totalpaid = "0";
$cashQuery = $connect->query("SELECT mda FROM vw_memberdepositsummary vmds, tblapplicantinfo tai WHERE vmds.mid=tai.mid AND tai.status=2");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totalpaid += $cashResult['mda'];
}

//paid share holder deposit
$totalpaidsh = "0";
$cashQuery = $connect->query("SELECT mda FROM vw_memberdepositsummary vmds, tblapplicantinfosh tai WHERE vmds.mid=tai.mid AND tai.status=2");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totalpaidsh += $cashResult['mda'];
}

//due member deposit
$totaldue = "0";
$cashQuery = $connect->query("SELECT mda-tpaya as due  FROM vw_memberdepositsummary vmds, tblapplicantinfo tai WHERE vmds.mid=tai.mid AND tai.status=2");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totaldue += $cashResult['due'];
}

//due share holder deposit
$totalduesh = "0";
$cashQuery = $connect->query("SELECT mda-tpaya as due  FROM vw_memberdepositsummary vmds, tblapplicantinfosh tai WHERE vmds.mid=tai.mid AND tai.status=2");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totalduesh += $cashResult['due'];
}

//total deposit
$totaldeposit = "0";
$cashQuery = $connect->query("SELECT deposit_amount FROM tbltrxdepositinfo WHERE status=2");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totaldeposit += $cashResult['deposit_amount'];
}

//monthly deposit
$monthlytotaldeposit= "0";
$cashQuery = $connect->query("SELECT deposit_amount FROM tbltrxdepositinfo WHERE status=2 AND DATE_FORMAT(depositdate,'%M %Y') =DATE_FORMAT(CURDATE(), '%M %Y')");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$monthlytotaldeposit += $cashResult['deposit_amount'];
}

//daily deposit
$dailytotaldeposit = "0";
$cashQuery = $connect->query("SELECT deposit_amount FROM tbltrxdepositinfo WHERE status=2 AND depositdate=CURDATE()");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$dailytotaldeposit += $cashResult['deposit_amount'];
}






//total application amount
$totalappamount = "0";
$cashQuery = $connect->query("SELECT app_amount FROM vw_income4application");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totalappamount += $cashResult['app_amount'];
}

//monthly application amount 
$totalmappamount = "0";
$cashQuery = $connect->query("SELECT app_amount FROM vw_income4application WHERE DATE_FORMAT(createdate,'%M %Y') =DATE_FORMAT(CURDATE(), '%M %Y')");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totalmappamount += $cashResult['app_amount'];
}

//today application amount 
$totaldappamount = "0";
$cashQuery = $connect->query("SELECT app_amount FROM vw_income4application WHERE createdate=CURDATE()");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totaldappamount += $cashResult['app_amount'];
}

//total sms buy
$totalsmsbuy = "0";
$cashQuery = $connect->query("SELECT amount FROM tbltrxexpenseinfo WHERE headname=1 AND status=2");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totalsmsbuy += $cashResult['amount'];
}



$remainsmsbal = "0";
$remainsmsbal=round(($totalsmsbuy-$totalsmscost),2);

$totalincome = "0";
$totalincome=$totalappamount+$totaldeposit+$totalothersincome;

$balance = "0";
$balance=$totalincome-$totalexpensecost;
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Start title --> 
    <title>Dashboard | Nurses Health Care Society </title>  
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
          
          <div class="row">

            
            </a>

               

                            
            
                     
            
            
            


            <?php if($_SESSION['Role']==1)
	          {
            ?>  
            <a href="setup-hospital-info.php?HospitalInfo">
            <?php } ?>
            <div class="col-md-3 col-sm-6">
              <div class="tiles blue m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black"> HOSPITAL LIST </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Overall</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalhospital; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Monthly</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $monthlyhospital; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title">Today's</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $dailyhospital; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="progress transparent progress-small no-radius m-t-20" style="width:100%">                    
                  </div>
                  <div class="description"> </span>
                  </div>
                </div>
              </div>
            </div>
            </a>

            

          </div>

          <div class="col-md-8 tiles white no-padding">
            <div class="tiles-body">
              <div id='calendar'></div>
            </div>
          </div>

          <!--<div id="footer">
            <div class="error-container">
              <div class="copyright"> © 2024, made with ❤️ by Matrik Solutions</div>
            </div>
          </div>-->          
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