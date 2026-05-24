<?php
if(isset($state) && ($state == "local" || $state == "testing")) {
    ini_set("display_errors", "1");
    error_reporting(E_ALL & ~E_NOTICE);
} else {
    error_reporting(0);
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// অ্যাডমিন চেক: userId থাকতে হবে এবং Role অবশ্যই Administrator হতে হবে
if (!isset($_SESSION['userId']) || empty($_SESSION['userId']) || $_SESSION['Role'] !== 'Administrator') {
    session_unset();
    session_destroy();
    header("Location: index.php"); // অ্যাডমিন লগইন পেজে পাঠাবে
    exit();
}

// সেশন রিজেনারেশন (নিরাপত্তার জন্য)
if (!isset($_SESSION['last_regeneration'])) {
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
} elseif (time() - $_SESSION['last_regeneration'] > 1800) {
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}
?>
