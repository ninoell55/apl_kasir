<?php
// Halaman update status pesanan
require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

$pageTitle = "Halaman Update Status Pesanan";

// Cek login
if (!isset($_SESSION['login_users'])) {
    header('Location: ../../../auth/admin/login.php');
    exit;
}

$id_pesanan = $_GET['id'];
$status     = $_GET['status'];

// Update status di tabel pesanan
$sqlUpdate = "UPDATE pesanan SET status = ? WHERE id_pesanan = ?";
$stmtUpdate = $conn->prepare($sqlUpdate);
$stmtUpdate->bind_param("si", $status, $id_pesanan);
$stmtUpdate->execute();
$stmtUpdate->close();

// Simpan ke log_status_pesanan
$sqlLog = "INSERT INTO log_status_pesanan (id_pesanan, status_baru, waktu) 
           VALUES (?, ?, NOW())";
$stmtLog = $conn->prepare($sqlLog);
$stmtLog->bind_param("is", $id_pesanan, $status);
$stmtLog->execute();
$stmtLog->close();

// Kembali ke daftar pesanan
header("Location: index.php");
exit;