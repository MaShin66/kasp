
<h2 class="page_tit">로그인</h2>
<div class="login_box">
  <form name="loginFrm" action="<?=$ssl?>/admin2/member/login_check.php" method="post" onSubmit="return loginCheck(this);">
    <input type="hidden" name="prev" value="<?=$prev?>">

    <input name="id" type="text" class="input_idpw" value="<?=$save_id?>" placeholder="아이디를 입력해주세요.">
    <input name="passwd" type="password" class="input_idpw" value="<?=$save_pw?>" placeholder="비밀번호를 입력해주세요.">

    <div class="ld_pw_info">
      <div class="box">
        <div class="design_chk">
          <input type="checkbox" name="secure_login" value="Y" id="id_save" checked>
          <label for="id_save">아이디 저장</label>
        </div>
      </div>
      <div class="box">
        <a href="/membership/idpw.html">아이디/비밀번호 찾기</a>
      </div>
    </div>

    <div class="submit_box">
      <input type="image" id="login_submit" src="">        
      <label for="login_submit">로그인</label>
    </div>
  </form>
  
  <div class="join_box">
    <p class="txt">아직 아이디가 없으신가요? 회원가입을 해주세요.</p>
    <a href="<?=$join_url?>">회원가입</a>
  </div>
</div>

<script>

function loginCheck(frm){
	if(frm.id.value == ""){
		alert("아이디를 입력하세요");
		frm.id.focus();
		return false;
	}
	if(frm.passwd.value == ""){
		alert("비밀번호를 입력하세요");
		frm.passwd.focus();
		return false;
	}
	
	if(frm.secure_login != undefined) {	
		if(!frm.secure_login.checked){
			frm.action = "/admin2/member/login_check.php";
		}
	}
}
</script>
