<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include "../head.php"; ?>

     <script language="JavaScript" type="text/javascript">
     <!--
     function deleteBanner( idx, code ){
       if(confirm('선택한 배너그룹을 삭제하시겠습니까?\n\n삭제한 데이타는 복구할수 없습니다.')){
         document.location = 'banner_save.php?mode=ban_delete&idx=' + idx + '&code=' + code + '&page=<?=$page?>';
       }
     }
     //-->
     </script>

			<?
			
			$sql = "select * from wiz_bannerinfo order by title";
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
          <td valign="bottom" class="tit">배너그룹관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">배너그룹을 추가/수정/삭제 관리합니다.</td>
        </tr>
      </table>
      
      <br>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>총 배너그룹수 : <b><?=$total?></b></td>
          <td align="right"><img src="../image/btn_banadd.gif" style="cursor:hand" onClick="document.location='banner_input.php?mode=ban_insert';"></td>
        </tr>
        <tr><td height="3"></td></tr>
      </table> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr><td class="t_rd" colspan=20></td></tr>
        <tr class="t_th">
        	<th width="8%">번호</th>
          <th>그룹명</th>
          <th width="10%">코드</th>
          <th width="10%">이미지</th>
          <th width="10%">형태</th>
          <th width="10%">배너개수</th>
          <th width="10%">사용여부</th>
          <th width="20%">기능</th>
        </tr>
        <tr><td class="t_rd" colspan=20></td></tr>
				<?
				$sql = "select * from wiz_bannerinfo order by title limit $start, $rows";
				$result = mysql_query($sql) or error(mysql_error());
					
				while($row = mysql_fetch_object($result)){
					
		      $sql = "select * from wiz_banner where code='$row->code'";
		      $result2 = mysql_query($sql) or error(mysql_error());
		      $ban_image = mysql_num_rows($result2);
		      
		      	if($row->types == "W") $row->types = "가로";
		         else $row->types = "세로";
		         
		        if($row->isuse == "N") $row->isuse = "사용안함";
		         else $row->isuse = "사용함";
				?>
		  	<tr> 
		  		<td align="center"><?=$no?></td>
          <td height="30" align="center"><a href="banner_input.php?mode=ban_update&idx=<?=$row->idx?>&page=<?=$page?>"><?=$row->title?></a></td>
          <td align="center"><a href="banner_input.php?mode=ban_update&idx=<?=$row->idx?>&page=<?=$page?>"><?=$row->code?></a></td>
          <td align="center"><?=$ban_image?></td>
          <td align="center"><?=$row->types?></td>
          <td align="center"><?=$row->types_num?></td>
          <td align="center"><?=$row->isuse?></td>
          <td align="center">
	          <img src="../image/btn_banlist.gif" style="cursor:hand" onClick="document.location='list.php?code=<?=$row->code?>'">
	          <img src="../image/btn_edit_s.gif" style="cursor:hand" onClick="document.location='banner_input.php?mode=ban_update&idx=<?=$row->idx?>&page=<?=$page?>'">
	          <img src="../image/btn_delete_s.gif" style="cursor:hand" onClick="deleteBanner('<?=$row->idx?>', '<?=$row->code?>');">
          </td>
        </tr>
        <tr><td colspan="20" class="t_line"></td></tr>
	     <?
	     		$no--;
	      }
	                           
	    	if($total <= 0){
	    	?>
	    		<tr><td height="30" colspan="10" align="center">등록된 배너그룹이 없습니다.</td></tr>
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
      <table width="100%" height="10" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td align="center"><? print_pagelist($page, $lists, $page_count, $param); ?></td>
        </tr>
      </table>
      
<? include "../foot.php"; ?>
