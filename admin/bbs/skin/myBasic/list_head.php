<!-- 카테고리 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><td align="left"><?=$catlist?></td></tr>
</table>
<!-- 카테고리 끝-->

<!-- 게시물 시작 -->
<table width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td colspan="10" height="2" bgcolor="#a9a9a9" style="margin:0px; padding:0px"></td>
  </tr>
  <tr bgcolor="#f9f9f9">
  	<td width="1%" style="margin:0px; padding:0px"><?=$checkbox_head?></td>
    <td width="8%" height="30" align="center" style="margin:0px; padding:0px"><strong>번호</strong></td>
    <?=$hide_admin_start?>
    <td width="12%" align="center" style="margin:0px; padding:0px"><strong>회원</strong></td>
    <?=$hide_admin_end?>
    <td align="center" style="margin:0px; padding:0px"><strong>제목</strong></td>
    <td width="12%" align="center" style="margin:0px; padding:0px"><strong>작성자</strong></td>
    <td width="12%" align="center" style="margin:0px; padding:0px"><strong>작성일</strong></td>
    <td width="8%" align="center" style="margin:0px; padding:0px"><strong>조회</strong></td>
    <?=$hide_recom_start?>
		<td width="8%" align="center" style="margin:0px; padding:0px"><strong>추천</strong></td>
    <?=$hide_recom_end?>                    
  </tr>  
  <tr>
    <td colspan="10" height="1" bgcolor="#d7d7d7" style="margin:0px; padding:0px"></td>
  </tr>
