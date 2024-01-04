<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<? include "../head.php"; ?>

			
			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">페이지접근권한</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">아래코드를 삽입하여 페이지접근권한을 설정합니다.</td>
        </tr>
      </table>

			<br><br>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 페이지접근권한 생성코드</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td class="t_name">
                	
                <?
                $php_code = "&lt;?\\n\$level = 3;\\n\$msg = \"접근권한이 없습니다.\";\\n\$backurl = \"/\";\\ninclude \"\$_SERVER[DOCUMENT_ROOT]/admin/module/levelcheck.php\"; \\n?&gt;";
                ?>
                <script language="javascript">
                function copy_Phpcode(){
                	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
                	set_ClipBoard(php_code);
                }
                </script>
                <font color=red><b><?=str_replace("\\n","<br>",$php_code)?></b></font>&nbsp; &nbsp; 
                <a href="javascript:copy_Phpcode();"><img src="../image/btn_codecopy.gif" border="0" align="absmiddle"></a>
                
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      
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
              	&nbsp; 사이트의 특정페이지를 회원 권한별로 접근할 수 있게하는 기능을 제공합니다.
              </td>
            </tr>
            <tr>
              <td class="chk_alt">              
        		  - 레벨별 접근권한 기능외에 로그인 체크기능으로도 이용할 수 있습니다.<br><br>
        		  <b>$level</b> : 접근권한 레벨을 지정합니다. ( 회원관리>회원등급>등급레벨 값을 입력합니다. )&nbsp; 3을 입력한경우 3과 같거나 작은경우 페이지 접근이 가능합니다.<br>
        		  <b>$msg</b> : 권한이 없을경우 경고 메세지를 설정합니다. 입력하지 않는경우 기본은 "권한이 없습니다." 입니다.<br>
        		  <b>$backurl</b> : 권한이 없어 경고창이 뜬경우 이동할 페이지를 입력합니다. 기본은 history.back(); 입니다.
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
