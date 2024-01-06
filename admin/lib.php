<?

// prev, 스팸글 체크등 HTTP_HOST 체크 시 SSL 포트번호와 분리
list($_http_host) = explode(":", $_SERVER['HTTP_HOST']);

// 에러 출력
function error($msg, $go_url=""){

	if($go_url == "") {
		echo "<script>alert(\"$msg\");history.go(-1);</script>";
		exit;
	} else {
		echo "<script>alert(\"$msg\");document.location=\"$go_url\";</script>";
		exit;
	}


}

// 경고창 출력
function alert($msg, $go_url=""){

	if($go_url == "")
		echo "<script>alert(\"$msg\");history.go(-1);</script>";
	else
		echo "<script>alert(\"$msg\");document.location=\"$go_url\";</script>";

}

// 완료 메세지 출력
function complete($com_msg, $go_url=""){

	if($go_url == "")
		echo "<script>window.setTimeout(\"history.go(-1)\",600);</script>";
	else
	echo "<script>window.setTimeout(\"document.location='$go_url';\",600);</script>";

	echo "<body><table width=100% height=100%><tr><td align=center><font size=2>$com_msg</font></td></tr></table></body>";

}

// 테이블 데이타 얻기
function get_table($table, $search = ""){

	if($search != "") $search_sql = " where $search";
	$sql = "select * from ".$table.$search_sql;
	$result = mysql_query($sql) or error(mysql_error());
	$data = mysql_fetch_array($result);

	return $data;

}

// UTF-8 문자열 자르기
function php_fn_utf8_to_array($str){
  $re_arr = array();    $re_icount = 0;
  for($i=0,$m=strlen($str);$i<$m;$i++){
    $ch = sprintf('%08b',ord($str{$i}));
    if(strpos($ch,'11110')===0){$re_arr[$re_icount++]=substr($str,$i,4);$i+=3;}
    else if(strpos($ch,'1110')===0){$re_arr[$re_icount++]=substr($str,$i,3);$i+=2;}
    else if(strpos($ch,'110')===0){$re_arr[$re_icount++]=substr($str,$i,2);    $i+=1;}
    else if(strpos($ch,'0')===0){$re_arr[$re_icount++]=substr($str,$i,1);}
  }
  return $re_arr;
}

//utf8문자열을 잘라낸다.
function php_fn_utf8_substr($str,$start,$length=NULL){
	return implode('',array_slice(php_fn_utf8_to_array($str),$start,$length));
}

//utf8문자열의 길이를 구한다.
function php_fn_utf8_strlen($str){
	return count(php_fn_utf8_to_array($str));
}

// 문자열 끊기 (이상의 길이일때는 ... 로 표시)
function cut_str($msg, $cut_size){

	$pointtmp = php_fn_utf8_substr($msg,0,$cut_size);
	$msg_size = php_fn_utf8_strlen($msg);
	if($msg_size  > $cut_size) $pointtmp .= "...";

	return $pointtmp;

}



// 문자열의 마지막 문자를 * 로 처리해서 반환
function set_passwd($str){
   $re_str = "";
   $strlen = strlen($str) - 2;
   $re_str = substr($str,0,2);
   for($ii=0;$ii<$strlen;$ii++){
      $re_str .= "*";
   }

   return $re_str;

}


// 기본 레벨
function level_basic(){
	$sql = "select idx from wiz_level order by level desc limit 1";
	$result = mysql_query($sql) or error(mysql_error());
	$row = mysql_fetch_object($result);

	return $row->idx;

}


// 회원등급 리스트
function level_list(){

	$sql = "select idx,level,name from wiz_level order by level desc, idx asc";
	$result = mysql_query($sql) or error(mysql_error());
	while($row = mysql_fetch_object($result)){
		echo "<option value='$row->idx'>$row->name</option>";
	}

}


// 등급정보
function level_info(){

	$level_info[""][level] = 10000;
	$level_info[""][name] = "전체";
	$level_info["0"][level] = 0;
	$level_info["0"][name] = "관리자";

	$sql = "select * from wiz_level";
	$result = mysql_query($sql) or error(mysql_error());

	while($row = mysql_fetch_object($result)){
		$level_info[$row->idx][level] = $row->level;
		$level_info[$row->idx][name] = $row->name;
	}

	return $level_info;

}


// 비방글, 욕설체크
function check_abuse($str){

	global $bbs_info;
	global $poll_info;
	if(!empty($bbs_info)) {
		if($bbs_info['abuse'] == "Y") {
			$abuse_list = explode(",",$bbs_info[abtxt]);
			for($ii=0; $ii < count($abuse_list); $ii++){
				$abuse_list[$ii] = trim($abuse_list[$ii]);
				if(!empty($abuse_list[$ii])){
					if( strpos($str, $abuse_list[$ii]) !== false){
						error("'$abuse_list[$ii]' 단어는 사용하실 수 없습니다.");
					}
				}
			}
		}
	}

	if(!empty($poll_info)) {
		if($poll_info['abuse'] == "Y") {
			$abuse_list = explode(",",$poll_info[abtxt]);
			for($ii=0; $ii < count($abuse_list); $ii++){
				$abuse_list[$ii] = trim($abuse_list[$ii]);
				if(!empty($abuse_list[$ii])){
					if( strpos($str, $abuse_list[$ii]) !== false){
						error("'$abuse_list[$ii]' 단어는 사용하실 수 없습니다.");
					}
				}
			}
		}
	}

}

