<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?
$sql = "select * from wiz_siteinfo";
$result = mysql_query($sql) or error(mysql_error());
$site_info = mysql_fetch_array($result);

// stripslashes()
$site_info[msg_url] 	= stripslashes($site_info[msg_url]);

$page_name = "쪽지설정"; $page_desc = "아래코드를 삽입하여 쪽지관련 페이지를 생성합니다.  "; $navi_name = "  환경설정  > 쪽지설정";
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
          <td valign="bottom" class="tit">쪽지</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">아래코드를 삽입하여 쪽지를 생성합니다.</td>
        </tr>
      </table>

			<br><br>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 쪽지 생성코드</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
      <form name="frm" action="message_save.php" method="post" enctype="multipart/form-data" onSubmit="return inputCheck(this);">
      <input type="hidden" name="tmp">
      <input type="hidden" name="mode" value="<?=$mode?>">
      <input type="hidden" name="idx" value="<?=$idx?>">
        <tr>
        	<td class="t_name" width="15%">스킨</td>
          <td class="t_value" align="left">
          
          <? if(!@opendir("../../message")){ ?>
          
          <font color=red><b>쪽지기능을 신청하지 않았습니다. 추가비용은 10만원입니다.</b></font>
          
        	<? }else{ ?>
          <select name="msg_skin">
          <?
          $dh = opendir("../../message/skin");
          while(($file = readdir($dh)) !== false){
          	if($file != "." && $file != ".."){
          		$file_list[] = $file;
          	}
          }
          sort ($file_list); reset ($file_list); 
          for($ii=0;$ii<count($file_list);$ii++){
          ?>
          <option value="<?=$file_list[$ii]?>"><?=$file_list[$ii]?></option>
          <?
          }
          
          $file_list = "";
          ?>
          </select>
          <script language="javascript">
          <!--
            skin = document.frm.msg_skin;
            for(ii=0; ii<skin.length; ii++){
               if(skin.options[ii].value == "<?=$site_info[msg_skin]?>")
                  skin.options[ii].selected = true;
            }
          -->
          </script>
          스킨위치 : /admin/message/skin
          
          <? } ?>
          
          </td>
        </tr>
        <tr>
        	<td class="t_name">쪽지 페이지</td>
          <td class="t_value" align="left">
          	&nbsp; http//<?=$HTTP_HOST?>/<input type="text" name="msg_url" value="<?=$site_info[msg_url]?>" size="40" class="input">
          </td>
        </tr>
        <tr>
        	<td class="t_name">받은쪽지</td>
          <td class="t_value" align="left">
          <?
          $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/msg_receive.php\";     // 받은쪽지 ?&gt;";
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
        <tr>
        	<td class="t_name">보낸쪽지</td>
          <td class="t_value" align="left">
          <?
          $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/msg_send.php\";     // 보낸쪽지 ?&gt;";
          ?>
          <script language="javascript">
          function copy_Phpcode2(){
          	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
          	set_ClipBoard(php_code);
          }
          </script>
          <font color=red><?=$php_code?></font>&nbsp; &nbsp; 
          <a href="javascript:copy_Phpcode2();"><img src="../image/btn_codecopy.gif" border="0" align="absmiddle"></a>

          </td>
        </tr>
        <tr>
        	<td class="t_name">회원목록</td>
          <td class="t_value" align="left">
          <?
          $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/msg_member.php\";     // 회원목록 ?&gt;";
          ?>
          <script language="javascript">
          function copy_Phpcode3(){
          	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
          	set_ClipBoard(php_code);
          }
          </script>
          <font color=red><?=$php_code?></font>&nbsp; &nbsp; 
          <a href="javascript:copy_Phpcode3();"><img src="../image/btn_codecopy.gif" border="0" align="absmiddle"></a>

          </td>
        </tr>
        <tr>
        	<td class="t_name">친구목록</td>
          <td class="t_value" align="left">
          <?
          $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/msg_friend.php\";     // 친구목록 ?&gt;";
          ?>
          <script language="javascript">
          function copy_Phpcode4(){
          	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
          	set_ClipBoard(php_code);
          }
          </script>
          <font color=red><?=$php_code?></font>&nbsp; &nbsp; 
          <a href="javascript:copy_Phpcode4();"><img src="../image/btn_codecopy.gif" border="0" align="absmiddle"></a>

          </td>
        </tr>
        <tr>
        	<td class="t_name">쪽지개수</td>
          <td class="t_value" align="left">
          <?
          $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/msg_count.php\";     // 쪽지개수 ?&gt;";
          ?>
          <script language="javascript">
          function copy_Phpcode5(){
          	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
          	set_ClipBoard(php_code);
          }
          </script>
          <font color=red><?=$php_code?></font>&nbsp; &nbsp; 
          <a href="javascript:copy_Phpcode5();"><img src="../image/btn_codecopy.gif" border="0" align="absmiddle"></a><br><br>
          쪽지개수 출력 : &lt;?=$msg_count?></font>
          </td>
        </tr>
      </table>
      <br>
      
      <? if(@opendir("../../message")){ ?>
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
              	&nbsp; 생성코드 삽입만으로 간단히 쪽지관련 기능을 생성할 수 있습니다. 
              </td>
            </tr>
            <tr>
              <td class="chk_alt">
              - 스킨위치 :  /admin/message/skin<br>
              - 환경설정 > 기본설정 > "쪽지 사용여부" 에서 사용함으로 설정 후 사용하세요<br>
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
