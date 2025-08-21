<?php
// Halaman detail pesanan
require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

$pageTitle = 'Halaman Detail Pesanan';

// Cek login
if (!isset($_SESSION['login_users'])) {
    header('Location: ../../../auth/admin/login.php');
    exit;
}

$id_pesanan = $_GET['id'];

// Ambil data pesanan
$pesanan = query(
    "SELECT 
        p.*, m.no_meja 
            FROM pesanan p 
        LEFT JOIN meja m ON p.id_meja = m.id_meja 
    WHERE p.id_pesanan='$id_pesanan'"
);

// Ambil detail pesanan
$detailPesanan = query(
    "SELECT 
        dp.*, mn.nama_menu, mn.harga 
            FROM detail_pesanan dp
                JOIN menu mn ON dp.id_menu = mn.id_menu
        WHERE dp.id_pesanan = '$id_pesanan'"
);

require_once '../../../includes/header.php';
require_once '../../../includes/navbar.php';
require_once '../../../includes/sidebar.php';
?>

<div class="p-6 min-h-screen text-gray-100">
    <?php foreach ($pesanan as $row): ?>
        <div class="bg-gray-800 p-5 rounded-lg shadow-md mb-6">
            <h2 class="text-2xl font-semibold mb-4 border-b border-gray-700 pb-2">
                Detail Pesanan #<?= $row['kode_pesanan']; ?>
            </h2>
            <div class="grid gap-3 text-gray-300">
                <div class="flex justify-between">
                    <span class="font-medium text-gray-200">No Meja:</span>
                    <span><?= $row['no_meja']; ?></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="font-medium text-gray-200">Status:</span>
                    <span class="px-2 py-1 text-xs font-medium rounded-full 
                <?= $row['status'] === 'selesai' ? 'bg-green-900 text-green-300' : ($row['status'] === 'diproses' ? 'bg-yellow-900 text-yellow-300' : 'bg-gray-700 text-gray-300'); ?>">
                        <?= ucfirst($row['status']); ?>
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-200">Tanggal:</span>
                    <span><?= $row['tanggal_pesanan']; ?></span>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="overflow-x-auto bg-gray-800 shadow-md rounded-lg">
        <table class="w-full text-sm text-left border border-gray-700">
            <thead class="bg-gray-700 text-gray-200">
                <tr>
                    <th class="px-4 py-3 border border-gray-700">Menu</th>
                    <th class="px-4 py-3 border border-gray-700">Qty</th>
                    <th class="px-4 py-3 border border-gray-700">Harga</th>
                    <th class="px-4 py-3 border border-gray-700">Subtotal</th>
                    <th class="px-4 py-3 border border-gray-700">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                <?php $total = 0;
                foreach ($detailPesanan as $row) :
                    $subtotal = $row['qty'] * $row['harga'];
                    $total += $subtotal; ?>
                    <tr class="hover:bg-gray-700">
                        <td class="px-4 py-3 border border-gray-700"><?= $row['nama_menu']; ?></td>
                        <td class="px-4 py-3 border border-gray-700"><?= $row['qty']; ?></td>
                        <td class="px-4 py-3 border border-gray-700">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td class="px-4 py-3 border border-gray-700">Rp <?= number_format($subtotal, 0, ',', '.'); ?></td>
                        <td class="px-4 py-3 border border-gray-700">Rp <?= number_format($total, 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../../../includes/footer.php'; ?>