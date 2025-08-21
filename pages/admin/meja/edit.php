<?php
// Halaman edit meja
require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

$pageTitle = 'Halaman Edit Meja';

// Cek login
if (!isset($_SESSION['login_users'])) {
    header('Location: ../../../auth/admin/login.php');
    exit;
}

// Logika edit meja
$id = $_GET['id'] ?? 0;
if ($id) {
    $row = query("SELECT * FROM meja WHERE id_meja = $id LIMIT 1")[0] ?? null;

    if (!$row) {
        $error = 'Meja tidak ditemukan.';
        exit;
    }
} else {
    $error = 'ID meja tidak ditemukan.';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $data['id_meja'] = $id;

    if (editMeja($data) > 0) {
        header('Location: index.php?success=edit');
        exit;
    } else {
        $error = 'Gagal menyimpan perubahan meja.';
        exit;   
    }
}

require_once '../../../includes/header.php';
require_once '../../../includes/navbar.php';
require_once '../../../includes/sidebar.php';
?>

<div class="p-6">
    <h2 class="text-2xl font-semibold text-white mb-4">Edit Meja</h2>

    <?php if (!empty($error)): ?>
        <div class="bg-red-600 text-white px-4 py-2 rounded mb-4">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="bg-gray-800 p-6 rounded-lg shadow-md w-full max-w-md">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-300 mb-2">Nomor Meja:</label>
            <input type="text" name="noMeja" value="<?= htmlspecialchars($row['no_meja']); ?>"
                class="w-full px-3 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring focus:ring-blue-500" required>
        </div>

        <div class="flex justify-end gap-2">
            <a href="index.php" class="px-4 py-2 bg-gray-600 hover:bg-gray-500 rounded text-white">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 rounded text-white">Simpan</button>
        </div>
    </form>
</div>

<?php require_once '../../../includes/footer.php'; ?>