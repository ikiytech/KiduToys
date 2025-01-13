<?php
// Mulai sesi untuk menyimpan data pengguna dan keranjang
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    // Jika belum login, arahkan ke halaman login
    header('Location: login.php');
    exit;
}

// Jika admin sudah login, tampilkan dashboard
header('Location: pages/dashboard.php');
exit;
?>
