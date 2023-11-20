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

INSERT INTO `tb_anggota_kim` (`id_anggota`, `nama_kim`, `wilayah`, `id_event`, `id_medsos`, `id_website`, `id_sanksi`) VALUES ('K001ZkqfYh', 'Jalen Media', 'Kec Balong', 'E001NquK2T', 'M001yA0dlK', 'W001ytGNgZ', 'S0011ACb3v');
INSERT INTO `tb_anggota_kim` (`id_anggota`, `nama_kim`, `wilayah`, `id_event`, `id_medsos`, `id_website`, `id_sanksi`) VALUES ('K002Be27B2', 'Balong Kim id', 'Kec Balong', 'E002BsalU2', 'M0025AMGTb', 'W002qOZ4Un', 'S002Tghk0P');
INSERT INTO `tb_anggota_kim` (`id_anggota`, `nama_kim`, `wilayah`, `id_event`, `id_medsos`, `id_website`, `id_sanksi`) VALUES ('K003s39wwX', 'Karangmojo center', 'Kec Balong', 'E0031PCKqw', 'M003AaYdi9', 'W003CUdZkH', 'S003AwqoCZ');
INSERT INTO `tb_anggota_kim` (`id_anggota`, `nama_kim`, `wilayah`, `id_event`, `id_medsos`, `id_website`, `id_sanksi`) VALUES ('K0044IOAdG', 'Sedarat kim id', 'Kec Balong', 'E004etg6MG', 'M004JoYhS9', 'W004kg2pD7', 'S004TDar9q');
INSERT INTO `tb_anggota_kim` (`id_anggota`, `nama_kim`, `wilayah`, `id_event`, `id_medsos`, `id_website`, `id_sanksi`) VALUES ('K005TfkT7V', 'Mejayan kim', 'Siman', 'E0057I8AHd', 'M005h67Kqv', 'W005ACuvrf', 'S005YAz2xH');
INSERT INTO `tb_anggota_kim` (`id_anggota`, `nama_kim`, `wilayah`, `id_event`, `id_medsos`, `id_website`, `id_sanksi`) VALUES ('K006l5ST0V', 'Pandak Jaya', 'Kec Balong', 'E0064dOxDw', 'M0060Pjhb3', 'W006Ij02mj', 'S006KbE31s');


#
# TABLE STRUCTURE FOR: tb_event
#

DROP TABLE IF EXISTS `tb_event`;

