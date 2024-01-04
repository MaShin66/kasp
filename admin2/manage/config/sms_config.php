<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<? include "../head.php"; ?>


			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">SMS발송</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">아래코드를 삽입하여 SMS발송 기능을 생성합니다.</td>
        </tr>
      </table>
      
			<br><br>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> SMS발송 생성코드</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td class="t_name">

                <?
                $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin2/module/sms.php\";	 // SMS발송 ?&gt;";
                ?>
                <script language="javascript">
                function copy_Phpcode(){
                	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
                	set_ClipBoard(php_code);
                }
                </script>
                <font color=red><b><?=str_replace("\\n","<br>",$php_code)?></b></font>&nbsp; &nbsp;
                <a href="javascript:copy_Phpcode();"> <img src="../image/btn_codecopy.gif" border="0" align="absmiddle"></a>

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
              	&nbsp; 생성코드 삽입만으로 간단히 SMS발송폼을 생성할 수 있습니다. 
              </td>
            </tr>
            <tr>
              <td class="chk_alt">
              - 스킨위치 : /admin2/sms/input.php<br>
              - 환경설정 > 기본설정 > SMS 사용함 체크<br>
          		- 기본설정 > SMS관리 > SMS 신청 및 충전 후 사용가능합니다.<br>
          		- 기본설정 > 사이트 관리정보 > 관리자 휴대폰 번호로 수신됩니다.
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
