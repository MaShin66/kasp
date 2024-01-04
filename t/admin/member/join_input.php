<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin/inc/site_info.php";
include "$_SERVER[DOCUMENT_ROOT]/admin/inc/mem_info.php";

echo "<link href=\"".$skin_dir."/style.css\" rel=\"stylesheet\" type=\"text/css\">";

// 자동등록글체크
get_spam_check();

$prev = "http://".$_http_host.$PHP_SELF;

$action = $ssl."/admin/member/join_save.php";

// 정보입력 여부 체크
if($info_use[nick] != true){
	$hide_nick_start = "<!--"; $hide_nick_end = "-->";
}
if($info_use[photo] != true){
	$hide_photo_start = "<!--"; $hide_photo_end = "-->";
}
if($info_use[icon] != true){
	$hide_icon_start = "<!--"; $hide_icon_end = "-->";
}
if($info_use[resno] != true){
	$hide_resno_start = "<!--"; $hide_resno_end = "-->";
}
if($info_use[tphone] != true){
	$hide_tphone_start = "<!--"; $hide_tphone_end = "-->";
}
if($info_use[hphone] != true){
	$hide_hphone_start = "<!--"; $hide_hphone_end = "-->";
}
if($info_use[comtel] != true){
	$hide_comtel_start = "<!--"; $hide_comtel_end = "-->";
}
if($info_use[email] != true){
	$hide_email_start = "<!--"; $hide_email_end = "-->";
}
if($info_use[reemail] != true){
	$hide_reemail_start = "<!--"; $hide_reemail_end = "-->";
}
if($info_use[resms] != true){
	$hide_resms_start = "<!--"; $hide_resms_end = "-->";
}
if($info_use[homepage] != true){
	$hide_homepage_start = "<!--"; $hide_homepage_end = "-->";
}
if($info_use[address] != true){
	$hide_address_start = "<!--"; $hide_address_end = "-->";
}
if($info_use[recom] != true){
	$hide_recom_start = "<!--"; $hide_recom_end = "-->";
}
if($info_use[birthday] != true){
	$hide_birthday_start = "<!--"; $hide_birthday_end = "-->";
}
if($info_use[marriage] != true){
	$hide_marriage_start = "<!--"; $hide_marriage_end = "-->";
}
if($info_use[memorial] != true){
	$hide_memorial_start = "<!--"; $hide_memorial_end = "-->";
}
if($info_use[job] != true){
	$hide_job_start = "<!--"; $hide_job_end = "-->";
}
if($info_use[scholarship] != true){
	$hide_scholarship_start = "<!--"; $hide_scholarship_end = "-->";
}
if($info_use[consph] != true){
	$hide_consph_start = "<!--"; $hide_consph_end = "-->";
}
if($info_use[hobby] != true){
	$hide_hobby_start = "<!--"; $hide_hobby_end = "-->";
}
if($info_use[income] != true){
	$hide_income_start = "<!--"; $hide_income_end = "-->";
}
if($info_use[car] != true){
	$hide_car_start = "<!--"; $hide_car_end = "-->";
}
if($info_use[intro] != true){
	$hide_intro_start = "<!--"; $hide_intro_end = "-->";
}
if($info_use[addinfo1] != true){
	$hide_addinfo1_start = "<!--"; $hide_addinfo1_end = "-->";
}
if($info_use[addinfo2] != true){
	$hide_addinfo2_start = "<!--"; $hide_addinfo2_end = "-->";
}
if($info_use[addinfo3] != true){
	$hide_addinfo3_start = "<!--"; $hide_addinfo3_end = "-->";
}
if($info_use[addinfo4] != true){
	$hide_addinfo4_start = "<!--"; $hide_addinfo4_end = "-->";
}
if($info_use[addinfo5] != true){
	$hide_addinfo5_start = "<!--"; $hide_addinfo5_end = "-->";
}
if($info_use[spam] != true){
	$hide_spam_start = "<!--"; $hide_spam_end = "-->";
}


