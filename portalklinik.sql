-- -------------------------------------------------------------
-- TablePlus 5.9.0(538)
--
-- https://tableplus.com/
--
-- Database: portalklinik
-- Generation Time: 2024-03-20 12:28:07.1920 AM
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `departemen` (
  `id_departemen` int NOT NULL AUTO_INCREMENT,
  `nama_departemen` text,
  `deleted` int DEFAULT NULL,
  PRIMARY KEY (`id_departemen`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `divisi` (
  `id_divisi` int NOT NULL AUTO_INCREMENT,
  `nama_divisi` text,
  `deleted` int DEFAULT NULL,
  PRIMARY KEY (`id_divisi`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `departemen` (`id_departemen`, `nama_departemen`, `deleted`) VALUES
(1, 'irga', 0),
(2, 'produksi', 0),
(3, 'qc', 0),
(4, 'warehouse', 0),
(5, 'engineering', 0),
(6, 'testing', 1);

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`, `deleted`) VALUES
(1, 'wafer', 0),
(2, 'biscuit', 0),
(3, 'testing', 1);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;