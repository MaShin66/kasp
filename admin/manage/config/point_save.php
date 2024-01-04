<?
include_once "../../common.php";
include_once "../../inc/admin_check.php";

$sql = "update wiz_siteinfo set point_skin='$point_skin', point_url = '$point_url'";
mysql_query($sql) or error(mysql_error());

complete("설정이 저장되었습니다.","point_config.php");

?>
