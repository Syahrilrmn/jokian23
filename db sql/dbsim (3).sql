-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Okt 2023 pada 07.25
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsim`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `ID_Barang` int(11) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `Nama_Barang` varchar(255) DEFAULT NULL,
  `Stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`ID_Barang`, `kode_barang`, `Nama_Barang`, `Stok`) VALUES
(15, 'BRG0001', 'Bensin', 13),
(26, 'BRG0002', 'Bensinnnnnnnnnnn', 14),
(27, 'BRG0003', 'Bensinnnnnnnnnnn', 13),
(28, 'BRG0004', 'Bensinnnnnnnnnnn  ', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjamanbarang`
--

CREATE TABLE `peminjamanbarang` (
  `ID_Peminjaman` int(11) NOT NULL,
  `Pinjam_id` varchar(10) NOT NULL,
  `Nama_Peminjam` varchar(255) DEFAULT NULL,
  `Tanggal_Peminjaman` date DEFAULT NULL,
  `Tanggal_Pengembalian` date DEFAULT NULL,
  `ID_Barang` int(11) DEFAULT NULL,
  `Jumlah` int(11) DEFAULT NULL,
  `anggota_id` varchar(10) NOT NULL,
  `kode_barang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Trigger `peminjamanbarang`
--
DELIMITER $$
CREATE TRIGGER `hapusbarang` BEFORE DELETE ON `peminjamanbarang` FOR EACH ROW BEGIN
    UPDATE barang
    SET Stok = Stok + OLD.Jumlah
    WHERE kode_barang = OLD.kode_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambahbarang` BEFORE INSERT ON `peminjamanbarang` FOR EACH ROW BEGIN
    UPDATE barang
    SET Stok = Stok - NEW.Jumlah
    WHERE kode_barang = NEW.kode_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengambilansolar`
--

CREATE TABLE `pengambilansolar` (
  `ID_Pengambilan` int(11) NOT NULL,
  `ID_Solar` int(11) DEFAULT NULL,
  `Nama_Pengambil` varchar(255) DEFAULT NULL,
  `Tanggal_Pengambilan` date DEFAULT NULL,
  `Jumlah_Liter` int(11) DEFAULT NULL,
  `Kendaraan` varchar(255) DEFAULT NULL,
  `Catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumumantugas`
--

CREATE TABLE `pengumumantugas` (
  `ID_Pengumuman` int(11) NOT NULL,
  `Isi_Pengumuman` text DEFAULT NULL,
  `Tanggal` date DEFAULT NULL,
  `Pegawai_Tujuan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengumumantugas`
--

INSERT INTO `pengumumantugas` (`ID_Pengumuman`, `Isi_Pengumuman`, `Tanggal`, `Pegawai_Tujuan`) VALUES
(1, 'esok libur', '2022-02-01', 'jambaran'),
(2, 'esok kita upacara', '2023-10-28', 'jamaludin ukak jamping'),
(3, 'di cari bapa', '2023-10-28', 'Syahril'),
(5, 'sadsadasd', '2023-10-28', 'asdasd'),
(6, 'sadsadasd', '2023-10-27', 'asdasd'),
(7, 'sadsadasd a', '2023-10-31', 'asdasd a'),
(8, 'asdasd', '2023-10-28', 'asdsad'),
(9, 'asdasd', '2023-10-28', 'asdasd'),
(10, 'asdasd', '2023-10-28', 'asdasd'),
(11, 'asdasd', '2023-10-28', 'asdasd'),
(12, 'asdasd', '2023-10-28', 'asdasd'),
(14, 'asdasdasd', '2023-10-28', 'asd'),
(15, 'adasda', '2023-10-28', 'asd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `solar`
--

CREATE TABLE `solar` (
  `ID_Solar` int(11) NOT NULL,
  `Jumlah_Stok` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `solar`
--

INSERT INTO `solar` (`ID_Solar`, `Jumlah_Stok`, `created_at`) VALUES
(1, 12, '2023-10-31 03:03:14'),
(2, 12, '2023-10-31 04:35:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id_login` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `level` enum('Admin','User') NOT NULL DEFAULT 'User',
  `anggota_id` varchar(50) NOT NULL,
  `jenkel` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tgl_bergabung` date NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_login`
--

INSERT INTO `tbl_login` (`id_login`, `user`, `pass`, `level`, `anggota_id`, `jenkel`, `alamat`, `email`, `tgl_bergabung`, `foto`) VALUES
(4, 'Syahril Ramadhan', '4a0f06e1bda45f50e20baa1127b71cdb', 'Admin', '', 'Laki-Laki', 'pingaran ulu', 'syahril1264@gmail.com', '2023-10-13', 'user_1697203149.jpg'),
(17, 'jamal', '202cb962ac59075b964b07152d234b70', 'User', 'baga123', 'Laki-Laki', 'Banjarbaru', 'jamal@gmail.com', '2023-10-31', 'user_1698733003.png'),
(18, 'munadi', '202cb962ac59075b964b07152d234b70', 'User', 'tes543', 'Laki-Laki', 'pingaran ulu', 'munadi@gmail.com', '2023-10-31', 'user_1698733145.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID_Barang`);

--
-- Indeks untuk tabel `peminjamanbarang`
--
ALTER TABLE `peminjamanbarang`
  ADD PRIMARY KEY (`ID_Peminjaman`),
  ADD KEY `ID_Barang` (`ID_Barang`);

--
-- Indeks untuk tabel `pengambilansolar`
--
ALTER TABLE `pengambilansolar`
  ADD PRIMARY KEY (`ID_Pengambilan`),
  ADD KEY `ID_Solar` (`ID_Solar`);

--
-- Indeks untuk tabel `pengumumantugas`
--
ALTER TABLE `pengumumantugas`
  ADD PRIMARY KEY (`ID_Pengumuman`);

--
-- Indeks untuk tabel `solar`
--
ALTER TABLE `solar`
  ADD PRIMARY KEY (`ID_Solar`);

--
-- Indeks untuk tabel `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id_login`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `ID_Barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `peminjamanbarang`
--
ALTER TABLE `peminjamanbarang`
  MODIFY `ID_Peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `pengumumantugas`
--
ALTER TABLE `pengumumantugas`
  MODIFY `ID_Pengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `solar`
--
ALTER TABLE `solar`
  MODIFY `ID_Solar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peminjamanbarang`
--
ALTER TABLE `peminjamanbarang`
  ADD CONSTRAINT `peminjamanbarang_ibfk_1` FOREIGN KEY (`ID_Barang`) REFERENCES `barang` (`ID_Barang`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengambilansolar`
--
ALTER TABLE `pengambilansolar`
  ADD CONSTRAINT `pengambilansolar_ibfk_1` FOREIGN KEY (`ID_Solar`) REFERENCES `solar` (`ID_Solar`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
