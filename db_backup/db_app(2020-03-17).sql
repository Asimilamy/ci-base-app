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

 Date: 17/03/2020 22:25:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `link` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `level` int(1) NOT NULL,
  `order` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `module` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'admin',
  `is_global` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `is_active` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `notes` text CHARACTER SET latin1 COLLATE latin1_general_ci NULL,
  `created_at` timestamp(0) NOT NULL,
  `updated_at` timestamp(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (1, NULL, 'dashboard', 'dashboard', 'Dashboard', 'fa fa-dashboard', 0, '1', 'admin', '0', '1', '', '2020-03-16 20:17:31', '2020-03-16 20:17:31');
INSERT INTO `menus` VALUES (2, NULL, 'profile', 'profile', 'Profile', 'fa fa-user', 0, '5', 'admin', '0', '1', '', '2020-03-16 20:18:00', '2020-03-17 22:08:21');
INSERT INTO `menus` VALUES (3, NULL, 'system', 'javascript:void(0);', 'System', 'fa fa-cogs', 0, '6', 'admin', '0', '1', '', '2020-03-16 20:18:23', '2020-03-17 22:08:38');
INSERT INTO `menus` VALUES (4, 3, 'user', 'user', 'User', 'fa fa-circle-o', 1, '1', 'admin', '0', '0', '', '2020-03-16 20:18:47', '2020-03-16 20:18:47');
INSERT INTO `menus` VALUES (5, 3, 'app_menu', 'menu', 'App Menu', 'fa fa-circle-o', 1, '2', 'admin', '0', '0', '', '2020-03-16 20:19:20', '2020-03-16 20:19:20');
INSERT INTO `menus` VALUES (6, 3, 'privilige', 'privilege', 'Privilege', 'fa fa-circle-o', 1, '2', 'admin', '0', '1', '', '2020-03-16 20:19:49', '2020-03-16 20:19:49');
INSERT INTO `menus` VALUES (7, 9, 'inventory', 'inventory', 'Inventory', 'fa fa-circle-o', 1, '2', 'admin', '0', '1', '', '2020-03-16 21:34:44', '2020-03-17 22:11:14');
INSERT INTO `menus` VALUES (8, 9, 'customer', 'customer', 'Customer', 'fa fa-circle-o', 1, '1', 'admin', '0', '1', '', '2020-03-16 21:35:43', '2020-03-17 22:11:02');
INSERT INTO `menus` VALUES (9, NULL, 'master', 'javascript:void(0);', 'Master', 'fa fa-archive', 0, '2', 'admin', '0', '1', '', '2020-03-17 22:05:19', '2020-03-17 22:05:19');
INSERT INTO `menus` VALUES (10, NULL, 'purchase', 'javascript:void(0);', 'Purchase', 'fa fa-shopping-cart', 0, '3', 'admin', '0', '1', '', '2020-03-17 22:06:50', '2020-03-17 22:07:57');
INSERT INTO `menus` VALUES (11, NULL, 'sales', 'javascript:void(0);', 'Sales', 'fa fa-shopping-basket', 0, '4', 'admin', '0', '1', '', '2020-03-17 22:07:29', '2020-03-17 22:07:29');
INSERT INTO `menus` VALUES (12, 10, 'purchase_order', 'purchase_order', 'Purchase Order', 'fa fa-circle-o', 1, '1', 'admin', '0', '1', '', '2020-03-17 22:19:09', '2020-03-17 22:19:09');
INSERT INTO `menus` VALUES (13, 11, 'sales_quotation', 'sales_quotation', 'Sales Quotation', 'fa fa-circle-o', 1, '1', 'admin', '0', '1', '', '2020-03-17 22:19:42', '2020-03-17 22:19:42');

-- ----------------------------
-- Table structure for privilege_menus
-- ----------------------------
DROP TABLE IF EXISTS `privilege_menus`;
CREATE TABLE `privilege_menus`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `privilege_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `can_create` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `can_read` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `can_update` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `can_delete` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of privilege_menus
-- ----------------------------
INSERT INTO `privilege_menus` VALUES (16, 1, 1, '1', '1', '1', '1', '2020-03-17 22:19:57');
INSERT INTO `privilege_menus` VALUES (17, 1, 8, '1', '1', '1', '1', '2020-03-17 22:19:57');
INSERT INTO `privilege_menus` VALUES (18, 1, 9, '1', '1', '1', '1', '2020-03-17 22:19:57');
INSERT INTO `privilege_menus` VALUES (19, 1, 7, '1', '1', '1', '1', '2020-03-17 22:19:57');
INSERT INTO `privilege_menus` VALUES (20, 1, 12, '1', '1', '1', '1', '2020-03-17 22:19:57');
INSERT INTO `privilege_menus` VALUES (21, 1, 10, '1', '1', '1', '1', '2020-03-17 22:19:57');
INSERT INTO `privilege_menus` VALUES (22, 1, 13, '1', '1', '1', '1', '2020-03-17 22:19:57');
INSERT INTO `privilege_menus` VALUES (23, 1, 11, '1', '1', '1', '1', '2020-03-17 22:19:57');
INSERT INTO `privilege_menus` VALUES (24, 1, 2, '1', '1', '1', '1', '2020-03-17 22:19:57');
INSERT INTO `privilege_menus` VALUES (25, 1, 4, '1', '1', '1', '1', '2020-03-17 22:19:57');
INSERT INTO `privilege_menus` VALUES (26, 1, 3, '1', '1', '1', '1', '2020-03-17 22:19:57');
INSERT INTO `privilege_menus` VALUES (27, 1, 5, '1', '1', '1', '1', '2020-03-17 22:19:57');
INSERT INTO `privilege_menus` VALUES (28, 1, 6, '1', '1', '1', '1', '2020-03-17 22:19:57');

-- ----------------------------
-- Table structure for privileges
-- ----------------------------
DROP TABLE IF EXISTS `privileges`;
CREATE TABLE `privileges`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `level` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `is_active` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `notes` text CHARACTER SET latin1 COLLATE latin1_general_ci NULL,
  `created_at` timestamp(0) NOT NULL,
  `updated_at` timestamp(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of privileges
-- ----------------------------
INSERT INTO `privileges` VALUES (1, NULL, 'Developer', '0', '1', '', '2020-03-16 18:55:54', '2020-03-16 18:56:51');
INSERT INTO `privileges` VALUES (2, 1, 'Admin', '0', '1', '', '2020-03-16 18:56:17', '2020-03-16 18:56:17');
INSERT INTO `privileges` VALUES (3, 2, 'User', '0', '1', '', '2020-03-16 18:56:39', '2020-03-16 18:56:39');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `privilege_id` int(11) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `notes` text CHARACTER SET latin1 COLLATE latin1_general_ci NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 2, 'johanes', 'joh', 'joh@gmail.com', '$2y$10$xqJpvTGspNuzy/6liXNwSuzgf/BwDZoT9rdQgv5BT8tkwFlbmocdK', NULL, '2009-08-04 07:45:36', '2020-03-15 02:22:43');
INSERT INTO `users` VALUES (2, 3, 'AdminGudang', 'Gudang', 'Gudang@gmail.com', '3d2172418ce305c7d16d4b05597c6a59', NULL, '2009-08-04 07:45:36', '2009-08-04 07:45:36');
INSERT INTO `users` VALUES (3, 3, 'AdminAkuntan', 'Akuntan', 'Akuntan@gmail.com', 'b7bc2a2f5bb6d521e64c8974c143e9a0', NULL, '2009-08-04 07:45:36', '2009-08-04 03:42:44');
INSERT INTO `users` VALUES (4, 3, 'AdminKeungan', 'Keuangan', 'Keuangan@gmail.com', '$2y$10$xqJpvTGspNuzy/6liXNwSuzgf/BwDZoT9rdQgv5BT8tkwFlbmocdK', 'Test notes', '2009-08-04 07:45:36', '2020-03-16 14:07:14');
INSERT INTO `users` VALUES (5, 1, 'Developer Admin', 'devadmin', 'devadmin@email.com', '$2y$10$9s3pnf21mK0alzhn2fQUWOe4zaSfePK9cTsnPHGidCygQP305.2IO', NULL, '2020-03-11 22:21:16', '2020-03-13 00:47:58');

SET FOREIGN_KEY_CHECKS = 1;
