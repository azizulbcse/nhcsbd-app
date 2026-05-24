<div class="page-sidebar " id="main-menu">
        <!-- BEGIN MINI-PROFILE -->
          <?php
	          $user_id = $_SESSION['userId'];
	          $sql = "SELECT mid,name_english,userpic,name_bangla FROM tblapplicantinfosh WHERE mid = {$user_id}";
	          $result = $connect->query($sql);
	          while($row = $result->fetch_array()) {
	          $imageUrl = substr($row[2], 3);
	          $userpic = "<img class='h-auto rounded-circle' src='".$imageUrl."' style='height:69; width: 69;'  />";
	        ?>
        <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
          <div class="user-info-wrapper sm">
            <div class="profile-wrapper sm">
              <!--<img src="assets/img/user/1773169009622d8c08bb79b.jpg" alt="" data-src="assets/img/user/1773169009622d8c08bb79b.jpg" data-src-retina="assets/img/user/1773169009622d8c08bb79b.jpg" width="69" height="69" />-->
              <?php echo $userpic ?>
              <div class="availability-bubble online"></div>
            </div>
            <div class="user-info sm">
              <div class="status"><?php echo $row['name_english'] ?></div>
              <div class="status">Senior Staff Nurse</div>
              <div class="status">Life goes on...</div>
            </div>
          </div>
          <?php } ?>
          <!-- END MINI-PROFILE -->

          <!-- BEGIN SIDEBAR MENU -->
          <p class="menu-title sm">BROWSE <span class="pull-right"><a href="javascript:;"><i class="material-icons">refresh</i></a></span></p>
          <ul>
            <li class="start  open active "> <a href="dashboard-shareholder.php"><i class="material-icons">home</i> <span class="title">Dashboard</span> <span class="selected"></span> </a>
              <!--<ul class="sub-menu">
                <li> <a href="dashboard.phpl"> Dashboard v1 </a> </li>
                <li class=""> <a href="dashboard.php"> Dashboard <span class=" label label-info pull-right m-r-30">NEW</span></a></li>
              </ul>-->
            </li>     

            <li>
              <a href="javascript:;"> <i class="material-icons">view_stream</i> <span class="title">Deposit Info</span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="transection-deposit-entry-sh.php?id=1&DepositEntry"> Deposit Entry [Cash] </a> </li>
                <li> <a href="transection-deposit-entry-sh.php?id=2&DepositEntry"> Deposit Entry [Online Banking] </a> </li>
                <li> <a href="transection-deposit-entry-sh.php?id=3&DepositEntry"> Deposit Entry [Mobile Banking] </a> </li>
                <li> <a href="shareholder-deposit-summary-self.php?SelfDepositSummary"> My Deposit Summary  </a> </li>
              </ul>
            </li>

            <li>
              <a href="javascript:;"> <i class="material-icons">timeline</i> <span class="title">Application Info</span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="application-resign-info.php?ResignApplication"> Resign Application </a> </li>
                <li> <a href="#"> Personal Loan Application </a> </li>
                <li> <a href="#"> Health Loan Application </a> </li>
              </ul>
            </li>

            <!--<li>
              <a href="javascript:;"> <i class="material-icons">apps</i> <span class="title">Donation Info</span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="transection-donation-entry.php?DonationEntry">Donation Entry [Cash]</a> </li>
                <li> <a href="transection-donation-entry.php?DonationEntry">Donation Entry [Online Banking]</a> </li>
                <li> <a href="transection-donation-entry.php?DonationEntry">Donation Entry [Mobile Banking]</a> </li>
                <li> <a href="member-donation-summary-self.php?SelfDepositSummary"> My Donation Summary  </a> </li>
              </ul>
            </li>-->

            <li>
              <a href="sms-sent-sh-info.php?SMSSentInfo"> <i class="material-icons">email</i> <span class="title">SMS List</span> </a>
            </li>
            
            <li>
              <a href="javascript:;"> <i class="material-icons">invert_colors</i> <span class="title">My Profile Info</span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="sh-profile.php?ShareHolderProfile">My Profile</a> </li>
                <li> <a href="shareholder-nominee-info.php?ShareHolderNomineeInfo">Share Holder Nominee Info</a> </li>
                <li> <a href="shareholder-bank-info.php?ShareHolderBankInfo">Share Holder Bank Acc Info</a> </li>
                <li> <a href="auth-sh-security.php?PasswordChange">Change Password</a> </li>
                <li> <a href="auth-log-out.php?SignOut">Log out</a> </li>
              </ul>
            </li>

            <!--<li>
              <a href="javascript:;"> <i class="material-icons">airplay</i> <span class="title">Setup</span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="setup-hospital-info.php?HospitalInfo"> Hospital Info </a> </li>
              </ul>
            </li>

            <li>
              <a href="javascript:;"> <i class="material-icons">flip</i><span class="title">All Application List </span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="application-form-list.php?ApplicantList"> Applicant Info  </a> </li>
              </ul>
            </li>

            

            <li>
              <a href="javascript:;"> <i class="material-icons">email</i> <span class="title">SMS Info</span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="sms-sent-info.php?SMSSentInfo">SMS Sent List </a> </li>
              </ul>
            </li>

            <li>
              <a href="javascript:;"> <i class="material-icons">invert_colors</i> <span class="title">Authentications</span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="auth-user-list.php?AdministratorListq">Administrator List </a> </li>
                <li> <a href="auth-user-security.php?PasswordChange">Change Password</a> </li>
                <li> <a href="auth-log-out.php?SignIn">Log out</a> </li>
              </ul>
            </li>-->
            
            <!--<li>
              <a href="#"> <i class="material-icons">panorama_horizontal</i> <span class="title">Widgets</span> <span class="label label-important bubble-only pull-right "></span></a>
            </li>
                     

            
            <li>
              <a href="javascript:;"> <i class="material-icons">apps</i> <span class="title">Grids</span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="grids_simple.html">Simple Grids</a> </li>
                <li> <a href="grids_draggable.html">Draggable Grids </a> </li>
              </ul>
            </li>
            <li>
              <a href="javascript:;"> <i class="material-icons">playlist_add_check</i> <span class="title">Tables</span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="tables.html"> Basic Tables </a> </li>
                <li> <a href="datatables.html"> Data Tables </a> </li>
              </ul>
            </li>
            <li>
              <a href="javascript:;"> <i class="material-icons">location_on</i> <span class="title">Maps</span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="google_map.html"> Google Maps </a> </li>
                <li> <a href="vector_map.html"> Vector Maps </a> </li>
              </ul>
            </li>
            <li>
              <a href="charts.html"> <i class="material-icons">timeline</i> <span class="title">Charts</span> </a>
            </li>
            <li>
              <a href="javascript:;"> <i class="material-icons">layers</i> <span class="title">Extra</span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="user-profile.html"> User Profile </a> </li>
                <li> <a href="time_line.html"> Time line </a> </li>
                <li> <a href="support_ticket.html"> Support Ticket </a> </li>
                <li> <a href="gallery.html"> Gallery</a> </li>
                <li class=""><a href="calender.html"> Calendar</a> </li>
                <li> <a href="search_results.html"> Search Results </a> </li>
                <li> <a href="invoice.html"> Invoice </a> </li>
                <li> <a href="404.html"> 404 Page </a> </li>
                <li> <a href="500.html"> 500 Page </a> </li>
                <li> <a href="blank_template.html"> Blank Page </a> </li>
                <li> <a href="login.html"> Login </a> </li>
                <li> <a href="login_v2.html">Login v2</a> </li>
                <li> <a href="lockscreen.html"> Lockscreen </a> </li>
              </ul>
            </li>
            <li class="">
              <a href="javascript:;"> <i class="material-icons">more_horiz</i> <span class="title">Menu Levels</span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="javascript:;"> Level 1 </a> </li>
                <li>
                  <a href="javascript:;"> <span class="title">Level 2</span> <span class=" arrow"></span> </a>
                  <ul class="sub-menu">
                    <li> <a href="javascript:;"> Sub Menu </a> </li>
                    <li> <a href="ujavascript:;"> Sub Menu </a> </li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="hidden-lg hidden-md hidden-xs" id="more-widgets">
              <a href="javascript:;"> <i class="material-icons"></i></a>
              <ul class="sub-menu">
                <li class="side-bar-widgets">
                  <p class="menu-title sm">FOLDER <span class="pull-right"><a href="#" class="create-folder"><i class="material-icons">add</i></a></span></p>
                  <ul class="folders">
                    <li>
                      <a href="#">
                        <div class="status-icon green"></div>
                        My quick tasks </a>
                    </li>
                    <li>
                      <a href="#">
                        <div class="status-icon red"></div>
                        To do list </a>
                    </li>
                    <li>
                      <a href="#">
                        <div class="status-icon blue"></div>
                        Projects </a>
                    </li>
                    <li class="folder-input" style="display:none">
                      <input type="text" placeholder="Name of folder" class="no-boarder folder-name" name="" id="folder-name">
                    </li>
                  </ul>
                  <p class="menu-title">PROJECTS </p>
                  <div class="status-widget">
                    <div class="status-widget-wrapper">
                      <div class="title">Freelancer<a href="#" class="remove-widget"><i class="material-icons">close</i></a></div>
                      <p>Redesign home page</p>
                    </div>
                  </div>
                  <div class="status-widget">
                    <div class="status-widget-wrapper">
                      <div class="title">envato<a href="#" class="remove-widget"><i class="material-icons">close</i></a></div>
                      <p>Statistical report</p>
                    </div>
                  </div>
                </li>
              </ul>
            </li>-->
          </ul>
          <!--<div class="side-bar-widgets">
            <p class="menu-title sm">FOLDER <span class="pull-right"><a href="#" class="create-folder"> <i class="material-icons">add</i></a></span></p>
            <ul class="folders">
              <li>
                <a href="#">
                  <div class="status-icon green"></div>
                  My quick tasks </a>
              </li>
              <li>
                <a href="#">
                  <div class="status-icon red"></div>
                  To do list </a>
              </li>
              <li>
                <a href="#">
                  <div class="status-icon blue"></div>
                  Projects </a>
              </li>
              <li class="folder-input" style="display:none">
                <input type="text" placeholder="Name of folder" class="no-boarder folder-name" name="">
              </li>
            </ul>
            <p class="menu-title">PROJECTS </p>
            <div class="status-widget">
              <div class="status-widget-wrapper">
                <div class="title">Freelancer<a href="#" class="remove-widget"><i class="material-icons">close</i></a></div>
                <p>Redesign home page</p>
              </div>
            </div>
            <div class="status-widget">
              <div class="status-widget-wrapper">
                <div class="title">envato<a href="#" class="remove-widget"><i class="material-icons">close</i></a></div>
                <p>Statistical report</p>
              </div>
            </div>
          </div>-->
          <div class="clearfix"></div>
          <!-- END SIDEBAR MENU -->
        </div>
      </div>
      <a href="#" class="scrollup">Scroll</a>
      <div class="footer-widget">
        <div class="progress transparent progress-small no-radius no-margin">
          <div class="progress-bar progress-bar-success animate-progress-bar" data-percentage="79%" style="width: 79%;"></div>
        </div>
        <div class="pull-right">
          <div class="details-status"> <span class="animate-number" data-value="86" data-animation-duration="560">86</span>% </div>
          <a href="auth-log-out.php?SignIn"><i class="material-icons">power_settings_new</i></a></div>
      </div>