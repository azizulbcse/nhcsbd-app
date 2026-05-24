<?php 
require_once 'core.php'; 

if($_POST) {
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $memberID = $_POST['memberID']; 

    $start_date = date("Y-m-d", strtotime($startDate));
    $end_date = date("Y-m-d", strtotime($endDate));

    // ১. মেম্বারের তথ্য সংগ্রহ
    $memberSql = "SELECT mid, name_english FROM tblapplicantinfo WHERE mid = '$memberID'";
    $memberData = $connect->query($memberSql)->fetch_assoc();

    // ২. ওপেনিং ব্যালেন্স বের করা
    $openingSql = "SELECT SUM(deposit_amount+fixed_amount) AS opening_balance 
                   FROM tbltrxdepositinfo 
                   WHERE creator_id = '$memberID' AND status != 0 
                   AND depositdate < '$start_date'";
    $openingResult = $connect->query($openingSql)->fetch_assoc();
    $openingBalance = $openingResult['opening_balance'] ?? 0;

    // ৩. নির্দিষ্ট সময়ের লেনদেন
    $sql = "SELECT depositdate, deposit_amount+fixed_amount as deposit_amount, trxno, remarks, payment_type 
            FROM tbltrxdepositinfo 
            WHERE creator_id = '$memberID' AND status != 0 
            AND depositdate >= '$start_date' AND depositdate <= '$end_date' 
            ORDER BY depositdate ASC, trxdid ASC";
    
    $query = $connect->query($sql);
    $runningBalance = $openingBalance;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bank Statement - <?php echo $memberData['name_english']; ?></title>
    <style type="text/css">
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; margin: 0; padding: 30px; color: #333; background-color: #fff; }
        .statement-container { max-width: 950px; margin: 0 auto; }
        
        /* Header */
        .header-table { width: 100%; border-bottom: 2px solid #28a745; margin-bottom: 30px; padding-bottom: 15px; }
        .org-name { font-size: 28px; font-weight: bold; color: #1a5a2a; margin: 0; letter-spacing: 1px; }
        .label-bg { background: #28a745; color: white; padding: 6px 15px; font-size: 13px; font-weight: bold; display: inline-block; margin-top: 10px; border-radius: 3px; }
        
        /* Info Grid */
        .info-table { width: 100%; margin-bottom: 30px; border: 1px solid #eee; padding: 20px; border-radius: 8px; background-color: #fcfcfc; }
        .info-label { font-size: 11px; color: #777; text-transform: uppercase; font-weight: bold; margin-bottom: 5px; }
        .info-value { font-size: 16px; font-weight: 600; color: #222; }

        /* Data Table */
        .data-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .data-table th { background: #f8f9fa; color: #333; padding: 12px 10px; font-size: 12px; text-align: left; border-bottom: 2px solid #28a745; text-transform: uppercase; }
        .data-table td { padding: 12px 10px; border-bottom: 1px solid #eee; font-size: 13px; color: #444; }
        
        .opening-row { background: #f0fdf4 !important; font-weight: bold; color: #1a5a2a; }
        .closing-row { background: #e8f5e9 !important; font-weight: bold; border-top: 2px solid #28a745; font-size: 15px; }
        
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .credit-amt { color: #28a745; font-weight: bold; }

        /* Footer */
        .footer { margin-top: 60px; text-align: center; border-top: 1px dashed #ccc; padding-top: 20px; }
        .digital-msg { font-size: 11px; color: #999; font-style: italic; }

        @media print {
            body { padding: 0; }
            .no-print { display: none; }
            .statement-container { width: 100%; }
        }
    </style>
</head>
<body onLoad="window.print()">

<div class="statement-container">
    <!-- Header -->
    <table class="header-table">
        <tr>
            <td width="15%">
                <img src="../assets/img/logo.jpg" width="95" alt="NHCS Logo" onerror="this.style.display='none'">
            </td>
            <td width="55%">
                <h1 class="org-name">Nurses Health Care Society</h1>
                <p style="margin: 5px 0; font-size: 14px; color: #555;">Dhaka-1206, Bangladesh | Phone: 01717288965</p>
                <div class="label-bg">ACCOUNT DEPOSIT STATEMENT</div>
            </td>
            <td width="30%" class="text-right">
                <p style="font-size: 12px; color: #777; margin: 0;">Statement Date</p>
                <p style="font-size: 16px; font-weight: bold; margin: 5px 0;"><?php echo date('d M, Y'); ?></p>
                <p style="font-size: 11px; color: #999;">Generated at: <?php echo date('h:i A'); ?></p>
            </td>
        </tr>
    </table>

    <!-- Member Info -->
    <table class="info-table">
        <tr>
            <td width="50%">
                <div class="info-label">Member Name</div>
                <div class="info-value"><?php echo $memberData['name_english']; ?></div>
            </td>
            <td width="50%" class="text-right">
                <div class="info-label">Account / Member ID</div>
                <div class="info-value">NHCS-<?php echo $memberData['mid']; ?></div>
            </td>
        </tr>
        <tr>
            <td style="padding-top: 15px;">
                <div class="info-label">Statement Period</div>
                <div class="info-value"><?php echo date('d/m/Y', strtotime($startDate)); ?> to <?php echo date('d/m/Y', strtotime($endDate)); ?></div>
            </td>
            <td class="text-right" style="padding-top: 15px;">
                <div class="info-label">Account Type</div>
                <div class="info-value">Member Savings / Deposit</div>
            </td>
        </tr>
    </table>

    <!-- Transaction Table -->
    <table class="data-table">
        <thead>
            <tr>
                <th width="15%">Date</th>
                <th width="40%">Description / Remarks</th>
                <th width="15%" class="text-center">Reference ID</th>
                <th width="15%" class="text-right">Credit (BDT)</th>
                <th width="15%" class="text-right">Balance</th>
            </tr>
        </thead>
        <tbody>
            <tr class="opening-row">
                <td class="text-center"><?php echo date('d/m/Y', strtotime($startDate)); ?></td>
                <td colspan="3">OPENING BALANCE BROUGHT FORWARD</td>
                <td class="text-right"><?php echo number_format($openingBalance, 2); ?></td>
            </tr>
            
            <?php
            if($query && $query->num_rows > 0) {
                while($row = $query->fetch_array()) {
                    $runningBalance += $row['deposit_amount'];
            ?>
            <tr>
                <td><?php echo date('d-m-Y', strtotime($row['depositdate'])); ?></td>
                <td>
                    <strong style="color: #222;"><?php echo $row['remarks']; ?></strong><br>
                    <small style="color: #888;">Transaction via <?php echo $row['payment_type']; ?></small>
                </td>
                <td class="text-center" style="font-size: 11px;"><?php echo $row['trxno']; ?></td>
                <td class="text-right credit-amt"><?php echo number_format($row['deposit_amount'], 2); ?></td>
                <td class="text-right" style="font-weight: bold;"><?php echo number_format($runningBalance, 2); ?></td>
            </tr>
            <?php } } else { ?>
                <tr><td colspan="5" class="text-center" style="padding: 30px; color: #999;">No transactions found in this period.</td></tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr class="closing-row">
                <td colspan="4" class="text-right">CLOSING BALANCE AS ON <?php echo date('d/m/Y', strtotime($endDate)); ?></td>
                <td class="text-right"><?php echo number_format($runningBalance, 2); ?></td>
            </tr>
        </tfoot>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p class="digital-msg">
            "This is a computer-generated statement and does not require a physical signature or seal."
        </p>
        <p style="font-size: 11px; color: #aaa; margin-top: 15px;">
            Software by: Matrik Solutions | © 2026 Nurses Health Care Society
        </p>
    </div>
</div>

<div class="text-center no-print" style="margin-top: 30px; margin-bottom: 50px;">
    <button onclick="window.print()" style="padding: 12px 35px; background: #28a745; color: white; border: none; cursor: pointer; border-radius: 5px; font-weight: bold; font-size: 14px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">Print Account Statement</button>
</div>
<style type="text/css">
    /* Watermark Style */
    .watermark {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-30deg); /* মাঝখানে এবং সামান্য বাঁকানো */
        opacity: 0.05; /* একদম হালকা (জলছাপের মতো) */
        z-index: -1; /* লেখার নিচে থাকবে */
        width: 400px; /* লোগোর আকার অনুযায়ী পরিবর্তন করতে পারেন */
        pointer-events: none;
    }

    /* বাকি স্টাইল আগের মতোই থাকবে... */
</style>

<body onLoad="window.print()">

<!-- Watermark Image -->
<div class="watermark">
    <img src="../assets/img/logo.jpg" style="width: 100%;">
</div>

<div class="statement-container">
    <!-- আগের সব HTML কোড এখানে থাকবে... -->

</body>
</html>
<?php } ?>