// 이미지 리사이즈
function img_resize($srcimg, $dstimg, $imgpath, $rewidth, $reheight, $mode=""){
	// $src_info[0] : width, $src_info[1] : height, $src_info[2] : type
	$src_info = getimagesize($imgpath."/".$srcimg);

	if(!strcmp($src_info['channels'], "4")) {
		//echo "<script>alert('현재 업로드하신 이미지는 CMYK 형식입니다. \\n\\n웹상에서 보이지 않을 수 있습니다.');</script>";
	}

	if($rewidth < $src_info[0] || $reheight < $src_info[1] ){

		if(!strcmp($mode, "width")) {

			$reheight = round(($src_info[1]*$rewidth)/$src_info[0]);

		} else {

			if(($src_info[0]-$rewidth) > ($src_info[1]-$reheight)){
				$reheight = round(($src_info[1]*$rewidth)/$src_info[0]);
			}else{
				$rewidth = round(($src_info[0]*$reheight)/$src_info[1]);
			}

		}

	}else{
		copy($imgpath."/".$srcimg,$imgpath."/".$dstimg);
		return;
	}

	if(function_exists(imageCreatetrueColor)) {

		$dst = @imageCreatetrueColor($rewidth,$reheight);

		if($src_info[2] == 1){

			$src = @ImageCreateFromGIF($imgpath."/".$srcimg);
			@imagecopyResampled($dst, $src,0,0,0,0,$rewidth,$reheight,ImageSX($src),ImageSY($src));
			@Imagejpeg($dst,$imgpath."/".$dstimg,100);

		}else if($src_info[2] == 2){

			$src = @ImageCreateFromJPEG($imgpath."/".$srcimg);
			@imagecopyResampled($dst, $src,0,0,0,0,$rewidth,$reheight,ImageSX($src),ImageSY($src));
			@Imagejpeg($dst,$imgpath."/".$dstimg,100);

		}else if($src_info[2] == 3){

			$src = @ImageCreateFromPNG($imgpath."/".$srcimg);
			@imagecopyResampled($dst, $src,0,0,0,0,$rewidth,$reheight,ImageSX($src),ImageSY($src));
			@Imagepng($dst,$imgpath."/".$dstimg);

		}else{

			copy($imgpath."/".$srcimg,$imgpath."/".$dstimg);

		}

		@imageDestroy($src);
		@imageDestroy($dst);

	} else {

			link($imgpath."/".$srcimg,$imgpath."/".$dstimg);

	}

}

// 파일이 이미지인지
function img_type($srcimg){
	if(is_file($srcimg)){

		$image_info = getimagesize($srcimg);
		switch ($image_info['mime']) {
			case 'image/gif': return true; break;
			case 'image/jpeg': return true; break;
			case 'image/png': return true; break;
			case 'image/bmp': return true; break;
			default : return false; break;
		}
	}else{
		return false;
	}

}

// 페이지 리스트 출력
function print_pagelist($page, $list_amount, $page_count, $param, $page_type = ""){

   global $code, $catcode, $orderby, $skin_dir, $ptype;

   if($skin_dir == "") $skin_dir = "/admin/manage";
   if($param != "") $param = "&".$param;

	if(($page%$list_amount) == 0) $tmp = $page-1;
	else $tmp = $page;

	$spage = floor($tmp/$list_amount)*$list_amount+1;
	if($spage <= 1) $ppage = 1;
	else $ppage = $spage - $list_amount;

	$epage = $spage+$list_amount-1;
	if($epage >= $page_count){
		$epage = $page_count;
		$npage = $page_count;
	}else{
		$npage = $epage + 1;
	}

	if(!empty($page_type)) {
		$page_name = strtolower($page_type)."page";
	} else {
		$page_name = "page";
	}

	if($epage > 0) {
	   echo "<div class='paging'><a href='$PHP_SELF?ptype=$ptype&$page_name=$ppage$param' class='prev_btn'><img src='$skin_dir/image/btn_prev.jpg'></a>";
	   echo "<div class='inner'>";

	   for($spage; $spage <= $epage; $spage++){
	      if($page == $spage) echo "<b class='btn'>$spage</b>";
	      else echo "<a href='$PHP_SELF?ptype=$ptype&$page_name=$spage$param' class='btn'> $spage </a>";
	   }

	   echo "</div>";
	   echo "          <a href='$PHP_SELF?ptype=$ptype&$page_name=$npage$param' class='next_btn'><img src='$skin_dir/image/btn_next.jpg'></a></div>";


	}

}

// 게시판 저장
function save_bbs($code, $name, $email, $subject, $ctype, $content, $passwd=""){

  global $DOCUMENT_ROOT;
  global $upfile1, $upfile1_size, $upfile1_name;
  global $upfile2, $upfile2_size, $upfile2_name;
  global $upfile3, $upfile3_size, $upfile3_name;

	$sql = "select max(prino) as prino from wiz_bbs where code = '$code'";
	$result = mysql_query($sql) or error(mysql_error());
	if($row = mysql_fetch_object($result)){
		$prino = $row->prino+1;
	}

	$upfile_idx = date('Ymdhis').rand(1,9);
	if(!is_dir("$_SERVER[DOCUMENT_ROOT]/wizhome/bbs/upfile/$code")){
		echo exec("mkdir $_SERVER[DOCUMENT_ROOT]/wizhome/bbs/upfile/$code");
		exec("chmod 705 $_SERVER[DOCUMENT_ROOT]/wizhome/bbs/upfile/$code");
	}

	if($upfile1_size > 0){
		$upfile1_tmp = $upfile_idx.".".substr($upfile1_name,-3);
		exec("cp $upfile1 $_SERVER[DOCUMENT_ROOT]/wizhome/bbs/upfile/$code/$upfile1_tmp");
		exec("chmod 606 $_SERVER[DOCUMENT_ROOT]/wizhome/bbs/upfile/$code/$upfile1_tmp");
	}
	if($upfile2_size > 0){
		$upfile2_tmp = $upfile_idx.".".substr($upfile2_name,-3);
		exec("cp $upfile2 $_SERVER[DOCUMENT_ROOT]/wizhome/bbs/upfile/$code/$upfile2_tmp");
		exec("chmod 606 $_SERVER[DOCUMENT_ROOT]/wizhome/bbs/upfile/$code/$upfile2_tmp");
	}
	if($upfile3_size > 0){
		$upfile3_tmp = $upfile_idx.".".substr($upfile3_name,-3);
		exec("cp $upfile3 $_SERVER[DOCUMENT_ROOT]/wizhome/bbs/upfile/$code/$upfile3_tmp");
		exec("chmod 606 $_SERVER[DOCUMENT_ROOT]/wizhome/bbs/upfile/$code/$upfile3_tmp");
	}

	$authkey = rand(0,999);
	$content = str_replace("'","",$content);
	$content = str_replace("\"","",$content);
	$sql = "insert into wiz_bbs(idx,code,prino,depno,notice,name,email,subject,content,ctype,upfile,upfile2,upfile3,upfile_name,upfile2_name,upfile3_name,wdate,passwd,authkey)
	                           values('', '$code', '$prino', '', '','$name', '$email', '$subject', '$content', '$ctype', '$upfile1_tmp', '$upfile2_tmp', '$upfile3_tmp', '$upfile1_name', '$upfile2_name', '$upfile3_name', now(), '$passwd','$authkey')";

	mysql_query($sql) or error(mysql_error());

}

