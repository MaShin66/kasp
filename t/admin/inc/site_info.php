<?
$sql = "select * from wiz_siteinfo";
$result = mysql_query($sql) or error(mysql_error());
$site_info = mysql_fetch_array($result);

if(!strcmp($site_info[ssl_use], "Y")) {
	$ssl = "https://".$_SERVER[HTTP_HOST];
	if(!empty($site_info[ssl_port])) $ssl .= ":".$site_info[ssl_port];
} else {
	$hide_ssl_start = "<!--"; $hide_ssl_end = "-->";
}
$icon_size = 25;
?>
