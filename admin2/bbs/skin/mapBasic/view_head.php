<?php
$zipfile = file("$_SERVER[DOCUMENT_ROOT]/admin2/wiz_zipcode.db");

$no = 0;

while($zipcode = each($zipfile)) {
	$ziplist = explode(" ", $zipcode[1]);	
	if(strcmp($tmp_si, $ziplist[1])) {
		
		$si_list[$no] = $ziplist[1];
		
		$tmp_si = $ziplist[1];
		$no2 = 0;
		$no++;
	}
	
	if(strcmp($tmp_gu, $ziplist[2])) {		
		
		$gu_list[$ziplist[1]][$no2] = $ziplist[2];
		
		$no2++;
		$tmp_gu = $ziplist[2];
	}
	
}

include $_SERVER['DOCUMENT_ROOT'].$skin_dir."/map_link.php";

?>
<script language="javascript" src="/admin2/js/flash.js"></script>
<script language="javascript">
<!--
function viewImg(img){
	var url = "/admin2/bbs/view_img.php?code=<?=$code?>&img=" + img;
	window.open(url, "viewImg", "height=100, width=100, menubar=no, scrollbars=no, resizable=yes, toolbar=no, status=no");
}
//-->
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td align="center" width="40%" valign="top">
    	<script language="JavaScript" type="text/javascript">flashView("<?=$skin_dir?>/image/map.swf", "",250, 320)</script>
    </td>
    <td width="60%" valign="top" align="right">
    	
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
			          <td align="center">
			          </td>
			          <td align="center"><input name="searchkey" value="<?=$searchkey?>" type="text" style="width:140px" class="input"></td>
			          <td align="center"><input type="image" src="<?=$skin_dir?>/image/btn_search.gif" border="0" align="absmiddle" /></td>
			        </tr>
			      
			    </table></td>
			  </tr>
			</form>
			</table>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
			    <td colspan="4" height="2" bgcolor="#a9a9a9"></td>
			  </tr>
			  <tr>
			    <td width="20%" align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>지점명</strong></td>
			    <td width="80%" align="left" colspan="3" style="padding-left:10px;"><?=$subject?></td>
			  </tr>
			  <tr>
			    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
			  </tr> 
			  <tr>
			    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>연락처</strong></td>
			    <td colspan="3" align="left" style="padding-left:10px;"><?=$tphone?></td>
			  </tr>
			  <tr>
			    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
			  </tr>         
			  <tr>
			    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>팩스번호</strong></td>
			    <td colspan="3" align="left" style="padding-left:10px;"><?=$addinfo1?></td>
			  </tr>
			  <tr>
			    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
			  </tr> 
			  <tr>
			    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>주소</strong></td>
			    <td colspan="3" align="left" style="padding-left:10px;"><?=$address?></td>
			  </tr>
			  <tr>
			    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
			  </tr> 
			  <tr>
			    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>영업시간</strong></td>
			    <td colspan="3" align="left" style="padding-left:10px;"><?=$addinfo2?></td>
			  </tr>
			  <tr>
			    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
			  </tr> 
			  <tr>
			    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>매장소개</strong></td>
			    <td colspan="3" align="left" style="padding-left:10px;"><?=$content?></td>
			  </tr>
			  <tr>
			    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
			  </tr> 
			  <tr>
			    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>약도</strong></td>
			    <td colspan="3" align="left" style="padding:5px;"><?=$upimg1?></td>
			  </tr>
			  <tr>
			    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
			  </tr> 
			  <tr>
			    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>이미지</strong></td>
			    <td colspan="3" align="left" style="padding:5px;"><?=$upimg2?><?=$upimg3?><?=$upimg4?><?=$upimg5?><?=$upimg6?><?=$upimg7?><?=$upimg8?><?=$upimg9?><?=$upimg10?><?=$upimg11?><?=$upimg12?></td>
			  </tr>
			  <tr>
			    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
			  </tr> 
			</table>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr><td height="5"></td></tr>
			  <tr>
			    <td align="right">
			    	&nbsp;<?=$copy_btn?>&nbsp;<?=$move_btn?>&nbsp;<?=$list_btn?>&nbsp;<?=$write_btn?>&nbsp;<?=$modify_btn?>&nbsp;<?=$delete_btn?>&nbsp;<?=$reply_btn?>&nbsp;<?=$recom_btn?>
			    </td>
			  </tr>
			</table>
		</td>
	</tr>
</table>
