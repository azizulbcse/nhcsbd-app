<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>Hospital Info | NHCS</title>  
    <?php require_once 'layouts/HeaderDTPage.php'; ?>
    <?php include ('layouts/1-base-head.php') ?>
    
    <link rel="stylesheet" href="https://cloudflare.com">

    <style>
        :root {
            --nhcs-blue: #2962FF;   /* লোগোর রিবন ব্লু */
            --nhcs-purple: #6A1B9A; /* লোগোর হার্ট পার্পল */
            --nhcs-green: #00C853;  /* লোগোর তারার সবুজ */
        }
        
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        
        /* স্মার্ট কার্ড ডিজাইন */
        .grid.simple {
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.05) !important;
            border: none !important;
            background: #fff;
            margin-top: 25px;
        }

        .grid-title {
            padding: 20px !important;
            border-bottom: 2px solid #f1f1f1 !important;
        }

        .grid-title h3 {
            color: var(--nhcs-purple) !important; /* হেডলাইন লোগোর বেগুনি রঙে */
            font-weight: 700 !important;
        }

        /* প্রফেশনাল নীল বাটন */
        .btn-add-hospital {
            background-color: var(--nhcs-blue) !important;
            color: white !important;
            border: none !important;
            padding: 10px 20px !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
            transition: 0.3s;
        }

        .btn-add-hospital:hover {
            background-color: var(--nhcs-purple) !important;
            transform: translateY(-2px);
        }

        /* টেবিল হেডার (লোগোর নীলের সাথে মিল রেখে) */
        #manageHospitalInfoTable thead th {
            background-color: var(--nhcs-blue) !important;
            color: white !important;
            text-transform: uppercase;
            font-size: 13px;
            padding: 16px !important;
            text-align: center;
        }

        /* মোডাল স্মার্ট ইনপুট ফিল্ড */
        .modal-content { border-radius: 20px; border: none; overflow: hidden; }
        .modal-header { background-color: var(--nhcs-purple); color: white; padding: 20px; }
        
        .input-group-addon {
            background-color: #f1f3f5 !important;
            color: var(--nhcs-blue);
            border: 1px solid #ddd;
            border-radius: 10px 0 0 10px !important;
        }
        
        .form-control { 
            border-radius: 0 10px 10px 0 !important; 
            border: 1.5px solid #eee; 
            padding: 12px;
        }

        .form-control:focus {
            border-color: var(--nhcs-blue);
            box-shadow: none;
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
                <div class="grid-title">
                  <div class="row-fluid">
                      <div class="span6">
                          <h3>Setup / <span style="color:var(--nhcs-green)">Hospital Info</span></h3>
                      </div>
                      <div class="span6 text-right">
                          <button class="btn btn-add-hospital" data-toggle="modal" data-target="#addHospitalInfoModel"> 
                              <i class="fa fa-plus-circle"></i> Hospital Name Info 
                          </button>
                      </div>
                  </div>
                </div>
                
                <div class="grid-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="manageHospitalInfoTable" style="width:100%;"> 
                          <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Hospital Name</th>               	
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

        <!-- Add Modal -->
        <div class="modal fade" id="addHospitalInfoModel" tabindex="-1" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal" id="submitHospitalInfoForm" action="php_action/createSetupHospitalInfo.php" method="POST">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" style="color:white; opacity:1;">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-hospital-user"></i> Add New Hospital Info</h4>
                  </div>
                  <div class="modal-body" style="padding:30px;">
                    <div id="add-hospital-messages"></div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label fw-bold">Hospital Name</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-h-square"></i></span>
                                <input type="text" class="form-control" id="HospitalName" placeholder="Enter Hospital Name" name="HospitalName" autocomplete="off">
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="modal-footer" style="background:#f8f9fa;">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="createHospitalInfoBtn" style="background:var(--nhcs-blue); border:none; padding:10px 25px;">
                        <i class="fa fa-save"></i> Save Changes
                    </button>
                  </div>
                </form>
            </div>
          </div>
        </div>

<!-- Edit Hospital Modal -->
<div class="modal fade" id="editHospitalInfoModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius: 20px; overflow: hidden;">
        <form class="form-horizontal" id="editHospitalInfoForm" action="php_action/editSetupHospitalInfo.php" method="POST">
          
          <div class="modal-header" style="background-color: var(--nhcs-green); color: white; padding: 20px;">
            <button type="button" class="close" data-dismiss="modal" style="color:white; opacity:1;">&times;</button>
            <h4 class="modal-title" style="font-weight: 700;"><i class="fa fa-edit"></i> Edit Hospital Information</h4>
          </div>

          <div class="modal-body" style="padding:35px; background-color: #fcfdfe;">
            
            <!-- এই মেসেজ ডিভটি জরুরি -->
            <div id="edit-hospitalinfo-messages"></div>

            <!-- লোডিং স্পিনার (এটি আপনার আগের কোডে মিসিং ছিল) -->
            <div class="modal-loading text-center" style="padding: 40px 0; display: none;">
                <i class="fa-solid fa-spinner fa-spin fa-3x" style="color: var(--nhcs-green);"></i>
                <p class="text-muted mt-2">তথ্য লোড হচ্ছে...</p>
            </div>

            <!-- রেজাল্ট কন্টেইনার -->
            <div class="edit-hospitalinfo-result">
                <div class="form-group">
                    <label class="col-sm-3 control-label fw-bold" style="color: #555;">Hospital Name</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <span class="input-group-addon" style="border-radius: 10px 0 0 10px;"><i class="fa-solid fa-file-signature"></i></span>
                            <input type="text" class="form-control" id="editHospitalName" name="editHospitalName" placeholder="Edit Hospital Name" autocomplete="off" required style="border-radius: 0 10px 10px 0 !important;">
                        </div>
                    </div>
                </div>
            </div>
          </div>

          <div class="modal-footer editHospitalInfoFooter" style="background: #f8f9fa; border-top: 1px solid #eee; padding: 20px;">
            <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 10px; padding: 10px 20px;">Close</button>
            <button type="submit" class="btn btn-success" id="editHospitalInfoBtn" style="background: var(--nhcs-green); border: none; padding: 10px 25px; border-radius: 10px; font-weight: bold;">
                <i class="fa-solid fa-rotate"></i> Update Information
            </button>
          </div>
        </form>
    </div>
  </div>
</div>

        <!-- Delete Modal -->
        <div class="modal fade" id="removeHospitalInfoModal" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" style="background-color: #d32f2f;">
                <h4 class="modal-title" style="color:white;"><i class="fa fa-trash-can"></i> Confirm Delete</h4>
              </div>
              <div class="modal-body text-center" style="padding:40px;">
                <i class="fa fa-triangle-exclamation fa-4x" style="color:#d32f2f; margin-bottom:15px;"></i>
                <h5 class="fw-bold">আপনি কি নিশ্চিতভাবে এই হসপিটালের তথ্য মুছে ফেলতে চান?</h5>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">বাতিল</button>
                <button type="button" class="btn btn-danger" id="removeHospitalInfoBtn">হ্যাঁ, মুছে ফেলুন</button>
              </div>
            </div>
          </div>
        </div>

        <?php include ('layouts/footer.php') ?> 

      </div>
    </div>

    <?php include ('layouts/5-base-js.php') ?> 
    <script src="custom/js/setup-hospital-info.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>
</body>
</html>