function createObject($no,$type,$size,$flist){

   global $upfile_idx;

   $fname = "f".$no;

   // 반복하지 않는 속성
   $tmp_type = Array("","address","birthday","phone","email");

   for($ii = 0;$ii < count($tmp_type); $ii++) {
   		if(!strcmp($type, $tmp_type[$ii])) $flist = " ";
   }

   $tmp_flist = explode("|",$flist);

   if($type == "select") $finput = "<select id='".$fname."_0' name='fname[".$no."][]'><option value=''>--</option>";

   for($ii=0;$ii<count($tmp_flist);$ii++){

      //if($tmp_flist[$ii] != ""){

         if($type == "text"){

            $finput .= "<input type='text' id='".$fname."_$ii' name='fname[".$no."][]' class='input' size='".$size."'>".$tmp_flist[$ii];

         }else if($type == "file"){

            $upfile_idx++;
            $finput .= "<input type='file' id='".$fname."_$ii' name='upfile".$upfile_idx."' class='input' size='".$size."'>".$tmp_flist[$ii];

         }else if($type == "radio"){

            $finput .= "<input type='radio' id='".$fname."_$ii' name='fname[".$no."]' value='".$tmp_flist[$ii]."'>".$tmp_flist[$ii]."&nbsp; ";

         }else if($type == "checkbox"){

            $finput .= "<input type='checkbox' id='".$fname."_$ii' name='fname[".$no."][]' value='".$tmp_flist[$ii]."'>".$tmp_flist[$ii]."&nbsp; ";

         }else if($type == "textarea"){

            $finput .= "<textarea id='".$fname."_$ii' name='fname[".$no."][]' rows='".$size."' class='input' style='width:99%'></textarea>";

         }else if($type == "select"){

            $finput .= "<option value='".$tmp_flist[$ii]."'>".$tmp_flist[$ii]."</option>";

         }else if($type == "address"){

         		$finput .= "<input type='text' id='".$fname."_0' name='".$fname."_post1' onClick=postSearch('".$fname."_'); class='input' size='6' readonly> - ";
         		$finput .= "<input type='text' id='".$fname."_1' name='".$fname."_post2' onClick=postSearch('".$fname."_'); class='input' size='6' readonly> ";
         		$finput .= "<input type='button' value='주소찾기' onClick=postSearch('".$fname."_'); class='button'><br>";
         		$finput .= "<input type='text' id='".$fname."_2' name='".$fname."_address1' class='input' size='".$size."'><br>";
         		$finput .= "<input type='text' id='".$fname."_3' name='".$fname."_address2' class='input' size='".$size."'><br>";

         }else if($type == "pdate"){

         		$finput .= "<input type='text' id='".$fname."_".$ii."' name='fname[".$no."][]' class='input' size='".$size."' onClick=Calendar5('document.joinFrm','".$fname."_".$ii."'); readonly> ";
            $finput .= "<input type='button' value='달력' onClick=Calendar5('document.joinFrm','".$fname."_".$ii."'); class='button'>".$tmp_flist[$ii];

         }else if($type == "tdate"){

            $finput .= "<select id='".$fname."_".$ii."_0' name='fname[".$no."][]'><option value=''>--</option>";
            for($jj=2008;$jj<=2015;$jj++){
            	$finput .= "<option value='".$jj."'>".$jj."</option>";
            }
            $finput .= "</select>년 ";

						$finput .= "<select id='".$fname."_".$ii."_1' name='fname[".$no."][]'><option value=''>--</option>";
            for($jj=1;$jj<=12;$jj++){
            	if($jj<10) $jj = "0".$jj;
            	$finput .= "<option value='".$jj."'>".$jj."</option>";
            }
            $finput .= "</select>월 ";

						$finput .= "<select id='".$fname."_".$ii."_2' name='fname[".$no."][]'><option value=''>--</option>";
            for($jj=1;$jj<=31;$jj++){
            	if($jj<10) $jj = "0".$jj;
            	$finput .= "<option value='".$jj."'>".$jj."</option>";
            }
            $finput .= "</select>일 ";


            $finput .= "<select id='".$fname."_".$ii."_3' name='fname[".$no."][]'><option value=''>--</option>";
            for($jj=1;$jj<=24;$jj++){
            	if($jj<10) $jj = "0".$jj;
            	$finput .= "<option value='".$jj."'>".$jj."</option>";
            }
            $finput .= "</select>시 ".$tmp_flist[$ii];

         }else if($type == "birthday") {

            $finput .= "<select id='".$fname."_".$ii."_0' name='fname[".$no."][]'><option value=''>--</option>";
            for($jj=1900;$jj<=date('Y');$jj++){
            	$finput .= "<option value='".$jj."'>".$jj."</option>";
            }
            $finput .= "</select>년 ";

						$finput .= "<select id='".$fname."_".$ii."_1' name='fname[".$no."][]'><option value=''>--</option>";
            for($jj=1;$jj<=12;$jj++){
            	if($jj<10) $jj = "0".$jj;
            	$finput .= "<option value='".$jj."'>".$jj."</option>";
            }
            $finput .= "</select>월 ";

						$finput .= "<select id='".$fname."_".$ii."_2' name='fname[".$no."][]'><option value=''>--</option>";
            for($jj=1;$jj<=31;$jj++){
            	if($jj<10) $jj = "0".$jj;
            	$finput .= "<option value='".$jj."'>".$jj."</option>";
            }
            $finput .= "</select>일 ";

         }else if($type == "phone") {

         		$finput .= "<input type='text' id='".$fname."_0' name='fname[".$no."][]' class='input' size='".$size."' maxlength='4'> - ";
         		$finput .= "<input type='text' id='".$fname."_1' name='fname[".$no."][]' class='input' size='".$size."' maxlength='4'> - ";
         		$finput .= "<input type='text' id='".$fname."_2' name='fname[".$no."][]' class='input' size='".$size."' maxlength='4'>".$tmp_flist[$ii];

         }else if($type == "email") {

         		$finput .= "<input type='text' id='".$fname."_$ii' name='fname[".$no."][]' class='input' size='".$size."'>".$tmp_flist[$ii];
         }

      //}
   }

   if($type == "select") $finput .= "</select>";

   return $finput;

}

