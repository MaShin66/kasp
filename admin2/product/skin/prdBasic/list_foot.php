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
    <td height="20" align="center">
        
        <table width="0%" border="0" cellpadding="0" cellspacing="0">
        <form name="sfrm" action="<?=$PHP_SELF?>">
      	<input type="hidden" name="catcode" value="<?=$catcode?>">
          <tr>
            <td style="padding-right:5px;">
							<select name="searchopt">
				      <option value="prdname">상품명</option>
				      <option value="prdcode">상품코드</option>
				      <option value="content">상품설명</option>
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
            <td style="padding-right:5px;"><input name="searchkey" type="text" class="search_input" value="<?=$searchkey?>" size="20"></td>
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
