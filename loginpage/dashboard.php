<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Pastikan pengguna yang login memiliki sesi yang valid
$user_role = $_SESSION['role']; // Ambil role pengguna

// Tampilkan konten sesuai dengan role
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Kidu Toys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f9;
        }
        .container {
            margin-top: 2rem;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Selamat datang, <?php echo $_SESSION['nama']; ?>!</h1>

    <?php if ($user_role === 'admin'): ?>
        <h2>Admin Dashboard</h2>
        <p>Halo Admin, Anda memiliki akses penuh ke semua fitur sistem.</p>
        <!-- Konten khusus untuk admin -->
        <a href="manage_users.php" class="btn btn-primary">Kelola Pengguna</a>
        <a href="view_orders.php" class="btn btn-primary">Lihat Pesanan</a>
    <?php else: ?>
        <h2>Dashboard Pengguna</h2>
        <p>Halo <?php echo $_SESSION['nama']; ?>, ini adalah dashboard pengguna biasa.</p>
        <!-- Konten untuk pengguna biasa -->
        <a href="view_orders.php" class="btn btn-primary">Lihat Pesanan</a>
    <?php endif; ?>

    <a href="logout.php" class="btn btn-danger mt-3">Keluar</a>
</div>

</body>
</html>
