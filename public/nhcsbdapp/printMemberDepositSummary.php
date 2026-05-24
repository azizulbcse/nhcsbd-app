<?php require_once 'php_action/core.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NHCS - Member Deposit Summary 2026</title>
    <link href="https://fonts.googleapis.com" rel="stylesheet">
    
    <style type="text/css">
        @page { size: A4 landscape; margin: 10mm; }
        body { font-family: 'Poppins', sans-serif; margin: 0; color: #334155; font-size: 11px; }

        /* Header Style */
        .header-container {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #0f172a;
        }
        .brand-text h1 { margin: 0; font-size: 24px; font-weight: 700; color: #0f172a; }
        .brand-text p { margin: 0; font-size: 11px; color: #64748b; }

        /* Table Design */
        .modern-table { width: 100%; border-collapse: collapse; }
        .modern-table thead { display: table-header-group; }
        .modern-table th {
            background-color: #f1f5f9 !important; color: #0f172a;
            padding: 12px 4px; border: 1px solid #cbd5e1; text-transform: uppercase;
        }
        .modern-table td { padding: 8px 4px; border: 1px solid #e2e8f0; text-align: center; }

        /* Member Photo & Name */
        .member-img { width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 1px solid #ddd; }
        .name-cell { text-align: left !important; padding-left: 10px !important; font-weight: 600; color: #1e293b; }

        /* DUE HIGHLIGHTS - গুরুত্বপূর্ণ অংশ */
        .bg-due { background-color: #fff1f2 !important; font-weight: 600; color: #be123c; } /* হালকা লাল ব্যাকগ্রাউন্ড */
        .total-due-final { 
            background-color: #ffe4e6 !important; 
            color: #9f1239 !important; 
            font-weight: 800 !important; 
            border: 1.5px solid #fda4af !important; 
            font-size: 12px;
        }

        /* Footer & Printing Logic */
        .modern-table tfoot { display: table-row-group; } /* সামারি শুধু শেষে দেখাবে */
        .grand-total-row td {
            background-color: #0f172a !important; color: #ffffff !important;
            font-weight: 600; padding: 12px 4px; border: 1px solid #0f172a;
        }
        .footer-sig { margin-top: 60px; display: flex; justify-content: flex-end; }
        .sig-box { width: 220px; text-align: center; border-top: 2px solid #0f172a; padding-top: 5px; font-weight: 700; }

        .no-print { text-align: center; padding: 15px; }
        .btn-print { background: #0f172a; color: white; padding: 10px 25px; border: none; border-radius: 5px; cursor: pointer; }

        @media print {
            .no-print { display: none; }
            .grand-total-row td { background-color: #0f172a !important; color: white !important; -webkit-print-color-adjust: exact; }
            .bg-due { background-color: #fff1f2 !important; -webkit-print-color-adjust: exact; }
            .total-due-final { background-color: #ffe4e6 !important; -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body>

    <div class="no-print">
        <button class="btn-print" onclick="window.print()">PRINT REPORT</button>
    </div>

    <div class="report-wrapper">
        <div class="header-container">
            <div style="display:flex; align-items:center; gap:15px;">
                <?php $logo = file_exists("logo.jpg") ? "logo.jpg" : "assets/img/logo.jpg"; ?>
                <img src="<?php echo $logo; ?>" width="70" alt="Logo">
                <div class="brand-text">
                    <h1>Nurses Health Care Society</h1>
                    <p>Dhaka-1206. | Phone: 01717288965, 01689597474 | nhcs.org.bd</p>
                </div>
            </div>
            <div style="text-align:right">
                <h2 style="margin:0; color:#2563eb;">Deposit Summary Report</h2>
                <?php $month = isset($_GET['month']) ? $_GET['month'] : ""; ?>
                <p style="font-weight:700; margin:5px 0;">PERIOD: <?php echo $month ? strtoupper($month) : "ALL DATA 2026"; ?></p>
            </div>
        </div>

        <table class="modern-table">
            <thead>
                <thead>
                <tr>
                    <th>SL</th>
                    <th>PHOTO</th>
                    <th width="140">MEMBER NAME</th>
                    <th>MOBILE</th>
                    <th>MONTH PAY</th>
                    <th>MONTH PAID</th>
                    <th>MONTH DUE</th>
                    <th>FIXED PAY</th>
                    <th>FIXED PAID</th>
                    <th>FIXED DUE</th>
                    <th>TOTAL PAY</th>
                    <th>TOTAL PAID</th>
                    <th>TOTAL DUE</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                $sql = "SELECT * FROM vw_memberdepositsummary";
                if(!empty($month)) { $sql .= " WHERE remarks = '".$connect->real_escape_string($month)."'"; }
                $sql .= " ORDER BY mid ASC";
                
                $result = $connect->query($sql);
                $totals = ['tmpaya'=>0, 'tmpaida'=>0, 'tmduea'=>0, 'tpayfixeda'=>0, 'tpaidfixeda'=>0, 'tfixeduea'=>0, 'tpaya'=>0, 'tpaida'=>0, 'tduea'=>0];
                
                $count = 1;
                while($row = $result->fetch_array()) {
                    $img = (!empty($row['userpic']) && strlen($row['userpic']) > 3) ? substr($row['userpic'], 3) : 'assets/img/default.png';
                    ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><img src="<?php echo $img; ?>" class="member-img"></td>
                        <td class="name-cell"><?php echo $row['name_english']; ?></td>
                        <td><?php echo $row['mobileno']; ?></td>
                        <td><?php echo number_format($row['tmpaya']); ?></td>
                        <td><?php echo number_format($row['tmpaida']); ?></td>
                        <!-- Month Due Highlight -->
                        <td class="bg-due"><?php echo number_format($row['tmduea']); ?></td>
                        <td><?php echo number_format($row['tpayfixeda']); ?></td>
                        <td><?php echo number_format($row['tpaidfixeda']); ?></td>
                        <!-- Fixed Due Highlight -->
                        <td class="bg-due"><?php echo number_format($row['tfixeduea']); ?></td>
                        <td><?php echo number_format($row['tpaya']); ?></td>
                        <td><?php echo number_format($row['tpaida']); ?></td>
                        <!-- TOTAL DUE - Most Highlighted -->
                        <td class="total-due-final"><?php echo number_format($row['tduea']); ?></td>
                    </tr>
                <?php 
                    foreach($totals as $key => $val) { $totals[$key] += $row[$key]; }
                } ?>
            </tbody>
            <tfoot>
                <tr class="grand-total-row">
                    <td colspan="4" style="text-align:right; padding-right:15px;">GRAND TOTAL (BDT)</td>
                    <?php foreach($totals as $t) { echo "<td>".number_format($t)."</td>"; } ?>
                </tr>
            </tfoot>
        </table>

        <div class="footer-sig">
            <div class="sig-box">Accountant Signature</div>
        </div>
    </div>

</body>
</html>
