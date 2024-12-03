-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Nov 2024 pada 08.26
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `konserlaravel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `event`
--

CREATE TABLE `event` (
  `idevent` int(11) NOT NULL,
  `judul` text NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` text NOT NULL,
  `tanggalevent` date DEFAULT NULL,
  `jamevent` time NOT NULL,
  `lokasi` text NOT NULL,
  `foto` text NOT NULL,
  `ideo` int(11) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `event`
--

INSERT INTO `event` (`idevent`, `judul`, `deskripsi`, `harga`, `tanggalevent`, `jamevent`, `lokasi`, `foto`, `ideo`, `waktu`) VALUES
(1, 'Pervormance Live : NGOBRYLS', '<p><strong>PERVORMANCE LIVE : NGOBRYLS</strong></p>\r\n\r\n<p>Tanggal 2 Februari 2019, sebuah video dipublikasikan di kanal YouTube NGOBRYLS: Jimi X Malau. Sosok sahabat lama ini kembali bercuap-cuap ria namun dengan konsep yang lebih artsy dari pada 2011 silam. Dalam video pertamanya setelah hilang dari peredaran jagat YouTube, mereka coba untuk menarik kembali ingatan masa lampau kala remaja-remaja Indonesia di era 70&rsquo;an berkreasi menciptakan lagu, dengan lirik-lirik yang cukup puitis di masanya. 97.8K subscriber dan 251 video telah merapat.</p>\r\n\r\n<p>Konten yang mereka publish lebih kepada memorabilia dengan sisipan-sisipan kisah atau kehidupan maskulinitas kaum seniman urban, sembari memotret fenomena-fenomena kehidupan di balik bingkai masing-masing dua sahabat, yang juga dedengkotnya IKJ.</p>\r\n\r\n<p>NGOBRYLS dengan segala keunikan nya telah memberikan sebuah hiburan yang berbeda dengan podcaster lain, dengan pembawaan Jimi Multhazam yang fun dan skenik lalu dengan Ricky Malau yang enerjik sekaligus bijak membuat video-video yang mereka buat selalu menjadi bahan tongkrongan yang asik untuk dibahas oleh 16 Juta lebih viewers mereka.</p>\r\n\r\n<p>Selain itu, NGOBRYLS juga ditemani oleh beberapa tamu menarik seperti Endah n Rhesa, Dustin Tiffani, dan Sore yang pastinya membuat banyak dari fans nya penasaran dengan apa yang akan terjadi jika mereka bertemu dua host nyentrik ini secara live.</p>\r\n\r\n<p>#SIKATFREN</p>', '150000', '2024-02-24', '00:00:00', '', '20240107223824_659ac570727dd.jpg', 1, '2024-11-25 13:28:19'),
(2, 'Jectfest 2024', '<p>Jectfest 2024 kembali dengan konsep yang lebih segar dan penuh kejutan! Mengusung tema&nbsp;<strong>Melotheria</strong>, yang akan membawa pengunjung ke dalam pengalaman musikal yang penuh emosi, imajinasi, dan energi tak terbatas. Tidak hanya sekadar acara musik, tetapi juga sebuah perjalanan emosional yang merayakan beragam genre, kreativitas, dan semangat muda.</p>\r\n\r\n<p>Acara utama tahun ini adalah&nbsp;<strong>Band Competition</strong>, yang akan menampilkan deretan band-band berbakat yang bersaing dalam berbagai kategori. Ini adalah kesempatan emas bagi para musisi muda untuk menunjukkan bakat mereka dan berkompetisi di panggung yang penuh prestise.</p>\r\n\r\n<p>Dengan kombinasi kompetisi band, penampilan guest star, dan DJ performance,&nbsp;<strong>Jectfest 2024</strong>&nbsp;adalah tempat para pencinta musik bisa menikmati berbagai aliran musik yang saling berinteraksi, menciptakan atmosfer yang penuh antusiasme dan kegembiraan.</p>\r\n\r\n<p>Bergabunglah dengan kami dalam perayaan musik yang tak terlupakan ini.&nbsp;<strong>Jectfest 2024 &ndash; Melotheria</strong>&nbsp;siap membawa pengalaman baru yang menggabungkan energi, kreativitas, dan semangat yang tak terbendung!</p>', '50000', '2024-12-08', '19:00:00', 'Hype Cafe | Hype Cafe, Billiard & Live Music, Jalan Kartini, Depok, Depok City, West Java, Indonesia', '4d8e1308-d0df-439b-a4c9-582d1c87f7e5.png', 1, '2024-11-25 13:38:08'),
(3, 'Closing Party Nose Cup 2025', '<p>Bergabunglah dalam malam penuh magis dan energi di&nbsp;<strong>&quot;Closing Party Nose Cup 2025&quot;</strong>, sebuah konser musik spektakuler yang akan mengguncang kota Anda! Nikmati perpaduan luar biasa dari genre musik populer, mulai dari pop, hingga indie yang dibawakan oleh deretan artis terbaik dari dalam negeri.</p>\r\n\r\n<p>🎤&nbsp;<strong>Highlight Event</strong>:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Penampilan Spesial:</strong>&nbsp;Bintang utama, (to be revealed).</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Kolaborasi Eksklusif:</strong>&nbsp;Side Guest Star, (to be revealed)</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>🎶&nbsp;<strong>Fasilitas Menarik:</strong></p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Zona Makanan &amp; Minuman:</strong>&nbsp;Jelajahi ragam kuliner dari food truck dan bar tematik.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Photo Booth &amp; Merchandise:</strong>&nbsp;Abadikan momen di area foto bertema, dan dapatkan merchandise edisi terbatas.</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>🗓️&nbsp;<strong>Detail Event:</strong></p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Tanggal:</strong>&nbsp;15 Februari 2025</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Lokasi:</strong>&nbsp;Gelora Pancasila Surabaya</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Jam:</strong>&nbsp;18.00 - Selesai</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>🎟️&nbsp;<strong>Tiket:</strong>&nbsp;Tersedia kategori tiket&nbsp;<strong>Early Bird</strong>,&nbsp;<strong>Presale</strong>, dan&nbsp;<strong>festival</strong>. Pesan sekarang di yesplis.com. Jangan sampai kehabisan!</p>\r\n\r\n<p>Datang dan rasakan suasana yang tak terlupakan bersama teman-teman Anda. Bersiaplah untuk menyatu dengan dentuman musik dan semangat festival yang akan membawa Anda pada pengalaman luar biasa! 🌟</p>', '100000', '2025-02-15', '18:00:00', 'Gelora Pancasila Surabaya | Jl. Patmosusastro No.12, Darmo, Kec. Wonokromo, Surabaya, Jawa Timur 60256, Indonesia', '242633af-a0a9-4005-ac33-6bc4bbe627c2.png', 1, '2024-11-25 13:41:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `favorit`
--

CREATE TABLE `favorit` (
  `idfavorit` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `idevent` int(11) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `telepon` text NOT NULL,
  `alamat` text DEFAULT NULL,
  `fotoprofil` text NOT NULL,
  `level` text NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `jekel` varchar(100) DEFAULT NULL,
  `provinsi` varchar(255) DEFAULT NULL,
  `kota` varchar(255) DEFAULT NULL,
  `kec` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `email`, `password`, `telepon`, `alamat`, `fotoprofil`, `level`, `tgl_lahir`, `tempat_lahir`, `jekel`, `provinsi`, `kota`, `kec`, `kode_pos`) VALUES
(1, 'EO 1', 'eo@gmail.com', 'eo', '0812344567', NULL, 'Untitled.png', 'EO', '2002-07-08', 'Jakarta', 'Laki-laki', 'DKI Jakarta', 'Jakarta Selatan', 'Ciganjur', '12170'),
(2, 'Administrator', 'admin@gmail.com', 'admin', '0812344567', '', '', 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Sugeng', 'sugeng@gmail.com', 'sugeng', '0812344567', NULL, 'Untitled.png', 'User', '2024-07-29', 'Muba', 'Laki-laki', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesertaevent`
--

CREATE TABLE `pesertaevent` (
  `idpesertaevent` int(11) NOT NULL,
  `idevent` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `tanggalpemesanan` datetime NOT NULL,
  `status` text NOT NULL,
  `bukti` text NOT NULL,
  `tanggaltransfer` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesertaevent`
--

INSERT INTO `pesertaevent` (`idpesertaevent`, `idevent`, `id`, `tanggalpemesanan`, `status`, `bukti`, `tanggaltransfer`) VALUES
(1, 3, 4, '2024-11-25 00:00:00', 'Pesanan Diterima', '20241125162929Karawo-Gorontalo-002.jpg', '2024-11-25'),
(4, 2, 4, '2024-11-25 17:35:41', 'Pesanan Diterima', '20241125173557f3ed226cdbf3f7fbba8d57155e23f753.jpeg', '2024-11-25');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`idevent`);

--
-- Indeks untuk tabel `favorit`
--
ALTER TABLE `favorit`
  ADD PRIMARY KEY (`idfavorit`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesertaevent`
--
ALTER TABLE `pesertaevent`
  ADD PRIMARY KEY (`idpesertaevent`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `event`
--
ALTER TABLE `event`
  MODIFY `idevent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `favorit`
--
ALTER TABLE `favorit`
  MODIFY `idfavorit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pesertaevent`
--
ALTER TABLE `pesertaevent`
  MODIFY `idpesertaevent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
