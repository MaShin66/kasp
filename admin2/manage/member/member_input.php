<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?
// 회원정보
if($mode == "") $mode = "insert";
if($mode == "update"){
	$sql = "select * from wiz_member where idx = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	$my_info = mysql_fetch_array($result);
}
?>
<? include_once "../../inc/mem_info.php"; ?>
<?
$param = "slevel=".$slevel."&searchopt=".$searchopt."&searchkey=".$searchkey."&page=".$page;

function createObject($no,$type,$size,$flist, $value){

   global $upfile_idx;
   global $idx;

   $fname = "f".$no;

   // 반복하지 않는 속성
   $tmp_type = Array("","address","birthday","phone","email");

   for($ii = 0;$ii < count($tmp_type); $ii++) {
   		if(!strcmp($type, $tmp_type[$ii])) $flist = " ";
   }

   $tmp_flist = explode("|",$flist);

   if($type == "select") $finput = "<select id=\"".$fname."_0\" name=\"fname[".$no."][]\"><option value=''>--</option>";

   for($ii=0;$ii<count($tmp_flist);$ii++){

      //if($tmp_flist[$ii] != ""){

         if($type == "text"){

         		$tmp_value = explode("|", $value);

            $finput .= "<input type=\"text\" id=\"".$fname."_$ii\" name=\"fname[".$no."][]\" class='input' size=\"".$size."\" value=\"".$tmp_value[$ii]."\">".$tmp_flist[$ii];

         }else if($type == "file"){

         		$tmp_value = explode("|", $value);

            $upfile_idx++;
            $finput .= "<input type=\"file\" id=\"".$fname."_$ii\" name=\"upfile".$upfile_idx."\" class='input' size=\"".$size."\">";
	          $finput .= " <input type=\"hidden\" name=\"tmp_upfile_".$no."_".$upfile_idx."\" value=\"".$tmp_value[$ii]."\">";

            if(!empty($tmp_value[$ii])) {
	            $finput .= " <a href=\"/admin2/data/member/".$tmp_value[$ii]."\" target=\"_blank\">".$tmp_value[$ii]."</a> ";
	            $finput .= " <a href=\"member_save.php?mode=addfile_del&upfile=".$tmp_value[$ii]."&idx=".$idx."&no=".$no."&".$param."\"><font color='red'>[삭제]</font></a> ";
	          }
            $finput .= $tmp_flist[$ii];

         }else if($type == "radio"){

         		$tmp_value = $value;
         		if(!strcmp($tmp_flist[$ii], $tmp_value)) $tmp_check = "checked";
         		else $tmp_check = "";

            $finput .= "<input type=\"radio\" id=\"".$fname."_$ii\" name=\"fname[".$no."]\" value=\"".$tmp_flist[$ii]."\" ".$tmp_check.">".$tmp_flist[$ii]."&nbsp; ";

         }else if($type == "checkbox"){

         		$tmp_value = explode("|", $value);

         		for($jj = 0; $jj < count($tmp_value); $jj++) {

	         		if(!strcmp($tmp_flist[$ii], $tmp_value[$jj])) ${"tmp_check".$ii} = "checked";

         		}

            $finput .= "<input type=\"checkbox\" id=\"".$fname."_$ii\" name=\"fname[".$no."][]\" value=\"".$tmp_flist[$ii]."\" ".${"tmp_check".$ii}.">".$tmp_flist[$ii]."&nbsp; ";

         }else if($type == "textarea"){

         		$tmp_value = $value;

            $finput .= "<textarea id=\"".$fname."_$ii\" name=\"fname[".$no."][]\" rows=\"".$size."\" class=\"input\" style=\"width:99%\">".$tmp_value."</textarea>";

         }else if($type == "select"){

         		$tmp_value = $value;
         		if(!strcmp($tmp_flist[$ii], $tmp_value)) $tmp_select = "selected";
         		else $tmp_select = "";

            $finput .= "<option value=\"".$tmp_flist[$ii]."\" ".$tmp_select.">".$tmp_flist[$ii]."</option>";

         }else if($type == "address"){

         		$tmp_value	= explode("|", $value);
         		$tmp_zip		= explode("-", $tmp_value[0]);

         		$finput .= "<input type=\"text\" id=\"".$fname."_0\" name=\"".$fname."_post1\" onClick=searchZip(\"".$fname."_\"); class=\"input\" size=\"6\" readonly value=\"".$tmp_zip[0]."\"> - ";
         		$finput .= "<input type=\"text\" id=\"".$fname."_1\" name=\"".$fname."_post2\" onClick=searchZip(\"".$fname."_\"); class=\"input\" size=\"6\" readonly value=\"".$tmp_zip[1]."\"> ";
         		$finput .= "<input type=\"button\" value=\"주소찾기\" onClick=searchZip(\"".$fname."_\"); class=\"button\"><br>";
         		$finput .= "<input type=\"text\" id=\"".$fname."_2\" name=\"".$fname."_address1\" class=\"input\" size=\"".$size."\" value=\"".$tmp_value[1]."\"><br>";
         		$finput .= "<input type=\"text\" id=\"".$fname."_3\" name=\"".$fname."_address2\" class=\"input\" size=\"".$size."\" value=\"".$tmp_value[2]."\"><br>";

         }else if($type == "pdate"){

         		$tmp_value = explode("~", $value);

         		$finput .= "<input type=\"text\" id=\"".$fname."_".$ii."\" name=\"fname[".$no."][]\" class=\"input\" size=\"".$size."\" onClick=Calendar5(\"document.frm\",\"".$fname."_".$ii."\"); readonly value=\"".$tmp_value[$ii]."\"> ";
            $finput .= "<input type=\"button\" value=\"달력\" onClick=Calendar5(\"document.frm\",\"".$fname."_".$ii."\"); class=\"button\">".$tmp_flist[$ii];

         }else if($type == "tdate"){

						$tmp_value	= explode("~", $value);
						$tmp_dt		= explode("&nbsp;", $tmp_value[$ii]);
						$tmp_date	= explode("-", $tmp_dt[0]);

            $finput .= "<select id=\"".$fname."_".$ii."_0\" name=\"fname[".$no."][]\"><option value=\"\">--</option>";
            for($jj=2008;$jj<=2015;$jj++){

            	if(!strcmp($jj, $tmp_date[0])) $tmp_select = "selected";
            	else $tmp_select = "";

            	$finput .= "<option value=\"".$jj."\" ".$tmp_select.">".$jj."</option>";
            }
            $finput .= "</select>년 ";

						$finput .= "<select id=\"".$fname."_".$ii."_1\" name=\"fname[".$no."][]\"><option value=\"\">--</option>";
            for($jj=1;$jj<=12;$jj++){

            	if($jj<10) $jj = "0".$jj;

            	if(!strcmp($jj, $tmp_date[1])) $tmp_select = "selected";
            	else $tmp_select = "";

            	$finput .= "<option value=\"".$jj."\" ".$tmp_select.">".$jj."</option>";
            }
            $finput .= "</select>월 ";

						$finput .= "<select id=\"".$fname."_".$ii."_2\" name=\"fname[".$no."][]\"><option value=\"\">--</option>";
            for($jj=1;$jj<=31;$jj++){

            	if($jj<10) $jj = "0".$jj;

            	if(!strcmp($jj, $tmp_date[2])) $tmp_select = "selected";
            	else $tmp_select = "";

            	$finput .= "<option value=\"".$jj."\" ".$tmp_select.">".$jj."</option>";
            }
            $finput .= "</select>일 ";

            $finput .= "<select id=\"".$fname."_".$ii."_3\" name=\"fname[".$no."][]\"><option value=\"\">--</option>";
            for($jj=1;$jj<=24;$jj++){

            	if($jj<10) $jj = "0".$jj;

            	if(!strcmp($jj, $tmp_dt[1])) $tmp_select = "selected";
            	else $tmp_select = "";

            	$finput .= "<option value=\"".$jj."\" ".$tmp_select.">".$jj."</option>";
            }
            $finput .= "</select>시 ".$tmp_flist[$ii];

         }else if($type == "birthday") {

         		$tmp_value = explode("|", $value);

            $finput .= "<select id=\"".$fname."_".$ii."_0\" name=\"fname[".$no."][]\"><option value=\"\">--</option>";
            for($jj=1900;$jj<=date('Y');$jj++){

            	if(!strcmp($jj, $tmp_value[0])) $tmp_select = "selected";
            	else $tmp_select = "";

            	$finput .= "<option value=\"".$jj."\" ".$tmp_select.">".$jj."</option>";
            }
            $finput .= "</select>년 ";

						$finput .= "<select id=\"".$fname."_".$ii."_1\" name=\"fname[".$no."][]\"><option value=\"\">--</option>";
            for($jj=1;$jj<=12;$jj++){
            	if($jj<10) $jj = "0".$jj;

            	if(!strcmp($jj, $tmp_value[1])) $tmp_select = "selected";
            	else $tmp_select = "";

            	$finput .= "<option value=\"".$jj."\" ".$tmp_select.">".$jj."</option>";
            }
            $finput .= "</select>월 ";

						$finput .= "<select id=\"".$fname."_".$ii."_2\" name=\"fname[".$no."][]\"><option value=\"\">--</option>";
            for($jj=1;$jj<=31;$jj++){
            	if($jj<10) $jj = "0".$jj;

            	if(!strcmp($jj, $tmp_value[2])) $tmp_select = "selected";
            	else $tmp_select = "";

            	$finput .= "<option value=\"".$jj."\" ".$tmp_select.">".$jj."</option>";
            }
            $finput .= "</select>일 ";

         }else if($type == "phone") {

         		$tmp_value = explode("|", $value);

         		$finput .= "<input type=\"text\" id=\"".$fname."_0\" name=\"fname[".$no."][]\" class=\"input\" size=\"".$size."\" maxlength=\"4\" value=\"".$tmp_value[0]."\"> - ";
         		$finput .= "<input type=\"text\" id=\"".$fname."_1\" name=\"fname[".$no."][]\" class=\"input\" size=\"".$size."\" maxlength=\"4\" value=\"".$tmp_value[1]."\"> - ";
         		$finput .= "<input type=\"text\" id=\"".$fname."_2\" name=\"fname[".$no."][]\" class=\"input\" size=\"".$size."\" maxlength=\"4\" value=\"".$tmp_value[2]."\">".$tmp_flist[$ii];

         }else if($type == "email") {

         		$tmp_value = $value;

         		$finput .= "<input type=\"text\" id=\"".$fname."_$ii\" name=\"fname[".$no."][]\" class=\"input\" size=\"".$size."\" value=\"".$tmp_value."\">".$tmp_flist[$ii];
         }

      //}
   }

   if($type == "select") $finput .= "</select>";

   return $finput;

}

