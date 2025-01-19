<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    // Jika sudah login, langsung menuju dashboard
    header('Location: pages/dashboard.php');
    exit;
}

$host = 'sql203.infinityfree.com';  // Host database
$user = '';            // MySQL Username
$pass = '';           // MySQL Password
$dbname = '';      // MySQL Database Name
// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menambahkan akun admin jika belum ada di database
$sql_check = "SELECT * FROM admin WHERE username = 'admin'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows == 0) {
    // Jika akun admin belum ada, tambahkan data admin
    $sql_insert = "INSERT INTO admin (username, password, name) VALUES ('admin', 'admin123', 'Admin Kidu Toys')";
    if ($conn->query($sql_insert) === TRUE) {
        // Jika berhasil menambah admin, beri pesan
        $admin_added = 'Akun admin default telah ditambahkan.';
    } else {
        $admin_added = 'Gagal menambahkan akun admin: ' . $conn->error;
    }
}

// Menangani proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['admin_name'] = $row['name'];
        header('Location: pages/dashboard.php');
        exit;
    } else {
        $error = 'Username atau password salah!';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Kidu Toys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styleforadmin/admin-style.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Login Admin</h2>
        <?php if (isset($admin_added)): ?>
            <div class="alert alert-info"><?= htmlspecialchars($admin_added) ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <!-- Form Login -->
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</body>
</html>
