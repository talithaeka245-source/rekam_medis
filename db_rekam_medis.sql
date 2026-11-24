-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 18, 2026 at 01:10 AM
-- Server version: 10.11.11-MariaDB
-- PHP Version: 8.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rekam_medis`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL,
  `nama_dokter` varchar(100) NOT NULL,
  `spesialisasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama_dokter`, `spesialisasi`) VALUES
(1, 'dr. Maya Indah', 'Spesialis Jantung'),
(2, 'dr. Andi Wijaya', 'Spesialis Penyakit Dalam'),
(3, 'dr. Dewi Mutia ', 'Spesialis Mata'),
(7, 'dr. Kartika Wulan Sari', 'Spesialis Anak'),
(8, 'drg. Rizky Pratama', 'Dokter gigi');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(100) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `satuan`, `stok`) VALUES
(1, 'Amoxicillin ', 'Kapsul', 50),
(2, 'Paracetamol', 'Tablet', 50),
(3, 'Asam Mefenamat', 'Kaplet', 55),
(5, 'Ambroxol Sirup', 'Botol', 30),
(6, 'Metformin', 'Tablet', 70),
(7, 'Omeprazole', 'Kapsul', 80),
(8, 'Acarbose', 'Tablet', 70),
(13, 'Chloramphenicol Tetes Mata', 'Botol', 50),
(14, ' Cendo Lyteers', 'Botol', 50),
(15, 'Paracetamol', 'Botol', 50),
(16, 'Amlodipine', 'Strip', 50);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `no_rm` varchar(20) NOT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `no_rm`, `nama_pasien`, `jenis_kelamin`, `tanggal_lahir`, `alamat`) VALUES
(1, 'RM 001', 'dino', 'L', '2015-10-11', 'JL.Melati Tuban'),
(2, 'RM 002', 'wati', 'P', '2001-10-10', 'JL.Merdeka Tuban'),
(3, 'RM 003', 'Michael Wijaya', 'L', '2005-10-12', 'JL. Pramuka Tuban'),
(7, 'RM 006', 'jose', 'L', '2020-12-12', 'JL.R.A. Kartini Tuban'),
(11, 'RM 005', 'Lia', 'P', '2019-05-10', 'Jl. Manunggal Tuban');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `id_rekam` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `tanggal_periksa` date NOT NULL,
  `keluhan` text NOT NULL,
  `diagnosa` text NOT NULL,
  `tindakan` text NOT NULL,
  `resep` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rekam_medis`
--

INSERT INTO `rekam_medis` (`id_rekam`, `id_pasien`, `id_dokter`, `id_obat`, `tanggal_periksa`, `keluhan`, `diagnosa`, `tindakan`, `resep`) VALUES
(8, 2, 3, 13, '2026-11-17', 'Mata kanan terasa gatal, perih, memerah, dan sering berair sejak 3 hari yang lalu.', 'Konjungtivitis Bakterial Akut', 'Pemeriksaan Slit Lamp & Pemberian Resep Obat Tetes', '3x1 tetes sehari pada mata kanan'),
(9, 7, 7, 15, '2026-11-17', 'Demam tinggi sejak kemarin malam disertai batuk berdahak, pilek, dan nafsu makan menurun', 'Infeksi Saluran Pernapasan Akut (ISPA)', 'Pemeriksaan Suhu Tubuh, Auskultasi Paru & Pemberian Resep', '3x1 sendok takar (5 ml) sesudah makan bila demam'),
(11, 1, 8, 3, '2026-11-17', 'Gigi geraham bawah kanan berlubang, terasa ngilu saat minum air dingin, dan nyeri berdenyut sejak 2 hari lalu.', 'Pulpitis Reversibel (Karies Dentin)', 'Pemeriksaan Intraoral, Pembersihan Kavitas & Penambalan Sementara', '3x1 tablet sehari sesudah makan bila nyeri'),
(12, 11, 2, 7, '2026-11-17', 'Nyeri ulu hati terasa perih dan panas, perut kembung, mual, serta mulut terasa pahit sejak 3 hari lalu.', 'Dispepsia Fungsional / GERD (Gastroesophageal Reflux Disease)', 'Pemeriksaan Fisik Abdomen & Edukasi Pola Makan', '2x1 kapsul sehari 30 menit sebelum makan'),
(13, 3, 1, 16, '2026-11-17', 'Kontrol rutin tekanan darah bulanan, kadang terasa sedikit pusing ringan saat kurang tidur, tidak ada nyeri dada maupun sesak napas.', 'Hipertensi Derajat 1 (Terkontrol)', 'Pemeriksaan Tekanan Darah, Auskultasi Jantung & Edukasi Gaya Hidup', ' 1x1 tablet sehari pada pagi hari sesudah makan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`id_rekam`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_dokter` (`id_dokter`),
  ADD KEY `id_obat` (`id_obat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `id_rekam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD CONSTRAINT `rekam_medis_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekam_medis_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekam_medis_ibfk_3` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
```[cite: 14]