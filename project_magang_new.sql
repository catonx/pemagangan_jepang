-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 03, 2018 at 08:44 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_magang`
--

-- --------------------------------------------------------

--
-- Table structure for table `hasil_fisik`
--

DROP TABLE IF EXISTS `hasil_fisik`;
CREATE TABLE `hasil_fisik` (
  `lari` varchar(3) NOT NULL,
  `push_up` varchar(3) NOT NULL,
  `sit_up` varchar(3) NOT NULL,
  `id_member` int(11) NOT NULL,
  `ket` enum('Lulus','Tidak Lulus','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil_fisik`
--

INSERT INTO `hasil_fisik` (`lari`, `push_up`, `sit_up`, `id_member`, `ket`) VALUES
('15', '35', '25', 2, 'Lulus'),
('10', '35', '35', 1, 'Lulus'),
('15', '35', '25', 4, 'Lulus');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_kesemaptaan`
--

DROP TABLE IF EXISTS `hasil_kesemaptaan`;
CREATE TABLE `hasil_kesemaptaan` (
  `tinggi` varchar(3) NOT NULL,
  `berat` varchar(3) NOT NULL,
  `bertato` enum('Ya','Tidak') NOT NULL,
  `bertindik` enum('Ya','Tidak') NOT NULL,
  `cacat_tubuh` enum('Ya','Tidak') NOT NULL,
  `patah_tulang` enum('Ya','Tidak') NOT NULL,
  `penyakit_kulit` enum('Ya','Tidak') NOT NULL,
  `id_member` int(11) NOT NULL,
  `ket` enum('Lulus','Tidak Lulus') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil_kesemaptaan`
--

INSERT INTO `hasil_kesemaptaan` (`tinggi`, `berat`, `bertato`, `bertindik`, `cacat_tubuh`, `patah_tulang`, `penyakit_kulit`, `id_member`, `ket`) VALUES
('170', '50', 'Tidak', 'Tidak', 'Tidak', 'Tidak', 'Tidak', 2, 'Lulus'),
('160', '50', 'Ya', 'Tidak', 'Tidak', 'Tidak', 'Ya', 1, 'Tidak Lulus'),
('160', '55', 'Tidak', 'Tidak', 'Tidak', 'Tidak', 'Tidak', 4, 'Lulus');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

