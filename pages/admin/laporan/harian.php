<?php
require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

$pageTitle = 'Laporan Harian';

// Cek login
if (!isset($_SESSION['login_users'])) {
    header('Location: ../../../auth/admin/login.php');
    exit;
}

// Ambil tanggal filter
$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');

// Query pesanan sesuai tanggal
$pesanan = query(
    "SELECT 
        p.id_pesanan, p.kode_pesanan, p.total, p.status, p.tanggal_pesanan, m.no_meja 
    FROM pesanan p 
        LEFT JOIN meja m
            ON p.id_meja = m.id_meja
        WHERE DATE(p.tanggal_pesanan) = '$tanggal'
    ORDER BY p.tanggal_pesanan DESC"
);

// Hitung total pemasukan
$totalPemasukan = 0;
foreach ($pesanan as $row) {
    if ($row['status'] == 'dibayar') {
        $totalPemasukan += $row['total'];
    }
}

require_once '../../../includes/header.php';
require_once '../../../includes/navbar.php';
require_once '../../../includes/sidebar.php';
?>

<div class="p-6 bg-gray-900 min-h-screen text-gray-200">
    <h1 class="text-2xl font-bold mb-6 flex items-center gap-2">
        <i data-lucide="calendar-days" class="w-6 h-6"></i>
        Laporan Harian
    </h1>

    <!-- Form filter tanggal -->
    <form method="GET" class="mb-6 flex items-center gap-3">
        <input type="date" name="tanggal" value="<?= $tanggal ?>"
            class="px-3 py-2 rounded-lg bg-gray-800 text-gray-200 border border-gray-700">
        <button type="submit"
            class="flex items-center gap-2 bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded-lg text-white">
            <i data-lucide="search" class="w-4 h-4"></i> Tampilkan
        </button>
    </form>

    <!-- Tabel pesanan -->
    <div class="overflow-x-auto bg-gray-800 rounded-lg shadow">
        <table class="w-full text-left text-gray-300">
            <thead class="bg-gray-700 text-gray-200">
                <tr>
                    <th class="px-4 py-3">Kode</th>
                    <th class="px-4 py-3">Meja</th>
                    <th class="px-4 py-3">Total</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($pesanan) > 0): ?>
                    <?php foreach ($pesanan as $row): ?>
                        <tr class="border-b border-gray-700 hover:bg-gray-700/50">
                            <td class="px-4 py-3 font-semibold"><?= $row['kode_pesanan'] ?></td>
                            <td class="px-4 py-3"><?= $row['no_meja'] ?? '-' ?></td>
                            <td class="px-4 py-3">Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                            <td class="px-4 py-3">
                                <?php if ($row['status'] == 'dibayar'): ?>
                                    <span class="px-2 py-1 text-xs rounded-lg bg-green-600 text-white">Dibayar</span>
                                <?php elseif ($row['status'] == 'selesai'): ?>
                                    <span class="px-2 py-1 text-xs rounded-lg bg-yellow-600 text-white">Selesai</span>
                                <?php else: ?>
                                    <span class="px-2 py-1 text-xs rounded-lg bg-gray-600 text-white"><?= ucfirst($row['status']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3"><?= date('H:i', strtotime($row['tanggal_pesanan'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-400">
                            <i data-lucide="info" class="w-5 h-5 inline mr-1"></i>
                            Tidak ada pesanan pada tanggal ini.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Ringkasan total pemasukan -->
    <div class="mt-6 p-4 bg-gray-800 rounded-lg flex items-center justify-between">
        <div class="flex items-center gap-2">
            <i data-lucide="wallet" class="w-6 h-6 text-green-400"></i>
            <span class="font-semibold">Total Pemasukan:</span>
        </div>
        <span class="text-xl font-bold text-green-400">
            Rp <?= number_format($totalPemasukan, 0, ',', '.') ?>
        </span>
    </div>
</div>

<?php require_once '../../../includes/footer.php'; ?>