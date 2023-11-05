-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 05, 2023 at 01:09 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.30

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
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `ID_Barang` int NOT NULL,
  `kode_barang` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `Nama_Barang` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Stok` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`ID_Barang`, `kode_barang`, `Nama_Barang`, `Stok`) VALUES
(15, 'BRG0001', 'Bensin', 13),
(26, 'BRG0002', 'Bensinnnnnnnnnnn', 14),
(27, 'BRG0003', 'Bensinnnnnnnnnnn', 13),
(28, 'BRG0004', 'Bensinnnnnnnnnnn  ', 5);

-- --------------------------------------------------------

--
-- Table structure for table `peminjamanbarang`
--

CREATE TABLE `peminjamanbarang` (
  `ID_Peminjaman` int NOT NULL,
  `Pinjam_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `Nama_Peminjam` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Tanggal_Peminjaman` date DEFAULT NULL,
  `Tanggal_Pengembalian` date DEFAULT NULL,
  `ID_Barang` int DEFAULT NULL,
  `Jumlah` int DEFAULT NULL,
  `anggota_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_barang` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `peminjamanbarang`
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
-- Table structure for table `pengumumantugas`
--

CREATE TABLE `pengumumantugas` (
  `ID_Pengumuman` int NOT NULL,
  `Isi_Pengumuman` json DEFAULT NULL,
  `Tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengumumantugas`
--

INSERT INTO `pengumumantugas` (`ID_Pengumuman`, `Isi_Pengumuman`, `Tanggal`) VALUES
(16, '[{\"Isi_Pengumuman\": \"1\", \"Pegawai_Tujuan\": \"1\"}, {\"Isi_Pengumuman\": \"2\", \"Pegawai_Tujuan\": \"2\"}]', '2002-01-20'),
(17, '[{\"Isi_Pengumuman\": \"Ke arab beli arak\", \"Pegawai_Tujuan\": \"Jamal\"}, {\"Isi_Pengumuman\": \"Ke portogal membawa bulik jablay\", \"Pegawai_Tujuan\": \"Jambran\"}]', '2002-08-20'),
(18, '[{\"Isi_Pengumuman\": \"bagababgab\", \"Pegawai_Tujuan\": \"Jamal\"}, {\"Isi_Pengumuman\": \"asdasd\", \"Pegawai_Tujuan\": \"Udin\"}]', '2023-11-03'),
(19, '[{\"Isi_Pengumuman\": \"Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quas eum nemo atque. Assumenda pariatur, molestiae atque numquam quia facere nobis architecto saepe suscipit perferendis aspernatur minus ipsam ab deserunt explicabo, adipisci quisquam reiciendis. Ipsa dolor praesentium beatae minima voluptates deserunt dicta vitae, illum ad error, animi aliquam qui illo aperiam doloremque maiores? Esse optio explicabo qui vel minima vero neque debitis molestiae, aspernatur ducimus obcaecati sunt quibusdam consequuntur perspiciatis totam quod consequatur illum culpa dignissimos nulla quae eligendi nostrum! Quam voluptates dolorem quis fuga ducimus consectetur, natus necessitatibus labore dolorum. Obcaecati nobis et error vitae numquam mollitia! Dolorum, totam quod!\", \"Pegawai_Tujuan\": \"baga\\r\\n\"}, {\"Isi_Pengumuman\": \"mengaji\", \"Pegawai_Tujuan\": \"fadlan\"}, {\"Isi_Pengumuman\": \"meantar laundry\", \"Pegawai_Tujuan\": \"anton\"}, {\"Isi_Pengumuman\": \"asdasdas\", \"Pegawai_Tujuan\": \"asdasd\"}, {\"Isi_Pengumuman\": \"asdasdad\", \"Pegawai_Tujuan\": \"asdasd\"}]', '2023-11-04'),
(22, '[{\"Isi_Pengumuman\": \"testing\", \"Pegawai_Tujuan\": \"Jamal\"}]', '2023-11-05');

-- --------------------------------------------------------

--
-- Table structure for table `solar`
--

CREATE TABLE `solar` (
  `ID_Solar` int NOT NULL,
  `Jumlah_Stok` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedat` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `solar`
