<?php
// Halaman hapus users
require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

$pageTitle = 'Halaman Hapus Users';

// Cek login
if (!isset($_SESSION['login_users'])) {
    header('Location: ../../../auth/admin/login.php');
    exit;
}

// Logika hapus users
$id = $_GET['id'];

if (deleteUser($id)) {
    header("Location: index.php?success=delete");
    exit;
} else {
    header("Location: index.php?error=1");
    exit;
}
