<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>Month Info | Nurses Health Care Society</title>  
    
    <!-- Header & Base Assets -->
    <?php require_once 'layouts/HeaderDTPage.php'; ?>
    <?php include ('layouts/1-base-head.php') ?>

    <style>
        /* NHCS Brand Colors Integration */
        :root {
            --nhcs-blue: #2962FF;   /* লোগোর রিবন ব্লু */
            --nhcs-purple: #6A1B9A; /* লোগোর হার্ট পার্পল */
            --nhcs-green: #00C853;  /* লোগোর তারার সবুজ */
            --nhcs-dark: #22262e;
        }
        
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        /* স্মার্ট কার্ড ডিজাইন */
        .grid.simple {
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.05) !important;
            border: none !important;
            background: #fff;
            margin-top: 25px;
            overflow: hidden;
        }

        .grid-title {
            padding: 20px 30px !important;
            border-bottom: 2px solid #f1f1f1 !important;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .grid-title h3 {
            color: var(--nhcs-purple) !important;
            font-weight: 700 !important;
            margin: 0;
            font-size: 18px;
            border-left: 5px solid var(--nhcs-blue);
            padding-left: 15px;
        }

        /* প্রফেশনাল ব্র্যান্ড বাটন */
        .btn-brand {
            background-color: var(--nhcs-blue) !important;
            color: white !important;
            border: none !important;
            padding: 10px 22px !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease;
        }

        .btn-brand:hover {
            background-color: var(--nhcs-purple) !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(106, 27, 154, 0.3);
        }

        /* টেবিল ডিজাইন */
        #manageDepositMonthInfoTable thead th {
            background-color: var(--nhcs-blue) !important;
            color: white !important;
            text-transform: uppercase;
            font-size: 13px;
            padding: 15px !important;
            border: none;
        }

        /* মডাল স্টাইল */
        .modal-header-brand { background-color: var(--nhcs-purple); color: white; border-radius: 15px 15px 0 0; }
        .modal-header-brand h4, .modal-header-brand .close { color: white; opacity: 1; }
        .modal-content { border-radius: 15px; border: none; }
        .input-group-addon { background-color: #f8f9fa; color: var(--nhcs-blue); }
        .form-control { height: 42px; border-radius: 0 8px 8px 0 !important; }
        
        .footer-custom { padding: 20px; background: #fff; border-top: 1px solid #eee; text-align: center; margin-top: 30px; }
    </style>
</head>

<body class="">
    <?php include ('layouts/2-base-header.php') ?>

    <div class="page-container row-fluid">
      <?php include ('layouts/4-base-menu.php') ?>

      <div class="page-content">
        <div class="content">
          <div class="row-fluid">
            <div class="span12">
              <div class="grid simple ">
                <div class="grid-title no-border">
                  <h3>Setup / <span style="color: var(--nhcs-green);">Deposit Month Info</span></h3>
                  <button class="btn btn-brand" data-toggle="modal" data-target="#addDepositMonthInfoModel"> 
                      <i class="fa fa-plus-circle"></i> Add Deposit Month Name 
                  </button>
                </div>
                
                <div class="grid-body no-border">
                  <div class="table-responsive" style="padding: 10px;">
                    <table class="table table-hover" id="manageDepositMonthInfoTable" style="width:100%;"> 
                      <thead>
                        <tr>
                          <th class="text-center">Sl No</th>
                          <th>Deposit Month Name</th>
                          <th>Deposit Year</th>               	
                          <th class="text-center">Status</th>
                          <th class="text-center">Option</th>
                        </tr>              
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Add Deposit Month Modal -->
        <div class="modal fade" id="addDepositMonthInfoModel" tabindex="-1" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" id="submitBankInfoForm" action="php_action/createSetupDepositMonthInfo.php" method="POST">
                  <div class="modal-header modal-header-brand">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Add Deposit Month</h4>
                  </div>
                  <div class="modal-body" style="padding: 30px;">
                    <div id="add-bankinfo-messages"></div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Month Name</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control" id="DepositMonth" placeholder="e.g. January" name="DepositMonth" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Deposit Year</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                <input type="number" class="form-control" id="DepositYear" placeholder="e.g. 2024" name="DepositYear" required>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-brand" id="createBankInfoBtn">Save Changes</button>
                  </div>
                </form>
            </div>
          </div>
        </div>

        <!-- Edit Deposit Month Modal -->
        <div class="modal fade" id="editDepositMonthInfoModel" tabindex="-1" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" id="editBankInfoForm" action="php_action/editSetupDepositMonthInfo.php" method="POST">
                  <div class="modal-header modal-header-brand" style="background: var(--nhcs-dark);">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Month Info</h4>
                  </div>
                  <div class="modal-body" style="padding: 30px;">
                    <div id="edit-bankinfo-messages"></div>
                    <div class="modal-loading div-hide text-center"><i class="fa fa-spinner fa-spin fa-3x" style="color: var(--nhcs-blue);"></i></div>
                    <div class="edit-bankinfo-result">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Month Name</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>
                                    <input type="text" class="form-control" id="editDepositMonth" name="editDepositMonth" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Year</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                    <input type="number" class="form-control" id="editDepositYear" name="editDepositYear" required>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-brand" id="editBankInfoBtn">Update Changes</button>
                  </div>
                </form>
            </div>
          </div>
        </div>

        <!-- Footer -->
        <?php include ('layouts/footer.php') ?> 

      </div> <!-- /.page-content -->
    </div> <!-- /.page-container -->
    
    <?php include ('layouts/5-base-js.php') ?> 
    <script src="custom/js/setup-depositmonth-info.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>
</body>
</html>
