<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<?
if($mode == "update"){

	$sql = "select * from wiz_admin where id = '$id'";
	$result = mysql_query($sql) or error(mysql_error());
	$admin_info = mysql_fetch_array($result);

}
?>
<?
$page_name = "관리자설정";
$page_desc = "관리자 상세정보를 설정합니다.";
$navi_name = " 기본설정 > 관리자설정";
?>
<? include "../head.php"; ?>

<script language="JavaScript" type="text/javascript">
<!--
function inputCheck(frm){

   if(frm.id.value == ""){
      alert("관리자 아이디를 입력하세요");
      frm.id.focus();
      return false;
   }
   if(frm.passwd.value == ""){
      alert("관리자 비밀번호를 입력하세요");
      frm.passwd.focus();
      return false;
   }
   if(frm.name.value == ""){
      alert("관리자 이름을 입력하세요");
      frm.name.focus();
      return false;
   }
   if(frm.email.value == ""){
      alert("관리자 이메일을 입력하세요");
      frm.email.focus();
      return false;
   }
}

// 주소찾기
function searchZip(){
	var url = "../member/search_zip.php";
	window.open(url,"searchZip","height=350, width=367, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, top=100, left=100");
}

// 아이디 중복확인
function idCheck(){
   var id = document.frm.id.value;
   var url = "../member/id_check.php?name=id&id=" + id;
   window.open(url, "idCheck", "width=350, height=150, menubar=no, scrollbars=no, resizable=no, toolbar=no, status=no, left=150, top=150");
}
//-->
</script>
<script language="javascript">
<!--
function checkBasic(type){
   var check00 = document.getElementById("02-00").checked;
   document.getElementById("02-01").checked = check00;
   document.getElementById("02-02").checked = check00;
   document.getElementById("02-03").checked = check00;
   document.getElementById("02-04").checked = check00;
}
function checkBasic2(ck){
   var check00 = document.getElementById("02-00").checked
   if(ck.checked == true || check00){
      document.getElementById("02-00").checked = true;
      document.getElementById("02-01").checked = true;
   }
}
function checkWork(type){
   var check00 = document.getElementById("03-00").checked;
   document.getElementById("03-01").checked = check00;
   document.getElementById("03-02").checked = check00;
   document.getElementById("03-03").checked = check00;
}
function checkWork2(ck){
   var check00 = document.getElementById("03-00").checked
   if(ck.checked == true || check00){
      document.getElementById("03-00").checked = true;
      document.getElementById("03-01").checked = true;
   }
}
function checkMember(type){
   var check00 = document.getElementById("04-00").checked;
   document.getElementById("04-01").checked = check00;
   document.getElementById("04-02").checked = check00;
   document.getElementById("04-03").checked = check00;
   document.getElementById("04-04").checked = check00;
   document.getElementById("04-05").checked = check00;
   document.getElementById("04-06").checked = check00;
}
function checkMember2(ck){
   var check00 = document.getElementById("04-00").checked
   if(ck.checked == true || check00){
      document.getElementById("04-00").checked = true;
      document.getElementById("04-01").checked = true;
   }
}
function checkBbs(type){
   var check00 = document.getElementById("05-00").checked;
   document.getElementById("05-01").checked = check00;
   document.getElementById("05-02").checked = check00;
}
function checkBbs2(ck){
   var check00 = document.getElementById("05-00").checked
   if(ck.checked == true || check00){
      document.getElementById("05-00").checked = true;
      document.getElementById("05-01").checked = true;
   }
}

