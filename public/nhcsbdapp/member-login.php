<?php 
session_start();
require_once 'php_action/db_connect.php';

if(isset($_SESSION['userId'])) {
	header('location: dashboard-member.php');
	exit();
}

$errors = array();

if($_POST) {		
	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) || empty($password)) {
		$errors[] = "Username and Password are required";
	} else {
		$stmt = $connect->prepare("SELECT * FROM tblapplicantinfo WHERE email = ? AND status = 2");
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();

		if($result->num_rows == 1) {
			$value = $result->fetch_assoc();
			$encrypted_password = md5($password);
			
			if($encrypted_password === $value['password']) {
				session_regenerate_id(true);
				$_SESSION['userId'] = $value['mid'];
				$_SESSION['Username'] = $value['email'];
				$_SESSION['Role'] = $value['role']; 
				header('location: dashboard-member.php');
				exit();
			} else {
				$errors[] = "Incorrect username/password combination";
			}
		} else {		
			$errors[] = "Member does not exist";		
		}
	}
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>Member Login | NHCS</title>  
    <?php include ('layouts/1-base-head.php') ?>
    <style>
        :root {
            --nhcs-purple: #6A1B9A; /* লোগোর বেগুনি */
            --nhcs-blue: #2962FF;   /* লোগোর নীল */
            --nhcs-green: #05B262;  /* আপনার ব্যাকগ্রাউন্ড সবুজ */
        }
        body {
            background-color: var(--nhcs-purple);
            font-family: 'Segoe UI', Tahoma, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            padding: 40px;
            width: 100%;
            max-width: 550px;
            text-align: center;
            border-bottom: 8px solid var(--nhcs-blue);
        }
        .logo-box img {
            width: 140px;
            margin-bottom: 20px;
        }
        h2 {
            color: var(--nhcs-purple);
            font-weight: 700;
            font-size: 22px;
            margin-bottom: 10px;
        }
        .form-label {
            font-weight: 600;
            color: #444;
            display: block;
            text-align: left;
            margin-bottom: 5px;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 2px solid #f0f0f0;
            transition: 0.3s;
        }
        .form-control:focus {
            border-color: var(--nhcs-blue);
            box-shadow: none;
        }
        .password-wrapper { position: relative; }
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 40px;
            cursor: pointer;
            color: #bbb;
            font-size: 18px;
        }
        .btn-login {
            background-color: var(--nhcs-blue);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 700;
            transition: 0.3s;
        }
        .btn-login:hover {
            background-color: var(--nhcs-purple);
            transform: translateY(-2px);
        }
        .btn-clear {
            background-color: #f8f9fa;
            border: 2px solid #f0f0f0;
            padding: 10px 25px;
            border-radius: 10px;
            margin-left: 10px;
        }
    </style>
</head>
<body>

<div class="login-card animated fadeInUp">
    <div class="logo-box">
        <img src="assets/img/logo.png" alt="NHCS Logo">
        <h2>Welcome Honourable Member to <br> Nurses Health Care Society!</h2>
        <p class="">Sign up Now! for Nurses Health Care Society accounts</p>
    </div>

    <?php if($errors): ?>
        <?php foreach ($errors as $error): ?>
            <div class="alert alert-danger py-2 small" role="alert">
                <i class="glyphicon glyphicon-exclamation-sign"></i> <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="row">
            <div class="col-md-6 mb-3 text-start">
                <label class="form-label">ব্যবহারকারীর নাম</label>
                <input type="email" name="username" class="form-control" placeholder="Email Address" required>
            </div>
            <div class="col-md-6 mb-4 text-start password-wrapper">
                <label class="form-label">পাসওয়ার্ড</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                <i class="glyphicon glyphicon-eye-open toggle-password" id="eyeIcon" onclick="togglePass()"></i>
            </div>
        </div>
        
        <div class="mt-2">
            <button type="submit" class="btn btn-login shadow-sm">Login</button>
            <button type="reset" class="btn btn-clear">Clear</button>
        </div>
    </form> </br></br>
    <div class="mt-3">
                <a href="index.php" class="text-muted small text-decoration-none">← Back to Home</a>
    </div>
</div>

<script>
    function togglePass() {
        var x = document.getElementById("password");
        var icon = document.getElementById("eyeIcon");
        if (x.type === "password") {
            x.type = "text";
            icon.classList.replace("glyphicon-eye-open", "glyphicon-eye-close");
            icon.style.color = "#2962FF";
        } else {
            x.type = "password";
            icon.classList.replace("glyphicon-eye-close", "glyphicon-eye-open");
            icon.style.color = "#bbb";
        }
    }
</script>

<?php include ('layouts/5-base-js.php') ?> 
</body>
</html>
