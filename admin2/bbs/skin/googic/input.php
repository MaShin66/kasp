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
	//희망근무지 selectbox 
	$("#zipcode").val("<?=$zipcode?>");
	$("#gender").val("<?=$addinfo1[1]?>");
	$("#w_type").val("<?=$addinfo2[1]?>");
	$("#w_field").val("<?=$addinfo2[0]?>");

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
	//input[id*='period']	
  $('#eadd').click(function(){
	  //edutable 에서 tr 요소의 id 가 addtr이 들어있는 요소의 length
		var edu = $("#edutable tr[id*='addtr']").length;

		if(edu>5){
			alert('학력추가를 더이상 할수없습니다.');
		} else {
			if(edu > 2){
					$('#removeline'+(edu-1)).css('visibility','hidden');
				}
			//학력사항 갯수 체크 
			$('#educhk').val(edu);
			$('#addtr'+(edu-1)).after(				
				"<tr id='line"+edu+"'><td colspan='5' height='1' bgcolor='#d7d7d7'></td></tr>"+
				"<tr height='30' id='addtr"+edu+"'>"+
				"<td align='left' style='padding-left:5px;border-right:1px solid #d7d7d7;'><input name='period"+edu+"_1' id='period"+edu+"_1' onClick='datepic(this)' readonly type='text' size='10' class='input'/> ~ <input name='period"+edu+"_2' id='period"+edu+"_2' onClick='datepic(this)' readonly type='text' size='10' class='input'/></td>"+
				"<td align='left' style='padding-left:5px;border-right:1px solid #d7d7d7;'><input name='s_name"+edu+"' id='s_name"+edu+"' type='text' size='15' class='input'></td>"+
				"<td align='left' style='padding-left:5px;border-right:1px solid #d7d7d7;'><input name='s_area"+edu+"' id='s_area"+edu+"' type='text' size='10' class='input'></td>"+
				"<td align='left' style='padding-left:5px;border-right:1px solid #d7d7d7;'><input name='major"+edu+"' id='major"+edu+"' type='text' size='10' class='input'></td>"+
				"<td align='left' style='padding-left:5px;border-right:1px solid #d7d7d7;'><input name='score"+edu+"_1' id='score"+edu+"_1' type='text' size='5' class='input'> / <input name='score"+edu+"_2' id='score"+edu+"_2' type='text' size='5' class='input'>&nbsp;<img id='removeline"+edu+"' width='12' height='12' onClick=trremove('addtr"+edu+"','line"+edu+"') style='cursor:hand' src='<?=$skin_dir?>/image/btn_minus.png'/></td></tr>"
			);
		}
  });
});

