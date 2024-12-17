-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 07:52 AM
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
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `username`, `password`, `nama`, `level`) VALUES
(1, 'apep', '$2y$10$VxEIwCbAq50askLjkJGQrO4knvRGl3VTyxdkp93fPITXsdAx/ocWq', 'Apep Wahyudin', 'guru'),
(2, 'anisa', '$2y$10$jWezqKTaNnYAfPJ2DA7SNu4aHACe.xpGPabksKq9S.A7oYAMSuStu', 'Anisa Ruhul Azizah', 'guru'),
(3, 'aku', '$2y$10$s5FJghuzyjY70ZXqmb79reYZk4KwjqWnLYCy7v1Jn7pK9FfSVd4Jm', 'Admin Ganteng', 'admin'),
(4, 'abizar', '$2y$10$SLp8lnksvvnzKCxpuaKS7OuKaATMeBTrlW6GsS1FuC0WytbHU8.EW', 'Abizar Hafiz Alfatih', 'guru'),
(5, 'guru', '$2y$10$a3R4gCW70ZMej3Ub4iy7x.7MVfdz28.xO2/0deKcEWU.sd5POM7Da', 'Guru', 'guru');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `jawaban` text NOT NULL,
  `test_result` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id`, `id_soal`, `id_ujian`, `id_siswa`, `jawaban`, `test_result`) VALUES
(1, 42, 15, 60, '&lt;?php\r\nfunction luas_persegi($sisi){\r\n    echo pow($sisi, 2);\r\n}\r\n      ', 'lulus'),
(2, 43, 15, 60, '&lt;?php\r\nfunction jalan_toll($jumlah_roda){\r\n  if($jumlah_roda &lt; 4) {\r\n      echo &quot;dilarang masuk&quot;;\r\n  }\r\n    else {\r\n        echo &quot;dilarang masuk&quot;;\r\n    }\r\n}\r\n      ', 'gagal'),
(3, 34, 16, 67, '&lt;?php\r\nfunction awal($arr){\r\n  return $arr[0];\r\n}\r\n      ', 'lulus'),
(4, 34, 16, 60, '&lt;?php\r\nfunction awal($arr){\r\n  return $arr[0];\r\n}\r\n      ', 'lulus'),
(5, 32, 16, 60, '&lt;?php\r\nfunction kembalian($uang, $harga){\r\n  return $uang - $harga;\r\n}\r\n      ', 'lulus');

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

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL,
  `id_guru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `status`, `id_guru`) VALUES
