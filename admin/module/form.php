<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";

// 폼메일정보
$sql = "select * from wiz_forminfo where code = '$code'";
$result = mysql_query($sql) or error(mysql_error());
$total = mysql_num_rows($result);

// 생성되지 않은 폼메일인경우
if($total <= 0){
	$msg = "<font color=red><b>".$code."</b></font> 폼메일은 아직 생성되지 않았습니다.";
	echo "<table align=center><tr><td height=25>&nbsp;&nbsp;".$msg."&nbsp;&nbsp;</td></tr></table>";
} else {
	if($ptype == "" || $ptype == "form") include "$_SERVER[DOCUMENT_ROOT]/admin/form/input.php";
	else if($ptype == "save") include "$_SERVER[DOCUMENT_ROOT]/admin/form/save.php";
}
?>
