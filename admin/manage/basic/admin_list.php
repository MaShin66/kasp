<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<? include "../head.php"; ?>


<script language="JavaScript" type="text/javascript">
<!--
function delAdmin(admin_id){
   if(confirm('해당관리자를 삭제하시겠습니까?')){
      document.location = "admin_save.php?mode=site_admin&mode=delete&admin_id=" + admin_id;
   }
}
//-->
</script>
</head>

			
			
			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">관리자목록</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">관리자를 추가/수정/삭제 합니다.</td>
        </tr>
      </table>
      
      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr><td class="t_rd" colspan=6></td></tr>
        <tr class="t_th">
          <th width="8%">번호</td>
          <th width="15%">아이디</td>
          <th>성명</td>
          <th width="20%">마지막접속</td>
          <th width="20%">등록일</td>
          <th width="10%">기능</td>
        </tr>
        <tr><td class="t_rd" colspan=6></td></tr>
      <?
      $sql = "select * from wiz_admin order by wdate desc";
      $result = mysql_query($sql) or error(mysql_error());
      $total = mysql_num_rows($result);

      $rows = 12;
      $lists = 5;
    	$page_count = ceil($total/$rows);
    	if($page < 1 || $page > $page_count) $page = 1;
    	$start = ($page-1)*$rows;
    	$no = $total-$start;
    	
      $sql = "select * from wiz_admin order by wdate desc limit $start, $rows";
      $result = mysql_query($sql) or error(mysql_error());
      
      while($row = mysql_fetch_array($result)){
      ?>
        <tr align="center"> 
          <td height="30" align="center"><?=$no?></td>
          <td><?=$row[id]?></td>
          <td><?=$row[name]?></td>
          <td><?=$row[last]?></td>
          <td><?=$row[wdate]?></td>
          <td>
            <img src="../image/btn_edit_s.gif" style="cursor:hand" onclick="document.location='admin_input.php?mode=update&id=<?=$row[id]?>&page=<?=$page?>'">
            <img src="../image/btn_delete_s.gif" style="cursor:hand" onclick="delAdmin('<?=$row[id]?>');">
          </td>
        </tr>
        <tr><td colspan="6" class="t_line"></td></tr>
      <?
      		$no--;
        }
        if($total <= 0){
      ?>
        <tr><td height="30" colspan="10" align="center">등록된 관리자가 없습니다.</td></tr>
        <tr><td height="1" colspan="10" bgcolor="EBEBEB"></td></tr>
      <?
        }
      ?>
      </table>

      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr><td height="5"></td></tr>
      	<tr>
      		<td width="33%"><img src="../image/btn_adminadd.gif" style="cursor:hand" onClick="document.location='admin_input.php?mode=insert';"></td>
      		<td width="33%"><? print_pagelist($page, $lists, $page_count, ""); ?></td>
      		<td width="33%"></td>
      	</tr>
      </table>
                             
<? include "../foot.php"; ?>
