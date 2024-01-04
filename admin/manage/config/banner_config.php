<? include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php"; ?>
<? include_once "$_SERVER[DOCUMENT_ROOT]/admin/inc/admin_check.php"; ?>
<? include_once "$_SERVER[DOCUMENT_ROOT]/admin/inc/site_info.php"; ?>
<? include "$_SERVER[DOCUMENT_ROOT]/admin/manage/head.php"; ?>

<script language="javascript">
function phpCode(code){
	var php_code = "&lt;? \$code=\""+code+"\"; include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/banner.php\"; ?&gt;";
	set_ClipBoard(php_code);
}
</script>

			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">배너관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">아래코드를 삽입하여 배너관리를 설정합니다.</td>
        </tr>
      </table>

			<br><br>
			<table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 배너관리 생성코드</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td class="t_name">

                <?
                $php_code = "&lt;? \$code=\"banner01\"; include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/banner.php\";     // 배너 ?&gt;";
                ?>
                <script language="javascript">
                function copy_Phpcode(){
                	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
                	set_ClipBoard(php_code);
                }
                </script>
                <font color=red><b><?=$php_code?></b></font>&nbsp; 
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
              	&nbsp; 홈페이지의 메인이미지 또는 배너를 관리자에서 관리할 수 있는 기능을 제공합니다.
              </td>
            </tr>
            <tr>
              <td class="chk_alt">
              - 사이트의 특정이미지를 수정/삭제하는 기능이나 이미지 추가를 원할경우 배너관리를 이용합니다<br>
          		- 배너관리 코드명($code) 은 해당 배너관리의 코드로 변경합니다.<br>
          		- 배너관리 메뉴에서 배너를 추가/수정/삭제가 가능합니다.
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
			$sql = "select * from wiz_bannerinfo";
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
			<br><br>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>총 배너그룹수 : <b><?=$total?></b></td>
          <td align="right"></td>
        </tr>
        <tr><td height="3"></td></tr>
      </table> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr><td class="t_rd" colspan=20></td></tr>
        <tr class="t_th">
          <th width="8%">번호</th>
          <th width="10%">코드</th>
          <th>그룹명</th>
          <th width="10%">배너형태</th>
          <th width="10%">사용여부</th>
          <th width="15%">기능</th>
        </tr>
        <tr><td class="t_rd" colspan=20></td></tr>
			<?
			while(($row = mysql_fetch_object($result)) && $rows){
				
				if(!strcmp($row->isuse, 'Y')) $row->isuse = "사용함";
				else $row->isuse = "사용안함";
				
				if(!strcmp($row->types, 'H')) $row->types = "세로형";
				else $row->types = "가로형";
			?>
		    <tr> 
          <td height="30" align="center"><?=$no?></td>
          <td align="center"><?=$row->code?></td>
          <td align=center><?=$row->title?></td>
          <td align=center><?=$row->types?></td>
          <td align=center><?=$row->isuse?></td>
          <td align="center">
            <img src="../image/btn_codecopy.gif" style="cursor:hand" onclick="phpCode('<?=$row->code?>');">
          </td>
        </tr>
        <tr><td colspan="20" class="t_line"></td></tr>
				<?
					$no--;
					$rows--;
				}       
				if($total <= 0){
				?>
				<tr><td height=30 colspan=10 align=center>등록된 배너그룹이 없습니다.</td></tr>
				<tr><td colspan="20" class="t_line"></td></tr>
				<?
				}
				?>
      </table>

<? include "$_SERVER[DOCUMENT_ROOT]/admin/manage/foot.php"; ?>