function info_replace($site_info, $re_info, $msg){

	global $_http_host;

	$date = date('Y')."년 ".date('m')."월 ".date('d')."일";

	$msg = str_replace("{DATE}", $date, $msg);
	$msg = str_replace("{MEM_ID}", $re_info[id], $msg);
	$msg = str_replace("{MEM_PW}", $re_info[passwd], $msg);
	$msg = str_replace("{MEM_NAME}", $re_info[name], $msg);
	$msg = str_replace("{SITE_NAME}", $site_info[site_name], $msg);
	$msg = str_replace("{SITE_EMAIL}", $site_info[site_email], $msg);
	$msg = str_replace("{SITE_TEL}", $site_info[site_tel], $msg);
	$msg = str_replace("{SITE_URL}", "http://".$_http_host, $msg);

	return $msg;

}

function site_replace($site_info, $re_info, $msg){

	global $_http_host;

	$date = date('Y')."년 ".date('m')."월 ".date('d')."일";

	$msg = str_replace("{SITE_URL}", "http://".$_http_host, $msg);

	return $msg;

}

// 이메일 발송
function send_mail($se_name, $se_email, $re_name, $re_email, $subject, $content, $cc="", $bcc="")
{
/*
	$se_name = iconv('utf-8', 'euc-kr', $se_name);
	$se_email = iconv('utf-8', 'euc-kr', $se_email);
	$re_name = iconv('utf-8', 'euc-kr', $re_name);
	$re_email = iconv('utf-8', 'euc-kr', $re_email);
	$subject = iconv('utf-8', 'euc-kr', $subject);
	$content = iconv('utf-8', 'euc-kr', $content);
*/

	$charset  = "UTF-8";

	$se_name   = "=?$charset?B?" . base64_encode($se_name) . "?=";
	$subject = "=?$charset?B?" . base64_encode($subject) . "?=";

	$header  = "Return-Path: <$se_email>\n";
	$header .= "From: $se_name <$se_email>\n";
	$header .= "Reply-To: <$se_email>\n";
	if ($cc)  $header .= "Cc: $cc\n";
	if ($bcc) $header .= "Bcc: $bcc\n";
	$header .= "MIME-Version: 1.0\n";

	$header .= "Content-Type: TEXT/HTML; charset=$charset\n";
	$content = stripslashes($content);

	$header .= "Content-Transfer-Encoding: BASE64\n\n";
	$header .= chunk_split(base64_encode($content)) . "\n";

	$result = @mail($re_email, $subject, "", $header);

	return $result;

}

// SMS 발송
function send_sms($se_num, $re_num, $message, $se_name=""){

	global $site_info;

	/**************************************************************************************
		SMS 클래스 사용 예제입니다.
	**************************************************************************************/
	include_once WIZHOME_PATH."/inc/class.sms.php";

	$sms_server	= "211.172.232.124";	## SMS 서버
	$sms_id		= $site_info[sms_id];				## icode 아이디
	$sms_pw		= $site_info[sms_pw];				## icode 패스워드
	//$portcode	= 1;				## 정액제 : 2, 충전식 : 1
	if($site_info[sms_type] == "" || $site_info[sms_type] == "C") $portcode = 1;
	else if($site_info[sms_type] == "J") $portcode = 2;

	$SMS	= new SMS;
	$SMS->SMS_con($sms_server,$sms_id,$sms_pw,$portcode);

	/**************************************************************************************
	1단계: 보낼 메시지를 저장합니다. 쇼핑몰에서 장바구니에 물건을 담는다고 생각하면 됩니다.

		일반 메시지를 보낼 경우 SMS->Add() 를 사용합니다. 인자는 다음과 같습니다.
			1. 받는 사람 핸드폰 번호
			2. 보내는 사람 전화 (회신번호)
			3. 보내는 사람 이름
			4. 보내는 메시지 (80자 이내)
			5. 예약시간 (12자 - 예약발송일 경우에만 입력. 예: 2001년 5월30일 오후2시30분이면 200105301430)

		URL을 보낼 경우 SMS->AddURL() 을 사용합니다. 인자는 다음과 같습니다.
			1. 받는 사람 핸드폰 번호
			2. URL (50자 이내)
			3. 보내는 메시지 (80자 이내)
			4. 예약시간 (12자 - 예약발송일 경우에만 입력. 예: 2001년 5월30일 오후2시30분이면 200105301430)

		잘못된 값이 들어갔을 경우 에러메시지가 리턴됩니다.

		※ .URL 콜백의 경우 건당 50원의 요금이 부과 됩니다.
		※ .SKT(011,017) 번호로 발송하실 경우 사용자 동의를 받지 않아 전송 실패일 경우에도
		    정상적으로 요금이 청구 됩니다.
		※ .KTF(016,018) 번호로 발송하실 경우 회신번호를 반드시 입력하셔야 정상적으로 송신이 됩니다.
	**************************************************************************************/

	$tran_phone	= str_replace("-", "", $re_num);		# 수신번호
	$tran_callback	= str_replace("-", "", $se_num);			# 회신번호
	$tran_msg		= str_conv($message, "euc-kr");	# 발송 메세지
	$tran_date	= "";				#발송시간
	#즉시 전송일 경우 $tran_date	= "" ;
	#예약 전송일 경우 $tran_date	= "200412312359";	# 2004년 12월 31일 23시 59분

	$result = $SMS->Add($tran_phone,"$tran_callback","$sms_id","$tran_msg","$tran_date");
	//if ($result) echo $result; else echo "일반메시지 입력 성공<BR>";

	//$result = $SMS->AddURL($tran_phone,"$tran_callback","w.yahoo.co.kr","테스트입니다","");
	//if ($result) echo $result; else echo "URL 입력 성공<BR>";
	//echo "<HR>";

	/**************************************************************************************
	2단계: 저장해둔 메시지를 전송합니다. 쇼핑몰에서 결제를 한다고 생각하면 됩니다.

		SMS->Send() 를 실행하면 모아둔 메시지를 모두 발송합니다.
		이때 SMS->Send()가 리턴하는 값은 true, false 입니다.
		이것은 서버와의 접속 상태를 나타냅니다.

		SMS->Send() 를 실행하고 난 후에는 메시지 발송 결과를 조회할 수 있습니다.
		메시지 발송 결과는 SMS->Result 배열에 저장되어 있습니다.
		데이타 형식은 "핸드폰 번호 : 메시지 고유번호" 입니다. 예) 0115511474:13622798
		전송이 제대로 되지 않은 건에 대해서는 에러 표시가 납니다. 예) 0195200107:Error

		만약 같은 클래스를 재사용할 경우, SMS->Init() 명령으로 메시지 발송 결과를 없애주십시오.
	**************************************************************************************/

	$result = $SMS->Send();
	if ($result) {
		//echo "SMS 서버에 접속했습니다.<br>";
		$success = $fail = 0;
		foreach($SMS->Result as $result) {
			list($phone,$code)=explode(":",$result);
			if ($code=="Error") {
				//echo $phone.'로 발송하는데 에러가 발생했습니다.<br>';
				$fail++;
			} else {
				//echo $phone."로 전송했습니다. (메시지번호:".$code.")<br>";
				$success++;
			}
		}
		//echo $success."건을 전송했으며 ".$fail."건을 보내지 못했습니다.<br>";
		$SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
	} else {
		//echo "에러: SMS 서버와 통신이 불안정합니다.<br>";
	}

	//echo "<table width='100%'><tr><td align='center'><span onClick='self.close()' style='cursor:pointer'>[닫기]</span></td></tr></table>";

}

