<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin/inc/bbs_info.php";

echo "<script Language=\"JavaScript\" src=\"/admin/js/lib.js\"></script>";
echo "<link href=\"".$skin_dir."/style.css\" rel=\"stylesheet\" type=\"text/css\">";

// 검색 파라미터
$param = "code=$code";
if($category != "") $param .= "&category=$category";
if($searchkey != "") $param .= "&searchopt=$searchopt&searchkey=$searchkey";
if($sido != "") $param .= "&sido=$sido";
if($gugun != "") $param .= "&gugun=$gugun";

if($code=="googic"){
	if($addinfo2 != "") $param .= "&addinfo2=$addinfo2";
	if($zipcode != "") $param .="&zipcode=$zipcode"; 
} elseif($code=="gooin"){
	if($zipcode != "") $param .="&zipcode=$zipcode";
	if($w_field != "") $param .="&w_field=$w_field";
	if($w_type != "") $param .="&w_type=$w_type";
	if($salary != "") $param .="&salary=$salary";
	if($c_type1 != "") $param .="&c_type1=$c_type1";
	if($c_type1_1 != "") $param .="&c_type1_1=$c_type1_1";
	if($c_type2 != "") $param .="&c_type2=$c_type2";
	if($c_type3 != "") $param .="&c_type3=$c_type3";
	if($c_type4 != "") $param .="&c_type4=$c_type4";
	if($c_type5 != "") $param .="&c_type5=$c_type5";
	if($c_type6 != "") $param .="&c_type6=$c_type6";
	if($c_type7 != "") $param .="&c_type7=$c_type7";
	if($c_type8 != "") $param .="&c_type8=$c_type8";
}


$line = $bbs_info[line];

// 목록보기 권한체크
if($lpermi < $mem_level) error($bbs_info[permsg],$bbs_info[perurl]);

// 버튼설정
$list_btn = "<a href='$PHP_SELF?ptype=list&code=$code' class='btn_txt btn_line_black'>목록으로</a>";
if($wpermi >= $mem_level) {

	if(!check_point($wiz_session[id], $bbs_info[write_point])) {
		$write_btn = "<img src='$skin_dir/image/btn_write.gif' border='0' onClick=\"alert('$bbs_info[point_msg]');\" style='cursor:pointer'>";
	} else {
		$write_btn = "<a href='$PHP_SELF?ptype=input&mode=insert&code=$code'><img src='$skin_dir/image/btn_write.gif' border='0'></a>";
	}

} else {

	if(!strcmp($bbs_info[btn_view], "Y")) {
		if(!empty($bbs_info[perurl])) $perurl = " document.location='".$bbs_info[perurl]."'; ";
		$write_btn = "<img src='$skin_dir/image/btn_write.gif' border='0' onClick=\"alert('$bbs_info[permsg]'); $perurl \" style='cursor:pointer'>";
	}

}

if($code == 'space_globalnews' && $mem_level== "0"){
	$write_btn = "<img src='$skin_dir/image/btn_write.gif' border='0' onClick=\"alert('$bbs_info[permsg]'); $perurl \" style='cursor:pointer'>";
}

// 관리자인 경우에만 볼수있는 컨텐츠 설정
if(
$mem_level == "0" || 																																			// 전체관리자
($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)			// 게시판관리자
){
} else {
	$hide_admin_start = "<!--"; $hide_admin_end = "-->";
}

// 추천기능 사용여부
if($bbs_info[recom] != "Y"){
	$hide_recom_start = "<!--"; $hide_recom_end = "-->";
}

