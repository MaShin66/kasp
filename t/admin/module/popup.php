<? include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php"; ?>

<!--                ### 팝업 시작 ###            -->
<script language="javascript">
<!--
function readCookie(cookiename)
{
 var Found = false;

 cookiedata = document.cookie;
 if ( cookiedata.indexOf(cookiename) >= 0 ){
   Found = true;
 }

 return Found;
}

function setCookie( name, value, expiredays )
{
 var todayDate = new Date();
 todayDate.setDate( todayDate.getDate() + expiredays );
 document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
}
//-->
</script>
<?
$today = date('Y-m-d');
$sql = "select idx,scroll,posi_x,posi_y,size_x,size_y,popup_type,linkurl,content from wiz_popup where isuse = 'Y' and sdate <= '$today' and edate >= '$today'";
$result = mysql_query($sql);
while($popup_info = mysql_fetch_array($result)){

	// 스크롤
	if($popup_info[scroll] == "Y") $popup_info[scroll] = "yes";
	else $popup_info[scroll] = "no";
	
	// 일반팝업
	if($popup_info[popup_type] == "" || $popup_info[popup_type] == "W"){
 
?>

<script language="javascript">
<!--
if(!readCookie('popupDayClose<?=$popup_info[idx]?>')){
	window.open('/admin/popup/popup.php?idx=<?=$popup_info[idx]?>','popup<?=$popup_info[idx]?>','height=<?=$popup_info[size_y]?>, width=<?=$popup_info[size_x]?>, menubar=no, scrollbars=<?=$popup_info[scroll]?>, resizable=no, toolbar=no, status=no, top=<?=$popup_info[posi_y]?>, left=<?=$popup_info[posi_x]?>');
}
-->
</script>

<?

	// 레이어팝업
	}else{
	
		if(!${"popupDayClose".$popup_info[idx]}) include "$_SERVER[DOCUMENT_ROOT]/admin/popup/popup_layer.php";
	
	}
   
}

?>
<!--                ### 팝업 끝 ###            -->