// 메일내용 생성
function send_mailsms($type, $re_info){

	global $site_info;

	// 관리자 정보 가져오기
	include WIZHOME_PATH."/inc/site_info.php";

	$se_name = $site_info[site_name];
	$se_email = $site_info[site_email];
	$se_tel = $site_info[site_tel];

	// 메일/sms 발송내용 가져오기
	$mail_info = get_table("wiz_mailsms", "code = '$type'");

	$mail_info[email_subj] = info_replace($site_info, $re_info, $mail_info[email_subj]);
	$mail_info[email_msg] = info_replace($site_info, $re_info, $mail_info[email_msg]);
	$mail_info[sms_msg] = info_replace($site_info, $re_info, $mail_info[sms_msg]);
	$mail_info[email_msg] = stripslashes($mail_info[email_msg]);

	if($mail_info[email_send] != "N"){
		send_mail($se_name, $se_email, $re_info[name], $re_info[email], $mail_info[email_subj], $mail_info[email_msg]);
	}

	if($mail_info[sms_send] != "N"){
		send_sms($se_tel, $re_info[hphone], $mail_info[sms_msg], $se_name);
	}


}


// 중복로그인 방지 세션삭제
function del_session($id){

	$sess_path = WIZHOME_PATH."/data/session";
	$dirlist = opendir($sess_path);

	while($file = readdir($dirlist)){
		if ($file != "." && $file != "..") {
			$sline = file($sess_path."/".$file,"r");
			$slist = explode(";",$sline[0]);
			$slist = explode(":",$slist[1]);
			if ($slist[2] == "\"".$id."\"") unlink($sess_path."/".$file);
		}
	}

}


// 포인트 저장
function save_point($ptype, $memid, $mode = "", $bidx = "", $cidx = "", $midx = ""){

	global $code;
	global $wiz_session;

	include WIZHOME_PATH."/inc/site_info.php";
	include WIZHOME_PATH."/inc/bbs_info.php";

	if(!strcmp($site_info[point_use], "Y") && !empty($memid)) {

		$mem_point = get_point($memid);

		$save = "Y";

		if(!strcmp($ptype, "JOIN")) {
			$point = $site_info[join_point];
			$memo = "회원가입 포인트";
		}

		if(!strcmp($ptype, "LOGIN")) {
			$point = $site_info[login_point];
			$memo = "로그인 포인트";

			$sql = "select idx from wiz_point where memid = '$memid' and ptype = 'LOGIN' and DATE_FORMAT(wdate, '%Y%m%d') = '".date('Ymd')."'";
			$result = mysql_query($sql) or error(mysql_error());
			$login_cnt = mysql_num_rows($result);

			if($login_cnt > 0) $save = "N";

		}

		if(!strcmp($ptype, "MSG")) {
			$point = $site_info[msg_point];
			$memo = "쪽지 보내기 포인트";
		}

		if(!strcmp($ptype, "BBS")) {
			if(!strcmp($mode, "view")) {
				$point = $bbs_info[view_point];
				$memo = "게시판 보기 포인트";
			}
			if(!strcmp($mode, "write")) {
				$point = $bbs_info[write_point];
				$memo = "게시판 글쓰기 포인트";

			}
			if(!strcmp($mode, "down")) {
				$point = $bbs_info[down_point];
				$memo = "게시판 다운로드 포인트";
			}
			if(!strcmp($mode, "recom")) {
				$point = $bbs_info[recom_point];
				$memo = "게시판 추천 포인트";
			}
		}

		if(!strcmp($ptype, "COMMENT")) {
			$sql = "select code from wiz_bbs where idx = '$bidx'";
			$result = mysql_query($sql) or error(mysql_error());
			$row = mysql_Fetch_array($result);
			$code = $row[code];

			include WIZHOME_PATH."/inc/bbs_info.php";

			$point = $bbs_info[comment_point];
			$memo = "게시판 덧글 포인트";
		}

		if($mem_point + $point < 0) {
			$save = "N";
			error($bbs_info[point_msg]);
		}

		if(!strcmp($site_info[point_use], "Y") && !strcmp($save, "Y") && $point != 0) {
			$sql = "insert into wiz_point (idx,bidx,cidx,midx,ptype,mode,memid,point,memo,wdate)
							values('','$bidx','$cidx','$midx','$ptype','$mode','$memid','$point','$memo',now())";
			mysql_query($sql) or error(mysql_error());
		}

	}
}

