/*
 Navicat Premium Dump SQL

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 100119 (10.1.19-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : test_database

 Target Server Type    : MySQL
 Target Server Version : 100119 (10.1.19-MariaDB)
 File Encoding         : 65001

 Date: 14/03/2025 10:58:58
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (1, 'admin', 'MAIN_ADMIN', 'd8578edf8458ce06fbc5bb76a58c5ca4');

-- ----------------------------
-- Table structure for barang
-- ----------------------------
DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `harga` double NOT NULL,
  `stok` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of barang
-- ----------------------------
INSERT INTO `barang` VALUES (1, '202503130001', 'roti', 5000, 30);
INSERT INTO `barang` VALUES (2, '202503130002', 'Susu', 6000, 50);
INSERT INTO `barang` VALUES (3, '202503140001', 'Roti Coklat', 4000, 35);

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
INSERT INTO `log` VALUES ('2025-03-04 09:51:06', 'Default', 'Update', 'Transaksi', '20250304075512;2025-03-04 09:46:59;Ponidi;9000000', '20250304075512;2025-03-04 09:46:59;Ponian;9000000');
INSERT INTO `log` VALUES ('2025-03-04 09:51:19', 'Default', 'Update', 'Transaksi', '20250304081808;2025-03-04 08:18:08;dana;1000000000000', '20250304081808;2025-03-04 08:18:08;dana;1000000000');
INSERT INTO `log` VALUES ('2025-03-04 12:26:45', 'Default', 'Delete', 'Transaksi', '20250304075004;2025-03-04 07:50:04;Jajan;9000000', '_');
INSERT INTO `log` VALUES ('2025-03-04 12:26:47', 'Default', 'Delete', 'Transaksi', '20250304075447;2025-03-04 07:54:47;OKY EKA NOORRAFIF;500000', '_');
INSERT INTO `log` VALUES ('2025-03-04 12:26:48', 'Default', 'Delete', 'Transaksi', '20250304075512;2025-03-04 09:46:59;Ponian;9000000', '_');
INSERT INTO `log` VALUES ('2025-03-04 12:26:50', 'Default', 'Delete', 'Transaksi', '20250304081808;2025-03-04 08:18:08;dana;1000000000', '_');
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
INSERT INTO `log` VALUES ('2025-03-05 07:38:32', 'Default', 'Update', 'Barang', '20250303160123;minyak;12000;40', '20250303160123;minyak;12000;45');
INSERT INTO `log` VALUES ('2025-03-05 12:37:49', 'Default', 'Create', 'Barang', '_', '20250305123749;sambal;10000;43');
INSERT INTO `log` VALUES ('2025-03-05 12:40:14', 'Default', 'Create', 'Barang', '_', '20250305124014;baju;55000;18');
INSERT INTO `log` VALUES ('2025-03-05 12:40:40', 'Default', 'Create', 'Barang', '_', '20250305124040;susu;20000;25');
INSERT INTO `log` VALUES ('2025-03-05 13:23:29', 'Default', 'Create', 'Transaksi', '_', '202503050004;2025-03-05 13:23:29;damar;7200000');
INSERT INTO `log` VALUES ('2025-03-06 14:59:46', 'Default', 'Create', 'Orang', '_', '20250306145946;anak2;22;Laki-laki;deewfedwafsg');
INSERT INTO `log` VALUES ('2025-03-06 15:00:03', 'Default', 'Create', 'Orang', '_', '20250306150003;jisu;23;Laki-laki;dgsejpdapsjpas');
INSERT INTO `log` VALUES ('2025-03-06 15:00:18', 'Default', 'Create', 'Orang', '_', '20250306150018;kod;23;Laki-laki;hfahfadddwadwqf');
INSERT INTO `log` VALUES ('2025-03-06 15:00:27', 'Default', 'Create', 'Orang', '_', '20250306150027;mamad;22;Laki-laki;fhtte4t4rwfesf');
INSERT INTO `log` VALUES ('2025-03-06 15:00:42', 'Default', 'Create', 'Orang', '_', '20250306150042;kosl;66;Perempuan;dawfjdpoopvdsv');
INSERT INTO `log` VALUES ('2025-03-06 15:00:55', 'Default', 'Create', 'Orang', '_', '20250306150055;moom;44;Perempuan;dawdweqwjoe');
INSERT INTO `log` VALUES ('2025-03-06 15:01:12', 'Default', 'Create', 'Orang', '_', '20250306150112;ojih;21;Perempuan;oppppppppooopp');
INSERT INTO `log` VALUES ('2025-03-06 15:01:25', 'Default', 'Create', 'Orang', '_', '20250306150125;raka;99;Laki-laki;cbjkabvajbafb');
INSERT INTO `log` VALUES ('2025-03-06 15:01:42', 'Default', 'Create', 'Orang', '_', '20250306150142;nyaa;17;Perempuan;nyaaaaaaaaa');
INSERT INTO `log` VALUES ('2025-03-06 15:02:17', 'Default', 'Create', 'Orang', '_', '20250306150217;nono;18;Perempuan;hiwuwq9fu90');
INSERT INTO `log` VALUES ('2025-03-06 15:02:33', 'Default', 'Create', 'Orang', '_', '20250306150233;dalala;19;Perempuan;wokdowpako2okop');
INSERT INTO `log` VALUES ('2025-03-07 09:22:28', 'Default', 'Create', 'Orang', '_', '20250307092228;nyayi;55;Perempuan;dg.fsfseeerw');
INSERT INTO `log` VALUES ('2025-03-07 09:22:48', 'Default', 'Create', 'Orang', '_', '20250307092248;wali;22;Laki-laki;dvfbgnhmj,k');
INSERT INTO `log` VALUES ('2025-03-07 09:23:07', 'Default', 'Create', 'Orang', '_', '20250307092307;sri;33;Perempuan;momoaowfjawd');
INSERT INTO `log` VALUES ('2025-03-07 09:23:25', 'Default', 'Create', 'Orang', '_', '20250307092325;momo;19;Perempuan;koalaadawdof');
INSERT INTO `log` VALUES ('2025-03-07 09:23:44', 'Default', 'Create', 'Orang', '_', '20250307092344;rere;19;Perempuan;gigijigvisjggij');
INSERT INTO `log` VALUES ('2025-03-07 09:23:58', 'Default', 'Create', 'Orang', '_', '20250307092358;sams;33;Laki-laki;ggggggggggggggggggggggggggggg');
INSERT INTO `log` VALUES ('2025-03-07 09:24:14', 'Default', 'Create', 'Orang', '_', '20250307092414;lak;25;Laki-laki;kkkkkkkkkkkkkkkkkkkkkkkkkk');
INSERT INTO `log` VALUES ('2025-03-07 09:24:29', 'Default', 'Create', 'Orang', '_', '20250307092429;juju;66;Laki-laki;ddddddddddddddddddddd');
INSERT INTO `log` VALUES ('2025-03-07 09:24:47', 'Default', 'Create', 'Orang', '_', '20250307092447;dio;55;Laki-laki;ibvpbebaefawfaw');
INSERT INTO `log` VALUES ('2025-03-07 14:39:04', 'Default', 'Create', 'Transaksi', '_', '202503070001;2025-03-07 14:39:04;luna;7000000');
INSERT INTO `log` VALUES ('2025-03-07 15:52:08', 'Default', 'Create', 'Orang', '_', '20250307155208;hhd;33;Laki-laki;proporpora');
INSERT INTO `log` VALUES ('2025-03-07 15:52:45', 'Default', 'Create', 'Barang', '_', '20250307155245;biskuit;10000;78');
INSERT INTO `log` VALUES ('2025-03-07 15:53:43', 'Default', 'Update', 'Barang', '20250307155245;biskuit;10000;78', '20250307155245;biskuit;10000;28');
INSERT INTO `log` VALUES ('2025-03-07 15:54:06', 'Default', 'Update', 'Transaksi', '202503070001;2025-03-07 14:39:04;luna;7000000', '202503070001;2025-03-07 14:39:04;luna;7700000');
INSERT INTO `log` VALUES ('2025-03-10 15:27:08', 'Default', 'Create', 'Orang', '_', '20250310152708;reca;22;Perempuan;yuadjawdawdwdaw');
INSERT INTO `log` VALUES ('2025-03-10 15:28:04', 'Default', 'Create', 'Orang', '_', '20250310152804;pos;34;Laki-laki;posdapdkfaege');
INSERT INTO `log` VALUES ('2025-03-10 15:29:15', 'Default', 'Create', 'Orang', '_', '20250310152915;reme;22;Perempuan;ghj,kmk,ggnfgb');
INSERT INTO `log` VALUES ('2025-03-10 15:30:55', 'Default', 'Create', 'Orang', '_', '20250310153055;nyawa;22;Perempuan;grhtrtrjjtrj');
INSERT INTO `log` VALUES ('2025-03-10 15:37:06', 'Default', 'Create', 'Barang', '_', '20250310153706;sabun;6000;31');
INSERT INTO `log` VALUES ('2025-03-10 16:32:59', 'Default', 'Create', 'Barang', '_', '20250310163259;jus;7000;44');
INSERT INTO `log` VALUES ('2025-03-10 16:33:17', 'Default', 'Create', 'Orang', '_', '20250310163317;wati;23;Perempuan;dawjoiifawfawiagwi');
INSERT INTO `log` VALUES ('2025-03-10 16:33:39', 'Default', 'Create', 'Transaksi', '_', '202503100001;2025-03-10 16:33:39;waluyo;9100000');
INSERT INTO `log` VALUES ('2025-03-11 07:00:41', 'Default', 'Create', 'Orang', '_', '20250311070041;koa;18;Laki-laki;xxxxxxxxxx');
INSERT INTO `log` VALUES ('2025-03-11 07:18:47', 'Default', 'Create', 'Transaksi', '_', '202503110001;2025-03-11 07:18:47;tumi;1000000');
INSERT INTO `log` VALUES ('2025-03-13 07:49:46', 'Default', 'Create', 'Orang', '_', '20250313074946;aprilia;21;Perempuan;polaassdad');
INSERT INTO `log` VALUES ('2025-03-13 07:51:50', 'Default', 'Create', 'Orang', '_', '20250313075150;johan;19;Laki-laki;ssisssssaw');
INSERT INTO `log` VALUES ('2025-03-13 07:57:22', 'Default', 'Create', 'Orang', '_', '202503130001;aprilia;22;Perempuan;odwpdpawffaw');
INSERT INTO `log` VALUES ('2025-03-13 07:57:38', 'Default', 'Create', 'Orang', '_', '202503130001;johan;19;Laki-laki;siffkoefag');
INSERT INTO `log` VALUES ('2025-03-13 07:58:31', 'Default', 'Delete', 'Orang', '2;202503130001;johan;19;Laki-laki;siffkoefag', '_');
INSERT INTO `log` VALUES ('2025-03-13 07:58:44', 'Default', 'Create', 'Orang', '_', '202503130001;johan;19;Laki-laki;pkjpjadwjaf');
INSERT INTO `log` VALUES ('2025-03-13 08:00:39', 'Default', 'Delete', 'Orang', '3;202503130001;johan;19;Laki-laki;pkjpjadwjaf', '_');
INSERT INTO `log` VALUES ('2025-03-13 08:00:52', 'Default', 'Create', 'Orang', '_', '202503130001;johan;19;Laki-laki;oofpjafwaafjpo');
INSERT INTO `log` VALUES ('2025-03-13 08:03:43', 'Default', 'Create', 'Orang', '_', '202503130002;wiwi;21;Perempuan;sdfghjklfgh');
INSERT INTO `log` VALUES ('2025-03-13 08:03:50', 'Default', 'Delete', 'Orang', '4;202503130001;johan;19;Laki-laki;oofpjafwaafjpo', '_');
INSERT INTO `log` VALUES ('2025-03-13 08:04:25', 'Default', 'Create', 'Orang', '_', '202503130003;johan;19;Laki-laki;qwertyuiop');
INSERT INTO `log` VALUES ('2025-03-13 08:12:30', 'Default', 'Create', 'Barang', '_', '202503130001;roti;5000;30');
INSERT INTO `log` VALUES ('2025-03-13 08:13:01', 'Default', 'Create', 'Barang', '_', '202503130002;Susu;6000;50');
INSERT INTO `log` VALUES ('2025-03-14 10:11:36', 'Default', 'Create', 'Barang', '_', '202503140001;Roti Coklat;4000;35');

-- ----------------------------
-- Table structure for orang
-- ----------------------------
DROP TABLE IF EXISTS `orang`;
CREATE TABLE `orang`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `umur` int NULL DEFAULT NULL,
  `jenis_kelamin` varchar(9) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of orang
-- ----------------------------
INSERT INTO `orang` VALUES (1, '202503130001', 'aprilia', 22, 'Perempuan', 'odwpdpawffaw');
INSERT INTO `orang` VALUES (5, '202503130002', 'wiwi', 21, 'Perempuan', 'sdfghjklfgh');
INSERT INTO `orang` VALUES (6, '202503130003', 'johan', 19, 'Laki-laki', 'qwertyuiop');

-- ----------------------------
-- Table structure for transaksi
-- ----------------------------
DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_customer` int NOT NULL,
  `id_barang` int NOT NULL,
  `jumlah` int NULL DEFAULT 1,
  `waktu` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of transaksi
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
