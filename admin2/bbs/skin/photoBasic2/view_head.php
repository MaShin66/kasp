<?
// 보기페이지에서 사용될 파일부분
for($ii = 1;$ii <= $upfile_max;$ii++){
	if(file_exists(WIZHOME_PATH."/data/bbs/".$code."/M".$bbs_row[upfile.$ii])) ${upimg_m.$ii} = "/admin2/data/bbs/$code/M".$bbs_row[upfile.$ii];							// img
	else ${upimg_m.$ii} = "$skin_dir/image/noimg.gif";
}
$line = $bbs_info[line];

$mimgsize = $bbs_info[mimgsize];
?>
<script language="javascript">
<!--
// 불러올 이미지
var cuimg = "<?=$bbs_row[upfile1]?>";
function chgImage(idx){
	<? 
	for($ii = 1;$ii <= $upfile_max; $ii++){
	?>
		if(idx == '<?=$ii?>'){
			cuimg = '<?=$bbs_row[upfile.$ii]?>';
			document.cuimg.src = '<?=${upimg_m.$ii}?>';
		}
	<?
	}
	?>
}

// 이미지 팝업
function cuImg(){
	if(cuimg == ""){
		alert("이미지가 없습니다.");
	}else{
		var url = "/admin2/bbs/view_img.php?code=<?=$code?>&img=" + cuimg;
		window.open(url, "cuImg<?=$bbs_row[idx]?>", "height=100, width=100, menubar=no, scrollbars=no, resizable=yes, toolbar=no, status=no");
	}
}
//-->
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" height="2" bgcolor="#a9a9a9"></td>
  </tr>
  <tr>
    <td width="15%" align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>제목</strong></td>
    <td width="85%" colspan="3" style="padding-left:10px;">
    <table width="100%" border="0">
    	<tr>
    		<td width="80%" align="left"><?=$catname?><?=$subject?></td>
    		<td width="20%" align="right" style="padding-right:10px"><?=$hide_recom_start?>추천:<?=$recom?><?=$hide_recom_end?></td>
    	</tr>
    </table>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>           
  <tr>
    <td height="50" colspan="4">
    	<table width="100%" border="0" cellpadding="0" cellspacing="0">
    		<tr>
    			<td>
    				<img src="<?=$upimg_m1?>" name="cuimg" onClick="cuImg();" style="cursor:hand;" width="600" height="400" vspace="3" name="view_img_resize">
    			</td>
    		</tr>
    	</table>
    	<table width="600" border="0" cellspacing="0" cellpadding="3" style="layout:fixed;">
        <tr>
          <?
          for($ii = 1;$ii <= $bbs_info[upfile];$ii++){
            $tidx = $ii - 1;
            if($tidx % $line == 0 && $tidx != 0) echo "</tr><tr>";
          ?>
          <td align="center"><img src="<?=${upimg_m.$ii}?>" width="112" height="82" vspace="1" <? if($bbs_row[upfile.$ii] != ""){ ?> onClick="chgImage('<?=$ii?>');" style="cursor:hand;"<? } ?>></td>
          <? } ?>
        </tr>
      </table>
    	<table width="100%" border="0" cellpadding="10" cellspacing="0">
        <tr>
          <td align="left" style="padding-top:5px">
      		<?=$movie1?><?=$movie2?><?=$movie3?>
      		<?=$content?>
          </td>
        </tr>
    	</table>
    </td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>          
  <tr>
    <td width="15%" align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>이전글</strong></td>
    <td width="85%" align="left" colspan="3" style="padding-left:10px;"><?=$prev?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>          
  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>다음글</strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><?=$next?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <tr>
  	<td height="10"></td>
  </tr>
</table>
