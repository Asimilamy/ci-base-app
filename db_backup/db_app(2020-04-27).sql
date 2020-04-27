/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : db_app

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 27/04/2020 19:02:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for code_generator_parts
-- ----------------------------
DROP TABLE IF EXISTS `code_generator_parts`;
CREATE TABLE `code_generator_parts`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code_generator_id` bigint(20) NOT NULL,
  `order` char(2) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `part` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `value` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `separator` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `code_format_kd`(`code_generator_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 77 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of code_generator_parts
-- ----------------------------
INSERT INTO `code_generator_parts` VALUES (17, 1, '0', 'yyyy', NULL, '.', '2019-07-24 21:09:34', NULL);
INSERT INTO `code_generator_parts` VALUES (18, 1, '1', 'mm', NULL, '.', '2019-07-24 21:09:34', NULL);
INSERT INTO `code_generator_parts` VALUES (19, 1, '2', 'dd', NULL, '.', '2019-07-24 21:09:34', NULL);
INSERT INTO `code_generator_parts` VALUES (20, 1, '3', 'urutan_angka', '00001', 'n', '2019-07-24 21:09:34', NULL);
INSERT INTO `code_generator_parts` VALUES (21, 2, '0', 'yy_roman', NULL, '.', '2019-07-24 22:23:56', NULL);
INSERT INTO `code_generator_parts` VALUES (22, 2, '1', 'mm_roman', NULL, '.', '2019-07-24 22:23:56', NULL);
INSERT INTO `code_generator_parts` VALUES (23, 2, '2', 'dd_roman', NULL, '.', '2019-07-24 22:23:56', NULL);
INSERT INTO `code_generator_parts` VALUES (24, 2, '3', 'urutan_angka', '00001', 'n', '2019-07-24 22:23:56', NULL);
INSERT INTO `code_generator_parts` VALUES (25, 3, '0', 'yy_roman', NULL, '.', '2019-07-24 22:40:10', NULL);
INSERT INTO `code_generator_parts` VALUES (26, 3, '1', 'mm_roman', NULL, '.', '2019-07-24 22:40:10', NULL);
INSERT INTO `code_generator_parts` VALUES (27, 3, '2', 'dd_roman', NULL, '.', '2019-07-24 22:40:10', NULL);
INSERT INTO `code_generator_parts` VALUES (28, 3, '3', 'urutan_angka', '001', 'n', '2019-07-24 22:40:10', NULL);
INSERT INTO `code_generator_parts` VALUES (29, 4, '0', 'yy', NULL, '.', '2019-07-24 22:40:49', NULL);
INSERT INTO `code_generator_parts` VALUES (30, 4, '1', 'mm', NULL, '.', '2019-07-24 22:40:49', NULL);
INSERT INTO `code_generator_parts` VALUES (31, 4, '2', 'dd', NULL, '.', '2019-07-24 22:40:49', NULL);
INSERT INTO `code_generator_parts` VALUES (32, 4, '3', 'urutan_angka', '0001', 'n', '2019-07-24 22:40:49', NULL);
INSERT INTO `code_generator_parts` VALUES (53, 8, '0', 'yyyy', NULL, '.', '2019-09-19 17:38:13', NULL);
INSERT INTO `code_generator_parts` VALUES (54, 8, '1', 'mm', NULL, '.', '2019-09-19 17:38:13', NULL);
INSERT INTO `code_generator_parts` VALUES (55, 8, '2', 'dd', NULL, '.', '2019-09-19 17:38:13', NULL);
INSERT INTO `code_generator_parts` VALUES (56, 8, '3', 'urutan_angka', '1', '.', '2019-09-19 17:38:13', NULL);
INSERT INTO `code_generator_parts` VALUES (57, 7, '0', 'yy', NULL, '.', '2019-09-19 18:00:50', NULL);
INSERT INTO `code_generator_parts` VALUES (58, 7, '1', 'mm', NULL, '.', '2019-09-19 18:00:50', NULL);
INSERT INTO `code_generator_parts` VALUES (59, 7, '2', 'dd', NULL, '.', '2019-09-19 18:00:50', NULL);
INSERT INTO `code_generator_parts` VALUES (60, 7, '3', 'urutan_angka', '1', 'n', '2019-09-19 18:00:50', NULL);
INSERT INTO `code_generator_parts` VALUES (61, 9, '0', 'yy_roman', NULL, '.', '2019-09-19 18:27:10', NULL);
INSERT INTO `code_generator_parts` VALUES (62, 9, '1', 'mm', NULL, '.', '2019-09-19 18:27:10', NULL);
INSERT INTO `code_generator_parts` VALUES (63, 9, '2', 'dd_roman', NULL, '.', '2019-09-19 18:27:10', NULL);
INSERT INTO `code_generator_parts` VALUES (64, 9, '3', 'urutan_angka', '01', 'n', '2019-09-19 18:27:10', NULL);
INSERT INTO `code_generator_parts` VALUES (65, 10, '0', 'yy_roman', NULL, '.', '2019-09-26 02:05:52', NULL);
INSERT INTO `code_generator_parts` VALUES (66, 10, '1', 'mm', NULL, '.', '2019-09-26 02:05:52', NULL);
INSERT INTO `code_generator_parts` VALUES (67, 10, '2', 'dd_roman', NULL, '.', '2019-09-26 02:05:52', NULL);
INSERT INTO `code_generator_parts` VALUES (68, 10, '3', 'urutan_angka', '001', 'n', '2019-09-26 02:05:52', NULL);
INSERT INTO `code_generator_parts` VALUES (73, 11, '0', 'yy', NULL, '.', '2019-09-26 23:20:39', NULL);
INSERT INTO `code_generator_parts` VALUES (74, 11, '1', 'mm', NULL, '.', '2019-09-26 23:20:39', NULL);
INSERT INTO `code_generator_parts` VALUES (75, 11, '2', 'dd', NULL, '.', '2019-09-26 23:20:39', NULL);
INSERT INTO `code_generator_parts` VALUES (76, 11, '3', 'urutan_angka', '01', 'n', '2019-09-26 23:20:39', NULL);

