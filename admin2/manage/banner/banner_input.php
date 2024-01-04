<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include "../head.php"; ?>

<?
  if($mode == "")
    $mode = "ban_insert";
?>

<script language="JavaScript">
<!--
function inputCheck(frm){
	if(frm.code.value == ""){
		alert("코드를 입력하세요.");
		frm.code.focus();
		return false;
	} else if(!check_Char(frm.code.value)) {
 		alert('코드는 특수문자를 사용할 수 없습니다.');
		frm.code.focus();
 		return false;
   }
	if(frm.title.value == ""){
		alert("그룹이름을 입력하세요.");
		frm.code.focus();
		return false;
	}
	
	if(frm.padding.value != "" && !check_Num(frm.padding.value)) {
		alert("배너간격은 숫자만 입력하세요.");
		frm.padding.focus();
		return false;
	}
}
//-->
</script>

<?
if($mode == "ban_update" || $mode == "ban_insert") {
	if($mode == "ban_update"){
	  $sql = "select * from wiz_bannerinfo where idx='$idx'";
	  $result = mysql_query($sql) or error(mysql_error());
	  $ban_info = mysql_fetch_object($result);
	}
?>

			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">배너그룹관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">배너그룹을 추가/수정/삭제 관리합니다.</td>
        </tr>
      </table>
      
      <br>
	  <form name="frm" action="banner_save.php" method="post" onSubmit="return inputCheck(this)" enctype="multipart/form-data">
      <input type="hidden" name="tmp">
      <input type="hidden" name="mode" value="<?=$mode?>">
      <input type="hidden" name="page" value="<?=$page?>">
      <input type="hidden" name="idx" value="<?=$idx?>">
      <table width="100%" border="0" cellspacing="1" cellpadding="2" class="t_style">
        <tr>
          <td width="15%" class="t_name">코드(영문) <font color="red">*</font></td>
          <td width="35%" class="t_value"><input type="text" name="code" value="<?=$ban_info->code?>" size="30" class="input" <? if(!strcmp($mode, 'ban_update')) echo "readonly" ?>></td>
          <td width="15%" class="t_name">그룹이름 <font color="red">*</font></td>
          <td width="35%" class="t_value"><input type="text" name="title" value="<?=$ban_info->title?>" size="30" class="input" ></td>
        </tr>
        <tr>
          <td class="t_name">배너형태</td>
          <td class="t_value">&nbsp;
            <input type="radio" name="types" value="H" size="80" <? if($ban_info->types == "H" || $ban_info->types == "") echo "checked"; ?>> 세로형 &nbsp;
            <input type="radio" name="types" value="W" size="80" <? if($ban_info->types == "W") echo "checked"; ?>> 가로형 &nbsp;
          </td>
          <td class="t_name">배너간격</td>
          <td class="t_value"><input type="text" name="padding" value="<?=$ban_info->padding?>" size="30" class="input">
          </td>
        </tr>
        <tr>
          <td class="t_name">사용여부</td>
          <td class="t_value">&nbsp;
            <input type="radio" name="isuse" value="Y" size="80" <? if($ban_info->isuse == "Y" || $ban_info->isuse == "") echo "checked"; ?>> 사용함 &nbsp;
            <input type="radio" name="isuse" value="N" size="80" <? if($ban_info->isuse == "N") echo "checked"; ?>> 사용안함
          </td>
          <td class="t_name">배너개수</td>
          <td class="t_value">&nbsp;
          <select name="types_num">
          <option value="1" <? if($ban_info->types_num == "1") echo "selected"; ?>>1
          <option value="2" <? if($ban_info->types_num == "2") echo "selected"; ?>>2
          <option value="3" <? if($ban_info->types_num == "3") echo "selected"; ?>>3
          <option value="4" <? if($ban_info->types_num == "4") echo "selected"; ?>>4
          <option value="5" <? if($ban_info->types_num == "5") echo "selected"; ?>>5
          <option value="6" <? if($ban_info->types_num == "6") echo "selected"; ?>>6
          <option value="7" <? if($ban_info->types_num == "7") echo "selected"; ?>>7
          <option value="8" <? if($ban_info->types_num == "8") echo "selected"; ?>>8
          <option value="9" <? if($ban_info->types_num == "9") echo "selected"; ?>>9
          </select>
          </td>
        </tr>
      </table>
      
      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr>
      		<td align="center">
      			<input type="image" src="../image/btn_confirm_l.gif"> &nbsp; 
      			<img src="../image/btn_list_l.gif" style="cursor:hand" onClick="document.location='banner_list.php?page=<?=$page?>';">
      		</td>
        </tr>
      </table>
	  </form>

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
              <td><img src="../image/check_tit.gif" width="75" height="19" /></td>
            </tr>
            <tr>
              <td class="chk_alt">
              - 코드(영문)는 반드시 영문으로 작성하고 변경이 불가합니다.<br>
              - 배너간격은 배너와 배너 사이의 간격을 조절합니다.<br>
              - 배너형태가 가로형인 경우 배너개수만큼 가로로 배너가 나오고 줄바꿈이 됩니다.
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
      

<?
  }
?>

<? include "../foot.php"; ?>
