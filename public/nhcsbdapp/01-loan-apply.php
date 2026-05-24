<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html>

<head>
    <!-- Start title --> 
    <title>Apply For Loan | Nurses Health Care Society </title>  
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
                  <h3>Application Info / Loan Application</h3>
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
                    ঋণের জন্য আবেদন করুন, এ ক্লিক করে  প্রয়োজনীয় তথ্য দিয়ে ফর্ম পূরণ করুন! 
                </p>
                
                <div class="d-flex justify-content-between align-items-center">
                    <span class="warning-text text-danger">
                        <i class="fas fa-exclamation-triangle me-1"></i> 
                        আবেদন করার আগে অবশ্যই প্রোফাইল আপডেট করুন।
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
                <div class="card">                  
                <small class="float-right">
     
                  <button class="btn btn-default button1" data-toggle="modal" data-target="#addLoanAppInfoModel"> <i class="glyphicon glyphicon-plus-sign"></i> ঋণের জন্য আবেদন করুন </button>
                  
                </small>
                
                <div class="card-datatable table-responsive">
                <table class="table table-bordered" id="manageLoanApplicationInfoTable"> 
                  <thead>
				    <tr>
                        <th>Sl No</th>
                        <th>Apply Date</th>
                        <th> Guarantor's Name </th>
			                  <th>Loan Type</th>
                        <th> Loan Amount </th>
                        <th> Interest Rate (%) </th>
                        <th> Loan Tenure </th>
                        <th> Monthly EMI </th> 
                        <th> Interest </th>
                        <th> Payment </th>
                        <th>Member Status</th>
                        <th>President Status</th>   
                        <th>Sec. General Status</th>  
                        <th>Accountened Status</th>       	
			            <th style="width:15%;">Option </th>
			        </tr>              
                  </thead>
                </table>             

<!--Start add Resignation Reasons info -->
<div class="modal fade" id="addLoanAppInfoModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitLoanAppInfoForm" action="php_action/createApp4Loan.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Apply for Loan </h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-loanappinfo-messages"></div>            

            <div class="form-group">
	        	<label for="LoanApplicationDate" class="col-sm-2 control-label"> Application Date </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="date" class="form-control" id="LoanApplicationDate" placeholder="Date" name="LoanApplicationDate" autocomplete="off">
				    </div>
	        </div>

            <div class="form-group">
	        	<label for="GuarantorName" class="col-sm-2 control-label"> Guarantor's Name </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
                <select class="form-control selectpicker" data-live-search="true" id="GuarantorName" name="GuarantorName">
				      	<option value="">~~PLEASE SELECT~~</option>
				      	<?php 								
                $sql = "SELECT mid,name_english,mobileno FROM tblapplicantinfo where status=2 Order by name_english ASC" ;
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
								echo "<option value='".$row[1]."'>".$row[1]."</option>";
								} 								
				      	?>
				        </select>
				    </div>
            </div>

        	<div class="form-group">
	        	<label for="LoanType" class="col-sm-2 control-label"> Loan Type </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
                <select class="form-control selectpicker" data-live-search="true" id="LoanType" name="LoanType">
				      	<option value="">~~PLEASE SELECT~~</option>
				      	<?php 								
                $sql = "SELECT rrid,loantype FROM tblloantypeinfo where status=1 Order by loantype ASC" ;
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
								echo "<option value='".$row[1]."'>".$row[1]."</option>";
								} 								
				      	?>
				        </select>
				    </div>
            </div> 

          <!-- Amount Input -->
<div class="form-group">
    <label for="LoanAmount" class="col-sm-2 control-label"> Loan Amount (টাকা) </label>
    <label class="col-sm-1 control-label">: </label>
    <div class="col-sm-8">
        <input type="number" class="form-control" id="LoanAmount" placeholder="Loan Amount (টাকা)" name="LoanAmount" oninput="calculateEMI()">
        <p id="amount-in-words" style="font-size: 12px; color: #00adef; margin-top: 8px; font-style: italic; font-weight: bold;"></p>
    </div>
</div>

<div class="form-group">
    <label for="InterestRate" class="col-sm-2 control-label"> Interest Rate (%) </label>
    <label class="col-sm-1 control-label">: </label>
    <div class="col-sm-8">
        <input type="flot" class="form-control" id="InterestRate" placeholder="Interest Rate (2.5%)" name="InterestRate" oninput="calculateEMI()">
    </div>
</div>

<!-- Tenure Input -->
<div class="form-group">
    <label for="LoanTenure" class="col-sm-2 control-label"> Tenure (Months) </label>
    <label class="col-sm-1 control-label">: </label>
    <div class="col-sm-8">
        <input type="number" class="form-control" id="LoanTenure" placeholder="Enter Months (e.g. 12)" name="LoanTenure" oninput="calculateEMI()">
    </div>