-- ----------------------------
-- Table structure for code_generators
-- ----------------------------
DROP TABLE IF EXISTS `code_generators`;
CREATE TABLE `code_generators`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `at_table` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `at_column` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `format` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `on_reset` char(5) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of code_generators
-- ----------------------------
INSERT INTO `code_generators` VALUES (1, 'Format Kode Pasien', 'patients', 'patient_code', 'yyyy.mm.dd.urutan_angka[00001]', 'year', '2019-07-24 20:05:08', '2019-07-24 21:09:34');
INSERT INTO `code_generators` VALUES (2, 'Format Kode Rekam Medik', 'checkups', 'medical_record_id', 'yy_roman.mm_roman.dd_roman.urutan_angka[00001]', 'day', '2019-07-24 22:23:56', '2019-07-24 22:23:56');
INSERT INTO `code_generators` VALUES (3, 'Format Code Dokter', 'doctors', 'doctor_id', 'yy_roman.mm_roman.dd_roman.urutan_angka[001]', 'year', '2019-07-24 22:40:10', '2019-07-24 22:40:10');
INSERT INTO `code_generators` VALUES (4, 'Format Code Pegawai', 'employees', 'employee_id', 'yy.mm.dd.urutan_angka[0001]', 'year', '2019-07-24 22:40:49', '2019-07-24 22:40:49');
INSERT INTO `code_generators` VALUES (7, 'Kode Supplier', 'supplier', 'supplier_code', 'yy.mm.dd.urutan_angka[1]', 'year', '2019-09-19 17:35:16', '2019-09-19 18:00:50');
INSERT INTO `code_generators` VALUES (8, 'No Retur', 'purchase_return', 'no_retur', 'yyyy.mm.dd.urutan_angka[1].', 'day', '2019-09-19 17:37:42', '2019-09-19 17:38:13');
INSERT INTO `code_generators` VALUES (9, 'No Faktur', 'purchase', 'no_faktur', 'yy_roman.mm.dd_roman.urutan_angka[01]', 'day', '2019-09-19 18:27:10', '2019-09-19 18:27:10');
INSERT INTO `code_generators` VALUES (10, 'No Faktur', 'drug_purchase', 'no_faktur', 'yy_roman.mm.dd_roman.urutan_angka[001]', 'day', '2019-09-26 02:05:52', '2019-09-26 02:05:52');
INSERT INTO `code_generators` VALUES (11, 'No Retur', 'sales_return', 'no_retur', 'yy.mm.dd.urutan_angka[01]', 'day', '2019-09-26 23:20:12', '2019-09-26 23:20:39');

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `address` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `is_active` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '1',
  `notes` text CHARACTER SET latin1 COLLATE latin1_general_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1, 'Test Customer', 'Address of test customer', '1', NULL, '2020-03-18 11:50:48', '2020-03-18 11:56:04');

