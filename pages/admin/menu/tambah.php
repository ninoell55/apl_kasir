<?php
// Halaman tambah menu
require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

$pageTitle = 'Halaman Tambah Menu';

// Cek login
if (!isset($_SESSION['login_users'])) {
    header('Location: ../../../auth/admin/login.php');
    exit;
}

// Logika tambah menu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $upload = uploadFile($_FILES['gambar'], '../../../assets/upload/');
        if ($upload) {
            $data['gambar'] = $upload;
        } else {
            $data['gambar'] = null;
        }
    }
    if (addMenu($data) > 0) {
        header('Location: index.php?success=tambah');
        exit;
    } else {
        $error = 'Gagal menambahkan menu. Pastikan semua data terisi dengan benar.';
        exit;
    }
}

require_once '../../../includes/header.php';
require_once '../../../includes/navbar.php';
require_once '../../../includes/sidebar.php';
?>

<div class="p-6 bg-gray-900 min-h-screen text-gray-100">
    <div class="max-w-md mx-auto mt-10 px-4">
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">
            <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-1">Tambah Menu</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Isi detail menu baru dengan lengkap.</p>

            <form method="post" enctype="multipart/form-data" class="space-y-4">
                <!-- Nama Menu -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-800 dark:text-gray-200">Nama Menu</label>
                    <input name="nama_menu" placeholder="Nama Menu"
                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300 
                              bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-800 dark:text-gray-200">Kategori</label>
                    <select name="kategori"
                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300 
                               bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                        <option value="makanan">Makanan</option>
                        <option value="minuman">Minuman</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>

                <!-- Harga -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-800 dark:text-gray-200">Harga</label>
                    <input name="harga" type="number" placeholder="Harga"
                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300 
                              bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-800 dark:text-gray-200">Deskripsi</label>
                    <textarea name="deskripsi" placeholder="Deskripsi"
                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300 
                                 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"></textarea>
                </div>

                <!-- Upload Gambar -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-800 dark:text-gray-200">Upload Gambar</label>
                    <input type="file" name="gambar" accept="image/*"
                        class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300 
                              bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                </div>

                <!-- Tombol -->
                <button type="submit"
                    class="w-full py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    Tambah
                </button>
            </form>
        </div>
    </div>
</div>

<?php require_once '../../../includes/footer.php' ?>