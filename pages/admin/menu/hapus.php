<?php
// Halaman hapus menu

require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

// Logika hapus menu
$id = $_GET['id'] ?? 0;

if ($id) {
    if (deleteMenu($id)) {
        header('Location: index.php');
        exit;
    } else {
        $error = 'Gagal menghapus menu. Pastikan ID menu valid.';
    }
}