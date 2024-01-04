<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>

<?
if($mode == "dellist"){
	
	$sql = "delete from wiz_contime";
	mysql_query($sql);
	
	complete("초기화 되었습니다.","connect_list.php");
	
}else if($mode == "delrefer"){
	
	$sql = "delete from wiz_conrefer";
	mysql_query($sql);
	
	complete("초기화 되었습니다.","connect_refer.php");
	
}else if($mode == "delos"){
	
	$sql = "delete from wiz_conother";
	mysql_query($sql);
	
	complete("초기화 되었습니다.","connect_osbrowser.php");
	
}
?>
