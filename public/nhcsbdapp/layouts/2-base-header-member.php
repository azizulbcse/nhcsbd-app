<?php
	$user_id = $_SESSION['userId'];
	$sql = "SELECT mid,name_english,userpic,name_bangla,designation FROM tblapplicantinfo WHERE mid = {$user_id}";
	$result = $connect->query($sql);
	while($row = $result->fetch_array()) {
	$imageUrl = substr($row[2], 3);
	$userpic = "<img class='h-auto rounded-circle' src='".$imageUrl."' style='height:40px; width:40px;'  />";
?>
    <div class="header navbar navbar-inverse ">
      <!-- BEGIN TOP NAVIGATION BAR -->
      <div class="navbar-inner">
        <div class="header-seperation">
          <ul class="nav pull-left notifcation-center visible-xs visible-sm">
            <li class="dropdown">
              <a href="#main-menu" data-webarch="toggle-left-side">
                <i class="material-icons">menu</i>
              </a>
            </li>
          </ul>
          <!-- BEGIN LOGO -->
          <a href="dashboard.php">            
            <img src="assets/img/logo-dashboard.jpg" class="logo" alt="" data-src="assets/img/logo-dashboard.jpg" data-src-retina="assets/img/logo-dashboard.jpg" />
          </a>
          <!-- END LOGO -->
          <ul class="nav pull-right notifcation-center">
            <li class="dropdown hidden-xs hidden-sm">
              <a href="dashboard.php" class="dropdown-toggle active" data-toggle="">
                <i class="material-icons">home</i>
              </a>
            </li>            
          </ul>
        </div>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <div class="header-quick-nav">
          <!-- BEGIN TOP NAVIGATION MENU -->
          <div class="pull-left">
            <ul class="nav quick-section">
              <li class="quicklinks">
                <a href="#" class="" id="layout-condensed-toggle">
                  <i class="material-icons">menu</i>
                </a>
              </li>
            </ul>
            <ul class="nav quick-section">
              <li class="quicklinks  m-r-10">
                <a href="#" class="">
                  <i class="material-icons">refresh</i>
                </a>
              </li>
              <li class="quicklinks">
                <a href="#" class="">
                  <i class="material-icons">apps</i>
                </a>
              </li>
              <li class="quicklinks"> <span class="h-seperate"></span></li>              
              <li class="m-r-10 input-prepend inside search-form no-boarder">
                <span class="add-on"> <i class="material-icons">search</i></span>
                <input name="" type="text" class="no-boarder " placeholder="Search Dashboard" style="width:250px;">
              </li>
            </ul>
          </div>
          <div id="notification-list" style="display:none">
            <div style="width:300px">
              <div class="notification-messages info">
                <div class="user-profile">
                  <!--<img src="assets/img/user/1773169009622d8c08bb79b.jpg" alt="" data-src="assets/img/user/1773169009622d8c08bb79b.jpg" data-src-retina="assets/img/user/1773169009622d8c08bb79b.jpg" width="35" height="35">-->
                  <?php echo $userpic ?>
                </div>                
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <!-- END TOP NAVIGATION MENU -->
          <!-- BEGIN CHAT TOGGLER -->
          <div class="pull-right">
            <div class="chat-toggler sm">
              <div class="profile-pic">
                <?php echo $userpic ?>
                <!--<img src="assets/img/user/1773169009622d8c08bb79b.jpg" alt="" data-src="assets/img/user/1773169009622d8c08bb79b.jpg" data-src-retina="assets/img/user/1773169009622d8c08bb79b.jpg" width="35" height="35" />-->
                <div class="availability-bubble online"></div>
              </div>
            </div>
            <ul class="nav quick-section ">
              <li class="quicklinks">
                <a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="#" id="user-options">
                  <i class="material-icons">tune</i>
                </a>
                <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
                  <li>
                    <a href="#"> My Account</a>
                  </li>

                  <li class="divider"></li>
                  <li>
                    <a href="auth-log-out.php?SignIn"><i class="material-icons">power_settings_new</i>&nbsp;&nbsp;Log Out</a>
                  </li>
                </ul>
              </li>
              <li class="quicklinks"> <span class="h-seperate"></span></li>
              <li class="quicklinks">
                <a href="#" class="chat-menu-toggle" data-webarch="toggle-right-side"><i class="material-icons">chat</i><span class="badge badge-important hide">1</span></a>
                <div class="simple-chat-popup chat-menu-toggle hide">
                  <div class="simple-chat-popup-arrow"></div>
                  <div class="simple-chat-popup-inner">
                    <div style="width:100px">
                      <div class="semi-bold"><?php echo $row['name_english'] ?></div></br>
                      <?php echo $row['designation'] ?></div>
                      <div class="message">Hey you there </div>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <!-- END CHAT TOGGLER -->
        </div>
        <!-- END TOP NAVIGATION MENU -->
      </div>
      <!-- END TOP NAVIGATION BAR -->
    </div>
    <?php } ?>