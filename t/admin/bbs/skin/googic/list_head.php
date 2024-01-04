
<!-- 카테고리 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><td align="left"><?=$catlist?></td></tr>
</table>
<!-- 카테고리 끝-->

<!-- 검색 -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #a9a9a9; border-bottom:1px solid #d7d7d7; padding:5px 0px;">
   <form name="sfrm" action="<?=$PHP_SELF?>">
  <tr>
    <td height="50" align="center" bgcolor="#f9f9f9">        
        <table width="0%" border="0" cellpadding="0" cellspacing="0" >       
      	<input type="hidden" name="code" value="<?=$code?>">
      	<input type="hidden" name="category" value="<?=$category?>"> 
		  	<tr height="30">
				<td style="padding-right:10px;width:50;"><b style="color:black;">근무분야</b></td>
						<td width="85">
							<select class="select" name="addinfo2">
								<option value="">선택</option>
								<option value="발사체">발사체</option>
								<option value="위성체">위성체</option>
								<option value="위성활용">위성활용</option>
								<option value="지상장비">지상장비</option>
								<option value="과학연구">과학연구</option>
								<option value="우주탐사">우주탐사</option>
								<option value="기타">기타</option>
								<script language="javascript">
								<!--
								searchopt = document.sfrm.addinfo2;
								for(ii=0; ii<searchopt.length; ii++){
								 if(searchopt.options[ii].value == "<?=$addinfo2?>")
									searchopt.options[ii].selected = true;
								}
								-->
								</script>
							</select>
						</td>
				<td style="padding-right:10px;"><b style="color:black;">근무지역</b>&nbsp;&nbsp;&nbsp;&nbsp;
					<select class="select" name="zipcode">
							<option value="">선택</option>
							<option value="무관">무관</option>
							<option value="서울">서울</option>
							<option value="경기">경기</option>
							<option value="강원">강원</option>
							<option value="충북">충북</option>
							<option value="충남">충남</option>
							<option value="전북">전북</option>
							<option value="전남">전남</option>
							<option value="인천">인천</option>
							<option value="대구">대구</option>
							<option value="부산">부산</option>
							<option value="광주">광주</option>
							<option value="경북">경북</option>
							<option value="경남">경남</option>
							<option value="제주">제주</option>
							<script language="javascript">
							<!--
							searchopt = document.sfrm.zipcode;
							for(ii=0; ii<searchopt.length; ii++){
							 if(searchopt.options[ii].value == "<?=$zipcode?>")
							    searchopt.options[ii].selected = true;
							}
							-->
							</script>
					</select>
				</td>
			</tr>				
		  <tr>
            <td style="padding-right:10px;"><img src="<?=$skin_dir?>/image/search_tit.gif" width="47" height="9" border="0" /></td>
            <td style="padding-right:5px;">
							<select name="searchopt" class="select">
							<option value="name">작성자</option>
							<option value="subject">제목</option>
							<option value="content">내용</option>
							<option value="subcon">제목 + 내용</option>
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
            <td style="padding-right:10px;" colspan="10"><input name="searchkey" type="text" class="search_input" value="<?=$searchkey?>" size="50"></td>
            <td><input type="image" src="<?=$skin_dir?>/image/btn_search.gif" border="0" align="absmiddle" width="75" height="21" /></td>
          </tr>
		  
        </table>        
    </td>
  </tr>
  </form>
</table>  
<!-- 검색 끝 -->     
<br/>

<!-- 게시물 시작 -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="10" height="2" bgcolor="#a9a9a9"></td>
  </tr>
  <tr bgcolor="#f9f9f9">
  	<td width="1%"><?=$checkbox_head?></td>
    <td width="8%" height="30" align="center"><strong>번호</strong></td>
    <td width="12%" align="center"><strong>작성자</strong></td>
	<td align="center"><strong>제목/근무분야/경력사항</strong></td>
	<td width="12%" align="center"><strong>근무가능지역</strong></td>
    <td width="12%" align="center"><strong>작성일</strong></td>	
    <?=$hide_recom_start?>
		<td width="8%" align="center"><strong>추천</strong></td>
    <?=$hide_recom_end?>                    
  </tr>  
  <tr>
    <td colspan="10" height="1" bgcolor="#d7d7d7"></td>
  </tr>
