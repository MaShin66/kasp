<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?

$upfile_path = "../../data/category/".$code;			// 업로드파일 위치
$upfile_idx = date('ymdhis').rand(1,9);						// 업로드파일명

// 업로드 디렉토리 생성
if(!is_dir($upfile_path)) mkdir($upfile_path, 0707);

if($mode == "insert"){

	$sql = "insert into wiz_bbsinfo
							(code,type,title,titleimg,header,footer,category,bbsadmin,lpermi,rpermi,wpermi,apermi,cpermi,datetype_list,datetype_view,skin,permsg,perurl,pageurl,editor,usetype,privacy,sms,upfile,movie,comment,remail,imgview,recom,abuse,abtxt,simgsize,mimgsize,rows,lists,newc,hotc,line,subject_len,view_point,write_point,down_point,comment_point,recom_point,point_msg,img_align,btn_view,spam_check,view_list,name_type,grp,prior)
			values('$code','BBS','$title','$titleimg','$header','$footer','$category','$bbsadmin','$lpermi','$rpermi','$wpermi','$apermi','$cpermi','$datetype_list','$datetype_view','$skin','$permsg','$perurl','$pageurl','$editor','$usetype','$privacy','$sms','$upfile','$movie','$comment','$remail','$imgview','$recom','$abuse','$abtxt','$simgsize','$mimgsize','$rows','$lists','$newc','$hotc','$line','$subject_len','$view_point','$write_point','$down_point','$comment_point','$recom_point','$point_msg','$img_align','$btn_view','$spam_check','$view_list','$name_type','$grp','$prior')";

	mysql_query($sql) or error("이미등록된 게시판입니다.");

	if(strcmp($name_type, "name")) {

		$sql = "select infouse from wiz_meminfo";
		$result = mysql_query($sql) or error(mysql_error());
		$row = mysql_fetch_array($result);

		$infouse = $row[infouse];

		if(!strcmp($name_type, "icon") || !strcmp($name_type, "iname") || !strcmp($name_type, "inick")) {
			if(strpos($infouse,"icon") == false) $infouse = $infouse."icon/";
		}

		if(!strcmp($name_type, "nick") || !strcmp($name_type, "inick")) {
			if(strpos($infouse,"nick") == false) $infouse = $infouse."nick/";
		}

		$sql = "update wiz_meminfo set infouse='$infouse'";
		mysql_query($sql) or error(mysql_error());

	}

$skin = "
<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
[LOOP]
<tr>
  <td width=\"5\" height=\"20\"><img src=\"/admin2/bbsmain/image/point.gif\" width=\"3\" height=\"3\"></td>
  <td width=\"5\"></td>
  <td align=\"left\"><a href=\"{LINK}\">{SUBJECT}</a>{NEW}</td>
  <td align=\"right\">{DATE}</td>
</tr>
[/LOOP]
</table>
";

	$sql = "insert into wiz_bbsmain(code,btype,purl,cnt,line,skin,subject_len,content_len)
							 values('$code','','', '5', '0', '$skin', '30', '80')";

	mysql_query($sql) or error(mysql_error());

	//전체 카테고리 추가
	if(empty($catname)) $catname = "전체";
  $sql = "insert into wiz_bbscat (idx,gubun,code,catname,catimg,catimg_over,caticon,prior)
  				values('','A','$code','$catname','$catimg_tmp','$catimg_over_tmp','$caticon_tmp','$prior')";
  mysql_query($sql) or error(mysql_error());

	complete("게시판을 추가 하였습니다.","bbs_list.php");


}else if($mode == "update"){

	$sql = "update wiz_bbsinfo set title='$title',titleimg='$titleimg',header='$header',footer='$footer',category='$category',bbsadmin='$bbsadmin',
					lpermi='$lpermi',rpermi='$rpermi',wpermi='$wpermi',apermi='$apermi',cpermi='$cpermi',datetype_list='$datetype_list',datetype_view='$datetype_view',skin='$skin',
					permsg='$permsg',perurl='$perurl',pageurl='$pageurl',editor='$editor',usetype='$usetype',privacy='$privacy',sms='$sms',
					upfile='$upfile',movie='$movie',comment='$comment',remail='$remail',imgview='$imgview',recom='$recom',abuse='$abuse',abtxt='$abtxt',
					simgsize='$simgsize',mimgsize='$mimgsize',rows='$rows',lists='$lists',newc='$newc',hotc='$hotc',line='$line',subject_len='$subject_len',
					view_point='$view_point',write_point='$write_point',down_point='$down_point',comment_point='$comment_point',recom_point='$recom_point',point_msg = '$point_msg', img_align='$img_align',
					btn_view='$btn_view', spam_check='$spam_check', view_list='$view_list', name_type='$name_type', grp='$grp', prior='$prior'
					where code = '$code'";

	mysql_query($sql) or error(mysql_error());

	if(strcmp($name_type, "name")) {

		$sql = "select infouse from wiz_meminfo";
		$result = mysql_query($sql) or error(mysql_error());
		$row = mysql_fetch_array($result);

		$infouse = $row[infouse];

		if(!strcmp($name_type, "icon") || !strcmp($name_type, "iname") || !strcmp($name_type, "inick")) {
			if(strpos($infouse,"icon") == false) $infouse = $infouse."icon/";
		}

		if(!strcmp($name_type, "nick") || !strcmp($name_type, "inick")) {
			if(strpos($infouse,"nick") == false) $infouse = $infouse."nick/";
		}

		$sql = "update wiz_meminfo set infouse='$infouse'";
		mysql_query($sql) or error(mysql_error());

	}

	complete("게시판 정보를 수정하였습니다.","bbs_input.php?mode=update&code=$code&page=$page");

}else if($mode == "delete"){

	$sql = "delete from wiz_bbsinfo where code = '$code'";
	mysql_query($sql) or error(mysql_error());

	$sql = "delete from wiz_bbsmain where code = '$code'";
	mysql_query($sql) or error(mysql_error());

	$sql = "delete from wiz_bbscat where code = '$code'";
	mysql_query($sql) or error(mysql_error());

	$sql = "delete from wiz_bbs where code = '$code'";
	mysql_query($sql) or error(mysql_error());

	// 첨부파일, 카테고리 디렉토리 삭제
	rm_dir("../../data/bbs/".$code); rm_dir("../../data/category/".$code);

	complete("해당게시판을 삭제하였습니다.","bbs_list.php");

// 카테고리 입력
} else if(!strcmp($mode, "catinsert")) {

	if(!strcmp($gubun, "A")) {

		$sql = "select gubun from wiz_bbscat where code = '$code' and gubun = 'A'";
		$result = mysql_query($sql) or error(mysql_error());
		$row = mysql_fetch_array($result);

		if(!empty($row[gubun])) {
			error("이미 전체분류가 등록되어 있습니다.", "");
			exit;
		}

	}

	if($catimg[size] > 0){

		file_check($catimg[name]);

		$catimg_tmp = $upfile_idx."_img.".substr($catimg[name],-3);
		copy($catimg[tmp_name], $upfile_path."/".$catimg_tmp);
		chmod($upfile_path."/".$catimg_tmp, 0606);

	}
	if($catimg_over[size] > 0){

		file_check($catimg_over[name]);

		$catimg_over_tmp = $upfile_idx."_img_over.".substr($catimg_over[name],-3);
		copy($catimg_over[tmp_name], $upfile_path."/".$catimg_over_tmp);
		chmod($upfile_path."/".$catimg_over_tmp, 0606);

	}
	if($caticon[size] > 0){

		file_check($caticon[name]);

		$caticon_tmp = $upfile_idx."_icon.".substr($caticon[name],-3);
		copy($caticon[tmp_name], $upfile_path."/".$caticon_tmp);
		chmod($upfile_path."/".$caticon_tmp, 0606);

	}

  $sql = "insert into wiz_bbscat (idx,gubun,code,catname,catimg,catimg_over,caticon,prior)
  				values('','$gubun','$code','$catname','$catimg_tmp','$catimg_over_tmp','$caticon_tmp','$prior')";
  mysql_query($sql) or error(mysql_error());

  $idx = mysql_insert_id();

	echo "<script>window.opener.document.location.href = window.opener.document.URL;</script>";
	complete("저장되었습니다.","category_input.php?code=$code&title=$title&idx=$idx&mode=catupdate");

// 카테고리 수정
} else if(!strcmp($mode, "catupdate")) {

	if(!strcmp($gubun, "A")) {

		$sql = "select gubun from wiz_bbscat where code = '$code' and gubun = 'A' and idx != '$idx'";
		$result = mysql_query($sql) or error(mysql_error());
		$row = mysql_fetch_array($result);

		if(!empty($row[gubun])) {
			error("이미 전체분류가 등록되어 있습니다.", "");
			exit;
		}

	}

	$sql = "select catimg,catimg_over,caticon from wiz_bbscat where idx = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	$cat_row = mysql_fetch_array($result);

	for($ii = 0; $ii < count($delfile); $ii++) {

		if($cat_row[$delfile[$ii]] != ""){
			@unlink($upfile_path."/".$cat_row[$delfile[$ii]]);
			${$delfile[$ii]."_sql"} = " , $delfile[$ii] = '' ";
		}
	}

	if($catimg[size] > 0 || $catimg_over[size] > 0 || $caticon[size]) {
		if(fileperms($upfile_path) != 16837 && fileperms($upfile_path) != 16839 && fileperms($upfile_path) != 16895){
			error("파일업로드시 문제가 발생하였습니다.\\n\\ndata 디렉토리 이하는 모두 쓰기권한이 있어야합니다.","");
		}
	}

	if($catimg[size] > 0){

		file_check($catimg[name]);

		$catimg_tmp = $upfile_idx."_img.".substr($catimg[name],-3);
		copy($catimg[tmp_name], $upfile_path."/".$catimg_tmp);
		chmod($upfile_path."/".$catimg_tmp, 0606);

		if($cat_row[catimg] != ""){
			@unlink($upfile_path."/".$cat_row[catimg]);
		}
		$catimg_sql = " , catimg='$catimg_tmp' ";

	}
	if($catimg_over[size] > 0){

		file_check($catimg_over[name]);

		$catimg_over_tmp = $upfile_idx."_img_over.".substr($catimg_over[name],-3);
		copy($catimg_over[tmp_name], $upfile_path."/".$catimg_over_tmp);
		chmod($upfile_path."/".$catimg_over_tmp, 0606);

		if($cat_row[catimg_over] != ""){
			@unlink($upfile_path."/".$cat_row[catimg_over]);
		}
		$catimg_over_sql = " , catimg_over='$catimg_over_tmp' ";

	}
	if($caticon[size] > 0){

		file_check($caticon[name]);

		$caticon_tmp = $upfile_idx."_icon.".substr($caticon[name],-3);
		copy($caticon[tmp_name], $upfile_path."/".$caticon_tmp);
		chmod($upfile_path."/".$caticon_tmp, 0606);

		if($cat_row[caticon] != ""){
			@unlink($upfile_path."/".$cat_row[caticon]);
		}
		$caticon_sql = " , caticon='$caticon_tmp' ";

	}

  $sql = "update wiz_bbscat set gubun='$gubun', catname='$catname' $catimg_sql $catimg_over_sql $caticon_sql ,prior='$prior' where idx = '$idx'";
  mysql_query($sql) or error(mysql_error());

	echo "<script>window.opener.document.location.href = window.opener.document.URL;</script>";
	complete("수정되었습니다.","category_input.php?code=$code&title=$title&idx=$idx&mode=catupdate");

// 카테고리 삭제
} else if(!strcmp($mode, "catdelete")) {

	$sql = "select gubun, code, catimg, catimg_over, caticon from wiz_bbscat where idx = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	$cat_row = mysql_fetch_array($result);

	if(!strcmp($cat_row[gubun], "A")) {
		error("전체분류는 삭제할 수 없습니다.", "");
		exit;
	}

	@unlink($upfile_path."/".$cat_row[catimg]);
	@unlink($upfile_path."/".$cat_row[catimg_over]);
	@unlink($upfile_path."/".$cat_row[caticon]);

  $sql = "delete from wiz_bbscat where idx = '$idx'";
  mysql_query($sql) or error(mysql_error());

	echo "<script>window.opener.document.location.href = window.opener.document.URL;</script>";
	complete("삭제되었습니다.","category.php?code=$code&title=$title");

}
?>
