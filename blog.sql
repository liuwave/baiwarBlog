/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306exit 
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2015-06-06 17:40:05
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
  `pid` int(11) DEFAULT NULL,
  `cname` varchar(255) DEFAULT NULL,
  `urlname` varchar(255) DEFAULT NULL,
  `cdescription` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of l_category
-- ----------------------------
INSERT INTO `l_category` VALUES ('1', '0', '上海故事', 'shanghai', 'soo');

-- ----------------------------
-- Table structure for `l_comment`
-- ----------------------------
DROP TABLE IF EXISTS `l_comment`;
CREATE TABLE `l_comment` (
  `coid` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `reply` varchar(255) DEFAULT NULL,
  `respond` varchar(255) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `couname` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`coid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of l_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `l_menu`
-- ----------------------------
DROP TABLE IF EXISTS `l_menu`;
CREATE TABLE `l_menu` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `mname` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of l_menu
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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of l_website_config
-- ----------------------------
INSERT INTO `l_website_config` VALUES ('1', '0', 'lang', 'group', '', '', '', '1');
INSERT INTO `l_website_config` VALUES ('2', '0', 'picture', 'group', '', '', '', '1');
INSERT INTO `l_website_config` VALUES ('3', '0', 'setting', 'group', '', '', '', '1');
INSERT INTO `l_website_config` VALUES ('4', '0', 'tags', 'group', '', '', '', '1');
INSERT INTO `l_website_config` VALUES ('5', '0', 'temp', 'group', '', '', '', '1');
INSERT INTO `l_website_config` VALUES ('6', '1', 'DEFAULT_LANG', 'select', 'zh-cn,en-us,zh-tw,ja-jp', '', 'zh-tw', '1');
INSERT INTO `l_website_config` VALUES ('7', '1', 'test', 'select', 'z,s,ss', '', 'ss', '1');