$sql = "select fprior, ftype, fsize, flist from wiz_formfield where fidx = 'addinfo' order by fprior asc";
$result = mysql_query($sql) or error(mysql_error());
while($row = mysql_fetch_array($result)) {
	$no = $row[fprior];

	${addinfo.$no._input} = createObject($no,$row[ftype],$row[fsize],$row[flist], $my_info["addinfo".$no]);
}
?>
<? include "../head.php"; ?>

<script language="javascript">
<!--
function inputCheck(frm){

   if(frm.id.value == ""){
      alert("아이디를 입력하세요");
      frm.id.focus();
      return false;
   }
	<?php if($mode == "insert") { ?>
   if(frm.passwd.value == ""){
      alert("비밀번호를 입력하세요");
      frm.passwd.focus();
      return false;
   }
	<?php } ?>

}

// 고객 메일발송
function sendEmail(seluser){
	var url = "send_email.php?seluser=" + seluser;
	window.open(url,"sendEmail","height=600, width=700, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, top=100, left=100");
}

// 주소찾기
function searchZip(kind){

	if(kind == undefined) kind = "";

	var url = "../member/search_zip.php?kind=" + kind;
	window.open(url,"searchZip","height=350, width=367, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, top=100, left=100");
}

// 회원별 포인트내역
function pointList(id,name){
	var url = "member_point.php?id=" + id + "&name=" + name;
	window.open(url,"pointList","height=400, width=600, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, top=100, left=100");
}
// 아이디 중복확인
function idCheck(){
   var id = document.frm.id.value;
   var url = "../member/id_check.php?name=id&id=" + id;
   window.open(url, "idCheck", "width=350, height=150, menubar=no, scrollbars=no, resizable=no, toolbar=no, status=no, left=150, top=150");
}
-->
</script>
</head>

		<table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><img src="../image/ic_tit.gif"></td>
          <td valign="bottom" class="tit">회원관리</td>
          <td width="2"></td>
          <td valign="bottom" class="tit_alt">회원을 검색/수정 관리합니다.</td>
        </tr>
      </table>

      <br>
      <? if($mode == "update"){ ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="right"><b>가입일</b> : <?=$my_info[wdate]?> &nbsp; <b>로그인 횟수</b> : <?=$my_info[visit]?> &nbsp; <b>마지막 로그인</b> : <?=$my_info[visit_time]?></td>
        </tr>
      </table>
    	<? } ?>
	   <form name="frm" action="member_save.php?<?=$param?>" method="post" enctype="multipart/form-data" onSubmit="return inputCheck(this);">
      <input type="hidden" name="tmp">
      <input type="hidden" name="mode" value="<?=$mode?>">
      <input type="hidden" name="idx" value="<?=$idx?>">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td width="15%" class="t_name">아이디</td>
                <td width="35%" class="t_value">
                	<input name="id" type="text" value="<?=$my_info[id]?>" class="input" readonly>
									<? if(strcmp($mode, "update")) { ?>
                	<img src="../image/btn_idcheck.gif" align="absmiddle" style="cursor:hand" onCLick="idCheck()">
									<? } ?>
                </td>
                <td width="15%" class="t_name">비밀번호</td>
                <td width="35%" class="t_value"><input name="passwd" type="text" value="" class="input"></td>
              </tr>
              <tr>
                <td class="t_name">이름</td>
                <td class="t_value"><input name="name" type="text" value="<?=$my_info[name]?>" class="input"></td>
                <td class="t_name">회원등급</td>
                <td class="t_value">
                  <select name="level">
                  <?=level_list();?>
                  </select>
                  <script language="javascript">
                  <!--
                   level = document.frm.level;
                   for(ii=0; ii<level.length; ii++){
                      if(level.options[ii].value == "<?=$my_info[level]?>")
                         level.options[ii].selected = true;
                   }
                  -->
                  </script>
                </td>
              </tr>

              <? if($info_use[nick] == true){ ?>
              <tr>
                <td class="t_name">닉네임</td>
                <td colspan="3" class="t_value">
                  <input name="nick" type="text" value="<?=$my_info[nick]?>" class="input">
                </td>
              </tr>
              <? } ?>

              <? if($site_info[point_use] == "Y"){ ?>
              <tr>
                <td class="t_name">포인트</td>
                <td class="t_value" colspan="3">
                	<a href="javascript:pointList('<?=$my_info[id]?>', '<?=$my_info[name]?>')"><?= number_format(get_point($my_info[id])) ?> 포인트  <img src="../image/btn_dview_s.gif" border="0" align="absmiddle"></a>
                </td>
              </tr>
              <? } ?>

              <? if($info_use[photo] == true){ ?>
              <tr>
                <td class="t_name">회원사진</td>
                <td class="t_value" colspan="3">
                  <?
                	if($my_info[photo] != "" && file_exists(WIZHOME_PATH."/data/member/".$my_info[photo])){
                		echo "<img src=/admin2/data/member/".$my_info[photo].">";
                		echo "<input type='checkbox' name='delphoto' value='Y'>";
                		echo "<font color='red'>삭제</font> <br>";
                	}
                	?>
                	<input name="photo" type="file" size="12" class="input">
                </td>
              </tr>
              <? } ?>

              <? if($info_use[icon] == true){ ?>
              <tr>
                <td class="t_name">회원아이콘</td>
                <td class="t_value" colspan="3">
                  <?
                	if($my_info[icon] != "" && file_exists(WIZHOME_PATH."/data/member/".$my_info[icon])){
                		echo "<img src=/admin2/data/member/".$my_info[icon]." width='".$icon_size."' height='".$icon_size."'>";
                		echo "<input type='checkbox' name='delicon' value='Y'>";
                		echo "<font color='red'>삭제</font> <br>";
                	}
                	?>
                	<input name="icon" type="file" size="12" class="input">
                </td>
              </tr>
              <? } ?>

              <? if($info_use[resno] == true){ ?>
              <tr>
                <td class="t_name">주민번호</td>
                <td colspan="3" class="t_value">
                  <? list($resno1, $resno2) = explode("-",$my_info[resno]); ?>
                  <input type="text" name="resno1" value="<?=$resno1?>" size="9" class="input"> -
                  <input type="text" name="resno2" value="<?=$resno2?>" size="9" class="input">
                </td>
              </tr>
              <? } ?>

              <? if($info_use[tphone] == true){ ?>
              <tr>
                <td class="t_name">전화번호</td>
                <td colspan="3" class="t_value">
                  <? list($tphone1, $tphone2, $tphone3) = explode("-",$my_info[tphone]); ?>
                  <input type="text" name="tphone1" value="<?=$tphone1?>" size="5" class="input"> -
                  <input type="text" name="tphone2" value="<?=$tphone2?>" size="5" class="input"> -
                  <input type="text" name="tphone3" value="<?=$tphone3?>" size="5" class="input">
                </td>
              </tr>
              <? } ?>

              <? if($info_use[hphone] == true){ ?>
              <tr>
                <td class="t_name">휴대폰</td>
                <td colspan="3" class="t_value">
                	<? list($hphone1, $hphone2, $hphone3) = explode("-",$my_info[hphone]); ?>
                  <input type="text" name="hphone1" value="<?=$hphone1?>"  size="5" class="input"> -
                  <input type="text" name="hphone2" value="<?=$hphone2?>"  size="5" class="input"> -
                  <input type="text" name="hphone3" value="<?=$hphone3?>"  size="5" class="input">
                </td>
              </tr>
              <? } ?>

							<? if($info_use[comtel] == true){ ?>
              <tr>
                <td class="t_name">회사전화</td>
                <td colspan="3" class="t_value">
                	<? list($comtel1, $comtel2, $comtel3) = explode("-",$my_info[comtel]); ?>
                  <input type="text" name="comtel1" value="<?=$comtel1?>"  size="5" class="input"> -
                  <input type="text" name="comtel2" value="<?=$comtel2?>"  size="5" class="input"> -
                  <input type="text" name="comtel3" value="<?=$comtel3?>"  size="5" class="input">
                </td>
              </tr>
              <? } ?>

              <? if($info_use[email] == true){ ?>
              <tr>
                <td class="t_name">이메일</td>
                <td colspan="3" class="t_value">
                  <input name="email" type="text" value="<?=$my_info[email]?>" size="40" class="input">
                </td>
              </tr>
              <? } ?>

              <? if($info_use[reemail] == true){ ?>
              <tr>
                <td class="t_name">이메일 수신</td>
                <td colspan="3" class="t_value">
                  <input type="radio" name="reemail" value="Y" <? if($my_info[reemail] == "Y") echo "checked"; ?>>예
                  <input type="radio" name="reemail" value="N" <? if($my_info[reemail] == "N") echo "checked"; ?>>아니오
                </td>
              </tr>
              <? } ?>

              <? if($info_use[resms] == true){ ?>
              <tr>
                <td class="t_name">SMS 수신</td>
                <td colspan="3" class="t_value">
                  <input type="radio" name="resms" value="Y" <? if($my_info[resms] == "Y") echo "checked"; ?>>예
                  <input type="radio" name="resms" value="N" <? if($my_info[resms] == "N") echo "checked"; ?>>아니오
                </td>
              </tr>
              <? } ?>

              <? if($info_use[homepage] == true){ ?>
              <tr>
                <td class="t_name">홈페이지</td>
                <td class="t_value" colspan="3">
                	<input name="homepage" type="text" value="<?=$my_info[homepage]?>" size="40" class="input">
                </td>
              </tr>
              <? } ?>

              <? if($info_use[address] == true){ ?>
              <tr>
                <td class="t_name">주소</td>
                <td colspan="3" class="t_value" colspan="3">
                  <? list($post1, $post2) = explode("-",$my_info[post]); ?>
                  <input name="post1" type="text" value="<?=$post1?>" size="5" class="input"> -
                  <input name="post2" type="text" value="<?=$post2?>" size="5" class="input">
                  <img src="../image/btn_post.gif" onClick="searchZip('');" style="cursor:hand" align="absmiddle"><br>
                  <input name="address1" type="text" value="<?=$my_info[address1]?>" size="60" class="input"><br>
                  <input name="address2" type="text" value="<?=$my_info[address2]?>" size="60" class="input">
                </td>
              </tr>
              <? } ?>

              <? if($info_use[birthday] == true){ ?>
              <tr>
                <td class="t_name">생년월일</td>
                <td class="t_value" colspan="3">
                  <? list($birthday1, $birthday2, $birthday3) = explode("-", $my_info[birthday]); ?>
                  <input name="birthday1" value="<?=$birthday1?>" type="text" class="input" id="26" size="4" maxlength="4">년
                  <input name="birthday2" value="<?=$birthday2?>" type="text" class="input" id="27" size="2" maxlength="2">월
                  <input name="birthday3" value="<?=$birthday3?>" type="text" class="input" id="28" size="2" maxlength="2">일 (
                  <input type="radio" name="bgubun" value="양력" <? if($my_info[bgubun] == "양력") echo "checked"; ?>>양력
                  <input type="radio" name="bgubun" value="음력" <? if($my_info[bgubun] == "음력") echo "checked"; ?>>음력 )
                </td>
              </tr>
              <? } ?>

              <? if($info_use[marriage] == true){ ?>
              <tr>
                <td class="t_name"> 결혼 여부</td>
                <td colspan="3" class="t_value">
                  <input type="radio" name="marriage" value="미혼" <? if($my_info[marriage] == "미혼") echo "checked"; ?>>미혼
                  <input type="radio" name="marriage" value="기혼" <? if($my_info[marriage] == "기혼") echo "checked"; ?>>기혼
                </td>
              </tr>
              <? } ?>

              <? if($info_use[memorial] == true){ ?>
              <tr>
                <td class="t_name">결혼기념일</td>
                <td colspan="3" class="t_value">
                  <? list($memorial1, $memorial2, $memorial3) = explode("-", $my_info[memorial]); ?>
                  <input name="memorial1" value="<?=$memorial1?>" type="text" size="4" maxlength="4" class="input">년
                  <input name="memorial2" value="<?=$memorial2?>"  type="text" size="2" maxlength="2" class="input">월
                  <input name="memorial3" value="<?=$memorial3?>"  type="text" size="2" maxlength="2" class="input">일
                </td>
              </tr>
              <? } ?>

              <? if($info_use[job] == true){ ?>
              <tr>
                <td class="t_name">직업</td>
                <td colspan="3" class="t_value">
                	<?=$job_list?>
                </td>
              </tr>
              <script language="javascript">
              <!--
              	if(document.frm.job != null){
	                job = document.frm.job;
	                for(ii=0; ii<job.length; ii++){
	                 if(job.options[ii].value == "<?=$my_info[job]?>")
	                    job.options[ii].selected = true;
	                }
              	}
              -->
              </script>
              <? } ?>

              <? if($info_use[scholarship] == true){ ?>
              <tr>
                <td class="t_name">학력</td>
                <td colspan="3" class="t_value">
                  <?=$sch_list?>
                </td>
              </tr>
              <script language="javascript">
              <!--
              	if(document.frm.scholarship != null){
	                scholarship = document.frm.scholarship;
	                for(ii=0; ii<scholarship.length; ii++){
	                 if(scholarship.options[ii].value == "<?=$my_info[scholarship]?>")
	                    scholarship.options[ii].selected = true;
	                }
                }
              -->
              </script>
              <? } ?>

              <? if($info_use[income] == true){ ?>
              <tr>
                <td class="t_name">월평균소득</td>
                <td class="t_value" colspan="3">
                	<?=$income_list?>
                </td>
              </tr>
              <script language="javascript">
              <!--
                if(document.frm.income != null){
	                income = document.frm.income;
	                for(ii=0; ii<income.length; ii++){
	                 if(income.options[ii].value == "<?=$my_info[income]?>")
	                    income.options[ii].selected = true;
	                }
	              }

              -->
              </script>
              <? } ?>

              <? if($info_use[consph] == true){ ?>
              <tr>
                <td class="t_name">관심분야</td>
                <td colspan="3" class="t_value">
                 <?=$consph_list?>
                </td>
              </tr>
              <? } ?>

              <? if($info_use[hobby] == true){ ?>
              <tr>
                <td class="t_name">취미</td>
                <td class="t_value" colspan="3">
                	<input name="hobby" type="text" value="<?=$my_info[hobby]?>" size="40" class="input">
                </td>
              </tr>
              <? } ?>

              <? if($info_use[hobby] == true){ ?>
              <tr>
                <td class="t_name">자동차소유</td>
                <td class="t_value" colspan="3">
                	<input name="car" type="radio" value="소유" <? if($my_info[car] == "소유") echo "checked"; ?>>소유
						      <input name="car" type="radio" value="미소유" <? if($my_info[car] == "미소유") echo "checked"; ?>>미소유
                </td>
              </tr>
              <? } ?>

              <? if($info_use[intro] == true){ ?>
              <tr>
                <td height="25" class="t_name">자기소개</td>
                <td class="t_value" colspan="3">
                <textarea name="intro" rows="5" cols="90" class="textarea"><?=$my_info[intro]?></textarea>
                </td>
              </tr>
              <? } ?>

              <? if($info_use[recom] == true){ ?>
              <tr>
                <td class="t_name">추천인</td>
                <td colspan="3" class="t_value">
                  <input type="text" name="recom" value="<?=$my_info[recom]?>" class="input">
                </td>
              </tr>
              <? } ?>

              <? if($info_use[addinfo1] == true){ ?>
              <tr>
                <td class="t_name"><?=$addname1?></td>
                <td colspan="3" class="t_value">
                	<?=$addinfo1_input?>
                </td>
              </tr>
              <? } ?>

              <? if($info_use[addinfo2] == true){ ?>
              <tr>
                <td class="t_name"><?=$addname2?></td>
                <td colspan="3" class="t_value">
                	<?=$addinfo2_input?>
                </td>
              </tr>
              <? } ?>

              <? if($info_use[addinfo3] == true){ ?>
              <tr>
                <td class="t_name"><?=$addname3?></td>
                <td colspan="3" class="t_value">
                	<?=$addinfo3_input?>
                </td>
              </tr>
              <? } ?>

              <? if($info_use[addinfo4] == true){ ?>
              <tr>
                <td class="t_name"><?=$addname4?></td>
                <td colspan="3" class="t_value">
                	<?=$addinfo4_input?>
                </td>
              </tr>
              <? } ?>

              <? if($info_use[addinfo5] == true){ ?>
              <tr>
                <td class="t_name"><?=$addname5?></td>
                <td colspan="3" class="t_value">
                	<?=$addinfo5_input?>
                </td>
              </tr>
              <? } ?>

              <tr>
                <td height="25" class="t_name">관라자메모</td>
                <td class="t_value" colspan="3">
                <textarea name="memo" rows="5" cols="90" class="textarea"><?=$my_info[memo]?></textarea>
                </td>
              </tr>
            </table>
            <!--
            <table width="100%" border="0" cellspacing="1" cellpadding="6" class="t_style">
              <tr>
                <td class="t_name">필명</td>
                <td colspan="3" class="t_value">
                  <input name="nick" type="text" value="<?=$my_info[nick]?>" class="input">
                </td>
              </tr>
              <tr>
                <td class="t_name">추천인</td>
                <td colspan="3" class="t_value">
                  <input name="recom" type="text" value="<?=$my_info[recom]?>" class="input">
                </td>
              </tr>
              <tr>
                <td class="t_name">SMS 수신</td>
                <td colspan="3" class="t_value">
                  <input type="radio" name="resms" value="Y" <? if($my_info[resms] == "Y") echo "checked"; ?>>예
                  <input type="radio" name="resms" value="N" <? if($my_info[resms] == "N") echo "checked"; ?>>아니오
                </td>
              </tr>

            </table>
             -->
          </td>
        </tr>
      </table>

      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center">
          	<input type="image" src="../image/btn_confirm_l.gif"> &nbsp;
          	<img src="../image/btn_list_l.gif" onClick="document.location='member_list.php?<?=$param?>';" style="cursor:hand"></td>
        </tr>
      </table>
	  </form>

<? include "../foot.php"; ?>
