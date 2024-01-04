<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<? include "../head.php"; ?>

<script language="javascript">
<!--
function inputCheck(frm){
	
}
//-->
</script>

			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">포인트</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">아래코드를 삽입하여 회원의 포인트를 생성합니다.</td>
        </tr>
      </table>

			<br><br>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 포인트 생성코드</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
      <form name="frm" action="point_save.php" method="post" enctype="multipart/form-data" onSubmit="return inputCheck(this);">
        <tr>
        	<td class="t_name" width="15%">스킨</td>
          <td class="t_value" align="left">
          	
          <? if(!@opendir("../../point")){ ?>
          
          <font color=red><b>포인트기능을 신청하지 않았습니다. 추가비용은 10만원입니다.</b></font>
          
          <? }else{ ?>
          
          <select name="point_skin">
          <?
          $dh = opendir("../../point/skin");
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
            skin = document.frm.point_skin;
            for(ii=0; ii<skin.length; ii++){
               if(skin.options[ii].value == "<?=$site_info[point_skin]?>")
                  skin.options[ii].selected = true;
            }
          -->
          </script>
          스킨위치 : /admin2/point/skin
          
        	<? } ?>
        	
          </td>
        </tr>
        <tr>
        	<td class="t_name">포인트내역 페이지</td>
          <td class="t_value" align="left">
          	&nbsp; http//<?=$HTTP_HOST?>/<input type="text" name="point_url" value="<?=$site_info[point_url]?>" size="40" class="input">
          </td>
        </tr>
        <tr>
        	<td class="t_name">포인트내역</td>
          <td class="t_value" align="left">
          <?
          $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin2/module/mypoint.php\";     // 회원포인트내역 ?&gt;";
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
        	<td class="t_name">총 포인트</td>
          <td class="t_value" align="left">
          <?
          $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin2/module/point.php\";     // 포인트 ?&gt;";
          ?>
          <script language="javascript">
          function copy_Phpcode2(){
          	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
          	set_ClipBoard(php_code);
          }
          </script>
          <font color=red><?=$php_code?></font>&nbsp; &nbsp; 
          <a href="javascript:copy_Phpcode2();"><img src="../image/btn_codecopy.gif" border="0" align="absmiddle"></a><br><br>
          총 포인트 : &lt;?=$total_point?></font>
          </td>
        </tr>
      </table>
      <br>
      
      <? if(@opendir("../../point")){ ?>
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
              	&nbsp; 생성코드 삽입만으로 간단히 포인트 기능을 생성할 수 있습니다. 
              </td>
            </tr>
            <tr>
              <td class="chk_alt">
              - 환경설정 > 기본설정 > "포인트 사용여부" 에서 사용함으로 설정 후 사용하세요<br>
              - 포인트를 표현하고자 하는 위치 상단에 포인트 생성코드를 삽입합니다.<br>
              - 총 포인트 : &lt;?=$total_point?&gt; &nbsp; 
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
