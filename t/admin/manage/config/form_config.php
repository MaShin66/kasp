<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<? include "../head.php"; ?>

<script language="javascript">
function phpCode(code){
	var php_code = "&lt;? \$code=\""+code+"\"; include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/form.php\"; ?&gt;";
	set_ClipBoard(php_code);
}
</script>

      <script language="JavaScript" type="text/javascript">
      <!--
      function delForm(idx){
        if(confirm('선택한 폼메일을 삭제하시겠습니까?')){
          document.location = 'form_save.php?mode=delete&idx=' + idx;
        }
      }
      //-->
      </script>
      <table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">폼메일</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">아래코드를 삽입하여 폼메일을 생성합니다.</td>
        </tr>
      </table>
      
			<br><br>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 폼메일 생성코드</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td align="left" class="t_name">
                	
                <?
                $php_code = "&lt;? \$code = \"contact\"; include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/form.php\"; // 폼메일 ?&gt;";
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
              	&nbsp; 폼메일을 형태에 구애없이 자유롭게 생성할수 있는 편리한 기능을 제공합니다.
              </td>
            </tr>
            <tr>
              <td class="chk_alt">
              - 스킨위치 : /admin/form/skin<br>
              - 폼메일 코드명은 해당 폼메일의 코드로 변경합니다.<br>
              - 폼메일 생성 > 각 항목을 설정후 해당위치에 폼메일 생성 코드를 삽입합니다.<br>
              - 작성된 폼메일내용은 관리자 > 폼메일관리 메뉴에서 확인가능합니다.
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

			<br><br>
			<?
			$sql = "select * from wiz_forminfo where code != ''";
			$result = mysql_query($sql) or error(mysql_error());
			$total = mysql_num_rows($result);
			
			$rows = 999;
			$lists = 5;
			$page_count = ceil($total/$rows);
			if(!$page || $page > $page_count) $page = 1;
			$start = ($page-1)*$rows;
			$no = $total-$start;
			if($start>1) mysql_data_seek($result,$start);
			?>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>총 폼메일수 : <b><?=$total?></b></td>
          <td align="right"><img src="../image/btn_formadd.gif" style="cursor:hand" onClick="document.location='form_input.php?mode=insert';"></td>
        </tr>
        <tr><td height="3"></td></tr>
      </table> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr><td class="t_rd" colspan=20></td></tr>
        <tr class="t_th">
          <th width="8%">번호</th>
          <th width="20%">폼메일코드</th>
          <th>폼메일명</th>
          <th width="20%">기능</th>
        </tr>
        <tr><td class="t_rd" colspan=20></td></tr>
			<?
			while(($row = mysql_fetch_object($result)) && $rows){
			?>
		  <tr> 
          <td height="30" align="center"><?=$no?></td>
          <td align="center"><?=$row->code?></td>
          <td align="center"><?=$row->title?></td>
          <td align="center">
          <img src="../image/btn_codecopy.gif" style="cursor:hand" onClick="phpCode('<?=$row->code?>');">
          <img src="../image/btn_edit_s.gif" style="cursor:hand" onClick="document.location='form_input.php?mode=update&idx=<?=$row->idx?>'">
          <img src="../image/btn_delete_s.gif" style="cursor:hand" onClick="delForm('<?=$row->idx?>')">
          </td>
        </tr>
        <tr><td colspan="20" class="t_line"></td></tr>
				<?
					$no--;
					$rows--;
				}       
				if($total <= 0){
				?>
				<tr><td height=30 colspan=10 align=center>등록된 폼메일이 없습니다.</td></tr>
				<tr><td colspan="20" class="t_line"></td></tr>
				<?
				}
				?>
      </table>
      <table width="100%" height="10" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td></td>
        </tr>
      </table>


<? include "../foot.php"; ?>
