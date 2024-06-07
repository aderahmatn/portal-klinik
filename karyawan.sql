-- -------------------------------------------------------------
-- TablePlus 6.0.4(556)
--
-- https://tableplus.com/
--
-- Database: portalklinik
-- Generation Time: 2024-05-30 1:47:43.6570 AM
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


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
  `bpjs_tk` text,
  `tgl_join` date DEFAULT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `karyawan` (`id_karyawan`, `nik`, `nama_lengkap`, `id_divisi`, `id_departemen`, `bagian`, `status`, `bpjs`, `jenkel`, `perusahaan`, `deleted`, `tgl_lahir`, `bpjs_tk`, `tgl_join`) VALUES
(1, '12345678', 'udin supena nurjaman', 4, 4, 'helper gudang', 'PKWT', '1222123456789', 'L', 'pt mirosea 123', 0, '1995-06-14', NULL, '2024-05-02'),
(4, '87654321', 'ASEP BENJAMIN SINAGA ', 2, 4, 'HELPER', 'PKWT', '09876654321', 'L', 'PT MAYORA INDAH', 0, '2000-03-12', NULL, '2024-05-02'),
(5, '11223344', 'james bond', 1, 2, 'packing', 'PKWT', '', 'L', 'pt mayora indah', 0, '1999-10-04', NULL, '2024-05-02'),
(6, '88776655', 'luna maya', 2, 2, 'packing', 'OUTSOURCE', '123456789', 'P', 'pt phalosa', 0, '1999-04-06', NULL, '2024-05-02'),
(7, '99223355', 'livy renata', 1, 1, 'recepsionis', 'OUTSOURCE', '', 'P', 'pt damarindo', 0, '1998-02-10', NULL, '2024-05-02'),
(8, '12345688', 'amirudin', 2, 2, 'packing', 'PKWT', '987654111', 'L', 'pt mayora indah', 0, '1987-05-02', '123456222', '2024-05-02');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;