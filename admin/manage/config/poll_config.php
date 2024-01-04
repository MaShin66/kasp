<? include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php"; ?>
<? include_once "$_SERVER[DOCUMENT_ROOT]/admin/inc/admin_check.php"; ?>
<? include_once "$_SERVER[DOCUMENT_ROOT]/admin/inc/poll_info.php"; ?>
<?
if($save == "ok"){
	$sql = "update wiz_pollinfo set skin='$skin'";
	mysql_query($sql) or error(mysql_error());
	complete("수정되었습니다.","poll_config.php");
	exit;
}
if($save == "ok2"){
	$sql = "update wiz_pollinfo set purl='$purl', mainskin='$mainskin'";
	mysql_query($sql) or error(mysql_error());
	complete("수정되었습니다.","poll_config.php");
	exit;
}
?>
<? include "$_SERVER[DOCUMENT_ROOT]/admin/manage/head.php"; ?>
<script Language="Javascript">
<!--
function phpCode(code){
	var php_code = "&lt;? \$code=\""+code+"\"; include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/poll.php\"; // 설문조사 ?&gt;";
	set_ClipBoard(php_code);
}
//-->
</script>

			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">설문조사</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">아래코드를 삽입하여 설문조사를 생성합니다.</td>
        </tr>
      </table>
      
			<br><br>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 설문조사 생성코드</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td class="t_name">

                <?
                $php_code = "&lt;? \$code=\"poll\"; include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/poll.php\";     // 설문조사 ?&gt;";
                ?>
                <script language="javascript">
                function copy_Phpcode(){
                	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
                	set_ClipBoard(php_code);
                }
                </script>
                <font color=red><b><?=$php_code?></b></font>&nbsp; &nbsp; 
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
              	&nbsp; 생성코드 삽입만으로 간단히 설문조사를 생성할 수 있습니다. 
              </td>
            </tr>
            <tr>
              <td class="chk_alt">
              - 스킨위치 : /admin/poll/skin<br>
          		- 설문조사는 너비값이 100% 로 되어있으므로 적당한 크기에 테이블을 만든 후 테이블안에 생성합니다.
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

      
      <?
      
			$sql = "select code from wiz_pollinfo";							
			$result = mysql_query($sql) or error(mysql_error());
			$total = mysql_num_rows($result);

      $rows = 999;
      $lists = 5;
    	$page_count = ceil($total/$rows);
    	if(!$page || $page > $page_count) $page = 1;
    	$start = ($page-1)*$rows;
    	$no = $total-$start;

			$sql = "select * from wiz_pollinfo order by code asc limit $start, $rows";
			$result = mysql_query($sql) or error(mysql_error());
			
			?>
			<br><br>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>총 설문수 : <b><?=$total?></b></td>
          <td align="right"></td>
        </tr>
        <tr><td height="3"></td></tr>
      </table> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr><td class="t_rd" colspan=20></td></tr>
        <tr class="t_th">
          <th width="8%">번호</th>
          <th width="10%">코드명</th>
          <th>설문조사명</th>
          <th width="10%">목록보기</th>
          <th width="10%">내용보기</th>
          <th width="10%">설문참여</th>
          <th width="10%">코멘트쓰기</th>
          <th width="10%">기능</th>
        </tr>
        <tr><td class="t_rd" colspan=20></td></tr>
		<?
			while($row = mysql_fetch_array($result)){
		?>
		  <tr> 
          <td height="30" align="center"><?=$no?></td>
          <td align="center"><?=$row[code]?></td>
          <td align="center"><?=$row[title]?></td>
          <td align="center"><?=$level_info[$row[lpermi]][name]?></td>
          <td align="center"><?=$level_info[$row[rpermi]][name]?></td>
          <td align="center"><?=$level_info[$row[apermi]][name]?></td>
          <td align="center"><?=$level_info[$row[cpermi]][name]?></td>
          <td align="center">
           <img src="../image/btn_codecopy.gif" style="cursor:hand" onClick="phpCode('<?=$row[code]?>');">
          </td>
        </tr>
        <tr><td colspan="20" class="t_line"></td></tr>
     <?
     		$no--;
      }
                           
    	if($total <= 0){
    	?>
    		<tr><td height="30" colspan="10" align="center">등록된 게시판이 없습니다.</td></tr>
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
<? include "$_SERVER[DOCUMENT_ROOT]/admin/manage/foot.php"; ?>
