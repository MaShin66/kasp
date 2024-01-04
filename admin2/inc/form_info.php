<?
	
$sql = "select * from wiz_forminfo where code = '$code'";
$result = mysql_query($sql) or error(mysql_error());
$form_info = mysql_fetch_array($result);

// 스킨위치
$skin_dir = "/admin2/form/skin/".$form_info[skin];
?>
