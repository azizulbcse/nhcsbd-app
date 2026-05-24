<?php 
require_once 'php_action/db_connect.php';

if(isset($_SESSION['userId'])) {
	header('location: dashboard-shareholder.php');
}

$errors = array();

if($_POST) {		

	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) || empty($password)) {
		if($username == "") {
			$errors[] = "Username is required";
		} 

		if($password == "") {
			$errors[] = "Password is required";
		}
	} else {
		$sql = "SELECT * FROM tblapplicantinfosh WHERE email = '$username'";
		$result = $connect->query($sql);

		if($result->num_rows == 1) {
			$password = md5($password);
			// exists
			$mainSql = "SELECT * FROM tblapplicantinfosh WHERE email = '$username' AND password = '$password' AND status=2";
			$mainResult = $connect->query($mainSql);

			if($mainResult->num_rows == 1) {
				$value = $mainResult->fetch_assoc();
				$user_id = $value['mid'];
				$Username = $value['email'];
        $Role = $value['role']; 

				// set session
					session_start();

				$_SESSION['userId'] = $user_id;
				$_SESSION['Username'] = $Username;
        $_SESSION['Role'] = $Role;
				header('location: dashboard-shareholder.php');	
			} else{
				
				$errors[] = "Incorrect username/password combination";
			} // /else
		} else {		
			$errors[] = "Share Holder doesnot exists";		
		} // /else
	} // /else not empty username // password
	
} // /if $_POST
?>

<!DOCTYPE html>
<html>
<!-- START HEAD -->
<head>
    <!-- Start title --> 
      <title>Login | Nurses Health Care Society </title>  
    <!-- End title --> 

    <!-- Start Header Base--> 
      <?php include ('layouts/1-base-head.php') ?>
    <!-- End Header Base --> 
  </head>
  <!-- END HEAD -->

  <!-- BEGIN BODY -->
  <body class="" style="background-color:#808000;">
    <div class="container" align="center">
      <div class="row login-container animated fadeInUp" align="center">
        <div class="col-md-7 col-md-offset-2 tiles white no-padding" align="center">
          <div class="p-t-30 p-l-40 p-b-20 xs-p-t-10 xs-p-l-10 xs-p-b-10" align="center">
          <a href="index.php" class="app-brand-link gap-2">
            <img src="assets/img/logo.jpg" alt="Nurses Health Care Society">
          </a>
            <h2 class="normal">
              Welcome Honourable Share Holder to </br> Nurses Health Care Society!
            </h2>
            <p class="p-b-20">
             <!--Please sign-in to your account and start the adventure-->
             Sign up Now! for Nurses Health Care Society accounts, it's always will be..
            </p>

            <div role="tabpanel" class="tab-pane active" id="tab_login" align="center">
              <form id="formAuthentication" align="center" class="animated fadeIn validate" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
              <div class="messages" align="center">
			          <?php if($errors) 
			              {
			               foreach ($errors as $key => $value) 
                      {
			                echo '<div class="alert alert-warning" role="alert">
			                <i class="glyphicon glyphicon-exclamation-sign"></i>
		                    '.$value.'</div>';										
			                }
			               }
			          ?>
	            </div>
                <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10" align="center">
                  <div class="col-md-6 col-sm-6">
                    <label class="form-label">ব্যবহারকারীর নাম</label>
                    <input class="form-control" id="login_username" name="username" placeholder="Username/Email" type="email" required>
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label class="form-label">পাসওয়ার্ড</label>
                    <input class="form-control" id="login_pass" name="password" placeholder="Password" type="password" required>
                  </div>
                    
                  <button type="submit" class="btn btn-primary btn-cons-md" type="submit"> Login</button>
                  <button type="reset" class="btn btn-white btn-cons-md" type="reset">Clear</button>
                </div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Start JS-->
    <?php include ('layouts/5-base-js.php') ?> 
    <!-- End JS-->
  </body>
</html>