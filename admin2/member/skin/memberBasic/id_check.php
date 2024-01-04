<div class="id_check_box">
  <div class="top">
    <h2 class="tit">아이디 중복확인</h2>
    <a href="javascript:window.close();" class="close_btn">닫기</a>
  </div>
                  
  <!-- 아이디 검색 -->
  <div class="sch_box">
      <form name="frm" method="post" action="<?=$PHP_SELF?>" onSubmit="return idCheck(this);">

      <div class="box">
        <input type="text" name="id" class="input_idpw">
        <label for="id_sch">
          <input type="image" id="id_sch">검색
        </label>
        <p class="txt">띄어쓰기 없이 영문(숫자포함) 3~12자까지 사용 가능함.</p>
      </div>

    </form>
  </div>
  <!-- //아이디 검색 -->

  <!-- 아이디 검색결과 -->
  <div class="sch_result">
    <?=$checkmsg?>          
  </div>
  <!-- //아이디 검색결과 -->
</div>              
