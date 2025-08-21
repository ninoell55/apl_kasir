<?php
// Halaman tambah users
require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

$pageTitle = 'Halaman Tambah Users';

// Cek login
if (!isset($_SESSION['login_users'])) {
    header('Location: ../../../auth/admin/login.php');
    exit;
}

// Logika tambah users
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (addUser($_POST)) {
        header("Location: index.php?success=tambah");
        exit;
    } else {
        $error = "Gagal tambah user.";
    }
}

require_once '../../../includes/header.php';
require_once '../../../includes/navbar.php';
require_once '../../../includes/sidebar.php';
?>

<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah User</h1>
    <form method="POST" class="space-y-4">
        <input type="text" name="username" placeholder="Username" class="w-full p-2 rounded bg-gray-800 text-white" required>
        <input type="password" name="password" placeholder="Password" class="w-full p-2 rounded bg-gray-800 text-white" required>
        <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" class="w-full p-2 rounded bg-gray-800 text-white" required>
        <select name="role" class="w-full p-2 rounded bg-gray-800 text-white" required>
            <option value="admin">Admin</option>
            <option value="kasir">Kasir</option>
        </select>
        <button type="submit" class="bg-green-500 px-4 py-2 rounded text-white">Simpan</button>
    </form>
</div>
        
<?php require_once '../../../includes/footer.php'; ?>