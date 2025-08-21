<?php
// Halaman edit menu
require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

$pageTitle = 'Halaman Edit Menu';

// Cek login
if (!isset($_SESSION['login_users'])) {
    header('Location: ../../../auth/admin/login.php');
    exit;
}

// Logika edit menu
$id = $_GET['id'] ?? 0;
if ($id) {
    $row = query("SELECT * FROM menu WHERE id_menu = $id LIMIT 1")[0] ?? null;

    if (!$row) {
        $error = 'Menu tidak ditemukan.';
        exit;
    }
} else {
    $error = 'ID menu tidak ditemukan.';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $upload = uploadFile($_FILES['gambar'], '../../../assets/upload/');
        if ($upload) {
            $data['gambar'] = $upload;
        } else {
            $data['gambar'] = $row['gambar']; // tetap gunakan gambar lama jika upload gagal
        }
    } else {
        $data['gambar'] = $row['gambar']; // tetap gunakan gambar lama jika tidak upload baru
    }
    if (editMenu($data) > 0) {
        header('Location: index.php?success=edit');
        exit;
    } else {
        $error = 'Gagal menyimpan perubahan menu. Pastikan semua data terisi dengan benar.';
        exit;
    }
}

require_once '../../../includes/header.php';
require_once '../../../includes/navbar.php';
require_once '../../../includes/sidebar.php';
?>

<div class="max-w-md mx-auto mt-10 px-4">
    <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">
        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-1">Edit Menu</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Perbarui data menu sesuai kebutuhan.</p>

        <form method="post" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="id_menu" value="<?= $row['id_menu']; ?>">

            <!-- Nama Menu -->
            <div>
                <label class="block mb-1 font-semibold text-gray-800 dark:text-gray-200">Nama Menu</label>
                <input name="nama_menu" value="<?= htmlspecialchars($row['nama_menu']); ?>" placeholder="Nama Menu"
                    class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300
                              bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
            </div>

            <!-- Kategori -->
            <div>
                <label class="block mb-1 font-semibold text-gray-800 dark:text-gray-200">Kategori</label>
                <select name="kategori"
                    class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300
                               bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                    <option value="makanan" <?= $row['kategori'] == 'makanan' ? 'selected' : ''; ?>>Makanan</option>
                    <option value="minuman" <?= $row['kategori'] == 'minuman' ? 'selected' : ''; ?>>Minuman</option>
                    <option value="lainnya" <?= $row['kategori'] == 'lainnya' ? 'selected' : ''; ?>>Lainnya</option>
                </select>
            </div>

            <!-- Harga -->
            <div>
                <label class="block mb-1 font-semibold text-gray-800 dark:text-gray-200">Harga</label>
                <input name="harga" type="number" value="<?= $row['harga']; ?>" placeholder="Harga"
                    class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300
                              bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block mb-1 font-semibold text-gray-800 dark:text-gray-200">Deskripsi</label>
                <textarea name="deskripsi" placeholder="Deskripsi"
                    class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300
                                 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"><?= htmlspecialchars($row['deskripsi']); ?></textarea>
            </div>

            <!-- Upload Gambar -->
            <div>
                <label class="block mb-1 font-semibold text-gray-800 dark:text-gray-200">Upload Gambar</label>
                <input type="file" name="gambar" accept="image/*"
                    class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300
                              bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">

                <?php if (!empty($row['gambar'])): ?>
                    <div class="mt-2">
                        <img src="../../../assets/upload/<?= htmlspecialchars($row['gambar']); ?>"
                            alt="Gambar Menu"
                            class="w-24 h-16 object-cover rounded border shadow-sm">
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Gambar saat ini</div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Tombol -->
            <div class="flex gap-3">
                <button type="submit"
                    class="flex-1 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Simpan
                </button>
                <a href="index.php"
                    class="flex-1 py-2 text-center bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<?php require_once '../../../includes/footer.php' ?>