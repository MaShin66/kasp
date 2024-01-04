<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<?

// 메일발송
if($mode == "sendmail"){

   $user_list = explode(",",$seluser);
   $user_info_list = explode(",",$seluser_info);

   $tmp_subject = $subject;
   $tmp_content = $content;

   for($ii=0; $ii < count($user_list); $ii++){

   		$re_info = "";

      list($re_name, $re_email) = explode(":", $user_list[$ii]);
      list($re_id, $re_passwd) = explode(":", $user_info_list[$ii]);

      $re_info[id] = $re_id;
      $re_info[passwd] = $re_passwd;
      $re_info[name] = $re_name;


			$subject = info_replace($site_info, $re_info, $tmp_subject);
			$content = info_replace($site_info, $re_info, $tmp_content);
			$content = stripslashes($content);	// 자동역슬래쉬 제거(역슬래쉬있으면 이미지 깨짐)

      if($re_name != "") send_mail($se_name, $se_email, $re_name, $re_email, $subject, $content);

   }

	echo "<script>alert('이메일 발송을 완료하였습니다.');self.close();</script>";
	exit;

}


// 메일스킨
$sql = "select * from wiz_mailsms where code = 'basic'";
$result = mysql_query($sql) or error(mysql_error());
$row = mysql_fetch_object($result);

?>
<html>
<head>
<title>:: 메일발송 ::</title>
<link href="../wiz_style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
<!--
// 주문상세내역 보기
function inputCheck(frm){

	if(frm.seluser.value == ""){
		alert("받는이가 없습니다");
		frm.seluser.focus();
		return false;
	}

	if(frm.subject.value == ""){
		alert("제목을 입력하세요");
		frm.subject.focus();
		return false;
	}

	try{ content.outputBodyHTML(); } catch(e){ }
	if(frm.content.value == ""){
		alert("내용을 입력하세요");
		return false;
	}
}
//-->
</script>
</head>
<body>
<table width="100%" border="0" cellpadding=10 cellspacing=0>
<tr>
<td>

<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td class="tit_sub"><img src="../image/ics_tit.gif"> 메일발송</td>
  </tr>
</table>
<table width="100%" border="0" cellpadding=2 cellspacing=1 class="t_style">
<form name="frm" action="<?=$PHP_SELF?>" method="post" onSubmit="return inputCheck(this);">
<input type="hidden" name="mode" value="sendmail">
<input type="hidden" name="se_name" value="<?=$site_info[site_name]?>">
<input type="hidden" name="se_email" value="<?=$site_info[site_email]?>">
<input type="hidden" name="seluser_info" value="<?=$seluser_info?>">
  <tr>
    <td height="30" width="20%" align=center class="t_name">보내는이</td>
    <td class="t_value"><?=$site_info[site_name]?>(<?=$site_info[site_email]?>)</td>
  </tr>
  <tr>
    <td height="30" align=center class="t_name">받는이</td>
    <td class="t_value">
      <textarea rows="3" cols="50" name="seluser" class="textarea" style="width:90%"><?=$seluser?></textarea>
      <table><tr><td>형식) 홍길동:test@test.com,</td></tr></table>
    </td>
  </tr>
  <tr>
    <td height="30" align=center class="t_name">제목</td>
    <td class="t_value"><input type="text" name="subject" size="55" class="input" style="width:90%"></td>
  </tr>
  <tr>
    <td colspan="2" class="t_value">
    <?
    $edit_content = $row->email_msg;
    $edit_content = info_replace($site_info, $re_info, $edit_content);
    include "../../webedit/WIZEditor.html";
    ?>
     <table width="98%" border="0" cellpadding="5" cellspacing="3" align="center" class="e_style">
        <tr>
          <td bgcolor="#FFFFFF">
          <table>
          <tr>
          <td><b>{DATE}</b> 오늘날짜 &nbsp;</td>
          <td><b>{MEM_ID}</b> 회원아이디 &nbsp;</td>
          <!--td><b>{MEM_PW}</b> 회원비밀번호 &nbsp;</td-->
          <td><b>{MEM_NAME}</b> 회원이름</td>
          </tr>
          <tr>
          <td><b>{SITE_NAME}</b> 사이트명 &nbsp;</td>
          <td><b>{SITE_EMAIL}</b> 사이트 이메일</td>
          </tr>
          <tr>
          <td><b>{SITE_TEL}</b> 사이트 전화번호 &nbsp;</td>
          <td colspan=2><b>{SITE_URL}</b> 사이트 주소로 변경되어 발송됩니다.</td>
          </tr>
          </table>
        </tr>
      </table>
    </td>
  </tr>
</table>

<br>
<table width="100%" border="0" cellpadding=0 cellspacing=0>
  <tr>
    <td align="center" colspan="2">
      <input type="image" src="../image/btn_send_l.gif"> &nbsp;
      <img src="../image/btn_close_l.gif" style="cursor:hand" onClick="self.close();">
    </td>
  </tr>
</form>
</table>

</td>
</tr>
</table>
</body>
</html>
