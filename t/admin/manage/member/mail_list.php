<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<? include "../head.php"; ?>


<script language="javascript">
<!--
function delConfirm(code){
	
	if(confirm("정말 삭제하시겠습니까?")){
		document.location = "mail_save.php?mode=delete&code=" + code;
	}
	
}
-->
</script>
			
			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">메세지설정</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">상황별 메일/SMS발송 내용을 관리합니다.</td>
        </tr>
      </table>
      
      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr><td colspan=20 class="t_rd"></td></tr>
        <tr class="t_th">
          <th width="8%">번호</th>
          <th width="15%">코드</th>
          <th>분류명</th>
          <th width="10%">발송여부</th>
          <th width="10%">기능</th>
        </tr>
        <tr><td colspan=20 class="t_rd"></td></tr>
      <?
      function getYesNo($yn){
      	if($yn == "N") return "발송안함";
      	else return "발송함";
      }

      $sql = "select * from wiz_mailsms order by wdate asc";
      $result = mysql_query($sql) or error(mysql_error());
      $total = mysql_num_rows($result);
      $no = $total;
      while($row = mysql_fetch_object($result)){
      	
				// stripslashes()
				$row->subject 		= stripslashes($row->subject);
				$row->sms_msg 		= stripslashes($row->sms_msg);
				$row->email_subj = stripslashes($row->email_subj);
				$row->email_msg 	= stripslashes($row->email_msg);
      ?>
        <tr> 
          <td height="30" align="center"><?=$no?></td>
          <td align="center"><?=$row->code?></td>
          <td><a href="mail_input.php?mode=update&code=<?=$row->code?>"><?=$row->subject?></a></td>
          <td align="center"><?=getYesNo($row->email_send)?></td>
          <td align="center">
            <img src="../image/btn_edit_s.gif" style="cursor:hand" onclick="document.location='mail_input.php?mode=update&code=<?=$row->code?>';">
            <? if($row->type == "ADD") { ?>
            <img src="../image/btn_delete_s.gif" style="cursor:hand" onclick="delConfirm('<?=$row->code?>');">
            <? } ?>
          </td>
        </tr>
        <tr><td colspan="20" class="t_line"></td></tr>
      <?
      	$no--;
   	  }
   	  
   	  if($total <= 0){
    	?>
    	  <tr><td height="30" colspan="10" align="center">등록된 메일이 없습니다.</td></tr>
        <tr><td colspan="20" class="t_line"></td></tr>
    	<?
    	}
   	  ?>
   	</table>
   	
   	<table width="100%" border="0" cellspacing="0" cellpadding="0">
   		<tr><td height="5"></td></tr>
   		<tr>
   			<td>
   			<img src="../image/btn_addmail.gif" style="cursor:hand" onClick="document.location='mail_input.php?mode=insert'">
   			</td>
   		</tr>
  	</table>

<? include "../foot.php"; ?>