-- ----------------------------
-- Table structure for inventories
-- ----------------------------
DROP TABLE IF EXISTS `inventories`;
CREATE TABLE `inventories`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `brand` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `qty` double NOT NULL,
  `unit` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `is_active` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT '1',
  `notes` text CHARACTER SET latin1 COLLATE latin1_general_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `code`(`code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of inventories
-- ----------------------------
INSERT INTO `inventories` VALUES (1, '1001', 'Box Panel Indor (2400x800x2000)mm + Acrylic cover ex lokal', '', 10, 'Unit', '1', '', '2020-02-28 15:19:54', '2020-02-28 15:19:54');
INSERT INTO `inventories` VALUES (2, '1002', 'Box Panel Indor (1200x800x300)mm ex lokal', '', 0, 'Unit', '1', '', '2020-02-28 15:22:47', '2020-02-28 15:22:47');
INSERT INTO `inventories` VALUES (3, '1003', 'Box Panel Indoor (1000x800x300)mm ex lokal', '', 0, '', '1', '', '2020-02-28 15:22:47', '2020-02-28 15:22:47');
INSERT INTO `inventories` VALUES (4, '1004', 'Box Panel Indoor (800x600x250)mm ex lokal', '', 1, 'Unit', '1', '', '2020-02-28 17:29:09', '2020-02-28 17:29:09');
INSERT INTO `inventories` VALUES (5, '1128', 'Pipa PVC 3/4\"', 'Wavin', 300, 'Pcs', '1', '', '2020-02-28 17:33:47', '2020-02-28 17:33:47');
INSERT INTO `inventories` VALUES (6, '1129', 'Pipa PVC 2\"', 'Wavin', 0, 'Pcs', '1', '', '2020-02-28 17:33:47', '2020-02-28 17:33:47');
INSERT INTO `inventories` VALUES (7, '1130', 'Pipa PVC 1 1/2', 'Wavin', 0, 'Pcs', '1', '', '2020-02-28 17:36:21', '2020-02-28 17:36:21');
INSERT INTO `inventories` VALUES (8, '1131', 'Flexible PVC 20mm', 'Ega', 800, 'Pcs', '1', '', '2020-02-28 17:38:35', '2020-02-28 17:38:35');
INSERT INTO `inventories` VALUES (9, '1134', 'Klem PVC 20mm', 'Ega', 202, 'Pcs', '1', '', '2020-02-28 17:36:21', '2020-02-28 17:36:21');
INSERT INTO `inventories` VALUES (10, '1135', 'klem PVC 20mm', 'Sigma', 0, 'Pcs', '1', '', '2020-02-28 17:38:35', '2020-02-28 17:38:35');

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `link` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `level` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `order` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `module` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'admin',
  `is_global` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `is_active` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `notes` text CHARACTER SET latin1 COLLATE latin1_general_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (1, NULL, 'dashboard', 'dashboard', 'Dashboard', 'fa fa-dashboard', '0', '1', 'admin', '0', '1', NULL, '2020-03-16 20:17:31', '2020-03-16 20:17:31');
INSERT INTO `menus` VALUES (2, NULL, 'profile', 'profile', 'Profile', 'fa fa-user', '0', '5', 'admin', '0', '1', NULL, '2020-03-16 20:18:00', '2020-03-17 22:08:21');
INSERT INTO `menus` VALUES (3, NULL, 'system', 'javascript:void(0);', 'System', 'fa fa-cogs', '0', '6', 'admin', '0', '1', NULL, '2020-03-16 20:18:23', '2020-03-17 22:08:38');
INSERT INTO `menus` VALUES (4, 3, 'user', 'user', 'User', 'fa fa-circle-o', '1', '1', 'admin', '0', '0', NULL, '2020-03-16 20:18:47', '2020-03-16 20:18:47');
INSERT INTO `menus` VALUES (5, 3, 'app_menu', 'menu', 'App Menu', 'fa fa-circle-o', '1', '2', 'admin', '0', '0', NULL, '2020-03-16 20:19:20', '2020-03-16 20:19:20');
INSERT INTO `menus` VALUES (6, 3, 'privilige', 'privilege', 'Privilege', 'fa fa-circle-o', '1', '2', 'admin', '0', '1', NULL, '2020-03-16 20:19:49', '2020-03-16 20:19:49');
INSERT INTO `menus` VALUES (7, 9, 'inventory', 'inventory', 'Inventory', 'fa fa-circle-o', '1', '2', 'admin', '0', '1', NULL, '2020-03-16 21:34:44', '2020-03-17 22:11:14');
INSERT INTO `menus` VALUES (8, 9, 'customer', 'customer', 'Customer', 'fa fa-circle-o', '1', '1', 'admin', '0', '1', NULL, '2020-03-16 21:35:43', '2020-03-17 22:11:02');
INSERT INTO `menus` VALUES (9, NULL, 'master', 'javascript:void(0);', 'Master', 'fa fa-archive', '0', '2', 'admin', '0', '1', NULL, '2020-03-17 22:05:19', '2020-03-17 22:05:19');
INSERT INTO `menus` VALUES (10, NULL, 'purchase', 'javascript:void(0);', 'Purchase', 'fa fa-shopping-cart', '0', '3', 'admin', '0', '1', NULL, '2020-03-17 22:06:50', '2020-03-17 22:07:57');
INSERT INTO `menus` VALUES (11, NULL, 'sales', 'javascript:void(0);', 'Sales', 'fa fa-shopping-basket', '0', '4', 'admin', '0', '1', NULL, '2020-03-17 22:07:29', '2020-03-17 22:07:29');
INSERT INTO `menus` VALUES (12, 10, 'purchase_order', 'purchase_order', 'Purchase Order', 'fa fa-circle-o', '1', '1', 'admin', '0', '1', NULL, '2020-03-17 22:19:09', '2020-03-17 22:19:09');
INSERT INTO `menus` VALUES (13, 11, 'sales_quotation', 'sales_quotation', 'Sales Quotation', 'fa fa-circle-o', '1', '1', 'admin', '0', '1', NULL, '2020-03-17 22:19:42', '2020-03-17 22:19:42');
INSERT INTO `menus` VALUES (14, 3, 'code_generator', 'code_generator', 'Code Generator', 'fa fa-circle-o', '1', '4', 'admin', '0', '1', NULL, NULL, '2020-04-27 18:37:54');
INSERT INTO `menus` VALUES (15, NULL, '', '', '', '', '', '', '', '', '0', NULL, NULL, '2020-04-27 18:37:38');

-- ----------------------------
-- Table structure for privilege_menus
-- ----------------------------
DROP TABLE IF EXISTS `privilege_menus`;
CREATE TABLE `privilege_menus`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `privilege_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `can_create` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `can_read` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `can_update` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `can_delete` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 57 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of privilege_menus
-- ----------------------------
INSERT INTO `privilege_menus` VALUES (43, 1, 1, '1', '1', '1', '1', '2020-04-27 18:38:02', NULL);
INSERT INTO `privilege_menus` VALUES (44, 1, 9, '1', '1', '1', '1', '2020-04-27 18:38:02', NULL);
INSERT INTO `privilege_menus` VALUES (45, 1, 8, '1', '1', '1', '1', '2020-04-27 18:38:02', NULL);
INSERT INTO `privilege_menus` VALUES (46, 1, 7, '1', '1', '1', '1', '2020-04-27 18:38:02', NULL);
INSERT INTO `privilege_menus` VALUES (47, 1, 10, '1', '1', '1', '1', '2020-04-27 18:38:02', NULL);
INSERT INTO `privilege_menus` VALUES (48, 1, 12, '1', '1', '1', '1', '2020-04-27 18:38:02', NULL);
INSERT INTO `privilege_menus` VALUES (49, 1, 11, '1', '1', '1', '1', '2020-04-27 18:38:02', NULL);
INSERT INTO `privilege_menus` VALUES (50, 1, 13, '1', '1', '1', '1', '2020-04-27 18:38:02', NULL);
INSERT INTO `privilege_menus` VALUES (51, 1, 2, '1', '1', '1', '1', '2020-04-27 18:38:02', NULL);
INSERT INTO `privilege_menus` VALUES (52, 1, 3, '1', '1', '1', '1', '2020-04-27 18:38:02', NULL);
INSERT INTO `privilege_menus` VALUES (53, 1, 4, '1', '1', '1', '1', '2020-04-27 18:38:02', NULL);
INSERT INTO `privilege_menus` VALUES (54, 1, 5, '1', '1', '1', '1', '2020-04-27 18:38:02', NULL);
INSERT INTO `privilege_menus` VALUES (55, 1, 6, '1', '1', '1', '1', '2020-04-27 18:38:02', NULL);
INSERT INTO `privilege_menus` VALUES (56, 1, 14, '1', '1', '1', '1', '2020-04-27 18:38:02', NULL);

-- ----------------------------
-- Table structure for privileges
-- ----------------------------
DROP TABLE IF EXISTS `privileges`;
CREATE TABLE `privileges`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `level` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `is_active` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `notes` text CHARACTER SET latin1 COLLATE latin1_general_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of privileges
-- ----------------------------
INSERT INTO `privileges` VALUES (1, NULL, 'Developer', '0', '1', NULL, '2020-03-16 18:55:54', '2020-03-16 18:56:51');
INSERT INTO `privileges` VALUES (2, 1, 'Admin', '1', '1', NULL, '2020-03-16 18:56:17', '2020-03-16 18:56:17');
INSERT INTO `privileges` VALUES (3, 2, 'User', '2', '1', NULL, '2020-03-16 18:56:39', '2020-03-16 18:56:39');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `privilege_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `notes` text CHARACTER SET latin1 COLLATE latin1_general_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 1, 'Developer Admin', 'devadmin', 'devadmin@email.com', '$2y$10$9s3pnf21mK0alzhn2fQUWOe4zaSfePK9cTsnPHGidCygQP305.2IO', NULL, '2009-08-04 07:45:36', '2020-03-15 02:22:43');

SET FOREIGN_KEY_CHECKS = 1;
