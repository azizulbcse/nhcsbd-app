<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html>

<head>
    <!-- Start title --> 
    <title>Password Change | Nurses Health Care Society </title>  
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
    <div class="page-container row">

      <!-- BEGIN SIDEBAR -->
      <?php include ('layouts/4-base-menu.php') ?>
      <!-- END SIDEBAR -->
	  <?php 
       $user_id = $_SESSION['userId'];
       $sql = "SELECT * FROM tbladminuser WHERE user_id = {$user_id}";
       $query = $connect->query($sql);
       $result = $query->fetch_assoc();
       $connect->close();
      ?>
      <!-- BEGIN PAGE CONTAINER-->
      <div class="page-content">
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->        
        <div class="clearfix"></div>
        <div class="content">          
          <div class="page-title"> <i class="icon-custom-left"></i>
            <h3>Authentications/ Password Change</h3>
          </div>
		  
          <div class="row">
            <div class="col-md-6">
              <div class="grid simple form-grid">
                <div class="grid-title no-border">
                  <h4>Change Username</h4>
                </div>
                <div class="grid-body no-border">
                  <form action="php_action/ChangeUsername.php" method="post"  id="changeUsernameForm" name="form_traditional_validation" role="form" autocomplete="off" class="validate">
				  <div class="changeUsenrameMessages"></div>
                    <div class="form-group">
                      <label class="form-label">Username</label>
					  <input type="text" class="form-control" id="username" name="username" readonly="false" placeholder="Usename" value="<?php echo $result['username']; ?>"/>
                    </div>                    

                    <div class="form-actions">
                      <div class="pull-right">
						<input type="hidden" name="user_id" id="user_id" value="<?php echo $result['user_id'] ?>" /> 
					    <!--<button type="submit" class="btn btn-success btn-cons" data-loading-text="Loading..." id="changeUsernameBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes </button>
						<button class="btn btn-white btn-cons" type="button">Cancel</button>-->
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="grid simple form-grid">
                <div class="grid-title no-border">
                  <h4>Change Password</h4>
                </div>
                <div class="grid-body no-border">
                  <br>
				  <form action="php_action/ChangePassword.php" method="post" class="form-horizontal" id="changePasswordForm">
				  <div class="changePasswordMessages"></div>
                    <div class="form-group">
                      <label class="form-label">Current Password</label>
                      <div class="input-with-icon  right">
                        <i class=""></i>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Current Password">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="form-label">New password</label>
                      <div class="input-with-icon  right">
                        <i class=""></i>
                        <input type="password" class="form-control" id="npassword" name="npassword" placeholder="New Password">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="form-label">Confirm Password</label>
                      <div class="input-with-icon  right">
                        <i class=""></i>
                        <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
                      </div>
                    </div>
                    <div class="form-actions">
                      <div class="pull-right">
					    <input type="hidden" name="user_id" id="user_id" value="<?php echo $result['user_id'] ?>" />
						<button type="submit" class="btn btn-danger btn-cons"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes </button>	
                        <button type="reset" class="btn btn-white btn-cons">Cancel</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
    <!-- END PAGE -->

    <!-- BEGIN CORE JS FRAMEWORK-->
    <?php include ('layouts/5-base-js.php') ?> 
	<script src="custom/js/auth-user-setting.js"></script>
    <!-- END CORE JS FRAMEWORK-->
    <?php include ('layouts/FooterDTPage.php') ?>
	</body>
</html>