-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 07, 2023 at 02:12 PM
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
(15, 'BRG0001', 'Bensin', 10),
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
  `tgl_kembali` date NOT NULL,
  `status` enum('Dipinjam','Di Kembalikan') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Dipinjam',
  `ID_Barang` int DEFAULT NULL,
  `Jumlah` int DEFAULT NULL,
  `anggota_id` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_barang` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjamanbarang`
--

INSERT INTO `peminjamanbarang` (`ID_Peminjaman`, `Pinjam_id`, `Nama_Peminjam`, `Tanggal_Peminjaman`, `Tanggal_Pengembalian`, `tgl_kembali`, `status`, `ID_Barang`, `Jumlah`, `anggota_id`, `kode_barang`) VALUES
(24, 'PJ-0002', NULL, '2023-11-07', '2023-11-16', '2023-11-07', 'Di Kembalikan', NULL, 3, 'tes123', 'BRG0003'),
(25, 'PJ-0003', NULL, '2023-11-07', '2023-11-09', '2023-11-07', 'Di Kembalikan', NULL, 5, 'tes789', 'BRG0001'),
(26, 'PJ-0004', NULL, '2023-11-07', '2023-11-10', '2023-11-07', 'Di Kembalikan', NULL, 4, 'tes345', 'BRG0002'),
(27, 'PJ-0005', NULL, '2023-11-07', '2023-11-08', '0000-00-00', 'Dipinjam', NULL, 5, 'tes345', 'BRG0001');

--
-- Triggers `peminjamanbarang`
--
DELIMITER $$
CREATE TRIGGER `barangkembali` AFTER UPDATE ON `peminjamanbarang` FOR EACH ROW BEGIN
    IF NEW.status = 'Di kembalikan' AND OLD.status = 'Dipinjam' THEN
        UPDATE barang
        SET Stok = Stok + NEW.Jumlah
        WHERE kode_barang = NEW.kode_barang;
    END IF;
END
$$
DELIMITER ;
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
  `Isi_Pengumuman` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `Tanggal` date DEFAULT NULL
) ;

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
  `tanggal_lahir` date NOT NULL,
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

INSERT INTO `tbl_login` (`id_login`, `user`, `pass`, `level`, `tanggal_lahir`, `anggota_id`, `jenkel`, `alamat`, `email`, `tgl_bergabung`, `foto`) VALUES
(4, 'Syahril Ramadhan', '4a0f06e1bda45f50e20baa1127b71cdb', 'Admin', '0000-00-00', '', 'Laki-Laki', 'pingaran ulu', 'syahril1264@gmail.com', '2023-10-13', 'user_1697203149.jpg'),
(24, 'aau', '202cb962ac59075b964b07152d234b70', 'User', '2002-02-11', 'tes789', 'Laki-Laki', 'astambul', 'aau@gmail.com', '2023-11-07', 'user_1699361970.png'),
(25, 'munadi', '0192023a7bbd73250516f069df18b500', 'User', '2004-02-11', 'tes345', 'Laki-Laki', 'pingaran ulu', 'munadi@gmail.com', '2023-11-07', 'user_1699362033.png');

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
  `no_plat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `solar_terakhir` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_solar`
--

INSERT INTO `transaksi_solar` (`id_transaksi_solar`, `id_user`, `tanggal_pengambilan`, `jumlah_liter`, `kendaraan`, `no_plat`, `solar_terakhir`, `created_at`) VALUES
(14, 4, '2023-11-07', 1, 'Supra Bapack', '111111', 6979, '2023-11-07 12:15:44'),
(15, 4, '2023-11-07', 1, 'Supra Bapack', '111111', 6978, '2023-11-07 12:15:56'),
(16, 4, '2023-11-07', 1, 'Supra Bapack', '111111', 6977, '2023-11-07 12:16:08'),
(17, 4, '2023-01-01', 1, 'Supra Bapack', '111111', 6976, '2023-11-07 12:54:46'),
(18, 4, '2023-01-14', 1, 'Supra Bapack', '111111', 6975, '2023-11-07 12:55:09'),
(19, 18, '2023-11-07', 1, 'Supra Bapack', '111111', 6974, '2023-11-07 13:30:06'),
(20, 18, '2023-01-07', 1, 'Supra Bapack', '111111', 6973, '2023-11-07 13:33:00');

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
  MODIFY `ID_Peminjaman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pengumumantugas`
--
ALTER TABLE `pengumumantugas`
  MODIFY `ID_Pengumuman` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `solar`
--
ALTER TABLE `solar`
  MODIFY `ID_Solar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id_login` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `transaksi_solar`
--
ALTER TABLE `transaksi_solar`
  MODIFY `id_transaksi_solar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