// 게시물 분류
$sql = "select idx, gubun, catname, catimg, catimg_over from wiz_bbscat where code = '$code' order by gubun desc,prior asc,idx asc";
$result = mysql_query($sql) or error(mysql_error());
$total = mysql_num_rows($result);
if($total > 0) {

	$ii = 0;
	while($row = mysql_fetch_array($result)) {

		if($total < 2 && !strcmp($row[gubun], "A")) {

		} else {

	  	if(empty($row[catimg_over])) $row[catimg_over] = $row[catimg];

	  	if(empty($category) && !strcmp($row[gubun], "A")) $row[catimg] = $row[catimg_over];

	  	if(!empty($row[catimg])) $catname = "<img src='/admin/data/category/".$code."/".$row[catimg]."' name='c_".$ii."' border=0 id='c_".$ii."' onMouseOver=WIZ_swapImage('c_".$ii."','','/admin/data/category/".$code."/".$row[catimg_over]."',1) onMouseOut=WIZ_swapImgRestore()>";
	  	else $catname = $row[catname];

	    if($category == $row[idx]) {
	    	if(!empty($row[catimg])) $catname = "<img src='/admin/data/category/".$code."/".$row[catimg_over]."' name='c_".$ii."' border=0 id='c_".$ii."' onMouseOver=WIZ_swapImage('c_".$ii."','','/admin/data/category/".$code."/".$row[catimg_over]."',1) onMouseOut=WIZ_swapImgRestore()>";
	    	else $catname = "<b>".$catname."</b>";
	    }

			if(!strcmp($row[gubun], "A")) {
				$catlist .= "<a href='$PHP_SELF?ptype=list&code=".$code."'>".$catname."</a>";
			} else {
	    	$catlist .= "<a href='$PHP_SELF?ptype=list&code=".$code."&category=".$row[idx]."'>".$catname."</a>";
	    }

	    if(empty($row[catimg]))  if($ii < $total-1) $catlist .= " | ";
	    $ii++;
	  }

	  $catname = "";
  }

  /* select박스형태
  $catlist = "<select name=\"category\" onChange=\"document.location='".$PHP_SELF."?ptype=list&code=".$code."&category=' + this.value;\">";
  $catlist .= "<option value=\"\">:: 전체목록 ::</option>";
	while($row = mysql_fetch_array($result)) {
  	$catname = $row[catname];
  	$selected = "";
		if($category == $row[idx]) $selected = "selected";
    $catlist .= "<option value=\"".$row[idx]."\" ".$selected.">".$catname."</option>";

  }
  $catlist .= "</select>";
  */

}

// 상단 체크박스
if(
	($mem_level == "0") ||																																		// 전체관리자
	($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)			// 게시판 관리자
) {
	$checkbox_head = "<form style='margin:0;'><input type='checkbox' name='select_tmp' onClick='selectReverseBbs(this.form)'></form>";

	$sel_delete_btn = "<img src='$skin_dir/image/btn_select_delete.gif' border='0' onClick=\"delBbs('".$PHP_SELF."', '".$param."');\" style='cursor:pointer'>";
	$sel_copy_btn = "<img src='$skin_dir/image/btn_select_copy.gif' border='0' onClick=\"copyBbs('".$code."');\" style='cursor:pointer'>";
	$sel_move_btn = "<img src='$skin_dir/image/btn_select_move.gif' border='0' onClick=\"moveBbs('".$code."');\" style='cursor:pointer'>";

	$order_btn = "<img src='$skin_dir/image/btn_select_order.gif' border='0' onClick=\"orderBbs('".$code."');\" style='cursor:pointer'>";

}


// 상단파일
@include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/list_head.php";

if(empty($bbs_info[datetype_list])) $bbs_info[datetype_list] = "%Y-%m-%d";

$idx = 0;

// 공지사항
$sql = "select wb.idx,wb.name,wb.category,wb.subject,from_unixtime(wb.wdate, '".$bbs_info[datetype_list]."') as wdate,
				wb.count,wb.comment,wb.recom,wb.upfile1,wb.content, wc.catname, wc.caticon, wb.memid, wb.address,
				wb.ip, wb.status, wb.nick
				from wiz_bbs as wb left join wiz_bbscat as wc on wb.category = wc.idx
				where wb.code = '$code' and wb.notice = 'Y' order by wb.prino desc";
