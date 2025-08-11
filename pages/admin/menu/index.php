<?php
// Halaman utama manajemen menu (CRUD)

require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

// Ambil data menu dari database
$menu = query("SELECT * FROM menu ORDER BY id_menu DESC");

require_once '../../../includes/header.php';
require_once '../../../includes/navbar.php';
require_once '../../../includes/sidebar.php';
?>

<div class="max-w-4xl mx-auto mt-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">Manajemen Menu</h2>
    <a href="tambah.php" class="inline-block px-5 py-2 mb-4 bg-green-600 text-white rounded hover:bg-green-700 transition">Tambah Menu</a>
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 dark:border-gray-700 rounded-lg overflow-hidden bg-white dark:bg-gray-900">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-800">
                    <th class="border px-4 py-2 text-gray-900 dark:text-gray-100">No</th>
                    <th class="border px-4 py-2 text-gray-900 dark:text-gray-100">Nama Menu</th>
                    <th class="border px-4 py-2 text-gray-900 dark:text-gray-100">Kategori</th>
                    <th class="border px-4 py-2 text-gray-900 dark:text-gray-100">Harga</th>
                    <th class="border px-4 py-2 text-gray-900 dark:text-gray-100">Deskripsi</th>
                    <th class="border px-4 py-2 text-gray-900 dark:text-gray-100">Gambar</th>
                    <th class="border px-4 py-2 text-gray-900 dark:text-gray-100">Tersedia</th>
                    <th class="border px-4 py-2 text-gray-900 dark:text-gray-100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($menu as $row): ?>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                        <td class="border px-4 py-2 text-center text-gray-900 dark:text-gray-100"><?= $no++; ?></td>
                        <td class="border px-4 py-2 text-gray-900 dark:text-gray-100"><?= htmlspecialchars($row['nama_menu']); ?></td>
                        <td class="border px-4 py-2 text-center text-gray-900 dark:text-gray-100"><?= htmlspecialchars($row['kategori']); ?></td>
                        <td class="border px-4 py-2 text-right text-gray-900 dark:text-gray-100">Rp<?= number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td class="border px-4 py-2 text-gray-900 dark:text-gray-100"><?= htmlspecialchars($row['deskripsi']); ?></td>
                        <td class="border px-4 py-2 text-center">
                            <?php if ($row['gambar']): ?>
                                <img src="../../../assets/upload/<?= htmlspecialchars($row['gambar']); ?>" class="w-16 h-12 object-cover mx-auto" />
                            <?php endif; ?>
                        </td>
                        <td class="border px-4 py-2 text-center text-gray-900 dark:text-gray-100"><?= (int)$row['tersedia'] > 0 ? $row['tersedia'] : 'Habis'; ?></td>
                        <td class="border px-4 py-2 text-center">
                            <a href="edit.php?id=<?= $row['id_menu']; ?>" class="inline-block px-3 py-1 text-yellow-400 rounded hover:text-yellow-500 mr-1">Edit</a>
                            <a href="hapus.php?id=<?= $row['id_menu']; ?>" class="inline-block px-3 py-1 text-red-600 rounded hover:text-red-700" onclick="return confirm('Yakin hapus menu ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../../../includes/footer.php'; ?>