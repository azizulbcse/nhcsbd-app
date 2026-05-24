<?php require_once 'core.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Deposit Statement - Nurses Health Care Society</title>
    <style type="text/css">
        /* ফন্ট ছাড়াই আধুনিক ডিজাইন - সিস্টেম ফন্ট ব্যবহার */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: #2c3e50;
            background-color: #fff;
            margin: 0;
            padding: 0;
            line-height: 1.5;
        }

        .wrapper {
            width: 800px;
            margin: 0 auto;
            padding: 40px;
            background: #fff;
        }

        /* হেডার ডিজাইন */
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .org-info {
            text-align: center;
            flex-grow: 1;
        }

        .org-name {
            font-size: 26px;
            font-weight: bold;
            color: #1a237e;
            margin: 0;
            text-transform: uppercase;
        }

        .org-details {
            font-size: 13px;
            color: #555;
            margin-top: 5px;
        }

        /* প্রোফাইল ফটো */
        .member-photo {
            width: 100px;
            height: 110px;
            border: 2px solid #eee;
            border-radius: 4px;
            object-fit: cover;
        }

        /* স্টেটমেন্ট টাইটেল */
        .statement-title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin: 20px 0;
            padding: 10px;
            background: #f8fafc;
            border-radius: 6px;
            color: #1a237e;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* মেম্বার ইনফো গ্রিড */
        .info-grid {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }

        .info-grid td {
            padding: 6px 0;
            font-size: 13px;
            vertical-align: top;
        }

        .label {
            font-weight: 700;
            width: 150px;
            color: #515e6a;
        }

        /* টেবিল ডিজাইন */
        .deposit-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .deposit-table th {
            background-color: #1a237e;
            color: #fff;
            padding: 12px 10px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            border: 1px solid #1a237e;
        }

        .deposit-table td {
            border: 1px solid #e2e8f0;
            padding: 10px;
            font-size: 13px;
            text-align: center;
        }

        .deposit-table tr:nth-child(even) {
            background-color: #f8fafc;
        }

        /* টোটাল সেকশন */
        .total-row td {
            font-weight: bold;
            background-color: #f1f5f9;
            color: #1a237e;
            font-size: 14px;
        }

        .grand-total-box {
            background: #1a237e !important;
            color: #fff !important;
            font-size: 16px !important;
        }

        /* সিগনেচার এরিয়া */
        .signature-section {
            margin-top: 60px;
            display: flex;
            justify-content: space-between;
        }

        .sig-box {
            width: 180px;
            text-align: center;
            border-top: 1px solid #333;
            padding-top: 8px;
            font-size: 12px;
            font-weight: 600;
        }

        /* প্রিন্ট বাটন */
        .no-print {
            text-align: center;
            margin: 30px 0;
        }

        .btn-print {
            background: #1a237e;
            color: #fff;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        @media print {
            .no-print { display: none; }
            .wrapper { width: 100%; padding: 0; border: none; }
            body { background: #fff; }
        }
    </style>
</head>

<body>

<?php
$mid = $_POST['mid']; 
$sql = "SELECT mid,name_bangla,userpic,name_english,fathers_name,mothers_name,gender,maritalstatus,DATE_FORMAT(dateofbirth, '%d/%m/%Y') as dateofbirth,
mobileno,nid,email,bloodgroup,presentaddress,age,permanentaddress FROM tblapplicantinfo WHERE mid = {$mid} AND status=2";

$result = $connect->query($sql);
if($row = $result->fetch_array()) {
    $imageUrl = substr($row['userpic'], 3);
    $userpic = "<img src='".$imageUrl."' class='member-photo' />";

    $orderItemSql ="SELECT trxdid, DATE_FORMAT(depositdate, '%d/%m/%Y') as depositdate, payment_type, deposit_amount, remarks, fixed_amount 
                    FROM tbltrxdepositinfo WHERE memberid = {$mid} AND status=2";
    $orderItemResult = $connect->query($orderItemSql);
    $totalamount = 0;
    $totalfixamount = 0;
?>

<div class="wrapper">
    <!-- Header -->
    <div class="header-section">
        <img src="logo.jpg" width="85">
        <div class="org-info">
            <h1 class="org-name">Nurses Health Care Society</h1>
            <div class="org-details">
                Dhaka-1206. Phone: 01717288965, 01689597474<br>
                Email: nhcs.org.bd@gmail.com
            </div>
        </div>
        <?php echo $userpic; ?>
    </div>

    <div class="statement-title">Deposit Statement</div>

    <!-- Member Details Grid -->
    <table class="info-grid">
        <tr>
            <td class="label">Name (Bangla)</td><td>: <?php echo $row['name_bangla'];?></td>
            <td class="label" style="padding-left:40px;">Member Name</td><td>: <?php echo $row['name_english'];?></td>
        </tr>
        <tr>
            <td class="label">Father's Name</td><td>: <?php echo $row['fathers_name'];?></td>
            <td class="label" style="padding-left:40px;">Mother's Name</td><td>: <?php echo $row['mothers_name'];?></td>
        </tr>
        <tr>
            <td class="label">Gender / Age</td><td>: <?php echo $row['gender'];?> / <?php echo $row['age'];?> Years</td>
            <td class="label" style="padding-left:40px;">Marital Status</td><td>: <?php echo $row['maritalstatus'];?></td>
        </tr>
        <tr>
            <td class="label">Date of Birth</td><td>: <?php echo $row['dateofbirth'];?></td>
            <td class="label" style="padding-left:40px;">Blood Group</td><td>: <?php echo $row['bloodgroup'];?></td>
        </tr>
        <tr>
            <td class="label">National ID No</td><td>: <?php echo $row['nid'];?></td>
            <td class="label" style="padding-left:40px;">Mobile No</td><td>: <?php echo $row['mobileno'];?></td>
        </tr>
        <tr>
            <td class="label">Present Addr.</td><td colspan="3">: <?php echo $row['presentaddress'];?></td>
        </tr>
        <tr>
            <td class="label">Permanent Addr.</td><td colspan="3">: <?php echo $row['permanentaddress'];?></td>
        </tr>
    </table>

    <!-- Deposit Table -->
    <table class="deposit-table">
        <thead>
            <tr>
                <th width="40">SL</th>
                <th>Deposit Date</th>
                <th>Payment Type</th>
                <th>Monthly Amount</th>
                <th>Fixed Amount</th>
                <th>Month Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $x = 1;
            while($item = $orderItemResult->fetch_array()) {
                $totalamount += $item["deposit_amount"];
                $totalfixamount += $item["fixed_amount"];
            ?>
            <tr>
                <td><?php echo $x++; ?></td>
                <td><?php echo $item['depositdate']; ?></td>
                <td><?php echo $item['payment_type']; ?></td>
                <td><?php echo number_format($item['deposit_amount'], 0); ?></td>
                <td><?php echo number_format($item['fixed_amount'], 0); ?></td>
                <td style="text-align: left;"><?php echo $item['remarks']; ?></td>
            </tr>
            <?php } ?>
            <tr class="total-row">
                <td colspan="3" style="text-align: right; padding-right: 20px;">TOTAL DEPOSIT SUMMARY</td>
                <td><?php echo number_format($totalamount, 0); ?></td>
                <td><?php echo number_format($totalfixamount, 0); ?></td>
                <td class="grand-total-box">Tk. <?php echo number_format($totalamount + $totalfixamount, 0); ?></td>
            </tr>
        </tbody>
    </table>

<?php
$sigSql = "SELECT tai.name_english, tai.signature 
           FROM tbladminuser tau, tblapplicantinfo tai 
           WHERE tau.mobileno = tai.mobileno AND tau.designations IN('Accountant') 
           LIMIT 1";
$sigresult = $connect->query($sigSql);

// Initialize variables to avoid "undefined" errors
$signatureHtml = "";
$accountantName = "Accountant";

if($row = $sigresult->fetch_array()) {
    $accountantName = $row['name_english'];
    $imageUrl = substr($row['signature'], 3); 
    
    // Check if file actually exists on the server
    if (!empty($row['signature']) && file_exists($row['signature'])) {
        $signatureHtml = "<img src='".$imageUrl."' style='max-height: 70px; max-width: 180px; object-fit: contain;'>";
    }
}
?>

<div style="margin-top: 60px; display: flex; justify-content: flex-end; padding-right: 30px;">
    <div style="width: 140px; text-align: center;">
        
        <!-- Signature Image -->
        <div style="min-height: 60px; display: flex; align-items: flex-end; justify-content: center; margin-bottom: 5px;">
            <?php if($signatureHtml !== ""): ?>
                <?php echo $signatureHtml; ?>
            <?php else: ?>
                <!-- Placeholder for manual signature if image missing -->
                <div style="height: 60px;"></div> 
            <?php endif; ?>
        </div>
        
        <!-- Signature Line and Name -->
        <div style="border-top: 1.5px solid #333; padding-top: 8px;">
            <div style="font-weight: bold; font-size: 13px; color: #1a237e;">
                <?php echo htmlspecialchars($accountantName); ?>
            </div>
            <div style="font-size: 11px;">Accountant</div>
        </div>
    </div>
</div>

</div>

<div class="no-print">
    <button class="btn-print" onclick="window.print()">Print Statement Now</button>
</div>

<?php } ?>

</body>
</html>
