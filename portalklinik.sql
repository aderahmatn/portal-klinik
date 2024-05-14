-- -------------------------------------------------------------
-- TablePlus 6.0.0(550)
--
-- https://tableplus.com/
--
-- Database: portalklinik
-- Generation Time: 2024-05-15 12:58:25.1130 AM
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `departemen` (
  `id_departemen` int NOT NULL AUTO_INCREMENT,
  `nama_departemen` text,
  `deleted` int DEFAULT NULL,
  PRIMARY KEY (`id_departemen`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `diagnosa` (
  `id_diagnosa` int NOT NULL AUTO_INCREMENT,
  `diagnosa` text,
  `deleted` int DEFAULT NULL,
  PRIMARY KEY (`id_diagnosa`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `divisi` (
  `id_divisi` int NOT NULL AUTO_INCREMENT,
  `nama_divisi` text,
  `deleted` int DEFAULT NULL,
  PRIMARY KEY (`id_divisi`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `karyawan` (
  `id_karyawan` int NOT NULL AUTO_INCREMENT,
  `nik` text,
  `nama_lengkap` text,
  `id_divisi` int DEFAULT NULL,
  `id_departemen` int DEFAULT NULL,
  `bagian` text,
  `status` text,
  `bpjs` text,
  `jenkel` text,
  `perusahaan` text,
  `deleted` int DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `kunjungan` (
  `id_kunjungan` int NOT NULL AUTO_INCREMENT,
  `tgl_kunjungan` date DEFAULT NULL,
  `id_user` text,
  `jam_kunjungan` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `id_karyawan` text,
  `anamnesa` text,
  `catatan_kunjungan` text,
  `created_by` int DEFAULT NULL,
  `teraphy` text,
  `deleted` int DEFAULT NULL,
  PRIMARY KEY (`id_kunjungan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `mcu` (
  `id_mcu` int NOT NULL AUTO_INCREMENT,
  `tgl_mcu` date DEFAULT NULL,
  `id_karyawan` int DEFAULT NULL,
  `kesimpulan` text,
  `saran` text,
  `kategori_mcu` text,
  `file_mcu` text,
  `deleted` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  PRIMARY KEY (`id_mcu`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `obat` (
  `id_obat` int NOT NULL AUTO_INCREMENT,
  `nama_obat` text,
  `catatan_obat` text,
  `minimum_stok` int DEFAULT NULL,
  `deleted` int DEFAULT NULL,
  PRIMARY KEY (`id_obat`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `stok_obat` (
  `id_stok_obat` int NOT NULL AUTO_INCREMENT,
  `id_obat` int DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `deleted_stok` int DEFAULT NULL,
  PRIMARY KEY (`id_stok_obat`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama_user` text,
  `email_user` text,
  `whatsapp_user` text,
  `deleted` int DEFAULT NULL,
  `username` text,
  `password` text,
  `level` text,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `departemen` (`id_departemen`, `nama_departemen`, `deleted`) VALUES
(1, 'irga', 0),
(2, 'produksi', 0),
(3, 'qc', 0),
(4, 'warehouse', 0),
(5, 'engineering', 0),
(6, 'testing', 1),
(7, 'ppic', 0);

INSERT INTO `diagnosa` (`id_diagnosa`, `diagnosa`, `deleted`) VALUES
(1, 'Cephalgia', 0),
(2, 'Abdominal Pain', 0),
(3, 'Chest Pain', 0),
(4, 'Gastritis', 0),
(5, 'GERD', 0),
(6, 'ISPA', 0),
(7, 'Febris/Obs. Febris', 0),
(8, 'Myalgia', 0),
(9, 'TFA', 0),
(10, 'Vertigo', 0),
(11, 'cc', 0),
(12, 'lbp', 0);

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`, `deleted`) VALUES
(1, 'wafer', 0),
(2, 'biscuit', 0),
(3, 'testing', 1),
(4, 'candy', 0),
(5, 'cokelat', 0);

INSERT INTO `karyawan` (`id_karyawan`, `nik`, `nama_lengkap`, `id_divisi`, `id_departemen`, `bagian`, `status`, `bpjs`, `jenkel`, `perusahaan`, `deleted`, `tgl_lahir`) VALUES
(1, '12345678', 'udin supena nurjaman', 4, 4, 'helper gudang', 'PKWT', '1222123456789', 'L', 'pt mirosea 123', 0, '1995-06-14'),
(4, '87654321', 'ASEP BENJAMIN SINAGA ', 2, 4, 'HELPER', 'PKWT', '09876654321', 'L', 'PT MAYORA INDAH', 0, '2000-03-12'),
(5, '11223344', 'james bond', 1, 2, 'packing', 'PKWT', '', 'L', 'pt mayora indah', 0, '1999-10-04'),
(6, '88776655', 'luna maya', 2, 2, 'packing', 'OUTSOURCE', '123456789', 'P', 'pt phalosa', 0, '1999-04-06'),
(7, '99223355', 'livy renata', 1, 1, 'recepsionis', 'OUTSOURCE', '', 'P', 'pt damarindo', 0, '1998-02-10');

INSERT INTO `mcu` (`id_mcu`, `tgl_mcu`, `id_karyawan`, `kesimpulan`, `saran`, `kategori_mcu`, `file_mcu`, `deleted`, `created_by`) VALUES
(5, '2024-05-20', 1, 'uraT738n91edit', 'TisqALpXtHedit', '3', '14052024.pdf', 0, 3),
(6, '2024-05-08', 4, 'Riwayat tuberkulosis.\r\nObesitas (BMI: 28.69).\r\nButa warna parsial.\r\nSuspek anemia (HB:13.1 g/dL).\r\nThrombositosis (Thrombosit:488 10^3/uL).\r\nPeningkatan LED (LED:20 mm).\r\nPeningkatan enzim fungsi hati (SGPT:58 U/L).\r\nFIT WITH NOTE', 'Konsultasi ke dokter perusahaan.\r\nHindari bekerja pada bagian yang membutuhkan ketelitian membedakan warna.\r\nLakukan pemeriksaan kesehatan berkala setidaknya setiap 1 tahun sekali.', '2', '140520241.pdf', 0, 3),
(7, '2023-06-12', 1, 'Obesitas (BMI: 25.71).\r\nMyopia mata kiri, OD:6/9,OS:6/12.\r\nGigi berlubang.\r\nFIT WITH NOTE', 'Konsultasi ke dokter perusahaan.\r\nGunakan kacamata dengan ukuran yang tepat dan sesuai dengan penglihatan.\r\nKonsul dokter gigi untuk penambalan gigi dan jaga kebersihan mulut.\r\nLakukan pemeriksaan kesehatan berkala setidaknya setiap 1 tahun sekali.', '2', '140520242.pdf', 0, 3),
(8, '2024-05-01', 7, 'Riwayat alergi.\r\nGigi berlubang.\r\nFIT TO WORK', 'Konsul dokter gigi untuk penambalan gigi dan jaga kebersihan mulut.\r\nLakukan pemeriksaan kesehatan berkala setidaknya setiap 1 tahun sekali.', '1', '15052024.pdf', 0, 6);

INSERT INTO `obat` (`id_obat`, `nama_obat`, `catatan_obat`, `minimum_stok`, `deleted`) VALUES
(1, 'asasa', 'zxczx', NULL, 1),
(2, 'Paracetamol', 'pereda nyeri', 40, 0),
(3, 'ranitidine', 'obat maag', 30, 0),
(4, 'Domperidone', 'pereda mual', 30, 0),
(5, 'Cetirizine', 'alergi', 24, 0),
(6, 'Spasminal', 'nyeri otot', 40, 0);

INSERT INTO `stok_obat` (`id_stok_obat`, `id_obat`, `tgl_masuk`, `expired_date`, `jumlah`, `created_by`, `deleted_stok`) VALUES
(1, 2, '2024-05-10', '2027-04-02', 40, 3, 0),
(2, 3, '2024-05-10', '2026-04-02', 53, 3, 0),
(3, 5, '2024-05-10', '2027-02-04', 40, 3, 1),
(4, 4, '2024-05-10', '2025-12-12', 24, 3, 0),
(5, 2, '2024-05-08', '2024-12-01', 12, 3, 0),
(6, 3, '2024-05-01', '2023-12-23', 43, 3, 0),
(7, 5, '2024-05-10', '2028-10-10', 12, 3, 0),
(8, 4, '2024-05-14', '2026-12-12', 24, 3, 0),
(9, 6, '2024-05-14', '2026-12-12', 12, 3, 0);

INSERT INTO `user` (`id_user`, `nama_user`, `email_user`, `whatsapp_user`, `deleted`, `username`, `password`, `level`) VALUES
(4, 'nandita putra panjati', 'nanditap@gmail.com', '087771521888', 0, 'nandita', 'MmZhMlA5dTA5RDVlUkJySUNBVzMzdz09', 'PERAWAT'),
(6, 'justin bieber', 'junstin.bieber@gmail.com', '087776451662', 0, 'justin', 'MmZhMlA5dTA5RDVlUkJySUNBVzMzdz09', 'ADMINISTRATOR');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;