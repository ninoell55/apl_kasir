<?php
// Halaman utama pembayaran
require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

$pageTitle = 'Halaman Utama Pembayaran';

// Cek login
if (!isset($_SESSION['login_users'])) {
    header('Location: ../../../auth/admin/login.php');
    exit;
}

// ambil semua pembayaran
$pembayaran = query(
    "SELECT p.id_pembayaran, ps.kode_pesanan, ps.total, p.jumlah_bayar, p.kembalian, p.tanggal_pembayaran, u.nama_lengkap 
    FROM pembayaran p 
    JOIN pesanan ps ON p.id_pesanan = ps.id_pesanan 
    LEFT JOIN users u ON p.id_kasir = u.id_user
    ORDER BY p.tanggal_pembayaran DESC"
);

require_once '../../../includes/header.php';
require_once '../../../includes/navbar.php';
require_once '../../../includes/sidebar.php';
?>

<div class="p-6 bg-gray-900 min-h-screen text-gray-100">
    <div class="max-w-7xl mx-auto p-6 rounded-xl shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Data Pembayaran</h2>
            <a href="create.php"
                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">
                Tambah Pembayaran
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse rounded-lg overflow-hidden">
                <thead class="bg-gray-800 text-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Kode Pesanan</th>
                        <th class="px-4 py-3 text-left">Total</th>
                        <th class="px-4 py-3 text-left">Bayar</th>
                        <th class="px-4 py-3 text-left">Kembalian</th>
                        <th class="px-4 py-3 text-left">Kasir</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    <?php if (count($pembayaran) > 0): $no = 1; ?>
                        <?php foreach ($pembayaran as $row): ?>
                            <tr class="hover:bg-gray-800 transition">
                                <td class="px-4 py-3"><?= $no++ ?></td>
                                <td class="px-4 py-3"><?= $row['kode_pesanan'] ?></td>
                                <td class="px-4 py-3"><?= number_format($row['total']) ?></td>
                                <td class="px-4 py-3"><?= number_format($row['jumlah_bayar']) ?></td>
                                <td class="px-4 py-3"><?= number_format($row['kembalian']) ?></td>
                                <td class="px-4 py-3"><?= $row['nama_lengkap'] ?></td>
                                <td class="px-4 py-3"><?= $row['tanggal_pembayaran'] ?></td>
                                <td class="px-4 py-3 text-center">
                                    <a href="struk.php?id=<?= $row['id_pembayaran'] ?>" target="_blank"
                                        class="text-indigo-400 hover:text-indigo-300 font-medium">
                                        Cetak Struk
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach;
                    else: ?>
                        <tr>
                            <td colspan="8" class="px-4 py-3 text-center text-gray-400">
                                Tidak ada data pembayaran
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once '../../../includes/footer.php'; ?>