<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<?
$page_name = "사이트 관리정보";
$page_desc = "SMS충전 합니다.";
$navi_name = " 기본설정 > SMS충전";
?>
<? include "../head.php"; ?>


<script language="javascript">
<!--
function inputCheck(frm){

	//if(frm.sms_id.value == ""){
	//	alert("sms아이디를 입력하세요.");
	//	frm.sms_id.focus();
	//	return false;
	//}
	
}

function popJoin(stype) {
	
	if(stype == "J"){
		document.smsjoin.action = "http://www.icodekorea.com/res/join_company_fix.php";
		window.open("", "popJoin", "height=700, width=617, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, left=50, top=50");
	}else{
		window.open("", "popJoin", "height=600, width=617, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, left=50, top=50");
	}
	
	document.smsjoin.submit();

}

function popFill() {

<? if(!empty($site_info[sms_id]) && !empty($site_info[sms_pw])) { ?>
   window.open("", "popFill", "height=500, width=667, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, left=50, top=50");
   document.smsfill.submit();
<? } else { ?>
	alert("sms아이디와 비밀번호를 입력하세요.");
<? } ?>

}

function popLog() {

<? if(!empty($site_info[sms_id]) && !empty($site_info[sms_pw])) { ?>
   window.open("", "popLog", "height=550, width=750, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, left=50, top=50");
   document.smslog.submit();
<? } else { ?>
	alert("sms아이디와 비밀번호를 입력하세요.");
<? } ?>

}

-->
</script>
</head>

			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">SMS관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">SMS를 충전합니다.</td>
        </tr>
      </table>
      
      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <form name="frm" action="sms_save.php" method="post" onSubmit="return inputCheck(this);">
      <input type="hidden" name="tmp">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="3" class="t_style">
            	<tr>
                <td width="17%" align="left" class="t_name">sms종류</td>
                <td colspan="3" class="t_value">
                	<table width="100%">
                		<tr>
                			<td>
                				<input name="sms_type" type="radio" value="C" <? if($site_info[sms_type] == "" || $site_info[sms_type] == "C") echo "checked"; ?>><b>충전제</b> (건당 25원, 10만원 충전시 4000건 발송)
                			</td>
                			<td>
                				<img src="../image/btn_sms_apply.gif" style="cursor:hand" onClick="popJoin('C')">
                				<img src="../image/btn_sms_fill.gif" style="cursor:hand" onClick="popFill()">
                			</td>
                			<td rowspan="2" align="right">
                				<img src="../image/btn_sms_search.gif" style="cursor:hand" onClick="popLog()">
                			</td>
                		</tr>
                		<tr>
                			<td>
                				<input name="sms_type" type="radio" value="J" <? if($site_info[sms_type] == "J") echo "checked"; ?>><b>정액제</b> (건당 20원, 월50,000원으로 2500건)
                			</td>
                			<td>
                				<img src="../image/btn_sms_apply2.gif" style="cursor:hand" onClick="popJoin('J')">
                			</td>
                		</tr>
                	</table>
                </td>
              </tr>
              <tr>
                <td width="150" align="left" class="t_name" width="120" height="25">sms아이디</td>
                <td class="t_value">
                	Any_<input name="sms_id" value="<?=str_replace("Any_","",$site_info[sms_id])?>" type="text" style="width:163" class="input">&nbsp;
                </td>
              </tr>
              <tr>
                <td align="left" class="t_name" width="120" height="25">sms비밀번호</td>
                <td class="t_value"><input name="sms_pw" value="<?=$site_info[sms_pw]?>" type="password" size="30" class="input"></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <br>
      <table width="100%" border="0">
      	<tr><td align="center"><input type="image" src="../image/btn_confirm_l.gif"></td></tr>
      </form>
      </table>

      <br>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="9d9d9d">
        <tr>
          <td width="5" height="5"><img src="../image/check_left_top.gif"></td>
          <td width="100%"></td>
          <td width="5" height="5"><img src="../image/check_right_top.gif"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="6">
            <tr>
              <td colspan="2"><img src="../image/check_tit.gif" width="75" height="19" /></td>
            </tr>
            <tr>
            	<td class="chk_alt" valign="top">
              <font color=#000000><b>주의사항</b></font><br>
              - sms 아이디,비밀번호를 입력후 저장해야 충전이 가능합니다.<br>
              - 발송결과조회을 클릭하시면 발송한 sms에 대한 내용을 확인할 수 있습니다.<br>
              - 발송이 되지 않는 경우 방화벽에서 IP(211.172.232.124)와 Port(7192~7195)를 확인해보세요.<br>
              - 시스템상에서 잔액이 없을 시 자동으로 서비스가 종료됩니다.<br>
              - 회신번호는 "기본정보>관리자 휴대폰" 번호이므로 사용하고 계신 번호로 변경하시기 바랍니다.<br>
              - SMS서비스는 <a href="http://icodekorea.com" target="_blank">아이코드(http://icodekorea.com)</a>와 제휴하여 제공됩니다.<br>
  					  - 비용/계산서관련 문의는 아이코드 연락하시기 바랍니다.
              </td>
              <td class="chk_alt" valign="top">
              <font color=#000000><b>사용법</b></font><br>
              1. 신청하기 버튼을 눌러 신청서를 작성, SMS를 충전 합니다.<br>
              2. 신청한 ID와 암호를 sms아이디, sms비밀번호에 입력한 후 저장합니다.<br>
              3. 1번,2번을 다 마치시면 SMS 발송이 가능합니다.<br><br><br>
            	</td>
            </tr>
          </table></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="5" height="5"><img src="../image/check_left_bottom.gif" width="5" height="5" /></td>
          <td></td>
          <td width="5" height="5"><img src="../image/check_right_bottom.gif" width="5" height="5" /></td>
        </tr>
      </table>

      <br>      
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
         <td align="center">
         	<iframe src="http://www.icodekorea.com/res/userinfo.php?userid=<?=$site_info[sms_id]?>&userpw=<?=$site_info[sms_pw]?>&r_url=http://<?=$_SERVER[HTTP_HOST]?>/admin2/manage/basic/sms_info.php" frameborder="0" width="100%" height="400"></iframe>
       </tr>
      </table>

			<!-- sms신청하기 -->
      <form name="smsjoin" method="post" target="popJoin" action="http://icodekorea.com/res/join_company_fix_a.php">
			<input type="hidden" name="sellid" value="anywiz">	
			</form>

			<!-- sms충전하기 -->
			<form name="smsfill" method="post" target="popFill" action="http://icodekorea.com/company/credit_card_input.php">
			<input type="hidden" name="icode_id" value="<?=$site_info[sms_id]?>">
			<input type="hidden" name="icode_passwd" value="<?=$site_info[sms_pw]?>">
			</form>

			<!-- sms발송내역 -->
			<form name="smslog" method="post" target="popLog" action="http://www.icodekorea.com/icodemsg/web/sms_sendmail_box.php">
			<input type="hidden" name="icode_id" value="<?=$site_info[sms_id]?>">
			<input type="hidden" name="icode_passwd" value="<?=$site_info[sms_pw]?>">	
			</form>
			
<? include "../foot.php"; ?>
