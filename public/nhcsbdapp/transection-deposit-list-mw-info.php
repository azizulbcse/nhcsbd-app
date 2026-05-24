<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Deposit Management | Nurses Health Care Society</title>  
    <?php require_once 'layouts/HeaderDTPage.php'; ?>
    <?php include ('layouts/1-base-head.php') ?>
    
    <style>
        /* Modern UI Improvements */
        body {
            background-color: #f0f4f8 !important; /* হালকা নীলচে ব্যাকগ্রাউন্ড */
        }
        
        .page-content {
            background-color: #f0f4f8 !important;
            padding-top: 0px !important;
            min-height: 100vh;
        }

        .content {
            padding-top: 10px !important;
            padding-left: 20px !important;
            padding-right: 20px !important;
        }

        /* Top Header (নীল রঙের স্ট্রিপ) */
        .grid-title {
            border: none !important;
            background: #ffffff !important; /* সাদা ব্যাকগ্রাউন্ড */
            padding: 15px 20px !important; 
            margin-bottom: 10px !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border-radius: 8px;
        }
        
        .grid-title h3 {
            font-size: 20px !important;
            font-weight: 700 !important;
            color: #2c3e50;
            margin: 0 !important;
        }

        .semi-bold {
            color: #1abc9c; /* আকর্ষণীয় সবুজ রঙ */
        }

        /* স্মার্ট ফিল্টার বক্স (আরেকটু রঙিন) */
        .filter-wrapper {
            background: #ffffff;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            margin-bottom: 20px;
            border-left: 5px solid #3498db; /* বাম দিকে নীল বর্ডার */
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .filter-title {
            font-size: 14px;
            font-weight: 600;
            color: #34495e; /* গাঢ় রঙ */
            margin-bottom: 0px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .selectpicker-custom {
            height: 40px !important;
            border-radius: 8px !important;
            border: 1px solid #3498db !important; /* বর্ডারের রঙ নীল */
            background-color: #ecf0f1 !important; /* হালকা ধূসর-নীল ব্যাকগ্রাউন্ড */
            font-size: 14px !important;
            color: #2c3e50 !important;
        }

        /* টেবিল কার্ড */
        .table-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        #manageTraxDepositInfoTable thead th {
            background-color: #eaf2f8 !important; /* টেবিল হেডারের রঙ পরিবর্তন */
            color: #2c3e50 !important;
            font-weight: 700 !important;
            padding: 12px !important;
            font-size: 11px !important;
        }
        
        #manageTraxDepositInfoTable tbody tr:hover {
            background-color: #f5fafd !important; /* হোভার করলে হালকা নীল রঙ হবে */
        }


        /* Footer Style */
        #footer {
            background: white;
            padding: 15px;
            margin-top: 30px;
            border-top: 1px solid #eee;
            text-align: center;
        }
        
        .copyright {
            font-size: 13px;
            color: #7f8c8d;
        }
    </style>
</head>

<body class="">
    <?php include ('layouts/2-base-header.php') ?>

    <div class="page-container row-fluid">
      <?php include ('layouts/4-base-menu.php') ?>

      <div class="page-content">
        <div class="content">
          
          <!-- Page Header -->
          <div class="grid-title">
            <h3><i class="fa fa-wallet" style="color: #1abc9c;"></i> Deposit <span class="semi-bold">Management</span></h3>
          </div>                  
                        
          <!-- Filter Section -->
          <div class="filter-wrapper">
              <div class="filter-title">
                  <i class="fa fa-filter" style="color: #3498db;"></i>
                  ফিল্টার করার জন্য মাস নির্বাচন করুন
              </div>
              
              <form action="" method="get" style="margin: 0;">
                  <div class="custom-select-container">
                      <select class="form-control selectpicker selectpicker-custom" 
                              data-live-search="true" 
                              name="MemberName" 
                              onChange="this.form.submit();">
                          <option value="">📁 সকল মাসের ডাটা</option>
                          <?php
                          $sql = "SELECT mid, mname FROM tblmonthname WHERE status=2 ORDER BY mid DESC";
                          $result = $connect->query($sql);
                          while($row = $result->fetch_array()) {
                              $selected = (isset($_GET['MemberName']) && $_GET['MemberName'] == $row['mname']) ? "selected" : "";
                              echo "<option value='".$row['mname']."' $selected>📅 ".$row['mname']."</option>";
                          }
                          ?>
                      </select>
                  </div>
              </form>
          </div>

          <!-- Table Section -->
          <div class="table-card">
              <div class="table-responsive">
                  <table class="table table-hover" id="manageTraxDepositInfoTable" style="width: 100%;"> 
                      <thead>
                          <tr>
                              <th>Sl</th>
                              <th>Photo</th>
                              <th>Date</th>
                              <th>Member Name</th>  
                              <th>Type</th> 
                              <th>From</th> 
                              <th>To</th> 
                              <th>Monthly</th>  
                              <th>Fixed</th>
                              <th>Trx No</th>     
                              <th>Month</th> 
                              <th>Status</th>
                              <th style="width:10%;">Option </th>
                          </tr>              
                      </thead>
                  </table>
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

      <!-- Footer -->
      <footer id="footer">
          <div class="copyright">
              © 2026 | <a href="#" style="color: #3498db; text-decoration: none; font-weight: 700;">Matrik Solutions</a>
          </div>
      </footer>
    </div>

    <?php include ('layouts/5-base-js.php') ?> 
    <script src="custom/js/transection-deposit-list-mw-info.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>
  </body>
</html>
