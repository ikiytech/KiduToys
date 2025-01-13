<?php
session_start();

// Aktifkan laporan error untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Cek jika ada pengiriman data form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validasi input dari pengguna
    $id = isset($_POST['id']) ? intval($_POST['id']) : null;
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') : null;
    $price = isset($_POST['price']) ? htmlspecialchars($_POST['price'], ENT_QUOTES, 'UTF-8') : null;
    $img = isset($_POST['img']) ? filter_var($_POST['img'], FILTER_SANITIZE_URL) : null;

    // Periksa apakah semua field diisi
    if ($id && $name && $price && $img) {
        $new_product = [
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'img' => $img,
        ];

        // Simpan produk ke dalam session untuk sementara (seharusnya ke database)
        if (!isset($_SESSION['produk'])) {
            $_SESSION['produk'] = [];
        }

        // Cek jika ID produk sudah ada
        foreach ($_SESSION['produk'] as $produk) {
            if ($produk['id'] == $id) {
                echo "<script>alert('ID produk sudah ada! Silakan gunakan ID yang berbeda.'); window.location.href='tambahkan_produk.php';</script>";
                exit();
            }
        }

        $_SESSION['produk'][] = $new_product;

        echo "<script>alert('Produk berhasil ditambahkan!'); window.location.href='tambahkan_produk.php';</script>";
    } else {
        echo "<script>alert('Semua field harus diisi dengan benar!'); window.location.href='tambahkan_produk.php';</script>";
    }
}

$produk = isset($_SESSION['produk']) ? $_SESSION['produk'] : [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambahkan Produk - Kidu Toys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Tambahkan Produk Baru</h2>
        <form method="POST" action="tambahkan_produk.php">
            <div class="mb-3">
                <label for="id" class="form-label">ID Produk</label>
                <input type="number" id="id" name="id" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama Produk</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga Produk</label>
                <input type="text" id="price" name="price" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">URL Gambar Produk</label>
                <input type="url" id="img" name="img" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambahkan Produk</button>
        </form>

        <hr>
        <h3 class="mt-4">Daftar Produk</h3>
        <?php if (empty($produk)): ?>
            <p>Belum ada produk yang ditambahkan.</p>
        <?php else: ?>
            <ul class="list-group">
                <?php foreach ($produk as $item): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></strong>
                            <span class="text-muted">- Rp <?php echo htmlspecialchars($item['price'], ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                        <img src="<?php echo htmlspecialchars($item['img'], ENT_QUOTES, 'UTF-8'); ?>" alt="Gambar Produk" style="width: 50px; height: 50px; object-fit: cover;">
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
