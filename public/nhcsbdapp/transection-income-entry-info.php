<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html>

<head>
    <!-- Start title --> 
    <title>Others Income Entry | Nurses Health Care Society </title>  
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
                  <h3>Income Info / Others Income Entry Info </h3>
                </div>
                
                <div class="card">
				 <?php
	                $user_id = $_SESSION['userId'];	 
	                $sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','Founder & General Secretary','Accountant','Assistant Accountant')";
	                $result = $connect->query($sql);
	                while($row = $result->fetch_array()) {
	              ?>
                <small class="float-right">      
                  <button class="btn btn-default button1" data-toggle="modal" data-target="#addIncomeEntryInfoModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add Others Income Info </button>
                </small>
                <?php } ?>
                <div class="card-datatable table-responsive">
                <table class="table table-bordered" id="manageTraxIncomeInfoTable"> 
                  <thead>
				    <tr>
                        <th>Sl No</th>
			            <th>Income Date</th>  
                        <th>Income Head</th> 
                        <th>Payee Name</th> 
                        <th>Payment Type</th> 
                        <th>Amount</th>      
                        <th>Payable Amount</th>    	
                        <th>Status</th>
			            <th style="width:15%;">Option </th>
			        </tr>              
                  </thead>
                </table>

<!--Start add Income info -->
<div class="modal fade" id="addIncomeEntryInfoModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitIncomeInfoForm" action="php_action/createTrxIncomeEntryInfo.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add New Income Info </h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-income-messages"></div>

	        <div class="form-group">
	        	<label for="IncomeDate" class="col-sm-2 control-label"> Date </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="date" class="form-control" id="IncomeDate" placeholder="Income Date" name="IncomeDate" autocomplete="off">
				    </div>
	        </div>	

			<?php if($_GET['id']==1) { ?>
            <div class="form-group">
	        	<label for="HeadName" class="col-sm-2 control-label">Head Name</label>
	        	<label class="col-sm-1 control-label">:</label>
				    <div class="col-sm-8">
                    <select class="form-control selectpicker"  data-live-search="true" id="HeadName" name="HeadName">
				      	<option value="">~~PLEASE SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT accHeadId, accHeadName FROM tblacchead WHERE accGroupId=1 AND status=1 AND accHeadId=5";
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while								
				      	?>
				      </select>
				    </div>
            </div>
			<?php } ?>

          <?php if($_GET['id']==2) { ?>
            <div class="form-group">
	        	<label for="HeadName" class="col-sm-2 control-label">Head Name</label>
	        	<label class="col-sm-1 control-label">:</label>
				    <div class="col-sm-8">
                    <select class="form-control selectpicker"  data-live-search="true" id="HeadName" name="HeadName">
				      	<option value="">~~PLEASE SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT accHeadId, accHeadName FROM tblacchead WHERE accGroupId=1 AND status=1 AND accHeadId!=5";
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while								
				      	?>
				      </select>
				    </div>
            </div>
			<?php } ?>			
            
			<?php if($_GET['id']==1) { ?>
            <!--<div class="form-group">
	        	<label for="PayeeName" class="col-sm-2 control-label">Despatcher Name</label>
	        	<label class="col-sm-1 control-label">:</label>
				    <div class="col-sm-8">
                    <select class="form-control selectpicker"  data-live-search="true" id="PayeeName" name="PayeeName" onChange="getCustomerData(this)">
				      	<option value="">~~PLEASE SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT mid PayeeName,name_english FROM tblapplication4resign t4r, tblapplicantinfo ta WHERE t4r.creator_id=ta.mid AND t4r.status=2";
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while								
				      	?>
				      </select>
				    </div>
            </div>-->

			<div class="form-group">
	        	<label for="CustomerId" class="col-sm-2 control-label">Despatcher Name</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
                      <select class="form-control selectpicker" data-live-search="true" id="CustomerId" name="CustomerId" onChange="getCustomerData(this)">
				      	<option value="">~~SELECT~~</option>
				      	<?php 
						$sql = "SELECT mid customerid,name_english FROM tblapplication4resign t4r, tblapplicantinfo ta WHERE t4r.creator_id=ta.mid AND t4r.status=2";
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) { 
								echo "<option value='".$row['0']."'>".$row['1']."</option>";
								}
				      	?>
				      </select>
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="DepositAmount" class="col-sm-2 control-label">Deposit Amount </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input onKeyUp="deductamount()" type="number" class="form-control" id="DepositAmount" placeholder="Deposit Amount" name="DepositAmount" required="" readonly=true>
					  <input type="hidden" class="form-control" id="PrevdueValue" name="PrevdueValue" />
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="Amount" class="col-sm-2 control-label">Deduction Amount </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input onKeyUp="deductamount()" type="number" class="form-control" id="Amount" placeholder="Amount" name="Amount" autocomplete="off">
					  <input type="hidden" class="form-control" id="AmountValue" name="AmountValue" />
				    </div>
	        </div>
			<?php } ?>

			<?php if($_GET['id']==2) { ?>
            <div class="form-group">
	        	<label for="CustomerId" class="col-sm-2 control-label">Payee Name</label>
	        	<label class="col-sm-1 control-label">:</label>
				    <div class="col-sm-8">
                    <select class="form-control selectpicker"  data-live-search="true" id="CustomerId" name="CustomerId">
				      	<option value="">~~PLEASE SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT payeeId, payeeName FROM tblaccpayto WHERE status=1";
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while								
				      	?>
				      </select>
				    </div>
            </div>

			<div class="form-group">
	        	<label for="Amount" class="col-sm-2 control-label"> Amount </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" id="Amount" placeholder="Amount" name="Amount" autocomplete="off">
				    </div>
	        </div>
			<?php } ?>

            <div class="form-group">
	        	<label for="PaymentType" class="col-sm-2 control-label">Payment Type </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control selectpicker" data-live-search="true" id="PaymentType" name="PaymentType">
				      	<option value="">~~SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT PaymentTypeId, PaymentType FROM  tblpaymenttype WHERE status=1";
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[1]."'>".$row[1]."</option>";
								} // while								
				      	?>
				      </select>
				    </div>
	        </div>	
      	        
	        <div class="form-group">
	        	<label for="Remarks" class="col-sm-2 control-label">Remarks </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="Remarks" placeholder="Remarks" name="Remarks" autocomplete="off">
				    </div>
	        </div>
	                 	        

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Close </button>
	        <button type="submit" class="btn btn-primary" id="createIncomeInfoBtn" data-loading-text="Loading..." autocomplete="off"><i class="glyphicon glyphicon-ok-sign"></i>Save Change</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!--End add Income info -->
