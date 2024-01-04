<? include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php"; ?>
<? include_once "$_SERVER[DOCUMENT_ROOT]/admin/inc/admin_check.php"; ?>
<? include_once "$_SERVER[DOCUMENT_ROOT]/admin/inc/prd_info.php"; ?>
<?
if($save == "ok"){
	//$sql = "update wiz_prdinfo set skin='$skin',purl='$purl', prdcnt='$prdcnt', prdline='$prdline', maintype='$maintype', mainskin='$mainskin', prdname_len='$prdname_len'";
	$sql = "update wiz_prdinfo set skin='$skin'";
	mysql_query($sql) or error(mysql_error());
	complete("수정되었습니다.","product_config.php");
	exit;
}
?>
<? include "$_SERVER[DOCUMENT_ROOT]/admin/manage/head.php"; ?>
<script Language="Javascript">
<!--
function phpCode(idx){
	var php_code = "&lt;? \$pidx=\""+idx+"\"; include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/prdmain.php\"; // 상품추출 ?&gt;";
	set_ClipBoard(php_code);
}

function delPrdmain(idx) {
	if(confirm("삭제하시겠습니까?")) {
		document.location = "prdmain_save.php?mode=delete&idx="+idx;
	}
}
function viewPrdmain(idx) {
	var url = "prdmain_view.php?pidx=" + idx;
	window.open(url,"ViewPrdmain","height=150, width=470, menubar=no, scrollbars=yes, resizable=yes, toolbar=no, status=no, top=100, left=100");
}
//-->
</script>

			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">메인상품</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">아래코드를 삽입하여 메인상품를 생성합니다.</td>
        </tr>
      </table>

			<br><br>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 메인페이지 상품추출 생성코드</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td class="t_name">

                <?
                $php_code = "&lt;?\\n \$pidx=\"1\";\\n \$pcategory=\"\";\\n include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/prdmain.php\";     // 상품추출\\n?&gt;";
                ?>
                <script language="javascript">
                function copy_Phpcode2(){
                	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
                	set_ClipBoard(php_code);
                }
                </script>
                <font color=red><b><?=str_replace("\\n","<br>",$php_code)?></b></font>&nbsp; &nbsp;
                <a href="javascript:copy_Phpcode2();"><img src="../image/btn_codecopy.gif" border="0"></a>


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
              	&nbsp; 생성코드 삽입만으로 간단히 상품을 추출할 수 있습니다.
              </td>
            </tr>
            <tr>
              <td>
              	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="chk_alt">
              		<tr>
              			<td colspan="2">- 메인상품 생성코드를 복사 후 해당 위치에 삽입합니다.</td>
              		</tr>
              		<tr>
              			<td colspan="2">- 메인상품은 너비값이 100% 로 되어있으므로 적당한 크기에 테이블을 만든 후 테이블안에 생성합니다.</td>
              		</tr>
              		<tr>
              			<td colspan="2">- 최근등록상품 또는 추천상품 두가지 형태로 추출이 가능합니다.</td>
              		</tr>
              		<tr>
              			<td colspan="2">- 카테고리($pcategory)를 설정하면 해당 카테고리 상품만 추출합니다, 없으면 전체 상품 추출.</td>
              		</tr>
              		<tr>
              			<td colspan="2">&nbsp; &nbsp; 카테고리 값은 "상품관리 > 상품분류 > 분류코드" 에서 확인가능합니다.</td>
              		</tr>
              		<tr><td height="5"></td></tr>
              		<tr>
              			<td width="10%">- 스킨위치</td><td width="90%">: 현재 페이지 생성/수정 페이지에서 가능합니다.</td>
              		</tr>
              		<tr>
              			<td>- $pcategory</td><td>: 상품카테고리(미지정시 전체 상품 추출)</td>
              		</tr>
              		<tr>
              			<td>- $pidx</td><td>: 메인상품 고유값</td>
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

			<?
			$sql = "select * from wiz_prdmain order by idx desc";
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
			<br>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>총 상품추출수 : <b><?=$total?></b></td>
          <td align="right">
          	<img src="../image/btn_prdmainadd.gif" style="cursor:hand" onClick="document.location='prdmain_input.php?mode=insert'">
          </td>
        </tr>
        <tr><td height="3"></td></tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr><td class="t_rd" colspan=20></td></tr>
        <tr class="t_th">
          <th width="8%">번호($pidx)</th>
          <th>추출상품</th>
          <th>상품명 글자수</th>
          <th>상품수</th>
          <th>줄바꿈 상품수</th>
          <th width="30%">기능</th>
        </tr>
        <tr><td class="t_rd" colspan=20></td></tr>
				<?
				while(($row = mysql_fetch_array($result)) && $rows){

				  switch($row[maintype]) {
				  	case "wdate" : $row[maintype] = "최근등록상품 "; break;
				  	case "recom" : $row[maintype] = "추천상품 "; break;
				  }
				?>
		  	<tr>
          <td height="30" align="center"><?=$row[idx]?></td>
          <td align="center"><?=$row[maintype]?></td>
          <td align="center"><?=$row[prdname_len]?></td>
          <td align="center"><?=$row[prdcnt]?></td>
          <td align="center"><?=$row[prdline]?></td>
          <td align="center">
          <img src="../image/btn_codecopy.gif" style="cursor:hand" onClick="phpCode('<?=$row[idx]?>');">
          <img src="../image/btn_overview.gif" style="cursor:hand" onClick="viewPrdmain('<?=$row[idx]?>')">
          <img src="../image/btn_edit_s.gif" style="cursor:hand" onClick="document.location='prdmain_input.php?idx=<?=$row[idx]?>'">
          <img src="../image/btn_delete_s.gif" style="cursor:hand" onClick="delPrdmain('<?=$row[idx]?>')">
          </td>
        </tr>
        <tr><td colspan="20" class="t_line"></td></tr>
	     <?
	     		$no--;
	         $rows--;
	      }

	    	if($total <= 0){
	    	?>
	    		<tr><td height=30 colspan=8 align=center>등록된 상품추출이 없습니다.</td></tr>
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
