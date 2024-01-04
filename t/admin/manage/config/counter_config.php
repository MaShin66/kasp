<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<?
$page_name = "카운터";
$page_desc = "아래코드를 삽입하여 카운터를 생성합니다.";
$navi_name = " 환경설정 > 카운터";
?>
<? include "../head.php"; ?>


			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">카운터</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">아래코드를 삽입하여 카운터를 생성합니다.</td>
        </tr>
      </table>

			<br><br>
			<table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 카운터설정 생성코드</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td class="t_name">
                	
                <?
                $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/counter.php\";     // 카운터 ?&gt;";
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
          
&lt;body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"&gt;<br>

&lt;table width="100%" border="0" cellspacing="0" cellpadding="2"&gt;<br>
&nbsp; &lt;tr&gt;<br>
&nbsp; &nbsp; &lt;td align="center"&gt;<br>
&nbsp; &nbsp; <font color=#0000FF>&lt;? include "$_SERVER[DOCUMENT_ROOT]/admin/module/counter.php";     // 카운터 ?&gt;</font><br>
&nbsp; &nbsp; 오늘접속자 : <font color=#0000FF>&lt;?=$today_cnt?&gt;</font><br>
&nbsp; &nbsp; 어제접속자 : <font color=#0000FF>&lt;?=$yester_cnt?&gt;</font><br>
&nbsp; &nbsp; 전체접속자 : <font color=#0000FF>&lt;?=$total_cnt?&gt;</font><br>
&nbsp; &nbsp; 현재접속자 : <font color=#0000FF>&lt;?=$now_cnt?&gt;</font><br>

&nbsp; &nbsp; &lt;/td&gt;<br>
&nbsp; &lt;/tr&gt;<br>
&lt;/table&gt;<br>


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
              	&nbsp; 생성코드 삽입만으로 간단히 카운터를 생성할 수 있습니다. 
              </td>
            </tr>
            <tr>
              <td class="chk_alt">
              - 카운터를 표현하고자 하는 위치 상단에 카운터 생성코드를 삽입합니다.<br>
              - 오늘접속자 : &lt;?=$today?&gt; &nbsp; 어제접속자 : &lt;?=$yester_cnt?&gt; &nbsp; 전체접속자 : &lt;?=$total_cnt?&gt; &nbsp; 현재접속자 : &lt;?=$now_cnt?&gt;
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
