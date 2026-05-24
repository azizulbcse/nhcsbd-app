<?php require_once 'core.php'; ?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>.:: Nurses Health Care Society - Smart Profile ::.</title>
    <style>
        body { font-family: 'Verdana', sans-serif; background-color: #f4f7f6; margin: 0; padding: 20px; }
        .profile-card { 
            max-width: 850px; margin: 0 auto; background: #fff; border-radius: 10px; 
            box-shadow: 0 2px 15px rgba(0,0,0,0.1); overflow: hidden; border: 1px solid #ccc; position: relative; 
        }
        
        .profile-card::before {
            content: ""; position: absolute; top: 50%; left: 50%; width: 400px; height: 400px; transform: translate(-50%, -50%);
            background-image: url('logo.jpg'); background-repeat: no-repeat; background-position: center; background-size: contain; opacity: 0.04; pointer-events: none; z-index: 0;
        }

        .header { background: #004a99; color: #fff; padding: 20px; display: flex; align-items: center; justify-content: space-between; position: relative; z-index: 1; }
        .logo-area img { width: 75px; height: 75px; background: #fff; border-radius: 5px; padding: 5px; }
        .header-text { flex-grow: 1; text-align: center; }
        .header-text h2 { margin: 0; font-size: 22px; text-transform: uppercase; font-weight: bold; }
        .header-text p { margin: 5px 0; font-size: 11px; line-height: 1.4; }
        .user-pic img { width: 100px; height: 115px; border: 3px solid #fff; border-radius: 5px; object-fit: cover; box-shadow: 0 2px 5px rgba(0,0,0,0.2); }

        .content-body { padding: 15px 25px; position: relative; z-index: 1; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        .info-table td { padding: 7px 10px; border-bottom: 1px solid rgba(0,0,0,0.03); font-size: 12.5px; vertical-align: top; }
        .label { font-weight: bold; color: #004a99; width: 30%; }
        .sep { width: 3%; font-weight: bold; }
        .value { color: #333; width: 67%; font-weight: 500; }
        
        .section-title { background: #eef4fb; padding: 8px 12px; font-weight: bold; color: #004a99; border-left: 5px solid #004a99; margin: 12px 0 5px 0; font-size: 13px; }

        .nominee-container { display: flex; justify-content: space-between; align-items: flex-start; }
        .nominee-details { width: 80%; }
        .nominee-photo { width: 18%; text-align: right; }
        .nominee-photo img { width: 85px; height: 95px; border: 2px solid #ddd; border-radius: 4px; object-fit: cover; margin-top: 5px; }

        .signature-area { display: flex; justify-content: space-between; margin-top: 50px; padding: 0 50px 30px 50px; position: relative; z-index: 1; }
        .sig-box { text-align: center; width: 200px; }
        .sig-line { border-top: 1.2px solid #444; margin-bottom: 5px; }
        .sig-text { font-size: 12px; font-weight: bold; color: #444; }

        @media print {
            body { background: #fff; padding: 0; }
            .profile-card { box-shadow: none; border: 1px solid #ddd; }
            .no-print { display: none; }
        }
        @media print {
    @page {
        size: A4;
        margin: 10mm; /* কাগজের চারপাশের মার্জিন */
    }
    
    body {
        background: #fff;
        padding: 0;
        margin: 0;
    }

    .profile-card {
        box-shadow: none;
        border: 1px solid #ddd;
        max-width: 100%; /* পুরো স্ক্রিন জুড়ে থাকবে */
        height: auto;
        overflow: hidden;
    }

    /* কন্টেন্ট ১ পাতায় আটকাতে সাইজ কিছুটা কমানো হয়েছে */
    .content-body {
        padding: 10px 20px;
    }

    .info-table td {
        padding: 4px 10px; /* টেবিলের রো-র উচ্চতা কমানো হয়েছে */
        font-size: 11px;
    }

    .section-title {
        margin: 8px 0 3px 0;
        padding: 5px 10px;
        font-size: 12px;
    }

    .signature-area {
        margin-top: 30px; /* সিগনেচারের গ্যাপ কমানো হয়েছে */
    }

    .no-print {
        display: none; /* প্রিন্ট বাটান বা অন্য কিছু হাইড করতে */
    }
}

    </style>
    
</head>
<body>
<?php
if(isset($_POST['userid'])) {
    $userid = $_POST['userid']; 
    $sql = "SELECT tai.*, thn.hospitalname FROM tblapplicantinfo tai 
            INNER JOIN tblhospitalname thn ON tai.hospitalname = thn.hid 
            WHERE tai.mid = '$userid'";

    $result = $connect->query($sql);
    if($row = $result->fetch_assoc()) {
        $imageUrl = substr($row['userpic'], 3);
        $userSignature = !empty($row['signature']) ? substr($row['signature'], 3) : 'default.png'; 
        $nomineePic = !empty($row['nomineepic']) ? substr($row['nomineepic'], 3) : 'default.png';
        // --- বয়স অটো ক্যালকুলেশন (Year, Month, Day) ---
        $birthDate = new DateTime($row['dateofbirth']);
        $today = new DateTime();
        $diff = $today->diff($birthDate);
        $fullAge = $diff->y . " Years, " . $diff->m . " Months, " . $diff->d . " Days";
        // -------------------------------------------
?>

<div class="profile-card">
    <div class="header">
        <div class="logo-area"><img src="logo.jpg" alt="Logo"></div>
        <div class="header-text">
            <h2>Nurses Health Care Society</h2>
            <p>Dhaka-1206. <br> Phone: 01717288965, 01689597474 | Email: nhcs.org.bd@gmail.com</p>
        </div>
        <div class="user-pic"><img src="<?php echo $imageUrl; ?>" alt="Member"></div>
    </div>

    <div class="content-body">
        <div class="section-title">ব্যক্তিগত তথ্য (Personal Information)</div>
        <table class="info-table">
            <tr><td class="label">নাম (বাংলা)</td><td class="sep">:</td><td class="value"><?php echo $row['name_bangla'];?></td></tr>
            <tr><td class="label">Name (English)</td><td class="sep">:</td><td class="value"><?php echo $row['name_english'];?></td></tr>
            <tr><td class="label">পিতা ও মাতার নাম</td><td class="sep">:</td><td class="value"><?php echo $row['fathers_name'];?> & <?php echo $row['mothers_name'];?></td></tr>
            <tr><td class="label">জন্ম তারিখ ও বয়স</td><td class="sep">:</td><td class="value"><?php echo date("d/m/Y", strtotime($row['dateofbirth']));?> <span style="font-size: 11px; color: #666;">(<?php echo $fullAge; ?>)</span></td></tr>
            <tr><td class="label">লিঙ্গ ও বৈবাহিক অবস্থা</td><td class="sep">:</td><td class="value"><?php echo $row['gender'];?> | <?php echo $row['maritalstatus'];?></td></tr>
            <tr><td class="label">ব্লাড গ্রুপ ও এনআইডি</td><td class="sep">:</td><td class="value"><span style="color:red; font-weight:bold;"><?php echo $row['bloodgroup'];?></span> | <?php echo $row['nid'];?></td></tr>
        </table>

        <div class="section-title">পেশাগত ও যোগাযোগ (Professional & Contact)</div>
        <table class="info-table">
            <tr><td class="label">হাসপাতালের নাম</td><td class="sep">:</td><td class="value"><?php echo $row['hospitalname'];?></td></tr>
            <tr><td class="label">মোবাইল ও ইমেইল</td><td class="sep">:</td><td class="value"><?php echo $row['mobileno'];?> | <?php echo $row['email'];?></td></tr>
            <tr><td class="label">বর্তমান ঠিকানা</td><td class="sep">:</td><td class="value"><?php echo $row['presentaddress'];?></td></tr>
            <tr><td class="label">স্থায়ী ঠিকানা</td><td class="sep">:</td><td class="value"><?php echo $row['permanentaddress'];?></td></tr>
            <tr><td class="label">জরুরি যোগাযোগ</td><td class="sep">:</td><td class="value"><?php echo $row['emergencycontact'];?></td></tr>
        </table>

        <div class="section-title">নমিনি ও ব্যাংক তথ্য (Nominee & Bank)</div>
        <div class="nominee-container">
            <div class="nominee-details">
                <table class="info-table">
                    <tr><td class="label">নমিনির নাম ও সম্পর্ক</td><td class="sep">:</td><td class="value"><?php echo $row['nomineename'];?> (<?php echo $row['nomineerelation'];?>)</td></tr>
                    <tr><td class="label">মোবাইল ও ঠিকানা</td><td class="sep">:</td><td class="value"><?php echo $row['nomineemobile'];?> (<?php echo $row['nomineeaddress'];?>)</td></tr>
                    <tr><td class="label">ব্যাংক ও শাখা</td><td class="sep">:</td><td class="value"><?php echo $row['bankmname'];?> (<?php echo $row['branchname'];?>)</td></tr>
                    <tr><td class="label">হিসাব নাম ও নম্বর</td><td class="sep">:</td><td class="value"><?php echo $row['acc_name'];?> - <?php echo $row['acc_no'];?></td></tr>
                    <tr><td class="label">মোবাইল ব্যাংকিং</td><td class="sep">:</td><td class="value"><?php echo $row['mobilebanktype'];?> (<?php echo $row['mobilebankno'];?>)</td></tr>
                </table>
            </div>
            <div class="nominee-photo">
                <img src="<?php echo $nomineePic; ?>" alt="Nominee">
                <p style="font-size: 9px; color: #666; text-align: center; margin-top: 2px;">NOMINEE</p>
            </div>
        </div>
    </div>

<?php
$sigSql = "SELECT tai.name_english, tai.signature,tau.designations 
           FROM tbladminuser tau, tblapplicantinfo tai 
           WHERE tau.designations IN('Founder & General Secretary') 
           LIMIT 1";
$sigresult = $connect->query($sigSql);

// Initialize variables to avoid "undefined" errors
$signatureHtml = "";
$accountantName = "General Secretary";

if($row = $sigresult->fetch_array()) {
    $accountantName = $row['name_english'];
    $designation = $row['designations'];
    $imageUrl = substr($row['signature'], 3); 
    
    // Check if file actually exists on the server
    if (!empty($row['signature']) && file_exists($row['signature'])) {
        $signatureHtml = "<img src='".$imageUrl."' style='max-height: 70px; max-width: 180px; object-fit: contain;'>";
    }
}
?>
<div style="margin-top: 60px; display: flex; justify-content: space-between; align-items: flex-end; padding: 0 30px;">
    
    <!-- Member's Signature Box -->
    <div class="sig-box" style="text-align: center; width: 140px;">
        <?php if(!empty($userSignature)): ?>
            <img src="<?php echo $userSignature; ?>" alt="User Signature" style="max-height: 45px; max-width: 140px; margin-bottom: 5px;">
        <?php else: ?>
            <div style="height: 50px;"></div> 
        <?php endif; ?>
        <div class="sig-line" style="border-top: 1.2px solid #444;"></div>
        <div class="sig-text" style="font-size: 11px; font-weight: bold; color: #444; margin-top: 5px;">Member's Signature</div>
    </div>

    <!-- Accountant/Official Signature Box -->
    <div style="text-align: center; width: 250px;">
        <!-- Signature Image -->
        <div style="min-height: 50px; display: flex; align-items: flex-end; justify-content: center; margin-bottom: 5px;">
            <?php if($signatureHtml !== ""): ?>
                <?php echo $signatureHtml; ?>
            <?php else: ?>
                <div style="height: 40px;"></div> 
            <?php endif; ?>
        </div>
        
        <!-- Signature Line and Info -->
        <div style="border-top: 2px solid #1a237e; padding-top: 10px;">Athorized by
            <div style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight: 700; font-size: 14px; color: #1a237e; letter-spacing: 0.5px; text-transform: uppercase; margin-bottom: 2px;">
                <?php echo htmlspecialchars($accountantName); ?>
            </div>
            <div style="font-weight: 600; font-size: 12px; color: #444; line-height: 1.2;">
                <?php echo htmlspecialchars($designation); ?>
            </div>
            <div style="font-weight: 500; font-size: 12px; color: #004a99; font-style: italic; margin-top: 4px; border-left: 3px solid #004a99; padding-left: 8px; text-align: left;">
                Nurses Health Care Society Bangladesh
            </div>
        </div>
    </div>

</div>

    <div style="padding: 15px; text-align: right; background: #f9f9f9;" class="no-print">
        <button onclick="window.print()" style="padding: 8px 25px; background: #004a99; color: white; border: none; cursor: pointer; border-radius: 4px; font-weight: bold;">PRINT PROFILE</button>
    </div>
</div>
<?php 
    } else { echo "<p style='text-align:center;'>No Data Found.</p>"; }
} 
?>
</body>
</html>
