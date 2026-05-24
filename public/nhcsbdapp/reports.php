<?php require_once 'php_action/core.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Reports | Nurses Health Care Society </title>
    <?php require_once 'layouts/HeaderDTPage.php'; ?>
    <?php include ('layouts/1-base-head.php') ?>
    
    <style>
        /* Smart Custom Styles */
        .report-card { border-radius: 10px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .grid-title { background: #f8f9fa; border-bottom: 2px solid #eee; padding: 15px 20px !important; border-radius: 10px 10px 0 0; }
        .report-form-container { padding: 30px; }
        .form-label { font-weight: 600; color: #555; }
        .input-group-text { background: #fff; border-right: none; }
        .form-control { border-radius: 6px !important; border-left: 2px solid #28a745 !important; }
        #generateReportBtn { padding: 10px 25px; font-weight: bold; border-radius: 30px; transition: 0.3s; }
        #generateReportBtn:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(40,167,69,0.3); }
    </style>
</head>

<body class="">
    <?php include ('layouts/2-base-header.php') ?>

    <div class="page-container row-fluid">
        <?php include ('layouts/4-base-menu.php') ?>

        <div class="page-content">
            <div class="content">
                <div class="row-fluid">
                    <div class="span10 offset1"> <!-- Center aligned -->
                        
                        <?php if(isset($_GET['id']) && $_GET['id'] == 1) { ?>
                        <div class="grid simple report-card">
                            <div class="grid-title">
                                <h3><i class="fa fa-file-text-o"></i> Deposit <span class="semi-bold">Details Report</span></h3>
                            </div>
                            
                            <div class="report-form-container bg-white">
                                <form action="php_action/reports-deposit.php" method="post" id="getDepositReportForm">
                                    <div class="row">
                                        <!-- Start Date -->
                                        <div class="span5">
                                            <div class="control-group">
                                                <label class="form-label" for="startDate">Start Date</label>
                                                <div class="controls">
                                                    <input type="date" class="form-control span12" id="startDate" name="startDate" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- End Date -->
                                        <div class="span5">
                                            <div class="control-group">
                                                <label class="form-label" for="endDate">End Date</label>
                                                <div class="controls">
                                                    <input type="date" class="form-control span12" id="endDate" name="endDate" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Button -->
                                        <div class="span2">
                                            <div class="control-group">
                                                <label class="form-label">&nbsp;</label> <!-- Empty label for alignment -->
                                                <div class="controls">
                                                    <button type="submit" class="btn btn-success btn-cons" id="generateReportBtn">
                                                        <i class="fa fa-check"></i> Generate
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div id="footer">
            <div class="copyright text-center p-3"> 
                © 2026, made with ❤️ by <a href="#" style="color:#28a745; font-weight:bold;">Matrik Solutions</a>
            </div>
        </div>
    </div>

    <?php include ('layouts/5-base-js.php') ?>
    <script src="custom/js/reports.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>
</body>
</html>
