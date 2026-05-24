<div class="page-sidebar" id="main-menu">
  <?php
    $user_id = $_SESSION['userId'];
    $sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id}";
    $result = $connect->query($sql);
    while($row = $result->fetch_array()) {
      $imageUrl = substr($row[2], 3);
      $userpic = "<img class='new-profile-img' src='".$imageUrl."' />";
  ?>
  <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
    <div class="user-info-wrapper custom-compact-admin">
      <div class="profile-wrapper">
        <?php echo $userpic ?>
        <div class="availability-bubble online"></div>
      </div>
      <div class="user-info">
        <div class="username-text"><?php echo $row['fullname'] ?></div>
        <div class="designation-text"><?php echo $row['designations'] ?></div>
      </div>
    </div>
  <?php } ?>
  
  <ul class="nav-main">
    <li class="start open active"> 
      <a href="dashboard.php"><i class="material-icons">dashboard</i> <span class="title">Dashboard</span></a>
    </li>          

    <li>
      <a href="javascript:;"> <i class="material-icons">settings</i> <span class="title">Setup</span> <span class="arrow"></span> </a>
      <ul class="sub-menu">
        <li> <a href="setup-hospital-info.php?HospitalInfo"> Hospital Info </a> </li>
        <li> <a href="setup-bank-info.php?BankInfo"> Bank Info </a> </li>
        <li> <a href="setup-depositmonth-info.php?DepositMonthInfo"> Deposit Month Info </a> </li>
        <li> <a href="setup-resign-Reasons-info.php?ResignationReasonsListInfo"> Resignation Reasons </a> </li>
        <li> <a href="setup-loan-type-info.php"> Loan Type Info</a> </li>
        <li> <a href="setup-yearly-deposit-info.php?YearlyDepositInfo"> Yearly Deposit </a> </li>
      </ul>
    </li>

    <li>
      <a href="javascript:;"> <i class="material-icons">account_balance_wallet</i> <span class="title">Member Deposit Info</span> <span class="arrow"></span> </a>
      <ul class="sub-menu">
        <li> <a href="transection-deposit-list-info.php?id=1&DepositList"> Deposit Entry List </a> </li>
        <li> <a href="member-deposit-summary.php?MemberDepositSummary"> Deposit Summary </a> </li>   
        <li> <a href="transection-deposit-entry-all.php?id=1&DepositEntry"> Edit Deposit [Cash] </a> </li>
        <li> <a href="transection-deposit-entry-all.php?id=2&DepositEntry"> Edit Deposit [Online Banking] </a> </li>
        <li> <a href="transection-deposit-entry-all.php?id=3&DepositEntry"> Edit Deposit [Mobile Banking] </a> </li>   
        <li> <a href="transection-deposit-list-mw-info.php?&DepositList"> Deposit List Month Wise </a> </li>          
      </ul>
    </li>

    <li>
      <a href="javascript:;"> <i class="material-icons">group</i><span class="title"> Member Profile Info </span> <span class="arrow"></span> </a>
      <ul class="sub-menu">
        <li> <a href="member-list-info.php?MemberInfo"> All Member Info </a> </li>
        <li> <a href="member-nominee-info.php?NomineeInfo">Member Nominee Info</a> </li>
        <li> <a href="member-bank-info.php?NomineeBankInfo">Member Bank Acc Info</a> </li>          
      </ul>
    </li>

    <li>
      <a href="javascript:;"> <i class="material-icons">assignment_turned_in</i> <span class="title">Application Info</span> <span class="arrow"></span> </a>
      <ul class="sub-menu">
        <li> <a href="application-resign-list.php?ResignApplication"> Resign Application </a> </li>
        <li> <a href="loan-apply-list.php?LoanApplyList">Loan Application List</a> </li>
      </ul>
    </li>

    <?php
      $user_id = $_SESSION['userId'];  
      $sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','Founder & General Secretary','Accountant','Assistant Accountant')";
      $result = $connect->query($sql);
      while($row = $result->fetch_array()) {
    ?>  

    <li>
      <a href="javascript:;"> <i class="material-icons">volunteer_activism</i> <span class="title">Donation Info</span> <span class="arrow"></span> </a>
      <ul class="sub-menu">
        <li> <a href="transection-donation-list-info.php?DonationList"> Donation List </a> </li>
        <li> <a href="transection-expense-donetion-entry-info.php?DonetionExpence"> Donation Expense </a> </li>               
      </ul>
    </li>

    <li>
      <a href="javascript:;"> <i class="material-icons">account_balance</i> <span class="title">Accounts Info</span> <span class="arrow"></span> </a>
      <ul class="sub-menu">
        <li> <a href="setup-account-group-info.php?AccountGroup"> Account Group </a> </li>
        <li> <a href="setup-account-head-info.php?AccountHead"> Account Head </a> </li>
        <li> <a href="setup-account-payee-info.php?Payee"> Payee Too </a> </li>
        <li> <a href="transection-expense-entry-info.php?ExpenseEntryInfo"> Expense Entry </a> </li>
        <li> <a href="transection-income-entry-info.php?id=1&MemberResignIncomeEntry"> Resign Income </a> </li>
        <li> <a href="transection-income-entry-info.php?id=2&OthersIncomeEntry"> Others Income Entry </a> </li>
      </ul>
    </li>
    <?php } ?>

    <li>
      <a href="javascript:;"> <i class="material-icons">assessment</i> <span class="title">Reports</span> <span class="arrow"></span> </a>
      <ul class="sub-menu">
        <li> <a href="reports.php?id=1&amp;DepositDetails"> Deposit Details </a> </li>
        <li> <a href="member-statement-dw.php"> Member Statement </a> </li>
      </ul>
    </li>

    <li>
        <a href="javascript:;"> <i class="material-icons">monetization_on</i> <span class="title">Loan Management</span> 
                    <span class="arrow"></span> 
                </a>
                <ul class="sub-menu">
                    <li> <a href="loan-emi-calculator-admin.php?EMICalculator">EMI Calculator</a> </li>
                    <li> <a href="loan-schedule-admin.php?LoanSchedule">Loan Schedule</a> </li>
                    <li> <a href="loan-instalmentpaid-info.php?id=1&LoanPaidInfo">Loan Instalment Paid Info</a> </li>
                </ul>
            </li>
    <li>

      <a href="javascript:;"> <i class="material-icons">textsms</i> <span class="title">SMS Info</span> <span class="arrow"></span> </a>
      <ul class="sub-menu">
        <li> <a href="sms-sent-info.php?SMSSentInfo"> SMS Sent List </a> </li>
        <li> <a href="sms-individual-info.php?IndividualSMSInfo"> Individual SMS </a> </li>
        <li> <a href="sms-allmember-info.php?AllMemberSMSInfo"> All Member SMS </a> </li>
        <!--<li> <a href="sms-sh-individual-info.php?IndividualSMSInfo"> SMS Sent for Share Holder </a> </li>
        <li> <a href="sms-allshareholder-info.php?AllShareHolderSMSInfo"> SMS Sent for All Share Holder </a> </li>-->
      </ul>
    </li>

    <?php
      $user_id = $_SESSION['userId'];  
      $sql = "SELECT user_id,username,userpic,fullname,designations,usertype FROM tbladminuser WHERE user_id = {$user_id} and designations IN ('Software Engineer','Founder & General Secretary')";
      $result = $connect->query($sql);
      while($row = $result->fetch_array()) {
    ?>  
    
    <li>
      <a href="javascript:;"> <i class="material-icons">photo_library</i> <span class="title">Gallery</span> <span class="arrow"></span> </a>
      <ul class="sub-menu">
        <li><a href="photos-list.php?PhotosList">Photos List</a></li>
        <!--<li><a href="videos.php">Videos</a></li>-->
      </ul>
    </li>
    
    <li>
      <a href="javascript:;"> <i class="material-icons">notifications</i> <span class="title">Notice</span> <span class="arrow"></span> </a>
      <ul class="sub-menu">
        <li> <a href="notice-list-info.php?NoticeList"> Notice List </a> </li>
      </ul>
    </li>
    <?php } ?>

    <li>
      <a href="javascript:;"> <i class="material-icons">admin_panel_settings</i> <span class="title">Authentications</span> <span class="arrow"></span> </a>
      <ul class="sub-menu">
        <li> <a href="auth-user-list.php?AdministratorList">Admin List </a> </li>
        <li> <a href="member-username-list.php?MemberUsernameList">Member Username List</a> </li>
        <!--<li> <a href="sh-username-list.php?ShareHolderUsernameList">Share Holder Username List</a> </li>-->
        <li> <a href="auth-user-security.php?PasswordChange">Change Password</a> </li>
        <li> <a href="auth-log-out.php?SignIn" style="color:#f35958 !important;">Log out</a> </li>
      </ul>
    </li>
  </ul>
  <div class="clearfix"></div>
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

