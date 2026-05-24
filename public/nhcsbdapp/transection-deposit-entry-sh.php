<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html>

<head>
    <!-- Start title --> 
    <title>Deposit Entry | Nurses Health Care Society </title>  
    <!-- End title --> 

    <!-- Start Header Base-->
    <?php require_once 'layouts/HeaderDTPage.php'; ?>
    <?php include ('layouts/1-base-head.php') ?>
    <!-- End Header Base --> 
</head>
  <!-- END HEAD -->

  <body class="">
    <!-- BEGIN HEADER -->
	<?php if($_SESSION['Role']==0)
	{
    ?>
    <?php include ('layouts/2-base-header-member.php') ?>
	<?php } ?>

	<?php if($_SESSION['Role']==2)
	{
    ?>
    <?php include ('layouts/2-base-header-sh.php') ?>
	<?php } ?>
    <!-- END HEADER -->

    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
      <!-- BEGIN SIDEBAR -->
	  <?php if($_SESSION['Role']==2)
	  {
      ?>
      <?php include ('layouts/4-base-menu-sh.php') ?>
	  <?php } ?>
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
                  <h3>Deposit Info / Self Deposit Entry List </h3>
                </div>
                
                <div class="card">
                <small class="float-right">      
                  <button class="btn btn-default button1" data-toggle="modal" data-target="#addDepositEntryInfoModel"> <i class="glyphicon glyphicon-plus-sign"></i> Self Deposit Entry </button>
                </small>
                
                <div class="card-datatable table-responsive">
                <table class="table table-bordered" id="manageTraxDepositInfoTable"> 
                  <thead>
				    <tr>
                        <th>Sl No</th>
						<th>Member Photo</th> 
			            <th>Deposit Date</th>  
                        <th>Deposit Type</th> 
						<th>Deposit From</th> 
                        <th>Deposit To</th> 
                        <th>Monthly Amount</th>  
						<th>Fixed Amount</th>
						<th>Trx </br> No</th>     
                        <th>Month Name</th>    	
                        <th>Status</th>
			            <th style="width:15%;"> Option </th>
			        </tr>              
                  </thead>
                </table>

