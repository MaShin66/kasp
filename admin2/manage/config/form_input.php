<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<?
if($mode == "" || $mode == "insert"){

	$sql = "delete from wiz_forminfo where code = ''";
	mysql_query($sql);

	$sql = "insert into wiz_forminfo(idx,code,title,skin,rece_sms,rece_email,rece_bbs) values('','$code','$title','','Y','Y','Y' )";
	mysql_query($sql);

	$sql = "select max(idx) as idx from wiz_forminfo";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$idx = $row[idx];
	$mode = "update";
}

if($mode == "update"){
	$sql = "select * from wiz_forminfo where idx = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	$form_info = mysql_fetch_array($result);

	if(empty($form_info[code])) $fmode = "insert";
	else $fmode = "update";
}
?>
<? include "../head.php"; ?>

<script language="JavaScript" type="text/javascript">
<!--
function inputCheck(frm){

   if(frm.code.value == ""){
      alert('폼메일 코드를 입력하세요.');
      frm.code.focus();
      return false;
   } else if(!check_Char(frm.code.value)) {
 		alert('코드는 특수문자를 사용할 수 없습니다.');
		frm.code.focus();
 		return false;
   }

   if(frm.title.value == ""){
      alert('폼메일명을 입력하세요.');
      frm.title.focus();
      return false;
   }

}

function deleteForm(idx){
   if(confirm('선택한 폼을 삭제하시겠습니까?')){
      document.location = 'form_save.php?mode=form&sub_mode=delete&code=<?=$code?>&idx=' + idx;
   }
}

function resizeFrame(iframeObj){
	var innerBody = iframeObj.contentWindow.document.body;
	oldEvent = innerBody.onclick;
	innerBody.onclick = function(){ resizeFrame(iframeObj, 1);oldEvent; };

	var innerHeight = innerBody.scrollHeight + (innerBody.offsetHeight - innerBody.clientHeight);
	iframeObj.style.height = innerHeight;

	if( !arguments[1] )        /* 특정 이벤트로 인한 호출시 스크롤을 그냥 둔다. */
	this.scrollTo(1,1);
}
//-->
</script>

			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">폼메일</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">폼메일을 생성/항목을 추가/수정/삭제 관리합니다.</td>
        </tr>
      </table>

			<br>
		<form name="frm" action="form_save.php" method="post" onSubmit="return inputCheck(this);">
      <input type="hidden" name="mode" value="update">
      <input type="hidden" name="idx" value="<?=$idx?>">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td width="15%" class="t_name">폼메일코드(영문) <font color=red>*</font></td>
                <td width="35%" class="t_value">
                  <input name="code" type="text" value="<?=$form_info[code]?>" class="input">
                </td>
                <td width="15%" class="t_name">폼메일명 <font color=red>*</font></td>
                <td width="35%" class="t_value">
                  <input name="title" type="text" value="<?=$form_info[title]?>" class="input">
                </td>
              </tr>
              <tr>
              	<td class="t_name">스킨</td>
                <td class="t_value">
                <select name="skin">
                <?
                $dh = opendir("../../form/skin");
                while(($file = readdir($dh)) !== false){
                	if($file != "." && $file != ".."){
                		$file_list[] = $file;
                	}
                }
                sort ($file_list); reset ($file_list);
                for($ii=0;$ii<count($file_list);$ii++){
                ?>
                <option value="<?=$file_list[$ii]?>"><?=$file_list[$ii]?></option>
                <?
                }
                ?>
                </select>
                <script language="javascript">
                <!--
                skin = document.frm.skin;
                for(ii=0; ii<skin.length; ii++){
                   if(skin.options[ii].value == "<?=$form_info[skin]?>")
                      skin.options[ii].selected = true;
                }
                -->
                </script>
                </td>
                <td class="t_name">스팸글체크</td>
                <td class="t_value">항목추가 시 항목속성을 "스팸글체크"를 선택하면<br>사용할 수 있습니다. </td>
              </tr>
              <tr>
              	<td class="t_name">발신설정</td>
                <td colspan="3" class="t_value">
                	<?=$site_info[site_name]?>&lt;<?=$site_info[site_email]?>>
                	<span class="tit_alt" style="color:#FF0000">기본설정 > 사이트정보 > "사이트명"과  "관리자 이메일"에 입력된 값으로 발송됩니다.</span>
                </td>
              </tr>
              <tr>
              	<td class="t_name">약관설정</td>
                <td colspan="3" class="t_value">

                	<table width="100%" border="0" cellspacing="2" cellpadding="1">
                		<tr>
                			<td><input name="agree_use" type="checkbox" value="Y" <? if($form_info[agree_use] == "Y") echo "checked"; ?>> 사용함</td>
                		</tr>
                		<tr>
                			<td>
                				<textarea name="agree_text" rows="10" cols="100" class="textarea"><?=$form_info[agree_text]?></textarea>
                			</td>
                		</tr>
                	</table>

                </td>
              </tr>
              <tr>
              	<td class="t_name">수신설정</td>
                <td colspan="3" class="t_value">

                	<table width="100%" border="0" cellspacing="2" cellpadding="1">
                		<tr>
                			<td width="100"><input name="rece_bbs" type="checkbox" value="Y" <? if($form_info[rece_bbs] == "Y") echo "checked"; ?> onClick="this.checked=true;">게시판 수신</td>
                			<td><font color=red>게시판 수신은 필수입니다.</font></td>
                		</tr>
                		<tr>
                			<td><input name="rece_email" type="checkbox" value="Y" <? if($form_info[rece_email] == "Y") echo "checked"; ?>>email 수신</td>
                			<td>
                				<input type="text" name="email_list" value="<?=$form_info[email_list]?>" size="40" style="width:90%" class="input">
                			</td>
                		</tr>

                		<? if($site_info[sms_use] == "Y"){ ?>
                    <tr>
                			<td><input name="rece_sms" type="checkbox" value="Y" <? if($form_info[rece_sms] == "Y") echo "checked"; ?>>SMS 수신</td>
                			<td>
                				<input type="text" name="sms_list" value="<?=$form_info[sms_list]?>" size="40" style="width:90%" class="input">
                			</td>
                		</tr>
                    <? } ?>
                  </table>

                </td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="6">
              <tr>
                <td>
                	<font color=red>
                	- 이메일, sms수신은 여러명이 동시에 수신할 수 있습니다. 수신할 이메일 sms를 콤마(,)로 구분하여 입력합니다.<br>
                	</font>
                	예) test@test.com,aaa@aaa.com  / 011-1234-5678,010-321-6547
                	</font>
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
          	<img src="../image/btn_list_l.gif" style="cursor:hand" onClick="document.location='form_config.php';">
          </td>
        </tr>
      </table>
	  </form>

      <br><br>

      <iframe src="form_field.php?fidx=<?=$idx?>&code=<?=$form_info[code]?>&fmode=<?=$fmode?>" width="100%" height="80" frameborder="0" marginwidth="0" onload="resizeFrame(this)"></iframe>


<? include "../foot.php"; ?>
