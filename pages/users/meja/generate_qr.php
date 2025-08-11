<?php
require_once "../../../libs/phpqrcode/qrlib.php";

// Base URL halaman menu
$base_url = "http://localhost/apl_kasir/pages/users/menu/menu.php?id_meja=";

// Jumlah meja
$jumlah_meja = 5; // Sesuaikan jumlah meja

for($i = 1; $i <= $jumlah_meja; $i++) {
    $link_meja = $base_url . $i;
    $filename = "qrcode_meja_" . $i . ".png";
    QRcode::png($link_meja, $filename, QR_ECLEVEL_L, 5);
    echo "QR Code untuk meja $i dibuat: <img src='$filename'><br>";
}
