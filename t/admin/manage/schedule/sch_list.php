<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include "../head.php"; ?>


     <script language="JavaScript" type="text/javascript">
     <!--
     function deleteBbs(code){
       if(confirm('선택한 일정을 삭제하시겠습니까?\n\n삭제한 데이타는 복구할수 없습니다.')){
         document.location = 'sch_save.php?mode=delete&code=' + code + '&page=<?=$page?>';
       }
     }
     //-->
     </script>

			<?
			$level_info = level_info();

			$sql = "select * from wiz_bbsinfo where type='SCH' order by code";
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
          <td valign="bottom" class="tit">일정관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">일정을 추가/삭제, 상세기능을 설정합니다.</td>
        </tr>
      </table>

      <br>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>총 일정수 : <b><?=$total?></b></td>
          <td align="right"><img src="../image/btn_schadd.gif" style="cursor:hand" onClick="document.location='sch_input.php?mode=insert';"></td>
        </tr>
        <tr><td height="3"></td></tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr><td class="t_rd" colspan=20></td></tr>
        <tr class="t_th">
          <th width="8%">번호</th>
          <th width="10%">영문명</th>
          <th>일정명</th>
          <th width="10%">목록보기</th>
          <th width="10%">내용보기</th>
          <th width="10%">글쓰기</th>
          <th width="10%">코멘트쓰기</th>
          <th width="10%">기능</th>
        </tr>
        <tr><td class="t_rd" colspan=20></td></tr>
				<?
				$sql = "select * from wiz_bbsinfo where type='SCH' order by code limit $start, $rows";
				$result = mysql_query($sql) or error(mysql_error());

				while($row = mysql_fetch_object($result)){
				?>
		  	<tr>
          <td height="30" align="center"><?=$no?></td>
          <td align="center"><a href="sch_input.php?mode=update&code=<?=$row->code?>&page=<?=$page?>"><?=$row->code?></a></td>
          <td align="center"><a href="sch_input.php?mode=update&code=<?=$row->code?>&page=<?=$page?>"><?=$row->title?></a></td>
          <td align="center"><?=$level_info[$row->lpermi][name]?></td>
          <td align="center"><?=$level_info[$row->rpermi][name]?></td>
          <td align="center"><?=$level_info[$row->wpermi][name]?></td>
          <td align="center"><?=$level_info[$row->cpermi][name]?></td>
          <td align="center">
          <img src="../image/btn_edit_s.gif" style="cursor:hand" onClick="document.location='sch_input.php?mode=update&code=<?=$row->code?>&page=<?=$page?>'">
          <img src="../image/btn_delete_s.gif" style="cursor:hand" onClick="deleteBbs('<?=$row->code?>');">
          </td>
        </tr>
        <tr><td colspan="20" class="t_line"></td></tr>
				<?
				$no--;
				}

				if($total <= 0){
				?>
				<tr><td height="30" colspan="10" align="center">등록된 일정이 없습니다.</td></tr>
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