(1, 'X-R1', 'aktif', 1),
(2, 'X-R2', 'aktif', 1),
(3, 'X-R3', 'aktif', 1),
(4, 'X-R4', 'aktif', 1),
(5, 'X-R5', 'aktif', 1),
(6, 'X-R6', 'aktif', 1),
(7, 'X-R7', 'aktif', 1),
(8, 'X-R8', 'aktif', 1),
(9, 'X-R9', 'aktif', 1),
(10, 'X-R10', 'aktif', 1),
(11, 'X-ACP', 'aktif', 1),
(12, 'Kelas Tes', 'aktif', 5),
(13, 'Kelas Demo', 'aktif', 1);

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
(22, '85439276', 'Andi Setiawan', '$2y$10$7UDuy3jDdDc7Uyb//pb8kO84tccN/228HtM.jAELmvCNcCwEqt6tC', 12),
(23, '92315784', 'Rina Suryani', '$2y$10$7UDuy3jDdDc7Uyb//pb8kO84tccN/228HtM.jAELmvCNcCwEqt6tC', 12),
(24, '73645198', 'Agus Pranoto', '$2y$10$7UDuy3jDdDc7Uyb//pb8kO84tccN/228HtM.jAELmvCNcCwEqt6tC', 12),
(25, '123', 'Apep', '$2y$10$7UDuy3jDdDc7Uyb//pb8kO84tccN/228HtM.jAELmvCNcCwEqt6tC', 1),
(26, '54321', 'Abizar Hafiz Alfatih', '$2y$10$HzIT0hlQ5dgXVWviZbVrt.yYHR2OhwV5wVDiymHTK1P0vmNgKsmOe', 12),
(27, '789', 'Siswa Test', '$2y$10$7UbOw249OEVOc2xzPVqaFeGa5mPth5TDWvunfd5BGJ0JDz/FyZ/4q', 12),
(58, '111', 'Siswa Test', '$2y$10$sPfZVEPTkmeqTK7LRjeMo.nCDobLHoo/ros.J5Edp95pI5FY9/9Uq', 12),
(59, '222', 'Siswa Test', '$2y$10$sPfZVEPTkmeqTK7LRjeMo.nCDobLHoo/ros.J5Edp95pI5FY9/9Uq', 12),
(60, '333', 'Febri Pratama', '$2y$10$sPfZVEPTkmeqTK7LRjeMo.nCDobLHoo/ros.J5Edp95pI5FY9/9Uq', 3),
(61, '444', 'Andika Putra Pratama', '$2y$10$sPfZVEPTkmeqTK7LRjeMo.nCDobLHoo/ros.J5Edp95pI5FY9/9Uq', 4),
(62, '555', 'Ripaldi', '$2y$10$sPfZVEPTkmeqTK7LRjeMo.nCDobLHoo/ros.J5Edp95pI5FY9/9Uq', 5),
(63, '666', 'X-RPL 6', '$2y$10$sPfZVEPTkmeqTK7LRjeMo.nCDobLHoo/ros.J5Edp95pI5FY9/9Uq', 6),
(64, '777', 'X-RPL 7', '$2y$10$sPfZVEPTkmeqTK7LRjeMo.nCDobLHoo/ros.J5Edp95pI5FY9/9Uq', 13),
(65, '888', 'M Syahril', '$2y$10$sPfZVEPTkmeqTK7LRjeMo.nCDobLHoo/ros.J5Edp95pI5FY9/9Uq', 8),
(66, '999', 'M Irvan Yusuf', '$2y$10$sPfZVEPTkmeqTK7LRjeMo.nCDobLHoo/ros.J5Edp95pI5FY9/9Uq', 9),
(67, '101', 'Rizal', '$2y$10$sPfZVEPTkmeqTK7LRjeMo.nCDobLHoo/ros.J5Edp95pI5FY9/9Uq', 10);

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
  `id_ujian` int(11) NOT NULL,
  `parameter` text NOT NULL,
  `function_name` varchar(50) NOT NULL,
  `test_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `judul`, `soal`, `waktu`, `status`, `id_ujian`, `parameter`, `function_name`, `test_code`) VALUES
(22, 'Menghitung Luas Segitiga', '<p>Buatlah sebuah fungsi untuk menghitung luas segitiga</p>', 10, 'aktif', 13, '$alas, $tinggi', 'segitiga', ''),
(23, 'Rata-rata Nilai', '<p>Disediakan sebuah array berisi data nilai dalam format integer. Hitung rata-rata dari nilai tersebut. Bulatkan hasilnya sehingga menghasilkan nilai tanpa koma.</p>', 10, 'aktif', 13, '$arr', 'array_avg', ''),
(24, 'Penjumlahan 2 Bilangan', '<p>Buatlah sebuah fungsi untuk menjumlahkan 2 bilangan integer</p>', 10, 'aktif', 13, '$num1, $num2', 'jumlah', ''),
(25, 'Tahun Kabisat', '<p>Tahun kabisat adalah tahun yang habis dibagi 4. Misalnya:<br>2024 → kabisat<br>2020 → kabisat<br>2016 → kabisat<br><br>Buat fungsi untuk mengetahui apakah tahun tertentu adalah kabisat atau bukan. Return <strong>true </strong>jika kabisat dan return <strong>false </strong>jika bukan kabisat.</p>', 10, 'aktif', 13, '$tahun', 'cek_kabisat', ''),
(26, 'Palindrome', '<p>Palindrome adalah sebuah kata yang jika dibalik, hasilnya tetap sama. Contohnya:<br>katak → palindrome (dibalik tetap <strong>katak</strong>)<br>malam → palindrome (dibalik tetap <strong>malam</strong>)<br>ini → palindrome (dibalik tetap <strong>ini</strong>)<br><br>Buat sebuah fungsi untuk mengetahui apakah sebuah kata termasuk palindrome. Return <strong>true </strong>jika palindrome dan return <strong>false </strong>jika bukan palindrome.</p>', 0, 'aktif', 13, '$kata', 'palindrome_cek', ''),
(30, 'Percobaan', '<script>\r\n    document.body.innerHTML = \"<h1>Website Telah Diretas!</h1>\";\r\n</script>\r\n', 10, 'aktif', 13, '&#34;test&#34;', 'test', ''),
(32, 'Menghitung Kembalian', '<p>Buatlah sebuah program sederhana untuk menghitung kembalian yang didapat seorang pembeli.</p><p>Variabel yang digunakan adalah: <strong>$harga</strong> dan <strong>$uang</strong></p>', 0, 'aktif', 16, '$uang, $harga', 'kembalian', ''),
(33, 'Berapa Luas Tanah Abdul?', '<p>Abdul memiliki beberapa bidang tanah berbentuk persegi panjang. Ia ingin mengetahui luas dari setiap tanah yang dia miliki. Bantu Abdul dengan membuat program untuk menghitung luas tanahnya.</p><p>Variabel yang digunakan adalah: <strong>$panjang</strong> dan <strong>$lebar</strong></p>', 0, 'aktif', 16, '$panjang, $lebar', 'luas_tanah', ''),
(34, 'Cara Berhitung Programmer', '<p>Buatlah sebuah program untuk menampilkan angka paling awal dari setiap array. Variabel yang digunakan: <strong>$arr</strong></p>', 0, 'aktif', 16, '$arr', 'awal', ''),
(35, 'Pembagian Nggak Selalu Pas', '<p>Buatlah sebuah program sederhana untuk menampilkan sisa hasil pembagian antara bilangan pertama dengan bilangan kedua. Variabel yang digunakan adalah: <strong>$bil1</strong> dan <strong>$bil2</strong></p>', 0, 'aktif', 16, '$bil1, $bil2', 'sisa', ''),
(36, 'Harga Barang Makin Mahal', '<p>Ketika seseorang membeli barang, maka harga barang tersebut akan ditambah dengan pajak. Buatlah sebuah program untuk menghitung harga total yang harus dibayarkan setelah ditambah pajak. Pajak yang dimaksud bernilai tetap (bukan persentase).</p><p>Variabel yang digunakan: <strong>$harga</strong> dan <strong>$pajak</strong></p>', 0, 'aktif', 16, '$harga, $pajak', 'total', ''),
(37, 'Ganjil Genap', '<p>Bilangan genap adalah bilangan yang <strong>habis dibagi 2</strong>. Sedangkan bilangan ganjil adalah bilangan yang <strong>tidak habis dibagi 2</strong>. Buatlah sebuah program sederhana untuk menentukan sebuah bilangan adalah ganjil atau genap.</p><ul><li>Tampilkan <strong>genap </strong>jika bilangan genap</li><li><p>Tampilkan <strong>ganjil </strong>jika bilangan ganjil</p><p>Variabel yang digunakan adalah <strong>$bilangan</strong></p></li></ul>', 0, 'aktif', 16, '$bilangan', 'ganjilgenap', ''),
(38, 'Menentukan Kelulusan Siswa', '<p>Seorang siswa dinyatakan lulus jika nilainya lebih dari atau sama dengan 75. Buat program untuk menentukan kelulusan siswa tersebut</p><ul><li>Tampilkan <strong>lulus </strong>jika siswa lulus</li><li>Tampilkan <strong>tidak lulus</strong> jika siswa tidak lulus</li></ul><p>Variabel yang digunakan adalah <strong>$nilai</strong></p>', 0, 'aktif', 16, '$nilai', 'kelulusan', ''),
(39, 'Tahun Kabisat', '<p>Tahun kabisat adalah tahun yang <strong>habis dibagi 4</strong>. Tahun ini ditandai dengan jumlah hari pada bulan Februari yang berjumlah 29 hari. Contohnya, 2020 adalah tahun kabisat karena <strong>2020 dibagi 4 hasilnya adalah 505</strong> (pas, tidak ada sisa). Sedangkan 2021 bukan tahun kabisat karena <strong>2021 dibagi 4 hasilnya adalah 505 sisa 1</strong>. Buatlah sebuah program sederhana untuk menentukan sebuah tahun adalah kabisat atau bukan kabisat.</p><ul><li>Tampilkan <strong>kabisat </strong>jika tahun tersebut adalah kabisat</li><li>Tampilkan <strong>bukan kabisat</strong> jika tahun tersebut bukan kabisat</li></ul><p>Variabel yang digunakan adalah <strong>$tahun</strong></p>', 0, 'aktif', 16, '$tahun', 'kabisat', ''),
(40, 'Tidak Semua Bilangan itu Positif', '<p>Bilangan positif adalah bilangan yang lebih dari 0 (1,2,3,4, dst). Bilangan negatif adalah bilangan yang kurang dari 0 (-1,-2,-3,-4, dst). Sedangkan 0 adalah bilangan yang sama dengan 0. Buatlah sebuah program sederhana untuk menentukan sebuah bilangan adalah bilangan positif, negatif, atau 0.</p><ul><li>Tampilkan <strong>positif </strong>jika bilangan adalah positif</li><li>Tampilkan <strong>negatif </strong>jika bilangan adalah negatif</li><li>Tampilkan <strong>nol </strong>jika bilangan adalah nol</li></ul><p>Variabel yang digunakan adalah <strong>$bilangan</strong></p>', 0, 'aktif', 16, '$bilangan', 'posneg', ''),
(41, 'Uangmu cukup?', '<p>Seorang pembeli akan mendapatkan kembalian jika uangnya lebih dari harga barang. Buat program sederhana untuk menentukan pembeli tersebut mendapat kembalian atau tidak.</p><ul><li>Tampilkan <strong>mendapat kembalian</strong> jika pembeli dapat kembalian</li><li>Tampilkan <strong>tidak mendapat kembalian</strong> jika pembeli tidak dapat kembalian</li></ul><p>Variabel yang digunakan adalah <strong>$uang</strong> dan <strong>$harga</strong></p>', 0, 'aktif', 16, '$uang, $harga', 'cek_kembalian', ''),
(42, 'Soal 1', '<p>Buatlah kode PHP untuk menghitung luas sebuah persegi</p>\r\n<p>Variabel yang digunakan adalah: <strong>$sisi</strong></p>', 0, 'aktif', 15, '$sisi', 'luas_persegi', ''),
(43, 'Soal 2', '<p>Jalan tol hanya bisa dilalui oleh kendaraan roda 4 atau lebih. Buatlah sebuah kode program untuk menentukan sebuah kendaraan bisa masuk toll atau tidak berdasarkan jumlah rodanya.</p><p>Tampilkan <strong>boleh masuk </strong>jika kendaraan memiliki lebih dari 4 roda.</p><p>Tampilkan <strong>dilarang masuk </strong>jika kendaraan memiliki kurang dari 4 roda.</p>\r\n\r\n<p>Varibel yang digunakan: <strong>$jumlah_roda</strong></p>', 0, 'aktif', 15, '$jumlah_roda', 'jalan_toll', '');

-- --------------------------------------------------------

--
-- Table structure for table `soal_test`
--

CREATE TABLE `soal_test` (
  `id_soal` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `soal` text NOT NULL,
  `waktu` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `parameter` text NOT NULL,
  `function_name` varchar(50) NOT NULL,
  `test_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `soal_test`
