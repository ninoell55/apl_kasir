<?php
require_once "../../../libs/phpqrcode/qrlib.php";
include "../../../connection/conn.php";

$base_url = "http://localhost/apl_kasir/pages/users/menu/menu.php?id_meja=";

$query = mysqli_query($conn, "SELECT id_meja FROM meja");

while ($row = mysqli_fetch_assoc($query)) {
    $id_meja = $row['id_meja'];
    $link_meja = $base_url . $id_meja;

    // Folder penyimpanan QR code
    $folder = "img/";
    if (!file_exists($folder)) {
        mkdir($folder, 0777, true); // buat folder jika belum ada
    }

    // Nama file QR code
    $filename = "qrcode_meja_" . $id_meja . ".png";
    $file_path = $folder . $filename;

    // Generate QR code dan simpan ke file
    QRcode::png($link_meja, $file_path, QR_ECLEVEL_L, 5);

    // Path relatif untuk simpan di database (agar bisa dipanggil di web)
    $db_path = "img/" . $filename;

    // Update kolom qrcode di database
    mysqli_query($conn, "UPDATE meja SET qrcode='$db_path' WHERE id_meja=$id_meja");

    echo "QR Code untuk meja $id_meja dibuat: <img src='$db_path'><br>";
}
?>