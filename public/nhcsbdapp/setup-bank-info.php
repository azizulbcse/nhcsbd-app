<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>Bank Info | Nurses Health Care Society</title>  
    
    <!-- ১. ফন্ট-অসাম আইকন ফিক্স (এটি অবশ্যই থাকতে হবে) -->
    <link rel="stylesheet" href="https://cloudflare.com">
    
    <?php require_once 'layouts/HeaderDTPage.php'; ?>
    <?php include ('layouts/1-base-head.php') ?>

    <style>
        :root {
            --nhcs-blue: #1a4d6d; 
            --nhcs-green: #05B262; 
        }
        
        body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
        
        /* স্মার্ট কার্ড ডিজাইন */
        .grid.simple {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05) !important;
            border: none !important;
            background: #fff;
            margin-top: 25px;
        }

        .grid-title {
            padding: 20px 25px !important;
            border-bottom: 1px solid #eee !important;
        }

        /* স্মার্ট বাটন */
        .btn-add-bank {
            background: linear-gradient(135deg, var(--nhcs-blue) 0%, #12364d 100%) !important;
            color: white !important;
            border: none !important;
            padding: 10px 22px !important;
            border-radius: 10px !important;
            font-weight: 600 !important;
            box-shadow: 0 4px 12px rgba(26, 77, 109, 0.2);
            transition: 0.3s;
        }

        .btn-add-bank:hover {
            transform: translateY(-2px);
            background: var(--nhcs-green) !important;
        }

        /* টেবিল হেডার */
        #manageBankInfoTable thead th {
            background-color: var(--nhcs-blue) !important;
            color: white !important;
            text-transform: uppercase;
            font-size: 13px;
            padding: 16px !important;
            border: none !important;
            text-align: center;
        }

        /* মোডাল স্মার্ট ইনপুট ফিল্ড */
        .input-group-addon {
            background-color: #f8f9fa !important;
            color: var(--nhcs-blue);
            border: 1.5px solid #e1e5e7;
            border-right: none;
            border-radius: 12px 0 0 12px !important;
            min-width: 45px;
        }
        
        .form-control { 
            border-radius: 0 12px 12px 0 !important; 
            border: 1.5px solid #e1e5e7; 
            padding: 10px 15px;
            height: 45px;
        }

        .modal-header { background-color: var(--nhcs-blue); color: white; border-radius: 15px 15px 0 0; }
        .modal-content { border-radius: 15px; border: none; }
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
                <div class="grid-title">
                  <div class="row-fluid">
                      <div class="span6">
                          <h3>Setup / <span class="semi-bold" style="color:var(--nhcs-green)">Bank Info</span></h3>
                      </div>
                      <div class="span6 text-right">
                          <button class="btn btn-add-bank" data-toggle="modal" data-target="#addBankInfoModel"> 
                              <i class="fa-solid fa-building-columns"></i> Add Bank Name 
                          </button>
                      </div>
                  </div>
                </div>
                
                <div class="grid-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="manageBankInfoTable" style="width:100%;"> 
                          <thead>
                            <tr>
                                <th style="width:10%;">Sl No</th>
                                <th>Bank Name</th>               	
                                <th>Status</th>
                                <th style="width:15%;">Option</th>
                            </tr>              
                          </thead>
                        </table>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Add Bank Modal (আইকনসহ) -->
        <div class="modal fade" id="addBankInfoModel" tabindex="-1" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" id="submitBankInfoForm" action="php_action/createSetupBankInfo.php" method="POST">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" style="color:white; opacity:1;">&times;</button>
                    <h4 class="modal-title" style="color:white;"><i class="fa-solid fa-plus-circle"></i> Add New Bank Info</h4>
                  </div>
                  <div class="modal-body" style="padding:35px;">
                    <div id="add-bankinfo-messages"></div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label fw-bold">Bank Name</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa-solid fa-university"></i></span>
                                <input type="text" class="form-control" id="bankName" placeholder="Enter Bank Name" name="bankName" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="createBankInfoBtn" style="background:var(--nhcs-blue); border:none; padding:10px 25px;"><i class="fa-solid fa-save"></i> Save Changes</button>
                  </div>
                </form>
            </div>
          </div>
        </div>

        <!-- Edit Bank Modal (আইকনসহ) -->
<div class="modal fade" id="editBankInfoModel" tabindex="-1" role="dialog" aria-labelledby="editBankInfoModelLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
            <form class="form-horizontal" id="editBankInfoForm" action="php_action/editSetupBankInfo.php" method="POST">
                
                <div class="modal-header" style="background-color: var(--nhcs-green); border-bottom: none;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:white; opacity:1;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" style="color:white; font-weight: 600;">
                        <i class="fa-solid fa-pen-to-square"></i> Edit Bank Info
                    </h4>
                </div>

                <div class="modal-body" style="padding: 30px 40px;">
                    <!-- সাকসেস বা এরর মেসেজ দেখানোর জায়গা -->
                    <div id="edit-bankinfo-messages"></div>

                    <!-- লোডিং স্পিনার -->
                    <div class="modal-loading div-hide text-center" style="padding: 20px;">
                        <i class="fa-solid fa-circle-notch fa-spin fa-3x" style="color:var(--nhcs-green)"></i>
                        <p style="margin-top: 10px; color: #666;">Loading Data...</p>
                    </div>

                    <div class="edit-bankinfo-result">
                        <!-- হিডেন আইডি ইনপুট: এটি আগে থেকেই রাখা স্মার্ট প্র্যাকটিস -->
                        <input type="hidden" name="BankId" id="BankId" />

                        <div class="form-group">
                            <label for="editbankName" class="col-sm-3 control-label fw-bold">Bank Name</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <span class="input-group-addon" style="background: #f8f9fa;">
                                        <i class="fa-solid fa-university"></i>
                                    </span>
                                    <input type="text" class="form-control" id="editbankName" name="editbankName" 
                                           placeholder="Enter bank name" autocomplete="off" required 
                                           style="border-left: none; height: 45px;">
                                </div>
                                <small class="help-block" id="bankNameError"></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="background: #f8f9fa; border-top: 1px solid #eee;">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 8px;">Close</button>
                    <button type="submit" class="btn btn-success" id="editBankInfoBtn" 
                            style="background:var(--nhcs-green); border:none; padding:10px 30px; border-radius: 8px; font-weight: bold; transition: 0.3s;">
                        <i class="fa-solid fa-check-double"></i> Update Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


        <!-- Delete Modal -->
        <div class="modal fade" id="removeBankInfoModel" tabindex="-1" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #d9534f;">
                <h4 class="modal-title" style="color:white;"><i class="fa-solid fa-trash-can"></i> Confirm Delete</h4>
              </div>
              <div class="modal-body text-center" style="padding:40px;">
                <i class="fa-solid fa-triangle-exclamation fa-4x" style="color:#d9534f; margin-bottom:20px;"></i>
                <h5>আপনি কি নিশ্চিতভাবে এই ব্যাংকের তথ্য মুছে ফেলতে চান?</h5>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">বাতিল</button>
                <button type="button" class="btn btn-danger" id="removeBankInfoBtn">ডিলিট করুন</button>
              </div>
            </div>
          </div>
        </div>
<?php include ('layouts/footer.php') ?> 
      </div>
    </div>

    <?php include ('layouts/5-base-js.php') ?> 
    <script src="custom/js/setup-bank-info.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>
</body>
</html>
