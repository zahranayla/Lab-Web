<?php
session_start();
include 'config.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$query = $conn->prepare("SELECT * FROM mahasiswa WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$mahasiswa = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];

    $query = $conn->prepare("UPDATE mahasiswa SET nama = ?, nim = ?, prodi = ? WHERE id = ?");
    $query->bind_param("sssi", $nama, $nim, $prodi, $id);
    $query->execute();

    header("Location: index.php");
    exit;
}
?>

<!-- HTML Form for Editing Data -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #90bdbb;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2>Edit Data Mahasiswa</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" id="nama" value="<?= htmlspecialchars($mahasiswa['nama']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control" id="nim" value="<?= htmlspecialchars($mahasiswa['nim']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="prodi" class="form-label">Program Studi</label>
            <input type="text" name="prodi" class="form-control" id="prodi" value="<?= htmlspecialchars($mahasiswa['prodi']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Data</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
