<?php
require_once __DIR__ . '/../controllers/BarangController.php';

$barangController = new BarangController();
$barangList = $barangController->getBarang(); // Change here from getAllBarang() to getBarang()
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Barang</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container">
        <h2>Katalog Barang</h2>
        <table>
            <tr>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Diskon (%)</th>
                <th>Stok</th>
            </tr>
            <?php foreach ($barangList as $barang): ?>
                <tr>
                    <td><?= $barang['nama'] ?></td>
                    <td><?= $barang['harga'] ?></td>
                    <td><?= $barang['diskon'] ?></td>
                    <td><?= $barang['stok'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <!-- Tombol Kembali -->
        <a href="dashboard_user.php" class="btn-back">Kembali ke Dashboard</a>
    </div>
</body>
</html>
