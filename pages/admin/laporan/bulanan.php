<?php
require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

$pageTitle = 'Laporan Bulanan';

// Cek login
if (!isset($_SESSION['login_users'])) {
    header('Location: ../../../auth/admin/login.php');
    exit;
}

// Ambil filter bulan & tahun
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

// Query rekap pesanan per tanggal
$rekap = query("
    SELECT DATE(tanggal_pesanan) as tgl, COUNT(*) as jumlah_pesanan, 
           SUM(CASE WHEN status='dibayar' THEN total ELSE 0 END) as pemasukan
    FROM pesanan
    WHERE MONTH(tanggal_pesanan) = '$bulan' AND YEAR(tanggal_pesanan) = '$tahun'
    GROUP BY DATE(tanggal_pesanan)
    ORDER BY tgl ASC
");

// Hitung total pemasukan bulan
$totalPemasukan = 0;
$totalPesanan = 0;
foreach ($rekap as $row) {
    $totalPemasukan += $row['pemasukan'];
    $totalPesanan += $row['jumlah_pesanan'];
}

require_once '../../../includes/header.php';
require_once '../../../includes/navbar.php';
require_once '../../../includes/sidebar.php';
?>

<div class="p-6 bg-gray-900 min-h-screen text-gray-200">
    <h1 class="text-2xl font-bold mb-6 flex items-center gap-2">
        <i data-lucide="calendar-range" class="w-6 h-6"></i>
        Laporan Bulanan
    </h1>

    <!-- Filter bulan & tahun -->
    <form method="GET" class="mb-6 flex items-center gap-3">
        <select name="bulan" class="px-3 py-2 rounded-lg bg-gray-800 text-gray-200 border border-gray-700">
            <?php
            $bulanArr = [
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember'
            ];
            foreach ($bulanArr as $key => $val): ?>
                <option value="<?= $key ?>" <?= $bulan == $key ? 'selected' : '' ?>><?= $val ?></option>
            <?php endforeach; ?>
        </select>

        <select name="tahun" class="px-3 py-2 rounded-lg bg-gray-800 text-gray-200 border border-gray-700">
            <?php for ($i = date('Y') - 3; $i <= date('Y'); $i++): ?>
                <option value="<?= $i ?>" <?= $tahun == $i ? 'selected' : '' ?>><?= $i ?></option>
            <?php endfor; ?>
        </select>

        <button type="submit"
            class="flex items-center gap-2 bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded-lg text-white">
            <i data-lucide="search" class="w-4 h-4"></i> Tampilkan
        </button>
    </form>

    <!-- Tabel laporan bulanan -->
    <div class="overflow-x-auto bg-gray-800 rounded-lg shadow">
        <table class="w-full text-left text-gray-300">
            <thead class="bg-gray-700 text-gray-200">
                <tr>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Jumlah Pesanan</th>
                    <th class="px-4 py-3">Total Pemasukan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($rekap) > 0): ?>
                    <?php foreach ($rekap as $row): ?>
                        <tr class="border-b border-gray-700 hover:bg-gray-700/50">
                            <td class="px-4 py-3"><?= date('d/m/Y', strtotime($row['tgl'])) ?></td>
                            <td class="px-4 py-3"><?= $row['jumlah_pesanan'] ?></td>
                            <td class="px-4 py-3">Rp <?= number_format($row['pemasukan'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="px-4 py-6 text-center text-gray-400">
                            <i data-lucide="info" class="w-5 h-5 inline mr-1"></i>
                            Tidak ada data pada bulan ini.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Ringkasan total -->
    <div class="mt-6 p-4 bg-gray-800 rounded-lg flex items-center justify-between">
        <div class="flex items-center gap-2">
            <i data-lucide="wallet" class="w-6 h-6 text-green-400"></i>
            <span class="font-semibold">Total Bulan Ini:</span>
        </div>
        <div class="text-right">
            <p class="text-gray-300">Jumlah Pesanan: <span class="font-semibold"><?= $totalPesanan ?></span></p>
            <p class="text-xl font-bold text-green-400">Rp <?= number_format($totalPemasukan, 0, ',', '.') ?></p>
        </div>
    </div>
</div>

<?php require_once '../../../includes/footer.php'; ?>