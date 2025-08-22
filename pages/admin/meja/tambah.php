<?php
// Halaman tambah meja
require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

$pageTitle = 'Halaman Tambah Meja';

// Cek login
if (!isset($_SESSION['login_users'])) {
    header('Location: ../../../auth/admin/login.php');
    exit;
}

// Logika tambah meja
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST;
    if (addMeja($data) > 0) {
        header("Location: index.php?success=tambah");
        exit;
    } else {
        $error = 'Gagal menambahkan meja.';
        exit;
    }
}

require_once '../../../includes/header.php';
require_once '../../../includes/navbar.php';
require_once '../../../includes/sidebar.php';
?>

<div class="flex items-center justify-center min-h-screen bg-gray-900 text-gray-100">
    <div class="w-full max-w-md bg-gray-800 rounded-lg shadow-lg p-6">
        <h1 class="text-xl font-bold mb-4 text-center">Tambah Meja</h1>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block mb-1 text-sm font-medium">Nomor Meja</label>
                <input type="text" name="noMeja" required
                    class="w-full px-3 py-2 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition">
                + Tambah Meja
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="index.php" class="text-sm text-gray-400 hover:text-gray-200">← Kembali ke Daftar Meja</a>
        </div>
    </div>
</div>

<?php require_once '../../../includes/footer.php'; ?>