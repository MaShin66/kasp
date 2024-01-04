<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?

if($mode == "ban_insert"){
	
	$sql = "insert into wiz_bannerinfo (idx,title,code,types,types_num,padding,isuse)
					values('','$title','$code','$types','$types_num','$padding','$isuse')";
	mysql_query($sql) or error(mysql_error());

	complete("배너그룹을 추가 하였습니다.","banner_list.php");

}else if($mode == "ban_update"){

	$sql = "update wiz_bannerinfo set title='$title',types='$types',types_num='$types_num',padding='$padding',isuse='$isuse' where idx = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());

	complete("배너그룹 정보를 수정하였습니다.","banner_input.php?mode=ban_update&idx=$idx&page=$page");

}else if($mode == "ban_delete"){

	$sql = "delete from wiz_bannerinfo where idx = '$idx'";
	mysql_query($sql) or error(mysql_error());
	
	$banner_path = "../../data/banner";

	$sql = "SELECT de_img FROM wiz_banner WHERE code = '$code'";
	$result = mysql_query($sql) or error(mysql_error());
	while ($row = mysql_fetch_array($result)) {
		if(!empty($row[de_img])) {
			@unlink($banner_path."/".$row[de_img]);
		}
	}
	
	$sql = "delete from wiz_banner where code = '$code'";
	mysql_query($sql) or error(mysql_error());
	
	complete("해당배너그룹을 삭제하였습니다.","banner_list.php");

} else if(!strcmp($mode, 'insert')) {

	$banner_path = "../../data/banner";
	$upfile_idx = date('ymdhis').rand(1,9);						// 업로드파일명
	
	// 업로드 디렉토리 생성
	if(!is_dir($banner_path)) mkdir($banner_path, 0707);

	if($de_img[size] > 0){
		
		if(fileperms($banner_path) != 16837 && fileperms($banner_path) != 16839 && fileperms($banner_path) != 16895){
			error("파일업로드시 문제가 발생하였습니다.\\n\\ndata 디렉토리 이하는 모두 쓰기권한이 있어야합니다.","");
		}
		
		file_check($de_img[name]);
		
		$de_img_name = $code."_".$upfile_idx.".".substr($de_img[name],-3);
		
		copy($de_img[tmp_name], $banner_path."/".$de_img_name);
		chmod($banner_path."/".$de_img_name, 0606);
	}
	
	if(!get_magic_quotes_gpc()) $content= addslashes($content);
	
	$sql = "insert into wiz_banner (idx,code,align,prior,isuse,link_url,link_target,de_type,de_img,de_html)
					values('','$code','$align','$prior','$isuse','$link_url','$link_target','$de_type','$de_img_name','$content')";

	mysql_query($sql) or error(mysql_error());

	complete("배너를 추가 하였습니다.","list.php?code=$code");



} else if(!strcmp($mode, "update")) {

	$banner_path = "../../data/banner";
	$upfile_idx = date('ymdhis').rand(1,9);						// 업로드파일명

	// 업로드 디렉토리 생성
	if(!is_dir($banner_path)) mkdir($banner_path, 0707);

	if($de_img[size] > 0){

		if(fileperms($banner_path) != 16837 && fileperms($banner_path) != 16839 && fileperms($banner_path) != 16895){
			error("파일업로드시 문제가 발생하였습니다.\\n\\ndata 디렉토리 이하는 모두 쓰기권한이 있어야합니다.","");
		}
		
		file_check($de_img[name]);
		
		$sql = "SELECT de_img FROM wiz_banner WHERE idx = '$idx'";
		$result = mysql_query($sql) or error(mysql_error());
		$row = mysql_fetch_array($result);

		if(!empty($row[de_img])) {
			@unlink($banner_path."/".$row[de_img]);
		}

		$de_img_name = $code."_".$upfile_idx.".".substr($de_img[name],-3);
		
		copy($de_img[tmp_name], $banner_path."/".$de_img_name);
		chmod($banner_path."/".$de_img_name, 0606);
		
		$de_img_sql = " de_img='$de_img_name', ";

	}

	if(!get_magic_quotes_gpc()) $content= addslashes($content);

	$sql = "update wiz_banner set code='$code',align='$align', prior='$prior', isuse='$isuse', link_url='$link_url',
					link_target='$link_target', de_type='$de_type', $de_img_sql de_html='$content' where idx = '$idx'";
	mysql_query($sql) or error(mysql_error());

	complete("배너를 수정 하였습니다.","input.php?mode=update&idx=$idx&code=$code&page=$page");



} else if(!strcmp($mode, 'delete')) {
	
	$banner_path = "../../data/banner";

	$sql = "SELECT de_img FROM wiz_banner WHERE idx = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	$row = mysql_fetch_array($result);

	if(!empty($row[de_img])) {
		@unlink($banner_path."/".$row[de_img]);
	}

	$sql = "delete from wiz_banner where idx = '$idx'";
	mysql_query($sql) or error(mysql_error());

	complete("배너를 삭제하였습니다.","list.php?code=$code");

}
?>
