<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>


<?
$upfile_path = "../../data/form/title";						// 업로드파일 위치

if($mode == "update"){

	$sql = "update wiz_forminfo set code='$code',title='$title',skin='$skin',rece_sms='$rece_sms',rece_email='$rece_email',rece_bbs='$rece_bbs',sms_list='$sms_list',email_list='$email_list',agree_use='$agree_use',agree_text='$agree_text' where idx = '$idx'";

	$result = mysql_query($sql) or error(mysql_error());

	complete("폼메일 정보를 수정하였습니다.","form_input.php?mode=update&idx=$idx");


}else if($mode == "delete"){

	$sql = "delete from wiz_forminfo where idx = '$idx'";
	mysql_query($sql) or error(mysql_error());

	$sql = "select fimg from wiz_formfield where fidx = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	while ($row = mysql_fetch_array($result)) {
		@unlink($upfile_path."/".$row[fimg]);
	}

	$sql = "delete from wiz_formfield where fidx = '$idx'";
	mysql_query($sql) or error(mysql_error());

	complete("해당 폼메일을 삭제되었습니다.","form_config.php");


}else if($mode == "field"){

	// 업로드 디렉토리 생성
	if(!is_dir($upfile_path)) mkdir($upfile_path, 0707);

	// 큰 따옴표(") -> 작은 따옴표(')
	$fname = str_replace("\"", "\'", $fname);

	if($sub_mode == "insert"){

		$sql = "select max(fprior) as max_prior from wiz_formfield where fidx = '$fidx'";
		$result = mysql_query($sql) or error(mysql_error());
		$row = mysql_fetch_array($result);

		$fprior = $row[max_prior] + 1;

	 	for($ii = 0; $ii < count($flist); $ii++) {
	 		$tmp_flist .= $flist[$ii];
	 		if($ii < count($flist) - 1) $tmp_flist .= "|";
	 	}

	 	if(!strcmp($ftype, "spamcheck")) $fessen = "Y";

	  $sql = "insert into wiz_formfield (idx,fidx,fprior,fname,ftype,fessen,fsize,fnum,fimg,flist)
	  				values('','$fidx','$fprior','$fname','$ftype','$fessen','$fsize','$fnum','$fimg_tmp','$tmp_flist')";
	  $result = mysql_query($sql) or error(mysql_error());
	  $idx = mysql_insert_id();

	 	if($fimg[size] > 0) {

			file_check($fimg[name]);

			$fimg_tmp = $fidx."_form_".$idx.".".substr($fimg[name],-3);
			copy($fimg[tmp_name], $upfile_path."/".$fimg_tmp);
			chmod($upfile_path."/".$fimg_tmp, 0606);

			$sql = "update wiz_formfield set fimg = '$fimg_tmp' where idx = '$idx'";
			mysql_query($sql) or error(mysql_error());

	 	}

	 	if(!strcmp($continue, "Y")) $idx_param = "&fidx=$fidx";
	 	else $idx_param = "&idx=$idx";

	  echo "<script>alert('필드를 추가하였습니다.'); document.location='form_field_input.php?code=$code".$idx_param."'; window.opener.document.location.reload(); </script>";

	}else if($sub_mode == "update"){

	 	for($ii = 0; $ii < count($flist); $ii++) {
	 		$tmp_flist .= $flist[$ii];
	 		if($ii < count($flist) - 1) $tmp_flist .= "|";
	 	}

	 	if($fimg[size] > 0) {

	 		$sql = "select fidx, fimg from wiz_formfield where idx = '$idx'";
	 		$result = mysql_query($sql) or error(mysql_error());
	 		$row = mysql_fetch_array($result);

			file_check($fimg[name]);

		 	if($fimg[size] > 0) {

				file_check($fimg[name]);

				$fimg_tmp = $row[fidx]."_form_".$idx.".".substr($fimg[name],-3);
				copy($fimg[tmp_name], $upfile_path."/".$fimg_tmp);
				chmod($upfile_path."/".$fimg_tmp, 0606);

				if($row[fimg] != "" && strcmp($row[fimg], $fimg_tmp)){
					@unlink($upfile_path."/".$row[fimg]);
				}
				$fimg_sql = " , fimg='$fimg_tmp' ";
		 	}

	 	}

	 	if(!strcmp($ftype, "spamcheck")) $fessen = "Y";

	  $sql = "update wiz_formfield set fname='$fname',ftype='$ftype',fessen='$fessen',fsize='$fsize',fnum='$fnum',flist='$tmp_flist' $fimg_sql where idx = '$idx'";
	  $result = mysql_query($sql) or error(mysql_error());

		echo "<script>alert('필드를 수정하였습니다.'); document.location='form_field_input.php?mode=update&idx=$idx&fidx=$fidx&code=$code'; window.opener.document.location.reload(); </script>";

	}else if($sub_mode == "delete"){

 		$sql = "select fimg from wiz_formfield where idx = '$idx'";
 		$result = mysql_query($sql) or error(mysql_error());
 		$row = mysql_fetch_array($result);

		if($row[fimg] != ""){
			@unlink($upfile_path."/".$row[fimg]);
		}

	  $sql = "delete from wiz_formfield where idx = '$idx'";
	  $result = mysql_query($sql) or error(mysql_error());

	  complete("필드를 삭제하였습니다.","form_field.php?mode=update&fmode=$fmode&fidx=$fidx&code=$code");

	}else if($sub_mode == "delimg") {

		$sql = "select fimg from wiz_formfield where idx = '$idx'";
		$result = mysql_query($sql) or error(mysql_error());
		$row = mysql_fetch_array($result);

		if($row[fimg] != ""){
			@unlink($upfile_path."/".$row[fimg]);

			$sql = "update wiz_formfield set fimg = '' where idx = '$idx'";
			mysql_query($sql) or error(mysql_error());
		}

	  complete("항목 이미지를 삭제하였습니다.","form_field_input.php?mode=update&idx=$idx&fidx=$fidx&code=$code");

	}

// 진열순서
}else if($mode == "prior"){

	$sql = "select idx, fprior from wiz_formfield where fidx = '$fidx' ";

	// 1단계위로
	if($posi == "up"){

		$sql .= " and fprior <= '$prior' and idx != '$idx' order by fprior desc limit 1";
		$result = mysql_query($sql) or error(mysql_error());

		if($row = mysql_fetch_object($result)){

			$sql = "update wiz_formfield set fprior = '$row->fprior' where idx = '$idx'";
			mysql_query($sql) or error(mysql_error());

			$sql = "update wiz_formfield set fprior = '$prior' where idx = '$row->idx'";
			mysql_query($sql) or error(mysql_error());

		}

	// 1단계아래로
	}else if($posi == "down"){

		$sql .= " and fprior >= '$prior' and idx != '$idx' order by fprior asc  limit 1";
		$result = mysql_query($sql) or error(mysql_error());

		if($row = mysql_fetch_object($result)){

			$sql = "update wiz_formfield set fprior = '$row->fprior' where idx = '$idx'";
			mysql_query($sql) or error(mysql_error());

			$sql = "update wiz_formfield set fprior = '$prior' where idx = '$row->idx'";
			mysql_query($sql) or error(mysql_error());

		}

	}

   complete("진열순서를 변경하였습니다.","form_field.php?fmode=$fmode&fidx=$fidx&code=$code");

}
?>
