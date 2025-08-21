<?php
// Halaman edit users
require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

$pageTitle = 'Halaman Edit Users';

if (!isset($_SESSION['login_users'])) {
    header('Location: ../../../auth/admin/login.php');
    exit;
}

// Logika edit users
$id = $_GET['id'];
$user = query("SELECT * FROM users WHERE id_user=$id")[0];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST['id_user'] = $id; // masukkan ID ke data
    if (editUser($_POST)) {
        header("Location: index.php?success=edit");
        exit;
    } else {
        $error = "Gagal update user.";
    }
}

require_once '../../../includes/header.php';
require_once '../../../includes/navbar.php';
require_once '../../../includes/sidebar.php';
?>

<div class="p-6 bg-gray-900 min-h-screen text-gray-100">
    <div class="max-w-md mx-auto mt-10 px-4">
        <h1 class="text-2xl font-bold mb-4">Edit User</h1>
        <?php if (isset($error)): ?>
            <p class="text-red-400"><?= $error; ?></p>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <input type="text" name="username" value="<?= htmlspecialchars($user['username']); ?>" placeholder="Username" class="w-full p-2 rounded bg-gray-800 text-white" required>

            <input type="password" name="password" placeholder="Password baru (kosongkan jika tidak diganti)" class="w-full p-2 rounded bg-gray-800 text-white">

            <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($user['nama_lengkap']); ?>" placeholder="Nama Lengkap" class="w-full p-2 rounded bg-gray-800 text-white" required>

            <select name="role" class="w-full p-2 rounded bg-gray-800 text-white" required>
                <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                <option value="kasir" <?= $user['role'] == 'kasir' ? 'selected' : ''; ?>>Kasir</option>
            </select>

            <button type="submit" class="bg-yellow-500 px-4 py-2 rounded text-white">Update</button>
        </form>
    </div>
</div>
<?php require_once '../../../includes/footer.php'; ?>