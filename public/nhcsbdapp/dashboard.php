<?php require_once 'php_action/core.php'; ?> 
<?php
//Payable member total deposit
$membertotalpayable = "0";
$cashQuery = $connect->query("SELECT tpaya FROM vw_memberdepositsummary");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$membertotalpayable += $cashResult['tpaya'];
}

//paid member total deposit
$membertotalpaid = "0";
$cashQuery = $connect->query("SELECT tpaida FROM vw_memberdepositsummary");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$membertotalpaid += $cashResult['tpaida'];
}

//due member total deposit
$membertotaldue = "0";
$cashQuery = $connect->query("SELECT tduea FROM vw_memberdepositsummary");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$membertotaldue += $cashResult['tduea'];
}

//Payable member deposit
$totalpayable = "0";
$cashQuery = $connect->query("SELECT tmpaya FROM vw_memberdepositsummary");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totalpayable += $cashResult['tmpaya'];
}

//paid member deposit
$totalpaid = "0";
$cashQuery = $connect->query("SELECT tmpaida FROM vw_memberdepositsummary");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totalpaid += $cashResult['tmpaida'];
}

//due member deposit
$totaldue = "0";
$cashQuery = $connect->query("SELECT tmduea FROM vw_memberdepositsummary");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totaldue += $cashResult['tmduea'];
}

//Payable member fixed deposit
$totalfixedapayable = "0";
$cashQuery = $connect->query("SELECT tpayfixeda FROM vw_memberdepositsummary");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totalfixedapayable += $cashResult['tpayfixeda'];
}

//paid member fixed deposit
$totalfixedapaid = "0";
$cashQuery = $connect->query("SELECT tpaidfixeda FROM vw_memberdepositsummary");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totalfixedapaid += $cashResult['tpaidfixeda'];
}

//due member fixed deposit
$totalfixedadue = "0";
$cashQuery = $connect->query("SELECT tfixeduea FROM vw_memberdepositsummary");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totalfixedadue += $cashResult['tfixeduea'];
}

$membertotaldepositmf = "0";
$membertotaldepositmf=$membertotalpaid+$totalfixedapaid;


//total administrator
$sql = "SELECT * FROM tbladminuser WHERE user_id!=1";
$query = $connect->query($sql);
$totaladministrator= $query->num_rows;

//total administrator approved
$sql = "SELECT * FROM tbladminuser WHERE user_id!=1 AND status=2";
$query = $connect->query($sql);
$totaladministratorapproved= $query->num_rows;

//total administrator cancel
$sql = "SELECT * FROM tbladminuser WHERE user_id!=1 AND status=0";
$query = $connect->query($sql);
$totaladministratorcancel= $query->num_rows;

//total applicant
$sql = "SELECT * FROM tblapplicantinfo";
$query = $connect->query($sql);
$totalapplicant= $query->num_rows;

//total applicant approved
$sql = "SELECT * FROM tblapplicantinfo where status=2";
$query = $connect->query($sql);
$totalapplicantapproved= $query->num_rows;

//total applicant cancel
$sql = "SELECT * FROM tblapplicantinfo where status=0";
$query = $connect->query($sql);
$totalapplicantcancel= $query->num_rows;

//total application amount
$totalappamount = "0";
$cashQuery = $connect->query("SELECT app_amount FROM vw_income4application");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totalappamount += $cashResult['app_amount'];
}

//total member application amount
$totalmamount = "0";
$cashQuery = $connect->query("SELECT app_amount FROM tblapplicantinfo");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totalmamount += $cashResult['app_amount'];
}

//total sh application amount
$totalshamount = "0";
$cashQuery = $connect->query("SELECT app_amount FROM tblapplicantinfosh");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totalshamount += $cashResult['app_amount'];
}

//total others income
$totalothersincome = "0";
$cashQuery = $connect->query("SELECT round(amount,2) amount FROM tbltrxincomeothersinfo WHERE status=2");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totalothersincome += $cashResult['amount'];
}

