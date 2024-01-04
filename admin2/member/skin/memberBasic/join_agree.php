<div class="agree_box">
	<form name="agreeFrm">
		<div class="box">
			<h2 class="tit">회원가입 약관</h2>
			<textarea name="textarea" class="textarea" readonly><?=$agreement?></textarea>
			<div class="design_chk">
				<input type="checkbox" name="join_agree" id="join_agree_01">
				<label for="join_agree_01">회원가입약관에 동의합니다.</label>
			</div>
		</div>		
		<div class="box">
			<h2 class="tit">개인정보취급방침</h2>
			<textarea name="textarea" class="textarea" readonly><?=$safeinfo?></textarea>
			<div class="design_chk">
				<input type="checkbox" name="join_agree" id="join_agree_02"> 
				<label for="join_agree_02">개인정보취급방침에 동의합니다.</label>
			</div>
		</div>
	</form>

	<div class="btn_area col2">
		<button class="btn_txt btn_line_black" onClick="history.back();">동의안함</button>
		<button class="btn_txt btn_navy" onClick="agreeCheck();">동의함</button>
	</div>
</div>


<script>
// 약관동의체크
function agreeCheck(){

	var agree = true;
	var agreeFrm = document.agreeFrm;

	for(ii = 0; ii < agreeFrm.join_agree.length; ii++) {
		if(!agreeFrm.join_agree[ii].checked) agree = false;
	}

<? if($site_info[namecheck_use] == "Y"){ ?>

	var frm = document.namecheckFrm;
	var name = frm.name.value;
	var resno1 = frm.resno1.value;
	var resno2 = frm.resno2.value;

	if(name == ""){
		alert("이름을 입력하세요");
		frm.name.focus();
		return;
	}
	if(resno1 == ""){
		alert("주민번호를 입력하세요");
		frm.resno1.focus();
		return;
	}
	if(resno2 == ""){
		alert("주민번호를 입력하세요");
		frm.resno2.focus();
		return;
	}

	if(!agree)
		alert("회원가입약관 및 개인정보보호정책에 동의하셔야 회원가입이 가능합니다.");
	else
		document.nameIframe.location = "/admin2/member/name_check.php?name=" + name + "&resno1=" + resno1 + "&resno2=" + resno2;

<? }else{ ?>
	
	if(!agree)
		alert("회원가입약관 및 개인정보보호정책에 동의하셔야 회원가입이 가능합니다.");
	else
		document.location = '<?=$PHP_SELF?>?ptype=input';
	
<? } ?>

}

// 주민번호 자동포커스
function jfocus(frm){
	if(frm.resno2 != null){
		var str = frm.resno1.value.length;
		if(str == 6) frm.resno2.focus();
	}
}
</script>