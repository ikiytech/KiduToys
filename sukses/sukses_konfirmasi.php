<?php
// Mulai sesi untuk memastikan pengguna sampai di halaman ini melalui proses yang benar
session_start();

// Periksa apakah data konfirmasi pembayaran tersedia di sesi
if (empty($_SESSION['konfirmasi'])) {
    header('Location: konfirmasi_pembayaran.php');
    exit();
}

// Ambil data konfirmasi dari sesi
$konfirmasi = $_SESSION['konfirmasi'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Berhasil - Kidu Toys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .success-section {
            margin-top: 50px;
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .success-icon {
            font-size: 50px;
            color: #28a745;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ff6f61;">
        <div class="container">
            <a class="navbar-brand text-white" href="#">Kidu Toys</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-white" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Produk</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Keranjang</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Masuk / Daftar</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Success Section -->
    <div class="container mt-5">
        <div class="success-section text-center">
            <div class="mb-4">
                <i class="success-icon bi bi-check-circle"></i>
            </div>
            <h2>Terima Kasih!</h2>
            <p class="mb-3">Konfirmasi pembayaran Anda telah berhasil.</p>
            <p><strong>Nama Pemilik Rekening:</strong> <?php echo htmlspecialchars($konfirmasi['nama']); ?></p>
            <p><strong>Bank:</strong> <?php echo htmlspecialchars($konfirmasi['bank']); ?></p>
            <p><strong>Nominal Transfer:</strong> Rp <?php echo number_format((float) $konfirmasi['nominal'], 0, ',', '.'); ?></p>
            <div class="mt-4">
                <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
                <a href="produk.php" class="btn btn-secondary">Lihat Produk Lain</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer style="background-color: #ff6f61; color: white; padding: 20px 0; margin-top: 40px;">
        <div class="container text-center">
            <p>&copy; 2024 Kidu Toys. All Rights Reserved.</p>
            <div class="footer-links">
                <a href="#" style="color: white; text-decoration: none;">Facebook</a> | 
                <a href="#" style="color: white; text-decoration: none;">Instagram</a> | 
                <a href="#" style="color: white; text-decoration: none;">Twitter</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