//monthly others income
$monthlyothersincome= "0";
$cashQuery = $connect->query("SELECT round(amount,2) amount FROM tbltrxincomeothersinfo WHERE status=2 AND DATE_FORMAT(incomedate,'%M %Y') =DATE_FORMAT(CURDATE(), '%M %Y')");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$monthlyothersincome += $cashResult['amount'];
}

//daily others income
$dailyothersincome = "0";
$cashQuery = $connect->query("SELECT round(amount,2) amount FROM tbltrxincomeothersinfo WHERE status=2 AND incomedate=CURDATE()");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$dailyothersincome += $cashResult['amount'];
}

//total member deposit
$totaldeposit = "0";
$cashQuery = $connect->query("SELECT (deposit_amount+fixed_amount) as depositamount FROM tbltrxdepositinfo WHERE status=2 AND memberid<1000");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totaldeposit += $cashResult['depositamount'];
}

//monthly member deposit
$monthlytotaldeposit= "0";
$cashQuery = $connect->query("SELECT (deposit_amount+fixed_amount) as depositamount FROM tbltrxdepositinfo WHERE status=2 AND memberid<1000 AND DATE_FORMAT(depositdate,'%M %Y') =DATE_FORMAT(CURDATE(), '%M %Y')");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$monthlytotaldeposit += $cashResult['depositamount'];
}

//daily member deposit
$dailytotaldeposit = "0";
$cashQuery = $connect->query("SELECT (deposit_amount+fixed_amount) as depositamount FROM tbltrxdepositinfo WHERE status=2 AND memberid<1000 AND depositdate=CURDATE()");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$dailytotaldeposit += $cashResult['depositamount'];
}

//total sh deposit
$totaldepositsh = "0";
$cashQuery = $connect->query("SELECT (deposit_amount+fixed_amount) as depositamount FROM tbltrxdepositinfo WHERE status=2 AND memberid>1000");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totaldepositsh += $cashResult['depositamount'];
}

//monthly sh deposit
$monthlytotaldepositsh= "0";
$cashQuery = $connect->query("SELECT (deposit_amount+fixed_amount) as depositamount FROM tbltrxdepositinfo WHERE status=2 AND memberid>1000 AND DATE_FORMAT(depositdate,'%M %Y') =DATE_FORMAT(CURDATE(), '%M %Y')");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$monthlytotaldepositsh += $cashResult['depositamount'];
}

//daily sh deposit
$dailytotaldepositsh = "0";
$cashQuery = $connect->query("SELECT (deposit_amount+fixed_amount) as depositamount FROM tbltrxdepositinfo WHERE status=2 AND memberid>1000 AND depositdate=CURDATE()");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$dailytotaldepositsh += $cashResult['depositamount'];
}

$totalincome = "0";
$totalincome=$membertotalpaid+$totalappamount+$totalothersincome;

$totaldepositmemsh = "0";
$totaldepositmemsh=$membertotalpaid;

//total expense cost
$totalexpensecost = "0";
$cashQuery = $connect->query("SELECT round(amount,2) amount FROM tbltrxexpenseinfo WHERE status=2");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totalexpensecost += $cashResult['amount'];
}

//monthly expense cost
$monthlyexpensecost = "0";
$cashQuery = $connect->query("SELECT round(amount,2) amount FROM tbltrxexpenseinfo WHERE status=2 AND DATE_FORMAT(expensedate,'%M %Y') =DATE_FORMAT(CURDATE(), '%M %Y')");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$monthlyexpensecost += $cashResult['amount'];
}

//daily expense cost
$dailyexpensecost = "0";
$cashQuery = $connect->query("SELECT round(amount,2) amount FROM tbltrxexpenseinfo WHERE status=2 AND expensedate=CURDATE()");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$dailyexpensecost += $cashResult['amount'];
}

$balance = "0";
$balance=$totalincome-$totalexpensecost;


