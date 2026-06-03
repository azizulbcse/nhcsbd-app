<?php require_once 'php_action/core.php'; ?> 
<!DOCTYPE html>
<html>

<head>
    <!-- Start title --> 
    <title>Photos List Info | Nurses Health Care Society </title>  
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
                  <h3>Gallery - Photos/Videos Info </h3>
                </div>
                
                <div class="card">
                <small class="float-right">      
                  <button class="btn btn-default button1" data-toggle="modal" data-target="#addGalleryModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add New Photos/Videos </button>
                </small>
                
                <div class="card-datatable table-responsive">
                <table class="table table-bordered" id="manageGalleryTable"> 
                  <thead>
				               <tr>
                        <th>ক্রমিক নং</th>
                        <th>ছবি/ভিডিও</th>
                        <th>বিষয়</th>
			                  <th>ধরন</th>
                        <th>তারিখ</th>               	
                        <th>Status</th>
			                  <th style="width:15%;">Option </th>
			                </tr>              
                  </thead>
                </table>

<!--Start add Gallery info -->

<div class="modal fade" id="addGalleryModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
        <!-- Action changed to createGallery.php to match your new table -->
        <form class="form-horizontal" id="submitGalleryForm" action="php_action/createGallery.php" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fa fa-plus"></i> Add New Media </h4>
          </div>
          <div class="modal-body">
            <div id="add-gallery-messages"></div>

            <!-- Title (Maps to 'title' column) -->
            <div class="form-group">
                <label for="title" class="col-sm-3 control-label"> Media Title </label>
                <label class="col-sm-1 control-label">: </label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" autocomplete="off" required>
                </div>
            </div>

            <!-- Media Type (Maps to 'media_type' ENUM column) -->
            <div class="form-group">
                <label for="media_type" class="col-sm-3 control-label"> Media Type </label>
                <label class="col-sm-1 control-label">: </label>
                <div class="col-sm-8">
                  <select class="form-control" id="media_type" name="media_type" required>
                      <option value="">~~ Select Type ~~</option>
                      <option value="image">Image</option>
                      <option value="video">Video</option>
                  </select>
                </div>
            </div>            

            <!-- File Upload (Maps to 'file_name' column) -->
            <div class="form-group">
                <label for="mediaFile" class="col-sm-3 control-label"> Select File </label>
                <label class="col-sm-1 control-label">: </label>
                <div class="col-sm-8">
                  <input type="file" class="form-control" id="mediaFile" name="mediaFile" accept="image/*,video/mp4" required>
                  <p class="help-block" style="font-size: 12px; color: blue;">* Upload JPG, PNG, or MP4.</p>
                </div>
            </div> 
          </div> 
          
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>          
            <button type="submit" class="btn btn-primary" id="createGalleryBtn" data-loading-text="Loading..." autocomplete="off"> <i class="fa fa-upload"></i> Upload to Gallery </button>
          </div>
        </form>
    </div>
  </div>
</div>
<!--End add Gallery info -->


<!-- Publish Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="publishGalleryModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-ok"></i> Publish Media</h4>
      </div>
      <div class="modal-body">
        <p>আপনি কি এই ইমেজ/ভিডিওটি সবার জন্য পাবলিশ করতে চান?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-success" id="publishBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Yes, Publish Now</button>
      </div>
    </div>
  </div>
</div>

<!-- Remove/Delete Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeGalleryModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Gallery Item</h4>
      </div>
      <div class="modal-body">
        <p>আপনি কি এটি মুছে ফেলতে চান?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-danger" id="removeGalleryBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-trash"></i> Remove</button>
      </div>
    </div>
  </div>
</div>
                  
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
    <script src="custom/js/photos-list.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>
  </body>
</html>