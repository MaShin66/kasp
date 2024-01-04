<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?

$sql = "select * from wiz_meminfo";
$result = mysql_query($sql) or error(mysql_error());
$mem_info = mysql_fetch_array($result);

// 입력정보 사용여부
$info_tmp = explode("/",$mem_info[infouse]);
for($ii=0; $ii<count($info_tmp); $ii++){
	$info_use[$info_tmp[$ii]] = true;
}

// 입력정보 필수여부
$info_tmp = explode("/",$mem_info[infoess]);
for($ii=0; $ii<count($info_tmp); $ii++){
	$info_ess[$info_tmp[$ii]] = true;
}

$addname = explode("|", $mem_info[addname]);

$sql = "select fprior, ftype, fsize, fnum, flist from wiz_formfield where fidx = 'addinfo' order by fprior asc";
$result = mysql_query($sql) or error(mysql_error());

while($field_info = mysql_fetch_array($result)) {

	$flist[$field_info[fprior]] = explode("|", $field_info[flist]);

	$addtype[$field_info[fprior]] = $field_info[ftype];
	$addsize[$field_info[fprior]] = $field_info[fsize];
	$addnum[$field_info[fprior]] = $field_info[fnum];

	//echo $field_info[fprior]." - ".$addsize[$field_info[fprior]]."<br>";

}

$page_name = "회원설정"; $page_desc = "아래코드를 삽입하여 회원관련 페이지를 생성합니다.  "; $navi_name = "  환경설정  > 회원설정";
?>
<? include "../head.php"; ?>
<script language="javascript">
<!--
function inputCheck(frm){
/*
   if(frm.agreement.value == ""){
      alert("가입약관을 입력하세요");
      frm.agreement.focus();
      return false;
   }
   if(frm.safeinfo.value == ""){
      alert("개인정보 보호정책을 입력하세요");
      frm.safeinfo.focus();
      return false;
   }
*/
}

  var flist_array = new Array();

<?php
for($jj = 1; $jj <= count($flist); $jj++) {
?>
  flist_array[<?=$jj?>] = new Array();
<?php
	if(count($flist[$jj]) <= 1) {
?>
	flist_array[<?=$jj?>][0] = "";
<?php
	}

	for($ii = 0; $ii < count($flist[$jj]); $ii++) {
		if(!empty($flist[$jj][$ii])) {
?>
	flist_array[<?=$jj?>][<?=$ii?>] = "<?=$flist[$jj][$ii]?>";
<?php
		}
	}
}
?>

function flist(num) {
	var length = eval("document.frm.fnum"+num+".value");
	var tmp = '';

	if(!length || length <= 0)
	{
		length = 1;
	}
	else if(length > 20)
	{
		length = 20;
	}

	for(i=1; i<=length; i++)
	{

		if(flist_array[num].length > 0) {
			var ii = i - 1;
			if(flist_array[num][ii] == undefined) flist_array[num][ii] = "";
			tmp += " " + i + " <input type=\"text\" name=\"flist" + num + "[]\" value=\"" + flist_array[num][ii] + "\" class=\"input\"><br>";
		} else {
			tmp += " " + i + " <input type=\"text\" name=\"flist" + num + "[]\" value=\"\" class=\"input\"><br>";
		}
	}
	document.getElementById('flist_layer_' + num).innerHTML = tmp;

}

function setOpt(num) {

	var opt = eval("document.frm.ftype"+num+".value");

	document.getElementById('size_' + num).style.display = "block";
	document.getElementById('num_' + num).style.display = "block";
	document.getElementById('opt_' + num).style.display = "block";

	//사이즈 - test, textarea, file
	if(opt == "text" || opt == "textarea" || opt == "file") {
		document.getElementById('size_' + num).style.display = "block";
	}
	//옵션 갯수 - select, radio, checkbox
	if(opt == "select" || opt == "radio" || opt == "checkbox") {
		document.getElementById('num_' + num).style.display = "block";
		document.getElementById('opt_' + num).style.display = "block";
	}
}

