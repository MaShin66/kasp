<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?

$param = "searchopt=".$searchopt."&searchkey=".$searchkey."&s_ptype=".$s_ptype."&s_mode=".$s_mode;

if($mode == "config") {
	
	$sql = "select * from wiz_siteinfo";
	$result = mysql_query($sql) or error(mysql_error());
	$exist = mysql_num_rows($result);

	if($exist > 0){
		$sql = "update wiz_siteinfo set join_point = '$join_point', login_point = '$login_point',msg_point='$msg_point',view_point='$view_point',write_point='$write_point',down_point='$down_point',comment_point='$comment_point',recom_point='$recom_point',point_msg='$point_msg'";
	}else{
		$sql = "insert into wiz_siteinfo(join_point,login_point,msg_point,view_point,write_point,down_point,comment_point,recom_point,point_msg)
						values('$join_point','$login_point','$msg_point','$view_point','$write_point','$down_point','$comment_point','$recom_point','$point_msg')";
	}

	$result = mysql_query($sql) or error(mysql_error());

	complete("수정되었습니다.","point_config.php");

} else if(!strcmp($mode, "delete")) {
	
	$sql = "delete from wiz_point where idx = '$idx'";
	mysql_query($sql) or error(mysql_error());
	
	complete("삭제되었습니다.","point_list.php");

} else if(!strcmp($mode, "delpoint")) {
	
	$selidx_list = explode("|", $selidx);
	
	for($ii = 0; $ii < count($selidx_list); $ii++) {
		
		$idx = $selidx_list[$ii];
		
		$sql = "delete from wiz_point where idx = '$idx'";
		mysql_query($sql) or error(mysql_error());
		
	}
	
	complete("삭제되었습니다.","point_list.php");

}
?>