// 포인트 삭제
function delete_point($ptype, $memid, $mode = "", $bidx = "", $cidx = "", $midx = ""){

	include WIZHOME_PATH."/inc/site_info.php";

	if(!strcmp($site_info[point_use], "Y")) {
		if(!strcmp($ptype, "BBS")) {

			$where_sql = " and bidx = '$bidx' and mode = '$mode' ";
			if(!strcmp($mode, "view")) $memo = "게시글 보기 포인트 삭제";
			if(!strcmp($mode, "write")) $memo = "게시글 삭제";
			if(!strcmp($mode, "down")) $memo = "게시글 다운로드 포인트 삭제";

		} else if(!strcmp($ptype, "COMMENT")) {

			$where_sql = " and cidx = '$cidx' ";
			$memo = "덧글 삭제";

		} else if(!strcmp($ptype, "MSG")) {

			$where_sql = " and midx = '$midx' ";
			$memo = "쪽지 삭제";

		}

		$sql = "select point from wiz_point where memid = '$memid' $where_sql";
		$result = mysql_query($sql) or error(mysql_error());
		$row = mysql_fetch_array($result);

		if($row[point] > 0) $point = "-".$row[point];
		else $point = abs($row[point]);

		if(!empty($memid) && $point != 0) {

			$sql = "insert into wiz_point (idx,bidx,cidx,midx,ptype,mode,memid,point,memo,wdate)
							values('','$bidx','$cidx','$midx','$ptype','$mode','$memid','$point','$memo',now())";
			mysql_query($sql) or error(mysql_error());

		}
	}
}

// 회원 포인트
function get_point($memid){

	include WIZHOME_PATH."/inc/site_info.php";

	if(!strcmp($site_info[point_use], "Y")) {
		$sql = "select sum(point) as total_point from wiz_point where memid = '$memid' and memid != ''";
		$result = mysql_query($sql) or error(mysql_error());
		$row = mysql_fetch_array($result);

		return $row[total_point];
	}
}

// 포인트 체크 포인트가 부족할때 false 충분할때 true
function check_point($memid, $point){

	global $wiz_session;

	include WIZHOME_PATH."/inc/site_info.php";

	if(!strcmp($site_info[point_use], "Y") && $wiz_session[level] > 0) {
		$mem_point = get_point($memid);
		if($mem_point + $point < 0) return false;
		else return true;
	} else {
		return true;
	}
}

// 파일 확장자 체크
function file_check($filename, $file_str = "php|htm|html|inc|htm|shtm|ztx|dot|cgi|pl|phtm|ph|exe"){

	$fnames = explode(".", $filename);
	$fext = $fnames[count($fnames)-1];
	$fext = strtolower($fext);
	$file_str = strtolower($file_str);

	//업로드 금지 확장자 체크
	if(eregi($file_str, $fext)) {
		error("해당 파일은 업로드할 수 없는 형식입니다.");
		exit;
	}

}

// 연결 페이지 업데이트
function update_page($type){

	global $code;
	global $catcode;
	global $PHP_SELF;

	if(strpos($PHP_SELF,"/manage/") == false) {

		switch ($type) {
			case "MEM_JOIN"		: $table = "wiz_meminfo"; $field = "join_url"; break;
			case "MEM_LOGIN"	: $table = "wiz_meminfo"; $field = "login_url"; break;
			case "MEM_IDPW" 	: $table = "wiz_meminfo"; $field = "idpw_url"; break;
			case "MEM_INFO" 	: $table = "wiz_meminfo"; $field = "myinfo_url"; break;
			case "MESSAGE" 		: $table = "wiz_siteinfo"; $field = "msg_url"; break;
			case "POINT" 			: $table = "wiz_siteinfo"; $field = "point_url"; break;
			case "SCH" 				: $table = "wiz_bbsinfo"; $field = "pageurl"; break;
			case "BBS" 				: $table = "wiz_bbsmain"; $field = "purl"; break;
			case "PRD" 				: $table = "wiz_category"; $field = "purl"; break;
			case "POLL" 			: $table = "wiz_pollinfo"; $field = "purl"; break;
			case "SEARCH"			: $table = "wiz_siteinfo"; $field = "search_url"; break;
		}

		if(empty($table) || empty($field)) {
			alert("연결 페이지 업데이트를 위한 함수를 정상적으로 불러들이지 못하였습니다. \\n\\n해당 페이지를 확인해주세요.");
		} else {

			$this_page = substr($PHP_SELF, 1, strlen($PHP_SELF));

			if(!empty($code) && strcmp($table, "wiz_meminfo") && strcmp($table, "wiz_siteinfo")) $code_sql = " where code = '$code' ";
			if(!empty($catcode) && !strcmp($table, "wiz_category")) {

				if($catcode != ""){

					$catcode01 = str_replace("00","",substr($catcode,0,2));
					$catcode02 = str_replace("00","",substr($catcode,2,2));
					$catcode03 = str_replace("00","",substr($catcode,4,2));
					$tmp_code = $catcode01.$catcode02.$catcode03;

					if($tmp_code != "") $catcode_sql = " where catcode like '$tmp_code%' ";
					else $catcode_sql = " where catcode = '$catcode' ";

					$code_sql = "";

				}

			}
			$sql = "select $field from $table $code_sql $catcode_sql";
			$result = mysql_query($sql) or error(mysql_error());

			while($row = mysql_fetch_array($result)) {

				if(strcmp($row[$field], $this_page)) {
					$sql = "update $table set $field = '$this_page' $code_sql $catcode_sql";
					mysql_query($sql) or error(mysql_error());
				}

			}

		}

	}

}

