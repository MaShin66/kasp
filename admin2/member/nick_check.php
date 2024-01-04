<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin2/inc/mem_info.php";

$sql = "select nick from wiz_member where nick='$nick'";
$result = mysql_query($sql) or error(mysql_error());
$total = mysql_num_rows($result);

if($nick != ""){
	if($total > 0){
		$checkmsg = "<font color=#00BCBC><b>".$nick."</b></font> 는 이미 사용중인 닉네임 입니다.";
	} else{
		$checkmsg = "<font color=#00BCBC><b>".$nick."</b></font> 는 사용가능한 닉네임 입니다. <a href='javascript:setNick();'><img src='".$skin_dir."/image/bt_nick_ok.gif' align='absmiddle' border='0'></a>";
	}
}else{
	$checkmsg = "사용하고자 하는 닉네임을 입력하세요";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>:: 닉네임 중복 체크 ::</title>
<link href="<?=$skin_dir?>/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="/admin2/js/lib.js"></script>
<script language="JavaScript">
<!--
// 입력값 체크
function nickCheck(frm){

	if(frm.nick.value.length < 3 || frm.nick.value.length > 12){
		alert("닉네임은 3 ~ 12자리만 가능합니다.");
		frm.nick.focus();
		return false;
	}

}

// 닉네임 입력폼으로 전송
function setNick(){

	var frm;
	for(i=0;i<opener.document.forms.length;i++){
		frm = opener.document.forms[i];
		if(frm.nick){
			frm.nick.value = '<?=$nick?>';
		}
	}
	self.close();

}
//-->
</script>
</head>
<body onLoad="document.frm.nick.focus();" topmargin="0" leftmargin="0">

<? include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/nick_check.php"; ?>

</body>
</html>
