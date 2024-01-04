<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<? include "../head.php"; ?>



			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">팝업관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">아래코드를 삽입하여 팝업을 생성합니다.</td>
        </tr>
      </table>

			<br><br>
			<table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 팝업 생성코드</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td align="left" class="t_name">

                <?
                $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin2/module/popup.php\";     // 팝업관리 ?&gt;";
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
          <td bgcolor="#ffffff">
<br>
<font color=blue>&lt;? include "$_SERVER[DOCUMENT_ROOT]/admin2/module/popup.php";     // 팝업관리 ?&gt;</font><br>
&lt;!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"&gt;<br>
&lt;html&gt;<br>
&lt;head&gt;<br>
&lt;title&gt;Untitled Document&lt;/title&gt;<br>
&lt;meta http-equiv="Content-Type" content="text/html; charset=utf-8"&gt;<br>
&lt;/head&gt;<br>
&lt;body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"&gt;<br>
<br>

          </td>
        </tr>
      </table>
      </td></tr></table>

      <br><br>
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
              	&nbsp; 홈페이지의 팝업을 관리할 수있는 기능입니다.
              </td>
            </tr>
            <tr>
              <td class="chk_alt">
              - 스킨위치 : /admin2/popup/popup.php, popup_layer.php<br>
              - 위의 팝업생성 코드를 웹사이트 첫페이지(index.htm, index.html, index.php)에 삽입합니다.<br>
              - 팝업내용은 기본생성 > 팝업관리 에서 작성할 수 있습니다.
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

<? include "../foot.php"; ?>
