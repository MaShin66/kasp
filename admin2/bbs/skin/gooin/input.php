<!-- jQuery UI CSS파일  --> 
<link rel="stylesheet" href="http://code.jquery.com/ui/1.8.18/themes/base/jquery-ui.css" type="text/css" />
<!-- jQuery 기본 js파일 --> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<!-- jQuery UI 라이브러리 js파일 --> 
<script src="http://code.jquery.com/ui/1.8.18/jquery-ui.min.js"></script>
<style type="text/css">
<!--
.ui-datepicker { font:12px dotum; }
.ui-datepicker select.ui-datepicker-month, 
.ui-datepicker select.ui-datepicker-year { width: 70px;}
.ui-datepicker-trigger { margin:0 0 -5px 2px; }
-->
</style>
<script language="JavaScript">
$( document ).ready(function() {
	//select box
	$("#zipcode").val("<?=$zipcode?>");
	$("#c_type").val("<?=$addinfo2[0]?>");
	$('#addinfo9').val("<?=$addinfo9?>");
	$('#w_type').val("<?=$addinfo4[0]?>");
	$('#w_field').val("<?=$addinfo4[2]?>");

   	$.datepicker.regional['ko'] = {
		closeText: '닫기',
		prevText: '이전달',
		nextText: '다음달',
		currentText: '오늘',
		monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)',
		'7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'],
		monthNamesShort: ['1월','2월','3월','4월','5월','6월',
		'7월','8월','9월','10월','11월','12월'],
		dayNames: ['일','월','화','수','목','금','토'],
		dayNamesShort: ['일','월','화','수','목','금','토'],
		dayNamesMin: ['일','월','화','수','목','금','토'],
		weekHeader: 'Wk',
		dateFormat: 'yymmdd',
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['ko']);
	$( "#c_est,#edate,#sdate" ).datepicker({
		changeMonth: true, 
         changeYear: true,
		yearRange: 'c-100:c+10',
         nextText: '다음 달',
         prevText: '이전 달',
		 closeText: '닫기',
		 dateFormat: "yy-mm-dd"
	});
	//숫자 3단위 컴마
	/*$('#c_sales').keyup(function(){
		var sales = set_WonComma2($(this).val());
		$(this).val(sales);
	});*/
	

});
<!--
function bbsCheck(frm){

  if(frm.c_name.value == ""){
    alert("기관명을 입력하세요.");
    frm.c_name.focus();
    return false;
  }
  if(frm.c_emp.value == "" || !check_Num(frm.c_emp.value)){
	alert("사원수를 올바르게 입력하세요.");
	frm.c_emp.focus();
	return false;
  }
  if(frm.c_type.value == ""){
	alert("기업형태를 선택하세요.");
	frm.c_type.focus();
	return false;
  }
  if(frm.c_sales.value == ""){
	alert("매출액을 입력하세요.");
	frm.c_sales.focus();
	return false;
  }
  if(frm.address.value == ""){
	alert("해당기관 소재지를 입력하세요.");
	frm.address.focus();
	return false;
  } 
  if(frm.career.value == "" || frm.edu.value == ""){
	alert("지원자격을 모두 입력하세요.");
	if(frm.career.value == "") frm.career.focus();
	else frm.edu.focus();	
	return false;
  }
  if(frm.addinfo9.value == "" || frm.zipcode.value == "" || frm.w_type.value == ""){
	alert("근무조건을 모두 입력하세요.");
	if(frm.addinfo9.value == "") frm.addinfo9.focus();
	else if(frm.zipcode.value == "") frm.zipcode.focus();
	else frm.w_type.focus();
	return false;
  }
  if(frm.sdate.value == "" || frm.edate.value == ""){
	alert("접수기간을 모두 입력하세요.");
	if(frm.sdate.value == "") frm.sdate.focus();
	else frm.edate.focus();	
	return false;
  }
  if(frm.name.value == ""){
    alert("담당자를 입력하세요.");
    frm.name.focus();
    return false;
  }
  if(frm.passwd != null && frm.passwd.value == ""){
    alert("비밀번호를 입력하세요.");
    frm.passwd.focus();
    return false;
  }
  if(frm.subject.value == ""){
    alert("제목을 입력하세요.");
    frm.subject.focus();
    return false;
  }
  if(frm.method.value == ""){
    alert("접수방법을 입력하세요.");
    frm.method.focus();
    return false;
  }
  if(frm.w_field.value == ""){
    alert("근무분야를 선택하세요.");
    frm.w_field.focus();
    return false;
  }
  try{ content.outputBodyHTML(); } catch(e){ }
  if(frm.content.value == ""){
		alert("내용을 입력하세요.");
		return false;
  }
  if (frm.vcode != undefined && (hex_md5(frm.vcode.value) != md5_norobot_key)) {
  	alert("자동등록방지코드를 정확히 입력해주세요.");
    frm.vcode.focus();
    return false;
	}
}
/*function set_WonComma2(price)
{
	if(price != null){
		price = price.replace(/,/gi,"");
		var pricelen = price.length;
		var ii = pricelen%3;
		var wonprice = price.substring(0,ii);
		for(;ii<pricelen;ii+=3){
			wonprice += "," + price.substring(ii,ii+3);
		}
		if((pricelen%3) == 0)
		wonprice = wonprice.substring(1,wonprice.length);
		return wonprice;
	}	
}*/
// 숫자 체크
function check_Num(tocheck)
{
	//if (tocheck == null || tocheck == "")
	//{
	//	return false;
	//}
	tocheck = tocheck.replace(/,/gi,"");
	for(var j = 0 ; j < tocheck.length; j++)
	{
		if ( tocheck.substring(j, j + 1) != "0"
			&&   tocheck.substring(j, j + 1) != "1"
			&&   tocheck.substring(j, j + 1) != "2"
			&&   tocheck.substring(j, j + 1) != "3"
			&&   tocheck.substring(j, j + 1) != "4"
			&&   tocheck.substring(j, j + 1) != "5"
			&&   tocheck.substring(j, j + 1) != "6"
			&&   tocheck.substring(j, j + 1) != "7"
			&&   tocheck.substring(j, j + 1) != "8"
			&&   tocheck.substring(j, j + 1) != "9" )
		{
			alert('아라비아 숫자만 입력해주세요.');
			return false;
		}
	}	
	return true;
}
-->
</script>
<form name="bbsFrm" id="bbsFrm" action="<?=$PHP_SELF?>" method="post" enctype="multipart/form-data" onSubmit="return bbsCheck(this)">
<input type="hidden" name="ptype" value="save">
<input type="hidden" name="code" value="<?=$code?>">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="idx" value="<?=$idx?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="searchopt" value="<?=$searchopt?>">
<input type="hidden" name="searchkey" value="<?=$searchkey?>">
<input type="hidden" name="tmp_vcode" value="<?=md5($norobot_key)?>">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" align="right" height="25"><font color="#000000">*</font> 표시는 필수입력 사항으로 글 작성시 반드시 기재해야 하는 항목입니다.</td>
  </tr>
  <tr>
    <td colspan="4" height="2" bgcolor="#a9a9a9"></td>
  </tr>
   <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>제목 *</strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><?=$catlist?><input name="subject" value="<?=$subject?>" type="text" size="60" class="input" /></td>
  </tr>
    <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <?=$hide_admin_start?>
  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>작성일</strong></td>
    <td align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;"><input name="wdate" value="<?=$wdate?>" type="text" size="20" class="input" /></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <?=$hide_admin_end?>
  <?=$hide_passwd_start?>
  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>비밀번호 *</strong></td>
  	<td align="left" colspan="3" style="padding-left:10px;"><input name="passwd" value="<?=$passwd?>" type="password" size="20" class="input" /> * 글 수정 삭제시 필요하시 꼭 기재해 주시기 바랍니다.</td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <?=$hide_passwd_end?>
  <tr>
    <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>기관명 *</strong></td>
    <td width="35%" align="left" colspan="3" style="padding-left:10px;"><input name="c_name" id="c_name" value="<?=$addinfo1[0]?>" type="text" size="60" class="input" /></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <tr>
	<tr>
		<td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:5px; border-right:1px solid #d7d7d7;"><strong>기관개요 *</strong></td>
		<td colspan="3">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td align="center" height="30" style="padding-left:10px;"><strong>● 설립년도&nbsp;:&nbsp;</strong></td>
				<td align="left" style="padding-left:5px;"><input name="c_est" value="<?=$addinfo1[1]?>" readonly id="c_est" type="text" size="20" class="input"></td>
				<td align="center" height="30"><strong>● 소재지&nbsp;:&nbsp;</strong></td>
				<td align="left" style="padding-left:5px;"><input name="address" id="address" value="<?=$address?>" type="text" size="20" class="input"></td>
			  </tr>
			  <tr>
				<td align="center" height="30" style="padding-left:10px;"><strong>● 기업형태&nbsp;:&nbsp;</strong></td>
				<td align="left" style="padding-left:5px;">
					<select class="select" name="c_type" id="c_type">
						<option value="">선택</option>
						<option value="1">중소기업</option>
						<option value="2">중견기업</option>
						<option value="3">대기업</option>
						<option value="4">대기업자회사</option>
						<option value="5">벤쳐기업</option>
						<option value="6">공공기관</option>
						<option value="7">외국계</option>
						<option value="8">비영리단체/협회/교육기관/재단</option>
					</select>
				</td>
				<td align="center" height="30" ><strong>● 사원수&nbsp;:&nbsp;</strong></td>
				<td align="left" style="padding-left:5px;"><input name="c_emp" id="c_emp" value="<?=$addinfo2[1]?>" type="text" size="20" class="input" />&nbsp;명</td>
			  </tr>
			  <tr>
				<td align="center" height="30" style="padding-left:10px;"><strong>● 홈페이지&nbsp;:&nbsp;</strong></td>
				<td align="left" style="padding-left:5px;"><input name="c_url" id="c_url" value="<?=$addinfo2[2]?>" type="text" size="20" class="input"></td>
				<td align="center" height="30" ><strong>● 매출액&nbsp;:&nbsp;</strong></td>
				<td align="left" style="padding-left:5px;"><input name="c_sales" id="c_sales" value="<?=$addinfo1[2]?>" type="text" size="20" class="input" />&nbsp;만원</td>
			  </tr>
			</table>
		</td>
	</tr>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
   <tr>
    <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>지원자격 *</strong></td>
    <td width="35%" align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center" height="30" style="padding-left:5px;"><strong>● 경력&nbsp;:&nbsp;</strong></td>
			<td align="left" style="padding-left:5px;"><input name="career" id="career" value="<?=$addinfo3[0]?>" placeholder="예) 신입 / 경력(0년)" type="text" size="20" class="input"></td>			
		</tr>
		<tr>
			<td align="center" height="30" style="padding-left:5px;"><strong>● 학력&nbsp;:&nbsp;</strong></td>
			<td align="left" style="padding-left:5px;"><input name="edu" id="edu" value="<?=$addinfo3[1]?>" placeholder="예) 고졸/대졸" type="text" size="20" class="input"></td>
		</tr>
		</table>
	</td>
    <td width="15%" align="center" bgcolor="#f9f9f9" style="padding-left:5px; border-right:1px solid #d7d7d7;"><strong>근무조건 *</strong></td>
    <td width="35%" align="left" style="padding-left:5px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td align="center" height="30" style="padding-left:5px;"><strong>● 급&nbsp&nbsp&nbsp여&nbsp&nbsp&nbsp&nbsp;:&nbsp;</strong></td>
				<td align="left" style="padding-left:5px;">
					<select class="select" id="addinfo9" name="addinfo9">
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
				</td>			
			</tr>
			<tr>
				<td align="center" height="30" style="padding-left:5px;"><strong>● 지&nbsp&nbsp&nbsp역&nbsp&nbsp&nbsp&nbsp;:&nbsp;</strong></td>
				<td align="left" style="padding-left:5px;">
					<select class="select" name="zipcode" id="zipcode">
						<option value="">선택</option>
						<option value="전국">전국</option>
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
				</td>
			</tr>
			<tr>
				<td align="center" height="30" style="padding-left:5px;"><strong>● 고용형태&nbsp;:&nbsp;</strong></td>
				<td align="left" style="padding-left:5px;">
					<select class="select" name="w_type" id="w_type">
						<option value="">선택</option>
						<option value="1">정규직</option>
						<option value="2">계약직</option>
						<option value="3">계약직 후 정규직</option>
						<option value="4">병역특례</option>
						<option value="5">인턴직</option>
						<option value="6">인턴 후 정규직</option>								
					</select>
				</td>
			</tr>
		</table>
	</td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <tr>
    <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>접수기간 *</strong></td>
    <td width="35%" align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;">
		<input name="sdate" id="sdate" value="<?=$addinfo3[2]?>" readonly type="text" size="15" class="input"/> ~ <input name="edate" id="edate" value="<?=$addinfo3[3]?>" readonly type="text" size="15" class="input"/>
	</td>
    <td width="15%" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>접수방법 *</strong></td>
    <td width="35%" align="left" style="padding-left:10px;"><input name="method" id="method" value="<?=$addinfo4[1]?>" type="text" size="30" class="input" /></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
   <tr>
    <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>근무시간</strong></td>
    <td width="35%" align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center" height="30" style="padding-left:5px;"><strong>● 평일&nbsp;:&nbsp;</strong></td>
			<td align="left" style="padding-left:5px;"><input name="w_time1" id="w_time1" value="<?=$addinfo4[3]?>" placeholder="예)09:00~15:00"  type="text" size="20" class="input"></td>			
		</tr>
		<tr>
			<td align="center" height="30" style="padding-left:5px;"><strong>● 주말&nbsp;:&nbsp;</strong></td>
			<td align="left" style="padding-left:5px;"><input name="w_time2" id="w_time2" value="<?=$addinfo4[4]?>" type="text" size="20" class="input"></td>
		</tr>
		</table>
	</td>
    <td width="15%" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>근무분야 *</strong></td>
    <td width="35%" align="left" style="padding-left:10px;">
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
	</td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>복리후생</strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><input name="addinfo5" id="addinfo5" value="<?=$addinfo5?>" type="text" size="60" class="input" /></td>
  </tr>
   <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <tr>
	 <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>담당자 *</strong></td>
	 <td width="35%" align="left" colspan="3" style="padding-left:5px;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
				<td align="center" height="30" style="padding-left:5px;"><strong>● 성&nbsp;&nbsp;&nbsp;명&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</strong></td>
				<td align="left" style="padding-left:5px;"><input name="name" value="<?=$name?>" type="text" size="20" class="input" /></td>
				<td align="center" height="30" style="padding-left:5px;"><strong>● E - mail&nbsp;&nbsp;:&nbsp;</strong></td>
				<td align="left" style="padding-left:5px;"><input name="email" value="<?=$email?>" type="text" size="20" class="input" /></td>
			  </tr>
			  <tr>
				<td align="center" height="30" style="padding-left:5px;"><strong>● 일반전화&nbsp;:&nbsp;</strong></td>
				<td align="left" style="padding-left:5px;"><input name="tphone" value="<?=$tphone?>" type="text" size="20" class="input"></td>
				<td align="center" height="30" style="padding-left:5px;"><strong>● 이동전화&nbsp;:&nbsp;</strong></td>
				<td align="left" style="padding-left:5px;"><input name="hphone" value="<?=$hphone?>" type="text" size="20" class="input" /></td>
			  </tr>
			</table>
	</td>
  </tr>
   <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <tr>
    <td colspan="4" align="center">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<td valign="top" align="left">
			<input type="checkbox" name="ctype" value="H" <?=$ctype_checked?>>HTML사용
			<input type="checkbox" name="privacy" value="Y" <?=$privacy_checked?>> 비밀글
			<?=$hide_notice_start?>
			<input type="checkbox" name="notice" value="Y" <?=$notice_checked?>> 공지글
			<?=$hide_notice_end?>
		</td>
		</tr>
		  <tr>
			<td colspan="4" height="4" bgcolor="#a9a9a9"></td>
		  </tr>
		  <tr>
			<td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>상세요강</strong></td>
		  <tr>
			<td colspan="4" height="2" bgcolor="#a9a9a9"></td>
		  </tr>
		<tr>
		<td align="left" valign="top">
			<?
			if($bbs_info[editor] == "Y"){
				$edit_content = $content;
				include WIZHOME_PATH."/webedit/WIZEditor.html";
			}else{?>
				<textarea name="content" cols="86" rows="13" class="input" style="width:100%;word-break:break-all;"><?=$content?></textarea>
			<?}?>
		</td>
		</tr>
		</table>
    </td>
  </tr>
  <tr>
     <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>

  <?
  for($ii=1;$ii<=5;$ii++){
  	echo ${"hide_upfile".$ii."_start"};
  ?>
  <tr>
    <td align="center"height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>첨부파일<?=$ii?></strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><input type="file" name="upfile<?=$ii?>" size="20" class="input" /> <?=${"upfile".$ii}?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <?
		echo ${"hide_upfile".$ii."_end"};
	}
	?>

  <?
  for($ii=1;$ii<=3;$ii++){
  	echo ${"hide_movie".$ii."_start"};
  	if($ii == 1) $input_type = "file";
  	else $input_type = "text";
  ?>
  <tr>
    <td align="center"height="30" colspan="1" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>동영상<?=$ii?></strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><input type="<?=$input_type?>" name="movie<?=$ii?>" size="20" class="input" /> <?=${"movie".$ii}?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <?
		echo ${"hide_movie".$ii."_end"};
	}
	?>

	<?=$hide_spam_check_start?>
	<tr>
    <td align="center"height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>자동등록방지</strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><?=$spam_check?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
	<?=$hide_spam_check_end?>

</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" style="padding-top:10px"><?=$list_btn?></td>
    <td align="right"><?=$confirm_btn?>&nbsp;<?=$cancel_btn?></td>
  </tr>
</table>
</form>