//total donation
$totaldonation = "0";
$cashQuery = $connect->query("SELECT donate_amount FROM tbltrxdonationinfo WHERE status=2");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totaldonation += $cashResult['donate_amount'];
}

//monthly donation
$monthlytotaldonation= "0";
$cashQuery = $connect->query("SELECT donate_amount FROM tbltrxdonationinfo WHERE status=2 AND DATE_FORMAT(donatedate,'%M %Y') =DATE_FORMAT(CURDATE(), '%M %Y')");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$monthlytotaldonation += $cashResult['donate_amount'];
}

//daily donation
$dailytotaldonation = "0";
$cashQuery = $connect->query("SELECT donate_amount FROM tbltrxdonationinfo WHERE status=2 AND donatedate=CURDATE()");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$dailytotaldonation += $cashResult['donate_amount'];
}

//total donation
$totaldonationex = "0";
$cashQuery = $connect->query("SELECT amount FROM tbltrxdoneexpenseinfo WHERE status=2");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totaldonationex += $cashResult['amount'];
}

//monthly donation
$totaldonationexm= "0";
$cashQuery = $connect->query("SELECT amount FROM tbltrxdoneexpenseinfo WHERE status=2 AND DATE_FORMAT(expensedate,'%M %Y') =DATE_FORMAT(CURDATE(), '%M %Y')");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totaldonationexm += $cashResult['amount'];
}

//daily donation
$totaldonationexd = "0";
$cashQuery = $connect->query("SELECT amount FROM tbltrxdoneexpenseinfo WHERE status=2 AND expensedate=CURDATE()");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totaldonationexd += $cashResult['amount'];
}

$donetionbalance = "0";
$donetionbalance=$totaldonation-$totaldonationex;

//total sms buy
$totalsmsbuy = "0";
$cashQuery = $connect->query("SELECT amount FROM tbltrxexpenseinfo WHERE headname=1 AND status=2");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totalsmsbuy += $cashResult['amount'];
}

//total sms cost
$totalsmscost = "0";
$cashQuery = $connect->query("SELECT round(sum(cost),2) cost from vw_smssentdetails");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totalsmscost = $cashResult['cost'];
}

//monthly sms cost
$monthlysmscost = "0";
$cashQuery = $connect->query("SELECT round(sum(cost),2) cost FROM vw_smssentdetails WHERE DATE_FORMAT(createdate,'%M %Y') =DATE_FORMAT(CURDATE(), '%M %Y')");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$monthlysmscost += $cashResult['cost'];
}

//daily sms cost
$dailysmscost = "0";
$cashQuery = $connect->query("SELECT round(sum(cost),2) cost FROM vw_smssentdetails WHERE createdate=CURDATE()");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$dailysmscost += $cashResult['cost'];
}

//total sms count
$sql = "SELECT * FROM tblsmslog";
$query = $connect->query($sql);
$totalsmssent= $query->num_rows;

//monthly sms count
$sql = "SELECT * FROM tblsmslog WHERE DATE_FORMAT(createdate,'%M %Y') =DATE_FORMAT(CURDATE(), '%M %Y')";
$query = $connect->query($sql);
$monthlysmssent= $query->num_rows;

//daily sms count
$sql = "SELECT * FROM tblsmslog WHERE createdate=CURDATE()";
$query = $connect->query($sql);
$dailysmssent= $query->num_rows;

$remainsmsbal = "0";
$remainsmsbal=round(($totalsmsbuy-$totalsmscost),2);

//total hospital count
$sql = "SELECT * FROM tblhospitalname WHERE status=1";
$query = $connect->query($sql);
$totalhospital= $query->num_rows;

//monthly hospital count
$sql = "SELECT * FROM tblhospitalname WHERE status=1 AND DATE_FORMAT(createdate,'%M %Y') =DATE_FORMAT(CURDATE(), '%M %Y')";
$query = $connect->query($sql);
$monthlyhospital= $query->num_rows;

