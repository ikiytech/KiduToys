<?php
// Mulai sesi untuk mengakses data pembayaran
session_start();

// Pastikan data konfirmasi pembayaran ada di sesi
if (isset($_SESSION['payment_confirmation'])) {
    $paymentData = $_SESSION['payment_confirmation'];

    $nama = $paymentData['nama'];
    $bank = $paymentData['bank'];
    $nominal = $paymentData['nominal'];
    $bukti = $paymentData['bukti'];

    // Menampilkan data konfirmasi pembayaran
    echo '
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Konfirmasi Pembayaran Berhasil - Kidu Toys</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .form-section { 
                background-color: #f8f9fa;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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

        <!-- Konfirmasi Pembayaran -->
        <div class="container mt-5">
            <h2 class="text-center mb-4">Konfirmasi Pembayaran Anda Berhasil!</h2>

            <div class="form-section">
                <h5>Informasi Pembayaran:</h5>
                <p><strong>Nama Pemilik Rekening:</strong> ' . $nama . '</p>
                <p><strong>Bank yang Digunakan:</strong> ' . $bank . '</p>
                <p><strong>Nominal Transfer:</strong> Rp ' . number_format($nominal, 0, ',', '.') . '</p>
                <p><strong>Bukti Pembayaran:</strong><br>
                <img src="' . $bukti . '" alt="Bukti Pembayaran" class="img-fluid" width="300">
                </p>
                <a href="home.php" class="btn btn-primary">Kembali ke Home</a>
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
    ';
} else {
    echo '<div class="container mt-5"><div class="alert alert-danger">Data pembayaran tidak ditemukan.</div></div>';
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran Berhasil - Kidu Toys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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

    <!-- Konfirmasi Pembayaran -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Konfirmasi Pembayaran Anda Berhasil!</h2>

        <div class="form-section">
            <h5>Informasi Pembayaran:</h5>
            <p><strong>Nama Pemilik Rekening:</strong> <?= $nama ?></p>
            <p><strong>Bank yang Digunakan:</strong> <?= $bank ?></p>
            <p><strong>Nominal Transfer:</strong> Rp <?= number_format($nominal, 0, ',', '.') ?></p>
            <p><strong>Bukti Pembayaran:</strong><br>
            <img src="<?= $destPath ?>" alt="Bukti Pembayaran" class="img-fluid" width="300">
            </p>
            <a href="home.php" class="btn btn-primary">Kembali ke Home</a>
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
