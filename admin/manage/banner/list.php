<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?
$param = "code=$code";
?>
<? include "../head.php"; ?>


     <script language="JavaScript" type="text/javascript">
     <!--
     function deleteBanner( idx ){
       if(confirm('선택한 배너를 삭제하시겠습니까?\n\n삭제한 데이타는 복구할수 없습니다.')){
         document.location = 'banner_save.php?mode=delete&idx=' + idx + '&code=<?=$code?>&page=<?=$page?>';
       }
     }
     //-->
     </script>

			<?

			$sql = "select * from wiz_banner where code = '$code' order by prior, idx asc";
			$result = mysql_query($sql) or error(mysql_error());
			$total = mysql_num_rows($result);

			$rows = 20;
			$lists = 5;
			$page_count = ceil($total/$rows);
			if(!$page || $page > $page_count) $page = 1;
			$start = ($page-1)*$rows;
			$no = $total-$start;
			?>
			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">배너관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">배너를 추가/수정/삭제 관리합니다.</td>
        </tr>
      </table>
      
      <br>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>총 배너수 : <b><?=$total?></b></td>
          <td align="right"><img src="../image/btn_banadd2.gif" style="cursor:hand" onClick="document.location='input.php?mode=insert&code=<?=$code?>';"></td>
        </tr>
        <tr><td height="3"></td></tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr><td class="t_rd" colspan=20></td></tr>
        <tr class="t_th">
          <th width="8%">번호</th>
          <th width="10%">코드</th>
          <th>이미지</th>
          <th>링크주소</th>
          <th width="10%">우선순위</th>
          <th width="10%">사용여부</th>
          <th width="15%">기능</th>
        </tr>
        <tr><td class="t_rd" colspan=20></td></tr>
		<?
		$sql = "select * from wiz_banner where code = '$code' order by prior, idx asc limit $start, $rows";
		$result = mysql_query($sql) or error(mysql_error());

		while($row = mysql_fetch_object($result)){

			if($row->isuse == "N") $row->isuse = "사용안함";
			else $row->isuse = "사용함";

		?>
		  <tr>
          <td height="30" align="center"><?=$no?></td>
          <td align="center"><?=$row->code?></td>
          <td align="center">
          <?
          if($row->de_type == "IMG") echo "<img src=/admin/data/banner/$row->de_img>";
          else echo "<table><tr><td>$row->de_html</td></tr></table>";
          ?>
          </td>
          <td align="center"><?=$row->link_url?></td>
          <td align="center"><?=$row->prior?></td>
          <td align="center"><?=$row->isuse?></td>
          <td align="center">
	          <img src="../image/btn_edit_s.gif" style="cursor:hand" onClick="document.location='input.php?mode=update&idx=<?=$row->idx?>&code=<?=$code?>&page=<?=$page?>'">
	          <img src="../image/btn_delete_s.gif" style="cursor:hand" onClick="deleteBanner('<?=$row->idx?>');">
          </td>
        </tr>
        <tr><td colspan="20" class="t_line"></td></tr>
     <?
     		$no--;
      }

    	if($total <= 0){
    	?>
    		<tr><td height="30" colspan="10" align="center">등록된 배너가 없습니다.</td></tr>
        <tr><td colspan="20" class="t_line"></td></tr>
    	<?
    	}
      ?>
      </table>
      <table width="100%" height="10" border="0" cellpadding="0" cellspacing="0">
      	<tr><td height="5"></td></tr>
        <tr>
          <td align="center"><? print_pagelist($page, $lists, $page_count, $param); ?></td>
        </tr>
      </table>

<? include "../foot.php"; ?>
