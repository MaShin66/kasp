<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<html>
<head>
<title>:: 페이지그룹관리 ::</title>
<link href="../wiz_style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
<!--
function grpDelete(idx) {
	if(confirm("삭제하시겠습니까?")) {
		document.location = "group_input.php?save=true&mode=grpdelete&idx=" + idx;
	}
}
//-->
</script>
</head>
<body>

<br>
<table align="center" width="98%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td class="tit_sub"><img src="../image/ics_tit.gif"> 페이지그룹관리</td>
    <td align="right"><img src="../image/btn_bbscat.gif" style="cursor:hand" onclick="document.location='group_input.php?mode=grpinsert'" class="sbtn"></td></td>
  </tr>
</table>

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

<table align="center" width="98%" border="0" cellspacing="0" cellpadding="0">
	<tr><td colspan=20 class="t_rd"></td></tr>
	<tr class="t_th">
		<th width="15%">번호</th>
		<th>분류명</th>
		<th width="30%">기능</th>
	</tr>
	<tr><td colspan=20 class="t_rd"></td></tr>
<?php
for($ii = 0; $ii < count($grp_list); $ii++) {
?>
	<tr>
		<td align="center" height="30"><?=$grp_list[$ii][no]?></td>
		<td align="center"><?=$grp_list[$ii][grp]?></td>
		<td align="center">
			<img src="../image/btn_edit_s.gif" style="cursor:hand" onclick="document.location='group_input.php?idx=<?=$grp_list[$ii][no]?>&mode=grpupdate'" class="gbtn">
			<img src="../image/btn_delete_s.gif" style="cursor:hand" onclick="grpDelete('<?=$grp_list[$ii][no]?>')" class="gbtn">
		</td>
	</tr>
	<tr><td colspan="20" class="t_line"></td></tr>
<?
}

	if($no <= 0) {
?>
	<tr>
		<td height="30" class="t_value" align="center" colspan="7">등록된 그룹이 없습니다.</td>
	</tr>
	<tr><td colspan="20" class="t_line"></td></tr>
<?php
	}
?>
</table>

</body>
</html>
