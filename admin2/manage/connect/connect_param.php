<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>

<?
if($save != "true"){
	
// 분석할 파라메터 가져오기
$sql = "select con_parameter from wiz_siteinfo";
$result = mysql_query($sql) or error(mysql_error());
$row = mysql_fetch_object($result);

?>
<html>
<head>
<title>:: 분석파라미터 설정 ::</title>
<link href="../wiz_style.css" rel="stylesheet" type="text/css">
</head>

<table width="100%"cellpadding=10 cellspacing=0><tr><td>
	
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td class="tit_sub"><img src="../image/ics_tit.gif"> 분석파라미터 설정</td>
  </tr>
</table>
<table width="100%"cellpadding=2 cellspacing=1 class="t_style">
<form name="frm" action="<?=$PHP_SELF?>" method="post">
<input type="hidden" name="save" value="true">
  <tr>
    <td class="t_name" align="center" height=35 width=100>분석파라미터</td>
    <td class="t_value">&nbsp; 
      <input type="text" name="parameter" value="<?=$row->con_parameter?>" size="55" class="input">
      <input type="image" align="absmiddle" src="../image/btn_confirm_s.gif"></td>
  </tr>
</form>
</table>
<br>
<table width="100%" border="0" cellpadding="2" cellspacing="6" class="e_style">
  <tr>
    <td bgcolor="ffffff">
    &nbsp;각 검색엔진 별로 분석해야할 파라미터 명이 다릅니다.<br>
    &nbsp;ex) 네이버에서 "아디다스"로 검색한경우 상단 주소는 다음과 같습니다.<br>
    &nbsp;http://search.naver.com/search.naver?where=nexearch&<font color='red'><b>query</b></font>=%BE%C6%B5%F0%B4%D9%BD%BA&frm=t1<br>
    &nbsp;이경우 분석해야할 파라메터는 <font color='red'><b>query</b></font>가 됩니다.<br>
    &nbsp;위의 분석파라메터에 각 파라메터를 컴마로 구분하여 저정하시면 됩니다.<br>
    </td>
  </tr>
</table>

</td></tr></table>
</body>
</html>
<?
}else{
	
	$sql = "update wiz_siteinfo set con_parameter = '$parameter'";
	$result = mysql_query($sql) or error(mysql_error());
	
	complete("적용되었습니다.","$PHP_SELF");
	
}
?>
