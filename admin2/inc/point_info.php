<?
$sql = "select point_use, point_skin, point_url from wiz_siteinfo";
$result = mysql_query($sql) or error(mysql_error());
$point_info = mysql_fetch_array($result);

// 스킨위치
$skin_dir = "/admin2/point/skin/".$point_info[point_skin];

?>
