<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit;
}

$host = 'sql203.infinityfree.com';
$user = 'if0_37983334';
$pass = '1WnBEape3lD9h';
$dbname = 'if0_37983334_db_toko_mainan';

// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menambahkan produk baru
if (isset($_POST['add_product'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $price = (int)str_replace(["Rp", ".", " "], "", $_POST['price']);
    $img = $conn->real_escape_string($_POST['img']);

    // Validasi untuk mencegah duplikasi produk
    $sql_check = "SELECT * FROM produk WHERE name = '$name' AND price = $price AND img = '$img'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        echo "<div class='alert alert-warning'>Produk ini sudah ada!</div>";
    } else {
        $sql = "INSERT INTO produk (name, price, img) VALUES ('$name', $price, '$img')";
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Produk berhasil ditambahkan!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
        }
    }
}

// Menghapus produk
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $sql = "DELETE FROM produk WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Produk berhasil dihapus!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}

// Menampilkan produk
$sql = "SELECT * FROM produk";
$result = $conn->query($sql);
$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk - Kidu Toys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styleforadmin/admin-style.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Kelola Produk</h2>

        <!-- Form Tambah Produk -->
        <form method="POST" class="mb-4">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="text" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Gambar Produk (URL)</label>
                <input type="text" class="form-control" id="img" name="img" required>
            </div>
            <button type="submit" name="add_product" class="btn btn-primary">Tambah Produk</button>
        </form>

        <h3>Daftar Produk</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= 'Rp ' . number_format($product['price'], 0, ',', '.') ?></td>
                        <td><img src="<?= htmlspecialchars($product['img']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" width="100"></td>
                        <td>
                            <a href="?delete=<?= $product['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
