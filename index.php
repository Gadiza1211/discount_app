<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION["user_id"])) {
    header("Location: views/login.php");
    exit();
}

// Arahkan berdasarkan role
if ($_SESSION["role"] == "admin") {
    header("Location: views/dashboard_admin.php");
} else {
    header("Location: views/dashboard_user.php");
}
exit();
?>
