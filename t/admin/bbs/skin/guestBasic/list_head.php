<?
// 자동등록글체크
get_spam_check();

// 스팸글체크기능 사용여부
if(!strcmp($bbs_info[spam_check], "N") || !strcmp($mode, "modify")){
	$hide_spam_check_start = "<!--"; $hide_spam_check_end = "-->";
}

?>
<!-- 게시물 시작 -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="10" height="2" bgcolor="#a9a9a9"></td>
  </tr>
</table>
