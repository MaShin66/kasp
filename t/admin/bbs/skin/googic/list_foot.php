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

                                

<!-- 버튼 -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
  	<td align="left" style="padding-top:10px"><?=$sel_delete_btn?> <?=$sel_copy_btn?> <?=$sel_move_btn?> <?=$order_btn?></td>
    <td align="right" style="padding-top:10px"><?=$list_btn?>&nbsp;<?=$write_btn?></td>
  </tr>
</table>  
<!-- 버튼 끝 -->
