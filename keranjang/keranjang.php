<?php
// Mulai sesi untuk menyimpan keranjang
session_start();

// Data produk
$produk = [
    [
        "id" => 1,
        "name" => "Mainan Topeng Helm Dinosaurus Mask Helmet Dino",
        "price" => "Rp 250.000",
        "img" => "../assets/images/TOPENG.jpg",
    ],
    [
        "id" => 2,
        "name" => "Mainan Anak Celengan ATM Crab Piggy Bank Tabungan",
        "price" => "Rp 125.000",
        "img" => "../assets/images/Celengan ATM.jpg",
    ],
    [
        "id" => 3,
        "name" => "Mainan Pistol Soft Blaster Foam Shooter",
        "price" => "Rp 65.000",
        "img" => "../assets/images/Tomindo Mainan.jpg",
    ],
    [
        "id" => 4,
        "name" => "Mainan Truk Besar",
        "price" => "Rp 250.000",
        "img" => "../assets/images/p2.png",
    ],
    [
        "id" => 5,
        "name" => "Lego Robot",
        "price" => "Rp 150.000",
        "img" => "../assets/images/p5.png",
    ],
    [
        "id" => 6,
        "name" => "Mainan Robot Iron Man",
        "price" => "Rp 350.000",
        "img" => "../assets/images/p6.png",
    ],
    [
        "id" => 7,
        "name" => "Boneka Candy JOR",
        "price" => "Rp 100.000",
        "img" => "../assets/images/p7.png",
    ],
    [
        "id" => 8,
        "name" => "Mainan Drone",
        "price" => "Rp 175.000",
        "img" => "../assets/images/p8.png",
    ],
    [
        "id" => 9,
        "name" => "Mainan Figur Basket",
        "price" => "Rp 140.000",
        "img" => "../assets/images/p9.png",
    ],
    [
        "id" => 10,
        "name" => "Mainan Play Doth",
        "price" => "Rp 90.000",
        "img" => "../assets/images/p10.png",
    ],
    [
        "id" => 11,
        "name" => "Mainan Masak Masakan Kitchen Set Anak",
        "price" => "Rp 76.000",
        "img" => "../assets/images/Kitchen.png",
    ],
    [
        "id" => 12,
        "name" => "Multifungsi Meja Bangunan Aktivitas Anak Blok Bangunan Besar",
        "price" => "Rp 51.000",
        "img" => "../assets/images/Meja.png",
    ],
    [
        "id" => 13,
        "name" => "DIY Gelang Kalung Anak Perempuan Set Manik Manik",
        "price" => "Rp 29.000",
        "img" => "../assets/images/Gelang.png",
    ],
    [
        "id" => 14,
        "name" => "Mainan Doll House Princess Castle Besar",
        "price" => "Rp 112.000",
        "img" => "../assets/images/Doll.png",
    ],
    [
        "id" => 15,
        "name" => "Mainan Magnetic Stick DIY Building Blocks Mainan Balok Susun Anak Mainan Edukasi",
        "price" => "Rp 58.000",
        "img" => "../assets/images/Stick.png",
    ],
    [
        "id" => 16,
        "name" => "Mainan Anak Claw Machine Jumbo Kartun",
        "price" => "Rp 220.000",
        "img" => "../assets/images/Claw.png",
    ],
    [
        "id" => 17,
        "name" => "Remote Helikopter RC Sensor Tangan Helikopter",
        "price" => "Rp 450.000",
        "img" => "../assets/images/Heli.png",
    ],
    [
        "id" => 18,
        "name" => "Mainan Anak Transformasi Robot Polisi 2 in 1 Remote",
        "price" => "Rp 99.000",
        "img" => "../assets/images/Robot.png",
    ],
    [
        "id" => 19,
        "name" => "Remote Control Beko Excavator",
        "price" => "Rp 128.000",
        "img" => "../assets/images/Beko.png",
    ],
    [
        "id" => 20,
        "name" => "Mainan Dokter Dokteran Anak dengan Koper Mainan",
        "price" => "Rp 45.000",
        "img" => "../assets/images/Dokter.png",
    ],
];

if (isset($_SESSION['produk'])) {
    $produk = array_merge($produk, $_SESSION['produk']);
}

// Menambahkan produk ke keranjang
if (isset($_GET['add_to_cart'])) {
    $product_id = $_GET['add_to_cart'];
    $product = array_filter($produk, function ($p) use ($product_id) {
        return $p['id'] == $product_id;
    });

    $product = array_values($product)[0]; // Ambil produk pertama dari hasil filter

    // Menambah produk ke dalam keranjang session
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += 1; // Jika sudah ada, tambahkan jumlahnya
    } else {
        $_SESSION['cart'][$product_id] = [
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => 1,
            'img' => $product['img']
        ];
    }
}


// Menghapus produk dari keranjang
if (isset($_GET['hapus'])) {
    $product_id = $_GET['hapus'];
    unset($_SESSION['cart'][$product_id]);
    header('Location: keranjang.php');
    exit();
}

// Memperbarui jumlah produk dalam keranjang
if (isset($_POST['update'])) {
    foreach ($_POST['quantity'] as $product_id => $quantity) {
        if ($quantity <= 0) {
            unset($_SESSION['cart'][$product_id]);
        } else {
            $_SESSION['cart'][$product_id]['quantity'] = $quantity;
        }
    }
    header('Location: keranjang.php');  // Redirect untuk memastikan pembaruan
    exit();
}

// Menampilkan pesan jika keranjang kosong
$keranjangKosong = empty($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Kidu Toys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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

    <!-- Keranjang Section -->
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Keranjang Belanja</h2>

        <?php if ($keranjangKosong): ?>
            <div class="alert alert-warning text-center">Keranjang Anda kosong!</div>
        <?php else: ?>
            <form method="post" action="keranjang.php">
                <div class="row">
                    <?php
                    $totalHarga = 0;
                    foreach ($_SESSION['cart'] as $product_id => $item):
                        // Menghapus simbol "Rp" dan titik pemisah ribuan untuk konversi ke angka
                        $price = str_replace(['Rp', '.', ' '], '', $item['price']);
                        $price = (float) $price;  // Mengonversi ke tipe float
                        $totalHarga += $price * $item['quantity'];
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="<?php echo $item['img']; ?>" class="card-img-top" alt="<?php echo $item['name']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $item['name']; ?></h5>
                                <p class="card-text text-danger fw-bold">Rp <?php echo number_format($price, 0, ',', '.'); ?></p>

                                <div class="mb-2">
                                    <label for="quantity-<?php echo $product_id; ?>">Jumlah: </label>
                                    <input type="number" id="quantity-<?php echo $product_id; ?>" name="quantity[<?php echo $product_id; ?>]" value="<?php echo $item['quantity']; ?>" class="form-control" min="1">
                                </div>
                                <a href="keranjang.php?hapus=<?php echo $product_id; ?>" class="btn btn-danger">Hapus</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="row">
                    <div class="col-md-12 text-end">
                        <h4>Total Harga: Rp <?php echo number_format($totalHarga, 0, ',', '.'); ?></h4>
                        <button type="submit" name="update" class="btn btn-primary">Perbarui Keranjang</button>
                        <a href="/sukses/checkout.php" class="btn btn-success">Checkout</a>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer style="background-color: #ff6f61; color: white; padding: 20px 0;">
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
