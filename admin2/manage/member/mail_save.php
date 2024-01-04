<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<?


// 메일추가
if($mode == "insert"){
	
	if(!get_magic_quotes_gpc()) $content= addslashes($content);
	$content = str_replace("http://".$HTTP_HOST, "{SITE_URL}", $content);
	
	$sql = "insert into wiz_mailsms(code,type,subject,sms_send,sms_msg,email_subj,email_send,email_msg) 
							values('$code','ADD','$subject','$sms_send','$sms_msg','$email_subj','$email_send','$content')";
	$result = mysql_query($sql) or error(mysql_error());
	
	complete("추가 하였습니다.","mail_list.php");						



// 메일수정		
}else if($mode == "update"){

	if(empty($sms_cust)) $sms_cust = "N";
	if(empty($sms_oper)) $sms_oper = "N";
	if(empty($email_cust)) $email_cust = "N";
	if(empty($email_oper)) $email_oper = "N";
	
	if(!get_magic_quotes_gpc()) $content= addslashes($content);
	$content = str_replace("http://".$HTTP_HOST, "{SITE_URL}", $content);
	
	$sql = "update wiz_mailsms set subject = '$subject', sms_send = '$sms_send', sms_msg = '$sms_msg', 
	                     email_send = '$email_send', email_subj = '$email_subj', email_msg  = '$content' where code = '$code'";

	mysql_query($sql) or error(mysql_error());
	
	complete("설정사항을 적용하였습니다.","mail_input.php?mode=update&code=$code");
	
	
// 삭제
}else if($mode == "delete"){

	$sql = "delete from wiz_mailsms where code = '$code'";
	mysql_query($sql) or error(mysql_error());
	
	complete("삭제 하였습니다.","mail_list.php");


// 메일발송
}else if($mode == "mailsend"){

	global $DOCUMENT_ROOT;

	// 관리자 정보 가져오기
  $se_name = $site_info[site_name];
  $se_email = $site_info[site_email];
  $re_name = $site_info[site_name];
  $re_email = $site_info[site_email];

	$no = 0;
	
	if($sdate != "") $sdate_sql = " and wdate > '$sdate' ";
	if($edate != "") $edate_sql = " and wdate <= '$edate 23:59:59' ";
	if($searchkey != "") $search_sql = " and $searchopt like '%$searchkey%' ";
	if($level != "") $level_sql = " and level = '$level' ";
	if($reemail == "N") $reemail_sql = " and reemail != 'N' ";
	
	$snum--; $enum--;
  $amount = $enum - $snum + 1;
	$sql = "select id,passwd,name,hphone,email,visit,reemail,wdate from wiz_member where id != '' $sdate_sql $edate_sql $search_sql $level_sql $reemail_sql order by wdate desc limit $snum, $amount";
	//echo $sql;
	//exit;

  $result = mysql_query($sql) or error(mysql_error());
	$tmp_subject = $subject;
	$tmp_content = $content;
   
	while($row = mysql_fetch_array($result)){
		
		$subject = info_replace($site_info, $row, $tmp_subject);
		$content = info_replace($site_info, $row, $tmp_content);
		$content = stripslashes($content);		// 자동역슬래쉬 제거(역슬래쉬있으면 이미지 깨짐)
		send_mail($se_name, $se_email, $row[name], $row[email], $subject, $content);		
		echo "<font size=2><b>$row[name] : </b> $row[email]</font> <br>";
			
		$no++;
		
	}

	echo "<br><font color='red' size=2><b>발송을 완료하였습니다.</b></font>";
	echo "<a href=javascript:window.close()><font size=2 color=black><b>[ 닫기 ]</b></font></a>";

}

?>