<style>
/* সাইডবার পজিশন */
.page-sidebar { background-color: #1b1e24 !important; }
#main-menu-wrapper { padding-top: 2px !important; }

/* প্রোফাইল সেকশন - টাইট হাইট */
.custom-compact-admin {
    display: flex !important;
    align-items: center !important;
    padding: 8px 15px !important; 
    background: rgba(255,255,255,0.03);
    border-bottom: 1px solid rgba(255,255,255,0.05);
    margin-top: 10px !important; /* হেডার থেকে নিরাপদ দূরত্ব */
}

.new-profile-img {
    width: 42px !important;
    height: 42px !important;
    border-radius: 50%;
    border: 2px solid #00adef;
    object-fit: cover;
}

.username-text { color: #fff; font-size: 13px; font-weight: bold; line-height: 1.1; margin-left: 10px; }
.designation-text { color: #00adef; font-size: 10px; margin-left: 10px; }

/* মেইন মেনু আইটেম - ফন্ট সাইজ আগের মতো (১৩ পিক্সেল), কিন্তু প্যাডিং কম */
.nav-main { list-style: none; padding: 0 !important; margin: 0; }
.nav-main li a { 
    padding: 8px 18px !important; /* উচ্চতা কমানো হয়েছে কিন্তু ফন্ট বড় রাখা হয়েছে */
    font-size: 13px !important; 
    color: #b8c7ce !important;
    display: flex !important;
    align-items: center !important;
}

.nav-main li a i { 
    font-size: 18px !important; 
    margin-right: 12px !important; 
    color: #00adef;
}

/* সাব-মেনু */
.sub-menu { background: #14171a !important; padding: 0 !important; }
.sub-menu li a { 
    padding: 6px 15px 6px 48px !important; 
    font-size: 12px !important; 
}
</style>