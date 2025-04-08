<?php
require_once __DIR__ . '/../config/database.php';

class Barang {
    private $conn;
    private $table_name = "barang";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table_name");
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table_name WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($nama, $harga, $diskon, $stok) {
        $stmt = $this->conn->prepare("INSERT INTO $this->table_name (nama, harga, diskon, stok) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdii", $nama, $harga, $diskon, $stok);
        return $stmt->execute();
    }

    public function update($id, $nama, $harga, $diskon, $stok) {
        $stmt = $this->conn->prepare("UPDATE $this->table_name SET nama = ?, harga = ?, diskon = ?, stok = ? WHERE id = ?");
        $stmt->bind_param("sdiii", $nama, $harga, $diskon, $stok, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM $this->table_name WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
