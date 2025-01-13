Kidu Toys Website

Kidu Toys adalah sebuah situs web e-commerce yang menjual mainan edukasi anak. Website ini dibuat dengan menggunakan PHP, MySQL, dan Bootstrap untuk memberikan pengalaman belanja yang mudah dan menarik bagi pengguna.

Fitur Utama

Halaman Produk Terbaru: Menampilkan berbagai mainan terbaru yang dapat langsung dibeli atau ditambahkan ke keranjang.

Login dan Registrasi: Pengguna dapat membuat akun baru, login, dan mengelola akun mereka.

Keranjang Belanja: Fitur untuk menyimpan produk yang akan dibeli sebelum melakukan checkout.

Responsif: Desain website yang responsif menggunakan Bootstrap, sehingga nyaman diakses melalui perangkat desktop maupun mobile.

Animasi Loader: Animasi loader ditampilkan saat halaman dimuat untuk meningkatkan pengalaman pengguna.

Teknologi yang Digunakan

Backend: PHP untuk pengolahan data dinamis dan interaksi dengan database.

Database: MySQL untuk menyimpan data produk, pengguna, dan transaksi.

Frontend: HTML, CSS, dan Bootstrap untuk desain antarmuka yang modern.

JavaScript: Digunakan untuk animasi loader dan interaksi dinamis lainnya.

Struktur Folder

Berikut adalah struktur folder proyek beserta fungsinya:

admin/Folder ini digunakan untuk halaman dashboard admin, di mana admin dapat mengelola produk, pesanan, atau pengguna.

assets/Berisi file statis seperti gambar, ikon, atau file JavaScript tambahan.

database/Folder ini digunakan untuk menyimpan file konfigurasi database atau file SQL (misalnya, db_toko_mainan.sql) untuk inisialisasi database.

keranjang/Berisi file terkait dengan fitur keranjang belanja, seperti menambahkan, menghapus, atau melihat isi keranjang.

loginpage/Folder ini menyimpan file yang berhubungan dengan autentikasi pengguna, seperti login, registrasi, dan logout.

myakun/Folder ini berisi file untuk halaman "Akun Saya", di mana pengguna dapat mengelola informasi akun mereka.

proses/Folder ini digunakan untuk menyimpan file backend atau pemrosesan data, seperti file untuk menangani pembelian, update data, atau interaksi lainnya dengan server.

styleforindex/Berisi file CSS khusus untuk halaman utama (index.php) atau file gaya lainnya.

sukses/Folder ini berisi halaman yang ditampilkan setelah pengguna berhasil melakukan suatu tindakan, seperti halaman "Pembayaran Berhasil" atau "Registrasi Berhasil".

index.phpFile utama yang berfungsi sebagai homepage atau entry point dari website.

log_produk.txtFile ini digunakan untuk mencatat log aktivitas terkait produk, seperti perubahan data produk atau pembaruan stok.

Instalasi

Clone repository ini:

git clone https://github.com/username/kidu-toys.git

Import file database db_toko_mainan.sql ke MySQL.

Atur file konfigurasi database di index.php:

$host = 'host_database';
$user = 'username_database';
$pass = 'password_database';
$dbname = 'nama_database';

Jalankan website menggunakan server lokal seperti XAMPP atau WAMP.

Cara Menggunakan

Buka halaman utama website.

Login atau daftar untuk mengakses fitur keranjang dan pembelian.

Tambahkan produk ke keranjang atau beli langsung dari halaman utama.

Kelola akun di halaman "Akun Saya".

Catatan

Pastikan server lokal mendukung PHP dan MySQL.

Gunakan folder styleforindex/ untuk menyesuaikan tampilan sesuai kebutuhan.

Lisensi

Proyek ini dirilis di bawah lisensi MIT. Silakan gunakan dan modifikasi sesuai kebutuhan.

Selamat berbelanja di Kidu Toys! 😊