function setEss(frm, val) {

	for(ii = 0; ii < frm.elements["info_use[]"].length; ii++) {
		if(frm.elements["info_use[]"][ii].value == val) {
			frm.elements["info_ess[]"][ii].checked = frm.elements["info_use[]"][ii].checked;
			break;
		}
	}

}

-->
</script>
</head>

<body onload="flist(1);flist(2);flist(3);flist(4);flist(5);setOpt(1);setOpt(2);setOpt(3);setOpt(4);setOpt(5);">

			<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">회원관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">아래코드를 삽입하여 회원관련 페이지를 생성합니다.</td>
        </tr>
      </table>

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
              <td>
              	<img src="../image/check_tit.gif" width="75" height="19" align="absmiddle">
              	&nbsp; 생성코드 삽입만으로 회원관련 모든 페이지를 완성할 수 있습니다.
              </td>
            </tr>
            <tr>
              <td class="chk_alt">
              - 스킨위치 : /admin/member/skin<br>
              - 회원가입항목은 기본항목선택, 임의추가도 가능합니다.<br>
              - 아이디/비번찾기 : 아이디, 비밀번호 찾기가 한페이지에 보여집니다.<br>
              - 아이디찾기 : 아이디찾기만 페이지에 보여집니다. / 비밀번호찾기 : 비밀번호찾기만 페이지에 보여집니다.
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

			<br><br>
		<form name="frm" action="member_save.php?<?=$param?>" method="post" enctype="multipart/form-data" onSubmit="return inputCheck(this);">
      <input type="hidden" name="tmp">
      <input type="hidden" name="mode" value="<?=$mode?>">
      <input type="hidden" name="idx" value="<?=$idx?>">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="2">
			        <tr>
			          <td class="tit_sub"><img src="../image/ics_tit.gif"> 페이지</td>
			        </tr>
			      </table>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
              	<td width="15%" class="t_name">회원가입</td>
                <td width="85%" class="t_value">
                <?
                $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/join.php\";     // 회원가입 ?&gt;";
                ?>
                <script language="javascript">
                function copy_Phpcode1(){
                	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
                	set_ClipBoard(php_code);
                }
                </script>
                <font color=red><?=$php_code?></font>&nbsp;
                <a href="javascript:copy_Phpcode1();"><img src="../image/btn_codecopy.gif" align="absmiddle" border="0"></a>

                </td>
              </tr>

							<tr>
              	<td class="t_name">로그인페이지</td>
                <td class="t_value">
                <?
                $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/login.php\";     // 로그인페이지 ?&gt;";
                ?>
                <script language="javascript">
                function copy_Phpcode4(){
                	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
                	set_ClipBoard(php_code);
                }
                </script>
                <font color=red><?=$php_code?></font>&nbsp;
                <a href="javascript:copy_Phpcode4();"><img src="../image/btn_codecopy.gif" align="absmiddle" border="0"></a>

                </td>
              </tr>

              <tr>
              	<td class="t_name">아이디/비번 찾기</td>
                <td class="t_value">
                <?
                $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/idpw.php\";     // 아이디/비번찾기 ?&gt;";
                ?>
                <script language="javascript">
                function copy_Phpcode6(){
                	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
                	set_ClipBoard(php_code);
                }
                </script>
                <font color=red><?=$php_code?></font>&nbsp;
                <a href="javascript:copy_Phpcode6();"><img src="../image/btn_codecopy.gif" align="absmiddle" border="0"></a>

                </td>
              </tr>

              <tr>
              	<td class="t_name">아이디찾기</td>
                <td class="t_value">
                <?
                $php_code = "&lt;? \$stype=\"id\"; include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/idpw.php\";     // 아이디찾기 ?&gt;";
                ?>
                <script language="javascript">
                function copy_Phpcode6_1(){
                	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
                	set_ClipBoard(php_code);
                }
                </script>
                <font color=red><?=$php_code?></font>&nbsp;
                <a href="javascript:copy_Phpcode6_1();"><img src="../image/btn_codecopy.gif" align="absmiddle" border="0"></a>

                </td>
              </tr>

              <tr>
              	<td class="t_name">비밀번호찾기</td>
                <td class="t_value">
                <?
                $php_code = "&lt;? \$stype=\"pw\"; include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/idpw.php\";     // 비밀번호찾기 ?&gt;";
                ?>
                <script language="javascript">
                function copy_Phpcode6_2(){
                	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
                	set_ClipBoard(php_code);
                }
                </script>
                <font color=red><?=$php_code?></font>&nbsp;
                <a href="javascript:copy_Phpcode6_2();"><img src="../image/btn_codecopy.gif" align="absmiddle" border="0"></a>

                </td>
              </tr>


              <tr>
              	<td class="t_name">회원정보수정</td>
                <td class="t_value">
                <?
                $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/myinfo.php\";     // 회원정보수정 ?&gt;";
                ?>
                <script language="javascript">
                function copy_Phpcode2(){
                	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
                	set_ClipBoard(php_code);
                }
                </script>
                <font color=red><?=$php_code?></font>&nbsp;
                <a href="javascript:copy_Phpcode2();"><img src="../image/btn_codecopy.gif" align="absmiddle" border="0"></a>

                </td>
              </tr>

              <tr>
              	<td class="t_name">회원탈퇴</td>
                <td class="t_value">
                <?
                $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/myout.php\";     // 회원탈퇴 ?&gt;";
                ?>
                <script language="javascript">
                function copy_Phpcode3(){
                	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
                	set_ClipBoard(php_code);
                }
                </script>
                <font color=red><?=$php_code?></font>&nbsp;
                <a href="javascript:copy_Phpcode3();"><img src="../image/btn_codecopy.gif" align="absmiddle" border="0"></a>

                </td>
              </tr>



              <tr>
              	<td class="t_name">로그인박스</td>
                <td class="t_value">
                <?
                $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/loginbox.php\";     // 로그인박스 ?&gt;";
                ?>
                <script language="javascript">
                function copy_Phpcode5(){
                	var php_code = "<?=str_replace("\"","\\\"",$php_code)?>";
                	set_ClipBoard(php_code);
                }
                </script>
                <font color=red><?=$php_code?></font>&nbsp;
                <a href="javascript:copy_Phpcode5();"><img src="../image/btn_codecopy.gif" align="absmiddle" border="0"></a>

                </td>
              </tr>


              <tr>
                <td class="t_name">페이지URL</td>
                <td class="t_value" colspan="3">
                 <table width="100%" border="0" cellspacing="1" cellpadding="0">
		             <tr><td height="5"></td></tr>
		             <tr>
		               <td width="20%" class="t_name">회원가입 페이지</td>
		               <td>http//<?=$HTTP_HOST?>/<input type="text" name="join_url" value="<?=$mem_info[join_url]?>" size="40" class="input"></td>
		             </tr>
		             <tr>
		               <td class="t_name">회원정보 페이지</td>
		               <td>http//<?=$HTTP_HOST?>/<input type="text" name="myinfo_url" value="<?=$mem_info[myinfo_url]?>" size="40" class="input"></td>
		             </tr>
		             <tr>
		               <td class="t_name">로그인 페이지</td>
		               <td>http//<?=$HTTP_HOST?>/<input type="text" name="login_url" value="<?=$mem_info[login_url]?>" size="40" class="input"></td>
		             </tr>
		             <tr>
		               <td class="t_name">아이디/비번 페이지</td>
		               <td>http//<?=$HTTP_HOST?>/<input type="text" name="idpw_url" value="<?=$mem_info[idpw_url]?>" size="40" class="input"></td>
		             </tr>
		             <tr>
		               <td class="t_name">로그아웃 후 이동페이지</td>
		               <td>http//<?=$HTTP_HOST?>/<input type="text" name="out_url" value="<?=$mem_info[out_url]?>" size="40" class="input"><br></td>
		             </tr>
		             <tr>
		             	<td colspan="2" height="20">인트로페이지를 사용하는 경우 로그아웃하면 다시 인트로로 가는것을 막기위해 이동페이지 주소를 설정합니다.</td>
		             </tr>
		             </table>
                </td>
              </tr>
            </table>
            <br>

            <table width="100%" border="0" cellspacing="0" cellpadding="2">
			        <tr>
			          <td class="tit_sub"><img src="../image/ics_tit.gif"> 탑메뉴</td>
			        </tr>
			      </table>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
              	<td width="15%" class="t_name">로그인/로그아웃</td>
                <td width="85%" class="t_value">
                <?
                $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/toplogin.php\";     // 로그인,로그아웃 ?&gt;";
                ?>
                <script language="javascript">
                function copy_Phpcode7(){
                	var php_code = "<?=str_replace("\n","",str_replace("\"","\\\"",$php_code))?>";
                	set_ClipBoard(php_code);
                }
                </script>
                <font color=red><?=str_replace("\n","<br>",$php_code)?></font>
                <a href="javascript:copy_Phpcode7();"><img src="../image/btn_codecopy.gif" align="absmiddle" border="0"></a>
                </td>
              </tr>

              <tr>
              	<td class="t_name">회원가입/마이페이지</td>
                <td class="t_value">
                <?
                $php_code = "&lt;? include \"\$_SERVER[DOCUMENT_ROOT]/admin/module/topjoin.php\";     // 회원가입,정보수정 ?&gt;";
                ?>
                <script language="javascript">
                function copy_Phpcode8(){
                	var php_code = "<?=str_replace("\n","",str_replace("\"","\\\"",$php_code))?>";
                	set_ClipBoard(php_code);
                }
                </script>
                <font color=red><?=str_replace("\n","<br>",$php_code)?></font>
                <a href="javascript:copy_Phpcode8();"><img src="../image/btn_codecopy.gif" align="absmiddle" border="0"></a>
                </td>
              </tr>
              <tr>
              	<td class="t_name">이미지설정</td>
                <td class="t_value">
                <table width="100%" border="0" cellspacing="1" cellpadding="0">
		             <tr><td height="5"></td></tr>
		             <tr>
		               <td width="20%" class="t_name">로그인 이미지</td>
		               <td>http//<?=$HTTP_HOST?>/<input type="text" name="login_img" value="<?=$mem_info[login_img]?>" size="40" class="input"></td>
		             </tr>
		             <tr>
		               <td class="t_name">로그아웃 이미지</td>
		               <td>http//<?=$HTTP_HOST?>/<input type="text" name="logout_img" value="<?=$mem_info[logout_img]?>" size="40" class="input"></td>
		             </tr>
		             <tr>
		               <td class="t_name">회원가입 이미지</td>
		               <td>http//<?=$HTTP_HOST?>/<input type="text" name="join_img" value="<?=$mem_info[join_img]?>" size="40" class="input"></td>
		             </tr>
		             <tr>
		               <td class="t_name">마이페이지 이미지</td>
		               <td>http//<?=$HTTP_HOST?>/<input type="text" name="myinfo_img" value="<?=$mem_info[myinfo_img]?>" size="40" class="input"></td>
		             </tr>
		             </table>
		             이미지를 설정하지 않으면 텍스트로 보여집니다.
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>

      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="tit_sub"><img src="../image/ics_tit.gif"> 아이디/패스워드 찾기</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
        <tr>
        	<td width="15%" class="t_name">확인방법</td>
          <td width="85%" class="t_value">
          	<input type=radio name=method value="E" <? if(!strcmp($mem_info[method], "E") || empty($mem_info[method])) echo "checked"; ?>> 이메일 발송
          	<!--input type=radio name=method value="A" <? if(!strcmp($mem_info[method], "A")) echo "checked"; ?>> 경고창
          	<br>(경고창의 경우 아이디, 패스워드의 두 글자만 보여지며 이후의 문자는 * 로 치환됩니다.)-->
          </td>
        </tr>
      </table>
      <br>

      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td width="15%" class="t_name">스킨</td>
                <td width="85%" class="t_value" colspan="3">
                <select name="skin">
                <?
                $dh = opendir("../../member/skin");
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
                     if(skin.options[ii].value == "<?=$mem_info[skin]?>")
                        skin.options[ii].selected = true;
                  }
                -->
                </script>
                스킨위치 : /admin/member/skin
                </td>
              </tr>
              <tr>
                <td class="t_name">입력정보 선택</td>
                <td class="t_value" colspan="3">

                 <table width="500" border="0" cellspacing="1" cellpadding="0">
		             <tr><td height="5"></td></tr>
		             <tr>
		               <td class="t_name" width="100">아이디</td>
		               <td width="180">사용함</td>
		               <td class="t_name" width="100">비밀번호</td>
		               <td width="180">사용함</td>
		             </tr>
		             <tr>
		               <td class="t_name">이름</td>
		               <td>사용함</td>
		               <td class="t_name">이메일</td>
		               <td>
		               	 사용함
		                 <input type="checkbox" name="info_use[]" value="email" checked style="display:none">
		                 <input type="checkbox" name="info_ess[]" value="email" checked style="display:none">
		               </td>
		             </tr>
		             <tr>
		               <td class="t_name">주민번호</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="resno" <? if($info_use["resno"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="resno" <? if($info_ess["resno"]==true) echo "checked";?>>필수항목
		               </td>
		               <td  class="t_name">주소</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="address" <? if($info_use["address"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="address" <? if($info_ess["address"]==true) echo "checked";?>>필수항목
		               </td>
		              </tr>
		              <tr>
		               <td  class="t_name">전화번호</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="tphone" <? if($info_use["tphone"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="tphone" <? if($info_ess["tphone"]==true) echo "checked";?>>필수항목
		               </td>
		               <td  class="t_name">휴대폰</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="hphone" <? if($info_use["hphone"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="hphone" <? if($info_ess["hphone"]==true) echo "checked";?>>필수항목
		               </td>
		             </tr>
		             <tr>
		               <td  class="t_name">회사전화</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="comtel" <? if($info_use["comtel"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="comtel" <? if($info_ess["comtel"]==true) echo "checked";?>>필수항목
		               </td>
		               <td  class="t_name">추천인</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="recom" <? if($info_use["recom"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="recom" <? if($info_ess["recom"]==true) echo "checked";?>>필수항목
		               </td>
		             </tr>
		             <tr>
		             	 <td  class="t_name">메일 수신여부</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="reemail" <? if($info_use["reemail"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="reemail" <? if($info_ess["reemail"]==true) echo "checked";?>>필수항목
		               </td>
		               <td  class="t_name">SMS 수신여부</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="resms" <? if($info_use["resms"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="resms" <? if($info_ess["resms"]==true) echo "checked";?>>필수항목
		               </td>
		             </tr>
		             <tr>
		               <td  class="t_name">닉네임</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="nick" <? if($info_use["nick"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="nick" <? if($info_ess["nick"]==true) echo "checked";?>>필수항목
		               </td>
		               <td  class="t_name">회원아이콘</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="icon" <? if($info_use["icon"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="icon" <? if($info_ess["icon"]==true) echo "checked";?>>필수항목
		               </td>
		              </tr>
		             <tr>
		               <td  class="t_name"><b>스팸글체크</b></td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="spam" <? if($info_use["spam"]==true) echo "checked";?> onClick="setEss(this.form, this.value)">사용함
		                 <input type="checkbox" name="info_ess[]" value="spam" <? if($info_ess["spam"]==true) echo "checked";?> onClick="return false;">필수항목
		               </td>
		              </tr>
		             <tr><td colspan="4" height="10"></td></tr>
		             <tr>
		               <td  class="t_name">회원사진</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="photo" <? if($info_use["photo"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="photo" <? if($info_ess["photo"]==true) echo "checked";?>>필수항목
		               </td>
		               <td  class="t_name">홈페이지</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="homepage" <? if($info_use["homepage"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="homepage" <? if($info_ess["homepage"]==true) echo "checked";?>>필수항목
		               </td>
		             </tr>
		             <tr>
		               <td  class="t_name">생년월일</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="birthday" <? if($info_use["birthday"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="birthday" <? if($info_ess["birthday"]==true) echo "checked";?>>필수항목
		               </td>
		               <td  class="t_name">직업</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="job" <? if($info_use["job"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="job" <? if($info_ess["job"]==true) echo "checked";?>>필수항목</td>
		             </tr>
		             <tr>
		               <td  class="t_name">관심분야</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="consph" <? if($info_use["consph"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="consph" <? if($info_ess["consph"]==true) echo "checked";?>>필수항목
		               </td>
		               <td  class="t_name">취미</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="hobby" <? if($info_use["hobby"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="hobby" <? if($info_ess["hobby"]==true) echo "checked";?>>필수항목
		               </td>
		             </tr>
		             <tr>
		               <td  class="t_name">학력</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="scholarship" <? if($info_use["scholarship"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="scholarship" <? if($info_ess["scholarship"]==true) echo "checked";?>>필수항목
		               </td>
		               <td  class="t_name">자기소개</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="intro" <? if($info_use["intro"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="intro" <? if($info_ess["intro"]==true) echo "checked";?>>필수항목
		               </td>
		             </tr>
		             <tr>
		               <td  class="t_name">결혼여부</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="marriage" <? if($info_use["marriage"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="marriage" <? if($info_ess["marriage"]==true) echo "checked";?>>필수항목
		               </td>
		               <td  class="t_name">결혼기념일</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="memorial" <? if($info_use["memorial"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="memorial" <? if($info_ess["memorial"]==true) echo "checked";?>>필수항목
		               </td>
		             </tr>
		             <tr>
		               <td  class="t_name">월평균소득</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="income" <? if($info_use["income"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="income" <? if($info_ess["income"]==true) echo "checked";?>>필수항목
		               </td>
		               <td  class="t_name">자동차소유</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="car" <? if($info_use["car"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="car" <? if($info_ess["car"]==true) echo "checked";?>>필수항목
		               </td>
		             </tr>
		             <tr><td height="10"></td></tr>
		             <tr>
		               <td  class="t_name">추가항목1</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="addinfo1" <? if($info_use["addinfo1"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="addinfo1" <? if($info_ess["addinfo1"]==true) echo "checked";?>>필수항목
		               </td>
		               <td  class="t_name">추가항목2</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="addinfo2" <? if($info_use["addinfo2"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="addinfo2" <? if($info_ess["addinfo2"]==true) echo "checked";?>>필수항목
		               </td>
		             </tr>
		             <tr>
		               <td  class="t_name">추가항목3</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="addinfo3" <? if($info_use["addinfo3"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="addinfo3" <? if($info_ess["addinfo3"]==true) echo "checked";?>>필수항목
		               </td>
		               <td  class="t_name">추가항목4</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="addinfo4" <? if($info_use["addinfo4"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="addinfo4" <? if($info_ess["addinfo4"]==true) echo "checked";?>>필수항목
		               </td>
		             </tr>
		             <tr>
		               <td  class="t_name">추가항목5</td>
		               <td>
		                 <input type="checkbox" name="info_use[]" value="addinfo5" <? if($info_use["addinfo5"]==true) echo "checked";?>>사용함
		                 <input type="checkbox" name="info_ess[]" value="addinfo5" <? if($info_ess["addinfo5"]==true) echo "checked";?>>필수항목
		               </td>
		             </tr>
		             <tr><td height="5"></td></tr>
		           </table>

                </td>
              </tr>
              <tr>
                <td class="t_name">추가항목명</td>
                <td class="t_value" colspan="3">
                 <table width="100%" border="0" cellspacing="1" cellpadding="0">
			             <tr><td height="5"></td></tr>
			             <tr>
			             		<td></td>
			             		<td width="130" class="t_name" align="center">항목명</td>
			             		<td width="90" class="t_name" align="center">항목속성</td>
			             		<td width="65" class="t_name" align="center">항목사이즈</td>
			             		<td width="80" class="t_name" align="center">세부항목 개수</td>
			             		<td class="t_name" align="center">세부항목</td>
			             	</tr>

<?php
for($ii = 1; $ii <= 5; $ii++) {
	$jj = $ii - 1;
?>
			             <tr>
			               <td class="t_name" width="70">추가항목<?=$ii?></td>
			               <td valign="top"><input type="text" name="add_name[]" value="<?=$addname[$jj]?>" class="input"></td>
			               <td valign="top">
									      <select name="ftype<?=$ii?>" onChange="setOpt(<?=$ii?>)">
									      <option value="text">text</option>
									      <option value="select">select</option>
									      <option value="radio">radio</option>
									      <option value="checkbox">checkbox</option>
									      <option value="textarea">textarea</option>
									      <option value="file">file</option>
									      <option value="pdate">일자(달력)</option>
									      <option value="tdate">년월일시</option>
									      <option value="birthday">생년월일</option>
									      <option value="phone">전화번호</option>
									      <option value="address">주소찾기</option>
									      <option value="email">이메일</option>
									      </select>
									      <script language="javascript">
									      <!--
									       ftype = document.frm.ftype<?=$ii?>;
									       var tmp = "";
									       for(ii=0; ii<ftype.length; ii++){
									          if(ftype.options[ii].value == "<?=$addtype[$ii]?>") {
									          	ftype.options[ii].selected = true;
									          	tmp = ftype.options[ii].value;
									          }
									       }
									      -->
									      </script>
									    </td>
									    <td valign="top" id="size_<?=$ii?>" style="display:none">
									    	<input name="fsize<?=$ii?>" type="text" value="<?=$addsize[$ii]?>" size="9" class="input">
									    </td>
									    <td valign="top" id="num_<?=$ii?>" style="display:none">
									    	<select name="fnum<?=$ii?>" onChange="flist('<?=$ii?>');" style="width:80px">
									    	<? for($kk=1;$kk<21;$kk++){ ?>
									    	<option value="<?=$kk?>" <? if($addnum[$ii] == $kk) echo "selected"; ?>><?=$kk?></option>
									    	<? } ?>
									    	<select>
									    </td>
									    <td valign="top" id="opt_<?=$ii?>" style="display:none">
									    	<span id='flist_layer_<?=$ii?>'></span>
									    </td>
			              </tr>
<?php
}
?>

		             </table>
                </td>
              </tr>
              <tr>
                <td class="t_name">직업</td>
                <td class="t_value" colspan="3">
                <textarea name="job_list" rows="3" cols="90" class="textarea"><?=$mem_info[job_list]?></textarea>
                </td>
              </tr>
              <tr>
                <td class="t_name">학력</td>
                <td class="t_value" colspan="3">
                <textarea name="sch_list" rows="3" cols="90" class="textarea"><?=$mem_info[sch_list]?></textarea>
                </td>
              </tr>
              <tr>
                <td class="t_name">월평균소득</td>
                <td class="t_value" colspan="3">
                <textarea name="income_list" rows="3" cols="90" class="textarea"><?=$mem_info[income_list]?></textarea>
                </td>
              </tr>
              <tr>
                <td class="t_name">관심분야</td>
                <td class="t_value" colspan="3">
                <textarea name="consph_list" rows="3" cols="90" class="textarea"><?=$mem_info[consph_list]?></textarea>
                </td>
              </tr>
              <!--
              <tr>
                <td class="t_name">가입약관</td>
                <td class="t_value" colspan="3">
                <textarea name="agreement" rows="10" cols="90" class="textarea"><?=$mem_info[agreement]?></textarea>
                </td>
              </tr>
              <tr>
                <td class="t_name">개인정보 보호정책</td>
                <td class="t_value" colspan="3">
                <textarea name="safeinfo" rows="10" cols="90" class="textarea"><?=$mem_info[safeinfo]?></textarea>
                </td>
              </tr>
              //-->
            </table>
          </td>
        </tr>
      </table>

      <br>
      <table align="center" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
          	<input type="image" src="../image/btn_confirm_l.gif"> &nbsp;
          	<img src="../image/btn_cancel_l.gif" style="cursor:hand" onClick="document.location='member_list.php?<?=$param?>';">
          </td>
        </tr>
      </table>
	  </form>

</body>

<? include "../foot.php"; ?>
