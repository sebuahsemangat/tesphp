-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2024 at 01:30 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tesphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `jawaban` text NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id`, `id_soal`, `id_siswa`, `jawaban`, `nilai`) VALUES
(4, 1, 1, '<?php\r\necho \"Hello World\";\r\n?>', 100);

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `jawaban` text NOT NULL,
  `jawaban_bersih` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `id_soal`, `jawaban`, `jawaban_bersih`) VALUES
(1, 1, '<?php\r\necho \"Hello World\";\r\n?>', 'echo\"HelloWorld\";'),
(2, 1, '<?= \"Hello World\"; ?>', '\"HelloWorld\";'),
(3, 1, '<?php\r\nprint \"Hello World\";\r\n?>', 'print\"HelloWorld\";');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `status`) VALUES
(1, 'X-R1', 'aktif'),
(2, 'X-R2', 'aktif'),
(3, 'X-R3', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nama`, `password`, `id_kelas`) VALUES
(1, '123456789', 'Apep Wahyudin', '3449cf29b6c2f4bb7892d5c7694ea81f', 1),
(3, '23241002', 'AHMAD KAMALUDDIN HUSNI MUBARAK', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(4, '23241003', 'AILEEN LINTANG PRAMESTI', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(5, '23241004', 'ANDRE SUTISNA AGUSTIN ', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(6, '23241005', 'ARISKA APRILYANI SUPRIATNA', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(7, '23241006', 'AZIS IRSYAD MAULANA ', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(8, '23241007', 'DEA NOVIYANTI', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(9, '23241008', 'DENDA FEBRIANA ', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(10, '23241009', 'DIAN MUTIANI ', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(11, '23241010', 'DITO MAHARDIKA RAMADHAN ', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(12, '23241011', 'ENOK NURHASANAH', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(13, '23241012', 'FATHIR FADZILAH ADZ DZIKRI', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(14, '23241013', 'FITRIANI KHOIRUNNISA', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(15, '23241014', 'IKHSAN GUSTANI ARIFIN', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(16, '23241015', 'ILHAM FAJAR PERMANA', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(17, '23241016', 'IRVAN SHARIPUDIN', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(18, '23241017', 'JEAL ANGGRAENI', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(19, '23241018', 'MOH. IHSAN JULIAN AL-SIDIK', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(20, '23241019', 'MUHAMAD IQBAL FIRMANSYAH', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(21, '23241020', 'MUHAMMAD FAREL HERMANSYAH ', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(22, '23241021', 'MUHAMMAD HADI NUR HIDAYAT', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(23, '23241022', 'NABILA ASY SYARA GEANOVA', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(24, '23241023', 'NAZILA NUR HAIDA ', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(25, '23241024', 'NUR ARBY PUTRA ', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(26, '23241025', 'NURHAYATI', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(27, '23241026', 'RAISYA ALIFA AYU ANDJANI ', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(28, '23241027', 'RANGGA HADI KUSUMAH ', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(29, '23241028', 'REYVAN ALFA REZKY KENCANA ', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(30, '23241029', 'RHISMA FAUZIAH', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(31, '23241030', 'RIZKI MAULANA PUTRA', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(32, '23241031', 'SALSABILA CHOSYAH', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(33, '23241032', 'SILVY NUR OKTAVIANY', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(34, '23241033', 'SRI SUCI GILANG CAHAYA', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(35, '23241034', 'SYIFA NURISMAN', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(36, '23241035', 'UFAS AMZANI ', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(37, '23241036', 'VIVIH TOFIA', '3c2aff0b6b69b6726a3e82d587174ccd', 1),
(38, '23241037', 'ADIS PRADISTA', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(39, '23241038', 'AHMAD REZA', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(40, '23241039', 'AISYA NURHOLIVAH', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(41, '23241040', 'ARGA NUGRAHA', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(42, '23241041', 'ARISYA NURZAHRA', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(43, '23241042', 'CENZHA MUHAMAD SAJJAD', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(44, '23241043', 'DEA RAHMAWATI', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(45, '23241044', 'DENIS AMERALDI ', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(46, '23241045', 'DIANDRA CINDY RAMADHANI ', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(47, '23241046', 'DIWAN', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(48, '23241047', 'ERNI DESTIANI', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(49, '23241048', 'FAUZAN NUR RIZKI', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(50, '23241049', 'HANA SHOFIANA SHOLIHAH', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(51, '23241050', 'IKHSAN MAULANA', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(52, '23241051', 'JEHAN APRILIYANTI ', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(53, '23241052', 'JUAN FADHILA SUDIA', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(54, '23241053', 'MAYA JULIANTI', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(55, '23241054', 'MUCHAMMAD HAICHALL AZIZ PRATAM', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(56, '23241055', 'MUHAMAD IRPAN PIRDAUS', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(57, '23241056', 'MUHAMAD TAZQI HAMDANI', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(58, '23241057', 'MUHAMMAD IRFAN LESMANA', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(59, '23241058', 'NADIA AGUSTINA', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(60, '23241059', 'NINDYA TITIS PURWATY', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(61, '23241060', 'NUR DENI SETIAWAN', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(62, '23241061', 'NURLAELA', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(63, '23241062', 'RAISYA NUR RISMAYANTI', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(64, '23241063', 'RANGGA UBAIDILLAH', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(65, '23241064', 'REYVAN DIVA PUTRA SUTARDI ', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(66, '23241065', 'RIMA ZESIKA', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(67, '23241066', 'RIZKI NUR FAUZI ', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(68, '23241067', 'SALWA NUR FIRDAUS ', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(69, '23241068', 'SINTA AMALIA DESWANTI PUTRI ', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(70, '23241069', 'SRI SULASTRI ', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(71, '23241070', 'TALIA RAHMAWATI', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(72, '23241071', 'WILDA FITRIANI', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(73, '23241072', 'WISNU DARMAWAN ', '3c2aff0b6b69b6726a3e82d587174ccd', 2),
(75, '23241073', 'ADIT DARMA WIGUNA', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(76, '23241074', 'AHMAD RIZKY ALGHONIYU ', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(77, '23241075', 'AKHIRA AZANING SUKMA', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(78, '23241076', 'APIN ADITYA SUHENDI', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(79, '23241077', 'ASTI JUNIANTI ', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(80, '23241078', 'DADAN JUANDA', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(81, '23241079', 'DEDEH LISNAWATI ANGGRAENI', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(82, '23241080', 'DERI ZAELANI ', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(83, '23241081', 'DINDA SRI ANDRIANI KOMARA', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(84, '23241082', 'DWIKI JULIANSYAH SUDRAJAT ', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(85, '23241083', 'EVA OKTARIA', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(86, '23241084', 'FAJAR FADILAH', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(87, '23241085', 'FIKRI OKTA PRATAMA', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(88, '23241086', 'HELMA LIAPUTRI ', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(89, '23241087', 'ILHAM AHMAD ZAKARIA', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(90, '23241088', 'JELITA KRISTIANTI', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(91, '23241089', 'KAKA MAULANA', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(92, '23241090', 'MAYA NUR FANTA ', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(93, '23241091', 'MUCHAMAD RAZIQIN BUDI SAPUTRA', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(94, '23241092', 'MUHAMAD AGUS PRASETYO ', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(95, '23241093', 'MUHAMAD RANGGA MAULANA', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(96, '23241094', 'MUHAMMAD RAKAN AL IMTIYAZ', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(97, '23241095', 'NADYA KAPORINA ', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(98, '23241096', 'NISA DINA FADILA', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(99, '23241097', 'PASHA FADILAH', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(100, '23241098', 'PEBRIANTI ANJANI PUTRI', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(101, '23241099', 'RASYAD FARRAS PRADIPA ', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(102, '23241100', 'RISKA DINI ROSIANA', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(103, '23241101', 'RIZKY MUHAMMAD SIDIQ', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(104, '23241102', 'SANYA DWI NOVIA ', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(105, '23241103', 'SINTIA FITRIANI', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(106, '23241104', 'SITI ZAQIAH', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(107, '23241105', 'SRI WULAN WAHYUNI', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(108, '23241106', 'THEA PUTRI ANANDA ', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(109, '23241107', 'WINDA VERLITA FEBRIYANTI ', '3c2aff0b6b69b6726a3e82d587174ccd', 3),
(110, '23241108', 'WISNU MUHAMMAD SIDIK', '3c2aff0b6b69b6726a3e82d587174ccd', 3);

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `soal` text NOT NULL,
  `waktu` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `id_ujian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `judul`, `soal`, `waktu`, `status`, `id_ujian`) VALUES
(1, 'Echo', 'Tampilkan teks \"Hello World\" di layar!', 0, 'aktif', 1),
(2, 'Positif/Negatif', 'Buat sebuah variabel dengan nama $angka. Isi angka tesebut dengan tanggal hari ini. Masukkan variabel di atas ke dalam fungsi if dengan ketentuan:\n<br>\n<ul>\n<li>Jika $angka kurang dari 0 maka akan muncul teks \"Ini angka negatif\"\n</li>\n<li>Jika $angka lebih dari 0 maka akan muncul teks \"Ini angka positif\"\n</li>\n<li>Jika $angka sams dengan 0 maka akan muncul teks \"Ini angka nol\"\n</li>\n</ul>', 0, 'aktif', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` int(11) NOT NULL,
  `nama_ujian` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ujian`
--

INSERT INTO `ujian` (`id_ujian`, `nama_ujian`, `status`, `id_kelas`) VALUES
(1, 'Ujian Materi Array', 'aktif', 1),
(2, 'Ujian Materi Operator', 'aktif', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23241073;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
