<?php 
require_once 'core.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deposit Summary Report | NHCS</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/logo.jpg" />
    <style type="text/css">
        /* Global Styles & Font */
        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            margin: 0; padding: 20px; color: #333; background-color: #fff;
        }
        .report-container {
            max-width: 950px; margin: 0 auto; padding: 30px;
            /* box-shadow: 0 0 10px rgba(0,0,0,0.1); removes shadow for print */
        }

        /* Header Section Styling */
        .header-table {
            width: 100%; border-bottom: 4px solid #28a745; margin-bottom: 30px; padding-bottom: 20px;
        }
        .org-name {
            font-size: 28px; font-weight: 700; color: #1a5a2a; margin: 0; text-transform: uppercase;
        }
        .contact-info {
            font-size: 14px; line-height: 1.6; color: #555; margin-top: 8px;
        }
        .report-title {
            text-align: center; text-transform: uppercase; letter-spacing: 2px;
            margin: 0 0 25px 0; font-size: 22px; color: #333; 
        }

        /* Smart Data Table Styling */
        .data-table {
            width: 100%; border-collapse: collapse; margin-top: 15px; 
        }
        .data-table th, .data-table td {
            padding: 12px 10px; font-size: 13px; border: none; /* Remove default borders */
        }
        .data-table thead th {
            background-color: #e9ecef; color: #333; font-weight: 600;
            text-align: center; border-bottom: 2px solid #ddd;
        }
        .data-table tbody td {
            border-bottom: 1px solid #eee; vertical-align: middle;
        }
        .data-table tbody tr:nth-child(even) { 
            background-color: #f9f9f9; 
        }
        .total-row { 
            background-color: #e0f2fe !important; /* Light blue accent */
            font-weight: bold; 
            border-top: 2px solid #28a745;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        
        .amount-cell { color: #d9534f; font-weight: 700; font-size: 14px; }

        /* Footer Info */
        .footer-info { margin-top: 50px; font-size: 11px; color: #777; border-top: 1px solid #eee; padding-top: 15px; }

        /* Print Specific Styles */
        @media print {
            body { padding: 0; background: none; }
            .report-container { width: 100%; max-width: 100%; padding: 0; }
            .no-print { display: none; }
            @page { margin: 1cm; }
            .header-table { border-bottom-color: #28a745 !important; }
        }
    </style>
</head>

<body onLoad="window.print()" onclick="window.close()">

<div class="report-container">
    <!-- Header Section -->
    <table class="header-table">
        <tr>
            <td width="15%" class="text-center">
                <img src="../assets/img/logo.jpg" width="90" alt="Logo" onerror="this.style.display='none'">
            </td>
            <td width="85%" class="text-center">
                <h1 class="org-name">Nurses Health Care Society</h1>
                <div class="contact-info">
                    Dhaka-1206, Bangladesh<br>
                    Phone: 01717288965, 01689597474 | Email: nhcs.org.bd@gmail.com
                </div>
            </td>
        </tr>
    </table>

    <h2 class="report-title">Member Deposit Summary Report</h2>

    <?php 
    if($_POST) {
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        // Handling Date Formats for PHP/MySQL Compatibility
        $start_date = date("Y-m-d", strtotime($startDate));
        $end_date = date("Y-m-d", strtotime($endDate));

        $sql = "SELECT tdi.trxdid, DATE_FORMAT(tdi.depositdate, '%d/%m/%Y') as depositdate, tai.name_english,
                tdi.payment_type, tdi.deposit_from, tdi.deposit_to, tdi.deposit_amount, tdi.trxno, tdi.remarks, tdi.status 
                FROM tbltrxdepositinfo tdi 
                JOIN tblapplicantinfo tai ON tdi.creator_id = tai.mid 
                WHERE tdi.status != 0 
                AND tdi.depositdate >= '$start_date' AND tdi.depositdate <= '$end_date' 
                ORDER BY tdi.trxdid ASC";

        $query = $connect->query($sql);
        $totalamount = 0;
    ?>

    <p style="font-size: 13px; margin-bottom: 15px; color: #444;">
        <strong>Reporting Period:</strong> <?php echo date("d M Y", strtotime($startDate)); ?> 
        <strong>To</strong> <?php echo date("d M Y", strtotime($endDate)); ?>
    </p>

    <table class="data-table">
        <thead>
            <tr>
                <th>SL</th>
                <th>Date</th>
                <th class="text-left">Member Name</th>  
                <th>Method</th> 
                <th>From</th> 
                <th>To</th> 
                <th class="text-right">Amount (BDT)</th>  
                <th>Trx ID</th>     
                <th>Month/Remarks</th> 
            </tr>
        </thead>
        <tbody>
            <?php
            $x = 1;
            if($query && $query->num_rows > 0) {
                while($row = $query->fetch_array()) {
                    $totalamount += $row["deposit_amount"];
            ?>
            <tr>
                <td class="text-center"><?php echo $x++; ?></td>
                <td class="text-center"><?php echo $row['depositdate']; ?></td>
                <td class="text-left"><?php echo $row['name_english']; ?></td>
                <td class="text-center"><?php echo $row['payment_type']; ?></td>
                <td class="text-center"><?php echo $row['deposit_from']; ?></td>
                <td class="text-center"><?php echo $row['deposit_to']; ?></td>
                <td class="text-right amount-cell"><?php echo number_format($row['deposit_amount'], 2); ?></td>
                <td class="text-center"><?php echo $row['trxno']; ?></td>
                <td><?php echo $row['remarks']; ?></td>
            </tr>
            <?php 
                } 
            } else {
                echo "<tr><td colspan='9' class='text-center' style='padding: 20px;'>No records found for the selected dates.</td></tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="6" class="text-right">GRAND TOTAL:</td>
                <td class="text-right" style="font-size: 16px; color: #AA0000;">
                    <?php echo number_format($totalamount, 2); ?>
                </td>
                <td colspan="2"></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer-info no-print">
        <table width="100%">
            <tr>
                <td>Report Generated: <?php echo date('d-M-Y h:i A'); ?></td>
                <td class="text-right">Software by: Matrik Solutions © 2026</td>
            </tr>
        </table>
    </div>

    <?php } else {
        echo "<div class='text-center'>Invalid Request. Please use the form to generate report.</div>";
    } ?>
</div>

</body>
</html>