// 보기페이지 이미지 리사이즈
function view_img_resize(){

	global $_ResizeCheck;

	if($_ResizeCheck) {
?>
<!-- 이미지 리사이즈를 위해서 처리하는 부분 -->
<script>
	function wiz_img_check(){
		//var wiz_main_table_width = document.wiz_get_table_width.width;
		var wiz_main_table_width = document.getElementById('wiz_get_table_width').style.width;
		wiz_main_table_width = wiz_main_table_width.replace("px", "");
		var wiz_target_resize_num = document.wiz_target_resize.length;
		for(i=0;i<wiz_target_resize_num;i++){
			if(document.wiz_target_resize[i].width > wiz_main_table_width) {
				document.wiz_target_resize[i].width = wiz_main_table_width;
			}
		}
	}
	window.onload = wiz_img_check;
</script>

<?
	}

}

// 자동등록방지코드 생성
function get_spam_check(){

	global $is_norobot;
	global $norobot_img;
	global $norobot_msg;
	global $norobot_key;
	global $spam_check;

	global $form_info;	// 폼메일 자동등록방지 코드 생성 시 필요

	if(!empty($form_info[idx])) $idx = $form_info[idx];

	$is_norobot = false;

	$tmp_str = substr(md5(rand()),0,12); // 임의의 md5 문자열을 생성

	list($usec, $sec) = explode(' ', microtime()); // 난수 발생기
	$seed =  (float)$sec + ((float)$usec * 100000);
	srand($seed);
	$keylen = strlen($tmp_str);
	$div = (int)($keylen / 2);
	while (count($arr) < 6)
	{
	    unset($arr);
	    for ($i=0; $i<$keylen; $i++)
	    {
	        $rnd = rand(1, $keylen);
	        $arr[$rnd] = $rnd;
	        if ($rnd > $div) break;
	    }
	}

	sort($arr);	// 배열에 저장된 숫자를 차례대로 정렬

	$norobot_key = "";
	$norobot_str = "";
	$m = 0;

	for ($i=0; $i<count($arr); $i++)
	{
	    for ($k=$m; $k<$arr[$i]-1; $k++)
	        $norobot_str .= $tmp_str[$k];
	    $norobot_str .= "<font size=3 color=#FF0000><b>{$tmp_str[$k]}</b></font>";
	    $norobot_key .= $tmp_str[$k];
	    $m = $k + 1;

	}

	if ($m < $keylen) {
	    for ($k=$m; $k<$keylen; $k++)
	        $norobot_str .= $tmp_str[$k];
	}

	$norobot_str = "<font color=#999999>$norobot_str</font>";

	$ss_norobot_key = $norobot_key;
	$is_norobot = true;

	if (function_exists("imagecreate")) {	// 이미지 생성이 가능한 경우 자동등록체크코드를 이미지로 생성
	  $norobot_img = "<img src='/admin/bbs/norobot_image.php?ss_norobot_key=$norobot_key' border='0' style='border: 1px solid #343d4f;' align='absmiddle'>";
	  $norobot_msg = "* 왼쪽의 자동등록방지 코드를 입력하세요.";
	}
	else {
	 $norobot_img = $norobot_str;
	 $norobot_msg = "* 왼쪽의 글자중 <FONT COLOR='red'>빨간글자</font>만 순서대로 입력하세요.";
	}
	$spam_check = $norobot_img." <input type='text' name='vcode' id='vcode' class='input' size='15' /> ".$norobot_msg;

	?>
	<script Language="JavaScript" src="/admin/js/md5.js"></script>
	<script language="javascript">
	<!--

	function hex_md5(s) {
		return binl2hex(core_md5(str2binl(s), s.length * chrsz));
	}
	var md5_norobot_key<?=$idx?> = "<?=md5($norobot_key)?>";

	String.prototype.trim = function() {
		return this.replace(/^\s+|\s+$/g, "");
	}

	//-->
	</script>
<?php
}

// 디렉토리 삭제
function rm_dir($path){
	$oDir = @openDir($path);
	while($entry = @readDir($oDir)) {
		if($entry <> '.' && $entry <> '..') {
			if(Is_Dir($path.'/'.$entry)) {
				rm_dir ($path.'/'.$entry);
			} else {
				@UnLink ($path.'/'.$entry);
			}
		}
	}
	@closeDir($oDir);
	@RmDir($path);
}

//SQL 입력값 문자열 필터
//$str = 입력 문자열
function sql_filter($str){
	//1단계 ? ',",NULL 문자 필터링. 각 문자들에 백슬래쉬(\) 삽입됨. 필수 항목
	//출력시 stripslashes()함수를 이용하여 백슬래쉬(\)를 제거
	if (!get_magic_quotes_gpc()) $str = addslashes($str);

	//3단계 ? 특수 문자 및 문자열 필터링
	//WHERE 구문에서 쓰여지는 데이터만 사용하는 것이 바람직하다.
	$search = array("--","#",";");
	$replace = array("\--","\#","\;");
	$str = str_replace($search, $replace, $str);

	return $str;
}

function xss_check($get_String, $get_HTML = true){

	// xss_check (Cross Site Script) 막기
	$get_String = preg_replace("/(on)([a-z]+)([^a-z]*)(\=)/i", "&#111;&#110;$2$3$4", $get_String);
	$get_String = preg_replace("/(dy)(nsrc)/i", "&#100;&#121;$2", $get_String);
	$get_String = preg_replace("/(lo)(wsrc)/i", "&#108;&#111;$2", $get_String);
	$get_String = preg_replace("/(sc)(ript)/i", "&#115;&#99;$2", $get_String);
	$get_String = preg_replace("/(ex)(pression)/i", "&#101&#120;$2", $get_String);

   if(!$get_HTML) {
	  $get_String = STR_REPLACE( "<", "&lt;", $get_String );
	  $get_String = STR_REPLACE( ">", "&gt;", $get_String );
   }
   return $get_String;

}

// 문자열 변환 in_charset → out_charset
function str_conv($str, $mode){
	if(!strcmp(strtolower($mode), 'euc-kr')) {
		$in_charset = "utf-8";
		$out_charset = "euc-kr";
	} else if(!strcmp(strtolower($mode), 'utf-8')) {
		$in_charset = "euc-kr";
		$out_charset = "utf-8";
	}

	if(iconv($out_charset,$out_charset,$str)==$str) return $str;
	else return iconv($in_charset,$out_charset,$str);
}


