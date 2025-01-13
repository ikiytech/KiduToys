<?php
// Mulai sesi untuk akses data keranjang
session_start();

// Pastikan data dari form checkout tersedia
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data pembeli dan keranjang
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $telepon = htmlspecialchars($_POST['telepon']);
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

    // Simpan data ke dalam sesi
    $_SESSION['checkout'] = [
        'nama' => $nama,
        'email' => $email,
        'alamat' => $alamat,
        'telepon' => $telepon,
    ];
    
    // Fungsi untuk menghitung total harga
    function hitungTotalHarga($cart) {
        $total = 0;
        foreach ($cart as $item) {
            $price = (float) $item['price']; // Pastikan harga sudah dalam format angka
            $total += $price * (int) $item['quantity'];
        }
        return $total;
    }

    $totalHarga = hitungTotalHarga($cart);
} else {
    // Jika diakses tanpa form POST, redirect ke halaman checkout
    header('Location: checkout.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Checkout - Kidu Toys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ff6f61;">
        <div class="container">
            <a class="navbar-brand" href="#">Kidu Toys</a>
        </div>
    </nav>

    <!-- Payment Section -->
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Proses Pembayaran</h2>
        <div class="row">
            <div class="col-md-6">
                <h4>Informasi Pembeli</h4>
                <p><strong>Nama:</strong> <?php echo $nama; ?></p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Alamat:</strong> <?php echo nl2br($alamat); ?></p>
                <p><strong>Telepon:</strong> <?php echo $telepon; ?></p>
            </div>
            <div class="col-md-6">
                <h4>Ringkasan Pesanan</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $product_id => $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td><?php echo (int) $item['quantity']; ?></td>
                                <td>Rp <?php echo number_format((float) $item['price'], 0, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <h4 class="text-end">Total Harga: Rp <?php echo number_format($totalHarga, 0, ',', '.'); ?></h4>
            </div>
        </div>

        <div class="mt-4">
            <h4 class="text-center">Pilih Metode Pembayaran</h4>
            <form method="post" action="/sukses/konfirmasi_pembayaran.php">
                <div class="mb-3">
                    <label for="metode" class="form-label">Metode Pembayaran</label>
                    <select id="metode" name="metode" class="form-select" required>
                        <option value="bank_transfer">Transfer Bank</option>
                        <option value="credit_card">Kartu Kredit</option>
                        <option value="e_wallet">E-Wallet</option>
                    </select>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-success">Konfirmasi Pembayaran</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer style="background-color: #ff6f61; color: white; padding: 20px 0;">
        <div class="container text-center">
            <p>&copy; 2024 Kidu Toys. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
