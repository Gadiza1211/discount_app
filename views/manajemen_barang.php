<?php
require_once __DIR__ . '/../controllers/BarangController.php';

$barangController = new BarangController();
$barangList = $barangController->getBarang();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Barang</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container">
        <h2>Manajemen Barang</h2>
        <a href="tambah_barang.php">Tambah Barang</a>
        <table>
            <tr>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Diskon (%)</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
            <?php foreach ($barangList as $barang): ?>
                <tr>
                    <td><?= $barang['nama'] ?></td>
                    <td><?= $barang['harga'] ?></td>
                    <td><?= $barang['diskon'] ?></td>
                    <td><?= $barang['stok'] ?></td>
                    <td>
                        <a href="edit_barang.php?id=<?= $barang['id'] ?>">Edit</a> | 
                        <a href="hapus_barang.php?id=<?= $barang['id'] ?>">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <!-- Tombol Kembali di Manajemen Barang -->
<a href="dashboard_admin.php" class="btn-back">Kembali ke Dashboard</a>


    </div>
</body>
</html>