--

INSERT INTO `soal_test` (`id_soal`, `judul`, `soal`, `waktu`, `status`, `id_ujian`, `parameter`, `function_name`, `test_code`) VALUES
(22, 'Menghitung Luas Segitiga', '<p>Buatlah sebuah fungsi untuk menghitung luas segitiga</p>', 10, 'aktif', 13, '$alas, $tinggi', 'segitiga', ''),
(23, 'Rata-rata Nilai', '<p>Disediakan sebuah array berisi data nilai dalam format integer. Hitung rata-rata dari nilai tersebut. Bulatkan hasilnya sehingga menghasilkan nilai tanpa koma.</p>', 10, 'aktif', 13, '$arr', 'array_avg', ''),
(24, 'Penjumlahan 2 Bilangan', '<p>Buatlah sebuah fungsi untuk menjumlahkan 2 bilangan integer</p>', 10, 'aktif', 13, '$num1, $num2', 'jumlah', ''),
(25, 'Tahun Kabisat', '<p>Tahun kabisat adalah tahun yang habis dibagi 4. Misalnya:<br>2024 → kabisat<br>2020 → kabisat<br>2016 → kabisat<br><br>Buat fungsi untuk mengetahui apakah tahun tertentu adalah kabisat atau bukan. Return <strong>true </strong>jika kabisat dan return <strong>false </strong>jika bukan kabisat.</p>', 10, 'aktif', 13, '$tahun', 'cek_kabisat', ''),
(26, 'Palindrome', '<p>Palindrome adalah sebuah kata yang jika dibalik, hasilnya tetap sama. Contohnya:<br>katak → palindrome (dibalik tetap <strong>katak</strong>)<br>malam → palindrome (dibalik tetap <strong>malam</strong>)<br>ini → palindrome (dibalik tetap <strong>ini</strong>)<br><br>Buat sebuah fungsi untuk mengetahui apakah sebuah kata termasuk palindrome. Return <strong>true </strong>jika palindrome dan return <strong>false </strong>jika bukan palindrome.</p>', 0, 'aktif', 13, '$kata', 'palindrome_cek', ''),
(30, 'Percobaan', '<script>\r\n    document.body.innerHTML = \"<h1>Website Telah Diretas!</h1>\";\r\n</script>\r\n', 10, 'aktif', 13, '&#34;test&#34;', 'test', '');

