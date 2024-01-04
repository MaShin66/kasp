<? include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php"; ?>
<? include_once "$_SERVER[DOCUMENT_ROOT]/admin2/inc/admin_check.php"; ?>
<html>
<head>
<title>파일/디렉토리 구조도</title>
<meta http-equiv="Content-Type" content="text/html;" charset="utf-8">
<style>
<!--
	td,li {font-size:13px;font-family:"굴림","돋움";color:#000000;}
	.input {
	font-size:9pt;
	font-family:"굴림","돋움";
	color:#545454;
	border-width:1pt;
	border-style:solid;
	background-color:#ffffff;
	border-color:#cccccc;
	height:18px;
	}
-->
</style>
</head>
<body onLoad="goInput()">
<table width=700>
	<tr><td height="20"></td></tr>
	<tr>
		<td><h1>파일/디렉토리 구조도</h1></td>
		<td align="right">
			<? if($mode != "print"){ ?><input type="button" value="전체출력" onClick="window.open('<?=$_SERVER[PHP_SELF]?>?mode=print','','');"><? } ?>
		</td>
	</tr>
</table>

<?
if($mode == "edit"){

	$sql = "select idx from wiz_filedesc where fdir='$fdir'";
	$result = mysql_query($sql);
	$exist = mysql_num_rows($result);
	if($exist <= 0){
		$sql = "insert into wiz_filedesc(idx,fdir,fdesc) values('','$fdir','$fdesc')";
	}else{
		$sql = "update wiz_filedesc set fdesc='$fdesc' where fdir='$fdir'";
	}
	mysql_query($sql);

}

$max_idx = 0;

$sql = "select * from wiz_filedesc";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)){
	$fdir = substr($row[fdir],1);
	$fdesc_list[$fdir][value] = $row[fdesc];
	$fdesc_list[$fdir][idx] = $row[idx];

	if($max_idx < $row[idx]) $max_idx = $row[idx];

}

?>

<script Language="Javascript">
<!--

// 마지막 입력 항목으로
function goInput() {
<? if($mode != "print"){ ?>
/*
	document.location = "#input<?=$max_idx?>";

	var last = eval("file_<?=$max_idx?>");
	last.focus();
*/
<? } ?>
}

//-->
</script>

<?php

$path = $_SERVER[DOCUMENT_ROOT]."/admin";
echo "<table border=0><tr><td><b>/admin</b></td></tr></table>\n";
list_dir($path,0);

function list_dir($path,$tab)
{
		global $fdesc_list, $mode;

		exec("ls -X $path", $file_array, $return_val);
		$total = count($file_array);
		$no = 0;

		while($total){

			$file_name = str_replace($path."/","",$file_array[$no]);
			$dir = $path."/".$file_name;
			$fdir = substr($dir,1);

      if(!empty($fdesc_list[$fdir][value])) echo "<a name='input".$fdesc_list[$fdir][idx]."'>";

			if(is_dir($dir)){

				if($mode == "print") echo "<table border=0><tr><td width=".($tab*60+50).">&nbsp;</td><td width=200><b>+".$file_name."</b></td><td>".$fdesc_list[$fdir][value]."</td></tr></table>\n";
				else echo "<table border=0><tr><td width=".($tab*60+50).">&nbsp;</td><td width=200><b>+".$file_name."</b></td><td><input id=\"file_".$fdesc_list[$fdir][idx]."\" type=\"text\" class=\"input\" value=\"".$fdesc_list[$fdir][value]."\" onChange=\"document.location='".$_SERVER[PHP_SELF]."?mode=edit&fdesc='+this.value+'&fdir=".$dir."';\"></td></tr></table>\n";
				if($file_name != "skin" && $file_name != "data"){
					$tab++;
					list_dir($path."/".$file_name,$tab);
					$tab--;
				}

			}else{

				if(
           substr($file_name,-3) == "html" ||
           substr($file_name,-3) == "htm" ||
           substr($file_name,-3) == "php"
          ){
					if($mode == "print") echo "<table border=0><tr><td width=".($tab*60+50).">&nbsp;</td><td width=200>".$file_name."</td><td>".$fdesc_list[$fdir][value]."</td></tr></table>\n";
					else echo "<table border=0><tr><td width=".($tab*60+50).">&nbsp;</td><td width=200>".$file_name."</td><td><input id=\"file_".$fdesc_list[$fdir][idx]."\" type=\"text\" class=\"input\" value=\"".$fdesc_list[$fdir][value]."\" onChange=\"document.location='".$_SERVER[PHP_SELF]."?mode=edit&fdesc='+this.value+'&fdir=".$dir."';\"></td></tr></table>\n";
				}

			}

			$no++;
			$total--;

		}


}

