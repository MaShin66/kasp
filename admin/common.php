<?
include ("/home/hosting_users/enkasp/www/mysql-compat-master/src/include.php");

@header('P3P: CP="NOI CURa ADMa DEVa TAIa OUR DELa BUS IND PHY ONL UNI COM NAV INT DEM PRE"');

@ini_set("session.use_trans_sid", 0);	// PHPSESSID를 자동으로 넘기지 않음	=> session.auto_start = 0 으로 설정 / PHP 5 이상 버전부터 session.use_trans_sid 설정을 ini_set으로 바꿀 수 없음
@ini_set("url_rewriter.tags","");			// 링크에 PHPSESSID가 따라다니는것을 무력화함

session_save_path("$_SERVER[DOCUMENT_ROOT]/admin/data/session");

if($SESSION_CACHE_LIMITER) session_cache_limiter($SESSION_CACHE_LIMITER);
else session_cache_limiter('private, must-revalidate');

@ini_set("session.cache_expire", 1440);			// 세션 캐쉬 보관시간 (분)
@ini_set("session.gc_maxlifetime", 86400);	// session data의 gabage collection 존재 기간을 지정 (초)

session_set_cookie_params(0, "/");
@ini_set("session.cookie_domain", "");

@session_start();

// register_globals off 처리
@extract($_GET);
@extract($_POST);
@extract($_SERVER);
@extract($_ENV);
@extract($_SESSION);
@extract($_COOKIE);
@extract($_REQUEST);
@extract($_FILES);

define(WIZHOME_DIR, "admin");
define(WIZHOME_PATH, $_SERVER['DOCUMENT_ROOT']."/".WIZHOME_DIR);

@header("Content-Type: text/html; charset=UTF-8");
//echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";

/******************************************************************************
* 위즈홈 설치확인
******************************************************************************/
if(!file_exists(WIZHOME_PATH."/dbcon.php")){
	echo "<script>document.location='/admin/install.php';</script>";
	exit;
}

/******************************************************************************
* lib.php
******************************************************************************/
include WIZHOME_PATH."/lib.php";
include WIZHOME_PATH."/lib_puny.php";

/******************************************************************************
* 데이타 베이스 접속
******************************************************************************/
include WIZHOME_PATH."/dbcon.php";
$connect = @mysql_connect($db_host, $db_user, $db_pass) or error("DB 접속시 에러가 발생했습니다.");
@mysql_select_db($db_name, $connect) or error("DB Select 에러가 발생했습니다");

@mysql_query( "set names utf8;" );

/******************************************************************************
* 접속상황 및 이동경로 파악
******************************************************************************/
$con_file = WIZHOME_PATH."/data/connect/".$_SERVER['REMOTE_ADDR'];
@touch($con_file);

/******************************************************************************
* 라이센스 체크
(아래 라이센스 체크 부분을 삭제하거나 변경 할 경우 법적 제제를 받으실수 있습니다.
******************************************************************************/
include WIZHOME_PATH."/licence.php";
?>
