-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12 Jan 2017 pada 09.04
-- Versi Server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_hotelbalecatur`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id_admin` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` enum('1','2','3','4') NOT NULL,
  `status` enum('Y','N') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `level`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '1', 'N'),
(4, 'Simo', '827ccb0eea8a706c4c34a16891f84e7b', '4', 'N'),
(5, 'Arnis', '827ccb0eea8a706c4c34a16891f84e7b', '2', 'N'),
(6, 'Lia', '827ccb0eea8a706c4c34a16891f84e7b', '3', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akomodasi`
--

CREATE TABLE IF NOT EXISTS `akomodasi` (
`id_akomodasi` int(10) NOT NULL,
  `judul_akomodasi` varchar(100) NOT NULL,
  `ket_akomodasi` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akomodasi`
--

INSERT INTO `akomodasi` (`id_akomodasi`, `judul_akomodasi`, `ket_akomodasi`) VALUES
(1, 'Layanan Hotel & Fasilitas Hotel', '<p>- Internet wifi gratis</p>\r\n<p>- Ac</p>\r\n<p>- Shower air panas / dingin</p>\r\n<p>- Extrabed(Biaya Tambahan)</p>\r\n<p>- Parking</p>\r\n<p>- Restaurant</p>\r\n<p>- Meeting Room</p>\r\n<p>- Rent Car and Rent Motor Cycle (Biaya Tambahan)</p>\r\n<p>- Laundry (Biaya Tambahan)</p>\r\n<p>- Layanan Antar Jemput Bandara &amp; Stasiun (Biaya Tambahan)</p>');

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `kd_booking` varchar(10) NOT NULL,
  `id_member` varchar(20) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `tgl_booking` datetime NOT NULL,
  `layanan_extra` varchar(10) NOT NULL,
  `status_userbook` enum('BK','KF','LS','PP','CI','CO','RF') NOT NULL,
  `company_or_other` varchar(50) NOT NULL,
  `nama_atasnama` text NOT NULL,
  `berapa_orang` int(50) NOT NULL,
  `total_biayasewa` int(20) NOT NULL,
  `biaya_perpanjangan` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `booking`
--

INSERT INTO `booking` (`kd_booking`, `id_member`, `checkin`, `checkout`, `tgl_booking`, `layanan_extra`, `status_userbook`, `company_or_other`, `nama_atasnama`, `berapa_orang`, `total_biayasewa`, `biaya_perpanjangan`) VALUES
('4J8HA', '0001VLG', '2017-01-12', '2017-01-13', '2017-01-12 00:44:25', 'Ya', 'KF', '-', '-', 1, 220000, 0),
('CKAXX', '0002G58', '2017-01-05', '2017-01-06', '2017-01-05 09:49:12', 'Tidak', 'BK', '-', '-', 1, 220000, 0),
('CMUR7', '0001VLG', '2016-12-29', '2016-12-30', '2016-12-29 11:45:26', 'Tidak', 'CO', '-', '-', 1, 467500, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_booking_kamar`
--

CREATE TABLE IF NOT EXISTS `detail_booking_kamar` (
`id_detail_booking_kamar` int(10) NOT NULL,
  `kd_booking` varchar(30) NOT NULL,
  `id_kategori_kamar` varchar(20) NOT NULL,
  `id_kamar` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_booking_kamar`
--

INSERT INTO `detail_booking_kamar` (`id_detail_booking_kamar`, `kd_booking`, `id_kategori_kamar`, `id_kamar`) VALUES
(3, 'CMUR7', 'STNDR', 'KMR005'),
(4, 'CMUR7', 'DELX', 'KMR005'),
(5, 'CKAXX', 'DELX', ''),
(18, '4J8HA', 'DELX', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_booking_rental`
--

CREATE TABLE IF NOT EXISTS `detail_booking_rental` (
`id_detail_booking_rental` int(10) NOT NULL,
  `kd_booking` varchar(30) NOT NULL,
  `id_rental` int(10) NOT NULL,
  `tgl_awal_sewa` date NOT NULL,
  `tgl_akhir_sewa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_paket`
--

CREATE TABLE IF NOT EXISTS `detail_paket` (
`id_detail_paket` int(10) NOT NULL,
  `id_paket` varchar(20) NOT NULL,
  `keterangan_menunya` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_paket`
--

INSERT INTO `detail_paket` (`id_detail_paket`, `id_paket`, `keterangan_menunya`) VALUES
(12, '5', '<p>capcay&nbsp;</p>\r\n<p>nasi goreng</p>\r\n<p>bihun</p>\r\n<p>telur dadar</p>'),
(13, '6', 'Lalapan, Gudeg ,mie goreng '),
(14, '7', 'Lalapan, Gudeg ,mie goreng');

-- --------------------------------------------------------

--
-- Struktur dari tabel `diskon`
--

CREATE TABLE IF NOT EXISTS `diskon` (
`id_diskon` int(10) NOT NULL,
  `id_kategori_kamar` varchar(20) NOT NULL,
  `besar_diskon` varchar(10) NOT NULL,
  `dari_tgl` date NOT NULL,
  `sampai_tgl` date NOT NULL,
  `keterangan_diskon` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `diskon`
--

INSERT INTO `diskon` (`id_diskon`, `id_kategori_kamar`, `besar_diskon`, `dari_tgl`, `sampai_tgl`, `keterangan_diskon`) VALUES
(3, 'DELX', '30', '2016-09-08', '2016-09-10', 'Independent Day');

-- --------------------------------------------------------

--
-- Struktur dari tabel `extrabed`
--

CREATE TABLE IF NOT EXISTS `extrabed` (
`id_extrabed` int(10) NOT NULL,
  `harga_extrabed` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `extrabed`
--

INSERT INTO `extrabed` (`id_extrabed`, `harga_extrabed`) VALUES
(1, '75000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
`id_gallery` int(10) NOT NULL,
  `foto_gallery` varchar(100) NOT NULL,
  `deskripsi_foto` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gallery`
--

INSERT INTO `gallery` (`id_gallery`, `foto_gallery`, `deskripsi_foto`) VALUES
(38, 'balecatur resto.jpg', 'asagdgf'),
(39, 'dalem baleresto.jpg', 'gghghgh'),
(40, 'resto dalem.png', 'ggfggf'),
(41, 'deluxe family bath.jpg', 'hjhjkhhkj'),
(42, 'deluxe family room view.jpg', 'hjghjghgj'),
(43, 'front officer.jpg', 'dasdas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE IF NOT EXISTS `kamar` (
  `id_kamar` varchar(10) NOT NULL,
  `id_kategori_kamar` varchar(20) NOT NULL,
  `status_kamar` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `id_kategori_kamar`, `status_kamar`) VALUES
('KMR001', 'STNDR', '0'),
('KMR002', 'STNDR', '2'),
('KMR003', 'STNDR', '1'),
('KMR004', 'STNDR', '0'),
('KMR005', 'STNDR', '2'),
('KMR006', 'DELX', '2'),
('KMR007', 'DELX', '2'),
('KMR008', 'DELX', '2'),
('KMR009', 'DELX', '1'),
('KMR010', 'STNDR', '2'),
('KMR011', 'DELXFAM', '1'),
('KMR012', 'DELXFAM', '1'),
('KMR013', 'DELXFAM', '0'),
('KMR014', 'STNDR', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_kamar`
--

CREATE TABLE IF NOT EXISTS `kategori_kamar` (
  `id_kategori_kamar` varchar(20) NOT NULL,
  `type_kamar` varchar(20) NOT NULL,
  `jumlah_kamar` int(10) NOT NULL,
  `jumlah_kamar_akhir` int(10) NOT NULL,
  `foto_kamar` text NOT NULL,
  `fasilitas` text NOT NULL,
  `deskripsi` text NOT NULL,
  `tarif` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_kamar`
--

INSERT INTO `kategori_kamar` (`id_kategori_kamar`, `type_kamar`, `jumlah_kamar`, `jumlah_kamar_akhir`, `foto_kamar`, `fasilitas`, `deskripsi`, `tarif`) VALUES
('DELX', 'Deluxe Room', 4, 1, '699920deluxe room.jpg', 'AC, Tv Cable, Shower Warm / Cold, Free WIFI, Shampoo, Body Shoap,Toothbrush and/or Toothpaste', 'Kenyamanan extra dengan konsep elegant serta fasilitas yang ditawarkan yang memadai cocok bagi anda yang menginap dengan nuansa yang klasik dengan alam. ukuran ruangan 3,25 x 4m', '275000'),
('DELXFAM', 'Deluxe Family Room', 3, 3, '391601deluxe family room.jpg', 'AC, Tv Cable, Shower Warm / Cold, Free WIFI, Shampoo, Body Shoap,Toothbrush and/or Toothpaste', 'Kenyamanan extra dengan konsep elegant serta fasilitas yang ditawarkan yang memadai cocok bagi anda yang menginap dengan nuansa yang klasik dengan alam.', '350000'),
('STNDR', 'Standart Room', 7, 5, '732971Standartroom.jpg', 'AC, Tv Cable, Shower Cold, Free WIFI, Shampoo, Body Shoap,Toothbrush and/or Toothpaste', 'Kenyamanan extra dengan konsep elegant serta fasilitas yang ditawarkan yang memadai cocok bagi anda yang menginap dengan nuansa yang klasik dengan alam.', '225000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `knfrimasi_pmbyaran`
--

CREATE TABLE IF NOT EXISTS `knfrimasi_pmbyaran` (
`id_knfrimasi_pmbyaran` int(10) NOT NULL,
  `kd_booking` varchar(30) NOT NULL,
  `id_member` varchar(20) NOT NULL,
  `cara_bayar` enum('Transfer') NOT NULL,
  `jenis_bank` varchar(20) NOT NULL,
  `jumlah_bayar` int(20) NOT NULL,
  `pelunasan` enum('DP','LUNAS') NOT NULL,
  `bukti_pembayaran` varchar(20) NOT NULL,
  `tgl_bayar` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `knfrimasi_pmbyaran`
--

INSERT INTO `knfrimasi_pmbyaran` (`id_knfrimasi_pmbyaran`, `kd_booking`, `id_member`, `cara_bayar`, `jenis_bank`, `jumlah_bayar`, `pelunasan`, `bukti_pembayaran`, `tgl_bayar`) VALUES
(3, 'CMUR7', '0001VLG', 'Transfer', 'BNI', 467500, 'LUNAS', '3410643.jpg', '2016-12-29 11:45:47'),
(4, '4J8HA', '0001VLG', 'Transfer', 'BNI', 66000, 'DP', '85876dimas.jpg', '2017-01-12 01:02:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laundry`
--

CREATE TABLE IF NOT EXISTS `laundry` (
`id_laundry` int(10) NOT NULL,
  `jenis_laundry` varchar(10) NOT NULL,
  `harga_laundry` varchar(10) NOT NULL,
  `ket_laundry` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laundry`
--

INSERT INTO `laundry` (`id_laundry`, `jenis_laundry`, `harga_laundry`, `ket_laundry`) VALUES
(1, 'Biasa', '80000', 'fdsfsdfsd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id_member` varchar(20) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kebangsaan` varchar(30) NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') NOT NULL,
  `jenis_identitas` varchar(20) NOT NULL,
  `identitas_user` varchar(20) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `foto_identitas` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id_member`, `nama_lengkap`, `password`, `email`, `alamat`, `kebangsaan`, `jenis_kelamin`, `jenis_identitas`, `identitas_user`, `no_telp`, `foto_identitas`, `foto`) VALUES
('0001VLG', 'Dimas Prasetyo', '827ccb0eea8a706c4c34a16891f84e7b', 'dimasprasetyo485@gmail.com', 'perum gkp sedayu bantul ', 'Indonesia', 'Pria', 'KTP', '0864564564565', '08756757657', '883880scan-ktp.jpg', '830627dimas.jpg'),
('0002G58', 'Gandi Prasetyo', '827ccb0eea8a706c4c34a16891f84e7b', 'gandiprasetyo@gmail.com', 'sdasdasdsad', 'Indonesia', 'Pria', 'KTP', '5463246755434534', '08965462343', 'ktp-cantik_20160830_191845.jpg', 'dimas.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE IF NOT EXISTS `paket` (
`id_paket` int(11) NOT NULL,
  `nama_paket` varchar(20) NOT NULL,
  `harga_paket` int(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `harga_paket`) VALUES
(5, 'A1', 70000),
(6, 'A2', 80000),
(7, 'A3', 87000),
(8, 'A4', 70000),
(9, 'A5', 76000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rental`
--

CREATE TABLE IF NOT EXISTS `rental` (
`id_rental` int(11) NOT NULL,
  `kate_kendaraan` varchar(20) NOT NULL,
  `nama_kendaraan` varchar(20) NOT NULL,
  `harga_kendaraan` varchar(20) NOT NULL,
  `foto_kendaraan` varchar(30) NOT NULL,
  `ket_kendaraan` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rental`
--

INSERT INTO `rental` (`id_rental`, `kate_kendaraan`, `nama_kendaraan`, `harga_kendaraan`, `foto_kendaraan`, `ket_kendaraan`) VALUES
(2, 'Mobil', 'Avanza', '250000', '326568avanza all new.jpg', 'asdasdasd'),
(3, 'Motor', 'Revo', '100000', '461486263336revo.jpg', 'Untuk mahasisiwa korting diskon 10% \r\n- Syarat memiliki kTP\r\n- Atau melampirkan Bukti KTM (Kartu Mahasiswa)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_checkin`
--

CREATE TABLE IF NOT EXISTS `temp_checkin` (
`id_tempcheckin` int(10) NOT NULL,
  `kd_booking` varchar(20) NOT NULL,
  `id_kamar` varchar(20) NOT NULL,
  `tgl_checkin_now` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `temp_checkin`
--

INSERT INTO `temp_checkin` (`id_tempcheckin`, `kd_booking`, `id_kamar`, `tgl_checkin_now`) VALUES
(27, 'CMUR7', 'KMR006', '2016-12-29 11:47:34'),
(28, 'CMUR7', 'KMR005', '2016-12-29 11:47:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimonial`
--

CREATE TABLE IF NOT EXISTS `testimonial` (
`id_testimonial` int(10) NOT NULL,
  `id_member` varchar(30) NOT NULL,
  `keterangan_testi` text NOT NULL,
  `tgl_testi` date NOT NULL,
  `blokir_testi` enum('Y','N') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `testimonial`
--

INSERT INTO `testimonial` (`id_testimonial`, `id_member`, `keterangan_testi`, `tgl_testi`, `blokir_testi`) VALUES
(3, '0001VLG', 'Pegawainya ramah, helpfull. Kemarin mau menggabungkan twin bed karena single bed nya tdk available. Sayang parkiran mobilnya klo hujan menggenang, dan tidak ada jalan yg terlindung hujan jika dr parkiran mobil ke pintu samping. Selebihnya, worth untuk menginap disana. Happy holiday.', '2016-12-19', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_layanan`
--

CREATE TABLE IF NOT EXISTS `transaksi_layanan` (
`id_transaksi_layanan` int(10) NOT NULL,
  `kd_booking` varchar(30) NOT NULL,
  `id_rental` int(10) NOT NULL,
  `id_laundry` int(10) NOT NULL,
  `id_extrabed` int(10) NOT NULL,
  `id_paket` int(10) NOT NULL,
  `tgl_transaksi` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_layanan`
--

INSERT INTO `transaksi_layanan` (`id_transaksi_layanan`, `kd_booking`, `id_rental`, `id_laundry`, `id_extrabed`, `id_paket`, `tgl_transaksi`) VALUES
(9, '4J8HA', 0, 0, 1, 0, '2017-01-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `akomodasi`
--
ALTER TABLE `akomodasi`
 ADD PRIMARY KEY (`id_akomodasi`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
 ADD PRIMARY KEY (`kd_booking`);

--
-- Indexes for table `detail_booking_kamar`
--
ALTER TABLE `detail_booking_kamar`
 ADD PRIMARY KEY (`id_detail_booking_kamar`);

--
-- Indexes for table `detail_booking_rental`
--
ALTER TABLE `detail_booking_rental`
 ADD PRIMARY KEY (`id_detail_booking_rental`);

--
-- Indexes for table `detail_paket`
--
ALTER TABLE `detail_paket`
 ADD PRIMARY KEY (`id_detail_paket`);

--
-- Indexes for table `diskon`
--
ALTER TABLE `diskon`
 ADD PRIMARY KEY (`id_diskon`);

--
-- Indexes for table `extrabed`
--
ALTER TABLE `extrabed`
 ADD PRIMARY KEY (`id_extrabed`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
 ADD PRIMARY KEY (`id_gallery`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
 ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `kategori_kamar`
--
ALTER TABLE `kategori_kamar`
 ADD PRIMARY KEY (`id_kategori_kamar`);

--
-- Indexes for table `knfrimasi_pmbyaran`
--
ALTER TABLE `knfrimasi_pmbyaran`
 ADD PRIMARY KEY (`id_knfrimasi_pmbyaran`);

--
-- Indexes for table `laundry`
--
ALTER TABLE `laundry`
 ADD PRIMARY KEY (`id_laundry`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
 ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
 ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `rental`
--
ALTER TABLE `rental`
 ADD PRIMARY KEY (`id_rental`);

--
-- Indexes for table `temp_checkin`
--
ALTER TABLE `temp_checkin`
 ADD PRIMARY KEY (`id_tempcheckin`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
 ADD PRIMARY KEY (`id_testimonial`);

--
-- Indexes for table `transaksi_layanan`
--
ALTER TABLE `transaksi_layanan`
 ADD PRIMARY KEY (`id_transaksi_layanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `akomodasi`
--
ALTER TABLE `akomodasi`
MODIFY `id_akomodasi` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `detail_booking_kamar`
--
ALTER TABLE `detail_booking_kamar`
MODIFY `id_detail_booking_kamar` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `detail_booking_rental`
--
ALTER TABLE `detail_booking_rental`
MODIFY `id_detail_booking_rental` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `detail_paket`
--
ALTER TABLE `detail_paket`
MODIFY `id_detail_paket` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `diskon`
--
ALTER TABLE `diskon`
MODIFY `id_diskon` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `extrabed`
--
ALTER TABLE `extrabed`
MODIFY `id_extrabed` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
MODIFY `id_gallery` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `knfrimasi_pmbyaran`
--
ALTER TABLE `knfrimasi_pmbyaran`
MODIFY `id_knfrimasi_pmbyaran` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `laundry`
--
ALTER TABLE `laundry`
MODIFY `id_laundry` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `rental`
--
ALTER TABLE `rental`
MODIFY `id_rental` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `temp_checkin`
--
ALTER TABLE `temp_checkin`
MODIFY `id_tempcheckin` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
MODIFY `id_testimonial` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transaksi_layanan`
--
ALTER TABLE `transaksi_layanan`
MODIFY `id_transaksi_layanan` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
