<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html>

<head>
    <!-- Start title --> 
    <title>Notice List Info | Nurses Health Care Society </title>  
    <!-- End title --> 

    <!-- Start Header Base-->
    <?php require_once 'layouts/HeaderDTPage.php'; ?>
    <?php include ('layouts/1-base-head.php') ?>
    <!-- End Header Base --> 
  </head>
  <!-- END HEAD -->

  <!-- BEGIN BODY -->
  <body class="">
    <!-- BEGIN HEADER -->
    <?php include ('layouts/2-base-header.php') ?>
    <!-- END HEADER -->

    <!-- BEGIN CONTAINER -->
    <div class="page-container row-fluid">
      <!-- BEGIN SIDEBAR -->
      <?php include ('layouts/4-base-menu.php') ?>
      <!-- END SIDEBAR -->

      <!-- BEGIN PAGE CONTAINER-->

      <div class="page-content">
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <div class="clearfix"></div>
        <div class="content">
          <div class="row-fluid">
            <div class="span12">
              <div class="grid simple ">
                <div class="grid-title">
                  <h3>Notice / Notice Info </h3>
                </div>
                
                <div class="card">
                <small class="float-right">      
                  <button class="btn btn-default button1" data-toggle="modal" data-target="#addNoticeInfoModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add New Notice </button>
                </small>
                
                <div class="card-datatable table-responsive">
                <table class="table table-bordered" id="manageNoticeInfoTable"> 
                  <thead>
				               <tr>
                        <th>ক্রমিক নং</th>
                        <th>স্মারক নং</th>
                        <th>তারিখ</th>
                        <th>বিষয়</th>
			                  <th>বিস্তারিত</th>
                        <th>Attachment</th>               	
                        <th>Status</th>
			                  <th style="width:15%;">Option </th>
			                </tr>              
                  </thead>
                </table>

<!--Start add Bank info -->
<div class="modal fade" id="addNoticeInfoModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<!-- অ্যাকশন ফাইল পরিবর্তন করে নোটিশ সেভ করার ফাইল দিন এবং অবশ্যই enctype যুক্ত করুন -->
    	<form class="form-horizontal" id="submitNoticeForm" action="php_action/createNotice.php" method="POST" enctype="multipart/form-data">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add New Notice </h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-notice-messages"></div>

          <div class="form-group">
	        	<label for="NoticeNo" class="col-sm-3 control-label"> Notice No </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="NoticeNo" value="স্মারক নং-" name="NoticeNo" autocomplete="off" required>
				    </div>
	        </div>

          <!-- নোটিশের তারিখ -->
<div class="form-group">
    <label for="noticeDate" class="col-sm-3 control-label"> Notice Date </label>
    <label class="col-sm-1 control-label">: </label>
    <div class="col-sm-8">
        <!-- ডিফল্টভাবে আজকের তারিখ সেট করা হয়েছে -->
        <input type="date" class="form-control" id="noticeDate" name="noticeDate" value="<?php echo date('Y-m-d'); ?>" required>
    </div>
</div>

          <!-- নোটিশের শিরোনাম -->
          <div class="form-group">
	        	<label for="noticeTitle" class="col-sm-3 control-label"> Notice Title </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="noticeTitle" placeholder="নোটিশের শিরোনাম লিখুন" name="noticeTitle" autocomplete="off" required>
				    </div>
	        </div>

          <!-- নোটিশের বিস্তারিত (ঐচ্ছিক) -->
	        <div class="form-group">
	        	<label for="noticeContent" class="col-sm-3 control-label"> Description </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <textarea class="form-control" id="noticeContent" placeholder="বিস্তারিত তথ্য (যদি থাকে)" name="noticeContent" rows="3"></textarea>
				    </div>
	        </div> 

          <!-- ফাইল আপলোড (PDF, JPG, PNG) -->
          <div class="form-group">
	        	<label for="noticeFile" class="col-sm-3 control-label"> Attachment </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="file" class="form-control" id="noticeFile" name="noticeFile" accept=".pdf, .jpg, .jpeg, .png" required>
              <p class="help-block" style="font-size: 12px; color: red;">* শুধু PDF বা Image আপলোড করুন।</p>
				    </div>
	        </div> 
	                 	        
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>	        
	        <button type="submit" class="btn btn-primary" id="createNoticeBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon font-awesome fa fa-paper-plane"></i> Publish Notice </button>
	      </div>
     	</form>
    </div>
  </div>
</div>
<!--End add Bank info -->



<!--Start Post Deposit info -->
<div class="modal fade" tabindex="-1" role="dialog" id="publishNoticeModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-ok"></i> Publish Notice</h4>
      </div>
      <div class="modal-body">
        <p>আপনি কি এই নোটিশটি সবার জন্য পাবলিশ করতে চান?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-success" id="publishNoticeBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Yes, Publish Now</button>
      </div>
    </div>
  </div>
</div>
<!--End Post Deposit info -->

<!--Start Delete Bank info -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeNoticeModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Notice</h4>
      </div>
      <div class="modal-body">
        <p>আপনি কি নিশ্চিতভাবে এই নোটিশটি ডিলিট করতে চান?</p>
        <p class="text-danger"><small>* শুধুমাত্র পেন্ডিং নোটিশ ডিলিট করা সম্ভব।</small></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <!-- বাটন আইডি পরিবর্তন করা হয়েছে: removeNoticeBtn -->
        <button type="button" class="btn btn-danger" id="removeNoticeBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Confirm Delete</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<!--End Delete Bank info -->
                  
                </div>
              </div>
            </div>
          </div>
        </div>


      </div>
      <!-- BEGIN footer -->
      <div id="footer">
        <div class="error-container">
          <div class="copyright"> © 2026, made with ❤️ by Matrik Solutions</div>
        </div>
      </div>  
      <!-- END footer -->
    </div>
    <!-- END CONTAINER -->
    
    <!-- BEGIN CORE JS FRAMEWORK-->
    <?php include ('layouts/5-base-js.php') ?> 
    <!-- END CORE JS FRAMEWORK-->
    <script src="custom/js/notice-list.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>
  </body>
</html>