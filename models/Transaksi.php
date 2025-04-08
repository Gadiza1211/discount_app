<?php
require_once __DIR__ . '/../config/database.php';

class Transaksi {
    private $conn;
    private $table_name = "transaksi";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($user_id, $barang_id, $jumlah, $total_harga) {
        $stmt = $this->conn->prepare("INSERT INTO $this->table_name (user_id, barang_id, jumlah, total_harga) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $user_id, $barang_id, $jumlah, $total_harga);
        return $stmt->execute();
    }

    public function getByUser($user_id) {
        $stmt = $this->conn->prepare("SELECT t.*, b.nama FROM $this->table_name t JOIN barang b ON t.barang_id = b.id WHERE t.user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT t.*, u.username, b.nama FROM $this->table_name t 
                                      JOIN users u ON t.user_id = u.id 
                                      JOIN barang b ON t.barang_id = b.id");
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>
