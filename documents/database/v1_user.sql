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

 Date: 01/02/2019 11:17:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for v1_user
-- ----------------------------
DROP TABLE IF EXISTS `v1_user`;
CREATE TABLE `v1_user`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `status` int(1) NULL DEFAULT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `salt` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `birthday` int(11) NULL DEFAULT NULL,
  `description` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `date_create` int(11) NULL DEFAULT NULL,
  `date_modify` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of v1_user
-- ----------------------------
INSERT INTO `v1_user` VALUES (8, 1, 'Trường Depay', 'admin', '$2y$10$B.7DzrkKtyS8wldEaFC/4O25jfvvfBigR51ES5KY7FIzMMUyaI2qi', '32e88fb6b416f84b9a4a963c44f6795720d3b3cc', NULL, NULL, 1548922316, NULL);

SET FOREIGN_KEY_CHECKS = 1;
