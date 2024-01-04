<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>

<?

// 등급추가
if($mode == "insert"){

   for($ii=0; $ii<count($permi); $ii++){
      $tmp_permi .= $permi[$ii]."/";
   }
   
   $sql = "insert into wiz_level(idx,level,icon,name,permi,memo) values('','$level','$icon','$name','$tmp_permi','$memo')";
	 $result = mysql_query($sql) or error(mysql_error());

	complete("등록되었습니다.","level_list.php");


// 등급수정
}else if($mode == "update"){
	
	for($ii=0; $ii<count($permi); $ii++){
      $tmp_permi .= $permi[$ii]."/";
   }
   
	$sql = "update wiz_level set level='$level', icon='$icon', name='$name', permi='$tmp_permi', memo='$memo' where idx = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	
	complete("수정되었습니다","level_input.php?mode=update&idx=$idx");
	
	
// 등급삭제
}else if($mode == "delete"){
	
	$sql = "select idx from wiz_level where level > $level order by idx asc limit 1";
	$result = mysql_query($sql) or error(mysql_error());
	$row = mysql_fetch_object($result);
	$chg_level = $row->idx;
	
	$sql = "update wiz_member set level = '$chg_level' where level = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	
	$sql = "update wiz_bbsinfo set lpermi = '$chg_level' where lpermi = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	
	$sql = "update wiz_bbsinfo set rpermi = '$chg_level' where rpermi = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	
	$sql = "update wiz_bbsinfo set wpermi = '$chg_level' where wpermi = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	
	$sql = "update wiz_bbsinfo set apermi = '$chg_level' where apermi = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	
	$sql = "update wiz_bbsinfo set cpermi = '$chg_level' where cpermi = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	
	$sql = "delete from wiz_level where idx = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	
	complete("삭제되었습니다.","level_list.php");
	
}

?>
