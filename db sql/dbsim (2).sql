-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Okt 2023 pada 05.39
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
(15, 'BRG0001', 'Bensin ', 10);

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
(1, 'esok libur', '2022-02-01', 'jambaran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `solar`
--

CREATE TABLE `solar` (
  `ID_Solar` int(11) NOT NULL,
  `Jenis_Solar` varchar(255) DEFAULT NULL,
  `Jumlah_Stok` int(11) DEFAULT NULL,
  `Harga_Per_Liter` decimal(10,2) DEFAULT NULL,
  `Tanggal_Update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(6, 'munadi', '558544e81333dc6c1c74d2d43afdb768', 'User', 'AGT0001', 'Laki-Laki', 'pingaran ulu', 'munadi@gmail.com', '2023-10-23', 'user_1698069440.png');

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
  MODIFY `ID_Barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `peminjamanbarang`
--
ALTER TABLE `peminjamanbarang`
  MODIFY `ID_Peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `pengambilansolar`
--
ALTER TABLE `pengambilansolar`
  MODIFY `ID_Pengambilan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengumumantugas`
--
ALTER TABLE `pengumumantugas`
  MODIFY `ID_Pengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `solar`
--
ALTER TABLE `solar`
  MODIFY `ID_Solar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
