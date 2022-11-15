/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100803 (10.8.3-MariaDB-log)
 Source Host           : localhost:3306
 Source Schema         : katalog

 Target Server Type    : MySQL
 Target Server Version : 100803 (10.8.3-MariaDB-log)
 File Encoding         : 65001

 Date: 15/11/2022 08:32:21
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bgr_provinsis
-- ----------------------------
DROP TABLE IF EXISTS `bgr_provinsis`;
CREATE TABLE `bgr_provinsis`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `province` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bgr_provinsis
-- ----------------------------
INSERT INTO `bgr_provinsis` VALUES (1, 'Bali', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (2, 'Bangka Belitung', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (3, 'Banten', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (4, 'Bengkulu', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (5, 'DI Yogyakarta', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (6, 'DKI Jakarta', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (7, 'Gorontalo', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (8, 'Jambi', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (9, 'Jawa Barat', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (10, 'Jawa Tengah', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (11, 'Jawa Timur', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (12, 'Kalimantan Barat', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (13, 'Kalimantan Selatan', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (14, 'Kalimantan Tengah', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (15, 'Kalimantan Timur', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (16, 'Kalimantan Utara', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (17, 'Kepulauan Riau', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (18, 'Lampung', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (19, 'Maluku', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (20, 'Maluku Utara', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (21, 'Nanggroe Aceh Darussalam (NAD)', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (22, 'Nusa Tenggara Barat (NTB)', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (23, 'Nusa Tenggara Timur (NTT)', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (24, 'Papua', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (25, 'Papua Barat', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (26, 'Riau', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (27, 'Sulawesi Barat', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (28, 'Sulawesi Selatan', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (29, 'Sulawesi Tengah', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (30, 'Sulawesi Tenggara', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (31, 'Sulawesi Utara', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (32, 'Sumatera Barat', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (33, 'Sumatera Selatan', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);
INSERT INTO `bgr_provinsis` VALUES (34, 'Sumatera Utara', '2019-12-14 21:12:20', '2019-12-14 21:12:20', NULL);

SET FOREIGN_KEY_CHECKS = 1;
