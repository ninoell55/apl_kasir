<?php
// Halaman utama meja
require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

$pageTitle = 'Halaman Utama Meja';

// Cek login
if (!isset($_SESSION['login_users'])) {
    header('Location: ../../../auth/admin/login.php');
    exit;
}

// Ambil data meja dari database
$meja = query("SELECT * FROM meja");

require_once '../../../includes/header.php';
require_once '../../../includes/navbar.php';
require_once '../../../includes/sidebar.php';
?>

<div class="p-6 bg-gray-900 min-h-screen text-gray-100">
    <h1 class="text-2xl font-bold mb-6">Daftar Meja</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-700 rounded-lg">
            <thead class="bg-gray-800 text-gray-200">
                <tr>
                    <th class="px-4 py-2 border border-gray-700">No</th>
                    <th class="px-4 py-2 border border-gray-700">Nomor Meja</th>
                    <th class="px-4 py-2 border border-gray-700">Status</th>
                    <th class="px-4 py-2 border border-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                <?php if (!empty($meja)) : ?>
                    <?php $i = 1;
                    foreach ($meja as $row) : ?>
                        <tr class="hover:bg-gray-800">
                            <td class="px-4 py-2 text-center"><?= $i++; ?></td>
                            <td class="px-4 py-2 text-center"><?= htmlspecialchars($row['no_meja']); ?></td>
                            <td class="px-4 py-2 text-center">
                                <?= htmlspecialchars($row['status']); ?>
                            </td>
                            <td class="px-4 py-2 text-center space-x-2">
                                <a href="edit.php?id=<?= $row['id_meja']; ?>" class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded">Edit</a>
                                <a href="hapus.php?id=<?= $row['id_meja']; ?>" onclick="return confirm('Yakin hapus meja ini?')" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-400">Belum ada data meja</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <a href="tambah.php" class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded text-white">+ Tambah Meja</a>
    </div>
</div>

<?php require_once '../../../includes/footer.php'; ?>   