<?php
	$user_id = $_SESSION['userId'];	 
	$sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','Founder & General Secretary','Accountant','Assistant Accountant')";
	$result = $connect->query($sql);
	while($row = $result->fetch_array()) {
?>
<!--Start edit Income info -->
<?php if($_GET['id']==2) { ?>
<div class="modal fade" id="editIncomeInfoModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editIncomeInfoForm" action="php_action/editTrxIncomeEntryInfo.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Income Info </h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-incomeinfo-messages"></div>

	      	        <div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-incomeinfo-result">
            <div class="form-group">
	        	<label for="editIncomeDate" class="col-sm-2 control-label"> Date </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="date" class="form-control" id="editIncomeDate" placeholder="Income Date" name="editIncomeDate" autocomplete="off">
				    </div>
	        </div>	   
          
            <div class="form-group">
	        	<label for="editHeadName" class="col-sm-2 control-label">Head Name</label>
	        	<label class="col-sm-1 control-label">:</label>
				    <div class="col-sm-8">
                    <select class="form-control" id="editHeadName" name="editHeadName">
				      	<option value="">~~PLEASE SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT accHeadId, accHeadName FROM tblacchead WHERE accGroupId=1 AND status=1";
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while								
				      	?>
				      </select>
				    </div>
            </div>

            <div class="form-group">
	        	<label for="editPayeeName" class="col-sm-2 control-label">Payee Name</label>
	        	<label class="col-sm-1 control-label">:</label>
				    <div class="col-sm-8">
                    <select class="form-control" id="editPayeeName" name="editPayeeName">
				      	<option value="">~~PLEASE SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT payeeId, payeeName FROM tblaccpayto WHERE status=1";
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while								
				      	?>
				      </select>
				    </div>
            </div>

          <div class="form-group">
	        	<label for="editPaymentType" class="col-sm-2 control-label">Payment Type </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="editPaymentType" name="editPaymentType" onChange="getbankDetails(this)">
				      	<option value="">~~SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT PaymentTypeId, PaymentType FROM  tblpaymenttype WHERE status=1";
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[1]."'>".$row[1]."</option>";
								} // while								
				      	?>
				      </select>
				    </div>
	        </div>

            <div class="form-group">
	        	<label for="editAmount" class="col-sm-2 control-label">Amount </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" id="editAmount" placeholder="Amount" name="editAmount" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	         	        
	                 	        
	        <div class="form-group">
	        	<label for="editRemarks" class="col-sm-2 control-label">Remarks </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editRemarks" placeholder="Remarks" name="editRemarks" autocomplete="off">
				    </div>
	        </div>
		       
		      </div>         	        
		      <!-- /edit brand result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editIncomeInfoFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close </button>
	        
	        <button type="submit" class="btn btn-success" id="editIncomeInfoBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Change </button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!--End edit Income info -->
<?php } ?>
<!--Start Post Income info -->
<div class="modal fade" tabindex="-1" role="dialog" id="postedIncomeInfoModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-ok"></i> Posted Income Info</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to Posting this Income ?</p>
      </div>
      <div class="modal-footer postedIncomeInfoFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="postedIncomeInfoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--End Post Income info -->

<!--Start Delete Income info -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeIncomeInfoModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Income Info </h4>
      </div>
      <div class="modal-body">
        <p>Do you want to delete this info?</p>
      </div>
      <div class="modal-footer removeIncomeInfoFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeIncomeInfoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Change</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!--End Delete Income info -->
<?php } ?>     
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
    <script src="custom/js/transection-income-info-resign.js"></script>
	<?php } ?>
	<?php if($_GET['id']==2) { ?>
    <script src="custom/js/transection-income-info.js"></script>
	<?php } ?>
    <?php include ('layouts/FooterDTPage.php') ?>
  </body>
</html>