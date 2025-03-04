/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 100119 (10.1.19-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : test_database

 Target Server Type    : MySQL
 Target Server Version : 100119 (10.1.19-MariaDB)
 File Encoding         : 65001

 Date: 04/03/2025 15:52:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for barang
-- ----------------------------
DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang`  (
  `id_item` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_barang` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga` double NOT NULL,
  `stok` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_item`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of barang
-- ----------------------------
INSERT INTO `barang` VALUES ('20250303134039', 'tepung', 4000, 30);
INSERT INTO `barang` VALUES ('20250303160123', 'minyak', 12000, 40);
INSERT INTO `barang` VALUES ('20250304151416', 'coklat', 12000, 45);

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log`  (
  `waktu` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `akun` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jenis` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tabel` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `awal` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `akhir` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`waktu`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of log
-- ----------------------------
INSERT INTO `log` VALUES ('2025-03-03 11:40:25', 'Default', 'Delete', 'Orang', '20250303102923;aa;22;Laki-laki;aaaaaaaaaa', '_');
INSERT INTO `log` VALUES ('2025-03-03 11:47:08', 'Default', 'Delete', 'Orang', '20250303090610;OKY EKA NOORRAFIF;26;Perempuan;dafsghjjk.m', '_');
INSERT INTO `log` VALUES ('2025-03-03 11:47:36', 'Default', 'Delete', 'Orang', '20250303103627;d22;33;Perempuan;33eeddawwdadfefe', '_');
INSERT INTO `log` VALUES ('2025-03-03 12:14:18', 'Default', 'Delete', 'Barang', '6;jamu;9500;22', '_');
INSERT INTO `log` VALUES ('2025-03-03 13:40:39', 'Default', 'Create', 'Barang', '_', '20250303134039;tepung;4000;30');
INSERT INTO `log` VALUES ('2025-03-03 13:42:42', 'Default', 'Update', 'Barang', '2;snack;7500;45', '2;snack;7600;45');
INSERT INTO `log` VALUES ('2025-03-03 13:43:14', 'Default', 'Delete', 'Barang', '3;beras;25000;17', '_');
INSERT INTO `log` VALUES ('2025-03-03 14:57:19', 'Default', 'Update', 'Orang', '20250303094829;yama;33;Perempuan;poiuyterdsfg', '20250303094829;yamamoto;33;Perempuan;poiuyterdsfg');
INSERT INTO `log` VALUES ('2025-03-03 15:58:34', 'Default', 'Create', 'Orang', '_', '20250303155834;pada;23;Perempuan;dwgfafadawd');
INSERT INTO `log` VALUES ('2025-03-03 15:59:24', 'Default', 'Update', 'Orang', '20250303155834;pada;23;Perempuan;dwgfafadawd', '20250303155834;lara;23;Perempuan;dwgfafadawd');
INSERT INTO `log` VALUES ('2025-03-03 16:00:48', 'Default', 'Create', 'Orang', '_', '20250303160048;dddaaa;18;Laki-laki;dadadavvsv v    daw');
INSERT INTO `log` VALUES ('2025-03-03 16:01:06', 'Default', 'Delete', 'Orang', '20250303160048;dddaaa;18;Laki-laki;dadadavvsv v    daw', '_');
INSERT INTO `log` VALUES ('2025-03-03 16:01:23', 'Default', 'Create', 'Barang', '_', '20250303160123;minyak;12000;46');
INSERT INTO `log` VALUES ('2025-03-03 16:01:40', 'Default', 'Update', 'Barang', '20250303160123;minyak;12000;46', '20250303160123;minyak;12000;40');
INSERT INTO `log` VALUES ('2025-03-04 07:50:04', 'Default', 'Create', 'Transaksi', '_', '20250304075004;;Jajan;9000000');
INSERT INTO `log` VALUES ('2025-03-04 07:54:47', 'Default', 'Create', 'Transaksi', '_', '20250304075447;;OKY EKA NOORRAFIF;500000');
INSERT INTO `log` VALUES ('2025-03-04 07:55:12', 'Default', 'Create', 'Transaksi', '_', '20250304075512;;Poni;9000000');
INSERT INTO `log` VALUES ('2025-03-04 08:18:08', 'Default', 'Create', 'Transaksi', '_', '20250304081808;;dana;1000000000000');
INSERT INTO `log` VALUES ('2025-03-04 09:51:06', 'Default', 'Update', 'Transaksi', '20250304075512;2025-03-04 09:46:59;Ponidi;9000000', '20250304075512;2025-03-04 09:46:59;Ponian;9000000');
INSERT INTO `log` VALUES ('2025-03-04 09:51:19', 'Default', 'Update', 'Transaksi', '20250304081808;2025-03-04 08:18:08;dana;1000000000000', '20250304081808;2025-03-04 08:18:08;dana;1000000000');
INSERT INTO `log` VALUES ('2025-03-04 12:26:45', 'Default', 'Delete', 'Transaksi', '20250304075004;2025-03-04 07:50:04;Jajan;9000000', '_');
INSERT INTO `log` VALUES ('2025-03-04 12:26:47', 'Default', 'Delete', 'Transaksi', '20250304075447;2025-03-04 07:54:47;OKY EKA NOORRAFIF;500000', '_');
INSERT INTO `log` VALUES ('2025-03-04 12:26:48', 'Default', 'Delete', 'Transaksi', '20250304075512;2025-03-04 09:46:59;Ponian;9000000', '_');
INSERT INTO `log` VALUES ('2025-03-04 12:26:50', 'Default', 'Delete', 'Transaksi', '20250304081808;2025-03-04 08:18:08;dana;1000000000', '_');
INSERT INTO `log` VALUES ('2025-03-04 12:37:13', 'Default', 'Create', 'Transaksi', '_', '202503040001;;kina;300000');
INSERT INTO `log` VALUES ('2025-03-04 12:39:43', 'Default', 'Create', 'Transaksi', '_', '202503040002;;yuda;9000000');
INSERT INTO `log` VALUES ('2025-03-04 12:43:24', 'Default', 'Create', 'Transaksi', '_', '202503050001;;diona;1700000');
INSERT INTO `log` VALUES ('2025-03-04 15:12:50', 'Default', 'Create', 'Transaksi', '_', '202503040003;;wahyu;800000');
INSERT INTO `log` VALUES ('2025-03-04 15:13:01', 'Default', 'Update', 'Transaksi', '202503040003;2025-03-04 15:12:50;wahyu;800000', '202503040003;2025-03-04 15:12:50;wahyu;8000000');
INSERT INTO `log` VALUES ('2025-03-04 15:13:52', 'Default', 'Delete', 'Barang', '1;sabun;5000;30', '_');
INSERT INTO `log` VALUES ('2025-03-04 15:13:55', 'Default', 'Delete', 'Barang', '10;keju;12000;30', '_');
INSERT INTO `log` VALUES ('2025-03-04 15:13:57', 'Default', 'Delete', 'Barang', '2;snack;7600;45', '_');
INSERT INTO `log` VALUES ('2025-03-04 15:14:00', 'Default', 'Delete', 'Barang', '4;sampo;6000;50', '_');
INSERT INTO `log` VALUES ('2025-03-04 15:14:02', 'Default', 'Delete', 'Barang', '5;susu;10000;69', '_');
INSERT INTO `log` VALUES ('2025-03-04 15:14:04', 'Default', 'Delete', 'Barang', '8;coklat;9000;80', '_');
INSERT INTO `log` VALUES ('2025-03-04 15:14:06', 'Default', 'Delete', 'Barang', '9;permen;10000;60', '_');
INSERT INTO `log` VALUES ('2025-03-04 15:14:16', 'Default', 'Create', 'Barang', '_', '20250304151416;coklat;12000;45');
INSERT INTO `log` VALUES ('2025-03-04 15:35:12', 'Default', 'Create', 'Orang', '_', '20250304153512;d;33;Laki-laki;efdghgmjhgfdfgf');

-- ----------------------------
-- Table structure for orang
-- ----------------------------
DROP TABLE IF EXISTS `orang`;
CREATE TABLE `orang`  (
  `id` varchar(16) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `umur` int NULL DEFAULT NULL,
  `jenis_kelamin` varchar(9) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of orang
-- ----------------------------
INSERT INTO `orang` VALUES ('20250303090744', 'poiokfea', 43, 'Perempuan', 'dfghjk.hzhrhh');
INSERT INTO `orang` VALUES ('20250303090836', 'halo', 222, 'Laki-laki', '2345yhgffdvbbc');
INSERT INTO `orang` VALUES ('20250303090945', 'joko', 24, 'Laki-laki', 'hujdjaiwdj');
INSERT INTO `orang` VALUES ('20250303091802', 'naoto', 33, 'Perempuan', '9fjsjfkakjpadko');
INSERT INTO `orang` VALUES ('20250303091853', 'ramo', 33, 'Laki-laki', 'fsbffszhhgeag');
INSERT INTO `orang` VALUES ('20250303092243', 'pokdaow', 18, 'Perempuan', 'ddddddddddddddd');
INSERT INTO `orang` VALUES ('20250303092904', 'juid', 21, 'Perempuan', 'ddfgegesafadaad');
INSERT INTO `orang` VALUES ('20250303093304', 'halo', 18, 'Laki-laki', 'haloworlddd');
INSERT INTO `orang` VALUES ('20250303094829', 'yamamoto', 33, 'Perempuan', 'poiuyterdsfg');
INSERT INTO `orang` VALUES ('20250303095215', 'jidawjd', 55, 'Perempuan', 'tervaadfawfaf');
INSERT INTO `orang` VALUES ('20250303101000', 'hunia', 21, 'Perempuan', 'awbnr h h e  graw a');
INSERT INTO `orang` VALUES ('20250303101259', 'kdakwjd', 23, 'Perempuan', 'owque9qu2iawf');
INSERT INTO `orang` VALUES ('20250303101653', 'dfhzh', 43, 'Laki-laki', 'pondadwojfa ddd');
INSERT INTO `orang` VALUES ('20250303103500', 'yodaw', 43, 'Laki-laki', 'gwadadfggvv');
INSERT INTO `orang` VALUES ('20250303155834', 'lara', 23, 'Perempuan', 'dwgfafadawd');
INSERT INTO `orang` VALUES ('20250304153512', 'd', 33, 'Laki-laki', 'efdghgmjhgfdfgf');

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi`  (
  `id_transaksi` varchar(24) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `akun` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jumlah` double NULL DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of transaksi
-- ----------------------------
INSERT INTO `transaksi` VALUES ('202503040001', '2025-03-04 12:37:13', 'kina', 300000);
INSERT INTO `transaksi` VALUES ('202503040002', '2025-03-04 12:39:43', 'yuda', 9000000);
INSERT INTO `transaksi` VALUES ('202503040003', '2025-03-04 15:12:50', 'wahyu', 8000000);
INSERT INTO `transaksi` VALUES ('202503050001', '2025-03-04 12:43:24', 'diona', 1700000);

SET FOREIGN_KEY_CHECKS = 1;
