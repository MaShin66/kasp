<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin/inc/bbs_info.php";

// 자동등록글체크
get_spam_check();

if(strcmp($mode, "modify")) {
	if(!check_point($wiz_session[id], $bbs_info[write_point])) {
		error($bbs_info[point_msg]);
	}
}

echo "<link href=\"".$skin_dir."/style.css\" rel=\"stylesheet\" type=\"text/css\">";

// 검색 파라미터
$param = "code=$code";
if($page != "") $param .= "&page=$page";
if($searchkey != "") $param .= "&searchopt=$searchopt&searchkey=$searchkey";

// 버튼설정
$list_btn = "<a href='$PHP_SELF?ptype=list&$param' class='btn_txt btn_line_black'>목록으로</a>";
$confirm_btn = "<input type='image' src='$skin_dir/image/btn_confirm.gif' border='0'>";
$cancel_btn = "<img src='$skin_dir/image/btn_cancel.gif' border='0' onClick='history.go(-1)' style='cursor:hand'>";


// 게시물 정보
$sql = "select *, FROM_UNIXTIME(wdate) as wdate from wiz_bbs where idx = '$idx'";
$result = mysql_query($sql) or error(mysql_error());
$bbs_row = mysql_fetch_array($result);

// 글 작성
if($mode == "") $mode = "insert";
if($mode == "insert"){

	if($wpermi < $mem_level) error($bbs_info[permsg],$bbs_info[perurl]);

	$name = $wiz_session[name];
	$email = $wiz_session[email];
	if($code=="googic" || $code=="gooin"){
	 $name = "";
	 $email = "";
	}

	$bbs_row[wdate] = date('Y-m-d H:i:s');

	$sql = "select nick from wiz_member where id = '$wiz_session[id]'";
	$result = mysql_query($sql) or error(mysql_error());
	$mem_info = mysql_fetch_array($result);

	$nick = $mem_info[nick];

	if((!strcmp($bbs_info[name_type], "nick") || !strcmp($bbs_info[name_type], "inick")) && !empty($nick)) $name = $nick;

	if($bbs_info[privacy] == "Y") $privacy_checked = "checked";

	// 비밀번호 숨김
	if($wiz_session[id] != ""){
		$hide_passwd_start = "<!--"; $hide_passwd_end = "-->";
	}

	// 공지글 표시
	if(
	$mem_level == "0" || 																																			// 전체관리자
	($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)			// 게시판관리자
	){
	}else{
		$hide_notice_start = "<!--"; $hide_notice_end = "-->";
	}

	// 답변권한이 없을 때 숨김
	if($apermi < $mem_level) {
		$hide_reply_start = "<!--"; $hide_reply_end = "-->";
	}

// 글 수정
}else if($mode == "modify"){

	$name = $bbs_row[name];
	$email = $bbs_row[email];
	$subject = $bbs_row[subject];
	$content = $bbs_row[content];
	$reply 	 = $bbs_row[reply];

	$tphone	= $bbs_row[tphone];
	$hphone	= $bbs_row[hphone];
	$zipcode	= $bbs_row[zipcode];
	$address	= $bbs_row[address];

	$addinfo1	= $bbs_row[addinfo1];
	$addinfo2	= $bbs_row[addinfo2];
	$addinfo3	= $bbs_row[addinfo3];
	$addinfo4	= $bbs_row[addinfo4];
	$addinfo5	= $bbs_row[addinfo5];
	$addinfo6	= $bbs_row[addinfo6];
	$addinfo7	= $bbs_row[addinfo7];
	$addinfo8	= $bbs_row[addinfo8];
	$addinfo9	= $bbs_row[addinfo9];

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
	$addinfo6 = xss_check($addinfo6);
	$addinfo7 = xss_check($addinfo7);
	$addinfo8 = xss_check($addinfo8);
	$addinfo9 = xss_check($addinfo9);


	for($ii = 1; $ii <= $upfile_max; $ii++) {
		if(!empty($bbs_row[upfile.$ii])) {
			${upfile.$ii} = "<input type='checkbox' name='delupfile[]' value='upfile".$ii."'> 삭제 (".$bbs_row[upfile.$ii._name].")";
		}
	}
	if(!empty($bbs_row[movie1])) {
		$movie1 = "<input type='checkbox' name='delupfile[]' value='movie1'> 삭제 ($bbs_row[movie1])";
	}

	$movie2 = $bbs_row[movie2];
	$movie3 = $bbs_row[movie3];

	// 비밀번호 숨김
	if(
	$mem_level == "0" || 																																			// 전체관리자
	($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)  ||	// 게시판관리자
	($bbs_row[memid] != "" && $wiz_session[id] == $bbs_row[memid])														// 자신에글
	){
		$hide_passwd_start = "<!--"; $hide_passwd_end = "-->";
	}

	// 공지글 표시
	if(
	$mem_level == "0" || 																																			// 전체관리자
	($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)			// 게시판관리자
	){
	}else{
		$hide_notice_start = "<!--"; $hide_notice_end = "-->";
	}

	if($bbs_row[ctype] == "H") $ctype_checked = "checked";
	if($bbs_row[privacy] == "Y") $privacy_checked = "checked";
	if($bbs_row[notice] == "Y") $notice_checked = "checked";
	if($bbs_row[status] == "Y") $status_checked = "checked";

	// 답변권한이 없을 때 숨김
	if($apermi < $mem_level) {
		$hide_reply_start = "<!--"; $hide_reply_end = "-->";
	}

// 글 답변
}else if($mode == "reply"){

	$sql = "select category,subject,content,privacy,passwd,tphone,address,addinfo1,addinfo2,addinfo3,addinfo4,addinfo5 from wiz_bbs where idx = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	$bbs_row = mysql_fetch_array($result);

	$category = $bbs_row[category];
	$subject = $bbs_row[subject];
	$content = $bbs_row[content]."\n\n==================== 답 변 ====================\n\n";
	$name = $wiz_session[name];
	$email = $wiz_session[email];

	$tphone = $bbs_row[tphone];
	$address = $bbs_row[address];
	$addinfo1 = $bbs_row[addinfo1];
	$addinfo2 = $bbs_row[addinfo2];
	$addinfo3 = $bbs_row[addinfo3];
	$addinfo4 = $bbs_row[addinfo4];
	$addinfo5 = $bbs_row[addinfo5];
	$addinfo6	= $bbs_row[addinfo6];
	$addinfo7	= $bbs_row[addinfo7];
	$addinfo8	= $bbs_row[addinfo8];
	$addinfo9	= $bbs_row[addinfo9];

	$tphone = xss_check($tphone);
	$hphone = xss_check($hphone);
	$zipcode = xss_check($zipcode);
	$address = xss_check($address);
	$subject = xss_check($subject);
	$content = xss_check($content);

	$addinfo1 = xss_check($addinfo1);
	$addinfo2 = xss_check($addinfo2);
	$addinfo3 = xss_check($addinfo3);
	$addinfo4 = xss_check($addinfo4);
	$addinfo5 = xss_check($addinfo5);
	$addinfo6 = xss_check($addinfo6);
	$addinfo7 = xss_check($addinfo7);
	$addinfo8 = xss_check($addinfo8);
	$addinfo9 = xss_check($addinfo9);

	$bbs_row[wdate] = date('Y-m-d H:i:s');

	$sql = "select nick from wiz_member where id = '$wiz_session[id]'";
	$result = mysql_query($sql) or error(mysql_error());
	$mem_info = mysql_fetch_array($result);

	$nick = $mem_info[nick];

	if(!strcmp($bbs_info[name_type], "NICK") && !empty($nick)) $name = $nick;

	if($bbs_info[privacy] == "Y" || $bbs_row[privacy] == "Y") $privacy_checked = "checked";

	// 비밀번호 숨김
	if($wiz_session[id] != ""){
		$hide_passwd_start = "<!--"; $hide_passwd_end = "-->";
	}

	// 공지글 표시
	if(
	$mem_level == "0" || 																																			// 전체관리자
	($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)			// 게시판관리자
	){
	}else{
		$hide_notice_start = "<!--"; $hide_notice_end = "-->";
	}

}

