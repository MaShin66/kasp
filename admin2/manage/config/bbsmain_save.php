<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?
if(!get_magic_quotes_gpc()) $skin = addslashes($skin);

if($mode == "insert"){
	
	$sql = "select max(idx) as idx from wiz_bbsmain";
	$result = mysql_query($sql) or error(mysql_error());
	$row = mysql_fetch_array($result);
	$idx = $row[idx] + 1;
	
	$sql = "insert into wiz_bbsmain(idx,code,btype,purl,cnt,line,skin,subject_len,content_len) 
							 values('$idx','$code','$btype','$purl', '$cnt', '$line', '$skin', '$subject_len', '$content_len')";
	$result = mysql_query($sql) or error(mysql_error());
	
	complete("저장 되었습니다.","bbsmain_input.php?code=$code&idx=$idx");
	
}else if($mode == "update"){
	
	$sql = "update wiz_bbsmain set btype='$btype', purl='$purl', cnt='$cnt', line='$line', skin='$skin', subject_len='$subject_len', content_len='$content_len' where code = '$code' and idx = '$idx'";

	$result = mysql_query($sql) or error(mysql_error());

	complete("수정 되었습니다.","bbsmain_input.php?code=$code&idx=$idx");
	
}else if(!strcmp($mode, "delete")) {
	$sql = "delete from wiz_bbsmain where code = '$code' and idx = '$idx'";
	mysql_query($sql) or error(mysql_error());
	
	complete("삭제 되었습니다.","bbsmain_config.php");
}


?>
