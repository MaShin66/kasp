<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>

<?

	$content = trim($content);
	
	// 추가
	if($mode == "insert"){
	
	$sql = "insert into wiz_popup(idx,isuse,scroll,posi_x,posi_y,size_x,size_y,sdate,edate,linkurl,popup_type,title,content,wdate)
									values('','$isuse', '$scroll', '$posi_x', '$posi_y', '$size_x', '$size_y', '$sdate', '$edate', '$linkurl', '$popup_type', '$title', '$content',now())";
	
	$result = mysql_query($sql) or error(mysql_error());
	
	complete("추가되었습니다.","popup_list.php");
	
	
	// 수정
	}else if($mode == "update"){
	
	$sql = "update wiz_popup set isuse='$isuse', scroll='$scroll', posi_x='$posi_x', posi_y='$posi_y', size_x='$size_x', size_y='$size_y',
					sdate='$sdate', edate='$edate', linkurl='$linkurl', popup_type='$popup_type', title='$title', content='$content' where idx = '$idx'";

	$result = mysql_query($sql) or error(mysql_error());
	
	complete("수정되었습니다.","popup_input.php?mode=update&idx=$idx&page=$page");
	
	
	// 삭제
	}else if($mode == "delete"){
	
	$sql = "delete from wiz_popup where idx = '$idx'";
	
	$result = mysql_query($sql) or error(mysql_error());
	
	complete("삭제되었습니다.","popup_list.php");
	
	}

?>