DROP TABLE IF EXISTS `jadwal`;
CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `tgl` varchar(2) NOT NULL,
  `bln` varchar(20) NOT NULL,
  `thn` varchar(4) NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `publish` enum('Ya','Tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `tgl`, `bln`, `thn`, `provinsi`, `publish`) VALUES
(1, '3', 'Januari', '2018', 'Banten', 'Ya'),
(2, '2', 'Januari', '2018', 'DKI Jakarta', 'Ya'),
(3, '3', 'Januari', '2018', 'DKI Jakarta', 'Ya'),
(4, '4', 'Januari', '2018', 'DKI Jakarta', 'Ya'),
(5, '3', 'Februari', '2018', 'Jawa Barat', 'Ya'),
(6, '4', 'Februari', '2018', 'Jawa Barat', 'Ya'),
(7, '5', 'Februari', '2018', 'Jawa Barat', 'Ya'),
(8, '22', 'November', '2017', 'Jawa Barat', 'Ya'),
(9, '14', 'Desember', '2017', 'DKI Jakarta', 'Ya'),
(10, '31', 'Agustus', '2018', 'Lampung', 'Ya'),
(11, '15', 'Februari', '2018', 'DI Yogyakarta', 'Ya'),
(13, '3', 'Maret', '2018', 'DI Yogyakarta', 'Ya'),
(14, '12', 'Mei', '2018', 'DI Yogyakarta', 'Ya'),
(15, '31', 'Agustus', '2018', 'DI Yogyakarta', 'Ya');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

DROP TABLE IF EXISTS `jawaban`;
CREATE TABLE `jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `jawaban` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `id_soal`, `id_kategori`, `id_member`, `jawaban`) VALUES
(1, 11, 2, 1, 'B'),
(2, 12, 2, 1, 'A'),
(3, 13, 2, 1, 'C'),
(4, 14, 2, 1, 'C'),
(5, 15, 2, 1, 'B'),
(6, 16, 2, 1, 'D'),
(7, 17, 2, 1, 'B'),
(8, 18, 2, 1, 'A'),
(9, 19, 2, 1, 'D'),
(10, 20, 2, 1, 'B'),
(11, 11, 2, 4, 'D'),
(12, 12, 2, 4, 'D'),
(13, 13, 2, 4, 'C'),
(14, 14, 2, 4, 'D'),
(15, 15, 2, 4, 'C'),
(16, 16, 2, 4, 'D'),
(17, 17, 2, 4, 'D'),
(18, 18, 2, 4, 'D'),
(19, 19, 2, 4, 'D'),
(20, 20, 2, 4, 'D'),
(21, 1, 3, 4, 'C'),
(22, 2, 3, 4, 'D'),
(23, 3, 3, 4, 'D'),
(24, 4, 3, 4, 'D'),
(25, 5, 3, 4, 'D'),
(26, 6, 3, 4, 'C'),
(27, 7, 3, 4, 'D'),
(28, 8, 3, 4, 'D'),
(29, 9, 3, 4, 'D'),
(30, 10, 3, 4, 'D'),
(31, 21, 4, 4, 'A'),
(32, 22, 4, 4, 'D'),
(33, 23, 4, 4, 'D'),
(34, 24, 4, 4, 'D'),
(35, 25, 4, 4, 'D'),
(36, 26, 4, 4, 'D'),
(37, 27, 4, 4, 'C'),
(38, 28, 4, 4, 'D'),
(39, 29, 4, 4, 'D'),
(40, 0, 5, 4, ''),
(41, 0, 5, 4, ''),
(42, 0, 5, 4, ''),
(43, 0, 5, 4, ''),
(44, 0, 5, 4, ''),
(45, 0, 5, 4, ''),
(46, 0, 5, 4, ''),
(47, 0, 5, 4, ''),
(48, 11, 2, 5, 'D'),
(49, 20, 2, 5, 'A'),
(50, 12, 2, 5, 'B'),
(51, 13, 2, 5, 'A'),
(52, 14, 2, 5, 'C'),
(53, 15, 2, 5, 'A'),
(54, 16, 2, 5, 'B'),
(55, 17, 2, 5, 'A'),
(56, 18, 2, 5, 'A'),
(57, 19, 2, 5, 'B'),
(58, 1, 3, 5, 'A'),
(59, 2, 3, 5, 'B'),
(60, 2, 3, 5, 'B'),
(61, 3, 3, 5, 'A'),
(62, 4, 3, 5, 'C'),
(63, 5, 3, 5, 'A'),
(64, 6, 3, 5, 'C'),
(65, 7, 3, 5, 'A'),
(66, 8, 3, 5, 'B'),
(67, 9, 3, 5, 'A'),
(68, 10, 3, 5, 'B'),
(69, 41, 3, 5, 'B'),
(70, 41, 3, 5, 'A'),
(71, 41, 3, 5, 'A'),
(72, 41, 3, 5, 'A'),
(73, 41, 3, 5, 'C'),
(74, 41, 3, 5, 'A'),
(75, 41, 3, 5, 'C'),
(76, 1, 3, 5, 'C'),
(77, 1, 3, 5, 'B'),
(78, 11, 2, 7, 'B'),
(79, 12, 2, 7, 'C'),
(80, 13, 2, 7, 'B'),
(81, 14, 2, 7, 'D'),
(82, 15, 2, 7, 'D'),
(83, 16, 2, 7, 'C'),
(84, 17, 2, 7, 'B'),
(85, 18, 2, 7, 'C'),
(86, 19, 2, 7, 'D'),
(87, 20, 2, 7, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `ket` text NOT NULL,
  `waktu` int(3) NOT NULL,
  `nilai_min` int(11) NOT NULL,
  `publish` enum('Ya','Tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `ket`, `waktu`, `nilai_min`, `publish`) VALUES
(2, 'Tingkat 1', '<p>kerjakan soal tersebut mulai dari yang termudah dahulu</p>', 2, 4, 'Ya'),
(3, 'Tingkat 2', '<p>kerjakan soal tersebut mulai dari yang termudah dahulu</p>', 3, 4, 'Ya'),
(4, 'Tingkat 3', '<p>kerjakan soal tersebut mulai dari yang termudah dahulu</p>', 4, 3, 'Ya'),
(5, 'Tingkat 4', '<p>kerjakan soal tersebut mulai dari yang termudah dahulu</p>', 6, 3, 'Ya');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `agama` varchar(20) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` varchar(20) DEFAULT NULL,
  `alamat` text,
  `hp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `foto` varchar(20) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `th_pelaksanaan` varchar(4) DEFAULT NULL,
  `id_jadwal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `nama`, `kelamin`, `agama`, `tempat_lahir`, `tgl_lahir`, `alamat`, `hp`, `email`, `password`, `foto`, `provinsi`, `th_pelaksanaan`, `id_jadwal`) VALUES
