<?php
require_once __DIR__ . '/../controllers/BarangController.php';

if (isset($_GET["id"])) {
    $barangController = new BarangController();
    $barangController->hapusBarang($_GET["id"]);
}

header("Location: manajemen_barang.php");
exit();
?>
