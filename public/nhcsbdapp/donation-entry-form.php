<?php 
require_once 'php_action/db_connect.php';

//total donation
$totaldonation = "0";
$cashQuery = $connect->query("SELECT donate_amount FROM tbltrxdonationinfo WHERE status=2");
while ($cashResult = $cashQuery->fetch_assoc()) {
	$totaldonation += $cashResult['donate_amount'];
}
?>
<!DOCTYPE html>
<html>
<!-- START HEAD -->
<head>
    <!-- Start title --> 
      <title>Donation Form | Nurses Health Care Society </title>  
    <!-- End title --> 

    <!-- Start Header Base--> 
      <?php //require_once 'layouts/HeaderDTPage.php'; ?>
      <?php include ('layouts/1-base-head.php') ?>
    <!-- End Header Base --> 
  </head>
  <!-- END HEAD -->

  <!-- BEGIN BODY -->
 <body class="" style="background-color:#0000FF;">
    <div class="container" align="center">
      <div class="" align="center">
        <div class="col-md-7 col-md-offset-2 tiles white no-padding" align="center">
          <div class="p-t-30 p-l-40 p-b-20 xs-p-t-10 xs-p-l-10 xs-p-b-10" align="center">
          <a href="index.php" class="app-brand-link gap-2">
            <img src="assets/img/logo.jpg" alt="Nurses Health Care Society">
          </a>
            <h4 class="normal">
            <!--প্রাকৃতিক দুর্যোগে ক্ষতিগ্রস্ত, অসহায় মানুষের সেবা ও কল্যাণে  ১০০% নিশ্চিন্তে আপনার দানকৃত অর্থ পৌঁছে দেওয়াই আমাদের লক্ষ্য। -->
            আর্ত-মানবতার সেবায় নিঃসন্দেহে আপনার হাদিয়া প্রদান করতে পারেন। আপনাদের প্রদানকৃত হাদিয়া উপযুক্ত ব্যক্তির নিকট পৌঁছে দেওয়াই আমাদের লক্ষ্য।
            </h4>
            <div role="">
              <a href="printDonationListAll.php" target="_blank" style="background-color:#0000FF;" class="btn btn-info btn-cons">আপনাদের ডোনেশনের পরিমাণ:- <?php echo $totaldonation; ?></a>

              <!--<a href="#" class="btn btn-info btn-cons">যারা ডোনেশন দিয়েছেন তাদের তালিকা</a>-->
            </div>

            <div role="tabpanel" class="tab-pane active" id="tab_login" align="center">
              <form action="php_action/createDonationForm.php" method="post" class="form-horizontal" id="ApplicationForm">              
                <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10" align="center">

                  <div class="col-md-6 col-sm-6">
										<label for="DonateDate" class="form-label">ডোনেশনের তারিখ</label>
										<input type="date" class="form-control" placeholder="Donate Date" id="DonateDate" name="DonateDate" autocomplete="off"/>
									</div>

                  <div class="col-md-6 col-sm-6">
                    <label class="form-label">ডোনেশন দেয়া ব্যাক্তির নাম</label>
                    <input class="form-control" id="DonateName" name="DonateName" autocomplete="on" placeholder="Name" type="text">
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label class="form-label"> ফোন নং </label>
                    <input class="form-control" id="MobileNo" name="MobileNo" autocomplete="off" type="number" placeholder="Self Mobile No">
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label class="form-label"> টাকার পরিমাণ </label>
                    <input class="form-control" id="DonationAmount" name="DonationAmount" autocomplete="off" type="number" placeholder="Donation Amount">
                  </div>            

                  <div class="col-md-6 col-sm-6">
                    <label class="form-label"> টাকা পাঠানোর মাধ্যম </label>
                    <select class="form-control selectpicker" data-live-search="true" id="PaymentType" name="PaymentType">
				      	      <option value="">~~নির্বাচন করুন~~</option>
				      	      <?php 
				      	      $sql = "SELECT * FROM tblpaymenttype WHERE status = 1 ORDER BY PaymentType ASC";
								      $result = $connect->query($sql);
								      while($row = $result->fetch_array()) {
									    echo "<option value='".$row[1]."'>".$row[1]."</option>";
								      }								
				      	      ?>
				            </select>
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <label class="form-label">যে একাউন্টে টাকা পাঠানো হয়েছে </label>
                    <select class="form-control selectpicker" data-live-search="true" id="DepositTo" name="DepositTo">
				      	      <option value="">~~নির্বাচন করুন~~</option>
				      	      <?php 
				      	      $sql = "SELECT sysid,CONCAT(name, '/',accountno,'/',type) as name FROM tbldonatelist WHERE status = 1 ORDER BY type ASC";
								      $result = $connect->query($sql);
								      while($row = $result->fetch_array()) {
									    echo "<option value='".$row[0]."'>".$row[1]."</option>";
								      }								
				      	      ?>
				            </select>
                  </div>

                  <div class="col-md-6 col-sm-6"">
                    <label class="form-label"> ট্রাঞ্জেকশন নং </label>
                    <input class="form-control" id="TransactionNo" name="TransactionNo" autocomplete="off" placeholder="Transaction No"  type="text">
                  </div>  
                  
                  <div class="col-md-6 col-sm-6"">
                    <label class="form-label"> নোট </label>
                    <input class="form-control" id="Remarks" name="Remarks" autocomplete="off" placeholder="Remarks"  type="text">
                  </div> 
                  </div>  
           
                  <button type="submit" class="btn btn-primary btn-cons-md" type="submit"> Submit</button>
                  <button type="reset" class="btn btn-white btn-cons-md" type="reset">Clear</button>
                </div>
                <div class="ApplicationFormMessage"></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Start JS-->
    <?php include ('layouts/5-base-js.php') ?> 
    <script src="custom/js/donation-entry-form.js"></script>
    <?php include ('layouts/FooterDTPage.php') ?>    
    <!-- End JS-->
  </body>
</html>