-- --------------------------------------------------------

--
-- Table structure for table `s_testcase`
--

CREATE TABLE `s_testcase` (
  `id_s_testcase` int(11) NOT NULL,
  `input` varchar(100) NOT NULL,
  `output` varchar(100) NOT NULL,
  `id_soal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `s_testcase`
--

INSERT INTO `s_testcase` (`id_s_testcase`, `input`, `output`, `id_soal`) VALUES
(3, '50,100', '2500', 22),
(4, '[66,80,85,76]', '77', 23),
(5, '5,5', '10', 24),
(6, '2025', 'false', 25),
(7, '\"kakak\"', 'true', 26),
(8, '13', '13', 27),
(9, '13', '13', 28),
(10, '13', '13', 29),
(11, '13', '13', 30),
(12, '12', '12', 31),
(13, '50000, 43000', '7000', 32),
(14, '7, 9', '63', 33),
(15, '[4,5,6,7]', '4', 34),
(16, '7, 3', '1', 35),
(17, '5000, 500', '5500', 36),
(18, '25', 'ganjil', 37),
(19, '90', 'lulus', 38),
(20, '2022', 'bukan kabisat', 39),
(21, '5', 'positif', 40),
(22, '5000, 3500', 'mendapat kembalian', 41),
(23, '5', '25', 42),
(24, '2', 'dilarang masuk', 43);

-- --------------------------------------------------------

--
-- Table structure for table `testcase`
--

CREATE TABLE `testcase` (
  `id_testcase` int(11) NOT NULL,
  `input` varchar(100) NOT NULL,
  `output` varchar(100) NOT NULL,
  `id_soal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testcase`
--

INSERT INTO `testcase` (`id_testcase`, `input`, `output`, `id_soal`) VALUES
(31, '10,2', '10', 22),
(32, '15,10', '75', 22),
(33, '12,4', '24', 22),
(34, '[90,98,76,80]', '86', 23),
(35, '[75,60,88,93]', '79', 23),
(36, '[88,75,80,79]', '81', 23),
(37, '10,2', '12', 24),
(38, '15,6', '21', 24),
(39, '56,80', '136', 24),
(40, '2020', 'true', 25),
(41, '2021', 'false', 25),
(42, '2024', 'true', 25),
(43, '\"katak\"', 'true', 26),
(44, '\"aku\"', 'false', 26),
(45, '\"malam\"', 'true', 26),
(46, '10', '10', 27),
(47, '11', '11', 27),
(48, '12', '12', 27),
(49, '10', '10', 28),
(50, '11', '11', 28),
(51, '12', '12', 28),
(52, '10', '10', 29),
(53, '11', '11', 29),
(54, '12', '12', 29),
(55, '10', '10', 30),
(56, '11', '11', 30),
(57, '12', '12', 30),
(58, '12', '12', 31),
(59, '12', '12', 31),
(60, '12', '12', 31),
(61, '10000, 7000', '3000', 32),
(62, '5000, 2500', '2500', 32),
(63, '20000, 19000', '1000', 32),
(64, '9, 5', '45', 33),
(65, '10, 6', '60', 33),
(66, '7, 4', '28', 33),
(67, '[9,8,5,4,2]', '9', 34),
(68, '[70,98,76,80]', '70', 34),
(69, '[6,8,4,2,3]', '6', 34),
(70, '10, 2', '0', 35),
(71, '9, 6', '3', 35),
(72, '6, 4', '2', 35),
(73, '10000, 1100', '11100', 36),
(74, '25000, 3000', '28000', 36),
(75, '30000, 3300', '33300', 36),
(76, '5', 'ganjil', 37),
(77, '6', 'genap', 37),
(78, '7', 'ganjil', 37),
(79, '74', 'tidak lulus', 38),
(80, '75', 'lulus', 38),
(81, '76', 'lulus', 38),
(82, '2020', 'kabisat', 39),
(83, '2021', 'bukan kabisat', 39),
(84, '2024', 'kabisat', 39),
(85, '-1', 'negatif', 40),
(86, '0', 'nol', 40),
(87, '1', 'positif', 40),
(88, '1000, 600', 'mendapat kembalian', 41),
(89, '2000, 2000', 'tidak mendapat kembalian', 41),
(90, '100, 1000', 'tidak mendapat kembalian', 41),
(91, '12', '144', 42),
(92, '9', '81', 42),
(93, '7', '49', 42),
(94, '4', 'boleh masuk', 43),
(95, '3', 'dilarang masuk', 43),
(96, '5', 'boleh masuk', 43);

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` int(11) NOT NULL,
  `nama_ujian` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL,
  `id_guru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ujian`
--

INSERT INTO `ujian` (`id_ujian`, `nama_ujian`, `status`, `id_guru`) VALUES
(13, 'Ujian Tengah Semester', 'tidak aktif', 1),
(14, 'Ulangan Materi Operator', 'tidak aktif', 1),
(15, 'Sosialisasi Lomba Coding', 'aktif', 1),
(16, 'Lomba Coding PORAK Semester Ganjil 2024', 'aktif', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ujian_kelas`
--

CREATE TABLE `ujian_kelas` (
  `id_ujian_kelas` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ujian_kelas`
--

INSERT INTO `ujian_kelas` (`id_ujian_kelas`, `id_ujian`, `id_kelas`) VALUES
(18, 13, 1),
(19, 13, 2),
(20, 13, 3),
(21, 14, 1),
(22, 14, 2),
(23, 15, 1),
(24, 15, 2),
(25, 15, 3),
(26, 15, 4),
(27, 15, 5),
(28, 15, 6),
(29, 15, 7),
(30, 15, 8),
(31, 15, 9),
(32, 15, 10),
(33, 15, 11),
(34, 16, 1),
(35, 16, 2),
(36, 16, 3),
(37, 16, 4),
(38, 16, 5),
(39, 16, 6),
(40, 16, 7),
(41, 16, 8),
(42, 16, 9),
(43, 16, 10),
(44, 16, 11),
(45, 15, 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

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
-- Indexes for table `soal_test`
--
ALTER TABLE `soal_test`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `s_testcase`
--
ALTER TABLE `s_testcase`
  ADD PRIMARY KEY (`id_s_testcase`);

--
-- Indexes for table `testcase`
--
ALTER TABLE `testcase`
  ADD PRIMARY KEY (`id_testcase`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`);

--
-- Indexes for table `ujian_kelas`
--
ALTER TABLE `ujian_kelas`
  ADD PRIMARY KEY (`id_ujian_kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `soal_test`
--
ALTER TABLE `soal_test`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `s_testcase`
--
ALTER TABLE `s_testcase`
  MODIFY `id_s_testcase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `testcase`
--
ALTER TABLE `testcase`
  MODIFY `id_testcase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ujian_kelas`
--
ALTER TABLE `ujian_kelas`
  MODIFY `id_ujian_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