--

INSERT INTO `solar` (`ID_Solar`, `Jumlah_Stok`, `created_at`, `updatedat`) VALUES
(1, 9980, '2023-10-31 03:03:14', '2023-11-05 01:04:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id_login` int NOT NULL,
  `user` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `level` enum('Admin','User') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'User',
  `anggota_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `jenkel` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_bergabung` date NOT NULL,
  `foto` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id_login`, `user`, `pass`, `level`, `anggota_id`, `jenkel`, `alamat`, `email`, `tgl_bergabung`, `foto`) VALUES
(4, 'Syahril Ramadhan', '4a0f06e1bda45f50e20baa1127b71cdb', 'Admin', '', 'Laki-Laki', 'pingaran ulu', 'syahril1264@gmail.com', '2023-10-13', 'user_1697203149.jpg'),
(17, 'jamal', '202cb962ac59075b964b07152d234b70', 'User', 'baga123', 'Laki-Laki', 'Banjarbaru', 'jamal@gmail.com', '2023-10-31', 'user_1698733003.png'),
(18, 'munadi', '202cb962ac59075b964b07152d234b70', 'User', 'tes543', 'Laki-Laki', 'pingaran ulu', 'munadi@gmail.com', '2023-10-31', 'user_1698733145.png');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_solar`
--

CREATE TABLE `transaksi_solar` (
  `id_transaksi_solar` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `tanggal_pengambilan` date DEFAULT NULL,
  `jumlah_liter` int DEFAULT NULL,
  `kendaraan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_plat` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `solar_terakhir` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_solar`
--

INSERT INTO `transaksi_solar` (`id_transaksi_solar`, `id_user`, `tanggal_pengambilan`, `jumlah_liter`, `kendaraan`, `no_plat`, `solar_terakhir`) VALUES
(1, 4, '2023-11-05', 111, 'Supra', 'DA 123 BB', 8889),
(2, 4, '2023-11-05', 111, 'Supra', 'DA 123 BB', 8778),
(3, 4, '2023-11-05', 1000, 'asd', 'asdasd', 8667),
(4, 4, '2023-11-05', 9000, 'asd', 'asdasd', 7667),
(5, 4, '0000-00-00', 1000, 'asd', 'asdasd', 7667),
(6, 4, '0000-00-00', 0, '', '', 6667),
(7, 4, '2023-11-05', 1111, 'Supra', 'DA 123 BB', 6667),
(8, 4, '2023-11-05', 5556, 'asdasda', 'asdasd', 5556),
(9, 4, '2023-11-05', 10, 'Supra', 'DA 123 BB', 10000),
(10, 4, '2023-11-05', 10, 'Supra', 'DA 123 BB', 9990);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID_Barang`);

--
-- Indexes for table `peminjamanbarang`
--
ALTER TABLE `peminjamanbarang`
  ADD PRIMARY KEY (`ID_Peminjaman`),
  ADD KEY `ID_Barang` (`ID_Barang`);

--
-- Indexes for table `pengumumantugas`
--
ALTER TABLE `pengumumantugas`
  ADD PRIMARY KEY (`ID_Pengumuman`);

--
-- Indexes for table `solar`
--
ALTER TABLE `solar`
  ADD PRIMARY KEY (`ID_Solar`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `transaksi_solar`
--
ALTER TABLE `transaksi_solar`
  ADD PRIMARY KEY (`id_transaksi_solar`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `ID_Barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `peminjamanbarang`
--
ALTER TABLE `peminjamanbarang`
  MODIFY `ID_Peminjaman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pengumumantugas`
--
ALTER TABLE `pengumumantugas`
  MODIFY `ID_Pengumuman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `solar`
--
ALTER TABLE `solar`
  MODIFY `ID_Solar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id_login` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transaksi_solar`
--
ALTER TABLE `transaksi_solar`
  MODIFY `id_transaksi_solar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjamanbarang`
--
ALTER TABLE `peminjamanbarang`
  ADD CONSTRAINT `peminjamanbarang_ibfk_1` FOREIGN KEY (`ID_Barang`) REFERENCES `barang` (`ID_Barang`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
