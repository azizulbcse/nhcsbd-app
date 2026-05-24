<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html>

<head>
    <!-- Start title --> 
    <title>Resignation Info | Nurses Health Care Society </title>  
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
    <?php if($_SESSION['Role']==0)  { ?>
    <?php include ('layouts/2-base-header-member.php') ?>
    <?php } ?>
    <?php if($_SESSION['Role']==1)  { ?>
    <?php include ('layouts/2-base-header.php') ?>
    <?php } ?>
    <?php if($_SESSION['Role']==2)  { ?>
    <?php include ('layouts/2-base-header-sh.php') ?>
    <?php } ?>
    <!-- END HEADER -->

    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
      <!-- BEGIN SIDEBAR -->
    	<?php if($_SESSION['Role']==0) { ?>
      <?php include ('layouts/4-base-menu-member.php') ?>
	    <?php } ?>
      <?php if($_SESSION['Role']==1) { ?>
      <?php include ('layouts/4-base-menu.php') ?>
	    <?php } ?>
	    <?php if($_SESSION['Role']==2) { ?>
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
                  <h3>Application Info / Resignation Info</h3>
                </div>
                <?php if($_SESSION['Role']!=1) { ?>
                <div class="card">
                <small class="float-right">      
                  <button class="btn btn-default button1" data-toggle="modal" data-target="#addResignInfoModel"> <i class="glyphicon glyphicon-plus-sign"></i> Apply Resignation </button>
                </small>
                <div class="row small-text">
                  <p class="col-md-12">
                    নোট - সন্মানিত সদস্য, আপনার আবেদন পত্রটি সভাপতির নিকট পাঠাতে হলে Action বাটনে ক্লিক করে Send বাটনে ক্লিক করুন। আর বাদ দিতে চাইলে Cancel বাটনে ক্লিক করুন।
                  </p>
                </div>
                <?php } ?>
                <div class="card-datatable table-responsive">
                <table class="table table-bordered" id="manageResignInfoTable"> 
                  <thead>
				               <tr>
                        <th>Sl No</th>
                        <th>Resign Date</th>
			                  <th>Resignation Reasons</th> 
                        <th>Member Status</th>
                        <th>President Status</th>   
                        <th>Secretary General Status</th>  
                        <th>Accountened Status</th>       	
			                  <th style="width:15%;">Option </th>
			                </tr>              
                  </thead>
                </table>

<!--Start add Resignation Reasons info -->
<div class="modal fade" id="addResignInfoModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitResignInfoForm" action="php_action/createApplicationResignListInfo.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Resignation Info</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-resigninfo-messages"></div>

          <div class="form-group">
	        	<label for="ResignDate" class="col-sm-2 control-label"> Resign Date </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="date" class="form-control" id="ResignDate" placeholder="Resign Date" name="ResignDate" autocomplete="off">
				    </div>
	        </div>

        	<div class="form-group">
	        	<label for="ResignationReasons" class="col-sm-2 control-label"> Resignation Reasons </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
                <select class="form-control selectpicker" data-live-search="true" id="ResignationReasons" name="ResignationReasons">
				      	<option value="">~~PLEASE SELECT~~</option>
				      	<?php 								
                $sql = "SELECT rrid,resignresons FROM tblresignreasonsinfo where status=1 Order by resignresons ASC" ;
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
								echo "<option value='".$row[1]."'>".$row[1]."</option>";
								} 								
				      	?>
				        </select>
				    </div>
          </div> 

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>	        
	        <button type="submit" class="btn btn-primary" id="createResignApplicationInfoBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
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

<!--Start edit Resignation Reasons info -->
<div class="modal fade" id="editResignInfoModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editResignInfoForm" action="php_action/editApplicationResignListInfo.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Resignation Reasons Info</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-resigninfo-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-resigninfo-result">

        <div class="form-group">
		        <label for="editResignDate" class="col-sm-2 control-label"> Resign Date </label>
		        	<label class="col-sm-1 control-label">: </label>
					<div class="col-sm-8">
					    <input type="date" class="form-control" id="editResignDate" placeholder="Resign Date" name="editResignDate" autocomplete="off">
					</div>
		    </div> 

        <div class="form-group">
	        	<label for="editResignationReasons" class="col-sm-2 control-label"> Resignation Reasons </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
              <select class="form-control" id="editResignationReasons" name="editResignationReasons">
				      	<option value="">~~PLEASE SELECT~~</option>
				      	<?php 								
                $sql = "SELECT rrid,resignresons FROM tblresignreasonsinfo where status=1 Order by resignresons ASC";
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[1]."'>".$row[1]."</option>";
								} 								
				      	?>
				        </select>
				    </div>
          </div>        	        
		       
		      </div>         	        
		      <!-- /edit brand result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editResignInfoFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editResignInfoBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!--End edit Resignation Reasons info -->

<!--Start Post Deposit info -->
<div class="modal fade" tabindex="-1" role="dialog" id="postedResignInfoModel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-ok"></i> Send Resign Application </h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to Send this Application?</p>
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
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Resign Application </h4>
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
          <div class="copyright"> © 2024, made with ❤️ by Matrik Solutions</div>
        </div>
      </div>  
      <!-- END footer -->
    </div>
    <!-- END CONTAINER -->
    
    <!-- BEGIN CORE JS FRAMEWORK-->
    <?php include ('layouts/5-base-js.php') ?> 
    <!-- END CORE JS FRAMEWORK-->
    <script src="custom/js/application-resign-info.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>
  </body>
</html>