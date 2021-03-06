-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2020 at 01:31 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ketering`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `email`, `no_hp`, `password`) VALUES
(1, 'owner', 'owner@gmail.com', '085741852963', '123'),
(2, 'mimin cantiq', 'mimin@gmail.com', '0821432245322', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bayar`
--

CREATE TABLE `tb_bayar` (
  `tipe_bayar` varchar(20) NOT NULL,
  `nama_rekening` varchar(20) NOT NULL,
  `no_rekening` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bayar`
--

INSERT INTO `tb_bayar` (`tipe_bayar`, `nama_rekening`, `no_rekening`) VALUES
('BCA', 'Siti Ayu W', '545123545'),
('BNI', 'Siti Ayu W', '66758192192');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_produk`
--

CREATE TABLE `tb_detail_produk` (
  `id_detail` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nota_produk` varchar(20) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `catatan` varchar(30) NOT NULL,
  `jumlah_pesan` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_produk`
--

INSERT INTO `tb_detail_produk` (`id_detail`, `id_produk`, `nota_produk`, `total_harga`, `catatan`, `jumlah_pesan`) VALUES
(11, 5, '16112020TG2Pw', 400000, 'satenya klatak yak', 40),
(12, 2, '16112020TG2Pw', 480000, 'murah ajah', 40),
(13, 2, '16112020fmIhv', 360000, 'dada ayam', 30),
(14, 2, '16112020liYg3', 360000, 'dada ayam', 30),
(15, 2, '16112020LwWRz', 360000, 'dada ayam', 30);

-- --------------------------------------------------------

--
-- Table structure for table `tb_keranjang`
--

CREATE TABLE `tb_keranjang` (
  `id_keranjang` int(5) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_pesan` int(5) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `catatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_keranjang`
--

INSERT INTO `tb_keranjang` (`id_keranjang`, `id_pelanggan`, `id_produk`, `jumlah_pesan`, `total_harga`, `catatan`) VALUES
(5934, 2, 6, 1, 20000, 'Engga pedes'),
(48175, 1, 2, 15, 180000, 'fdsfdfddfdfdfdfdfdfdf');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nm_pelanggan` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `password` varchar(128) NOT NULL,
  `tgl_daftar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nm_pelanggan`, `alamat`, `email`, `no_hp`, `password`, `tgl_daftar`) VALUES
(1, 'muhammad fahmy', 'melati', 'muhammadfahmy123@gmail.com', '085789456123', 'lahkokbisa', '2020-10-01 13:31:33'),
(2, 'Ayu', 'Trini Sleman Belakang Mushola', 'ayu@gmail.com', '082175439495', '123', '2020-12-07 12:17:12');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemesanan`
--

CREATE TABLE `tb_pemesanan` (
  `nota_pemesanan` varchar(20) NOT NULL,
  `tipe_bayar` varchar(20) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tgl_order` datetime NOT NULL DEFAULT current_timestamp(),
  `tgl_antar` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `gambar` text NOT NULL,
  `status_bayar` enum('belum','dp','lunas') NOT NULL,
  `status_antar` enum('belum','selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pemesanan`
--

INSERT INTO `tb_pemesanan` (`nota_pemesanan`, `tipe_bayar`, `id_pelanggan`, `tgl_order`, `tgl_antar`, `gambar`, `status_bayar`, `status_antar`) VALUES
('16112020fmIhv', 'BCA', 1, '2020-11-16 17:03:33', '2020-11-21 11:51:49', 'download.jpg', 'lunas', 'selesai'),
('16112020liYg3', 'BCA', 1, '2020-11-16 17:07:39', '2020-11-20 17:09:00', 'belum', 'belum', 'belum'),
('16112020LwWRz', 'BCA', 1, '2020-11-16 17:09:08', '2020-11-24 21:09:00', 'belum', 'belum', 'belum'),
('16112020TG2Pw', 'BCA', 1, '2020-11-16 17:02:35', '2020-11-19 17:06:00', 'belum', 'belum', 'belum');

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `minimal_pesan` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `satuan` enum('kotak','porsi') NOT NULL,
  `kategori` enum('prasmanan','paket') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `nama_produk`, `harga`, `minimal_pesan`, `foto`, `deskripsi`, `satuan`, `kategori`) VALUES
(2, 'Nasi Goreng', 12000, 15, 'download.jpg', 'Nasi Goreng Zimbabwe', 'kotak', 'paket'),
(3, 'Nasi Kuning', 13000, 15, 'nasi-kuning-rice-cooker.jpg', 'Nasi kuning Himalaya', 'kotak', 'paket'),
(4, 'Opor Ayam', 10000, 15, 'Resep-Opor-Ayam.jpg', 'Opor Ayam Bali', 'kotak', 'paket'),
(5, 'Sate', 10000, 15, 'Sate_Ponorogo.jpg', 'Sate Ponorogo', 'kotak', 'paket'),
(6, 'Prasmanan 1', 20000, 1, 'prasmanan_1.jpeg', 'menu prasmanan ada lombok, ayam, kacang, rempah rempah', 'porsi', 'prasmanan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_bayar`
--
ALTER TABLE `tb_bayar`
  ADD PRIMARY KEY (`tipe_bayar`);

--
-- Indexes for table `tb_detail_produk`
--
ALTER TABLE `tb_detail_produk`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `nota_produk` (`nota_produk`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD PRIMARY KEY (`nota_pemesanan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_detail_produk`
--
ALTER TABLE `tb_detail_produk`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_detail_produk`
--
ALTER TABLE `tb_detail_produk`
  ADD CONSTRAINT `tb_detail_produk_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detail_produk_ibfk_3` FOREIGN KEY (`nota_produk`) REFERENCES `tb_pemesanan` (`nota_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD CONSTRAINT `tb_pemesanan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
