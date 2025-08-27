<?php
require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

$pageTitle = 'Laporan';

if (!isset($_SESSION['login_users'])) {
    header('Location: ../../../auth/admin/login.php');
    exit;
}

require_once '../../../includes/header.php';
require_once '../../../includes/navbar.php';
require_once '../../../includes/sidebar.php';
?>

<div class="p-6 bg-gray-900 text-white min-h-screen">
    <h1 class="text-3xl font-bold mb-6 flex items-center gap-2">
        <i data-lucide="file-text" class="w-8 h-8"></i> Laporan
    </h1>

    <p class="text-gray-400 mb-8">
        Silakan pilih jenis laporan yang ingin Anda lihat untuk memantau transaksi dan pesanan.
    </p>

    <div class="grid md:grid-cols-3 gap-6">
        <!-- Laporan Harian -->
        <a href="harian.php"
            class="bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-xl hover:bg-gray-700 hover:scale-105 transition transform flex items-center gap-4">
            <i data-lucide="calendar-days" class="w-10 h-10 text-indigo-400"></i>
            <div>
                <h2 class="text-xl font-semibold">Laporan Harian</h2>
                <p class="text-gray-400 text-sm">Ringkasan transaksi dan pesanan per hari.</p>
            </div>
        </a>

        <!-- Laporan Bulanan -->
        <a href="bulanan.php"
            class="bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-xl hover:bg-gray-700 hover:scale-105 transition transform flex items-center gap-4">
            <i data-lucide="calendar-range" class="w-10 h-10 text-green-400"></i>
            <div>
                <h2 class="text-xl font-semibold">Laporan Bulanan</h2>
                <p class="text-gray-400 text-sm">Ringkasan transaksi dan pesanan per bulan.</p>
            </div>
        </a>

        <!-- Laporan Tahunan -->
        <a href="tahunan.php"
            class="bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-xl hover:bg-gray-700 hover:scale-105 transition transform flex items-center gap-4">
            <i data-lucide="calendar-clock" class="w-10 h-10 text-yellow-400"></i>
            <div>
                <h2 class="text-xl font-semibold">Laporan Tahunan</h2>
                <p class="text-gray-400 text-sm">Ringkasan transaksi dan pesanan per tahun.</p>
            </div>
        </a>
    </div>
</div>

<?php require_once '../../../includes/footer.php'; ?>