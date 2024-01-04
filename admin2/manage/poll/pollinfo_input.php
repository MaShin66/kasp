<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<?
$page_name = "설문관리";
$page_desc = "설문정보를 등록/수정합니다.";
$navi_name = " 설문관리 > 설문정보";

$param = "page=".$page."&searchopt=".$searchopt."&searchkey=".$searchkey;

if($mode == "") $mode = "insert";

if($mode == "insert"){
	
	$poll_info[permsg] = "권한이 없습니다.";
	
}else if($mode == "update"){
	
	$sql = "select * from wiz_pollinfo where code = '$code'";
	$result = mysql_query($sql) or error(mysql_error());
	$poll_info = mysql_fetch_array($result);
	
}
?>
<script language="JavaScript" type="text/javascript">
<!--
function inputCheck(form){
   
   if(form.code.value == ""){
      alert('설문코드를 입력하세요.');
      form.code.focus();
      return false;
   } else if(!check_Char(form.code.value)) {
   		alert('설문코드는 특수문자를 사용할 수 없습니다.');
      form.code.focus();
   		return false;
   }
   if(form.title.value == ""){
      alert('설문명을 입력하세요.');
      form.title.focus();
      return false;
   }

}

//-->
</script>

<? include "../head.php"; ?>  
      
      <table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">설문관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">설문을 추가/삭제, 상세기능을 설정합니다.</td>
        </tr>
      </table>
      
      <br>
	  <form name="frm" action="pollinfo_save.php?<?=$param?>" method="post" onSubmit="return inputCheck(this);">
      <input type="hidden" name="mode" value="<?=$mode?>">
      <input type="hidden" name="idx" value="<?=$idx?>">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr> 
                <td width="15%" class="t_name">설문코드 <font color=red>*</font></td>
                <td width="35%" class="t_value">
                  <input name="code" type="text" size="30" value="<?=$poll_info[code]?>" maxlength="30" <? if($mode == "update") echo "readonly"; ?> class="input">
                </td>
                <td width="15%" class="t_name">설문명 <font color=red>*</font></td>
                <td width="35%" class="t_value">
                  <input name="title" type="text" size="30" value="<?=$poll_info[title]?>" maxlength="30" class="input">
                </td>
              </tr>
              <tr>
                <td class="t_name">권한</td>
                <td class="t_value" colspan="3">
                  <table width="98%" border="0" cellspacing="1" cellpadding="6">
                    <tr class="t_name">
                      <td width="25%" align="center" height="25">목록보기</td>
                      <td width="25%" align="center">내용보기</td>
                      <td width="25%" align="center">설문참여</td>
                      <td width="25%" align="center">코멘트쓰기</td>
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
                      lpermi = document.frm.lpermi;
                      for(ii=0; ii<lpermi.length; ii++){
                         if(lpermi.options[ii].value == "<?=$poll_info[lpermi]?>")
                            lpermi.options[ii].selected = true;
                      }
                      rpermi = document.frm.rpermi;
                      for(ii=0; ii<rpermi.length; ii++){
                         if(rpermi.options[ii].value == "<?=$poll_info[rpermi]?>")
                            rpermi.options[ii].selected = true;
                      }
                      apermi = document.frm.apermi;
                      for(ii=0; ii<apermi.length; ii++){
                         if(apermi.options[ii].value == "<?=$poll_info[apermi]?>")
                            apermi.options[ii].selected = true;
                      }
                      cpermi = document.frm.cpermi;
                      for(ii=0; ii<cpermi.length; ii++){
                         if(cpermi.options[ii].value == "<?=$poll_info[cpermi]?>")
                            cpermi.options[ii].selected = true;
                      }
                    -->
                  </script>
                </td>
              </tr>
              <tr>
                <td class="t_name">권한이 없을경우</td>
                <td class="t_value" colspan="3">
                	경고메세지 : <input name="permsg" type="text" size="30" value="<?=$poll_info[permsg]?>" class="input">&nbsp;
                	경고후 이동페이지 : <input name="perurl" type="text" size="30" value="<?=$poll_info[perurl]?>" class="input">
                </td>
              </tr>
              <tr> 
                <td class="t_name">스킨</td>
                <td colspan="3" class="t_value">
                <select name="skin">
                <?
                $dh = opendir("../../poll/skin");
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
                <script language="javascript">
                <!--
                  skin = document.frm.skin;
                  for(ii=0; ii<skin.length; ii++){
                     if(skin.options[ii].value == "<?=$poll_info[skin]?>")
                        skin.options[ii].selected = true;
                  }
                -->
                </script> 
                </td>
              </tr>
              <tr>
                <td width="15%" class="t_name">스팸글체크기능</td>
                <td width="35%" class="t_value">
                	<input type="radio" name="spam_check" value="Y" <? if($poll_info[spam_check] == "Y") echo "checked"; ?>>사용함
                	<input type="radio" name="spam_check" value="N" <? if($poll_info[spam_check] == "N" || $poll_info[spam_check] == "") echo "checked"; ?>>사용안함
                </td>
                <td width="15%" class="t_name">코멘트 허용</td>
                <td width="35%" class="t_value">
                  <input type="radio" name="comment" value="Y" <? if($poll_info[comment] == "Y") echo "checked"; ?>>허용함
                  <input type="radio" name="comment" value="N" <? if($poll_info[comment] == "N" || empty($poll_info[comment])) echo "checked"; ?>>허용안함
                </td>
              </tr>
              <tr>
                <td class="t_name">날짜형식(목록페이지)</td>
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
                	</select>
                  <script language="javascript">
                    <!--
                      datetype_list = document.frm.datetype_list;
                      for(ii=0; ii<datetype_list.length; ii++){
                         if(datetype_list.options[ii].value == "<?=$poll_info[datetype_list]?>")
                            datetype_list.options[ii].selected = true;
                      }
                    -->
                  </script>
                </td>
                <td class="t_name">날짜형식(보기페이지)</td>
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
                	</select>
                  <script language="javascript">
                    <!--
                      datetype_view = document.frm.datetype_view;
                      for(ii=0; ii<datetype_view.length; ii++){
                         if(datetype_view.options[ii].value == "<?=$poll_info[datetype_view]?>")
                            datetype_view.options[ii].selected = true;
                      }
                    -->
                  </script>
                </td>
              </tr>
              <tr>
                <td class="t_name">페이지출력수 <font color=red>*</font></td>
                <td class="t_value"><input name="rows" type="text" value="<? if($poll_info[rows] == "") echo "20"; else echo $poll_info[rows]; ?>" class="input"></td>
                <td class="t_name">리스트출력수 <font color=red>*</font></td>
                <td class="t_value"><input name="lists" type="text" value="<? if($poll_info[lists] == "") echo "5"; else echo $poll_info[lists]; ?>" class="input"></td>
              </tr>
              <tr>
                <td class="t_name">new 기간설정</td>
                <td class="t_value"><input name="newc" type="text" value="<? if($poll_info[newc] == "") echo "2"; else echo $poll_info[newc]; ?>" class="input"></td>
                <td class="t_name">제목 글자수</td>
                <td class="t_value"><input name="subject_len" type="text" value="<?=$poll_info[subject_len];?>" class="input"></td>
              </tr>
              <tr>
                <td class="t_name">욕설,비방글<br>필터링</td>
                <td class="t_value" colspan="3">
                  <input type="checkbox" name="abuse" value="Y" <? if($poll_info[abuse] == "Y") echo "checked"; ?>>사용함 &nbsp; (공백없이 단어를 입력하시고, 단어와 단어사이에는 콤마(,)로 구분하세요.)<br>
                  <textarea name="abtxt" rows="3" cols="80" class="textarea"><?=$poll_info[abtxt]?></textarea></td>
              </tr>
            </table>
           </td>
        </tr>
      </table>
      
      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr>
          <td align="center">
          	<input type="image" src="../image/btn_confirm_l.gif"> &nbsp; 
          	<img src="../image/btn_list_l.gif" style="cursor:hand" onClick="document.location='pollinfo_list.php?<?=$param?>';">
          </td>
      </table>
	  </form>
<? include "../foot.php"; ?>
