<?php
// Halaman utama menu
require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

$pageTitle = 'Halaman Utama Menu';

// Cek login
if (!isset($_SESSION['login_users'])) {
    header('Location: ../../../auth/admin/login.php');
    exit;
}

// Ambil data menu dari database
$menu = query("SELECT * FROM menu ORDER BY id_menu DESC");

require_once '../../../includes/header.php';
require_once '../../../includes/navbar.php';
require_once '../../../includes/sidebar.php';
?>

<div class="p-6 bg-gray-900 min-h-screen text-gray-100">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Manajemen Menu</h2>
        <a href="tambah.php"
            class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
            + Tambah Menu
        </a>
    </div>

    <div class="overflow-x-auto rounded-xl shadow">
        <table class="min-w-full text-sm bg-white dark:bg-gray-900">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Nama Menu</th>
                    <th class="px-4 py-3 text-left">Kategori</th>
                    <th class="px-4 py-3 text-right">Harga</th>
                    <th class="px-4 py-3 text-left">Deskripsi</th>
                    <th class="px-4 py-3 text-center">Gambar</th>
                    <th class="px-4 py-3 text-center">Tersedia</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                <?php $no = 1;
                foreach ($menu as $row): ?>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100"><?= $no++; ?></td>
                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100"><?= htmlspecialchars($row['nama_menu']); ?></td>
                        <td class="px-4 py-2 text-gray-900 dark:text-gray-100"><?= htmlspecialchars($row['kategori']); ?></td>
                        <td class="px-4 py-2 text-right text-gray-900 dark:text-gray-100">Rp<?= number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td class="px-4 py-2 text-gray-700 dark:text-gray-300"><?= htmlspecialchars($row['deskripsi']); ?></td>
                        <td class="px-4 py-2 text-center">
                            <?php if ($row['gambar']): ?>
                                <img src="../../../assets/upload/<?= htmlspecialchars($row['gambar']); ?>"
                                    class="w-16 h-12 object-cover mx-auto rounded-md shadow-sm" />
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-2 text-center font-medium <?= (int)$row['tersedia'] > 0 ? 'text-green-600' : 'text-red-500'; ?>">
                            <?= (int)$row['tersedia'] > 0 ? $row['tersedia'] : 'Habis'; ?>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <a href="edit.php?id=<?= $row['id_menu']; ?>"
                                class="px-3 py-1 text-yellow-600 hover:text-yellow-700 font-medium">Edit</a>
                            <a href="hapus.php?id=<?= $row['id_menu']; ?>"
                                class="px-3 py-1 text-red-600 hover:text-red-700 font-medium"
                                onclick="return confirm('Yakin hapus menu ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../../../includes/footer.php'; ?>