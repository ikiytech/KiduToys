<?php
session_start();

// Menampilkan ucapan terima kasih setelah pembayaran berhasil
if (isset($_POST['nama']) && isset($_POST['total_harga'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $totalHarga = $_POST['total_harga'];
    $metodePembayaran = htmlspecialchars($_POST['metode']);
    $fakturUploaded = isset($_POST['faktur_pembayaran']) ? true : false;

    // Simpan informasi pembeli ke dalam session untuk digunakan di halaman ini
    $_SESSION['nama'] = $nama;
    $_SESSION['total_harga'] = $totalHarga;
    $_SESSION['metode'] = $metodePembayaran;
} else {
    header('Location: checkout.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sukses Pembayaran - Kidu Toys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ff6f61;">
        <div class="container">
            <a class="navbar-brand" href="#">Kidu Toys</a>
        </div>
    </nav>

    <!-- Halaman Terima Kasih -->
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Terima Kasih!</h2>

        <p class="text-center">Halo <?php echo $nama; ?>,</p>
        <p class="text-center">Terima kasih telah berbelanja di Kidu Toys. Pembayaran Anda telah kami terima. Barang Anda akan segera dikirimkan melalui kurir dan tiba dalam waktu 3 hari kerja.</p>

        <div class="text-center mt-4">
            <p><strong>Rincian Pembayaran:</strong></p>
            <p>Total Harga: Rp <?php echo number_format($totalHarga, 0, ',', '.'); ?></p>
            <p>Metode Pembayaran: <?php echo ucfirst($metodePembayaran); ?></p>
        </div>

        <?php if ($metodePembayaran === 'bank_transfer' && $fakturUploaded): ?>
            <div class="text-center mt-4">
                <p class="text-success">Faktur pembayaran berhasil di-upload. Kami akan segera memverifikasi pembayaran Anda.</p>
            </div>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
        </div>
    </div>

    <footer style="background-color: #ff6f61; color: white; padding: 20px 0;">
        <div class="container text-center">
            <p>&copy; 2024 Kidu Toys. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
