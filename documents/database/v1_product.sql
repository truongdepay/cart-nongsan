delimiter $$

CREATE TABLE `v1_product` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `status` int(1) DEFAULT NULL,
  `category` int(20) DEFAULT NULL,
  `slugs` text COLLATE utf8_unicode_ci,
  `title` text COLLATE utf8_unicode_ci,
  `desc` text COLLATE utf8_unicode_ci,
  `content` longtext COLLATE utf8_unicode_ci,
  `keywords` text COLLATE utf8_unicode_ci,
  `tags` text COLLATE utf8_unicode_ci,
  `thumb` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(1) DEFAULT NULL,
  `order` int(20) DEFAULT NULL,
  `price` int(20) DEFAULT NULL,
  `author` int(20) DEFAULT NULL,
  `date_create` int(11) DEFAULT NULL,
  `date_modify` int(11) DEFAULT NULL,
  `author_modify` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci$$

