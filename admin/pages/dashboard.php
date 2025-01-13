<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Kidu Toys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styleforadmin/admin-style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Dashboard Admin</h2>
        <p>Selamat datang, <?php echo htmlspecialchars($_SESSION['admin_name']); ?>!</p>
        <a href="manage-users.php" class="btn btn-info">Kelola Pengguna</a>
        <a href="manage-products.php" class="btn btn-info">Kelola Produk</a>
        <a href="orders.php" class="btn btn-info">Kelola Pesanan</a>
        <a href="reports.php" class="btn btn-info">Laporan</a>
        <a href="../logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>
