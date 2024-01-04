<?
$sql = "select msg_use, msg_skin, msg_url from wiz_siteinfo";
$result = mysql_query($sql) or error(mysql_error());
$msg_info = mysql_fetch_array($result);

// 스킨위치
$skin_dir = "/admin2/message/skin/".$msg_info[msg_skin];

$img_width = "440";
?>
