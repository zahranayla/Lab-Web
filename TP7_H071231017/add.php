<?php 
session_start();
include 'config.php';

// Cek apakah user memiliki role admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$error = ""; // Variabel untuk menyimpan pesan error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    // Cek apakah NIM sudah ada di database
    $checkQuery = $conn->prepare("SELECT * FROM mahasiswa WHERE nim = ?");
    $checkQuery->bind_param("s", $nim);
    $checkQuery->execute();
    $result = $checkQuery->get_result();

    if ($result->num_rows > 0) {
        // Jika NIM sudah ada, tampilkan pesan error
        $error = "Data mahasiswa dengan NIM ini sudah ada. Silakan gunakan NIM lain.";
    } else {
        // Jika NIM belum ada, lakukan proses insert
        $query = $conn->prepare("INSERT INTO mahasiswa (nama, nim, prodi) VALUES (?, ?, ?)");
        if (!$query) {
            die("Insert Query Error: " . $conn->error);
        }

        $query->bind_param("sss", $nama, $nim, $prodi);

        if ($query->execute()) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Gagal menambahkan data mahasiswa. Error: " . $query->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body{
            background-color: #90bdbb;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Tambah Data Mahasiswa</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" id="nama" required>
        </div>
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control" id="nim" required>
        </div>
        <div class="mb-3">
            <label for="prodi" class="form-label">Program Studi</label>
            <input type="text" name="prodi" class="form-control" id="prodi" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
    <?php if (!empty($error)) echo "<p class='text-danger'>$error</p>"; ?>
</div>
</body>
</html>