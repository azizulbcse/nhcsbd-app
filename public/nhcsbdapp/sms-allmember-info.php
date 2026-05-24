<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html>

<head>
    <!-- Start title --> 
    <title>All Member SMS | Nurses Health Care Society </title>  
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
                  <h3>SMS Info / All Member SMS Send </h3>
                </div>
                
                <div class="card">
                <small class="float-right">      
                  <button class="btn btn-default button1" data-toggle="modal" data-target="#addIndividualSMSInfoModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add SMS for Member </button>
                </small>
                
                <div class="card-datatable table-responsive">
                <table class="table table-bordered" id="manageSMSIndividualInfoTable"> 
                  <thead>
				               <tr>
                        <th>Sl No</th> 
                        <th>Message</th>
                        <th>Send Date & Time</th>           	
                        <th>Status</th>
			                  <th style="width:15%;">Option </th>
			                </tr>              
                  </thead>
                </table>

<!--Start add Payee info -->
<div class="modal fade" id="addIndividualSMSInfoModel" tabindex="-1" role="dialog"> 
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitSMSIndividualInfoForm" action="php_action/createSMSAllMember.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> All Member SMS Info </h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-individualsms-messages"></div>          

	        <div class="form-group">
	        	<label for="MessageDts" class="col-sm-3 control-label">Message</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="MessageDts" placeholder="Message Dts" name="MessageDts" autocomplete="off">
				    </div>
	        </div>     	        

	      </div> <!-- /modal-body -->	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Close </button>
	        <button type="submit" class="btn btn-primary" id="createIndividualSMSInfoBtn" data-loading-text="Loading..." autocomplete="off"><i class="glyphicon glyphicon-ok-sign"></i>Save Change</button>
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
<div class="modal fade" id="editIndividualSMSModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editIndividualSMSForm" action="php_action/editSMSAllMember.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Individual SMS Info </h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-individualsms-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-individualsms-result">

	        <div class="form-group">
	        	<label for="editMessageDts" class="col-sm-3 control-label">Message</label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editMessageDts" placeholder="Message Dts" name="editMessageDts" autocomplete="off">
				    </div>
	        </div>        

		      </div>         	        
		      <!-- /edit brand result -->
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editSMSIndividualFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close </button>
	        <button type="submit" class="btn btn-success" id="editSMSIndividualBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Change </button>
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

<!-- posting -->
<div class="modal fade" tabindex="-1" role="dialog" id="postSMSIndividualModel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-ok-sign"></i> Sent this SMS </h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to SENT this SMS?</p>
      </div>
      <div class="modal-footer postSMSIndividualFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="postingSMSIndividualBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Sent </button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /posting -->

<!--Start Delete Hospital info -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeIndividualSMSModel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Delete Individual SMS Info </h4>
      </div>
      <div class="modal-body">
        <p>Do you want to delete this SMS info?</p>
      </div>
      <div class="modal-footer removeSMSIndividualFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeSMSIndividualBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Change</button>
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
    <script src="custom/js/sms-sent-allmember.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>
  </body>
</html>