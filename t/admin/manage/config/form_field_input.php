<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";

if(!empty($idx)) $sub_mode = "update";
else $sub_mode = "insert";

$sql = "select count(idx) as cnt from wiz_formfield where fidx = '$fidx' and ftype = 'spamcheck'";
$result = mysql_query($sql) or error(mysql_error());
$row = mysql_fetch_array($result);
$spam_total = $row[cnt];

$sql = "select * from wiz_formfield where idx = '$idx' order by fprior asc";
$result = mysql_query($sql) or error(mysql_error());
$row = mysql_fetch_array($result);

$flist = explode("|", $row[flist]);

if($row[fnum] <= 0 && count($flist) > 0 && !empty($row[flist])) { $row[fnum] = count($flist);}

?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>폼메일 설정</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../wiz_style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../../js/lib.js"></script>
<script language="JavaScript">
<!--

  var flist_array = new Array();
<?php
for($ii = 0; $ii < count($flist); $ii++) {
	if(!empty($flist[$ii])) {
?>
	flist_array[<?=$ii?>] = "<?=$flist[$ii]?>";
<?php
	}
}
?>

// 입력값 체크
function formCheck(frm){
   if(frm.fname.value == ""){
      alert('이름을 입력하세요.');
      frm.fname.focus();
      return false;
   }

   if(frm.fsize.value != "" && !check_Num(frm.fsize.value)){
      alert('항목사이즈는 숫자만 입력하세요.');
      frm.fsize.focus();
      return false;
   }

  <? if($spam_total > 0 && strcmp($row[ftype], "spamcheck")) { ?>

	if(frm.ftype.value == "spamcheck") {
		alert("스팸글체크는 폼메일당 한 항목만 등록가능합니다.");
		frm.ftype.focus();
		return false;
	}

	<? } ?>

}

function flist() {

	var length = document.frm.fnum.value;
	var tmp = '';

	if(!length || length <= 0)
	{
		length = 1;
		document.frm.fnum.value = 1;
	}
	else if(length > 20)
	{
		length = 20;
		document.frm.fnum.value = 20;
	}

	for(i=1; i<=length; i++)
	{
		var ii = i - 1;
		if(flist_array[ii] == undefined) flist_array[ii] = "";
		tmp += " &nbsp; " + i + " <input type=\"text\" name=\"flist[]\" value=\"" + flist_array[ii] + "\" class=\"input\"><br>";
	}
	document.getElementById('flist_layer').innerHTML = tmp;

}

function setOpt() {

	var opt = document.frm.ftype.value;

	document.getElementById('size').style.display = "block";
	document.getElementById('num').style.display = "block";
	document.getElementById('opt').style.display = "block";

	//사이즈 - test, textarea, file
	if(opt == "text" || opt == "textarea" || opt == "file") {
		document.getElementById('size').style.display = "block";
	}
	//옵션 갯수 - select, radio, checkbox
	if(opt == "select" || opt == "radio" || opt == "checkbox") {
		document.getElementById('num').style.display = "block";
		document.getElementById('opt').style.display = "block";
	}
}
//-->
</script>
</head>

<body onload="flist();setOpt();">

<table width="100%" cellpadding=10 cellspacing=0><tr><td>

<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td class="tit_sub"><img src="../image/ics_tit.gif"> 폼메일 설정</td>
  </tr>
</table>

