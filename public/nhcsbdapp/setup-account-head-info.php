<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html>

<head>
    <!-- Start title --> 
    <title>Account Head | Nurses Health Care Society </title>  
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
                  <h3>Setup / Account Head Info </h3>
                </div>
                
                <div class="card">
                <small class="float-right">      
                  <button class="btn btn-default button1" data-toggle="modal" data-target="#addAccountHeadInfoModel"> <i class="glyphicon glyphicon-plus-sign"></i>Add Account Head </button>
                </small>
                
                <div class="card-datatable table-responsive">
                <table class="table table-bordered" id="manageAccHeadInfoTable"> 
                  <thead>
				               <tr>
                        <th>Sl No</th>
                        <th>Account Group</th>
			                  <th>Account Head</th>               	
                        <th>Status</th>
			                  <th style="width:15%;">Option </th>
			                </tr>              
                  </thead>
                </table>

<!--Start add Payee info -->
<div class="modal fade" id="addAccountHeadInfoModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitAccHeadInfoForm" action="php_action/createSetupAccHeadInfo.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Account Head Info </h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-acchead-messages"></div>

          <div class="form-group">
	        	<label for="AccGroupName" class="col-sm-2 control-label">Account Group </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
              <select class="form-control selectpicker"  data-live-search="true" id="AccGroupName" name="AccGroupName">
				      	<option value="">~~PLEASE SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT AccGroupId, AccGroupName FROM tblaccgroup WHERE status=1";
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while
								
				      	?>
				      </select>
				    </div>
          </div> 

	        <div class="form-group">
	        	<label for="AccountHead" class="col-sm-2 control-label">Account Head </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="AccountHead" placeholder="Account Name" name="AccountHead" autocomplete="off">
				    </div>
	        </div>     	        

	      </div> <!-- /modal-body -->	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Close </button>
	        <button type="submit" class="btn btn-primary" id="createAccountHeadInfoBtn" data-loading-text="Loading..." autocomplete="off"><i class="glyphicon glyphicon-ok-sign"></i>Save Change</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!--End add Payee info -->

<!--Start edit unit info -->
<div class="modal fade" id="editAccHeadInfoModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editAccHeadInfoForm" action="php_action/editSetupAccHeadInfo.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Account Head Info </h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-acchead-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-acchead-result">

          <div class="form-group">
	        	<label for="editAccGroupName" class="col-sm-2 control-label">Group Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">                     
				      <select class="form-control" data-live-search="true" id="editAccGroupName" name="editAccGroupName">
				      	<option value="">~~SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT AccGroupId, AccGroupName FROM tblaccgroup WHERE status=1";
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while								
				      	?>
				      </select>
				    </div>
	        </div> <!-- /form-group-->	

		      	<div class="form-group">
		        	<label for="editAccountHead" class="col-sm-2 control-label"> Account Head </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="editAccountHead" placeholder="Account Name" name="editAccountHead" autocomplete="off">
					    </div>
		        </div> <!-- /form-group-->	         	        
		       
		      </div>         	        
		      <!-- /edit brand result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editAccountHeadFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close </button>
	        
	        <button type="submit" class="btn btn-success" id="editAccountHeadBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Change </button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!--End edit unit info -->

<!--Start Delete Hospital info -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeAccHeadInfoModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Account Head Info </h4>
      </div>
      <div class="modal-body">
        <p>Do you want to delete this info?</p>
      </div>
      <div class="modal-footer removeAccHeadInfoFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeAccHeadInfoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Change</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!--End Delete Hospital info -->
                  
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
    <script src="custom/js/setup-acc-head-info.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>
  </body>
</html>