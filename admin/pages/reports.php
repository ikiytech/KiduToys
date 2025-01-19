<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit;
}

$host = 'sql203.infinityfree.com';  // Host database
$user = '';            // MySQL Username
$pass = '';           // MySQL Password
$dbname = '';      // MySQL Database Name
// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menampilkan laporan penjualan
$sql = "SELECT order_date, customer_name, total_price, status FROM orders ORDER BY order_date DESC";
$result = $conn->query($sql);
$reports = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reports[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - Kidu Toys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styleforadmin/admin-style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Laporan Penjualan</h2>
        <h3>Daftar Pesanan</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal Pesanan</th>
                    <th>Nama Pelanggan</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reports as $report): ?>
                    <tr>
                        <td><?= htmlspecialchars($report['order_date']) ?></td>
                        <td><?= htmlspecialchars($report['customer_name']) ?></td>
                        <td><?= 'Rp ' . number_format($report['total_price'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($report['status']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Script untuk menyimpan laporan dari halaman konfirmasi pembayaran
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = isset($_SESSION['checkout']['nama']) ? $_SESSION['checkout']['nama'] : 'Pembeli';
    $alamat = isset($_SESSION['checkout']['alamat']) ? $_SESSION['checkout']['alamat'] : '-';
    $telepon = isset($_SESSION['checkout']['telepon']) ? $_SESSION['checkout']['telepon'] : '-';
    $totalHarga = isset($_POST['total_harga']) ? $_POST['total_harga'] : 0;
    $metodePembayaran = isset($_POST['metode']) ? $_POST['metode'] : 'Tidak diketahui';
    $status = 'Pending';

    $conn = new mysqli($host, $user, $pass, $dbname);
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO orders (customer_name, order_date, total_price, status) VALUES (?, NOW(), ?, ?)");
    $stmt->bind_param("sis", $nama, $totalHarga, $status);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Laporan berhasil disimpan!</div>";
    } else {
        echo "<div class='alert alert-danger'>Gagal menyimpan laporan: " . $conn->error . "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>
