<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<?
// SMS발송
if($mode == "sendsms"){

	if($se_num == "") error("보내는이가 없습니다.");
	if($seluser == "") error("받는이가 없습니다.");
	if($message == "") error("보낼 내용이 없습니다.");
	
	$user_list = explode(",",$seluser);
	
	for($ii=0; $ii < count($user_list); $ii++){
	
		$re_num = $user_list[$ii];
		send_sms($se_num, $re_num, $message);
	
	}

	echo "<script>alert('SMS 발송을 완료하였습니다.');self.close();</script>";
	exit;

}
?>
<html>
<head>
<title>:: SMS발송 ::</title>
<link href="../wiz_style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
<!--
// 주문상세내역 보기
function inputCheck(frm){
	
	if(frm.se_num.value == ""){
		alert("받는이 휴대폰번호를 입력하세요");
		frm.se_num.focus();
		return false;
	}

	if(frm.message.value == ""){
		alert("내용을 입력하세요");
		frm.message.focus();
		return false;
	}
}

function calByte(aquery){
	
	var tmpStr;
	var temp = 0;
	var onechar;
	var tcount = 0;;

	tmpStr = new String(aquery);
	temp = tmpStr.length;
	for(k=0; k<temp; k++) {
		onechar = tmpStr.charAt(k);
		if(escape(onechar).length > 4) {
			tcount += 2;
		} else if(onechar != '\n' || onechar != '\r') {
			tcount++;
		}
		
		frm.sms_byte.value = tcount+"/80 bytes";
		
		if(tcount > 80) {
			alert("메시지내용은 80 바이트 이상 전송할 수 없습니다.");
			
			cutText(frm.message.value);
			
			return;
		}
	}
	if ( temp == 0 ) { 
		
		frm.sms_byte.value = "0/80 bytes";
		
	}
}

function cutText(aquery) {
	
	var tmpStr;
	var temp=0;
	var onechar;
	var tcount = 0;

	tmpStr = new String(aquery);
	temp = tmpStr.length;
	for(t=0; t<temp; t++){
		onechar = tmpStr.charAt(t);
		if(escape(onechar).length > 4) {
			tcount += 2;
		} else if(onechar != '\n' || onechar != '\r') {
			tcount++;
		}
		if(tcount > 80) {
			tmpStr = tmpStr.substring(0, t);
			break;
		}
	}
	
	document.frm.message.value = tmpStr;
	
	calByte(tmpStr);        
}

function checkSmsmsg(){
	
	var tmpStr = document.frm.message.value;
	
	calByte(tmpStr);

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
    <td class="tit_sub"><img src="../image/ics_tit.gif"> SMS발송</td>
  </tr>
</table>
<form name="frm" action="<?=$PHP_SELF?>" method="post" onSubmit="return inputCheck(this);">
<input type="hidden" name="mode" value="sendsms">
<input type="hidden" name="se_name" value="<?=$site_info[site_name]?>">
<table width="100%" border="0" cellpadding=2 cellspacing=1 class="t_style">
  <tr>
    <td height="30" width="30%" align=center class="t_name">보내는이</td>
    <td class="t_value"><input type="text" name="se_num" value="<?=$site_info[site_hand]?>" size="30" class="input"></td>
  </tr>
  <tr>
    <td height="30" align=center class="t_name">받는이</td>
    <td class="t_value">
      <textarea name="seluser" rows="2" cols="20" class="textarea" style="width:100%"><?=$seluser?></textarea>
      <table><tr><td>형식) 011-123-4567,016-123-4567</td></tr></table>
    </td>
  </tr>
  <tr>
    <td height="30" align=center class="t_name">내용</td>
    <td align="center" class="t_value">
    <textarea name="message" rows="10" cols="36" class="textarea" style="width:100%" onKeyDown="checkSmsmsg();"></textarea>
    </td>
  </tr>
</table>
<table width="100%" border="0" cellpadding=2 cellspacing=1>
<tr><td align="right"><input type="text" name="sms_byte" size="11" style="height:14px; border: 1px solid #91FBFF; ; font-size:8pt; font-family:돋움; background-color:#91FBFF" value="0/80 bytes" onfocus="this.blur()"></td></tr>
</table>

<br>
<table width="100%" border="0" cellpadding=0 cellspacing=0>
  <tr>
    <td align="center" colspan="2">
      <input type="image" src="../image/btn_send_l.gif"> &nbsp; 
      <img src="../image/btn_close_l.gif" style="cursor:hand" onClick="self.close();">
    </td>
  </tr>
</table>
</form>

</td>
</tr>
</table>
</body>
</html>
