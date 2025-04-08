<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}

require_once __DIR__ . '/../controllers/TransaksiController.php';
$controller = new TransaksiController();
$transaksiList = $controller->getAllTransaksi();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h2>Laporan Transaksi</h2>

    <table border="1">
        <tr>
            <th>Nama User</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Tanggal</th>
        </tr>
        <?php while ($transaksi = $transaksiList->fetch_assoc()) : ?>
            <tr>
                <td><?= $transaksi["username"] ?></td>
                <td><?= $transaksi["nama"] ?></td>
                <td><?= $transaksi["jumlah"] ?></td>
                <td>Rp<?= number_format($transaksi["total_harga"], 2, ',', '.') ?></td>
                <td><?= $transaksi["tanggal"] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <a href="dashboard_admin.php">Kembali</a>
</body>
</html>
