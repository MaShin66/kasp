<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?
$sql = "select * from wiz_siteinfo";
$result = mysql_query($sql) or error(mysql_error());
$site_info = mysql_fetch_array($result);

// stripslashes()
$site_info[mini_url] 	= stripslashes($site_info[mini_url]);
?>
<? include "../head.php"; ?>
<script language="javascript">
<!--
function inputCheck(frm){
   
}
-->
</script>
</head>

			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">미니홈피</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">아래코드를 삽입하여 미니홈피를 생성합니다.</td>
        </tr>
      </table>

			<br><br>
    	<table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 미니홈피 생성코드</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
      <form name="frm" action="mini_save.php" method="post" enctype="multipart/form-data" onSubmit="return inputCheck(this);">
      <input type="hidden" name="tmp">
      <input type="hidden" name="mode" value="<?=$mode?>">
      <input type="hidden" name="idx" value="<?=$idx?>">
        <tr width="15%">
        	<td class="t_name">메인 페이지</td>
          <td class="t_value" align="left">
          	<? if(!@opendir("../../mini")){ ?>
          
          	<font color=red><b>미니홈피기능을 신청하지 않았습니다. </b></font>
          
        		<? }else{ ?>
          	&nbsp; http//<?=$HTTP_HOST?>/<input type="text" name="mini_url" value="<?=$site_info[mini_url]?>" size="40" class="input"><br>
          	&nbsp; 브라우저에 바로 미니홈피 주소를 입력한경우 새창으로 미니홈피가 열리고 원래 브라우저는 위에서 설정한 주소로 이동합니다.
          	<? } ?>
          </td>
        </tr>
        <!--tr>
        	<td class="t_name">메인 생성코드</td>
          <td class="t_value" align="left">
          <?
          $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin/mini/mini_main.php\";     // 메인 페이지 ?&gt;";
          ?>
          <script language="javascript">
          function copy_Phpcode1(){
          	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
          	set_ClipBoard(php_code);
          }
          </script>
          <font color=red><?=$php_code?></font>&nbsp; &nbsp; 
          <a href="javascript:copy_Phpcode1();"><font color=blue>생성코드 복사</font></a>

          </td>
        </tr//-->
        <tr>
        	<td class="t_name">내 미니홈피가기</td>
          <td class="t_value" align="left">
          <?
          $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin/mini/mini_my.php\";     // 내 미니홈피가기 ?&gt;";
          ?>
          <script language="javascript">
          function copy_Phpcode1(){
          	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
          	set_ClipBoard(php_code);
          }
          </script>
          <font color=red><?=$php_code?></font>&nbsp; &nbsp; 
          <a href="javascript:copy_Phpcode1();"><img src="../image/btn_codecopy.gif" border="0" align="absmiddle"></a>

          </td>
        </tr>
      </table>
      <br>
      
      <? if(@opendir("../../mini")){ ?>
      <table align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
          	<input type="image" src="../image/btn_confirm_l.gif"> &nbsp; 
          	<img src="../image/btn_cancel_l.gif" style="cursor:hand" onClick="history.go(-1);">
          </td>
        </tr>
      </form>
      </table>
    	<? } ?>
    	
    	
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
&nbsp; &nbsp; <font color=#0000FF>&lt;? include "$_SERVER[DOCUMENT_ROOT]/admin/mini/mini_my.php";     // 내 미니홈피가기 ?&gt;</font><br>
&nbsp; &nbsp; &lt;a href="<font color=#0000FF>&lt;?=$mini_my?&gt;</font>">내 미니홈피가기&lt;/a><br>

&nbsp; &nbsp; &lt;/td&gt;<br>
&nbsp; &lt;/tr&gt;<br>
&lt;/table&gt;<br>


          </td>
        </tr>
      </table>
      </td></tr></table>
      
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
              	&nbsp; 생성코드 삽입만으로 미니홈페이지를 생성합니다.
              </td>
            </tr>
            <tr>
              <td class="chk_alt">
              - 환경설정 > 기본설정 > "미니홈피 사용여부" 에서 사용함으로 설정 후 사용하세요
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
