<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin2/inc/mem_info.php";

$sql = "select id from wiz_member where id='$id'";
$result = mysql_query($sql) or error(mysql_error());
$total = mysql_num_rows($result);

$sql = "select id from wiz_admin where id = '$id'";
$result = mysql_query($sql) or error(mysql_error());
$total2 = mysql_num_rows($result);

$sql = "select designer_id from wiz_siteinfo where designer_id  = '$id' or anywiz_id = '".md5($id)."'";
$result = mysql_query($sql) or error(mysql_error());
$total3 = mysql_num_rows($result);

if($id != ""){
	if($total > 0){
		$checkmsg = "<font color=#00BCBC><b>".$id."</b></font> 는 이미 사용중인 아이디 입니다.";
	} else if($total2 + $total3 > 0) {
		$checkmsg = "<font color=#00BCBC><b>".$id."</b></font> 는 사용할 수 없는 아이디 입니다.";
	} else{
		$checkmsg = "<font color=#00BCBC><b>".$id."</b></font> 는 사용가능한 아이디 입니다. <img src='../image/btn_use.gif' align='absmiddle' style='cursor:hand' onClick='setId();'>";
	}
}else{
	$checkmsg = "사용하고자 하는 아이디를 입력하세요";
}
?>
<html>
<head>
<title>아이디 중복체크</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../wiz_style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../../js/lib.js"></script>
<script language="JavaScript">
<!--

// 입력값 체크
function inputCheck(frm){

	if(frm.id.value.length < 3 || frm.id.value.length > 12){
		alert("아이디는 3 ~ 12자리만 가능합니다.");
		frm.id.focus();
		return false;
	}else{
		if(!check_Char(frm.id.value)){
			alert("아이디는 특수문자를 사용할수 없습니다.");
			frm.id.focus();
			return false;
		}
   }

}
// 아이디 입력폼으로 전송
function setId(){
	opener.frm.<?=$name?>.value = '<?=$id?>';
	self.close();
}
//-->
</script>
</head>

<body onLoad="document.frm.id.focus();">

<table width="100%" cellpadding=10 cellspacing=0><tr><td>


<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td class="tit_sub"><img src="../image/ics_tit.gif"> 아이디검색</td>
  </tr>
</table>
<table width="100%"cellpadding=2 cellspacing=1 class="t_style">
<form name="frm" method="post" action="<?=$PHP_SELF?>" onSubmit="return inputCheck(this)">
	<input type=hidden name=name value="<?=$name?>">
  <tr>
    <td width="100" class="t_name">아이디</td>
    <td class="t_value">
    	<table width="100%"cellpadding=0 cellspacing=0>
    		<tr>
    			<td><input type="text" name="id" class="input" size="20" value="<?=$id?>"></td>
      		<td><input type="image" src="../image/btn_search.gif"></td>
      	</tr>
      </table>
    </td>
  </tr>
</form>
</table>
<br>

<table border=0 cellpadding=2 cellspacing=0 width=100% bgcolor=#ffffff align=center>
	<tr>
	  <td colspan="2" align="center"><?=$checkmsg?></td>
	</tr>
</table>

</td></tr></table>
</body>
</html>