function checkMarketing(type){
   var check00 = document.getElementById("07-00").checked;
   document.getElementById("07-01").checked = check00;
   document.getElementById("07-02").checked = check00;
   document.getElementById("07-03").checked = check00;
}
function checkMarketing2(ck){
   var check00 = document.getElementById("07-00").checked
   if(ck.checked == true || check00){
      document.getElementById("07-00").checked = true;
      document.getElementById("07-01").checked = true;
   }
}
-->
</script>
</head>
			
			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">관리자목록</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">관리자를 추가/수정/삭제 합니다.</td>
        </tr>
      </table>
      
      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <form name="frm" action="admin_save.php" method="post" onSubmit="return inputCheck(this);" enctype="multipart/form-data">
      <input type="hidden" name="tmp">
      <input type="hidden" name="mode" value="<?=$mode?>">
      <input type="hidden" name="page" value="<?=$page?>">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td width="15%" height="30" align="left" class="t_name">아이디 <font color=red>*</font></td>
                <td width="35%" class="t_value">
                	<input name="id" type="text" value="<?=$admin_info[id]?>" class="input" readonly>
									<? if(strcmp($mode, "update")) { ?>
                	<img src="../image/btn_idcheck.gif" align="absmiddle" style="cursor:hand" onCLick="idCheck()">
									<? } ?>
                </td>
                <td width="15%" height="30" align="left" class="t_name">비밀번호 <font color=red>*</font></td>
                <td width="35%" class="t_value"><input name="passwd" type="text" value="<?=$admin_info[passwd]?>" class="input"></td>
              </tr>
              <tr>
                <td height="30" align="left" class="t_name">이름 <font color=red>*</font></td>
                <td class="t_value"><input name="name" type="text" value="<?=$admin_info[name]?>" class="input"></td>
                <td height="30" align="left" class="t_name">이메일 <font color=red>*</font></td>
                <td class="t_value"><input name="email" type="text" value="<?=$admin_info[email]?>" class="input"></td>
              </tr>
              <tr>
                <td height="30" align="left" class="t_name">주민번호</td>
                <td class="t_value">
                  <? list($resno, $resno2) = explode("-",$admin_info[resno]); ?>
                  <input type="text" name="resno" value="<?=$resno?>" size="9" class="input"> -
                  <input type="text" name="resno2" value="<?=$resno2?>" size="9" class="input">
                </td>
                <td height="30" align="left" class="t_name">전화번호</td>
                <td class="t_value">
                  <? list($tphone, $tphone2, $tphone3) = explode("-",$admin_info[tphone]); ?>
                  <input type="text" name="tphone" value="<?=$tphone?>" size="5" class="input"> -
                  <input type="text" name="tphone2" value="<?=$tphone2?>" size="5" class="input"> -
                  <input type="text" name="tphone3" value="<?=$tphone3?>" size="5" class="input">
                </td>
              </tr>
              <tr>
                <td height="30" align="left" class="t_name">휴대폰</td>
                <td class="t_value">
                  <? list($hphone, $hphone2, $hphone3) = explode("-",$admin_info[hphone]); ?>
                  <input type="text" name="hphone" value="<?=$hphone?>"  size="5" class="input"> -
                  <input type="text" name="hphone2" value="<?=$hphone2?>"  size="5" class="input"> -
                  <input type="text" name="hphone3" value="<?=$hphone3?>"  size="5" class="input">
                  </td>
                <td height="30" align="left" class="t_name">회원등급</td>
                <td class="t_value">관리자</td>
              </tr>
              <tr>
                <td height="30" align="left" class="t_name">관리자아이콘</td>
                <td class="t_value" colspan="3">
                  <?
                	if($admin_info[icon] != "" && file_exists(WIZHOME_PATH."/data/member/".$admin_info[icon])){
                		echo "<img src=/admin2/data/member/".$admin_info[icon]." align='absmiddle'>";
                		echo "<input type='checkbox' name='delicon' value='Y'>";
                		echo "<font color='red'>삭제</font> <br>";
                	}
                	?>
                	<input name="icon" type="file" class="input">
                </td>
              </tr>
              <tr>
                <td height="30" align="left" class="t_name">우편번호</td>
                <td class="t_value" colspan="3">
                  <? list($post1, $post2) = explode("-",$admin_info[post]); ?>
                  <input name="post1" type="text" value="<?=$post1?>" size="5" class="input"> -
                  <input name="post2" type="text" value="<?=$post2?>" size="5" class="input">
                  <img src="../image/btn_post.gif" align="absmiddle" style="cursor:hand" onClick="searchZip();">
                </td>
              </tr>
              <tr>
                <td height="30" align="left" class="t_name">주소</td>
                <td class="t_value" colspan="3">
                <input name="address1" type="text" value="<?=$admin_info[address1]?>" size="60" class="input"><br>
                <input name="address2" type="text" value="<?=$admin_info[address2]?>" size="60" class="input">
                </td>
              </tr>
              <!--
              <tr>
                <td height="25" align="left" class="t_name">접근권한</td>
                <td class="t_value" colspan="3">
                  <?
                  $permi_list = explode("/",$admin_info[permi]);
                  for($ii=0; $ii<count($permi_list); $ii++){
                     $tmp_permi[$permi_list[$ii]] = true;
                  }
                  ?>
                  <table border="0" cellpadding="5" width="100%">
                    <tr>
                      <td width="33%" bgcolor="#efefef" valign="top">
                        <input type="checkbox" size="20" name="permi[]" value="00-00" checked disabled><b>관리자(인트라넷)접근</b><br><br>
                        <input type="checkbox" size="20" name="permi[]" value="01-00" <? if($tmp_permi["01-00"]==true || $mode == "insert") echo "checked"; ?>><b>환경설정</b><br><br>
                        <input type="checkbox" size="20" name="permi[]" value="06-00" <? if($tmp_permi["06-00"]==true || $mode == "insert") echo "checked"; ?>><b>폼메일</b>
                      </td>
                      <td width="33%" bgcolor="#efefef" valign="top">
                        <input type="checkbox" size="20" name="permi[]" id="02-00" value="02-00" onClick="checkBasic();" <? if($tmp_permi["02-00"]==true || $mode == "insert") echo "checked"; ?>><b>기본정보</b><br>
                        <input type="checkbox" size="20" name="permi[]" id="02-01" value="02-01" onClick="checkBasic2(this);" <? if($tmp_permi["02-01"]==true || $mode == "insert") echo "checked"; ?>>기본정보설정<br>
                        <input type="checkbox" size="20" name="permi[]" id="02-02" value="02-02" onClick="checkBasic2(this);" <? if($tmp_permi["02-02"]==true || $mode == "insert") echo "checked"; ?>>관리자설정<br>
                        <input type="checkbox" size="20" name="permi[]" id="02-03" value="02-03" onClick="checkBasic2(this);" <? if($tmp_permi["02-03"]==true || $mode == "insert") echo "checked"; ?>>팝업관리<br>
                        <input type="checkbox" size="20" name="permi[]" id="02-04" value="02-04" onClick="checkBasic2(this);" <? if($tmp_permi["02-04"]==true || $mode == "insert") echo "checked"; ?>>SMS관리/충전
                      </td>
                      <td width="33%" bgcolor="#efefef" valign="top">
                        <input type="checkbox" size="20" name="permi[]" id="03-00" onClick="checkWork();" value="03-00" <? if($tmp_permi["03-00"]==true || $mode == "insert") echo "checked"; ?>><b>사내업무</b><br>
                        <input type="checkbox" size="20" name="permi[]" id="03-01" onClick="checkWork2(this);" value="03-01" <? if($tmp_permi["03-01"]==true || $mode == "insert") echo "checked"; ?>>스케쥴관리<br>
                        <input type="checkbox" size="20" name="permi[]" id="03-02" onClick="checkWork2(this);" value="03-02" <? if($tmp_permi["03-02"]==true || $mode == "insert") echo "checked"; ?>>사내웹하드<br>
                        <input type="checkbox" size="20" name="permi[]" id="03-03" onClick="checkWork2(this);" value="03-03" <? if($tmp_permi["03-03"]==true || $mode == "insert") echo "checked"; ?>>거래처관리
                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#efefef" valign="top">
                        <input type="checkbox" size="20" name="permi[]" id="04-00" onClick="checkMember();" value="04-00" <? if($tmp_permi["04-00"]==true || $mode == "insert") echo "checked"; ?>><b>회원관리</b><br>
                        <input type="checkbox" size="20" name="permi[]" id="04-01" onClick="checkMember2(this);" value="04-01" <? if($tmp_permi["04-01"]==true || $mode == "insert") echo "checked"; ?>>회원목록<br>
                        <input type="checkbox" size="20" name="permi[]" id="04-02" onClick="checkMember2(this);" value="04-02" <? if($tmp_permi["04-02"]==true || $mode == "insert") echo "checked"; ?>>회원등록<br>
                        <input type="checkbox" size="20" name="permi[]" id="04-03" onClick="checkMember2(this);" value="04-03" <? if($tmp_permi["04-03"]==true || $mode == "insert") echo "checked"; ?>>등급관리<br>
                        <input type="checkbox" size="20" name="permi[]" id="04-04" onClick="checkMember2(this);" value="04-04" <? if($tmp_permi["04-04"]==true || $mode == "insert") echo "checked"; ?>>탈퇴회원<br>
                        <input type="checkbox" size="20" name="permi[]" id="04-05" onClick="checkMember2(this);" value="04-05" <? if($tmp_permi["04-05"]==true || $mode == "insert") echo "checked"; ?>>메일발송<br>
                        <input type="checkbox" size="20" name="permi[]" id="04-06" onClick="checkMember2(this);" value="04-06" <? if($tmp_permi["04-06"]==true || $mode == "insert") echo "checked"; ?>>SMS발송<br>
                      </td>
                      <td bgcolor="#efefef" valign="top">
                        <input type="checkbox" size="20" name="permi[]" id="05-00" onClick="checkBbs();" value="05-00" <? if($tmp_permi["05-00"]==true || $mode == "insert") echo "checked"; ?>><b>게시판관리</b><br>
                        <input type="checkbox" size="20" name="permi[]" id="05-01" onClick="checkBbs2(this);" value="05-01" <? if($tmp_permi["05-01"]==true || $mode == "insert") echo "checked"; ?>>게시판목록<br>
                        <input type="checkbox" size="20" name="permi[]" id="05-02" onClick="checkBbs2(this);" value="05-02" <? if($tmp_permi["05-02"]==true || $mode == "insert") echo "checked"; ?>>게시물관리<br>
                      </td>
                      <td bgcolor="#efefef" valign="top">
                        <input type="checkbox" size="20" name="permi[]" id="07-00" onClick="checkMarketing();" value="07-00" <? if($tmp_permi["07-00"]==true || $mode == "insert") echo "checked"; ?>><b>마케팅분석</b><br>
                        <input type="checkbox" size="20" name="permi[]" id="07-01" onClick="checkMarketing2(this);" value="07-01" <? if($tmp_permi["07-01"]==true || $mode == "insert") echo "checked"; ?>>접속자분석<br>
                        <input type="checkbox" size="20" name="permi[]" id="07-02" onClick="checkMarketing2(this);" value="07-02" <? if($tmp_permi["07-02"]==true || $mode == "insert") echo "checked"; ?>>접속경로분석<br>
                        <input type="checkbox" size="20" name="permi[]" id="07-03" onClick="checkMarketing2(this);" value="07-03" <? if($tmp_permi["07-03"]==true || $mode == "insert") echo "checked"; ?>>회원통계<br>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              -->
              <tr>
                <td height="25" align="left" class="t_name">메모</td>
                <td class="t_value" colspan="3">
                <textarea name="descript" rows="5" cols="90" class="textarea"><?=$admin_info[descript] ?></textarea>
                </td>
              </tr>
            </table></td>
        </tr>
      </table>
      
      <br>
      <table align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
          	<input type="image" src="../image/btn_confirm_l.gif"> &nbsp; 
          	<img src="../image/btn_list_l.gif" style="cursor:hand" onclick="document.location='admin_list.php?page=<?=$page?>';">
          </td>
        </tr>
      </form>
      </table>

<? include "../foot.php"; ?>