function checkObject($no,$name,$essen,$type,$flist){

   $fname = "f".$no;
   if($flist == "") $flist = " ";

   if($essen == "Y"){

      if($type == "text" || $type == "textarea" || $type == "file" || $type == "pdate"){

         $flist_list = explode("|",$flist);
         for($ii=0;$ii<count($flist_list);$ii++){

            $checkObj .=   "var obj = document.getElementById(\"".$fname."_".$ii."\");\n";
            $checkObj .=   "if(obj.value == \"\"){\n";
            $checkObj .=   "   alert(\"".$name."을 입력하세요\");\n";
            $checkObj .=   "   obj.focus();\n";
            $checkObj .=   "   return false;\n";
            $checkObj .=   "}\n";

         }

      }else if($type == "select"){

      	$checkObj .=   "var obj = document.getElementById(\"".$fname."_0\");\n";
        $checkObj .=   "if(obj.value == \"\"){\n";
        $checkObj .=   "   alert(\"".$name."을 선택하세요\");\n";
        $checkObj .=   "   obj.focus();\n";
        $checkObj .=   "   return false;\n";
        $checkObj .=   "}\n";

      }else if($type == "tdate"){

				 $flist_list = explode("|",$flist);
         for($ii=0;$ii<count($flist_list);$ii++){

					 $checkObj .=   "var obj = document.getElementById(\"".$fname."_".$ii."_0\");\n";
					 $checkObj .=   "if(obj.value == \"\"){\n";
	         $checkObj .=   "   alert('년도를 선택하세요');\n";
	         $checkObj .=   "   obj.focus();\n";
	         $checkObj .=   "   return false;\n";
	         $checkObj .=   "}\n";
	         $checkObj .=   "var obj = document.getElementById(\"".$fname."_".$ii."_1\");\n";
					 $checkObj .=   "if(obj.value == \"\"){\n";
	         $checkObj .=   "   alert('월을 선택하세요');\n";
	         $checkObj .=   "   obj.focus();\n";
	         $checkObj .=   "   return false;\n";
	         $checkObj .=   "}\n";
	         $checkObj .=   "var obj = document.getElementById(\"".$fname."_".$ii."_2\");\n";
					 $checkObj .=   "if(obj.value == \"\"){\n";
	         $checkObj .=   "   alert('일자를 선택하세요');\n";
	         $checkObj .=   "   obj.focus();\n";
	         $checkObj .=   "   return false;\n";
	         $checkObj .=   "}\n";
	         $checkObj .=   "var obj = document.getElementById(\"".$fname."_".$ii."_3\");\n";
					 $checkObj .=   "if(obj.value == \"\"){\n";
	         $checkObj .=   "   alert('시간을 선택하세요');\n";
	         $checkObj .=   "   obj.focus();\n";
	         $checkObj .=   "   return false;\n";
	         $checkObj .=   "}\n";

	       }

      }else if($type == "checkbox" || $type == "radio"){

         $checkObj .=   "var c_checked = false;";

         $flist_list = explode("|",$flist);
         for($ii=0;$ii<count($flist_list);$ii++){

            $checkObj .=   "var obj = document.getElementById(\"".$fname."_".$ii."\");\n";
            $checkObj .=   "if(obj.checked == true) c_checked = true;\n";

         }

         $checkObj .=   "if(c_checked == false){\n";
         $checkObj .=   "   alert('".$name." 을 선택하세요');\n";
         $checkObj .=   "   return false;\n";
         $checkObj .=   "}\n";


      }else if($type == "address"){

      	 $checkObj .=   "if(frm.".$fname."_address1.value == ''){\n";
         $checkObj .=   "   alert('주소를 입력하세요');\n";
         $checkObj .=   "   return false;\n";
         $checkObj .=   "}\n";
         $checkObj .=   "if(frm.".$fname."_address2.value == ''){\n";
         $checkObj .=   "   alert('주소를 입력하세요');\n";
         $checkObj .=   "   frm.".$fname."_address2.focus();\n";
         $checkObj .=   "   return false;\n";
         $checkObj .=   "}\n";

      }else if($type == "birthday"){

				 $flist_list = explode("|",$flist);
         for($ii=0;$ii<count($flist_list);$ii++){

					 $checkObj .=   "var obj = document.getElementById(\"".$fname."_".$ii."_0\");\n";
					 $checkObj .=   "if(obj.value == \"\"){\n";
	         $checkObj .=   "   alert('년도를 선택하세요');\n";
	         $checkObj .=   "   obj.focus();\n";
	         $checkObj .=   "   return false;\n";
	         $checkObj .=   "}\n";
	         $checkObj .=   "var obj = document.getElementById(\"".$fname."_".$ii."_1\");\n";
					 $checkObj .=   "if(obj.value == \"\"){\n";
	         $checkObj .=   "   alert('월을 선택하세요');\n";
	         $checkObj .=   "   obj.focus();\n";
	         $checkObj .=   "   return false;\n";
	         $checkObj .=   "}\n";
	         $checkObj .=   "var obj = document.getElementById(\"".$fname."_".$ii."_2\");\n";
					 $checkObj .=   "if(obj.value == \"\"){\n";
	         $checkObj .=   "   alert('일자를 선택하세요');\n";
	         $checkObj .=   "   obj.focus();\n";
	         $checkObj .=   "   return false;\n";
	         $checkObj .=   "}\n";

	       }

      }else if($type == "phone"){

          $checkObj .=   "var obj = document.getElementById(\"".$fname."_0\");\n";
          $checkObj .=   "if(obj.value == \"\"){\n";
          $checkObj .=   "   alert(\"".$name."을 입력하세요\");\n";
          $checkObj .=   "   obj.focus();\n";
          $checkObj .=   "   return false;\n";
          $checkObj .=   "}else if(!check_Num(obj.value)){\n";
          $checkObj .=   "	alert(\"지역번호는 숫자만 가능합니다.\");\n";
          $checkObj .=   "   obj.focus();\n";
          $checkObj .=   "   return false;\n";
          $checkObj .=   "}\n";

          $checkObj .=   "var obj = document.getElementById(\"".$fname."_1\");\n";
          $checkObj .=   "if(obj.value == \"\"){\n";
          $checkObj .=   "   alert(\"".$name."을 입력하세요\");\n";
          $checkObj .=   "   obj.focus();\n";
          $checkObj .=   "   return false;\n";
          $checkObj .=   "}else if(!check_Num(obj.value)){\n";
          $checkObj .=   "	alert(\"국번은 숫자만 가능합니다.\");\n";
          $checkObj .=   "   obj.focus();\n";
          $checkObj .=   "   return false;\n";
          $checkObj .=   "}\n";
          $checkObj .=   "var obj = document.getElementById(\"".$fname."_2\");\n";
          $checkObj .=   "if(obj.value == \"\"){\n";
          $checkObj .=   "   alert(\"".$name."을 입력하세요\");\n";
          $checkObj .=   "   obj.focus();\n";
          $checkObj .=   "   return false;\n";
          $checkObj .=   "}else if(!check_Num(obj.value)){\n";
          $checkObj .=   "	alert(\"전화번호는 숫자만 가능합니다.\");\n";
          $checkObj .=   "   obj.focus();\n";
          $checkObj .=   "   return false;\n";
          $checkObj .=   "}\n";

      } else if($type == "email"){

            $checkObj .=   "var obj = document.getElementById(\"".$fname."_0\");\n";
            $checkObj .=   "if(obj.value == \"\"){\n";
            $checkObj .=   "   alert(\"".$name."을 입력하세요\");\n";
            $checkObj .=   "   obj.focus();\n";
            $checkObj .=   "   return false;\n";
            $checkObj .=   "} else if(!check_Email(obj.value)) {\n";
            $checkObj .=   "   obj.focus();\n";
            $checkObj .=   "   return false;\n";
          $checkObj .=   "}\n";

      }


   }

   return $checkObj;

}

