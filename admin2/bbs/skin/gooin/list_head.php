
<!-- 카테고리 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><td align="left"><?=$catlist?></td></tr>
</table>
<!-- 카테고리 끝-->
<!-- 검색 -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #a9a9a9; border-bottom:1px solid #d7d7d7; padding:5px 0px;">
   <form name="sfrm" action="<?=$PHP_SELF?>" onSubmit="return searchchk(this)">
  <tr>
    <td height="80" align="center" bgcolor="#f9f9f9">        
        <table width="0%" border="0" cellpadding="0" cellspacing="0" >       
      	<input type="hidden" name="code" value="<?=$code?>">
      	<input type="hidden" name="category" value="<?=$category?>"> 
		  	<tr height="30">
				<td style="padding-right:10px;width:47;"><b style="color:black;">근무분야</b></td>
						<td width="85">
							<select class="select" name="w_field" id="w_field">
								<option value="">선택</option>
								<option value="발사체">발사체</option>
								<option value="위성체">위성체</option>
								<option value="위성활용">위성활용</option>
								<option value="지상장비">지상장비</option>
								<option value="과학연구">과학연구</option>
								<option value="우주탐사">우주탐사</option>
								<option value="기타">기타</option>
							</select>
							<script language="javascript">
							<!--
							w_field = document.sfrm.w_field;
							for(ii=0; ii<w_field.length; ii++){
							 if(w_field.options[ii].value == "<?=$w_field?>")
							    w_field.options[ii].selected = true;
							}
							-->
							</script>
						</td>
				<td style="padding-right:10px;"><b style="color:black;">근무지역</b>&nbsp;&nbsp;			
					<select class="select" id="zipcode" name="zipcode">
						<option value="">전국</option>
						<option value="서울">서울</option>
						<option value="경기">경기</option>
						<option value="강원">강원</option>
						<option value="충북">충북</option>
						<option value="충남">충남</option>
						<option value="전북">전북</option>
						<option value="전남">전남</option>
						<option value="인천">인천</option>
						<option value="대구">대구</option>
						<option value="대전">대전</option>
						<option value="울산">울산</option>
						<option value="부산">부산</option>
						<option value="광주">광주</option>
						<option value="경북">경북</option>
						<option value="경남">경남</option>
						<option value="제주">제주</option>
					</select>
					<script language="javascript">
					<!--
						zipcode = document.sfrm.zipcode;
						for(ii=0; ii<zipcode.length; ii++){
						 if(zipcode.options[ii].value == "<?=$zipcode?>")
							zipcode.options[ii].selected = true;
						}
					-->
					</script>
					</td>
			</tr>	
			<tr>
				<td rowspan="2" style="padding-right:10px;"><b style="color:black;">기업형태</b></td>
				<td colspan="5" valign="middle">
				<input type="checkbox" name="c_type1" id="c_type1" value="1" <?if($c_type1) echo "checked";?>><b>중소기업(100명이하)<b/>
				<input type="checkbox" name="c_type1_1" id="c_type1-1" value="1_1" <?if($c_type1_1) echo "checked";?>><b>중소기업(100명이상)<b/>
				<input type="checkbox" name="c_type2" id="c_type2" value="2" <?if($c_type2) echo "checked";?>><b>중견기업(300명이상)<b/>
				<input type="checkbox" name="c_type3" id="c_type3" value="3" <?if($c_type3) echo "checked";?>><b>대기업<b/>
				</td>
			</tr>
			<tr>
				<td colspan="5" valign="middle">
				<input type="checkbox" name="c_type4" id="c_type4" value="4" <?if($c_type4) echo "checked";?>><b>대기업자회사<b/>
				<input type="checkbox" name="c_type5" id="c_type5" value="5" <?if($c_type5) echo "checked";?>><b>벤쳐기업<b/>&nbsp;&nbsp;
				<input type="checkbox" name="c_type6" id="c_type6" value="6" <?if($c_type6) echo "checked";?>><b>공공기관<b/>
				<input type="checkbox" name="c_type7" id="c_type7" value="7" <?if($c_type7) echo "checked";?>><b>외국계<b/>
				<input type="checkbox" name="c_type8" id="c_type8" value="8" <?if($c_type8) echo "checked";?>><b>비영리단체/협회/교육기관/재단<b/>
				</td>
			</tr>
			<tr height="30">
				<td style="padding-right:10px;width:47;"><b style="color:black;">고용형태</b></td>
				<td width="85" colspan="2">
					<select class="select" id="w_type" name="w_type">
						<option value="">선택</option>
						<option value="1">정규직</option>
						<option value="2">계약직</option>
						<option value="3">계약직 후 정규직 전환</option>
						<option value="4">병역특례</option>
						<option value="5">인턴직</option>
						<option value="6">인턴 후 정규직 전환</option>								
					</select>
					<script language="javascript">
					<!--
						w_type = document.sfrm.w_type;
						for(ii=0; ii<w_type.length; ii++){
						 if(w_type.options[ii].value == "<?=$w_type?>")
							w_type.options[ii].selected = true;
						}
					-->
					</script>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<b style="color:black;">급여조건</b>&nbsp;&nbsp;
					<select class="select" id="salary" name="salary">
						<option value="">선택</option>
						<option value="1">회사내규</option>
						<option value="2">면접 후 협의</option>
						<option value="3">1500</option>
						<option value="4">1500~2000</option>
						<option value="5">2000~2500</option>
						<option value="6">2500~3000</option>
						<option value="7">3000~3500</option>
						<option value="8">3500~4000</option>
						<option value="9">4000~4500</option>
						<option value="10">4500~5000</option>
						<option value="11">5000~5500</option>
						<option value="12">5500~6000</option>
						<option value="13">6000~7000</option>
						<option value="14">7000~8000</option>
						<option value="15">8000~9000</option>
						<option value="16">9000~1억</option>
						<option value="17">1억이상</option>
					</select>
					<script language="javascript">
					<!--
						salary = document.sfrm.salary;
						for(ii=0; ii<salary.length; ii++){
						 if(salary.options[ii].value == "<?=$salary?>")
							salary.options[ii].selected = true;
						}
					-->
					</script>
				</td>
			</tr>	
		  <tr>
            <td style="padding-right:10px;"><img src="<?=$skin_dir?>/image/search_tit.gif" width="47" height="9" border="0" /></td>
            <td style="padding-right:5px;">
							<select name="searchopt" class="select">
							<option value="c_name">업체명</option>
							<option value="subject">채용제목</option>
							<option value="content">내용</option>
							<option value="subcon">채용제목 + 내용</option>
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
            <td style="padding-right:10px;" colspan="3"><input name="searchkey" type="text" class="search_input" value="<?=$searchkey?>" size="50"></td>
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
    <td width="5%" height="30" align="center"><strong>번호</strong></td>
	<td width="15%" align="center"><strong>업체명</strong></td>
    <td align="center"><strong>채용제목 / 급여조건 / 근무지역</strong></td>
    <td width="12%" align="center"><strong>학력/경력</strong></td>
    <td width="12%" align="center"><strong>마감일</strong></td>
    <td width="12%" align="center"><strong>등록일</strong></td>
    <?=$hide_recom_start?>
		<td width="8%" align="center"><strong>추천</strong></td>
    <?=$hide_recom_end?>                    
  </tr>  
  <tr>
    <td colspan="10" height="1" bgcolor="#d7d7d7"></td>
  </tr>