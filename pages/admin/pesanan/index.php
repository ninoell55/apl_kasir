<?php
// Halaman utama pesanan
require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

$pageTitle = 'Halaman Utama Pesanan';

// Cek login
if (!isset($_SESSION['login_users'])) {
    header('Location: ../../../auth/admin/login.php');
    exit;
}

// Ambil semua pesanan
$pesanan = query(
    "SELECT
        p.id_pesanan, p.kode_pesanan, p.tanggal_pesanan, p.status, p.total, m.no_meja
            FROM pesanan p
                LEFT JOIN meja m ON p.id_meja = m.id_meja
        ORDER BY p.tanggal_pesanan DESC"
);

require_once '../../../includes/header.php';
require_once '../../../includes/navbar.php';
require_once '../../../includes/sidebar.php';
?>

<div class="p-6 bg-gray-900 min-h-screen text-gray-100">
    <h2 class="text-2xl font-semibold mb-4">Daftar Pesanan</h2>

    <div class="overflow-x-auto bg-gray-800 shadow-md rounded-lg">
        <table class="w-full text-sm text-left border border-gray-700">
            <thead class="bg-gray-700 text-gray-200">
                <tr>
                    <th class="px-4 py-3 border border-gray-700">#</th>
                    <th class="px-4 py-3 border border-gray-700">Kode Pesanan</th>
                    <th class="px-4 py-3 border border-gray-700">No Meja</th>
                    <th class="px-4 py-3 border border-gray-700">Tanggal</th>
                    <th class="px-4 py-3 border border-gray-700">Status</th>
                    <th class="px-4 py-3 border border-gray-700">Total</th>
                    <th class="px-4 py-3 border border-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                <?php if (count($pesanan) > 0): $no = 1; ?>
                    <?php foreach ($pesanan as $row): ?>
                        <tr class="hover:bg-gray-700">
                            <td class="px-4 py-3 border border-gray-700"><?= $no++; ?></td>
                            <td class="px-4 py-3 border border-gray-700"><?= $row['kode_pesanan']; ?></td>
                            <?php if (isset($row['no_meja'])) : ?>
                                <td class="px-4 py-3 border border-gray-700"><?= $row['no_meja']; ?></td>
                            <?php else : ?>
                                <td class="px-4 py-3 border border-gray-700">-</td>
                            <?php endif; ?>
                            <td class="px-4 py-3 border border-gray-700"><?= $row['tanggal_pesanan']; ?></td>
                            <td class="px-4 py-3 border border-gray-700">
                                <span class="px-2 py-1 text-xs font-medium rounded-full 
                                    <?= $row['status'] === 'selesai' ? 'bg-green-900 text-green-300' : ($row['status'] === 'diproses' ? 'bg-yellow-900 text-yellow-300' : 'bg-gray-700 text-gray-300'); ?>">
                                    <?= ucfirst($row['status']); ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 border border-gray-700 font-semibold">Rp <?= number_format($row['total'], 0, ',', '.'); ?></td>
                            <td class="px-4 py-3 border border-gray-700 space-x-2">
                                <a href="detail.php?id=<?= $row['id_pesanan']; ?>"
                                    class="text-blue-400 hover:text-blue-300">Detail</a>
                                <a href="updateStatus.php?id=<?= $row['id_pesanan']; ?>&status=diproses"
                                    class="text-yellow-400 hover:text-yellow-300">Proses</a>
                                <a href="updateStatus.php?id=<?= $row['id_pesanan']; ?>&status=selesai"
                                    class="text-green-400 hover:text-green-300">Selesai</a>
                                <a href="../pembayaran/create.php?id=<?= $row['id_pesanan']; ?>"
                                    class="text-purple-400 hover:text-purple-300">Bayar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="px-4 py-3 text-center text-gray-400">Tidak ada data pesanan</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../../../includes/footer.php'; ?>