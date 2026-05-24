<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>Yearly Deposit Info | NHCS</title>  
    <?php require_once 'layouts/HeaderDTPage.php'; ?>
    <?php include ('layouts/1-base-head.php') ?>
    
    <style>
        :root {
            --nhcs-blue: #2962FF;   /* লোগোর রিবন ব্লু */
            --nhcs-purple: #6A1B9A; /* লোগোর হার্ট পার্পল */
            --nhcs-green: #00C853;  /* লোগোর তারার সবুজ */
            --nhcs-dark: #22262e;
        }
        
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, sans-serif; }
        
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
            font-size: 20px;
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
        #manageYearlyAmountInfoTable thead th {
            background-color: var(--nhcs-blue) !important;
            color: white !important;
            text-transform: uppercase;
            font-size: 13px;
            padding: 15px !important;
            border: none;
        }

        /* মোডাল ডিজাইন */
        .modal-content { border-radius: 15px; border: none; overflow: hidden; }
        .modal-header { background-color: var(--nhcs-purple); color: white; padding: 18px; }
        .modal-header .close { color: white; opacity: 1; }
        .modal-header h4 { color: white; font-weight: 600; margin: 0; }
        
        .input-group-addon {
            background-color: #f8f9fa !important;
            color: var(--nhcs-blue);
            border: 1px solid #ddd;
            border-radius: 8px 0 0 8px !important;
        }
        
        .form-control { 
            border-radius: 0 8px 8px 0 !important; 
            border: 1px solid #ddd; 
            height: 42px;
        }

        .footer-custom {
            padding: 20px;
            background: #fff;
            border-top: 1px solid #eee;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <?php include ('layouts/2-base-header.php') ?>

    <div class="page-container row-fluid">
      <?php include ('layouts/4-base-menu.php') ?>

      <div class="page-content">
        <div class="content">
          <div class="row-fluid">
            <div class="span12">
              <div class="grid simple">
                <!-- হেডার সেকশন -->
                <div class="grid-title no-border">
                    <h3>Setup / <span style="color: var(--nhcs-green);">Yearly Deposit Info</span></h3>
                    <button class="btn btn-brand" data-toggle="modal" data-target="#addYearlyAmountInfoModel"> 
                        <i class="fa fa-plus-circle"></i> Add Yearly Deposit Amount 
                    </button>
                </div>
                
                <!-- টেবিল বডি -->
                <div class="grid-body no-border">
                    <div class="table-responsive" style="padding: 10px;">
                        <table class="table table-hover" id="manageYearlyAmountInfoTable" style="width:100%;"> 
                            <thead>
                                <tr>
                                    <th class="text-center">Sl No</th>
                                    <th>Deposit Last Date</th>
                                    <th>Yearly Amount</th>               	
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

        <!-- Add Yearly Amount Modal -->
        <div class="modal fade" id="addYearlyAmountInfoModel" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" id="submitYearlyAmountInfoForm" action="php_action/createSetupYearlyAmountInfo.php" method="POST">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Add Yearly Deposit</h4>
                        </div>
                        <div class="modal-body" style="padding: 30px;">
                            <div id="add-yearamountinfo-messages"></div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Deposit Last Date</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="date" class="form-control" name="DepositDate" id="DepositDate" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Yearly Amount</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                        <input type="number" class="form-control" name="YearlyAmount" id="YearlyAmount" placeholder="Enter Amount" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-brand" id="createYearlyAmountInfoBtn">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Yearly Amount Modal -->
        <div class="modal fade" id="editYearlyAmountInfoModel" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form-horizontal" id="editYearlyAmountInfoForm" action="php_action/editSetupYearlyAmountInfo.php" method="POST">
                        <div class="modal-header" style="background: var(--nhcs-dark);">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Deposit Info</h4>
                        </div>
                        <div class="modal-body" style="padding: 30px;">
                            <div id="edit-yearlyamountinfo-messages"></div>
                            <div class="modal-loading div-hide text-center" style="padding: 20px;">
                                <i class="fa fa-spinner fa-spin fa-3x" style="color: var(--nhcs-blue);"></i>
                            </div>
                            <div class="edit-yearlyamountinfo-result">
                                <input type="hidden" name="editYearlyAmountId" id="editYearlyAmountId" />
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Deposit Last Date</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>
                                            <input type="date" class="form-control" id="editDepositDate" name="editDepositDate" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Yearly Amount</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-database"></i></span>
                                            <input type="number" class="form-control" id="editYearlyAmount" name="editYearlyAmount" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-brand" id="editYearlyAmountInfoBtn">Update Info</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include ('layouts/footer.php') ?>

      </div> <!-- /.page-content -->
    </div> <!-- /.page-container -->

    <!-- JS Assets -->
    <?php include ('layouts/5-base-js.php') ?> 
    <script src="custom/js/setup-yearly-amont-info.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>
</body>
</html>
