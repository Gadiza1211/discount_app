<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "user") {
    header("Location: login.php");
    exit();
}

require_once __DIR__ . '/../controllers/TransaksiController.php';
$controller = new TransaksiController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller->beliBarang();
}

$barangList = $controller->getBarang();
$transaksiList = $controller->getTransaksiUser();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h2>Belanja</h2>
    <form method="POST">
        <label>Pilih Barang:</label>
        <select name="barang_id" required>
            <?php while ($barang = $barangList->fetch_assoc()) : ?>
                <option value="<?= $barang['id'] ?>">
                    <?= $barang['nama'] ?> - Rp<?= number_format($barang['harga'], 2, ',', '.') ?> 
                    (Diskon: <?= $barang['diskon'] ?>%)
                </option>
            <?php endwhile; ?>
        </select>

        <label>Jumlah:</label>
        <input type="number" name="jumlah" required>

        <button type="submit">Beli</button>
    </form>

    <h3>Riwayat Transaksi</h3>
    <table border="1">
        <tr>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Total Harga</th>
            <th>Tanggal</th>
        </tr>
        <?php while ($transaksi = $transaksiList->fetch_assoc()) : ?>
            <tr>
                <td><?= $transaksi["nama"] ?></td>
                <td><?= $transaksi["jumlah"] ?></td>
                <td>Rp<?= number_format($transaksi["total_harga"], 2, ',', '.') ?></td>
                <td><?= $transaksi["tanggal"] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <a href="dashboard_user.php">Kembali</a>
</body>
</html>
