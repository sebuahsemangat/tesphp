-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2023 at 05:06 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

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
  `nama` varchar(50) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `hasil` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id`, `id_soal`, `nama`, `kelas`, `hasil`) VALUES
(3, 1, 'ORANG', 'acp', '<?php\r\necho \"Hai\";\r\n?>');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL,
  `soal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `soal`) VALUES
(1, 'Buat sebuah variabel dengan nama $teks.\r\n<br>\r\nIsi nilai variabel dengan nilai \"katak\". <br>\r\nMasukkan variabel ke dalam fungsi if untuk menentukan apaka kata tersebut merupakan kata palindrome atau bukan.\r\n<br>Output yang dihasilkan adalah:\r\n<br>\r\n<b>Ini merupakan kata palindrome</b> atau <b>ini bukan kata palindrome</b>'),
(2, 'Buat sebuah variabel dengan nama $angka. Isi angka tesebut dengan tanggal hari ini. Masukkan variabel di atas ke dalam fungsi if dengan ketentuan:\r\n<br>\r\n<ul>\r\n<li>Jika $angka kurang dari 0 maka akan muncul teks \"Ini angka negatif\"\r\n</li>\r\n<li>Jika $angka lebih dari 0 maka akan muncul teks \"Ini angka positif\"\r\n</li>\r\n<li>Jika $angka sams dengan 0 maka akan muncul teks \"Ini angka nol\"\r\n</li>\r\n</ul>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