$result = mysql_query($sql) or error(mysql_error());
while($row = mysql_fetch_array($result)){

	$catname		= "";
	$upimg_s		= "";
	$upimg_m		= "";
	$home_icon 	= "";
	$status 		= "";
	$ip 				= "";

	if($row[caticon] != "") $catname = "<img src='/admin/data/category/".$code."/".$row[caticon]."' align='absmiddle'>";		// category
	else if($row[catname] != "") $catname = "[".$row[catname]."]";

	if($bbs_info[subject_len] > 0) $row[subject] = cut_str($row[subject], $bbs_info[subject_len]);

	$no = "<b class='point_color'>[공지]</b>"; $name = $row[name]; $nick = $row[nick]; $wdate = $row[wdate]; $count = $row[count];

	if($row[comment] > 0) $comment = "(".number_format($row[comment]).")";
	else $comment = "";

	$subject = "<a href='$PHP_SELF?ptype=view&idx=$row[idx]&page=$page&$param'>$row[subject]</a>";
	$viewBbs = "$PHP_SELF?ptype=view&idx=$row[idx]&page=$page&$param";

	$recom = $row[recom];

	$upimg_l = $row[upfile1];
	if(file_exists("/enkasp/www/admin/data/bbs/".$code."/S".$row[upfile1])) $upimg_s = "http://www.kasp.or.kr/admin/data/bbs/$code/S".$row[upfile1];							// img
	else $upimg_s = "$skin_dir/image/noimg.gif";

	if(file_exists("/enkasp/www/admin/data/bbs/".$code."/M".$row[upfile1])) $upimg_m = "http://www.kasp.or.kr/admin/data/bbs/$code/M".$row[upfile1];							// img
	else $upimg_m = "$skin_dir/image/noimg.gif";

	$viewImg = "javascript:viewImg('".$upimg_l."')";

	$content = $row[content];
	if($row[ctype] != "H"){
		$content = str_replace("\n", "<br>", $content);
	}

	// 목록 체크박스
	if(
		($mem_level == "0") ||																																		// 전체관리자
		($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)
	) {
		$checkbox_body = "<form style='margin:0;'><input type='hidden' name='idx' value='".$row[idx]."'><input type='checkbox' name='select_checkbox'></form>";
	}

	$ip = $row[ip];

	if(img_type("/enkasp/www/admin/data/member/".$row[memid]."_icon.gif")) $icon = "<img src='/admin/data/member/".$row[memid]."_icon.gif' align='absmiddle'>";
	else if(img_type("/enkasp/www/admin/data/member/".$row[memid]."_icon.jpg")) $icon = "<img src='/admin/data/member/".$row[memid]."_icon.jpg' align='absmiddle'>";
	else $icon = "";

	if(!strcmp($bbs_info[name_type], "name")) $name = $name;
	else if(!strcmp($bbs_info[name_type], "nick") && !empty($nick)) $name = $nick;
	else if(!strcmp($bbs_info[name_type], "icon") && !empty($icon)) $name = $icon;
	else if(!strcmp($bbs_info[name_type], "iname")) $name = $icon." ".$name;
	else if(!strcmp($bbs_info[name_type], "inick")) {
		if(!empty($nick)) $name = $icon." ".$nick;
		else $name = $icon." ".$name;
	}

	$name = xss_check($name);
	$email = xss_check($email);
	$tphone = xss_check($tphone);
	$hphone = xss_check($hphone);
	$zipcode = xss_check($zipcode);
	$address = xss_check($address);
	$subject = xss_check($subject);
	$content = xss_check($content);
	$reply = xss_check($reply);

	$addinfo1 = xss_check($addinfo1);
	$addinfo2 = xss_check($addinfo2);
	$addinfo3 = xss_check($addinfo3);
	$addinfo4 = xss_check($addinfo4);
	$addinfo5 = xss_check($addinfo5);

	// 글목록파일
	@include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/list_body.php";

	$idx++;

}

