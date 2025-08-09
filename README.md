# Aplikasi Kasir Sederhana

Aplikasi Kasir Sederhana ini dibuat untuk membantu proses transaksi penjualan pada toko atau usaha kecil. Aplikasi ini berbasis web dan dapat dijalankan secara lokal menggunakan XAMPP.

## Fitur Utama

- Manajemen data barang
- Manajemen data pengguna (admin & kasir)
- Proses transaksi penjualan
- Riwayat transaksi
- Laporan penjualan
- Otentikasi login

## Instalasi

1. Pastikan sudah menginstall XAMPP (Apache & MySQL).
2. Clone atau salin folder `apl_kasir` ke direktori `htdocs` XAMPP.
3. Import database:
   - Buka phpMyAdmin
   - Buat database baru, misal: `apl_kasir`
   - Import file `database/apl_kasir.sql`
4. Atur konfigurasi koneksi database di `connection/conn.php` jika diperlukan.
5. Jalankan aplikasi melalui browser: `http://localhost/apl_kasir`

## Struktur Folder

- `assets/` : Berisi file CSS, JS, dan gambar
- `auth/` : Halaman login dan autentikasi
- `config/` : Konfigurasi aplikasi
- `connection/` : Koneksi database
- `database/` : File SQL database
- `includes/` : Komponen layout (header, footer, navbar, sidebar)
- `pages/` : Halaman utama aplikasi (admin, users, dll)

## Penggunaan

1. Login menggunakan akun yang sudah terdaftar (admin/kasir).
2. Kelola data barang dan pengguna sesuai kebutuhan.
3. Lakukan transaksi penjualan melalui menu kasir.
4. Lihat riwayat dan laporan penjualan pada menu yang tersedia.

## Lisensi

Aplikasi ini dibuat untuk tujuan pembelajaran dan dapat dikembangkan sesuai kebutuhan.
