<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html>

<head>
    <!-- Start title --> 
    <title>Administrator List | Nurses Health Care Society </title>  
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
        <div id="portlet-config" class="modal hide">
          <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button"></button>
            <h3>Authentications/ Administrator List</h3>
          </div>
          <div class="modal-body"> Widget settings form goes here </div>
        </div>
        <div class="clearfix"></div>
        <div class="content">
          <div class="row-fluid">
            <div class="span12">
              <div class="grid simple ">
                <div class="grid-title">
                  <h3>Authentications/ Administrator List</h3>
                </div>
                
                <div class="card">
                <small class="float-right">
	                 <?php
	                 $user_id = $_SESSION['userId'];	 
	                 $sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} AND usertype='Administrator'";
	                 $result = $connect->query($sql);
	                 while($row = $result->fetch_array()) {
                     ?>
	                 <button class="btn btn-default button1" data-toggle="modal" id="addUserModalBtn" data-target="#addUserModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Administrator </button>
	                 <?php } ?>
                </small>
                
                <div class="card-datatable table-responsive">
                <table class="table table-bordered" id="manageUserTable"> 
                 <thead>
                  <tr>
                    <th>Sl No</th>
			        <th>Photo</th>
                    <th>Full Name</th>
                    <th>Designation</th>	
                    <th>Email</th>
                    <th>Mobile No</th>
                    <th>User Type</th>	
                    <th>Status</th>		
			        <th style="width:15%;">Options</th>
			      </tr>          
                 </thead>
                </table>

                <!-- add user -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	<form class="form-horizontal" id="submitUserForm" action="php_action/createAuthUserInfo.php" method="POST" enctype="multipart/form-data">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Administrator</h4>
	      </div>

	      <div class="modal-body" style="max-height:650px; overflow:auto;">

	      	<div id="add-user-messages"></div> 
            
            <div class="form-group">
	        	<label for="UserPhoto" class="col-sm-3 control-label">Administrator Photo </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
							<div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
					    <div class="kv-avatar center-block">					        
					        <input type="file" class="form-control" id="UserPhoto" placeholder="User Photo" name="UserPhoto" class="file-loading" style="width:auto;"/>
					    </div>				      
				    </div>
	        </div>		     	           	       

	        <div class="form-group">
	        	<label for="UserFullName" class="col-sm-3 control-label">Full Name </label>	
                <label class="col-sm-1 control-label">: </label>        	
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="UserFullName" placeholder="Full Name" name="UserFullName" autocomplete="off">
				    </div>
	        </div> 
            
          <div class="form-group">
	        	<label for="UserDesignation" class="col-sm-3 control-label">Designation </label>	
                <label class="col-sm-1 control-label">: </label>        	
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="UserDesignation" placeholder="Designation" name="UserDesignation" autocomplete="off">
				    </div>
	        </div>
            
          <div class="form-group">
	        	<label for="UserType" class="col-sm-3 control-label">User Type </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control selectpicker" data-live-search="true" id="UserType" name="UserType">
				      	<option value="">~~SELECT~~</option>
				      	<?php 
				      	$sql = "SELECT * FROM tbllookup WHERE type ='usertype' AND status = 001";
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
									echo "<option value='".$row[1]."'>".$row[1]."</option>";
								} // while								
				      	?>
				      </select>
				    </div>
	        </div>

	        <div class="form-group">
	        	<label for="UserEmail" class="col-sm-3 control-label">Email </label>	  
                <label class="col-sm-1 control-label">: </label>      	
				    <div class="col-sm-8">
				      <input type="email" class="form-control" id="UserEmail" placeholder="Email" name="UserEmail" autocomplete="off">
				    </div>
	        </div>
            
          <div class="form-group">
	        	<label for="MobileNo" class="col-sm-3 control-label">Mobile No </label>	
                <label class="col-sm-1 control-label">: </label>        	
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="MobileNo" placeholder="Mobile No" name="MobileNo" autocomplete="off">
				    </div>
	        </div>
            
          <div class="form-group">
	        	<label for="UserPassword" class="col-sm-3 control-label">Password </label>
                <label class="col-sm-1 control-label">: </label>	        	
				    <div class="col-sm-8">
				      <input type="password" class="form-control" id="UserPassword" placeholder="Password" name="UserPassword" autocomplete="off">
				    </div>
	        </div>
	        	         	        
	      </div> 
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        <button type="submit" class="btn btn-primary" id="createUserBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!-- /add user -->