// 게시물 쿼리
if($category) $category_sql = " and category = '$category' ";
if($searchopt) {
	if($code == "gooin"){//구인구직 쿼리 추가
		if(!strcmp($searchopt, "c_name")) $search_sql = " and substring_index(addinfo1,'/+gooin+/',1) like '%$searchkey%'";
		elseif(!strcmp($searchopt, "subcon")) $search_sql = " and (subject like '%$searchkey%' or content like '%$searchkey%') ";
		else $search_sql = " and $searchopt like '%$searchkey%' ";
	} else {
		if(!strcmp($searchopt, "subcon")) $search_sql = " and (subject like '%$searchkey%' or content like '%$searchkey%') ";
		else $search_sql = " and $searchopt like '%$searchkey%' ";
	}	
}
// 자신이 쓴 글 또는 자신의 글에 달린 답변글
if($mybbs) $my_sql = " and (memid='$wiz_session[id]' or memgrp like '".$wiz_session[id].",%')";
if($sido) $address_sql = " and address like '".$sido."%' ";
if($gugun) $address_sql .= " and address like '%".$gugun."%' ";
//구인구직 게시판 쿼리문
if($code=="googic"){
	//지원분야 검색
	if($addinfo2 != "") $addinfo_sql = "and addinfo2 like '%$addinfo2%'";
	if($zipcode != "") $zipcode_sql ="and (zipcode = '$zipcode' or zipcode = '무관')"; 
} elseif($code=="gooin"){
	if($w_field != "") $gooin_wfield_sql = " and substring_index(substring_index(addinfo4,'/+gooin+/',3),'/+gooin+/',-1) = '$w_field'";
	if($zipcode != "") $zipcode_sql ="and (zipcode = '$zipcode' or zipcode = '전국')"; 
	if($w_type != "") $gooin_wtype_sql = " and substring_index(addinfo4,'/+gooin+/',1) = '$w_type'";
	if($salary != "") $gooin_salary_sql = " and addinfo9 = '$salary'";
	//중소기업중 사원수가 100명 이상인 검색 쿼리
	$check_sql = "";
	$checkbox_chk = 1;
	if($c_type1 != ""){
		$check_sql  = " (substring_index(addinfo2,'/+gooin+/',1) = '1' and convert(substring_index(substring_index(addinfo2,'/+gooin+/',2),'/+gooin+/',-1),UNSIGNED) <= 100) or";
		$checkbox_chk++;
	}
	if($c_type1_1 != ""){
		$check_sql  = $check_sql." (substring_index(addinfo2,'/+gooin+/',1) = '1' and convert(substring_index(substring_index(addinfo2,'/+gooin+/',2),'/+gooin+/',-1),UNSIGNED) >= 100) or";
		$checkbox_chk++;
	}
	if($c_type2 != ""){
		$check_sql  = $check_sql." substring_index(addinfo2,'/+gooin+/',1) = '$c_type2' or";
		$checkbox_chk++;
	}
	if($c_type3 != ""){
		$check_sql  = $check_sql." substring_index(addinfo2,'/+gooin+/',1) ='$c_type3' or";
		$checkbox_chk++;
	}
	if($c_type4 != ""){
		$check_sql  = $check_sql." substring_index(addinfo2,'/+gooin+/',1) = '$c_type4' or";	
		$checkbox_chk++;
	}
	if($c_type5 != ""){
		$check_sql  = $check_sql." substring_index(addinfo2,'/+gooin+/',1) = '$c_type5' or";
		$checkbox_chk++;
	}
	if($c_type6 != ""){
		$check_sql  = $check_sql." substring_index(addinfo2,'/+gooin+/',1) = '$c_type6' or";
		$checkbox_chk++;
	}
	if($c_type7 != ""){ 
		$check_sql  = $check_sql." substring_index(addinfo2,'/+gooin+/',1) = '$c_type7' or";
		$checkbox_chk++;
	}
	if($c_type8 != ""){
		$check_sql  = $check_sql." substring_index(addinfo2,'/+gooin+/',1) = '$c_type8' or";
		$checkbox_chk++;
	}
	//or 제거
	$check_sql  = substr($check_sql,0,-2);
	if($checkbox_chk != 1){
		$check_sql = " and(".$check_sql.") ";
	}
	
}
$sql = "select idx from wiz_bbs where code = '$code' and notice != 'Y' $my_sql $category_sql $search_sql $address_sql $addinfo_sql $zipcode_sql $gooin_wfield_sql $gooin_wtype_sql $gooin_salary_sql $check_sql order by prino desc";
$result = mysql_query($sql) or error(mysql_error());
$total = mysql_num_rows($result);

