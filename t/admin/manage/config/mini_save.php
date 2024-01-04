<?
include_once "../../common.php";
include_once "../../inc/admin_check.php";

$sql = "update wiz_siteinfo set mini_skin='$mini_skin', mini_url = '$mini_url'";
mysql_query($sql) or error(mysql_error());

complete("미니홈피 설정이 저장되었습니다.","mini_config.php");

?>
