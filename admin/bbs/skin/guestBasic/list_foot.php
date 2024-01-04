<?
$mode = "insert";
$confirm_btn = "<input type='image' src='$skin_dir/image/btn_confirm.gif' border='0'>";
$cancel_btn = "<img src='$skin_dir/image/btn_cancel.gif' border='0' onClick='history.go(-1)' style='cursor:hand'>";

if($row[name] == "") $name = $wiz_session[name];
if($row[email] == "") $email = $wiz_session[email];

$sql = "select nick from wiz_member where id = '$wiz_session[id]'";
$result = mysql_query($sql) or error(mysql_error());
$mem_info = mysql_fetch_array($result);

$nick = $mem_info[nick];

if((!strcmp($bbs_info[name_type], "nick") || !strcmp($bbs_info[name_type], "inick")) && !empty($nick)) $name = $nick;

// 비밀번호 숨김
if($wiz_session[id] != ""){
	$hide_passwd_start = "<!--"; $hide_passwd_end = "-->";
}
// 쓰기권한 체크
if($wpermi < $mem_level){
	$wpermi_check = "alert('$bbs_info[permsg]'); return false;";
}
?>

<script language="JavaScript">
<!--
function bbsCheck(frm){
	
	<?=$wpermi_check?>
	
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
  if(frm.content.value == ""){
    alert("내용을 입력하세요.");
    frm.content.focus();
    return false;
  } 

  if (frm.vcode != undefined && (hex_md5(frm.vcode.value) != md5_norobot_key)) {
  	alert("자동등록방지코드를 정확히 입력해주세요.");
    frm.vcode.focus();
    return false;
	}
}

function layerchk(mode, idx){
	
	var modify = document.getElementById('modify'+idx);
	var view = document.getElementById('view'+idx);
	var reply = document.getElementById('reply'+idx);
	
	if(mode == "modify") {
		modify.style.display="block";
		view.style.display="none";
		reply.style.display="none";
	} else if(mode == "view") {
		modify.style.display="none";
		view.style.display="block";
		reply.style.display="none";
	} else if(mode == "reply") {
		modify.style.display="none";
		view.style.display="block";
		reply.style.display="block";
	}
	
}

function layerchk2(idx){
	document.getElementById('view'+idx).style.display="";
	document.getElementById('modify'+idx).style.display="none";
}

-->
</script>
<table cellspacing="0" cellpadding="0" width="100%" border="0">
<form name="frm" action="<?=$PHP_SELF?>" method="post" enctype="multipart/form-data" onSubmit="return bbsCheck(this)">
<input type="hidden" name="ptype" value="save">
<input type="hidden" name="code" value="<?=$code?>">
<input type="hidden" name="mode" value="<?=$mode?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="searchopt" value="<?=$searchopt?>">
<input type="hidden" name="searchkey" value="<?=$searchkey?>">
<input type="hidden" name="tmp_vcode" value="<?=md5($norobot_key)?>">
<input type="hidden" name="subject" value="방명록입니다.">
		<tr>
	    <td height="1" bgcolor="#efefef"></td>
	  </tr>
	  <tr><td height="5"></td></tr>
    <tr>
      <td align="left">
      	<table cellspacing="0" cellpadding="0" border="0">
          <tr>
            <td>이름</td>
            <td style="PADDING-LEFT: 10px"><input class="input" name="name" value="<?=$name?>" style="width:100px" /></td>
          </tr>
        	<?=$hide_passwd_start?>
        	<tr>
          	<td>비밀번호</td>
          	<td style="PADDING-LEFT: 10px"><input class="input" type="password" name="passwd" style="width:100px" /></td>
          </tr>
        	<?=$hide_passwd_end?>
          <tr>
            <td>이메일</td>
            <td style="PADDING-LEFT: 10px"><input class="input" type="text" name="email" value="<?=$email?>"style="width:200px"/></td>
          </tr>
          <tr>
            <td>홈페이지</td>
            <td style="PADDING-LEFT: 10px"><input class="input" type="text" name="address" value="http://"style="width:200px"/></td>
          </tr>
          <?=$hide_spam_check_start?>
          <tr>
            <td>자동등록<br>방지코드</td>
            <td style="PADDING-LEFT: 10px"><?=$spam_check?> </td>
          </tr>
          <?=$hide_spam_check_end?>
          <tr>
          	<td colspan="4">
          		<table cellspacing="0" cellpadding="0" border="0">
                <tr>
                  <td>
                  	<textarea class="input" style="WIDTH: 350px; HEIGHT: 50px" name="content" cols="10"></textarea>
                  </td>
                  <td> &nbsp;<input type="image" src="<?=$skin_dir?>/image/bt_register.gif" /></td>
                </tr>
              </table>
    				</td>
    			</tr>
    		</table>
      </td>
    </tr>
  </tbody>
</form>
</table>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr><td height=5></td></tr>
  <tr>
    <td height="2" bgcolor="#a9a9a9"></td>
  </tr>
</table>
<!-- 페이지 번호 -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" align="center">
			<? print_pagelist($page, $lists, $page_count, $param); ?>
    </td>
  </tr>
</table>  
<!-- 페이지 번호끝 -->

<!-- 버튼 -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
  	<td align="left" style="padding-top:10px"><?=$sel_delete_btn?> <?=$sel_copy_btn?> <?=$sel_move_btn?> <?=$order_btn?></td>
    <td align="right" style="padding-top:10px"><?=$list_btn?>&nbsp;<?=$write_btn?></td>
  </tr>
</table>  
<!-- 버튼 끝 -->
