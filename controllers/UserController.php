<?php
require_once __DIR__ . '/../models/User.php';
session_start();

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $role = $_POST["role"]; // 'admin' atau 'user'

            if ($this->userModel->register($username, $password, $role)) {
                header("Location: login.php");
                exit();
            } else {
                echo "Registrasi gagal.";
            }
        }
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];

            $user = $this->userModel->login($username, $password);

            if ($user) {
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["role"] = $user["role"];

                if ($user["role"] == "admin") {
                    header("Location: dashboard_admin.php");
                } else {
                    header("Location: dashboard_user.php");
                }
                exit();
            } else {
                echo "Username atau password salah.";
            }
        }
    }

    public function logout() {
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
?>