<form name="frm" action="form_save.php" method="post" enctype="multipart/form-data" onSubmit="return formCheck(this)">
	<input type="hidden" name="mode" value="field">
	<input type="hidden" name="sub_mode" value="<?=$sub_mode?>">
	<input type="hidden" name="idx" value="<?=$idx?>">
	<input type="hidden" name="fidx" value="<?=$fidx?>">
	<input type="hidden" name="code" value="<?=$code?>">
	<table width="100%"cellpadding=2 cellspacing=1 class="t_style">
	  <tr>
		<td width="90" align="left" class="t_name">&nbsp; 항목명</td>
		<td class="t_value">&nbsp;
			<input name="fname" type="text" value="<?=$row[fname]?>" size="12" class="input">
			<input name="fessen" type="checkbox" value="Y" <? if($row[fessen] == "Y") echo "checked"; ?>>필수
		  </td>
	  </tr>
	  <tr>
		<td align="left" class="t_name">&nbsp; 항목이미지</td>
		<td class="t_value">&nbsp;
			<input name="fimg" type="file" class="input">
	<?php
	if(img_type(WIZHOME_PATH."/data/form/title/".$row[fimg])) {
	?>
		<img src="/admin/data/form/title/<?=$row[fimg]?>" align="absmiddle">
		<a href="form_save.php?mode=field&sub_mode=delimg&fidx=<?=$row[fidx]?>&code=<?=$code?>&idx=<?=$row[idx]?>"><font color="red">[삭제]</font></a>
	<?php
	}
	?>
		  </td>
	  </tr>
	  <tr>
		<td align="left" class="t_name">&nbsp; 항목속성</td>
		<td class="t_value">&nbsp;
		  <select name="ftype" onChange="setOpt()">
		  <option value="text">text</option>
		  <option value="select">select</option>
		  <option value="radio">radio</option>
		  <option value="checkbox">checkbox</option>
		  <option value="textarea">textarea</option>
		  <option value="file">file</option>
		  <option value="name">이름</option>
		  <option value="tel">전화번호</option>
		  <option value="phone">휴대전화번호</option>
		  <option value="email">이메일</option>
		  <option value="pdate">일자(달력)</option>
		  <option value="tdate">년월일시</option>
		  <option value="birthday">생년월일</option>
		  <option value="address">주소찾기</option>
		  <option value="spamcheck">스팸글체크</option>
		  </select>
		  <script language="javascript">
		  <!--
		   ftype = document.frm.ftype;
		   var tmp = "";
		   for(ii=0; ii<ftype.length; ii++){
			  if(ftype.options[ii].value == "<?=$row[ftype]?>") {
				ftype.options[ii].selected = true;
				tmp = ftype.options[ii].value;
			  }
		   }
		  -->
		  </script>
		  </td>
	  </tr>
	  <tr id="size" style="display:none">
		<td align="left" class="t_name">&nbsp; 항목사이즈</td>
		<td class="t_value">&nbsp;
			<input name="fsize" type="text" value="<?=$row[fsize]?>" size="9" class="input">
		  </td>
	  </tr>
	  <tr id="num" style="display:none">
		<td align="left" class="t_name">&nbsp; 세부항목 개수</td>
		<td class="t_value">&nbsp;
			<select name="fnum" onChange="flist();">
			<? for($ii=1;$ii<21;$ii++){ ?>
			<option value="<?=$ii?>" <? if($row[fnum] == $ii) echo "selected"; ?>><?=$ii?></option>
			<? } ?>
			<select>
		  </td>
	  </tr>
	  <tr id="opt" style="display:none">
		<td align="left" class="t_name">&nbsp; 세부항목</td>
		<td class="t_value">
			<span id='flist_layer'></span>
		  </td>
	  </tr>
	  <!--tr>
		<td align="left" class="t_name">&nbsp; 순서</td>
		<td class="t_value">&nbsp;
			<input name="fprior" type="text" value="<?=$row[fprior]?>" size="9" class="input">
			(숫자가 작을수록 먼저 나옵니다.)
		  </td>
	  </tr-->
	</table>
	<input type="checkbox" name="continue" value="Y" checked> 계속 등록하기
	<br>
	
	<table border=0 cellpadding=0 cellspacing=0 width=100% align=center>
		<tr>
		  <td align="center">
			<input type="image" src="../image/btn_confirm_l.gif"> &nbsp;
			<img src="../image/btn_close_l.gif" style="cursor:hand" onClick="self.close()">
		  </td>
		</tr>
	</table>
	</form>

<table width="100%" border="0" cellpadding="0" cellspacing="6">
  <tr>
    <td>- 항목이미지 </td><td>: 항목명(텍스트)대신 업로드한 이미지가 항목 이름부분에 노출됩니다.</td>
  </tr>
  <tr>
    <td>- 항목사이즈 </td><td>: 항목의 크기를 정합니다. 예) &lt;input size="항목사이즈"></td>
  </tr>
  <tr>
    <td><font color=red>- 항목속성</font> </td>
    <td>
    	<font color=red>
    	: 이름을 입력받을때 text 가아닌 "이름"을 선택하시면 "관리자 > 폼메일" 목록에 보여집니다.<br>
    	&nbsp; 이메일,연락처도 목록에 보여집니다.
      </font>
    </td>
  </tr>
  <tr><td height="5"></td></tr>
  <tr>
    <td colspan="2"><b>예제)</b></td>
  </tr>
  <tr>
    <td>세부항목 개수 </td><td>: 3</td>
  </tr>
  <tr>
    <td>세부항목 </td><td>: 1 - 가 2 - 나 3 - 다</td>
  </tr>
  <tr>
  	<td colspan="2">
			<table width="100%" cellpadding=2 cellspacing=1 class="t_style">
				<tr>
					<td width="100" class="t_name">항목속성 : text </td>
					<td class="t_value">&nbsp;<input type="text" size="3" class="input">가 <input type="text" size="3" class="input">나 <input type="text" size="3" class="input">다</td>
				</tr>
				<tr>
					<td class="t_name">항목속성 : select</td>
					<td class="t_value">&nbsp;<select> <option>--</option> <option>가</option> <option>나</option> <option>다</option> </select></td>
				</tr>
				<tr>
					<td class="t_name">항목속성 : radio</td>
					<td class="t_value">&nbsp;<input type="radio"> 가 <input type="radio"> 나 <input type="radio"> 다</td>
				</tr>
			</table>
  	</td>
  </tr>
</table>
</td></tr></table>
</body>
</html>