$idx = 0;
$rows = $bbs_info[rows];
$lists = $bbs_info[lists];
if($rows == "") $rows = "20";
if($lists == "") $lists = "5";

$ttime = mktime(0,0,0,date('m'),date('d'),date('Y'));
$page_count = ceil($total/$rows);
if(!$page || $page > $page_count) $page = 1;
$start = ($page-1)*$rows;
$no = $total-$start;

$sql = "select wb.*,wb.wdate as wtime,from_unixtime(wb.wdate, '".$bbs_info[datetype_list]."') as wdate, wc.catname, wc.caticon
				from wiz_bbs as wb left join wiz_bbscat as wc on wb.category = wc.idx
				where wb.code = '$code' and wb.notice != 'Y' $category_sql $search_sql $my_sql $address_sql $addinfo_sql $zipcode_sql $gooin_wfield_sql $gooin_wtype_sql $gooin_salary_sql $check_sql
				order by wb.prino desc limit $start, $rows";

$result = mysql_query($sql) or error(mysql_error());

while($row = mysql_fetch_array($result)){

	$catname		="";
	$lock_icon	="";
	$re_icon		="";
	$new_icon		="";
	$hot_icon		="";
	$file_icon	="";
	$re_space		="";
	$upimg_s		="";
	$upimg_m		="";
	$upimg_size = "";

	$home_icon 	= "";
	$status    	= "";
	
	$name 		= $row[name];
	$nick 		= $row[nick];
	$email 		= $row[email];
	$count 		= $row[count];
	$zipcode    = $row[zipcode];
	if($row[comment] > 0) $comment = "(".number_format($row[comment]).")";
	else $comment = "";

	$recom 		= $row[recom];
	$wdate 		= $row[wdate];
	$address 		= $row[address];
	$ip = $row[ip];

	$addinfo1	= $row[addinfo1];
	$addinfo2	= $row[addinfo2];
	$addinfo3	= $row[addinfo3];
	$addinfo4	= $row[addinfo4];
	$addinfo5	= $row[addinfo5];
	$addinfo9	= $row[addinfo9];

	//$wdate = str_replace("-",".",$row[wdate]);

	$content = $row[content];
	if($row[ctype] != "H"){
		$content = str_replace("\n", "<br>", $content);
	}

	if($row[caticon] != "") $catname = "<img src='/admin/data/category/".$code."/".$row[caticon]."' align='absmiddle'>";		// category
	else if($row[catname] != "") $catname = "[".$row[catname]."]";

	if($bbs_info[subject_len] > 0) $row[subject] = cut_str($row[subject], $bbs_info[subject_len]);

	if(!empty($row[upfile1])) {
		// 첨부파일
		if(!check_point($wiz_session[id], $bbs_info[down_point])) {
			$file_icon = "<a href=\"javascript:alert('$bbs_info[point_msg]')\" style='margin-left:5px'><img src='$skin_dir/image/icon_file.png'></a>";			// file
		} else if($rpermi < $mem_level) {
			$file_icon = "<a href=\"$PHP_SELF?ptype=view&idx=$row[idx]&page=$page&$param\" style='margin-left:5px'><img src='$skin_dir/image/icon_file.png'></a>";			// file
		} else {
			$file_icon = "<a href='/admin/bbs/down.php?code=$code&idx=$row[idx]&no=1' style='margin-left:5px'><img src='$skin_dir/image/icon_file.png'></a>";			// file
		}

	}

	$subject = "<a href='$PHP_SELF?ptype=view&idx=$row[idx]&page=$page&$param'>$row[subject]</a>";		// subject
	$viewBbs = "$PHP_SELF?ptype=view&idx=$row[idx]&page=$page&$param";
	if($row[privacy] == "Y"){																																					// privacy
		if(
			($mem_level == "0") ||																																		// 전체관리자
			($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)  ||	// 게시판관리자
			($row[memid] != "" && $row[memid] == $wiz_session[id])																 ||	// 자신의글
			($wiz_session[id] != "" && strpos($row[memgrp],$wiz_session[id]) !== false)								// 그룹의글
		){
		}else{
			$subject = "<a href='$PHP_SELF?ptype=passwd&mode=view&idx=$row[idx]&page=$page&$param'>$row[subject]</a>";
			$viewBbs = "$PHP_SELF?ptype=passwd&mode=view&idx=$row[idx]&page=$page&$param";
			if(!empty($file_icon)) $file_icon = "<a href='$PHP_SELF?ptype=passwd&mode=view&idx=$row[idx]&page=$page&$param' style='margin-left:5px'><img src='$skin_dir/image/icon_file.png'></a>";
		}
		$lock_icon = "<img src='$skin_dir/image/lock.gif' border='0' align='absmiddle'>";
	}

	//$wdate_list = explode(".",$wdate);
	//$wtime = mktime(0,0,0,$wdate_list[1],$wdate_list[2],$wdate_list[0]);
	$wtime = $row[wtime];
	if(($ttime-$wtime)/86400 <= $bbs_info[newc]) 	$new_icon = "<img src='$skin_dir/image/new.gif' border='0' align='absmiddle'>";				// new
	if($row[count] > $bbs_info[hotc]) 						$hot_icon = "<img src='$skin_dir/image/hot.gif' border='0' align='absmiddle'>";				// hot
	if($row[depno] != 0) 													$re_icon = "<img src='$skin_dir/image/re.gif' border='0' align='absmiddle'>";					// re

	for($ii=0; $ii < $row[depno]; $ii++) 					$re_space .= "&nbsp;&nbsp;";																													// respace

	$upimg_l = $row[upfile1];
	if(file_exists("/enkasp/www/admin/data/bbs/".$code."/S".$row[upfile1])) $upimg_s = "http://www.kasp.or.kr/admin/data/bbs/$code/S".$row[upfile1];							// img
	else $upimg_s = "$skin_dir/image/noimg.gif";

	if(file_exists("/enkasp/www/admin/data/bbs/".$code."/M".$row[upfile1])) $upimg_m = "http://www.kasp.or.kr/admin/data/bbs/$code/M".$row[upfile1];							// img
	else $upimg_m = "$skin_dir/image/noimg.gif";

	$viewImg = "javascript:viewImg('".$upimg_l."')";

	if(img_type("/enkasp/www/admin/data/member/".$row[memid]."_icon.gif")) $icon = "<img src='/admin/data/member/".$row[memid]."_icon.gif' align='absmiddle'>";
	else if(img_type("/enkasp/www/admin/data/member/".$row[memid]."_icon.jpg")) $icon = "<img src='/admin/data/member/".$row[memid]."_icon.jpg' align='absmiddle'>";
	else $icon = "";

	if(!strcmp($bbs_info[name_type], "name")) $name = $name;
	else if(!strcmp($bbs_info[name_type], "nick") && !empty($nick)) $name = $nick;
	else if(!strcmp($bbs_info[name_type], "icon") && !empty($icon)) $name = $icon;
	else if(!strcmp($bbs_info[name_type], "iname")) $name = $icon." ".$name;
	else if(!strcmp($bbs_info[name_type], "inick")) {
		if(!empty($nick)) $name = $icon." ".$nick;
		else $name = $icon." ".$name;
	}

	// 목록 체크박스
	if(
		($mem_level == "0") ||																																		// 전체관리자
		($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)
	) {
		$checkbox_body = "<form style='margin:0;'><input type='hidden' name='idx' value='".$row[idx]."'><input type='checkbox' name='select_checkbox'></form>";
	}

	$name = xss_check($name);
	$email = xss_check($email);
	$tphone = xss_check($tphone);
	$hphone = xss_check($hphone);
	$zipcode = xss_check($zipcode);
	$address = xss_check($address);
	$subject = xss_check($subject);
	$content = xss_check($content);
	$reply = xss_check($reply);

	$addinfo1 = xss_check($addinfo1);
	$addinfo2 = xss_check($addinfo2);
	$addinfo3 = xss_check($addinfo3);
	$addinfo4 = xss_check($addinfo4);
	$addinfo5 = xss_check($addinfo5);
	$addinfo9 = xss_check($addinfo9);
//구직 게시판일시 addinfo 구분자로 나누어서 view 페이지에출력!
if($code=="googic"){
	$content = explode("/+googic+/",$content);
	//[0] 생년월일 [1] 성별 [2] 경력
	$addinfo1 = explode("/+googic+/",$addinfo1);
	if($addinfo2[0]!= "" || $addinfo2[0]!= null){
		$subject = "<a href='$PHP_SELF?ptype=view&idx=$row[idx]&page=$page&$param'>$row[subject] / $addinfo1[2]</a>";		// subject
	}
	//[0] 지원분야 [1] 근무형태 [2] 희망연봉
	$addinfo2 = explode("/+googic+/",$addinfo2);
	if($addinfo2[0]!= "" || $addinfo2[0]!= null){
		$subject = "<a href='$PHP_SELF?ptype=view&idx=$row[idx]&page=$page&$param'>$row[subject] / $addinfo2[0] / $addinfo1[2]</a>";		// subject
	}
	//재학기간1 재학기간1_1 학교명1 소재지1 전공1 학점1 학점1_1
	$addinfo4 = explode("/+googic+/",$addinfo4);
	//재학기간2 재학기간2_1 학교명2 소재지2 전공2 학점2 학점2_1
	$addinfo5 = explode("/+googic+/",$addinfo5);
} else if($code=="gooin"){
	//[0]기관명[1]설립년도[2]매출액
	$addinfo1 = explode("/+gooin+/",$addinfo1);
	//[0]기업형태[1]사원수[2]홈페이지
	$addinfo2 = explode("/+gooin+/",$addinfo2);
	//[0]경력[1]학력[2~3]접수기간
	$addinfo3 = explode("/+gooin+/",$addinfo3);
	//[0]고용형태[1]접수방법[2]근무분야
	$addinfo4 = explode("/+gooin+/",$addinfo4);
	
	if($addinfo9 == 1)$addinfo9 = "회사내규";
	elseif($addinfo9 == 2)$addinfo9 = "면접 후 협의";
	elseif($addinfo9 == 3)$addinfo9 = "1500";
	elseif($addinfo9 == 4)$addinfo9 = "1500~2000";
	elseif($addinfo9 == 5)$addinfo9 = "2000~2500";
	elseif($addinfo9 == 6)$addinfo9 = "2500~3000";
	elseif($addinfo9 == 7)$addinfo9 = "3000~3500";
	elseif($addinfo9 == 8)$addinfo9 = "3500~4000";
	elseif($addinfo9 == 9)$addinfo9 = "4000~4500";
	elseif($addinfo9 == 10)$addinfo9 = "4500~5000";
	elseif($addinfo9 == 11)$addinfo9 = "5000~5500";
	elseif($addinfo9 == 12)$addinfo9 = "5500~6000";
	elseif($addinfo9 == 13)$addinfo9 = "6000~7000";
	elseif($addinfo9 == 14)$addinfo9 = "7000~8000";
	elseif($addinfo9 == 15)$addinfo9 = "8000~9000";
	elseif($addinfo9 == 16)$addinfo9 = "9000~1억";
	elseif($addinfo9 == 17)$addinfo9 = "1억이상";

	$subject = "<a href='$PHP_SELF?ptype=view&idx=$row[idx]&page=$page&$param'>$row[subject] / $addinfo9 / $zipcode</a>";		// subject
}

	// 글목록파일
	@include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/list_body.php";

	$no--;
	$idx++;

	if(empty($bbs_idx)) $bbs_idx = $row[idx];

}

if($total <= 0){
	//echo "<tr><td height='25' align='center' colspan='20'>등록된 글이 없습니다.</td></tr>";
}

if(!empty($view_idx)) $param .= "&idx=$view_idx";

// 하단파일
@include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/list_foot.php";

?>
