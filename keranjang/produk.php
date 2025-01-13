<?php
// Memulai sesi
session_start();

// Koneksi ke database
include 'db.php'; 

// Menghapus produk
if (isset($_GET['hapus'])) {
    $product_id = $_GET['hapus'];
    $query = "DELETE FROM produk WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();

    // Redirect untuk memastikan produk yang dihapus ter-refresh
    header('Location: produk.php');
    exit();
}

// Mengambil data produk dari database
$query = "SELECT * FROM produk";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link active" href="produk.php">Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Daftar Produk -->
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Daftar Produk</h2>
        <div class="text-end mb-3">
            <a href="tambah_produk.php" class="btn btn-success">Tambah Produk</a>
        </div>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan produk dengan format harga yang benar
                $no = 1;
                while ($p = $result->fetch_assoc()):
                    // Format harga untuk ditampilkan dengan simbol 'Rp' dan format ribuan dengan titik
                    $formattedPrice = "Rp" . number_format($p['price'], 0, ',', '.');
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><img src="<?php echo $p['img']; ?>" alt="<?php echo $p['name']; ?>" width="80"></td>
                    <td><?php echo $p['name']; ?></td>
                    <td><?php echo $formattedPrice; ?></td> <!-- Menampilkan harga dengan format 'Rp69.800' -->
                    <td>
                        <!-- Tombol untuk menghapus produk -->
                        <a href="produk.php?hapus=<?php echo $p['id']; ?>" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
