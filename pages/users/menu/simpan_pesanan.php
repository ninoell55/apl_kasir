<?php
// simpan_pesanan.php
include "../../../connection/conn.php"; // koneksi mysqli $conn

// Ambil data dari form
$id_meja = $_SESSION['id_meja'] ?? 0;
if ($id_meja <= 0) {
    die("Meja belum dipilih melalui QR Code");
}
$menu_list = $_POST['menu'] ?? [];

$menu_dipesan = array_filter($menu_list, function ($qty) {
    return (int)$qty > 0;
});

if (empty($menu_dipesan)) {
    die("Tidak ada menu yang dipilih. <a href='menu.php'>Kembali</a>");
}
if ($id_meja <= 0) {
    die("Meja belum dipilih. <a href='menu.php'>Kembali</a>");
}

try {
    // Mulai transaksi
    $conn->begin_transaction();

    // Generate kode pesanan
    $kode_pesanan = 'PSN' . time();

    // Insert ke tabel pesanan (sesuaikan kolom bila beda)
    $stmt = $conn->prepare("INSERT INTO pesanan (kode_pesanan, id_meja, metode_pesanan, status, tanggal_pesanan, total, created_at) VALUES (?, ?, 'dine-in', 'menunggu', NOW(), 0, NOW())");
    $stmt->bind_param("si", $kode_pesanan, $id_meja);
    $stmt->execute();
    $id_pesanan = $stmt->insert_id;
    $stmt->close();

    $total = 0;

    // Siapkan statement untuk ambil harga dan nama, dan untuk insert detail
    $stmt_get = $conn->prepare("SELECT harga FROM menu WHERE id_menu = ?");
    $stmt_ins = $conn->prepare("INSERT INTO detail_pesanan (id_pesanan, id_menu, qty, subtotal) VALUES (?, ?, ?, ?)");

    foreach ($menu_dipesan as $id_menu => $qty) {
        $id_menu = (int)$id_menu;
        $qty = (int)$qty;
        $stmt_get->bind_param("i", $id_menu);
        $stmt_get->execute();
        $res = $stmt_get->get_result()->fetch_assoc();
        if (!$res) continue; // jika menu tidak ada, skip
        $harga = (int)$res['harga'];
        $subtotal = $harga * $qty;
        $total += $subtotal;

        $stmt_ins->bind_param("iiii", $id_pesanan, $id_menu, $qty, $subtotal);
        $stmt_ins->execute();
    }
    $stmt_get->close();
    $stmt_ins->close();

    // Update total di pesanan
    $stmt_upd = $conn->prepare("UPDATE pesanan SET total = ? WHERE id_pesanan = ?");
    $stmt_upd->bind_param("ii", $total, $id_pesanan);
    $stmt_upd->execute();
    $stmt_upd->close();

    // Update status meja menjadi 'digunakan'
    $stmt_meja = $conn->prepare("UPDATE meja SET status = 'digunakan' WHERE id_meja = ?");
    $stmt_meja->bind_param("i", $id_meja);
    $stmt_meja->execute();
    $stmt_meja->close();

    $conn->commit();

    // Redirect atau tampilkan sukses
    header("Location: menu.php?success=1&kode=" . $kode_pesanan);
    exit;
} catch (Exception $e) {
    $conn->rollback();
    echo "Terjadi kesalahan: " . $e->getMessage();
}