function datepic(obj){ 	
	$(obj).datepicker({
		changeMonth: true, 
        changeYear: true,
        yearRange: 'c-100:c+10',
		minDate: '-100y', 
		nextText: '다음 달',
         prevText: '이전 달',
		 closeText: '닫기',
		 dateFormat: "yy-mm-dd"
	}).datepicker("show");
}
//tr 제거 function 해당 객체를 지운 후 바로 상위 객체의 removeline을 hidden => show
function trremove(obj,line){
	var num = obj.charAt(obj.length-1);
	num--;
	//학력사항 갯수 체크
	$('#educhk').val($('#educhk').val()-1);
	$('#'+obj).remove();
	$('#'+line).remove();
	$('#removeline'+num).css('visibility','visible');
}
<!--
function bbsCheck(frm){

  if(frm.name.value == ""){
    alert("작성자를 입력하세요.");
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
  try{ content1.outputBodyHTML(); } catch(e){ }
  if(frm.content1.value == ""){
		alert("경력사항을 입력하세요.");
		frm.content1.focus();
		return false;
  }
  try{ content2.outputBodyHTML(); } catch(e){ }
  if(frm.content2.value == ""){
		alert("자기소개서을 입력하세요.");
		frm.content2.focus();
		return false;
  }
  if(frm.h_salary.value == ""){
	alert("희망연봉을 입력하세요.");
	frm.h_salary.focus();
	return false;
  }
  if(frm.gender.value == ""){
	alert("성별을 선택하세요.");
	frm.gender.focus();
	return false;
  }
  if(frm.zipcode.value == ""){
	alert("희망근무지를 선택하세요.");
	frm.zipcode.focus();
	return false;
  }
  if(frm.w_field.value == ""){
	alert("지원분야를 선택하세요.");
	frm.w_field.focus();
	return false;
  }
  if(frm.career.value == ""){
	alert("경력을 입력하세요.");
	frm.career.focus();
	return false;
  }
  if(frm.w_type.value == ""){
	alert("근무형태를 선택하세요.");
	frm.w_type.focus();
	return false;
  }
  if (frm.vcode != undefined && (hex_md5(frm.vcode.value) != md5_norobot_key)) {
  	alert("자동등록방지코드를 정확히 입력해주세요.");
    frm.vcode.focus();
    return false;
	}

}

// 숫자 체크
function check_Num(tocheck)
{
	//if (tocheck == null || tocheck == "")
	//{
	//	return false;
	//}
	tocheck = tocheck.replace(".","");
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
  <tr>
    <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>작성자 *</strong></td>
    <td width="35%" align="left" colspan="3"  style="padding-left:10px;"><input name="name" value="<?=$name?>" type="text" size="20" class="input" /></td>
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
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>거주지</strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><input name="address" id="address" value="<?=$address?>" type="text" size="60" class="input" /></td>
  </tr>
    <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <tr>
    <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>생년월일</strong></td>
    <td width="35%" align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;"><input name="birth" id="birth" onClick="datepic(this)" readonly value="<?=$addinfo1[0]?>" type="text" size="20" class="input" /></td>
    <td width="15%" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>성별 *</strong></td>
    <td width="35%" align="left" style="padding-left:10px;">
		<select class="select" name="gender" id="gender">
			<option value="">선택</option>
			<option value="1" <?if($addinfo[1]=="1") echo "selected";?>>남</option>
			<option value="2" <?if($addinfo[1]=="2") echo "selected"?>>여</option>
		</select>
	</td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  
 <tr>
    <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>연락처</strong></td>
    <td width="35%" align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center" height="30" style="padding-left:5px;"><strong>● 일반전화&nbsp;:&nbsp;</strong></td>
			<td align="left" style="padding-left:5px;"><input name="tphone" id="tphone" value="<?=$tphone?>" type="text" size="20" class="input"></td>			
		</tr>
		<tr>
			<td align="center" height="30" style="padding-left:5px;"><strong>● 이동전화&nbsp;:&nbsp;</strong></td>
			<td align="left" style="padding-left:5px;"><input name="hphone" id="hphone" value="<?=$hphone?>" type="text" size="20" class="input"></td>
		</tr>
		<tr>
			<td align="center" height="30" style="padding-left:5px;"><strong>● E - mail&nbsp;:&nbsp;</strong></td>
			<td align="left" style="padding-left:5px;"><input name="email" id="email" value="<?=$email?>" type="text" size="20" class="input"></td>
		</tr>
		</table>
	</td>
    <td width="15%" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>경력 *</strong></td>
    <td width="35%" align="left" style="padding-left:10px;"><input name="career" id="career" value="<?=$addinfo1[2]?>" placeholder="예) 신입 / 경력 (0년)"  type="text" size="20" class="input"></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
   
  <tr>
    <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>근무형태 *</strong></td>
    <td width="35%" align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;">
		<select class="select" name="w_type" id="w_type">
			<option value="">선택</option>
			<option value="0">무관</option>
			<option value="1">정규직</option>
			<option value="2">계약직</option>
			<option value="3">계약직 후 정규직 전환</option>
			<option value="4">병역특례</option>
			<option value="5">인턴직</option>
			<option value="6">인턴 후 정규직 전환</option>								
		</select>
	</td>
    <td width="15%" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>희망근무지 *</strong></td>
    <td width="35%" align="left" style="padding-left:10px;">
		<select class="select" name="zipcode" id="zipcode">
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
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
    <tr>
    <td width="15%" height="30" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>지원분야 *</strong></td>
    <td width="35%" align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;">
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
    <td width="15%" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>희망연봉 *</strong></td>
	<td align="left" style="padding-left:5px;"><input name="h_salary" id="h_salary" value="<?=$addinfo2[2]?>" type="text" size="20" class="input"></td>
  </tr> 
   <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
    <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>특기사항</strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><input name="addinfo3" id="addinfo3" value="<?=$addinfo3?>" type="text" size="60" class="input" /></td>
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
			<td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>학력사항</strong></td>
		  </tr>
		  <tr>
			<td colspan="4" height="2" bgcolor="#a9a9a9"></td>
		  </tr>
		<tr>
		<td align="left" valign="top">
			<table width="100%" id="edutable" cellspacing="0" cellpadding="0" style="border:1px solid #d7d7d7;">
				<tr height="30" id="addtr">
					<th style="padding-left:10px; border-right:1px solid #d7d7d7;width:28%">재학기간</th>
					<th style="padding-left:10px; border-right:1px solid #d7d7d7;">학교명</th>
					<th style="padding-left:10px; border-right:1px solid #d7d7d7;">소재지</th>
					<th style="padding-left:10px; border-right:1px solid #d7d7d7;">전공</th>
					<th style="padding-left:10px;width:20%;">학점</th>
				</tr>
				 <tr>
					<td colspan="5" height="1" bgcolor="#d7d7d7"></td>
	 			  </tr>
				  <?
				  if($mode == 'modify'){
					  echo "<input type='hidden' id='educhk' name='educhk' value='".sizeof($addinfo6)."'/>";
					  for($i =1; $i<=sizeof($addinfo6); $i++){
						$eduinfo = explode("/+googic+/",$addinfo6[$i-1]);
						echo "<tr height='30' id='addtr".$i."'>";
						echo "<td align='left' style='padding-left:5px;border-right:1px solid #d7d7d7;'>";
						echo "<input name='period".$i."_1' id='period".$i."_1' onClick='datepic(this)' readonly type='text' size='10' class='input' value='$eduinfo[0]'> ~ ";
						echo "<input name='period".$i."_2' id='period".$i."_2' onClick='datepic(this)' readonly type='text' size='10' class='input' value='$eduinfo[1]'>";
						echo "</td>";
						echo "<td align='left' style='padding-left:5px;border-right:1px solid #d7d7d7;'><input name='s_name".$i."' id='s_name".$i."' type='text' size='15' class='input' value='$eduinfo[2]'></td>";
						echo "<td align='left' style='padding-left:5px;border-right:1px solid #d7d7d7;'><input name='s_area".$i."' id='s_area".$i."' type='text' size='10' class='input' value='$eduinfo[3]'></td>";
						echo "<td align='left' style='padding-left:5px;border-right:1px solid #d7d7d7;'><input name='major".$i."' id='major".$i."' type='text' size='10' class='input' value='$eduinfo[4]'></td>";
						echo "<td align='left' style='padding-left:5px;'><input name='score".$i."_1' id='score".$i."_1' type='text' size='5' class='input' value='$eduinfo[5]'> / <input name='score".$i."_2' id='score".$i."_2' type='text' size='5' class='input' value='$eduinfo[6]'>&nbsp;";
						
						if($i > 1 && $i !=sizeof($addinfo6)){
							echo "<img id='removeline".$i."' width='12' height='12' onClick=trremove('addtr".$i."','line".$i."') style='cursor:hand;visibility:hidden;' src='$skin_dir/image/btn_minus.png'/>";
						} elseif ($i == sizeof($addinfo6) && $i != 1 ) {
							echo "<img id='removeline".$i."' width='12' height='12' onClick=trremove('addtr".$i."','line".$i."') style='cursor:hand;' src='$skin_dir/image/btn_minus.png'/>";
						}
						echo "</td>";
						echo "</tr>";
						if($i != sizeof($addinfo6))echo "<tr id='line".($i+1)."'><td colspan='5' height='1' bgcolor='#d7d7d7'></td></tr>";
					  }

				  } else {
				 ?>		
				<!--학력사항 tr 시작-->
				<tr height="30" id="addtr1">
					<input type="hidden" id="educhk" name="educhk" value="1"/>
					<td align="left" style="padding-left:5px;border-right:1px solid #d7d7d7;">
						<input name="period1_1" id="period1_1" onClick="datepic(this)" readonly type="text" size="10" class="input">
						~
						<input name="period1_2" id="period1_2" onClick="datepic(this)" readonly type="text" size="10" class="input">
					</td>
					<td align="left" style="padding-left:5px;border-right:1px solid #d7d7d7;"><input name="s_name1" id="s_name1" type="text" size="15" class="input"></td>
					<td align="left" style="padding-left:5px;border-right:1px solid #d7d7d7;"><input name="s_area1" id="s_area1" type="text" size="10" class="input"></td>
					<td align="left" style="padding-left:5px;border-right:1px solid #d7d7d7;"><input name="major1" id="major1" type="text" size="10" class="input"></td>
					<td align="left" style="padding-left:5px;border-right:1px solid #d7d7d7;">
					<input name="score1_1" id="score1_1" type="text" size="5" class="input"> / <input name="score1_2" id="score1_2" type="text" size="5" class="input">
					</td>
				</tr>
				<!--학력사항 tr 끝-->
				 <?}?>
				  <tr>
					<td colspan="5" height="1" bgcolor="#d7d7d7"></td>
	 			  </tr>
				 <tr>
					<td align="right" colspan="5"><b id="eadd" style="cursor:hand">학력추가&nbsp;<img width="12" height="12" src='<?=$skin_dir?>/image/btn_plus.png'/></b>&nbsp;&nbsp;</td>
	 			</tr>
			</table>
		</td>
		</tr>
		 <tr>
			<td colspan="4" height="4" bgcolor="#a9a9a9"></td>
		  </tr>
		  <tr>
			<td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>경력사항</strong></td>
		  </tr>
		  <tr>
			<td colspan="4" height="2" bgcolor="#a9a9a9"></td>
		  </tr>
		<tr>
		<td align="left" valign="top">
			<?
			if($bbs_info[editor] == "Y"){
				$edit_name = "content1";
				$edit_content = $content[0];
				include WIZHOME_PATH."/webedit/WIZEditor.html";
			}else{?>
				<textarea name="content1" id="content1" cols="86" rows="13" class="input" style="width:100%;word-break:break-all;"><?=$content[0]?></textarea>
			<?}?>
		</td>
		</tr>
		  <tr>
			<td colspan="4" height="4" bgcolor="#a9a9a9"></td>
		  </tr>
		  <tr>
			<td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>자기소개서</strong></td>
		  </tr>
		  <tr>
			<td colspan="4" height="2" bgcolor="#a9a9a9"></td>
		  </tr>
		<tr>
		<td align="left" valign="top">
			<?
			if($bbs_info[editor] == "Y"){
				$edit_name = "content2";
				$edit_content = $content[1];
				include WIZHOME_PATH."/webedit/WIZEditor.html";
			}else{?>
				<textarea name="content2" id="content2" cols="86" rows="13" class="input" style="width:100%;word-break:break-all;"><?=$content[1]?></textarea>
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
