<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?

$upfile_path = "../../data/product";						// 업로드파일 위치

if($mode == "insert"){

	if($catname == "") error("분류명을 입력하세요.");

	// 카테고리넘버,깊이
	$parent_catcode = $catcode;

   $catnum1 = substr($catcode,0,2);
   $catnum2 = substr($catcode,2,2);
   $catnum3 = substr($catcode,4,2);

   if(empty($depthno)) $depthno = 0;

   if($depthno == 0){ $sposi = 1; $tmpcode = ""; }
   else if($depthno == 1){  $sposi = 3;  $tmpcode = $catnum1; }
   else if($depthno == 2){  $sposi = 5;  $tmpcode = $catnum1.$catnum2; }

   $sql = "select max(substring(catcode,$sposi,2)) as catnum from wiz_category where catcode like '$tmpcode%'";
   $result = mysql_query($sql) or error(mysql_error());
   $row = mysql_fetch_object($result);
   $row->catnum = substr(++$row->catnum."0",0,2);

   if($depthno == 0){ $catcode = $row->catnum."0000";}
   else if($depthno == 1){  $catcode = $catnum1.$row->catnum."00";}
   else if($depthno == 2){  $catcode = $catnum1.$catnum2.$row->catnum;}


   // 우선순위 설정
   $sql = "select * from wiz_category where catcode like '$tmpcode%' order by priorno01 desc, priorno02 desc, priorno03 desc";
   $result = mysql_query($sql) or error(mysql_error());
   $row = mysql_fetch_object($result);

   $priorno01 = $row->priorno01;
   $priorno02 = $row->priorno02;
   $priorno03 = $row->priorno03;

   if($depthno == 0){ ++$priorno01; }
   else if($depthno == 1){  ++$priorno02;}
   else if($depthno == 2){  ++$priorno03;}

   $depthno++;

   // 메뉴이미지 저장
   if($catimg[size] > 0){
		file_check($catimg[name]);
   	$catimg_ext = strtolower(substr($catimg[name],-3));
    $catimg_name = $catcode."_cat.".$catimg_ext;
	  copy($catimg[tmp_name], $upfile_path."/".$catimg_name);
	  chmod($upfile_path."/".$catimg_name,0606);
   }

   // 카테고리명에 따음표 들어가면 상품등록시 스크립트 에러
   $catname = str_replace("\"","”",$catname);
   $catname = str_replace("'","′",$catname);

   //  카테고리 저장
   $sql = "insert into wiz_category(catcode,depthno,priorno01,priorno02,priorno03,catname,catuse,catimg,subimg,subimg_type,prd_skin,prd_num,prd_width,prd_height,purl)
				values('$catcode','$depthno','$priorno01','$priorno02','$priorno03','$catname','$catuse','$catimg_name','$subimg','$subimg_type','$prd_skin','$prd_num','$prd_width','$prd_height','$purl')";
   $result = mysql_query($sql) or error(mysql_error());

	$depthno--;

	complete("상품분류를 추가하였습니다.","prd_cat.php?mode=$mode&catcode=$parent_catcode&depthno=$depthno");


}else if($mode == "update"){

	// 메뉴이미지 저장
	if($delimg != ""){
		unlink($upfile_path."/".$delimg);
	}
	
	if($catimg[size] > 0){
		file_check($catimg[name]);
		$catimg_ext = strtolower(substr($catimg[name],-3));
		$catimg_name = $catcode."_cat.".$catimg_ext;
		copy($catimg[tmp_name], $upfile_path."/".$catimg_name);
		chmod($upfile_path."/".$catimg_name,0606);
		$catimg_sql = " , catimg='$catimg_name' ";
	}

	
   $catname = str_replace("\"","”",$catname);
   $catname = str_replace("'","′",$catname);

	$sql = "update wiz_category set catcode='$catcode',depthno='$depthno',catname='$catname',catuse='$catuse'".$catimg_sql.", subimg='$subimg',subimg_type='$subimg_type',prd_skin='$prd_skin',prd_num='$prd_num',prd_width='$prd_width',prd_height='$prd_height',purl='$purl' where catcode = '$catcode'";

	mysql_query($sql) or error(mysql_error());

	// 분류숨김시 하위분류도 모두 숨김
	if($catuse == "N" || (empty($catuse) && strcmp($org_catuse, $catuse))){
		if($depthno == "1") $tmp_catcode = substr($catcode,0,2);
		else if($depthno == "2") $tmp_catcode = substr($catcode,0,4);
		if($tmp_catcode != ""){
			$sql = "update wiz_category set catuse='$catuse' where catcode like '$tmp_catcode%'";
			//echo $sql;
			mysql_query($sql) or error(mysql_error());
		}
	}
	
	complete("분류정보를 수정하였습니다.","prd_cat.php?mode=$mode&catcode=$catcode&depthno=$depthno");

}else if($mode == "delete"){



	if($depthno == 1){ $tmpcode = substr($catcode,0,2); }
   else if($depthno == 2){ $tmpcode = substr($catcode,0,4); }
   else if($depthno == 3){ $tmpcode = $catcode; }

   //$depthno = $depthno-1;
   // 하위분류가 존재하면 삭제하지 못함
   $sql = "select catcode from wiz_category where catcode != '$catcode' and catcode like '$tmpcode%'";
   $result = mysql_query($sql) or error(mysql_error());
   if($row = mysql_fetch_object($result)){
      echo "<script>alert('하위분류가 존재합니다. 삭제하실 수 없습니다.');document.location='prd_cat.php?mode=update&catcode=$catcode&depthno=$depthno';</script>";
      exit;
   }


   // 현재 또는 하위분류에 상품이 존재하면 삭제하지 못함
   $sql = "select wp.prdcode from wiz_cprelation wc, wiz_product wp where wc.catcode = '$catcode' and wc.prdcode = wp.prdcode";
   $result = mysql_query($sql) or error(mysql_error());
   if($row = mysql_fetch_object($result)){
      echo "<script>alert('현재분류에 상품이 존재합니다. 삭제하실 수 없습니다.');document.location='prd_cat.php?mode=update&catcode=$catcode&depthno=$depthno';</script>";
      exit;
   }


   // 선택분류 삭제
   $sql = "delete from wiz_category where catcode = '$catcode'";
   $result = mysql_query($sql) or error(mysql_error());

   complete("선택하신 분류를 삭제하였습니다.","prd_cat.php?mode=$mode&catcode=$catcode&depthno=$depthno");


// 카테고리 우선순위
}else if($mode == "updateprior"){

	if($catcode != ""){

		$break = false;
		$sel_row = ""; $chg_row = ""; $tmp_row = "";
		$sql = "select * from wiz_category where depthno = '$depthno' order by priorno01, priorno02, priorno03 asc";
		$result = mysql_query($sql) or error(mysql_error());
		while($row = mysql_fetch_object($result)){
	
			if($break == true) { $chg_row = $row; break;}
	
			if($row->catcode == $catcode){
				$sel_row = $row;
				if($posi == "up"){
					$chg_row = $tmp_row;
				}else if($posi == "down"){
					$break = true;
				}
			}
	
			$tmp_row = $row;
			
	}

	if($depthno == 1){
		
		$sel_catcode = substr($sel_row->catcode,0,2);
		$chg_catcode = substr($chg_row->catcode,0,2);

		$sel_sql = " priorno01='$chg_row->priorno01' ";
		$chg_sql = " priorno01='$sel_row->priorno01' ";

	}else if($depthno == 2){
		
		$sel_catcode = substr($sel_row->catcode,0,4);
		$chg_catcode = substr($chg_row->catcode,0,4);

		$sel_sql = " priorno02='$chg_row->priorno02' ";
		$chg_sql = " priorno02='$sel_row->priorno02' ";

	}else if($depthno == 3){
		
		$sel_catcode = $sel_row->catcode;
		$chg_catcode = $chg_row->catcode;

		$sel_sql = " priorno03='$chg_row->priorno03' ";
		$chg_sql = " priorno03='$sel_row->priorno03' ";
		
	}


	if($chg_row->catcode != ""){

		$sql = "update wiz_category set $sel_sql where catcode like '$sel_catcode%'";
		mysql_query($sql) or error(mysql_error());

		$sql = "update wiz_category set $chg_sql where catcode like '$chg_catcode%'";
		mysql_query($sql) or error(mysql_error());

	}

	}

  Header("Location: prd_cat.php?mode=update&catcode=$catcode&depthno=$depthno");

}else if($mode == "delsubimg"){

	exec("rm -f ../../images/subimg/".$catcode."_sub.*");
	$sql = "update wiz_category set subimg = '' where catcode = '$catcode'";
	mysql_query($sql) or error(mysql_error());
	Header("Location: prd_cat.php?mode=update&catcode=$catcode&depthno=$depthno");

}else if($mode == "delcatimg"){

	exec("rm -f ../../images/catimg/".$catcode."_cat.*");
	$sql = "update wiz_category set catimg = '' where catcode = '$catcode'";
	mysql_query($sql) or error(mysql_error());
	Header("Location: prd_cat.php?mode=update&catcode=$catcode&depthno=$depthno");

}else if($mode == "delcatimg_over"){

	exec("rm -f ../../images/catimg/".$catcode."_cat_over.*");
	$sql = "update wiz_category set catimg_over = '' where catcode = '$catcode'";
	mysql_query($sql) or error(mysql_error());
	Header("Location: prd_cat.php?mode=update&catcode=$catcode&depthno=$depthno");

}



?>
