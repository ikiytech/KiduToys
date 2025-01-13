<?php
// Mulai sesi untuk mengakses data pengguna
session_start();

// Periksa apakah form dikirimkan melalui metode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: konfirmasi_pembayaran.php');
    exit();
}

// Periksa apakah semua data yang diperlukan tersedia
if (empty($_POST['nama']) || empty($_POST['bank']) || empty($_POST['nominal']) || empty($_FILES['bukti']['name'])) {
    echo "<script>alert('Semua data harus diisi!'); window.location = 'konfirmasi_pembayaran.php';</script>";
    exit();
}

// Ambil data dari form
$nama = htmlspecialchars(trim($_POST['nama']));
$bank = htmlspecialchars(trim($_POST['bank']));
$nominal = htmlspecialchars(trim($_POST['nominal']));
$bukti = $_FILES['bukti'];

// Direktori penyimpanan bukti pembayaran
$uploadDir = 'uploads/bukti_pembayaran/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Proses unggah file
$targetFile = $uploadDir . basename($bukti['name']);
$uploadOk = true;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Validasi tipe file
if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
    echo "<script>alert('Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan!'); window.location = 'konfirmasi_pembayaran.php';</script>";
    $uploadOk = false;
}

// Pindahkan file jika validasi lolos
if ($uploadOk && move_uploaded_file($bukti['tmp_name'], $targetFile)) {
    // Simpan data ke dalam sesi atau database (simulasi)
    $_SESSION['konfirmasi'] = [
        'nama' => $nama,
        'bank' => $bank,
        'nominal' => $nominal,
        'bukti' => $targetFile,
    ];

    // Redirect ke halaman sukses
    echo "<script>alert('Konfirmasi pembayaran berhasil!'); window.location = 'sukses_konfirmasi.php';</script>";
    exit();
} else {
    echo "<script>alert('Gagal mengunggah bukti pembayaran. Coba lagi!'); window.location = 'konfirmasi_pembayaran.php';</script>";
    exit();
}
?>
