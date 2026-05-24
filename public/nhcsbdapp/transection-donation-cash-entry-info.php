<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html>

<head>
    <!-- Start title --> 
    <title>Cash Donation Entry | Nurses Health Care Society </title>  
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
                  <h3>Income Info / Cash Donation Entry </h3>
                </div>
                
                <div class="card">
                <?php
	                $user_id = $_SESSION['userId'];	 
	                $sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','Founder & General Secretary','Accountant','Assistant Accountant')";
	                $result = $connect->query($sql);
	                while($row = $result->fetch_array()) {
	              ?>
                <small class="float-right">      
                  <button class="btn btn-default button1" data-toggle="modal" data-target="#addCashEntryInfoModel"> <i class="glyphicon glyphicon-plus-sign"></i> Cash Donation Entry </button>
                </small>
                <?php } ?>
                <div class="card-datatable table-responsive">
                <table class="table table-bordered" id="manageTraxCashInfoTable"> 
                  <thead>
				    <tr>
                        <th>Sl No</th>
					    <th>Photo</th>
			            <th>Date</th>
						<th>Member's Name</th>  
                        <th>Payment Type</th> 
						<!--<th>Payment From</th> 
                        <th>Payment To</th>--> 
                        <th>Amount</th>  
						<!--<th>Trx No</th>-->     
                        <th>Remarks</th>    	
                        <th>Status</th>
			            <th style="width:15%;">Option </th>
			        </tr>              
                  </thead>
                </table>

<!--Start add Deposit info -->
<div class="modal fade" id="addCashEntryInfoModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitCashReceivedInfoForm" action="php_action/createTrxCashDonationEntryInfo.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Cash Received Info </h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-cashreceived-messages"></div>

	        <div class="form-group">
	        	<label for="ReceivedDate" class="col-sm-2 control-label"> Received Date </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="date" class="form-control" id="ReceivedDate" placeholder="Donate Date" name="ReceivedDate" autocomplete="off">
				    </div>
	        </div>	

			<div class="form-group">
	        	<label for="MemberName" class="col-sm-2 control-label"> Member Name </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
                       <select class="form-control selectpicker"  data-live-search="true" id="MemberName" name="MemberName">
				      	<option value="">~~PLEASE SELECT~~</option>
				      	    <?php 
                                $sql = "SELECT mid,CONCAT(name_english, '/',mobileno) as customername FROM tblapplicantinfo where status=2 Order by mid ASC" ;
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} 								
				      	    ?>
				        </select>
				    </div>
            </div>

			<div class="form-group">
	        	<label for="ReceivedAmount" class="col-sm-2 control-label"> Amount </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" id="ReceivedAmount" placeholder="টাকার পরিমাণ" name="ReceivedAmount">
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
	        <button type="submit" class="btn btn-primary" id="createCashReceivedInfoBtn" data-loading-text="Loading..." autocomplete="off"><i class="glyphicon glyphicon-ok-sign"></i>Save Change</button>
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
<?php
	$user_id = $_SESSION['userId'];	 
	$sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','Founder & General Secretary','Accountant','Assistant Accountant')";
	$result = $connect->query($sql);
	while($row = $result->fetch_array()) {
?>
<!--Start edit Deposit info -->
<div class="modal fade" id="editCashReceivedEntryInfoModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editCashReceivedEntryInfoForm" action="php_action/editTrxCashDonationEntryInfo.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Donation Entry Info</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-cashreceived-messages"></div>

	      	        <div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-cashreceived-result">

		      	<div class="form-group">
		        	<label for="editReceivedDate" class="col-sm-2 control-label">Received Date </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="date" class="form-control" id="editReceivedDate" placeholder="" name="editReceivedDate" autocomplete="off">
					    </div>
		        </div>    
				
			<div class="form-group">
	        	<label for="editMemberName" class="col-sm-2 control-label"> Member Name </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
                       <select class="form-control"  id="editMemberName" name="editMemberName">
				      	<option value="">~~PLEASE SELECT~~</option>
				      	    <?php 
                                $sql = "SELECT mid,CONCAT(name_english, '/',mobileno) as customername FROM tblapplicantinfo where status=2 Order by mid ASC" ;
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} 								
				      	    ?>
				        </select>
				    </div>
            </div>			

			<div class="form-group">
	        	<label for="editReceivedAmount" class="col-sm-2 control-label"> Amount </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="number" class="form-control" id="editReceivedAmount" placeholder="টাকার পরিমাণ" name="editReceivedAmount">
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
	      
	      <div class="modal-footer editCashReceivedEntryInfoFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>	        
	        <button type="submit" class="btn btn-success" id="editCashReceivedEntryInfoBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
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

<!--Start Post Deposit info -->
<div class="modal fade" tabindex="-1" role="dialog" id="postedCashReceivedInfoModel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-ok"></i> Posted Cash Donation Info</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to Posting this Cash Donation Info?</p>
      </div>
      <div class="modal-footer postedCashReceivedInfoFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="postedCashReceivedInfoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--End Post Deposit info -->

<!--Start Delete Deposit info -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeCashReceivedInfoModel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Cash Donation Info </h4>
      </div>
      <div class="modal-body">
        <p>Do you want to delete this info?</p>
      </div>
      <div class="modal-footer removeCashReceivedInfoFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeCashReceivedInfoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Change</button>
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
    <script src="custom/js/transection-cash-donation-entry-info.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>
  </body>
</html>