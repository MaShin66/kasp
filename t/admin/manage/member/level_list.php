<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<? include "../head.php"; ?>

<script language="JavaScript" type="text/javascript">
<!--
function delLevel(idx,level){

	if(confirm('회원등급을 삭제하시겠습니까?\n\n삭제할 등급에 속한 회원은 아래 등급으로 수정됩니다.')){
		document.location="level_save.php?mode=delete&idx=" + idx + "&level=" + level;
	}
	
}

//-->
</script>
			
			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">등급관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">회원등급을 생성 관리합니다.</td>
        </tr>
      </table>
      
      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr><td colspan=20 class="t_rd"></td></tr>
        <tr class="t_th">
          <th width="8%">번호</th>
          <th>등급명</th>
          <th width="15%">등급레벨</th>
          <th width="15%">회원보기</th>
          <th width="15%">기능</th>
        </tr>
        <tr><td colspan=20 class="t_rd"></td></tr>
        <tr> 
          <td height="30" align="center">1</td>
          <td align="center">관리자</td>
          <td align="center">0</td>
          <td align="center"><a href="../basic/admin_list.php"><img src="../image/btn_memview.gif" border="0"></a></td>
          <td align="center"><a href="../basic/admin_list.php">관리자목록</a></td>
        </tr>
        <tr><td height="1" colspan="10" bgcolor="EBEBEB"></td></tr>
   	<?
   	$sql = "select * from wiz_level order by level asc, idx asc";
   	$result = mysql_query($sql) or error(mysql_error());
   	$total = mysql_num_rows($result);
   	$no = 2;
   	while($row = mysql_fetch_object($result)){
   		
   		$row->permi = str_replace("00/","관리자(인트라넷)접근 / ",$row->permi);
   		$row->permi = str_replace("01/","환경설정 / ",$row->permi);
   		$row->permi = str_replace("02/","기본정보 / ",$row->permi);
   		$row->permi = str_replace("03/","사내업무 / ",$row->permi);
   		$row->permi = str_replace("04/","회원관리 / ",$row->permi);
   		$row->permi = str_replace("05/","게시판관리 / ",$row->permi);
   		$row->permi = str_replace("06/","마케팅분석 / ",$row->permi);
   		
   	?>
        <tr> 
          <td height="30" align="center"><?=$no?></td>
          <td align="center"><?=$row->name?></td>
          <td align="center"><?=$row->level?></td>
          <td align="center"><a href="member_list.php?slevel=<?=$row->idx?>"><img src="../image/btn_memview.gif" border="0"></a></td>
          <td align="center">
            <img src="../image/btn_edit_s.gif" style="cursor:hand" onclick="document.location='level_input.php?mode=update&idx=<?=$row->idx?>';">
            <img src="../image/btn_delete_s.gif" style="cursor:hand" onclick="delLevel('<?=$row->idx?>','<?=$row->level?>');">
          </td>
        </tr>
        <tr><td colspan="20" class="t_line"></td></tr>
     <? 
     		$no++;
      }
                           
    	if($total <= 0){
    	?>
    		<tr><td height="30" colspan="10" align="center">등록된 등급이 없습니다.</td></tr>
        <tr><td colspan="20" class="t_line"></td></tr>
    	<?
    	}
      ?>
      </table>
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr><td height="5"></td></tr>
				<tr>
					<td>
						<img src="../image/btn_addlevel.gif" style="cursor:hand" onClick="document.location='level_input.php?mode=insert';">
					</td>
				</tr>
			</table>
			
<? include "../foot.php"; ?>
