<?
if(!strcmp($mode, "reply")) {

	$mode = "modify";

	// 게시물 정보
	$sql = "select *, FROM_UNIXTIME(wdate) as wdate from wiz_bbs where idx = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	$bbs_row = mysql_fetch_array($result);

	$name = $bbs_row[name];
	$email = $bbs_row[email];
	$subject = $bbs_row[subject];
	$content = $bbs_row[content];
	$reply 	 = $bbs_row[reply];

	$tphone	= $bbs_row[tphone];
	$hphone	= $bbs_row[hphone];
	$zipcode	= $bbs_row[zipcode];
	$address	= $bbs_row[address];

	$addinfo1	= $bbs_row[addinfo1];
	$addinfo2	= $bbs_row[addinfo2];
	$addinfo3	= $bbs_row[addinfo3];
	$addinfo4	= $bbs_row[addinfo4];
	$addinfo5	= $bbs_row[addinfo5];

	$wdate	= $bbs_row[wdate];

	for($ii = 1; $ii <= $upfile_max; $ii++) {
		if(!empty($bbs_row[upfile.$ii])) {
			${upfile.$ii} = "<input type='checkbox' name='delupfile[]' value='upfile".$ii."'> 삭제 (".$bbs_row[upfile.$ii._name].")";
		}
	}
	if(!empty($bbs_row[movie1])) {
		$movie1 = "<input type='checkbox' name='delupfile[]' value='movie1'> 삭제 ($bbs_row[movie1])";
	}

	$movie2 = $bbs_row[movie2];
	$movie3 = $bbs_row[movie3];

	// 비밀번호 숨김
	if(
	$mem_level == "0" || 																																			// 전체관리자
	($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)  ||	// 게시판관리자
	($bbs_row[memid] != "" && $wiz_session[id] == $bbs_row[memid])														// 자신에글
	){
		$hide_passwd_start = "<!--"; $hide_passwd_end = "-->";
	}

	// 공지글 표시
	if(
	$mem_level == "0" || 																																			// 전체관리자
	($bbs_info[bbsadmin] != "" && strpos($bbs_info[bbsadmin],$wiz_session[id]) !== false)			// 게시판관리자
	){
	}else{
		$hide_notice_start = "<!--"; $hide_notice_end = "-->";
	}

	if($bbs_row[ctype] == "H") $ctype_checked = "checked";
	if($bbs_row[privacy] == "Y") $privacy_checked = "checked";
	if($bbs_row[notice] == "Y") $notice_checked = "checked";
	if($bbs_row[status] == "Y") $status_checked = "checked";

	// 답변권한이 없을 때 숨김
	if($apermi < $mem_level) {
		$hide_reply_start = "<!--"; $hide_reply_end = "-->";
	}

} else {
	$hide_reply_start = "<!--"; $hide_reply_end = "-->";
}
?>
<script language="JavaScript">
<!--
function bbsCheck(frm){

  if(frm.name.value == ""){
    alert("작성자를 입력하세요.");
    frm.name.focus();
    return false;
  }
  if(frm.addinfo1.value == ""){
    alert("병명을 입력하세요.");
    frm.addinfo1.focus();
    return false;
  }
  if(!frm.addinfo2[0].checked && !frm.addinfo2[1].checked){
    alert("성별을 선택하세요.");
    frm.addinfo2[0].focus();
    return false;
  }
  if(frm.addinfo3.value == ""){
    alert("나이를 입력하세요.");
    frm.addinfo3.focus();
    return false;
  }
  if(frm.tphone.value == ""){
    alert("연락처를 입력하세요.");
    frm.tphone.focus();
    return false;
  }
  if(frm.passwd != null && frm.passwd.value == ""){
    alert("비밀번호를 입력하세요.");
    frm.passwd.focus();
    return false;
  }
  if(frm.subject.value == ""){
    alert("제목을 입력하세요.");
    frm.subject.focus();
    return false;
  }
	try{ content.outputBodyHTML(); } catch(e){ }
  if(frm.content.value == ""){
		alert("내용을 입력하세요.");
		return false;
  }
  if (frm.vcode != undefined && (hex_md5(frm.vcode.value) != md5_norobot_key)) {
  	alert("자동등록방지코드를 정확히 입력해주세요.");
    frm.vcode.focus();
    return false;
	}
	reply.outputBodyHTML();
}
-->
</script>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
<form name="bbsFrm" action="<?=$PHP_SELF?>" method="post" enctype="multipart/form-data" onSubmit="return bbsCheck(this)">
<input type="hidden" name="ptype" value="save">
<input type="hidden" name="code" value="<?=$code?>">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="idx" value="<?=$idx?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="searchopt" value="<?=$searchopt?>">
<input type="hidden" name="searchkey" value="<?=$searchkey?>">
<input type="hidden" name="tmp_vcode" value="<?=md5($norobot_key)?>">
  <tr>
    <td colspan="4" align="right" height="25"><font color="#000000">*</font> 표시는 필수입력 사항으로 글 작성시 반드시 기재해야 하는 항목입니다.</td>
  </tr>
  <tr>
    <td colspan="4" height="2" bgcolor="#a9a9a9"></td>
  </tr>
  <tr>
    <td width="15%" align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>작성자 *</strong></td>
    <td width="35%" align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;"><input name="name" value="<?=$name?>" type="text" size="20" class="input" /></td>
    <td width="15%" align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>이메일</strong></td>
    <td width="35%" align="left" style="padding-left:10px;"><input name="email" value="<?=$email?>" type="text" size="30" class="input" /></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>병명 *</strong></td>
    <td align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;"><input name="addinfo1" value="<?=$addinfo1?>" type="text" size="20" class="input" /></td>
    <td align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>성별 *</strong></td>
    <td align="left" style="padding-left:10px;">
    	<input type="radio" name="addinfo2" value="남" <? if(!strcmp($addinfo2, "남")) echo "checked" ?>> 남
    	<input type="radio" name="addinfo2" value="여" <? if(!strcmp($addinfo2, "여")) echo "checked" ?>> 여
    </td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>나이 *</strong></td>
    <td align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;"><input name="addinfo3" value="<?=$addinfo3?>" type="text" size="20" class="input" /></td>
    <td align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>연락처 *</strong></td>
    <td align="left" style="padding-left:10px;"><input name="tphone" value="<?=$tphone?>" type="text" size="20" class="input" /></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <?=$hide_admin_start?>
  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>작성일</strong></td>
    <td align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;"><input name="wdate" value="<?=$wdate?>" type="text" size="20" class="input" /></td>
    <td align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>조회수</strong></td>
    <td align="left" style="padding-left:10px;"><input name="count" value="<?=$count?>" type="text" size="20" class="input" /></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <?=$hide_admin_end?>
  <?=$hide_passwd_start?>
  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>비밀번호 *</strong></td>
  	<td align="left" colspan="3" style="padding-left:10px;"><input name="passwd" value="<?=$passwd?>" type="password" size="20" class="input" /> * 글 수정 삭제시 필요하시 꼭 기재해 주시기 바랍니다.</td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <?=$hide_passwd_end?>
  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>제목 *</strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><?=$catlist?><input name="subject" value="<?=$subject?>" type="text" size="60" class="input" /></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <tr>
    <td colspan="4" align="center">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td valign="top" align="left">
				<input type="checkbox" name="ctype" value="H" <?=$ctype_checked?>>HTML사용
				<input type="checkbox" name="privacy" value="Y" <?=$privacy_checked?>> 비밀글
				<?=$hide_notice_start?>
				<input type="checkbox" name="notice" value="Y" <?=$notice_checked?>> 공지글
				<?=$hide_notice_end?>
			</td>
			</tr>
			<tr>
			<td align="left" valign="top">
				<?
				if($bbs_info[editor] == "Y"){
					$edit_content = $content;
					include WIZHOME_PATH."/webedit/WIZEditor.html";
				}else{
				?>
				<textarea name="content" cols="85" rows="13" class="input" style="width:98%;word-break:break-all;"><?=$content?></textarea>
				<?
				}
				?>
			</td>
			</tr>
			</table>
    </td>
  </tr>
  <?=$hide_reply_start?>
  <tr>
    <td colspan="4" align="center">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td valign="top" align="left">
				<input type="checkbox" name="status" value="Y" <?=$status_checked?>> 답변완료
			</td>
			</tr>
			<tr>
			<td align="left" valign="top">
				<?
				if($bbs_info[editor] == "Y" && empty($hide_reply_start)){
					$edit_content = $reply;
					$edit_name = "reply";
					include WIZHOME_PATH."/webedit/WIZEditor.html";
				}else{
				?>
        <textarea name="reply" cols="85" rows="13" class="input" style="width:98%;word-break:break-all;"><?=$reply?></textarea>
				<?
				}
				?>
			</td>
			</tr>
			</table>
    </td>
  </tr>
  <?=$hide_reply_end?>
  <tr>
     <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>

  <?
  for($ii=1;$ii<=5;$ii++){
  	echo ${"hide_upfile".$ii."_start"};
  ?>
  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>첨부파일<?=$ii?></strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><input type="file" name="upfile<?=$ii?>" size="20" class="input" /> <?=${"upfile".$ii}?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <?
		echo ${"hide_upfile".$ii."_end"};
	}
	?>

  <?
  for($ii=1;$ii<=3;$ii++){
  	echo ${"hide_movie".$ii."_start"};
  	if($ii == 1) $input_type = "file";
  	else $input_type = "text";
  ?>
  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>동영상<?=$ii?></strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><input type="<?=$input_type?>" name="movie<?=$ii?>" size="20" class="input" /> <?=${"movie".$ii}?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
  <?
		echo ${"hide_movie".$ii."_end"};
	}
	?>

	<?=$hide_spam_check_start?>
	<tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>자동등록방지</strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><?=$spam_check?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
	<?=$hide_spam_check_end?>

</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" style="padding-top:10px"><?=$list_btn?></td>
    <td align="right"><?=$confirm_btn?>&nbsp;<?=$cancel_btn?></td>
  </tr>
</table>
