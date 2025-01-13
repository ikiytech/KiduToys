<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect ke login jika belum login
    header("Location: login.php");
    exit();
}
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengubah data pengguna setelah formulir dikirim
    include '../database/db.php';  // Menggunakan path relatif jika file berada dalam folder yang sama dengan htdocs


    // Pastikan koneksi berhasil
    if (!$conn) {
        echo "<script>alert('Gagal terhubung ke database.'); window.location.href = 'myakun/akun.php';</script>";
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $phone = $_POST['phone']; // Mengganti no_telepon menjadi phone
    $password = $_POST['password'];

    // Validasi input form
    if (empty($nama) || empty($email) || empty($phone)) {
        echo "<script>alert('Semua kolom harus diisi.');</script>";
        exit();
    }

    // Validasi format email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Format email tidak valid.');</script>";
        exit();
    }

    // Update password hanya jika ada perubahan
    if (!empty($password)) {
        // Pastikan password memiliki panjang minimal 8 karakter
        if (strlen($password) < 8) {
            echo "<script>alert('Password harus memiliki minimal 8 karakter.');</script>";
            exit();
        }
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET nama = ?, email = ?, phone = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $nama, $email, $phone, $hashed_password, $user_id);
    } else {
        // Jika password kosong, hanya update nama, email, dan phone
        $sql = "UPDATE users SET nama = ?, email = ?, phone = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nama, $email, $phone, $user_id);
    }

    // Eksekusi query dan tangani kesalahan
    if ($stmt->execute()) {
        $_SESSION['nama'] = $nama;  // Update nama di session
        $_SESSION['email'] = $email; // Update email di session
        $_SESSION['phone'] = $phone; // Update phone di session
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href = '../myakun/akun.php';</script>";
    } else {
        // Tangani kesalahan jika query gagal
        echo "<script>alert('Gagal memperbarui data. Error: " . $stmt->error . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Diri - Kidu Toys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f7f7f7;
            color: #333;
        }
        .container {
            margin-top: 50px;
            max-width: 500px;
        }
        .card {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #ff6f61;
            border-color: #ff6f61;
        }
        .btn-primary:hover {
            background-color: #ff8c42;
            border-color: #ff8c42;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Edit Data Diri -->
        <div class="card">
            <h2 class="text-center">Edit Data Diri</h2>
            <hr>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($_SESSION['nama'] ?? ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">No Telepon</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($_SESSION['phone'] ?? ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
            </form>
            <hr>
            <a href="akun.php" class="btn btn-secondary btn-block">Kembali ke Data Diri</a>
        </div>
    </div>
</body>
</html>
