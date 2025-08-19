<?php
// Halaman login admin
require_once '../../connection/conn.php';
require_once '../../config/functions.php';

$pageTitle = 'Halaman Login Admin';

// Pengecekan SESSION ADMIN
if (isset($_SESSION['login_users'])) {
    header('Location: ../../pages/admin/dashboard.php');
    exit;
}

require_once '../../includes/header.php';
?>

<div class="flex items-center justify-center min-h-screen bg-gray-900">
    <div class="w-full max-w-md bg-gray-800 rounded-2xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-center text-white mb-6">Login Admin</h2>

        <?php if (isset($_GET['error'])): ?>
            <div class="mb-4 p-3 text-sm text-red-400 bg-red-900/40 rounded-lg">
                <?= htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['logout']) && $_GET['logout'] === 'success'): ?>
            <div class="mb-4 p-3 text-sm text-green-400 bg-green-900/40 rounded-lg">
                Berhasil logout.
            </div>
        <?php endif; ?>

        <form action="proses.php" method="POST" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-200">Username</label>
                <input type="text" name="username" id="username" required
                    class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm 
                              bg-gray-700 border-gray-600 text-white 
                              focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-200">Password</label>
                <input type="password" name="password" id="password" required
                    class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm 
                              bg-gray-700 border-gray-600 text-white 
                              focus:ring-blue-500 focus:border-blue-500">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow">
                Login
            </button>
        </form>
    </div>
</div>

<?php require_once '../../includes/footer.php' ?>