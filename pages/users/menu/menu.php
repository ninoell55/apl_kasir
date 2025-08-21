<?php
include "../../../connection/conn.php";

// Pastikan id_meja dari URL valid
if (!isset($_GET['id_meja']) || !is_numeric($_GET['id_meja'])) {
  die("Nomor meja tidak valid");
}

$id_meja = (int)$_GET['id_meja'];
$_SESSION['id_meja'] = $id_meja;

// Ambil data menu
$menu_q = $conn->query("SELECT * FROM menu");
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Menu - Pesan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-b from-orange-50 to-orange-100 min-h-screen">

  <!-- Navbar -->
  <div class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
      <h1 class="text-xl font-bold text-orange-600">☕ Coffee Order</h1>
      <nav class="flex gap-3">
        <button class="category-btn px-4 py-2 rounded-full bg-orange-500 text-white text-sm" data-category="all">All</button>
        <button class="category-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 text-sm" data-category="Cappuccino">Cappuccino</button>
        <button class="category-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 text-sm" data-category="Latte">Latte</button>
        <button class="category-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 text-sm" data-category="Espresso">Espresso</button>
      </nav>
    </div>
  </div>

  <!-- Search Bar -->
  <div class="container mx-auto px-4 mt-4">
    <input
      type="text"
      id="searchMenu"
      placeholder="Cari menu..."
      class="w-full px-4 py-2 rounded-xl border border-gray-300 shadow-sm focus:ring-2 focus:ring-orange-400 focus:outline-none">
  </div>

  <!-- Content -->
  <div class="container mx-auto px-4 py-6">
    <!-- <h3 class="text-2xl font-bold mb-6">Daftar Menu (Meja <?= $id_meja ?>)</h3> -->

    <form id="orderForm" action="simpan_pesanan.php" method="post">
      <input type="hidden" name="id_meja" value="<?= $id_meja ?>">

      <!-- List Menu -->
      <div id="menuContainer" class="flex flex-wrap -m-2">
        <?php while ($m = $menu_q->fetch_assoc()): ?>
          <div
            class="menu-card w-full sm:w-1/2 md:w-1/3 p-2"
            data-category="<?= htmlspecialchars($m['kategori'] ?? 'all') ?>"
            data-name="<?= htmlspecialchars(strtolower($m['nama_menu'])) ?>">
            <div class="bg-gradient-to-b from-orange-100 to-orange-200 rounded-2xl shadow-lg hover:shadow-xl transition p-4 flex flex-col h-full">
              <?php if (!empty($m['gambar'])): ?>
                <img src="uploads/<?= htmlspecialchars($m['gambar']) ?>" class="h-40 w-full object-cover rounded-xl mb-3">
              <?php endif; ?>
              <h5 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($m['nama_menu']) ?></h5>
              <p class="text-sm text-gray-600 flex-grow"><?= nl2br(htmlspecialchars($m['deskripsi'])) ?></p>
              <p class="text-base font-bold text-gray-800 mt-2">Rp <?= number_format($m['harga'], 0, ',', '.') ?></p>

              <div class="flex justify-center items-center gap-2 mt-4">
                <button type="button" class="px-3 py-1 bg-gray-200 rounded-full qty-minus">-</button>
                <input type="number"
                  class="w-14 text-center border rounded-md qty-input"
                  name="menu[<?= (int)$m['id_menu'] ?>]"
                  value="0" min="0"
                  data-name="<?= htmlspecialchars($m['nama_menu'], ENT_QUOTES) ?>"
                  data-price="<?= (int)$m['harga'] ?>">
                <button type="button" class="px-3 py-1 bg-gray-200 rounded-full qty-plus">+</button>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>

      <!-- Tombol Pesan -->
      <div class="flex justify-end mt-6">
        <button type="button" id="openMejaModal" class="px-6 py-3 bg-orange-500 text-white font-semibold rounded-2xl shadow-md" data-modal-target="#mejaModal">
          Pesan
        </button>
      </div>

      <!-- Modal Ringkasan -->
      <div id="mejaModal" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white rounded-3xl shadow-xl w-full max-w-lg p-6">
          <div class="flex justify-between items-center mb-4">
            <h5 class="text-lg font-bold">Konfirmasi Pesanan (Meja <?= $id_meja ?>)</h5>
            <button type="button" class="text-gray-500" onclick="closeModal('#mejaModal')">&times;</button>
          </div>

          <div class="mb-4">
            <h6 class="font-semibold">Ringkasan Pesanan</h6>
            <div id="orderSummary" class="border rounded-xl p-3 max-h-60 overflow-y-auto text-sm text-gray-700">
              <em>Belum ada item terpilih.</em>
            </div>
            <p class="mt-3 font-semibold">Total: <span id="orderTotal">Rp 0</span></p>
          </div>

          <div class="flex justify-end gap-2 mt-4">
            <button type="button" class="px-4 py-2 bg-gray-300 rounded-xl" onclick="closeModal('#mejaModal')">Batal</button>
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-xl">Konfirmasi & Simpan</button>
          </div>
        </div>
      </div>
    </form>
  </div>

  <script>
    // Qty plus/minus
    document.querySelectorAll('.qty-plus').forEach(btn => {
      btn.addEventListener('click', () => {
        const inp = btn.parentElement.querySelector('.qty-input');
        inp.value = parseInt(inp.value || 0) + 1;
        updateSummary();
      });
    });
    document.querySelectorAll('.qty-minus').forEach(btn => {
      btn.addEventListener('click', () => {
        const inp = btn.parentElement.querySelector('.qty-input');
        inp.value = Math.max(0, (parseInt(inp.value || 0) - 1));
        updateSummary();
      });
    });
    document.querySelectorAll('.qty-input').forEach(inp => {
      inp.addEventListener('input', updateSummary);
    });

    // Modal Control
    document.querySelectorAll("[data-modal-target]").forEach(btn => {
      btn.addEventListener("click", () => {
        const target = btn.getAttribute("data-modal-target");
        document.querySelector(target).classList.remove("hidden");
        document.querySelector(target).classList.add("flex");
        updateSummary();
      });
    });

    function closeModal(selector) {
      const modal = document.querySelector(selector);
      modal.classList.add("hidden");
      modal.classList.remove("flex");
    }

    // Format Rupiah
    function formatRupiah(x) {
      return new Intl.NumberFormat('id-ID').format(x);
    }

    // Update Ringkasan
    function updateSummary() {
      const summary = document.getElementById('orderSummary');
      const totalEl = document.getElementById('orderTotal');
      const items = [];
      let total = 0;

      document.querySelectorAll('.qty-input').forEach(inp => {
        const qty = parseInt(inp.value || 0);
        if (qty > 0) {
          const name = inp.dataset.name || 'Item';
          const price = parseInt(inp.dataset.price || 0);
          const subtotal = price * qty;
          items.push({
            name,
            qty,
            price,
            subtotal
          });
          total += subtotal;
        }
      });

      if (items.length === 0) {
        summary.innerHTML = '<em>Belum ada item terpilih.</em>';
        totalEl.textContent = 'Rp 0';
        return;
      }

      let html = '<ul class="space-y-2">';
      items.forEach(it => {
        html += `<li class="border-b pb-2">
          <strong>${it.name}</strong> × ${it.qty}
          <div class="text-xs text-gray-500">Rp ${formatRupiah(it.price)} — Sub: Rp ${formatRupiah(it.subtotal)}</div>
        </li>`;
      });
      html += '</ul>';
      summary.innerHTML = html;
      totalEl.textContent = 'Rp ' + formatRupiah(total);
    }

    // Filter kategori
    document.querySelectorAll('.category-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const cat = btn.dataset.category;
        document.querySelectorAll('.menu-card').forEach(card => {
          if (cat === 'all' || card.dataset.category === cat) {
            card.classList.remove('hidden');
          } else {
            card.classList.add('hidden');
          }
        });
        // Update style tombol aktif
        document.querySelectorAll('.category-btn').forEach(b => {
          b.classList.remove('bg-orange-500', 'text-white');
          b.classList.add('bg-gray-200', 'text-gray-700');
        });
        btn.classList.add('bg-orange-500', 'text-white');
        btn.classList.remove('bg-gray-200', 'text-gray-700');
      });
    });

    // Search menu
    document.getElementById("searchMenu").addEventListener("input", function() {
      const q = this.value.toLowerCase();
      document.querySelectorAll(".menu-card").forEach(card => {
        const name = card.dataset.name;
        if (name.includes(q)) {
          card.classList.remove("hidden");
        } else {
          card.classList.add("hidden");
        }
      });
    });
  </script>
</body>

</html>