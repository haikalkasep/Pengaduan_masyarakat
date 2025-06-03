-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jun 2025 pada 05.40
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pp_masyarakat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `masyarakat`
--

CREATE TABLE `masyarakat` (
  `nik` char(16) NOT NULL,
  `nama` varchar(35) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(322) DEFAULT NULL,
  `telp` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `masyarakat`
--

INSERT INTO `masyarakat` (`nik`, `nama`, `username`, `password`, `telp`) VALUES
('1', 'asep', 'badrie an nashr Baadilaa', '$2y$10$74u4l4M/LVJpywMwXJnSqeUG2IMJCnvYBcuxQD1GKoi6s4OUvN1Ly', '00901930910'),
('2', 'ase[', 'badrie an nashr Baadilaa', '$2y$10$UwAj22ch/QBO5/gpCd5YDufRfgje2AcjC2P65cr/zW91Oflro/TMO', '00901930910'),
('3', 'aqil', 'admin', '202cb962ac59075b964b07152d234b70', '09120'),
('4', 'kqe', 'memek', '202cb962ac59075b964b07152d234b70', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id_pengaduan` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `tanggal_laporan` date DEFAULT NULL,
  `tgl_kejadian` date DEFAULT NULL,
  `nik` char(16) DEFAULT NULL,
  `isi_laporan` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('0','proses','selesai','valid') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengaduan`
--

INSERT INTO `pengaduan` (`id_pengaduan`, `judul`, `tanggal_laporan`, `tgl_kejadian`, `nik`, `isi_laporan`, `foto`, `status`) VALUES
(8, 'ling tlol ajg', '2025-05-13', '2025-05-08', '1', 'emem', '68230522c1b3f.', '0'),
(10, 'memek', '2025-05-17', '2025-05-14', '1', 'makd', 'default.jpg', 'selesai'),
(11, 'global warming', '2025-05-17', '2025-05-10', '1', 'aldl', '68281aea9d97f.jpg', '0'),
(12, 'lorem ipsum', '2025-05-17', '2025-05-19', '1', '&lt;?php\r\nsession_start();\r\nrequire_once &#039;../function/logic.php&#039;;\r\n\r\nif (!isset($_SESSION[&quot;role&quot;]) || $_SESSION[&quot;role&quot;] !== &quot;admin&quot; &amp;&amp; $_SESSION[&quot;role&quot;] !== &quot;petugas&quot;) {\r\n    header(&quot;Location: login_admin.php&quot;);\r\n    exit;\r\n}\r\nif (!isset($_GET[&#039;id&#039;])) {\r\n    echo &quot;ID pengaduan tidak ditemukan.&quot;;\r\n    exit;\r\n}\r\n\r\n$id = intval($_GET[&#039;id&#039;]);\r\n$data = tampil(&quot;SELECT * FROM pengaduan WHERE id_pengaduan = &#039;$id&#039;&quot;)[0];\r\n?&gt;\r\n&lt;!DOCTYPE html&gt;\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n    &lt;title&gt;Detail Pengaduan&lt;/title&gt;\r\n    &lt;link rel=&quot;stylesheet&quot; href=&quot;https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css&quot;&gt;\r\n&lt;/head&gt;\r\n&lt;body&gt;\r\n&lt;div class=&quot;container mt-4&quot;&gt;\r\n    &lt;h2&gt;Detail Pengaduan&lt;/h2&gt;\r\n    &lt;table class=&quot;table table-bordered&quot;&gt;\r\n        &lt;tr&gt;\r\n            &lt;th&gt;Judul&lt;/th&gt;\r\n            &lt;td&gt;&lt;?php echo $data[&#039;judul&#039;]; ?&gt;&lt;/td&gt;\r\n        &lt;/tr&gt;\r\n        &lt;tr&gt;\r\n            &lt;th&gt;Isi Laporan&lt;/th&gt;\r\n            &lt;td&gt;&lt;?php echo $data[&#039;isi_laporan&#039;]; ?&gt;&lt;/td&gt;\r\n        &lt;/tr&gt;\r\n        &lt;tr&gt;\r\n            &lt;th&gt;Tanggal&lt;/th&gt;\r\n            &lt;td&gt;&lt;?php echo $data[&#039;tgl_kejadian&#039;]; ?&gt;&lt;/td&gt;\r\n        &lt;/tr&gt;\r\n        &lt;tr&gt;\r\n            &lt;th&gt;Status&lt;/th&gt;\r\n            &lt;td&gt;&lt;?php echo $data[&#039;status&#039;]; ?&gt;&lt;/td&gt;\r\n        &lt;/tr&gt;\r\n        &lt;tr&gt;\r\n            &lt;th&gt;Foto&lt;/th&gt;\r\n            &lt;td&gt;\r\n                &lt;?php if ($data[&quot;foto&quot;] == &quot;default.jpg&quot;): ?&gt;\r\n                    tidak ada foto\r\n                &lt;?php else: ?&gt;\r\n                          &lt;img src=&quot;../assets/img/&lt;?php echo $data[&#039;foto&#039;]; ?&gt;&quot; width=&quot;300&quot;&gt;\r\n                &lt;?php endif; ?&gt;\r\n            &lt;/td&gt;\r\n        &lt;/tr&gt;\r\n    &lt;/table&gt;\r\n    &lt;a href=&quot;laporan_menunggu.php&quot; class=&quot;btn btn-secondary&quot;&gt;Kembali&lt;/a&gt;\r\n&lt;/div&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;', '6828581c17dfd.png', 'selesai'),
(13, 'yes i.m ataomic', '2025-06-02', '2025-06-11', '1', 'apa ari kamu', '683d798e5354c.jpeg', 'selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(35) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `telp` varchar(13) DEFAULT NULL,
  `level` enum('admin','petugas') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `username`, `password`, `telp`, `level`) VALUES
(1, 'agus', 'agus', '123', '019302', 'petugas'),
(2, 'agus13', 'admin', '12', '132131222', 'admin'),
(3, 'eoq', 'aqil', '123', '131321', 'admin'),
(4, 'agus', 'asep', '123', '123', 'petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id_tanggapan` int(11) NOT NULL,
  `id_pengaduan` int(11) DEFAULT NULL,
  `tgl_tanggapan` date DEFAULT NULL,
  `tanggapan` text DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tanggapan`
--

INSERT INTO `tanggapan` (`id_tanggapan`, `id_pengaduan`, `tgl_tanggapan`, `tanggapan`, `id_petugas`) VALUES
(2, 10, '2025-05-17', 'sia jawa gblk', 1),
(3, 12, '2025-05-17', 'memek', 1),
(4, 13, '2025-06-02', 'iyahh', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`nik`);

--
-- Indeks untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `nik` (`nik`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`),
  ADD KEY `id_pengaduan` (`id_pengaduan`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id_tanggapan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `masyarakat` (`nik`);

--
-- Ketidakleluasaan untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD CONSTRAINT `tanggapan_ibfk_1` FOREIGN KEY (`id_pengaduan`) REFERENCES `pengaduan` (`id_pengaduan`),
  ADD CONSTRAINT `tanggapan_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
