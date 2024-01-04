<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?
// 회원정보
if($mode == "") $mode = "insert";
if($mode == "update"){
	$sql = "select * from wiz_message where idx = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	$msg_info = mysql_fetch_array($result);
}
?>
<? include_once "../../inc/mem_info.php"; ?>
<?
$param = "slevel=".$slevel."&searchopt=".$searchopt."&searchkey=".$searchkey."&page=".$page;
?>
<? include "../head.php"; ?>

<script language="javascript">
<!--
function inputCheck(frm){

   if(frm.subject.value == ""){
      alert("제목을 입력하세요");
      frm.subject.focus();
      return false;
   }
   if(frm.content.value == ""){
      alert("내용을 입력하세요");
      frm.content.focus();
      return false;
   }

}
-->
</script>
</head>

			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">쪽지목록</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">주고받은 쪽지를 관리합니다.</td>
        </tr>
      </table>

      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><b>발송일</b> : <?=$msg_info[wdate]?></td>
        </tr>
      </table>
	  <form name="frm" action="message_save.php?<?=$param?>" method="post" enctype="multipart/form-data" onSubmit="return inputCheck(this);">
      <input type="hidden" name="tmp">
      <input type="hidden" name="mode" value="<?=$mode?>">
      <input type="hidden" name="idx" value="<?=$idx?>">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td width="15%" class="t_name">보낸사람(이름)</td>
                <td width="35%" class="t_value"><input name="re_name" type="text" value="<?=$msg_info[se_name]?>" class="input" <? if($mode == "update") echo "readonly"; ?>></td>
                <td width="15%" class="t_name">보낸사람(아이디)</td>
                <td width="35%" class="t_value"><input name="re_id" type="text" value="<?=$msg_info[se_id]?>" class="input" <? if($mode == "update") echo "readonly"; ?>></td>
              </tr>
              <tr>
                <td class="t_name">받은사람(이름)</td>
                <td class="t_value"><input name="se_name" type="text" value="<?=$msg_info[re_name]?>" class="input" <? if($mode == "update") echo "readonly"; ?>></td>
                <td class="t_name">받은사람(아이디)</td>
                <td class="t_value"><input name="se_id" type="text" value="<?=$msg_info[re_id]?>" class="input" <? if($mode == "update") echo "readonly"; ?>></td>
              </tr>
              <tr>
                <td class="t_name">제목</td>
                <td class="t_value" colspan=3>
                	<input name="subject" type="text" value="<?=$msg_info[subject]?>" class="input" size=90>
                </td>
              </tr>
              <tr>
                <td height="25" class="t_name">내용</td>
                <td class="t_value" colspan="3">
                <textarea name="content" rows="5" cols="90" class="textarea"><?=$msg_info[content]?></textarea>
                </td>
              </tr>
              <tr>
                <td class="t_name">첨부파일</td>
                <td class="t_value" colspan=3>
                	<input name="upfile" type="file" class="input">
                <? if($msg_info[upfile] != ""){ ?>
                	<a href="message_save.php?mode=delfile&idx=<?=$idx?>&file=<?=$msg_info[upfile]?>&se_id=<?=$msg_info[se_id]?>">[삭제]</a>&nbsp;
                	<a href='../../data/message/<?=$msg_info[se_id]?>/<?=$msg_info[upfile]?>' target='_blank'><?=$msg_info[upfile_name]?></a>
                <? } ?>
                </td>
              </tr>
              <tr>
                <td class="t_name">수신여부</td>
                <td class="t_value" colspan=3>
                	<input name="status" type="radio" value="Y" <? if(!strcmp($msg_info[status], 'Y')) echo 'checked' ?>> 읽음
                	<input name="status" type="radio" value="N" <? if(!strcmp($msg_info[status], 'N') || empty($msg_info[status])) echo 'checked' ?>> 읽지않음
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>

      <br>
      <table align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
          	<input type="image" src="../image/btn_confirm_l.gif"> &nbsp;
          	<img src="../image/btn_list_l.gif" style="cursor:hand" onClick="document.location='message_list.php?<?=$param?>';">
          </td>
        </tr>
      </table>
	  </form>

<? include "../foot.php"; ?>
