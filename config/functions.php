<?php
// Start the session if it hasn't been started yet
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// base_url for the application
define('BASE_URL', 'http://localhost/apl_kasir/');

// Select Data || Menampilkan Data ->
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
// <- End Select Data

// FUNCTION MENU-start >>>
// Add
function addMenu($data)
{
    global $conn;

    // Validasi data yang diterima
    $nama_menu = $data['nama_menu'] ?? '';
    $kategori = $data['kategori'] ?? 'makanan';
    $harga = $data['harga'] ?? 0;
    $deskripsi = $data['deskripsi'] ?? '';
    $gambar = $data['gambar'] ?? null; // asumsikan upload gambar belum di-handle
    $tersedia = $data['tersedia'] ?? 1;

    $sql = "INSERT INTO menu (nama_menu, kategori, harga, deskripsi, gambar, tersedia) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false; // Gagal menyiapkan statement
    }

    $stmt->bind_param('ssissi', $nama_menu, $kategori, $harga, $deskripsi, $gambar, $tersedia);
    $result = $stmt->execute();
    $stmt->close();

    return $result; // Kembalikan hasil eksekusi
}

// Edit
function editMenu($data)
{
    global $conn;

    $id = (int) $data['id_menu'] ?? 0;
    $nama_menu = $data['nama_menu'] ?? '';
    $kategori = $data['kategori'] ?? 'makanan';
    $harga = $data['harga'] ?? 0;
    $deskripsi = $data['deskripsi'] ?? '';
    $gambar = $data['gambar'] ?? null;
    $tersedia = $data['tersedia'] ?? 1;

    // Ambil gambar lama
    $old = query("SELECT gambar FROM menu WHERE id_menu = $id LIMIT 1");
    $oldGambar = $old[0]['gambar'] ?? null;
    // Jika gambar diganti dan gambar lama ada, hapus file lama
    if ($gambar && $oldGambar && $gambar !== $oldGambar) {
        $path = realpath(__DIR__ . '/../assets/upload/' . $oldGambar);
        if ($path && file_exists($path)) {
            @unlink($path);
        }
    }

    $sql = "UPDATE menu SET nama_menu=?, kategori=?, harga=?, deskripsi=?, gambar=?, tersedia=? WHERE id_menu=?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param('ssissii', $nama_menu, $kategori, $harga, $deskripsi, $gambar, $tersedia, $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

// Delete
function deleteMenu($id)
{
    global $conn;
    $id = (int) $id;
    if ($id <= 0) {
        return false;
    }
    // Ambil gambar lama
    $old = query("SELECT gambar FROM menu WHERE id_menu = $id LIMIT 1");
    $oldGambar = $old[0]['gambar'] ?? null;
    if ($oldGambar) {
        $path = realpath(__DIR__ . '/../assets/upload/' . $oldGambar);
        if ($path && file_exists($path)) {
            @unlink($path);
        }
    }
    $sql = "DELETE FROM menu WHERE id_menu=?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param('i', $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

// Upload
function uploadFile($file, $targetDir = '../assets/upload/', $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'], $maxSize = 2 * 1024 * 1024)
{
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return false;
    }
    $fileName = basename($file['name']);
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (!in_array($fileExt, $allowedTypes)) {
        return false;
    }
    if ($file['size'] > $maxSize) {
        return false;
    }
    $newName = uniqid('menu_', true) . '.' . $fileExt;
    $targetPath = rtrim($targetDir, '/\\') . '/' . $newName;
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        return $newName;
    }
    return false;
}
// <<< FUNCTION MENU-end