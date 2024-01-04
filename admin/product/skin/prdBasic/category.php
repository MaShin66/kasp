<?
/*
$catimg 				: 카테고리 이미지
$catname				: 카테고리 명
$catlist				: 카테고리 리스트
$position				: 현재위치 (제품소개 > 상품분류1)
*/
?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<td><?=$catimg?></td>
  </tr>
  <tr><td height="2"></td></tr>
</table>               
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<td width="15"><img src="<?=$skin_dir?>/image/arrow.gif" border=0 align=absmiddle></td>
  	<td align="left">&nbsp;<b><?=$catname?></b></td>
  </tr>
  <tr><td height="2"></td></tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" bgcolor="#f7f7f7" style="border:1px solid #e9e9e9; padding:10px;">
      <table width="100%" border="0" cellpadding="4" cellspacing="0">
      	<?
      	for($ii=0;$ii<count($catlist);$ii++){
      		if($ii%4 == 0) echo "<tr>";
      	?>
        <td align="left"><table><tr><td><img src="<?=$skin_dir?>/image/product_cat_icon.gif" align="absmiddle"></td><td style="padding-left:5px"><?=$catlist[$ii]?></td></tr></table></td>
				<?
				}
				?>
      </table>
  	
    </td>
  </tr>                              
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<td height="5"></td>
  </tr>
</table>
