<?
/*
$msg_id		: 아이디 찾기 문구
$msg_pw		: 비밀번호 찾기 문구
*/
?>

<div class="idpw_box">
	<div class="left box">
		<div class="top">
			<p class="tit">사용자 아이디를 분실하셨나요?</p>
			<p class="txt">회원님의 이름과 가입시 작성하신 이메일 주소를 입력해주세요.</p>
		</div>
		<form name="idfindFrm" action="<?=$ssl?>/admin2/member/idpw.php" method="post" onSubmit="return idfindCheck(this);">
			<input type="hidden" name="search" value="ok">
			<input type="hidden" name="submode" value="id">

			<div class="form_area">
				<ul class="form_write">
					<li>
						<div class="tit"><label for="">이름 <span class="point">*</span></label></div>
						<div class="con">
							<input name="name" type="text"  class="input_idpw" value="" placeholder="이름을 입력해주세요.">
						</div>
					</li>
					<li class="email_li">
						<div class="tit"><label for="">이메일 <span class="point">*</span></label></div>
						<div class="con">
							<input name="email" type="text"  class="input_idpw" value="" placeholder="이메일을 입력해주세요.">
						</div>
					</li>				
				</ul>
			</div>
			<div class="btn">
				<label for="id_submit">
					<input type="image" id="id_submit">확인
				</label>
			</div>
		</form>
	</div>
	<div class="right box">
		<div class="top">
			<p class="tit">비밀번호를 분실하셨나요?</p>
			<p class="txt">회원님의 아이디와 이름, 가입시 작성하신 이메일 주소를 입력해주세요.</p>
		</div>
		<form name="pwfindFrm" action="<?=$ssl?>/admin2/member/idpw.php" method="post" onSubmit="return pwfindCheck(this);">
			<input type="hidden" name="search" value="ok">
			<input type="hidden" name="submode" value="passwd">

			<div class="form_area">
				<ul class="form_write">
					<li>
						<div class="tit"><label for="">아이디 <span class="point">*</span></label></div>
						<div class="con">
							<input name="id" type="text" class="input_idpw" value="" placeholder="아이디를 입력해주세요.">
						</div>
					</li>
					<li>
						<div class="tit"><label for="">이름 <span class="point">*</span></label></div>
						<div class="con">
							<input name="name" type="text" class="input_idpw" value="" placeholder="이름을 입력해주세요.">
						</div>
					</li>				
					<li>
						<div class="tit"><label for="">이메일 <span class="point">*</span></label></div>
						<div class="con">
							<input name="email" type="text" class="input_idpw" value="" placeholder="이메일을 입력해주세요.">
						</div>
					</li>								
				</ul>
			</div>				
			<div class="btn">
				<label for="pw_submit">
					<input type="image" id="pw_submit">확인
				</label>
			</div>		
		</form>
	</div>
</div>

<script>
	function idfindCheck(frm){
		if(frm.name.value == ""){
			alert("이름을 입력하세요.");
			frm.name.focus();
			return false;
		}
		if(frm.email.value == ""){
			alert("이메일을 입력하세요.");
			frm.email.focus();
			return false;
		}
	}

	function pwfindCheck(frm){
		if(frm.id.value == ""){
			alert("아이디를 입력하세요.");
			frm.id.focus();
			return false;
		}
		if(frm.name.value == ""){
			alert("이름을 입력하세요.");
			frm.name.focus();
			return false;
		}
		if(frm.email.value == ""){
			alert("이메일을 입력하세요.");
			frm.email.focus();
			return false;
		}
	}
</script>
