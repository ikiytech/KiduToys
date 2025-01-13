<?php
$host = 'sql203.infinityfree.com';  // Host database
$user = 'if0_37983334';            // MySQL Username
$pass = '1WnBEape3lD9h';           // MySQL Password
$dbname = 'if0_37983334_db_toko_mainan';      // MySQL Database Name

// Buat koneksi ke database
$conn = new mysqli($host, $user, $pass, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
