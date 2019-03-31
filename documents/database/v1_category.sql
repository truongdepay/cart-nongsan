/*
 Navicat Premium Data Transfer

 Source Server         : LocalHost
 Source Server Type    : MySQL
 Source Server Version : 100132
 Source Host           : localhost:3306
 Source Schema         : db_develop

 Target Server Type    : MySQL
 Target Server Version : 100132
 File Encoding         : 65001

 Date: 23/01/2019 11:45:57
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for v1_category
-- ----------------------------
DROP TABLE IF EXISTS `v1_category`;
CREATE TABLE `v1_category`  (
  `id` int(20) NOT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `slugs` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `title` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `parent` int(20) NULL DEFAULT NULL,
  `type` int(2) NULL DEFAULT NULL,
  `author` int(20) NULL DEFAULT NULL,
  `date_create` int(11) NULL DEFAULT NULL,
  `date_modify` int(11) NULL DEFAULT NULL,
  `author_modify` int(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
