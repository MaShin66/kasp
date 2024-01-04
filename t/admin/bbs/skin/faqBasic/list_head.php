<script language="javascript">
<!--
var clickvalue='';
function faqShow(idnum) {
	var faq=eval("faq"+idnum+".style");
	if(clickvalue != faq) {
		if(clickvalue!='') {
			clickvalue.display='none';
		}
		faq.display='block';
		clickvalue=faq;
	} else {
		faq.display='none';
		clickvalue='';
	}
	if(parent.document.getElementById('bbs_frame') != null) {
		parent.resizeFrame(parent.document.getElementById('bbs_frame'));
	}
}
-->
</script>

<!-- 카테고리 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><td align="left"><?=$catlist?></td></tr>
</table>
<!-- 카테고리 끝-->

<!-- 게시물 시작 -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="10" height="2" bgcolor="#a9a9a9"></td>
  </tr>
