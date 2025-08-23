<?php
// Halaman struk pembayaran
require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

$pageTitle = 'Halaman Struk Pembayaran';

// Cek login
if (!isset($_SESSION['login_users'])) {
    header('Location: ../../../auth/admin/login.php');
    exit;
}

$id = $_GET['id'];

if (!$id) {
    header('Location: index.php');
    exit;
}

// Data pembayaran + pesanan
$dataStruk = query(
    "SELECT 
        p.*, ps.kode_pesanan, ps.total, u.nama_lengkap 
    FROM pembayaran p
        JOIN pesanan ps ON p.id_pesanan = ps.id_pesanan
        LEFT JOIN users u ON p.id_kasir = u.id_user
    WHERE p.id_pembayaran = '$id'"
)[0];

// Data detail pesanan
$idPesanan = $dataStruk['id_pesanan'];
$detailPesanan = query(
    "SELECT m.nama_menu, dp.qty, m.harga, (dp.qty * m.harga) as subtotal
     FROM detail_pesanan dp
     JOIN menu m ON dp.id_menu = m.id_menu
     WHERE dp.id_pesanan = '$idPesanan'"
);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran</title>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL; ?>assets/img/logo.png" />
    <link href="<?= BASE_URL; ?>/assets/css/output.css" rel="stylesheet">
</head>

<body class="font-mono text-sm text-black bg-gray-100 min-h-screen flex justify-center py-6 print:bg-white" onload="window.print()">

    <div class="bg-white shadow-md rounded-lg p-4 w-full max-w-md print:shadow-none print:rounded-none print:p-0 print:w-[280px]">
        <!-- Header Logo & Info Toko -->
        <div class="text-center mb-3">
            <img src="<?= BASE_URL; ?>assets/img/logo.png" alt="Logo" class="mx-auto w-14 h-14 mb-1">
            <h2 class="text-lg font-bold">Loka Café</h2>
            <p class="text-xs">Jl. Perjuangan No.123, Cirebon</p>
            <p class="text-xs">Telp: 0877-4086-4657</p>
        </div>

        <hr class="border-t border-dashed border-black my-2">

        <!-- Info Transaksi -->
        <div class="mb-2">
            <p>Kode Pesanan : <?= $dataStruk['kode_pesanan'] ?></p>
            <p>Kasir : <?= $dataStruk['nama_lengkap'] ?></p>
            <p>Tanggal : <?= $dataStruk['tanggal_pembayaran'] ?></p>
        </div>

        <hr class="border-t border-dashed border-black my-2">

        <!-- Detail Pesanan -->
        <table class="w-full mb-2">
            <tbody>
                <?php foreach ($detailPesanan as $row): ?>
                    <tr>
                        <td class="py-0.5"><?= $row['nama_menu'] ?> (<?= $row['qty'] ?>x)</td>
                        <td class="py-0.5 text-right">Rp <?= number_format($row['subtotal']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <hr class="border-t border-dashed border-black my-2">

        <!-- Total -->
        <table class="w-full mb-2">
            <tbody>
                <tr>
                    <td class="py-0.5 font-semibold">Total</td>
                    <td class="py-0.5 text-right font-semibold">Rp <?= number_format($dataStruk['total']) ?></td>
                </tr>
                <tr>
                    <td class="py-0.5">Bayar</td>
                    <td class="py-0.5 text-right">Rp <?= number_format($dataStruk['jumlah_bayar']) ?></td>
                </tr>
                <tr>
                    <td class="py-0.5">Kembalian</td>
                    <td class="py-0.5 text-right">Rp <?= number_format($dataStruk['kembalian']) ?></td>
                </tr>
            </tbody>
        </table>

        <hr class="border-t border-dashed border-black my-2">

        <!-- Footer -->
        <div class="text-center">
            <p class="mt-1">✨ Terima kasih sudah berkunjung ✨</p>
            <p class="text-[11px] mt-1">Terima kasih atas pembelian Anda. Mohon diperhatikan bahwa transaksi bersifat final.</p>
        </div>
    </div>

</body>

</html>