-- -------------------------------------------------------------
-- TablePlus 6.0.8(562)
--
-- https://tableplus.com/
--
-- Database: portalklinik
-- Generation Time: 2024-06-22 11:00:45.8990 AM
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `kk` (
  `id_kk` int NOT NULL AUTO_INCREMENT,
  `id_karyawan` int DEFAULT NULL,
  `pendidikan_terakhir` text,
  `area_kejadian` text,
  `nama_atasan` text,
  `tgl_kejadian` date DEFAULT NULL,
  `jam_kejadian` text,
  `shif` text,
  `kategori` text,
  `lost_time_injury` text,
  `medical_treatment` text,
  `bagian_cidera` text,
  `faskes_penanganan` text,
  `tipe_kecelakaan` text,
  `penyebab_kecelakaan` text,
  `kronologi_kejadian` text,
  `is_rujuk` int DEFAULT NULL,
  `tindakan_rujuk` text,
  `catatan` text,
  `update_pemantauan_medis` text,
  `file` text,
  `deleted` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id_kk`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `kk` (`id_kk`, `id_karyawan`, `pendidikan_terakhir`, `area_kejadian`, `nama_atasan`, `tgl_kejadian`, `jam_kejadian`, `shif`, `kategori`, `lost_time_injury`, `medical_treatment`, `bagian_cidera`, `faskes_penanganan`, `tipe_kecelakaan`, `penyebab_kecelakaan`, `kronologi_kejadian`, `is_rujuk`, `tindakan_rujuk`, `catatan`, `update_pemantauan_medis`, `file`, `deleted`, `id_user`) VALUES
(6, 7, 'SMA/SMK', 'packing line 2', 'udin', '2024-05-20', '01:00', '3', 'p3k', 'ybs kembali bekerja', 'perawatan luka', 'jari telunjuk kanan', 'klinik perusahaan', 'luka ringan', 'kurang berhati-hati', 'Ybs sedang cleaning membersihakn mesin mixer dalam kondisi mati atau tidak menyala, Kemudia ybs membersihakn bagian dalam mesin dan tidak sengaja mengenai bagian tajam, hingga membuat tangan ybs terluka atau tersayat', 0, 'tr livy', 'note livy', 'upm liby', '17_06_20245.pdf', 0, 6),
(7, 5, 'SARJANA (S1)', 'packing line 2', 'jamal', '2024-05-20', '16:00', '2', 'p3k', 'ybs kembali bekerja', 'perawatan luka', 'jari telunjuk kanan', 'klinik perusahaan', 'luka ringan', 'kurang berhati-hati', 'Ybs sedang mengambil box cream yang tersangkut/rusak, tiba-tiba jari tangan ybs terjepit. Lalu ybs spontan langsung menarik', 0, 'tr bond', 'note bond', 'upm bond', '17_06_20246.pdf', 1, 6),
(8, 4, 'DOKTORAL (S3)', 'packing line 2 ed', 'fadil ed', '2024-06-18', '18:00', '2', 'p3k ed', 'ybs kembali bekerja ed', 'perawatan luka ed', 'jari telunjuk kanan ed', 'klinik perusahaan ed', 'luka ringan ed', 'kurang berhati-hati ed', 'Ybs sedang mengambil box cream yang tersangkut/rusak, tiba-tiba jari tangan ybs terjepit. Lalu ybs spontan langsung menarik ed', 0, 'tr asep ed', 'note asep ed', 'upm asep ed', 'cuti_sakit_gigi_tgl_16_.pdf', 0, 6);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;