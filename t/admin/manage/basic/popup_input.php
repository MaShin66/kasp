<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?
$page_name = "팝업관리";
$page_desc = "팝업내용을 설정 합니다.";
$navi_name = " 기본설정 > 팝업관리";
?>
<? include "../head.php"; ?>

<?
if($mode == "") $mode = "insert";
if($mode == "update"){
	$sql = "select * from wiz_popup where idx='$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	$popup_info = mysql_fetch_object($result);
}

if($popup_info->sdate == "") $popup_info->sdate = date('Y-m-d');
if($popup_info->edate == "") $popup_info->edate = date('Y-m-d');

if($popup_info->posi_x == "") $popup_info->posi_x = "100";
if($popup_info->posi_y == "") $popup_info->posi_y = "100";

if($popup_info->size_x == "") $popup_info->size_x = "340";
if($popup_info->size_y == "") $popup_info->size_y = "400";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
<!--
function inputCheck(frm){

   if(frm.title.value == ""){
      alert("제목을 입력하세요");
      frm.title.focus();
      return false;
   }

	if(frm.posi_x.value != "" && !check_Num(frm.posi_x.value)) {
		alert("위치는 숫자만 입력하세요.");
		frm.posi_x.focus();
		return false;
	}
	if(frm.posi_y.value != "" && !check_Num(frm.posi_y.value)) {
		alert("위치는 숫자만 입력하세요.");
		frm.posi_y.focus();
		return false;
	}

	if(frm.size_x.value != "" && !check_Num(frm.size_x.value)) {
		alert("크기는 숫자만 입력하세요.");
		frm.size_x.focus();
		return false;
	}
	if(frm.size_y.value != "" && !check_Num(frm.size_y.value)) {
		alert("크기는 숫자만 입력하세요.");
		frm.size_y.focus();
		return false;
	}

  if(content.outputBodyHTML() == ""){
		alert("팝업내용을 입력하세요");
		return false;
  }

}
//-->
</script>
</head>

			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">팝업관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">팝업을 추가/수정/삭제 합니다.</td>
        </tr>
      </table>

      <br>
      <table width="100%" border="0" cellspacing="1" cellpadding="2" class="t_style">
      <form name="frm" action="popup_save.php" method="post" onSubmit="return inputCheck(this)" enctype="multipart/form-data">
      <input type="hidden" name="tmp">
      <input type="hidden" name="mode" value="<?=$mode?>">
      <input type="hidden" name="idx" value="<?=$idx?>">
      <input type="hidden" name="page" value="<?=$page?>">
        <tr>
          <td class="t_name">제목 <font color="red">*</font></td>
          <td class="t_value" colspan="3">
          <input type="text" name="title" value="<?=$popup_info->title?>" size="80" class="input">
          </td>
        </tr>
        <tr>
          <td class="t_name">게시기간 <font color="red">*</font></td>
          <td class="t_value" colspan="3">
          	<input type="text" name="sdate" value="<?=$popup_info->sdate?>" size="12" class="input">
            <img src="../image/ic_cal.gif" align="absmiddle" style="cursor:hand" onClick="Calendar1('document.frm','sdate');" > ~
            <input type="text" name="edate" value="<?=$popup_info->edate?>" size="12" class="input">
            <img src="../image/ic_cal.gif" align="absmiddle" style="cursor:hand" onClick="Calendar1('document.frm','edate');">
            <? if($popup_info->edate < date('Y-m-d')) echo "<font color=red>[종료일지남]</font>"; ?>&nbsp;
          </td>
        </tr>
        <tr>
          <td class="t_name">팝업형태</td>
          <td class="t_value">
            <input name="popup_type" type="radio" value="W" size="6" class="input" <? if($popup_info->popup_type == "W" || $popup_info->popup_type == "") echo "checked"; ?>> 일반팝업 &nbsp;
            <input name="popup_type" type="radio" value="L" size="6" class="input" <? if($popup_info->popup_type == "L") echo "checked"; ?>> 레이어팝업
          </td>
          <td class="t_name"></td>
          <td class="t_value"></td>
        </tr>
        <tr>
          <td width="15%" class="t_name">사용여부</td>
          <td width="35%" class="t_value">
            <input name="isuse" type="radio" value="Y" size="6" class="input" <? if($popup_info->isuse == "Y" || $popup_info->isuse == "") echo "checked"; ?>> 사용함 &nbsp;
            <input name="isuse" type="radio" value="N" size="6" class="input" <? if($popup_info->isuse == "N") echo "checked"; ?>> 사용안함
          </td>
          <td width="15%" class="t_name">스크롤여부</td>
          <td width="35%" class="t_value">&nbsp;
            <input name="scroll" type="radio" value="Y" size="6" class="input" <? if($popup_info->scroll == "Y") echo "checked"; ?>> 허용함&nbsp;
            <input name="scroll" type="radio" value="N" size="6" class="input" <? if($popup_info->scroll == "N" || $popup_info->scroll == "") echo "checked"; ?>> 허용안함
          </td>
        </tr>
        <tr>
          <td class="t_name">위치 <font color="red">*</font></td>
          <td class="t_value">&nbsp;
            X : <input name="posi_x" type="text" value="<?=$popup_info->posi_x?>" size="6" class="input"> &nbsp;
            Y : <input name="posi_y" type="text" value="<?=$popup_info->posi_y?>" size="6" class="input">
          </td>
          <td class="t_name">크기</td>
          <td class="t_value">&nbsp;
            가로 : <input name="size_x" type="text" value="<?=$popup_info->size_x?>" size="6" class="input"> &nbsp;
            세로 : <input name="size_y" type="text" value="<?=$popup_info->size_y?>" size="6" class="input">
          </td>
        </tr>
        <tr>
          <td class="t_name">링크주소</td>
          <td class="t_value" colspan="3"><input type="text" name="linkurl" value="<?=$popup_info->linkurl?>" size="60" class="input"></td>
        </tr>
        <tr>
          <td class="t_name">팝업내용</td>
          <td class="t_value" colspan="3" height="300">

          	<?
	          $edit_content = $popup_info->content;
	          include "../../webedit/WIZEditor.html";
	          ?>

          </td>
        </tr>
      </table>

      <br>
      <table align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
          	<input type="image" src="../image/btn_confirm_l.gif"> &nbsp;
          	<img src="../image/btn_list_l.gif" style="cursor:hand" onclick="document.location='popup_list.php?page=<?=$page?>';">
          </td>
        </tr>
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
              <td><img src="../image/check_tit.gif" width="75" height="19" /></td>
            </tr>
            <tr>
              <td class="chk_alt">
              - 팝업형태에서 레이어팝업을 이용하여 창이아닌 레이어로 공지할 수 있습니다.<br>
              - 팝업을 생성하였으나 뜨지않을 경우 세가지를 체크해보세요. 게시기간, 사용여부, 브라우저>도구>인터넷옵션>쿠키삭제
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


<? include "../foot.php"; ?>
