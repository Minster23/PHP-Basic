-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 30, 2023 at 01:08 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_psb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_forum`
--

DROP TABLE IF EXISTS `tb_forum`;
CREATE TABLE IF NOT EXISTS `tb_forum` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Isinya` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Foto` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_forum`
--

INSERT INTO `tb_forum` (`id`, `Judul`, `Isinya`, `Foto`) VALUES
(67, 'Duet Gitar Perwakilan SMPIT RJ Raih Medali Perak', 'Alhamdulillahirobbilalamiin..\r\nPasangan sejoli duet gitar perwakilan dari SMPIT Raudhatul Jannah Cilegon kembali meraih prestasi yang membanggakan.\r\nKami ucapkan selamat dan sukses kepada:\r\n- Yudhistiro Ardy Wicaksono\r\n- Daffa Alfiro Ramadhan\r\natas prestasi yang diraih yakni Juara II Lomba Duet Gitar FLS2N Tingkat Nasional Tahun 2022.\r\nKami ucapkan terima kasih kepada ananda Yudhis dan Daffa atas prestasi yang diraih dan tak lupa kami ucapkan terima kasih pula kepada orang tua peserta didik yang telah memberi dukungan dan doa sehingga SMPIT Raudhatul Jannah Cilegon dapat menoreh prestasi yang membanggakan.\r\nTak lupa kami ucapkan terima kasih kepada Bapak Dinar, S. Pd. sebagai guru pembimbing yang telah memberikan arahan serta masukannya, sehingga SMPIT Raudhatul Jannah Cilegon lagi-lagi dapat meraih prestasi.????\r\nKita jadi semakin yakin bahwa proses kerja keras yg maksimal tidak akan menghayati hasilnya.\r\nSelamat Daffa Yudis????????\r\n \r\nSelain itu di ajang KSM Tingkat Provinsi Banten, juga meraih prestasi yang menakjubkan.\r\nBerikut rekapannya.', 0x706f73742d696d6167652d313637323239393532343732332e6a7067),
(69, 'dfdsvdsvdfbd', 'dfbdbdbb', 0x706f73742d696d6167652d313637323239393532343732332e6a7067),
(70, 'defefef', 'fdefgreg', 0x646f776e6c6f61642e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kontenwebdepan`
--

DROP TABLE IF EXISTS `tb_kontenwebdepan`;
CREATE TABLE IF NOT EXISTS `tb_kontenwebdepan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Profil` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Visi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Misi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Jumlah_siswa` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pt_kepsek` longblob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kontenwebdepan`
--

INSERT INTO `tb_kontenwebdepan` (`id`, `Profil`, `Visi`, `Misi`, `Jumlah_siswa`, `pt_kepsek`) VALUES
(1, 'fwefewfewd', 'ggewwg', 'wrgwg', '54 12 36 71 17 41 62 6 79 24 70 50 75', 0x37383465303935343236633435323332313139346239656262356438616330392e6a706567);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
