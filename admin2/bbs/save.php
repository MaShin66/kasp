<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin2/inc/bbs_info.php";

// 검색 파라미터
$param = "code=$code";
if($page != "") $param .= "&page=$page";
if($searchkey != "") $param .= "&searchopt=$searchopt&searchkey=$searchkey";

//SQL 입력값 문자열 필터
if($code=="googic"){//"/+googic+/"//구인 구직 게시판 addinfo 추가시 검색 sql 수정해야함.

	$name = sql_filter($_POST["name"]);
	$email = sql_filter($_POST["email"]);
	$tphone = sql_filter($_POST["tphone"]);
	$hphone = sql_filter($_POST["hphone"]);
	$zipcode = sql_filter($_POST["zipcode"]);
	$address = sql_filter($_POST["address"]);
	$subject = sql_filter($_POST["subject"]);
	$reply = sql_filter($_POST["reply"]);
	//content = 경력사항 + 자기소개
	$content = sql_filter($_POST["content1"])."/+googic+/".sql_filter($_POST["content2"]);
	//addinfo1 = 생년 + 성별 + 경력
	$addinfo1 = sql_filter($_POST["birth"])."/+googic+/".sql_filter($_POST["gender"])."/+googic+/".sql_filter($_POST["career"]);
	//addinfo2 = 지원분야 + 근무형태 + 희망연봉
	$addinfo2 = sql_filter($_POST["w_field"])."/+googic+/".sql_filter($_POST["w_type"])."/+googic+/".sql_filter($_POST["h_salary"]);
	$addinfo3 = sql_filter($_POST["addinfo3"]);
	//addinfo6 = 학력사항
	$educhk = sql_filter($_POST["educhk"]);
	for($i = 1; $i<=$educhk; $i++){
		$addinfo6.= sql_filter($_POST["period".$i."_1"])."/+googic+/".sql_filter($_POST["period".$i."_2"])."/+googic+/".sql_filter($_POST["s_name".$i.""])."/+googic+/".sql_filter($_POST["major".$i.""])."/+googic+/".sql_filter($_POST["s_area".$i.""])."/+googic+/".sql_filter($_POST["score".$i."_1"])."/+googic+/".sql_filter($_POST["score".$i."_2"]);
		if($i != $educhk){
			$addinfo6 .="/+edu+googic+edu+/";
		}
	}	
} elseif($code=="gooin"){

	$name = sql_filter($_POST["name"]);
	$email = sql_filter($_POST["email"]);
	$tphone = sql_filter($_POST["tphone"]);
	$hphone = sql_filter($_POST["hphone"]);
	$zipcode = sql_filter($_POST["zipcode"]);
	$address = sql_filter($_POST["address"]);
	$subject = sql_filter($_POST["subject"]);
	$content = sql_filter($_POST["content"]);
	$reply = sql_filter($_POST["reply"]);
	//addinfo1 기관명 + 설립년도 + 매출액 
	$addinfo1 = sql_filter($_POST["c_name"])."/+gooin+/".sql_filter($_POST["c_est"])."/+gooin+/".sql_filter($_POST["c_sales"]);
	//addinfo2 기업형태 + 사원수 + 홈페이지
	$addinfo2 = sql_filter($_POST["c_type"])."/+gooin+/".sql_filter($_POST["c_emp"])."/+gooin+/".sql_filter($_POST["c_url"]);
	//addinfo 지원자격 경력 + 학력 + 접수기간 시작 + 종료 
	$addinfo3 = sql_filter($_POST["career"])."/+gooin+/".sql_filter($_POST["edu"])."/+gooin+/".sql_filter($_POST["sdate"])."/+gooin+/".sql_filter($_POST["edate"]);
	//addinfo4 고용형태 + 접수방법 + 근무분야+ 업무시간1 + 업무시간2
	$addinfo4 = sql_filter($_POST["w_type"])."/+gooin+/".sql_filter($_POST["method"])."/+gooin+/".sql_filter($_POST["w_field"])."/+gooin+/".sql_filter($_POST["w_time1"])."/+gooin+/".sql_filter($_POST["w_time2"]);
	$addinfo5 = sql_filter($_POST["addinfo5"]);
	$addinfo9 = sql_filter($_POST["addinfo9"]);
} else {
	$name = sql_filter($_POST["name"]);
	$email = sql_filter($_POST["email"]);
	$tphone = sql_filter($_POST["tphone"]);
	$hphone = sql_filter($_POST["hphone"]);
	$zipcode = sql_filter($_POST["zipcode"]);
	$address = sql_filter($_POST["address"]);
	$subject = sql_filter($_POST["subject"]);
	$content = sql_filter($_POST["content"]);
	$reply = sql_filter($_POST["reply"]);

	$addinfo1 = sql_filter($_POST["addinfo1"]);
	$addinfo2 = sql_filter($_POST["addinfo2"]);
	$addinfo3 = sql_filter($_POST["addinfo3"]);
	$addinfo4 = sql_filter($_POST["addinfo4"]);
	$addinfo5 = sql_filter($_POST["addinfo5"]);
	$addinfo9 = sql_filter($_POST["addinfo9"]);
}


