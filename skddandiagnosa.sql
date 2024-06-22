-- -------------------------------------------------------------
-- TablePlus 6.0.4(556)
--
-- https://tableplus.com/
--
-- Database: portalklinik
-- Generation Time: 2024-06-07 2:38:29.2870 PM
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `diagnosa_skd` (
  `id_diagnosa_skd` int NOT NULL AUTO_INCREMENT,
  `id_diagnosa` int DEFAULT NULL,
  `id_skd` int DEFAULT NULL,
  `deleted` int DEFAULT NULL,
  PRIMARY KEY (`id_diagnosa_skd`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `skd` (
  `id_skd` int NOT NULL AUTO_INCREMENT,
  `created_date` date DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `id_karyawan` int DEFAULT NULL,
  `jenis_penyakit` text,
  `tgl_akhir_skd` date DEFAULT NULL,
  `jumlah_hari` int DEFAULT NULL,
  `tgl_mulai_skd` date DEFAULT NULL,
  `pembayaran` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `faskes` text,
  `tgl_penyerahan` date DEFAULT NULL,
  `status_skd` text,
  `catatan_skd` text,
  `deleted` int DEFAULT NULL,
  PRIMARY KEY (`id_skd`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `diagnosa_skd` (`id_diagnosa_skd`, `id_diagnosa`, `id_skd`, `deleted`) VALUES
(3, 10, 5, 0),
(4, 9, 6, 0),
(9, 8, 5, 0),
(10, 7, 5, 0);

INSERT INTO `skd` (`id_skd`, `created_date`, `id_user`, `id_karyawan`, `jenis_penyakit`, `tgl_akhir_skd`, `jumlah_hari`, `tgl_mulai_skd`, `pembayaran`, `faskes`, `tgl_penyerahan`, `status_skd`, `catatan_skd`, `deleted`) VALUES
(5, '2024-06-07', 6, 8, 'vertigo pusing, demam', '2024-06-06', 1, '2024-06-06', 'BPJS', 'klinik pratama', '2024-06-07', 'ACC', 'note 1', 0),
(6, '2024-06-07', 6, 6, 'jp 1 edit', '2024-06-04', 2, '2024-06-02', 'ASURANSI', 'klinik pratama edit', '2024-06-06', 'ACC', 'as edit', 0);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;