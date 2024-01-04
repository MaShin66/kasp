-- MySQL dump 10.9
--
-- Host: localhost    Database: utfhome_bak
-- ------------------------------------------------------
-- Server version	4.1.22-standard
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO,MYSQL323' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `wiz_admin`
--

DROP TABLE IF EXISTS `wiz_admin`;
CREATE TABLE `wiz_admin` (
  `id` varchar(20) NOT NULL default '',
  `passwd` varchar(20) default NULL,
  `name` varchar(100) default NULL,
  `icon` varchar(30) default NULL,
  `resno` varchar(14) default NULL,
  `email` varchar(80) default NULL,
  `tphone` varchar(14) default NULL,
  `hphone` varchar(14) default NULL,
  `post` varchar(7) default NULL,
  `address1` varchar(255) default NULL,
  `address2` varchar(255) default NULL,
  `part` int(3) default NULL,
  `permi` mediumtext,
  `last` datetime default NULL,
  `wdate` datetime default NULL,
  `descript` mediumtext,
  PRIMARY KEY  (`id`)
);

--
-- Dumping data for table `wiz_admin`
--

/*!40000 ALTER TABLE `wiz_admin` DISABLE KEYS */;
INSERT INTO `wiz_admin` VALUES ('admin','1234','관리자','admin_icon.jpg','761001-1000004','test@test.com','000-0000-0000','000-0000-0000','000-000','서울 서초구 서초동','000-0번지 000호',0,'','2011-11-24 17:49:25','2006-08-11 11:59:21','메모');
/*!40000 ALTER TABLE `wiz_admin` ENABLE KEYS */;

--
-- Table structure for table `wiz_banner`
--

