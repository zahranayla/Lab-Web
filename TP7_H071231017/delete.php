<?php
session_start();
include 'config.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$query = $conn->prepare("DELETE FROM mahasiswa WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();

header("Location: index.php");
exit;
?>
