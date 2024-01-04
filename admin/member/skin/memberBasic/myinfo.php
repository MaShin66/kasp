<form name="myinfoFrm" action="<?=$action?>" method="post" enctype="multipart/form-data" onSubmit="return myinfoCheck(this);">
<input type="hidden" name="ptype" value="save">
<input type="hidden" name="prev" value="<?=$prev?>">

<div class="edit_member_box">
  <div class="form_area">
      <div class="form_top">
        <p class="form_tit">기본정보입력</h2>
        <p class="form_txt">* 필수입력</p>
      </div>
      <ul class="form_write">
        <li>
          <div class="tit"><label for="">아이디<span class="point">*</span></label></div>
          <div class="con">
            <input type="text" value="<?=$id?>" name="" disabled>
          </div>
        </li>
        <li class="pass_li first">
          <div class="tit"><label for="">비밀번호 <span class="point">*</span></label></div>
          <div class="con">
            <input name="passwd1" type="password" class="input" placeholder="대소문자 구별, 4~12자리">
          </div>
        </li>      
        <li class="pass_li">
          <div class="tit"><label for="">비밀번호 확인 <span class="point">*</span></label></div>
          <div class="con">
            <input name="passwd2" type="password" class="input" placeholder="비밀번호 확인을 위해 한번 더 입력해주세요.">
          </div>
        </li>            
        <li>
          <div class="tit"><label for="">이름 <span class="point">*</span></label></div>
          <div class="con">
            <input type="text" value="<?=$name?>" name="">
          </div>
        </li>  

        <?=$hide_tphone_start?>
        <li class="tel_li tel_li_01">
          <div class="tit"><label for="">전화번호 <span class="point"><? if($info_ess[tphone]) echo "*"; ?></span></label></div>
          <div class="con">
            <input name="tphone1" type="text" value="<?=$tphone1?>" class="input">
            <span>-</span>
            <input name="tphone2" type="text" value="<?=$tphone2?>" class="input">
            <span>-</span>
            <input name="tphone3" type="text" value="<?=$tphone3?>" class="input">          
          </div>
        </li>  
        <?=$hide_tphone_end?>

        <?=$hide_hphone_start?>
        <li class="tel_li tel_li_02">
          <div class="tit"><label for="">휴대폰 번호 <span class="point"><? if($info_ess[hphone]) echo "*"; ?></span></div>
            <div class="con">
              <input name="hphone1" type="text" value="<?=$hphone1?>" class="input">
              <span>-</span>
              <input name="hphone2" type="text" value="<?=$hphone2?>" class="input">
              <span>-</span>
              <input name="hphone3" type="text" value="<?=$hphone3?>" class="input">
            </div>
        </li>       
        <li class="tel_chk_li chk_li">
          <div class="tit"><label for="">SMS 수신동의 여부</label></div>
          <div class="con">
            <div class="design_chk">
              <input name="resms" type="radio" class="radio" value="Y" id="tel_y" <?=$resms_y?>>
              <label for="tel_y" class="radio">동의</label>
            </div>
            <div class="design_chk">
              <input name="resms" type="radio"  class="radio" value="N" id="tel_n" <?=$resms_n?>>
              <label for="tel_n" class="radio">비동의</label>
            </div>          
          </div>
        </li>      
        <?=$hide_hphone_end?>    

        <?=$hide_email_start?>
        <li class="email_li">
          <div class="tit"><label for="">이메일 <span class="point"><? if($info_ess[email]) echo "*"; ?></span></label></div>
          <div class="con">
            <input type="text" name="email" value="<?=$email?>" size="30" maxlength="80" class="input">
          </div>
        </li>   
        <?=$hide_email_end?>

        <?=$hide_reemail_start?>
        <li class="email_chk_li chk_li">
          <div class="tit"><label for="">이메일 수신동의 여부</label></div>
          <div class="con">
            <div class="design_chk">
              <input name="reemail" type="radio" class="radio" value="Y" id="email_y" checked <?=$reemail_y?>>
              <label for="email_y" class="radio">동의</label>
            </div>
            <div class="design_chk">
              <input name="reemail" type="radio" class="radio" value="N" id="email_n" <?=$reemail_n?>>
              <label for="email_n" class="radio">비동의</label>
            </div>
          </div>
        </li>   
        <?=$hide_reemail_end?>      

        <!-- 새로 추가된 요소, 따로 개발 요청 (일단대기) -->
        <li class="chk_li">
          <div class="tit"><label for="">소속 구분<span class="point">*</span></label></div>
          <div class="con">
            <div class="design_chk">
              <input type="radio" name="aff" value="" id="aff_01">
              <label for="aff_01" class="radio">산업체</label>
            </div>
            <div class="design_chk">
              <input type="radio" name="aff" value="" id="aff_02">
              <label for="aff_02" class="radio">기관</label>
            </div>
            <div class="design_chk">
              <input type="radio" name="aff" value="" id="aff_03">
              <label for="aff_03" class="radio">대학</label>
            </div>
            <div class="design_chk">
              <input type="radio" name="aff" value="" id="aff_04">
              <label for="aff_04" class="radio">기타</label>
            </div>                              
          </div>
        </li>
        <li>
          <div class="tit"><label for="">소속 단체/회사명</label></div>
          <div class="con">
            <input type="text" value="" name="" placeholder="소속 단체/회사명을 입력해주세요.">
          </div>
        </li>
        <li>
          <div class="tit"><label for="">부서/직위</label></div>
          <div class="con">
            <input type="text" value="" name="" placeholder="부서와 직위를 입력해주세요.">
          </div>
        </li>      
        <!-- //새로 추가된 요소, 따로 개발 요청 -->     
      </ul>
  </div>
  <div class="edit_form_ok">
    <button type="button" class="back_btn" onClick="history.go(-1);">취소</button>
    <label for="edit_ok">
      <input type="image" id="edit_ok">확인
    </label>
  </div>  
