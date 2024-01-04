<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<? include "../head.php"; ?>

      <script language="javascript">
      <!--
      function inputCheck(frm){
      	if(frm.designer_id.value == ""){
      		alert("디자이너 아이디를 입력하세요.");
      		frm.designer_id.focus();
      		return false;
      	}
      	if(frm.designer_pw.value == ""){
      		alert("디자이너 비밀번호를 입력하세요.");
      		frm.designer_pw.focus();
      		return false;
      	}
      }

			// 아이디 중복확인
			function idCheck(){
			   var id = document.frm.designer_id.value;
			   var url = "../member/id_check.php?name=designer_id&id=" + id;
			   window.open(url, "idCheck", "width=350, height=150, menubar=no, scrollbars=no, resizable=no, toolbar=no, status=no, left=150, top=150");
			}

      -->
      </script>
      
      <table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">기본설정</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">사이트운영에 필요한 기본정보를 설정합니다.</td>
        </tr>
      </table>

			<br>
		<form name="frm" action="basic_save.php" method="post" enctype="multipart/form-data" onSubmit="return inputCheck(this)">
      <input type="hidden" name="tmp">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>

            <table width="100%" border="0" cellspacing="0" cellpadding="2">
			        <tr>
			          <td align="right">
			          	<img src="../image/btn_manual.gif" style="cursor:hand" onClick="window.open('http://anywiz.co.kr/man/wizhome/index.html','','');">
                  <img src="../image/btn_dbdesc.gif" style="cursor:hand" onClick="window.open('/admin/desc_table.php?mode=print','','');">
                  <img src="../image/btn_filedesc.gif" style="cursor:hand" onClick="window.open('/admin/desc_file.php?mode=print','','');">
			          </td>
			        </tr>
			      </table>

						<br>
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
			        <tr>
			          <td class="tit_sub"><img src="../image/ics_tit.gif" align="absmiddle"> 최종 업데이트 날짜</td>
			        </tr>
			      </table>
            <table width="100%" border="0" cellspacing="1" cellpadding="3" class="t_style">
              <tr>
                <td width="15%" class="t_name">최종 업데이트 날짜</td>
                <td width="85%" class="t_value">
                	<?=$site_info[up_date]?>
                </td>
              </tr>
            </table>
						<br>
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
			        <tr>
			          <td class="tit_sub"><img src="../image/ics_tit.gif" align="absmiddle"> 라이센스키 등록</td>
			        </tr>
			      </table>
            <table width="100%" border="0" cellspacing="1" cellpadding="3" class="t_style">
              <tr>
                <td width="15%" class="t_name">라이센스 키</td>
                <td width="85%" class="t_value">
                	<textarea name="site_key" rows="2" cols="50" class="textarea"><?=$site_info[site_key]?></textarea>&nbsp;
                	<a href="http://www.anywiz.co.kr" target="_blank"><img src="../image/btn_license.gif" border="0"></a>
                </td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="6">
              <tr>
                <td>
                	- 라이센스 키 를 등록하지 않을경우 위즈홈 설치 2주일 후 부터 관리자 기능을 사용할 수 없습니다.<br>
                	- 도메인이 변경될 경우 라이센스 키를 다시 발급받아야 합니다.<br>
                	- 도메인이 여러개인경우 한라인에 하나씩 추가할 수 있습니다.
                </td>
              </tr>
            </table>
            <br>
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
			        <tr>
			          <td class="tit_sub"><img src="../image/ics_tit.gif" align="absmiddle"> 관리자 로고 및 타이틀</td>
			        </tr>
			      </table>
            <table width="100%" border="0" cellspacing="1" cellpadding="3" class="t_style">
              <tr>
                <td width="15%" class="t_name">관리자 로고</td>
                <td width="85%" class="t_value">
                <? if(is_file(WIZHOME_PATH."/data/config/admin_logo.gif")) echo "<br><img src='/admin/data/config/admin_logo.gif'><br><br>"; ?>
                <input name="admin_logo" type="file" class="input">
                </td>
              </tr>
              <tr>
                <td class="t_name">관리자 타이틀</td>
                <td class="t_value"><input name="admin_title" type="text" value="<?=$site_info[admin_title]?>" size="80" class="input"></td>
              </tr>
              <tr>
                <td class="t_name">관리자 카피라잇</td>
                <td class="t_value"><textarea name="admin_copyright" rows="3" cols="80" class="textarea"><?=$site_info[admin_copyright]?></textarea></td>
              </tr>
            </table>
            <br>
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
			        <tr>
			          <td class="tit_sub"><img src="../image/ics_tit.gif" align="absmiddle"> 디자이너 아이디/비밀번호</td>
			        </tr>
			      </table>
            <table width="100%" border="0" cellspacing="1" cellpadding="3" class="t_style">
              <tr>
                <td width="15%" class="t_name">디자이너 아이디</td>
                <td width="85%" class="t_value"><input name="designer_id" type="text" value="<?=$site_info[designer_id]?>" maxlength="20" class="input" readonly> <img src="../image/btn_idcheck.gif" style="cursor:hand" align="absmiddle" onCLick="idCheck()"></td>
              </tr>
              <tr>
                <td class="t_name">디자이너 비밀번호</td>
                <td class="t_value"><input name="designer_pw" type="text" value="<?=$site_info[designer_pw]?>" maxlength="20" class="input"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="6">
              <tr>
                <td>
                	- 디자이너 아이디/비밀번호으로 로그인시에만 환경설정 메뉴가 나타며 일반관리자는 보이지 않습니다.<br>
                	- 사이트 제작 완료후 관리자 비번이 변경되었더라도 디자이너 정보로 접속하므로 관리자 접속에 편리합니다.</td>
              </tr>
            </table>
            <br>
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
			        <tr>
			          <td class="tit_sub"><img src="../image/ics_tit.gif" align="absmiddle"> 메뉴 사용여부</td>
			        </tr>
			      </table>
            <table width="100%" border="0" cellspacing="1" cellpadding="3" class="t_style">
              <tr>
                <td width="15%" class="t_name">메뉴 선택</td>
                <td width="85%" class="t_value">
								<?
								$menu_tmp = explode("/",$site_info[menu_use]);
								for($ii=0; $ii<count($menu_tmp); $ii++){
									$menu_arr[$menu_tmp[$ii]] = true;
								}
								?>
                <table cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="center"><input type="checkbox" name="menu_use[]" value="BASIC" <? if($menu_arr["BASIC"]==true) echo "checked";?>></td><td>기본설정</td><td width="10"></td>
                    <td align="center"><input type="checkbox" name="menu_use[]" value="BBS" <? if($menu_arr["BBS"]==true) echo "checked";?>></td><td>게시판관리</td><td width="10"></td>
                    <td align="center"><input type="checkbox" name="menu_use[]" value="LOG" <? if($menu_arr["LOG"]==true) echo "checked";?>></td><td>접속통계</td><td width="10"></td>
                    <td align="center"><input type="checkbox" name="menu_use[]" value="MEMBER" <? if($menu_arr["MEMBER"]==true) echo "checked";?>></td><td>회원관리</td><td width="10"></td>
                    <td align="center"><input type="checkbox" name="menu_use[]" value="BANNER" <? if($menu_arr["BANNER"]==true) echo "checked";?>></td><td>배너관리</td>
                  </tr>
                  <tr>
                    <td align="center"><input type="checkbox" name="menu_use[]" value="FORMMAIL" <? if($menu_arr["FORMMAIL"]==true) echo "checked";?>></td><td>폼메일관리</td><td></td>
                    <td align="center"><input type="checkbox" name="menu_use[]" value="POLL" <? if($menu_arr["POLL"]==true) echo "checked";?>></td><td>설문관리</td><td></td>
                    <td align="center"><input type="checkbox" name="menu_use[]" value="SCHEGUAL" <? if($menu_arr["SCHEGUAL"]==true) echo "checked";?>></td><td>스케쥴관리</td><td></td>
                    <td align="center"><input type="checkbox" name="menu_use[]" value="PRODUCT" <? if($menu_arr["PRODUCT"]==true) echo "checked";?>></td><td>상품관리</td><td></td>
                    <td align="center"><input type="checkbox" name="menu_use[]" value="PAGE" <? if($menu_arr["PAGE"]==true) echo "checked";?>></td><td>페이지관리</td>
                    <!--td align="center"><input type="checkbox" name="menu_use[]" value="CATALOG" <? if($menu_arr["CATALOG"]==true) echo "checked";?>></td><td>카다로그관리</td-->
                  </tr>

                </table>
                </td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="6">
              <tr>
                <td>
                	- 사용여부에 따라 메뉴을 보이거나 숨길 수 있습니다.
                </td>
              </tr>
            </table>
            <br>
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
			        <tr>
			          <td class="tit_sub"><img src="../image/ics_tit.gif" align="absmiddle"> 게시판추가 사용여부</td>
			        </tr>
			      </table>
            <table width="100%" border="0" cellspacing="1" cellpadding="3" class="t_style">
              <tr>
                <td width="15%" class="t_name">사용여부</td>
                <td width="85%" class="t_value">
                	<input type="radio" name="addbbs_use" value="Y" <? if(!strcmp($site_info[addbbs_use], "Y") || empty($site_info[addbbs_use])) echo "checked" ?>> 사용
                	<input type="radio" name="addbbs_use" value="N" <? if(!strcmp($site_info[addbbs_use], "N")) echo "checked" ?>> 사용안함
                </td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="6">
              <tr>
                <td>
                	- 게시판추가를 사용하지 않는 경우 "게시판관리 > 게시판목록"에서 게시판을 추가할 수 없습니다.
                </td>
              </tr>
            </table>
            <!--br>
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
			        <tr>
			          <td class="tit_sub"><img src="../image/ics_tit.gif" align="absmiddle"> 관리자 로그인후 이동페이지</td>
			        </tr>
			      </table>
            <table width="100%" border="0" cellspacing="1" cellpadding="3" class="t_style">
              <tr>
                <td width="15%" class="t_name">로그인후 이동페이지</td>
                <td width="85%" class="t_value">
                	<table>
                	<tr><td>기본페이지 : /admin/manage/main/main.php</td></tr>
                	<tr><td>http://<?=$HTTP_HOST?><input name="start_page" type="text" value="<?=$site_info[start_page]?>" size="50" class="input"></td></tr>
                	</table>
                </td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="6">
              <tr>
                <td>- 관리자 로그인 후 작성한 주소로 이동합니다.</td>
              </tr>
              <tr>
                <td>- 클라이언트요청 또는 메뉴의 중요도에 따라 관리자 로그인후 이동페이지를 설정합니다. </td>
              </tr>
            </table-->
						<br>
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
			        <tr>
			          <td class="tit_sub"><img src="../image/ics_tit.gif" align="absmiddle"> SMS 사용</td>
			        </tr>
			      </table>
            <table width="100%" border="0" cellspacing="1" cellpadding="3" class="t_style">
              <tr>
                <td width="15%" class="t_name">사용여부</td>
                <td width="85%" class="t_value">
                	<input type="radio" name="sms_use" value="Y" <? if($site_info[sms_use] == "Y") echo "checked"; ?>>사용함&nbsp;
                	<input type="radio" name="sms_use" value="N" <? if($site_info[sms_use] == "N") echo "checked"; ?>>사용안함
                </td>
              </tr>
              <tr>
                <td class="t_name">SMS아이디</td>
                <td class="t_value"><input type="text" name="sms_id" value="<?=$site_info[sms_id]?>" class="input"></td>
              </tr>
              <tr>
                <td class="t_name">SMS비밀번호</td>
                <td class="t_value"><input type="text" name="sms_pw" value="<?=$site_info[sms_pw]?>" class="input"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="6">
              <tr>
                <td>- SMS서비스는 애니위즈에서 서비스 해드리며 SMS서비스 업체와 계약이 되있습니다.</td>
              </tr>
              <tr>
                <td>- SMS를 사용하는경우 기본설정에 "SMS관리" 메뉴가 생성되며 충전및발송 가능횟수를 조회할 수 있습니다.</td>
              </tr>
              <tr>
                <td>- 회원관리에 "SMS발송" 메뉴가 생성되어 전체발송이 가능하며 회원목록에서 개별,선택발송이 가능합니다.</td>
              </tr>
            </table>
            <br>
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
			        <tr>
			          <td class="tit_sub"><img src="../image/ics_tit.gif" align="absmiddle"> 실명인증 사용</td>
			        </tr>
			      </table>
            <table width="100%" border="0" cellspacing="1" cellpadding="3" class="t_style">
              <tr>
                <td width="15%" class="t_name">사용여부</td>
                <td width="85%" class="t_value">
                	<input type="radio" name="namecheck_use" value="Y" <? if($site_info[namecheck_use] == "Y") echo "checked"; ?>>사용함&nbsp;
                	<input type="radio" name="namecheck_use" value="N" <? if($site_info[namecheck_use] == "N") echo "checked"; ?>>사용안함
                </td>
              </tr>
              <tr>
                <td class="t_name">실명인증 아이디</td>
                <td class="t_value"><input type="text" name="namecheck_id" value="<?=$site_info[namecheck_id]?>" class="input"></td>
              </tr>
              <tr>
                <td class="t_name">실명인증 비밀번호</td>
                <td class="t_value"><input type="text" name="namecheck_pw" value="<?=$site_info[namecheck_pw]?>" class="input"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="6">
              <tr>
                <td>- 실명인증을 사용하는 경우 회원가입 약관페이지에서 실명을 체크하게 됩니다.</td>
              </tr>
              <tr>
                <td>- 실명인증은 한국신용평가정보(주)에서 제공하며 <a href="http://www.namecheck.co.kr" target="_blank">http://www.namecheck.co.kr</a>에서 신청하실 수 있습니다.</td>
              </tr>
              <tr>
                <td>- 신청 후 발급받은 아이디와 비밀번호를 입력 저장하면 바로 실명인증 체크가 가능합니다.</td>
              </tr>
              <tr>
                <td><font color=red>주의) 신청후 받은 cb_namecheck 파일을 /admin/member 폴더에 업로드(<b>전송타입 꼭 바이너리</b>)후 707퍼미션을 줍니다.</font></td>
              </tr>
            </table>

            <br>
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
			        <tr>
			          <td class="tit_sub"><img src="../image/ics_tit.gif" align="absmiddle"> 쪽지 사용</td>
			        </tr>
			      </table>
            <table width="100%" border="0" cellspacing="1" cellpadding="3" class="t_style">
              <tr>
                <td width="15%" class="t_name">사용여부</td>
                <td width="85%" class="t_value">
                	<input type="radio" name="msg_use" value="Y" <? if($site_info[msg_use] == "Y") echo "checked"; ?>>사용함&nbsp;
                	<input type="radio" name="msg_use" value="N" <? if($site_info[msg_use] == "N") echo "checked"; ?>>사용안함
                </td>
              </tr>
            </table>


            <br>
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
			        <tr>
			          <td class="tit_sub"><img src="../image/ics_tit.gif" align="absmiddle"> 포인트 사용</td>
			        </tr>
			      </table>
            <table width="100%" border="0" cellspacing="1" cellpadding="3" class="t_style">
              <tr>
                <td width="15%" class="t_name">사용여부</td>
                <td width="85%" class="t_value" colspan=3>
                	<input type="radio" name="point_use" value="Y" <? if($site_info[point_use] == "Y") echo "checked"; ?>>사용함&nbsp;
                	<input type="radio" name="point_use" value="N" <? if($site_info[point_use] == "N") echo "checked"; ?>>사용안함
                </td>
              </tr>
            </table>

            <br>
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
			        <tr>
			          <td class="tit_sub"><img src="../image/ics_tit.gif" align="absmiddle"> 미니홈피 사용</td>
			        </tr>
			      </table>
            <table width="100%" border="0" cellspacing="1" cellpadding="3" class="t_style">
              <tr>
                <td width="15%" class="t_name">사용여부</td>
                <td width="85%" class="t_value" colspan=3>
                	<input type="radio" name="mini_use" value="Y" <? if($site_info[mini_use] == "Y") echo "checked"; ?>>사용함&nbsp;
                	<input type="radio" name="mini_use" value="N" <? if($site_info[mini_use] == "N") echo "checked"; ?>>사용안함
                </td>
              </tr>
            </table>
            
            <br>
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
			        <tr>
			          <td class="tit_sub"><img src="../image/ics_tit.gif" align="absmiddle"> SSL 사용</td>
			        </tr>
			      </table>
            <table width="100%" border="0" cellspacing="1" cellpadding="3" class="t_style">
              <tr>
                <td width="15%" class="t_name">사용여부</td>
                <td width="35%" class="t_value">
                	<input type="radio" name="ssl_use" value="Y" <? if($site_info[ssl_use] == "Y") echo "checked"; ?>>사용함&nbsp;
                	<input type="radio" name="ssl_use" value="N" <? if($site_info[ssl_use] == "N") echo "checked"; ?>>사용안함
                </td>
                <td width="15%" class="t_name">포트번호</td>
                <td width="35%" class="t_value">
                	<input type="text" name="ssl_port" value="<?=$site_info[ssl_port]?>" class="input">
                </td>
              </tr>
            </table>
            <table width="100%" border="0" cellpadding="0" cellspacing="6">
              <tr>
                <td>- SSL을 사용하는 경우 기본적으로 서버에 SSL이 적용이 되어있어야합니다.</td>
              </tr>
              <tr>
                <td>- 확인 방법 https://해당도메인 ex) https://<?=$HTTP_HOST?> </td>
              </tr>
            </table>

          </td>
        </tr>
      </table>

      <br>

      <table align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
          	<input type="image" src="../image/btn_confirm_l.gif"> &nbsp; 
          	<input type="image" src="../image/btn_list_l.gif">
          </td>
        </tr>
      </table>
	  </form>

<? include "../foot.php"; ?>
