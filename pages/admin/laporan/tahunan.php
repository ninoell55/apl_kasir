<?php
require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

$pageTitle = 'Laporan Tahunan';

if (!isset($_SESSION['login_users'])) {
    header('Location: ../../../auth/admin/login.php');
    exit;
}

// Ambil daftar tahun unik dari pesanan
$tahunList = query("SELECT DISTINCT YEAR(tanggal_pesanan) as tahun FROM pesanan ORDER BY tahun DESC");

require_once '../../../includes/header.php';
require_once '../../../includes/navbar.php';
require_once '../../../includes/sidebar.php';
?>

<div class="p-6 bg-gray-900 text-white min-h-screen">
    <h1 class="text-3xl font-bold mb-6 flex items-center gap-2">
        <i data-lucide="calendar-clock" class="w-8 h-8 text-yellow-400"></i> Laporan Tahunan
    </h1>

    <form method="GET" class="mb-6 flex items-center gap-4">
        <label for="tahun" class="text-lg">Pilih Tahun:</label>
        <select name="tahun" id="tahun" class="px-4 py-2 rounded-lg bg-gray-800 border border-gray-700 text-white">
            <?php foreach ($tahunList as $t): ?>
                <option value="<?= $t['tahun'] ?>" <?= (isset($_GET['tahun']) && $_GET['tahun'] == $t['tahun']) ? 'selected' : '' ?>>
                    <?= $t['tahun'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit"
            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg flex items-center gap-2">
            <i data-lucide="search" class="w-5 h-5"></i> Tampilkan
        </button>
    </form>

    <?php if (isset($_GET['tahun'])): ?>
        <?php
        $tahun = $_GET['tahun'];
        $laporanTahunan = query("
                SELECT MONTH(tanggal_pesanan) as bulan, COUNT(*) as total_pesanan, SUM(total) as total_pendapatan
                FROM pesanan 
                WHERE YEAR(tanggal_pesanan) = $tahun
                GROUP BY MONTH(tanggal_pesanan)
                ORDER BY bulan
            ");
        ?>

        <div class="bg-gray-800 p-4 rounded-2xl shadow-lg overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="px-4 py-2">Bulan</th>
                        <th class="px-4 py-2">Total Pesanan</th>
                        <th class="px-4 py-2">Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($laporanTahunan as $row): ?>
                        <tr class="border-b border-gray-700 hover:bg-gray-700">
                            <td class="px-4 py-2"><?= date("F", mktime(0, 0, 0, $row['bulan'], 1)) ?></td>
                            <td class="px-4 py-2"><?= $row['total_pesanan'] ?></td>
                            <td class="px-4 py-2">Rp <?= number_format($row['total_pendapatan'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require_once '../../../includes/footer.php'; ?>