<!--Start edit user -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	    	
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Administrator Info</h4>
	      </div>
	      <div class="modal-body" style="max-height:850px; overflow:auto;">

	      	<div class="div-loading">
	      		<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
	      	</div>

	      	<div class="div-result">

				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#photo" aria-controls="home" role="tab" data-toggle="tab">Administrator Photo</a></li>
				    <li role="presentation"><a href="#memberInfo" aria-controls="profile" role="tab" data-toggle="tab">Administrator Info </a></li>    
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">
				  	
				    <div role="tabpanel" class="tab-pane active" id="photo">
				    	<form action="php_action/editAuthUserImage.php" method="POST" id="updateMemberImageForm" class="form-horizontal" enctype="multipart/form-data">
				    	<br />
				    	<div id="edit-memberPhoto-messages"></div>

				    	<div class="form-group">
			        	<label for="editUserImage" class="col-sm-3 control-label">Administrator Image </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">							    				   
						      <img src="" id="getUserImage" class="thumbnail" style="width:250px; height:250px;" />
						    </div>
			        </div> <!-- /form-group-->	     	           	       
				    	
			      	<div class="form-group">
			        	<label for="editUserImage" class="col-sm-3 control-label">Select Administrator Images </label>
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
				    	<form accept-charset="utf-8" class="form-horizontal" id="editMemberForm" action="php_action/editAuthUserInfo.php" method="POST">				    
				    	<br />

				    	<div id="edit-member-messages"></div>

				    	<div class="form-group">
			        	<label for="editUserFullName" class="col-sm-3 control-label">Full Name </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editUserFullName" placeholder="User Full Name" name="editUserFullName" autocomplete="off">
						    </div>
			        </div>	   

			        <div class="form-group">
			        	<label for="editDesignation" class="col-sm-3 control-label">Designation </label>
			        	<label class="col-sm-1 control-label">: </label>
						    <div class="col-sm-8">
						      <input type="text" class="form-control" id="editDesignation" placeholder="Designation" name="editDesignation" autocomplete="off">
						    </div>
			        </div>	        	 

			        <div class="form-group">
	        	    <label for="editUserType" class="col-sm-3 control-label">User Type </label>
	        	    <label class="col-sm-1 control-label">: </label>
				        <div class="col-sm-8">
				          <select class="form-control" id="editUserType" name="editUserType">
				      	  <option value="">~~SELECT~~</option>
				      	  <?php 
				      	  $sql = "SELECT * FROM tbllookup WHERE type ='usertype' AND status = 001";
								  $result = $connect->query($sql);
								  while($row = $result->fetch_array()) {
									echo "<option value='".$row[1]."'>".$row[1]."</option>";
								  }								
				       	  ?>
				          </select>
				        </div>
	            </div> 	          
            
              <div class="form-group">
			        	  <label for="editMobileNo" class="col-sm-3 control-label">Mobile No </label>
			        	  <label class="col-sm-1 control-label">: </label>
						      <div class="col-sm-8">
						      <input type="text" class="form-control" id="editMobileNo" placeholder="Mobile No" name="editMobileNo" autocomplete="off">
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
<!-- /End edit user -->

<!--Start Post User info -->
<div class="modal fade" tabindex="-1" role="dialog" id="postedUserInfoModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-ok"></i> Approved Administrator Info</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to Approved ?</p>
      </div>
      <div class="modal-footer postedUserInfoFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="postedUserInfoBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div>
  </div>
</div>
<!--End Post User info -->

<!--Start Delete user -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeUserModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Administrator</h4>
      </div>
      <div class="modal-body">

      	<div class="removeUserMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeUserFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeUserBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!-- End Delete user -->
                  
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
      <!-- BEGIN footer -->
        <?php include ('layouts/footer.php') ?>   
      <!-- END footer -->
    </div>
    <!-- END CONTAINER -->
    
    <!-- BEGIN CORE JS FRAMEWORK-->
    <?php include ('layouts/5-base-js.php') ?> 
    <!-- END CORE JS FRAMEWORK-->
    <script src="custom/js/auth-user-list.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>
  </body>
</html>