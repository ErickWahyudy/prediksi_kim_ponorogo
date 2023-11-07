#
# TABLE STRUCTURE FOR: tb_anggota_kim
#

DROP TABLE IF EXISTS `tb_anggota_kim`;

CREATE TABLE `tb_anggota_kim` (
  `id_anggota` varchar(15) NOT NULL,
  `nama_kim` varchar(30) NOT NULL,
  `wilayah` varchar(50) NOT NULL,
  `id_event` varchar(10) NOT NULL,
  `id_medsos` varchar(10) NOT NULL,
  `id_website` varchar(10) NOT NULL,
  `id_sanksi` varchar(10) NOT NULL,
  PRIMARY KEY (`id_anggota`),
  KEY `id_event` (`id_event`),
  KEY `id_medsos` (`id_medsos`),
  KEY `id_website` (`id_website`),
  KEY `id_sanksi` (`id_sanksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_anggota_kim` (`id_anggota`, `nama_kim`, `wilayah`, `id_event`, `id_medsos`, `id_website`, `id_sanksi`) VALUES ('K001TAHSNH', 'Jalen Media', 'Jalen Balong Ponorogo', 'E0018gySpF', 'M0012Jh54s', 'W001aPYLoM', 'S001UTsVaV');
INSERT INTO `tb_anggota_kim` (`id_anggota`, `nama_kim`, `wilayah`, `id_event`, `id_medsos`, `id_website`, `id_sanksi`) VALUES ('K002RyIw8A', 'Balong Kim ID', 'Kec Balong', 'E002pNLFkb', 'M0025DRB22', 'W002BmveoC', 'S0023t5DGw');
INSERT INTO `tb_anggota_kim` (`id_anggota`, `nama_kim`, `wilayah`, `id_event`, `id_medsos`, `id_website`, `id_sanksi`) VALUES ('K003zP4WFE', 'Karangmojo Center', 'Balong', 'E003B0qVwm', 'M003bvfGTb', 'W003X70vNV', 'S003jafB8m');
INSERT INTO `tb_anggota_kim` (`id_anggota`, `nama_kim`, `wilayah`, `id_event`, `id_medsos`, `id_website`, `id_sanksi`) VALUES ('K004jft5SM', 'Menjayan Kim ', 'Ponorogo', 'E0043s2g1J', 'M004kowGR4', 'W004xQ1V3d', 'S004wHrhzX');


#
# TABLE STRUCTURE FOR: tb_event
#

DROP TABLE IF EXISTS `tb_event`;

CREATE TABLE `tb_event` (
  `id_event` varchar(10) NOT NULL,
  `id_anggota` varchar(15) NOT NULL,
  `bobot_event` varchar(2) NOT NULL,
  `jumlah_event` varchar(9) NOT NULL,
  PRIMARY KEY (`id_event`),
  KEY `id_anggota` (`id_anggota`),
  CONSTRAINT `tb_event_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `tb_anggota_kim` (`id_event`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_event` (`id_event`, `id_anggota`, `bobot_event`, `jumlah_event`) VALUES ('E0018gySpF', 'K001TAHSNH', '2', '1-3');
INSERT INTO `tb_event` (`id_event`, `id_anggota`, `bobot_event`, `jumlah_event`) VALUES ('E002pNLFkb', 'K002RyIw8A', '2', '4-7');
INSERT INTO `tb_event` (`id_event`, `id_anggota`, `bobot_event`, `jumlah_event`) VALUES ('E003B0qVwm', 'K003zP4WFE', '4', '1-3');
INSERT INTO `tb_event` (`id_event`, `id_anggota`, `bobot_event`, `jumlah_event`) VALUES ('E0043s2g1J', 'K004jft5SM', '2', '1-3');


#
# TABLE STRUCTURE FOR: tb_level
#

DROP TABLE IF EXISTS `tb_level`;

CREATE TABLE `tb_level` (
  `id_level` varchar(2) NOT NULL,
  `level` varchar(15) NOT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_level` (`id_level`, `level`) VALUES ('1', 'superadmin');
INSERT INTO `tb_level` (`id_level`, `level`) VALUES ('2', 'admin');


#
# TABLE STRUCTURE FOR: tb_medsos
#

DROP TABLE IF EXISTS `tb_medsos`;

CREATE TABLE `tb_medsos` (
  `id_medsos` varchar(10) NOT NULL,
  `id_anggota` varchar(15) NOT NULL,
  `bobot_medsos` varchar(2) NOT NULL,
  `jumlah_medsos` varchar(9) NOT NULL,
  PRIMARY KEY (`id_medsos`),
  KEY `id_anggota` (`id_anggota`),
  CONSTRAINT `tb_medsos_ibfk_1` FOREIGN KEY (`id_medsos`) REFERENCES `tb_anggota_kim` (`id_medsos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_medsos` (`id_medsos`, `id_anggota`, `bobot_medsos`, `jumlah_medsos`) VALUES ('M0012Jh54s', 'K001TAHSNH', '5', '1-2');
INSERT INTO `tb_medsos` (`id_medsos`, `id_anggota`, `bobot_medsos`, `jumlah_medsos`) VALUES ('M0025DRB22', 'K002RyIw8A', '4', '4');
INSERT INTO `tb_medsos` (`id_medsos`, `id_anggota`, `bobot_medsos`, `jumlah_medsos`) VALUES ('M003bvfGTb', 'K003zP4WFE', '2', '1-2');
INSERT INTO `tb_medsos` (`id_medsos`, `id_anggota`, `bobot_medsos`, `jumlah_medsos`) VALUES ('M004kowGR4', 'K004jft5SM', '2', '1-2');


#
# TABLE STRUCTURE FOR: tb_pengaturan
#

DROP TABLE IF EXISTS `tb_pengaturan`;

CREATE TABLE `tb_pengaturan` (
  `id_pengaturan` varchar(7) NOT NULL,
  `nama_judul` varchar(50) NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `background` text NOT NULL,
  PRIMARY KEY (`id_pengaturan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_pengaturan` (`id_pengaturan`, `nama_judul`, `meta_keywords`, `meta_description`, `background`) VALUES ('P1xhDwL', 'Prediksi KIM', 'Kassandra Production, Prediksi KIM', 'KIM merupakan kelompok yang dibentuk di Desa/Kelurahan yang disah\r\nkan dengan SK dari Desa/Kelurahan. Pada penerapannya KIM juga memiliki\r\nfokus untuk meningkatkan eksistensi daerah dan perekonomian.', 'header_65032c44088d2.jpg');


#
# TABLE STRUCTURE FOR: tb_pengguna
#

DROP TABLE IF EXISTS `tb_pengguna`;

CREATE TABLE `tb_pengguna` (
  `id_pengguna` varchar(15) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `keterangan` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `id_level` varchar(2) NOT NULL,
  PRIMARY KEY (`id_pengguna`),
  KEY `id_level` (`id_level`),
  CONSTRAINT `tb_pengguna_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `tb_level` (`id_level`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama`, `keterangan`, `email`, `password`, `id_level`) VALUES ('A001bnHDs', 'Erik Wahyudi', 'Superadmin', 'erik@gmail.com', '202cb962ac59075b964b07152d234b70', '1');


#
# TABLE STRUCTURE FOR: tb_sanksi
#

DROP TABLE IF EXISTS `tb_sanksi`;

CREATE TABLE `tb_sanksi` (
  `id_sanksi` varchar(10) NOT NULL,
  `id_anggota` varchar(15) NOT NULL,
  `bobot_sanksi` varchar(2) NOT NULL,
  PRIMARY KEY (`id_sanksi`),
  KEY `id_anggota` (`id_anggota`),
  CONSTRAINT `tb_sanksi_ibfk_1` FOREIGN KEY (`id_sanksi`) REFERENCES `tb_anggota_kim` (`id_sanksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_sanksi` (`id_sanksi`, `id_anggota`, `bobot_sanksi`) VALUES ('S001UTsVaV', 'K001TAHSNH', '4');
INSERT INTO `tb_sanksi` (`id_sanksi`, `id_anggota`, `bobot_sanksi`) VALUES ('S0023t5DGw', 'K002RyIw8A', '4');
INSERT INTO `tb_sanksi` (`id_sanksi`, `id_anggota`, `bobot_sanksi`) VALUES ('S003jafB8m', 'K003zP4WFE', '4');
INSERT INTO `tb_sanksi` (`id_sanksi`, `id_anggota`, `bobot_sanksi`) VALUES ('S004wHrhzX', 'K004jft5SM', '4');


#
# TABLE STRUCTURE FOR: tb_website
#

DROP TABLE IF EXISTS `tb_website`;

CREATE TABLE `tb_website` (
  `id_website` varchar(10) NOT NULL,
  `id_anggota` varchar(15) NOT NULL,
  `bobot_website` varchar(2) NOT NULL,
  PRIMARY KEY (`id_website`),
  KEY `id_anggota` (`id_anggota`),
  CONSTRAINT `tb_website_ibfk_1` FOREIGN KEY (`id_website`) REFERENCES `tb_anggota_kim` (`id_website`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_website` (`id_website`, `id_anggota`, `bobot_website`) VALUES ('W001aPYLoM', 'K001TAHSNH', '2');
INSERT INTO `tb_website` (`id_website`, `id_anggota`, `bobot_website`) VALUES ('W002BmveoC', 'K002RyIw8A', '4');
INSERT INTO `tb_website` (`id_website`, `id_anggota`, `bobot_website`) VALUES ('W003X70vNV', 'K003zP4WFE', '5');
INSERT INTO `tb_website` (`id_website`, `id_anggota`, `bobot_website`) VALUES ('W004xQ1V3d', 'K004jft5SM', '2');