<!--Start add Deposit info -->
<div class="modal fade" id="addDepositEntryInfoModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
	    <?php if($_GET['id']==1) { ?>
    	<form class="form-horizontal" id="submitDepositInfoForm" action="php_action/createDepositCashEntryInfo.php" method="POST">
		<?php } ?>
		<?php if($_GET['id']==2) { ?>
    	<form class="form-horizontal" id="submitDepositInfoForm" action="php_action/createDepositOnlineEntryInfo.php" method="POST">
		<?php } ?>
		<?php if($_GET['id']==3) { ?>
    	<form class="form-horizontal" id="submitDepositInfoForm" action="php_action/createDepositMBEntryInfo.php" method="POST">
		<?php } ?>
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> New Deposit Info </h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-deposit-messages"></div>

	        <div class="form-group">
	        	<label for="DepositDate" class="col-sm-2 control-label"> Deposit Date </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="date" class="form-control" id="DepositDate" placeholder="Deposit Date" name="DepositDate" autocomplete="off">
				    </div>
	        </div>	
            <?php if($_GET['id']==1) { ?>
			<div class="form-group">
	        	<label for="DepositTo" class="col-sm-2 control-label"> Payment To </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
                       <select class="form-control selectpicker" data-live-search="true" id="DepositTo" name="DepositTo">
				      	<option value="">~~PLEASE SELECT~~</option>
				      	    <?php 								
                                $sql = "SELECT user_id,fullname FROM tbladminuser where status=2 AND user_id!=1 Order by user_id ASC" ;
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[1]."'>".$row[1]."</option>";
								} 								
				      	    ?>
				        </select>
				    </div>
            </div>			
			<?php } ?>

			<?php if($_GET['id']==2) { ?>
			<div class="form-group">
	        	<label for="DepositForm" class="col-sm-2 control-label"> Deposit From </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="DepositForm" placeholder="যে ব্যাংক থেকে টাকা পাঠানো হইছে" name="DepositForm" autocomplete="on">
				    </div>
	        </div>
          
			<div class="form-group">
	        	<label for="DepositTo" class="col-sm-2 control-label"> Deposit To </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" value="City Bank PLC-2304110322001" id="DepositTo" placeholder="যে ব্যাংক এ টাকা পাঠানো হইছে" name="DepositTo" autocomplete="on" readonly="false">
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="TrxNo" class="col-sm-2 control-label"> Slip No </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="TrxNo" placeholder="স্লিপ নং" name="TrxNo" autocomplete="off">
				    </div>
	        </div>
			<?php } ?>

			<?php if($_GET['id']==3) { ?>
			<div class="form-group">
	        	<label for="PaymentType" class="col-sm-2 control-label">Payment Type </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control selectpicker" data-live-search="true" id="PaymentType" name="PaymentType">
				      	<option value="">~~SELECT~~</option>
				      	<?php 
				      	    $sql = "SELECT PaymentTypeId, PaymentType FROM tblpaymenttype WHERE PaymentType NOT IN('Cash','Online Cash Deposit') AND status=1;";
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[1]."'>".$row[1]."</option>";
								} // while								
				      	?>
				      </select>
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="DepositForm" class="col-sm-2 control-label"> Deposit From </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="DepositForm" placeholder="যে নং থেকে টাকা পাঠানো হইছে" name="DepositForm" autocomplete="on">
				    </div>
	        </div>
          
			<div class="form-group">
	        	<label for="DepositTo" class="col-sm-2 control-label"> Deposit To </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="DepositTo" placeholder="যে নং এ টাকা পাঠানো হইছে" name="DepositTo" autocomplete="on">
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="TrxNo" class="col-sm-2 control-label"> Tnx No </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="TrxNo" placeholder="ট্রাঞ্জেকশন নং" name="TrxNo" autocomplete="off">
				    </div>
	        </div>
			<?php } ?>

			<div class="form-group">
	        	<label for="DepositAmount" class="col-sm-2 control-label">Deposit Amount </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" id="DepositAmount" value="2000.00" placeholder="টাকার পরিমাণ" name="DepositAmount">
				    </div>
	        </div>
			
			<div class="form-group">
	        	<label for="Remarks" class="col-sm-2 control-label"> Deposit Month </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control selectpicker" data-live-search="true" id="Remarks" name="Remarks">
				      	<option value="">~~কোন মাসের টাকা~~</option>
				      	<?php 
				      	    $sql = "SELECT mname FROM tblmonthname WHERE status=2 AND year=(SELECT YEAR(CURDATE())) ORDER BY mid DESC";
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[0]."</option>";
								} // while								
				      	?>
				      </select>
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="YearlyAmount" class="col-sm-2 control-label"> Fixed Amount </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control selectpicker" data-live-search="true" id="YearlyAmount" name="YearlyAmount">
				      	<option value="">~~এককালীন টাকা~~</option>
				      	<?php 
				      	    $sql = "SELECT yearlyamount FROM tblyearlyamount WHERE status=2 ORDER BY yid DESC";
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[0]."</option>";
								} // while								
				      	?>
				      </select>
				    </div>
	        </div>

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Close </button>
	        <button type="submit" class="btn btn-primary" id="createDepositInfoBtn" data-loading-text="Loading..." autocomplete="off"><i class="glyphicon glyphicon-ok-sign"></i>Save Change</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!--End add Deposit info -->

