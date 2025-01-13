<?php
// Mulai sesi untuk menyimpan data pengguna dan keranjang
session_start();

// Koneksi ke database
$host = 'sql203.infinityfree.com';  // Host database
$user = 'if0_37983334';            // MySQL Username
$pass = '1WnBEape3lD9h';           // MySQL Password
$dbname = 'if0_37983334_db_toko_mainan';      // MySQL Database Name

// Buat koneksi ke database
$conn = new mysqli($host, $user, $pass, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menampilkan sapaan berdasarkan sesi login
if (!isset($_SESSION['user_id'])) {
    // Jika pengguna belum login, tampilkan opsi login dan daftar
    $greeting = '<a href="loginpage/login.php" class="nav-link">Login</a>';
} else {
    // Jika pengguna sudah login, tampilkan sapaan dengan data yang disanitasi
    $greeting = 'Hi, ' . htmlspecialchars($_SESSION['nama']);
}

// Data produk
$produk = [
    ["id" => 1, "name" => "Mainan Topeng Helm Dinosaurus", "price" => "Rp 250.000", "img" => "../assets/images/TOPENG.jpg"],
    ["id" => 2, "name" => "Mainan Anak Celengan ATM", "price" => "Rp 125.000", "img" => "../assets/images/Celengan ATM.jpg"],
    ["id" => 3, "name" => "Mainan Pistol Soft Blaster", "price" => "Rp 65.000", "img" => "../assets/images/Tomindo Mainan.jpg"],
    ["id" => 4, "name" => "Mainan Truk Besar", "price" => "Rp 250.000", "img" => "../assets/images/p2.png"],
    ["id" => 5, "name" => "Lego Robot", "price" => "Rp 150.000", "img" => "../assets/images/p5.png"],
    ["id" => 6, "name" => "Mainan Robot Iron Man", "price" => "Rp 350.000", "img" => "../assets/images/p6.png"],
    ["id" => 7, "name" => "Boneka Candy JOR", "price" => "Rp 100.000", "img" => "../assets/images/p7.png"],
    ["id" => 8, "name" => "Mainan Drone", "price" => "Rp 175.000", "img" => "../assets/images/p8.png"],
    ["id" => 9, "name" => "Mainan Figur Basket", "price" => "Rp 140.000", "img" => "../assets/images/p9.png"],
    ["id" => 10, "name" => "Mainan Play Doth", "price" => "Rp 90.000", "img" => "../assets/images/p10.png"],
    ["id" => 11, "name" => "Mainan Masak Masakan Kitchen Set Anak", "price" => "Rp 76.000", "img" => "../assets/images/Kitchen.png"],
    ["id" => 12, "name" => "Multifungsi Meja Bangunan Aktivitas Anak Blok Bangunan Besar ", "price" => "Rp 51.000", "img" => "../assets/images/Meja.png"],
    ["id" => 13, "name" => "DIY Gelang Kalung Anak Perempuan Set Manik Manik ", "price" => "Rp 29.000", "img" => "../assets/images/Gelang.png"],
    ["id" => 14, "name" => "Mainan Doll House Princess Castle Besar ", "price" => "Rp 112.000", "img" => "../assets/images/Doll.png"],
    ["id" => 15, "name" => "Mainan Magnetic Stick DIY Building Blocks Mainan Balok Susun Anak Mainan Edukasi", "price" => "Rp 58.000", "img" => "../assets/images/Stick.png"],
    ["id" => 16, "name" => "Mainan Anak Claw Machine Jumbo Kartun", "price" => "Rp 220.000", "img" => "../assets/images/Claw.png"],
    ["id" => 17, "name" => "Remote Helikopter RC Sensor Tangan helikopter ", "price" => "Rp 450.000", "img" => "../assets/images/Heli.png"],
    ["id" => 18, "name" => "Mainan Anak Transformasi Robot Polisi 2 in 1 Remote", "price" => "Rp 99.000", "img" => "../assets/images/Robot.png"],
    ["id" => 19, "name" => "Remote Control Beko Excavator ", "price" => "Rp 128.000", "img" => "../assets/images/Beko.png"],
    ["id" => 20, "name" => "Mainan Dokter Dokteran Anak dengan Koper Mainan", "price" => "Rp 45.000", "img" => "../assets/images/Dokter.png"]
];

// Simpan produk ke database
foreach ($produk as $item) {
    $name = $conn->real_escape_string($item['name']);
    $price = (int)str_replace(["Rp", ".", " "], "", $item['price']); // Ubah harga ke angka
    $img = $conn->real_escape_string($item['img']);

    $sql = "INSERT INTO produk (name, price, img) VALUES ('$name', $price, '$img')";

    if ($conn->query($sql) === TRUE) {
        file_put_contents("log_produk.txt", "Produk berhasil disimpan: $name\n", FILE_APPEND);
        // Pesan berhasil disimpan (hapus atau simpan di log jika tidak diperlukan di layar)
        // echo "Produk berhasil disimpan: $name<br>";
    } else {
        // Tampilkan pesan error hanya jika ada kesalahan
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Terbaru - Kidu Toys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styleforindex/style.css">
    <style>
        .loader {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 9999;
        }
        .loader .dot {
            height: 20px;
            width: 20px;
            border-radius: 50%;
            background: #16b0c1;
            animation: jump 1.8s ease-in-out infinite;
        }
        @keyframes jump {
            0% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0); }
        }
        .hidden { display: none; }
    </style>
</head>
<body>
    <div class="loader" id="loader">
        <div class="dot"></div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ff6f61;">
        <div class="container">
            <a class="navbar-brand" href="#">Kidu Toys</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><?php echo $greeting; ?></li>
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="keranjang/keranjang.php">Keranjang</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item"><a class="nav-link" href="myakun/akun.php">Akun Saya</a></li>
                        <li class="nav-item"><a class="nav-link" href="loginpage/logout.php">Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="loginpage/register.php">Daftar</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="banner" style="background: linear-gradient(to right, #ff6f61, #ff8c42); color: white; text-align: center; padding: 100px 20px;">
        <h1>Selamat Datang di Kidu Toys</h1>
        <p>Belanja mainan anak edukasi dengan harga terbaik!</p>
        <a href="#produkTerbaru" class="btn btn-banner" style="background-color: white; color: #ff6f61; font-weight: bold; padding: 10px 30px; border-radius: 20px;">Lihat Produk</a>
    </div>

    <div class="container mt-5" id="produkTerbaru">
        <h2 class="mb-4 text-center">Produk Terbaru</h2>
        <div class="row">
            <?php foreach ($produk as $item): ?>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100">
                        <img src="<?= htmlspecialchars($item['img']); ?>" class="card-img-top" alt="<?= htmlspecialchars($item['name']); ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= htmlspecialchars($item['name']); ?></h5>
                            <p class="card-text text-danger fw-bold"><?= htmlspecialchars($item['price']); ?></p>
                            <a href="?add_to_cart=<?= $item['id']; ?>" class="btn btn-primary mb-2">Beli Sekarang</a>
                            <a href="keranjang/keranjang.php?add_to_cart=<?= $item['id']; ?>" class="btn btn-cart" style="background-color: #16b0c1; color: white;">Tambahkan ke Keranjang</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

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
    <script>
        window.addEventListener("load", function () {
            document.getElementById("loader").classList.add("hidden");
        });
    </script>
</body>
</html>
