# Kidu Toys Website

Kidu Toys adalah sebuah situs web e-commerce yang menjual mainan edukasi anak. Website ini dibuat dengan menggunakan PHP, MySQL, dan Bootstrap untuk memberikan pengalaman belanja yang mudah dan menarik bagi pengguna.

## Fitur Utama
1. **Halaman Produk Terbaru**: Menampilkan berbagai mainan terbaru yang dapat langsung dibeli atau ditambahkan ke keranjang.
2. **Login dan Registrasi**: Pengguna dapat membuat akun baru, login, dan mengelola akun mereka.
3. **Keranjang Belanja**: Fitur untuk menyimpan produk yang akan dibeli sebelum melakukan checkout.
4. **Responsif**: Desain website yang responsif menggunakan Bootstrap, sehingga nyaman diakses melalui perangkat desktop maupun mobile.
5. **Animasi Loader**: Animasi loader ditampilkan saat halaman dimuat untuk meningkatkan pengalaman pengguna.

## Teknologi yang Digunakan
- **Backend**: PHP untuk pengolahan data dinamis dan interaksi dengan database.
- **Database**: MySQL untuk menyimpan data produk, pengguna, dan transaksi.
- **Frontend**: HTML, CSS, dan Bootstrap untuk desain antarmuka yang modern.
- **JavaScript**: Digunakan untuk animasi loader dan interaksi dinamis lainnya.

## Struktur Folder
Berikut adalah struktur folder proyek beserta fungsinya:

1. **admin/**  
   Folder ini digunakan untuk halaman dashboard admin, di mana admin dapat mengelola produk, pesanan, atau pengguna.

2. **assets/**  
   Berisi file statis seperti gambar, ikon, atau file JavaScript tambahan.

3. **database/**  
   Folder ini digunakan untuk menyimpan file konfigurasi database atau file SQL (misalnya, `db_toko_mainan.sql`) untuk inisialisasi database.

4. **keranjang/**  
   Berisi file terkait dengan fitur keranjang belanja, seperti menambahkan, menghapus, atau melihat isi keranjang.

5. **loginpage/**  
   Folder ini menyimpan file yang berhubungan dengan autentikasi pengguna, seperti login, registrasi, dan logout.

6. **myakun/**  
   Folder ini berisi file untuk halaman "Akun Saya", di mana pengguna dapat mengelola informasi akun mereka.

7. **proses/**  
   Folder ini digunakan untuk menyimpan file backend atau pemrosesan data, seperti file untuk menangani pembelian, update data, atau interaksi lainnya dengan server.

8. **styleforindex/**  
   Berisi file CSS khusus untuk halaman utama (`index.php`) atau file gaya lainnya.

9. **sukses/**  
   Folder ini berisi halaman yang ditampilkan setelah pengguna berhasil melakukan suatu tindakan, seperti halaman "Pembayaran Berhasil" atau "Registrasi Berhasil".

10. **index.php**  
    File utama yang berfungsi sebagai homepage atau entry point dari website.

11. **log_produk.txt**  
    File ini digunakan untuk mencatat log aktivitas terkait produk, seperti perubahan data produk atau pembaruan stok.

## Instalasi
1. Clone repository ini:
   ```bash
   git clone https://github.com/username/kidu-toys.git
   ```
2. Import file database `db_toko_mainan.sql` ke MySQL.
3. Atur file konfigurasi database di `index.php`:
   ```php
   $host = 'host_database';
   $user = 'username_database';
   $pass = 'password_database';
   $dbname = 'nama_database';
   ```
4. Jalankan website menggunakan server lokal seperti XAMPP atau WAMP.

## Cara Menggunakan
1. Buka halaman utama website.
2. Login atau daftar untuk mengakses fitur keranjang dan pembelian.
3. Tambahkan produk ke keranjang atau beli langsung dari halaman utama.
4. Kelola akun di halaman "Akun Saya".

## Catatan
- Pastikan server lokal mendukung PHP dan MySQL.
- Gunakan folder `styleforindex/` untuk menyesuaikan tampilan sesuai kebutuhan.

## Lisensi
Proyek ini dirilis di bawah lisensi MIT. Silakan gunakan dan modifikasi sesuai kebutuhan.

---

Selamat berbelanja di Kidu Toys! 😊

