<?php 	
require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
    // ডেটা গ্রহণ
    $LoanApplicationDate = date('Y-m-d', strtotime($_POST['LoanApplicationDate']));
    $GuarantorName       = $_POST['GuarantorName'];
    $LoanType            = $_POST['LoanType'];
    $LoanAmount          = $_POST['LoanAmount'];
    $InterestRate        = $_POST['InterestRate'];
    $LoanTenure          = $_POST['LoanTenure'];
    $MonthlyEMI          = $_POST['MonthlyEMI'];
    $TotalInterest       = $_POST['TotalInterest'];
    $TotalPayment        = $_POST['TotalPayment'];
    $userid              = $_SESSION['userId']; 

    // ডাটাবেসে ডেটা ঢোকানো
$sql = "INSERT INTO tblapplication4loan 
        (loanappdate, guarantorname, loantype, loanamount, interestrate, loantenure, monthemi, totalinterest, totalpayment, creator_id, status, president_status, sg_status, acc_status) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '1', '1', '1', '1')";

    $stmt = $connect->prepare($sql);
    // ডেটার ধরণ উল্লেখ করে বাইন্ড করা
$stmt->bind_param("sssssssssi", 
    $LoanApplicationDate, $GuarantorName, $LoanType, $LoanAmount, 
    $InterestRate, $LoanTenure, $MonthlyEMI, $TotalInterest, 
    $TotalPayment, $userid
);

    if($stmt->execute()) {
        $valid['success'] = true;
        $valid['messages'] = "Successfully Added Loan Application";	
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error while adding the Loan Application: " . $connect->error;
    }	 

    $stmt->close();
    $connect->close();

    echo json_encode($valid);
}
?>
