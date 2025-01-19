<?php
$host = 'sql203.infinityfree.com';  // Host database
$user = '';            // MySQL Username
$pass = '';           // MySQL Password
$dbname = '';      // MySQL Database Name

// Buat koneksi ke database
$conn = new mysqli($host, $user, $pass, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
