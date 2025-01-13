<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit;
}

$host = 'sql203.infinityfree.com';
$user = 'if0_37983334';
$pass = '1WnBEape3lD9h';
$dbname = 'if0_37983334_db_toko_mainan';

// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengubah status pesanan
if (isset($_POST['update_status'])) {
    $order_id = (int)$_POST['order_id'];
    $new_status = $conn->real_escape_string($_POST['status']);
    $sql = "UPDATE orders SET status = '$new_status' WHERE id = $order_id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Status pesanan berhasil diperbarui!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}

// Menampilkan daftar pesanan
$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$result = $conn->query($sql);
$orders = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - Kidu Toys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styleforadmin/admin-style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Kelola Pesanan</h2>
        <h3>Daftar Pesanan</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal Pesanan</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['id']) ?></td>
                        <td><?= htmlspecialchars($order['customer_name']) ?></td>
                        <td><?= htmlspecialchars($order['order_date']) ?></td>
                        <td><?= 'Rp ' . number_format($order['total_price'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($order['status']) ?></td>
                        <td>
                            <form method="POST" class="d-inline">
                                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                <select name="status" class="form-select form-select-sm mb-2">
                                    <option value="Pending" <?= $order['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="Diproses" <?= $order['status'] === 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                                    <option value="Selesai" <?= $order['status'] === 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                                </select>
                                <button type="submit" name="update_status" class="btn btn-primary btn-sm">Perbarui</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
