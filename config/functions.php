<?php
// Start the session if it hasn't been started yet
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// base_url for the application
define('BASE_URL', '/apl_kasir/');

// Function -- LOGIN >>
function login_users($conn, $username, $password)
{
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Cek password dengan hash
        if (password_verify($password, $row['password'])) {
            // Simpan session
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
            // LOGIN SESSION
            $_SESSION['login_users'] = true;
            $_SESSION['login_success'] = true;

            $stmt->close();
            return ['success' => true];
        } else {
            $stmt->close();
            return ['success' => false, 'message' => 'Password salah. Silakan coba lagi.'];
        }
    } else {
        $stmt->close();
        return ['success' => false, 'message' => 'Username tidak ditemukan.'];
    }
}
// Function -- LOGIN--end >>


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


// CRUD ============ CRUD - START
// --
// FUNCTION USERS-start >>>
// Add
function addUser($data)
{
    global $conn;

    $username = htmlspecialchars($data['username']);
    $password = password_hash($data['password'], PASSWORD_DEFAULT); // bisa juga plain jika tidak ingin hash
    $role = htmlspecialchars($data['role']);
    $nama = htmlspecialchars($data['nama_lengkap']);

    $sql = "INSERT INTO users (username, password, role, nama_lengkap) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $password, $role, $nama);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}

// Edit
function editUser($data)
{
    global $conn;

    $id = (int)$data['id_user'];
    $username = htmlspecialchars($data['username']);
    $role = htmlspecialchars($data['role']);
    $nama = htmlspecialchars($data['nama_lengkap']);

    // cek apakah password diisi baru
    if (!empty($data['password'])) {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username=?, password=?, role=?, nama_lengkap=? WHERE id_user=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $username, $password, $role, $nama, $id);
    } else {
        $sql = "UPDATE users SET username=?, role=?, nama_lengkap=? WHERE id_user=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $role, $nama, $id);
    }

    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

// Delete
function deleteUser($id)
{
    global $conn;

    $sql = "DELETE FROM users WHERE id_user=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}
// <<< FUNCTION USERS-end


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


// FUNCTION MEJA-start >>>
// Add
function addMeja($data)
{
    global $conn;

    require_once __DIR__ . '/../libs/phpqrcode/qrlib.php';

    $noMeja = $data['noMeja'];

    // URL untuk QR
    $url = "http://localhost/apl_kasir/pages/users/menu/menu.php?id_meja=" . urlencode($noMeja);

    // Folder simpan QR
    $dir = __DIR__ . "/../assets/img/qrcode/";
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }

    $filename = "qrcode_meja_" . $noMeja . ".png";
    $filepath = $dir . $filename;

    // Generate QR
    QRcode::png($url, $filepath, QR_ECLEVEL_L, 10);

    // Path untuk DB
    $savePath = "assets/img/qrcode/" . $filename;

    // Insert ke DB
    $sql = "INSERT INTO meja (no_meja, qrcode) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $noMeja, $savePath);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}

// Edit 
function editMeja($data)
{
    global $conn;
    require_once __DIR__ . '/../libs/phpqrcode/qrlib.php';

    $id = $data['id_meja'];
    $noMeja = $data['noMeja'];

    // Ambil data lama
    $row = query("SELECT * FROM meja WHERE id_meja = $id LIMIT 1")[0] ?? null;
    if (!$row) return 0;

    // Hapus file QR lama (optional, kalau mau dibersihkan)
    if (!empty($row['qrcode']) && file_exists(__DIR__ . '/../' . $row['qrcode'])) {
        unlink(__DIR__ . '/../' . $row['qrcode']);
    }

    // URL baru
    $url = "http://localhost/apl_kasir/pages/users/menu/menu.php?id_meja=" . urlencode($noMeja);

    // Folder simpan QR
    $dir = __DIR__ . "/../assets/img/qrcode/";
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }

    // Nama file sesuai noMeja baru
    $filename = "qrcode_meja_" . $noMeja . ".png";
    $filepath = $dir . $filename;

    // Generate QR baru
    QRcode::png($url, $filepath, QR_ECLEVEL_L, 10);

    // Path untuk DB
    $savePath = "assets/img/qrcode/" . $filename;

    // Update DB
    $sql = "UPDATE meja SET no_meja=?, qrcode=? WHERE id_meja=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $noMeja, $savePath, $id);
    $result = $stmt->execute();
    $stmt->close();

    return $result ? 1 : 0;
}

// Delete
function deleteMeja($id)
{
    global $conn;

    // Ambil data meja dulu (untuk hapus file QR kalau ada)
    $row = query("SELECT * FROM meja WHERE id_meja = $id LIMIT 1")[0] ?? null;
    if (!$row) {
        return 0; // ga ada datanya
    }

    // Kalau ada file QR di DB, hapus juga
    if (!empty($row['qrcode']) && file_exists(__DIR__ . '/../' . $row['qrcode'])) {
        unlink(__DIR__ . '/../' . $row['qrcode']);
    }

    // Hapus dari DB
    $sql = "DELETE FROM meja WHERE id_meja = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();
    $stmt->close();

    return $result ? 1 : 0;
}
// <<< FUNCTION MEJA-end
// --
// CRUD ============ CRUD - END