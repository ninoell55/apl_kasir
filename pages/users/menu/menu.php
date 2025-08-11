<?php
include "../../../connection/conn.php";

// Pastikan id_meja dari URL valid
if (!isset($_GET['id_meja']) || !is_numeric($_GET['id_meja'])) {
    die("Nomor meja tidak valid");
}

$id_meja = (int)$_GET['id_meja'];

// Simpan ke session supaya tetap terbawa saat submit
$_SESSION['id_meja'] = $id_meja;

// Ambil data menu
$menu_q = $conn->query("SELECT * FROM menu");
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Menu - Pesan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <h3 class="mb-3">Daftar Menu (Meja <?= $id_meja ?>)</h3>

  <form id="orderForm" action="simpan_pesanan.php" method="post">
    <!-- id_meja langsung hidden -->
    <input type="hidden" name="id_meja" value="<?= $id_meja ?>">

    <div class="row">
      <?php while($m = $menu_q->fetch_assoc()): ?>
        <div class="col-md-4 mb-3">
          <div class="card h-100">
            <?php if(!empty($m['gambar'])): ?>
              <img src="uploads/<?= htmlspecialchars($m['gambar']) ?>" class="card-img-top" style="height:180px;object-fit:cover;">
            <?php endif; ?>
            <div class="card-body d-flex flex-column">
              <h5 class="card-title"><?= htmlspecialchars($m['nama_menu']) ?></h5>
              <p class="card-text small mb-1"><?= nl2br(htmlspecialchars($m['deskripsi'])) ?></p>
              <p class="fw-bold mb-2">Rp <?= number_format($m['harga'],0,',','.') ?></p>

              <div class="mt-auto">
                <div class="input-group">
                  <button type="button" class="btn btn-outline-secondary btn-sm qty-minus">-</button>
                  <input type="number"
                         class="form-control form-control-sm text-center qty-input"
                         name="menu[<?= (int)$m['id_menu'] ?>]"
                         value="0" min="0"
                         data-name="<?= htmlspecialchars($m['nama_menu'], ENT_QUOTES) ?>"
                         data-price="<?= (int)$m['harga'] ?>">
                  <button type="button" class="btn btn-outline-secondary btn-sm qty-plus">+</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>

    <div class="d-flex justify-content-end">
      <button type="button" id="openMejaModal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mejaModal">
        Pesan
      </button>
    </div>

    <!-- Modal ringkasan -->
    <div class="modal fade" id="mejaModal" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Konfirmasi Pesanan (Meja <?= $id_meja ?>)</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <h6>Ringkasan Pesanan</h6>
            <div id="orderSummary" class="border rounded p-2" style="max-height:300px;overflow:auto;">
              <em>Belum ada item terpilih.</em>
            </div>

            <div class="mt-3">
              <p class="mb-0">Total: <span id="orderTotal">Rp 0</span></p>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Konfirmasi & Simpan Pesanan</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Qty plus/minus
document.querySelectorAll('.qty-plus').forEach(btn=>{
  btn.addEventListener('click', ()=> {
    const inp = btn.parentElement.querySelector('.qty-input');
    inp.value = parseInt(inp.value || 0) + 1;
    updateSummary();
  });
});
document.querySelectorAll('.qty-minus').forEach(btn=>{
  btn.addEventListener('click', ()=> {
    const inp = btn.parentElement.querySelector('.qty-input');
    inp.value = Math.max(0, (parseInt(inp.value || 0) - 1));
    updateSummary();
  });
});
document.querySelectorAll('.qty-input').forEach(inp=>{
  inp.addEventListener('input', updateSummary);
});

const mejaModalEl = document.getElementById('mejaModal');
mejaModalEl.addEventListener('shown.bs.modal', updateSummary);

function formatRupiah(x){
  return new Intl.NumberFormat('id-ID').format(x);
}

function updateSummary(){
  const summary = document.getElementById('orderSummary');
  const totalEl = document.getElementById('orderTotal');
  const items = [];
  let total = 0;

  document.querySelectorAll('.qty-input').forEach(inp=>{
    const qty = parseInt(inp.value || 0);
    if(qty > 0){
      const name = inp.dataset.name || 'Item';
      const price = parseInt(inp.dataset.price || 0);
      const subtotal = price * qty;
      items.push({name, qty, price, subtotal});
      total += subtotal;
    }
  });

  if(items.length===0){
    summary.innerHTML = '<em>Belum ada item terpilih.</em>';
    totalEl.textContent = 'Rp 0';
    return;
  }

  let html = '<ul class="list-unstyled mb-0">';
  items.forEach(it=>{
    html += `<li class="py-1 border-bottom">
      <strong>${it.name}</strong> &times; ${it.qty}
      <div class="small text-muted">Rp ${formatRupiah(it.price)} — Sub: Rp ${formatRupiah(it.subtotal)}</div>
    </li>`;
  });
  html += '</ul>';
  summary.innerHTML = html;
  totalEl.textContent = 'Rp ' + formatRupiah(total);
}
</script>
</body>
</html>
