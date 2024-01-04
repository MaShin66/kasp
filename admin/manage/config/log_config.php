<? include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php"; ?>
<? include_once "$_SERVER[DOCUMENT_ROOT]/admin/inc/admin_check.php"; ?>
<? include_once "$_SERVER[DOCUMENT_ROOT]/admin/inc/site_info.php"; ?>
<? include "$_SERVER[DOCUMENT_ROOT]/admin/manage/head.php"; ?>


			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">로그분석</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">아래코드를 삽입하여 로그분석을 생성합니다.</td>
        </tr>
      </table>

			<br><br>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 로그분석 생성코드</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td class="t_name">

                <?
                $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/connect.php\";     // 로그분석 ?&gt;";
                ?>
                <script language="javascript">
                function copy_Phpcode(){
                	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
                	set_ClipBoard(php_code);
                }
                </script>
                <font color=red><b><?=$php_code?></b></font>&nbsp; &nbsp;
                <a href="javascript:copy_Phpcode();"><img src="../image/btn_codecopy.gif" align="absmiddle" border="0"></a>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>

      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 적용예제</td>
        </tr>
      </table>
      <table width="100%" border="0" cellpadding="6" cellspacing="0" bgcolor="#EEEEEE"><tr><td>
      <table width="100%" border="0" cellspacing="0" cellpadding="6">
        <tr>
          <td bgcolor="#ffffff"><br>
<font color=#0000FF>&lt;? include "$_SERVER[DOCUMENT_ROOT]/admin/module/connect.php";     // 로그분석 ?&gt;</font><br>
&lt;!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"&gt;<br>
&lt;html&gt;<br>
&lt;head&gt;<br>
&lt;title&gt;Untitled Document&lt;/title&gt;<br>
&lt;meta http-equiv="Content-Type" content="text/html; charset=utf-8"&gt;<br>
&lt;/head&gt;<br>
&lt;body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"&gt;<br><br>
          </td>
        </tr>
      </table>
      </td></tr></table>
      <br>

      <br>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="9d9d9d">
        <tr>
          <td width="5" height="5"><img src="../image/check_left_top.gif"></td>
          <td width="100%"></td>
          <td width="5" height="5"><img src="../image/check_right_top.gif"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="6">
            <tr>
              <td>
              	<img src="../image/check_tit.gif" width="75" height="19" align="absmiddle">
              	&nbsp; 홈페이지의 접속자를  분석할 수 있는 기능입니다.
              </td>
            </tr>
            <tr>
              <td class="chk_alt">
              - 위의 로그분석 코드를 웹사이트 첫페이지(index.htm, index.html, index.php) 첫줄에 삽입합니다.<br>
              - 분석내용은 접속통계 > 접속자분석,접속경로분석 에서 확인 가능합니다.<br>
              - 프레임으로 나눈 사이트의 경우 프레임 페이지 상단에 삽입합니다.
              </td>
            </tr>
          </table></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="5" height="5"><img src="../image/check_left_bottom.gif" width="5" height="5" /></td>
          <td></td>
          <td width="5" height="5"><img src="../image/check_right_bottom.gif" width="5" height="5" /></td>
        </tr>
      </table>

<? include "$_SERVER[DOCUMENT_ROOT]/admin/manage/foot.php"; ?>