DROP TABLE IF EXISTS `wiz_banner`;
CREATE TABLE `wiz_banner` (
  `idx` int(3) NOT NULL auto_increment,
  `code` varchar(20) NOT NULL default '',
  `align` enum('R','L') default NULL,
  `prior` int(3) default NULL,
  `isuse` enum('Y','N') default NULL,
  `link_url` varchar(255) default NULL,
  `link_target` enum('_SELF','_BLANK') default NULL,
  `de_type` enum('IMG','HTML') default NULL,
  `de_img` varchar(255) default NULL,
  `de_html` mediumtext,
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=34;

--
-- Dumping data for table `wiz_banner`
--

/*!40000 ALTER TABLE `wiz_banner` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiz_banner` ENABLE KEYS */;

--
-- Table structure for table `wiz_bannerinfo`
--

DROP TABLE IF EXISTS `wiz_bannerinfo`;
CREATE TABLE `wiz_bannerinfo` (
  `idx` int(5) NOT NULL auto_increment,
  `title` varchar(20) NOT NULL default '',
  `code` varchar(20) NOT NULL default '',
  `types` enum('W','H') NOT NULL default 'W',
  `types_num` int(3) NOT NULL default '1',
  `padding` int(3) NOT NULL default '0',
  `isuse` enum('Y','N') NOT NULL default 'Y',
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=13;

--
-- Dumping data for table `wiz_bannerinfo`
--

/*!40000 ALTER TABLE `wiz_bannerinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiz_bannerinfo` ENABLE KEYS */;

--
-- Table structure for table `wiz_bbs`
--

DROP TABLE IF EXISTS `wiz_bbs`;
CREATE TABLE `wiz_bbs` (
  `idx` int(10) NOT NULL auto_increment,
  `code` varchar(30) default NULL,
  `prino` int(10) default NULL,
  `grpno` int(10) default NULL,
  `depno` int(2) default NULL,
  `notice` char(1) default NULL,
  `category` varchar(80) default NULL,
  `memid` varchar(20) default NULL,
  `memgrp` varchar(255) default NULL,
  `name` varchar(100) default NULL,
  `nick` varchar(100) default NULL,
  `email` varchar(50) default NULL,
  `tphone` varchar(20) default NULL,
  `hphone` varchar(20) default NULL,
  `zipcode` varchar(20) default NULL,
  `address` varchar(255) default NULL,
  `subject` varchar(100) default NULL,
  `content` mediumtext,
  `reply` mediumtext,
  `addinfo1` varchar(255) default NULL,
  `addinfo2` varchar(255) default NULL,
  `addinfo3` varchar(255) default NULL,
  `addinfo4` varchar(255) default NULL,
  `addinfo5` varchar(255) default NULL,
  `ctype` enum('T','H') default NULL,
  `privacy` enum('Y','N') default NULL,
  `upfile1` varchar(40) default NULL,
  `upfile2` varchar(40) default NULL,
  `upfile3` varchar(40) default NULL,
  `upfile4` varchar(40) default NULL,
  `upfile5` varchar(40) default NULL,
  `upfile6` varchar(40) default NULL,
  `upfile7` varchar(40) default NULL,
  `upfile8` varchar(40) default NULL,
  `upfile9` varchar(40) default NULL,
  `upfile10` varchar(40) default NULL,
  `upfile11` varchar(40) default NULL,
  `upfile12` varchar(40) default NULL,
  `upfile1_name` varchar(255) default NULL,
  `upfile2_name` varchar(255) default NULL,
  `upfile3_name` varchar(255) default NULL,
  `upfile4_name` varchar(255) default NULL,
  `upfile5_name` varchar(255) default NULL,
  `upfile6_name` varchar(255) default NULL,
  `upfile7_name` varchar(255) default NULL,
  `upfile8_name` varchar(255) default NULL,
  `upfile9_name` varchar(255) default NULL,
  `upfile10_name` varchar(255) default NULL,
  `upfile11_name` varchar(255) default NULL,
  `upfile12_name` varchar(255) default NULL,
  `movie1` mediumtext,
  `movie2` mediumtext,
  `movie3` mediumtext,
  `passwd` varchar(30) default NULL,
  `count` int(8) default NULL,
  `recom` int(8) default NULL,
  `comment` int(8) default NULL,
  `ip` varchar(15) default NULL,
  `wdate` int(10) default NULL,
  `status` char(1) default NULL,
  PRIMARY KEY  (`idx`),
  KEY `code` (`code`)
) AUTO_INCREMENT=5124;

--
-- Dumping data for table `wiz_bbs`
--

/*!40000 ALTER TABLE `wiz_bbs` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiz_bbs` ENABLE KEYS */;

--
-- Table structure for table `wiz_bbscat`
--

DROP TABLE IF EXISTS `wiz_bbscat`;
CREATE TABLE `wiz_bbscat` (
  `idx` int(10) unsigned NOT NULL auto_increment,
  `gubun` char(1) default NULL,
  `code` varchar(30) default NULL,
  `catname` varchar(100) default NULL,
  `catimg` varchar(30) default NULL,
  `catimg_over` varchar(30) default NULL,
  `caticon` varchar(30) default NULL,
  `prior` int(11) default NULL,
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=49;

--
-- Dumping data for table `wiz_bbscat`
--

/*!40000 ALTER TABLE `wiz_bbscat` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiz_bbscat` ENABLE KEYS */;

--
-- Table structure for table `wiz_bbsinfo`
--

DROP TABLE IF EXISTS `wiz_bbsinfo`;
CREATE TABLE `wiz_bbsinfo` (
  `code` varchar(30) default NULL,
  `type` enum('BBS','SCH') default NULL,
  `title` varchar(50) default NULL,
  `titleimg` varchar(40) default NULL,
  `header` varchar(255) default NULL,
  `footer` varchar(255) default NULL,
  `category` varchar(255) default NULL,
  `bbsadmin` varchar(255) default NULL,
  `lpermi` varchar(6) default NULL,
  `rpermi` varchar(6) default NULL,
  `wpermi` varchar(6) default NULL,
  `apermi` varchar(6) default NULL,
  `cpermi` varchar(6) default NULL,
  `datetype_list` varchar(30) default NULL,
  `datetype_view` varchar(30) default NULL,
  `skin` varchar(50) default NULL,
  `permsg` varchar(255) default NULL,
  `perurl` varchar(255) default NULL,
  `pageurl` varchar(255) default NULL,
  `editor` enum('Y','N') default NULL,
  `usetype` enum('Y','N') default NULL,
  `privacy` enum('Y','N') default NULL,
  `sms` enum('Y','N') default NULL,
  `upfile` int(2) default NULL,
  `movie` int(2) default NULL,
  `comment` enum('Y','N') default NULL,
  `remail` enum('Y','N') default NULL,
  `imgview` enum('Y','N') default NULL,
  `recom` enum('Y','N') default NULL,
  `abuse` enum('Y','N') default NULL,
  `abtxt` mediumtext,
  `simgsize` int(3) default NULL,
  `mimgsize` int(3) default NULL,
  `rows` int(3) default NULL,
  `lists` int(3) default NULL,
  `newc` int(3) default NULL,
  `hotc` int(3) default NULL,
  `line` int(3) default NULL,
  `subject_len` int(3) default NULL,
  `view_point` int(11) default NULL,
  `write_point` int(11) default NULL,
  `down_point` int(11) default NULL,
  `comment_point` int(11) default NULL,
  `recom_point` int(11) default NULL,
  `point_msg` varchar(255) default NULL,
  `img_align` varchar(10) default NULL,
  `btn_view` enum('Y','N') default NULL,
  `spam_check` enum('Y','N') default NULL,
  `view_list` enum('Y','N') default NULL,
  `name_type` varchar(5) default NULL,
  `grp` int(11) default NULL,
  `prior` bigint(20) default NULL,
  UNIQUE KEY `code` (`code`)
);

--
-- Dumping data for table `wiz_bbsinfo`
--

/*!40000 ALTER TABLE `wiz_bbsinfo` DISABLE KEYS */;
INSERT INTO `wiz_bbsinfo` VALUES ('schedule','SCH','일정','','','','','','','','','0','','','%Y.%m.%d','scheduleBasic','권한이 없습니다.','/sub07/sub01.php','sub05/sub05_05.php','Y','','',NULL,3,3,'Y','','','N','','',120,500,0,0,0,0,0,0,0,0,0,0,0,'','CENTER','N','Y',NULL,'',0,0);
/*!40000 ALTER TABLE `wiz_bbsinfo` ENABLE KEYS */;

--
-- Table structure for table `wiz_bbsmain`
--

DROP TABLE IF EXISTS `wiz_bbsmain`;
CREATE TABLE `wiz_bbsmain` (
  `idx` int(10) unsigned NOT NULL auto_increment,
  `code` varchar(20) NOT NULL default '',
  `btype` enum('BBS','PHOTO') default NULL,
  `purl` varchar(255) default NULL,
  `cnt` int(3) default NULL,
  `line` int(3) default NULL,
  `skin` mediumtext,
  `subject_len` int(3) default NULL,
  `content_len` int(3) default NULL,
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=33;

--
-- Dumping data for table `wiz_bbsmain`
--

/*!40000 ALTER TABLE `wiz_bbsmain` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiz_bbsmain` ENABLE KEYS */;

--
-- Table structure for table `wiz_catainfo`
--

DROP TABLE IF EXISTS `wiz_catainfo`;
CREATE TABLE `wiz_catainfo` (
  `idx` int(10) unsigned NOT NULL auto_increment,
  `code` varchar(10) NOT NULL default '',
  `title` varchar(128) NOT NULL default '',
  `status` enum('N','Y') NOT NULL default 'Y',
  PRIMARY KEY  (`idx`),
  UNIQUE KEY `code` (`code`)
) AUTO_INCREMENT=10;

--
-- Dumping data for table `wiz_catainfo`
--

/*!40000 ALTER TABLE `wiz_catainfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiz_catainfo` ENABLE KEYS */;

--
-- Table structure for table `wiz_catalog`
--

DROP TABLE IF EXISTS `wiz_catalog`;
CREATE TABLE `wiz_catalog` (
  `idx` int(10) unsigned NOT NULL auto_increment,
  `code` varchar(10) NOT NULL default '',
  `filename` varchar(64) NOT NULL default '',
  `status` enum('N','Y') NOT NULL default 'Y',
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=27;

--
-- Dumping data for table `wiz_catalog`
--

/*!40000 ALTER TABLE `wiz_catalog` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiz_catalog` ENABLE KEYS */;

--
-- Table structure for table `wiz_category`
--

DROP TABLE IF EXISTS `wiz_category`;
CREATE TABLE `wiz_category` (
  `catcode` varchar(6) NOT NULL default '',
  `depthno` int(1) default NULL,
  `priorno01` int(2) default NULL,
  `priorno02` int(2) default NULL,
  `priorno03` int(2) default NULL,
  `catname` varchar(255) default NULL,
  `catuse` enum('Y','N') default NULL,
  `catimg` varchar(100) default NULL,
  `subimg` mediumtext,
  `subimg_type` varchar(3) default NULL,
  `prd_skin` varchar(10) default NULL,
  `prd_num` int(3) default NULL,
  `prd_width` varchar(3) default NULL,
  `prd_height` varchar(3) default NULL,
  `purl` mediumtext,
  PRIMARY KEY  (`catcode`)
);

--
-- Dumping data for table `wiz_category`
--

/*!40000 ALTER TABLE `wiz_category` DISABLE KEYS */;
INSERT INTO `wiz_category` VALUES ('000000',0,0,0,0,'제품소개','','000000_cat.jpg','','','prdBasic',20,'','','sub02/sub00.php'),('100000',1,1,0,0,'상품분류1','','100000_cat.htm','','','prdBasic',20,'','','sub06/sub06_01.php'),('110000',1,2,0,0,'상품분류2','','','','','prdBasic2',20,'','','sub06/sub06_02.php'),('101100',2,1,2,0,'2차분류2','','','','','prdBasic',20,'','','sub06/sub06_01.php'),('101010',3,1,1,1,'3차분류 1','','','','','prdBasic',20,'','','sub06/sub06_01.php'),('120000',1,3,0,0,'상품분류3','','','','','prdBasic2',20,'','','sub06/sub06_03.php'),('101000',2,1,1,0,'2차분류1','','','','','prdBasic',20,'','','sub06/sub06_01.php'),('101011',3,1,1,2,'3차분류 2','','','','','prdBasic',20,'','','sub06/sub06_01.php'),('111000',2,2,1,0,'2차분류1','','','','','prdBasic2',20,'','','sub06/sub06_02.php'),('111100',2,2,2,0,'2차분류2','','','','','prdBasic2',20,'','','sub06/sub06_02.php'),('121000',2,3,1,0,'2차분류1','','','','','prdBasic2',20,'','','sub06/sub06_03.php'),('121100',2,3,2,0,'2차분류2','','','','','prdBasic2',20,'','','sub06/sub06_03.php');
/*!40000 ALTER TABLE `wiz_category` ENABLE KEYS */;

--
-- Table structure for table `wiz_comment`
--

DROP TABLE IF EXISTS `wiz_comment`;
CREATE TABLE `wiz_comment` (
  `idx` int(10) NOT NULL auto_increment,
  `ctype` varchar(10) default NULL,
  `cidx` int(10) default NULL,
  `star` int(1) default NULL,
  `memid` varchar(20) default NULL,
  `name` varchar(100) default NULL,
  `nick` varchar(100) default NULL,
  `content` mediumtext,
  `passwd` varchar(20) default NULL,
  `wdate` datetime default NULL,
  `ip` varchar(20) default NULL,
  PRIMARY KEY  (`idx`),
  KEY `cidx` (`cidx`)
) AUTO_INCREMENT=220;

--
-- Dumping data for table `wiz_comment`
--

/*!40000 ALTER TABLE `wiz_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiz_comment` ENABLE KEYS */;

--
-- Table structure for table `wiz_conother`
--

DROP TABLE IF EXISTS `wiz_conother`;
CREATE TABLE `wiz_conother` (
  `os` varchar(20) default NULL,
  `browser` varchar(20) default NULL,
  `cnt` int(10) default NULL
);

--
-- Dumping data for table `wiz_conother`
--

/*!40000 ALTER TABLE `wiz_conother` DISABLE KEYS */;
INSERT INTO `wiz_conother` VALUES (NULL,'Explorer 8.0',152),('WinXP',NULL,154),(NULL,'Mozilla',8),(NULL,'Explorer',15),('Win7',NULL,20),(NULL,'Etc',32),('Etc',NULL,34),(NULL,'Firefox',1);
/*!40000 ALTER TABLE `wiz_conother` ENABLE KEYS */;

--
-- Table structure for table `wiz_conrefer`
--

DROP TABLE IF EXISTS `wiz_conrefer`;
CREATE TABLE `wiz_conrefer` (
  `referer` mediumtext,
  `host` varchar(30) default NULL,
  `wdate` date default NULL,
  `cnt` int(10) default NULL,
  KEY `host` (`host`),
  KEY `wdate` (`wdate`)
);

--
-- Dumping data for table `wiz_conrefer`
--

/*!40000 ALTER TABLE `wiz_conrefer` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiz_conrefer` ENABLE KEYS */;

--
-- Table structure for table `wiz_contime`
--

DROP TABLE IF EXISTS `wiz_contime`;
CREATE TABLE `wiz_contime` (
  `time` int(10) default NULL,
  `cnt` int(10) default NULL
);

--
-- Dumping data for table `wiz_contime`
--

/*!40000 ALTER TABLE `wiz_contime` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiz_contime` ENABLE KEYS */;

--
-- Table structure for table `wiz_cprelation`
--

DROP TABLE IF EXISTS `wiz_cprelation`;
CREATE TABLE `wiz_cprelation` (
  `idx` int(10) NOT NULL auto_increment,
  `prdcode` char(10) default NULL,
  `catcode` char(6) default NULL,
  PRIMARY KEY  (`idx`),
  KEY `catcode` (`catcode`)
) AUTO_INCREMENT=73;

--
-- Dumping data for table `wiz_cprelation`
--

/*!40000 ALTER TABLE `wiz_cprelation` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiz_cprelation` ENABLE KEYS */;

--
-- Table structure for table `wiz_filedesc`
--

DROP TABLE IF EXISTS `wiz_filedesc`;
CREATE TABLE `wiz_filedesc` (
  `idx` int(10) NOT NULL auto_increment,
  `fdir` text,
  `fdesc` text,
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=427;

--
-- Dumping data for table `wiz_filedesc`
--

/*!40000 ALTER TABLE `wiz_filedesc` DISABLE KEYS */;
INSERT INTO `wiz_filedesc` VALUES (1,'',''),(2,'/admin2/member','회원관리'),(3,'/admin2/member/join_save.php','회원정보저장 페이지'),(4,'/admin2/member/join_input.php','회원입력 페이지'),(5,'/admin2/member/loginbox.php','로그인박스'),(6,'/admin2/bbs','게시판'),(7,'/admin2/mini','미니홈피'),(8,'/admin2/manage','관리자페이지'),(9,'/admin2/bbs/down.php','첨부파일 다운로드'),(10,'/admin2/bbs/copy.php','게시물복사'),(11,'/admin2/bbs/move.php','게시물이동'),(12,'/admin2/bbs/skin','스킨 디렉토리'),(13,'/admin2/bbs/comment.php','코멘트'),(14,'/admin2/bbs/input.php','입력페이지'),(15,'/admin2/bbs/list.php','리스트페이지'),(16,'/admin2/bbs/passwd.php','비밀번호체크'),(17,'/admin2/bbs/save.php','데이타저장'),(18,'/admin2/bbs/list_bak.php','리스트페이지 백업'),(19,'/admin2/bbs/norobot_image.php','스팸글방지 이미지생성'),(20,'/admin2/bbs/view.php','보기페이지'),(21,'/admin2/bbs/view_img.php','첨부이미지 확대보기'),(22,'/admin2/bbsmain','메인게시물'),(23,'/admin2/bbsmain/image','이미지'),(24,'/admin2/bbsmain/skin','스킨 디렉토리'),(25,'/admin2/data','데이터 디렉토리'),(26,'/admin2/form','폼메일'),(27,'/admin2/form/skin','스킨 디렉토리'),(28,'/admin2/form/input.php','폼메일 작성'),(29,'/admin2/form/save.php','폼메일 저장'),(30,'/admin2/inc','인클루드 디렉토리'),(31,'/admin2/inc/admin_check.php','관리자 체크'),(32,'/admin2/inc/bbs_info.php','게시판 정보'),(33,'/admin2/inc/bbsmain_info.php','메인게시물 정보'),(34,'/admin2/inc/class.sms.php','SMS 클래스'),(35,'/admin2/inc/form_info.php','폼메일 정보'),(36,'/admin2/inc/mem_info.php','회원설정 정보'),(37,'/admin2/inc/msg_info.php','쪽지설정 정보'),(38,'/admin2/inc/point_info.php','포인트설정 정보'),(39,'/admin2/inc/poll_info.php','설문조사 정보'),(40,'/admin2/inc/pollmain_info.php','메인설문조사 정보'),(41,'/admin2/inc/prd_info.php','상품설정 정보'),(42,'/admin2/inc/prdmain_info.php','메인상품 정보'),(43,'/admin2/inc/sch_info.php','일정관리 정보'),(44,'/admin2/inc/site_info.php','사이트 정보'),(45,'/admin2/js','js 디렉토리'),(46,'/admin2/mail','메일'),(47,'/admin2/mail/img','메일 이미지'),(48,'/admin2/manage/banner','배너관리'),(49,'/admin2/manage/banner/banner_input.php','배너그룹 입력페이지'),(50,'/admin2/manage/banner/banner_list.php','배너그룹 목록페이지'),(51,'/admin2/manage/banner/banner_save.php','데이터 저장'),(52,'/admin2/manage/banner/input.php','배너 입력페이지'),(53,'/admin2/manage/banner/left_menu.php','좌측 메뉴'),(54,'/admin2/manage/banner/list.php','배너 목록페이지'),(55,'/admin2/manage/basic','기본설정'),(56,'/admin2/manage/basic/admin_input.php','관리자 입력'),(57,'/admin2/manage/basic/admin_list.php','관리자 목록'),(58,'/admin2/manage/basic/admin_save.php','관리자 데이터 저장'),(59,'/admin2/manage/basic/domain_input.php','도메인 입력'),(60,'/admin2/manage/basic/email_input.php','이메일 입력'),(61,'/admin2/manage/basic/left_menu.php','좌측메뉴'),(62,'/admin2/manage/basic/popup_input.php','팝업 입력'),(63,'/admin2/manage/basic/popup_list.php','팝업 목록'),(64,'/admin2/manage/basic/popup_save.php','팝업 데이터 저장'),(65,'/admin2/manage/basic/site_info.php','사이트 정보 입력'),(66,'/admin2/manage/basic/site_save.php','사이트 정보 저장'),(67,'/admin2/manage/basic/sms_fill.php','SMS 관리'),(68,'/admin2/manage/basic/sms_info.php','SMS 충전내용'),(69,'/admin2/manage/basic/sms_save.php','SMS 데이터 저장'),(70,'/admin2/manage/bbs','게시판'),(71,'/admin2/manage/bbs/bbs_input.php','게시판 입력'),(72,'/admin2/manage/bbs/bbs_list.php','게시판 목록'),(73,'/admin2/manage/bbs/bbs_save.php','게시판 데이터 저장'),(74,'/admin2/manage/bbs/category.php','카테고리 목록'),(75,'/admin2/manage/bbs/category_input.php','카테고리 입력'),(76,'/admin2/manage/bbs/copy.php','게시물 복사'),(77,'/admin2/manage/bbs/down.php','첨부파일 다운로드'),(78,'/admin2/manage/bbs/input.php','게시물 입력'),(79,'/admin2/manage/bbs/left_menu.php','좌측메뉴'),(80,'/admin2/manage/bbs/list.php','게시물 목록'),(81,'/admin2/manage/bbs/list_c.php','게시물 목록 스킨버전'),(82,'/admin2/manage/bbs/move.php','게시물 이동'),(83,'/admin2/manage/bbs/pop_view.php','게시물 보기 팝업'),(84,'/admin2/manage/bbs/save.php','게시물 데이터 저장'),(85,'/admin2/manage/bbs/view.php','게시물 보기'),(86,'/admin2/manage/bbs/view_img.php','첨부이미지 확대보기'),(87,'/admin2/manage/config','환경설정'),(88,'/admin2/manage/config/banner_config.php','배너관리'),(89,'/admin2/manage/config/basic_config.php','기본설정'),(90,'/admin2/manage/config/basic_save.php','기본설정 저장'),(91,'/admin2/manage/config/bbs_config.php','게시판 관리'),(92,'/admin2/manage/config/bbsmain_config.php','메인게시물 관리'),(93,'/admin2/manage/config/bbsmain_input.php','메인게시물 입력'),(94,'/admin2/manage/config/bbsmain_save.php','메인게시물 저장'),(95,'/admin2/manage/config/bbsmain_view.php','메인게시물 미리보기'),(96,'/admin2/manage/config/counter_config.php','카운터'),(97,'/admin2/manage/config/form_config.php','폼메일'),(98,'/admin2/manage/config/form_field.php','폼메일 항목 목록'),(99,'/admin2/manage/config/form_field_c.php','폼메일 항목 목록 백업'),(100,'/admin2/manage/config/form_field_input.php','폼메일 항목 입력'),(101,'/admin2/manage/config/form_input.php','폼메일 입력'),(102,'/admin2/manage/config/form_save.php','폼메일 저장'),(103,'/admin2/manage/config/form_save_c.php','폼메일 저장 백업'),(104,'/admin2/manage/config/left_menu.php','좌측 메뉴'),(105,'/admin2/manage/config/levelcheck_config.php','페이지접근권한'),(106,'/admin2/manage/config/log_config.php','로그분석'),(107,'/admin2/manage/config/member_config.php','회원설정'),(108,'/admin2/manage/config/member_save.php','회원설정 저장'),(109,'/admin2/manage/config/message_config.php','쪽지설정'),(110,'/admin2/manage/config/message_save.php','쪽지설정 저장'),(111,'/admin2/manage/config/mini_config.php','미니홈피 설정'),(112,'/admin2/manage/config/mini_save.php','미니홈피 설정 저장'),(113,'/admin2/manage/config/page_config.php','페이지 관리'),(114,'/admin2/manage/config/point_config.php','포인트 설정'),(115,'/admin2/manage/config/point_save.php','포인트 설정 저장'),(116,'/admin2/manage/config/poll_config.php','설문조사 '),(117,'/admin2/manage/config/poll_config_b.php','설문조사 백업'),(118,'/admin2/manage/config/pollmain_config.php','메인설문조사'),(119,'/admin2/manage/config/pollmain_input.php','메인설문조사 입력'),(120,'/admin2/manage/config/pollmain_save.php','메인설문조사 저장'),(121,'/admin2/manage/config/popup_config.php','팝업관리'),(122,'/admin2/manage/config/prdmain_input.php','메인 상품추출 입력'),(123,'/admin2/manage/config/prdmain_save.php','메인 상품추출 저장'),(124,'/admin2/manage/config/prdmain_view.php','메인 상품추출 미리보기'),(125,'/admin2/manage/config/product_config.php','상품관리'),(126,'/admin2/manage/config/schedule_config.php','일정관리'),(127,'/admin2/manage/config/sms_config.php','SMS 발송'),(128,'/admin2/manage/connect','접속통계'),(129,'/admin2/manage/connect/connect_keyword.php','검색키워드분석'),(130,'/admin2/manage/connect/connect_list.php','접속자분석'),(131,'/admin2/manage/connect/connect_param.php','분석파라미터 설정'),(132,'/admin2/manage/connect/connect_refer.php','접속경로분석'),(133,'/admin2/manage/connect/connect_save.php','초기화 및 파라미터 설정 저장'),(134,'/admin2/manage/connect/left_menu.php','좌측메뉴'),(135,'/admin2/manage/form','폼메일'),(136,'/admin2/manage/form/down.php','첨부파일 다운로드'),(137,'/admin2/manage/form/form_input.php','폼메일 입력'),(138,'/admin2/manage/form/form_list.php','폼메일 목록'),(139,'/admin2/manage/form/form_save.php','폼메일 저장'),(140,'/admin2/manage/form/form_view.php','폼메일 보기'),(141,'/admin2/manage/form/left_menu.php','좌측메뉴'),(142,'/admin2/manage/image','이미지'),(143,'/admin2/manage/image/bbs','게시판 이미지'),(144,'/admin2/manage/image/day','달력 이미지'),(145,'/admin2/manage/image/main','메인 이미지'),(146,'/admin2/manage/image/tree','상품분류 트리 이미지'),(147,'/admin2/manage/main','메인'),(148,'/admin2/manage/main/left_menu.php','좌측메뉴'),(149,'/admin2/manage/main/main.php','메인페이지'),(150,'/admin2/manage/member','회원관리'),(151,'/admin2/manage/member/id_check.php','아이디 중복검사'),(152,'/admin2/manage/member/left_menu.php','좌측메뉴'),(153,'/admin2/manage/member/level_input.php','회원등급 입력'),(154,'/admin2/manage/member/level_list.php','회원등급 목록'),(155,'/admin2/manage/member/level_save.php','회원등급 저장'),(156,'/admin2/manage/member/mail_input.php','메세지설정 입력'),(157,'/admin2/manage/member/mail_list.php','메세지설정 목록'),(158,'/admin2/manage/member/mail_popup.php','메일발송 팝업'),(159,'/admin2/manage/member/mail_save.php','메세지설정 저장'),(160,'/admin2/manage/member/mail_send.php','단체메일발송'),(161,'/admin2/manage/member/mail_set.php','메일 내용 세팅'),(162,'/admin2/manage/member/mail_test.php','메일발송테스트'),(163,'/admin2/manage/member/member_analy.php','회원통계'),(164,'/admin2/manage/member/member_config.php','가입약관 및 개인정보 보호정책'),(165,'/admin2/manage/member/member_excel.php','회원정보 엑셀 다운로드'),(166,'/admin2/manage/member/member_input.php','회원정보 입력'),(167,'/admin2/manage/member/member_list.php','회원목록'),(168,'/admin2/manage/member/member_point.php','회원포인트 목록'),(169,'/admin2/manage/member/member_save.php','회원 데이터 저장'),(170,'/admin2/manage/member/message_input.php','쪽지 입력'),(171,'/admin2/manage/member/message_list.php','쪽지 목록'),(172,'/admin2/manage/member/message_save.php','쪽지 저장'),(173,'/admin2/manage/member/message_send.php','쪽지발송'),(174,'/admin2/manage/member/out_list.php','탈퇴회원'),(175,'/admin2/manage/member/point_config.php','포인트 설정'),(176,'/admin2/manage/member/point_list.php','포인트 목록'),(177,'/admin2/manage/member/point_save.php','포인트 저장'),(178,'/admin2/manage/member/search_zip.php','주소찾기'),(179,'/admin2/manage/member/sms_popup.php','SMS 발송 팝업'),(180,'/admin2/manage/member/sms_save.php','SMS 발송'),(181,'/admin2/manage/member/sms_send.php','단체SMS발송'),(182,'/admin2/manage/mini','미니홈피'),(183,'/admin2/manage/mini/down.php','첨부파일 다운로드'),(184,'/admin2/manage/mini/input.php','게시물 입력'),(185,'/admin2/manage/mini/left_menu.php','좌측메뉴'),(186,'/admin2/manage/mini/list.php','게시물목록'),(187,'/admin2/manage/mini/mini_input.php','미니홈피 입력'),(188,'/admin2/manage/mini/mini_list.php','미니홈피 목록'),(189,'/admin2/manage/mini/mini_save.php','미니홈피 저장'),(190,'/admin2/manage/mini/save.php','게시물 저장'),(191,'/admin2/manage/mini/skin_input.php','스킨 입력'),(192,'/admin2/manage/mini/skin_list.php','스킨 목록'),(193,'/admin2/manage/mini/skin_save.php','스킨 저장'),(194,'/admin2/manage/mini/url_check.php','미니홈피URL 중복체크'),(195,'/admin2/manage/mini/view.php','게시글 보기'),(196,'/admin2/manage/mini/view_img.php','첨부이미지 확대보기'),(197,'/admin2/manage/page','페이지관리'),(198,'/admin2/manage/page/left_menu.php','좌측메뉴'),(199,'/admin2/manage/page/page_input.php','페이지 입력'),(200,'/admin2/manage/page/page_list.php','페이지 목록'),(201,'/admin2/manage/page/page_save.php','페이지 저장'),(202,'/admin2/manage/poll','설문관리'),(203,'/admin2/manage/poll/left_menu.php','좌측메뉴'),(204,'/admin2/manage/poll/poll_input.php','설문조사 입력'),(205,'/admin2/manage/poll/poll_list.php','설문조사 목록'),(206,'/admin2/manage/poll/poll_question.php','설문내용 입력'),(207,'/admin2/manage/poll/poll_save.php','설문조사 저장'),(208,'/admin2/manage/poll/pollinfo_input.php','설문 입력'),(209,'/admin2/manage/poll/pollinfo_list.php','설문 목록'),(210,'/admin2/manage/poll/pollinfo_save.php','설문 저장'),(211,'/admin2/manage/product','상품관리'),(212,'/admin2/manage/product/cat_list.php','상품분류 목록'),(213,'/admin2/manage/product/cat_save.php','상품분류 저장'),(214,'/admin2/manage/product/left_menu.php','좌측메뉴'),(215,'/admin2/manage/product/prd_cat.php','상품분류'),(216,'/admin2/manage/product/prd_copy.php','상품 복사'),(217,'/admin2/manage/product/prd_img.php','상품입력 > 상품사진'),(218,'/admin2/manage/product/prd_imgsize.php','상품이미지사이즈 설정'),(219,'/admin2/manage/product/prd_input.php','상품 입력'),(220,'/admin2/manage/product/prd_list.php','상품 목록'),(221,'/admin2/manage/product/prd_move.php','상품 이동'),(222,'/admin2/manage/product/prd_save.php','상품 저장'),(223,'/admin2/manage/schedule','일정관리'),(224,'/admin2/manage/schedule/calendar.php','큰 달력'),(225,'/admin2/manage/schedule/calendar_s.php','작은 달력'),(226,'/admin2/manage/schedule/down.php','첨부파일 다운로드'),(227,'/admin2/manage/schedule/input.php','일정 입력'),(228,'/admin2/manage/schedule/left_menu.php','좌측메뉴'),(229,'/admin2/manage/schedule/list.php','일정 목록'),(230,'/admin2/manage/schedule/save.php','일정 저장'),(231,'/admin2/manage/schedule/sch_input.php','일정정보 입력'),(232,'/admin2/manage/schedule/sch_list.php','일정정보 목록'),(233,'/admin2/manage/schedule/sch_save.php','일정정보 저장'),(234,'/admin2/manage/schedule/schedule_s.php','관리자 메인 일정달력'),(235,'/admin2/manage/schedule/view.php','일정 보기'),(236,'/admin2/manage/schedule/view_img.php','첨부이미지 확대보기'),(237,'/admin2/manage/db_backup.php','DB 백업'),(238,'/admin2/manage/foot.php','관리자 하단'),(239,'/admin2/manage/head.php','관리자 상단'),(240,'/admin2/manage/site_info.php','사이트 기본정보'),(241,'/admin2/member/skin','스킨 디렉토리'),(242,'/admin2/member/id_check.php','아이디 중복체크'),(243,'/admin2/member/idpw.php','아이디/비밀번호 찾기'),(244,'/admin2/member/join_agree.php','회원가입 약관 및 개인정보 보호정책 동의'),(245,'/admin2/member/join_ok.php','회원가입 완료'),(246,'/admin2/member/login.php','로그인 페이지'),(247,'/admin2/member/login_check.php','로그인 처리'),(248,'/admin2/member/logout.php','로그아웃 처리'),(249,'/admin2/member/myinfo.php','회원정보'),(250,'/admin2/member/myinfo_save.php','회원정보 저장'),(251,'/admin2/member/myout.php','회원탈퇴'),(252,'/admin2/member/myout_save.php','회원탈퇴 처리'),(253,'/admin2/member/name_check.php','실명인증'),(254,'/admin2/member/nick_check.php','닉네임 중복체크'),(255,'/admin2/member/post_search.php','우편번호 찾기'),(256,'/admin2/message','쪽지'),(257,'/admin2/message/skin','스킨 디렉토리'),(258,'/admin2/message/down.php','첨부파일 다운로드'),(259,'/admin2/message/friend.php','친구목록'),(260,'/admin2/message/input.php','쪽지입력'),(261,'/admin2/message/list.php','쪽지목록'),(262,'/admin2/message/member.php','회원목록'),(263,'/admin2/message/passwd.php','삭제확인 페이지'),(264,'/admin2/message/pop_message.php','쪽지 보기 팝업'),(265,'/admin2/message/save.php','쪽지 저장'),(266,'/admin2/message/save_b.php','쪽지 저장 백업'),(267,'/admin2/message/view.php','쪽지 보기'),(268,'/admin2/message/view_img.php','첨부이미지 확대보기'),(269,'/admin2/mini/bbs','게시판'),(270,'/admin2/mini/bbs/skin','스킨 디렉토리'),(271,'/admin2/mini/bbs/comment.php','코멘트'),(272,'/admin2/mini/bbs/down.php','첨부파일 다운로드'),(273,'/admin2/mini/bbs/input.php','입력페이지'),(274,'/admin2/mini/bbs/list.php','목록페이지'),(275,'/admin2/mini/bbs/move.php','게시물 이동'),(276,'/admin2/mini/bbs/passwd.php','비밀번호 체크'),(277,'/admin2/mini/bbs/save.php','데이터저장'),(278,'/admin2/mini/bbs/view.php','보기페이지'),(279,'/admin2/mini/bbs/view_img.php','첨부이미지 확대보기'),(280,'/admin2/mini/image','이미지 디렉토리'),(281,'/admin2/mini/inc','인클루드 디렉토리'),(282,'/admin2/mini/inc/mini_connect.php','미니홈피 로그분석'),(283,'/admin2/mini/inc/mini_info.php','미니홈피 정보'),(284,'/admin2/mini/inc/minibbs_info.php','미니홈피 게시판 정보'),(285,'/admin2/mini/makeucc','UCC 컴포넌트'),(286,'/admin2/mini/makeucc/example','UCC 예제'),(287,'/admin2/mini/makeucc/example/board','UCC 게시판'),(288,'/admin2/mini/makeucc/example/board/db','UCC DB 처리'),(289,'/admin2/mini/makeucc/example/board/img','UCC 게시판 이미지'),(290,'/admin2/mini/makeucc/view_file.php','UCC 파일 정보 전달'),(291,'/admin2/mini/music','미니홈피 음악'),(292,'/admin2/mini/music/img','이미지 디렉토리'),(293,'/admin2/mini/add_friend.php','친구 추가'),(294,'/admin2/mini/admin_connect.php','관리 > 접속통계'),(295,'/admin2/mini/admin_friend.php','관리 > 친구관리'),(296,'/admin2/mini/admin_info.php','관리 > 기본설정'),(297,'/admin2/mini/admin_left.php','관리 > 좌측메뉴'),(298,'/admin2/mini/admin_menu.php','관리 > 메뉴설정'),(299,'/admin2/mini/admin_menu_config.php','관리 > 메뉴설정 > 메뉴관리'),(300,'/admin2/mini/admin_music.php','관리 > 음악설정'),(301,'/admin2/mini/admin_music_input.php','음악입력'),(302,'/admin2/mini/admin_profile.php','관리 > 프로필'),(303,'/admin2/mini/admin_skin.php','관리 > 스킨설정'),(304,'/admin2/mini/admin_skin_input.php','스킨입력'),(305,'/admin2/mini/bbs.php','게시판'),(306,'/admin2/mini/bbs_left.php','게시판 좌측메뉴'),(307,'/admin2/mini/data.php','자료실'),(308,'/admin2/mini/data_left.php','자료실 좌측메뉴'),(309,'/admin2/mini/foot.php','하단파일'),(310,'/admin2/mini/guest.php','방명록'),(311,'/admin2/mini/head.php','상단파일'),(312,'/admin2/mini/info.php','프로필 > 내소개'),(313,'/admin2/mini/info_input.php','내소개 입력'),(314,'/admin2/mini/info_list.php','내소개 목록'),(315,'/admin2/mini/main.php','메인페이지'),(316,'/admin2/mini/main_content.php','메인페이지 내용'),(317,'/admin2/mini/main_left.php','메인페이지 좌측메뉴'),(318,'/admin2/mini/menu.php','우측메뉴'),(319,'/admin2/mini/mini_index.php','미니홈피 인덱스'),(320,'/admin2/mini/mini_my.php','내 미니홈피가기'),(321,'/admin2/mini/movie.php','동영상'),(322,'/admin2/mini/movie_left.php','동영상 좌측메뉴'),(323,'/admin2/mini/photo.php','갤러리'),(324,'/admin2/mini/photo_left.php','갤러리 좌측메뉴'),(325,'/admin2/mini/profile.php','프로필'),(326,'/admin2/mini/profile_left.php','프로필 좌측메뉴'),(327,'/admin2/mini/save.php','데이터저장'),(328,'/admin2/mini/url_check.php','미니홈피 URL 중복체크'),(329,'/admin2/module','모듈'),(330,'/admin2/module/banner.php','배너 모듈'),(331,'/admin2/module/bbs.php','게시판 모듈'),(332,'/admin2/module/bbsmain.php','메인게시물 모듈'),(333,'/admin2/module/connect.php','로그분석 모듈'),(334,'/admin2/module/counter.php','카운터 모듈'),(335,'/admin2/module/form.php','폼메일 모듈'),(336,'/admin2/module/idpw.php','아이디/비밀번호 찾기 모듈'),(337,'/admin2/module/join.php','회원가입 모듈'),(338,'/admin2/module/levelcheck.php','페이지접근권한 모듈'),(339,'/admin2/module/login.php','로그인 모듈'),(340,'/admin2/module/loginbox.php','로그인박스 모듈'),(341,'/admin2/module/msg_count.php','쪽지갯수 모듈'),(342,'/admin2/module/msg_friend.php','친구목록 모듈'),(343,'/admin2/module/msg_member.php','회원목록 모듈'),(344,'/admin2/module/msg_receive.php','받은쪽지 모듈'),(345,'/admin2/module/msg_send.php','보낸쪽지 모듈'),(346,'/admin2/module/myinfo.php','회원정보수정 모듈'),(347,'/admin2/module/myout.php','회원탈퇴 모듈'),(348,'/admin2/module/mypoint.php','회원 포인트내역 모듈'),(349,'/admin2/module/page.php','페이지 모듈'),(350,'/admin2/module/point.php','포인트 모듈'),(351,'/admin2/module/poll.php','설문조사 모듈'),(352,'/admin2/module/pollmain.php','메인설문조사 모듈'),(353,'/admin2/module/popup.php','팝업 모듈'),(354,'/admin2/module/prdmain.php','상품메인추출 모듈'),(355,'/admin2/module/product.php','상품 모듈'),(356,'/admin2/module/schedule.php','일정(대) 모듈'),(357,'/admin2/module/schedule_s.php','일정(소) 모듈'),(358,'/admin2/module/sms.php','SMS발송 모듈'),(359,'/admin2/module/topjoin.php','로그인/로그아웃 탑메뉴 모듈'),(360,'/admin2/module/toplogin.php','회원가입/마이페이지 탑메뉴 모듈'),(361,'/admin2/point','포인트'),(362,'/admin2/point/skin','스킨 디렉토리'),(363,'/admin2/point/mypoint.php','포인트내역'),(364,'/admin2/poll','설문조사'),(365,'/admin2/poll/skin','스킨 디렉토리'),(366,'/admin2/poll/list.php','목록 페이지'),(367,'/admin2/poll/passwd.php','비밀번호 체크'),(368,'/admin2/poll/save.php','데이터저장'),(369,'/admin2/poll/view.php','보기 페이지'),(370,'/admin2/popup','팝업'),(371,'/admin2/popup/popup.php','일반 팝업'),(372,'/admin2/popup/popup_layer.php','레이어 팝업'),(373,'/admin2/product','상품'),(374,'/admin2/product/skin','스킨 디렉토리'),(375,'/admin2/product/list.php','목록 페이지'),(376,'/admin2/product/prdimg.php','상품이미지 확대보기'),(377,'/admin2/product/view.php','보기 페이지'),(378,'/admin2/schedule','일정'),(379,'/admin2/schedule/skin','스킨 디렉토리'),(380,'/admin2/schedule/comment.php','코멘트'),(381,'/admin2/schedule/down.php','첨부파일 다운로드'),(382,'/admin2/schedule/input.php','입력페이지'),(383,'/admin2/schedule/list.php','목록페이지'),(384,'/admin2/schedule/list_s.php','목록페이지(소)'),(385,'/admin2/schedule/passwd.php','비밀번호체크'),(386,'/admin2/schedule/save.php','데이터저장'),(387,'/admin2/schedule/view.php','보기페이지'),(388,'/admin2/schedule/view_img.php','첨부이미지 확대보기'),(389,'/admin2/sms','SMS 발송'),(390,'/admin2/sms/image','이미지 디렉토리'),(391,'/admin2/sms/input.php','입력 페이지'),(392,'/admin2/sms/send.php','발송 페이지'),(393,'/admin2/webedit','웹에디터'),(394,'/admin2/webedit/PopupWin','팝업 페이지'),(395,'/admin2/webedit/PopupWin/Editor_Help.htm','웹에디터 도움말'),(396,'/admin2/webedit/PopupWin/Editor_InsertFlash.htm','플래쉬 입력'),(397,'/admin2/webedit/PopupWin/Editor_InsertImage.htm','이미지 입력'),(398,'/admin2/webedit/PopupWin/Editor_InsertMovie.htm','동영상 입력'),(399,'/admin2/webedit/PopupWin/Editor_InsertTable.htm','테이블 입력'),(400,'/admin2/webedit/PopupWin/Editor_SelectColor.htm','색상 선택'),(401,'/admin2/webedit/PopupWin/Editor_Version.htm','웹에디터 버전'),(402,'/admin2/webedit/PopupWin/Editor_InsertFlash.php','플래쉬 저장'),(403,'/admin2/webedit/PopupWin/Editor_InsertImage.php','이미지 저장'),(404,'/admin2/webedit/PopupWin/Editor_InsertMovie.php','동영상 저장'),(405,'/admin2/webedit/images','이미지 디렉토리'),(406,'/admin2/common.php','설정파일'),(407,'/admin2/dbcon.php','DB 접속 정보'),(408,'/admin2/desc_file.php','파일구조'),(409,'/admin2/desc_table.php','디비스키마'),(410,'/admin2/index.php','관리자 인덱스페이지'),(411,'/admin2/install.php','솔루션 설치 정보 입력'),(412,'/admin2/install_ok.php','솔루션 설치'),(413,'/admin2/lib.php','함수선언'),(414,'/admin2/login.php','관리자 로그인'),(415,'/admin2/logout.php','관리자 로그아웃'),(416,'/admin2/phpinfo.php','PHP 정보 phpinfo()'),(417,'/admin2/query.php','쿼리문'),(418,'/admin2/site_key.php','라이센스키 입력'),(419,'/admin2/manage/bbs/group.php','게시판그룹 목록'),(420,'/admin2/manage/bbs/group_input.php','게시판그룹 입력'),(421,'/admin2/manage/bbs/list_b.php','게시물 목록 백업'),(422,'/admin2/manage/config/prd_config.php','상품관리'),(423,'/admin2/manage/config/prdmain_config.php','메인상품관리'),(424,'/admin2/bbs/order.php','게시물 순서변경'),(425,'/admin2/manage/bbs/bbs.php','게시판'),(426,'/admin2/desc_file_b.php','파일구조 백업');
/*!40000 ALTER TABLE `wiz_filedesc` ENABLE KEYS */;

--
-- Table structure for table `wiz_form`
--

DROP TABLE IF EXISTS `wiz_form`;
CREATE TABLE `wiz_form` (
  `idx` int(10) NOT NULL auto_increment,
  `code` varchar(20) default NULL,
  `name` varchar(100) default NULL,
  `phone` varchar(20) default NULL,
  `email` varchar(50) default NULL,
  `subject` varchar(255) default NULL,
  `content` mediumtext,
  `reply` mediumtext,
  `upfile1` varchar(255) default NULL,
  `upfile2` varchar(255) default NULL,
  `upfile3` varchar(255) default NULL,
  `upfile1_name` varchar(255) default NULL,
  `upfile2_name` varchar(255) default NULL,
  `upfile3_name` varchar(255) default NULL,
  `wdate` datetime default NULL,
  `ip` varchar(15) default NULL,
  `status` varchar(20) default NULL,
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=161;

--
-- Dumping data for table `wiz_form`
--

/*!40000 ALTER TABLE `wiz_form` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiz_form` ENABLE KEYS */;

--
-- Table structure for table `wiz_formfield`
--

DROP TABLE IF EXISTS `wiz_formfield`;
CREATE TABLE `wiz_formfield` (
  `idx` int(10) NOT NULL auto_increment,
  `fidx` varchar(20) default NULL,
  `fprior` int(3) default NULL,
  `fname` varchar(60) default NULL,
  `ftype` varchar(20) default NULL,
  `fessen` enum('Y','N') default NULL,
  `fsize` varchar(5) default NULL,
  `fnum` varchar(5) default NULL,
  `fimg` varchar(100) default NULL,
  `flist` mediumtext,
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=151;

--
-- Dumping data for table `wiz_formfield`
--

/*!40000 ALTER TABLE `wiz_formfield` DISABLE KEYS */;
INSERT INTO `wiz_formfield` VALUES (88,'addinfo',1,'','text','','','1','',''),(89,'addinfo',2,'','text','','','1','',''),(90,'addinfo',3,'','file','','','1','',''),(91,'addinfo',4,'','file','','','1','',''),(92,'addinfo',5,'','text','','','1','','');
/*!40000 ALTER TABLE `wiz_formfield` ENABLE KEYS */;

--
-- Table structure for table `wiz_forminfo`
--

DROP TABLE IF EXISTS `wiz_forminfo`;
CREATE TABLE `wiz_forminfo` (
  `idx` int(10) NOT NULL auto_increment,
  `code` varchar(20) NOT NULL default '',
  `title` varchar(60) default NULL,
  `skin` varchar(30) default NULL,
  `rece_sms` char(1) default NULL,
  `rece_email` char(1) default NULL,
  `rece_bbs` char(1) default NULL,
  `sms_list` mediumtext,
  `email_list` mediumtext,
  `agree_use` char(1) default NULL,
  `agree_text` text,
  PRIMARY KEY  (`idx`),
  UNIQUE KEY `code` (`code`)
) AUTO_INCREMENT=126;

--
-- Dumping data for table `wiz_forminfo`
--

/*!40000 ALTER TABLE `wiz_forminfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiz_forminfo` ENABLE KEYS */;

--
-- Table structure for table `wiz_friend`
--

DROP TABLE IF EXISTS `wiz_friend`;
CREATE TABLE `wiz_friend` (
  `idx` int(10) unsigned NOT NULL auto_increment,
  `myid` varchar(20) NOT NULL default '',
  `frdid` varchar(20) NOT NULL default '',
  `wdate` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=13;

--
-- Dumping data for table `wiz_friend`
--

/*!40000 ALTER TABLE `wiz_friend` DISABLE KEYS */;
INSERT INTO `wiz_friend` VALUES (9,'test','test3','2008-02-13'),(12,'test','test2','2008-12-23'),(11,'test1','test','2008-03-13');
/*!40000 ALTER TABLE `wiz_friend` ENABLE KEYS */;

--
-- Table structure for table `wiz_level`
--

DROP TABLE IF EXISTS `wiz_level`;
CREATE TABLE `wiz_level` (
  `idx` int(10) NOT NULL auto_increment,
  `level` int(2) default NULL,
  `icon` varchar(60) default NULL,
  `name` varchar(100) default NULL,
  `permi` mediumtext,
  `memo` mediumtext,
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=5;

--
-- Dumping data for table `wiz_level`
--

/*!40000 ALTER TABLE `wiz_level` DISABLE KEYS */;
INSERT INTO `wiz_level` VALUES (1,3,'','일반회원','',''),(2,1,'','우수회원','',''),(3,2,'','정회원','','');
/*!40000 ALTER TABLE `wiz_level` ENABLE KEYS */;

--
-- Table structure for table `wiz_mailsms`
--

DROP TABLE IF EXISTS `wiz_mailsms`;
CREATE TABLE `wiz_mailsms` (
  `code` varchar(20) NOT NULL default '',
  `type` varchar(10) default NULL,
  `subject` varchar(255) default NULL,
  `sms_send` char(1) default NULL,
  `sms_msg` varchar(100) default NULL,
  `email_subj` varchar(255) default NULL,
  `email_send` char(1) default NULL,
  `email_msg` mediumtext,
  `wdate` date default NULL,
  PRIMARY KEY  (`code`)
);

--
-- Dumping data for table `wiz_mailsms`
--

/*!40000 ALTER TABLE `wiz_mailsms` DISABLE KEYS */;
INSERT INTO `wiz_mailsms` VALUES ('mem_join','MEM','회원가입시','Y','[{SITE_NAME}] 회원님 가입해주셔서 감사합니다.','[{SITE_NAME}] - {MEM_NAME} 회원님 가입해주셔서 감사합니다.','Y','<STYLE>\r\n  td {font-size:12px;font-family:\'굴림\',\'돋움\';color:#4A4A4A;line-height:160%} \r\n  table {border-collapse:collapse;}\r\n</STYLE>\r\n\r\n<TABLE height=\'100%\' cellSpacing=0 cellPadding=0 width=642 align=center border=0>\r\n<TBODY>\r\n<TR>\r\n<TD align=middle>\r\n<TABLE cellSpacing=0 cellPadding=0 border=0>\r\n<TBODY>\r\n<TR>\r\n<TD><IMG src=\'{SITE_URL}/admin2/mail/img/top_02.gif\'></TD></TR>\r\n<TR>\r\n<TD background={SITE_URL}/admin2/mail/img/bg_line.gif>\r\n<TABLE cellSpacing=0 cellPadding=0 width=642 border=0>\r\n<TBODY>\r\n<TR>\r\n<TD style=\'PADDING-RIGHT: 30px; PADDING-LEFT: 30px; PADDING-BOTTOM: 10px; PADDING-TOP: 10px\'>회원님 가입해주셔서 감사합니다.<BR><BR>아이디 : {MEM_ID}</TD>\r\n<TD vAlign=bottom align=right width=190><IMG src=\'{SITE_URL}/admin2/mail/img/img_06.gif\'></TD></TR></TBODY></TABLE></TD></TR>\r\n<TR>\r\n<TD><IMG src=\'{SITE_URL}/admin2/mail/img/bottom.gif\'></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>','2007-01-01'),('mem_out','MEM','회원탈퇴시','Y','[{SITE_NAME}] 회원님 탈퇴처리 되었습니다. 불편을드려 죄송합니다','[{SITE_NAME}] -  {MEM_NAME}회원님 탈퇴처리되었습니다.','Y','<STYLE>\r\n  td {font-size:12px;font-family:\'굴림\',\'돋움\';color:#4A4A4A;line-height:160%} \r\n  table {border-collapse:collapse;}\r\n</STYLE>\r\n\r\n<TABLE height=\'100%\' cellSpacing=0 cellPadding=0 width=642 align=center border=0>\r\n<TBODY>\r\n<TR>\r\n<TD align=middle>\r\n<TABLE cellSpacing=0 cellPadding=0 border=0>\r\n<TBODY>\r\n<TR>\r\n<TD><IMG src=\'{SITE_URL}/admin2/mail/img/top_03.gif\'></TD></TR>\r\n<TR>\r\n<TD background={SITE_URL}/admin2/mail/img/bg_line.gif>\r\n<TABLE cellSpacing=0 cellPadding=0 width=642 border=0>\r\n<TBODY>\r\n<TR>\r\n<TD style=\'PADDING-RIGHT: 30px; PADDING-LEFT: 30px; PADDING-BOTTOM: 10px; PADDING-TOP: 10px\'>회원님 탈퇴처리 되었습니다. 불편을드려 죄송합니다 </TD>\r\n<TD vAlign=bottom align=right width=190><IMG src=\'{SITE_URL}/admin2/mail/img/img_06.gif\'></TD></TR></TBODY></TABLE></TD></TR>\r\n<TR>\r\n<TD><IMG src=\'{SITE_URL}/admin2/mail/img/bottom.gif\'></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>','2007-01-02'),('basic','','일반 메일 발송시','','','','','<STYLE>\r\n  td {font-size:12px;font-family:굴림,돋움;color:#4A4A4A;line-height:160%} \r\n  table {border-collapse:collapse;}\r\n</STYLE>\r\n\r\n<TABLE height=100% cellSpacing=0 cellPadding=0 width=642 align=center border=0>\r\n<TBODY>\r\n<TR>\r\n<TD align=middle>\r\n<TABLE cellSpacing=0 cellPadding=0 border=0>\r\n<TBODY>\r\n<TR>\r\n<TD><IMG src={SITE_URL}/admin2/mail/img/top_01.gif></TD></TR>\r\n<TR>\r\n<TD background={SITE_URL}/admin2/mail/img/bg_line.gif>\r\n<TABLE cellSpacing=0 cellPadding=0 width=642 border=0>\r\n<TBODY>\r\n<TR>\r\n<TD style=\'PADDING-RIGHT: 10px; PADDING-LEFT: 10px; PADDING-BOTTOM: 10px; PADDING-TOP: 10px\'></TD></TR></TBODY></TABLE></TD></TR>\r\n<TR>\r\n<TD><IMG src={SITE_URL}/admin2/mail/img/bottom.gif></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>','2007-01-05'),('mem_idpw','MEM','아이디/비밀번호 찾기','Y','[{SITE_NAME}] 회원님의 아이디는 {MEM_ID} 입니다.','[{SITE_NAME}] -  {MEM_NAME}회원님이 요청하신 정보 입니다.','Y','<style>\r\n  td {font-size:12px;font-family:\"굴림\",\"돋움\";color:#4A4A4A;line-height:160%} \r\n  table {border-collapse:collapse;}</style>\r\n<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"642\" align=\"center\" height=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\">\r\n<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><img alt=\"\" src=\"{SITE_URL}/admin2/mail/img/top_04.gif\" /></td></tr>\r\n<tr>\r\n<td background=\"{SITE_URL}/admin2/mail/img/bg_line.gif\">\r\n<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"642\">\r\n<tbody>\r\n<tr>\r\n<td style=\"padding-bottom: 10px; padding-left: 30px; padding-right: 30px; padding-top: 10px\">회원님이 요청하신 아이디입니다.<br /><br />아이디 : {MEM_ID}</td>\r\n<td valign=\"bottom\" width=\"190\" align=\"right\"><img alt=\"\" src=\"{SITE_URL}/admin2/mail/img/img_06.gif\" /></td></tr></tbody></table></td></tr>\r\n<tr>\r\n<td><img alt=\"\" src=\"{SITE_URL}/admin2/mail/img/bottom.gif\" /></td></tr></tbody></table></td></tr></tbody></table>','2007-01-04'),('bbs','BBS','게시판 답변메일','','','','','<STYLE>\r\n  td {font-size:12px;font-family:\'굴림\',\'돋움\';color:#4A4A4A;line-height:160%} \r\n  table {border-collapse:collapse;}\r\n</STYLE>\r\n\r\n<TABLE height=\'100%\' cellSpacing=0 cellPadding=0 width=642 align=center border=0>\r\n<TBODY>\r\n<TR>\r\n<TD align=middle>\r\n<TABLE cellSpacing=0 cellPadding=0 border=0>\r\n<TBODY>\r\n<TR>\r\n<TD><IMG src=\'{SITE_URL}/admin2/mail/img/top_01.gif\'></TD></TR>\r\n<TR>\r\n<TD background={SITE_URL}/admin2/mail/img/bg_line.gif>\r\n<TABLE cellSpacing=0 cellPadding=0 width=642 border=0>\r\n<TBODY>\r\n<TR>\r\n<TD style=\'PADDING-RIGHT: 10px; PADDING-LEFT: 10px; PADDING-BOTTOM: 10px; PADDING-TOP: 10px\'>{MESSAGE}</TD></TR></TBODY></TABLE></TD></TR>\r\n<TR>\r\n<TD><IMG src=\'{SITE_URL}/admin2/mail/img/bottom.gif\'> </TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>','2007-01-05'),('mailling','ADD','1월 정기 웹진 - 테스트','','','','','1월 정기 웹진 - 테스트','2007-01-06'),('mem_id','MEM','아이디 찾기','Y','[{SITE_NAME}] 회원님의 아이디는 {MEM_ID} 입니다.','[{SITE_NAME}] -  {MEM_NAME}회원님이 요청하신 정보 입니다.','Y','<STYLE>\r\n  td {font-size:12px;font-family:\'굴림\',\'돋움\';color:#4A4A4A;line-height:160%} \r\n  table {border-collapse:collapse;}\r\n</STYLE>\r\n\r\n<TABLE height=\'100%\' cellSpacing=0 cellPadding=0 width=642 align=center border=0>\r\n<TBODY>\r\n<TR>\r\n<TD align=middle>\r\n<TABLE cellSpacing=0 cellPadding=0 border=0>\r\n<TBODY>\r\n<TR>\r\n<TD><IMG src=\'{SITE_URL}/admin2/mail/img/top_04.gif\'></TD></TR>\r\n<TR>\r\n<TD background={SITE_URL}/admin2/mail/img/bg_line.gif>\r\n<TABLE cellSpacing=0 cellPadding=0 width=642 border=0>\r\n<TBODY>\r\n<TR>\r\n<TD style=\'PADDING-RIGHT: 30px; PADDING-LEFT: 30px; PADDING-BOTTOM: 10px; PADDING-TOP: 10px\'>회원님이 요청하신 아이디입니다.<BR><BR>아이디 : {MEM_ID}</TD>\r\n<TD vAlign=bottom align=right width=190><IMG src=\'{SITE_URL}/admin2/mail/img/img_06.gif\'></TD></TR></TBODY></TABLE></TD></TR>\r\n<TR>\r\n<TD><IMG src=\'{SITE_URL}/admin2/mail/img/bottom.gif\'></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>','2007-01-04'),('mem_pw','MEM','비밀번호 찾기','Y','[{SITE_NAME}] 회원님의 비밀번호는 {MEM_PW} 입니다.','[{SITE_NAME}] -  {MEM_NAME}회원님이 요청하신 정보 입니다.','Y','<STYLE>\r\n  td {font-size:12px;font-family:\'굴림\',\'돋움\';color:#4A4A4A;line-height:160%} \r\n  table {border-collapse:collapse;}\r\n</STYLE>\r\n\r\n<TABLE height=\'100%\' cellSpacing=0 cellPadding=0 width=642 align=center border=0>\r\n<TBODY>\r\n<TR>\r\n<TD align=middle>\r\n<TABLE cellSpacing=0 cellPadding=0 border=0>\r\n<TBODY>\r\n<TR>\r\n<TD><IMG src=\'{SITE_URL}/admin2/mail/img/top_04.gif\'></TD></TR>\r\n<TR>\r\n<TD background={SITE_URL}/admin2/mail/img/bg_line.gif>\r\n<TABLE cellSpacing=0 cellPadding=0 width=642 border=0>\r\n<TBODY>\r\n<TR>\r\n<TD style=\'PADDING-RIGHT: 30px; PADDING-LEFT: 30px; PADDING-BOTTOM: 10px; PADDING-TOP: 10px\'>회원님이 요청하신 비밀번호 입니다.<BR><BR>비밀번호 : {MEM_PW}</TD>\r\n<TD vAlign=bottom align=right width=190><IMG src=\'{SITE_URL}/admin2/mail/img/img_06.gif\'></TD></TR></TBODY></TABLE></TD></TR>\r\n<TR>\r\n<TD><IMG src=\'{SITE_URL}/admin2/mail/img/bottom.gif\'></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>','2007-01-04'),('form','FRM','폼메일 답변메일','','','','','<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"642\" align=\"center\" height=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\">\r\n<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><img alt=\"\" src=\"{SITE_URL}/admin2/mail/img/top_01.gif\" /></td></tr>\r\n<tr>\r\n<td background=\"{SITE_URL}/admin2/mail/img/bg_line.gif\">\r\n<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"642\">\r\n<tbody>\r\n<tr>\r\n<td style=\"padding-bottom: 10px; padding-left: 10px; padding-right: 10px; padding-top: 10px\">{MESSAGE}</td></tr></tbody></table></td></tr>\r\n<tr>\r\n<td><img alt=\"\" src=\"{SITE_URL}/admin2/mail/img/bottom.gif\" /> </td></tr></tbody></table></td></tr></tbody></table>',NULL);
/*!40000 ALTER TABLE `wiz_mailsms` ENABLE KEYS */;

--
-- Table structure for table `wiz_member`
--

DROP TABLE IF EXISTS `wiz_member`;
CREATE TABLE `wiz_member` (
  `idx` int(10) NOT NULL auto_increment,
  `id` varchar(20) NOT NULL default '',
  `passwd` varchar(32) default NULL,
  `name` varchar(100) default NULL,
  `photo` varchar(25) default NULL,
  `icon` varchar(30) default NULL,
  `nick` varchar(100) default NULL,
  `resno` varchar(14) default NULL,
  `email` varchar(50) default NULL,
  `tphone` varchar(14) default NULL,
  `hphone` varchar(14) default NULL,
  `comtel` varchar(14) default NULL,
  `homepage` varchar(255) default NULL,
  `post` varchar(7) default NULL,
  `address1` varchar(255) default NULL,
  `address2` varchar(255) default NULL,
  `reemail` enum('Y','N') default NULL,
  `resms` enum('Y','N') default NULL,
  `birthday` varchar(10) default NULL,
  `bgubun` varchar(4) default NULL,
  `marriage` varchar(4) default NULL,
  `memorial` varchar(10) default NULL,
  `scholarship` varchar(30) default NULL,
  `job` varchar(30) default NULL,
  `income` varchar(30) default NULL,
  `car` varchar(6) default NULL,
  `hobby` varchar(60) default NULL,
  `consph` varchar(80) default NULL,
  `conprd` varchar(80) default NULL,
  `level` varchar(10) default NULL,
  `recom` varchar(20) default NULL,
  `visit` int(5) default NULL,
  `visit_time` datetime default NULL,
  `intro` mediumtext,
  `memo` mediumtext,
  `addinfo1` mediumtext,
  `addinfo2` mediumtext,
  `addinfo3` mediumtext,
  `addinfo4` mediumtext,
  `addinfo5` mediumtext,
  `wdate` datetime default NULL,
  PRIMARY KEY  (`idx`),
  UNIQUE KEY `id` (`id`)
) AUTO_INCREMENT=91;

--
-- Dumping data for table `wiz_member`
--

/*!40000 ALTER TABLE `wiz_member` DISABLE KEYS */;
INSERT INTO `wiz_member` VALUES (48,'test','098f6bcd4621d373cade4e832627b4f6','테스트','test.gif','test_icon.gif','','761001-1000004','test@test.com','00-0000-0000','010-3042-4016','--','','153-023','서울 금천구 가산동','1234번지','','','-0-0','','','-0-0','','','','','',',','','1','',412,'2014-04-01 14:17:10','','','','','','','','2008-07-03 17:38:36'),(68,'test2','ad0234829205b9033196ba818f7a872b','테스트2','',NULL,'','761001-1000005','test2@test.com','00-0000-0000','000-0000-0000','--','','137-130','서울 서초구 양재동','1234번지','','','-0-0','','','-0-0','','','','','',',','','3','',10,'2010-06-21 17:30:52','','','','','','','','2009-02-11 10:27:44');
/*!40000 ALTER TABLE `wiz_member` ENABLE KEYS */;

--
-- Table structure for table `wiz_meminfo`
--

DROP TABLE IF EXISTS `wiz_meminfo`;
CREATE TABLE `wiz_meminfo` (
  `skin` varchar(50) default NULL,
  `agreement` mediumtext,
  `safeinfo` mediumtext,
  `infouse` mediumtext,
  `infoess` mediumtext,
  `join_url` varchar(255) default NULL,
  `login_url` varchar(255) default NULL,
  `idpw_url` varchar(255) default NULL,
  `myinfo_url` varchar(255) default NULL,
  `out_url` varchar(255) default NULL,
  `login_img` varchar(255) default NULL,
  `logout_img` varchar(255) default NULL,
  `join_img` varchar(255) default NULL,
  `myinfo_img` varchar(255) default NULL,
  `job_list` mediumtext,
  `sch_list` mediumtext,
  `income_list` mediumtext,
  `consph_list` mediumtext,
  `addname` mediumtext,
  `method` enum('E','A') default NULL
);

--
-- Dumping data for table `wiz_meminfo`
--

/*!40000 ALTER TABLE `wiz_meminfo` DISABLE KEYS */;
INSERT INTO `wiz_meminfo` VALUES ('memberBasic','제 1조 (목적) \r\n이 약관은 전기통신 사업법 및 동 법 시행령에 의하여 OOO(이하 \"회사\" 라 합니다.)가 제공하는 인터넷 홈페이지 서비스 (이하 \"서비스\" 라 합니다.)의 이용조건 및 절차에 관한 사항, 회사와 이용자의 권리와 의무 및 책임사항을 규정함을 목적으로 합니다.\r\n \r\n제 2조 (약관의 효력과 개정) \r\n1. 이 약관은 전기통신사업법 제 31 조, 동 법 시행규칙 제 21조의 2에 따라 공시절차를 거친 후 홈페이지를 통하여 이를 공지하거나 전자우편 기타의 방법으로 이용자에게 통지함으로써 효력을 발생합니다.\r\n \r\n2. 회사는 본 약관을 사전 고지 없이 개정할 수 있으며, 개정된 약관은 제9조에 정한 방법으로 공지합니다. 회원은 개정된 약관에 동의하지 아니하는 경우 본인의 회원등록을 취소(회원탈퇴)할 수 있으며, 계속 사용의 경우는 약관 개정에 대한 동의로 간주됩니다. 개정된 약관은 공지와 동시에 그 효력이 발생됩니다.\r\n  \r\n제 3조 (약관이외의 준칙) \r\n이 약관에 명시되어 있지 않은 사항은 전기통신 기본법, 전기통신 사업법, 기타 관련법령의 규정에 따릅니다.\r\n \r\n제 4조 (용어의 정의) \r\n이 약관에서 사용하는 용어의 정의는 다음과 같습니다.\r\n \r\n1. 회원 : 서비스에 개인정보를 제공하여 회원등록을 한 자로서, 서비스의 정보를 지속적으로 제공받으며, 이용할 수 있는 자를 말합니다. \r\n2. 이용자 : 본 약관에 따라 회사가 제공하는 서비스를 받는 회원 및 비회원을 말합니다.\r\n3. 아이디 (ID) : 회원 식별과 회원의 서비스 이용을 위하여 회원이 선정하고 회사가 승인하는 문자와 숫자의 조합을 말합니다.  \r\n4. 비밀번호 : 회원이 통신상의 자신의 비밀을 보호하기 위해 선정한 문자와 숫자의 조합을 말합니다.  \r\n5. 전자우편 (E-mail) : 인터넷을 통한 우편입니다.  \r\n6. 해지 : 회사 또는 회원이 서비스 이용 이후 그 이용계약을 종료 시키는 의사표시를 말합니다.  \r\n7. 홈페이지 : 회사가 이용자에게 서비스를 제공하기 위하여 컴퓨터 등 정보통신설비를 이용하여 이용자가 열람 및 이용할 수 있도록 설정한 가상의 서비스 공간을 말합니다.\r\n  \r\n제 5조 (서비스의 제공 및 변경) \r\n1. 회사가 제공하는 서비스는 다음과 같습니다.\r\n \r\n1) 회사에 대한 홍보 내용\r\n2) 회사가 판매하는 제품 안내\r\n3) 기타 회사가 제공하는 각종 정보\r\n4) 고객 상담 서비스\r\n5) 회원 이용 서비스\r\n \r\n2. 회사는 필요한 경우 서비스의 내용을 추가 또는 변경하여 제공할 수 있습니다.\r\n  \r\n제 6조 (서비스의 중단) \r\n1. 회사는 컴퓨터 등 정보통신설비의 보수점검/교체 및 고장, 통신의 두절 등의 사유가 발생한 경우에는 서비스의 제공을 일시적으로 중단할 수 있습니다.\r\n \r\n2. 제 1항에 의한 서비스 중단의 경우에는 제 9조에 정한 방법으로 이용자에게 통지합니다.\r\n \r\n3. 회사는 제1항의 사유로 서비스의 제공이 일시적으로 중단됨으로 인하여 이용자 또는 제3자가 입은 손해에 대하여 배상하지 아니합니다. 단, 회사에 고의 또는 중과실이 있는 경우에는 그러하지 아니합니다.\r\n  \r\n제 7조 (회원가입) \r\n1. 이용자는 회사가 정한 가입양식에 따라 회원정보를 기입한 후 이 약관에 동의한다는 의사표시를 함으로서 회원가입을 신청합니다.\r\n \r\n2. 이용자는 반드시 실명으로 회원가입을 하여야 하며, 1개의 주민등록번호에 대해 1건의 회원가입신청을 할 수 있습니다.\r\n \r\n3. 회사는 제 1항과 같이 회원으로 가입할 것을 신청한 이용자 중 다음 각 호에 해당하지 않는 한 회원으로 등록합니다.\r\n \r\n 1) 이름이 실명이 아닌 경우\r\n \r\n2) 등록 내용에 허위, 기재누락, 오기가 있는 경우\r\n \r\n3) 타인의 명의를 사용하여 신청한 경우\r\n \r\n4) 가입신청자가 이 약관 제 8조 3항에 의하여 이전에 회원자격을 상실한 적이 있는 경우(단, 제 8조 3항에 의한 회원자격 상실 후 3년이 경과한 자로서 회사의 회원 재가입 승낙을 얻은 경우는 예외로 합니다.)\r\n \r\n5) 만 14세 미만의 아동\r\n \r\n6) 기타 회원으로 회사 소정의 이용신청요건을 충족하지 못하는 경우\r\n  \r\n4. 회원가입계약의 성립시기는 회사의 승낙이 이용자에게 도달한 시점으로 합니다.\r\n \r\n5. 회원은 제 10조 1항에 의한 등록사항에 변경이 있는 경우 회원정보변경 항목을 통해 직접 변경사항을 수정, 등록하여야 합니다.\r\n  \r\n제 8조 (회원탈퇴 및 자격 상실 등) \r\n1. 회원은 언제든지 회원의 탈퇴를 홈페이지에 요청할 수 있으며, 홈페이지는 즉시 이에 응합니다.\r\n \r\n2. 회원이 다음 각 호의 사유에 해당하는 경우, 회사는 회원자격을 제한 및 정지시킬 수 있습니다.\r\n \r\n 1) 가입 신청 시에 허위 내용을 등록한 경우\r\n \r\n2) 타인의 서비스 이용을 방해하거나 그 정보를 도용하는 등 서비스 운영질서를 위협하는 경우\r\n \r\n3) 서비스를 이용하여 법령과 이 약관이 금지하거나, 공서양속에 반하는 행위를 하는 경우\r\n \r\n4) 제 13조 에 명기된 회원의 의무사항을 준수하지 못할 경우\r\n  \r\n3. 회사가 회원자격을 제한/정지시킨 후, 동일한 행위가 2회 이상 반복되거나 30일 이내에 그 사유가 시정되지 아니하는 경우 회사는 회원자격을 상실 시킬 수 있습니다.\r\n \r\n4. 회사가 회원자격을 상실 시키는 경우 회원에게 이를 통지하고 탈퇴를 처리합니다. 이 경우 회원에게 이를 통지하고, 탈퇴 전에 소명할 기회를 부여합니다.\r\n \r\n \r\n제 9조 (이용자에 대한 통지) \r\n1. 회사가 이용자에 대한 통지를 하는 경우, 이용자가 서비스에 제출한 전자우편 주소로 할 수 있습니다.\r\n \r\n2. 회사가 불특정 다수 이용자에 대한 통지의 경우 1주일 이상 서비스 게시판에 게시함으로써 개별 통지에 갈음할 수 있습니다.\r\n \r\n \r\n제 10조 (개인 정보 보호) \r\n1. 회사는 이용자 정보 수집 시 회사측이 필요한 최소한의 정보를 수집합니다.\r\n다음 사항을 필수사항으로 하며 그 외 사항은 선택사항으로 합니다.\r\n \r\n1) 성명\r\n2) 주민등록번호\r\n3) 희망 ID\r\n4) 비밀번호\r\n5) E-mail\r\n6) 주소\r\n7) 전화번호\r\n8) favor 구독 여부\r\n \r\n2. 회사가 이용자의 개인식별이 가능한 개인정보를 수집하는 때에는 반드시 당해 이용자의 동의를 받습니다.\r\n \r\n3. 제공된 개인정보는 당해 이용자의 동의 없이 제 3자에게 제공할 수 없으며, 이에 대한 모든 책임은 회사가 집니다. 다만 다음의 경우에는 예외로 합니다.\r\n \r\n 1) 배송업무상 배송업체에게 배송에 필요한 최소한의 이용자의 정보\r\n(성명, 주소, 전화번호)를 알려주는 경우\r\n \r\n2) 통계작성, 학술연구 또는 시장조사를 위하여 필요한 경우로서 특정 개인을 식별할 수 없는 형태로 제공하는 경우\r\n \r\n3) 관계법령에 의하여 국가기관으로부터 요구 받은 경우\r\n \r\n4) 범죄에 대한 수사상의 목적이 있거나, 정보통신 윤리위원회의 요청이 있는 경우\r\n \r\n5) 기타 관계법령에서 정한 절차에 따른 요청이 있는 경우\r\n \r\n \r\n4. 이용자는 언제든지 회사가 가지고 있는 자신의 개인정보에 대해 열람 및 오류정정을 할 수 있습니다.\r\n \r\n5. 회사로부터 개인정보를 제공받은 제 3자는 개인정보를 제공받은 목적을 달성한 때에는 당해 개인정보를 지체 없이 파기합니다.\r\n \r\n \r\n제 11조 (회사의 의무) \r\n1. 회사는 이 약관에서 정한 바에 따라 계속적, 안정적으로 서비스를 제공할 수 있도록 최선의 노력을 다하여야만 합니다.\r\n \r\n2. 회사는 서비스에 관련된 설비를 항상 운용할 수 있는 상태로 유지/보수하고, 장애가 발생하는 경우 지체 없이 이를 수리/복구할 수 있도록 최선의 노력을 다하여야 합니다.\r\n \r\n3. 회사는 이용자가 안전하게 서비스를 이용할 수 있도록 이용자의 개인정보보호를 위한 보안시스템을 갖추어야 합니다.\r\n \r\n4. 회사는 이용자가 원하지 않는 영리목적의 광고성 전자우편을 발송하지 않습니다.\r\n \r\n \r\n제 12조 (회원의 ID 및 비밀번호에 대한 의무) \r\n1. 회원에게 부여된 아이디(ID)와 비밀번호의 관리책임은 회원에게 있으며 관리 소홀, 부정사용에 의하여 발생하는 모든 결과에 대한 책임은 회원에게 있습니다.\r\n \r\n2. 회원이 자신의 ID 및 비밀번호를 도난 당하거나 제 3자가 사용하고 있음을 인지한 경우에는 바로 회사에 통보하고 회사의 안내가 있는 경우에는 그에 따라야 합니다.\r\n \r\n \r\n제 13조 (회원의 의무) \r\n1. 회원은 관계법령, 본 약관의 규정, 이용안내 및 주의사항 등 회사가 통지하는 사항을 준수하여야 하며, 기타 회사의 업무에 방해되는 행위를 하여서는 안됩니다.\r\n \r\n2. 회원은 회사의 사전승낙 없이 서비스를 이용하여 어떠한 영리행위도 할 수 없습니다.\r\n \r\n3. 회원은 서비스를 이용하여 얻은 정보를 회사의 사전승낙 없이 복사, 복제, 변경, 번역, 출판/방송 기타의 방법으로 사용하거나 이를 타인에게 제공할 수 없습니다.\r\n \r\n4. 회원은 자기 신상정보의 변경사항 발생시 즉각 변경하여야 합니다.\r\n회원정보를 수정하지 않아 발생하는 모든 결과에 대한 책임은 회원에게 있습니다.\r\n \r\n5. 회원은 서비스 이용과 관련하여 다음 각 호의 행위를 하지 않아야 하며, 다음 행위를 함으로 발생하는 모든 결과에 대한 책임은 회원에게 있습니다.\r\n \r\n 1) 다른 회원의 아이디(ID)를 부정하게 사용하는 행위\r\n \r\n2) 다른 회원의 E-mail 주소를 취득하여 스팸메일을 발송하는 행위\r\n \r\n3) 범죄행위를 목적으로 하거나 기타 범죄행위와 관련된 행위\r\n \r\n4) 선량한 풍속, 기타 사회질서를 해하는 행위\r\n \r\n5) 회사 및 타인의 명예를 훼손하거나 모욕하는 행위\r\n \r\n6) 회사 및 타인의 지적재산권 등의 권리를 침해하는 행위\r\n \r\n7) 해킹행위 또는 컴퓨터 바이러스의 유포행위\r\n \r\n8) 타인의 의사에 반하여 광고성 정보 등 일정한 내용을 지속적으로 전송하는 행위\r\n \r\n9) 서비스의 안정적인 운영에 지장을 주거나 줄 우려가 있는 일체의 행위\r\n \r\n10) 회사가 제공하는 서비스의 내용을 변경하는 행위\r\n\r\n11) 기타 관계법령에 위배되는 행위\r\n \r\n \r\n \r\n제 14조 (게시물 삭제) \r\n1. 회사는 이용자가 게시하거나 등록하는 서비스내의 게시물이 제 13조의 규정에 위반되거나, 다음 각 호에 해당한다고 판단되는 경우 사전통지 없이 게시물을 삭제할 수 있습니다.\r\n \r\n 1) 다른 이용자 또는 제 3자를 비방하거나 중상모략으로 명예를 손상시키는 내용\r\n \r\n2) 공공질서 또는 미풍양속에 위반되는 내용\r\n \r\n3) 범죄적 행위에 결부된다고 인정되는 내용\r\n \r\n4) 제 3자의 저작권 등 기타 권리를 침해하는 내용\r\n \r\n5) 서비스의 안정적인 운영에 지장을 주거나 줄 우려가 있는 내용\r\n \r\n6) 근거나 확인절차 없이 회사를 비난하거나 유언비어를 유포한 내용용\r\n \r\n7) 기타 관계법령에 의거하여 위반된다고 판단되는 내용\r\n \r\n단, 독자게시판의 경우 다음과 같이 예외를 둔다.\r\n용량이 큰 데이터의 경우 업로드 된 게시물의 수를 제한하며 그 수를 넘을 때에는 서버의 원활한 운영을 위해 가장 오래된 게시물부터 삭제할 수 있다.\r\n \r\n2. 회사는 이용자가 게시하거나 등록하는 서비스내의 게시물이 제 13조의 규정에 위반되거나 동 조 제1항 각 호에 해당한다고 판단되는 정보를 링크하고 있을 경우 사전통지 없이 게시물을 삭제할 수 있습니다.\r\n \r\n \r\n제 15조 (게시물에 대한 권리 / 의무) \r\n게시물에 대한 저작권을 포함한 모든 권리 및 책임은 이를 게시한 이용자에게 있습니다.\r\n \r\n제 16조 (연결 \"홈페이지\"와 피연결 \"홈페이지\"간의 관계) \r\n1. 상위 \"홈페이지\"와 하위 \"홈페이지\"가 하이퍼 링크(예:하이퍼 링크의 대상에는 문자, 그림 및 동화상 등이 포함됨) 방식 등으로 연결된 경우, 전자를 연결 \"홈페이지\"라고 하고 후자를 피연결 \"홈페이지(웹사이트)\"라고 합니다.\r\n \r\n2. 연결 \"홈페이지\"는 피연결 \"홈페이지\"가 독자적으로 제공하는 재화?용역에 의하여 이용자와 행하는 거래에 대해서 보증책임을 지지 않습니다.\r\n \r\n \r\n제 17조 (저작권의 귀속 및 이용제한) \r\n1. 회사가 작성한 저작물에 대한 저작권 및 기타 지적재산권은 회사에 귀속합니다.\r\n \r\n2. 이용자는 서비스를 이용함으로써 얻은 정보를 회사의 사전승낙 없이 복제, 송신, 출판, 배포, 방송, 기타 방법에 의하여 영리목적으로 이용하거나 제 3자에게 이용하게 하여서는 안됩니다.\r\n \r\n \r\n제 18조 (양도금지) \r\n회원이 서비스의 이용권한, 기타 이용 계약상 지위를 타인에게 양도, 증여할 수 없으며, 이를 담보로 제공할 수 없습니다.\r\n \r\n제 19조 (손해배상) \r\n회사는 무료로 제공되는 서비스와 관련하여 이용자에게 어떠한 손해가 발생하더라도 동 손해가 회사의 중대한 과실에 의한 경우를 제외하고 이에 대하여 책임을 부여하지 아니합니다.\r\n \r\n제 20조 (면책 / 배상) \r\n1. 회사는 이용자가 서비스에 게재한 정보, 자료, 사실의 정확성, 신뢰성 등 그 내용에 관하여는 어떠한 책임을 부담하지 아니하고, 이용자는 자신의 책임아래 서비스를 이용하며, 서비스를 이용하여 게시 또는 전송한 자료 등에 관하여 손해가 발생하거나 자료의 취사선택, 기타 서비스 이용과 관련하여 어떠한 불이익이 발생하더라도 이에 대한 모든 책임은 이용자에게 있습니다.\r\n \r\n2. 회사는 제 13조의 규정에 위반하여 이용자간 또는 이용자와 제 3자간에 서비스를 매개로 한 물품거래 등과 관련하여 어떠한 책임도 부담하지 아니하고, 이용자가 서비스의 이용과 관련하여 기대하는 이익에 관하여 책임을 부담하지 않습니다.\r\n \r\n3. 이용자가 제 13조, 기타 이 약관의 규정을 위반함으로 인하여 회사가 이용자 또는 제 3자에 대하여 책임을 부담하게 되고, 이로써 회사에게 손해가 발생하게 되는 경우, 이 약관을 위반한 이용자는 회사에게 발생하는 모든 손해를 배상하여야 하며, 동 손해로부터 회사를 면책시켜야 합니다.\r\n \r\n \r\n제 21조 (분쟁의 해결) \r\n1. 회사와 이용자는 서비스와 관련하여 발생한 분쟁을 원만하게 해결하기 위하여 필요한 모든 노력을 하여야 합니다.\r\n \r\n2. 제 1항의 규정에도 불구하고, 동 분쟁으로 인하여 소송이 제기될 경우 동 소송은 서울지방법원을 관할로 합니다.\r\n \r\n3. 동 소송에는 대한민국 법을 적용합니다.\r\n \r\n \r\n제 22조 (기타) \r\n이 약관에 명시되지 아니한 사항의 처리를 위하여 이용자는 OOO.(전화번호 : 02-xxx-xxxx)를 이용합니다.\r\n \r\n부칙 \r\n이 약관은 OOOO년 O월 O 일부터 시행합니다.','※ 총 칙\r\n1. OOO는 \"정보통신망이용촉진및정보보호등에관한법률\"상의 개인정보보호 규정과 정보통신부가 제정한 \"개인정보보\r\n    호지침\" 및 \"개인정보의 기술적/관리적 보호조치 기준\"을 준수하고 있습니다. 또한 OOO는 \"개인정보보호정책\"을 \r\n    제정하여 회원들의 개인정보 보호를 위해 최선을 다하겠음을 선언합니다.\r\n2. OOO의 \"개인정보보호정책\"은 관련 법률 및 정부 지침의 변경과 OOO의 내부 방침 변경에 의해 변경될 수 있습\r\n    니다. OOO의 \"개인정보보호방침\"이 변경될 경우 변경사항은 OOO 홈페이지의 공지사항에 \r\n    최소 7일간 게시됩니다. \r\n\r\n\r\n※ 개인정보\r\nOOO는 귀하께서 OOO의 이용약관의 내용에 대해 \"동의한다\" 버튼 또는 \"동의하지 않는다\" 버튼을 클릭할 수 있는 절차를 마련하여, \"동의한다\" 버튼을 클릭하면 개인정보 수집에 대해 동의한 것으로 봅니다. 또한, 귀하께서 “동의한다” 버튼을 클릭하면 아래의 개인정보 수집 항목 중 “비밀번호”와 “주민등록번호”를 제외한 나머지 항목들은 OOO가 서비스\r\n를 이행하기 위해 외주업체에 제공하는 것에 대해 동의한 것으로 간주합니다.\r\n\r\n\r\n1. \"개인정보\"의 범위는 정보통신망이용촉진및정보보호등에관한법률에서 규정하는 내용에 따라, \"생존하는 개인에 관한 \r\n    정보로서 당해 정보에 포함되어 있는 성명, 주민등록번호 등의 사항에 의하여 당해 개인을 식별할 수 있는 정보(당해 \r\n    정보만으로는 특정 개인을 식별할 수 없더라도 다른 정보와 용이하게 결합하여 식별할 수 있는 것을 포함한다)\"를 의미\r\n    합니다. \r\n2. OOO는 이용자 확인, 대금결제, 이용 서비스의 소유자 확인, 개별회원에게 맞춤화된 서비스, 기타 부가서비스 등을 \r\n    위하여 회원들의 개인정보를 수집ㆍ이용 합니다. 수집하는 개인정보 항목에 따른 구체적인 수집목적 및 이용 목적은 \r\n    다음과 같습니다.\r\n-  성명, 아이디, 비밀번호, 주민등록번호/사업자등록번호 : 회원제 서비스 이용에 따른 본인 확인 절차에 이용, \r\n-  이용 서비스의 소유자 확인\r\n-  이메일주소, 전화번호, 팩스번호 : 도메인 관리 규정에 따른 필수 정보 확보, 고지사항 전달, 불만처리 등을 위한 원활\r\n    한 의사 소통\r\n-  경로의 확보, 새로운 서비스 및 신상품이나 이벤트 정보 등의 안내\r\n-  은행정보, 신용카드 정보 : 유료정보 이용 및 구매에 대한 결제\r\n-  주소 : 도메인 정보조회 제공, 청구서 및 쇼핑몰 물품 배송에 대한 정확한 배송지 확인\r\n    쿠키 ( 아이디 ) : 쿠키 운영을 통해 방문자들의 아이디를 자동 분석하여 등급별 차등화된 가격 혜택 적용.\r\n    고객께서는 웹브라우저에서 옵션을 설정함으로써 쿠키가 저장될 때마다 확인을 거치거나, 아니면 모든 쿠키의 저장을 \r\n    거부할 수도 있습니다. 그러나 쿠키의 저장을 거부할 경우 웹서비스 이용이 제한될 수 있습니다. \r\n3. OOO은 회원 개인정보를 위탁관리하지 않습니다. \r\n4. 이용자의 기본적 인권 침해의 우려가 있는 민감한 개인정보(인종 및 민족, 사상 및 신조, 출신지 및 본적 지, 정치적 성향 \r\n    및 범죄기록, 건강상태 및 성생활 등)는 요구하지 않습니다. \r\n5. 개인정보의 보유 기간은 \"회원이 OOO에 가입하는 순간부터 해지 신청 순간까지\"입니다. OOO의 회원DB는 탈퇴\r\n    신청자의 개인정보가 탈퇴 즉시 삭제토록 되어 있습니다. \r\n    단, 수집목적 및 제공받은 목적이 달성된 경우에도 법률의 규정에 의하여 보존할 필요성이 있는 경우에는 법률의 \r\n    규정에 따라 고객의 개인정보를 보유할 수 있습니다.\r\n- 계약 또는 청약철회 등에 관한 기록 : 5년\r\n- 대금결제 및 재화등의 공급에 관한 기록 : 5년\r\n- 소비자의 불만 또는 분쟁처리에 관한 기록 : 3년 등\r\n\r\n\r\n\r\n※ 제3자에 대한 정보 제공\r\n1. OOO는 회원들의 개인정보를 무단으로 타인 또는 다른 회사나 기관에 제공하지 않습니다. \r\n    단, 다음에 해당하는 경우는 예외로 합니다. \r\n-  도메인 이름 등록을 위하여 해당 도메인의 등록사업자에게 신청자의 정보를 제공하는 경우\r\n-  도메인 이름에 대한 WHOIS 서비스를 위하여 제공하는 경우 \r\n-  정보통신망이용촉진및정보보호등에관한법률 등 관계법령에 의하여 국가기관 또는 정부에서 지정한 소비자단체들의 \r\n    요청에 의한 경우 \r\n-  분쟁에 연루된 도메인 등록자의 연락처를 분쟁 조정 기구나 법원이 요청하는 경우\r\n-  범죄에 대한 수사상의 목적이 있거나 정보통신윤리위원회, 한국정보보호진흥원 등 법정단체의 요청이 있는 경우 \r\n-  업무상 연락을 위하여 회원의 정보(성명, 주소, 전화번호)를 사용하는 경우 \r\n-  통계작성, 홍보자료, 학술연구 또는 시장조사를 위하여 필요한 경우로서 특정 고객임을 식별할 수 없는 형태로 제공\r\n    되는 경우\r\n-  회원들이 OOO의 서비스를 신청하여 OOO가 서비스 이행을 위해 배송업체, 외주콜센터업체, 지로발송 업체 등\r\n    에 해당 회원의 비밀번호, 주민등록번호를 포함하지 않는 주문정보, 주소지 정보, 연락처 등을 제공하는 경우\r\n\r\n2. OOO는 보다 다양한 서비스 제공을 위하여 회원들의 개인정보를 제휴사에게 제공하거나, 제휴사와 공유하고자 할 때\r\n    는 반드시 사전에 회원 개개인의 동의를 구하겠습니다. 제휴사가 어디인지, 제공 또는 공유되는 개인정보항목이 무엇인\r\n    지, 왜 그러한 개인정보가 공유되어야 하는지, 그리고 언제까지 어떻게 보호, 관리되는지에 대해 개별적으로 전자우편을 \r\n    통해 고지하여 동의를 구하는 절차를 거치게 되며, 귀하께서 동의하지 않는 경우에는 제휴사에게 제공하거나 제휴사와 \r\n    공유하지 않습니다.\r\n\r\n\r\n\r\n※ 개인정보의 열람 및 정정 \r\n1. OOO의 회원은 언제든지 자신의 개인정보를 열람하거나 정정하실 수 있습니다. 개인정보 열람 및 정정을 원하시는\r\n    분은 OOO 사이트에 로그온 하신 후, 로그아웃 버튼 옆의 \"정보변경\" 버튼을 클릭하십시오. \r\n2. 만일 ID와 비밀번호를 잃어버리신 회원은 홈페이지에서 \"ID 확인/비밀번호 확인\"서비스를 통해 ID나 비밀번호를 확인하\r\n    실 수 있습니다.\r\n3. OOO 회원 ID와 비밀번호에 대한 관리 책임은 본인에게 있습니다.\r\n    본인의 개인정보를 효과적으로 보호하기 위해서 자신의 회원ID 와 비밀번호를 적절하게 관리하고 책임을 져야 합니다. \r\n    본인의 ID와 비밀번호를 유출하였다면 이에 대해서 OOO는 책임을 지지않습니다. 다만, OOO의 과실 혹은 고의\r\n    에 의한 회원 ID와 비밀번호 유출에 대해서는 해당 고객이 OOO의 책임을 물을 수 있습니다.\r\n    이용자는 OOO의 계정을 이용해서 웹사이트를 이용한 뒤에는 해당 계정을 종료하시고 웹 브라우저의 창을 닫아주십\r\n    시오. 특히 컴퓨터를 타인과 공유하거나 공공장소에서 사용하는 경우 반드시 로그아웃하시거나 웹 브라우저를 종료하여\r\n    야 합니다.\r\n\r\n\r\n\r\n※ 회원 탈퇴\r\nOOO 회원은 언제든지 본인이 원할 때 탈퇴가 가능합니다. 회원 탈퇴는 회원 정보 관리 화면에서 신청 가능합니다. \r\n단, 회원이 가비아에서 이용 중인 서비스의 만기일이 지나지 않은 경우, 회원 탈퇴는 가능하지 않습니다.\r\n\r\n\r\n\r\n※ 개인정보보호를 위한 기술적 대책\r\nOOO는 회원들의 개인정보가 분실, 도난, 누출, 변조 또는 훼손되지 않도록 다음과 같은 기술적 대책을 마련하고 있습\r\n니다. \r\n1. 회원 개개인의 개인정보는 비밀번호에 의해 보호되며, 개인정보 데이터는 별도의 보안기능을 통해 보호 되고 있습니다. \r\n2. 회원 개개인의 비밀번호는 이용자 및 개인정보취급자가 생일, 주민등록번호, 전화번호 등 추측하기 쉬운 숫자를 비밀\r\n    번호로 이용하지 않도록 패스워드 작성 규칙을 수립하고 이행합니다.\r\n3. OOO는 백신 프로그램 및 악성코드 방어 소프트웨어을 이용하여 컴퓨터 바이러스에 의한 피해를 방지하고 있으며, \r\n    해당 소프트웨어는 매일 주기적으로 업데이트하고 있습니다.\r\n4. OOO는 침입차단 기능과 침입탐지 기능을 탑재하고 있는 고가의 라우터와 L3 스위치 장비를 사용하여 이중으로 \r\n    네트워크 상의 개인정보를 안전하게 보호하고 있습니다.\r\n5. OOO는 또한 별도의 침입차단시스템(Firewall)을 구축하여 3중 개인정보보호시스템을 운영하고 있습니다.\r\n6. OOO는 개인정보를 개인정보보호시스템에 암호화하여 저장하고 있으며, OOO의 정보통신망 외부로 개인정보를 \r\n    송신하거나 PC에 저장할 경우 암호화하여 저장하도록 시스템을 운영하고 있습니다. \r\n\r\n※ 의견수렴 및 불만처리\r\nOOO 회원 중 OOO의 개인정보보호와 관련하여 불만이 있으신 분은 개인정보 관리책임자에게 의견을 주시면, 접수 즉시 조치하여 처리결과를 통보해 드리겠습니다. 개인정보 무단 유출이나 기타 심각한 개인정보 침해 시에는 정부에서 설치하여 운영중인 개인정보침해 신고센터(http://www.cyberpr ivacy.or.kr, http://www.1336.or.kr, 전화 02-1336,)에 불만처리 또는 중재를 신청하실 수도 있습니다.\r\n\r\n\r\n\r\n※ 개인정보관리 계획의 수립 및 시행\r\nOOO는 회사 규정에 별도의 전산관리규정을 마련하여 다음과 같은 사항을 준수하겠습니다.\r\n1. 개인정보관리책임자의 지정 등 개인정보보호 조칙의 구성, 운영에 관한 사항\r\n2. 개인정보취급자의 교육에 관한 사항\r\n3. 개인정보처리시스템의 접속 기록 유지 및 정기적인 확인 감독\r\n4. 개인정보 출력 및 복사시의 보호조치\r\n5. 기타 개인정보 보호를 위해 필요한 사항\r\n\r\n\r\n\r\n※ 개인정보 관리 담당자\r\nOOO는 개인정보에 대한 의견수렴 및 불만처리를 담당하는 개인정보 관리담당자를 지정하고 있습니다. \r\n- 개인정보 관리 담당자\r\n성 명 : OOO\r\n직 책 : OOOO 대표\r\n전화번호 : 02-xxx-xxxx\r\nE-mail : xxxx@xxxx.com\r\n\r\n\r\n\r\n※ 아동의 회원 가입에 대해\r\n1. OOO는 아동의 개인정보를 보호하기 위하여 만 14세 미만의 아동이 회원 가입을 신청할 경우 법정대리인(부모)의 \r\n    동의가 있어야 합니다. 부모님의 허락을 받지않은 14세 미만의 미성년자에 대해서는 OOO가 임의로 회원에서 제외\r\n    할 수 있습니다. \r\n2. 만 14세 미만 미성년자의 법정대리인은 대리인의 책임하에 있는 미성년자의 개인정보에 대한 열람, 정정, 동의철회를 \r\n    요청할 수 있으며, 이러한 요청이 있을 경우 OOO는 지체없이 필요한 조치를 취하겠습니다. \r\n\r\n※ 미성년자 거래시 철회에 대해\r\nOOO는 미성년자와의 거래시 사전에 법정대리인(부모)의 동의를 구할 의무가 있으며, 법정대리인(부모)의 동의를 얻지 못한 거래의 경우, 거래를 취소할 수 있습니다. 또한 거래 당사자인 미성년자의 법정대리인(부모)이 거래 성립 후 7일 이내에 철회를 요청할 경우, 거래를 철회(환불)하겠습니다.\r\n\r\n\r\n\r\n※ 광고성 정보 전송에 대해\r\n1. OOO는 회원을 대상으로 OOO가 제공하고 있는 서비스에 대한 안내, 서비스에 대한 공지 등에 대한 메일을 자유\r\n    롭게 보낼 수 있습니다.\r\n2. OOO는 회원을 대상으로 광고성 정보를 전송할 수 있습니다. 단, 이러한 경우에는 (광고)라는 문구를 표시하여 회원\r\n    들이 광고성 정보임을 쉽게 파악할 수 있게 하며, 수신거부 의사를 밝힌 회원에게는 광고성 정보를 전송하지 않겠습니다.','email/resno/address/tphone/hphone/reemail/resms/icon/nick/','email/resno/address/tphone/hphone/reemail/resms/','','','','','','','','','','무직,학생,컴퓨터/인터넷,언론,공무원,군인,서비스업,교육,금융/증권/보험업,유통업,예술','없음,초등학교재학,초등학교졸업,중학교재학,중학교졸업,고등학교재학,고등학교졸업,대학교재학,대학교졸업','100만원이하,101-200만원,201-250만원,251-300만원,301-400만원,400만원 이상','건강,문화/예술,경제,연예/오락,뉴스,여행/레저,생활,스포츠,교육,컴퓨터,학문','1|2|3|4|5|','E');
/*!40000 ALTER TABLE `wiz_meminfo` ENABLE KEYS */;

--
-- Table structure for table `wiz_message`
--

DROP TABLE IF EXISTS `wiz_message`;
CREATE TABLE `wiz_message` (
  `idx` int(10) unsigned NOT NULL auto_increment,
  `se_id` varchar(20) default NULL,
  `se_name` varchar(100) default NULL,
  `re_id` varchar(20) default NULL,
  `re_name` varchar(100) default NULL,
  `subject` varchar(100) default NULL,
  `content` mediumtext,
  `upfile` varchar(40) default NULL,
  `upfile_name` varchar(255) default NULL,
  `addinfo1` varchar(255) default NULL,
  `addinfo2` varchar(255) default NULL,
  `addinfo3` varchar(255) default NULL,
  `wdate` datetime default NULL,
  `status` enum('Y','N') NOT NULL default 'N',
  `re_status` enum('Y','N') NOT NULL default 'Y',
  `se_status` enum('Y','N') NOT NULL default 'Y',
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=60;

--
-- Dumping data for table `wiz_message`
--

/*!40000 ALTER TABLE `wiz_message` DISABLE KEYS */;
INSERT INTO `wiz_message` VALUES (39,'test','test','test2','테스트2','테스트쪽지','테스트쪽지','0812230730027.gif','logo.gif','','','','2008-12-23 19:30:02','Y','Y','N'),(54,'test','테스트','test2','테스트2','test','test','','','','','','2009-09-09 10:49:00','Y','Y','Y'),(58,'test2','테스트2','test','테스트','쪽지 답글 테스트','쪽지 답글 테스트','','','','','','2010-06-21 17:31:03','Y','Y','Y'),(59,'test2','테스트2','test','테스트','첨부이미지 테스트','첨부이미지 테스트','1006210532254.jpg','0902250154496_1.jpg','','','','2010-06-21 17:32:25','Y','Y','Y');
/*!40000 ALTER TABLE `wiz_message` ENABLE KEYS */;

--
-- Table structure for table `wiz_mini_bbs`
--

DROP TABLE IF EXISTS `wiz_mini_bbs`;
CREATE TABLE `wiz_mini_bbs` (
  `idx` int(10) NOT NULL auto_increment,
  `code` varchar(30) default NULL,
  `prino` int(10) default NULL,
  `grpno` int(10) default NULL,
  `depno` int(2) default NULL,
  `notice` char(1) default NULL,
  `category` varchar(80) default NULL,
  `memid` varchar(20) default NULL,
  `memgrp` varchar(255) default NULL,
  `name` varchar(100) default NULL,
  `email` varchar(50) default NULL,
  `tphone` varchar(20) default NULL,
  `hphone` varchar(20) default NULL,
  `zipcode` varchar(20) default NULL,
  `address` varchar(20) default NULL,
  `subject` varchar(100) default NULL,
  `content` mediumtext,
  `addinfo1` varchar(255) default NULL,
  `addinfo2` varchar(255) default NULL,
  `addinfo3` varchar(255) default NULL,
  `addinfo4` varchar(255) default NULL,
  `addinfo5` varchar(255) default NULL,
  `ctype` enum('T','H') default NULL,
  `privacy` enum('Y','N') default NULL,
  `upfile1` varchar(40) default NULL,
  `upfile2` varchar(40) default NULL,
  `upfile3` varchar(40) default NULL,
  `upfile4` varchar(40) default NULL,
  `upfile5` varchar(40) default NULL,
  `upfile6` varchar(40) default NULL,
  `upfile7` varchar(40) default NULL,
  `upfile8` varchar(40) default NULL,
  `upfile9` varchar(40) default NULL,
  `upfile10` varchar(40) default NULL,
  `upfile11` varchar(40) default NULL,
  `upfile12` varchar(40) default NULL,
  `upfile1_name` varchar(255) default NULL,
  `upfile2_name` varchar(255) default NULL,
  `upfile3_name` varchar(255) default NULL,
  `upfile4_name` varchar(255) default NULL,
  `upfile5_name` varchar(255) default NULL,
  `upfile6_name` varchar(255) default NULL,
  `upfile7_name` varchar(255) default NULL,
  `upfile8_name` varchar(255) default NULL,
  `upfile9_name` varchar(255) default NULL,
  `upfile10_name` varchar(255) default NULL,
  `upfile11_name` varchar(255) default NULL,
  `upfile12_name` varchar(255) default NULL,
  `movie1` mediumtext,
  `movie2` mediumtext,
  `movie3` mediumtext,
  `passwd` varchar(30) default NULL,
  `count` int(8) default NULL,
  `recom` int(8) default NULL,
  `comment` int(8) default NULL,
  `ip` varchar(15) default NULL,
  `wdate` int(10) default NULL,
  `ucc_file` varchar(255) default NULL,
  `ucc_movie` varchar(255) default NULL,
  `ucc_img` varchar(255) default NULL,
  `ucc_size` int(11) default NULL,
  `ucc_time` varchar(10) default NULL,
  `miniid` varchar(20) default NULL,
  PRIMARY KEY  (`idx`),
  KEY `code` (`code`)
) AUTO_INCREMENT=100;

--
-- Dumping data for table `wiz_mini_bbs`
--

/*!40000 ALTER TABLE `wiz_mini_bbs` DISABLE KEYS */;
INSERT INTO `wiz_mini_bbs` VALUES (74,'bbs',1,1,0,'','1','test','test','테스트','help@abc.com','','','','','게시판 테스트','게시판 테스트','','','','','','H','Y','','','','','','','','','','','','','','','','','','','','','','','','','','','','test',187,0,0,'121.134.141.93',1234749004,'','','',0,'','test');
/*!40000 ALTER TABLE `wiz_mini_bbs` ENABLE KEYS */;

--
-- Table structure for table `wiz_mini_bbscat`
--

DROP TABLE IF EXISTS `wiz_mini_bbscat`;
CREATE TABLE `wiz_mini_bbscat` (
  `idx` int(10) unsigned NOT NULL auto_increment,
  `gubun` char(1) default NULL,
  `code` varchar(30) default NULL,
  `catname` varchar(30) default NULL,
  `catimg` varchar(30) default NULL,
  `catimg_over` varchar(30) default NULL,
  `caticon` varchar(30) default NULL,
  `miniid` varchar(20) default NULL,
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=15;

--
-- Dumping data for table `wiz_mini_bbscat`
--

/*!40000 ALTER TABLE `wiz_mini_bbscat` DISABLE KEYS */;
INSERT INTO `wiz_mini_bbscat` VALUES (1,'','bbs','게시판 1',NULL,NULL,NULL,'test'),(3,'','bbs','게시판 2',NULL,NULL,NULL,'test'),(4,'','data','자료실 1',NULL,NULL,NULL,'test'),(5,'','data','자료실 2',NULL,NULL,NULL,'test'),(13,'','photo','갤러리 3',NULL,NULL,NULL,'test'),(12,'','photo','갤러리 2',NULL,NULL,NULL,'test'),(11,'','photo','갤러리 1',NULL,NULL,NULL,'test'),(9,'','movie','동영상 1',NULL,NULL,NULL,'test'),(10,'','movie','동영상 2',NULL,NULL,NULL,'test');
/*!40000 ALTER TABLE `wiz_mini_bbscat` ENABLE KEYS */;

--
-- Table structure for table `wiz_mini_comment`
--

DROP TABLE IF EXISTS `wiz_mini_comment`;
CREATE TABLE `wiz_mini_comment` (
  `idx` int(10) NOT NULL auto_increment,
  `ctype` varchar(10) default NULL,
  `code` varchar(10) default NULL,
  `cidx` int(10) default NULL,
  `star` int(1) default NULL,
  `memid` varchar(20) default NULL,
  `name` varchar(100) default NULL,
  `content` mediumtext,
  `passwd` varchar(20) default NULL,
  `wdate` datetime default NULL,
  `ip` varchar(20) default NULL,
  `miniid` varchar(20) default NULL,
  PRIMARY KEY  (`idx`),
  KEY `cidx` (`cidx`)
) AUTO_INCREMENT=125;

--
-- Dumping data for table `wiz_mini_comment`
--

/*!40000 ALTER TABLE `wiz_mini_comment` DISABLE KEYS */;
INSERT INTO `wiz_mini_comment` VALUES (72,'MINI',NULL,0,0,'test','테스트','아름다운입술을 갖고싶으면 친절한말을하라','','2009-02-13 16:57:04','121.134.141.93','test'),(112,'BBS','data',1,0,'test','테스트','qqq','test','2009-02-23 15:43:16','121.134.141.93','test'),(110,'BBS','guest',1,0,'test','테스트','123','test','2009-02-23 15:42:37','121.134.141.93','test'),(113,'BBS','data',1,0,'test','테스트','www','test','2009-02-23 15:43:17','121.134.141.93','test');
/*!40000 ALTER TABLE `wiz_mini_comment` ENABLE KEYS */;

--
-- Table structure for table `wiz_mini_conrefer`
--

DROP TABLE IF EXISTS `wiz_mini_conrefer`;
CREATE TABLE `wiz_mini_conrefer` (
  `referer` mediumtext,
  `host` varchar(30) default NULL,
  `wdate` date default NULL,
  `cnt` int(10) default NULL,
  `miniid` varchar(20) default NULL,
  KEY `host` (`host`),
  KEY `wdate` (`wdate`)
);

--
-- Dumping data for table `wiz_mini_conrefer`
--

/*!40000 ALTER TABLE `wiz_mini_conrefer` DISABLE KEYS */;
INSERT INTO `wiz_mini_conrefer` VALUES ('','','2009-02-09',4,'test'),('','','2009-02-25',2,'test2'),('','','2009-02-10',5,'test'),('','','2009-02-11',15,'test'),('','','2009-02-11',11,'test2'),('','','2009-02-12',14,'test'),('','','2009-02-12',5,'test2'),('','','2009-02-13',12,'test'),('','','2009-02-13',4,'test2'),('','','2009-02-14',1,'test'),('','','2009-02-16',5,'test'),('','','2009-02-16',4,'test2'),('','','2009-02-17',9,'test'),('','','2009-02-25',3,'test'),('','','2009-02-17',2,'test2'),('','','2009-02-18',4,'test'),('','','2009-02-18',2,'test2'),('','','2009-02-20',5,'test'),('','','2009-02-20',3,'test2'),('','','2009-02-23',12,'test'),('','','2009-02-23',2,'test2'),('','','2009-02-23',1,'wizhome'),('','','2009-02-24',2,'test'),('','','2009-03-03',3,'test'),('','','2009-03-05',4,'test'),('','','2009-03-06',5,'test'),('','','2009-03-07',1,'test'),('','','2009-03-16',2,'test'),('','','2009-03-17',8,'test'),('','','2009-03-17',1,'test2'),('','','2009-03-18',4,'test'),('','','2009-03-19',1,'test'),('','','2009-03-19',1,'test2'),('','','2009-03-20',1,'test'),('','','2009-03-23',1,'test'),('','','2009-03-31',1,'test'),('','','2010-12-07',1,'test'),('','','2011-08-25',1,'test'),('','','2010-12-15',1,'test'),('','','2011-06-15',1,'test'),('','','2011-08-26',1,'test'),('','','2011-08-30',1,'test'),('','','2011-09-08',1,'test');
/*!40000 ALTER TABLE `wiz_mini_conrefer` ENABLE KEYS */;

--
-- Table structure for table `wiz_mini_contime`
--

DROP TABLE IF EXISTS `wiz_mini_contime`;
CREATE TABLE `wiz_mini_contime` (
  `time` int(10) default NULL,
  `cnt` int(10) default NULL,
  `miniid` varchar(20) default NULL
);

--
-- Dumping data for table `wiz_mini_contime`
--

/*!40000 ALTER TABLE `wiz_mini_contime` DISABLE KEYS */;
INSERT INTO `wiz_mini_contime` VALUES (2009020915,2,'test'),(2009020918,1,'test'),(2009021114,1,'test'),(2009020919,1,'test'),(2009021011,1,'test'),(2009021012,1,'test'),(2009021014,1,'test'),(2009021017,2,'test'),(2009021109,1,'test'),(2009021110,3,'test'),(2009021111,1,'test'),(2009021113,1,'test'),(2009021115,2,'test2'),(2009021115,2,'test'),(2009021116,2,'test2'),(2009021116,1,'test'),(2009021117,2,'test'),(2009021117,2,'test2'),(2009021118,2,'test'),(2009021118,4,'test2'),(2009021123,1,'test'),(2009021123,1,'test2'),(2009021210,2,'test'),(2009021210,1,'test2'),(2009021211,4,'test'),(2009021212,1,'test'),(2009021213,1,'test'),(2009021214,2,'test'),(2009021214,1,'test2'),(2009021215,1,'test'),(2009021216,1,'test'),(2009021217,1,'test2'),(2009021218,1,'test'),(2009021218,1,'test2'),(2009021219,1,'test'),(2009021219,1,'test2'),(2009021310,4,'test'),(2009021310,1,'test2'),(2009021311,1,'test'),(2009021311,1,'test2'),(2009021313,1,'test'),(2009021315,1,'test2'),(2009021315,1,'test'),(2009021316,2,'test'),(2009021316,1,'test2'),(2009021317,2,'test'),(2009021323,1,'test'),(2009021422,1,'test'),(2009021610,1,'test'),(2009021611,1,'test'),(2009021612,1,'test2'),(2009021612,1,'test'),(2009021613,1,'test'),(2009021614,2,'test2'),(2009021614,1,'test'),(2009021616,1,'test2'),(2009021710,2,'test'),(2009022510,2,'test'),(2009021713,2,'test'),(2009021713,1,'test2'),(2009021714,3,'test'),(2009021715,1,'test'),(2009021721,1,'test'),(2009021722,1,'test2'),(2009021811,1,'test'),(2009021814,1,'test'),(2009021815,1,'test'),(2009021815,1,'test2'),(2009021818,1,'test'),(2009021818,1,'test2'),(2009022010,2,'test'),(2009022014,1,'test'),(2009022015,1,'test'),(2009022015,1,'test2'),(2009022016,1,'test2'),(2009022018,1,'test'),(2009022018,1,'test2'),(2009022309,1,'test'),(2009022311,1,'test'),(2009022313,6,'test'),(2009022313,1,'test2'),(2009022314,1,'test'),(2009022317,1,'test'),(2009022318,1,'wizhome'),(2009022319,1,'test'),(2009022319,1,'test2'),(2009022323,1,'test'),(2009022418,1,'test'),(2009022419,1,'test'),(2009022513,1,'test2'),(2009022514,1,'test2'),(2009022514,1,'test'),(2009030310,1,'test'),(2009030313,2,'test'),(2009030517,3,'test'),(2009030519,1,'test'),(2009030615,3,'test'),(2009030616,2,'test'),(2009030711,1,'test'),(2009031620,2,'test'),(2009031700,1,'test'),(2009031711,1,'test'),(2009031712,1,'test'),(2009031714,1,'test'),(2009031715,1,'test2'),(2009031715,1,'test'),(2009031716,1,'test'),(2009031718,1,'test'),(2009031721,1,'test'),(2009031801,1,'test'),(2009031816,1,'test'),(2009031819,1,'test'),(2009031822,1,'test'),(2009031916,1,'test'),(2009031916,1,'test2'),(2009032022,1,'test'),(2009032322,1,'test'),(2009033114,1,'test'),(2010120718,1,'test'),(2011082517,1,'test'),(2010121510,1,'test'),(2011061504,1,'test'),(2011082615,1,'test'),(2011083009,1,'test'),(2011090820,1,'test');
/*!40000 ALTER TABLE `wiz_mini_contime` ENABLE KEYS */;

--
-- Table structure for table `wiz_mini_data`
--

DROP TABLE IF EXISTS `wiz_mini_data`;
CREATE TABLE `wiz_mini_data` (
  `idx` int(10) NOT NULL auto_increment,
  `code` varchar(30) default NULL,
  `prino` int(10) default NULL,
  `grpno` int(10) default NULL,
  `depno` int(2) default NULL,
  `notice` char(1) default NULL,
  `category` varchar(80) default NULL,
  `memid` varchar(20) default NULL,
  `memgrp` varchar(255) default NULL,
  `name` varchar(100) default NULL,
  `email` varchar(50) default NULL,
  `tphone` varchar(20) default NULL,
  `hphone` varchar(20) default NULL,
  `zipcode` varchar(20) default NULL,
  `address` varchar(20) default NULL,
  `subject` varchar(100) default NULL,
  `content` mediumtext,
  `addinfo1` varchar(255) default NULL,
  `addinfo2` varchar(255) default NULL,
  `addinfo3` varchar(255) default NULL,
  `addinfo4` varchar(255) default NULL,
  `addinfo5` varchar(255) default NULL,
  `ctype` enum('T','H') default NULL,
  `privacy` enum('Y','N') default NULL,
  `upfile1` varchar(40) default NULL,
  `upfile2` varchar(40) default NULL,
  `upfile3` varchar(40) default NULL,
  `upfile4` varchar(40) default NULL,
  `upfile5` varchar(40) default NULL,
  `upfile6` varchar(40) default NULL,
  `upfile7` varchar(40) default NULL,
  `upfile8` varchar(40) default NULL,
  `upfile9` varchar(40) default NULL,
  `upfile10` varchar(40) default NULL,
  `upfile11` varchar(40) default NULL,
  `upfile12` varchar(40) default NULL,
  `upfile1_name` varchar(255) default NULL,
  `upfile2_name` varchar(255) default NULL,
  `upfile3_name` varchar(255) default NULL,
  `upfile4_name` varchar(255) default NULL,
  `upfile5_name` varchar(255) default NULL,
  `upfile6_name` varchar(255) default NULL,
  `upfile7_name` varchar(255) default NULL,
  `upfile8_name` varchar(255) default NULL,
  `upfile9_name` varchar(255) default NULL,
  `upfile10_name` varchar(255) default NULL,
  `upfile11_name` varchar(255) default NULL,
  `upfile12_name` varchar(255) default NULL,
  `movie1` mediumtext,
  `movie2` mediumtext,
  `movie3` mediumtext,
  `passwd` varchar(30) default NULL,
  `count` int(8) default NULL,
  `recom` int(8) default NULL,
  `comment` int(8) default NULL,
  `ip` varchar(15) default NULL,
  `wdate` int(10) default NULL,
  `ucc_file` varchar(255) default NULL,
  `ucc_movie` varchar(255) default NULL,
  `ucc_img` varchar(255) default NULL,
  `ucc_size` int(11) default NULL,
  `ucc_time` varchar(10) default NULL,
  `miniid` varchar(20) default NULL,
  PRIMARY KEY  (`idx`),
  KEY `code` (`code`)
) AUTO_INCREMENT=4;

--
-- Dumping data for table `wiz_mini_data`
--

/*!40000 ALTER TABLE `wiz_mini_data` DISABLE KEYS */;
INSERT INTO `wiz_mini_data` VALUES (1,'data',1,1,0,'','4','test','test','테스트','help@abc.com','','','','','111','111 ','','','','','','H','','0902250154379_1.jpg','','','','','','','','','','','','pic_314x263.jpg','','','','','','','','','','','','','','','test',19,0,3,'121.134.141.93',1235370144,'','','',0,'','test');
/*!40000 ALTER TABLE `wiz_mini_data` ENABLE KEYS */;

--
-- Table structure for table `wiz_mini_friend`
--

DROP TABLE IF EXISTS `wiz_mini_friend`;
CREATE TABLE `wiz_mini_friend` (
  `idx` int(11) NOT NULL auto_increment,
  `myid` varchar(20) default NULL,
  `mynick` varchar(100) default NULL,
  `frdid` varchar(20) default NULL,
  `frdnick` varchar(100) default NULL,
  `message` mediumtext,
  `status` enum('Y','N') default NULL,
  `wdate` datetime default NULL,
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=9;

--
-- Dumping data for table `wiz_mini_friend`
--

/*!40000 ALTER TABLE `wiz_mini_friend` DISABLE KEYS */;
INSERT INTO `wiz_mini_friend` VALUES (8,'test2','22','test','11','33','Y','2009-02-11 18:48:44');
/*!40000 ALTER TABLE `wiz_mini_friend` ENABLE KEYS */;

--
-- Table structure for table `wiz_mini_guest`
--

DROP TABLE IF EXISTS `wiz_mini_guest`;
CREATE TABLE `wiz_mini_guest` (
  `idx` int(10) NOT NULL auto_increment,
  `code` varchar(30) default NULL,
  `prino` int(10) default NULL,
  `grpno` int(10) default NULL,
  `depno` int(2) default NULL,
  `notice` char(1) default NULL,
  `category` varchar(80) default NULL,
  `memid` varchar(20) default NULL,
  `memgrp` varchar(255) default NULL,
  `name` varchar(100) default NULL,
  `email` varchar(50) default NULL,
  `tphone` varchar(20) default NULL,
  `hphone` varchar(20) default NULL,
  `zipcode` varchar(20) default NULL,
  `address` varchar(20) default NULL,
  `subject` varchar(100) default NULL,
  `content` mediumtext,
  `addinfo1` varchar(255) default NULL,
  `addinfo2` varchar(255) default NULL,
  `addinfo3` varchar(255) default NULL,
  `addinfo4` varchar(255) default NULL,
  `addinfo5` varchar(255) default NULL,
  `ctype` enum('T','H') default NULL,
  `privacy` enum('Y','N') default NULL,
  `upfile1` varchar(40) default NULL,
  `upfile2` varchar(40) default NULL,
  `upfile3` varchar(40) default NULL,
  `upfile4` varchar(40) default NULL,
  `upfile5` varchar(40) default NULL,
  `upfile6` varchar(40) default NULL,
  `upfile7` varchar(40) default NULL,
  `upfile8` varchar(40) default NULL,
  `upfile9` varchar(40) default NULL,
  `upfile10` varchar(40) default NULL,
  `upfile11` varchar(40) default NULL,
  `upfile12` varchar(40) default NULL,
  `upfile1_name` varchar(255) default NULL,
  `upfile2_name` varchar(255) default NULL,
  `upfile3_name` varchar(255) default NULL,
  `upfile4_name` varchar(255) default NULL,
  `upfile5_name` varchar(255) default NULL,
  `upfile6_name` varchar(255) default NULL,
  `upfile7_name` varchar(255) default NULL,
  `upfile8_name` varchar(255) default NULL,
  `upfile9_name` varchar(255) default NULL,
  `upfile10_name` varchar(255) default NULL,
  `upfile11_name` varchar(255) default NULL,
  `upfile12_name` varchar(255) default NULL,
  `movie1` mediumtext,
  `movie2` mediumtext,
  `movie3` mediumtext,
  `passwd` varchar(30) default NULL,
  `count` int(8) default NULL,
  `recom` int(8) default NULL,
  `comment` int(8) default NULL,
  `ip` varchar(15) default NULL,
  `wdate` int(10) default NULL,
  `ucc_file` varchar(255) default NULL,
  `ucc_movie` varchar(255) default NULL,
  `ucc_img` varchar(255) default NULL,
  `ucc_size` int(11) default NULL,
  `ucc_time` varchar(10) default NULL,
  `miniid` varchar(20) default NULL,
  PRIMARY KEY  (`idx`),
  KEY `code` (`code`)
) AUTO_INCREMENT=4;

--
-- Dumping data for table `wiz_mini_guest`
--

/*!40000 ALTER TABLE `wiz_mini_guest` DISABLE KEYS */;
INSERT INTO `wiz_mini_guest` VALUES (1,'guest',1,1,0,'','','test','test','test','help@abc.com','','','','','qqqq\r\n','qqqq\r\n','','','','','','H','','','','','','','','','','','','','','','','','','','','','','','','','','','','','test',1,0,1,'121.134.141.93',1235371178,'','','',0,'','test'),(2,'guest',2,2,0,'','','test','test','test','help@abc.com','','','','','eeee','eeee','','','','','','H','','','','','','','','','','','','','','','','','','','','','','','','','','','','','test',0,0,0,'121.134.141.93',1235371184,'','','',0,'','test'),(3,'guest',3,3,0,'','','test','test','test','help@abc.com','','','','','wwww','wwww','','','','','','H','','','','','','','','','','','','','','','','','','','','','','','','','','','','','test',0,0,0,'121.134.141.93',1235371189,'','','',0,'','test');
/*!40000 ALTER TABLE `wiz_mini_guest` ENABLE KEYS */;

--
-- Table structure for table `wiz_mini_info`
--

DROP TABLE IF EXISTS `wiz_mini_info`;
CREATE TABLE `wiz_mini_info` (
  `idx` int(11) NOT NULL auto_increment,
  `memid` varchar(20) default NULL,
  `title` varchar(50) default NULL,
  `photo` varchar(50) default NULL,
  `miniurl` varchar(50) default NULL,
  `skin` varchar(50) default NULL,
  `searchkey` mediumtext,
  `info` mediumtext,
  `best` enum('Y','N') default NULL,
  `privacy` enum('Y','N') default NULL,
  `birthday_privacy` enum('Y','N','F') default NULL,
  `email_pricacy` enum('Y','N','F') default NULL,
  `tphone_privacy` enum('Y','N','F') default NULL,
  `hphone_privacy` enum('Y','N','F') default NULL,
  `address_privacy` enum('Y','N','F') default NULL,
  `menu_use` varchar(255) default NULL,
  `bbs_permi` enum('Y','N','F') default NULL,
  `data_permi` enum('Y','N','F') default NULL,
  `photo_permi` enum('Y','N','F') default NULL,
  `movie_permi` enum('Y','N','F') default NULL,
  `guest_permi` enum('Y','N','F') default NULL,
  `wdate` datetime default NULL,
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=9;

--
-- Dumping data for table `wiz_mini_info`
--

/*!40000 ALTER TABLE `wiz_mini_info` DISABLE KEYS */;
INSERT INTO `wiz_mini_info` VALUES (1,'test','테스트 홈페이지','test.jpg','test','0902090211087.jpg','1112','아름다운입술을\r\n갖고싶으면친절한말을하라\r\n\r\n\r\n사랑스런눈을갖고\r\n싶으면너의음식을\r\n배고픈사람과나눠라','','Y','F','N','N','N','N','PRO/BBS/DATA/PHOTO/MOVIE/VISIT/','F','F','F','F','Y','2009-02-05 19:36:09'),(2,'test2','test2님의 미니홈피','','test2','','','','','Y','N','N','N','N','N','PRO/BBS/DATA/PHOTO/MOVIE/VISIT/','Y','Y','Y','Y','Y','2009-02-12 19:06:25');
/*!40000 ALTER TABLE `wiz_mini_info` ENABLE KEYS */;

--
-- Table structure for table `wiz_mini_movie`
--

DROP TABLE IF EXISTS `wiz_mini_movie`;
CREATE TABLE `wiz_mini_movie` (
  `idx` int(10) NOT NULL auto_increment,
  `code` varchar(30) default NULL,
  `prino` int(10) default NULL,
  `grpno` int(10) default NULL,
  `depno` int(2) default NULL,
  `notice` char(1) default NULL,
  `category` varchar(80) default NULL,
  `memid` varchar(20) default NULL,
  `memgrp` varchar(255) default NULL,
  `name` varchar(20) default NULL,
  `email` varchar(50) default NULL,
  `tphone` varchar(20) default NULL,
  `hphone` varchar(20) default NULL,
  `zipcode` varchar(20) default NULL,
  `address` varchar(20) default NULL,
  `subject` varchar(100) default NULL,
  `content` mediumtext,
  `addinfo1` varchar(255) default NULL,
  `addinfo2` varchar(255) default NULL,
  `addinfo3` varchar(255) default NULL,
  `addinfo4` varchar(255) default NULL,
  `addinfo5` varchar(255) default NULL,
  `ctype` enum('T','H') default NULL,
  `privacy` enum('Y','N') default NULL,
  `upfile1` varchar(40) default NULL,
  `upfile2` varchar(40) default NULL,
  `upfile3` varchar(40) default NULL,
  `upfile4` varchar(40) default NULL,
  `upfile5` varchar(40) default NULL,
  `upfile6` varchar(40) default NULL,
  `upfile7` varchar(40) default NULL,
  `upfile8` varchar(40) default NULL,
  `upfile9` varchar(40) default NULL,
  `upfile10` varchar(40) default NULL,
  `upfile11` varchar(40) default NULL,
  `upfile12` varchar(40) default NULL,
  `upfile1_name` varchar(255) default NULL,
  `upfile2_name` varchar(255) default NULL,
  `upfile3_name` varchar(255) default NULL,
  `upfile4_name` varchar(255) default NULL,
  `upfile5_name` varchar(255) default NULL,
  `upfile6_name` varchar(255) default NULL,
  `upfile7_name` varchar(255) default NULL,
  `upfile8_name` varchar(255) default NULL,
  `upfile9_name` varchar(255) default NULL,
  `upfile10_name` varchar(255) default NULL,
  `upfile11_name` varchar(255) default NULL,
  `upfile12_name` varchar(255) default NULL,
  `movie1` mediumtext,
  `movie2` mediumtext,
  `movie3` mediumtext,
  `passwd` varchar(30) default NULL,
  `count` int(8) default NULL,
  `recom` int(8) default NULL,
  `comment` int(8) default NULL,
  `ip` varchar(15) default NULL,
  `wdate` int(10) default NULL,
  `ucc_file` varchar(255) default NULL,
  `ucc_movie` varchar(255) default NULL,
  `ucc_img` varchar(255) default NULL,
  `ucc_size` int(11) default NULL,
  `ucc_time` varchar(10) default NULL,
  `miniid` varchar(20) default NULL,
  PRIMARY KEY  (`idx`),
  KEY `code` (`code`)
) AUTO_INCREMENT=3;

--
-- Dumping data for table `wiz_mini_movie`
--

/*!40000 ALTER TABLE `wiz_mini_movie` DISABLE KEYS */;
INSERT INTO `wiz_mini_movie` VALUES (1,'movie',1,1,0,'','9','test','test','테스트','help@abc.com','','','','','test','test','','','','','','H','','','','','','','','','','','','','','','','','','','','','','','','','','','','','test',8,0,0,'121.134.141.93',1235370763,'0809040917045_m1.wmv','200922513587_162439373052.flv','200922513587_162439373052.jpg',15421674,'00:01:02','test'),(2,'movie',2,2,0,'','9','test','test','테스트','help@abc.com','','','','','44','44','','','','','','H','','','','','','','','','','','','','','','','','','','','','','','','','','','','','test',11,0,0,'121.134.141.93',1235379159,'0809040917045_m1.wmv','200922513592_162982033232.flv','200922513592_162982033232.jpg',15421674,'00:01:02','test');
/*!40000 ALTER TABLE `wiz_mini_movie` ENABLE KEYS */;

--
-- Table structure for table `wiz_mini_music`
--

DROP TABLE IF EXISTS `wiz_mini_music`;
CREATE TABLE `wiz_mini_music` (
  `idx` int(11) NOT NULL auto_increment,
  `miniid` varchar(20) default NULL,
  `title` varchar(255) default NULL,
  `artist` varchar(255) default NULL,
  `upfile` varchar(50) default NULL,
  `words` mediumtext,
  `wdate` datetime default NULL,
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=12;

--
-- Dumping data for table `wiz_mini_music`
--

/*!40000 ALTER TABLE `wiz_mini_music` DISABLE KEYS */;
INSERT INTO `wiz_mini_music` VALUES (2,'test','알수없는인생','이문세','0903310256182.mp3','','2009-02-10 17:37:18'),(3,'test','날아라병아리','신해철','0902131038116.mp3','가사 13131313','2009-02-10 17:40:38'),(4,'test','물고기자리','이안','0902110713144.mp3','','2009-02-11 19:13:14'),(5,'test','웃는 여잔 다이뻐','김성호','0902130521515.mp3','','2009-02-13 17:21:51');
/*!40000 ALTER TABLE `wiz_mini_music` ENABLE KEYS */;

--
-- Table structure for table `wiz_mini_photo`
--

DROP TABLE IF EXISTS `wiz_mini_photo`;
CREATE TABLE `wiz_mini_photo` (
  `idx` int(10) NOT NULL auto_increment,
  `code` varchar(30) default NULL,
  `prino` int(10) default NULL,
  `grpno` int(10) default NULL,
  `depno` int(2) default NULL,
  `notice` char(1) default NULL,
  `category` varchar(80) default NULL,
  `memid` varchar(20) default NULL,
  `memgrp` varchar(255) default NULL,
  `name` varchar(100) default NULL,
  `email` varchar(50) default NULL,
  `tphone` varchar(20) default NULL,
  `hphone` varchar(20) default NULL,
  `zipcode` varchar(20) default NULL,
  `address` varchar(20) default NULL,
  `subject` varchar(100) default NULL,
  `content` mediumtext,
  `addinfo1` varchar(255) default NULL,
  `addinfo2` varchar(255) default NULL,
  `addinfo3` varchar(255) default NULL,
  `addinfo4` varchar(255) default NULL,
  `addinfo5` varchar(255) default NULL,
  `ctype` enum('T','H') default NULL,
  `privacy` enum('Y','N') default NULL,
  `upfile1` varchar(40) default NULL,
  `upfile2` varchar(40) default NULL,
  `upfile3` varchar(40) default NULL,
  `upfile4` varchar(40) default NULL,
  `upfile5` varchar(40) default NULL,
  `upfile6` varchar(40) default NULL,
  `upfile7` varchar(40) default NULL,
  `upfile8` varchar(40) default NULL,
  `upfile9` varchar(40) default NULL,
  `upfile10` varchar(40) default NULL,
  `upfile11` varchar(40) default NULL,
  `upfile12` varchar(40) default NULL,
  `upfile1_name` varchar(255) default NULL,
  `upfile2_name` varchar(255) default NULL,
  `upfile3_name` varchar(255) default NULL,
  `upfile4_name` varchar(255) default NULL,
  `upfile5_name` varchar(255) default NULL,
  `upfile6_name` varchar(255) default NULL,
  `upfile7_name` varchar(255) default NULL,
  `upfile8_name` varchar(255) default NULL,
  `upfile9_name` varchar(255) default NULL,
  `upfile10_name` varchar(255) default NULL,
  `upfile11_name` varchar(255) default NULL,
  `upfile12_name` varchar(255) default NULL,
  `movie1` mediumtext,
  `movie2` mediumtext,
  `movie3` mediumtext,
  `passwd` varchar(30) default NULL,
  `count` int(8) default NULL,
  `recom` int(8) default NULL,
  `comment` int(8) default NULL,
  `ip` varchar(15) default NULL,
  `wdate` int(10) default NULL,
  `ucc_file` varchar(255) default NULL,
  `ucc_movie` varchar(255) default NULL,
  `ucc_img` varchar(255) default NULL,
  `ucc_size` int(11) default NULL,
  `ucc_time` varchar(10) default NULL,
  `miniid` varchar(20) default NULL,
  PRIMARY KEY  (`idx`),
  KEY `code` (`code`)
) AUTO_INCREMENT=5;

--
-- Dumping data for table `wiz_mini_photo`
--

/*!40000 ALTER TABLE `wiz_mini_photo` DISABLE KEYS */;
INSERT INTO `wiz_mini_photo` VALUES (1,'photo',1,1,0,'','11','test','test','테스트','help@abc.com','','','','','test','test','','','','','','H','','0902250157157_1.jpg','','','','','','','','','','','','photo_s01.jpg','','','','','','','','','','','','','','','test',8,0,0,'121.134.141.93',1235370577,'','','',0,'','test'),(2,'photo',2,2,0,'','11','test','test','테스트','help@abc.com','','','','','22','222','','','','','','H','','0902250157221_1.jpg','','','','','','','','','','','','photo_s03.jpg','','','','','','','','','','','','','','','test',4,0,0,'121.134.141.93',1235370593,'','','',0,'','test'),(3,'photo',3,3,0,'','11','test','test','테스트','help@abc.com','','','','','33','33','','','','','','H','','0902250154496_1.jpg','','','','','','','','','','','','picture.jpg','','','','','','','','','','','','','','','test',6,0,0,'121.134.141.93',1235379149,'','','',0,'','test');
/*!40000 ALTER TABLE `wiz_mini_photo` ENABLE KEYS */;

--
-- Table structure for table `wiz_mini_profile`
--

DROP TABLE IF EXISTS `wiz_mini_profile`;
CREATE TABLE `wiz_mini_profile` (
  `idx` int(11) NOT NULL auto_increment,
  `miniid` varchar(20) default NULL,
  `content` mediumtext,
  `wdate` datetime default NULL,
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=13;

--
-- Dumping data for table `wiz_mini_profile`
--

/*!40000 ALTER TABLE `wiz_mini_profile` DISABLE KEYS */;
INSERT INTO `wiz_mini_profile` VALUES (10,'test','아름다운입술을 <BR>갖고싶으면친절한말을하라 <BR><BR><BR>사랑스런눈을갖고 <BR>싶으면너의음식을 <BR>배고픈사람과나눠라','2009-02-20 10:40:04');
/*!40000 ALTER TABLE `wiz_mini_profile` ENABLE KEYS */;

--
-- Table structure for table `wiz_mini_skin`
--

DROP TABLE IF EXISTS `wiz_mini_skin`;
CREATE TABLE `wiz_mini_skin` (
  `idx` int(11) NOT NULL auto_increment,
  `title` varchar(255) default NULL,
  `thumb` varchar(255) default NULL,
  `skin` varchar(255) default NULL,
  `miniid` varchar(20) default NULL,
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=13;

--
-- Dumping data for table `wiz_mini_skin`
--

/*!40000 ALTER TABLE `wiz_mini_skin` DISABLE KEYS */;
INSERT INTO `wiz_mini_skin` VALUES (1,'스킨 1','1112060645268_thumb.jpg','1112060645268.jpg',''),(3,'스킨 2','1112060645345_thumb.jpg','1112060645345.jpg',''),(4,'스킨 3','1112060645402_thumb.jpg','1112060645402.jpg',''),(5,'스킨 4','1112060645499_thumb.jpg','1112060645499.jpg',''),(6,'스킨 5','1112060645563_thumb.jpg','1112060645563.jpg',''),(12,'test','1112060646054_thumb.jpg','1112060646054.jpg','test');
/*!40000 ALTER TABLE `wiz_mini_skin` ENABLE KEYS */;

--
-- Table structure for table `wiz_otherinfo`
--

DROP TABLE IF EXISTS `wiz_otherinfo`;
CREATE TABLE `wiz_otherinfo` (
  `idx` int(10) NOT NULL auto_increment,
  `type` varchar(20) default NULL,
  `info01` varchar(255) default NULL,
  `info02` varchar(255) default NULL,
  `info03` varchar(255) default NULL,
  `info04` varchar(255) default NULL,
  `info05` varchar(255) default NULL,
  `info06` varchar(255) default NULL,
  `info07` varchar(255) default NULL,
  `info08` varchar(255) default NULL,
  `info09` varchar(255) default NULL,
  `info10` varchar(255) default NULL,
  PRIMARY KEY  (`idx`),
  KEY `type` (`type`)
) AUTO_INCREMENT=10;

--
-- Dumping data for table `wiz_otherinfo`
--

/*!40000 ALTER TABLE `wiz_otherinfo` DISABLE KEYS */;
INSERT INTO `wiz_otherinfo` VALUES (1,'domain','test.com','test.com','test','test','2007-10-01','','','','',''),(2,'email','test@test.com','test','test','test','','','','','','');
/*!40000 ALTER TABLE `wiz_otherinfo` ENABLE KEYS */;

--
-- Table structure for table `wiz_page`
--

DROP TABLE IF EXISTS `wiz_page`;
CREATE TABLE `wiz_page` (
  `idx` int(10) NOT NULL auto_increment,
  `code` varchar(30) default NULL,
  `title` varchar(255) default NULL,
  `menu` varchar(255) default NULL,
  `url` mediumtext,
  `level` varchar(6) default NULL,
  `content` mediumtext,
  `prior` int(11) default NULL,
  `wdate` date default NULL,
  PRIMARY KEY  (`idx`),
  UNIQUE KEY `code` (`code`)
) AUTO_INCREMENT=18;

--
-- Dumping data for table `wiz_page`
--

/*!40000 ALTER TABLE `wiz_page` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiz_page` ENABLE KEYS */;

--
-- Table structure for table `wiz_point`
--

DROP TABLE IF EXISTS `wiz_point`;
CREATE TABLE `wiz_point` (
  `idx` int(10) unsigned NOT NULL auto_increment,
  `bidx` int(10) unsigned default NULL,
  `cidx` int(10) unsigned default NULL,
  `midx` int(10) unsigned default NULL,
  `ptype` varchar(7) default NULL,
  `mode` varchar(5) default NULL,
  `memid` varchar(20) default NULL,
  `point` int(11) default NULL,
  `memo` varchar(255) default NULL,
  `wdate` datetime default NULL,
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=315;

--
-- Dumping data for table `wiz_point`
--

/*!40000 ALTER TABLE `wiz_point` DISABLE KEYS */;
INSERT INTO `wiz_point` VALUES (164,483,0,0,'BBS','recom','test',10,'게시판 추천 포인트','2008-12-24 14:50:37'),(165,0,0,0,'','point','test',1000,'포인트 테스트','2008-12-24 14:56:09'),(166,483,0,0,'BBS','recom','test',10,'게시판 추천 포인트','2008-12-24 16:32:55'),(167,483,0,0,'BBS','view','test',-10,'게시판 보기 포인트','2008-12-24 17:04:53'),(312,0,0,0,'','point','test2',1111,'포인트내용','2009-03-23 19:07:55'),(313,0,0,0,'LOGIN','','test',10,'로그인 포인트','2009-06-17 10:06:53');
/*!40000 ALTER TABLE `wiz_point` ENABLE KEYS */;

--
-- Table structure for table `wiz_poll`
--

DROP TABLE IF EXISTS `wiz_poll`;
CREATE TABLE `wiz_poll` (
  `idx` int(10) NOT NULL auto_increment,
  `code` varchar(20) default NULL,
  `polluse` enum('Y','N') default NULL,
  `pollmain` enum('Y','N') default NULL,
  `sdate` date default NULL,
  `edate` date default NULL,
  `apermi` enum('N','M') default NULL,
  `cpermi` enum('N','M') default NULL,
  `subject` varchar(150) default NULL,
  `content` mediumtext,
  `wdate` date default NULL,
  `cnt` int(10) default '0',
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=21;

--
-- Dumping data for table `wiz_poll`
--

/*!40000 ALTER TABLE `wiz_poll` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiz_poll` ENABLE KEYS */;

--
-- Table structure for table `wiz_polldata`
--

DROP TABLE IF EXISTS `wiz_polldata`;
CREATE TABLE `wiz_polldata` (
  `idx` int(10) NOT NULL auto_increment,
  `pidx` int(10) NOT NULL default '0',
  `question` varchar(150) default NULL,
  `answer01` varchar(100) default NULL,
  `count01` int(10) default NULL,
  `answer02` varchar(100) default NULL,
  `count02` int(10) default NULL,
  `answer03` varchar(100) default NULL,
  `count03` int(10) default NULL,
  `answer04` varchar(100) default NULL,
  `count04` int(10) default NULL,
  `answer05` varchar(100) default NULL,
  `count05` int(10) default NULL,
  `answer06` varchar(100) default NULL,
  `count06` int(10) default NULL,
  `answer07` varchar(100) default NULL,
  `count07` int(10) default NULL,
  `answer08` varchar(100) default NULL,
  `count08` int(10) default NULL,
  `answer09` varchar(100) default NULL,
  `count09` int(10) default NULL,
  `answer10` varchar(100) default NULL,
  `count10` int(10) default NULL,
  PRIMARY KEY  (`idx`),
  KEY `code` (`pidx`)
) AUTO_INCREMENT=23;

--
-- Dumping data for table `wiz_polldata`
--

/*!40000 ALTER TABLE `wiz_polldata` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiz_polldata` ENABLE KEYS */;

--
-- Table structure for table `wiz_pollinfo`
--

DROP TABLE IF EXISTS `wiz_pollinfo`;
CREATE TABLE `wiz_pollinfo` (
  `code` varchar(20) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `lpermi` varchar(6) default NULL,
  `rpermi` varchar(6) default NULL,
  `apermi` varchar(6) default NULL,
  `cpermi` varchar(6) default NULL,
  `skin` varchar(100) default NULL,
  `permsg` varchar(255) default NULL,
  `perurl` varchar(255) default NULL,
  `mainskin` mediumtext,
  `purl` mediumtext,
  `wdate` date default NULL,
  `datetype_list` varchar(30) default NULL,
  `datetype_view` varchar(30) default NULL,
  `rows` int(3) default NULL,
  `lists` int(3) default NULL,
  `newc` int(3) default NULL,
  `subject_len` int(3) default NULL,
  `spam_check` enum('Y','N') default NULL,
  `comment` enum('Y','N') default NULL,
  `abuse` enum('Y','N') default NULL,
  `abtxt` mediumtext,
  PRIMARY KEY  (`code`)
);

--
-- Dumping data for table `wiz_pollinfo`
--

/*!40000 ALTER TABLE `wiz_pollinfo` DISABLE KEYS */;
INSERT INTO `wiz_pollinfo` VALUES ('poll','설문조사','','','','','pollBasic','권한이 없습니다.','/sub/login.php','<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">\r\n  <tr>\r\n    <td height=\"20\" align=\"left\"><b>{SUBJECT}</b></td>\r\n  </tr>\r\n  <tr><td height=\"5\"></td></tr>\r\n  <tr><td bgcolor=\"f3f3f3\" style=\"padding:4px\" align=\"left\">{CONTENT}</td></tr>\r\n  <tr><td height=\"7\"></td></tr>\r\n\r\n  [LOOP]\r\n  <tr><td align=\"left\"><img src=\"{SKIN_DIR}/image/point.gif\" align=\"absmiddle\"> {QUESTION}</td></tr>\r\n\r\n  [LOOP2]\r\n  <tr><td align=\"left\">{ANSWER}</td></tr>\r\n  [/LOOP2]\r\n\r\n  [/LOOP]\r\n\r\n  <tr><td height=\"10\"></td></tr>\r\n  <tr>\r\n    <td align=\"right\">{VOTE_BTN} {VIEW_BTN}</td>\r\n  </tr>\r\n</table>','sub03/sub03_11.php','2007-10-14','%Y.%m.%d','%Y.%m.%d',10,10,3,0,'Y','Y','Y','');
/*!40000 ALTER TABLE `wiz_pollinfo` ENABLE KEYS */;

--
-- Table structure for table `wiz_popup`
--

DROP TABLE IF EXISTS `wiz_popup`;
CREATE TABLE `wiz_popup` (
  `idx` int(3) NOT NULL auto_increment,
  `isuse` enum('Y','N') default NULL,
  `scroll` enum('Y','N') default NULL,
  `posi_x` int(3) default NULL,
  `posi_y` int(3) default NULL,
  `size_x` int(3) default NULL,
  `size_y` int(3) default NULL,
  `sdate` date default NULL,
  `edate` date default NULL,
  `linkurl` varchar(255) default NULL,
  `popup_type` char(1) default NULL,
  `title` varchar(255) default NULL,
  `content` mediumtext,
  `wdate` date default NULL,
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=12;

--
-- Dumping data for table `wiz_popup`
--

/*!40000 ALTER TABLE `wiz_popup` DISABLE KEYS */;
INSERT INTO `wiz_popup` VALUES (1,'Y','Y',300,200,300,300,'2007-01-01','2012-12-31','','W','팝업 테스트','팝업테스트','2007-04-04');
/*!40000 ALTER TABLE `wiz_popup` ENABLE KEYS */;

--
-- Table structure for table `wiz_prdinfo`
--

DROP TABLE IF EXISTS `wiz_prdinfo`;
CREATE TABLE `wiz_prdinfo` (
  `skin` varchar(100) default NULL,
  `wdate` date default NULL,
  `purl` mediumtext,
  `prdcnt` int(3) default NULL,
  `prdline` int(3) default NULL,
  `maintype` varchar(20) default NULL,
  `mainskin` mediumtext,
  `prdname_len` int(3) default NULL
);

--
-- Dumping data for table `wiz_prdinfo`
--

/*!40000 ALTER TABLE `wiz_prdinfo` DISABLE KEYS */;
INSERT INTO `wiz_prdinfo` VALUES ('prdBasic','2007-10-14','',4,0,'wdate','<table width=\'100%\' cellspacing=\'0\' cellpadding=\'0\' border=\'0\'>\r\n[LOOP]\r\n<td>\r\n  <table>\r\n    <tr><td align=\'center\'><img src=\'{PRDIMG}\' width=\'100\' height=\'100\' {PRDLINK}></td></tr>\r\n    <tr><td align=\'center\'>{PRDNAME}</td></tr>\r\n    <tr><td align=\'center\'>{PRDPRICE}원</td></tr>\r\n  </table>\r\n</td>\r\n[/LOOP]\r\n</table>',0);
/*!40000 ALTER TABLE `wiz_prdinfo` ENABLE KEYS */;

--
-- Table structure for table `wiz_prdmain`
--

DROP TABLE IF EXISTS `wiz_prdmain`;
CREATE TABLE `wiz_prdmain` (
  `idx` int(10) unsigned NOT NULL auto_increment,
  `prdcnt` smallint(6) default NULL,
  `prdline` smallint(6) default NULL,
  `maintype` varchar(20) default NULL,
  `mainskin` mediumtext,
  `prdname_len` smallint(6) default NULL,
  `prdexp_len` smallint(6) default NULL,
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=4;

--
-- Dumping data for table `wiz_prdmain`
--

/*!40000 ALTER TABLE `wiz_prdmain` DISABLE KEYS */;
INSERT INTO `wiz_prdmain` VALUES (2,2,2,'wdate','<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tr>\r\n[LOOP]\r\n<td>\r\n  <table border=\"0\" cellspacing=\"0\" cellpadding=\"4\">\r\n    <tr>\r\n      <td rowspan=\"2\">\r\n      <a href=\"{PRDLINK}\"><img src=\"{PRDIMG}\" width=\"78\" height=\"78\" border=\"0\"></a>\r\n      </td>\r\n      <td><strong><a href=\"{PRDLINK}\">{PRDNAME}</a></strong><br>\r\n      <span class=\"s01\"><a href=\"{PRDLINK}\">{PRDEXP}</a></span>\r\n      </td>\r\n    </tr>\r\n  </table>\r\n</td>\r\n[/LOOP]\r\n</tr>\r\n</table>',30,30),(3,2,0,'recom','<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tr>\r\n[LOOP]\r\n<td>\r\n  <table width=\"190\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">\r\n    <tr>\r\n      <td rowspan=\"2\">\r\n      <a href=\"{PRDLINK}\"><img src=\"{PRDIMG}\" width=\"90\" height=\"72\" border=\"0\"></a>\r\n      </td>\r\n      <td align=\"left\" style=\"padding:5px\"><strong><a href=\"{PRDLINK}\">{PRDNAME}</a></strong><br>\r\n      <span class=\"s01\"><a href=\"{PRDLINK}\">{PRDEXP}</a></span>\r\n      </td>\r\n    </tr>\r\n  </table>\r\n</td>\r\n[/LOOP]\r\n</tr>\r\n</table>',30,30);
/*!40000 ALTER TABLE `wiz_prdmain` ENABLE KEYS */;

--
-- Table structure for table `wiz_prdrelation`
--

DROP TABLE IF EXISTS `wiz_prdrelation`;
CREATE TABLE `wiz_prdrelation` (
  `idx` int(10) NOT NULL auto_increment,
  `prdcode` varchar(10) default NULL,
  `relcode` varchar(10) default NULL,
  PRIMARY KEY  (`idx`),
  KEY `prdcode` (`prdcode`)
) AUTO_INCREMENT=8;

--
-- Dumping data for table `wiz_prdrelation`
--

/*!40000 ALTER TABLE `wiz_prdrelation` DISABLE KEYS */;
INSERT INTO `wiz_prdrelation` VALUES (1,'0909280004','0909280004'),(2,'0909280004','0909280003'),(3,'0909280004','0903160001'),(5,'0909280004','0712020005'),(6,'0909280004','0712020003');
/*!40000 ALTER TABLE `wiz_prdrelation` ENABLE KEYS */;

--
-- Table structure for table `wiz_product`
--

DROP TABLE IF EXISTS `wiz_product`;
CREATE TABLE `wiz_product` (
  `prdcode` varchar(10) NOT NULL default '',
  `prdnum` varchar(50) default NULL,
  `prdname` varchar(100) default NULL,
  `prdprice` int(10) default NULL,
  `showset` enum('Y','N') default NULL,
  `prior` bigint(14) default NULL,
  `prdicon` varchar(255) default NULL,
  `recom` enum('Y','N') default NULL,
  `info_name1` varchar(80) default NULL,
  `info_value1` varchar(255) default NULL,
  `info_name2` varchar(80) default NULL,
  `info_value2` varchar(255) default NULL,
  `info_name3` varchar(80) default NULL,
  `info_value3` varchar(255) default NULL,
  `info_name4` varchar(80) default NULL,
  `info_value4` varchar(255) default NULL,
  `info_name5` varchar(80) default NULL,
  `info_value5` varchar(255) default NULL,
  `info_name6` varchar(80) default NULL,
  `info_value6` varchar(255) default NULL,
  `info_name7` varchar(80) default NULL,
  `info_value7` varchar(255) default NULL,
  `info_name8` varchar(80) default NULL,
  `info_value8` varchar(255) default NULL,
  `info_name9` varchar(80) default NULL,
  `info_value9` varchar(255) default NULL,
  `info_name10` varchar(80) default NULL,
  `info_value10` varchar(255) default NULL,
  `addinfo1` mediumtext,
  `addinfo2` mediumtext,
  `addinfo3` mediumtext,
  `addinfo4` mediumtext,
  `addinfo5` mediumtext,
  `prdimg_R` varchar(30) default NULL,
  `prdimg_L1` varchar(30) default NULL,
  `prdimg_M1` varchar(30) default NULL,
  `prdimg_S1` varchar(30) default NULL,
  `prdimg_L2` varchar(30) default NULL,
  `prdimg_M2` varchar(30) default NULL,
  `prdimg_S2` varchar(30) default NULL,
  `prdimg_L3` varchar(30) default NULL,
  `prdimg_M3` varchar(30) default NULL,
  `prdimg_S3` varchar(30) default NULL,
  `prdimg_L4` varchar(30) default NULL,
  `prdimg_M4` varchar(30) default NULL,
  `prdimg_S4` varchar(30) default NULL,
  `prdimg_L5` varchar(30) default NULL,
  `prdimg_M5` varchar(30) default NULL,
  `prdimg_S5` varchar(30) default NULL,
  `prdimg_L6` varchar(30) default NULL,
  `prdimg_M6` varchar(30) default NULL,
  `prdimg_S6` varchar(30) default NULL,
  `prdimg_L7` varchar(30) default NULL,
  `prdimg_M7` varchar(30) default NULL,
  `prdimg_S7` varchar(30) default NULL,
  `prdimg_L8` varchar(30) default NULL,
  `prdimg_M8` varchar(30) default NULL,
  `prdimg_S8` varchar(30) default NULL,
  `prdimg_L9` varchar(30) default NULL,
  `prdimg_M9` varchar(30) default NULL,
  `prdimg_S9` varchar(30) default NULL,
  `prdimg_L10` varchar(30) default NULL,
  `prdimg_M10` varchar(30) default NULL,
  `prdimg_S10` varchar(30) default NULL,
  `prdimg_L11` varchar(30) default NULL,
  `prdimg_M11` varchar(30) default NULL,
  `prdimg_S11` varchar(30) default NULL,
  `prdimg_L12` varchar(30) default NULL,
  `prdimg_M12` varchar(30) default NULL,
  `prdimg_S12` varchar(30) default NULL,
  `upfile1` varchar(40) default NULL,
  `upfile2` varchar(40) default NULL,
  `upfile3` varchar(40) default NULL,
  `upfile4` varchar(40) default NULL,
  `upfile5` varchar(40) default NULL,
  `upfile1_name` varchar(255) default NULL,
  `upfile2_name` varchar(255) default NULL,
  `upfile3_name` varchar(255) default NULL,
  `upfile4_name` varchar(255) default NULL,
  `upfile5_name` varchar(255) default NULL,
  `shortexp` mediumtext,
  `content` mediumtext,
  PRIMARY KEY  (`prdcode`)
);

--
-- Dumping data for table `wiz_product`
--

/*!40000 ALTER TABLE `wiz_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiz_product` ENABLE KEYS */;

--
-- Table structure for table `wiz_schedule`
--

DROP TABLE IF EXISTS `wiz_schedule`;
CREATE TABLE `wiz_schedule` (
  `idx` int(10) unsigned NOT NULL auto_increment,
  `memid` varchar(15) NOT NULL default '',
  `prior` int(1) default NULL,
  `subject` varchar(255) default NULL,
  `content` mediumtext,
  `sdate` datetime default NULL,
  `edate` datetime default NULL,
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=25;

--
-- Dumping data for table `wiz_schedule`
--

/*!40000 ALTER TABLE `wiz_schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `wiz_schedule` ENABLE KEYS */;

--
-- Table structure for table `wiz_siteinfo`
--

DROP TABLE IF EXISTS `wiz_siteinfo`;
CREATE TABLE `wiz_siteinfo` (
  `site_name` varchar(100) default NULL,
  `site_url` varchar(100) default NULL,
  `site_email` varchar(80) default NULL,
  `site_tel` varchar(20) default NULL,
  `site_hand` varchar(20) default NULL,
  `site_key` mediumtext,
  `site_date` varchar(20) default NULL,
  `ftp_host` varchar(80) default NULL,
  `ftp_id` varchar(20) default NULL,
  `ftp_pw` varchar(20) default NULL,
  `admin_title` varchar(255) default NULL,
  `admin_copyright` mediumtext,
  `addbbs_use` enum('Y','N') default NULL,
  `ssl_use` enum('Y','N') default NULL,
  `ssl_port` varchar(10) default NULL,
  `msg_use` enum('Y','N') default NULL,
  `msg_skin` varchar(50) default NULL,
  `msg_url` varchar(255) default NULL,
  `mini_use` enum('Y','N') default NULL,
  `mini_skin` varchar(50) default NULL,
  `mini_url` varchar(255) default NULL,
  `sms_use` enum('Y','N') default NULL,
  `sms_type` char(1) default NULL,
  `sms_id` varchar(80) default NULL,
  `sms_pw` varchar(20) default NULL,
  `search_skin` varchar(50) default NULL,
  `search_url` varchar(255) default NULL,
  `namecheck_use` enum('Y','N') default NULL,
  `namecheck_id` varchar(20) default NULL,
  `namecheck_pw` varchar(20) default NULL,
  `point_use` enum('Y','N') default NULL,
  `point_skin` varchar(50) default NULL,
  `point_url` varchar(255) default NULL,
  `join_point` int(11) default NULL,
  `login_point` int(11) default NULL,
  `msg_point` int(11) default NULL,
  `view_point` int(11) default NULL,
  `write_point` int(11) default NULL,
  `down_point` int(11) default NULL,
  `comment_point` int(11) default NULL,
  `recom_point` int(11) default NULL,
  `point_msg` varchar(255) default NULL,
  `designer_id` varchar(20) default NULL,
  `designer_pw` varchar(20) default NULL,
  `anywiz_id` varchar(60) default NULL,
  `anywiz_pw` varchar(60) default NULL,
  `start_page` varchar(255) default NULL,
  `menu_use` varchar(100) default NULL,
  `solution` varchar(100) default NULL,
  `prdimg_R` int(3) default NULL,
  `prdimg_L` int(3) default NULL,
  `prdimg_M` int(3) default NULL,
  `prdimg_S` int(3) default NULL,
  `com_num` varchar(20) default NULL,
  `com_name` varchar(30) default NULL,
  `com_owner` varchar(20) default NULL,
  `com_post` varchar(7) default NULL,
  `com_address` varchar(80) default NULL,
  `com_kind` varchar(50) default NULL,
  `com_class` varchar(50) default NULL,
  `com_tel` varchar(20) default NULL,
  `com_fax` varchar(20) default NULL,
  `con_parameter` varchar(255) default NULL,
  `bbs_grp` mediumtext,
  `page_grp` mediumtext,
  `up_date` date default NULL
);

--
-- Dumping data for table `wiz_siteinfo`
--

/*!40000 ALTER TABLE `wiz_siteinfo` DISABLE KEYS */;
INSERT INTO `wiz_siteinfo` VALUES ('홈페이지','http://test.com','test@test.com','00-0000-0000','000-1111-2222','','','abc.com','abc','1234','홈페이지 관리자','Copyright ⓒ 2009 사이트명 All rights reserved.','N','N','','N','msgBasic','','N','','','Y','C','','','searchBasic','sub08/search.php','N','','','N','pointBasic','',0,0,0,0,0,0,0,1,'포인트가 부족합니다.','wizhome','1234','34138f076d918cb3b7f91205181fb3ab','663c13d1d636f6ea10e3be4d8a25710b','/admin2/manage/main/main.php','BASIC/BBS/LOG/MEMBER/BANNER/FORMMAIL/POLL/SCHEGUAL/PRODUCT/PAGE/','wizhome',120,500,250,50,'000-00-00000','테스트','테스트','000-000','서울 서초구 서초동  000-0번지 000호','서비스','홈페이지제작','00-0000-0000','00-0000-0000','p,q,query','','\n1^회사소개\n2^고객센터','2014-06-23');
/*!40000 ALTER TABLE `wiz_siteinfo` ENABLE KEYS */;

--
-- Table structure for table `wiz_tabledesc`
--

DROP TABLE IF EXISTS `wiz_tabledesc`;
CREATE TABLE `wiz_tabledesc` (
  `idx` int(10) NOT NULL auto_increment,
  `tname` varchar(100) default NULL,
  `tdesc` text,
  `field` varchar(100) default NULL,
  `fdesc` text,
  PRIMARY KEY  (`idx`)
) AUTO_INCREMENT=1113;

--
-- Dumping data for table `wiz_tabledesc`
--

/*!40000 ALTER TABLE `wiz_tabledesc` DISABLE KEYS */;
INSERT INTO `wiz_tabledesc` VALUES (1,'wiz_admin','관리자 정보','',NULL),(2,'wiz_admin','<b>관리자테이블</b>\r\n관리자 목록테이블입니다.','anywiz',NULL),(3,'wiz_admin',NULL,'id','아이디'),(4,'wiz_admin',NULL,'passwd','비밀번호'),(5,'wiz_admin',NULL,'name','이름'),(6,'wiz_admin',NULL,'icon','아이콘'),(7,'wiz_admin',NULL,'resno','주민번호'),(8,'wiz_admin',NULL,'email','이메일'),(9,'wiz_admin',NULL,'tphone','전화번호'),(10,'wiz_admin',NULL,'hphone','휴대폰'),(11,'wiz_admin',NULL,'post','우편번호'),(12,'wiz_admin',NULL,'address1','주소'),(13,'wiz_admin',NULL,'address2','상세주소'),(14,'wiz_admin',NULL,'part','직급'),(15,'wiz_admin',NULL,'permi','페이지 접근권한'),(16,'wiz_admin',NULL,'last','마지막 접속시간'),(17,'wiz_admin',NULL,'wdate','등록일'),(18,'wiz_admin',NULL,'descript','관리자 주석'),(19,'wiz_banner',NULL,'idx','인덱스'),(20,'wiz_banner',NULL,'code','배너그룹코드'),(21,'wiz_banner',NULL,'align','배너정렬'),(22,'wiz_banner',NULL,'prior','우선순위'),(23,'wiz_banner',NULL,'isuse','사용여부'),(24,'wiz_banner',NULL,'link_url','링크주소'),(25,'wiz_banner',NULL,'link_target','링크 Target'),(26,'wiz_banner',NULL,'de_type','디자인방법'),(27,'wiz_banner',NULL,'de_img','배너이미지'),(28,'wiz_banner',NULL,'de_html','배너내용'),(29,'wiz_banner','','anywiz',NULL),(30,'wiz_banner','<b>배너테이블</b>\r\n배너 테이블입니다.','anywiz',NULL),(31,'wiz_bannerinfo','<b>배너그룹테이블</b>\r\n배너그룹 테이블입니다.','anywiz',NULL),(32,'wiz_bannerinfo',NULL,'idx','인덱스'),(33,'wiz_bannerinfo',NULL,'title','배너그룹이름'),(34,'wiz_bannerinfo',NULL,'code','배너그룹코드'),(35,'wiz_bannerinfo',NULL,'types','배너형태'),(36,'wiz_bannerinfo',NULL,'types_num','배너갯수'),(37,'wiz_bannerinfo',NULL,'padding','배너간격'),(38,'wiz_bannerinfo',NULL,'isuse','사용여부'),(39,'wiz_bbs','<b>게시물테이블</b>\r\n게시물 테이블입니다.','anywiz',NULL),(40,'wiz_bbs',NULL,'idx','인덱스'),(41,'wiz_bbs',NULL,'code','게시판코드'),(42,'wiz_bbs',NULL,'prino','정렬값'),(43,'wiz_bbs',NULL,'grpno','답변그룹값'),(44,'wiz_bbs',NULL,'depno','답변깊이값'),(45,'wiz_bbs',NULL,'notice','공지글'),(46,'wiz_bbs',NULL,'category','카테고리'),(47,'wiz_bbs',NULL,'memid','글쓴이ID'),(48,'wiz_bbs',NULL,'memgrp','답변그룹ID'),(49,'wiz_bbs',NULL,'name','이름'),(50,'wiz_bbs',NULL,'nick','닉네임'),(51,'wiz_bbs',NULL,'email','이메일'),(52,'wiz_bbs',NULL,'tphone','전화번호'),(53,'wiz_bbs',NULL,'hphone','휴대전화번호'),(54,'wiz_bbs',NULL,'zipcode','우편번호'),(55,'wiz_bbs',NULL,'address','주소'),(56,'wiz_bbs',NULL,'subject','제목'),(57,'wiz_bbs',NULL,'content','내용'),(58,'wiz_bbs',NULL,'addinfo1','추가내용1'),(59,'wiz_bbs',NULL,'addinfo2','추가내용2'),(60,'wiz_bbs',NULL,'addinfo3','추가내용3'),(61,'wiz_bbs',NULL,'addinfo4','추가내용4'),(62,'wiz_bbs',NULL,'addinfo5','추가내용5'),(63,'wiz_bbs',NULL,'ctype','HTML사용여부'),(64,'wiz_bbs',NULL,'privacy','비밀글'),(65,'wiz_bbs',NULL,'upfile1','첨부파일1'),(66,'wiz_bbs',NULL,'upfile2','첨부파일2'),(67,'wiz_bbs',NULL,'upfile3','첨부파일3'),(68,'wiz_bbs',NULL,'upfile4','첨부파일4'),(69,'wiz_bbs',NULL,'upfile5','첨부파일5'),(70,'wiz_bbs',NULL,'upfile6','첨부파일6'),(71,'wiz_bbs',NULL,'upfile7','첨부파일7'),(72,'wiz_bbs',NULL,'upfile8','첨부파일8'),(73,'wiz_bbs',NULL,'upfile9','첨부파일9'),(74,'wiz_bbs',NULL,'upfile10','첨부파일10'),(75,'wiz_bbs',NULL,'upfile11','첨부파일11'),(76,'wiz_bbs',NULL,'upfile12','첨부파일12'),(77,'wiz_bbs',NULL,'upfile1_name','첨부파일명1'),(78,'wiz_bbs',NULL,'upfile2_name','첨부파일명2'),(79,'wiz_bbs',NULL,'upfile3_name','첨부파일명3'),(80,'wiz_bbs',NULL,'upfile4_name','첨부파일명4'),(81,'wiz_bbs',NULL,'upfile5_name','첨부파일명5'),(82,'wiz_bbs',NULL,'upfile6_name','첨부파일명6'),(83,'wiz_bbs',NULL,'upfile7_name','첨부파일명7'),(84,'wiz_bbs',NULL,'upfile8_name','첨부파일명8'),(85,'wiz_bbs',NULL,'upfile9_name','첨부파일명9'),(86,'wiz_bbs',NULL,'upfile10_name','첨부파일명10'),(87,'wiz_bbs',NULL,'upfile11_name','첨부파일명11'),(88,'wiz_bbs',NULL,'upfile12_name','첨부파일명12'),(89,'wiz_bbs',NULL,'movie1','동영상1'),(90,'wiz_bbs',NULL,'movie2','동영상2'),(91,'wiz_bbs',NULL,'movie3','동영상3'),(92,'wiz_bbs',NULL,'passwd','비밀번호'),(93,'wiz_bbs',NULL,'count','조회수'),(94,'wiz_bbs',NULL,'recom','추천수'),(95,'wiz_bbs',NULL,'comment','덧글수'),(96,'wiz_bbs',NULL,'ip','IP'),(97,'wiz_bbs',NULL,'wdate','작성일'),(98,'wiz_bbscat','<b>게시판 카테고리 테이블</b>\r\n게시판 카테고리 테이블입니다.','anywiz',NULL),(99,'wiz_bbscat',NULL,'idx','인덱스'),(100,'wiz_bbscat',NULL,'gubun','카테고리형식(전체, 일반)'),(101,'wiz_bbscat',NULL,'code','게시판코드'),(102,'wiz_bbscat',NULL,'catname','카테고리명'),(103,'wiz_bbscat',NULL,'catimg','메뉴이미지'),(104,'wiz_bbscat',NULL,'catimg_over','메뉴 롤오버 이미지'),(105,'wiz_bbscat',NULL,'caticon','아이콘'),(106,'wiz_bbsinfo','<b>게시판 정보 테이블</b>\r\n게시판 정보 테이블입니다.','anywiz',NULL),(107,'wiz_bbsinfo',NULL,'code','게시판코드'),(108,'wiz_bbsinfo',NULL,'type','게시판형식(일반, 일정)'),(109,'wiz_bbsinfo',NULL,'title','게시판명'),(110,'wiz_bbsinfo',NULL,'titleimg','타이틀이미지'),(111,'wiz_bbsinfo',NULL,'header','상단파일'),(112,'wiz_bbsinfo',NULL,'footer','하단파일'),(113,'wiz_bbsinfo',NULL,'category','카테고리'),(114,'wiz_bbsinfo',NULL,'bbsadmin','게시판관리자'),(115,'wiz_bbsinfo',NULL,'lpermi','목록보기 권한'),(116,'wiz_bbsinfo',NULL,'rpermi','내용보기 권한'),(117,'wiz_bbsinfo',NULL,'wpermi','글쓰기 권한'),(118,'wiz_bbsinfo',NULL,'apermi','답글쓰기 권한'),(119,'wiz_bbsinfo',NULL,'cpermi','코멘트쓰기 권한'),(120,'wiz_bbsinfo',NULL,'datetype_list','날짜형식(목록페이지)'),(121,'wiz_bbsinfo',NULL,'datetype_view','날짜형식(보기페이지)'),(122,'wiz_bbsinfo',NULL,'skin','스킨'),(123,'wiz_bbsinfo',NULL,'permsg','권한이 없을 경우 경고메세지'),(124,'wiz_bbsinfo',NULL,'perurl','권한이 없을 경우 이동페이지'),(125,'wiz_bbsinfo',NULL,'pageurl','게시판 페이지 주소'),(126,'wiz_bbsinfo',NULL,'editor','웹에디터 사용여부'),(127,'wiz_bbsinfo',NULL,'usetype','게시판 사용여부'),(128,'wiz_bbsinfo',NULL,'privacy','자동 비밀글 사용여부'),(129,'wiz_bbsinfo',NULL,'upfile','파일업로드 사용여부 및 업로드갯수'),(130,'wiz_bbsinfo',NULL,'movie','동영상 사용여부 및 동영상 갯수'),(131,'wiz_bbsinfo',NULL,'comment','코멘트 사용여부'),(132,'wiz_bbsinfo',NULL,'remail','답글 메일알람 사용여부'),(133,'wiz_bbsinfo',NULL,'imgview','이미지 첨부파일 보기페이지 노출여부'),(134,'wiz_bbsinfo',NULL,'recom','추천기능 사용여부'),(135,'wiz_bbsinfo',NULL,'abuse','욕설,비방글 필터링 사용여부'),(136,'wiz_bbsinfo',NULL,'abtxt','욕설,비방글 필터링 내용'),(137,'wiz_bbsinfo',NULL,'simgsize','목록페이지 이미지크기'),(138,'wiz_bbsinfo',NULL,'mimgsize','보기페이지 이미지크기'),(139,'wiz_bbsinfo',NULL,'rows','페이지 출력수'),(140,'wiz_bbsinfo',NULL,'lists','리스트 출력수'),(141,'wiz_bbsinfo',NULL,'newc','NEW 기간설정'),(142,'wiz_bbsinfo',NULL,'hotc','HOT 조회수 설정'),(143,'wiz_bbsinfo',NULL,'line','줄바꿈 게시물수'),(144,'wiz_bbsinfo',NULL,'subject_len','제목 글자수'),(145,'wiz_bbsinfo',NULL,'view_point','글보기 포인트'),(146,'wiz_bbsinfo',NULL,'write_point','글쓰기 포인트'),(147,'wiz_bbsinfo',NULL,'down_point','첨부파일 다운로드 포인트'),(148,'wiz_bbsinfo',NULL,'comment_point','코멘트 포인트'),(149,'wiz_bbsinfo',NULL,'recom_point','추천 포인트'),(150,'wiz_bbsinfo',NULL,'point_msg','포인트가 없을 경우 경고메세지'),(151,'wiz_bbsinfo',NULL,'img_align','첨부파일 이미지 정렬값'),(152,'wiz_bbsinfo',NULL,'btn_view','권한이 없을 경우 글쓰기 버튼 노출여부'),(153,'wiz_bbsinfo',NULL,'spam_check','스팸글체크기능 사용여부'),(154,'wiz_bbsinfo',NULL,'name_type','글쓴이 형식'),(155,'wiz_bbsmain','<b>메인 게시물 테이블</b>\r\n메인 게시물 테이블입니다.','anywiz',NULL),(156,'wiz_bbsmain',NULL,'idx','인덱스'),(157,'wiz_bbsmain',NULL,'code','게시판코드'),(158,'wiz_bbsmain',NULL,'btype','게시판형식'),(159,'wiz_bbsmain',NULL,'purl','연결페이지'),(160,'wiz_bbsmain',NULL,'cnt','게시물수'),(161,'wiz_bbsmain',NULL,'line','줄바꿈 게시물수'),(162,'wiz_bbsmain',NULL,'skin','게시물스킨'),(163,'wiz_bbsmain',NULL,'subject_len','제목 글자수'),(164,'wiz_bbsmain',NULL,'content_len','내용 글자수'),(165,'wiz_catainfo','<b>카탈로그 정보 테이블</b>\r\n카탈로그 정보 테이블입니다.','anywiz',NULL),(166,'wiz_catainfo',NULL,'idx','인덱스'),(167,'wiz_catainfo',NULL,'code','카탈로그 코드'),(168,'wiz_catainfo',NULL,'title','카탈로그 제목'),(169,'wiz_catainfo',NULL,'status','카탈로그 상태'),(170,'wiz_catalog','<b>카탈로그 테이블</b>\r\n카탈로그 테이블입니다.','anywiz',NULL),(171,'wiz_catalog',NULL,'idx','인덱스'),(172,'wiz_catalog',NULL,'code','카탈로그 코드'),(173,'wiz_catalog',NULL,'filename','파일명'),(174,'wiz_catalog',NULL,'status','상태'),(175,'wiz_category','<b>카테고리 테이블</b>\r\n카테고리 테이블입니다.','anywiz',NULL),(176,'wiz_category',NULL,'catcode','분류코드'),(177,'wiz_category',NULL,'depthno','분류위치값'),(178,'wiz_category',NULL,'priorno01','대분류 정렬값'),(179,'wiz_category',NULL,'priorno02','중분류 정렬값'),(180,'wiz_category',NULL,'priorno03','소분류 정렬값'),(181,'wiz_category',NULL,'catname','분류명'),(182,'wiz_category',NULL,'catuse','사용여부'),(183,'wiz_category',NULL,'catimg','분류이미지'),(184,'wiz_category',NULL,'subimg','분류상단이미지'),(185,'wiz_category',NULL,'subimg_type','분류상단형식'),(186,'wiz_category',NULL,'prd_skin','상품스킨'),(187,'wiz_category',NULL,'prd_num','상품수'),(188,'wiz_category',NULL,'prd_width','상품이미지 가로크기'),(189,'wiz_category',NULL,'prd_height','상품이미지 세로크기'),(190,'wiz_category',NULL,'purl','연결페이지'),(191,'wiz_comment','<b>코멘트 테이블</b>\r\n코멘트 테이블입니다.','anywiz',NULL),(192,'wiz_comment',NULL,'idx','인덱스'),(193,'wiz_comment',NULL,'ctype','코멘트 형식'),(194,'wiz_comment',NULL,'cidx','게시물 번호'),(195,'wiz_comment',NULL,'star','선호도'),(196,'wiz_comment',NULL,'memid','작성자ID'),(197,'wiz_comment',NULL,'name','이름'),(198,'wiz_comment',NULL,'nick','닉네임'),(199,'wiz_comment',NULL,'content','내용'),(200,'wiz_comment',NULL,'passwd','비밀번호'),(201,'wiz_comment',NULL,'wdate','작성일'),(202,'wiz_comment',NULL,'ip','IP'),(203,'wiz_conrefer','<b>접속경로 테이블</b>\r\n접속경로 테이블입니다.','anywiz',NULL),(204,'wiz_conrefer',NULL,'referer','접속경로'),(205,'wiz_conrefer',NULL,'host','접속HOST'),(206,'wiz_conrefer',NULL,'wdate','접속일'),(207,'wiz_conrefer',NULL,'cnt','접속자수'),(208,'wiz_contime','<b>접속자 테이블</b>\r\n접속자 테이블입니다.','anywiz',NULL),(209,'wiz_contime',NULL,'time','접속시간'),(210,'wiz_contime',NULL,'cnt','접속자수'),(211,'wiz_cprelation','<b>상품,상품분류 관계 테이블</b>\r\n상품, 상품분류 관계 테이블입니다.','anywiz',NULL),(212,'wiz_cprelation',NULL,'idx','인덱스'),(213,'wiz_cprelation',NULL,'prdcode','상품코드'),(214,'wiz_cprelation',NULL,'catcode','분류코드'),(215,'wiz_filedesc','<b>파일구조 테이블</b>\r\n파일구조 테이블입니다.','anywiz',NULL),(216,'wiz_filedesc',NULL,'idx','인덱스'),(217,'wiz_filedesc',NULL,'fdir','파일경로'),(218,'wiz_filedesc',NULL,'fdesc','파일설명'),(219,'wiz_form','<b>폼메일 테이블</b>\r\n폼메일 테이블입니다.','anywiz',NULL),(220,'wiz_form',NULL,'idx','인덱스'),(221,'wiz_form',NULL,'code','폼메일코드'),(222,'wiz_form',NULL,'name','작성자'),(223,'wiz_form',NULL,'phone','전화번호'),(224,'wiz_form',NULL,'email','이메일'),(225,'wiz_form',NULL,'subject','제목'),(226,'wiz_form',NULL,'content','내용'),(227,'wiz_form',NULL,'reply','답변'),(228,'wiz_form',NULL,'upfile1','첨부파일1'),(229,'wiz_form',NULL,'upfile2','첨부파일2'),(230,'wiz_form',NULL,'upfile3','첨부파일3'),(231,'wiz_form',NULL,'upfile1_name','첨부파일명1'),(232,'wiz_form',NULL,'upfile2_name','첨부파일명2'),(233,'wiz_form',NULL,'upfile3_name','첨부파일명3'),(234,'wiz_form',NULL,'wdate','작성일'),(235,'wiz_form',NULL,'ip','IP'),(236,'wiz_form',NULL,'status','처리상태'),(237,'wiz_formfield','<b>폼메일 항목 테이블</b>\r\n폼메일 항목 테이블입니다.','anywiz',NULL),(238,'wiz_formfield',NULL,'idx','인덱스'),(239,'wiz_formfield',NULL,'fidx','폼메일 번호'),(240,'wiz_formfield',NULL,'fprior','항목순서'),(241,'wiz_formfield',NULL,'fname','항목명'),(242,'wiz_formfield',NULL,'ftype','항목속성'),(243,'wiz_formfield',NULL,'fessen','항목 필수체크 여부'),(244,'wiz_formfield',NULL,'fsize','항목사이즈'),(245,'wiz_formfield',NULL,'fnum','항목갯수'),(246,'wiz_formfield',NULL,'fimg','항목이미지'),(247,'wiz_formfield',NULL,'flist','세부항목'),(248,'wiz_forminfo','<b>폼메일 정보 테이블</b>\r\n폼메일 정보 테이블입니다.','anywiz',NULL),(249,'wiz_forminfo',NULL,'idx','인덱스'),(250,'wiz_forminfo',NULL,'code','폼메일코드'),(251,'wiz_forminfo',NULL,'title','폼메일명'),(252,'wiz_forminfo',NULL,'skin','스킨'),(253,'wiz_forminfo',NULL,'rece_sms','SMS 수신여부'),(254,'wiz_forminfo',NULL,'rece_email','이메일 수신여부'),(255,'wiz_forminfo',NULL,'rece_bbs','게시판 수신여부'),(256,'wiz_forminfo',NULL,'sms_list','SMS 수신번호'),(257,'wiz_forminfo',NULL,'email_list','이메일 수신이메일'),(258,'wiz_friend','<b>친구 테이블</b>\r\n친구 테이블입니다.','anywiz',NULL),(259,'wiz_friend',NULL,'idx','인덱스'),(260,'wiz_friend',NULL,'myid','자신의 ID'),(261,'wiz_friend',NULL,'frdid','친구의 ID'),(262,'wiz_friend',NULL,'wdate','등록일'),(263,'wiz_level','<b>회원등급 테이블</b>\r\n회원등급 테이블입니다.','anywiz',NULL),(264,'wiz_level',NULL,'idx','인덱스'),(265,'wiz_level',NULL,'level','등급레벨'),(266,'wiz_level',NULL,'icon','아이콘'),(267,'wiz_level',NULL,'name','등급명'),(268,'wiz_level',NULL,'permi','등급권한'),(269,'wiz_level',NULL,'memo','설명'),(270,'wiz_mailsms','<b>이메일, SMS 메세지 설정 테이블</b>\r\n이메일, SMS 메세지 설정 테이블입니다.','anywiz',NULL),(271,'wiz_mailsms',NULL,'code','메세지 코드'),(272,'wiz_mailsms',NULL,'type','메세지 형식'),(273,'wiz_mailsms',NULL,'subject','분류명'),(274,'wiz_mailsms',NULL,'sms_send','SMS 발송여부'),(275,'wiz_mailsms',NULL,'sms_msg','SMS 메세지'),(276,'wiz_mailsms',NULL,'email_subj','이메일 제목'),(277,'wiz_mailsms',NULL,'email_send','이메일 발송여부'),(278,'wiz_mailsms',NULL,'email_msg','이메일 메세지'),(279,'wiz_mailsms',NULL,'wdate','작성일'),(280,'wiz_member','<b>회원 테이블</b>\r\n회원 테이블입니다.','anywiz',NULL),(281,'wiz_member',NULL,'idx','인덱스'),(282,'wiz_member',NULL,'id','아이디'),(283,'wiz_member',NULL,'passwd','비밀번호'),(284,'wiz_member',NULL,'name','이름'),(285,'wiz_member',NULL,'photo','회원사진'),(286,'wiz_member',NULL,'icon','아이콘'),(287,'wiz_member',NULL,'nick','닉네임'),(288,'wiz_member',NULL,'resno','주민등록번호'),(289,'wiz_member',NULL,'email','이메일'),(290,'wiz_member',NULL,'tphone','전화번호'),(291,'wiz_member',NULL,'hphone','휴대전화번호'),(292,'wiz_member',NULL,'comtel','회사전화번호'),(293,'wiz_member',NULL,'homepage','홈페이지'),(294,'wiz_member',NULL,'post','우편번호'),(295,'wiz_member',NULL,'address1','주소'),(296,'wiz_member',NULL,'address2','상세주소'),(297,'wiz_member',NULL,'reemail','이메일 수신여부'),(298,'wiz_member',NULL,'resms','SMS 수신여부'),(299,'wiz_member',NULL,'birthday','생년월일'),(300,'wiz_member',NULL,'bgubun','양력, 음력'),(301,'wiz_member',NULL,'marriage','결혼여부'),(302,'wiz_member',NULL,'memorial','결혼기념일'),(303,'wiz_member',NULL,'scholarship','학력'),(304,'wiz_member',NULL,'job','직업'),(305,'wiz_member',NULL,'income','월평균수입'),(306,'wiz_member',NULL,'car','자동차소유'),(307,'wiz_member',NULL,'hobby','취미'),(308,'wiz_member',NULL,'consph','관심분야'),(309,'wiz_member',NULL,'conprd',''),(310,'wiz_member',NULL,'level','회원등급'),(311,'wiz_member',NULL,'recom','추천인'),(312,'wiz_member',NULL,'visit','방문수'),(313,'wiz_member',NULL,'visit_time','마지막 방문일'),(314,'wiz_member',NULL,'intro','자기소개'),(315,'wiz_member',NULL,'memo','관리자메모'),(316,'wiz_member',NULL,'addinfo1','추가정보1'),(317,'wiz_member',NULL,'addinfo2','추가정보2'),(318,'wiz_member',NULL,'addinfo3','추가정보3'),(319,'wiz_member',NULL,'addinfo4','추가정보4'),(320,'wiz_member',NULL,'addinfo5','추가정보5'),(321,'wiz_member',NULL,'wdate','가입일'),(322,'wiz_meminfo','<b>회원 정보 테이블</b>\r\n회원 정보 테이블입니다.','anywiz',NULL),(323,'wiz_meminfo',NULL,'skin','스킨'),(324,'wiz_meminfo',NULL,'agreement','가입약관'),(325,'wiz_meminfo',NULL,'safeinfo','개인정보 보호정책'),(326,'wiz_meminfo',NULL,'infouse','입력정보 사용여부'),(327,'wiz_meminfo',NULL,'infoess','입력정보 필수항목여부'),(328,'wiz_meminfo',NULL,'join_url','회원가입 페이지'),(329,'wiz_meminfo',NULL,'login_url','로그인 페이지'),(330,'wiz_meminfo',NULL,'idpw_url','아이디/비밀번호 찾기 페이지'),(331,'wiz_meminfo',NULL,'myinfo_url','회원정보 페이지'),(332,'wiz_meminfo',NULL,'out_url','로그아웃 후 이동페이지'),(333,'wiz_meminfo',NULL,'login_img','로그인 이미지'),(334,'wiz_meminfo',NULL,'logout_img','로그아웃 이미지'),(335,'wiz_meminfo',NULL,'join_img','회원가입 이미지'),(336,'wiz_meminfo',NULL,'myinfo_img','회원정보 이미지'),(337,'wiz_meminfo',NULL,'job_list','직업 목록'),(338,'wiz_meminfo',NULL,'sch_list','학력 목록'),(339,'wiz_meminfo',NULL,'income_list','월평균소득 목록'),(340,'wiz_meminfo',NULL,'consph_list','관심분야 목록'),(341,'wiz_meminfo',NULL,'addname','추가항목명'),(342,'wiz_meminfo',NULL,'method','아이디/비밀번호 찾기 방식'),(343,'wiz_message','<b>쪽지 테이블</b>\r\n쪽지 테이블입니다.','anywiz',NULL),(344,'wiz_message',NULL,'idx','인덱스'),(345,'wiz_message',NULL,'se_id','보낸이 ID'),(346,'wiz_message',NULL,'se_name','보낸이 이름'),(347,'wiz_message',NULL,'re_id','받는이 ID'),(348,'wiz_message',NULL,'re_name','받는이 이름'),(349,'wiz_message',NULL,'subject','제목'),(350,'wiz_message',NULL,'content','내용'),(351,'wiz_message',NULL,'upfile','첨부파일'),(352,'wiz_message',NULL,'upfile_name','첨부파일명'),(353,'wiz_message',NULL,'addinfo1','추가정보1'),(354,'wiz_message',NULL,'addinfo2','추가정보2'),(355,'wiz_message',NULL,'addinfo3','추가정보3'),(356,'wiz_message',NULL,'wdate','발송일'),(357,'wiz_message',NULL,'status','수신확인'),(358,'wiz_message',NULL,'re_status','받는이 삭제여부'),(359,'wiz_message',NULL,'se_status','보낸이 삭제여부'),(360,'wiz_mini_bbs','<b>미니홈피 게시판 테이블</b>\r\n미니홈피 게시판 테이블입니다.','anywiz',NULL),(361,'wiz_mini_bbs',NULL,'idx','인덱스'),(362,'wiz_mini_bbs',NULL,'code','게시판 코드'),(363,'wiz_mini_bbs',NULL,'prino','정렬값'),(364,'wiz_mini_bbs',NULL,'grpno','덧글그룹값'),(365,'wiz_mini_bbs',NULL,'depno','덧글깊이값'),(366,'wiz_mini_bbs',NULL,'notice','공지사항'),(367,'wiz_mini_bbs',NULL,'category','카테고리'),(368,'wiz_mini_bbs',NULL,'memid','글쓴이ID'),(369,'wiz_mini_bbs',NULL,'memgrp','덧글그룹ID'),(370,'wiz_mini_bbs',NULL,'name','작성자'),(371,'wiz_mini_bbs',NULL,'email','이메일'),(372,'wiz_mini_bbs',NULL,'tphone','전화번호'),(373,'wiz_mini_bbs',NULL,'hphone','휴대전화번호'),(374,'wiz_mini_bbs',NULL,'zipcode','우편번호'),(375,'wiz_mini_bbs',NULL,'address','주소'),(376,'wiz_mini_bbs',NULL,'subject','제목'),(377,'wiz_mini_bbs',NULL,'content','내용'),(378,'wiz_mini_bbs',NULL,'addinfo1','추가정보1'),(379,'wiz_mini_bbs',NULL,'addinfo2','추가정보2'),(380,'wiz_mini_bbs',NULL,'addinfo3','추가정보3'),(381,'wiz_mini_bbs',NULL,'addinfo4','추가정보4'),(382,'wiz_mini_bbs',NULL,'addinfo5','추가정보5'),(383,'wiz_mini_bbs',NULL,'ctype','HTML 사용여부'),(384,'wiz_mini_bbs',NULL,'privacy','비밀글'),(385,'wiz_mini_bbs',NULL,'upfile1','첨부파일1'),(386,'wiz_mini_bbs',NULL,'upfile2','첨부파일2'),(387,'wiz_mini_bbs',NULL,'upfile3','첨부파일3'),(388,'wiz_mini_bbs',NULL,'upfile4','첨부파일4'),(389,'wiz_mini_bbs',NULL,'upfile5','첨부파일5'),(390,'wiz_mini_bbs',NULL,'upfile6','첨부파일6'),(391,'wiz_mini_bbs',NULL,'upfile7','첨부파일7'),(392,'wiz_mini_bbs',NULL,'upfile8','첨부파일8'),(393,'wiz_mini_bbs',NULL,'upfile9','첨부파일9'),(394,'wiz_mini_bbs',NULL,'upfile10','첨부파일10'),(395,'wiz_mini_bbs',NULL,'upfile11','첨부파일11'),(396,'wiz_mini_bbs',NULL,'upfile12','첨부파일12'),(397,'wiz_mini_bbs',NULL,'upfile1_name','첨부파일명1'),(398,'wiz_mini_bbs',NULL,'upfile2_name','첨부파일명2'),(399,'wiz_mini_bbs',NULL,'upfile3_name','첨부파일명3'),(400,'wiz_mini_bbs',NULL,'upfile4_name','첨부파일명4'),(401,'wiz_mini_bbs',NULL,'upfile5_name','첨부파일명5'),(402,'wiz_mini_bbs',NULL,'upfile6_name','첨부파일명6'),(403,'wiz_mini_bbs',NULL,'upfile7_name','첨부파일명7'),(404,'wiz_mini_bbs',NULL,'upfile8_name','첨부파일명8'),(405,'wiz_mini_bbs',NULL,'upfile9_name','첨부파일명9'),(406,'wiz_mini_bbs',NULL,'upfile10_name','첨부파일명10'),(407,'wiz_mini_bbs',NULL,'upfile11_name','첨부파일명11'),(408,'wiz_mini_bbs',NULL,'upfile12_name','첨부파일명12'),(409,'wiz_mini_bbs',NULL,'movie1','동영상1'),(410,'wiz_mini_bbs',NULL,'movie2','동영상2'),(411,'wiz_mini_bbs',NULL,'movie3','동영상3'),(412,'wiz_mini_bbs',NULL,'passwd','비밀번호'),(413,'wiz_mini_bbs',NULL,'count','조회수'),(414,'wiz_mini_bbs',NULL,'recom','추천수'),(415,'wiz_mini_bbs',NULL,'comment','코멘트수'),(416,'wiz_mini_bbs',NULL,'ip','IP '),(417,'wiz_mini_bbs',NULL,'wdate','작성일'),(418,'wiz_mini_bbs',NULL,'ucc_file','UCC 파일명 '),(419,'wiz_mini_bbs',NULL,'ucc_movie','UCC 동영상명'),(420,'wiz_mini_bbs',NULL,'ucc_img','UCC 썸네일명'),(421,'wiz_mini_bbs',NULL,'ucc_size','UCC 크기'),(422,'wiz_mini_bbs',NULL,'ucc_time','UCC 재생시간'),(423,'wiz_mini_bbs',NULL,'miniid','미니홈피 ID'),(424,'wiz_mini_bbscat','<b>미니홈피 게시판 카테고리 테이블</b>\r\n미니홈피 게시판 카테고리 테이블입니다.','anywiz',NULL),(425,'wiz_mini_bbscat',NULL,'idx','인덱스'),(426,'wiz_mini_bbscat',NULL,'gubun','카테고리형식(전체, 일반)'),(427,'wiz_mini_bbscat',NULL,'code','게시판코드'),(428,'wiz_mini_bbscat',NULL,'catname','카테고리명'),(429,'wiz_mini_bbscat',NULL,'catimg','메뉴이미지'),(430,'wiz_mini_bbscat',NULL,'catimg_over','메뉴 롤오버 이미지'),(431,'wiz_mini_bbscat',NULL,'caticon','아이콘'),(432,'wiz_mini_bbscat',NULL,'miniid','미니홈피 ID'),(433,'wiz_mini_comment','<b>미니홈피 코멘트 테이블</b>\r\n미니홈피 코멘트 테이블입니다.','anywiz',NULL),(434,'wiz_mini_comment',NULL,'idx','인덱스'),(435,'wiz_mini_comment',NULL,'ctype','코멘트 형식'),(436,'wiz_mini_comment',NULL,'code','게시판 코드'),(437,'wiz_mini_comment',NULL,'cidx','게시물 번호'),(438,'wiz_mini_comment',NULL,'star','선호도'),(439,'wiz_mini_comment',NULL,'memid','작성자 ID'),(440,'wiz_mini_comment',NULL,'name','이름'),(441,'wiz_mini_comment',NULL,'content','내용'),(442,'wiz_mini_comment',NULL,'passwd','비밀번호'),(443,'wiz_mini_comment',NULL,'wdate','작성일'),(444,'wiz_mini_comment',NULL,'ip','IP'),(445,'wiz_mini_comment',NULL,'miniid','미니홈피 ID'),(446,'wiz_mini_conrefer','<b>미니홈피 접속경로 테이블</b>\r\n미니홈피 접속경로 테이블입니다.','anywiz',NULL),(447,'wiz_mini_conrefer',NULL,'referer','접속경로 '),(448,'wiz_mini_conrefer',NULL,'host','접속HOST'),(449,'wiz_mini_conrefer',NULL,'wdate','접속일'),(450,'wiz_mini_conrefer',NULL,'cnt','접속자수'),(451,'wiz_mini_conrefer',NULL,'miniid','미니홈피 ID'),(452,'wiz_mini_contime','<b>미니홈피 접속자 테이블</b>\r\n미니홈피 접속자 테이블입니다.','anywiz',NULL),(453,'wiz_mini_contime',NULL,'time','접속시간'),(454,'wiz_mini_contime',NULL,'cnt','접속자수'),(455,'wiz_mini_contime',NULL,'miniid','미니홈피 ID'),(456,'wiz_mini_data','<b>미니홈피 자료실 테이블</b>\r\n미니홈피 자료실 테이블입니다.','anywiz',NULL),(457,'wiz_mini_data',NULL,'idx','인덱스'),(458,'wiz_mini_data',NULL,'code','게시판 코드'),(459,'wiz_mini_data',NULL,'prino','정렬값'),(460,'wiz_mini_data',NULL,'grpno','덧글그룹값'),(461,'wiz_mini_data',NULL,'depno','덧글깊이값'),(462,'wiz_mini_data',NULL,'notice','공지사항'),(463,'wiz_mini_data',NULL,'category','카테고리'),(464,'wiz_mini_data',NULL,'memid','글쓴이ID'),(465,'wiz_mini_data',NULL,'memgrp','덧글그룹ID'),(466,'wiz_mini_data',NULL,'name','이름'),(467,'wiz_mini_data',NULL,'email','이메일'),(468,'wiz_mini_data',NULL,'tphone','전화번호'),(469,'wiz_mini_data',NULL,'hphone','휴대전화번호'),(470,'wiz_mini_data',NULL,'zipcode','우편번호'),(471,'wiz_mini_data',NULL,'address','주소'),(472,'wiz_mini_data',NULL,'subject','제목'),(473,'wiz_mini_data',NULL,'content','내용'),(474,'wiz_mini_data',NULL,'addinfo1','추가정보1'),(475,'wiz_mini_data',NULL,'addinfo2','추가정보2'),(476,'wiz_mini_data',NULL,'addinfo3','추가정보3'),(477,'wiz_mini_data',NULL,'addinfo4','추가정보4'),(478,'wiz_mini_data',NULL,'addinfo5','추가정보5'),(479,'wiz_mini_data',NULL,'ctype','HTML 사용여부'),(480,'wiz_mini_data',NULL,'privacy','비밀글'),(481,'wiz_mini_data',NULL,'upfile1','첨부파일1'),(482,'wiz_mini_data',NULL,'upfile2','첨부파일2'),(483,'wiz_mini_data',NULL,'upfile3','첨부파일3'),(484,'wiz_mini_data',NULL,'upfile4','첨부파일4'),(485,'wiz_mini_data',NULL,'upfile5','첨부파일5'),(486,'wiz_mini_data',NULL,'upfile6','첨부파일6'),(487,'wiz_mini_data',NULL,'upfile7','첨부파일7'),(488,'wiz_mini_data',NULL,'upfile8','첨부파일8'),(489,'wiz_mini_data',NULL,'upfile9','첨부파일9'),(490,'wiz_mini_data',NULL,'upfile10','첨부파일10'),(491,'wiz_mini_data',NULL,'upfile11','첨부파일11'),(492,'wiz_mini_data',NULL,'upfile12','첨부파일12'),(493,'wiz_mini_data',NULL,'upfile1_name','첨부파일명1'),(494,'wiz_mini_data',NULL,'upfile2_name','첨부파일명2'),(495,'wiz_mini_data',NULL,'upfile3_name','첨부파일명3'),(496,'wiz_mini_data',NULL,'upfile4_name','첨부파일명4'),(497,'wiz_mini_data',NULL,'upfile5_name','첨부파일명5'),(498,'wiz_mini_data',NULL,'upfile6_name','첨부파일명6'),(499,'wiz_mini_data',NULL,'upfile7_name','첨부파일명7'),(500,'wiz_mini_data',NULL,'upfile8_name','첨부파일명8'),(501,'wiz_mini_data',NULL,'upfile9_name','첨부파일명9'),(502,'wiz_mini_data',NULL,'upfile10_name','첨부파일명10'),(503,'wiz_mini_data',NULL,'upfile11_name','첨부파일명11'),(504,'wiz_mini_data',NULL,'upfile12_name','첨부파일명12'),(505,'wiz_mini_data',NULL,'movie1','동영상1'),(506,'wiz_mini_data',NULL,'movie2','동영상2'),(507,'wiz_mini_data',NULL,'movie3','동영상3'),(508,'wiz_mini_data',NULL,'passwd','비밀번호'),(509,'wiz_mini_data',NULL,'count','조회수'),(510,'wiz_mini_data',NULL,'recom','추천수'),(511,'wiz_mini_data',NULL,'comment','코멘트수'),(512,'wiz_mini_data',NULL,'ip','IP'),(513,'wiz_mini_data',NULL,'wdate','작성일'),(514,'wiz_mini_data',NULL,'ucc_file','UCC 파일명 '),(515,'wiz_mini_data',NULL,'ucc_movie','UCC 동영상명'),(516,'wiz_mini_data',NULL,'ucc_img','UCC 썸네일명'),(517,'wiz_mini_data',NULL,'ucc_size','UCC 크기'),(518,'wiz_mini_data',NULL,'ucc_time','UCC 재생시간'),(519,'wiz_mini_data',NULL,'miniid','미니홈피 ID'),(520,'wiz_mini_friend','<b>미니홈피 친구 테이블</b>\r\n미니홈피 친구 테이블입니다.','anywiz',NULL),(521,'wiz_mini_friend',NULL,'idx','인덱스'),(522,'wiz_mini_friend',NULL,'myid','자신의 ID'),(523,'wiz_mini_friend',NULL,'mynick','자신의 닉네임'),(524,'wiz_mini_friend',NULL,'frdid','친구의 ID'),(525,'wiz_mini_friend',NULL,'frdnick','친구의 닉네임'),(526,'wiz_mini_friend',NULL,'message','친구요청 메세지'),(527,'wiz_mini_friend',NULL,'status','승인여부'),(528,'wiz_mini_friend',NULL,'wdate','요청일'),(529,'wiz_mini_guest','<b>미니홈피 방명록 테이블</b>\r\n미니홈피 방명록 테이블입니다.','anywiz',NULL),(530,'wiz_mini_guest',NULL,'idx','인덱스'),(531,'wiz_mini_guest',NULL,'code','게시판코드'),(532,'wiz_mini_guest',NULL,'prino','정렬값'),(533,'wiz_mini_guest',NULL,'grpno','덧글그룹값'),(534,'wiz_mini_guest',NULL,'depno','덧글깊이값'),(535,'wiz_mini_guest',NULL,'notice','공지사항'),(536,'wiz_mini_guest',NULL,'category','카테고리'),(537,'wiz_mini_guest',NULL,'memid','글쓴이ID'),(538,'wiz_mini_guest',NULL,'memgrp','덧글그룹ID'),(539,'wiz_mini_guest',NULL,'name','작성자'),(540,'wiz_mini_guest',NULL,'email','이메일'),(541,'wiz_mini_guest',NULL,'tphone','전화번호'),(542,'wiz_mini_guest',NULL,'hphone','휴대전화번호'),(543,'wiz_mini_guest',NULL,'zipcode','우편번호'),(544,'wiz_mini_guest',NULL,'address','주소'),(545,'wiz_mini_guest',NULL,'subject','제목'),(546,'wiz_mini_guest',NULL,'content','내용'),(547,'wiz_mini_guest',NULL,'addinfo1','추가정보1'),(548,'wiz_mini_guest',NULL,'addinfo2','추가정보2'),(549,'wiz_mini_guest',NULL,'addinfo3','추가정보3'),(550,'wiz_mini_guest',NULL,'addinfo4','추가정보4'),(551,'wiz_mini_guest',NULL,'addinfo5','추가정보5'),(552,'wiz_mini_guest',NULL,'ctype','HTML 사용여부'),(553,'wiz_mini_guest',NULL,'privacy','비밀글'),(554,'wiz_mini_guest',NULL,'upfile1','첨부파일1'),(555,'wiz_mini_guest',NULL,'upfile2','첨부파일2'),(556,'wiz_mini_guest',NULL,'upfile3','첨부파일3'),(557,'wiz_mini_guest',NULL,'upfile4','첨부파일4'),(558,'wiz_mini_guest',NULL,'upfile5','첨부파일5'),(559,'wiz_mini_guest',NULL,'upfile6','첨부파일6'),(560,'wiz_mini_guest',NULL,'upfile7','첨부파일7'),(561,'wiz_mini_guest',NULL,'upfile8','첨부파일8'),(562,'wiz_mini_guest',NULL,'upfile9','첨부파일9'),(563,'wiz_mini_guest',NULL,'upfile10','첨부파일10'),(564,'wiz_mini_guest',NULL,'upfile11','첨부파일11'),(565,'wiz_mini_guest',NULL,'upfile12','첨부파일12'),(566,'wiz_mini_guest',NULL,'upfile1_name','첨부파일명1'),(567,'wiz_mini_guest',NULL,'upfile2_name','첨부파일명2'),(568,'wiz_mini_guest',NULL,'upfile3_name','첨부파일명3'),(569,'wiz_mini_guest',NULL,'upfile4_name','첨부파일명4'),(570,'wiz_mini_guest',NULL,'upfile5_name','첨부파일명5'),(571,'wiz_mini_guest',NULL,'upfile6_name','첨부파일명6'),(572,'wiz_mini_guest',NULL,'upfile7_name','첨부파일명7'),(573,'wiz_mini_guest',NULL,'upfile8_name','첨부파일명8'),(574,'wiz_mini_guest',NULL,'upfile9_name','첨부파일명9'),(575,'wiz_mini_guest',NULL,'upfile10_name','첨부파일명10'),(576,'wiz_mini_guest',NULL,'upfile11_name','첨부파일명11'),(577,'wiz_mini_guest',NULL,'upfile12_name','첨부파일명12'),(578,'wiz_mini_guest',NULL,'movie1','동영상1'),(579,'wiz_mini_guest',NULL,'movie2','동영상2'),(580,'wiz_mini_guest',NULL,'movie3','동영상3'),(581,'wiz_mini_guest',NULL,'passwd','비밀번호'),(582,'wiz_mini_guest',NULL,'count','조회수'),(583,'wiz_mini_guest',NULL,'recom','추천수'),(584,'wiz_mini_guest',NULL,'comment','코멘트수'),(585,'wiz_mini_guest',NULL,'ip','IP'),(586,'wiz_mini_guest',NULL,'wdate','작성일'),(587,'wiz_mini_guest',NULL,'ucc_file','UCC 파일명'),(588,'wiz_mini_guest',NULL,'ucc_movie','UCC 동영상명'),(589,'wiz_mini_guest',NULL,'ucc_img','UCC 썸네일명'),(590,'wiz_mini_guest',NULL,'ucc_size','UCC 크기'),(591,'wiz_mini_guest',NULL,'ucc_time','UCC 재생시간'),(592,'wiz_mini_guest',NULL,'miniid','미니홈피 ID'),(593,'wiz_mini_info','<b>미니홈피 정보 테이블</b>\r\n미니홈피 정보 테이블입니다.','anywiz',NULL),(594,'wiz_mini_info',NULL,'idx','인덱스'),(595,'wiz_mini_info',NULL,'memid','아이디'),(596,'wiz_mini_info',NULL,'title','미니홈피명'),(597,'wiz_mini_info',NULL,'photo','사진'),(598,'wiz_mini_info',NULL,'miniurl','URL'),(599,'wiz_mini_info',NULL,'skin','스킨'),(600,'wiz_mini_info',NULL,'searchkey','검색어'),(601,'wiz_mini_info',NULL,'info','소개글'),(602,'wiz_mini_info',NULL,'best','베스트 미니홈피'),(603,'wiz_mini_info',NULL,'privacy','미니홈피 공개여부'),(604,'wiz_mini_info',NULL,'birthday_privacy','생년월일 공개여부'),(605,'wiz_mini_info',NULL,'email_pricacy','이메일 공개여부'),(606,'wiz_mini_info',NULL,'tphone_privacy','전화번호 공개여부'),(607,'wiz_mini_info',NULL,'hphone_privacy','휴대전화번호 공개여부'),(608,'wiz_mini_info',NULL,'address_privacy','주소 공개여부'),(609,'wiz_mini_info',NULL,'menu_use','메뉴 사용여부'),(610,'wiz_mini_info',NULL,'bbs_permi','게시판 덧글권한'),(611,'wiz_mini_info',NULL,'data_permi','자료실 덧글권한'),(612,'wiz_mini_info',NULL,'photo_permi','갤러리 덧글권한'),(613,'wiz_mini_info',NULL,'movie_permi','동영상 덧글권한'),(614,'wiz_mini_info',NULL,'guest_permi','방명록 덧글권한'),(615,'wiz_mini_info',NULL,'wdate','생성일'),(616,'wiz_mini_movie','<b>미니홈피 동영상 테이블</b>\r\n미니홈피 동영상 테이블입니다.','anywiz',NULL),(617,'wiz_mini_movie',NULL,'idx','인덱스'),(618,'wiz_mini_movie',NULL,'code','게시판 코드'),(619,'wiz_mini_movie',NULL,'prino','정렬값'),(620,'wiz_mini_movie',NULL,'grpno','덧글그룹값'),(621,'wiz_mini_movie',NULL,'depno','덧글깊이값'),(622,'wiz_mini_movie',NULL,'notice','공지사항'),(623,'wiz_mini_movie',NULL,'category','카테고리'),(624,'wiz_mini_movie',NULL,'memid','글쓴이ID'),(625,'wiz_mini_movie',NULL,'memgrp','덧글그룹ID'),(626,'wiz_mini_movie',NULL,'name','작성자'),(627,'wiz_mini_movie',NULL,'email','이메일'),(628,'wiz_mini_movie',NULL,'tphone','전화번호'),(629,'wiz_mini_movie',NULL,'hphone','휴대전화번호'),(630,'wiz_mini_movie',NULL,'zipcode','우편번호'),(631,'wiz_mini_movie',NULL,'address','주소'),(632,'wiz_mini_movie',NULL,'subject','제목'),(633,'wiz_mini_movie',NULL,'content','내용'),(634,'wiz_mini_movie',NULL,'addinfo1','추가정보1'),(635,'wiz_mini_movie',NULL,'addinfo2','추가정보2'),(636,'wiz_mini_movie',NULL,'addinfo3','추가정보3'),(637,'wiz_mini_movie',NULL,'addinfo4','추가정보4'),(638,'wiz_mini_movie',NULL,'addinfo5','추가정보5'),(639,'wiz_mini_movie',NULL,'ctype','HTML 사용여부'),(640,'wiz_mini_movie',NULL,'privacy','비밀글'),(641,'wiz_mini_movie',NULL,'upfile1','첨부파일1'),(642,'wiz_mini_movie',NULL,'upfile2','첨부파일2'),(643,'wiz_mini_movie',NULL,'upfile3','첨부파일3'),(644,'wiz_mini_movie',NULL,'upfile4','첨부파일4'),(645,'wiz_mini_movie',NULL,'upfile5','첨부파일5'),(646,'wiz_mini_movie',NULL,'upfile6','첨부파일6'),(647,'wiz_mini_movie',NULL,'upfile7','첨부파일7'),(648,'wiz_mini_movie',NULL,'upfile8','첨부파일8'),(649,'wiz_mini_movie',NULL,'upfile9','첨부파일9'),(650,'wiz_mini_movie',NULL,'upfile10','첨부파일10'),(651,'wiz_mini_movie',NULL,'upfile11','첨부파일11'),(652,'wiz_mini_movie',NULL,'upfile12','첨부파일12'),(653,'wiz_mini_movie',NULL,'upfile1_name','첨부파일명1'),(654,'wiz_mini_movie',NULL,'upfile2_name','첨부파일명2'),(655,'wiz_mini_movie',NULL,'upfile3_name','첨부파일명3'),(656,'wiz_mini_movie',NULL,'upfile4_name','첨부파일명4'),(657,'wiz_mini_movie',NULL,'upfile5_name','첨부파일명5'),(658,'wiz_mini_movie',NULL,'upfile6_name','첨부파일명6'),(659,'wiz_mini_movie',NULL,'upfile7_name','첨부파일명7'),(660,'wiz_mini_movie',NULL,'upfile8_name','첨부파일명8'),(661,'wiz_mini_movie',NULL,'upfile9_name','첨부파일명9'),(662,'wiz_mini_movie',NULL,'upfile10_name','첨부파일명10'),(663,'wiz_mini_movie',NULL,'upfile11_name','첨부파일명11'),(664,'wiz_mini_movie',NULL,'upfile12_name','첨부파일명12'),(665,'wiz_mini_movie',NULL,'movie1','동영상1'),(666,'wiz_mini_movie',NULL,'movie2','동영상2'),(667,'wiz_mini_movie',NULL,'movie3','동영상3'),(668,'wiz_mini_movie',NULL,'passwd','비밀번호'),(669,'wiz_mini_movie',NULL,'count','조회수'),(670,'wiz_mini_movie',NULL,'recom','추천수'),(671,'wiz_mini_movie',NULL,'comment','코멘트수'),(672,'wiz_mini_movie',NULL,'ip','IP'),(673,'wiz_mini_movie',NULL,'wdate','작성일'),(674,'wiz_mini_movie',NULL,'ucc_file','UCC 파일명'),(675,'wiz_mini_movie',NULL,'ucc_movie','UCC 동영상명'),(676,'wiz_mini_movie',NULL,'ucc_img','UCC 썸네일명'),(677,'wiz_mini_movie',NULL,'ucc_size','UCC 크기'),(678,'wiz_mini_movie',NULL,'ucc_time','UCC 재생시간'),(679,'wiz_mini_movie',NULL,'miniid','미니홈피 ID'),(680,'wiz_mini_movie','<b>미니홈피 동영상 테이블</b>\r\n미니홈피 동영상 테이블입니다.','anywiz',NULL),(681,'wiz_mini_movie',NULL,'idx','인덱스'),(682,'wiz_mini_movie',NULL,'code','게시판 코드'),(683,'wiz_mini_movie',NULL,'prino','정렬값'),(684,'wiz_mini_movie',NULL,'grpno','덧글그룹값'),(685,'wiz_mini_movie',NULL,'depno','덧글깊이값'),(686,'wiz_mini_movie',NULL,'notice','공지사항'),(687,'wiz_mini_movie',NULL,'category','카테고리'),(688,'wiz_mini_movie',NULL,'memid','글쓴이ID'),(689,'wiz_mini_movie',NULL,'memgrp','덧글그룹ID'),(690,'wiz_mini_movie',NULL,'name','작성자'),(691,'wiz_mini_movie',NULL,'email','이메일'),(692,'wiz_mini_movie',NULL,'tphone','전화번호'),(693,'wiz_mini_movie',NULL,'hphone','휴대전화번호'),(694,'wiz_mini_movie',NULL,'zipcode','우편번호'),(695,'wiz_mini_movie',NULL,'address','주소'),(696,'wiz_mini_movie',NULL,'subject','제목'),(697,'wiz_mini_movie',NULL,'content','내용'),(698,'wiz_mini_movie',NULL,'addinfo1','추가정보1'),(699,'wiz_mini_movie',NULL,'addinfo2','추가정보2'),(700,'wiz_mini_movie',NULL,'addinfo3','추가정보3'),(701,'wiz_mini_movie',NULL,'addinfo4','추가정보4'),(702,'wiz_mini_movie',NULL,'addinfo5','추가정보5'),(703,'wiz_mini_movie',NULL,'ctype','HTML 사용여부'),(704,'wiz_mini_movie',NULL,'privacy','비밀글'),(705,'wiz_mini_movie',NULL,'upfile1','첨부파일1'),(706,'wiz_mini_movie',NULL,'upfile2','첨부파일2'),(707,'wiz_mini_movie',NULL,'upfile3','첨부파일3'),(708,'wiz_mini_movie',NULL,'upfile4','첨부파일4'),(709,'wiz_mini_movie',NULL,'upfile5','첨부파일5'),(710,'wiz_mini_movie',NULL,'upfile6','첨부파일6'),(711,'wiz_mini_movie',NULL,'upfile7','첨부파일7'),(712,'wiz_mini_movie',NULL,'upfile8','첨부파일8'),(713,'wiz_mini_movie',NULL,'upfile9','첨부파일9'),(714,'wiz_mini_movie',NULL,'upfile10','첨부파일10'),(715,'wiz_mini_movie',NULL,'upfile11','첨부파일11'),(716,'wiz_mini_movie',NULL,'upfile12','첨부파일12'),(717,'wiz_mini_movie',NULL,'upfile1_name','첨부파일명1'),(718,'wiz_mini_movie',NULL,'upfile2_name','첨부파일명2'),(719,'wiz_mini_movie',NULL,'upfile3_name','첨부파일명3'),(720,'wiz_mini_movie',NULL,'upfile4_name','첨부파일명4'),(721,'wiz_mini_movie',NULL,'upfile5_name','첨부파일명5'),(722,'wiz_mini_movie',NULL,'upfile6_name','첨부파일명6'),(723,'wiz_mini_movie',NULL,'upfile7_name','첨부파일명7'),(724,'wiz_mini_movie',NULL,'upfile8_name','첨부파일명8'),(725,'wiz_mini_movie',NULL,'upfile9_name','첨부파일명9'),(726,'wiz_mini_movie',NULL,'upfile10_name','첨부파일명10'),(727,'wiz_mini_movie',NULL,'upfile11_name','첨부파일명11'),(728,'wiz_mini_movie',NULL,'upfile12_name','첨부파일명12'),(729,'wiz_mini_movie',NULL,'movie1','동영상1'),(730,'wiz_mini_movie',NULL,'movie2','동영상2'),(731,'wiz_mini_movie',NULL,'movie3','동영상3'),(732,'wiz_mini_movie',NULL,'passwd','비밀번호'),(733,'wiz_mini_movie',NULL,'count','조회수'),(734,'wiz_mini_movie',NULL,'recom','추천수'),(735,'wiz_mini_movie',NULL,'comment','코멘트수'),(736,'wiz_mini_movie',NULL,'ip','IP'),(737,'wiz_mini_movie',NULL,'wdate','작성일'),(738,'wiz_mini_movie',NULL,'ucc_file','UCC 파일명'),(739,'wiz_mini_movie',NULL,'ucc_movie','UCC 동영상명'),(740,'wiz_mini_movie',NULL,'ucc_img','UCC 썸네일명'),(741,'wiz_mini_movie',NULL,'ucc_size','UCC 크기'),(742,'wiz_mini_movie',NULL,'ucc_time','UCC 재생시간'),(743,'wiz_mini_movie',NULL,'miniid','미니홈피 ID'),(744,'wiz_mini_music','<b>미니홈피 음악 테이블</b>\r\n미니홈피 음악 테이블입니다.','anywiz',NULL),(745,'wiz_mini_music',NULL,'idx','인덱스'),(746,'wiz_mini_music',NULL,'miniid','미니홈피 ID'),(747,'wiz_mini_music',NULL,'title','곡명'),(748,'wiz_mini_music',NULL,'artist','아티스트'),(749,'wiz_mini_music',NULL,'upfile','음악파일'),(750,'wiz_mini_music',NULL,'words','가사'),(751,'wiz_mini_music',NULL,'wdate','작성일'),(752,'wiz_mini_photo','<b>미니홈피 갤러리 테이블</b>\r\n미니홈피 갤러리 테이블입니다.','anywiz',NULL),(753,'wiz_mini_photo',NULL,'idx','인덱스'),(754,'wiz_mini_photo',NULL,'code','게시판 코드'),(755,'wiz_mini_photo',NULL,'prino','정렬값'),(756,'wiz_mini_photo',NULL,'grpno','덧글그룹값'),(757,'wiz_mini_photo',NULL,'depno','덧글깊이값'),(758,'wiz_mini_photo',NULL,'notice','공지사항'),(759,'wiz_mini_photo',NULL,'category','카테고리'),(760,'wiz_mini_photo',NULL,'memid','글쓴이ID'),(761,'wiz_mini_photo',NULL,'memgrp','덧글그룹ID'),(762,'wiz_mini_photo',NULL,'name','작성자'),(763,'wiz_mini_photo',NULL,'email','이메일'),(764,'wiz_mini_photo',NULL,'tphone','전화번호'),(765,'wiz_mini_photo',NULL,'hphone','휴대전화번호'),(766,'wiz_mini_photo',NULL,'zipcode','우편번호'),(767,'wiz_mini_photo',NULL,'address','주소'),(768,'wiz_mini_photo',NULL,'subject','제목'),(769,'wiz_mini_photo',NULL,'content','내용'),(770,'wiz_mini_photo',NULL,'addinfo1','추가정보1'),(771,'wiz_mini_photo',NULL,'addinfo2','추가정보2'),(772,'wiz_mini_photo',NULL,'addinfo3','추가정보3'),(773,'wiz_mini_photo',NULL,'addinfo4','추가정보4'),(774,'wiz_mini_photo',NULL,'addinfo5','추가정보5'),(775,'wiz_mini_photo',NULL,'ctype','HTML 사용여부'),(776,'wiz_mini_photo',NULL,'privacy','비밀글'),(777,'wiz_mini_photo',NULL,'upfile1','첨부파일1'),(778,'wiz_mini_photo',NULL,'upfile2','첨부파일2'),(779,'wiz_mini_photo',NULL,'upfile3','첨부파일3'),(780,'wiz_mini_photo',NULL,'upfile4','첨부파일4'),(781,'wiz_mini_photo',NULL,'upfile5','첨부파일5'),(782,'wiz_mini_photo',NULL,'upfile6','첨부파일6'),(783,'wiz_mini_photo',NULL,'upfile7','첨부파일7'),(784,'wiz_mini_photo',NULL,'upfile8','첨부파일8'),(785,'wiz_mini_photo',NULL,'upfile9','첨부파일9'),(786,'wiz_mini_photo',NULL,'upfile10','첨부파일10'),(787,'wiz_mini_photo',NULL,'upfile11','첨부파일11'),(788,'wiz_mini_photo',NULL,'upfile12','첨부파일12'),(789,'wiz_mini_photo',NULL,'upfile1_name','첨부파일명1'),(790,'wiz_mini_photo',NULL,'upfile2_name','첨부파일명2'),(791,'wiz_mini_photo',NULL,'upfile3_name','첨부파일명3'),(792,'wiz_mini_photo',NULL,'upfile4_name','첨부파일명4'),(793,'wiz_mini_photo',NULL,'upfile5_name','첨부파일명5'),(794,'wiz_mini_photo',NULL,'upfile6_name','첨부파일명6'),(795,'wiz_mini_photo',NULL,'upfile7_name','첨부파일명7'),(796,'wiz_mini_photo',NULL,'upfile8_name','첨부파일명8'),(797,'wiz_mini_photo',NULL,'upfile9_name','첨부파일명9'),(798,'wiz_mini_photo',NULL,'upfile10_name','첨부파일명10'),(799,'wiz_mini_photo',NULL,'upfile11_name','첨부파일명11'),(800,'wiz_mini_photo',NULL,'upfile12_name','첨부파일명12'),(801,'wiz_mini_photo',NULL,'movie1','동영상1'),(802,'wiz_mini_photo',NULL,'movie2','동영상2'),(803,'wiz_mini_photo',NULL,'movie3','동영상3'),(804,'wiz_mini_photo',NULL,'passwd','비밀번호'),(805,'wiz_mini_photo',NULL,'count','조회수'),(806,'wiz_mini_photo',NULL,'recom','추천수'),(807,'wiz_mini_photo',NULL,'comment','코멘트수'),(808,'wiz_mini_photo',NULL,'ip','IP'),(809,'wiz_mini_photo',NULL,'wdate','작성일'),(810,'wiz_mini_photo',NULL,'ucc_file','UCC 파일명'),(811,'wiz_mini_photo',NULL,'ucc_movie','UCC 동영상명'),(812,'wiz_mini_photo',NULL,'ucc_img','UCC 썸네일명'),(813,'wiz_mini_photo',NULL,'ucc_size','UCC 크기'),(814,'wiz_mini_photo',NULL,'ucc_time','UCC 재생시간'),(815,'wiz_mini_photo',NULL,'miniid','미니홈피 ID'),(816,'wiz_mini_profile','<b>미니홈피 내소개 테이블</b>\r\n미니홈피 내소개 테이블입니다.','anywiz',NULL),(817,'wiz_mini_profile',NULL,'idx','인덱스'),(818,'wiz_mini_profile',NULL,'miniid','미니홈피 ID'),(819,'wiz_mini_profile',NULL,'content','내용'),(820,'wiz_mini_profile',NULL,'wdate','작성일'),(821,'wiz_mini_skin','<b>미니홈피 스킨 테이블</b>\r\n미니홈피 스킨 테이블입니다.','anywiz',NULL),(822,'wiz_mini_skin',NULL,'idx','인덱스'),(823,'wiz_mini_skin',NULL,'title','스킨명'),(824,'wiz_mini_skin',NULL,'thumb','썸네일 이미지'),(825,'wiz_mini_skin',NULL,'skin','스킨 이미지'),(826,'wiz_mini_skin',NULL,'miniid','미니홈피 ID'),(827,'wiz_otherinfo','<b>기타정보 테이블</b>\r\n기타정보 테이블입니다.','anywiz',NULL),(828,'wiz_otherinfo',NULL,'idx','인덱스'),(829,'wiz_otherinfo',NULL,'type','입력형식'),(830,'wiz_otherinfo',NULL,'info01','추가정보1'),(831,'wiz_otherinfo',NULL,'info02','추가정보2'),(832,'wiz_otherinfo',NULL,'info03','추가정보3'),(833,'wiz_otherinfo',NULL,'info04','추가정보4'),(834,'wiz_otherinfo',NULL,'info05','추가정보5'),(835,'wiz_otherinfo',NULL,'info06','추가정보6'),(836,'wiz_otherinfo',NULL,'info07','추가정보7'),(837,'wiz_otherinfo',NULL,'info08','추가정보8'),(838,'wiz_otherinfo',NULL,'info09','추가정보9'),(839,'wiz_otherinfo',NULL,'info10','추가정보10'),(840,'wiz_page','<b>페이지 테이블</b>\r\n페이지 테이블입니다.','anywiz',NULL),(841,'wiz_page',NULL,'idx','인덱스'),(842,'wiz_page',NULL,'code','페이지 코드'),(843,'wiz_page',NULL,'title','페이지명'),(844,'wiz_page',NULL,'menu','메뉴'),(845,'wiz_page',NULL,'url','페이지URL'),(846,'wiz_page',NULL,'level','페이지 등급'),(847,'wiz_page',NULL,'content','페이지 내용'),(848,'wiz_page',NULL,'wdate','작성일'),(849,'wiz_point','<b>포인트 테이블</b>\r\n포인트 테이블입니다.','anywiz',NULL),(850,'wiz_point',NULL,'idx','인덱스'),(851,'wiz_point',NULL,'bidx','게시판 번호'),(852,'wiz_point',NULL,'cidx','코멘트 번호'),(853,'wiz_point',NULL,'midx','쪽지 번호'),(854,'wiz_point',NULL,'ptype','포인트 형식'),(855,'wiz_point',NULL,'mode','게시판 모드'),(856,'wiz_point',NULL,'memid','회원 ID'),(857,'wiz_point',NULL,'point','포인트'),(858,'wiz_point',NULL,'memo','포인트 내용'),(859,'wiz_point',NULL,'wdate','포인트 적립일'),(860,'wiz_poll','<b>설문조사 테이블</b>\r\n설문조사 테이블입니다.','anywiz',NULL),(861,'wiz_poll',NULL,'idx','인덱스'),(862,'wiz_poll',NULL,'code','설문코드'),(863,'wiz_poll',NULL,'polluse','진행여부'),(864,'wiz_poll',NULL,'pollmain','메인추출여부'),(865,'wiz_poll',NULL,'sdate','진행시작일'),(866,'wiz_poll',NULL,'edate','진행종료일'),(867,'wiz_poll',NULL,'apermi','참여 권한'),(868,'wiz_poll',NULL,'cpermi','코멘트작성 권한'),(869,'wiz_poll',NULL,'subject','설문명'),(870,'wiz_poll',NULL,'content','설문내용'),(871,'wiz_poll',NULL,'wdate','작성일'),(872,'wiz_poll',NULL,'cnt','참여자수'),(873,'wiz_polldata','<b>설문내용 테이블</b>\r\n설문내용 테이블입니다.','anywiz',NULL),(874,'wiz_polldata',NULL,'idx','인덱스'),(875,'wiz_polldata',NULL,'pidx','설문조사 번호'),(876,'wiz_polldata',NULL,'question','질문'),(877,'wiz_polldata',NULL,'answer01','답변1'),(878,'wiz_polldata',NULL,'count01','참여자수1'),(879,'wiz_polldata',NULL,'answer02','답변2'),(880,'wiz_polldata',NULL,'count02','참여자수2'),(881,'wiz_polldata',NULL,'answer03','답변3'),(882,'wiz_polldata',NULL,'count03','참여자수3'),(883,'wiz_polldata',NULL,'answer04','답변4'),(884,'wiz_polldata',NULL,'count04','참여자수4'),(885,'wiz_polldata',NULL,'answer05','답변5'),(886,'wiz_polldata',NULL,'count05','참여자수5'),(887,'wiz_polldata',NULL,'answer06','답변6'),(888,'wiz_polldata',NULL,'count06','참여자수6'),(889,'wiz_polldata',NULL,'answer07','답변7'),(890,'wiz_polldata',NULL,'count07','참여자수7'),(891,'wiz_polldata',NULL,'answer08','답변8'),(892,'wiz_polldata',NULL,'count08','참여자수8'),(893,'wiz_polldata',NULL,'answer09','답변9'),(894,'wiz_polldata',NULL,'count09','참여자수9'),(895,'wiz_polldata',NULL,'answer10','답변10'),(896,'wiz_polldata',NULL,'count10','참여자수10'),(897,'wiz_pollinfo','<b>설문조사 정보 테이블</b>\r\n설문조사 정보 테이블입니다.','anywiz',NULL),(898,'wiz_pollinfo',NULL,'code','설문코드'),(899,'wiz_pollinfo',NULL,'title','설문명'),(900,'wiz_pollinfo',NULL,'lpermi','목록보기 권한'),(901,'wiz_pollinfo',NULL,'rpermi','내용보기 권한'),(902,'wiz_pollinfo',NULL,'apermi','설문참여 권한'),(903,'wiz_pollinfo',NULL,'cpermi','코멘트쓰기 권한'),(904,'wiz_pollinfo',NULL,'skin','스킨'),(905,'wiz_pollinfo',NULL,'permsg','권한이 없을 경우 경고 메세지'),(906,'wiz_pollinfo',NULL,'perurl','권한이 없을 경우 이동페이지'),(907,'wiz_pollinfo',NULL,'mainskin','메인추출 스킨'),(908,'wiz_pollinfo',NULL,'purl','연결페이지'),(909,'wiz_pollinfo',NULL,'wdate','작성일'),(910,'wiz_popup','<b>팝업 테이블</b>\r\n팝업 테이블입니다.','anywiz',NULL),(911,'wiz_popup',NULL,'idx','인덱스'),(912,'wiz_popup',NULL,'isuse','사용여부'),(913,'wiz_popup',NULL,'scroll','스크롤여부'),(914,'wiz_popup',NULL,'posi_x','좌측 위치'),(915,'wiz_popup',NULL,'posi_y','상단 위치'),(916,'wiz_popup',NULL,'size_x','가로 크기'),(917,'wiz_popup',NULL,'size_y','세로 크기'),(918,'wiz_popup',NULL,'sdate','게시기간 시작일'),(919,'wiz_popup',NULL,'edate','게시기간 종료일'),(920,'wiz_popup',NULL,'linkurl','링크주소'),(921,'wiz_popup',NULL,'popup_type','팝업형태'),(922,'wiz_popup',NULL,'title','제목'),(923,'wiz_popup',NULL,'content','팝업내용'),(924,'wiz_popup',NULL,'wdate','작성일'),(925,'wiz_prdinfo','<b>상품정보 테이블</b>\r\n상품정보 테이블입니다.','anywiz',NULL),(926,'wiz_prdinfo',NULL,'skin','스킨'),(927,'wiz_prdinfo',NULL,'wdate','작성일'),(928,'wiz_prdinfo',NULL,'purl','연결페이지'),(929,'wiz_prdinfo',NULL,'prdcnt','상품수'),(930,'wiz_prdinfo',NULL,'prdline','줄바꿈 상품수'),(931,'wiz_prdinfo',NULL,'maintype','추출상품 형태'),(932,'wiz_prdinfo',NULL,'mainskin','상품메인스킨'),(933,'wiz_prdinfo',NULL,'prdname_len','상품명 글자수'),(934,'wiz_prdmain','<b>상품 메인추출 테이블</b>\r\n상품 메인추출 테이블입니다.','anywiz',NULL),(935,'wiz_prdmain',NULL,'idx','인덱스'),(936,'wiz_prdmain',NULL,'prdcnt','상품수'),(937,'wiz_prdmain',NULL,'prdline','줄바꿈 상품수'),(938,'wiz_prdmain',NULL,'maintype','추출상품 형태'),(939,'wiz_prdmain',NULL,'mainskin','상품메인스킨'),(940,'wiz_prdmain',NULL,'prdname_len','상품명 글자수'),(941,'wiz_prdmain',NULL,'prdexp_len','간단설명 글자수'),(942,'wiz_product','<b>상품 테이블</b>\r\n상품 테이블입니다.','anywiz',NULL),(943,'wiz_product',NULL,'prdcode','상품코드'),(944,'wiz_product',NULL,'prdnum','상품번호'),(945,'wiz_product',NULL,'prdname','상품명'),(946,'wiz_product',NULL,'prdprice','상품가격'),(947,'wiz_product',NULL,'showset','진열여부'),(948,'wiz_product',NULL,'prior','진열순서'),(949,'wiz_product',NULL,'prdicon','아이콘'),(950,'wiz_product',NULL,'recom','추천상품'),(951,'wiz_product',NULL,'info_name1','상품정보 이름1'),(952,'wiz_product',NULL,'info_value1','상품정보 내용1'),(953,'wiz_product',NULL,'info_name2','상품정보 이름2'),(954,'wiz_product',NULL,'info_value2','상품정보 내용2'),(955,'wiz_product',NULL,'info_name3','상품정보 이름3'),(956,'wiz_product',NULL,'info_value3','상품정보 내용3'),(957,'wiz_product',NULL,'info_name4','상품정보 이름4'),(958,'wiz_product',NULL,'info_value4','상품정보 내용4'),(959,'wiz_product',NULL,'info_name5','상품정보 이름5'),(960,'wiz_product',NULL,'info_value5','상품정보 내용5'),(961,'wiz_product',NULL,'info_name6','상품정보 이름6'),(962,'wiz_product',NULL,'info_value6','상품정보 내용6'),(963,'wiz_product',NULL,'info_name7','상품정보 이름7'),(964,'wiz_product',NULL,'info_value7','상품정보 내용7'),(965,'wiz_product',NULL,'info_name8','상품정보 이름8'),(966,'wiz_product',NULL,'info_value8','상품정보 내용8'),(967,'wiz_product',NULL,'info_name9','상품정보 이름9'),(968,'wiz_product',NULL,'info_value9','상품정보 내용9'),(969,'wiz_product',NULL,'info_name10','상품정보 이름10'),(970,'wiz_product',NULL,'info_value10','상품정보 내용10'),(971,'wiz_product',NULL,'addinfo1','추가정보1 '),(972,'wiz_product',NULL,'addinfo2','추가정보2'),(973,'wiz_product',NULL,'addinfo3','추가정보3'),(974,'wiz_product',NULL,'addinfo4','추가정보4'),(975,'wiz_product',NULL,'addinfo5','추가정보5'),(976,'wiz_product',NULL,'prdimg_R','상품목록 이미지'),(977,'wiz_product',NULL,'prdimg_L1','확대보기 이미지1'),(978,'wiz_product',NULL,'prdimg_M1','제품상세 이미지1'),(979,'wiz_product',NULL,'prdimg_S1','축소 이미지1'),(980,'wiz_product',NULL,'prdimg_L2','확대보기 이미지2'),(981,'wiz_product',NULL,'prdimg_M2','제품상세 이미지2'),(982,'wiz_product',NULL,'prdimg_S2','축소 이미지2'),(983,'wiz_product',NULL,'prdimg_L3','확대보기 이미지3'),(984,'wiz_product',NULL,'prdimg_M3','제품상세 이미지3'),(985,'wiz_product',NULL,'prdimg_S3','축소 이미지3'),(986,'wiz_product',NULL,'prdimg_L4','확대보기 이미지4'),(987,'wiz_product',NULL,'prdimg_M4','제품상세 이미지4'),(988,'wiz_product',NULL,'prdimg_S4','축소 이미지4'),(989,'wiz_product',NULL,'prdimg_L5','확대보기 이미지5'),(990,'wiz_product',NULL,'prdimg_M5','제품상세 이미지5'),(991,'wiz_product',NULL,'prdimg_S5','축소 이미지5'),(992,'wiz_product',NULL,'prdimg_L6','확대보기 이미지6'),(993,'wiz_product',NULL,'prdimg_M6','제품상세 이미지6'),(994,'wiz_product',NULL,'prdimg_S6','축소 이미지6'),(995,'wiz_product',NULL,'prdimg_L7','확대보기 이미지7'),(996,'wiz_product',NULL,'prdimg_M7','제품상세 이미지7'),(997,'wiz_product',NULL,'prdimg_S7','축소 이미지7'),(998,'wiz_product',NULL,'prdimg_L8','확대보기 이미지8'),(999,'wiz_product',NULL,'prdimg_M8','제품상세 이미지8'),(1000,'wiz_product',NULL,'prdimg_S8','축소 이미지8'),(1001,'wiz_product',NULL,'prdimg_L9','확대보기 이미지9'),(1002,'wiz_product',NULL,'prdimg_M9','제품상세 이미지9'),(1003,'wiz_product',NULL,'prdimg_S9','축소 이미지9'),(1004,'wiz_product',NULL,'prdimg_L10','확대보기 이미지10'),(1005,'wiz_product',NULL,'prdimg_M10','제품상세 이미지10'),(1006,'wiz_product',NULL,'prdimg_S10','축소 이미지10'),(1007,'wiz_product',NULL,'prdimg_L11','확대보기 이미지11'),(1008,'wiz_product',NULL,'prdimg_M11','제품상세 이미지11'),(1009,'wiz_product',NULL,'prdimg_S11','축소 이미지11'),(1010,'wiz_product',NULL,'prdimg_L12','확대보기 이미지12'),(1011,'wiz_product',NULL,'prdimg_M12','제품상세 이미지12'),(1012,'wiz_product',NULL,'prdimg_S12','축소 이미지12'),(1013,'wiz_product',NULL,'shortexp','상품간단설명'),(1014,'wiz_product',NULL,'content','상품상세정보'),(1015,'wiz_schedule','<b>일정 테이블</b>\r\n일정 테이블입니다.','anywiz',NULL),(1016,'wiz_schedule',NULL,'idx','인덱스'),(1017,'wiz_schedule',NULL,'memid','회원 ID'),(1018,'wiz_schedule',NULL,'prior','순서'),(1019,'wiz_schedule',NULL,'subject','제목'),(1020,'wiz_schedule',NULL,'content','내용'),(1021,'wiz_schedule',NULL,'sdate','시작일'),(1022,'wiz_schedule',NULL,'edate','종료일'),(1023,'wiz_siteinfo','<b>사이트 정보 테이블</b>\r\n사이트 정보 테이블입니다.','anywiz',NULL),(1024,'wiz_siteinfo',NULL,'site_name','사이트명'),(1025,'wiz_siteinfo',NULL,'site_url','사이트 URL'),(1026,'wiz_siteinfo',NULL,'site_email','관리자 이메일'),(1027,'wiz_siteinfo',NULL,'site_tel','관리자 전화번호'),(1028,'wiz_siteinfo',NULL,'site_hand','관리자 휴대전화번호'),(1029,'wiz_siteinfo',NULL,'site_key','라이센스키'),(1030,'wiz_siteinfo',NULL,'site_date','사이트 설치일'),(1031,'wiz_siteinfo',NULL,'ftp_host','FTP 접속주소'),(1032,'wiz_siteinfo',NULL,'ftp_id','FTP 아이디'),(1033,'wiz_siteinfo',NULL,'ftp_pw','FTP 비밀번호'),(1034,'wiz_siteinfo',NULL,'admin_title','관리자 타이틀'),(1035,'wiz_siteinfo',NULL,'admin_copyright','관리자 카피라잇'),(1036,'wiz_siteinfo',NULL,'addbbs_use','게시판추가 사용여부'),(1037,'wiz_siteinfo',NULL,'ssl_use','SSL 사용여부'),(1038,'wiz_siteinfo',NULL,'ssl_port','SSL 포트번호'),(1039,'wiz_siteinfo',NULL,'msg_use','쪽지 사용여부'),(1040,'wiz_siteinfo',NULL,'msg_skin','쪽지 스킨'),(1041,'wiz_siteinfo',NULL,'msg_url','쪽지 연결페이지'),(1042,'wiz_siteinfo',NULL,'mini_use','미니홈피 사용여부'),(1043,'wiz_siteinfo',NULL,'mini_skin','미니홈피 스킨'),(1044,'wiz_siteinfo',NULL,'mini_url','미니홈피 메인 주소'),(1045,'wiz_siteinfo',NULL,'sms_use','SMS 사용여부'),(1046,'wiz_siteinfo',NULL,'sms_type','SMS 종류'),(1047,'wiz_siteinfo',NULL,'sms_id','SMS 아이디'),(1048,'wiz_siteinfo',NULL,'sms_pw','SMS 비밀번호'),(1049,'wiz_siteinfo',NULL,'namecheck_use','실명인증 사용여부'),(1050,'wiz_siteinfo',NULL,'namecheck_id','실명인증 아이디'),(1051,'wiz_siteinfo',NULL,'namecheck_pw','실명인증 비밀번호'),(1052,'wiz_siteinfo',NULL,'point_use','포인트 사용여부'),(1053,'wiz_siteinfo',NULL,'point_skin','포인트 스킨'),(1054,'wiz_siteinfo',NULL,'point_url','포인트 연결페이지'),(1055,'wiz_siteinfo',NULL,'join_point','회원가입 포인트'),(1056,'wiz_siteinfo',NULL,'login_point','로그인 포인트'),(1057,'wiz_siteinfo',NULL,'msg_point','쪽지 포인트'),(1058,'wiz_siteinfo',NULL,'view_point','보기 포인트'),(1059,'wiz_siteinfo',NULL,'write_point','글쓰기 포인트'),(1060,'wiz_siteinfo',NULL,'down_point','첨부파일 다운로드 포인트'),(1061,'wiz_siteinfo',NULL,'comment_point','코멘트 포인트'),(1062,'wiz_siteinfo',NULL,'recom_point','추천 포인트'),(1063,'wiz_siteinfo',NULL,'point_msg','포인트가 없을 경우 경고메세지'),(1064,'wiz_siteinfo',NULL,'designer_id','디자이너 아이디'),(1065,'wiz_siteinfo',NULL,'designer_pw','디자이너 비밀번호'),(1066,'wiz_siteinfo',NULL,'anywiz_id','애니위즈 아이디'),(1067,'wiz_siteinfo',NULL,'anywiz_pw','애니위즈 비밀번호'),(1068,'wiz_siteinfo',NULL,'start_page','관리자 로그인 후 이동페이지'),(1069,'wiz_siteinfo',NULL,'menu_use','메뉴사용여부'),(1070,'wiz_siteinfo',NULL,'prdimg_R','상품 목록 이미지'),(1071,'wiz_siteinfo',NULL,'prdimg_L','상품 확대 이미지'),(1072,'wiz_siteinfo',NULL,'prdimg_M','상품 상세 이미지'),(1073,'wiz_siteinfo',NULL,'prdimg_S','상품 썸네일 이미지'),(1074,'wiz_siteinfo',NULL,'com_num','사업자등록번호'),(1075,'wiz_siteinfo',NULL,'com_name','상호'),(1076,'wiz_siteinfo',NULL,'com_owner','대표자명'),(1077,'wiz_siteinfo',NULL,'com_post','우편번호'),(1078,'wiz_siteinfo',NULL,'com_address','주소'),(1079,'wiz_siteinfo',NULL,'com_kind','업태'),(1080,'wiz_siteinfo',NULL,'com_class','종목'),(1081,'wiz_siteinfo',NULL,'com_tel','전화번호'),(1082,'wiz_siteinfo',NULL,'com_fax','팩스번호'),(1083,'wiz_siteinfo',NULL,'con_parameter','검색 키워드 분석 파라미터'),(1084,'','','anywiz',NULL),(1085,'wiz_bbs',NULL,'reply','답변내용'),(1086,'wiz_bbs',NULL,'status','처리상태'),(1087,'wiz_bbsinfo',NULL,'sms','글작성 시 관리자에게 SMS 발송 여부'),(1088,'wiz_bbsinfo',NULL,'grp','게시판그룹'),(1089,'wiz_bbsinfo',NULL,'prior','우선순위'),(1090,'wiz_pollinfo',NULL,'datetype_list','날짜형식(목록페이지) '),(1091,'wiz_pollinfo',NULL,'datetype_view','날짜형식(보기페이지) '),(1092,'wiz_pollinfo',NULL,'rows','페이지 출력수'),(1093,'wiz_pollinfo',NULL,'lists','리스트 출력수'),(1094,'wiz_pollinfo',NULL,'newc','NEW 기간설정'),(1095,'wiz_pollinfo',NULL,'subject_len','제목 글자수 '),(1096,'wiz_pollinfo',NULL,'spam_check','스팸글체크기능 사용여부 '),(1097,'wiz_pollinfo',NULL,'comment','코멘트 사용여부 '),(1098,'wiz_pollinfo',NULL,'abuse','욕설,비방글 필터링 사용여부 '),(1099,'wiz_pollinfo',NULL,'abtxt','욕설,비방글 필터링 내용 '),(1100,'wiz_product',NULL,'upfile1','첨부파일1'),(1101,'wiz_product',NULL,'upfile2','첨부파일2'),(1102,'wiz_product',NULL,'upfile3','첨부파일3'),(1103,'wiz_product',NULL,'upfile4','첨부파일4'),(1104,'wiz_product',NULL,'upfile5','첨부파일5'),(1105,'wiz_product',NULL,'upfile1_name','첨부파일명1'),(1106,'wiz_product',NULL,'upfile2_name','첨부파일명2'),(1107,'wiz_product',NULL,'upfile3_name','첨부파일명3'),(1108,'wiz_product',NULL,'upfile4_name','첨부파일명4'),(1109,'wiz_product',NULL,'upfile5_name','첨부파일명5'),(1110,'wiz_siteinfo',NULL,'bbs_grp','게시판그룹'),(1111,'wiz_siteinfo',NULL,'up_date','최종 업데이트 날짜'),(1112,'','','anywiz',NULL);
/*!40000 ALTER TABLE `wiz_tabledesc` ENABLE KEYS */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

