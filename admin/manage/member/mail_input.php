<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<?
if($mode == "update"){
	$sql = "select * from wiz_mailsms where code = '$code'";
	$result = mysql_query($sql) or error(mysql_error());
	$mailsms_info = mysql_fetch_object($result);
	$mailsms_info->email_msg = stripslashes($mailsms_info->email_msg);
}

?>
<? include "../head.php"; ?>

<script language="javascript">
<!--
function inputCheck(frm){

	if(frm.code.value == ""){
		alert("코드명을 입력하세요");
		frm.code.focus();
		return false;
	} else if(!check_Char(frm.code.value)) {
   		alert('코드명은 특수문자를 사용할 수 없습니다.');
      frm.code.focus();
   		return false;
	}
	if(frm.subject.value == ""){
		alert("분류명을 입력하세요");
		frm.subject.focus();
		return false;
	}
	content.outputBodyHTML();
}

function calByte(type, aquery){

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

		if(type == "cust") frm.sms_custbyte.value = tcount+"/80 bytes";
		else  frm.sms_operbyte.value = tcount+"/80 bytes";

		if(tcount > 80) {
			alert("메시지내용은 80 바이트 이상 전송할 수 없습니다.");

			if(type == "cust") cutText(type, frm.sms_msg.value);
			else cutText(type, frm.sms_opermsg.value);


			return;
		}
	}
	if ( temp == 0 ) {

		if(type == "cust") frm.sms_custbyte.value = "0/80 bytes";
		else  frm.sms_operbyte.value = "0/80 bytes";

	}
}

function cutText(type, aquery) {

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

	if(type == "cust") document.frm.sms_msg.value = tmpStr;
	else  document.frm.sms_opermsg.value = tmpStr;

	calByte(type, tmpStr);
}

function checkSmsmsg(type){

	var tmpStr;
	if(type == "cust" && document.frm.sms_msg != null){
		tmpStr = document.frm.sms_msg.value;
		calByte(type, tmpStr);
	}
}

-->
</script>
</head>

			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">메세지설정</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">상황별 메일/SMS발송 내용을 관리합니다.</td>
        </tr>
      </table>

      <br>
	   <form name="frm" action="mail_save.php" onSubmit="return inputCheck(this)" method="post">
      <input type="hidden" name="tmp">
      <input type="hidden" name="mode" value="<?=$mode?>">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="t_style">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr>
                <td width="15%" class="t_name">코드 <font color=red>*</font></td>
                <td width="85%" class="t_value">
                <input type="text" name="code" value="<?=$mailsms_info->code?>" size="20" class="input" <? if($mode == "update") echo "readonly"; ?>>
                </td>
              </tr>
              <tr>
                <td class="t_name">분류명 <font color=red>*</font></td>
                <td class="t_value">
                <input type="text" name="subject" value="<?=$mailsms_info->subject?>" size="60" class="input">
                </td>
              </tr>

              <? if( strpos($code,"mem")!==false && $site_info[sms_use] == "Y"){ ?>
              <tr>
                <td class="t_name">SMS발송</td>
                <td class="t_value">
                  <input type="radio" name="sms_send" value="Y" <? if($mailsms_info->sms_send == 'Y') echo "checked"; ?>>발송함 &nbsp;
                  <input type="radio" name="sms_send" value="N" <? if($mailsms_info->sms_send == 'N') echo "checked"; ?>>발송하지않음<br>
                  <textarea cols="35" rows="5" name="sms_msg" onKeyDown="checkSmsmsg('cust');" class="textarea"><?=$mailsms_info->sms_msg?></textarea>
                  <input type="text" name="sms_custbyte" size="11" style="height:14px; border: 1px solid #91FBFF; ; font-size:8pt; font-family:돋움; background-color:#91FBFF" value="0/80 bytes" onfocus="this.blur()">
                </td>
              </tr>
            	<? } ?>

              <? if($mailsms_info->type == "MEM"){ ?>
              <tr>
                <td class="t_name">메일발송</td>
                <td class="t_value">
                <input type="radio" name="email_send" value="Y" <? if($mailsms_info->email_send == "Y" || $mailsms_info->email_send == "") echo "checked"; ?>>발송함 &nbsp;
                <input type="radio" name="email_send" value="N" <? if($mailsms_info->email_send == "N") echo "checked"; ?>>발송하지않음
                </td>
              </tr>
              <tr>
                <td class="t_name">메일제목</td>
                <td class="t_value">
                <input type="text" name="email_subj" value="<?=$mailsms_info->email_subj?>" size="80" class="input">
                </td>
              </tr>
              <? } ?>

              <tr>
                <td colspan="3" class="t_value">
                <?
                $edit_content = $mailsms_info->email_msg;
                $edit_content = str_replace("{SITE_URL}", "http://".$HTTP_HOST, $edit_content);
                include "../../webedit/WIZEditor.html";
                ?>

                 <table width="98%" border="0" cellpadding="5" cellspacing="3" align="center" class="e_style">
                    <tr>
                      <td bgcolor="#FFFFFF">
                      <table>
                      <tr>
                      <td><b>{DATE}</b> 오늘날짜 &nbsp;</td>
                      <td><b>{MEM_ID}</b> 회원아이디 &nbsp;</td>
                      <td><b>{MEM_PW}</b> 회원비밀번호 &nbsp;</td>
                      </tr>
                      <tr>
                      <td><b>{MEM_NAME}</b> 회원이름</td>
                      <td><b>{SITE_NAME}</b> 사이트명 &nbsp;</td>
                      <td><b>{SITE_EMAIL}</b> 사이트 이메일</td>
                      </tr>
                      <tr>
                      <td><b>{SITE_TEL}</b> 사이트 전화번호 &nbsp;</td>
                      <td><b>{SITE_URL}</b> 사이트 주소로 변경되어 발송됩니다.</td>
                      <td></td>
                      </tr>
                      </table>
                    </tr>
                  </table>

                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>

      <br>
      <table align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
          	<input type="image" src="../image/btn_confirm_l.gif"> &nbsp;
          	<img src="../image/btn_list_l.gif" style="cursor:hand" onclick="document.location='mail_list.php';">
          </td>
        </tr>
      </table>
	  </form>

<? include "../foot.php"; ?>
