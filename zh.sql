/*
Navicat MySQL Data Transfer

Source Server         : demo
Source Server Version : 50711
Source Host           : 127.0.0.1:3306
Source Database       : zh

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2019-09-24 14:14:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for think_article
-- ----------------------------
DROP TABLE IF EXISTS `think_article`;
CREATE TABLE `think_article` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title_img` varchar(200) DEFAULT NULL COMMENT '标题文件',
  `is_hot` int(4) DEFAULT '0' COMMENT '是否热门1是0否',
  `is_top` int(4) DEFAULT '0' COMMENT '是否置顶1是0否',
  `cate_id` int(8) DEFAULT NULL COMMENT '栏目主键',
  `user_id` int(8) DEFAULT NULL COMMENT '用户主键',
  `title` varchar(255) DEFAULT NULL COMMENT '文档标题',
  `content` text COMMENT '文档内容',
  `pv` int(10) DEFAULT '0' COMMENT '阅读量',
  `status` int(4) DEFAULT NULL COMMENT '状态1显示0隐藏',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COMMENT='文档表';

-- ----------------------------
-- Records of think_article
-- ----------------------------
INSERT INTO `think_article` VALUES ('1', '20190508/a0aae983598a0767fd56fc5d9582e2c5.jpg', '0', '0', '1', '10', '我的第一个博客', '我的第一个博客我的第一个博客我的第一个博客', '8', '1', '1557288191', '1557288191');
INSERT INTO `think_article` VALUES ('13', '20190508/32530d73ff25cf74fde185d6f82d6c5a.jpg', '0', '0', '3', '10', 'test1', 'sdfghjkljhfasdgfklsafsdfdhfdh', '2', '1', '1557306132', '1557306132');
INSERT INTO `think_article` VALUES ('19', '20190508/a3475ab301da2ffff4c7a4b18a6b3b7f.jpg', '0', '0', '1', '10', 'dsgdshfdjdf', 'fsdgdshdfjfgkfklhgl', '1', '1', '1557306189', '1557306189');
INSERT INTO `think_article` VALUES ('21', '20190508/2f507a3c5ada16b4ef68153f6707b15d.jpg', '0', '0', '4', '10', 'dsgdsh', 'sadhgfkhgklghl,cx', '4', '1', '1557306674', '1557306674');
INSERT INTO `think_article` VALUES ('22', '20190508/5ecfd4d946de2dc9151add8a4319eff2.jpg', '0', '0', '1', '10', 'PHP是世界上最好的语言吗？', '<b><font size=\"4\" color=\"#ff0000\">PHP是世界上最好的语言吗？</font></b><br>', '10', '1', '1557311582', '1557311582');
INSERT INTO `think_article` VALUES ('23', '20190508/e2e683de7da708b537fa6bcb19b5a84d.jpg', '0', '0', '4', '10', 'MyTest1Blog', '<b><font size=\"4\">MyTest1Blog</font></b><font size=\"4\"><b>MyTest1BlogMyTest1Blog</b></font><br>', '39', '1', '1557315006', '1557315006');
INSERT INTO `think_article` VALUES ('24', '20190508/44a55fdc6d9318a9f1108f73f25f49b8.jpg', '0', '0', '1', '12', '我的第一个项目', '<b><font size=\"3\">我的第一个项目</font></b><font size=\"3\"><b>我的第一个项目我的第一个项目我的第一个项目</b></font><br>', '23', '1', '1557315114', '1557315114');
INSERT INTO `think_article` VALUES ('35', '20190515/0cee27884a45f7c0336dcfe156872a8d.gif', '0', '0', '1', '25', '普通用户发表的第一篇文章', '需要在分页的时候传入查询条件，可以使用query参数拼接额外的查询参数需要在分页的时候传入查询条件，可以使用query参数拼接额外的查询参数<br>', '25', '1', '1557906178', '1557906178');
INSERT INTO `think_article` VALUES ('36', '20190516/c3250f9a3294bb3bcce066cc1a16ee59.gif', '0', '0', '4', '11', 'Javascript是最好的语言吗？', '<b><font size=\"4\" color=\"#3333ff\">Javascript是世界上最好的语言吗？Javascript是世界上最好的语言吗？Javascript是世界上最好的语言吗？Javascript是世界上最好的语言吗？</font></b><br>', '50', '1', '1557968223', '1557968223');
INSERT INTO `think_article` VALUES ('37', '20190519/1f3d9423148e698626a3da2174068f55.gif', '0', '0', '8', '24', '520是什么？', '                <font color=\"#ff9900\" size=\"4\"><b>520是什么？520是什么？520是什么？520是什么？</b></font><br>            ', '59', '1', '1558261122', '1558261122');
INSERT INTO `think_article` VALUES ('38', '20190701/78b03edb2506f020962e8e15248a2e55.gif', '0', '0', '1', '27', 'Python-Django框架', '                <font color=\"#FF0000\">\"hello world,Wellcome to php\'s world\"</font><br>            ', '31', '1', '1561946858', '1561946858');
INSERT INTO `think_article` VALUES ('39', '20190702/5f6770592a58c7bf65e58927bc7591a1.gif', '0', '0', '2', '30', '数据库基础操作', '创建数据库，数据库中数据表的增、删、改、查<br>', '67', '1', '1562031272', '1562031272');

-- ----------------------------
-- Table structure for think_article_category
-- ----------------------------
DROP TABLE IF EXISTS `think_article_category`;
CREATE TABLE `think_article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_id` int(11) DEFAULT NULL COMMENT '用户主键',
  `name` varchar(30) DEFAULT NULL COMMENT '栏目名称',
  `sort` int(11) DEFAULT NULL COMMENT '栏目排序',
  `status` int(11) DEFAULT NULL COMMENT '栏目状态1启用0禁用',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='栏目表';

-- ----------------------------
-- Records of think_article_category
-- ----------------------------
INSERT INTO `think_article_category` VALUES ('1', '0', 'ThinkPHP', '2', '1', null, null);
INSERT INTO `think_article_category` VALUES ('2', '0', 'MYSQL', '0', '1', null, null);
INSERT INTO `think_article_category` VALUES ('3', '0', 'HTML', '4', '1', null, null);
INSERT INTO `think_article_category` VALUES ('4', null, 'JavaScript', '3', '1', null, null);
INSERT INTO `think_article_category` VALUES ('5', null, 'Python', '6', '1', null, null);
INSERT INTO `think_article_category` VALUES ('7', null, 'Java', '7', '1', null, null);
INSERT INTO `think_article_category` VALUES ('8', null, 'c++', '9', '1', null, null);

-- ----------------------------
-- Table structure for think_comment
-- ----------------------------
DROP TABLE IF EXISTS `think_comment`;
CREATE TABLE `think_comment` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `parent_id` int(10) DEFAULT NULL COMMENT '上级评论ID。若是一级评论则为0',
  `nickname` varchar(100) DEFAULT NULL COMMENT '评论人昵称',
  `head_pic` varchar(400) DEFAULT NULL COMMENT '评论人头像',
  `content` text COMMENT '评论内容',
  `create_time` datetime DEFAULT NULL COMMENT '评论或回复发表时间',
  `update_time` datetime DEFAULT NULL COMMENT '评论更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of think_comment
-- ----------------------------
INSERT INTO `think_comment` VALUES ('1', '2', 'tom', null, '1+849asdasfa', null, null);
INSERT INTO `think_comment` VALUES ('2', '3', '啊打发', null, '很过分即可是靠不可能 ', null, null);

-- ----------------------------
-- Table structure for think_site
-- ----------------------------
DROP TABLE IF EXISTS `think_site`;
CREATE TABLE `think_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(255) DEFAULT NULL COMMENT '站点名称',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键字',
  `desc` text COMMENT '网站描述',
  `is_open` int(11) DEFAULT '1' COMMENT '是否开启1是0否',
  `is_comment` int(11) DEFAULT '1' COMMENT '允许评论1开0关',
  `is_reg` int(11) DEFAULT '1' COMMENT '是否允许注册1是0否',
  `status` int(11) DEFAULT '1' COMMENT '状态1允许0禁止',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='站点信息表';

-- ----------------------------
-- Records of think_site
-- ----------------------------
INSERT INTO `think_site` VALUES ('1', 'admin的网站', 'www.php.com', '                                                                                                                                                                                                                                                                                                                                                                                                我的网站描述jhhhhkhkh                                                                                ', '1', '1', '1', '1', '0', '2019-05-13 22:09:44');

-- ----------------------------
-- Table structure for think_user
-- ----------------------------
DROP TABLE IF EXISTS `think_user`;
CREATE TABLE `think_user` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `is_admin` int(11) DEFAULT '0' COMMENT '是否是管理员1是0否',
  `name` varchar(100) DEFAULT NULL COMMENT '用户名',
  `email` varchar(200) DEFAULT NULL COMMENT '邮箱',
  `mobile` varchar(15) DEFAULT NULL COMMENT '手机号码',
  `password` char(40) DEFAULT NULL COMMENT '密码',
  `status` int(11) DEFAULT '1' COMMENT '状态1启用0禁用',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of think_user
-- ----------------------------
INSERT INTO `think_user` VALUES ('6', '0', 'leo123', '1234@foxmail.com', '18728609111', '123abc', '1', null, null);
INSERT INTO `think_user` VALUES ('8', '0', 'ubuntu1', 'ubuntu@php.com', '13662390122', 'a906449d5769fa7361d7ecc6aa3f6d28', '1', '1557203327', '1557203327');
INSERT INTO `think_user` VALUES ('11', '1', 'admin', 'admin@php.com', '18728609133', 'e10adc3949ba59abbe56e057f20f883e', '1', '1557500763', '1557500763');
INSERT INTO `think_user` VALUES ('23', '0', 'test1', 'test1@php.com', '13662390101', 'e10adc3949ba59abbe56e057f20f883e', '1', '1557836879', '1557836879');
INSERT INTO `think_user` VALUES ('24', '0', 'test2', 'test2@php.com', '13662390102', 'e10adc3949ba59abbe56e057f20f883e', '1', '1557836908', '1557836908');
INSERT INTO `think_user` VALUES ('25', '0', 'test3', 'test3@php.com', '13662390103', 'e10adc3949ba59abbe56e057f20f883e', '1', '1557836930', '1557836930');
INSERT INTO `think_user` VALUES ('26', '0', '和平精英@', '98k@pho.com', '13662390107', 'e10adc3949ba59abbe56e057f20f883e', '1', '1558003829', '1558003829');
INSERT INTO `think_user` VALUES ('28', '0', 'article', 'article@php.com', '18728609132', 'e10adc3949ba59abbe56e057f20f883e', '1', '1561950151', '1561950151');
INSERT INTO `think_user` VALUES ('30', '0', 'article2', 'article2@php.com', '18728609142', 'e10adc3949ba59abbe56e057f20f883e', '1', '1561950233', '1561950233');
INSERT INTO `think_user` VALUES ('31', '0', 'article1', 'article1@php.com', '18728609141', 'e10adc3949ba59abbe56e057f20f883e', '1', '1561950571', '1561950571');

-- ----------------------------
-- Table structure for think_user_comments
-- ----------------------------
DROP TABLE IF EXISTS `think_user_comments`;
CREATE TABLE `think_user_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户主键',
  `article_id` int(11) DEFAULT NULL COMMENT '文档主键',
  `content` text COMMENT '评论内容',
  `reply_id` int(11) DEFAULT NULL COMMENT '回复id',
  `status` int(11) DEFAULT NULL COMMENT '1显示0隐藏',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COMMENT='评论表';

-- ----------------------------
-- Records of think_user_comments
-- ----------------------------
INSERT INTO `think_user_comments` VALUES ('44', '23', null, '时代峰峻刚看过', null, '1', '1557982510', '1557982510');
INSERT INTO `think_user_comments` VALUES ('45', '24', null, '所发生的规划', null, '1', '1557982595', '1557982595');
INSERT INTO `think_user_comments` VALUES ('46', '23', '29', '但是更好地', null, '1', '1557982763', '1557982763');
INSERT INTO `think_user_comments` VALUES ('47', '11', '36', 'Javascript是使用最广泛的编程语言之一', null, '1', '1557987041', '1557987041');
INSERT INTO `think_user_comments` VALUES ('48', '11', '36', 'PHP是世界上最好的语言☺☺☺☺', null, '1', '1557987577', '1557987577');
INSERT INTO `think_user_comments` VALUES ('49', '11', '36', 'java才是最好的语言', null, '1', '1557987830', '1557987830');
INSERT INTO `think_user_comments` VALUES ('50', '26', '23', 'MyTest1BlogMyTest1Bl>>>水电费方法', null, '1', '1558004189', '1558004189');
INSERT INTO `think_user_comments` VALUES ('51', '10', '23', '绝地求生，刺激战场。', null, '1', '1558004432', '1558004432');
INSERT INTO `think_user_comments` VALUES ('52', '11', '28', 'sfadhfdjgfkhglhglsdsgdh', null, '1', '1558004956', '1558004956');
INSERT INTO `think_user_comments` VALUES ('53', '25', '35', 'fdsfkdsjfsdlgsgslkdbglga', null, '1', '1558152901', '1558152901');
INSERT INTO `think_user_comments` VALUES ('54', '10', '26', 'bvmjbv,bn.;nm/', null, '1', '1558157607', '1558157607');
INSERT INTO `think_user_comments` VALUES ('55', '11', '36', 'safzgzxgzgzxgzg', null, '1', '1559879528', '1559879528');
INSERT INTO `think_user_comments` VALUES ('56', '24', '37', 'hello world！', null, '1', '1560053368', '1560053368');
INSERT INTO `think_user_comments` VALUES ('57', '11', '36', 'hello world！', null, '1', '1560053418', '1560053418');
INSERT INTO `think_user_comments` VALUES ('58', '22', '27', 'vxcnv,n .m/hfdz', null, '1', '1560088215', '1560088215');
INSERT INTO `think_user_comments` VALUES ('59', '22', '27', 'fdhcvjcvk,', null, '1', '1560088247', '1560088247');
INSERT INTO `think_user_comments` VALUES ('60', '24', '37', '的东西个性化宣传', null, '1', '1561883460', '1561883460');
INSERT INTO `think_user_comments` VALUES ('61', '25', '37', '金风科技空间', null, '1', '1561884445', '1561884445');
INSERT INTO `think_user_comments` VALUES ('62', '25', '23', 'rgfdhdjjgck', null, '1', '1561886538', '1561886538');
INSERT INTO `think_user_comments` VALUES ('63', '30', '39', 'sdsafa', null, '1', '1562232051', '1562232051');
INSERT INTO `think_user_comments` VALUES ('64', '30', '39', 'xzfzxfz', null, '1', '1562232065', '1562232065');
INSERT INTO `think_user_comments` VALUES ('65', '30', '39', 'dzxfzxf', null, '1', '1562232082', '1562232082');
INSERT INTO `think_user_comments` VALUES ('66', '30', '38', 'safafa', null, '1', '1562232133', '1562232133');
INSERT INTO `think_user_comments` VALUES ('67', '30', '38', 'hello ,wds f', null, '1', '1562232475', '1562232475');

-- ----------------------------
-- Table structure for think_user_fav
-- ----------------------------
DROP TABLE IF EXISTS `think_user_fav`;
CREATE TABLE `think_user_fav` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_id` int(11) DEFAULT NULL COMMENT '用户主键',
  `article_id` int(11) DEFAULT NULL COMMENT '文档表',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8 COMMENT='用户收藏表';

-- ----------------------------
-- Records of think_user_fav
-- ----------------------------
INSERT INTO `think_user_fav` VALUES ('19', '9', '2');
INSERT INTO `think_user_fav` VALUES ('20', '10', '13');
INSERT INTO `think_user_fav` VALUES ('22', '12', '24');
INSERT INTO `think_user_fav` VALUES ('23', '22', '30');
INSERT INTO `think_user_fav` VALUES ('25', '10', '3');
INSERT INTO `think_user_fav` VALUES ('27', '10', '25');
INSERT INTO `think_user_fav` VALUES ('28', '10', '21');
INSERT INTO `think_user_fav` VALUES ('31', '11', '28');
INSERT INTO `think_user_fav` VALUES ('33', '11', '31');
INSERT INTO `think_user_fav` VALUES ('46', '11', '33');
INSERT INTO `think_user_fav` VALUES ('47', '11', '30');
INSERT INTO `think_user_fav` VALUES ('57', '10', '26');
INSERT INTO `think_user_fav` VALUES ('61', '22', '27');
INSERT INTO `think_user_fav` VALUES ('62', '21', '29');
INSERT INTO `think_user_fav` VALUES ('109', '10', '23');
INSERT INTO `think_user_fav` VALUES ('126', '27', '38');
INSERT INTO `think_user_fav` VALUES ('128', '30', '39');

-- ----------------------------
-- Table structure for think_user_like
-- ----------------------------
DROP TABLE IF EXISTS `think_user_like`;
CREATE TABLE `think_user_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_id` int(11) DEFAULT NULL COMMENT '用户主键',
  `article_id` int(11) DEFAULT NULL COMMENT '文档主键',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COMMENT='用户点赞表';

-- ----------------------------
-- Records of think_user_like
-- ----------------------------
INSERT INTO `think_user_like` VALUES ('8', '10', '22');
INSERT INTO `think_user_like` VALUES ('9', '22', '30');
INSERT INTO `think_user_like` VALUES ('11', '10', '3');
INSERT INTO `think_user_like` VALUES ('13', '10', '25');
INSERT INTO `think_user_like` VALUES ('14', '10', '21');
INSERT INTO `think_user_like` VALUES ('18', '11', '28');
INSERT INTO `think_user_like` VALUES ('20', '11', '31');
INSERT INTO `think_user_like` VALUES ('39', '11', '33');
INSERT INTO `think_user_like` VALUES ('40', '11', '30');
INSERT INTO `think_user_like` VALUES ('46', '10', '26');
INSERT INTO `think_user_like` VALUES ('47', '21', '29');
INSERT INTO `think_user_like` VALUES ('65', '24', '37');
INSERT INTO `think_user_like` VALUES ('80', '10', '23');
INSERT INTO `think_user_like` VALUES ('98', '27', '38');
INSERT INTO `think_user_like` VALUES ('100', '30', '39');
