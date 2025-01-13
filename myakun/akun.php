<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect ke login jika belum login
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Diri - Kidu Toys</title>
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
        <!-- Data Diri -->
        <div class="card">
            <h2 class="text-center">Data Diri Anda</h2>
            <hr>
            <p><strong>Nama:</strong> <?php echo htmlspecialchars($_SESSION['nama']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
            <p><strong>No Telepon:</strong> <?php echo htmlspecialchars($_SESSION['no_telepon']); ?></p>
            <a href="edit_akun.php" class="btn btn-primary btn-block">Edit Data Diri</a>
            <hr>
            <a href="../index.php" class="btn btn-secondary btn-block">Kembali ke Halaman Utama</a>
        </div>
    </div>
</body>
</html>
