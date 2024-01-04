<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<?
if($save == ""){

	if(empty($mode)) $mode = "grpinsert";

	if(!strcmp($mode, "grpupdate")) {

		$bbs_grp = explode("\n", $site_info[bbs_grp]);
		for($ii = 0; $ii < count($bbs_grp); $ii++) {
			if(!empty($bbs_grp[$ii])) {
				$tmp_grp = explode("^", $bbs_grp[$ii]);

				if(!strcmp($idx, $tmp_grp[0])) {
					$grpname = $tmp_grp[1];
					break;
				}

			}
		}

	}

?>
<html>
<head>
<title>:: 게시판그룹관리 ::</title>
<link href="../wiz_style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
<!--
function inputCheck(frm){

	if(frm.grpname.value == ""){
		alert("그룹명을 입력하세요.");
		frm.grpname.focus();
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

<table border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td class="tit_sub"><img src="../image/ics_tit.gif"> 게시판그룹관리</td>
  </tr>
</table>
<form name="frm" action="<?=$PHP_SELF?>" method="post" onSubmit="return inputCheck(this);">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="idx" value="<?=$idx?>">
<input type="hidden" name="save" value="true">
<table width="100%" border="0" cellpadding=2 cellspacing=1 class="t_style">
  <tr>
    <td width="20%" class="t_name">그룹명</td>
    <td class="t_value">
    	<input type="text" name="grpname" value="<?=$grpname?>" class="input">
    </td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellpadding=0 cellspacing=0>
  <tr>
    <td align="center">
      <input type="image" src="../image/btn_confirm_l.gif"> &nbsp;
      <img src="../image/btn_list_l.gif" style="cursor:hand" onClick="document.location='group.php'">
    </td>
  </tr>
</table>
</form>
</td>
</tr>
</table>
</body>
</html>
<?php
} else {

	if(!strcmp($mode, "grpinsert")) {

		$bbs_grp = explode("\n",$site_info[bbs_grp]);
		$bbs_grp_cnt = count($bbs_grp) - 1;

		$grp_tmp = explode("^", $bbs_grp[$bbs_grp_cnt]);

		$idx = $grp_tmp[0] + 1;

		$bbs_grp_tmp = $site_info[bbs_grp]."\n".$idx."^".$grpname;

		$sql = "update wiz_siteinfo set bbs_grp = '".$bbs_grp_tmp."'";
		mysql_query($sql) or error(mysql_error());

		echo "<script>alert('저장되었습니다.');window.opener.document.location.href = window.opener.document.URL; document.location='group.php?';</script>";

	} else if(!strcmp($mode, "grpupdate")) {

		$bbs_grp = explode("\n",$site_info[bbs_grp]);
		for($ii = 0; $ii < count($bbs_grp); $ii++) {

			$grp_tmp = explode("^", $bbs_grp[$ii]);

			if(!empty($grp_tmp[0])) {

				if(!strcmp($idx, $grp_tmp[0])) {
					$bbs_grp_tmp .= "\n".$idx."^".$grpname;
				} else {
					$bbs_grp_tmp .= "\n".$grp_tmp[0]."^".$grp_tmp[1];
				}

			}

		}

		$sql = "update wiz_siteinfo set bbs_grp = '".$bbs_grp_tmp."'";
		mysql_query($sql) or error(mysql_error());

		echo "<script>alert('수정되었습니다.');window.opener.document.location.href = window.opener.document.URL; document.location='group.php?';</script>";

	} else if(!strcmp($mode, "grpdelete")) {

		$bbs_grp = explode("\n",$site_info[bbs_grp]);
		for($ii = 0; $ii < count($bbs_grp); $ii++) {

			$grp_tmp = explode("^", $bbs_grp[$ii]);

			if(!empty($grp_tmp[0])) {
				if(!strcmp($idx, $grp_tmp[0])) {
					$delete = true;
				} else {
					if(!strcmp($delete, true)) $grp_tmp[0] = $grp_tmp[0] - 1;
					$bbs_grp_tmp .= "\n".$grp_tmp[0]."^".$grp_tmp[1];
				}
			}

		}

		$sql = "update wiz_siteinfo set bbs_grp = '".$bbs_grp_tmp."'";
		mysql_query($sql) or error(mysql_error());

		echo "<script>alert('삭제되었습니다.');window.opener.document.location.href = window.opener.document.URL; document.location='group.php';</script>";

	}
}
?>
