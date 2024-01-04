<?
$sql = "select * from wiz_bbs where code = '$code' and idx = '$bbs_idx'";
$result = mysql_query($sql) or error(mysql_error());
$bbs_row = mysql_fetch_array($result);

$subject 	= $bbs_row[subject];

// 보기페이지에서 사용될 파일부분
for($ii = 1;$ii <= $bbs_info[upfile];$ii++){
	if(file_exists(WIZHOME_PATH."/data/bbs/".$code."/M".$bbs_row[upfile.$ii])) ${upimg_m.$ii} = "/admin/data/bbs/$code/M".$bbs_row[upfile.$ii];							// img
	else ${upimg_m.$ii} = "$skin_dir/image/noimg.gif";
	
	if(file_exists(WIZHOME_PATH."/data/bbs/".$code."/S".$bbs_row[upfile.$ii])) ${upimg_s.$ii} = "/admin/data/bbs/$code/S".$bbs_row[upfile.$ii];							// img
	else ${upimg_s.$ii} = "$skin_dir/image/noimg.gif";
}
$line = $bbs_info[line];

$mimgsize = $bbs_info[mimgsize];

/*
$list_btn					: 목록 버튼
$write_btn				: 쓰기 버튼
*/
?>
<script language="javascript">
<!--
// 불러올 이미지
var cuimg = "<?=$bbs_row[upfile1]?>";
function chgImage(idx){
	<? 
	for($ii = 1;$ii <= $bbs_info[upfile]; $ii++){
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
		var url = "/admin/bbs/view_img.php?code=<?=$code?>&img=" + cuimg;
		window.open(url, "cuImg<?=$bbs_row[idx]?>", "height=100, width=100, menubar=no, scrollbars=no, resizable=yes, toolbar=no, status=no");
	}
}
//-->
</script>


    	</table>
    </td>
    <td width="550" align="right">
    	
    	<table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="<?=$upimg_m1?>" name="cuimg" onClick="cuImg();" style="cursor:pointer;" width="550" height="365" /></td>
      </tr>
      <tr>
        <td height="6"></td>
      </tr>
      <tr>
        <td>
        	
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" class="l02"><strong><?=$subject?></strong></td>
            <td align="right">
            	<table border="0" cellspacing="0" cellpadding="0">
                <tr>
                	<? for($ii = 1;$ii <= $bbs_info[upfile];$ii++){ ?>
                	<? if($bbs_row["upfile".$ii] != ""){ ?>
                	<td width="6"></td>
                  <td><img src="<?=${"upimg_s".$ii}?>" onClick="chgImage('<?=$ii?>');" style="cursor:pointer;" width="50" height="40"></td>
                  <? } ?>
                	<? } ?>
                </tr>
            	</table>
            </td>
          </tr>
        	</table>
        
        </td>
      </tr>
    	</table>
    	
    </td>
  </tr>
</table>
<!-- 게시물 끝 -->   
  
<!-- 페이지 번호 -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" align="center">
			<? print_pagelist($page, $lists, $page_count, $param); ?>
    </td>
  </tr>
</table>  
<!-- 페이지 번호끝 -->

<!-- 검색 -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" align="center" bgcolor="#f9f9f9" style="border-top:1px solid #a9a9a9; border-bottom:1px solid #d7d7d7; padding:5px 0px;">
        
        <table width="0%" border="0" cellpadding="0" cellspacing="0">
        <form name="sfrm" action="<?=$PHP_SELF?>">
      	<input type="hidden" name="code" value="<?=$code?>">
      	<input type="hidden" name="category" value="<?=$category?>">
          <tr>
            <td style="padding-right:10px;"><img src="<?=$skin_dir?>/image/search_tit.gif" width="47" height="9" border="0" /></td>
            <td style="padding-right:5px;">
							<select name="searchopt" class="select">
							<option value="subject">제 목</option>
							<option value="content">내 용</option>
							<option value="subcon">제목 + 내용</option>
							<option value="name">작성자</option>
							<option value="memid">아이디</option>
							</select>	
							<script language="javascript">
							<!--
							searchopt = document.sfrm.searchopt;
							for(ii=0; ii<searchopt.length; ii++){
							 if(searchopt.options[ii].value == "<?=$searchopt?>")
							    searchopt.options[ii].selected = true;
							}
							-->
							</script>
            </td>
            <td style="padding-right:10px;"><input name="searchkey" type="text" class="search_input" value="<?=$searchkey?>" size="50"></td>
            <td><input type="image" src="<?=$skin_dir?>/image/btn_search.gif" border="0" align="absmiddle" width="75" height="21" /></td>
          </tr>
        </form>
        </table>
        
    </td>
  </tr>
</table>  
<!-- 검색 끝 -->                                                 

<!-- 버튼 -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
  	<td align="left" style="padding-top:10px"><?=$sel_delete_btn?> <?=$sel_copy_btn?> <?=$sel_move_btn?> <?=$order_btn?></td>
    <td align="right" style="padding-top:10px"><?=$list_btn?>&nbsp;<?=$write_btn?></td>
  </tr>
</table>  
<!-- 버튼 끝 -->
