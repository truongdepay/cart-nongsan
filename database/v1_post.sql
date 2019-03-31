/*
 Navicat Premium Data Transfer

 Source Server         : LocalHost
 Source Server Type    : MySQL
 Source Server Version : 100134
 Source Host           : localhost:3306
 Source Schema         : db_develop

 Target Server Type    : MySQL
 Target Server Version : 100134
 File Encoding         : 65001

 Date: 14/09/2018 22:06:17
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for v1_post
-- ----------------------------
DROP TABLE IF EXISTS `v1_post`;
CREATE TABLE `v1_post`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category` bigint(20) NULL DEFAULT NULL,
  `author` bigint(20) NULL DEFAULT NULL,
  `status` tinyint(1) NULL DEFAULT NULL,
  `slugs` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `thumb` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `type` tinyint(1) NULL DEFAULT NULL,
  `order` bigint(20) NULL DEFAULT NULL,
  `date_created` int(11) NULL DEFAULT NULL,
  `date_modify` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