</div>

</form>

<!-- 이 밑으로는 이전 코드, 사용되는지 여부를 아직 몰라 대기 -->
    <?=$hide_nick_start?>
    <tr>
      <td width="18%" height="32" align="left" bgcolor="fafaf9" class="tit" style="border-right:1px solid #d7d7d7; color:#707070; padding-left:10px;">닉네임 <? if($info_ess[nick]) echo "*"; ?></td>
      <td colspan="9" align="left" style="padding-left:10px">
        <input name="nick" value="<?=$nick?>" type="text" class="input" size="15" readonly onClick="nickCheck();"/>
        <img src="<?=$skin_dir?>/image/input_bt_search.gif" width="112" height="21" border="0" align="absmiddle" style="cursor:pointer" onClick="nickCheck()">&nbsp;
      </td>
    </tr>
    <tr>
      <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
    </tr>
    <?=$hide_nick_end?>
    
    <?=$hide_photo_start?>
    <tr>
      <td width="18%" height="32" align="left" bgcolor="fafaf9" class="tit" style="border-right:1px solid #d7d7d7; color:#707070; padding-left:10px;">회원사진 <? if($info_ess[photo]) echo "*"; ?></td>
      <td colspan="9" align="left" style="padding-left:10px"><?=$photo?><input name="photo" type="file" class="input" size="15" /></td>
    </tr>
    <tr>
      <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
    </tr>
    <?=$hide_photo_end?>
    
    <?=$hide_icon_start?>
    <tr>
      <td width="18%" height="32" align="left" bgcolor="fafaf9" class="tit" style="border-right:1px solid #d7d7d7; color:#707070; padding-left:10px;">회원아이콘 <? if($info_ess[icon]) echo "*"; ?></td>
      <td colspan="9" align="left" style="padding-left:10px"><?=$icon?><input name="icon" type="file" class="input" size="15" /></td>
    </tr>
    <tr>
      <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
    </tr>
    <?=$hide_icon_end?>
    
    <?=$hide_resno_start?>
    <tr>
      <td width="18%" height="32" align="left" bgcolor="fafaf9" class="tit" style="border-right:1px solid #d7d7d7; color:#707070; padding-left:10px;">주민등록번호 <? if($info_ess[resno]) echo "*"; ?></td>
      <td colspan="9" align="left" style="padding-left:10px; padding-top:5px;"><?=$resno?></td>
    </tr>
    <tr>
      <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
    </tr>
    <?=$hide_resno_end?>

    
    <?=$hide_comtel_start?>
    <tr>
      <td width="18%" height="32" align="left" bgcolor="fafaf9" class="tit" style="border-right:1px solid #d7d7d7; color:#707070; padding-left:10px;">회사전화 <? if($info_ess[comtel]) echo "*"; ?></td>
      <td colspan="9" align="left" style="padding-left:10px">
        <input name="comtel1" type="text" value="<?=$comtel1?>" class="input" size="3" />-
        <input name="comtel2" type="text" value="<?=$comtel2?>" class="input" size="4" />-
        <input name="comtel3" type="text" value="<?=$comtel3?>" class="input" size="4" />
      </td>
    </tr>
    <tr>
      <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
    </tr>
    <?=$hide_comtel_end?>
    

    
    <?=$hide_homepage_start?>
      <tr>
      <td width="18%" height="32" align="left" bgcolor="fafaf9" class="tit" style="border-right:1px solid #d7d7d7; color:#707070; padding-left:10px;">홈페이지 <? if($info_ess[homepage]) echo "*"; ?></td>
      <td colspan="9" align="left" style="padding-left:8px">
        <input type="text" name="homepage" value="<?=$homepage?>" size="40" maxlength="80" class="input">
      </td>
    </tr>
    <tr>
      <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
    </tr>
    <?=$hide_homepage_end?>
  

    
  </table>