//daily hospital count
$sql = "SELECT * FROM tblhospitalname WHERE status=1 AND createdate=CURDATE()";
$query = $connect->query($sql);
$dailyhospital= $query->num_rows;

//total applicant SH
$sql = "SELECT * FROM tblapplicantinfosh";
$query = $connect->query($sql);
$totalapplicantsh= $query->num_rows;

//total applicant approved sh
$sql = "SELECT * FROM tblapplicantinfosh where status=2";
$query = $connect->query($sql);
$totalapplicantapprovedsh= $query->num_rows;


//total applicant cancel sh
$sql = "SELECT * FROM tblapplicantinfosh where status=0";
$query = $connect->query($sql);
$totalapplicantcancelsh= $query->num_rows;

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

            <?php
	            $user_id = $_SESSION['userId'];	 
	            $sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','Founder & General Secretary','Accountant','Assistant Accountant')";
	            $result = $connect->query($sql);
	            while($row = $result->fetch_array()) {
            ?>  
            <a href="member-monthly-deposit-summary.php?MemberMonthlyDepositSummary">
            <?php } ?>
            <div class="col-md-3 col-sm-6">
              <div class="tiles green m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black"> মাসিক টাকার পরিমান </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title"> জমা দিবে </span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalpayable; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title"> জমা দিছে </span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalpaid; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title"> বকেয়া আছে </span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totaldue; ?>" data-animation-duration="700">0</span>
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

            <?php
	            $user_id = $_SESSION['userId'];	 
	            $sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','Founder & General Secretary','Accountant','Assistant Accountant')";
	            $result = $connect->query($sql);
	            while($row = $result->fetch_array()) {
            ?>  
            <a href="member-fixed-deposit-summary.php?MemberFixedDepositSummary">
            <?php } ?>
            <div class="col-md-3 col-sm-6">
              <div class="tiles blue m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black"> এককালীন জমার পরিমান </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title"> জমা দিবে </span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalfixedapayable; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title"> জমা দিছে </span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalfixedapaid; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title"> বকেয়া আছে </span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalfixedadue; ?>" data-animation-duration="700">0</span>
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

            <?php
	            $user_id = $_SESSION['userId'];	 
	            $sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','Founder & General Secretary','Accountant','Assistant Accountant')";
	            $result = $connect->query($sql);
	            while($row = $result->fetch_array()) {
            ?>  
            <a href="member-deposit-summary.php?MemberDepositSummary">
            <?php } ?>
            <div class="col-md-3 col-sm-6">
              <div class="tiles red m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black"> মোট জমার পরিমান (মাসিক+এককালীন) </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title"> জমা দিবে </span> <span class="item-count animate-number semi-bold" data-value="<?php echo $membertotalpayable; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title"> জমা দিছে </span> <span class="item-count animate-number semi-bold" data-value="<?php echo $membertotalpaid; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title"> বকেয়া আছে </span> <span class="item-count animate-number semi-bold" data-value="<?php echo $membertotaldue; ?>" data-animation-duration="700">0</span>
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

            <div class="col-md-3 col-sm-6">
              <div class="tiles purple m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black"> জমা দেয়া হইছে </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title"> মাসিক জমা </span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalpaid; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title"> এককালীন জমা </span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalfixedapaid; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title"> মোট জমা </span> <span class="item-count animate-number semi-bold" data-value="<?php echo $membertotalpaid; ?>" data- animation-duration="100">0</span>
                    </div>
                  </div>
                  <div class="progress transparent progress-small no-radius m-t-20" style="width:100%">
                   
                  </div>
                  <div class="description"> </span>
                  </div>
                </div>
              </div>
            </div>   
            
            <?php if($_SESSION['Role']==1)
	          {
            ?> 
            <a href="sms-sent-info.php?SMSSentInfo">
            <?php } ?>
            <div class="col-md-3 col-sm-6">
              <div class="tiles blue m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black"> SMS BALANCE INFO </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Recharge</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalsmsbuy; ?>" data- animation-duration="100">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Expense</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalsmscost; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title">Remain </span> <span class="item-count animate-number semi-bold" data-value="<?php echo $remainsmsbal; ?>" data-animation-duration="700">0</span>
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
            
            <div class="col-md-3 col-sm-6">
              <div class="tiles green m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black">INCOME FROM OTHERS </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Overall</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalothersincome; ?>" data- animation-duration="100">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Monthly</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $monthlyothersincome; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title"> Today's </span> <span class="item-count animate-number semi-bold" data-value="<?php echo $dailyothersincome; ?>" data-animation-duration="700">0</span>
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

            <div class="col-md-3 col-sm-6">
              <div class="tiles purple m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black">INCOME SUMMARY </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Overall</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalincome; ?>" data- animation-duration="100">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Deposit</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totaldepositmemsh; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <!--<div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Application</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalappamount; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>-->
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title"> Others </span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalothersincome; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="progress transparent progress-small no-radius m-t-20" style="width:100%">
                   
                  </div>
                  <div class="description"> </span>
                  </div>
                </div>
              </div>
            </div>

            <?php
	            $user_id = $_SESSION['userId'];	 
	            $sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','Founder & General Secretary','Accountant','Assistant Accountant')";
	            $result = $connect->query($sql);
	            while($row = $result->fetch_array()) {
            ?>  
            <a href="sh-monthly-deposit-summary.php?ShareHolderMonthlyDepositSummary">
            <?php } ?>
            <!--<div class="col-md-3 col-sm-6">
              <div class="tiles blue m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black">SHARE HOLDER MONTHLY DEPOSIT AMOUNT </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Payable Taka</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalpayablesh; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Paid Taka</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalpaidsh; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title">Due Taka</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalduesh; ?>" data-animation-duration="700">0</span>
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
            
            <?php
	            $user_id = $_SESSION['userId'];	 
	            $sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','Founder & General Secretary','Accountant','Assistant Accountant')";
	            $result = $connect->query($sql);
	            while($row = $result->fetch_array()) {
            ?>  
            <a href="sh-fixed-deposit-summary.php?ShareHolderFixedDepositSummary">
            <?php } ?>
            <div class="col-md-3 col-sm-6">
              <div class="tiles green m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black"> SHARE HOLDER FIXED DEPOSIT AMOUNT </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Payable Taka</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $shtotalfixedapayable; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Paid Taka</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $shtotalfixedapaid; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title">Due Taka</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $shtotalfixedadue; ?>" data-animation-duration="700">0</span>
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

            <?php
	            $user_id = $_SESSION['userId'];	 
	            $sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','Founder & General Secretary','Accountant','Assistant Accountant')";
	            $result = $connect->query($sql);
	            while($row = $result->fetch_array()) {
            ?>  
            <a href="sh-deposit-summary.php?ShareHolderDepositSummary">
            <?php } ?>
            <div class="col-md-3 col-sm-6">
              <div class="tiles purple m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black">SHARE HOLDER TOTAL DEPOSIT AMOUNT </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Payable Taka</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $shtotalpayable; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Paid Taka</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $shtotalpaid; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title">Due Taka</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $shtotaldue; ?>" data-animation-duration="700">0</span>
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

            <div class="col-md-3 col-sm-6">
              <div class="tiles red m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black"> SHARE HOLDER PAID AMOUNT </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Overall</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $shtotaldeposit; ?>" data- animation-duration="100">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Monthly Paid</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalpaidsh; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title">Fixed Paid</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $shtotalfixedapaid; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="progress transparent progress-small no-radius m-t-20" style="width:100%">
                   
                  </div>
                  <div class="description"> </span>
                  </div>
                </div>
              </div>
            </div>-->            

            <!--<div class="col-md-3 col-sm-6">
              <div class="tiles green m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black">INCOME FROM APPLICATION </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Overall</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalappamount; ?>" data- animation-duration="100">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Member</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalmamount; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title"> Share Holder </span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalshamount; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="progress transparent progress-small no-radius m-t-20" style="width:100%">
                   
                  </div>
                  <div class="description"> </span>
                  </div>
                </div>
              </div>
            </div>-->

            

            <?php
	            $user_id = $_SESSION['userId'];	 
	            $sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','Founder & General Secretary','Accountant','Assistant Accountant')";
	            $result = $connect->query($sql);
	            while($row = $result->fetch_array()) {
            ?>
            <a href="transection-deposit-list-info.php?id=1&DepositList">
            <?php } ?>
            <!--<div class="col-md-3 col-sm-6">
              <div class="tiles red m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black"> ALL DEPOSIT AMOUNT [MEMBER]</div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Overall</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totaldeposit; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Monthly</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $monthlytotaldeposit; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title">Today's</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $dailytotaldeposit; ?>" data-animation-duration="700">0</span>
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

            <?php
	            $user_id = $_SESSION['userId'];	 
	            $sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','Founder & General Secretary','Accountant','Assistant Accountant')";
	            $result = $connect->query($sql);
	            while($row = $result->fetch_array()) {
            ?>
            <a href="transection-deposit-list-info.php?id=2&DepositList">
            <?php } ?>
            <div class="col-md-3 col-sm-6">
              <div class="tiles purple m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black"> ALL DEPOSIT AMOUNT [SHARE HOLDER]</div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Overall</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totaldepositsh; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Monthly</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $monthlytotaldepositsh; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title">Today's</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $dailytotaldepositsh; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="progress transparent progress-small no-radius m-t-20" style="width:100%">                    
                  </div>
                  <div class="description"> </span>
                  </div>
                </div>
              </div>
            </div>
            </a>-->   
            
            <!--<a href="auth-user-list.php?AdministratorList">
            <div class="col-md-3 col-sm-6">
              <div class="tiles red m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black">ADMINISTRATOR LIST</div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Overall</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totaladministrator; ?>" data- animation-duration="100">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Approved</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totaladministratorapproved; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title">Cancel</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totaladministratorcancel; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="progress transparent progress-small no-radius m-t-20" style="width:100%">
                   
                  </div>
                  <div class="description"> </span>
                  </div>
                </div>
              </div>
            </div>
            </a>-->

            <?php if($_SESSION['Role']==1)
	          {
            ?> 
            <a href="sms-sent-info.php?SMSSentInfo">
            <?php } ?>
            <!--<div class="col-md-3 col-sm-6">
              <div class="tiles green m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black">OVERALL SMS SENT (COUNT) </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Overall</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalsmssent; ?>" data- animation-duration="100">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Monthly</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $monthlysmssent; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title"> Today's </span> <span class="item-count animate-number semi-bold" data-value="<?php echo $dailysmssent; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="progress transparent progress-small no-radius m-t-20" style="width:100%">
                   
                  </div>
                  <div class="description"> </span>
                  </div>
                </div>
              </div>
            </div>-->
            </a>           
            
            <?php if($_SESSION['Role']==1)
	          {
            ?> 
            <a href="sms-sent-info.php?SMSSentInfo">
            <?php } ?>
            <!--<div class="col-md-3 col-sm-6">
              <div class="tiles blue m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black"> OVERALL SMS SENT (PRICE) </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title"> Overall </span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalsmscost; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title"> Monthly </span> <span class="item-count animate-number semi-bold" data-value="<?php echo $monthlysmscost; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title"> Today's </span> <span class="item-count animate-number semi-bold" data-value="<?php echo $dailysmscost; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="progress transparent progress-small no-radius m-t-20" style="width:100%">
                  </div>
                  <div class="description">  </span>
                  </div>
                </div>
              </div>
            </div>-->
            </a>

            <!--<a href="application-form-list.php?ApplicantList">
            <div class="col-md-3 col-sm-6">
              <div class="tiles purple m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black">MEMBER LIST </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Overall</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalapplicant; ?>" data- animation-duration="100">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Approved</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalapplicantapproved; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title">Cancel</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalapplicantcancel; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="progress transparent progress-small no-radius m-t-20" style="width:100%">
                   
                  </div>
                  <div class="description"> </span>
                  </div>
                </div>
              </div>
            </div>
            </a>-->
            
            

            <a href="transection-expense-entry-info.php?ExpenseEntryInfo">
            <div class="col-md-3 col-sm-6">
              <div class="tiles red m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black">EXPENSE LIST</div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Overall</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalexpensecost; ?>" data- animation-duration="100">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Monthly</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $monthlyexpensecost; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title">Today's</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $dailyexpensecost; ?>" data-animation-duration="700">0</span>
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
            
            <a href="#">
            <div class="col-md-3 col-sm-6">
              <div class="tiles green m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black">BALANCE SUMMARY</div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Income</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalincome; ?>" data- animation-duration="100">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Expence</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalexpensecost; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title">Balance</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $balance; ?>" data-animation-duration="700">0</span>
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

                        <?php
	            $user_id = $_SESSION['userId'];	 
	            $sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','Founder & General Secretary','Accountant','Assistant Accountant')";
	            $result = $connect->query($sql);
	            while($row = $result->fetch_array()) {
            ?>  
            <a href="transection-donation-list-info.php?DonationList">
            <?php } ?>
            <div class="col-md-3 col-sm-6">
              <div class="tiles blue m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black"> DONATION COLLECT </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Overall</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totaldonation; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Monthly</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $monthlytotaldonation; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title">Today's</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $dailytotaldonation; ?>" data-animation-duration="700">0</span>
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

            <?php
	            $user_id = $_SESSION['userId'];	 
	            $sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','Founder & General Secretary','Accountant','Assistant Accountant')";
	            $result = $connect->query($sql);
	            while($row = $result->fetch_array()) {
            ?>  
            <a href="#">
            <?php } ?>
            <div class="col-md-3 col-sm-6">
              <div class="tiles red m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black"> DONATION EXPENCE </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Overall</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totaldonationex; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Monthly</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totaldonationexm; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title">Today's</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totaldonationexd; ?>" data-animation-duration="700">0</span>
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

            <?php
	            $user_id = $_SESSION['userId'];	 
	            $sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','Founder & General Secretary','Accountant','Assistant Accountant')";
	            $result = $connect->query($sql);
	            while($row = $result->fetch_array()) {
            ?> 
            <a href="#">
            <?php } ?>
            <div class="col-md-3 col-sm-6">
              <div class="tiles purple m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black">DONATION SUMMARY</div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Collect</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totaldonation; ?>" data- animation-duration="100">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Donate</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totaldonationex; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title">Balance</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $donetionbalance; ?>" data-animation-duration="700">0</span>
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

            <!--<a href="shareholder-list-info.php?ShareHolderInfo">
            <div class="col-md-3 col-sm-6">
              <div class="tiles red m-b-10">
                <div class="tiles-body">
                  <div class="tiles-title text-black">SHARE HOLDER LIST </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Overall</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalapplicantsh; ?>" data- animation-duration="100">0</span>
                    </div>
                  </div>
                  <div class="widget-stats">
                    <div class="wrapper transparent">
                      <span class="item-title">Approved</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalapplicantapprovedsh; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="widget-stats ">
                    <div class="wrapper last">
                      <span class="item-title">Cancel</span> <span class="item-count animate-number semi-bold" data-value="<?php echo $totalapplicantcancelsh; ?>" data-animation-duration="700">0</span>
                    </div>
                  </div>
                  <div class="progress transparent progress-small no-radius m-t-20" style="width:100%">
                   
                  </div>
                  <div class="description"> </span>
                  </div>
                </div>
              </div>
            </div>
            </a> -->         

          </div>

          <!--<div class="col-md-8 tiles white no-padding">
            <div class="tiles-body">
              <div id='calendar'></div>
            </div>
          </div>-->

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