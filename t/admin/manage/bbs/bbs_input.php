<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?

if($mode == "") $mode = "insert";

if($mode == "insert"){

	$bbs_info[simgsize] = "120";
	$bbs_info[mimgsize] = "600";
	$bbs_info[permsg] = "권한이 없습니다.";
	$bbs_info[line] = "4";

	$bbs_info[upfile] = "1";
	$bbs_info[movie] = "0";

}else if($mode == "update"){
	$sql = "select * from wiz_bbsinfo where code = '$code'";
	$result = mysql_query($sql) or error(mysql_error());
	$bbs_info = mysql_fetch_array($result);
}
?>
<? include "../head.php"; ?>
<script language="JavaScript" type="text/javascript">
<!--
function inputCheck(frm){

   if(frm.code.value == ""){
      alert('게시판 영문명(db명)을 입력하세요.');
      frm.code.focus();
      return false;
   } else if(!check_Char(frm.code.value)) {
   		alert('게시판 영문명(db명)은 특수문자를 사용할 수 없습니다.');
      frm.code.focus();
   		return false;
   }

   if(frm.title.value == ""){
      alert('게시판 한글명 입력하세요.');
      frm.title.focus();
      return false;
   }

   if(frm.rows.value == ""){
      alert('페이지출력수 입력하세요.');
      frm.rows.focus();
      return false;
   }
   if(frm.lists.value == ""){
      alert('리스트출력수 입력하세요.');
      frm.lists.focus();
      return false;
   }

	if(frm.rows.value != "" && !check_Num(frm.rows.value)) {
		alert("페이지출력수는 숫자만 입력하세요.");
		frm.rows.focus();
		return false;
	}
	if(frm.lists.value != "" && !check_Num(frm.lists.value)) {
		alert("리스트출력수는 숫자만 입력하세요.");
		frm.lists.focus();
		return false;
	}
	if(frm.newc.value != "" && !check_Num(frm.newc.value)) {
		alert("new 기간설정은 숫자만 입력하세요.");
		frm.newc.focus();
		return false;
	}
	if(frm.hotc.value != "" && !check_Num(frm.hotc.value)) {
		alert("hot 조회수설정은 숫자만 입력하세요.");
		frm.hotc.focus();
		return false;
	}
	if(frm.subject_len.value != "" && !check_Num(frm.subject_len.value)) {
		alert("제목 글자수는 숫자만 입력하세요.");
		frm.subject_len.focus();
		return false;
	}
	if(frm.line.value != "" && !check_Num(frm.line.value)) {
		alert("줄바꿈 게시물수는 숫자만 입력하세요.");
		frm.line.focus();
		return false;
	}

}

function popCategory() {
<?
if(!strcmp($mode, "insert")) {
?>
	alert("게시판 추가 후 카테고리를 수정할 수 있습니다.");
<?
} else {
?>
	var url = "category.php?code=<?=$code?>";
	window.open(url,"BBSCategory","height=340, width=700, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, top=100, left=100");
<?
}
?>
}

