<div class="page-sidebar" id="main-menu">
    <?php
        $user_id = $_SESSION['userId'];
        $sql = "SELECT mid, name_english, userpic, name_bangla,designation FROM tblapplicantinfo WHERE mid = {$user_id}";
        $result = $connect->query($sql);
        while($row = $result->fetch_array()) {
            $imageUrl = substr($row[2], 3);
            $userpic = "<img class='h-auto rounded-circle profile-img' src='".$imageUrl."' />";
    ?>
    
    <style>
        /* --- DASHING SIDEBAR CSS --- */
        .page-sidebar { background-color: #1b1e24 !important; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        /* Profile Section Styling */
        .user-info-wrapper {
            padding: 20px 15px;
            background: rgba(255, 255, 255, 0.03);
            margin: 15px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            display: flex; align-items: center;
        }
        .profile-wrapper { border: 2px solid #00adef; border-radius: 50%; padding: 3px; position: relative; }
        .profile-img { width: 60px; height: 60px; border-radius: 50%; object-fit: cover; }
        .availability-bubble.online { width: 12px; height: 12px; background: #04d39f; border: 2px solid #1b1e24; position: absolute; bottom: 5px; right: 0; border-radius: 50%; }
        .user-info { margin-left: 12px; }
        .user-info .username { color: #fff; font-weight: 700; font-size: 14px; margin-bottom: 2px; }
        .user-info .user-role { color: #00adef; font-size: 11px; font-weight: 600; text-transform: uppercase; }

        /* Menu Styling */
        #main-menu ul { list-style: none; padding: 0 10px; }
        #main-menu ul li { margin-bottom: 5px; }
        #main-menu ul li a {
            padding: 12px 15px !important;
            border-radius: 12px;
            color: #b8c7ce !important;
            display: flex; align-items: center;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-decoration: none;
        }
        #main-menu ul li a i { font-size: 20px; margin-right: 15px; transition: all 0.3s; color: #808b96; }
        
        /* Hover Effects */
        #main-menu ul li a:hover {
            background: linear-gradient(90deg, rgba(0, 173, 239, 0.2) 0%, rgba(1, 173, 239, 0) 100%) !important;
            color: #fff !important;
            padding-left: 20px !important;
        }
        #main-menu ul li a:hover i { color: #00adef; transform: scale(1.2) rotate(-5deg); text-shadow: 0 0 8px rgba(0, 173, 239, 0.5); }

        /* Sub Menu Styling */
        .sub-menu { background: rgba(0, 0, 0, 0.15) !important; border-radius: 10px; margin: 5px 0 5px 20px !important; border-left: 1px solid rgba(0, 173, 239, 0.3); }
        .sub-menu li a { font-size: 13px !important; padding: 8px 15px !important; }
        .sub-menu li a:hover { background: transparent !important; color: #00adef !important; padding-left: 25px !important; }

        /* Active State */
        li.active > a { background: #00adef !important; color: #fff !important; box-shadow: 0 4px 15px rgba(0, 173, 239, 0.4); }
        li.active > a i { color: #fff !important; }

        /* Pulse Animation for Refresh */
        .refresh-icon { animation: spin 4s linear infinite; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
    </style>

    <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
        <div class="user-info-wrapper">
            <div class="profile-wrapper">
                <?php echo $userpic ?>
                <div class="availability-bubble online"></div>
            </div>
            <div class="user-info">
                <div class="username"><?php echo $row['name_english'] ?></div>
                <div class="user-role"><?php echo $row['designation'] ?></div>
                <div class="user-role" style="font-size: 9px; opacity: 0.6; color: #fff;">Online Status</div>
            </div>
        </div>
        <?php } ?>
        <p class="menu-title sm" style="padding-left: 25px; color: rgba(255,255,255,0.3);">BROWSE <span class="pull-right"><a href="javascript:;"><i class="material-icons refresh-icon" style="font-size: 14px;">refresh</i></a></span></p>
        
        <ul>
            <li class="start active"> 
                <a href="dashboard-member.php">
                    <i class="material-icons">dashboard</i> 
                    <span class="title">Dashboard</span> 
                    <span class="selected"></span> 
                </a>
            </li>     

            <li>
                <a href="constitution-new.php" style="display: flex; align-items: center; gap: 8px; font-weight: 600; transition: 0.3s; text-decoration: none; color: <?= ($current_page == 'constitution.php') ? '#6f42c1' : '#444'; ?>; background: <?= ($current_page == 'constitution.php') ? 'rgba(111, 66, 193, 0.1)' : 'transparent'; ?>; padding: 5px 10px; border-radius: 5px;">
                    <i class="bi bi-journal-bookmark-fill" style="font-size: 18px; color: #6f42c1; filter: drop-shadow(0 2px 4px rgba(111, 66, 193, 0.2));"></i> Constitution
                </a>
            </li>

            <li>
                <a href="javascript:;"> 
                    <i class="material-icons">account_balance_wallet</i> 
                    <span class="title">Deposit Info</span> 
                    <span class="arrow"></span> 
                </a>
                <ul class="sub-menu">
                    <li> <a href="transection-deposit-entry.php?id=1&DepositEntry">Deposit Entry [Cash]</a> </li>
                    <li> <a href="transection-deposit-entry.php?id=2&DepositEntry">Deposit Entry [Online Banking]</a> </li>
                    <li> <a href="transection-deposit-entry.php?id=3&DepositEntry">Deposit Entry [Mobile Banking]</a> </li>
                    <li> <a href="member-deposit-summary-self.php?SelfDepositSummary">My Deposit Summary</a> </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;"> 
                    <i class="material-icons">assignment_ind</i> 
                    <span class="title">Application Info</span> 
                    <span class="arrow"></span> 
                </a>
                <ul class="sub-menu">
                    <li> <a href="application-resign-info.php?ResignApplication">Resign Application</a> </li>
                    <li> <a href="01-loan-apply.php?LoanApplication">Loan Application</a> </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;"> 
                    <i class="material-icons">monetization_on</i> 
                    <span class="title">Loan Management</span> 
                    <span class="arrow"></span> 
                </a>
                <ul class="sub-menu">
                    <li> <a href="loan-emi-calculator.php?EMICalculator">EMI Calculator</a> </li>
                    <li> <a href="01-loan-apply.php?LoanApplication">Loan Application</a> </li>
                    <li> <a href="loan-schedule.php?LoanSchedule">Loan Schedule </a> </li>

                    <li> <a href="transection-loanemi-entry.php?id=1&DepositEntry">Loan EMI Paid [Cash]</a> </li>
                    <li> <a href="transection-loanemi-entry.php?id=2&DepositEntry">Loan EMI Paid [Online Banking]</a> </li>
                    <li> <a href="transection-loanemi-entry.php?id=3&DepositEntry">Loan EMI Paid [Mobile Banking]</a> </li>
                    <!--<li> <a href="member-deposit-summary-self.php?SelfDepositSummary">My Loan Summary</a> </li>-->
                </ul>
            </li>

            <li>
                <a href="sms-sent-self-info.php?SMSSentInfo"> 
                    <i class="material-icons">forum</i> 
                    <span class="title">SMS List</span>
                    <span class="badge badge-info pull-right" style="font-size: 9px;">New</span>
                </a>
            </li>
            
            <li>
                <a href="javascript:;"> 
                    <i class="material-icons">manage_accounts</i> 
                    <span class="title">Account Settings</span> 
                    <span class="arrow"></span> 
                </a>
                <ul class="sub-menu">
                    <li> <a href="member-profile.php?MemberProfile">My Profile</a> </li>
                    <li> <a href="member-nominee-info.php?NomineeInfo">Nominee Info</a> </li>
                    <li> <a href="member-bank-info.php?NomineeBankInfo">Bank Account</a> </li>
                    <li> <a href="auth-member-security.php?PasswordChange">Change Password</a> </li>
                    <li> <a href="auth-log-out.php?SignOut" style="color: #ff5b5b !important;">Log Out</a> </li>
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