$sql = "select fprior, ftype, fsize, flist from wiz_formfield where fidx = 'addinfo' order by fprior asc";
$result = mysql_query($sql) or error(mysql_error());
while($row = mysql_fetch_array($result)) {
	$no = $row[fprior];

	${addinfo.$no._input} = createObject($no,$row[ftype],$row[fsize],$row[flist]);
	${addinfo.$no._check} = checkObject($no,${addname.$no},"Y",$row[ftype],$row[flist]);

}
?>

<script language="JavaScript" src="/admin/js/lib.js"></script>
<script language="JavaScript" src="/admin/js/calendar.js"></script>
<script language="JavaScript">
<!--

// 입력값 체크
function joinCheck(frm){

	if(frm.id.value.length < 3 || frm.id.value.length > 12){ alert("아이디는 3 ~ 12자리만 가능합니다."); frm.id.focus(); return false;
   }else{
      if(!check_Char(frm.id.value)){ alert("아이디는 특수문자를 사용할수 없습니다."); frm.id.focus(); return false; }
   }

	if(frm.passwd1.value.length < 4 || frm.passwd1.value.length > 12){ alert("비밀번호는 4 ~ 12자리입니다"); frm.passwd1.focus(); return false; }
	if(frm.passwd2.value.length < 4 || frm.passwd2.value.length > 12){ alert("비밀번호는 4 ~ 12자리입니다"); frm.passwd2.focus(); return false; }
	if(frm.passwd1.value != frm.passwd2.value){alert("비밀번호가 일치하지 않습니다");frm.passwd1.focus();return false;}

   if(frm.name.value == ""){alert("이름을 입력하세요");frm.name.focus();return false;
   }else{
      if(!check_nonChar(frm.name.value)){alert("이름에는 특수문자가 들어갈 수 없습니다");frm.name.focus();return false;}
   }

<? if($info_use[nick]=="true" && $info_ess[nick]=="true"){ ?>

   if(frm.nick.value == ""){alert("닉네임을 입력하세요.");frm.nick.focus();return false;}

<? } ?>

<? if($info_use[photo]=="true" && $info_ess[photo]=="true"){ ?>

   if(frm.photo.value == ""){alert("사진을 입력하세요.");frm.photo.focus();return false;}

<? } ?>

<? if($info_use[icon]=="true" && $info_ess[icon]=="true"){ ?>

   if(frm.icon.value == ""){alert("아이콘을 입력하세요.");frm.icon.focus();return false;}

<? } ?>

<? if($info_use[resno]=="true" && $info_ess[resno]=="true"){ ?>

   if(frm.resno1.value == ""){alert("주민번호를 입력하세요");frm.resno1.focus();return false;}
   if(frm.resno2.value == ""){alert("주민번호를 입력하세요");frm.resno2.focus();return false;}
   if(!check_ResidentNO(frm.resno1.value, frm.resno2.value)){alert("주민번호가 올바르지 않습니다");frm.resno1.value == "";frm.resno2.value == "";frm.resno1.focus();return false;}

<? } ?>

<? if($info_use[tphone]=="true" && $info_ess[tphone]=="true"){ ?>

   if(frm.tphone1.value == ""){alert("전화번호를 입력하세요");frm.tphone1.focus();return false;
   }else if(!check_Num(frm.tphone1.value)){alert("지역번호는 숫자만 가능합니다.");frm.tphone1.focus();return false;}

   if(frm.tphone2.value == ""){alert("전화번호를 입력하세요");frm.tphone2.focus();return false;
   }else if(!check_Num(frm.tphone2.value)){alert("국번은 숫자만 가능합니다.");frm.tphone2.focus();return false;}

   if(frm.tphone3.value == ""){alert("전화번호를 입력하세요");frm.tphone3.focus();return false;
   }else if(!check_Num(frm.tphone3.value)){alert("전화번호는 숫자만 가능합니다");frm.tphone3.focus();return false;}

<? } ?>

<? if($info_use[hphone]=="true" && $info_ess[hphone]=="true"){ ?>

   if(frm.hphone1.value == ""){alert("휴대폰번호를 입력하세요");frm.hphone1.focus();return false;
   }else if(!check_Num(frm.hphone1.value)){alert("휴대폰번호는 숫자만 가능합니다.");frm.hphone1.focus();return false;}

   if(frm.hphone2.value == ""){alert("휴대폰번호를 입력하세요");frm.hphone2.focus();return false;
   }else if(!check_Num(frm.hphone2.value)){alert("휴대폰번호는 숫자만 가능합니다.");frm.hphone2.focus();return false;}

   if(frm.hphone3.value == ""){alert("휴대폰번호를 입력하세요");frm.hphone3.focus();return false;
   }else if(!check_Num(frm.hphone3.value)){alert("휴대폰번호는 숫자만 가능합니다");frm.hphone3.focus();return false;}

<? } ?>

<? if($info_use[comtel]=="true" && $info_ess[comtel]=="true"){ ?>

   if(frm.comtel1.value == ""){alert("회사전화를 입력하세요");frm.comtel1.focus();return false;
   }else if(!check_Num(frm.comtel1.value)){alert("전화번호는 숫자만 가능합니다.");frm.comtel1.focus();return false;}

   if(frm.comtel2.value == ""){alert("회사전화를 입력하세요");frm.comtel2.focus();return false;
   }else if(!check_Num(frm.comtel2.value)){alert("전화번호는 숫자만 가능합니다.");frm.comtel2.focus();return false;}

   if(frm.comtel3.value == ""){alert("회사전화를 입력하세요");frm.comtel3.focus();return false;
   }else if(!check_Num(frm.comtel3.value)){alert("전화번호는 숫자만 가능합니다");frm.comtel3.focus();return false;}

<? } ?>

<? if($info_use[email]=="true" && $info_ess[email]=="true"){ ?>

   if(frm.email.value == ""){alert("이메일을 입력하세요.");frm.email.focus();return false;
   }else if(!check_Email(frm.email.value)){frm.email.focus();return false;}

<? } ?>

if ( !$("input[name=class_gb]").is(":checked") ){
  alert("소속 구분을 선택해주세요.");
  return false;
}


<? if($info_use[homepage]=="true" && $info_ess[homepage]=="true"){ ?>

   if(frm.homepage.value == ""){alert("홈페이지를 입력하세요.");frm.homepage.focus();return false;}

<? } ?>


<? if($info_use[address]=="true" && $info_ess[address]=="true"){ ?>

   if(frm.post1.value == ""){alert("우편번호를 입력하세요");frm.post1.focus();return false;}
   if(frm.post2.value == ""){alert("우편번호를 입력하세요");frm.post2.focus();return false;}
   if(frm.post1.value.length != 3 || frm.post2.value.length != 3){alert("우편번호가 올바르지 않습니다");frm.post1.focus();return false;}
   if(frm.address1.value == ""){alert("주소를 입력하세요");frm.address1.focus();return false;}
   if(frm.address2.value == ""){alert("상세주소를 입력하세요");frm.address2.focus();return false;}

<? } ?>

<? if($info_use[birthday]=="true" && $info_ess[birthday]=="true"){ ?>

   if(frm.birthday1.value == ""){alert("생년월일을 입력하세요.");frm.birthday1.focus();return false;}
   if(frm.birthday2.value == ""){alert("생년월일을 입력하세요.");frm.birthday2.focus();return false;}
   if(frm.birthday3.value == ""){alert("생년월일을 입력하세요.");frm.birthday3.focus();return false;}
   if(frm.bgubun[0].checked == false && frm.bgubun[1].checked == false){alert("양력 음력을 선택하세요.");return false;}

<? } ?>

<? if($info_use[marriage]=="true" && $info_ess[marriage]=="true"){ ?>
   if(frm.marriage[0].checked == false && frm.marriage[1].checked == false){alert("결혼여부를 선택하세요.");return false;}

<? } ?>

<? if($info_use[memorial]=="true" && $info_ess[memorial]=="true"){ ?>

   if(frm.memorial1.value == ""){alert("결혼기념일을 입력하세요.");frm.memorial1.focus();return false;}
   if(frm.memorial2.value == ""){alert("결혼기념일을 입력하세요.");frm.memorial2.focus();return false;}
   if(frm.memorial3.value == ""){alert("결혼기념일을 입력하세요.");frm.memorial3.focus();return false;}

<? } ?>

<? if($info_use[job]=="true" && $info_ess[job]=="true"){ ?>

   if(frm.job.value == ""){alert("직업을 선택하세요.");frm.job.focus();return false;}

<? } ?>

<? if($info_use[scholarship]=="true" && $info_ess[scholarship]=="true"){ ?>

   if(frm.scholarship.value == ""){alert("학력을 선택하세요.");frm.scholarship.focus();return false;}

<? } ?>

<? if($info_use[consph]=="true" && $info_ess[consph]=="true"){ ?>

	var consphLen=frm['consph[]'].length;

	if(consphLen == undefined){
	  if( frm['consph[]'].checked == false ){alert("관심분야가 선택되지 않았습니다.");frm['consph[]'].focus();return false;  }
	}else {
	  var ChkLike=0;
	  for(i=0;i<consphLen;i++){if( frm['consph[]'][i].checked == true ){ ChkLike=1; break;}}
	  if( ChkLike==0 ){alert("관심분야는 한개 이상 선택하셔야 합니다.");frm['consph[]'][0].focus();return false; }
	}

<? } ?>

<? if($info_use[hobby]=="true" && $info_ess[hobby]=="true"){ ?>

   if(frm.hobby.value == ""){alert("취미를 입력하세요.");frm.hobby.focus();return false;}

<? } ?>

<? if($info_use[income]=="true" && $info_ess[income]=="true"){ ?>

   if(frm.income.value == ""){alert("월평균 소득일 선택하세요.");frm.income.focus();return false;}

<? } ?>

<? if($info_use[car]=="true" && $info_ess[car]=="true"){ ?>

   if(frm.car[0].checked==false && frm.car[1].checked==false ){alert("자동차 소유여부를 선택하세요.");return false;}

<? } ?>

<? if($info_use[intro]=="true" && $info_ess[intro]=="true"){ ?>

   if(frm.intro.value == ""){alert("자기소개를 입력하세요.");frm.intro.focus();return false;}

<? } ?>

<? if($info_use[recom]=="true" && $info_ess[recom]=="true"){ ?>

   if(frm.recom.value == ""){alert("추천인을 입력하세요");frm.recom.focus();return false;}
   else if(frm.id.value == frm.recom.value){alert("추천인은 본인이 될 수 없습니다.");frm.recom.focus();return false;}

<? } ?>

<? if($info_use[addinfo1]=="true" && $info_ess[addinfo1]=="true"){ ?>

   <?=$addinfo1_check?>

<? } ?>

<? if($info_use[addinfo2]=="true" && $info_ess[addinfo2]=="true"){ ?>

   <?=$addinfo2_check?>

<? } ?>

<? if($info_use[addinfo3]=="true" && $info_ess[addinfo3]=="true"){ ?>

   <?=$addinfo3_check?>

<? } ?>

<? if($info_use[addinfo4]=="true" && $info_ess[addinfo4]=="true"){ ?>

   <?=$addinfo4_check?>

<? } ?>

<? if($info_use[addinfo5]=="true" && $info_ess[addinfo5]=="true"){ ?>

   <?=$addinfo5_check?>

<? } ?>

<? if($info_use[spam]=="true" && $info_ess[spam]=="true"){ ?>

  if (frm.vcode != undefined && (hex_md5(frm.vcode.value) != md5_norobot_key)) {
  	alert("자동등록방지코드를 정확히 입력해주세요.");
    frm.vcode.focus();
    return false;
	}

<? } ?>

	if(frm.secure_login != undefined) {
		if(!frm.secure_login.checked){
			frm.action = "/admin/member/join_save.php";
		}
	}

}

// 아이디 중복확인
function idCheck(){
   var id = document.joinFrm.id.value;
   var url = "/admin/member/id_check.php?id=" + id;
   window.open(url, "idCheck", "width=490, height=370, menubar=no, scrollbars=no, resizable=no, toolbar=no, status=no, left=0, top=0");
}

// 닉네임 중복확인
function nickCheck(){
   var nick = document.joinFrm.nick.value;
   var url = "/admin/member/nick_check.php?nick=" + nick;
   window.open(url, "nickCheck", "width=410, height=280, menubar=no, scrollbars=no, resizable=no, toolbar=no, status=no, left=150, top=150");
}

// 우편번호 찾기
function postSearch(kind){
	if(kind == undefined) kind = "";
   document.joinFrm.address1.focus();
   var url = "/admin/member/post_search.php?kind="+kind;
   window.open(url, "postSearch", "width=427, height=400, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, left=50, top=50");
}

// 주민번호 자동포커스
function jfocus(frm){
	if(frm.resno2 != null){
		var str = frm.resno1.value.length;
		if(str == 6) frm.resno2.focus();
	}
}
//-->
</script>

<? include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/join_input.php"; ?>
