<script language="JavaScript">
<!--
function postSearch(){
   document.bbsFrm.address.focus();
   var url = "/admin/member/post_search.php";
   window.open(url, "postSearch", "width=427, height=400, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, left=50, top=50");
}
function bbsCheck(frm){

  if(frm.name.value == ""){
    alert("작성자를 입력하세요.");
    frm.name.focus();
    return false;
  }
  if(frm.passwd != null && frm.passwd.value == ""){
    alert("비밀번호를 입력하세요.");
    frm.passwd.focus();
    return false;
  }
  if(frm.subject.value == ""){
    alert("지점명을 입력하세요.");
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

}
-->
</script>
<form name="bbsFrm" action="<?=$PHP_SELF?>" method="post" enctype="multipart/form-data" onSubmit="return bbsCheck(this)">
<input type="hidden" name="ptype" value="save">
<input type="hidden" name="code" value="<?=$code?>">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="idx" value="<?=$idx?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="searchopt" value="<?=$searchopt?>">
<input type="hidden" name="searchkey" value="<?=$searchkey?>">
<input type="hidden" name="tmp_vcode" value="<?=md5($norobot_key)?>">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
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
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>지점명 *</strong></td>
    <td align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;"><?=$catlist?><input name="subject" value="<?=$subject?>" type="text" size="20" class="input" /></td>
    <td align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>영업시간</strong></td>
    <td align="left" style="padding-left:10px;"><input name="addinfo2" value="<?=$addinfo2?>" type="text" size="20" class="input" /></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>        
  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>연락처</strong></td>
    <td align="left" style="padding-left:10px; border-right:1px solid #d7d7d7;"><input name="tphone" value="<?=$tphone?>" type="text" size="20" class="input" /></td>
    <td align="center" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>팩스</strong></td>
    <td align="left" style="padding-left:10px;"><input name="addinfo1" value="<?=$addinfo1?>" type="text" size="20" class="input" /></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>  
  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>주소</strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><input name="address" value="<?=$address?>" type="text" size="60" class="input" /> <span onClick="postSearch()" style="cursor:pointer">[주소찾기]</span></td>
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
  <tr>
     <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>

  <tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>약도</strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><input type="file" name="upfile1" size="20" class="input" /> <?=$upfile1?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
	<tr>
    <td align="center" height="30" bgcolor="#f9f9f9" style="padding-left:10px; border-right:1px solid #d7d7d7;"><strong>이미지</strong></td>
    <td align="left" colspan="3" style="padding-left:10px;"><input type="file" name="upfile2" size="20" class="input" /> <?=$upfile2?></td>
  </tr>
  <tr>
    <td colspan="4" height="1" bgcolor="#d7d7d7"></td>
  </tr>
	
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
</form>
