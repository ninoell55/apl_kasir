<?php
// Halaman hapus meja
require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

$pageTitle = 'Halaman Hapus Meja';

// Cek login
if (!isset($_SESSION['login_users'])) {
    header('Location: ../../../auth/admin/login.php');
    exit;
}

// Ambil ID
$id = $_GET['id'] ?? 0;
if (!$id) {
    $error = 'ID meja tidak ditemukan.';
    exit;
}

// Jalankan hapus
if (deleteMeja($id) > 0) {
    header('Location: index.php?success=delete');
    exit;
} else {
    header("Location: index.php?error=1");
    exit;
}
