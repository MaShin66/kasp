<? include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php"; ?>
<? include_once "$_SERVER[DOCUMENT_ROOT]/admin/inc/admin_check.php"; ?>
<?
if($save == "ok"){
	$sql = "update wiz_bbsinfo set pageurl='$pageurl' where code='$code'";
	mysql_query($sql) or error(mysql_error());
	complete("수정되었습니다.","schedule_config.php");
	exit;
}

?>
<? include "$_SERVER[DOCUMENT_ROOT]/admin/manage/head.php"; ?>

<script language="javascript">
function phpCode(code){
	var php_code = "&lt;? \$code=\""+code+"\"; include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/schedule.php\"; // 일정관리(대) ?&gt;";
	set_ClipBoard(php_code);
}
function phpCode2(code){
	var php_code = "&lt;? \$code=\""+code+"\"; include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/schedule_s.php\"; // 일정관리(소) ?&gt;";
	set_ClipBoard(php_code);
}
</script>
			
			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">일정관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">아래코드를 삽입하여 일정관리을 생성합니다.</td>
        </tr>
      </table>
      
			<br><br>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 일정관리 생성코드</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td class="t_name">

                <?
                $php_code = "&lt;? \$code=\"schedule\"; include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/schedule.php\";     // 일정관리(대) ?&gt;";
                ?>
                <script language="javascript">
                function copy_Phpcode1(){
                	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
                	set_ClipBoard(php_code);
                }
                </script>
                <font color=red><b><?=$php_code?></b></font>&nbsp; &nbsp; 
                <a href="javascript:copy_Phpcode1();"><img src="../image/btn_codecopy.gif" border="0" align="absmiddle"></a>
                
                
                </td>
              </tr>
            </table>
            <br>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td class="t_name">

                <?
                $php_code = "&lt;? \$code=\"schedule\"; include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/schedule_s.php\";     // 일정관리(소) ?&gt;";
                ?>
                <script language="javascript">
                function copy_Phpcode2(){
                	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
                	set_ClipBoard(php_code);
                }
                </script>
                <font color=red><b><?=$php_code?></b></font>&nbsp; &nbsp; 
                <a href="javascript:copy_Phpcode2();"><img src="../image/btn_codecopy.gif" border="0" align="absmiddle"></a>
                
                
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
              	&nbsp; 생성코드 삽입만으로 간단히 일정관리를 생성할 수 있습니다. 
              </td>
            </tr>
            <tr>
              <td class="chk_alt">
              - 스킨위치 : /admin/schedule/skin<br>
          		- 일정관리 코드명은 해당 일정관리의 코드로 변경합니다.<br>
          		- 일정관리는 너비값이 100% 로 되어있으므로 적당한 크기에 테이블을 만든 후 테이블안에 생성합니다.<br>
          		- 페이지 주소는 일정관리(대)가 삽입된 페이지로 일정관리(소)를 클릭했을때 연결되는 페이지입니다.
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
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
            	<tr><td class="t_rd" colspan=20></td></tr>
			        <tr class="t_th">
			          <th width="8%">번호</th>
			          <th width="10%">코드명</th>
			          <th>일정명</th>
			          <th width="40%">페이지 주소</th>
			          <th width="30%">기능</th>
			        </tr>
			        <tr><td class="t_rd" colspan=20></td></tr>
							<?
							$sql = "select * from wiz_bbsinfo where type = 'SCH' order by code";
							$result = mysql_query($sql) or error(mysql_error());
							$total = mysql_num_rows($result);
							
							$no = $total;
							while($sch_info = mysql_fetch_array($result)) {
							?>
							<form name="frm<?=$sch_info[code]?>" action="<?=$PHP_SELF?>" method="post">
							<input type=hidden name="save" value="ok">
							<input type=hidden name="code" value="<?=$sch_info[code]?>">
						  <tr> 
						  	<td height="30" align="center"><?=$no?></td>
				      	<td align="center"><?=$sch_info[code]?></td>
				      	<td align="center"><?=$sch_info[title]?></td>
				      	<td align="center">
				      		http://<?=$HTTP_HOST?>/<input type="text" name="pageurl" value="<?=$sch_info[pageurl]?>" class="input" size="20">
				      		<input type="image" src="../image/btn_confirm_s.gif" align="absmiddle">
				      	</td>
				      	<td align="center">
				      		<img src="../image/btn_codecopy.gif" style="cursor:hand" align="absmiddle" onClick="phpCode('<?=$sch_info[code]?>');"><b>(대)</b> &nbsp;
				      		<img src="../image/btn_codecopy.gif" style="cursor:hand" align="absmiddle" onClick="phpCode2('<?=$sch_info[code]?>');"><b>(소)</b>
				      	</td>
				      </tr>
			        <tr><td colspan="20" class="t_line"></td></tr>
            	</form>
							<?
								$no--;
							}
							?>
            </table>
          </td>
        </tr>
      </table>

<? include "$_SERVER[DOCUMENT_ROOT]/admin/manage/foot.php"; ?>
