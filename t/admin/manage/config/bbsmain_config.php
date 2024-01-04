<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<? include "../head.php"; ?>

<script language="javascript">
function phpCode(code, idx){
	var php_code = "&lt;?\n \$code=\""+code+"\";\n \$category=\"\";\n \$bidx=\""+idx+"\";\n include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/bbsmain.php\"; // 메인게시물\n?&gt;";
	set_ClipBoard(php_code);
}
function delBbsmain(code, idx) {
	if(confirm("삭제하시겠습니까?")) {
		document.location = "bbsmain_save.php?mode=delete&code="+code+"&idx="+idx;
	}
}
function viewBbsmain(code, idx) {
	var url = "bbsmain_view.php?bidx=" + idx + "&code=" + code;
	window.open(url,"ViewBBSMain","height=150, width=450, menubar=no, scrollbars=yes, resizable=yes, toolbar=no, status=no, top=100, left=100");
}
function popCategory(code) {
	var url = "../bbs/category.php?code="+code;
	window.open(url,"BBSCategory","height=300, width=700, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, top=100, left=100");
}
</script>
			
			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">메인게시물</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">아래코드를 삽입하여 메인게시물을 생성합니다.</td>
        </tr>
      </table>
      
			<br><br>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 메인게시물 생성코드</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td align="left" class="t_name">
                <?
                $php_code = "&lt;?\\n \$code=\"qna\";\\n \$category=\"\";\\n \$bidx=\"8\";\\n include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/bbsmain.php\"; //메인게시물\\n ?&gt;";
                ?>
                <script language="javascript">
                function copy_Phpcode1(){
                	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
                	set_ClipBoard(php_code);
                }
                </script>
                <font color=red><b><?=str_replace("\\n","<br>",$php_code)?></b></font>&nbsp; &nbsp; 
                <a href="javascript:phpCode('qna', '8');"><img src="../image/btn_codecopy.gif" align="absmiddle" border="0"></a>

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
              	&nbsp; 생성코드 삽입만으로 간단히 게시물을 추출할 수 있습니다.
              </td>
            </tr>
            <tr>
              <td>
              	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="chk_alt">
              		<tr>
              			<td colspan="2">- 위 메인게시물 생성코드를 해당 위치에 삽입합니다.</td>
              		</tr>
              		<tr>
              			<td colspan="2">- 메인게시물은 너비값이 100% 로 되어있으므로 적당한 크기에 테이블을 만든 후 테이블안에 생성합니다.</td>
              		</tr>
              		<tr><td height="5"></td></tr>
              		<tr>
              			<td width="100">- 스킨위치</td><td>: 현재 페이지 메인게시물 수정/생성 페이지에서 수정이 가능합니다.</td>
              		</tr>
              		<tr>
              			<td>- $code</td><td>: 게시판 코드명($code) 은 해당 게시판의 코드로 변경합니다.</td>
              		</tr>
              		<tr>
              			<td>- $category</td><td>: 카테고리($category)를 설정하면 해당 카테고리 게시물만 추출합니다, 없으면 전체 게시물 추출.</td>
              		</tr>
              		<tr>
              			<td></td><td>&nbsp; 카테고리 값은 "게시판관리 > 게시판설정 > 카테고리관리 > 링크값" 에서 확인가능합니다.</td>
              		<tr>
              			<td>- $bidx</td><td>: 메인게시물 고유값($bidx) 은 해당 메인게시물의 번호로 변경합니다.</td>
              		</tr>
								</table>
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
			$sql = "select wb.code, wb.title, wm.idx, wm.cnt, wm.subject_len 
							from wiz_bbsinfo as wb left join wiz_bbsmain as wm on wb.code = wm.code 
							where wb.type='BBS' order by wm.idx desc";
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
          <td align="right">
          	<img src="../image/btn_bbsmainadd.gif" style="cursor:hand" onClick="document.location='bbsmain_input.php?mode=insert'">
          </td>
        </tr>
        <tr><td height="3"></td></tr>
      </table> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr><td class="t_rd" colspan=20></td></tr>
        <tr class="t_th">
          <th width="10%">번호</th>
          <th>게시판코드</th>
          <th>게시판명</th>
          <th width="10%">게시물수</th>
          <th width="10%">제목 글자수</th>
          <th width="10%">카테고리</th>
          <th width="25%">기능</th>
        </tr>
        <tr><td class="t_rd" colspan=20></td></tr>
		<?
		while(($row = mysql_fetch_array($result)) && $rows){
		?>
		  <tr> 
          <td height="30" align="center"><?=$row[idx]?></td>
          <td align="center"><?=$row[code]?></td>
          <td align="center"><?=$row[title]?></td>
          <td align="center"><?=$row[cnt]?></td>
          <td align="center"><?=$row[subject_len]?></td>
          <td align="center"><a href="javascript:popCategory('<?=$row[code]?>');">[보기]</a></td>
          <td align="center">
          <img src="../image/btn_codecopy.gif" style="cursor:hand" onClick="phpCode('<?=$row[code]?>', '<?=$row[idx]?>');">
          <img src="../image/btn_overview.gif" style="cursor:hand" onClick="viewBbsmain('<?=$row[code]?>', '<?=$row[idx]?>')">
          <img src="../image/btn_edit_s.gif" style="cursor:hand" onClick="document.location='bbsmain_input.php?code=<?=$row[code]?>&idx=<?=$row[idx]?>'">
          <img src="../image/btn_delete_s.gif" style="cursor:hand" onClick="delBbsmain('<?=$row[code]?>', '<?=$row[idx]?>')">
          </td>
        </tr>
        <tr><td colspan="20" class="t_line"></td></tr>
     <?
     		$no--;
        $rows--;
      }
   
    	if($total <= 0){
    	?>
    		<tr><td height=30 colspan=8 align=center>등록된 게시판이 없습니다.</td></tr>
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
