<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<div class="container">
    <h2><i class="fas fa-chart-line"></i> Dashboard</h2>
<body>
    <div class="menu">
        <a href="manajemen_barang.php"><i class="fas fa-box"></i> Manajemen Barang</a>
        <a href="laporan.php"><i class="fas fa-file-alt"></i> Laporan</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

</body>
</html>
