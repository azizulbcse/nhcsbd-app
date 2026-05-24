<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html>

<head>
    <!-- Start title --> 
    <title>Share Holder Nominee Info | Nurses Health Care Society </title>  
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
	<?php if($_SESSION['Role']==1)
	{
    ?>
    <?php include ('layouts/2-base-header.php') ?>
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
	  <?php if($_SESSION['Role']==1)
	  {
      ?>
      <?php include ('layouts/4-base-menu.php') ?>
	  <?php } ?>
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
                  <h3>Nominee Info</h3>
                </div>                
                <div class="card">                
                <div class="card-datatable table-responsive">
                <table class="table table-bordered" id="manageNomineeInfoTable"> 
                  <thead>
				    <tr>
                        <th> Sl No </th>
                        <th> Nominee Photo </th>
						<th> Share Holder Name </th>
			            <th> Nominee Name </th>     
                        <th> Relation </th>   
                        <th> Mobile No </th>
                        <th> Address </th> 
						<th> Nominee NID </th>  	
                        <th> Status </th>
			            <th style="width:15%;">Option </th>
			        </tr>              
                  </thead>
                </table>

<!--Start edit Nominee -->
<div class="modal fade" id="editNomineeInfoModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	    	
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Nominee Info</h4>
	      </div>
	      <div class="modal-body" style="max-height:850px; overflow:auto;">

	      	<div class="div-loading">
	      		<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
	      	</div>

	      	<div class="div-result">

				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#photo" aria-controls="home" role="tab" data-toggle="tab">Nominee Photo</a></li>
				    <li role="presentation"><a href="#memberInfo" aria-controls="profile" role="tab" data-toggle="tab">Nominee Info </a></li>    
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">
				  	
				    <div role="tabpanel" class="tab-pane active" id="photo">
				    	<form action="php_action/editSHNomineeImage.php" method="POST" id="updateMemberImageForm" class="form-horizontal" enctype="multipart/form-data">
				    	<br />
				    	<div id="edit-memberPhoto-messages"></div>

				    	<div class="form-group">
			        	<label for="editUserImage" class="col-sm-3 control-label">Nominee Photo </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">							    				   
						      <img src="" id="getUserImage" class="thumbnail" style="width:250px; height:250px;" />
						    </div>
			        </div> <!-- /form-group-->	     	           	       
				    	
			      	<div class="form-group">
			        	<label for="editUserImage" class="col-sm-3 control-label">Select Nominee Photo </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
							    <!-- the avatar markup -->
									<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
							    <div class="kv-avatar center-block">					        
							        <input type="file" class="form-control" id="editUserImage" placeholder="User Name" name="editUserImage" class="file-loading" style="width:auto;"/>
							    </div>
						      
						    </div>
			        </div> <!-- /form-group-->	     	           	       

			        <div class="modal-footer editMemberPhotoFooter">
				        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>				        
				        <!-- <button type="submit" class="btn btn-success" id="editUserImageBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button> -->
				      </div>
				      <!-- /modal-footer -->
				      </form>
				      <!-- /form -->
				    </div>
				    <!-- product image -->
				    <div role="tabpanel" class="tab-pane" id="memberInfo">
				    	<form accept-charset="utf-8" class="form-horizontal" id="editMemberForm" action="php_action/editSHNomineeInfo.php" method="POST">				    
				    	<br />

				    	<div id="edit-applicantinfo-messages"></div>			    	

					<div class="form-group">
			        	<label for="editNomineeName" class="col-sm-3 control-label"> নমিনির নাম </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editNomineeName" placeholder="Nominee Name" name="editNomineeName" autocomplete="off">
						    </div>
			        </div>

					<div class="form-group">
			        	<label for="editNomineeRelation" class="col-sm-3 control-label"> নমিনির সম্পর্ক </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editNomineeRelation" placeholder="Nominee Relation" name="editNomineeRelation" autocomplete="off">
						    </div>
			        </div>

					<div class="form-group">
			        	<label for="editNomineeMobile" class="col-sm-3 control-label"> নমিনির ফোন নং </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editNomineeMobile" placeholder="Nominee Mobile" name="editNomineeMobile" autocomplete="off">
						    </div>
			        </div>

					<div class="form-group">
			        	<label for="editNomineeAddress" class="col-sm-3 control-label"> নমিনির ঠিকানা </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editNomineeAddress" placeholder="Nominee Address" name="editNomineeAddress" autocomplete="off">
						    </div>
			        </div>

					<div class="form-group">
			        	<label for="editNomineeNID" class="col-sm-3 control-label"> নমিনির জাতীয় পরিচয় পত্র </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="number" class="form-control" id="editNomineeNID" placeholder="Nominee NID" name="editNomineeNID" autocomplete="off">
						    </div>
			        </div>

			        <div class="modal-footer editMemberFooter">
				        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>				        
				        <button type="submit" class="btn btn-success" id="editMemberBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
				      </div> <!-- /modal-footer -->				     
			        </form> <!-- /.form -->				     	
				    </div>    
				    <!-- /product info -->
				  </div>
				</div>	      	
	      </div> <!-- /modal-body -->     	      
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- /End edit Nominee -->
                  
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
    <script src="custom/js/shareholder-nominee-info.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>
  </body>
</html>