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

 Date: 19/02/2019 17:14:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for v1_category
-- ----------------------------
DROP TABLE IF EXISTS `v1_category`;
CREATE TABLE `v1_category`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of v1_category
-- ----------------------------
INSERT INTO `v1_category` VALUES (1, 1, 'dien-thoa', 'Điện thoại', 0, NULL, NULL, 1548231761, NULL, NULL);
INSERT INTO `v1_category` VALUES (2, 1, 'may-tinh-bang', 'Máy tính bảng', 0, 0, NULL, 1550469879, NULL, NULL);
INSERT INTO `v1_category` VALUES (3, 1, 'xe-may', 'Xe máy', 0, 1, NULL, 1548317995, NULL, NULL);
INSERT INTO `v1_category` VALUES (4, 1, 'dong-ho-thong-minh', 'Đồng hồ thông minh', 0, 0, NULL, 1550471701, NULL, NULL);

-- ----------------------------
-- Table structure for v1_money
-- ----------------------------
DROP TABLE IF EXISTS `v1_money`;
CREATE TABLE `v1_money`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `money` int(10) NULL DEFAULT NULL,
  `date` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of v1_posts
-- ----------------------------
INSERT INTO `v1_posts` VALUES (11, 'cach-viet-the-mo-ta-chua', NULL, NULL, 'Cách viết thẻ mô tả chuẩn S', 'Cách viết thẻ mô tả chuẩn S', 'Cách viết thẻ mô tả chuẩn S', 'uploads/img/cach-viet-the-mo-ta-chua/xeno_goku_by_ajckh2-db3ldjp.png', NULL, NULL, '', '', NULL, 1547697770, NULL, NULL);
INSERT INTO `v1_posts` VALUES (12, 'cach-viet-the-mo-ta-chuan-seo-nhung-van-thu-hut-duoc-doc', NULL, NULL, 'Cách viết thẻ mô tả chuẩn SEO nhưng vẫn thu hút được độc', 'file_ext', 'file_ext', 'uploads/img/cach-viet-the-mo-ta-chuan-seo-nhung-van-thu-hut-duoc-doc/3020586-poster-1280-iwatch.jpg', NULL, NULL, '', '', NULL, 1547697731, NULL, NULL);
INSERT INTO `v1_posts` VALUES (13, 'cach-viet-the-mo-ta-chuan-seo-nhung-van-thu-hut-duoc-doc-gia-hien-hay', NULL, NULL, 'Cách viết thẻ mô tả chuẩn SEO nhưng vẫn thu hút được độc gia hien hay', 'file_ext', 'file_ext', 'uploads/img/cach-viet-the-mo-ta-chuan-seo-nhung-van-thu-hut-duoc-doc-gia-hien-hay/Flat-Design-Letters-PowerPoint-Slide12.JPG', NULL, NULL, '', '', NULL, 1547696853, NULL, NULL);
INSERT INTO `v1_posts` VALUES (14, 'may-anh-canon-750d-lens-18-55-is-stm-le-bao-minh', 1, NULL, 'Máy Ảnh Canon 750D + Lens 18-55 IS STM (Lê Bảo Minh) ', 'Máy Ảnh Canon 750D + Lens 18-55 IS STM (Lê Bảo Minh) ', 'Máy Ảnh Canon 750D + Lens 18-55 IS STM (Lê Bảo Minh) ', 'uploads/img/may-anh-canon-750d-lens-18-55-is-stm-le-bao-minh/UjK4eUF.jpg', NULL, NULL, 'Máy Ảnh', 'Máy Ảnh', NULL, 1547722028, NULL, NULL);
INSERT INTO `v1_posts` VALUES (15, '18h00-chieu-nay-truc-tiep-viet-nam-vs-iran', 1, NULL, '18h00 chiều nay, trực tiếp Việt Nam vs Iran', 'Máy Ảnh', 'Máy Ảnh', 'uploads/img/18h00-chieu-nay-truc-tiep-viet-nam-vs-iran/mouse-cursor-png-5a39e3ddefeb36_63074698151374332598278371.jpg', NULL, NULL, 'Máy Ảnh', 'Máy Ảnh', NULL, 1548063410, NULL, NULL);
INSERT INTO `v1_posts` VALUES (16, 'may-anh-canon-750d-lens-18-55-is-stm-le-bao-minhh', 1, NULL, 'Máy Ảnh Canon 750D + Lens 18-55 IS STM (Lê Bảo Minh) ', 'Máy Ảnh Canon 750D + Lens 18-55 IS STM (Lê Bảo Minh) ', 'Máy Ảnh Canon 750D + Lens 18-55 IS STM (Lê Bảo Minh) ', 'uploads/img/may-anh-canon-750d-lens-18-55-is-stm-le-bao-minhh/giphy_(1).gif', NULL, NULL, '', '', NULL, 1550469901, NULL, NULL);
INSERT INTO `v1_posts` VALUES (17, 'vong-deo-tay-thong-minh-xiaomi-mi-band-3', 1, 2, 'Vòng Đeo Tay Thông Minh Xiaomi MI Band 3', 'Vòng Đeo Tay Thông Minh Xiaomi MI Band 3', 'Vòng Đeo Tay Thông Minh Xiaomi MI Band 3', 'uploads/img/vong-deo-tay-thong-minh-xiaomi-mi-band-3/3020586-poster-1280-iwatch.jpg', NULL, NULL, '', '', NULL, 1550471672, NULL, NULL);

