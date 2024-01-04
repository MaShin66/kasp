<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?
if(!get_magic_quotes_gpc()) $mainskin = addslashes($mainskin);

if($mode == "insert"){
	
	$sql = "select max(idx) as idx from wiz_prdmain";
	$result = mysql_query($sql) or error(mysql_error());
	$row = mysql_fetch_array($result);
	$idx = $row[idx] + 1;
	
  $sql = "insert into wiz_prdmain (idx,prdcnt,prdline,maintype,mainskin,prdname_len,prdexp_len) 
  				values('$idx','$prdcnt','$prdline','$maintype','$mainskin','$prdname_len','$prdexp_len')";
  mysql_query($sql) or error(mysql_error()); 
	
	complete("저장 되었습니다.","prdmain_input.php?idx=$idx");
	
}else if($mode == "update"){
	
  $sql = "update wiz_prdmain set prdcnt='$prdcnt',prdline='$prdline',maintype='$maintype',mainskin='$mainskin',prdname_len='$prdname_len',prdexp_len='$prdexp_len' where idx = '$idx'";
  mysql_query($sql) or error(mysql_error()); 
  
	complete("수정 되었습니다.","prdmain_input.php?idx=$idx");
	
}else if(!strcmp($mode, "delete")) {
	$sql = "delete from wiz_prdmain where idx = '$idx'";
	mysql_query($sql) or error(mysql_error());
	
	complete("삭제 되었습니다.","prdmain_config.php");
}

?>