CREATE TABLE `tb_event` (
  `id_event` varchar(10) NOT NULL,
  `id_anggota` varchar(15) NOT NULL,
  `bobot_event` varchar(2) NOT NULL,
  `nama_event` text NOT NULL,
  PRIMARY KEY (`id_event`),
  KEY `id_anggota` (`id_anggota`),
  CONSTRAINT `tb_event_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `tb_anggota_kim` (`id_event`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_event` (`id_event`, `id_anggota`, `bobot_event`, `nama_event`) VALUES ('E001NquK2T', 'K001ZkqfYh', '3', 'Pelantikan, Monitoring, Pekan KIM');
INSERT INTO `tb_event` (`id_event`, `id_anggota`, `bobot_event`, `nama_event`) VALUES ('E002BsalU2', 'K002Be27B2', '7', 'Pelantikan, Monitoring, Giat Desa, Bimtek, Studi Banding, Pekan KIM, Lomba Des');
INSERT INTO `tb_event` (`id_event`, `id_anggota`, `bobot_event`, `nama_event`) VALUES ('E0031PCKqw', 'K003s39wwX', '1', 'Pelantikan');
INSERT INTO `tb_event` (`id_event`, `id_anggota`, `bobot_event`, `nama_event`) VALUES ('E004etg6MG', 'K0044IOAdG', '2', 'Pelantikan, Lomba Agustusan');
INSERT INTO `tb_event` (`id_event`, `id_anggota`, `bobot_event`, `nama_event`) VALUES ('E0057I8AHd', 'K005TfkT7V', '2', 'Pelantikan, Monitoring');
INSERT INTO `tb_event` (`id_event`, `id_anggota`, `bobot_event`, `nama_event`) VALUES ('E0064dOxDw', 'K006l5ST0V', '4', 'Pelantikan, Giat Desa, Pekan KIM, apa yaa');


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
  `nama_medsos` text NOT NULL,
  PRIMARY KEY (`id_medsos`),
  KEY `id_anggota` (`id_anggota`),
  CONSTRAINT `tb_medsos_ibfk_1` FOREIGN KEY (`id_medsos`) REFERENCES `tb_anggota_kim` (`id_medsos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_medsos` (`id_medsos`, `id_anggota`, `bobot_medsos`, `nama_medsos`) VALUES ('M001yA0dlK', 'K001ZkqfYh', '3', 'Instagram, Facebook, Youtube');
INSERT INTO `tb_medsos` (`id_medsos`, `id_anggota`, `bobot_medsos`, `nama_medsos`) VALUES ('M0025AMGTb', 'K002Be27B2', '2', 'Instagram, Youtube');
INSERT INTO `tb_medsos` (`id_medsos`, `id_anggota`, `bobot_medsos`, `nama_medsos`) VALUES ('M003AaYdi9', 'K003s39wwX', '1', 'Instagram');
INSERT INTO `tb_medsos` (`id_medsos`, `id_anggota`, `bobot_medsos`, `nama_medsos`) VALUES ('M004JoYhS9', 'K0044IOAdG', '2', 'Shopee, Tokped');
INSERT INTO `tb_medsos` (`id_medsos`, `id_anggota`, `bobot_medsos`, `nama_medsos`) VALUES ('M005h67Kqv', 'K005TfkT7V', '2', 'Instagram, Twitter');
INSERT INTO `tb_medsos` (`id_medsos`, `id_anggota`, `bobot_medsos`, `nama_medsos`) VALUES ('M0060Pjhb3', 'K006l5ST0V', '2', 'Twitter, Tiktok');


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

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama`, `keterangan`, `email`, `password`, `id_level`) VALUES ('A001bnHDs', 'Erik Wahyudi', 'admin utama', 'erik@gmail.com', '202cb962ac59075b964b07152d234b70', '1');
INSERT INTO `tb_pengguna` (`id_pengguna`, `nama`, `keterangan`, `email`, `password`, `id_level`) VALUES ('A002WwImkL', 'Caesar', 'Admin 1', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', '2');


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

INSERT INTO `tb_sanksi` (`id_sanksi`, `id_anggota`, `bobot_sanksi`) VALUES ('S0011ACb3v', 'K001ZkqfYh', '4');
INSERT INTO `tb_sanksi` (`id_sanksi`, `id_anggota`, `bobot_sanksi`) VALUES ('S002Tghk0P', 'K002Be27B2', '4');
INSERT INTO `tb_sanksi` (`id_sanksi`, `id_anggota`, `bobot_sanksi`) VALUES ('S003AwqoCZ', 'K003s39wwX', '2');
INSERT INTO `tb_sanksi` (`id_sanksi`, `id_anggota`, `bobot_sanksi`) VALUES ('S004TDar9q', 'K0044IOAdG', '3');
INSERT INTO `tb_sanksi` (`id_sanksi`, `id_anggota`, `bobot_sanksi`) VALUES ('S005YAz2xH', 'K005TfkT7V', '3');
INSERT INTO `tb_sanksi` (`id_sanksi`, `id_anggota`, `bobot_sanksi`) VALUES ('S006KbE31s', 'K006l5ST0V', '3');


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

INSERT INTO `tb_website` (`id_website`, `id_anggota`, `bobot_website`) VALUES ('W001ytGNgZ', 'K001ZkqfYh', '3');
INSERT INTO `tb_website` (`id_website`, `id_anggota`, `bobot_website`) VALUES ('W002qOZ4Un', 'K002Be27B2', '3');
INSERT INTO `tb_website` (`id_website`, `id_anggota`, `bobot_website`) VALUES ('W003CUdZkH', 'K003s39wwX', '2');
INSERT INTO `tb_website` (`id_website`, `id_anggota`, `bobot_website`) VALUES ('W004kg2pD7', 'K0044IOAdG', '3');
INSERT INTO `tb_website` (`id_website`, `id_anggota`, `bobot_website`) VALUES ('W005ACuvrf', 'K005TfkT7V', '2');
INSERT INTO `tb_website` (`id_website`, `id_anggota`, `bobot_website`) VALUES ('W006Ij02mj', 'K006l5ST0V', '2');


