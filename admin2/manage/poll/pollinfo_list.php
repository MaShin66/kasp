<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<?
$param = "searchopt=".$searchopt."&searchkey=".$searchkey;
?>
<? include "../head.php"; ?>
<script language="JavaScript" type="text/javascript">
<!--
function delConfirm(code){
	if(confirm("삭제 하시겠습니까?")){
		document.location = "pollinfo_save.php?mode=delete&code=" + code; 
	}
}
//-->
</script>

			<?
			$sql = "select count(code) as all_total from wiz_pollinfo";
			$result = mysql_query($sql) or error(mysql_error());
			$row = mysql_fetch_object($result);
			$all_total = $row->all_total;
			
			if($searchopt != "") $search_sql .= " where $searchopt like '%$searchkey%' ";
			
			$sql = "select * from wiz_pollinfo $search_sql order by code desc";
			$result = mysql_query($sql) or error(mysql_error());
			$total = mysql_num_rows($result);
			
			$rows = 20;
			$lists = 5;
			$page_count = ceil($total/$rows);
			if(!$page || $page > $page_count) $page = 1;
			$start = ($page-1)*$rows;
			$no = $total-$start;
			
			if($start>1) mysql_data_seek($result,$start);
			
			?>
			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">설문관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">설문을 추가/삭제, 상세기능을 설정합니다.</td>
        </tr>
      </table>
      
      <br>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>총 설문수 : <b><?=$all_total?></b></td>
          <td align="right">
          <img src="../image/btn_polladd.gif" style="cursor:hand" onClick="document.location='pollinfo_input.php?mode=insert';">
          </td>
        </tr>
      </table> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr><td class="t_rd" colspan=20></td></tr>
        <tr class="t_th">
          <th width="8%">번호</th>
          <th width="10%">코드</th>
          <th>설문명</th>
          <th>스킨</th>
          <th width="15%">기능</th>
        </tr>
        <tr><td class="t_rd" colspan=20></td></tr>
			<?
			while(($row = mysql_fetch_array($result)) && $rows){
			?>
        <tr> 
          <td height="30" align="center"><?=$no?></td>
          <td align="center"><?=$row[code]?></td>
          <td align="center"><a href="pollinfo_input.php?mode=update&code=<?=$row[code]?>&page=<?=$page?>&<?=$param?>"><?=$row[title]?></a></td>
          <td align="center"><?=$row[skin]?></td>
          <td align="center">
          <img src="../image/btn_edit_s.gif" style="cursor:hand" onClick="document.location='pollinfo_input.php?mode=update&code=<?=$row[code]?>&page=<?=$page?>&<?=$param?>';">
          <img src="../image/btn_delete_s.gif" style="cursor:hand" onClick="delConfirm('<?=$row[code]?>')">
          </td>
        </tr>
        <tr><td colspan="20" class="t_line"></td></tr>
			<?
				$no--;
				$rows--;
			}
			             
			if($total <= 0){
			?>
    	  <tr><td height="30" colspan="10" align="center">등록된 설문이 없습니다.</td></tr>
        <tr><td colspan="20" class="t_line"></td></tr>
			<?
			}
			?>
      </table>

      <table width="100%" height="10" border="0" cellpadding="0" cellspacing="0">
      	<tr><td height="5"></td></tr>
        <tr> 
          <td><? print_pagelist($page, $lists, $page_count, $param); ?></td>
        </tr>
      </table>
      
<? include "../foot.php"; ?>
