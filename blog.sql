/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306exit 
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2015-06-11 17:47:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `l_admin`
-- ----------------------------
DROP TABLE IF EXISTS `l_admin`;
CREATE TABLE `l_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `logintime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of l_admin
-- ----------------------------
INSERT INTO `l_admin` VALUES ('1', 'admin', 'nickname', '21232f297a57a5a743894a0e4a801fc3', '1404116067');

-- ----------------------------
-- Table structure for `l_article`
-- ----------------------------
DROP TABLE IF EXISTS `l_article`;
CREATE TABLE `l_article` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `time` int(11) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `click` int(11) DEFAULT NULL,
  `hot` int(11) DEFAULT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of l_article
-- ----------------------------
INSERT INTO `l_article` VALUES ('1', '1', '上海故事', '&lt;p&gt;\r\n	&lt;img width=&quot;200&quot; height=&quot;200&quot; style=&quot;width:555px;height:343px;&quot; alt=&quot;&quot; src=&quot;http://upload.17u.net/uploadpicbase/2012/06/16/aa/2012061623561752340.jpg&quot; /&gt; \r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	还没有来得及回味娇羞委婉的吴侬酥软，这一走神的时间，就跪拜在热情火辣的桑巴舞娘裙边。\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	我们到了，这个地方，叫上海。\r\n&lt;/p&gt;', null, null, null, null, '1', '1');

-- ----------------------------
-- Table structure for `l_category`
-- ----------------------------
DROP TABLE IF EXISTS `l_category`;
CREATE TABLE `l_category` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `urlname` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `sort_order` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`),
  UNIQUE KEY `urlname` (`urlname`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of l_category
-- ----------------------------
INSERT INTO `l_category` VALUES ('2', '0', '公司新闻', 'news', '公司及行业的发展动态', '', '0');
INSERT INTO `l_category` VALUES ('3', '0', '公司简介', 'intro', '公司的简要介绍', '', '0');
INSERT INTO `l_category` VALUES ('4', '0', '苜草素', 'mucaosu', '苜草素介绍', '', '0');
INSERT INTO `l_category` VALUES ('5', '0', '联系方式', 'contact', '联系我们', '', '0');

-- ----------------------------
-- Table structure for `l_comment`
-- ----------------------------
DROP TABLE IF EXISTS `l_comment`;
CREATE TABLE `l_comment` (
  `coid` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `reply` varchar(255) DEFAULT NULL,
  `respond` varchar(255) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `couname` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`coid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of l_comment
-- ----------------------------
INSERT INTO `l_comment` VALUES ('1', '1', 'liuwave@qq.com', 'new', null, null, '1433850937', '1111');