function popGrp() {
	var url = "group.php";
	window.open(url,"BBSGroup","height=250, width=350, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, top=100, left=100");
}
//-->
</script>


			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">게시판관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">게시판 상세기능을 설정합니다.</td>
        </tr>
      </table>

      <br>
      <form name="frm" action="bbs_save.php" method="post" enctype="multipart/form-data" onSubmit="return inputCheck(this);">
      <input type="hidden" name="mode" value="<?=$mode?>">
      <input type="hidden" name="page" value="<?=$page?>">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td height="10" align="left" class="t_name">영문명(db명) <font color=red>*</font></td>
                <td class="t_value" colspan="3"><input name="code" type="text" size="30" value="<?=$bbs_info[code]?>" maxlength="30" <? if($mode == "update") echo "readonly"; ?> class="input"></td>
              </tr>
              <tr>
                <td height="10" align="left" class="t_name">한글명 <font color=red>*</font></td>
                <td class="t_value" colspan="3"><input name="title" type="text" size="30" value="<?=$bbs_info[title]?>" class="input"></td>
              </tr>
              <!--
              <tr>
                <td height="10" align="left" class="t_name">게시판주소 <font color=red>*</font></td>
                <td class="t_value" colspan="3">http://<?=$HTTP_HOST?>/<input name="pageurl" type="text" size="32" value="<?=$bbs_info[pageurl]?>" class="input"></td>
              </tr>
              <tr>
                <td height="10" align="left" class="t_name">타이들이미지</td>
                <td class="t_value" colspan="3">
                <?
                if($bbs_info[titleimg] != "") echo "<img src=/bbs/upfile/$bbs_info[titleimg] width=500><a href=bbs_save.php?mode=del_titleimg&code=$code><font color=red>[삭제]</font></a><br>";
                ?>
                <input name="titleimg" type="file" size="30" class="input">
                </td>
              </tr>
              <tr>
                <td height="10" align="left" class="t_name">상단파일</td>
                <td class="t_value" colspan="3"><input name="header" type="text" size="30" value="<?=$bbs_info[header]?>" class="input"></td>
              </tr>
              <tr>
                <td height="10" align="left" class="t_name">하단파일</td>
                <td class="t_value" colspan="3"><input name="footer" type="text" size="30" value="<?=$bbs_info[footer]?>" class="input"></td>
              </tr>
              <tr>
                <td height="10" align="left" class="t_name">카테고리</td>
                <td class="t_value" colspan="3">쉼표로 분리 예)공지,분류1,분류2<br><input name="category" type="text" size="60" value="<?=$bbs_info[category]?>" class="input"></td>
              </tr>
              -->
              <tr>
                <td height="10" align="left" class="t_name">게시판그룹</td>
                <td class="t_value" colspan="3">
                	<?php
                	$bbs_grp = explode("\n", $site_info[bbs_grp]);
                	$no = 0;
                	for($ii = 0; $ii < count($bbs_grp); $ii++) {
                		if(!empty($bbs_grp[$ii])) {
                			$tmp_grp = explode("^", $bbs_grp[$ii]);
                			$grp_list[$no][no] = $tmp_grp[0];
                			$grp_list[$no][grp] = $tmp_grp[1];
                			$no++;
                		}
                	}
                	?>
                	<select name="grp" id="bbs_grp">
                		<option value="">:: 게시판그룹 ::</option>
                		<? for($ii = 0; $ii < count($grp_list); $ii++) { ?>
                		<option value="<?=$grp_list[$ii][no]?>" <? if(!strcmp($bbs_info[grp], $grp_list[$ii][no])) echo "selected" ?>><?=$grp_list[$ii][grp]?></option>
                		<? } ?>
                	</select>
                	<img src="../image/btn_bbsgroup.gif" align="absmiddle" style="cursor:hand" onclick="popGrp()">&nbsp;
                	우선순위
                	<select name="prior">
                		<? for($ii = 1; $ii < 11; $ii++) { ?>
                		<option value="<?=$ii?>" <? if(!strcmp($ii, $bbs_info[prior])) echo "selected"; ?>><?=$ii?></option>
                		<? } ?>
                	</select> (그룹내에서 게시판 우선순위,작을수록 순위가 높음)<br>
                	게시판그룹은 게시판이 많은 경우 게시판을 그룹별로 효과적으로 관리하기 위한 기능입니다.
                </td>
              </tr>
              <tr>
                <td height="10" align="left" class="t_name">카테고리</td>
                <td class="t_value" colspan="3">
                	<select name="bbs_cat">
                		<option value="">:: 카테고리 ::</option>
                	<?
                	$sql = "select * from wiz_bbscat where code = '$code' order by gubun desc, prior asc, idx asc";
                	$result = mysql_query($sql) or error(mysql_error());
                	while($cat_row = mysql_fetch_array($result)) {
                	?>
                		<option value="<?=$cat_row[idx]?>"><?=$cat_row[catname]?></option>
                	<?
                	}
                	?>
                	</select>
                	<img src="../image/btn_category_s.gif" align="absmiddle" style="cursor:hand" onclick="popCategory()">&nbsp;
                	<? if($mode == "insert"){ ?> 게시판 추가 후 카테고리를 수정할 수 있습니다.<? } ?>
                </td>
              </tr>
              <tr>
                <td height="10" align="left" class="t_name">게시판관리자</td>
                <td class="t_value" colspan="3">아이디를 쉼표로 분리 예)admin,admin1,admin3<br><input name="bbsadmin" type="text" size="60" value="<?=$bbs_info[bbsadmin]?>" class="input"></td>
              </tr>
              <tr>
                <td width="15%" height="10" align="left" class="t_name">자동 비밀글</td>
                <td width="35%" class="t_value">
                  <input type="checkbox" name="privacy" value="Y" <? if($bbs_info[privacy] == "Y") echo "checked"; ?>>작성자와 운영자만 연람가능
                </td>
                <td width="15%" height="10" align="left" class="t_name">게시판스킨</td>
                <td width="35%" class="t_value">
                <select name="skin">
                <?
                $dh = opendir("../../bbs/skin");
                while(($file = readdir($dh)) !== false){
                	if($file != "." && $file != ".."){
                		$file_list[] = $file;
                	}
                }
                sort ($file_list); reset ($file_list);
                for($ii=0;$ii<count($file_list);$ii++){
                ?>
                <option value="<?=$file_list[$ii]?>"><?=$file_list[$ii]?></option>
                <?
                }
                ?>
                </select>
                </td>
              </tr>
              <tr>
                <td height="10" align="left" class="t_name">권한</td>
                <td class="t_value" colspan="3">
                  <table width="98%" border="0" cellspacing="1" cellpadding="6">
                    <tr class="t_name">
                      <td width="20%" align="center">목록보기</td>
                      <td width="20%" align="center">내용보기</td>
                      <td width="20%" align="center">글쓰기</td>
                      <td width="20%" align="center">답글쓰기</td>
                      <td width="20%" align="center">코멘트쓰기</td>
                    </tr>
                    <tr>
                      <td align="center" height="25">
                        <select name="lpermi">
                        <option value="">전체</option>
                        <?=level_list();?>
                        <option value="0">관리자</option>
                        </select>
                      </td>
                      <td align="center">
                        <select name="rpermi">
                        <option value="">전체</option>
                        <?=level_list();?>
                        <option value="0">관리자</option>
                        </select>
                      </td>
                      <td align="center">
                        <select name="wpermi">
                        <option value="">전체</option>
                        <?=level_list();?>
                        <option value="0">관리자</option>
                        </select>
                      </td>
                      <td align="center">
                        <select name="apermi">
                        <option value="">전체</option>
                        <?=level_list();?>
                        <option value="0">관리자</option>
                        </select>
                      </td>
                      <td align="center">
                        <select name="cpermi">
                        <option value="">전체</option>
                        <?=level_list();?>
                        <option value="0">관리자</option>
                        </select>
                      </td>
                    </tr>
                  </table>
                  <script language="javascript">
                    <!--
                      skin = document.frm.skin;
                      for(ii=0; ii<skin.length; ii++){
                         if(skin.options[ii].value == "<?=$bbs_info[skin]?>")
                            skin.options[ii].selected = true;
                      }
                      lpermi = document.frm.lpermi;
                      for(ii=0; ii<lpermi.length; ii++){
                         if(lpermi.options[ii].value == "<?=$bbs_info[lpermi]?>")
                            lpermi.options[ii].selected = true;
                      }
                      rpermi = document.frm.rpermi;
                      for(ii=0; ii<rpermi.length; ii++){
                         if(rpermi.options[ii].value == "<?=$bbs_info[rpermi]?>")
                            rpermi.options[ii].selected = true;
                      }
                      wpermi = document.frm.wpermi;
                      for(ii=0; ii<wpermi.length; ii++){
                         if(wpermi.options[ii].value == "<?=$bbs_info[wpermi]?>")
                            wpermi.options[ii].selected = true;
                      }
                      apermi = document.frm.apermi;
                      for(ii=0; ii<apermi.length; ii++){
                         if(apermi.options[ii].value == "<?=$bbs_info[apermi]?>")
                            apermi.options[ii].selected = true;
                      }
                      cpermi = document.frm.cpermi;
                      for(ii=0; ii<cpermi.length; ii++){
                         if(cpermi.options[ii].value == "<?=$bbs_info[cpermi]?>")
                            cpermi.options[ii].selected = true;
                      }
                    -->
                  </script>
                </td>
              </tr>
              <tr>
                <td rowspan="2" height="10" align="left" class="t_name">권한이 없을경우</td>
                <td class="t_value" colspan="3">
                	경고메세지 : <input name="permsg" type="text" size="30" value="<?=$bbs_info[permsg]?>" class="input">&nbsp;
                	경고후 이동페이지 : <input name="perurl" type="text" size="30" value="<?=$bbs_info[perurl]?>" class="input">
                </td>
              </tr>
              <tr>
                <td class="t_value" colspan="3">
                	<input type="radio" name="btn_view" value="N" <? if($bbs_info[btn_view] == "N" || $bbs_info[btn_view] == "") echo "checked"; ?>> 글쓰기 버튼이 보이지 않음
                	<input type="radio" name="btn_view" value="Y" <? if($bbs_info[btn_view] == "Y") echo "checked"; ?>> 글쓰기 버튼이 보이고 클릭 시 경고창
                </td>
              </tr>
              <tr>
                <td height="10" align="left" class="t_name">이미지크기</td>
                <td class="t_value" colspan="3">
                	목록페이지  : <input name="simgsize" type="text" size="9" value="<?=$bbs_info[simgsize]?>" class="input">픽셀 &nbsp;
                	보기페이지  : <input name="mimgsize" type="text" size="9" value="<?=$bbs_info[mimgsize]?>" class="input">픽셀
                </td>
              </tr>
              <tr>
                <td height="10" align="left" class="t_name">이미지파일</td>
                <td class="t_value" colspan="3">
                	<input type="checkbox" name="imgview" value="N" <? if($bbs_info[imgview] == "N") echo "checked"; ?>>첨부파일이 이미지인 경우 보기 페이지에서 이미지 감추기
                </td>
              </tr>
              <tr>
                <td height="10" align="left" class="t_name">이미지 첨부파일 정렬</td>
                <td class="t_value" colspan="3">
                	<input type="radio" name="img_align" value="LEFT" <? if($bbs_info[img_align] == "LEFT" || $bbs_info[img_align] == "") echo "checked"; ?>> 좌측정렬
                	<input type="radio" name="img_align" value="CENTER" <? if($bbs_info[img_align] == "CENTER") echo "checked"; ?>> 중앙정렬
                	<input type="radio" name="img_align" value="RIGHT" <? if($bbs_info[img_align] == "RIGHT") echo "checked"; ?>> 우측정렬
                </td>
              </tr>
              <tr>
                <td height="10" align="left" class="t_name">SMS 발송</td>
                <td class="t_value" colspan="3">
                	<input type="checkbox" name="sms" value="Y" <? if($bbs_info[sms] == "Y") echo "checked"; ?>>
                	글작성 시 관리자에게 SMS 발송 (기본설정 > 사이트 정보 > 관리자 휴대폰)
                </td>
              </tr>
              <tr>
                <td height="10" align="left" class="t_name">보기 하단에 목록보기</td>
                <td class="t_value" colspan="3">
                	<input type="radio" name="view_list" value="Y" <? if($bbs_info[view_list] == "Y") echo "checked"; ?>> 사용
                	<input type="radio" name="view_list" value="N" <? if($bbs_info[view_list] == "N" || $bbs_info[view_list] == "") echo "checked"; ?>> 미사용
                </td>
              </tr>
              <tr>
                <td height="10" align="left" class="t_name">스팸글체크기능</td>
                <td class="t_value">
                	<input type="radio" name="spam_check" value="Y" <? if($bbs_info[spam_check] == "Y" || $bbs_info[spam_check] == "") echo "checked"; ?>> 사용
                	<input type="radio" name="spam_check" value="N" <? if($bbs_info[spam_check] == "N") echo "checked"; ?>> 미사용
                </td>
                <td align="left" class="t_name">글쓴이 형식</td>
                <td class="t_value">
                	<select name="name_type">
                		<option value="name">이름만 사용</option>
                		<option value="nick">닉네임만 사용</option>
                		<option value="icon">아이콘만 사용</option>
                		<option value="iname">아이콘+이름 사용</option>
                		<option value="inick">아이콘+닉네임 사용</option>
                	</select>
                  <script language="javascript">
                    <!--
                      name_type = document.frm.name_type;
                      for(ii=0; ii<name_type.length; ii++){
                         if(name_type.options[ii].value == "<?=$bbs_info[name_type]?>")
                            name_type.options[ii].selected = true;
                      }
                    -->
                  </script>
                </td>
              </tr>
              <tr>
                <td height="10" align="left" class="t_name">날짜형식(목록페이지)</td>
                <td class="t_value">
                	<select name=datetype_list>
                		<option value="">:: 목록페이지 :: </option>
                		<option value="%y.%m.%d"><?= date('y.m.d') ?></option>
                		<option value="%y/%m/%d"><?= date('y/m/d') ?></option>
                		<option value="%y-%m-%d"><?= date('y-m-d') ?></option>
                		<option value="%Y.%m.%d"><?= date('Y.m.d') ?></option>
                		<option value="%Y/%m/%d"><?= date('Y/m/d') ?></option>
                		<option value="%Y-%m-%d"><?= date('Y-m-d') ?></option>
                		<option value="%Y년 %m월 %d일"><?= date('Y년 m월 d일') ?></option>
                		<option value="%Y-%m-%d %H:%i"><?= date('Y-m-d H:i') ?></option>
                		<option value="%Y-%m-%d %H:%i %p"><?= date('Y-m-d h:i A') ?></option>
                		<option value="%Y.%m.%d %H:%i:%s"><?= date('Y.m.d H:i:s') ?></option>
                	</select>
                  <script language="javascript">
                    <!--
                      datetype_list = document.frm.datetype_list;
                      for(ii=0; ii<datetype_list.length; ii++){
                         if(datetype_list.options[ii].value == "<?=$bbs_info[datetype_list]?>")
                            datetype_list.options[ii].selected = true;
                      }
                    -->
                  </script>
                </td>
                <td height="10" align="left" class="t_name">날짜형식(보기페이지)</td>
                <td class="t_value">
                	<select name=datetype_view>
                		<option value="">:: 보기페이지 :: </option>
                		<option value="%y.%m.%d"><?= date('y.m.d') ?></option>
                		<option value="%y/%m/%d"><?= date('y/m/d') ?></option>
                		<option value="%y-%m-%d"><?= date('y-m-d') ?></option>
                		<option value="%Y.%m.%d"><?= date('Y.m.d') ?></option>
                		<option value="%Y/%m/%d"><?= date('Y/m/d') ?></option>
                		<option value="%Y-%m-%d"><?= date('Y-m-d') ?></option>
                		<option value="%Y년 %m월 %d일"><?= date('Y년 m월 d일') ?></option>
                		<option value="%Y-%m-%d %H:%i"><?= date('Y-m-d H:i') ?></option>
                		<option value="%Y-%m-%d %H:%i %p"><?= date('Y-m-d h:i A') ?></option>
                		<option value="%Y.%m.%d %H:%i:%s"><?= date('Y.m.d H:i:s') ?></option>
                	</select>
                  <script language="javascript">
                    <!--
                      datetype_view = document.frm.datetype_view;
                      for(ii=0; ii<datetype_view.length; ii++){
                         if(datetype_view.options[ii].value == "<?=$bbs_info[datetype_view]?>")
                            datetype_view.options[ii].selected = true;
                      }
                    -->
                  </script>
                </td>
              </tr>
              <tr>
                <td align="left" class="t_name">웹에디터</td>
                <td class="t_value">
                	<input type="radio" name="editor" value="Y" <? if($bbs_info[editor] == "Y") echo "checked"; ?>>사용함
                  <input type="radio" name="editor" value="N" <? if($bbs_info[editor] == "N" || $bbs_info[editor] == "") echo "checked"; ?>>사용안함
                </td>
                <td align="left" class="t_name">답글 메일알림</td>
                <td class="t_value">
                  <input type="radio" name="remail" value="Y" <? if($bbs_info[remail] == "Y") echo "checked"; ?>>허용함
                  <input type="radio" name="remail" value="N" <? if($bbs_info[remail] == "N" || empty($bbs_info[remail])) echo "checked"; ?>>허용안함
                </td>
              </tr>
              <tr>
                <td align="left" class="t_name">추천기능</td>
                <td class="t_value">
                	<input type="radio" name="recom" value="Y" <? if($bbs_info[recom] == "Y") echo "checked"; ?>>사용함
                  <input type="radio" name="recom" value="N" <? if($bbs_info[recom] == "N" || empty($bbs_info[recom])) echo "checked"; ?>>사용안함
                </td>
                <td align="left" class="t_name">코멘트 허용</td>
                <td class="t_value">
                  <input type="radio" name="comment" value="Y" <? if($bbs_info[comment] == "Y") echo "checked"; ?>>허용함
                  <input type="radio" name="comment" value="N" <? if($bbs_info[comment] == "N" || empty($bbs_info[comment])) echo "checked"; ?>>허용안함
                </td>
              </tr>
              <tr>
                <td align="left" class="t_name">파일업로드</td>
                <td class="t_value">
                	<select name="upfile">
                		<option value="0">사용안함</option>
                		<option value="1">1개</option>
                		<option value="2">2개</option>
                		<option value="3">3개</option>
                		<option value="4">4개</option>
                		<option value="5">5개</option>
                	</select>
                  <script language="javascript">
                    <!--
                      upfile = document.frm.upfile;
                      for(ii=0; ii<upfile.length; ii++){
                         if(upfile.options[ii].value == "<?=$bbs_info[upfile]?>")
                            upfile.options[ii].selected = true;
                      }
                    -->
                  </script>
                </td>
                <td align="left" class="t_name">동영상</td>
                <td class="t_value">
                	<select name="movie">
                		<option value="0">사용안함</option>
                		<option value="1">1개</option>
                		<option value="2">2개</option>
                		<option value="3">3개</option>
                	</select>
                  <script language="javascript">
                    <!--
                      movie = document.frm.movie;
                      for(ii=0; ii<movie.length; ii++){
                         if(movie.options[ii].value == "<?=$bbs_info[movie]?>")
                            movie.options[ii].selected = true;
                      }
                    -->
                  </script>
                </td>
              </tr>
              <tr>
                <td align="left" class="t_name">페이지출력수 <font color=red>*</font></td>
                <td class="t_value"><input name="rows" type="text" value="<? if($bbs_info[rows] == "") echo "20"; else echo $bbs_info[rows]; ?>" class="input"></td>
                <td align="left" class="t_name">리스트출력수 <font color=red>*</font></td>
                <td class="t_value"><input name="lists" type="text" value="<? if($bbs_info[lists] == "") echo "5"; else echo $bbs_info[lists]; ?>" class="input"></td>
              </tr>
              <tr>
                <td align="left" class="t_name">new 기간설정</td>
                <td class="t_value"><input name="newc" type="text" value="<? if($bbs_info[newc] == "") echo "2"; else echo $bbs_info[newc]; ?>" class="input"></td>
                <td align="left" class="t_name">hot 조회수설정</td>
                <td class="t_value"><input name="hotc" type="text" value="<? if($bbs_info[hotc] == "") echo "600"; else echo $bbs_info[hotc]; ?>" class="input"></td>
              </tr>
              <tr>
                <td align="left" class="t_name">제목 글자수</td>
                <td class="t_value"><input name="subject_len" type="text" value="<?=$bbs_info[subject_len];?>" class="input"></td>
                <td align="left" class="t_name">줄바꿈 게시물수</td>
                <td class="t_value"><input name="line" type="text" value="<?= $bbs_info[line]; ?>" class="input"><br>(포토갤러리 형식 스킨인 경우 적용)</td>
              </tr>
              <tr>
                <td height="10" align="left" class="t_name">욕설,비방글 필터링</td>
                <td class="t_value" colspan="3">
                  <input type="checkbox" name="abuse" value="Y" <? if($bbs_info[abuse] == "Y") echo "checked"; ?>>사용함 &nbsp; (공백없이 단어를 입력하시고, 단어와 단어사이에는 콤마(,)로 구분하세요.)<br>
                  <textarea name="abtxt" rows="3" cols="80" class="textarea"><?=$bbs_info[abtxt]?></textarea></td>
              </tr>
            </table></td>
        </tr>
      </table><br>

			<?
			if(!strcmp($site_info[point_use], "Y")) {
			?>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 포인트정보</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td width="15%" align="left" class="t_name">글보기 포인트</td>
                <td width="35%" class="t_value"><input name="view_point" type="text" value="<? if($bbs_info[view_point] == "" && $mode != "update") echo $site_info[view_point]; else echo $bbs_info[view_point]; ?>" class="input"></td>
                <td width="15%" align="left" class="t_name">글쓰기 포인트</td>
                <td width="35%" class="t_value"><input name="write_point" type="text" value="<? if($bbs_info[write_point] == "" && $mode != "update") echo $site_info[write_point]; else echo $bbs_info[write_point]; ?>" class="input"></td>
              </tr>
              <tr>
                <td align="left" class="t_name">다운로드 포인트</td>
                <td class="t_value"><input name="down_point" type="text" value="<? if($bbs_info[down_point] == "" && $mode != "update") echo $site_info[down_point]; else echo $bbs_info[down_point]; ?>" class="input"></td>
                <td align="left" class="t_name">코멘트 포인트</td>
                <td class="t_value"><input name="comment_point" type="text" value="<? if($bbs_info[comment_point] == "" && $mode != "update") echo $site_info[comment_point]; else echo $bbs_info[comment_point]; ?>" class="input"></td>
              </tr>
              <tr>
                <td height="10" align="left" class="t_name">추천 포인트</td>
                <td colspan="3" class="t_value"><input name="recom_point" type="text" value="<? if($bbs_info[recom_point] == "" && $mode != "update") echo $site_info[recom_point]; else echo $bbs_info[recom_point]; ?>" class="input"></td>
              </tr>
              <tr>
                <td height="10" align="left" class="t_name">포인트가 없을경우</td>
                <td class="t_value" colspan="3">
                	경고메세지 : <input name="point_msg" type="text" size="30" value="<? if($bbs_info[point_msg] == "" && $mode != "update") echo $site_info[point_msg]; else echo $bbs_info[point_msg]?>" class="input">
                </td>
              </tr>
            </table>
           </td>
        </tr>
      </table>
			<?
			}
			?>

			<br>
      <table align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
          	<input type="image" src="../image/btn_confirm_l.gif"> &nbsp;
          	<img src="../image/btn_list_l.gif" style="cursor:hand" onClick="document.location='bbs_list.php?page=<?=$page?>';">
          </td>
        </tr>
      </table>
	  </form>

			<br>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="9d9d9d">
        <tr>
          <td width="5" height="5"><img src="../image/check_left_top.gif"></td>
          <td width="100%"></td>
          <td width="5" height="5"><img src="../image/check_right_top.gif"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="6">
            <tr>
              <td><img src="../image/check_tit.gif" width="75" height="19" /></td>
            </tr>
            <tr>
              <td class="chk_alt">
              - 영문명은 반드시 영문으로 작성하고 변경이 불가합니다.<br>
              - 권한설정은 각 상황별 회원분류에따라 접근권한을 설정합니다.<br>
              - 욕설,비방글 설정을 통하여 글 작성시 욕설 비방글을 방지할 수 있습니다.<br>
              - 제목 글자수는 게시판 목록에서 보여지는 제목의 글자수를 지정하며 그 이상은 ... 으로 표시됩니다.<br>
              - 제목 글자수를 지정하지 않거나 0인 경우에는 글자수 노출에 제한이 없습니다.<br>
              - 줄바꿈 게시물수는 게시판 스킨이 포토갤러리 형식인 경우 한 줄에 나오는 게시물 수를 지정합니다.<br>
              - 줄바꿈 게시물수를 지정하지 않거나 0인 경우에는 적용되지 않습니다.<br>
              <? if(!strcmp($site_info[point_use], "Y")) { ?>
							- 포인트를 차감하고 싶은 경우 숫자 앞에 - 를 붙여 주세요. (예 : -10)
							<? } ?>
              </td>
            </tr>
          </table></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="5" height="5"><img src="../image/check_left_bottom.gif" width="5" height="5" /></td>
          <td></td>
          <td width="5" height="5"><img src="../image/check_right_bottom.gif" width="5" height="5" /></td>
        </tr>
      </table>

<? include "../foot.php"; ?>
