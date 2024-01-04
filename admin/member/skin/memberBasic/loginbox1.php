<?
/*
<?=$join_url?>					: 회원가입 주소
<?=$idpw_url?>					: 아이디,비번찾기 주소
*/
?>
<script language="javascript">
<!--
function loginboxCheck(frm){
	if(frm.id.value == ""){
		alert("아이디를 입력하세요.");
		frm.id.focus();
		return false;
	}
	if(frm.passwd.value == ""){
		alert("비밀번호를 입력하세요.");
		frm.passwd.focus();
		return false;
	}

	if(frm.secure_login != undefined) {
		if(!frm.secure_login.checked){
			frm.action = "/admin/member/login_check.php";
		}
	}
}
-->
</script>
<form name="loginboxFrm" action="<?=$ssl?>/admin/member/login_check.php" method="post" onSubmit="return loginboxCheck(this)">
<input type="hidden" name="prev" value="<?=$self_page?>">
<table width="165">
	<tr>
	   <td>
	   	<table cellspacing="0" cellpadding="0">
				<tr>
					<td><input name="id" type="text" class="input" size="16" /></td>
				</tr>
				<tr>
					<td><input name="passwd" type="password" class="input" size="16" /></td>
				</tr>
			</table>
		</td>
		<td><input type="image" src="<?=$skin_dir?>/image/btn_m_login.gif" /></td>
	</tr>
	<tr>
		<td colspan="2" height="10" align="left">
			<?=$hide_ssl_start?>
			<input type="checkbox" name="secure_login" value="Y" checked>보안접속
			<?=$hide_ssl_end?>
		</td>
	</tr>
	<tr>
		<td colspan="2"><a href="<?=$join_url?>"><img src="<?=$skin_dir?>/image/btn_m_join.gif" border="0"></a><a href="<?=$idpw_url?>"><img src="<?=$skin_dir?>/image/btn_m_find.gif" border="0"></a></td>
	</tr>
</table>
</form>

<?
/*
가로형 로그인
<table border="0" height="30" cellpadding="0" cellspacing="0">
<form name="loginboxFrm" action="/admin/member/login_check.php" method="post" onSubmit="return inputCheck(this)">
<input type="hidden" name="prev" value="<?=$self_page?>">
  <tr>
    <td>
    	<table border="0" cellspacing="0" cellpadding="1">
        <tr>
          <td><img src="<?=$skin_dir?>/image/txt_id.gif" border="0"></td>
          <td><input name="id" type="text" size="15" class="input"></td>
          <td><img src="<?=$skin_dir?>/image/txt_pw.gif" border="0"></td>
          <td><input name="passwd" type="password" size="15" class="input"></td>
          <?=$hide_ssl_start?>
          <td>
            <input type="checkbox" name="secure_login" value="Y" checked>보안접속
          </td>
          <?=$hide_ssl_end?>
          <td><input type="image" src="<?=$skin_dir?>/image/bt_login2.gif"></td>
          <td><a href="<?=$join_url?>"><img src="<?=$skin_dir?>/image/bt_join2.gif" border="0"></a></td>
          <td><a href="<?=$idpw_url?>"><img src="<?=$skin_dir?>/image/bt_idpw2.gif" border="0"></a></td>
        </tr>
        <tr>
          <td></td>
        </tr>
      </table>
    </td>
  </tr>
</form>
</table>
*/
?>
