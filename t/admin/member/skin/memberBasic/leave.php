<?
include "./inc/head.php"; 		// 탑부분
include "./inc/left.php";			// 카테고리, 왼쪽배너영역

?>
<!-- 실제 컨텐츠 부분 -->

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="35" align="right" class="here">HOME > 마이페이지 > <strong>회원정보수정</strong></td>
  </tr>
  <tr>
    <td class="title"><img src="../images/member/tit_mypage.gif" /></td>
  </tr>
  <tr>
    <td align="center" style="padding:30px 0px;"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="join_member">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="11" class="bpad_10"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><img src="../images/member/leave_stit01.gif" border="0" /></td>
                      <td align="right"><img src="../images/member/form_txt.gif" border="0" /></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="2" colspan="11" bgcolor="#a9a9a9"></td>
              </tr>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">아이디 *</td>
                <td colspan="9" align="left" style="padding-left:10px"><input name="id" type="text" class="join_input" size="15" onClick="idCheck()" readonly>
                  <img src="../images/member/input_bt_search.gif" width="112" height="21" border="0" align="absmiddle" onClick="idCheck()" style="cursor:hand"><span class="form_sub">(3~12 영문, 숫자, 가입 후 ID변경은 불가)</span></td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">이름 *</td>
                <td colspan="9" align="left" style="padding-left:10px"><input name="name" type="text" class="join_input"  <? if($name!="") echo "value='".$name."' readonly"; ?>size="15" /></td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>
              <?=$hide_addinfo1_start?>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">주민등록번호 *</td>
                <td colspan="9" align="left" style="padding-left:10px; padding-top:5px;"><!-- <?=$addinfo1_input?>-->
                  <input type='text' id='f1_0' name='fname[1][]' class='input' size='6' onkeyup="ad1_su(this.value)">
                  -
                  <input type='password' id='f1_2' name='f1_2' class='input' size='7' onkeyup="ad1_su(this.value)"></td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">비밀번호 *</td>
                <td colspan="9" align="left" style="padding-left:10px"><input name="passwd1" type="password" class="join_input" value="" size="15" />
                  <span class="form_sub">(특수문자 및 한글입력불가. 대소문자 구별. 6자리이상 입력)</span> </td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">비밀번호 확인 *</td>
                <td colspan="9" align="left" style="padding-left:10px"><input name="passwd2" type="password" class="join_input" value="" size="15" />
                  <span class="form_sub">비밀번호 확인을 위해 다시 한 번 입력해 주세요.</span></td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>              
              <?=$hide_addinfo1_end?>
              <?=$hide_address_start?>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">주소 *</td>
                <td colspan="9" align="left" style="padding-left:10px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><input type='text' name='post1' size='3' maxlength='3' class="join_input" onClick="postSearch('')" readonly>
                        -
                        <input type='text' name='post2' size='3' maxlength='3' class="join_input" onClick="postSearch('')" readonly>
                        <img src='../images/member/input_bt_zip.gif' border="0" align="absmiddle" onClick="postSearch()" style="cursor:hand"></td>
                    </tr>
                    <tr>
                      <td><input type='text' name='address1' id='addr1' size='50' maxlength='80' class="join_input" onClick="postSearch()" readonly>
                        <br>
                        <input type='text' name='address2' id='addr2' size='50' maxlength='80' class="join_input"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>
              <?=$hide_address_end?>
              <?=$hide_tphone_start?>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">전화번호 *</td>
                <td colspan="9" align="left" style="padding-left:10px"><input name="tphone1" type="text" class="join_input" value="" size="3" />
                  -
                  <input name="tphone2" type="text" class="join_input" value="" size="4" />
                  -
                  <input name="tphone3" type="text" class="join_input" value="" size="4" /></td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>
              <?=$hide_tphone_end?>
              <?=$hide_comtel_start?>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">휴대 전화번호 *</td>
                <td colspan="9" align="left" style="padding-left:10px"><table border="0" cellpadding="2" cellspacing="0">
                    <tr>
                      <td><input name="comtel1" type="text" class="join_input" value="" size="3" />
                        -
                        <input name="comtel2" type="text" class="join_input" value="" size="4" />
                        -
                        <input name="comtel3" type="text" class="join_input" value="" size="4" />
                        <br></td>
                    </tr>
                    <tr>
                      <td><span class="form_sub"><strong>문자 정보 서비스를 받으시겠습니까?</strong></span>
                        <input name="reemail" type="radio" value="Y" checked>
                        수신함
                        <input name="reemail" type="radio" value="N">
                      <span class="gray">수신하지 않음</span></td>
                    </tr>
                    <tr>
                      <td class="blue">* 주문,결제,이벤트 정보제공, 단 유효하지 않은 이메일은 서비스 불가.</td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>
              <?=$hide_comtel_end?>
              <?=$hide_hphone_start?>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">팩스  *</td>
                <td colspan="9" align="left" style="padding-left:10px"><input name="hphone1" type="text" class="join_input" value="" size="3" />
                  -
                  <input name="hphone2" type="text" class="join_input" value="" size="4" />
                  -
                  <input name="hphone3" type="text" class="join_input" value="" size="4" /></td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>
              <?=$hide_hphone_end?>
              <?=$hide_email_start?>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">이메일 *</td>
                <td colspan="9" align="left" style="padding-left:10px"><table border="0" cellpadding="2" cellspacing="0">
                    <tr>
                      <td><input name="comtel4" type="text" class="join_input" value="" size="3" />
                        -
                        <input name="comtel4" type="text" class="join_input" value="" size="4" />
                        -
                        <input name="comtel4" type="text" class="join_input" value="" size="4" />
                        <br></td>
                    </tr>
                    <tr>
                      <td class="form_sub"><strong>이메일 서비스를 받으시겠습니까?</strong>
                        <input name="reemail" type="radio" value="Y" checked>
                        예
                        <input name="reemail" type="radio" value="N">
                        <span class="gray">아니오</span></td>
                    </tr>
                    <tr>
                      <td class="blue">* 주문확인,배송 진행상황,알리미 등록,이벤트 공지 서비스 제공 해 드립니다.</td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>
              <?=$hide_email_end?>
              <?=$hide_reemail_start?>

            </table></td>
        </tr>
        <tr>
          <td class="tpad_30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="11" class="bpad_10"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><img src="../images/member/leave_stit02.gif" border="0" /></td>
                      <td align="right"><img src="../images/member/form_txt.gif" border="0" /></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="2" colspan="11" bgcolor="#a9a9a9"></td>
              </tr>
              <?=$hide_birthday_start?>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">생년월일</td>
                <td colspan="9" align="left" style="padding-left:10px"><input name="birthday1" type="text" class="join_input" size="5">
                  년
                  <input name="birthday2" type="text" class="join_input" size="3">
                  월
                  <input name="birthday3" type="text" class="join_input" size="3">
                  일 &nbsp; 
                  (
                  <input name="bgubun" value="양력" type="radio">
                  양력
                  <input name="bgubun" value="음력" type="radio">
                  <span class="gray">음력</span>) </td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>
              <?=$hide_birthday_end?>
              <?=$hide_marriage_start?>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">결혼여부</td>
                <td colspan="9" align="left" style="padding-left:10px"><input name="marriage" value="미혼" type="radio">
                  미혼
                  <input name="marriage" value="기혼" type="radio">
                 <span class="gray"> 기혼</span></td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>
              <?=$hide_marriage_end?>
              <?=$hide_memorial_start?>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">결혼기념일</td>
                <td colspan="9" align="left" style="padding-left:10px"><input name="memorial1" type="text" class="join_input" size="5">
                  년
                  <input name="memorial2" type="text" class="join_input" size="3">
                  월
                  <input name="memorial3" type="text" class="join_input" size="3">
                  일 </td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>
              <?=$hide_memorial_end?>
              <?=$hide_job_start?>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">직업</td>
                <td colspan="9" align="left" style="padding-left:10px"><select name="job" class="select">
                    <option selected>항목을 선택 해 주세요</option>
                    <option value="00">무직</option>
                    <option value="10">학생</option>
                    <option value="30">컴퓨터/인터넷</option>
                    <option value="50">언론</option>
                    <option value="70">공무원</option>
                    <option value="90">군인</option>
                    <option value="A0">서비스업</option>
                    <option value="C0">교육</option>
                    <option value="E0">금융/증권/보험업</option>
                    <option value="G0">유통업</option>
                    <option value="I0">예술</option>
                    <option value="K0">의료</option>
                    <option value="M0">법률</option>
                    <option value="O0">건설업</option>
                    <option value="Q0">제조업</option>
                    <option value="S0">부동산업</option>
                    <option value="U0">운송업</option>
                    <option value="W0">농/수/임/광산업</option>
                    <option value="Y0">가사</option>
                    <option value="z0">기타</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>
              <?=$hide_job_end?>
              <?=$hide_scholarship_start?>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">학력</td>
                <td colspan="9" align="left" style="padding-left:10px"><select name="scholarship" class="select">
                    <option value="" selected>항목을 선택 해 주세요</option>
                    <option value="0">없음</option>
                    <option value="1">초등학교재학</option>
                    <option value="2">초등학교졸업</option>
                    <option value="4">중학교재학</option>
                    <option value="6">중학교졸업</option>
                    <option value="7">고등학교재학</option>
                    <option value="9">고등학교졸업</option>
                    <option value="H">대학교재학</option>
                    <option value="J">대학교졸업</option>
                    <option value="O">대학원재학</option>
                    <option value="Z">대학원졸업이상</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>
              <?=$hide_scholarship_end?>
              <?=$hide_consph_start?>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">관심분야</td>
                <td colspan="9" align="left" style="padding-left:10px">
                  <input type="checkbox" name="consph[]" value="01"> 건강
                  <input type="checkbox" name="consph[]" value="02"> 문화/예술
                  <input type="checkbox" name="consph[]" value="03"> 경제
                  <input type="checkbox" name="consph[]" value="04"> 연예/오락
                  <input type="checkbox" name="consph[]" value="05"> 뉴스
                  <input type="checkbox" name="consph[]" value="06"> 여행/레저<br>
                  <input type="checkbox" name="consph[]" value="07"> 생활
                  <input type="checkbox" name="consph[]" value="08"> 스포츠
                  <input type="checkbox" name="consph[]" value="09"> 교육
                  <input type="checkbox" name="consph[]" value="10"> 컴퓨터
                  <input type="checkbox" name="consph[]" value="11"> 학문
                </td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>
              <?=$hide_consph_end?>
              <?=$hide_addinfo1_start?>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">사업자번호</td>
                <td colspan="9" align="left" style="padding-left:10px; padding-top:5px;"><!-- <?=$addinfo1_input?>-->
                  <input type='text' id='f1_0' name='fname[1][]' class='input' size='' onkeyup="ad1_su(this.value)">
                  &nbsp;</td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>
              <?=$hide_addinfo1_end?>
              <?=$hide_addinfo1_start?>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">상호</td>
                <td colspan="9" align="left" style="padding-left:10px; padding-top:5px;"><!-- <?=$addinfo1_input?>-->
                  <input type='text' id='f1_0' name='fname[1][]' class='input' size='' onkeyup="ad1_su(this.value)"></td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>
              <?=$hide_addinfo1_end?>
              <?=$hide_addinfo1_start?>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">대표자명</td>
                <td colspan="9" align="left" style="padding-left:10px; padding-top:5px;"><!-- <?=$addinfo1_input?>-->
                  <input type='text' id='f1_0' name='fname[1][]' class='input' size='' onkeyup="ad1_su(this.value)">
                  &nbsp;</td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>
              <?=$hide_addinfo1_end?>
              <?=$hide_address_start?>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">주소</td>
                <td colspan="9" align="left" style="padding-left:10px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><input type='text' name='post1' size='3' maxlength='3' class="join_input" onClick="postSearch('')" readonly>
                        -
                        <input type='text' name='post2' size='3' maxlength='3' class="join_input" onClick="postSearch('')" readonly>
                        <img src='../images/member/input_bt_zip.gif' border="0" align="absmiddle" onClick="postSearch()" style="cursor:hand"></td>
                    </tr>
                    <tr>
                      <td><input type='text' name='address1' id='addr1' size='50' maxlength='80' class="join_input" onClick="postSearch()" readonly>
                        <br>
                        <input type='text' name='address2' id='addr2' size='50' maxlength='80' class="join_input"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>
              <?=$hide_address_end?>
              <?=$hide_homepage_start?>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">업태</td>
                <td colspan="9" align="left" style="padding-left:10px"><input name="homepage" type="text" class="join_input" value="" size="30" /></td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>
              <?=$hide_homepage_end?>
              <?=$hide_recom_start?>
              <tr>
                <td width="15%" height="28" align="left" bgcolor="fafaf9" class="join_tit">종목</td>
                <td colspan="9" align="left" style="padding-left:10px"><input name="recom" type="text" class="join_input" value="" size="15" /></td>
              </tr>
              <tr>
                <td height="1" colspan="11" bgcolor="d7d7d7" ></td>
              </tr>
              <?=$hide_recom_end?>
           
            </table></td>
        </tr>
        <tr>
          <td height="50" align="center"><input type="image" src="../images/member/bt_modify_ok.gif" />
            &nbsp;&nbsp; <img src="../images/member/bt_cancel.gif" onClick="history.go(-1);" style="cursor:hand"/></td>
        </tr>
        
    </table></td>
  </tr>
</table>
<!-- 실제 컨텐츠 끝 -->
<?
include "./inc/foot.php"; 		// 푸터영역

?>
