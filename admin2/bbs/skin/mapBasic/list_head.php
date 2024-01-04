<?
$zipfile = file("$_SERVER[DOCUMENT_ROOT]/admin2/wiz_zipcode.db");
$no = 0;

while($zipcode = each($zipfile)) {
	$ziplist = explode(" ", $zipcode[1]);
	if(strcmp($tmp_si, $ziplist[1])) {
		if($ziplist[1] != "") {
			$si_list[$no] = $ziplist[1];
			$tmp_si = $ziplist[1];
			$no2 = 0;
			$no++;
		}
	}
	if(strcmp($tmp_gu, $ziplist[2])) {
		if($ziplist[2] != "") {
			$gu_list[$ziplist[1]][$no2] = $ziplist[2];
			$no2++;
			$tmp_gu = $ziplist[2];
		}
	}
}

include $_SERVER['DOCUMENT_ROOT'].$skin_dir."/map_link.php";
?>
<script language="javascript" src="/admin2/js/flash.js"></script>

<!-- 카테고리 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><td align="left"><?=$catlist?></td></tr>
</table>
<!-- 카테고리 끝-->

<!-- 게시물 시작 -->
<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td align="center" width="40%" valign="top">
    	<script language="JavaScript" type="text/javascript">flashView("<?=$skin_dir?>/image/map.swf", "",250, 320)</script>
    </td>
    <td width="90%" valign="top" align="right">

    	<table border="0" cellspacing="0" cellpadding="0">
      <form name="sfrm" action="<?=$PHP_SELF?>">
      <input type="hidden" name="code" value="<?=$code?>">
      <input type="hidden" name="category" value="<?=$category?>">
      <input type="hidden" name="searchopt" value="subject">
			  <tr>
          <td height="30">
          	<select name="sido" onChange="this.form.gugun.value='';this.form.submit();">
            	<option value="">광역시/도</option>
            	<? for($ii = 0; $ii < count($si_list); $ii++) { ?>
							<option value="<?=$si_list[$ii]?>" <? if (!strcmp($si_list[$ii], $sido)) echo "selected" ?>><?=$si_list[$ii]?></option>
							<? } ?>
          	</select>
          </td>
          <td>
          	<select name="gugun" onChange="this.form.submit();">
            	<option value="">시/군/구</option>
							<? for($ii = 0; $ii < count($gu_list[$sido]); $ii++) { ?>
							<option value="<?=$gu_list[$sido][$ii]?>" <? if (!strcmp($gu_list[$sido][$ii], $gugun)) echo "selected" ?>><?=$gu_list[$sido][$ii]?></option>
							<? } ?>
          	</select>
          </td>
			    <td>
			    	<table border="0" cellpadding="2" cellspacing="0">
			        <tr>
			          <td align="center" style="padding-left:2px"><input name="searchkey" value="<?=$searchkey?>" type="text" style="width:130px" class="input"></td>
			          <td align="center" style="padding-left:2px"><input type="image" src="<?=$skin_dir?>/image/btn_search.gif" border="0" align="absmiddle" /></td>
			        </tr>

			    </table></td>
			  </tr>
			</form>
			</table>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
			    <td colspan="10" height="2" bgcolor="#a9a9a9"></td>
			  </tr>
			  <tr bgcolor="#f9f9f9">
			  	<td width="1%"><?=$checkbox_head?></td>
			    <td width="15%" height="30" align="center"><strong>지점명</strong></td>
			    <td align="center"><strong>주소</strong></td>
			    <td width="15%" align="center"><strong>상세보기</strong></td>
			  </tr>
			  <tr>
			    <td colspan="10" height="1" bgcolor="#d7d7d7"></td>
			  </tr>