<!--Start edit Deposit info -->
<div class="modal fade" id="editDepositEntryInfoModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
	    <?php if($_GET['id']==1) { ?>
    	<form class="form-horizontal" id="editDepositEntryInfoForm" action="php_action/editDepositCashEntryInfo.php" method="POST">
		<?php } ?>
		<?php if($_GET['id']==2) { ?>
    	<form class="form-horizontal" id="editDepositEntryInfoForm" action="php_action/editDepositOnlineCashEntryInfo.php" method="POST">
		<?php } ?>
		<?php if($_GET['id']==3) { ?>
    	<form class="form-horizontal" id="editDepositEntryInfoForm" action="php_action/editDepositMBEntryInfo.php" method="POST">
		<?php } ?>
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Deposit Entry Info</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-depositentry-messages"></div>

	      	        <div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-depositentry-result">

		    <div class="form-group">
		        <label for="editDepositDate" class="col-sm-2 control-label"> Date </label>
		        	<label class="col-sm-1 control-label">: </label>
					<div class="col-sm-8">
					    <input type="date" class="form-control" id="editDepositDate" placeholder="Bank Name" name="editDepositDate" autocomplete="off">
					</div>
		    </div>   
			<?php if($_GET['id']==1) { ?>
			<div class="form-group">
	        	<label for="editDepositTo" class="col-sm-2 control-label"> Payment To </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
                       <select class="form-control" id="editDepositTo" name="editDepositTo">
				      	<option value="">~~PLEASE SELECT~~</option>
				      	    <?php 								
                                $sql = "SELECT user_id,fullname FROM tbladminuser where status=2 AND user_id!=1 Order by user_id ASC" ;
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[1]."'>".$row[1]."</option>";
								} 								
				      	    ?>
				        </select>
				    </div>
            </div>
			<?php } ?>

			<?php if($_GET['id']==2) { ?>
			<div class="form-group">
	        	<label for="editDepositForm" class="col-sm-2 control-label"> Deposit From </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editDepositForm" placeholder="যে ব্যাংক থেকে টাকা পাঠানো হইছে" name="editDepositForm" autocomplete="on">
				    </div>
	        </div>
          
			<div class="form-group">
	        	<label for="editDepositTo" class="col-sm-2 control-label"> Deposit To </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" value="City Bank PLC-2304110322001" id="editDepositTo" placeholder="যে ব্যাংক এ টাকা পাঠানো হইছে" name="editDepositTo" autocomplete="on" readonly="false">
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="editTrxNo" class="col-sm-2 control-label"> Slip No </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editTrxNo" placeholder="স্লিপ নং" name="editTrxNo" autocomplete="off">
				    </div>
	        </div>
			<?php } ?>

			<?php if($_GET['id']==3) { ?>
			<div class="form-group">
	        	<label for="editPaymentType" class="col-sm-2 control-label">Payment Type </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="editPaymentType" name="editPaymentType">
				      	<option value="">~~SELECT~~</option>
				      	<?php 
				      	    $sql = "SELECT PaymentTypeId, PaymentType FROM tblpaymenttype WHERE PaymentType NOT IN('Cash','Online Cash Deposit') AND status=1;";
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[1]."'>".$row[1]."</option>";
								} // while								
				      	?>
				      </select>
				    </div>
	        </div>
			<div class="form-group">
	        	<label for="editDepositForm" class="col-sm-2 control-label"> Deposit From </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editDepositForm" placeholder="যে নং থেকে টাকা পাঠানো হইছে" name="editDepositForm" autocomplete="on">
				    </div>
	        </div>
          
			<div class="form-group">
	        	<label for="editDepositTo" class="col-sm-2 control-label"> Deposit To </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editDepositTo" placeholder="যে নং এ টাকা পাঠানো হইছে" name="editDepositTo" autocomplete="on">
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="editTrxNo" class="col-sm-2 control-label"> Tnx No </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editTrxNo" placeholder="ট্রাঞ্জেকশন নং" name="editTrxNo" autocomplete="off">
				    </div>
	        </div>
			<?php } ?>

			<div class="form-group">
	        	<label for="editDepositAmount" class="col-sm-2 control-label"> Deposit Amount </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" id="editDepositAmount" placeholder="টাকার পরিমাণ" name="editDepositAmount">
				    </div>
	        </div>

			<!--<div class="form-group">
	        	<label for="editRemarks" class="col-sm-2 control-label"> Remarks </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editRemarks" placeholder="নোট" name="editRemarks" autocomplete="off">
				    </div>
	        </div>-->

			<div class="form-group">
	        	<label for="editRemarks" class="col-sm-2 control-label"> Deposit Month </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="editRemarks" name="editRemarks">
				      	<option value="">~~কোন মাসের টাকা~~</option>
				      	<?php 
				      	    $sql = "SELECT mname FROM tblmonthname WHERE status=2 AND year=(SELECT YEAR(CURDATE())) ORDER BY mid DESC";
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[0]."</option>";
								} // while								
				      	?>
				      </select>
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="editYearlyAmount" class="col-sm-2 control-label"> Fixed Amount </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="editYearlyAmount" name="editYearlyAmount">
				      	<option value="">~~এককালীন টাকা~~</option>
				      	<?php 
				      	    $sql = "SELECT yearlyamount FROM tblyearlyamount WHERE status=2 ORDER BY yid DESC";
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[0]."</option>";
								} // while								
				      	?>
				      </select>
				    </div>
	        </div>
		       
		    </div>         	        

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editDepositEntryInfoFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>	        
	        <button type="submit" class="btn btn-success" id="editDepositEntryInfoBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!--End edit Deposit info -->                  
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
	<?php if($_GET['id']==1) { ?>
		<script src="custom/js/transection-deposit-cashsh-entry-info.js"></script>
    <?php } ?>
	<?php if($_GET['id']==2) { ?>
		<script src="custom/js/transection-deposit-onlinecashsh-entry-info.js"></script>
    <?php } ?>
	<?php if($_GET['id']==3) { ?>
		<script src="custom/js/transection-deposit-mb-entrysh-info.js"></script>
    <?php } ?>

    <?php include ('layouts/FooterDTPage.php') ?>
  </body>
</html>