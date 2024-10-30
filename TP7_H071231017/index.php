<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$role = $_SESSION['role'];
$search = $_GET['search'] ?? '';
$page = $_GET['page'] ?? 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$search%' OR nim LIKE '%$search%' LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

$totalQuery = "SELECT COUNT(*) as total FROM mahasiswa WHERE nama LIKE '%$search%' OR nim LIKE '%$search%'";
$totalResult = $conn->query($totalQuery);
$totalData = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalData / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color : #90bdbb
        }

        .search-button {
            position: relative;
            margin-left: 10px; 
            margin-top : 0px;
            height : 40px;
        }
        h2 {
            padding-left: 450px;
        }
    </style>

</head>
<body>
<div class="container mt-5">
    <h2>Data Mahasiswa</h2>
    <form method="GET" action="" class="d-flex mb-3">
        <input type="text" name="search" placeholder="Cari Nama atau NIM" class="form-control mb-3">
        <button type="submit" class="btn btn-primary search-button">Cari</button>
    </form>

    <?php if ($role == 'admin') : ?>
        <a href="add.php" class="btn btn-primary">Tambah Mahasiswa</a>
    <?php endif; ?>

    <a href="logout.php" class="btn btn-secondary">Logout</a>

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Prodi</th>
                <?php if ($role == 'admin') : ?>
                    <th>Aksi</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['nim'] ?></td>
                    <td><?= $row['prodi'] ?></td>
                    <?php if ($role == 'admin') : ?>
                        <td>
                            <a href='edit.php?id=<?= $row['id'] ?>' class='btn btn-warning'>Edit</a>
                            <a href='delete.php?id=<?= $row['id'] ?>' class='btn btn-danger'>Delete</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="index.php?page=<?= $i ?>&search=<?= $search ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
</body>
</html>