(4, 'imam', 'Laki-laki', 'Islam', 'Lampung', '29-09-1991', 'jl.bandar lampung', '123456789', 'imam@email.com', '827ccb0eea8a706c4c34a16891f84e7b', '171220_103106.jpg', 'Lampung', '2017', 10),
(5, 'yanuar adhi', 'Laki-laki', 'Kristen Katolik', 'sleman', '23-01-1990', '12345', '123456', 'yanuar@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '180215_111001.JPG', 'DI Yogyakarta', '2018', 11),
(6, 'hoho', NULL, '', '', '', '', '12345', '123@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', 0),
(7, 'adhi', 'Laki-laki', 'Kristen Katolik', 'jogja', '23-01-1990', 'beran lor', '123456', 'adhi@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '180303_114235.jpg', 'DI Yogyakarta', '2018', 13),
(8, 'anton', 'Laki-laki', 'Kristen Katolik', 'sleman', '1990-01-23', '1234', '1234', '1234@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '', 'DI Yogyakarta', '2018', 0),
(10, 'Kibol', 'Laki-laki', 'Islam', 'Jakarta', '24-09-1989', 'jokja', '08111111111', 'kibi@kibol.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 'DI Yogyakarta', '2018', 15);

-- --------------------------------------------------------

--
-- Table structure for table `panduan`
--

DROP TABLE IF EXISTS `panduan`;
CREATE TABLE `panduan` (
  `id_panduan` int(11) NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `panduan`
--

INSERT INTO `panduan` (`id_panduan`, `isi`) VALUES
(0, '<h3>Panduan Penggunaan</h3>\r\n<p>&nbsp;</p>\r\n<p>- Lengkapi biodata terlebih dahulu pada menu <strong>Biodata</strong></p>\r\n<p>- Silahkan pilih tes yang akan anda kerjakan pada menu <strong>Soal Tes</strong>.</p>\r\n<p>- Jumlah soal dan waktu pengerjaan bisa berbeda pada masing-masing kategori tes.</p>\r\n<p>- Klik tombol <strong>Simpan</strong> setiap anda selesai menjawab.</p>\r\n<p>- Jika ragu anda bisa berpindah ke soal yang lain terlebih dahulu.</p>\r\n<p>- Anda masih bisa mengubah jawaban sebelum waktu habis atau sebelum menekan tombol <strong>Selesai</strong>.</p>\r\n<p>- Tekan tombol <strong>Selesai</strong> jika anda sudah yakin dengan semua jawaban anda.</p>\r\n<p>- Jika anda belum selesai hingga waktu habis, maka sistem akan menyimpan kondisi terakhir saat anda mengisi soal.</p>\r\n<p>&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

DROP TABLE IF EXISTS `provinsi`;
CREATE TABLE `provinsi` (
  `id_provinsi` int(11) NOT NULL,
  `nama_provinsi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id_provinsi`, `nama_provinsi`) VALUES
(1, 'Banten'),
(2, 'DKI Jakarta'),
(3, 'Jawa Barat'),
(4, 'Jawa Tengah'),
(5, 'Jawa Timur'),
(6, 'DI Yogyakarta'),
(7, 'Lampung'),
(8, 'Aceh'),
(9, 'Sumatra Barat'),
(10, 'Sumatra Utara'),
(11, 'Sumatra Selatan');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

DROP TABLE IF EXISTS `soal`;
CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `pilihan_a` varchar(100) NOT NULL,
  `pilihan_b` varchar(100) NOT NULL,
  `pilihan_c` varchar(100) NOT NULL,
  `pilihan_d` varchar(100) NOT NULL,
  `jawaban` enum('A','B','C','D') NOT NULL,
  `publish` enum('Ya','Tidak') NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `pertanyaan`, `pilihan_a`, `pilihan_b`, `pilihan_c`, `pilihan_d`, `jawaban`, `publish`, `id_kategori`) VALUES
(24, '2 1/4 : 4/11 =', '2 1/4', '6 3/16', '6 5/8', '36/44', 'B', 'Ya', 2),
(26, '0,875 : 1 1/4 =', '0,75', '0,70', '0,68', '0,56', 'B', 'Ya', 2),
(28, '304,09 : 64,7 =', '0,407', '4,07', '4,70', '0,47', 'C', 'Ya', 2),
(42, '755 + 379 =', '1034', '1134', '1124', '1024', 'B', 'Ya', 2),
(43, '5323 - 3279 =', '2054', '2064', '2144', '2044', 'D', 'Ya', 2),
(44, '817 + 568 =', '1285', '1375', '1385', '1275', 'C', 'Ya', 2),
(45, '7259 - 5693 =', '1566', '1666', '1576', '2566', 'A', 'Ya', 2),
(46, '240 : 15 =', '15', '16', '17', '18', 'B', 'Ya', 2),
(47, '221 : 17 =', '11', '12', '13', '14', 'C', 'Ya', 2),
(48, '335 x 82 =', '27570', '26470', '26570', '27470', 'D', 'Ya', 2),
(49, '278 x 56 =', '15568', '15658', '16558', '16568', 'A', 'Ya', 2),
(50, '2/9 + 2/8 =', '4/72', '17/36', '16/18', '4/17', 'B', 'Ya', 2),
(51, '1/12 + 1/10 =', '30/60', '2/22', '1/60', '11/60', 'D', 'Ya', 2),
(52, 'rata - rata dari 13+57+45+125 adalah', '50', '55', '60', '65', 'C', 'Ya', 3),
(53, 'rata - rata dari 23+55+75+117 adalah', '67.5', '68', '68.5', '69', 'A', 'Ya', 3),
(54, '126 peserta lulus dari total 216. berapa % peserta yang lulus?', '25%', '50%', '75%', '100%', 'C', 'Ya', 3),
(55, '62 peserta lulus dari total 248. berapa % peserta yang lulus?', '25%', '50%', '75%', '100%', 'A', 'Ya', 3),
(56, 'Data tinggi peserta adalah 168, 169, 170, 171, 171, 169, 170, 170, 168. berapakah nilai tengah data tersebut?', '168', '169', '170', '171', 'C', 'Ya', 3),
(57, 'Data nilai peserta adalah 68, 69, 70, 71, 71, 69, 70, 70, 68. berapakah nilai tengah data tersebut?', '71', '70', '69', '68', 'B', 'Ya', 3),
(58, 'Data tinggi peserta adalah 168, 169, 170, 171, 171, 169, 170, 170, 168. berapakah tinggi yang sering muncul dari data tersebut?', '170', '171', '169', '168', 'A', 'Ya', 3),
(59, 'Data nilai peserta adalah 68, 69, 70, 71, 71, 69, 70, 70, 68. berapakah nilai peserta yang sering muncul dari data tersebut?', '69', '68', '71', '70', 'D', 'Ya', 3),
(60, 'Luas bangun persegi panjang dengan panjang 19 cm dan lebar 13 cm adalah', '247', '227', '274', '272', 'A', 'Ya', 4),
(61, 'Luas bangun persegi panjang dengan panjang 17 cm dan lebar 12 cm adalah', '214', '204', '224', '222', 'B', 'Ya', 4),
(62, 'Luas segitiga sama sisi dengan alas 11 cm dan tinggi 9 cm adalah', '46.5', '48.5', '47.5', '49.5', 'D', 'Ya', 4),
(63, 'Luas segitiga sama sisi dengan alas 16 cm dan tinggi 13 cm adalah', '104', '94', '114', '124', 'A', 'Ya', 4),
(64, 'Volume balok dengan panjang 10 cm, lebar 4 cm dan tinggi 3 cm adalah', '100', '160', '120', '140', 'C', 'Ya', 4),
(65, 'Volume balok dengan panjang 12 cm, lebar 7 cm dan tinggi 5 cm adalah', '420', '410', '400', '430', 'A', 'Ya', 4),
(66, 'Keliling lingkaran dengan jari-jari 13 cm adalah', '80.70', '81.70', '80.71', '81.71', 'D', 'Ya', 4),
(67, 'Keliling lingkaran dengan jari-jari 11 cm adalah', '68.14', '69.14', '68.12', '69.12', 'B', 'Ya', 4),
(68, 'Waktu liburan musim panas, Rudy membeli jaket seharga Rp 450,000,- dan mendapatkan potongan harga sebesar 15 %. Berapa besar uang yang harus Rudy bayar?', 'Rp 350.000,-', 'Rp 372.500,-', 'Rp 382.500,-', '390.000,-', 'C', 'Ya', 5),
(69, 'Dadan bekerja di sebuah perusahaan pemotongan baja. Dadan diperintah oleh atasan untuk memotong besi yang panjangnya 11 meter untuk di potong menjadi 5 bagian dengan panjang yang sama. Berapa cm kah besi yang harus dipotong Dadan untuk masing - masing bagian ?', '220 cm', '120 cm', '320 cm', '250 cm', 'A', 'Ya', 5),
(70, 'Ibu membeli telur sebanyak 8 kg dengan harga Rp 13,000,-/ kg. Ibu membayar dengan 1 lembar uang Rp 100.000,- dan 1 lembar uang Rp 50.000,-. Berapa uang kembalian yang harus ibu terima?', 'Rp. 40.000,-', 'Rp 50.000,-', 'Rp 38.000,-', 'Rp 46.000,-', 'D', 'Ya', 5),
(71, 'Seorang peserta magang mendapatkan perintah dari atasan untuk mencampur bahan cat sebanyak 5 liter di tambah 500 ml cairan tiner  untuk mendapatkan campuran cat siap pakai. Menjadi berapa literkah campuran cat tersebut?', '5.5 liter', '5.05 liter', '0.5 liter', '0.55 liter', 'A', 'Ya', 5),
(72, 'Waktu liburan musim panas, Rudy membeli sepatu seharga Rp 750,000,- dan mendapatkan potongan harga sebesar 25 %. Berapa besar uang yang harus Rudy bayar?', 'Rp 550.000,-', 'Rp 562.500,-', 'Rp 575.000,-', 'Rp 582.500,-', 'B', 'Ya', 5),
(73, 'Dadan bekerja di sebuah perusahaan pemotongan baja. Dadan diperintah oleh atasan untuk memotong besi yang panjangnya 6 meter untuk di potong menjadi 5 bagian dengan panjang yang sama. Berapa cm kah besi yang harus dipotong Dadan untuk masing - masing bagian ?', '120 cm', '130 cm', '12 cm', '13 cm', 'A', 'Ya', 5),
(74, 'Ibu membeli gula sebanyak 16 kg dengan harga Rp 8,000,-/ kg. Ibu membayar dengan 1 lembar uang Rp 100.000,- dan 1 lembar uang Rp 50.000,-. Berapa uang kembalian yang harus ibu terima?', 'Rp 32.000,-', 'Rp 22.000,-', 'Rp 42.000,-', 'Rp 12.000,-', 'B', 'Ya', 5),
(75, 'Seorang peserta magang mendapatkan perintah dari atasan untuk mencampur bahan cat sebanyak 12,5 liter di tambah 1.500 ml cairan tiner  untuk mendapatkan campuran cat siap pakai. Menjadi berapa literkah campuran cat tersebut?', '13.5 liter', '12.5 liter', '13 liter', '14 liter', 'D', 'Ya', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tentang`
--

DROP TABLE IF EXISTS `tentang`;
CREATE TABLE `tentang` (
  `id_tentang` int(3) NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tentang`
--

INSERT INTO `tentang` (`id_tentang`, `isi`) VALUES
(1, '<p>jhfjwhaskjdfnjkcnaisndcji sdjbfiuerhansjvcnjanficvdsn ancdaebnlfvc</p>\r\n<p>&nbsp;</p>\r\n<p>bajvceailhdsvjkcnealijndvcjknalndv</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>nvlafnlisjnfcjaerilcvn</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tes_fisik`
--

DROP TABLE IF EXISTS `tes_fisik`;
CREATE TABLE `tes_fisik` (
  `id_tes` int(11) NOT NULL,
  `lari` varchar(3) NOT NULL,
  `push_up` varchar(3) NOT NULL,
  `sit_up` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tes_fisik`
--

INSERT INTO `tes_fisik` (`id_tes`, `lari`, `push_up`, `sit_up`) VALUES
(1, '15', '35', '25');

-- --------------------------------------------------------

--
-- Table structure for table `tes_kesemaptaan`
--

DROP TABLE IF EXISTS `tes_kesemaptaan`;
CREATE TABLE `tes_kesemaptaan` (
  `id_tes` int(11) NOT NULL,
  `tinggi` varchar(3) NOT NULL,
  `berat` varchar(3) NOT NULL,
  `bertato` enum('Ya','Tidak') NOT NULL,
  `bertindik` enum('Ya','Tidak') NOT NULL,
  `cacat_tubuh` enum('Ya','Tidak') NOT NULL,
  `patah_tulang` enum('Ya','Tidak') NOT NULL,
  `penyakit_kulit` enum('Ya','Tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tes_kesemaptaan`
--

INSERT INTO `tes_kesemaptaan` (`id_tes`, `tinggi`, `berat`, `bertato`, `bertindik`, `cacat_tubuh`, `patah_tulang`, `penyakit_kulit`) VALUES
(5, '160', '50', 'Tidak', 'Tidak', 'Tidak', 'Tidak', 'Tidak');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` enum('Admin','Staff') NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tlp` varchar(20) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `nama_lengkap`, `email`, `tlp`, `last_login`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'yanuar', 'yanuar.adhi.nugroho@gmail.com', '085643707015', '2018-08-31 00:16:35'),
(2, 'staff1', '4d7d719ac0cf3d78ea8a94701913fe47', 'Staff', 'hoho', 'hoho@gmail.com', '081931781176', '2018-05-23 23:07:26'),
(3, 'yanhoho', '94fced7d9e42731aea466c6fd447d73a', 'Admin', 'YANUAR ADHI NUGROHO', 'yanuar.adhi.nugroho@gmail.com', '085643707015', '2018-05-23 23:13:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id_provinsi`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `tentang`
--
ALTER TABLE `tentang`
  ADD PRIMARY KEY (`id_tentang`);

--
-- Indexes for table `tes_fisik`
--
ALTER TABLE `tes_fisik`
  ADD PRIMARY KEY (`id_tes`);

--
-- Indexes for table `tes_kesemaptaan`
--
ALTER TABLE `tes_kesemaptaan`
  ADD PRIMARY KEY (`id_tes`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id_provinsi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tentang`
--
ALTER TABLE `tentang`
  MODIFY `id_tentang` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tes_fisik`
--
ALTER TABLE `tes_fisik`
  MODIFY `id_tes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tes_kesemaptaan`
--
ALTER TABLE `tes_kesemaptaan`
  MODIFY `id_tes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
