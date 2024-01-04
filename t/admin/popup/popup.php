<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";

$sql = "select title,linkurl,content from wiz_popup where idx = '$idx'";
$result = mysql_query($sql);
$popup_info = mysql_fetch_array($result);

if($popup_info[linkurl]) {
	$popup_info[linkurl] = "onclick=self.close();opener.document.location='$popup_info[linkurl]'; style='cursor:pointer'";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?=$popup_info[title]?></title>
<style>
p { margin-top: 0px; margin-bottom: 0px }
td { font-size:12px; font-family:"굴림","돋움"; color:#4A4A4A; line-height:160% }
</style>
<script language="javascript">
<!--
function popupClose(){
  setCookie("popupDayClose<?=$idx?>", "true", 1);
  self.close();
}

function setCookie( name, value, expiredays )
{
  var todayDate = new Date();
  todayDate.setDate( todayDate.getDate() + expiredays );
  document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
}
//-->
</script>
</head>
<body topmargin="0" leftmargin="0">

<table border="0" width="100%" cellpadding="0" cellspacing="0" <?=$popup_info[linkurl]?>>
<tr><td><?=$popup_info[content]?></td></tr>
</table>

<table width="100%" height="25" bgcolor="#909090" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right"><font color=#ffffff>오늘하루 열지않음</font> <input type="checkbox" onClick="popupClose();">&nbsp; </td>
  </tr>
</table>

</body>
</html>
