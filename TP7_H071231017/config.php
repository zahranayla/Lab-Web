<?php
$servername = "localhost";
$username = "root";
$password = ""; // Biarkan kosong jika Anda menggunakan XAMPP dan belum mengatur password
$dbname = "mahasiswa_db";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname, 3306);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
