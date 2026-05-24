<?php 
// ১. সেশন সব সময় সবার উপরে শুরু করতে হয়
session_start();
require_once 'php_action/db_connect.php';

if(isset($_SESSION['userId'])) {
	header('location: dashboard.php');
	exit();
}

$errors = array();

if($_POST) {		
	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) || empty($password)) {
		$errors[] = "ইমেইল এবং পাসওয়ার্ড উভয়ই প্রয়োজন।";
	} else {
		// ৩. SQL Injection পুরোপুরি বন্ধ করার আধুনিক পদ্ধতি (Prepared Statement)
		$stmt = $connect->prepare("SELECT * FROM tbladminuser WHERE username = ? AND status = 2");
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();

		if($result->num_rows == 1) {
			$value = $result->fetch_assoc();
			$encrypted_password = md5($password);
			
			if($encrypted_password === $value['password'] && $value['usertype'] == 'Administrator') {
				
				// ৪. লগইন সফল হলে সেশন আইডি পরিবর্তন করা (সিকিউরিটি)
				session_regenerate_id(true);

				$_SESSION['userId'] = $value['user_id'];
				$_SESSION['Username'] = $value['username']; 
				$_SESSION['BrandId'] = $value['brandid']; 
				$_SESSION['Role'] = $value['role']; 
				
				header('location: dashboard.php');
				exit();
			} else {
				$errors[] = "ভুল ইমেইল বা পাসওয়ার্ড।";
			}
		} else {		
			$errors[] = "এই ইউজারটি আমাদের সিস্টেমে নেই।";		
		}
	}
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>Login | Nurses Health Care Society</title>  
    <?php include ('layouts/1-base-head.php') ?>
    <style>
        :root {
            --nhcs-blue: #2196F3;
            --nhcs-purple: #7B1FA2;
        }
        body {
            background-color: #e9ecef;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 40px;
            margin-top: 10%;
            max-width: 450px;
            border-top: 5px solid var(--nhcs-blue);
        }
        .btn-login {
            background-color: var(--nhcs-blue);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            font-weight: bold;
        }
        .btn-login:hover { background-color: #1976D2; }

        /* চোখের আইকনের জন্য নতুন স্টাইল */
        .password-wrapper { position: relative; }
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 38px;
            cursor: pointer;
            color: #999;
            font-size: 18px;
            z-index: 10;
        }
    </style>
</head>
<body>
    <div class="container" align="center">
        <div class="login-card animated fadeIn">
            <img src="assets/img/logo.png" style="width: 200px; margin-bottom: 20px;">
            <h3 style="color: var(--nhcs-purple); font-weight: bold;">Welcome to Nurses Health Care Society!</h3>
            <p class="text-muted small">Sign up Now!</p>

            <!-- এলার্ট মেসেজ -->
            <?php if($errors): ?>
                <?php foreach ($errors as $error): ?>
                    <div class="alert alert-danger py-2 small" role="alert" align="left"><?php echo $error; ?></div>
                <?php endforeach; ?>
            <?php endif; ?>

            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" align="left">
                <div class="mb-3">
                    <label class="form-label small fw-bold">ইমেইল বা ইউজারনেম</label>
                    <input type="email" name="username" class="form-control" placeholder="admin@nhcsbd.org" required>
                </div>
                <div class="mb-4 password-wrapper">
                    <label class="form-label small fw-bold">পাসওয়ার্ড</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                    <!-- চোখের আইকন -->
                    <i class="glyphicon glyphicon-eye-open toggle-password" id="eyeIcon" onclick="togglePass()"></i>
                </div>
                <button type="submit" class="btn btn-login">Login</button>
            </form>
            <div class="mt-3">
                <a href="index.php" class="text-muted small text-decoration-none">← Back to Home</a>
            </div>
        </div>
    </div>

    <!-- আইকন কাজ করার জন্য ছোট স্ক্রিপ্ট -->
    <script>
        function togglePass() {
            var x = document.getElementById("password");
            var icon = document.getElementById("eyeIcon");
            if (x.type === "password") {
                x.type = "text";
                icon.classList.replace("glyphicon-eye-open", "glyphicon-eye-close");
            } else {
                x.type = "password";
                icon.classList.replace("glyphicon-eye-close", "glyphicon-eye-open");
            }
        }
    </script>

    <?php include ('layouts/5-base-js.php') ?>
</body>
</html>
