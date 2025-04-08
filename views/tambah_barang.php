<?php
require_once __DIR__ . '/../controllers/BarangController.php';

$barangController = new BarangController();

// Jika form disubmit, tambah barang
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $harga = $_POST["harga"];
    $diskon = $_POST["diskon"];
    $stok = $_POST["stok"];

    $barangController->tambahBarang($nama, $harga, $diskon, $stok);
    header("Location: manajemen_barang.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Barang</h2>
        <form method="POST">
            <label>Nama Barang:</label>
            <input type="text" name="nama" required>
            
            <label>Harga:</label>
            <input type="number" name="harga" required>
            
            <label>Diskon (%):</label>
            <input type="number" name="diskon" required>
            
            <label>Stok:</label>
            <input type="number" name="stok" required>

            <button type="submit">Tambah Barang</button>
            <a href="manajemen_barang.php">Batal</a>
        </form>
    </div>
</body>
</html>