$wdate = $bbs_row[wdate];
$count = $bbs_row[count];

// 관리자인 경우 날짜, 조회수 수정가능
if(
$mem_level == "0" || 																																			// 전체관리자
($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)			// 게시판관리자
){
} else {
	$hide_admin_start = "<!--"; $hide_admin_end = "-->";
}

// 게시물 분류
$sql = "select idx, catname, catimg from wiz_bbscat where code = '$code' and gubun != 'A' order by prior asc, idx asc";
$result = mysql_query($sql) or error(mysql_error());
$total = mysql_num_rows($result);
if($total > 0) {

  /* select박스형태 */
  $catlist = "<select name=\"category\">";
  $catlist .= "<option value=\"\">:: 전체목록 ::</option>";
	while($row = mysql_fetch_array($result)) {

  	$catname = $row[catname];
  	$selected = "";
		if($bbs_row[category] == $row[idx]) $selected = "selected";
    $catlist .= "<option value=\"".$row[idx]."\" ".$selected.">".$catname."</option>";

  }
  $catlist .= "</select> ";

}

//구직 게시판일시 addinfo 구분자로 나누어서 view 페이지에출력!
if($code=="googic"){
	$content = explode("/+googic+/",$content);
	//[0] 생년월일 [1] 성별 [2] 경력
	$addinfo1 = explode("/+googic+/",$addinfo1);
	//[0] 지원분야 [1] 근무형태 [2] 희망연봉
	$addinfo2 = explode("/+googic+/",$addinfo2);
	//재학기간1 재학기간1_1 학교명1 소재지1 전공1 학점1 학점1_1
	$addinfo6 = explode("/+edu+googic+edu+/",$addinfo6);
} else if($code=="gooin"){
	//[0]기관명[1]설립년도[2]매출액
	$addinfo1 = explode("/+gooin+/",$addinfo1);
	//[0]기업형태[1]사원수[2]홈페이지
	$addinfo2 = explode("/+gooin+/",$addinfo2);
	//[0]경력[1]학력[2~3]접수기간
	$addinfo3 = explode("/+gooin+/",$addinfo3);
	//[0]고용형태[1]접수방법[2]근무분야
	$addinfo4 = explode("/+gooin+/",$addinfo4);
}

