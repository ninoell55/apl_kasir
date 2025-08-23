<?php
// Halaman tambah pembayaran
require_once '../../../connection/conn.php';
require_once '../../../config/functions.php';

$pageTitle = 'Halaman Tambah Pembayaran';

// Cek login
if (!isset($_SESSION['login_users'])) {
    header('Location: ../../../auth/admin/login.php');
    exit;
}

// id_pesanan from url
$id = $_GET['id'] ?? null;

// ambil pesanan yang belum dibayar
$pesanan = query("SELECT * FROM pesanan WHERE status != 'dibayar'");

// proses simpan pembayaran
if (isset($_POST['simpan'])) {
    $id_pesanan = $_POST['id_pesanan'];
    $jumlah_bayar = $_POST['jumlah_bayar'];

    // ambil total dari pesanan
    $dataPesanan = query("SELECT total FROM pesanan WHERE id_pesanan='$id_pesanan'")[0];
    $total = $dataPesanan['total'];

    $kembalian = $jumlah_bayar - $total;
    $id_kasir = $_SESSION['id_user'];

    // Insert pembayaran
    $stmtInsert = $conn->prepare("INSERT INTO pembayaran (id_pesanan, jumlah_bayar, kembalian, id_kasir) VALUES (?,?,?,?)");
    $stmtInsert->bind_param("iiii", $id_pesanan, $jumlah_bayar, $kembalian, $id_kasir);
    $stmtInsert->execute();
    $stmtInsert->close();

    // update status pesanan
    $stmtUpdate = $conn->prepare("UPDATE pesanan SET status = ? WHERE id_pesanan = ?");
    $status = "dibayar";
    $stmtUpdate->bind_param("si", $status, $id_pesanan);
    $stmtUpdate->execute();
    $stmtUpdate->close();

    echo "<script>alert('Pembayaran berhasil disimpan!');window.location='index.php';</script>";
}

require_once '../../../includes/header.php';
require_once '../../../includes/navbar.php';
require_once '../../../includes/sidebar.php';
?>

<div class="p-6 bg-gray-900 min-h-screen text-gray-100">
    <div class="max-w-lg mx-auto p-6 rounded-xl shadow-lg">
        <h2 class="text-2xl font-semibold mb-6">Tambah Pembayaran</h2>

        <form method="post" class="space-y-5">
            <!-- Pilih Pesanan -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-300">Pilih Pesanan</label>
                <select name="id_pesanan" required
                    class="w-full px-4 py-2 rounded-lg bg-gray-800 border border-gray-700 text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">-- Pilih Pesanan --</option>
                    <?php foreach ($pesanan as $ps): ?>
                        <option value="<?= $ps['id_pesanan'] ?>"
                            <?= ($ps['id_pesanan'] == $id) ? 'selected' : '' ?>>
                            <?= $ps['kode_pesanan'] ?> - Total: <?= number_format($ps['total']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Jumlah Bayar -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-300">Jumlah Bayar</label>
                <input type="number" name="jumlah_bayar" required
                    class="w-full px-4 py-2 rounded-lg bg-gray-800 border border-gray-700 text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end">
                <button type="submit" name="simpan"
                    class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-lg text-white font-medium transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once '../../../includes/footer.php'; ?>