<?
include_once "../../common.php";
include_once "../../inc/admin_check.php";

$sql = "update wiz_siteinfo set msg_skin='$msg_skin', msg_url = '$msg_url'";
mysql_query($sql) or error(mysql_error());

complete("쪽지설정이 저장되었습니다.","message_config.php");

?>