/*
-- phpMyAdmin SQL Dump
-- version 2.11.7.1
-- http://www.phpmyadmin.net
--
-- 호스트: localhost
-- 처리한 시간: 09-04-07 20:37
-- 서버 버전: 5.0.27
-- PHP 버전: 4.4.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 데이터베이스: `wizhome`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `wiz_filedesc`
--

CREATE TABLE IF NOT EXISTS `wiz_filedesc` (
  `idx` int(10) NOT NULL auto_increment,
  `fdir` text,
  `fdesc` text,
  PRIMARY KEY  (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=euckr AUTO_INCREMENT=424 ;

--
-- 테이블의 덤프 데이터 `wiz_filedesc`
--

INSERT INTO `wiz_filedesc` (`idx`, `fdir`, `fdesc`) VALUES
(1, '', ''),
(2, '/home/anywiz/wizhome/www/admin2/member', '회원관리'),
(3, '/home/anywiz/wizhome/www/admin2/member/join_save.php', '회원정보저장 페이지'),
(4, '/home/anywiz/wizhome/www/admin2/member/join_input.php', '회원입력 페이지'),
(5, '/home/anywiz/wizhome/www/admin2/member/loginbox.php', '로그인박스'),
(6, '/home/anywiz/wizhome/www/admin2/bbs', '게시판'),
(7, '/home/anywiz/wizhome/www/admin2/mini', '미니홈피'),
(8, '/home/anywiz/wizhome/www/admin2/manage', '관리자페이지'),
(9, '/home/anywiz/wizhome/www/admin2/bbs/down.php', '첨부파일 다운로드'),
(10, '/home/anywiz/wizhome/www/admin2/bbs/copy.php', '게시물복사'),
(11, '/home/anywiz/wizhome/www/admin2/bbs/move.php', '게시물이동'),
(12, '/home/anywiz/wizhome/www/admin2/bbs/skin', '스킨 디렉토리'),
(13, '/home/anywiz/wizhome/www/admin2/bbs/comment.php', '코멘트'),
(14, '/home/anywiz/wizhome/www/admin2/bbs/input.php', '입력페이지'),
(15, '/home/anywiz/wizhome/www/admin2/bbs/list.php', '리스트페이지'),
(16, '/home/anywiz/wizhome/www/admin2/bbs/passwd.php', '비밀번호체크'),
(17, '/home/anywiz/wizhome/www/admin2/bbs/save.php', '데이타저장'),
(18, '/home/anywiz/wizhome/www/admin2/bbs/list_bak.php', '리스트페이지 백업'),
(19, '/home/anywiz/wizhome/www/admin2/bbs/norobot_image.php', '스팸글방지 이미지생성'),
(20, '/home/anywiz/wizhome/www/admin2/bbs/view.php', '보기페이지'),
(21, '/home/anywiz/wizhome/www/admin2/bbs/view_img.php', '첨부이미지 확대보기'),
(22, '/home/anywiz/wizhome/www/admin2/bbsmain', '메인게시물'),
(23, '/home/anywiz/wizhome/www/admin2/bbsmain/image', '이미지'),
(24, '/home/anywiz/wizhome/www/admin2/bbsmain/skin', '스킨 디렉토리'),
(25, '/home/anywiz/wizhome/www/admin2/data', '데이터 디렉토리'),
(26, '/home/anywiz/wizhome/www/admin2/form', '폼메일'),
(27, '/home/anywiz/wizhome/www/admin2/form/skin', '스킨 디렉토리'),
(28, '/home/anywiz/wizhome/www/admin2/form/input.php', '폼메일 작성'),
(29, '/home/anywiz/wizhome/www/admin2/form/save.php', '폼메일 저장'),
(30, '/home/anywiz/wizhome/www/admin2/inc', '인클루드 디렉토리'),
(31, '/home/anywiz/wizhome/www/admin2/inc/admin_check.php', '관리자 체크'),
(32, '/home/anywiz/wizhome/www/admin2/inc/bbs_info.php', '게시판 정보'),
(33, '/home/anywiz/wizhome/www/admin2/inc/bbsmain_info.php', '메인게시물 정보'),
(34, '/home/anywiz/wizhome/www/admin2/inc/class.sms.php', 'SMS 클래스'),
(35, '/home/anywiz/wizhome/www/admin2/inc/form_info.php', '폼메일 정보'),
(36, '/home/anywiz/wizhome/www/admin2/inc/mem_info.php', '회원설정 정보'),
(37, '/home/anywiz/wizhome/www/admin2/inc/msg_info.php', '쪽지설정 정보'),
(38, '/home/anywiz/wizhome/www/admin2/inc/point_info.php', '포인트설정 정보'),
(39, '/home/anywiz/wizhome/www/admin2/inc/poll_info.php', '설문조사 정보'),
(40, '/home/anywiz/wizhome/www/admin2/inc/pollmain_info.php', '메인설문조사 정보'),
(41, '/home/anywiz/wizhome/www/admin2/inc/prd_info.php', '상품설정 정보'),
(42, '/home/anywiz/wizhome/www/admin2/inc/prdmain_info.php', '메인상품 정보'),
(43, '/home/anywiz/wizhome/www/admin2/inc/sch_info.php', '일정관리 정보'),
(44, '/home/anywiz/wizhome/www/admin2/inc/site_info.php', '사이트 정보'),
(45, '/home/anywiz/wizhome/www/admin2/js', 'js 디렉토리'),
(46, '/home/anywiz/wizhome/www/admin2/mail', '메일'),
(47, '/home/anywiz/wizhome/www/admin2/mail/img', '메일 이미지'),
(48, '/home/anywiz/wizhome/www/admin2/manage/banner', '배너관리'),
(49, '/home/anywiz/wizhome/www/admin2/manage/banner/banner_input.php', '배너그룹 입력페이지'),
(50, '/home/anywiz/wizhome/www/admin2/manage/banner/banner_list.php', '배너그룹 목록페이지'),
(51, '/home/anywiz/wizhome/www/admin2/manage/banner/banner_save.php', '데이터 저장'),
(52, '/home/anywiz/wizhome/www/admin2/manage/banner/input.php', '배너 입력페이지'),
(53, '/home/anywiz/wizhome/www/admin2/manage/banner/left_menu.php', '좌측 메뉴'),
(54, '/home/anywiz/wizhome/www/admin2/manage/banner/list.php', '배너 목록페이지'),
(55, '/home/anywiz/wizhome/www/admin2/manage/basic', '기본설정'),
(56, '/home/anywiz/wizhome/www/admin2/manage/basic/admin_input.php', '관리자 입력'),
(57, '/home/anywiz/wizhome/www/admin2/manage/basic/admin_list.php', '관리자 목록'),
(58, '/home/anywiz/wizhome/www/admin2/manage/basic/admin_save.php', '관리자 데이터 저장'),
(59, '/home/anywiz/wizhome/www/admin2/manage/basic/domain_input.php', '도메인 입력'),
(60, '/home/anywiz/wizhome/www/admin2/manage/basic/email_input.php', '이메일 입력'),
(61, '/home/anywiz/wizhome/www/admin2/manage/basic/left_menu.php', '좌측메뉴'),
(62, '/home/anywiz/wizhome/www/admin2/manage/basic/popup_input.php', '팝업 입력'),
(63, '/home/anywiz/wizhome/www/admin2/manage/basic/popup_list.php', '팝업 목록'),
(64, '/home/anywiz/wizhome/www/admin2/manage/basic/popup_save.php', '팝업 데이터 저장'),
(65, '/home/anywiz/wizhome/www/admin2/manage/basic/site_info.php', '사이트 정보 입력'),
(66, '/home/anywiz/wizhome/www/admin2/manage/basic/site_save.php', '사이트 정보 저장'),
(67, '/home/anywiz/wizhome/www/admin2/manage/basic/sms_fill.php', 'SMS 관리'),
(68, '/home/anywiz/wizhome/www/admin2/manage/basic/sms_info.php', 'SMS 충전내용'),
(69, '/home/anywiz/wizhome/www/admin2/manage/basic/sms_save.php', 'SMS 데이터 저장'),
(70, '/home/anywiz/wizhome/www/admin2/manage/bbs', '게시판'),
(71, '/home/anywiz/wizhome/www/admin2/manage/bbs/bbs_input.php', '게시판 입력'),
(72, '/home/anywiz/wizhome/www/admin2/manage/bbs/bbs_list.php', '게시판 목록'),
(73, '/home/anywiz/wizhome/www/admin2/manage/bbs/bbs_save.php', '게시판 데이터 저장'),
(74, '/home/anywiz/wizhome/www/admin2/manage/bbs/category.php', '카테고리 목록'),
(75, '/home/anywiz/wizhome/www/admin2/manage/bbs/category_input.php', '카테고리 입력'),
(76, '/home/anywiz/wizhome/www/admin2/manage/bbs/copy.php', '게시물 복사'),
(77, '/home/anywiz/wizhome/www/admin2/manage/bbs/down.php', '첨부파일 다운로드'),
(78, '/home/anywiz/wizhome/www/admin2/manage/bbs/input.php', '게시물 입력'),
(79, '/home/anywiz/wizhome/www/admin2/manage/bbs/left_menu.php', '좌측메뉴'),
(80, '/home/anywiz/wizhome/www/admin2/manage/bbs/list.php', '게시물 목록'),
(81, '/home/anywiz/wizhome/www/admin2/manage/bbs/list_c.php', '게시물 목록 스킨버전'),
(82, '/home/anywiz/wizhome/www/admin2/manage/bbs/move.php', '게시물 이동'),
(83, '/home/anywiz/wizhome/www/admin2/manage/bbs/pop_view.php', '게시물 보기 팝업'),
(84, '/home/anywiz/wizhome/www/admin2/manage/bbs/save.php', '게시물 데이터 저장'),
(85, '/home/anywiz/wizhome/www/admin2/manage/bbs/view.php', '게시물 보기'),
(86, '/home/anywiz/wizhome/www/admin2/manage/bbs/view_img.php', '첨부이미지 확대보기'),
(87, '/home/anywiz/wizhome/www/admin2/manage/config', '환경설정'),
(88, '/home/anywiz/wizhome/www/admin2/manage/config/banner_config.php', '배너관리'),
(89, '/home/anywiz/wizhome/www/admin2/manage/config/basic_config.php', '기본설정'),
(90, '/home/anywiz/wizhome/www/admin2/manage/config/basic_save.php', '기본설정 저장'),
(91, '/home/anywiz/wizhome/www/admin2/manage/config/bbs_config.php', '게시판 관리'),
(92, '/home/anywiz/wizhome/www/admin2/manage/config/bbsmain_config.php', '메인게시물 관리'),
(93, '/home/anywiz/wizhome/www/admin2/manage/config/bbsmain_input.php', '메인게시물 입력'),
(94, '/home/anywiz/wizhome/www/admin2/manage/config/bbsmain_save.php', '메인게시물 저장'),
(95, '/home/anywiz/wizhome/www/admin2/manage/config/bbsmain_view.php', '메인게시물 미리보기'),
(96, '/home/anywiz/wizhome/www/admin2/manage/config/counter_config.php', '카운터'),
(97, '/home/anywiz/wizhome/www/admin2/manage/config/form_config.php', '폼메일'),
(98, '/home/anywiz/wizhome/www/admin2/manage/config/form_field.php', '폼메일 항목 목록'),
(99, '/home/anywiz/wizhome/www/admin2/manage/config/form_field_c.php', '폼메일 항목 목록 백업'),
(100, '/home/anywiz/wizhome/www/admin2/manage/config/form_field_input.php', '폼메일 항목 입력'),
(101, '/home/anywiz/wizhome/www/admin2/manage/config/form_input.php', '폼메일 입력'),
(102, '/home/anywiz/wizhome/www/admin2/manage/config/form_save.php', '폼메일 저장'),
(103, '/home/anywiz/wizhome/www/admin2/manage/config/form_save_c.php', '폼메일 저장 백업'),
(104, '/home/anywiz/wizhome/www/admin2/manage/config/left_menu.php', '좌측 메뉴'),
(105, '/home/anywiz/wizhome/www/admin2/manage/config/levelcheck_config.php', '페이지접근권한'),
(106, '/home/anywiz/wizhome/www/admin2/manage/config/log_config.php', '로그분석'),
(107, '/home/anywiz/wizhome/www/admin2/manage/config/member_config.php', '회원설정'),
(108, '/home/anywiz/wizhome/www/admin2/manage/config/member_save.php', '회원설정 저장'),
(109, '/home/anywiz/wizhome/www/admin2/manage/config/message_config.php', '쪽지설정'),
(110, '/home/anywiz/wizhome/www/admin2/manage/config/message_save.php', '쪽지설정 저장'),
(111, '/home/anywiz/wizhome/www/admin2/manage/config/mini_config.php', '미니홈피 설정'),
(112, '/home/anywiz/wizhome/www/admin2/manage/config/mini_save.php', '미니홈피 설정 저장'),
(113, '/home/anywiz/wizhome/www/admin2/manage/config/page_config.php', '페이지 관리'),
(114, '/home/anywiz/wizhome/www/admin2/manage/config/point_config.php', '포인트 설정'),
(115, '/home/anywiz/wizhome/www/admin2/manage/config/point_save.php', '포인트 설정 저장'),
(116, '/home/anywiz/wizhome/www/admin2/manage/config/poll_config.php', '설문조사 '),
(117, '/home/anywiz/wizhome/www/admin2/manage/config/poll_config_b.php', '설문조사 백업'),
(118, '/home/anywiz/wizhome/www/admin2/manage/config/pollmain_config.php', '메인설문조사'),
(119, '/home/anywiz/wizhome/www/admin2/manage/config/pollmain_input.php', '메인설문조사 입력'),
(120, '/home/anywiz/wizhome/www/admin2/manage/config/pollmain_save.php', '메인설문조사 저장'),
(121, '/home/anywiz/wizhome/www/admin2/manage/config/popup_config.php', '팝업관리'),
(122, '/home/anywiz/wizhome/www/admin2/manage/config/prdmain_input.php', '메인 상품추출 입력'),
(123, '/home/anywiz/wizhome/www/admin2/manage/config/prdmain_save.php', '메인 상품추출 저장'),
(124, '/home/anywiz/wizhome/www/admin2/manage/config/prdmain_view.php', '메인 상품추출 미리보기'),
(125, '/home/anywiz/wizhome/www/admin2/manage/config/product_config.php', '상품관리'),
(126, '/home/anywiz/wizhome/www/admin2/manage/config/schedule_config.php', '일정관리'),
(127, '/home/anywiz/wizhome/www/admin2/manage/config/sms_config.php', 'SMS 발송'),
(128, '/home/anywiz/wizhome/www/admin2/manage/connect', '접속통계'),
(129, '/home/anywiz/wizhome/www/admin2/manage/connect/connect_keyword.php', '검색키워드분석'),
(130, '/home/anywiz/wizhome/www/admin2/manage/connect/connect_list.php', '접속자분석'),
(131, '/home/anywiz/wizhome/www/admin2/manage/connect/connect_param.php', '분석파라미터 설정'),
(132, '/home/anywiz/wizhome/www/admin2/manage/connect/connect_refer.php', '접속경로분석'),
(133, '/home/anywiz/wizhome/www/admin2/manage/connect/connect_save.php', '초기화 및 파라미터 설정 저장'),
(134, '/home/anywiz/wizhome/www/admin2/manage/connect/left_menu.php', '좌측메뉴'),
(135, '/home/anywiz/wizhome/www/admin2/manage/form', '폼메일'),
(136, '/home/anywiz/wizhome/www/admin2/manage/form/down.php', '첨부파일 다운로드'),
(137, '/home/anywiz/wizhome/www/admin2/manage/form/form_input.php', '폼메일 입력'),
(138, '/home/anywiz/wizhome/www/admin2/manage/form/form_list.php', '폼메일 목록'),
(139, '/home/anywiz/wizhome/www/admin2/manage/form/form_save.php', '폼메일 저장'),
(140, '/home/anywiz/wizhome/www/admin2/manage/form/form_view.php', '폼메일 보기'),
(141, '/home/anywiz/wizhome/www/admin2/manage/form/left_menu.php', '좌측메뉴'),
(142, '/home/anywiz/wizhome/www/admin2/manage/image', '이미지'),
(143, '/home/anywiz/wizhome/www/admin2/manage/image/bbs', '게시판 이미지'),
(144, '/home/anywiz/wizhome/www/admin2/manage/image/day', '달력 이미지'),
(145, '/home/anywiz/wizhome/www/admin2/manage/image/main', '메인 이미지'),
(146, '/home/anywiz/wizhome/www/admin2/manage/image/tree', '상품분류 트리 이미지'),
(147, '/home/anywiz/wizhome/www/admin2/manage/main', '메인'),
(148, '/home/anywiz/wizhome/www/admin2/manage/main/left_menu.php', '좌측메뉴'),
(149, '/home/anywiz/wizhome/www/admin2/manage/main/main.php', '메인페이지'),
(150, '/home/anywiz/wizhome/www/admin2/manage/member', '회원관리'),
(151, '/home/anywiz/wizhome/www/admin2/manage/member/id_check.php', '아이디 중복검사'),
(152, '/home/anywiz/wizhome/www/admin2/manage/member/left_menu.php', '좌측메뉴'),
(153, '/home/anywiz/wizhome/www/admin2/manage/member/level_input.php', '회원등급 입력'),
(154, '/home/anywiz/wizhome/www/admin2/manage/member/level_list.php', '회원등급 목록'),
(155, '/home/anywiz/wizhome/www/admin2/manage/member/level_save.php', '회원등급 저장'),
(156, '/home/anywiz/wizhome/www/admin2/manage/member/mail_input.php', '메세지설정 입력'),
(157, '/home/anywiz/wizhome/www/admin2/manage/member/mail_list.php', '메세지설정 목록'),
(158, '/home/anywiz/wizhome/www/admin2/manage/member/mail_popup.php', '메일발송 팝업'),
(159, '/home/anywiz/wizhome/www/admin2/manage/member/mail_save.php', '메세지설정 저장'),
(160, '/home/anywiz/wizhome/www/admin2/manage/member/mail_send.php', '단체메일발송'),
(161, '/home/anywiz/wizhome/www/admin2/manage/member/mail_set.php', '메일 내용 세팅'),
(162, '/home/anywiz/wizhome/www/admin2/manage/member/mail_test.php', '메일발송테스트'),
(163, '/home/anywiz/wizhome/www/admin2/manage/member/member_analy.php', '회원통계'),
(164, '/home/anywiz/wizhome/www/admin2/manage/member/member_config.php', '가입약관 및 개인정보 보호정책'),
(165, '/home/anywiz/wizhome/www/admin2/manage/member/member_excel.php', '회원정보 엑셀 다운로드'),
(166, '/home/anywiz/wizhome/www/admin2/manage/member/member_input.php', '회원정보 입력'),
(167, '/home/anywiz/wizhome/www/admin2/manage/member/member_list.php', '회원목록'),
(168, '/home/anywiz/wizhome/www/admin2/manage/member/member_point.php', '회원포인트 목록'),
(169, '/home/anywiz/wizhome/www/admin2/manage/member/member_save.php', '회원 데이터 저장'),
(170, '/home/anywiz/wizhome/www/admin2/manage/member/message_input.php', '쪽지 입력'),
(171, '/home/anywiz/wizhome/www/admin2/manage/member/message_list.php', '쪽지 목록'),
(172, '/home/anywiz/wizhome/www/admin2/manage/member/message_save.php', '쪽지 저장'),
(173, '/home/anywiz/wizhome/www/admin2/manage/member/message_send.php', '쪽지발송'),
(174, '/home/anywiz/wizhome/www/admin2/manage/member/out_list.php', '탈퇴회원'),
(175, '/home/anywiz/wizhome/www/admin2/manage/member/point_config.php', '포인트 설정'),
(176, '/home/anywiz/wizhome/www/admin2/manage/member/point_list.php', '포인트 목록'),
(177, '/home/anywiz/wizhome/www/admin2/manage/member/point_save.php', '포인트 저장'),
(178, '/home/anywiz/wizhome/www/admin2/manage/member/search_zip.php', '주소찾기'),
(179, '/home/anywiz/wizhome/www/admin2/manage/member/sms_popup.php', 'SMS 발송 팝업'),
(180, '/home/anywiz/wizhome/www/admin2/manage/member/sms_save.php', 'SMS 발송'),
(181, '/home/anywiz/wizhome/www/admin2/manage/member/sms_send.php', '단체SMS발송'),
(182, '/home/anywiz/wizhome/www/admin2/manage/mini', '미니홈피'),
(183, '/home/anywiz/wizhome/www/admin2/manage/mini/down.php', '첨부파일 다운로드'),
(184, '/home/anywiz/wizhome/www/admin2/manage/mini/input.php', '게시물 입력'),
(185, '/home/anywiz/wizhome/www/admin2/manage/mini/left_menu.php', '좌측메뉴'),
(186, '/home/anywiz/wizhome/www/admin2/manage/mini/list.php', '게시물목록'),
(187, '/home/anywiz/wizhome/www/admin2/manage/mini/mini_input.php', '미니홈피 입력'),
(188, '/home/anywiz/wizhome/www/admin2/manage/mini/mini_list.php', '미니홈피 목록'),
(189, '/home/anywiz/wizhome/www/admin2/manage/mini/mini_save.php', '미니홈피 저장'),
(190, '/home/anywiz/wizhome/www/admin2/manage/mini/save.php', '게시물 저장'),
(191, '/home/anywiz/wizhome/www/admin2/manage/mini/skin_input.php', '스킨 입력'),
(192, '/home/anywiz/wizhome/www/admin2/manage/mini/skin_list.php', '스킨 목록'),
(193, '/home/anywiz/wizhome/www/admin2/manage/mini/skin_save.php', '스킨 저장'),
(194, '/home/anywiz/wizhome/www/admin2/manage/mini/url_check.php', '미니홈피URL 중복체크'),
(195, '/home/anywiz/wizhome/www/admin2/manage/mini/view.php', '게시글 보기'),
(196, '/home/anywiz/wizhome/www/admin2/manage/mini/view_img.php', '첨부이미지 확대보기'),
(197, '/home/anywiz/wizhome/www/admin2/manage/page', '페이지관리'),
(198, '/home/anywiz/wizhome/www/admin2/manage/page/left_menu.php', '좌측메뉴'),
(199, '/home/anywiz/wizhome/www/admin2/manage/page/page_input.php', '페이지 입력'),
(200, '/home/anywiz/wizhome/www/admin2/manage/page/page_list.php', '페이지 목록'),
(201, '/home/anywiz/wizhome/www/admin2/manage/page/page_save.php', '페이지 저장'),
(202, '/home/anywiz/wizhome/www/admin2/manage/poll', '설문관리'),
(203, '/home/anywiz/wizhome/www/admin2/manage/poll/left_menu.php', '좌측메뉴'),
(204, '/home/anywiz/wizhome/www/admin2/manage/poll/poll_input.php', '설문조사 입력'),
(205, '/home/anywiz/wizhome/www/admin2/manage/poll/poll_list.php', '설문조사 목록'),
(206, '/home/anywiz/wizhome/www/admin2/manage/poll/poll_question.php', '설문내용 입력'),
(207, '/home/anywiz/wizhome/www/admin2/manage/poll/poll_save.php', '설문조사 저장'),
(208, '/home/anywiz/wizhome/www/admin2/manage/poll/pollinfo_input.php', '설문 입력'),
(209, '/home/anywiz/wizhome/www/admin2/manage/poll/pollinfo_list.php', '설문 목록'),
(210, '/home/anywiz/wizhome/www/admin2/manage/poll/pollinfo_save.php', '설문 저장'),
(211, '/home/anywiz/wizhome/www/admin2/manage/product', '상품관리'),
(212, '/home/anywiz/wizhome/www/admin2/manage/product/cat_list.php', '상품분류 목록'),
(213, '/home/anywiz/wizhome/www/admin2/manage/product/cat_save.php', '상품분류 저장'),
(214, '/home/anywiz/wizhome/www/admin2/manage/product/left_menu.php', '좌측메뉴'),
(215, '/home/anywiz/wizhome/www/admin2/manage/product/prd_cat.php', '상품분류'),
(216, '/home/anywiz/wizhome/www/admin2/manage/product/prd_copy.php', '상품 복사'),
(217, '/home/anywiz/wizhome/www/admin2/manage/product/prd_img.php', '상품입력 > 상품사진'),
(218, '/home/anywiz/wizhome/www/admin2/manage/product/prd_imgsize.php', '상품이미지사이즈 설정'),
(219, '/home/anywiz/wizhome/www/admin2/manage/product/prd_input.php', '상품 입력'),
(220, '/home/anywiz/wizhome/www/admin2/manage/product/prd_list.php', '상품 목록'),
(221, '/home/anywiz/wizhome/www/admin2/manage/product/prd_move.php', '상품 이동'),
(222, '/home/anywiz/wizhome/www/admin2/manage/product/prd_save.php', '상품 저장'),
(223, '/home/anywiz/wizhome/www/admin2/manage/schedule', '일정관리'),
(224, '/home/anywiz/wizhome/www/admin2/manage/schedule/calendar.php', '큰 달력'),
(225, '/home/anywiz/wizhome/www/admin2/manage/schedule/calendar_s.php', '작은 달력'),
(226, '/home/anywiz/wizhome/www/admin2/manage/schedule/down.php', '첨부파일 다운로드'),
(227, '/home/anywiz/wizhome/www/admin2/manage/schedule/input.php', '일정 입력'),
(228, '/home/anywiz/wizhome/www/admin2/manage/schedule/left_menu.php', '좌측메뉴'),
(229, '/home/anywiz/wizhome/www/admin2/manage/schedule/list.php', '일정 목록'),
(230, '/home/anywiz/wizhome/www/admin2/manage/schedule/save.php', '일정 저장'),
(231, '/home/anywiz/wizhome/www/admin2/manage/schedule/sch_input.php', '일정정보 입력'),
(232, '/home/anywiz/wizhome/www/admin2/manage/schedule/sch_list.php', '일정정보 목록'),
(233, '/home/anywiz/wizhome/www/admin2/manage/schedule/sch_save.php', '일정정보 저장'),
(234, '/home/anywiz/wizhome/www/admin2/manage/schedule/schedule_s.php', '관리자 메인 일정달력'),
(235, '/home/anywiz/wizhome/www/admin2/manage/schedule/view.php', '일정 보기'),
(236, '/home/anywiz/wizhome/www/admin2/manage/schedule/view_img.php', '첨부이미지 확대보기'),
(237, '/home/anywiz/wizhome/www/admin2/manage/db_backup.php', 'DB 백업'),
(238, '/home/anywiz/wizhome/www/admin2/manage/foot.php', '관리자 하단'),
(239, '/home/anywiz/wizhome/www/admin2/manage/head.php', '관리자 상단'),
(240, '/home/anywiz/wizhome/www/admin2/manage/site_info.php', '사이트 기본정보'),
(241, '/home/anywiz/wizhome/www/admin2/member/skin', '스킨 디렉토리'),
(242, '/home/anywiz/wizhome/www/admin2/member/id_check.php', '아이디 중복체크'),
(243, '/home/anywiz/wizhome/www/admin2/member/idpw.php', '아이디/비밀번호 찾기'),
(244, '/home/anywiz/wizhome/www/admin2/member/join_agree.php', '회원가입 약관 및 개인정보 보호정책 동의'),
(245, '/home/anywiz/wizhome/www/admin2/member/join_ok.php', '회원가입 완료'),
(246, '/home/anywiz/wizhome/www/admin2/member/login.php', '로그인 페이지'),
(247, '/home/anywiz/wizhome/www/admin2/member/login_check.php', '로그인 처리'),
(248, '/home/anywiz/wizhome/www/admin2/member/logout.php', '로그아웃 처리'),
(249, '/home/anywiz/wizhome/www/admin2/member/myinfo.php', '회원정보'),
(250, '/home/anywiz/wizhome/www/admin2/member/myinfo_save.php', '회원정보 저장'),
(251, '/home/anywiz/wizhome/www/admin2/member/myout.php', '회원탈퇴'),
(252, '/home/anywiz/wizhome/www/admin2/member/myout_save.php', '회원탈퇴 처리'),
(253, '/home/anywiz/wizhome/www/admin2/member/name_check.php', '실명인증'),
(254, '/home/anywiz/wizhome/www/admin2/member/nick_check.php', '닉네임 중복체크'),
(255, '/home/anywiz/wizhome/www/admin2/member/post_search.php', '우편번호 찾기'),
(256, '/home/anywiz/wizhome/www/admin2/message', '쪽지'),
(257, '/home/anywiz/wizhome/www/admin2/message/skin', '스킨 디렉토리'),
(258, '/home/anywiz/wizhome/www/admin2/message/down.php', '첨부파일 다운로드'),
(259, '/home/anywiz/wizhome/www/admin2/message/friend.php', '친구목록'),
(260, '/home/anywiz/wizhome/www/admin2/message/input.php', '쪽지입력'),
(261, '/home/anywiz/wizhome/www/admin2/message/list.php', '쪽지목록'),
(262, '/home/anywiz/wizhome/www/admin2/message/member.php', '회원목록'),
(263, '/home/anywiz/wizhome/www/admin2/message/passwd.php', '삭제확인 페이지'),
(264, '/home/anywiz/wizhome/www/admin2/message/pop_message.php', '쪽지 보기 팝업'),
(265, '/home/anywiz/wizhome/www/admin2/message/save.php', '쪽지 저장'),
(266, '/home/anywiz/wizhome/www/admin2/message/save_b.php', '쪽지 저장 백업'),
(267, '/home/anywiz/wizhome/www/admin2/message/view.php', '쪽지 보기'),
(268, '/home/anywiz/wizhome/www/admin2/message/view_img.php', '첨부이미지 확대보기'),
(269, '/home/anywiz/wizhome/www/admin2/mini/bbs', '게시판'),
(270, '/home/anywiz/wizhome/www/admin2/mini/bbs/skin', '스킨 디렉토리'),
(271, '/home/anywiz/wizhome/www/admin2/mini/bbs/comment.php', '코멘트'),
(272, '/home/anywiz/wizhome/www/admin2/mini/bbs/down.php', '첨부파일 다운로드'),
(273, '/home/anywiz/wizhome/www/admin2/mini/bbs/input.php', '입력페이지'),
(274, '/home/anywiz/wizhome/www/admin2/mini/bbs/list.php', '목록페이지'),
(275, '/home/anywiz/wizhome/www/admin2/mini/bbs/move.php', '게시물 이동'),
(276, '/home/anywiz/wizhome/www/admin2/mini/bbs/passwd.php', '비밀번호 체크'),
(277, '/home/anywiz/wizhome/www/admin2/mini/bbs/save.php', '데이터저장'),
(278, '/home/anywiz/wizhome/www/admin2/mini/bbs/view.php', '보기페이지'),
(279, '/home/anywiz/wizhome/www/admin2/mini/bbs/view_img.php', '첨부이미지 확대보기'),
(280, '/home/anywiz/wizhome/www/admin2/mini/image', '이미지 디렉토리'),
(281, '/home/anywiz/wizhome/www/admin2/mini/inc', '인클루드 디렉토리'),
(282, '/home/anywiz/wizhome/www/admin2/mini/inc/mini_connect.php', '미니홈피 로그분석'),
(283, '/home/anywiz/wizhome/www/admin2/mini/inc/mini_info.php', '미니홈피 정보'),
(284, '/home/anywiz/wizhome/www/admin2/mini/inc/minibbs_info.php', '미니홈피 게시판 정보'),
(285, '/home/anywiz/wizhome/www/admin2/mini/makeucc', 'UCC 컴포넌트'),
(286, '/home/anywiz/wizhome/www/admin2/mini/makeucc/example', 'UCC 예제'),
(287, '/home/anywiz/wizhome/www/admin2/mini/makeucc/example/board', 'UCC 게시판'),
(288, '/home/anywiz/wizhome/www/admin2/mini/makeucc/example/board/db', 'UCC DB 처리'),
(289, '/home/anywiz/wizhome/www/admin2/mini/makeucc/example/board/img', 'UCC 게시판 이미지'),
(290, '/home/anywiz/wizhome/www/admin2/mini/makeucc/view_file.php', 'UCC 파일 정보 전달'),
(291, '/home/anywiz/wizhome/www/admin2/mini/music', '미니홈피 음악'),
(292, '/home/anywiz/wizhome/www/admin2/mini/music/img', '이미지 디렉토리'),
(293, '/home/anywiz/wizhome/www/admin2/mini/add_friend.php', '친구 추가'),
(294, '/home/anywiz/wizhome/www/admin2/mini/admin_connect.php', '관리 > 접속통계'),
(295, '/home/anywiz/wizhome/www/admin2/mini/admin_friend.php', '관리 > 친구관리'),
(296, '/home/anywiz/wizhome/www/admin2/mini/admin_info.php', '관리 > 기본설정'),
(297, '/home/anywiz/wizhome/www/admin2/mini/admin_left.php', '관리 > 좌측메뉴'),
(298, '/home/anywiz/wizhome/www/admin2/mini/admin_menu.php', '관리 > 메뉴설정'),
(299, '/home/anywiz/wizhome/www/admin2/mini/admin_menu_config.php', '관리 > 메뉴설정 > 메뉴관리'),
(300, '/home/anywiz/wizhome/www/admin2/mini/admin_music.php', '관리 > 음악설정'),
(301, '/home/anywiz/wizhome/www/admin2/mini/admin_music_input.php', '음악입력'),
(302, '/home/anywiz/wizhome/www/admin2/mini/admin_profile.php', '관리 > 프로필'),
(303, '/home/anywiz/wizhome/www/admin2/mini/admin_skin.php', '관리 > 스킨설정'),
(304, '/home/anywiz/wizhome/www/admin2/mini/admin_skin_input.php', '스킨입력'),
(305, '/home/anywiz/wizhome/www/admin2/mini/bbs.php', '게시판'),
(306, '/home/anywiz/wizhome/www/admin2/mini/bbs_left.php', '게시판 좌측메뉴'),
(307, '/home/anywiz/wizhome/www/admin2/mini/data.php', '자료실'),
(308, '/home/anywiz/wizhome/www/admin2/mini/data_left.php', '자료실 좌측메뉴'),
(309, '/home/anywiz/wizhome/www/admin2/mini/foot.php', '하단파일'),
(310, '/home/anywiz/wizhome/www/admin2/mini/guest.php', '방명록'),
(311, '/home/anywiz/wizhome/www/admin2/mini/head.php', '상단파일'),
(312, '/home/anywiz/wizhome/www/admin2/mini/info.php', '프로필 > 내소개'),
(313, '/home/anywiz/wizhome/www/admin2/mini/info_input.php', '내소개 입력'),
(314, '/home/anywiz/wizhome/www/admin2/mini/info_list.php', '내소개 목록'),
(315, '/home/anywiz/wizhome/www/admin2/mini/main.php', '메인페이지'),
(316, '/home/anywiz/wizhome/www/admin2/mini/main_content.php', '메인페이지 내용'),
(317, '/home/anywiz/wizhome/www/admin2/mini/main_left.php', '메인페이지 좌측메뉴'),
(318, '/home/anywiz/wizhome/www/admin2/mini/menu.php', '우측메뉴'),
(319, '/home/anywiz/wizhome/www/admin2/mini/mini_index.php', '미니홈피 인덱스'),
(320, '/home/anywiz/wizhome/www/admin2/mini/mini_my.php', '내 미니홈피가기'),
(321, '/home/anywiz/wizhome/www/admin2/mini/movie.php', '동영상'),
(322, '/home/anywiz/wizhome/www/admin2/mini/movie_left.php', '동영상 좌측메뉴'),
(323, '/home/anywiz/wizhome/www/admin2/mini/photo.php', '갤러리'),
(324, '/home/anywiz/wizhome/www/admin2/mini/photo_left.php', '갤러리 좌측메뉴'),
(325, '/home/anywiz/wizhome/www/admin2/mini/profile.php', '프로필'),
(326, '/home/anywiz/wizhome/www/admin2/mini/profile_left.php', '프로필 좌측메뉴'),
(327, '/home/anywiz/wizhome/www/admin2/mini/save.php', '데이터저장'),
(328, '/home/anywiz/wizhome/www/admin2/mini/url_check.php', '미니홈피 URL 중복체크'),
(329, '/home/anywiz/wizhome/www/admin2/module', '모듈'),
(330, '/home/anywiz/wizhome/www/admin2/module/banner.php', '배너 모듈'),
(331, '/home/anywiz/wizhome/www/admin2/module/bbs.php', '게시판 모듈'),
(332, '/home/anywiz/wizhome/www/admin2/module/bbsmain.php', '메인게시물 모듈'),
(333, '/home/anywiz/wizhome/www/admin2/module/connect.php', '로그분석 모듈'),
(334, '/home/anywiz/wizhome/www/admin2/module/counter.php', '카운터 모듈'),
(335, '/home/anywiz/wizhome/www/admin2/module/form.php', '폼메일 모듈'),
(336, '/home/anywiz/wizhome/www/admin2/module/idpw.php', '아이디/비밀번호 찾기 모듈'),
(337, '/home/anywiz/wizhome/www/admin2/module/join.php', '회원가입 모듈'),
(338, '/home/anywiz/wizhome/www/admin2/module/levelcheck.php', '페이지접근권한 모듈'),
(339, '/home/anywiz/wizhome/www/admin2/module/login.php', '로그인 모듈'),
(340, '/home/anywiz/wizhome/www/admin2/module/loginbox.php', '로그인박스 모듈'),
(341, '/home/anywiz/wizhome/www/admin2/module/msg_count.php', '쪽지갯수 모듈'),
(342, '/home/anywiz/wizhome/www/admin2/module/msg_friend.php', '친구목록 모듈'),
(343, '/home/anywiz/wizhome/www/admin2/module/msg_member.php', '회원목록 모듈'),
(344, '/home/anywiz/wizhome/www/admin2/module/msg_receive.php', '받은쪽지 모듈'),
(345, '/home/anywiz/wizhome/www/admin2/module/msg_send.php', '보낸쪽지 모듈'),
(346, '/home/anywiz/wizhome/www/admin2/module/myinfo.php', '회원정보수정 모듈'),
(347, '/home/anywiz/wizhome/www/admin2/module/myout.php', '회원탈퇴 모듈'),
(348, '/home/anywiz/wizhome/www/admin2/module/mypoint.php', '회원 포인트내역 모듈'),
(349, '/home/anywiz/wizhome/www/admin2/module/page.php', '페이지 모듈'),
(350, '/home/anywiz/wizhome/www/admin2/module/point.php', '포인트 모듈'),
(351, '/home/anywiz/wizhome/www/admin2/module/poll.php', '설문조사 모듈'),
(352, '/home/anywiz/wizhome/www/admin2/module/pollmain.php', '메인설문조사 모듈'),
(353, '/home/anywiz/wizhome/www/admin2/module/popup.php', '팝업 모듈'),
(354, '/home/anywiz/wizhome/www/admin2/module/prdmain.php', '상품메인추출 모듈'),
(355, '/home/anywiz/wizhome/www/admin2/module/product.php', '상품 모듈'),
(356, '/home/anywiz/wizhome/www/admin2/module/schedule.php', '일정(대) 모듈'),
(357, '/home/anywiz/wizhome/www/admin2/module/schedule_s.php', '일정(소) 모듈'),
(358, '/home/anywiz/wizhome/www/admin2/module/sms.php', 'SMS발송 모듈'),
(359, '/home/anywiz/wizhome/www/admin2/module/topjoin.php', '로그인/로그아웃 탑메뉴 모듈'),
(360, '/home/anywiz/wizhome/www/admin2/module/toplogin.php', '회원가입/마이페이지 탑메뉴 모듈'),
(361, '/home/anywiz/wizhome/www/admin2/point', '포인트'),
(362, '/home/anywiz/wizhome/www/admin2/point/skin', '스킨 디렉토리'),
(363, '/home/anywiz/wizhome/www/admin2/point/mypoint.php', '포인트내역'),
(364, '/home/anywiz/wizhome/www/admin2/poll', '설문조사'),
(365, '/home/anywiz/wizhome/www/admin2/poll/skin', '스킨 디렉토리'),
(366, '/home/anywiz/wizhome/www/admin2/poll/list.php', '목록 페이지'),
(367, '/home/anywiz/wizhome/www/admin2/poll/passwd.php', '비밀번호 체크'),
(368, '/home/anywiz/wizhome/www/admin2/poll/save.php', '데이터저장'),
(369, '/home/anywiz/wizhome/www/admin2/poll/view.php', '보기 페이지'),
(370, '/home/anywiz/wizhome/www/admin2/popup', '팝업'),
(371, '/home/anywiz/wizhome/www/admin2/popup/popup.php', '일반 팝업'),
(372, '/home/anywiz/wizhome/www/admin2/popup/popup_layer.php', '레이어 팝업'),
(373, '/home/anywiz/wizhome/www/admin2/product', '상품'),
(374, '/home/anywiz/wizhome/www/admin2/product/skin', '스킨 디렉토리'),
(375, '/home/anywiz/wizhome/www/admin2/product/list.php', '목록 페이지'),
(376, '/home/anywiz/wizhome/www/admin2/product/prdimg.php', '상품이미지 확대보기'),
(377, '/home/anywiz/wizhome/www/admin2/product/view.php', '보기 페이지'),
(378, '/home/anywiz/wizhome/www/admin2/schedule', '일정'),
(379, '/home/anywiz/wizhome/www/admin2/schedule/skin', '스킨 디렉토리'),
(380, '/home/anywiz/wizhome/www/admin2/schedule/comment.php', '코멘트'),
(381, '/home/anywiz/wizhome/www/admin2/schedule/down.php', '첨부파일 다운로드'),
(382, '/home/anywiz/wizhome/www/admin2/schedule/input.php', '입력페이지'),
(383, '/home/anywiz/wizhome/www/admin2/schedule/list.php', '목록페이지'),
(384, '/home/anywiz/wizhome/www/admin2/schedule/list_s.php', '목록페이지(소)'),
(385, '/home/anywiz/wizhome/www/admin2/schedule/passwd.php', '비밀번호체크'),
(386, '/home/anywiz/wizhome/www/admin2/schedule/save.php', '데이터저장'),
(387, '/home/anywiz/wizhome/www/admin2/schedule/view.php', '보기페이지'),
(388, '/home/anywiz/wizhome/www/admin2/schedule/view_img.php', '첨부이미지 확대보기'),
(389, '/home/anywiz/wizhome/www/admin2/sms', 'SMS 발송'),
(390, '/home/anywiz/wizhome/www/admin2/sms/image', '이미지 디렉토리'),
(391, '/home/anywiz/wizhome/www/admin2/sms/input.php', '입력 페이지'),
(392, '/home/anywiz/wizhome/www/admin2/sms/send.php', '발송 페이지'),
(393, '/home/anywiz/wizhome/www/admin2/webedit', '웹에디터'),
(394, '/home/anywiz/wizhome/www/admin2/webedit/PopupWin', '팝업 페이지'),
(395, '/home/anywiz/wizhome/www/admin2/webedit/PopupWin/Editor_Help.htm', '웹에디터 도움말'),
(396, '/home/anywiz/wizhome/www/admin2/webedit/PopupWin/Editor_InsertFlash.htm', '플래쉬 입력'),
(397, '/home/anywiz/wizhome/www/admin2/webedit/PopupWin/Editor_InsertImage.htm', '이미지 입력'),
(398, '/home/anywiz/wizhome/www/admin2/webedit/PopupWin/Editor_InsertMovie.htm', '동영상 입력'),
(399, '/home/anywiz/wizhome/www/admin2/webedit/PopupWin/Editor_InsertTable.htm', '테이블 입력'),
(400, '/home/anywiz/wizhome/www/admin2/webedit/PopupWin/Editor_SelectColor.htm', '색상 선택'),
(401, '/home/anywiz/wizhome/www/admin2/webedit/PopupWin/Editor_Version.htm', '웹에디터 버전'),
(402, '/home/anywiz/wizhome/www/admin2/webedit/PopupWin/Editor_InsertFlash.php', '플래쉬 저장'),
(403, '/home/anywiz/wizhome/www/admin2/webedit/PopupWin/Editor_InsertImage.php', '이미지 저장'),
(404, '/home/anywiz/wizhome/www/admin2/webedit/PopupWin/Editor_InsertMovie.php', '동영상 저장'),
(405, '/home/anywiz/wizhome/www/admin2/webedit/images', '이미지 디렉토리'),
(406, '/home/anywiz/wizhome/www/admin2/common.php', '설정파일'),
(407, '/home/anywiz/wizhome/www/admin2/dbcon.php', 'DB 접속 정보'),
(408, '/home/anywiz/wizhome/www/admin2/desc_file.php', '파일구조'),
(409, '/home/anywiz/wizhome/www/admin2/desc_table.php', '디비스키마'),
(410, '/home/anywiz/wizhome/www/admin2/index.php', '관리자 인덱스페이지'),
(411, '/home/anywiz/wizhome/www/admin2/install.php', '솔루션 설치 정보 입력'),
(412, '/home/anywiz/wizhome/www/admin2/install_ok.php', '솔루션 설치'),
(413, '/home/anywiz/wizhome/www/admin2/lib.php', '함수선언'),
(414, '/home/anywiz/wizhome/www/admin2/login.php', '관리자 로그인'),
(415, '/home/anywiz/wizhome/www/admin2/logout.php', '관리자 로그아웃'),
(416, '/home/anywiz/wizhome/www/admin2/phpinfo.php', 'PHP 정보 phpinfo()'),
(417, '/home/anywiz/wizhome/www/admin2/query.php', '쿼리문'),
(418, '/home/anywiz/wizhome/www/admin2/site_key.php', '라이센스키 입력'),
(419, '/home/anywiz/wizhome/www/admin2/manage/bbs/group.php', '게시판그룹 목록'),
(420, '/home/anywiz/wizhome/www/admin2/manage/bbs/group_input.php', '게시판그룹 입력'),
(421, '/home/anywiz/wizhome/www/admin2/manage/bbs/list_b.php', '게시물 목록 백업'),
(422, '/home/anywiz/wizhome/www/admin2/manage/config/prd_config.php', '상품관리'),
(423, '/home/anywiz/wizhome/www/admin2/manage/config/prdmain_config.php', '메인상품관리');
*/
?>
