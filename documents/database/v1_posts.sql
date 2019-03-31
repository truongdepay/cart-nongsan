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

 Date: 15/01/2019 14:09:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for v1_posts
-- ----------------------------
DROP TABLE IF EXISTS `v1_posts`;
CREATE TABLE `v1_posts`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `slugs` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `category` int(20) NULL DEFAULT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `desc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `thumb` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `type` int(1) NULL DEFAULT NULL,
  `order` int(10) NULL DEFAULT NULL,
  `keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `tags` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `author` int(20) NULL DEFAULT NULL,
  `date_create` int(11) NULL DEFAULT NULL,
  `date_modify` int(11) NULL DEFAULT NULL,
  `author_modify` int(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of v1_posts
-- ----------------------------
INSERT INTO `v1_posts` VALUES (4, 'cach-viet-the-mo-ta-chuan-seo-nhung-van-thu-hut-duoc-doc-gia', NULL, NULL, 'Cách viết thẻ mô tả chuẩn SEO nhưng vẫn thu hút được độc giả', 'được độc giả', 'được độc giả', NULL, NULL, NULL, 'được độc giả', 'được độc giả', NULL, 1547105063, NULL, NULL);
INSERT INTO `v1_posts` VALUES (5, 'cach-viet-the-mo-ta-chuan-seo-nhung-van-thu-hut-duoc-doc-gia-hien-nay', NULL, NULL, 'Cách viết thẻ mô tả chuẩn SEO nhưng vẫn thu hút được độc giả', 'nhưng vẫn thu hút được độc giả', 'nhưng vẫn thu hút được độc giả', NULL, NULL, NULL, 'cach viet, phuong phap', '', NULL, 1547106835, NULL, NULL);
INSERT INTO `v1_posts` VALUES (6, 'cach-viet-the-mo-ta-chuan-seo', NULL, NULL, 'Cách viết thẻ mô tả chuẩn SEO', 'Cách viết thẻ mô tả chuẩn SEO', 'Cách viết thẻ mô tả chuẩn SEO', NULL, NULL, NULL, 'Cách viết thẻ mô tả chuẩn SEO', 'Cách viết thẻ mô tả chuẩn SEO', NULL, 1547195379, NULL, NULL);
INSERT INTO `v1_posts` VALUES (7, 'cach-viet-the-mo-ta-chuan-s', NULL, NULL, 'Cách viết thẻ mô tả chuẩn S', '$slugs', '$slugs', NULL, NULL, NULL, '', '', NULL, 1547196652, NULL, NULL);
INSERT INTO `v1_posts` VALUES (8, 'cach-viet-the-mo-ta-chuan', NULL, NULL, 'Cách viết thẻ mô tả chuẩn S', '$slugs', '$slugs', NULL, NULL, NULL, '', '', NULL, 1547196734, NULL, NULL);
INSERT INTO `v1_posts` VALUES (10, 'cach-viet-the-mo-ta', NULL, NULL, 'Cách viết thẻ mô tả chuẩn S', 'Cách viết thẻ mô tả chuẩn S', 'Cách viết thẻ mô tả chuẩn S', './uploads/img/cach-viet-the-mo-ta/', NULL, NULL, 'Cách viết thẻ mô tả chuẩn S', '', NULL, 1547199609, NULL, NULL);
INSERT INTO `v1_posts` VALUES (11, 'cach-viet-the-mo-ta-chua', NULL, NULL, 'Cách viết thẻ mô tả chuẩn S', 'Cách viết thẻ mô tả chuẩn S', 'Cách viết thẻ mô tả chuẩn S', './uploads/img/cach-viet-the-mo-ta-chua/48356872_2183136258611374_7100951399927644160_o', NULL, NULL, '', '', NULL, 1547199754, NULL, NULL);
INSERT INTO `v1_posts` VALUES (12, 'cach-viet-the-mo-ta-chuan-seo-nhung-van-thu-hut-duoc-doc', NULL, NULL, 'Cách viết thẻ mô tả chuẩn SEO nhưng vẫn thu hút được độc', 'file_ext', 'file_ext', './uploads/img/cach-viet-the-mo-ta-chuan-seo-nhung-van-thu-hut-duoc-doc/48064122_2183038031908922_6663102462175477760_o..jpg', NULL, NULL, '', '', NULL, 1547199867, NULL, NULL);
INSERT INTO `v1_posts` VALUES (13, 'cach-viet-the-mo-ta-chuan-seo-nhung-van-thu-hut-duoc-doc-gi', NULL, NULL, 'Cách viết thẻ mô tả chuẩn SEO nhưng vẫn thu hút được độc gi', 'file_ext', 'file_ext', './uploads/img/cach-viet-the-mo-ta-chuan-seo-nhung-van-thu-hut-duoc-doc-gi/48064122_2183038031908922_6663102462175477760_o.jpg', NULL, NULL, '', '', NULL, 1547199913, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