// 글작성
if($mode == "insert"){

	// 스팸글 차단
	$pos = strpos($HTTP_REFERER, $HTTP_HOST);
  if($pos === false) error("잘못된 경로 입니다.");

  if($mem_level != "0" && !strcmp($bbs_info[spam_check], "Y")) {

	  // 자동등록방지 코드 검사
	  if(empty($_POST[tmp_vcode]) || empty($_POST[vcode])) {
	  	error("자동등록방지 코드가 존재하지 않습니다.");
	  } else if(strcmp($_POST[tmp_vcode], md5($_POST[vcode]))) {
	  	error("자동등록방지 코드가 일치하지 않습니다.");
	  }
	}

	// 작성권한 체크
	if($wpermi < $mem_level) error($bbs_info[permsg],$bbs_info[perurl]);

	// 욕설체크
	check_abuse($subject); check_abuse($content);

	// 첨부파일 업로드
	include WIZHOME_PATH."/bbs/upfile.inc";

	// 입력데이터
	if($memid == "") $memid = $wiz_session[id];
	$memgrp = $memid;

	$sql = "select nick from wiz_member where id = '$memid'";
	$result = mysql_query($sql) or error(mysql_error());
	$row = mysql_fetch_array($result);

	$nick = $row[nick];

	$name = str_replace("\"","&quot;",$name);
	$subject = str_replace("\"","&quot;",$subject);
	if($passwd == "") $passwd = $wiz_session[passwd];
	if($bbs_info[editor] == "Y") $ctype = "H";

	$sql = "select max(prino) as prino from wiz_bbs where code = '$code'";
	$result = mysql_query($sql) or error(mysql_error());
	if($row = mysql_fetch_array($result)){
		$prino = $row[prino] + 1;
	}
	$grpno = $prino;

	if(empty($wdate)) $wdate = date('Y-m-d H:i:s');

	$sql = "insert into wiz_bbs(idx,code,prino,grpno,depno,notice,category,memid,memgrp,name,nick,email,tphone,hphone,zipcode,address,subject,content,reply,addinfo1,addinfo2,addinfo3,addinfo4,addinfo5,addinfo6,addinfo9, ctype,privacy,upfile1,upfile2,upfile3,upfile4,upfile5,upfile6,upfile7,upfile8,upfile9,upfile10,upfile11,upfile12,upfile1_name,upfile2_name,upfile3_name,upfile4_name,upfile5_name,upfile6_name,upfile7_name,upfile8_name,upfile9_name,upfile10_name,upfile11_name,upfile12_name,movie1,movie2,movie3,passwd,count,recom,comment,ip,wdate,status)
					values('','$code','$prino','$grpno','$depno','$notice','$category','$memid','$memgrp','$name','$nick','$email','$tphone','$hphone','$zipcode','$address','$subject','$content','$reply','$addinfo1','$addinfo2','$addinfo3','$addinfo4','$addinfo5','$addinfo6','$addinfo9','$ctype','$privacy','$upfile1_tmp','$upfile2_tmp','$upfile3_tmp','$upfile4_tmp','$upfile5_tmp','$upfile6_tmp','$upfile7_tmp','$upfile8_tmp','$upfile9_tmp','$upfile10_tmp','$upfile11_tmp','$upfile12_tmp','$upfile1_name','$upfile2_name','$upfile3_name','$upfile4_name','$upfile5_name','$upfile6_name','$upfile7_name','$upfile8_name','$upfile9_name','$upfile10_name','$upfile11_name','$upfile12_name',
					'$movie1_tmp','$movie2','$movie3','$passwd','$count','$recom','$comment','$REMOTE_ADDR',unix_timestamp('".$wdate."'), '$status')";

	mysql_query($sql) or error(mysql_error());
	$bidx = mysql_insert_id();

	// 관리자에게 SMS 발송
	if(!strcmp($bbs_info[sms], "Y")) {
		include $_SERVER[DOCUMENT_ROOT]."/admin2/inc/site_info.php";

		$se_name = $name;
		$se_num = $hphone;

		$re_num = $site_info[site_hand];

		$message = "[".$bbs_info[title]."] ".$se_name."님의 글이 등록되었습니다";

		send_sms($se_num, $re_num, $message, $se_name);
	}

	save_point("BBS", $memid, "write", $bidx);

	echo "<script>document.location='$PHP_SELF?ptype=list&$param';</script>";

// 게시물 수정
}else if($mode == "modify"){

	$sql = "select memid,passwd from wiz_bbs where idx = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	$bbs_row = mysql_fetch_array($result);

	// 수정권한 체크
	if(
		$mem_level == "0" || 																																				// 전체관리자
		($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)  ||		// 게시판관리자
		($bbs_row[memid] != "" && $bbs_row[memid] == $wiz_session[id]) || 													// 자신의글
		($bbs_row[passwd] != "" && $bbs_row[passwd] == $passwd)																			// 비밀번호일치
	){
	}else{
		error("비밀번호가 일치하지 않습니다.");
	}

	$sql = "select nick from wiz_member where id = '$bbs_row[memid]'";
	$result = mysql_query($sql) or error(mysql_error());
	$row = mysql_fetch_array($result);

	$nick = $row[nick];

	// 첨부파일 업로드
	include WIZHOME_PATH."/bbs/upfile.inc";

	// 입력데이터
	$name = str_replace("\"","&quot;",$name);
	$subject = str_replace("\"","&quot;",$subject);
	if($bbs_info[editor] == "Y") $ctype = "H";

	// 답변권한이 있을때 답변(reply), 처리상태(status) 수정
	if($apermi >= $mem_level) {
		$reply_sql = ", reply='$reply', status='$status' ";
	}

	if(!empty($wdate)) $wdate_sql = ", wdate=unix_timestamp('".$wdate."') ";
	if(!empty($count)) $count_sql = ", count='$count' ";

	$sql = "update wiz_bbs set notice='$notice',category='$category',name='$name',nick='$nick',email='$email',tphone='$tphone',hphone='$hphone',zipcode='$zipcode',address='$address',subject='$subject',content='$content',addinfo1='$addinfo1',addinfo2='$addinfo2',addinfo3='$addinfo3',addinfo4='$addinfo4',addinfo5='$addinfo5', addinfo6='$addinfo6',addinfo9='$addinfo9',ctype='$ctype',privacy='$privacy' $upfile_sql $movie1_sql,movie2='$movie2',movie3='$movie3' $reply_sql $wdate_sql $count_sql where idx = '$idx'";
	mysql_query($sql) or error(mysql_error());

	if($privacy == "Y" && ($bbs_row[memid] == "" || $wiz_session[id] == "")) $param .= "&passwd=$passwd";

	alert("수정 되었습니다.","$PHP_SELF?ptype=view&idx=$idx&$param");

// 답글작성
}else if($mode == "reply"){

	// 스팸글 차단
	$pos = strpos($HTTP_REFERER, $HTTP_HOST);
  if($pos === false) error("잘못된 경로 입니다.");

  if($mem_level != "0" && !strcmp($bbs_info[spam_check], "Y")) {

	  // 자동등록방지 코드 검사
	  if(empty($_POST[tmp_vcode]) || empty($_POST[vcode])) {
	  	error("자동등록방지 코드가 존재하지 않습니다.");
	  } else if(strcmp($_POST[tmp_vcode], md5($_POST[vcode]))) {
	  	error("자동등록방지 코드가 일치하지 않습니다.");
	  }
	}

	// 작성권한 체크
	if($apermi < $mem_level) error($bbs_info[permsg],$bbs_info[perurl]);

	// 욕설체크
	check_abuse($subject); check_abuse($content);

	// 첨부파일 업로드
	include WIZHOME_PATH."/bbs/upfile.inc";

	$sql = "select idx,grpno,prino,depno,memid,memgrp,name,email from wiz_bbs where idx='$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	$row = mysql_fetch_array($result);
	$re_name = $row[name];
	$re_email = $row[email];

	$grpno = $row[grpno];
	$prino = $row[prino];
	$depno = ++$row[depno];

	// 입력데이타
	if($memid == "") $memid = $wiz_session[id];
	$memgrp = $row[memgrp].",".$memid;

	$sql = "select nick from wiz_member where id = '$memid'";
	$result = mysql_query($sql) or error(mysql_error());
	$row = mysql_fetch_array($result);

	$nick = $row[nick];

	if($privacy == "Y") $memid = $row[memid];

	$name = str_replace("\"","&quot;",$name);
	$subject = str_replace("\"","&quot;",$subject);
	if($passwd == "") $passwd = $wiz_session[passwd];
	if($bbs_info[editor] == "Y") $ctype = "H";

	$sql = "update wiz_bbs set prino = prino+1 where code = '$code' and prino >= '$prino'";
	$result = mysql_query($sql) or error(mysql_error());

	if(empty($wdate)) $wdate = date('Y-m-d H:i:s');

	$sql = "insert into wiz_bbs(idx,code,grpno,prino,depno,notice,category,memid,memgrp,name,nick,email,tphone,hphone,zipcode,address,subject,content,addinfo1,addinfo2,addinfo3,addinfo4,addinfo5,ctype,privacy,upfile1,upfile2,upfile3,upfile4,upfile5,upfile6,upfile7,upfile8,upfile9,upfile10,upfile11,upfile12,upfile1_name,upfile2_name,upfile3_name,upfile4_name,upfile5_name,upfile6_name,upfile7_name,upfile8_name,upfile9_name,upfile10_name,upfile11_name,upfile12_name,movie1,movie2,movie3,passwd,count,recom,comment,ip,wdate)
					values('','$code','$grpno','$prino','$depno','$notice','$category','$memid','$memgrp','$name','$nick','$email','$tphone','$hphone','$zipcode','$address','$subject','$content','$addinfo1','$addinfo2','$addinfo3','$addinfo4','$addinfo5','$ctype','$privacy','$upfile1_tmp','$upfile2_tmp','$upfile3_tmp','$upfile4_tmp','$upfile5_tmp','$upfile6_tmp','$upfile7_tmp','$upfile8_tmp','$upfile9_tmp','$upfile10_tmp','$upfile11_tmp','$upfile12_tmp','$upfile1_name','$upfile2_name','$upfile3_name','$upfile4_name','$upfile5_name','$upfile6_name','$upfile7_name','$upfile8_name','$upfile9_name','$upfile10_name','$upfile11_name','$upfile12_name',
					'$movie1_tmp','$movie2','$movie3','$passwd','$count','$recom','$comment','$REMOTE_ADDR',unix_timestamp('".$wdate."'))";

	mysql_query($sql) or error(mysql_error());

	// 관리자에게 SMS 발송
	if(!strcmp($bbs_info[sms], "Y")) {
		include $_SERVER[DOCUMENT_ROOT]."/admin2/inc/site_info.php";

		$se_name = $name;
		$se_num = $hphone;

		$re_num = $site_info[site_hand];

		$message = "[".$bbs_info[title]."] ".$se_name."님의 글이 등록되었습니다";

		send_sms($se_num, $re_num, $message, $se_name);
	}

	// 답글 메일발송
	if($bbs_info[remail] == "Y"){

		include_once "$_SERVER[DOCUMENT_ROOT]/admin2/inc/site_info.php";

		$mail_info = get_table("wiz_mailsms", "code = 'bbs'");

		$content = str_replace("\n","<br>",$content);
		$content = "<table width=100% cellpadding=2><tr><td bgcolor=#efefef>&nbsp; <b>제목 : $subject</b></td></tr><tr><td><br></td></tr><tr><td>$content</td></tr></table>";

		$email_subj = "[".$site_info[site_name]."] 문의하신 게시물 답변입니다.";
		$email_msg = str_replace("{MESSAGE}",$content,$mail_info[email_msg]);
		$email_msg = str_replace("{SITE_URL}", "http://".$HTTP_HOST, $email_msg);

		send_mail($site_info[site_name], $site_info[site_email], $re_name, $re_email, $email_subj, $email_msg);

	}

	alert("답글이 작성되었습니다.","$PHP_SELF?ptype=list&$param");


// 게시물 삭제
}else if($mode == "delete"){

	$sql = "select memid,passwd,upfile1,upfile2,upfile3,upfile4,upfile5,upfile6,upfile7,upfile8,upfile9,upfile10,upfile11,upfile12,movie1 from wiz_bbs where idx = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	$bbs_row = mysql_fetch_array($result);

	// 삭제권한 체크
	if(
	$mem_level == "0" ||																																			// 전체관리자
	($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)  ||	// 게시판관리자
	($bbs_row[memid] != "" && $bbs_row[memid] == $wiz_session[id]) || 												// 자신의글
	($bbs_row[passwd] != "" && $bbs_row[passwd] == $passwd)																		// 비밀번호일치
	){
	}else{
		if($passwd) error("비밀번호가 일치하지 않습니다.");
		else error("권한이 없습니다.");
	}


	for($ii = 1; $ii <= $upfile_max; $ii++) {

		if($bbs_row[upfile.$ii] != ""){
			@unlink($upfile_path."/".$bbs_row[upfile.$ii]);
			@unlink($upfile_path."/S".$bbs_row[upfile.$ii]);
			@unlink($upfile_path."/M".$bbs_row[upfile.$ii]);
		}

	}

	if($bbs_row[movie1] != ""){
		@unlink($upfile_path."/".$bbs_row[movie1]);
	}

	$sql = "delete from wiz_bbs where idx = '$idx'";
	mysql_query($sql) or error(mysql_error());

	delete_point("BBS", $bbs_row[memid], "write", $idx);

	alert("삭제 되었습니다.","$PHP_SELF?ptype=list&$param");



// 다중삭제
}else if($mode == "delbbs"){

	$array_selbbs = explode("|",$selbbs);
	for($ii=0;$ii<count($array_selbbs);$ii++){

		$idx = $array_selbbs[$ii];
		$sql = "select memid,passwd,upfile1,upfile2,upfile3,upfile4,upfile5,upfile6,upfile7,upfile8,upfile9,upfile10,upfile11,upfile12,movie1 from wiz_bbs where idx = '$idx'";
		$result = mysql_query($sql) or error(mysql_error());
		$bbs_row = mysql_fetch_array($result);

		// 삭제권한 체크
		if(
		$mem_level == "0" ||																																			// 전체관리자
		($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)  ||	// 게시판관리자
		($bbs_row[memid] != "" && $bbs_row[memid] == $wiz_session[id]) || 												// 자신의글
		($bbs_row[passwd] != "" && $bbs_row[passwd] == $passwd)																		// 비밀번호일치
		){
		}else{
			if($passwd) error("비밀번호가 일치하지 않습니다.");
			else error("권한이 없습니다.");
		}


		for($jj = 1; $jj <= $upfile_max; $jj++) {

			if($bbs_row[upfile.$jj] != ""){
				@unlink($upfile_path."/".$bbs_row[upfile.$jj]);
				@unlink($upfile_path."/S".$bbs_row[upfile.$jj]);
				@unlink($upfile_path."/M".$bbs_row[upfile.$jj]);
			}

		}

		if($bbs_row[movie1] != ""){
			@unlink($upfile_path."/".$bbs_row[movie1]);
		}

		$sql = "delete from wiz_bbs where idx = '$idx'";
		mysql_query($sql) or error(mysql_error());

		delete_point("BBS", $bbs_row[memid], "write", $idx);

	}

	alert("게시물이 삭제되었습니다.","$PHP_SELF?ptype=list&$param");



// 코멘트 입력
}else if($mode == "comment"){

	// 스팸글 차단
	$pos = strpos($HTTP_REFERER, $HTTP_HOST);
  if($pos === false) error("잘못된 경로 입니다.");

  if($mem_level != "0" && !strcmp($bbs_info[spam_check], "Y")) {

	  // 자동등록방지 코드 검사
	  if(empty($_POST[tmp_vcode]) || empty($_POST[vcode])) {
	  	error("자동등록방지 코드가 존재하지 않습니다.");
	  } else if(strcmp($_POST[tmp_vcode], md5($_POST[vcode]))) {
	  	error("자동등록방지 코드가 일치하지 않습니다.");
	  }
	}

	// 작성권한 체크
	if($cpermi < $mem_level) error($bbs_info[permsg],$bbs_info[perurl]);

	if($name == "") $name = $wiz_session[name];
	if($passwd == "") $passwd = $wiz_session[passwd];

	$sql = "select nick from wiz_member where id = '$wiz_session[id]'";
	$result = mysql_query($sql) or error(mysql_error());
	$row = mysql_fetch_array($result);

	$nick = $row[nick];

	// 욕설체크
	check_abuse($name); check_abuse($content);

	$ctype = "BBS";

	$sql = "insert into wiz_comment(idx,ctype,cidx,star,memid,name,nick,content,passwd,wdate,ip)
					 values('', '$ctype', '$cidx', '$star', '$wiz_session[id]', '$name', '$nick', '$content', '$passwd', now(), '$_SERVER[REMOTE_ADDR]')";
  $result = mysql_query($sql) or error(mysql_error());
	$point_cidx = mysql_insert_id();

	// 댓글수 업데이트
	$sql = "select idx from wiz_comment where cidx='$cidx'";
	$result = mysql_query($sql) or error(mysql_error());
	$comment = mysql_num_rows($result);

	$sql = "update wiz_bbs set comment = '$comment' where idx = '$cidx'";
	mysql_query($sql) or error(mysql_error());

	save_point("COMMENT", $wiz_session[id], "", $cidx, $point_cidx);

	echo "<script>document.location='$PHP_SELF?ptype=view&idx=$cidx&$param';</script>";



// 코멘트 삭제
}else if($mode == "delco"){

	$sql = "select memid,passwd from wiz_comment where idx='$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	$row = mysql_fetch_array($result);

	// 삭제권한 체크
	if(
	$mem_level == "0" ||																																			// 전체관리자
	($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)  ||	// 게시판관리자
	($row[memid] != "" && $row[memid] == $wiz_session[id]) || 																// 자신의글
	($row[passwd] != "" && $row[passwd] == $passwd)																						// 비밀번호일치
	){
	}else{
		if($passwd) error("비밀번호가 일치하지 않습니다.");
		else error("권한이 없습니다.");
	}

	$sql = "delete from wiz_comment where idx='$idx'";
  $result = mysql_query($sql) or error(mysql_error());

  // 댓글수 업데이트
	$sql = "select idx from wiz_comment where cidx='$cidx'";
	$result = mysql_query($sql) or error(mysql_error());
	$comment = mysql_num_rows($result);

	$sql = "update wiz_bbs set comment = '$comment' where idx = '$cidx'";
	mysql_query($sql) or error(mysql_error());

	delete_point("COMMENT", $row[memid], "", $cidx, $idx);

	alert("삭제 되었습니다.","$PHP_SELF?ptype=view&idx=$cidx&$param");



// 추천하기
}else if($mode == "recom"){

	if(strlen($HTTP_COOKIE_VARS["bbs_recom".$idx])==0){

		$sql = "select memid from wiz_bbs where idx = '$idx'";
		$result = mysql_query($sql) or error(mysql_error());
		$row = mysql_fetch_array($result);

		$memid = $row[memid];

		$sql = "update wiz_bbs set recom = recom + 1 where idx='$idx'";
		$result = mysql_query($sql) or error(mysql_error());

		setcookie("bbs_recom".$idx, $idx, time()+60*60*24*365);

		save_point("BBS", $memid, "recom", $idx);

		echo "<script>alert('추천 되었습니다.');document.location='$prev?ptype=view&recom=ok&idx=$idx&$param';</script>";

	}else{

		echo "<script>alert('한번만 추천가능합니다.');document.location='$prev?ptype=view&idx=$idx&$param';</script>";

	}



// 진열순서 변경
} else if(!strcmp($mode, "prino")) {

	$sql = "update wiz_bbs set prino = '$prino' where code = '$code' and idx = '$idx'";
	mysql_query($sql) or error(mysql_error());

	echo "<script>window.opener.document.location.href = window.opener.document.URL; document.location='order.php?$param';</script>";



// 진열순서 변경
} else if(!strcmp($mode, "pribbs")) {

	$array_selbbs = explode("|",$selbbs);
	$array_selpri = explode("|",$selpri);
	for($ii=0;$ii<count($array_selbbs);$ii++){

	$idx = $array_selbbs[$ii];
	$prino = $array_selpri[$ii];

	$sql = "update wiz_bbs set prino = '$prino' where code = '$code' and idx = '$idx'";
	mysql_query($sql) or error(mysql_error());

	}

	echo "<script>window.opener.document.location.href = window.opener.document.URL; document.location='order.php?$param';</script>";

}

?>
