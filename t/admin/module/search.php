<?php
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
include_once "$_SERVER[DOCUMENT_ROOT]/admin/inc/site_info.php";

// 스킨위치
$skin_dir = "/admin/search/skin/".$site_info[search_skin];
$search_url = "/".$site_info[search_url];
?>
<link href="<?=$skin_dir?>/style.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form action="<?=$search_url?>" method="get">
  <tr>
    <td><img src="<?=$skin_dir?>/image/img_search.gif" width="67" height="18"></td>
    <td><input name="total_searchkey" value="<?=$total_searchkey?>" type="text" class="input" size="12"></td>
    <td style="padding-left:3px"><input type="image" src="<?=$skin_dir?>/image/btn_search.gif" width="29" height="17" border="0"></td>
  </tr>
</form>
</table>
