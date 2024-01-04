<div class="secession_box">
	<form name="myoutFrm" action="<?=$PHP_SELF?>" method="post" enctype="multipart/form-data" onSubmit="return myoutCheck(this);">
	<input type="hidden" name="ptype" value="save">	

		<div class="form_area">
			<ul class="form_write">
			  <li>
				<div class="tit"><label for="">탈퇴사유 <span class="point">*</span></label></div>
				<div class="con">
					<input name="reason" type="text" value="" class="input">
				</div>
			  </li>
			  <li>
				<div class="tit"><label for="">남기실 말씀 <span class="point">*</span></label></div>
				<div class="con">
					<textarea name="content" class="textarea"></textarea>
				</div>
			  </li>			  
		  </ul>
	  </div>
	  <div class="secession_form_ok">
		<button type="button" class="back_btn" onClick="history.go(-1);">취소</button>
		<label for="secession_ok">
		  <input type="image" id="secession_ok">탈퇴
		</label>
	  </div>  

	</form>
</div>
<script>

function myoutCheck(frm){
	if(frm.reason.value == ""){
		alert("탈퇴사유를 입력하세요");
		frm.reason.focus();
		return false;
	}

	if(frm.content.value == ""){
		alert("내용을 입력하세요");
		frm.content.focus();
		return false;
	}

	if(!confirm("정말 탈퇴하시겠습니까?")) return false;

}
</script>
