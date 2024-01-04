<?php
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";

$sql = "select code, types, types_num, padding, isuse from wiz_bannerinfo where code = '$code'";
$result = mysql_query($sql) or error(mysql_error());
$total = mysql_num_rows($result);
$ban_info = mysql_fetch_object($result);

if($total <= 0){
	$msg = "<font color=red><b>".$code."</b></font> 배너는 아직 생성되지 않았습니다.";
	echo "<table align=center><tr><td height=25>&nbsp;&nbsp;".$msg."&nbsp;&nbsp;</td></tr></table>";
}
if($ban_info->isuse != 'N'){
?>
<!-- Banner : Start -->
<table border=0 cellpadding=0 cellspacing=0>
<?php
	$sql = "select * from wiz_banner where code = '$ban_info->code' and isuse != 'N' order by prior asc, idx asc";
	$result2 = mysql_query($sql) or error(mysql_error());
	$total = mysql_num_rows($result2);
	$no = 0;
	$num = 1;
	while ($row = mysql_fetch_object($result2)) {
		$onClick = "";
		if(!empty($row->link_url)) {
			if(!strcmp($row->link_target, "_SELF") || empty($row->link_target)) $onClick = " onClick=\"self.location.href='".$row->link_url."'\" style='cursor:pointer' ";
			if(!strcmp($row->link_target, "_BLANK")) $onClick = " onClick=\"window.open('".$row->link_url."')\" style='cursor:pointer' ";
		}

    if($row->de_type == "IMG")
      $ban_content = "<img src=/admin/data/banner/".$row->de_img." border=0 ".$onClick.">";
    else
      $ban_content = "<table cellpadding=0 cellspacing=0 border=0><tr><td ".$onClick.">".$row->de_html."</td></tr></table>";

    if($ban_info->types == "H") {

?>
			<tr>
				<td><?=$ban_content?></td>
			</tr>
<?php

			if($no < ($total - 1) && $ban_info->padding > 0) echo "<tr><td height=".$ban_info->padding."></td></tr>";

		} else {

      $mod = ($num%$ban_info->types_num);

?>
          <td align='left'><?=$ban_content?></td>
<?php
      if($mod == 0) {
?>
				</tr>
<?php
				if($total > ($ban_info->types_num * $tr) && $total != $ban_info->types_num && $ban_info->padding > 0) {
?>
      	<tr><td colspan="<?=$ban_info->types_num * 2?>" height="<?=$ban_info->padding?>"></td></tr>
<?php
				}
?>
				<tr>
<?php
      	$tr++;
			}
      if($mod > 0 && $mod < $total && $ban_info->padding > 0) echo "<td width=".$ban_info->padding."></td>";

		}

		$no++;
		$num++;
	}
?>
</table>
<?
}
?>
<!-- Banner : End -->
