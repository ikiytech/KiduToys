<?php
// Memulai sesi
session_start();

// Memastikan keranjang kosong tidak diarahkan jika form di-submit
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $keranjangKosong = empty($_SESSION['cart']);

    if ($keranjangKosong) {
        header('Location: keranjang.php');
        exit();
    }
}

// Fungsi untuk menghitung total harga
function hitungTotalHarga($cart) {
    $total = 0;
    foreach ($cart as $item) {
        $price = (float) $item['price']; // Memastikan harga berupa angka
        $total += $price * $item['quantity'];
    }
    return $total;
}

$totalHarga = isset($_SESSION['cart']) ? hitungTotalHarga($_SESSION['cart']) : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Kidu Toys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        footer {
            margin-top: auto;
            background-color: #ff6f61;
            color: white;
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ff6f61;">
        <div class="container">
            <a class="navbar-brand" href="#">Kidu Toys</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://tokomainan.infy.uk/#produkTerbaru">Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="../keranjang/keranjang.php">Keranjang</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Checkout Section -->
    <div class="container mt-5">
    <h2 class="mb-4 text-center">Checkout</h2>

    <?php if (empty($_SESSION['cart'])): ?>
        <div class="alert alert-warning text-center">Keranjang Anda kosong, tidak bisa melanjutkan ke checkout!</div>
    <?php else: ?>
        <form method="post" action="/sukses/proses_checkout.php">
            <div class="row">
                <div class="col-md-6">
                    <h4>Informasi Pembeli</h4>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Pengiriman</label>
                        <textarea id="alamat" name="alamat" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Nomor Telepon</label>
                        <input type="text" id="telepon" name="telepon" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <h4>Rincian Pesanan</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['cart'] as $product_id => $item): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                                    <td><?php echo (int) $item['quantity']; ?></td>
                                    <td>Rp <?php echo number_format((float)$item['price'], 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <h4 class="text-end">Total Harga: Rp <?php echo number_format($totalHarga, 0, ',', '.'); ?></h4>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary">Lanjutkan Pembayaran</button>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>


    <!-- Footer -->
    <footer>
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