// 첨부파일 사용여부
if($bbs_info[upfile] < 5) { $hide_upfile5_start = "<!--"; $hide_upfile5_end = "-->"; }
if($bbs_info[upfile] < 4) { $hide_upfile4_start = "<!--"; $hide_upfile4_end = "-->"; }
if($bbs_info[upfile] < 3) { $hide_upfile3_start = "<!--"; $hide_upfile3_end = "-->"; }
if($bbs_info[upfile] < 2) { $hide_upfile2_start = "<!--"; $hide_upfile2_end = "-->"; }
if($bbs_info[upfile] < 1) { $hide_upfile1_start = "<!--"; $hide_upfile1_end = "-->"; }

// 동영상 사용여부
if($bbs_info[movie] < 3) { $hide_movie3_start = "<!--"; $hide_movie3_end = "-->"; }
if($bbs_info[movie] < 2) { $hide_movie2_start = "<!--"; $hide_movie2_end = "-->"; }
if($bbs_info[movie] < 1) { $hide_movie1_start = "<!--"; $hide_movie1_end = "-->"; }

// 스팸글체크기능 사용여부
if($mem_level == "0" || !strcmp($bbs_info[spam_check], "N") || !strcmp($mode, "modify")){
	$hide_spam_check_start = "<!--"; $hide_spam_check_end = "-->";
}

// 입력스킨 인클루드
@include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/input.php";
?>
