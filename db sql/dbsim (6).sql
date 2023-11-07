-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Nov 2023 pada 07.35
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
(15, 'BRG0001', 'Bensin', 1),
(26, 'BRG0002', 'Bensinnnnnnnnnnn', 14),
(27, 'BRG0003', 'Bensinnnnnnnnnnn', 10),
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
  `tgl_kembali` date NOT NULL,
  `status` enum('Dipinjam','Di Kembalikan') NOT NULL DEFAULT 'Dipinjam',
  `ID_Barang` int(11) DEFAULT NULL,
  `Jumlah` int(11) DEFAULT NULL,
  `anggota_id` varchar(10) NOT NULL,
  `kode_barang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjamanbarang`
--

INSERT INTO `peminjamanbarang` (`ID_Peminjaman`, `Pinjam_id`, `Nama_Peminjam`, `Tanggal_Peminjaman`, `Tanggal_Pengembalian`, `tgl_kembali`, `status`, `ID_Barang`, `Jumlah`, `anggota_id`, `kode_barang`) VALUES
(16, 'PJ-0001', NULL, '2023-11-06', '2023-11-16', '2023-11-06', 'Di Kembalikan', NULL, 11, 'tes543', 'BRG0001'),
(17, 'PJ-0002', NULL, '2023-11-06', '2023-11-07', '0000-00-00', 'Dipinjam', NULL, 1, 'tes456', 'BRG0001'),
(18, 'PJ-0003', NULL, '2023-11-07', '2023-11-10', '2023-11-07', 'Di Kembalikan', NULL, 3, 'baga123', 'BRG0003');

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
-- Struktur dari tabel `pengumumantugas`
--

CREATE TABLE `pengumumantugas` (
  `ID_Pengumuman` int(11) NOT NULL,
  `Isi_Pengumuman` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`Isi_Pengumuman`)),
  `Tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengumumantugas`
--

INSERT INTO `pengumumantugas` (`ID_Pengumuman`, `Isi_Pengumuman`, `Tanggal`) VALUES
(16, '[{\"Isi_Pengumuman\": \"1\", \"Pegawai_Tujuan\": \"1\"}, {\"Isi_Pengumuman\": \"2\", \"Pegawai_Tujuan\": \"2\"}]', '2002-01-20'),
(17, '[{\"Isi_Pengumuman\": \"Ke arab beli arak\", \"Pegawai_Tujuan\": \"Jamal\"}, {\"Isi_Pengumuman\": \"Ke portogal membawa bulik jablay\", \"Pegawai_Tujuan\": \"Jambran\"}]', '2002-08-20'),
(18, '[{\"Isi_Pengumuman\": \"bagababgab\", \"Pegawai_Tujuan\": \"Jamal\"}, {\"Isi_Pengumuman\": \"asdasd\", \"Pegawai_Tujuan\": \"Udin\"}]', '2023-11-03'),
(19, '[{\"Isi_Pengumuman\": \"Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quas eum nemo atque. Assumenda pariatur, molestiae atque numquam quia facere nobis architecto saepe suscipit perferendis aspernatur minus ipsam ab deserunt explicabo, adipisci quisquam reiciendis. Ipsa dolor praesentium beatae minima voluptates deserunt dicta vitae, illum ad error, animi aliquam qui illo aperiam doloremque maiores? Esse optio explicabo qui vel minima vero neque debitis molestiae, aspernatur ducimus obcaecati sunt quibusdam consequuntur perspiciatis totam quod consequatur illum culpa dignissimos nulla quae eligendi nostrum! Quam voluptates dolorem quis fuga ducimus consectetur, natus necessitatibus labore dolorum. Obcaecati nobis et error vitae numquam mollitia! Dolorum, totam quod!\", \"Pegawai_Tujuan\": \"baga\\r\\n\"}, {\"Isi_Pengumuman\": \"mengaji\", \"Pegawai_Tujuan\": \"fadlan\"}, {\"Isi_Pengumuman\": \"meantar laundry\", \"Pegawai_Tujuan\": \"anton\"}, {\"Isi_Pengumuman\": \"asdasdas\", \"Pegawai_Tujuan\": \"asdasd\"}, {\"Isi_Pengumuman\": \"asdasdad\", \"Pegawai_Tujuan\": \"asdasd\"}]', '2023-11-04'),
(22, '[{\"Isi_Pengumuman\": \"testing\", \"Pegawai_Tujuan\": \"Jamal\"}]', '2023-11-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `solar`
--

CREATE TABLE `solar` (
  `ID_Solar` int(11) NOT NULL,
  `Jumlah_Stok` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedat` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `solar`
--

INSERT INTO `solar` (`ID_Solar`, `Jumlah_Stok`, `created_at`, `updatedat`) VALUES
(1, 9980, '2023-10-31 03:03:14', '2023-11-05 01:04:34');

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
(18, 'munadi', '202cb962ac59075b964b07152d234b70', 'User', 'tes543', 'Laki-Laki', 'pingaran ulu', 'munadi@gmail.com', '2023-10-31', 'user_1698733145.png'),
(19, 'aau', '202cb962ac59075b964b07152d234b70', 'User', 'tes456', 'Laki-Laki', 'astambul', 'aau@gmail.com', '2023-11-06', 'user_1699270233.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_solar`
--

CREATE TABLE `transaksi_solar` (
  `id_transaksi_solar` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tanggal_pengambilan` date DEFAULT NULL,
  `jumlah_liter` int(11) DEFAULT NULL,
  `kendaraan` varchar(255) DEFAULT NULL,
  `no_plat` varchar(50) NOT NULL,
  `solar_terakhir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_solar`
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
-- Indeks untuk tabel `transaksi_solar`
--
ALTER TABLE `transaksi_solar`
  ADD PRIMARY KEY (`id_transaksi_solar`);

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
  MODIFY `ID_Peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `pengumumantugas`
--
ALTER TABLE `pengumumantugas`
  MODIFY `ID_Pengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `solar`
--
ALTER TABLE `solar`
  MODIFY `ID_Solar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `transaksi_solar`
--
ALTER TABLE `transaksi_solar`
  MODIFY `id_transaksi_solar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peminjamanbarang`
--
ALTER TABLE `peminjamanbarang`
  ADD CONSTRAINT `peminjamanbarang_ibfk_1` FOREIGN KEY (`ID_Barang`) REFERENCES `barang` (`ID_Barang`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
