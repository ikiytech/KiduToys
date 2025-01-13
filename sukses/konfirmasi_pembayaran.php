<?php
// Mulai sesi untuk akses data checkout
session_start();

// Pastikan data dari form konfirmasi pembayaran tersedia
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $metodePembayaran = htmlspecialchars($_POST['metode']);

    // Ambil informasi pembeli dan keranjang dari sesi
    $nama = isset($_SESSION['checkout']['nama']) ? htmlspecialchars($_SESSION['checkout']['nama']) : 'Pembeli';
    $email = isset($_SESSION['checkout']['email']) ? htmlspecialchars($_SESSION['checkout']['email']) : '-';
    $alamat = isset($_SESSION['checkout']['alamat']) ? htmlspecialchars($_SESSION['checkout']['alamat']) : '-';
    $telepon = isset($_SESSION['checkout']['telepon']) ? htmlspecialchars($_SESSION['checkout']['telepon']) : '-';
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

    // Fungsi untuk menghitung total harga
    function hitungTotalHarga($cart) {
        $total = 0;
        foreach ($cart as $item) {
            $price = (float) $item['price']; // Pastikan harga diubah ke tipe float
            $total += $price * (int) $item['quantity']; // Kalikan dengan jumlah produk
        }
        return $total;
    }

    $totalHarga = hitungTotalHarga($cart);
} else {
    // Jika diakses tanpa POST, redirect ke halaman checkout
    header('Location: checkout.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sukses Checkout - Kidu Toys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        main {
            flex: 1;
        }

        footer {
            background-color: #ff6f61;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ff6f61;">
        <div class="container">
            <a class="navbar-brand" href="#">Kidu Toys</a>
        </div>
    </nav>

    <!-- Success Section -->
    <main class="container mt-5 text-center">
        <h2 class="mb-4 text-success">Pembayaran Berhasil!</h2>
        <p>Terima kasih, <strong><?php echo $nama; ?></strong>, sudah berbelanja di Kidu Toys.</p>
        <p>Kami akan memproses pesanan Anda sesegera mungkin.</p>

        <div class="row mt-4">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Detail Pesanan</h5>
                        <p><strong>Metode Pembayaran:</strong> <?php echo ucfirst(str_replace('_', ' ', $metodePembayaran)); ?></p>
                        <p><strong>Total Harga:</strong> Rp <?php echo number_format($totalHarga, 0, ',', '.'); ?></p>
                        <p><strong>Alamat Pengiriman:</strong><br><?php echo nl2br($alamat); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="../index.php" class="btn btn-primary">Kembali ke Beranda</a>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Kidu Toys. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