-- ----------------------------
-- Table structure for `l_menu`
-- ----------------------------
DROP TABLE IF EXISTS `l_menu`;
CREATE TABLE `l_menu` (
  `mid` mediumint(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '0：自定义页面\r\n；1：cate；\r\n2：product；\r\n3：page',
  `category_urlname` varchar(255) NOT NULL DEFAULT '0',
  `is_show` tinyint(1) NOT NULL DEFAULT '1',
  `is_open_new` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` tinyint(1) NOT NULL DEFAULT '0',
  `position` varchar(10) NOT NULL DEFAULT 'top' COMMENT 'top,side',
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of l_menu
-- ----------------------------
INSERT INTO `l_menu` VALUES ('1', '首页', '/', '0', '', '1', '0', '0', 'top');
INSERT INTO `l_menu` VALUES ('2', '公司简介', '/list/3.html', '0', '', '1', '0', '1', 'top');
INSERT INTO `l_menu` VALUES ('3', '苜草素', '/list/4.html', '0', '', '1', '0', '2', 'top');
INSERT INTO `l_menu` VALUES ('4', '公司新闻', '/cate/news.html', '1', 'news', '1', '0', '3', 'top');
INSERT INTO `l_menu` VALUES ('5', '产品系列', '', '0', '', '1', '0', '4', 'top');
INSERT INTO `l_menu` VALUES ('6', '联系方式', '', '0', '', '1', '0', '5', 'top');

-- ----------------------------
-- Table structure for `l_order`
-- ----------------------------
DROP TABLE IF EXISTS `l_order`;
CREATE TABLE `l_order` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `mphone` varchar(20) NOT NULL,
  `qq` varchar(255) NOT NULL,
  `msg` varchar(2048) NOT NULL,
  `is_checked` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of l_order
-- ----------------------------

-- ----------------------------
-- Table structure for `l_page`
-- ----------------------------
DROP TABLE IF EXISTS `l_page`;
CREATE TABLE `l_page` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `urlname` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of l_page
-- ----------------------------

-- ----------------------------
-- Table structure for `l_product`
-- ----------------------------
DROP TABLE IF EXISTS `l_product`;
CREATE TABLE `l_product` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `provider_name` varchar(255) NOT NULL,
  `shop_price` decimal(10,2) NOT NULL,
  `img` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `click_count` int(11) NOT NULL DEFAULT '0',
  `sort_order` tinyint(1) NOT NULL DEFAULT '0',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `is_best` tinyint(1) NOT NULL,
  `is_new` tinyint(1) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of l_product
-- ----------------------------

-- ----------------------------
-- Table structure for `l_website_config`
-- ----------------------------
DROP TABLE IF EXISTS `l_website_config`;
CREATE TABLE `l_website_config` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `code` varchar(30) NOT NULL DEFAULT '',
  `type` varchar(10) NOT NULL DEFAULT '',
  `store_range` varchar(255) NOT NULL DEFAULT '',
  `store_dir` varchar(255) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of l_website_config
-- ----------------------------
INSERT INTO `l_website_config` VALUES ('1', '0', 'lang', 'group', '', '', '', '1');
INSERT INTO `l_website_config` VALUES ('2', '0', 'picture', 'group', '', '', '', '1');
INSERT INTO `l_website_config` VALUES ('3', '0', 'settings', 'group', '', '', '', '1');
INSERT INTO `l_website_config` VALUES ('4', '0', 'tags', 'group', '', '', '', '1');
INSERT INTO `l_website_config` VALUES ('5', '0', 'template', 'group', '', '', '', '1');
INSERT INTO `l_website_config` VALUES ('6', '1', 'DEFAULT_LANG', 'select', 'zh-cn,en-us,zh-tw,ja-jp', '', 'zh-cn', '1');
INSERT INTO `l_website_config` VALUES ('8', '3', 'blogName', 'text', '', '', '白袜儿的个人主页', '1');
INSERT INTO `l_website_config` VALUES ('9', '3', 'subtitle', 'text', '', '', '白袜儿的个人主页', '2');
INSERT INTO `l_website_config` VALUES ('10', '3', 'description', 'text', '', '', '这是白袜儿的个人主页', '4');
INSERT INTO `l_website_config` VALUES ('11', '3', 'copy', 'text', '', '', '© 2014 www.baiwar.com All Rights Reserved.Theme by', '5');
INSERT INTO `l_website_config` VALUES ('13', '3', 'keywords', 'text', '', '', '白娃儿', '3');
INSERT INTO `l_website_config` VALUES ('14', '5', 'templateName', 'select', 'Default,Test', '', 'Default', '1');
INSERT INTO `l_website_config` VALUES ('15', '5', 'PAGESIZE', 'number', '', '', '8', '1');
INSERT INTO `l_website_config` VALUES ('16', '5', 'LISTPAGESIZE', 'number', '', '', '20', '1');
INSERT INTO `l_website_config` VALUES ('17', '2', 'mi_exts', 'text', '', '', 'jpg,gif,png,jpeg', '1');
INSERT INTO `l_website_config` VALUES ('18', '2', 'mi_maxSize', 'text', '', '', '3145728', '1');
INSERT INTO `l_website_config` VALUES ('19', '0', '', '', '', '', '', '1');
