<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include "../head.php"; ?>

     <script language="JavaScript" type="text/javascript">
     <!--
     function deleteBbs(code){
       if(confirm('선택한 게시판을 삭제하시겠습니까?\n\n삭제한 데이타는 복구할수 없습니다.')){
         document.location = 'bbs_save.php?mode=delete&code=' + code + '&page=<?=$page?>';
       }
     }
     //-->
     </script>
			
			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">게시판관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">게시판을 추가/삭제, 상세기능을 설정합니다.</td>
        </tr>
      </table>
      
			<?
			$level_info = level_info();
			
			$sql = "select * from wiz_bbsinfo where type='BBS' order by code";
			$result = mysql_query($sql) or error(mysql_error());
			$total = mysql_num_rows($result);

			$rows = 20;
			$lists = 5;
			$page_count = ceil($total/$rows);
			if(!$page || $page > $page_count) $page = 1;
			$start = ($page-1)*$rows;
			$no = $total-$start;
			
			?>
			<br>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>총 게시판수 : <b><?=$total?></b></td>
          <td align="right">
						<?
						if(strcmp($site_info[addbbs_use], "N") || !strcmp($wiz_admin[designer], "Y")) {
						?>	
          	<img src="../image/btn_bbsadd.gif" style="cursor:hand" onClick="document.location='bbs_input.php?mode=insert';">
          	<?
          	}
          	?>
          </td>
        </tr>
      </table> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr><td colspan=20 class="t_rd"></td></tr>
        <tr class="t_th">
          <th width="8%">번호</th>
          <th width="8%">그룹명</th>
          <th width="8%">영문명</th>
          <th>게시판명</th>
          <th width="8%">스킨</th>
          <th width="8%">목록보기</th>
          <th width="8%">내용보기</th>
          <th width="8%">글쓰기</th>
          <th width="8%">답글쓰기</th>
          <th width="8%">코멘트쓰기</th>
          <th width="10%">기능</th>
        </tr>
        <tr><td colspan=20 class="t_rd"></td></tr>
				<?
				
				$sql = "select * from wiz_bbsinfo where type='BBS' order by grp asc, prior asc limit $start, $rows";
				$result = mysql_query($sql) or error(mysql_error());
				
				while($row = mysql_fetch_object($result)){					
					if(empty($row->grp)) $bbs_grp_list[$row->grp] = "-";
				?>
		  	<tr> 
          <td height="30" align="center"><?=$no?></td>
          <td align="center"><a href="bbs_input.php?mode=update&code=<?=$row->code?>&page=<?=$page?>"><?=$bbs_grp_list[$row->grp]?></a></td>
          <td align="center"><a href="bbs_input.php?mode=update&code=<?=$row->code?>&page=<?=$page?>"><?=$row->code?></a></td>
          <td align="center"><a href="bbs_input.php?mode=update&code=<?=$row->code?>&page=<?=$page?>"><?=$row->title?></a></td>
          <td align="center"><?=$row->skin?></td>
          <td align="center"><?=$level_info[$row->lpermi][name]?></td>
          <td align="center"><?=$level_info[$row->rpermi][name]?></td>
          <td align="center"><?=$level_info[$row->wpermi][name]?></td>
          <td align="center"><?=$level_info[$row->apermi][name]?></td>
          <td align="center"><?=$level_info[$row->cpermi][name]?></td>
          <td align="center">
          <a href="bbs_input.php?mode=update&code=<?=$row->code?>&page=<?=$page?>"><img src="../image/btn_edit_s.gif" border="0"></a>
          <img src="../image/btn_delete_s.gif" onClick="deleteBbs('<?=$row->code?>');" style="cursor:hand">
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
      
      <br>
      <table width="100%" height="10" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td align="center"><? print_pagelist($page, $lists, $page_count, $param); ?></td>
        </tr>
      </table>
      
<? include "../foot.php"; ?>
