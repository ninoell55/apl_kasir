<?php
// Halaman proses login admin
require_once '../../connection/conn.php';
require_once '../../config/functions.php';

$pageTitle = 'Halaman Proses Login Admin';

// Pengecekan SESSION ADMIN
if (isset($_SESSION['login_users'])) {
    header('Location: ../../pages/admin/dashboard.php');
    exit;
}

// Pengecekan Fungsi login_user
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginResult = login_users($conn, $username, $password);

    if ($loginResult['success']) {
        header('Location: ../../pages/admin/dashboard.php');
        exit;
    } else {
        // Kirim pesan error ke halaman login
        $message = urlencode($loginResult['message'] ?? 'Login gagal.');
        header("Location: login.php?error={$message}");
        exit;
    }
} else {
    header('Location: login.php');
    exit;
}