</td>
</tr>
<tr>
<td>
  
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    
    <?
    if($info_use[birthday] || 
    $info_use[marriage] || 
    $info_use[memorial] || 
    $info_use[job] || 
    $info_use[scholarship] || 
    $info_use[income] || 
    $info_use[car] || 
    $info_use[hobby] || 
    $info_use[consph] || 
    $info_use[intro] || 
    $info_use[addinfo1] || 
    $info_use[addinfo2] || 
    $info_use[addinfo3] || 
    $info_use[addinfo4] || 
    $info_use[addinfo5])
    {
    ?>
    <tr><td height="30"></td></tr>
    <tr>
      <td colspan="11" style="padding-bottom:5px;">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left"><img src="<?=$skin_dir?>/image/form_tit02.gif" border="0" /></td>
            <td align="right"><img src="<?=$skin_dir?>/image/form_txt.gif" border="0" /></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td height="2" colspan="11" bgcolor="#a9a9a9"></td>
    </tr>
    <? } ?>
    
    <?=$hide_birthday_start?>
    <tr>
      <td width="18%" height="32" align="left" bgcolor="fafaf9" class="tit" style="border-right:1px solid #d7d7d7; color:#707070; padding-left:10px;">생년월일 <? if($info_ess[birthday]) echo "*"; ?></td>
      <td colspan="9" align="left" style="padding-left:10px">
        <input name="birthday1" value="<?=$birthday1?>" type="text" class="input" size="5">년
        <input name="birthday2" value="<?=$birthday2?>" type="text" class="input" size="3">월
        <input name="birthday3" value="<?=$birthday3?>" type="text" class="input" size="3">일 &nbsp; 
        (<input name="bgubun" value="양력" type="radio" class="radio" <?=$bgubun_s?>>양력<input name="bgubun" value="음력" type="radio" class="radio" <?=$bgubun_m?>><span class="gray">음력</span>)
      </td>
    </tr>
    <tr>
      <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
    </tr>
    <?=$hide_birthday_end?>
    
    <?=$hide_marriage_start?>
    <tr>
      <td width="18%" height="32" align="left" bgcolor="fafaf9" class="tit" style="border-right:1px solid #d7d7d7; color:#707070; padding-left:10px;">결혼여부 <? if($info_ess[marriage]) echo "*"; ?></td>
      <td colspan="9" align="left" style="padding-left:10px">
        <input name="marriage" value="미혼" type="radio" class="radio" <?=$marriage_n?>>미혼
        <input name="marriage" value="기혼" type="radio" class="radio" <?=$marriage_y?>><span class="gray"> 기혼</span>
      </td>
    </tr>
    <tr>
      <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
    </tr>
    <?=$hide_marriage_end?>
    
    <?=$hide_memorial_start?>
    <tr>
      <td width="18%" height="32" align="left" bgcolor="fafaf9" class="tit" style="border-right:1px solid #d7d7d7; color:#707070; padding-left:10px;">결혼기념일 <? if($info_ess[marriage]) echo "*"; ?></td>
      <td colspan="9" align="left" style="padding-left:10px">
        <input name="memorial1" type="text" value="<?=$memorial1?>" class="input" size="5">년
        <input name="memorial2" type="text" value="<?=$memorial2?>" class="input" size="3">월
        <input name="memorial3" type="text" value="<?=$memorial3?>" class="input" size="3">일
      </td>
    </tr>
    <tr>
      <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
    </tr>
    <?=$hide_memorial_end?>
    
    <?=$hide_job_start?>
    <tr>
      <td width="18%" height="32" align="left" bgcolor="fafaf9" class="tit" style="border-right:1px solid #d7d7d7; color:#707070; padding-left:10px;">직업 <? if($info_ess[job]) echo "*"; ?></td>
      <td colspan="9" align="left" style="padding-left:10px">
        <?=$job_list?>
        <script language="javascript">
        job = document.myinfoFrm.job;
        for(ii=0; ii<job.length; ii++){
          if(job.options[ii].value == "<?=$job?>")
            job.options[ii].selected = true;
        }
        </script>
      </td>
    </tr>
    <tr>
      <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
    </tr>
    <?=$hide_job_end?>
    
    <?=$hide_scholarship_start?>
    <tr>
      <td width="18%" height="32" align="left" bgcolor="fafaf9" class="tit" style="border-right:1px solid #d7d7d7; color:#707070; padding-left:10px;">학력 <? if($info_ess[scholarship]) echo "*"; ?></td>
      <td colspan="9" align="left" style="padding-left:10px">
        <?=$sch_list?>
        <script language="javascript">
        scholarship = document.myinfoFrm.scholarship;
        for(ii=0; ii<scholarship.length; ii++){
          if(scholarship.options[ii].value == "<?=$scholarship?>")
            scholarship.options[ii].selected = true;
        }
        </script>
      </td>
    </tr>
    <tr>
      <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
    </tr>
    <?=$hide_scholarship_end?>
    
    <?=$hide_income_start?>
    <tr>
      <td width="18%" height="32" align="left" bgcolor="fafaf9" class="tit" style="border-right:1px solid #d7d7d7; color:#707070; padding-left:10px;">월평균소득 <? if($info_ess[income]) echo "*"; ?></td>
      <td colspan="9" align="left" style="padding-left:10px">
        <?=$income_list?>
        <script language="javascript">
        income = document.myinfoFrm.income;
        for(ii=0; ii<income.length; ii++){
          if(income.options[ii].value == "<?=$income?>")
            income.options[ii].selected = true;
        }
        </script>
      </td>
    </tr>
    <tr>
      <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
    </tr>
    <?=$hide_income_end?>
    
    
    <?=$hide_car_start?>
    <tr>
      <td width="18%" height="32" align="left" bgcolor="fafaf9" class="tit" style="border-right:1px solid #d7d7d7; color:#707070; padding-left:10px;">자동차소유 <? if($info_ess[car]) echo "*"; ?></td>
      <td colspan="9" align="left" style="padding-left:10px">
        <input name="car" type="radio" value="소유" <?=$car_y?>>소유 
        <input name="car" type="radio" value="미소유" <?=$car_n?>>미소유
      </td>
    </tr>
    <tr>
      <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
    </tr>
    <?=$hide_car_end?>
    
    <?=$hide_hobby_start?>
    <tr>
      <td width="18%" height="32" align="left" bgcolor="fafaf9" class="tit" style="border-right:1px solid #d7d7d7; color:#707070; padding-left:10px;">취미 <? if($info_ess[hobby]) echo "*"; ?></td>
      <td colspan="9" align="left" style="padding-left:10px">
        <input name="hobby" type="text" value="<?=$hobby?>" class="input" size="30">
      </td>
    </tr>
    <tr>
      <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
    </tr>
    <?=$hide_hobby_end?>
    
    <?=$hide_consph_start?>
    <tr>
      <td width="18%" height="32" align="left" bgcolor="fafaf9" class="tit" style="border-right:1px solid #d7d7d7; color:#707070; padding-left:10px;">관심분야 <? if($info_ess[consph]) echo "*"; ?></td>
      <td colspan="9" align="left" style="padding-left:10px"><?=$consph_list?></td>
    </tr>
    <tr>
      <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
    </tr>
    <?=$hide_consph_end?>
    
    <?=$hide_intro_start?>
    <tr>
      <td width="18%" height="32" align="left" bgcolor="fafaf9" class="tit" style="border-right:1px solid #d7d7d7; color:#707070; padding-left:10px;">자기소개 <? if($info_ess[intro]) echo "*"; ?></td>
      <td colspan="9" align="left" style="padding-left:10px">
        <textarea name="intro" rows="5" cols="10" style="width:98%" class="input"><?=$intro?></textarea>
      </td>
    </tr>
    <tr>
      <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
    </tr>
    <?=$hide_intro_end?>
    
    <?=$hide_addinfo1_start?>
    <tr>
      <td width="18%" height="32" align="left" bgcolor="fafaf9" class="addinfo1_input" style="border-right:1px solid #d7d7d7; color:#707070; padding-left:10px;"><?=$addname1?> <? if($info_ess[addinfo1]) echo "*"; ?></td>
      <td colspan="9" align="left" style="padding-left:10px"><?=$addinfo1_input?></td>
    </tr>
    <tr>
      <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
    <tr>
    <?=$hide_addinfo1_end?>
    <?=$hide_addinfo2_start?>
    <tr>
      <td width="18%" height="32" align="left" bgcolor="fafaf9" class="addinfo1_input" style="border-right:1px solid #d7d7d7; color:#707070; padding-left:10px;"><?=$addname2?> <? if($info_ess[addinfo2]) echo "*"; ?></td>
      <td colspan="9" align="left" style="padding-left:10px"><?=$addinfo2_input?></td>
    </tr>
    <tr>
      <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
    <tr>
    <?=$hide_addinfo2_end?>
    <?=$hide_addinfo3_start?>
    <tr>
      <td width="18%" height="32" align="left" bgcolor="fafaf9" class="addinfo1_input" style="border-right:1px solid #d7d7d7; color:#707070; padding-left:10px;"><?=$addname3?> <? if($info_ess[addinfo3]) echo "*"; ?></td>
      <td colspan="9" align="left" style="padding-left:10px"><?=$addinfo3_input?></td>
    </tr>
    <tr>
      <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
    <tr>
    <?=$hide_addinfo3_end?>
    <?=$hide_addinfo4_start?>
    <tr>
      <td width="18%" height="32" align="left" bgcolor="fafaf9" class="addinfo1_input" style="border-right:1px solid #d7d7d7; color:#707070; padding-left:10px;"><?=$addname4?> <? if($info_ess[addinfo4]) echo "*"; ?></td>
      <td colspan="9" align="left" style="padding-left:10px"><?=$addinfo4_input?></td>
    </tr>
    <tr>
      <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
    <tr>
    <?=$hide_addinfo4_end?>
    <?=$hide_addinfo5_start?>
    <tr>
      <td width="18%" height="32" align="left" bgcolor="fafaf9" class="addinfo1_input" style="border-right:1px solid #d7d7d7; color:#707070; padding-left:10px;"><?=$addname5?> <? if($info_ess[addinfo5]) echo "*"; ?></td>
      <td colspan="9" align="left" style="padding-left:10px"><?=$addinfo5_input?></td>
    </tr>
    <tr>
      <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
    <tr>
    <?=$hide_addinfo5_end?>    
  </table>
</td>
</tr>
</table>
<!-- //이 밑으로는 이전 코드, 사용되는지 여부를 아직 몰라 대기 -->