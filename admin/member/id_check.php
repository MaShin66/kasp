<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin/inc/mem_info.php";

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
		$checkmsg = "<p class='id_txt'> <em>".$id."</em> 는 이미 사용중인 아이디 입니다.</p>";
	} else if($total2 + $total3 > 0) {
		$checkmsg = "<p class='id_txt'> <em>".$id."</em> 는 사용할 수 없는 아이디 입니다.</p>";
	} else{
		$checkmsg = "<p class='id_txt'> <em>".$id."</em> 는 사용가능한 아이디 입니다. <a href='javascript:setId();'>사용하기</a></p>";
	}
}else{
	$checkmsg = "<p class='none_id'>사용하고자 하는 아이디를 입력하세요</p>";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>:: 아이디 중복 체크 ::</title>
<link href="<?=$skin_dir?>/style.css" rel="stylesheet" type="text/css">
<link href="/common/css/layout.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="/admin/js/lib.js"></script>
<script language="JavaScript">
<!--
// 입력값 체크
function idCheck(frm){

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
	opener.joinFrm.id.value = '<?=$id?>';
	opener.joinFrm.passwd1.focus();
	self.close();
}
//-->
</script>
</head>
<body onLoad="document.frm.id.focus();" topmargin="0" leftmargin="0">

<? include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/id_check.php"; ?>

</body>
</html>