</div>

                <div class="emi-result-container" style="background: #1b1e24; color: white; padding: 25px; border-radius: 8px; margin-top: 20px; border: 1px solid #333;">
                    
                    <h5 class="text-center" style="color: #8b9199; margin-bottom: 5px;">Monthly EMI</h5>
                    <h2 id="emi-output" class="text-center" style="font-weight: bold; color: #00adef !important; margin-top: 0; font-size: 36px;">0.00</h2>
                    <p id="emi-in-words" class="text-center" style="font-size: 11px; color: #aaa; text-transform: capitalize; font-style: italic;"></p>
                    <input type="hidden" name="MonthlyEMI" id="MonthlyEMI" />
                    <hr style="border-top: 1px dashed #444;">
                    
                    <div class="row text-center">
                        <div class="col-md-6 col-xs-6">
                            <p style="font-size: 12px; color: #8b9199; margin-bottom: 0;">Total Interest</p>
                            <span id="total-interest" style="font-weight: bold; font-size: 18px;">0.00</span>
                            <input type="hidden" name="TotalInterest" id="TotalInterest" />
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <p style="font-size: 12px; color: #8b9199; margin-bottom: 0;">Total Payment</p>
                            <span id="total-payment" style="font-weight: bold; font-size: 18px;">0.00</span>
                            <input type="hidden" name="TotalPayment" id="TotalPayment" />
                        </div>
                    </div>
                </div>

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>	        
	        <button type="submit" class="btn btn-primary" id="createLoanApplicationInfoBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!--End add Resignation Reasons info -->

<!--Start Post Deposit info -->
<div class="modal fade" tabindex="-1" role="dialog" id="postedResignInfoModel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-ok"></i> Send Loan Application </h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to Send this Loan Application?</p>
      </div>
      <div class="modal-footer postedResignInfoFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="postedResignInfoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--End Post Deposit info -->

<!--Start Delete Resignation Reasons info -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeResignInfoModel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Loan Application </h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeResignInfoFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeResignInfoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!--End Delete Resignation Reasons info -->

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
    <script src="custom/js/01-loan-application.js"></script>
    <script>
function convertToTakaWords(number) {
    if (number == 0) return 'Zero Taka';
    number = Math.floor(number);
    const ones = ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
    const tens = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

    function getWords(n) {
        if (n < 20) return ones[n];
        if (n < 100) return tens[Math.floor(n / 10)] + (n % 10 !== 0 ? ' ' + ones[n % 10] : '');
        if (n < 1000) return ones[Math.floor(n / 100)] + ' hundred' + (n % 100 !== 0 ? ' and ' + getWords(n % 100) : '');
        return '';
    }

    let words = '';
    if (Math.floor(number / 10000000) > 0) { words += getWords(Math.floor(number / 10000000)) + ' crore '; number %= 10000000; }
    if (Math.floor(number / 100000) > 0) { words += getWords(Math.floor(number / 100000)) + ' lakh '; number %= 100000; }
    if (Math.floor(number / 1000) > 0) { words += getWords(Math.floor(number / 1000)) + ' thousand '; number %= 1000; }
    if (Math.floor(number) > 0) { words += getWords(Math.floor(number)); }

    return words.trim().toUpperCase() + ' TAKA ONLY';
}

function calculateEMI() {
    const principal = parseFloat(document.getElementById('LoanAmount').value) || 0;
    const interestRate = parseFloat(document.getElementById('InterestRate').value) || 0;
    const tenure = parseFloat(document.getElementById('LoanTenure').value) || 0;

    if (principal > 0) {
        document.getElementById('amount-in-words').innerText = "In Words: " + convertToTakaWords(principal);
    }

    if (principal > 0 && interestRate > 0 && tenure > 0) {
        let monthlyInterest = (interestRate / 100) / 12;
        let emi = (principal * monthlyInterest * Math.pow(1 + monthlyInterest, tenure)) / (Math.pow(1 + monthlyInterest, tenure) - 1);
        let totalPayment = emi * tenure;
        let totalInterest = totalPayment - principal;

        document.getElementById('emi-output').innerText = emi.toFixed(2);
        document.getElementById('total-interest').innerText = totalInterest.toFixed(2);
        document.getElementById('total-payment').innerText = totalPayment.toFixed(2);
        document.getElementById('emi-in-words').innerText = "(" + convertToTakaWords(emi) + ")";

                // ২. হিডেন ফিল্ডে ডেটা সেট করা (এটিই ডাটাবেজে যাবে)
        document.getElementById('MonthlyEMI').value = emi.toFixed(2);
        document.getElementById('TotalInterest').value = totalInterest.toFixed(2);
        document.getElementById('TotalPayment').value = totalPayment.toFixed(2);

        console.log("Hidden Fields Updated: ", emi); // চেক করার জন্য
    }
}
</script>
    <?php include ('layouts/FooterDTPage.php') ?>
  </body>
</html>