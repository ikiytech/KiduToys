<?php
// Mulai sesi
session_start();

// Koneksi langsung dengan database
$host = "sql203.infinityfree.com"; // Host database
$username = "if0_37983334"; // Username database
$password = "1WnBEape3lD9h"; // Password database
$dbname = "if0_37983334_db_toko_mainan"; // Nama database

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Koneksi database
$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = mysqli_real_escape_string($conn, $_POST['role']); // Ambil role dari form

    // Cek apakah email sudah ada
    $sql_check = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $error_message = "Email sudah terdaftar. Silakan gunakan email lain.";
    } else {
        // Masukkan ke database
        $sql_insert = "INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql_insert);
        mysqli_stmt_bind_param($stmt, "ssss", $nama, $email, $password, $role);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: login.php");
            exit();
        } else {
            $error_message = "Gagal mendaftar. Coba lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Kidu Toys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            transition: all 0.3s ease;
        }

        .form-container:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #333;
            font-weight: 600;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .btn-primary {
            background: linear-gradient(to right, #ff6f61, #ff9966);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(to left, #ff6f61, #ff9966);
        }

        a {
            text-decoration: none;
            font-weight: 500;
            color: #4facfe;
        }

        a:hover {
            color: #0066cc;
        }

        .input-group .btn {
            border: 1px solid #ced4da;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Registrasi</h2>
    <?php if (isset($error_message)) echo "<p class='text-danger text-center'>$error_message</p>"; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama lengkap" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan email" required>
        </div>
        <div class="mb-3 position-relative">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password" required>
                <button type="button" class="btn btn-outline-secondary" id="togglePassword" tabindex="-1">
                    <span id="toggleIcon" class="fa fa-eye"></span>
                </button>
            </div>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" name="role" id="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Daftar</button>
    </form>
    <p class="text-center mt-3">Sudah punya akun? <a href="login.php">Login di sini</a></p>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
    const togglePassword = document.querySelector("#togglePassword");
    const passwordField = document.querySelector("#password");
    const toggleIcon = document.querySelector("#toggleIcon");

    togglePassword.addEventListener("click", () => {
        const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);
        toggleIcon.classList.toggle("fa-eye");
        toggleIcon.classList.toggle("fa-eye-slash");
    });
</script>

</body>
</html>
