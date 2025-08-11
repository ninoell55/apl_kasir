<?php
// Halaman edit menu

require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

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
        header('Location: index.php');
        exit;
    } else {
        $error = 'Gagal menyimpan perubahan menu. Pastikan semua data terisi dengan benar.';
    }
}

require_once '../../../includes/header.php';
require_once '../../../includes/navbar.php';
require_once '../../../includes/sidebar.php';
?>

<form method="post" enctype="multipart/form-data" class="max-w-md mx-auto bg-white dark:bg-gray-900 p-6 rounded shadow">
    <input type="hidden" name="id_menu" value="<?= $row['id_menu']; ?>">
    <div class="mb-4">
        <label class="block mb-1 font-semibold text-gray-800 dark:text-gray-200">Nama Menu</label>
        <input name="nama_menu" value="<?= htmlspecialchars($row['nama_menu']); ?>" placeholder="Nama Menu" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
    </div>
    <div class="mb-4">
        <label class="block mb-1 font-semibold text-gray-800 dark:text-gray-200">Kategori</label>
        <select name="kategori" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
            <option value="makanan" <?= $row['kategori'] == 'makanan' ? 'selected' : ''; ?>>Makanan</option>
            <option value="minuman" <?= $row['kategori'] == 'minuman' ? 'selected' : ''; ?>>Minuman</option>
            <option value="lainnya" <?= $row['kategori'] == 'lainnya' ? 'selected' : ''; ?>>Lainnya</option>
        </select>
    </div>
    <div class="mb-4">
        <label class="block mb-1 font-semibold text-gray-800 dark:text-gray-200">Harga</label>
        <input name="harga" type="number" value="<?= $row['harga']; ?>" placeholder="Harga" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
    </div>
    <div class="mb-4">
        <label class="block mb-1 font-semibold text-gray-800 dark:text-gray-200">Deskripsi</label>
        <textarea name="deskripsi" placeholder="Deskripsi" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"><?= htmlspecialchars($row['deskripsi']); ?></textarea>
    </div>
    <div class="mb-4">
        <label class="block mb-1 font-semibold text-gray-800 dark:text-gray-200">Upload Gambar</label>
        <input type="file" name="gambar" accept="image/*" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
        <?php if (!empty($row['gambar'])): ?>
            <div class="mt-2">
                <img src="../../../assets/upload/<?= htmlspecialchars($row['gambar']); ?>" alt="Gambar Menu" class="w-24 h-16 object-cover rounded border">
                <div class="text-xs text-gray-500 dark:text-gray-400">Gambar saat ini</div>
            </div>
        <?php endif; ?>
    </div>
    <div class="mb-4">
        <label class="block mb-1 font-semibold text-gray-800 dark:text-gray-200">Stok</label>
        <input name="tersedia" type="number" value="<?= $row['tersedia']; ?>" placeholder="Stok" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
    </div>
    <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Simpan</button>
</form>

<?php require_once '../../../includes/footer.php' ?>