// 로봇 체크
function check_robots($user_agent){
	$robots = array('1Noonbot', 'Accoona-AI-Agent', 'Allblog.net', 'Baiduspider', 'Blogbeat', 'Crawler', 'DigExt', 'DrecomBot', 'Exabot', 'FeedChecker', 'FeedFetcher', 'Gigabot', 'Googlebot', 'HMSE_Robot', 'IP*Works!', 'IRLbot', 'Jigsaw', 'LWP::Simple', 'Labrador', 'MJ12bot', 'Mirror Checking', 'Missigua Locator', 'NG/2.0', 'NaverBot', 'NutchCVS', 'PEAR HTTP_Request', 'PostFavorites', 'SBIder', 'W3C_Validator', 'WISEbot', 'Y!J-BSC', 'Yahoo! Slurp', 'ZyBorg', 'archiver', 'carleson', 'cfetch', 'compatible; Eolin', 'favicon', 'feedfinder', 'findlinks', 'genieBot', 'ichiro', 'kinjabot', 'larbin', 'lwp-trivial', 'msnbot', 'psbot', 'sogou', 'urllib/1.15', 'voyager');
	foreach($robots as $robot)
		if(strpos($user_agent, $robot) !== false)
			return false;
	return true;
}

// OS,브라우저 정보
function get_osbrowser($user_agent){

	if(strpos($user_agent, "Gecko") ){
		if(strpos($user_agent, "Netscape") ){
			$browser = "Netscape";
		}else if(strpos($user_agent, "Firefox") ){
			$browser = "Firefox";
		}else{
			$browser = "Mozilla";
		}
	}else if(strpos($user_agent, "MSIE") ){
		if (strpos($user_agent, "Opera") ){
			$browser = "Opera";
		}else if (strpos($user_agent, "MSIE or Firefox") ){
			$browser = "MSIE or Firefox";
		}else{
			$browser = "Explorer";
			$sidx = strpos($user_agent,"MSIE")+4; $eidx = strpos($user_agent,";",$sidx);
			if(strpos($user_agent, "Trident/4.0")) $browser .= " 8.0";
			else if($sidx-$eidx == 4) $browser .=  substr($user_agent,$sidx,4);
		}
	}else{
		$browser = "Etc";
	}

	if (strpos($user_agent, "Windows 95") ){
		$os = "Win95";
	}else if(strpos($user_agent, "Win98 95") || strpos($user_agent, "Windows 98")){
		$os = "Win98";
	}else if(strpos($user_agent, "Windows NT 6.1") ){
		$os = "Win7";
	}else if(strpos($user_agent, "Windows NT 6") ){
		$os = "Vista";
	}else if(strpos($user_agent, "Windows NT 5.2") ){
		$os = "Win2003";
	}else if( strpos($user_agent, "Windows NT 5.01") ){
		$os = "Win2000";
	}else if(strpos($user_agent, "Windows NT 5.1") ){
		$os = "WinXP";
	}else if(strpos($user_agent, "Windows NT 5") ){
		$os = "Win2000";
	}else if(strpos($user_agent, "Macintosh") || strpos($user_agent, "Mac_PowerPC") || strpos($user_agent, "mac")){
		$os = "Mac";
	}else if(strpos($user_agent, "Linux") || strpos($user_agent, "Wget")){
		$os = "Linux";
	}else if(strpos($user_agent, "Unix")){
		$os = "Unix";
	}else{
		$os = "Etc";
	}
	$data["browser"] = $browser;
	$data["os"] = $os;

	return $data;

}

// 게시물 번호 ($no)
function get_bbs_no($data) {

	global $bbs_info, $wiz_session;
	@extract($data);

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

	$sql = "select idx from wiz_bbs where code = '$code' $my_sql $category_sql $search_sql $address_sql order by prino desc";
	$result = mysql_query($sql) or error(mysql_error());
	$total = mysql_num_rows($result);

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
					where wb.code = '$code' $category_sql $search_sql $my_sql $address_sql
					order by wb.prino desc limit $start, $rows";

	$result = mysql_query($sql) or error(mysql_error());

	while($row = mysql_fetch_array($result)){
		if($row[idx] == $idx) break;
		$no--;
	}

	return $no;
}

function get_rand_str($len=5) {
	$code_char = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

	for($ii = 0; $ii < $len; $ii++) {
		$code_number .= $code_char{rand()%strlen($code_char)};
	}

	return $code_number;
}

