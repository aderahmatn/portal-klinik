-- -------------------------------------------------------------
-- TablePlus 6.0.4(556)
--
-- https://tableplus.com/
--
-- Database: portalklinik
-- Generation Time: 2024-05-30 1:34:34.3900 AM
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `diagnosa_kunjungan` (
  `id_diagnosa_kunjungan` int NOT NULL AUTO_INCREMENT,
  `id_kunjungan` int DEFAULT NULL,
  `id_diagnosa` int DEFAULT NULL,
  `deleted` int DEFAULT NULL,
  PRIMARY KEY (`id_diagnosa_kunjungan`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `kunjungan` (
  `id_kunjungan` int NOT NULL AUTO_INCREMENT,
  `tgl_kunjungan` date DEFAULT NULL,
  `jam_kunjungan` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `id_karyawan` text,
  `anamnesa` text,
  `catatan_kunjungan` text,
  `created_by` int DEFAULT NULL,
  `teraphy` text,
  `deleted` int DEFAULT NULL,
  PRIMARY KEY (`id_kunjungan`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `obat_kunjungan` (
  `id_obat_kunjungan` int NOT NULL AUTO_INCREMENT,
  `id_obat` int DEFAULT NULL,
  `id_kunjungan` int DEFAULT NULL,
  `deleted` int DEFAULT NULL,
  `jumlah_keluar` int DEFAULT NULL,
  PRIMARY KEY (`id_obat_kunjungan`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;