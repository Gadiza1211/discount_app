<?php
require_once __DIR__ . '/../models/Transaksi.php';
require_once __DIR__ . '/../models/Barang.php';

class TransaksiController {
    private $transaksiModel;
    private $barangModel;

    public function __construct() {
        $this->transaksiModel = new Transaksi();
        $this->barangModel = new Barang();
    }

    public function beliBarang() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (!isset($_SESSION["user_id"])) {
                header("Location: login.php");
                exit();
            }

            $user_id = $_SESSION["user_id"];
            $barang_id = $_POST["barang_id"];
            $jumlah = $_POST["jumlah"];

            // Ambil data barang
            $barangList = $this->barangModel->getAll()->fetch_all(MYSQLI_ASSOC);
            $barang = null;

            foreach ($barangList as $b) {
                if ($b["id"] == $barang_id) {
                    $barang = $b;
                    break;
                }
            }

            if (!$barang) {
                echo "Barang tidak ditemukan.";
                return;
            }

            $harga = $barang["harga"];
            $diskon = $barang["diskon"];
            $stok = $barang["stok"];

            if ($jumlah > $stok) {
                echo "Stok tidak mencukupi.";
                return;
            }

            // Hitung total harga setelah diskon
            $harga_setelah_diskon = $harga - ($harga * $diskon / 100);
            $total_harga = $harga_setelah_diskon * $jumlah;

            // Simpan transaksi
            if ($this->transaksiModel->create($user_id, $barang_id, $jumlah, $total_harga)) {
                echo "Pembelian berhasil!";
            } else {
                echo "Terjadi kesalahan.";
            }
        }
    }

    public function getBarang() {
        return $this->barangModel->getAll();
    }

    public function getAllTransaksi() {
        return $this->transaksiModel->getAll();
    }

    public function getTransaksiUser() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return $this->transaksiModel->getByUser($_SESSION["user_id"]);
    }
}
?>