-- ----------------------------
-- Table structure for v1_product
-- ----------------------------
DROP TABLE IF EXISTS `v1_product`;
CREATE TABLE `v1_product`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `status` int(1) NULL DEFAULT NULL,
  `category` int(20) NULL DEFAULT NULL,
  `slugs` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `desc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `keywords` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `tags` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `thumb` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `type` int(1) NULL DEFAULT NULL,
  `order` int(20) NULL DEFAULT NULL,
  `price` int(20) NULL DEFAULT NULL,
  `author` int(20) NULL DEFAULT NULL,
  `date_create` int(11) NULL DEFAULT NULL,
  `date_modify` int(11) NULL DEFAULT NULL,
  `author_modify` int(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of v1_product
-- ----------------------------
INSERT INTO `v1_product` VALUES (7, 1, 1, 'may-anh-canon-750d-lens-18-55-is-stm-le-bao-minh', 'Máy Ảnh Canon 750D + Lens 18-55 IS STM (Lê Bảo Minh) ', 'Máy Ảnh Canon 750D + Lens 18-55 IS STM (Lê Bảo Minh) ', 'Máy Ảnh Canon 750D + Lens 18-55 IS STM (Lê Bảo Minh) ', '', '', 'uploads/img/may-anh-canon-750d-lens-18-55-is-stm-le-bao-minh/Flat-Design-Letters-PowerPoint-Slide18.JPG', NULL, NULL, 1000000, NULL, 1548061654, NULL, NULL);
INSERT INTO `v1_product` VALUES (8, 1, 1, 'dien-thoai-nokia-6-1-plus-hang-chinh-hang', 'Điện thoại Nokia 6.1 Plus - Hàng Chính Hãng', 'Điện thoại Nokia 6.1 Plus - Hàng Chính Hãng', 'Điện thoại Nokia 6.1 Plus - Hàng Chính Hãng', '', '', NULL, NULL, NULL, 9000000, NULL, 1548063402, NULL, NULL);
INSERT INTO `v1_product` VALUES (9, 1, 1, 'op-lung-da-ke-soc-danh-cho-dien-thoai-huawei-y6-prime-2018', 'Ốp Lưng Da Kẻ Sọc Dành Cho Điện Thoại Huawei Y6 Prime 2018', 'Ốp Lưng Da Kẻ Sọc Dành Cho Điện Thoại Huawei Y6 Prime 2018', 'Ốp Lưng Da Kẻ Sọc Dành Cho Điện Thoại Huawei Y6 Prime 2018', '', '', 'uploads/img/op-lung-da-ke-soc-danh-cho-dien-thoai-huawei-y6-prime-2018/UjK4eUF.jpg', NULL, NULL, 2000000, NULL, 1548063520, NULL, NULL);
INSERT INTO `v1_product` VALUES (10, 0, 1, 'op-lung-danh-cho-samsung-galaxy-a8-plus-mau-92', 'Ốp Lưng Dành Cho Samsung Galaxy A8 Plus - Mẫu 92', 'Ốp Lưng Dành Cho Samsung Galaxy A8 Plus - Mẫu 92', 'Ốp Lưng Dành Cho Samsung Galaxy A8 Plus - Mẫu 92', '', '', 'uploads/img/op-lung-danh-cho-samsung-galaxy-a8-plus-mau-92/20180416080516-56-up5dfhtohsrexzr9zcjj.jpg', NULL, NULL, 200000, NULL, 1548067049, NULL, NULL);

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
