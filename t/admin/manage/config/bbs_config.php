<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<? include "../head.php"; ?>
    
<script language="javascript">
function phpCode(code){
	var php_code = "&lt;? \$code=\""+code+"\"; include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/bbs.php\"; // 게시판 ?&gt;";
	set_ClipBoard(php_code);
}
function insertBbs(){
	var uri = "/admin/manage/bbs/bbs_input.php?mode=insert";
	window.open(uri,"insertBbs","top=200,left=200,width=550,height=280,resizable=yes");
}
</script>


			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">게시판</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">아래코드를 삽입하여 게시판을 생성합니다.</td>
        </tr>
      </table>

			<br><br>
			<table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 게시판 생성코드</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td align="left" class="t_name">
                	
                <?
                $php_code = "&lt;? \$code=\"qna\"; include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/bbs.php\";     // 게시판 ?&gt;";
                ?>
                
                <font color=red><b><?=$php_code?></b></font>&nbsp; &nbsp; 
                <a href="javascript:phpCode('qna');"><img src="../image/btn_codecopy.gif" align="absmiddle" border="0"></a>

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
              	&nbsp; 생성코드 삽입만으로 간단히 게시판을 생성할 수 있습니다.
              </td>
            </tr>
            <tr>
              <td class="chk_alt">
              - 스킨위치 : /admin/bbs/skin<br>
              - 게시판 위치에 게시판 생성코드를 삽입합니다.<br>
              - 게시판 코드명($code) 은 해당 게시판의 코드로 변경합니다.<br>
              - 게시판은 너비값이 100% 로 되어있으므로 적당한 크기에 테이블을 만든 후 테이블안에 삽입합니다.<br>
              - 게시판정보에서 사이트 컨셉에 맞는 형태의 게시판 스킨선택이 가능합니다.<br>
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
			$level_info = level_info();
			
			$sql = "select * from wiz_bbsinfo where type = 'BBS' order by code";
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
          <td>총 게시판수 : <b><?=$total?></b></td>
          <td align="right"></td>
        </tr>
        <tr><td height="3"></td></tr>
      </table> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr><td class="t_rd" colspan=20></td></tr>
        <tr class="t_th">
          <th width="8%">번호</th>
          <th width="10%">코드명</th>
          <th>게시판명</th>
          <th width="10%">목록보기</th>
          <th width="10%">내용보기</th>
          <th width="10%">글쓰기</th>
          <th width="10%">답글쓰기</th>
          <th width="10%">코멘트쓰기</th>
          <th width="10%">기능</th>
        </tr>
        <tr><td class="t_rd" colspan=20></td></tr>
		<?
		while(($row = mysql_fetch_object($result)) && $rows){
		?>
		  <tr> 
          <td height="30" align="center"><?=$no?></td>
          <td align="center"><?=$row->code?></td>
          <td align="center"><?=$row->title?></td>
          <td align="center"><?=$level_info[$row->lpermi][name]?></td>
          <td align="center"><?=$level_info[$row->rpermi][name]?></td>
          <td align="center"><?=$level_info[$row->wpermi][name]?></td>
          <td align="center"><?=$level_info[$row->apermi][name]?></td>
          <td align="center"><?=$level_info[$row->cpermi][name]?></td>
          <td align="center">
          <img src="../image/btn_codecopy.gif" style="cursor:hand" onClick="phpCode('<?=$row->code?>');">
          </td>
        </tr>
        <tr><td colspan="20" class="t_line"></td></tr>
     <?
     		$no--;
         $rows--;
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
      
<? include "../foot.php"; ?>
