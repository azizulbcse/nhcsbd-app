      <div class="page-sidebar " id="main-menu">
        <!-- BEGIN MINI-PROFILE -->
          <?php
	          $user_id = $_SESSION['userId'];
	          $sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id}";
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
              <div class="status"><?php echo $row['fullname'] ?></div>
              <div class="status"><?php echo $row['designations'] ?></div>
              <div class="status">Life goes on...</div>
            </div>
          </div>
          <?php } ?>
          <!-- END MINI-PROFILE -->

          <!-- BEGIN SIDEBAR MENU -->
          <p class="menu-title sm">BROWSE <span class="pull-right"><a href="javascript:;"><i class="material-icons">refresh</i></a></span></p>
          <ul>
            <li class="start  open active "> <a href="dashboard.php"><i class="material-icons">home</i> <span class="title">Dashboard</span> <span class="selected"></span> </a>
              <!--<ul class="sub-menu">
                <li> <a href="dashboard.phpl"> Dashboard v1 </a> </li>
                <li class=""> <a href="dashboard.php"> Dashboard <span class=" label label-info pull-right m-r-30">NEW</span></a></li>
              </ul>-->
            </li>           

            <li>
              <a href="javascript:;"> <i class="material-icons">airplay</i> <span class="title">Setup</span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="setup-hospital-info.php?HospitalInfo"> Hospital Info </a> </li>
                <li> <a href="setup-bank-info.php?BankInfo"> Bank Info </a> </li>
                <li> <a href="setup-depositmonth-info.php?DepositMonthInfo"> Deposit Month Info </a> </li>
                <li> <a href="setup-resign-Reasons-info.php?ResignationReasonsListInfo"> Resignation Reasons List Info</a> </li>
                <li> <a href="setup-loan-type-info.php"> Loan Type List Info</a> </li>
                <li> <a href="setup-yearly-deposit-info.php?YearlyDepositInfo"> Yearly Deposit Info </a> </li>
              </ul>
            </li>

            <li>
              <a href="javascript:;"> <i class="material-icons">apps</i> <span class="title">Member Deposit Info </span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="transection-deposit-list-info.php?id=1&DepositList"> Deposit Entry List </a> </li>
                <li> <a href="member-deposit-summary.php?MemberDepositSummary"> Deposit Summary List </a> </li>   
                <li> <a href="transection-deposit-entry-all.php?id=1&DepositEntry"> Edit Deposit Entry [Cash] </a> </li>
                <li> <a href="transection-deposit-entry-all.php?id=2&DepositEntry"> Edit Deposit Entry [Online Banking] </a> </li>
                <li> <a href="transection-deposit-entry-all.php?id=3&DepositEntry"> Edit Deposit Entry [Mobile Banking] </a> </li>             
              </ul>
            </li>

            <!--<li>
              <a href="javascript:;"> <i class="material-icons">panorama_horizontal</i> <span class="title">Share Holder Deposit </span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="transection-deposit-list-info.php?id=2&DepositList"> Deposit Entry List </a> </li>
                <li> <a href="sh-deposit-summary.php?ShareHolderDepositSummary"> Deposit Summary List </a> </li>   
                <li> <a href="transection-sh-deposit-entry-all.php?id=1&DepositEntry"> Edit Deposit Entry [Cash] </a> </li>
                <li> <a href="transection-sh-deposit-entry-all.php?id=2&DepositEntry"> Edit Deposit Entry [Online Banking] </a> </li>
                <li> <a href="transection-sh-deposit-entry-all.php?id=3&DepositEntry"> Edit Deposit Entry [Mobile Banking] </a> </li>             
              </ul>
            </li>-->

            <li>
              <a href="javascript:;"> <i class="material-icons">flip</i><span class="title"> Member Profile Info </span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="member-list-info.php?MemberInfo"> All Member Info  </a> </li>
                <li> <a href="member-nominee-info.php?NomineeInfo">Member Nominee Info</a> </li>
                <li> <a href="member-bank-info.php?NomineeBankInfo">Member Bank Acc Info</a> </li>          
              </ul>
            </li>

            <!--<li>
              <a href="javascript:;"> <i class="material-icons">layers</i><span class="title"> Share Holder Info </span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="shareholder-list-info.php?ShareHolderInfo"> All Share Holder Info  </a> </li>
                <li> <a href="shareholder-nominee-info.php?ShareHolderNomineeInfo">Share Holder Nominee Info</a> </li>
                <li> <a href="shareholder-bank-info.php?ShareHolderBankInfo">Share Holder Bank Acc Info</a> </li>        
              </ul>
            </li>-->

            <li>
              <a href="javascript:;"> <i class="material-icons">timeline</i> <span class="title">Application Info</span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="application-resign-list.php?ResignApplication"> Resign Application </a> </li>
                <li> <a href="#"> Personal Loan Application </a> </li>
                <li> <a href="#"> Health Loan Application </a> </li>
              </ul>
            </li>

            <?php
	            $user_id = $_SESSION['userId'];	 
	            $sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','Founder & General Secretary','Accountant','Assistant Accountant')";
	            $result = $connect->query($sql);
	            while($row = $result->fetch_array()) {
            ?>  

            <li class="">
              <a href="javascript:;"> <i class="material-icons">more_horiz</i> <span class="title">Donation Info</span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="transection-donation-list-info.php?DonationList"> Donation List </a> </li>
                <!--<li> <a href="member-donation-summary.php?MemberDonationSummary"> Donation Summary List </a> </li>-->  
                <li> <a href="transection-expense-donetion-entry-info.php?DonetionExpence"> Donation Expence Info </a> </li>              
              </ul>
            </li>

            <li>
              <a href="javascript:;"> <i class="material-icons">view_stream</i> <span class="title">Accounts Info</span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="setup-account-group-info.php?AccountGroup"> Account Group </a> </li>
                <li> <a href="setup-account-head-info.php?AccountHead"> Account Head </a> </li>
                <li> <a href="setup-account-payee-info.php?Payee"> Payee Too </a> </li>
                <li> <a href="transection-expense-entry-info.php?ExpenseEntryInfo"> Expense Entry </a> </li>
                <li> <a href="transection-income-entry-info.php?id=1&MemberResignIncomeEntry"> Member Resign Income Info </a> </li>
                <li> <a href="transection-income-entry-info.php?id=2&OthersIncomeEntry"> Others Income Entry </a> </li>
              </ul>
            </li>

            <li>
              <a href="javascript:;"> <i class="material-icons">playlist_add_check</i> <span class="title">Reports</span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="reports.php?id=1&amp;DepositDetails"> Deposit Details </a> </li>
              </ul>
            </li>
            <?php } ?>

            <li>
              <a href="javascript:;"> <i class="material-icons">email</i> <span class="title">SMS Info</span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="sms-sent-info.php?SMSSentInfo"> SMS Sent List </a> </li>
                <li> <a href="sms-individual-info.php?IndividualSMSInfo"> SMS Sent for Member </a> </li>
                <li> <a href="sms-allmember-info.php?AllMemberSMSInfo"> SMS Sent for All Member </a> </li>
                <!--<li> <a href="sms-sh-individual-info.php?IndividualSMSInfo"> SMS Sent for Share Holder </a> </li>
                <li> <a href="sms-allshareholder-info.php?AllShareHolderSMSInfo"> SMS Sent for All Share Holder </a> </li>-->
              </ul>
            </li>            

            <li>
              <a href="javascript:;"> <i class="material-icons">invert_colors</i> <span class="title">Authentications</span> <span class=" arrow"></span> </a>
              <ul class="sub-menu">
                <li> <a href="auth-user-list.php?AdministratorList">Administrator List </a> </li>
                <li> <a href="member-username-list.php?MemberUsernameList">Member Username List</a> </li>
                <!--<li> <a href="sh-username-list.php?ShareHolderUsernameList">Share Holder Username List</a> </li>-->
                <li> <a href="auth-user-security.php?PasswordChange">Change Password</a> </li>
                <li> <a href="auth-log-out.php?SignIn">Log out</a> </li>
              </ul>
            </li>
          </ul>
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