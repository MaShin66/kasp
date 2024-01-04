<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<? include_once "../../inc/bbs_info.php"; ?>
<?
$page_name = "게시물관리";
$page_desc = "게시물을 관리합니다.";
$navi_name = " 게시판관리 > 게시물관리";

$param = "code=$code&category=$category&searchopt=$searchopt&searchkey=$searchkey";

$wiz_session[id]		= $wiz_admin[id];
$wiz_session[name]	= $wiz_admin[name];
$wiz_session[email] = $wiz_admin[email];
$wiz_session[level] = 0;
?>
<? include "../head.php"; ?>
<script Language="Javascript">
<!--

function resizeFrame(iframeObj){
	
	var innerBody = iframeObj.contentWindow.document.body;
	oldEvent = innerBody.onclick;
	innerBody.onclick = function(){ resizeFrame(iframeObj, 1);oldEvent; };
	
	var innerHeight = innerBody.scrollHeight + (innerBody.offsetHeight - innerBody.clientHeight);
	iframeObj.style.height = innerHeight;

	if( !arguments[1] )        /* 특정 이벤트로 인한 호출시 스크롤을 그냥 둔다. */
	this.scrollTo(1,1);

}

//-->
</script>

	<table border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td><img src="../image/ic_tit.gif"></td>
      <td valign="bottom" class="tit"><?=$bbs_info[title]?></td>
      <td width="2"></td>
      <td valign="bottom" class="tit_alt">게시물을 관리합니다.</td>
    </tr>
  </table>

  <br><br><br>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center">
				<iframe id="bbs_frame" src="bbs.php?code=<?=$code?>" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="no" onload="resizeFrame(this)"></iframe>
			</td>
		</tr>
	</table>

<? include "../foot.php"; ?>
