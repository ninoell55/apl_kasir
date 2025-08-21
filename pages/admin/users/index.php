<?php
// Halaman utama manajemen users
require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

$pageTitle = 'Halaman Utama Manajemen Users';   

// Cek login
if (!isset($_SESSION['login_users'])) {
    header('Location: ../../../auth/admin/login.php');
    exit;
}

// Ambil data user dari database
$users = query("SELECT * FROM users");

require_once '../../../includes/header.php';
require_once '../../../includes/navbar.php';
require_once '../../../includes/sidebar.php';
?>

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Users</h1>
    <a href="tambah.php" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah User</a>

    <table class="w-full mt-4 border border-gray-700 text-left">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="p-2">#</th>
                <th class="p-2">Username</th>
                <th class="p-2">Nama Lengkap</th>
                <th class="p-2">Role</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-gray-900 text-gray-200">
            <?php $no = 1;
            foreach ($users as $u): ?>
                <tr class="border-t border-gray-700">
                    <td class="p-2"><?= $no++; ?></td>
                    <td class="p-2"><?= htmlspecialchars($u['username']); ?></td>
                    <td class="p-2"><?= htmlspecialchars($u['nama_lengkap']); ?></td>
                    <td class="p-2"><?= htmlspecialchars($u['role']); ?></td>
                    <td class="p-2">
                        <a href="edit.php?id=<?= $u['id_user']; ?>" class="text-yellow-400">Edit</a> |
                        <a href="hapus.php?id=<?= $u['id_user']; ?>" class="text-red-400" onclick="return confirm('Hapus user ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../../../includes/footer.php'; ?>