function xml2array($content, $get_attributes = 1, $priority = 'tag')
{
    $contents = "";
    if (!function_exists('xml_parser_create'))
    {
        return array ();
    }
    $parser = xml_parser_create('');
    $url = $content;
    $url_list = parse_url($url);

    // URL
    if($url_list['host'] != "") {

			if(!($socket = fsockopen($url_list['host'], 80, $errno, $errstr, 5))) { // URL에 소켓 연결
				echo " $errno : $errstr ";
				exit;
			}

			$header = "GET {$url} HTTP/1.0\n\n";
			fwrite($socket, $header);

			$data = '';
			while(!feof($socket)) { $data .= fgets($socket); }
			fclose($socket);

			$data = explode("\r\n\r\n", $data, 2);
			$contents = $data[1];

		// XML Data
		} else {

			$contents=$content;

		}

    //xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8"); //xml  파서에서 옵션설정 인코딩
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0); ///대문자로변경
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1); //공백값무시
    xml_parse_into_struct($parser, trim($contents), $xml_values); //읽어들인 xml를 이용해 배열에 xml 구조를 담는다
    xml_parser_free($parser); //파서해제

    if (!$xml_values)
        return; //Hmm...
    $xml_array = array ();
    $parents = array ();
    $opened_tags = array ();
    $arr = array ();
    $current = & $xml_array;
    $repeated_tag_index = array ();

    foreach ($xml_values as $data)
    {
        unset ($attributes, $value);
        extract($data);
        $result = array ();
        $attributes_data = array ();
        if (isset ($value))
        {
            if ($priority == 'tag')
                $result = $value;
            else
                $result['value'] = $value;
        }
        if (isset ($attributes) and $get_attributes)
        {
            foreach ($attributes as $attr => $val)
            {
                if ($priority == 'tag')
                    $attributes_data[$attr] = $val;
                else
                    $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'
            }
        }
        if ($type == "open")
        {
            $parent[$level -1] = & $current;
            if (!is_array($current) or (!in_array($tag, array_keys($current))))
            {
                $current[$tag] = $result;
                if ($attributes_data)
                    $current[$tag . '_attr'] = $attributes_data;
                $repeated_tag_index[$tag . '_' . $level] = 1;
                $current = & $current[$tag];
            }
            else
            {
                if (isset ($current[$tag][0]))
                {
                    $current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
                    $repeated_tag_index[$tag . '_' . $level]++;
                }
                else
                {
                    $current[$tag] = array (
                        $current[$tag],
                        $result
                    );
                    $repeated_tag_index[$tag . '_' . $level] = 2;
                    if (isset ($current[$tag . '_attr']))
                    {
                        $current[$tag]['0_attr'] = $current[$tag . '_attr'];
                        unset ($current[$tag . '_attr']);
                    }
                }
                $last_item_index = $repeated_tag_index[$tag . '_' . $level] - 1;
                $current = & $current[$tag][$last_item_index];
            }
        }
        elseif ($type == "complete")
        {
            if (!isset ($current[$tag]))
            {
                $current[$tag] = $result;
                $repeated_tag_index[$tag . '_' . $level] = 1;
                if ($priority == 'tag' and $attributes_data)
                    $current[$tag . '_attr'] = $attributes_data;
            }
            else
            {
                if (isset ($current[$tag][0]) and is_array($current[$tag]))
                {
                    $current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
                    if ($priority == 'tag' and $get_attributes and $attributes_data)
                    {
                        $current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
                    }
                    $repeated_tag_index[$tag . '_' . $level]++;
                }
                else
                {
                    $current[$tag] = array (
                        $current[$tag],
                        $result
                    );
                    $repeated_tag_index[$tag . '_' . $level] = 1;
                    if ($priority == 'tag' and $get_attributes)
                    {
                        if (isset ($current[$tag . '_attr']))
                        {
                            $current[$tag]['0_attr'] = $current[$tag . '_attr'];
                            unset ($current[$tag . '_attr']);
                        }
                        if ($attributes_data)
                        {
                            $current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
                        }
                    }
                    $repeated_tag_index[$tag . '_' . $level]++; //0 and 1 index is already taken
                }
            }
        }
        elseif ($type == 'close')
        {
            $current = & $parent[$level -1];
        }
    }

    return ($xml_array);
}

// 우편번호 검색
function get_zipcode_list($address) {

	// 도로명주소 관련 변수
	$site_info['zipcode_key']	= "5C38658E5EBBDFC5AD88D24EC7D80449";	// API키
	$site_info['zipcode_url']	= "ws.didim365.com";									// API주소
	$site_info['zipcode_enc']	= "utf-8";														// 인코딩 : euc-kr, utf-8
	$site_info['zipcode_dr']	= "t";																// 도로명주소 포함여부 : t(포함), f(포함안함)
	$site_info['zipcode_jb']	= "t";																// 지번주소 포함여부 : t(포함), f(포함안함)
	$site_info['zipcode_de']	= "f";																// 도로명영어주소 포함여부 : t(포함), f(포함안함)
	$site_info['zipcode_bn']	= "f";																// 대량배달/건물명 포함여부 : t(포함), f(포함안함)
	$site_info['zipcode_sp']	= "t";																// 건물번호/지번 제외여부 : t(포함), f(포함안함)

	$search_count = 0;
	if($address) {

		$WS_URL = $site_info['zipcode_url'];

		$GET_URL = "http://".$WS_URL."/address/addr.aspx?sd=" . urlencode("");
		$GET_URL .= "&sg=" . urlencode("");
		$GET_URL .= "&r=x";
		$GET_URL .= "&enc=".$site_info['zipcode_enc'];
		$GET_URL .= "&k=" . urlencode($address);
		$GET_URL .= "&dr=".$site_info['zipcode_dr'];
		$GET_URL .= "&jb=".$site_info['zipcode_jb'];
		$GET_URL .= "&de=".$site_info['zipcode_de'];
		$GET_URL .= "&bn=".$site_info['zipcode_bn'];
		$GET_URL .= "&sp=".$site_info['zipcode_sp'];
		$GET_URL .= "&key=".$site_info['zipcode_key'];
		$GET_URL .= "&ts=" . time();

		$parser = xml2array($GET_URL);

		$doc_el = $parser['Didim365-Address'];

		$Result = $doc_el['Result'];
		$Message = $doc_el['Message'];

		if ($Result == "True")
		{
			$Cnt = $doc_el['Count'];
			if($Cnt == 1) {
				$doc_el['Data']['Item'][0] = $doc_el['Data']['Item'];
			}
			foreach($doc_el['Data']['Item'] as $item)
			{
				//  <항상 포함>
				// zipno : 우편번호
				//  <옵션에 따라 포함>
				// doro : 도로명 주소
				// doroen : 도로면 영문 주소
				// jibun : 지번주소

				$ZipNo	= $item['ZipNo'];
				$Doro	= str_conv($item['Doro'], $site_info['zipcode_enc']);
				$Jibun	= str_conv($item['JiBun'], $site_info['zipcode_enc']);

				if(is_array($item)) {
					$list[$search_count][zip1]	= substr($ZipNo,0,3);
					$list[$search_count][zip2]	= substr($ZipNo,3,3);
					$list[$search_count][set_addr]	= $Doro;
					$list[$search_count][addr]	= $Doro.($Jibun ? '<br/>'.$Jibun : '');
					$list[$search_count][bunji]	= "";
					$list[$search_count][jibun]	= $Jibun;

					$list[$search_count][encode_addr] = urlencode($list[$search_count][addr]);
					$search_count++;
				}
			}
		}

		return $list;

	}
}
?>
