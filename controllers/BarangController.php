<?php
require_once __DIR__ . '/../models/Barang.php';

class BarangController {
    private $barangModel;

    public function __construct() {
        $this->barangModel = new Barang();
    }

    public function tambahBarang() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama = $_POST["nama"];
            $harga = $_POST["harga"];
            $diskon = $_POST["diskon"];
            $stok = $_POST["stok"];

            if ($this->barangModel->create($nama, $harga, $diskon, $stok)) {
                header("Location: manajemen_barang.php");
                exit();
            } else {
                echo "Gagal menambahkan barang.";
            }
        }
    }

    public function hapusBarang($id) {
        if ($this->barangModel->delete($id)) {
            header("Location: manajemen_barang.php");
            exit();
        } else {
            echo "Gagal menghapus barang.";
        }
    }

    public function getBarang() {
        return $this->barangModel->getAll();
    }

    public function getBarangById($id) {
        return $this->barangModel->getById($id);
    }

    public function updateBarang($id, $nama, $harga, $diskon, $stok) {
        if ($this->barangModel->update($id, $nama, $harga, $diskon, $stok)) {
            return true;
        } else {
            return false;
        }
    }
    
}
?>
