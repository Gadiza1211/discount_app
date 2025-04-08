<?php
require_once __DIR__ . '/../controllers/BarangController.php';

$barangController = new BarangController();
$barang = null;

// Ambil data barang berdasarkan ID
if (isset($_GET["id"])) {
    $barang = $barangController->getBarangById($_GET["id"]);
}

if (!$barang) {
    die("Barang tidak ditemukan.");
}

// Jika form disubmit, update barang
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $harga = $_POST["harga"];
    $diskon = $_POST["diskon"];
    $stok = $_POST["stok"];

    // Update barang
    if ($barangController->updateBarang($id, $nama, $harga, $diskon, $stok)) {
        header("Location: manajemen_barang.php");
        exit();
    } else {
        echo "Gagal memperbarui barang.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Barang</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $barang['id'] ?>">
            <label>Nama Barang:</label>
            <input type="text" name="nama" value="<?= $barang['nama'] ?>" required>
            
            <label>Harga:</label>
            <input type="number" name="harga" value="<?= $barang['harga'] ?>" required>
            
            <label>Diskon (%):</label>
            <input type="number" name="diskon" value="<?= $barang['diskon'] ?>" required>
            
            <label>Stok:</label>
            <input type="number" name="stok" value="<?= $barang['stok'] ?>" required>

            <button type="submit">Simpan Perubahan</button>
            <a href="manajemen_barang.php">Batal</a>
        </form>
         <!-- Tombol Kembali -->
         <a href="manajemen_barang.php" class="btn-back">Kembali</a>
    </div>
</body>
</html>
