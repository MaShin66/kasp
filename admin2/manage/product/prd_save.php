<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<? include_once "../../inc/prd_info.php"; ?>
<?

// 검색 파라미터
$param = "page=$page&dep_code=$dep_code&dep2_code=$dep2_code&dep3_code=$dep3_code&searchopt=$searchopt&searchkey=$searchkey";


if($mode == "insert"){

	// 상품넘버 만들기
	$sql = "select max(prdcode) as prdcode from wiz_product";
	$result = mysql_query($sql) or error(mysql_error());
	if($row = mysql_fetch_object($result)){

	  $datenum = substr($row->prdcode,0,6);
	  $tmp_prdnum = substr($row->prdcode,6,4);
	  $tmp_prdnum = substr("000".(++$tmp_prdnum),-4);

	  if($datenum == date('ymd')) $prdcode = $datenum.$tmp_prdnum;
	  else $prdcode = date('ymd')."0001";

	}else{
	  $prdcode = date('ymd')."0001";
	}

	// 상품아이콘
	for($ii=0; $ii<count($prdicon); $ii++){
	  $prdicon_list .= $prdicon[$ii]."/";
	}

	// 상품이미지 저장
	include "./prd_imgup.inc";

	// 첨부파일 저장
	include "./prd_upfile.inc";

	$prdname = str_replace("'","′",$prdname);

	// 상품진열 순서
	$prior = date(ymdHis);

	if(!get_magic_quotes_gpc()) $shortexp= addslashes($shortexp);
	if(!get_magic_quotes_gpc()) $content= addslashes($content);

	// 상품정보 저장
	$sql = "insert into wiz_product
						(prdcode,prdnum,prdname,prdprice,showset,prior,prdicon,recom,
						info_name1,info_value1,info_name2,info_value2,info_name3,info_value3,info_name4,info_value4,info_name5,info_value5,
						info_name6,info_value6,info_name7,info_value7,info_name8,info_value8,info_name9,info_value9,info_name10,info_value10,
						addinfo1,addinfo2,addinfo3,addinfo4,addinfo5,prdimg_R,prdimg_L1,prdimg_M1,prdimg_S1,prdimg_L2,prdimg_M2,prdimg_S2,
						prdimg_L3,prdimg_M3,prdimg_S3,prdimg_L4,prdimg_M4,prdimg_S4,prdimg_L5,prdimg_M5,prdimg_S5,
						prdimg_L6,prdimg_M6,prdimg_S6,prdimg_L7,prdimg_M7,prdimg_S7,prdimg_L8,prdimg_M8,prdimg_S8,
						prdimg_L9,prdimg_M9,prdimg_S9,prdimg_L10,prdimg_M10,prdimg_S10,prdimg_L11,prdimg_M11,prdimg_S11,
						prdimg_L12,prdimg_M12,prdimg_S12,upfile1,upfile2,upfile3,upfile4,upfile5,
						upfile1_name,upfile2_name,upfile3_name,upfile4_name,upfile5_name,shortexp,content)
						values('$prdcode','$prdnum','$prdname','$prdprice','$showset','$prior','$prdicon','$recom',
						'$info_name1','$info_value1','$info_name2','$info_value2','$info_name3','$info_value3','$info_name4','$info_value4','$info_name5','$info_value5',
						'$info_name6','$info_value6','$info_name7','$info_value7','$info_name8','$info_value8','$info_name9','$info_value9','$info_name10','$info_value10',
						'$addinfo1','$addinfo2','$addinfo3','$addinfo4','$addinfo5',
						'$prdimg_R_name','$prdimg_L1_name','$prdimg_M1_name','$prdimg_S1_name',
						'$prdimg_L2_name','$prdimg_M2_name','$prdimg_S2_name',
						'$prdimg_L3_name','$prdimg_M3_name','$prdimg_S3_name',
						'$prdimg_L4_name','$prdimg_M4_name','$prdimg_S4_name',
						'$prdimg_L5_name','$prdimg_M5_name','$prdimg_S5_name',
						'$prdimg_L6_name','$prdimg_M6_name','$prdimg_S6_name',
						'$prdimg_L7_name','$prdimg_M7_name','$prdimg_S7_name',
						'$prdimg_L8_name','$prdimg_M8_name','$prdimg_S8_name',
						'$prdimg_L9_name','$prdimg_M9_name','$prdimg_S9_name',
						'$prdimg_L10_name','$prdimg_M10_name','$prdimg_S10_name',
						'$prdimg_L11_name','$prdimg_M11_name','$prdimg_S11_name',
						'$prdimg_L12_name','$prdimg_M12_name','$prdimg_S12_name',
						'$upfile1_tmp','$upfile2_tmp','$upfile3_tmp','$upfile4_tmp','$upfile5_tmp',
						'$upfile1_name','$upfile2_name','$upfile3_name','$upfile4_name','$upfile5_name',
						'$shortexp','$content')";

	$result = mysql_query($sql) or error(mysql_error());


	// 카테고리 정보 저장
	if(!empty($class03)){
	  $catcode = $class03;
	}else{
	  if(!empty($class02)) $catcode = $class02."00";
	  else {
			if(empty($class01)) $class01 = "00";
	  		$catcode = $class01."0000";
	  	}
	}

	$sql = "insert into wiz_cprelation(idx,prdcode,catcode) values('', '$prdcode', '$catcode')";
	$result = mysql_query($sql) or error(mysql_error());

	complete("상품이 입력되었습니다.","prd_input.php?mode=update&prdcode=$prdcode&$param");


}else if($mode == "update"){

	// 상품이미지 저장
	include "./prd_imgup.inc";

	// 첨부파일 저장
	include "./prd_upfile.inc";

	$prdname = str_replace("'","′",$prdname);


	// 상품아이콘
	for($ii=0; $ii<count($prdicon); $ii++){
	  $prdicon_list .= $prdicon[$ii]."/";
	}

	// 상품이미지 삭제
	for($ii=0; $ii<count($delimg); $ii++){
	if($delimg[$ii] != "") @unlink($imgpath."/".$delimg[$ii]);
	}

	if(!get_magic_quotes_gpc()) $shortexp= addslashes($shortexp);
	if(!get_magic_quotes_gpc()) $content= addslashes($content);

	// 상품정보 저장
	//$sql = "update wiz_product set prdnum='$prdnum',prdname='$prdname',prdprice='$prdprice',showset='$showset',prior='$prior',prdicon='$prdicon',recom='$recom',
	$sql = "update wiz_product set prdnum='$prdnum',prdname='$prdname',prdprice='$prdprice',showset='$showset',prdicon='$prdicon',recom='$recom',

				info_name1='$info_name1',info_value1='$info_value1',
				info_name2='$info_name2',info_value2='$info_value2',
				info_name3='$info_name3',info_value3='$info_value3',
				info_name4='$info_name4',info_value4='$info_value4',
				info_name5='$info_name5',info_value5='$info_value5',

				info_name6='$info_name6',info_value6='$info_value6',
				info_name7='$info_name7',info_value7='$info_value7',
				info_name8='$info_name8',info_value8='$info_value8',
				info_name9='$info_name9',info_value9='$info_value9',
				info_name10='$info_name10',info_value10='$info_value10',

				addinfo1='$addinfo1',addinfo2='$addinfo2',addinfo3='$addinfo3',addinfo4='$addinfo4',addinfo5='$addinfo5',
				prdimg_R='$prdimg_R_name',prdimg_L1='$prdimg_L1_name',prdimg_M1='$prdimg_M1_name',prdimg_S1='$prdimg_S1_name',
				prdimg_L2='$prdimg_L2_name',prdimg_M2='$prdimg_M2_name',prdimg_S2='$prdimg_S2_name',
				prdimg_L3='$prdimg_L3_name',prdimg_M3='$prdimg_M3_name',prdimg_S3='$prdimg_S3_name',
				prdimg_L4='$prdimg_L4_name',prdimg_M4='$prdimg_M4_name',prdimg_S4='$prdimg_S4_name',
				prdimg_L5='$prdimg_L5_name',prdimg_M5='$prdimg_M5_name',prdimg_S5='$prdimg_S5_name',
				prdimg_L6='$prdimg_L6_name',prdimg_M6='$prdimg_M6_name',prdimg_S6='$prdimg_S6_name',
				prdimg_L7='$prdimg_L7_name',prdimg_M7='$prdimg_M7_name',prdimg_S7='$prdimg_S7_name',
				prdimg_L8='$prdimg_L8_name',prdimg_M8='$prdimg_M8_name',prdimg_S8='$prdimg_S8_name',
				prdimg_L9='$prdimg_L9_name',prdimg_M9='$prdimg_M9_name',prdimg_S9='$prdimg_S9_name',
				prdimg_L10='$prdimg_L10_name',prdimg_M10='$prdimg_M10_name',prdimg_S10='$prdimg_S10_name',
				prdimg_L11='$prdimg_L11_name',prdimg_M11='$prdimg_M11_name',prdimg_S11='$prdimg_S11_name',
				prdimg_L12='$prdimg_L12_name',prdimg_M12='$prdimg_M12_name',prdimg_S12='$prdimg_S12_name',
				$upfile_sql shortexp='$shortexp', content='$content' where prdcode = '$prdcode'";

	$result = mysql_query($sql) or error(mysql_error());

	// 카테고리 정보 저장
	if(!empty($class03)){
	  $catcode = $class03;
	}else{
	  if(!empty($class02)) $catcode = $class02."00";
	  else {
			if(empty($class01)) $class01 = "00";
	  		$catcode = $class01."0000";
	  	}
	}

	$sql = "update wiz_cprelation set catcode = '$catcode' where prdcode = '$prdcode' and idx = '$relidx'";
	$result = mysql_query($sql) or error(mysql_error());

	complete("상품정보가 수정되었습니다.","prd_input.php?mode=update&prdcode=$prdcode&$param");

}else if($mode == "delete"){

	if($prdcode){

		// 카테고리 연관 삭제
		$sql = "delete from wiz_cprelation where prdcode = '$prdcode'";
		$result = mysql_query($sql) or error(mysql_error());

		// 상품데이타 삭제
		foreach (glob(WIZHOME_PATH."/data/product/".$prdcode."*") as $filename) {
   		@unlink($filename);
		}

		$sql = "delete from wiz_product where prdcode = '$prdcode'";
		$result = mysql_query($sql) or error(mysql_error());

	}else{

		$array_selected = explode("|",$selvalue);
		$i=0;
		while($array_selected[$i]){

			$tmp_prdcode = $array_selected[$i];

			if($tmp_prdcode){

				// 카테고리 연관 삭제
				$sql = "delete from wiz_cprelation where prdcode = '$tmp_prdcode'";
				$result = mysql_query($sql) or error(mysql_error());

				// 상품데이타 삭제
				foreach (glob(WIZHOME_PATH."/data/product/".$tmp_prdcode."*") as $filename) {
		   		@unlink($filename);
				}

				$sql = "delete from wiz_product where prdcode = '$tmp_prdcode'";
				$result = mysql_query($sql) or error(mysql_error());

			}

			$i++;
		}

	}

	complete("선택한 상품을 삭제하였습니다.","prd_list.php?$param");

// 진열순서
}else if($mode == "prior"){

   if(!empty($dep_code)) $catcode_sql = "wc.catcode like '$dep_code$dep2_code$dep3_code%' and ";
   if(!empty($special)) $special_sql = "wp.$special = 'Y' and ";
   if(!empty($showset)) $showset_sql = "wp.showset = '$showset' and ";
   if(!empty($searchopt)) $search_sql = "wp.$searchopt like '%$searchkey%' and ";

   $sql = "select distinct wp.prdcode, wp.prdname, wp.prior from wiz_product wp, wiz_cprelation wc
                  where $catcode_sql $special_sql $showset_sql $search_sql wc.prdcode = wp.prdcode";

   // 1단계위로
   if($posi == "up"){

   	$sql .= " and wp.prior >= '$prior' and wp.prdcode != '$prdcode' order by wp.prior asc  limit 1";
		$result = mysql_query($sql) or error(mysql_error());

	   if($row = mysql_fetch_object($result)){
	   	//$prior = $row->prior-1;

		   $sql = "update wiz_product set prior = '$row->prior' where prdcode = '$prdcode'";
		   $result = mysql_query($sql) or error(mysql_error());

		   $sql = "update wiz_product set prior = '$prior' where prdcode = '$row->prdcode'";
		   $result = mysql_query($sql) or error(mysql_error());
		}

	// 1단계아래로
	}else if($posi == "down"){

		$sql .= " and wp.prior <= '$prior' and wp.prdcode != '$prdcode' order by wp.prior desc  limit 1";
		$result = mysql_query($sql) or error(mysql_error());

	   if($row = mysql_fetch_object($result)){
	   	//$prior = $row->prior+1;

		   $sql = "update wiz_product set prior = '$row->prior' where prdcode = '$prdcode'";
		   $result = mysql_query($sql) or error(mysql_error());

		   $sql = "update wiz_product set prior = '$prior' where prdcode = '$row->prdcode'";
		   $result = mysql_query($sql) or error(mysql_error());
		}

	// 10단계위로
	}else if($posi == "upup"){

   	$sql .= " and wp.prior >= '$prior'  and wp.prdcode != '$prdcode' order by wp.prior asc  limit 10";

   	$result = mysql_query($sql) or error(mysql_error());
   	$total = mysql_num_rows($result);

	   while($row = mysql_fetch_object($result)){
	   	//$prior = $row->prior+1;
			$sql = "update wiz_product set prior = '$prior' where prdcode = '".$row->prdcode."'";
			mysql_query($sql) or error(mysql_error());

			$prior = $row->prior;
		}

		if($total > 0){
		   $sql = "update wiz_product set prior = '$prior' where prdcode = '$prdcode'";
		   $result = mysql_query($sql) or error(mysql_error());
		}

	// 10단계아래로
	}else if($posi == "downdown"){

	   $sql .= " and wp.prior <= '$prior' and wp.prdcode != '$prdcode' order by wp.prior desc  limit 10";
	   $result = mysql_query($sql) or error(mysql_error());
	   $total = mysql_num_rows($result);

	   while($row = mysql_fetch_object($result)){
	   	//$prior = $row->prior-1;
			$sql = "update wiz_product set prior = '$prior' where prdcode = '".$row->prdcode."'";
			mysql_query($sql) or error(mysql_error());

			$prior = $row->prior;
	   }

		if($total > 0){
		   $sql = "update wiz_product set prior = '$prior' where prdcode = '$prdcode'";
		   $result = mysql_query($sql) or error(mysql_error());
		}
	}

   complete("진열순서를 변경하였습니다.","prd_list.php?$param");

// 상품아이콘
}else if($mode == "prdicon"){

	if($upfile_size > 0){
		copy($upfile, "../../data/product/".$upfile_name);
    chmod("../../data/product/".$upfile_name, 0606);
	}

	complete('등록되었습니다.','prd_icon.php');


// 아이콘삭제
}else if($mode == "icondel"){

	@unlink("../../data/product/".$prdicon);

	complete('삭제되었습니다.','prd_icon.php');

// 관련상품 등록
}else if($mode == "reladd"){

	$array_selected = explode("|",$selected);
	$i=0;
	while($array_selected[$i]){

		$tmp_prdcode = $array_selected[$i];

		$sql = "insert into wiz_prdrelation(idx,prdcode,relcode) values('','$prdcode','$tmp_prdcode')";
		mysql_query($sql) or error(mysql_error());

		$i++;
	}

	echo "<script>opener.document.location.reload();</script>";
	complete("등록되었습니다.","prd_rellist.php?$param");

// 관련상품 삭제
}else if($mode == "reldel"){

	for($ii=0;$ii<count($idx);$ii++){
		$sql = "delete from wiz_prdrelation where idx = '".$idx[$ii]."'";
		//echo $sql."<br>";
		mysql_query($sql);
	}

	complete("삭제되었습니다.","prd_relation.php?prdcode=".$prdcode);

}
?>
