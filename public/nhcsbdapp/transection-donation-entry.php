<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html>

<head>
    <!-- Start title --> 
    <title>Donation Entry | Nurses Health Care Society </title>  
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
                  <h3>Income Info / Donation Entry </h3>
                </div>
                
                <div class="card">
                <small class="float-right">      
                  <button class="btn btn-default button1" data-toggle="modal" data-target="#addDonationEntryInfoModel"> <i class="glyphicon glyphicon-plus-sign"></i> Donation Entry </button>
                </small>
                
                <div class="card-datatable table-responsive">
                <table class="table table-bordered" id="manageTraxDonateInfoTable"> 
                  <thead>
				    <tr>
                        <th>Sl No</th>
			            <th>Donate Date</th>  
                        <th>Payment Type</th> 
						<th>Payment From</th> 
                        <th>Payment To</th> 
                        <th>Amount</th>  
						<th>Trx No</th>     
                        <th>Remarks</th>    	
                        <th>Status</th>
			            <th style="width:15%;">Option </th>
			        </tr>              
                  </thead>
                </table>

<!--Start add Donation info -->
<div class="modal fade" id="addDonationEntryInfoModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitDonationInfoForm" action="php_action/createTrxDonateEntryInfo.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add New Donation Info </h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-donation-messages"></div>

	        <div class="form-group">
	        	<label for="DonateDate" class="col-sm-2 control-label"> Date </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="date" class="form-control" id="DonateDate" placeholder="Donate Date" name="DonateDate" autocomplete="off">
				    </div>
	        </div>	

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
	        	<label for="DonateFrom" class="col-sm-2 control-label"> Donate From </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="DonateFrom" placeholder="যে নং থেকে টাকা পাঠানো হইছে" name="DonateFrom" autocomplete="on">
				    </div>
	        </div>
          
			<div class="form-group">
	        	<label for="DonateTo" class="col-sm-2 control-label"> Donate To </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="DonateTo" placeholder="যে নং এ টাকা পাঠানো হইছে" name="DonateTo" autocomplete="on">
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="DonateAmount" class="col-sm-2 control-label"> Amount </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" id="DonateAmount" placeholder="টাকার পরিমাণ" name="DonateAmount" autocomplete="on">
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="TrxNo" class="col-sm-2 control-label"> Tnx No </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="TrxNo" placeholder="ট্রাঞ্জেকশন নং" name="TrxNo" autocomplete="off">
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="Remarks" class="col-sm-2 control-label"> Remarks </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="Remarks" placeholder="নোট" name="Remarks" autocomplete="off">
				    </div>
	        </div>					

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Close </button>
	        <button type="submit" class="btn btn-primary" id="createDonationInfoBtn" data-loading-text="Loading..." autocomplete="off"><i class="glyphicon glyphicon-ok-sign"></i>Save Change</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!--End add Donation info -->

<!--Start edit Donation info -->
<div class="modal fade" id="editDonateEntryInfoModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editDonationEntryInfoForm" action="php_action/editTrxDonationEntryInfo.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Donation Entry Info</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-donationentry-messages"></div>

	      	        <div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-donationentry-result">

		      	<div class="form-group">
		        	<label for="editDonateDate" class="col-sm-2 control-label"> Date </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="date" class="form-control" id="editDonateDate" placeholder="Bank Name" name="editDonateDate" autocomplete="off">
					    </div>
		        </div>    
				
			<div class="form-group">
	        	<label for="editPaymentType" class="col-sm-2 control-label">Payment Type </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="editPaymentType" name="editPaymentType">
				      	<option value="">~~SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT PaymentTypeId, PaymentType FROM tblpaymenttype WHERE status=1";
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[1]."'>".$row[1]."</option>";
								} // while								
				      	?>
				      </select>
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="editDonateFrom" class="col-sm-2 control-label"> Donate From </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editDonateFrom" placeholder="যে নং থেকে টাকা পাঠানো হইছে" name="editDonateFrom" autocomplete="on">
				    </div>
	        </div>
          
			<div class="form-group">
	        	<label for="editDonateTo" class="col-sm-2 control-label"> Donate To </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editDonateTo" placeholder="যে নং এ টাকা পাঠানো হইছে" name="editDonateTo" autocomplete="on">
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="editDonateAmount" class="col-sm-2 control-label"> Amount </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" id="editDonateAmount" placeholder="টাকার পরিমাণ" name="editDonateAmount" autocomplete="on">
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="editTrxNo" class="col-sm-2 control-label"> Tnx No </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editTrxNo" placeholder="ট্রাঞ্জেকশন নং" name="editTrxNo" autocomplete="off">
				    </div>
	        </div>

			<div class="form-group">
	        	<label for="editRemarks" class="col-sm-2 control-label"> Remarks </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editRemarks" placeholder="নোট" name="editRemarks" autocomplete="off">
				    </div>
	        </div>
		       
		      </div>         	        

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editDonationEntryInfoFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>	        
	        <button type="submit" class="btn btn-success" id="editDonationEntryInfoBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!--End edit Donation info -->

<!--Start Post Donation info -->
<div class="modal fade" tabindex="-1" role="dialog" id="postedExpenseInfoModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-ok"></i> Posted Expense Info</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to Posting this Expense ?</p>
      </div>
      <div class="modal-footer postedExpenseInfoFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="postedExpenseInfoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--End Post Donation info -->

<!--Start Delete Donation info -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeExpenseInfoModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Expense Info </h4>
      </div>
      <div class="modal-body">
        <p>Do you want to delete this info?</p>
      </div>
      <div class="modal-footer removeExpenseInfoFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeExpenseInfoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Change</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!--End Delete Donation info -->
                  
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
    <script src="custom/js/transection-donate-entry-info.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>
  </body>
</html>