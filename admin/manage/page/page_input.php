<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include "../head.php"; ?>

<?
if($mode == "") $mode = "insert";
if($mode == "update"){
	$sql = "select * from wiz_page where idx='$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	$page_info = mysql_fetch_object($result);
	$page_info->content = stripslashes($page_info->content);
}
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../style.css" rel="stylesheet" type="text/css">
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
      alert("페이지명을 입력하세요");
      frm.title.focus();
      return false;
   }
   if(content.outputBodyHTML() == ""){
      alert("페이지내용을 입력하세요");
      return false;
   }

}
function popGrp() {
	var url = "group.php";
	window.open(url,"PAGEGroup","height=250, width=350, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, top=100, left=100");
}
//-->
</script>
</head>

			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">페이지관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">페이지를 추가/수정/삭제 관리합니다.</td>
        </tr>
      </table>

      <br>
	     <form name="frm" action="page_save.php" method="post" onSubmit="return inputCheck(this)" enctype="multipart/form-data">
      <input type="hidden" name="tmp">
      <input type="hidden" name="mode" value="<?=$mode?>">
      <input type="hidden" name="idx" value="<?=$idx?>">
      <input type="hidden" name="page" value="<?=$page?>">
      <table width="100%" border="0" cellspacing="1" cellpadding="2" class="t_style">
        <tr>
          <td width="15%" class="t_name">페이지코드 <font color="red">*</font></td>
          <td width="85%" class="t_value" colspan="3">
          <input type="text" name="code" value="<?=$page_info->code?>" size="30" class="input" maxlength="30" <? if($mode == "update") echo "readonly"; ?>> 영문입력
          </td>
        </tr>
        <tr>
          <td height="10" align="left" class="t_name">메뉴 <font color="red">*</font></td>
          <td class="t_value" colspan="3">
          	<?php
          	$page_grp = explode("\n", $site_info[page_grp]);
          	$no = 0;
          	for($ii = 0; $ii < count($page_grp); $ii++) {
          		if(!empty($page_grp[$ii])) {
          			$tmp_grp = explode("^", $page_grp[$ii]);
          			$grp_list[$no][no] = $tmp_grp[0];
          			$grp_list[$no][grp] = $tmp_grp[1];
          			$no++;
          		}
          	}
          	?>
          	<select name="menu" id="page_grp">
          		<option value="">:: 페이지그룹 ::</option>
          		<? for($ii = 0; $ii < count($grp_list); $ii++) { ?>
          		<option value="<?=$grp_list[$ii][no]?>" <? if(!strcmp($page_info->menu, $grp_list[$ii][no])) echo "selected" ?>><?=$grp_list[$ii][grp]?></option>
          		<? } ?>
          	</select>
          	<img src="../image/btn_bbsgroup.gif" align="absmiddle" style="cursor:hand" onclick="popGrp()">&nbsp;
          	우선순위
          	<select name="prior">
          		<? for($ii = 1; $ii < 11; $ii++) { ?>
          		<option value="<?=$ii?>" <? if(!strcmp($ii, $page_info->prior)) echo "selected"; ?>><?=$ii?></option>
          		<? } ?>
          	</select> (그룹내에서 페이지 우선순위,작을수록 순위가 높음)<br>
          	페이지그룹은 페이지가 많은 경우 페이지를 그룹별로 효과적으로 관리하기 위한 기능입니다.
          </td>
        </tr>
        <tr>
          <td class="t_name">페이지명 <font color="red">*</font></td>
          <td class="t_value" colspan="3">
          <input type="text" name="title" value="<?=$page_info->title?>" size="80" class="input">
          </td>
        </tr>
        <tr>
          <td class="t_name">페이지url</td>
          <td class="t_value" colspan="3">
          http://<?=$HTTP_HOST?>/<input type="text" name="url" value="<?=$page_info->url?>" size="52" class="input">
          </td>
        </tr>
        <tr>
          <td class="t_value" colspan="4">
          <?
          $edit_height = "500";
          $edit_content = $page_info->content;
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
          	<img src="../image/btn_list_l.gif" style="cursor:hand" onclick="document.location='page_list.php?page=<?=$page?>';">
          </td>
        </tr>
      </table>
	  </form>

<? include "../foot.php"; ?>
