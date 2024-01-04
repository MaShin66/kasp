<?
if($popup_info[linkurl]) {
	$popup_info[linkurl] = "onclick=document.location='$popup_info[linkurl]'; style='cursor:pointer'";
}
?>
<style>
p { margin-top: 0px; margin-bottom: 0px }
td { font-size:12px; font-family:"굴림","돋움"; color:#4A4A4A; line-height:160% }
</style>
<script language="javascript">
<!--
  function popupClose<?=$popup_info[idx]?>(){
    setCookie("popupDayClose<?=$popup_info[idx]?>", "true", 1);
    popup<?=$popup_info[idx]?>.style.display = 'none';
    document.getElementById("popContent<?=$popup_info[idx]?>").innerHTML="";
  }
//-->
</script>
<div id="popup<?=$popup_info[idx]?>" style='z-index:10; position:absolute; left: <?=$popup_info[posi_x]?>px; top: <?=$popup_info[posi_y]?>px;'>
<table border="0" width="<?=$popup_info[size_x]?>" height="<?=$popup_info[size_y]?>" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">
    
      <table border="0" cellpadding="0" cellspacing="0" <?=$popup_info[linkurl]?>>
      <tr><td id="popContent<?=$popup_info[idx]?>"><?=$popup_info[content]?></td></tr>
      </table>

      <table width="100%" height="25" bgcolor="#909090" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td align="right"><font color=#ffffff>오늘하루 열지않음</font> <input type="checkbox" onClick="popupClose<?=$popup_info[idx]?>();">&nbsp; </td>
        </tr>
      </table>

      </td>
  </tr>
</table>
</div>
<script language="javascript">
<!--
if(readCookie('popupDayClose<?=$popup_info[idx]?>')){
  popup<?=$popup_info[idx]?>.style.display = 'none';
}
-->
</script>
