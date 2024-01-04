<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin2/inc/site_info.php";
include "$_SERVER[DOCUMENT_ROOT]/admin2/inc/mem_info.php";

echo "<link href=\"".$skin_dir."/style.css\" rel=\"stylesheet\" type=\"text/css\">";

$prev = "http://".$_http_host.$PHP_SELF;

$action = $ssl."/admin2/member/myinfo_save.php";

if($wiz_session[id] == "") error("로그인 후 이용하세요");

// 회원정보
$sql="select * from wiz_member where id='$wiz_session[id]'";
$result=mysql_query($sql);
$my_info=mysql_fetch_array($result);

include "$_SERVER[DOCUMENT_ROOT]/admin2/inc/mem_info.php";

if($my_info[photo] != "" && file_exists(WIZHOME_PATH."/data/member/".$my_info[photo])){
	$photo = "<img src=/admin2/data/member/".$my_info[photo]." name='wiz_target_resize'> <input type='checkbox' name='delphoto' value='Y'><font color='red'>삭제</font><br>";
}
if($my_info[icon] != "" && file_exists(WIZHOME_PATH."/data/member/".$my_info[icon])){
	$icon = "<img src=/admin2/data/member/".$my_info[icon]." width='".$icon_size."' height='".$icon_size."' align='absmiddle'> <input type='checkbox' name='delicon' value='Y'><font color='red'>삭제</font><br>";
}

$id				= $my_info[id];
$name			= $my_info[name];
$nick			= $my_info[nick];
$resno		= $my_info[resno];
$email		= $my_info[email];
$homepage	= $my_info[homepage];
$address1	= $my_info[address1];
$address2	= $my_info[address2];

$job			= $my_info[job];
$scholarship= $my_info[scholarship];
$hobby		= $my_info[hobby];
$income		= $my_info[income];
$intro		= $my_info[intro];
$car			= $my_info[car];

$addinfo1	= $my_info[addinfo1];
$addinfo2	= $my_info[addinfo2];
$addinfo3	= $my_info[addinfo3];
$addinfo4	= $my_info[addinfo4];
$addinfo5	= $my_info[addinfo5];

$resno = substr($resno, 0, 7)."*******";

if($my_info[reemail] == "Y") $reemail_y = "checked";
else if($my_info[reemail] == "N")  $reemail_n = "checked";

if($my_info[resms] == "Y") $resms_y = "checked";
else if($my_info[resms] == "N")  $resms_n = "checked";

if($my_info[bgubun] == "양력") $bgubun_s = "checked";
else if($my_info[bgubun] == "음력") $bgubun_m = "checked";

if($my_info[marriage] == "기혼") $marriage_y = "checked";
else if($my_info[marriage] == "미혼") $marriage_n = "checked";

if($my_info[car] == "소유") $car_y = "checked";
else if($my_info[car] == "미소유") $car_n = "checked";

$tmp_list=explode("-",$my_info[post]);
$post1=$tmp_list[0]; $post2=$tmp_list[1];

$tmp_list=explode("-",$my_info[tphone]);
$tphone1=$tmp_list[0]; $tphone2=$tmp_list[1]; $tphone3=$tmp_list[2];

$tmp_list=explode("-",$my_info[hphone]);
$hphone1=$tmp_list[0]; $hphone2=$tmp_list[1]; $hphone3=$tmp_list[2];

$tmp_list=explode("-",$my_info[comtel]);
$comtel1=$tmp_list[0]; $comtel2=$tmp_list[1]; $comtel3=$tmp_list[2];

$tmp_list=explode("-",$my_info[birthday]);
$birthday1=$tmp_list[0]; $birthday2=$tmp_list[1]; $birthday3=$tmp_list[2];

$tmp_list=explode("-",$my_info[memorial]);
$memorial1=$tmp_list[0]; $memorial2=$tmp_list[1]; $memorial3=$tmp_list[2];



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

function createObject($no,$type,$size,$flist, $value){

   global $upfile_idx;

   $fname = "f".$no;

   // 반복하지 않는 속성
   $tmp_type = Array("","address","birthday","phone","email");

   for($ii = 0;$ii < count($tmp_type); $ii++) {
   		if(!strcmp($type, $tmp_type[$ii])) $flist = " ";
   }

   $tmp_flist = explode("|",$flist);

   if($type == "select") $finput = "<select id=\"".$fname."_0\" name=\"fname[".$no."][]\"><option value=\"\">--</option>";

   for($ii=0;$ii<count($tmp_flist);$ii++){

      //if($tmp_flist[$ii] != ""){

         if($type == "text"){

         		$tmp_value = explode("|", $value);

            $finput .= "<input type=\"text\" id=\"".$fname."_$ii\" name=\"fname[".$no."][]\" class=\"input\" size=\"".$size."\" value=\"".$tmp_value[$ii]."\">".$tmp_flist[$ii];

         }else if($type == "file"){
         	
         		$tmp_value = explode("|", $value);

            $upfile_idx++;
            $finput .= "<input type=\"file\" id=\"".$fname."_$ii\" name=\"upfile".$upfile_idx."\" class=\"input\" size=\"".$size."\">";
	          $finput .= " <input type=\"hidden\" id=\"tmp_".$fname."_$ii\" name=\"tmp_upfile_".$no."_".$upfile_idx."\" value=\"".$tmp_value[$ii]."\">";
            
            if(!empty($tmp_value[$ii])) {
	            $finput .= " <a href=\"/admin2/data/member/".$tmp_value[$ii]."\" target=\"_blank\">".$tmp_value[$ii]."</a> ";
	            $finput .= " <a href=\"".$PHP_SELF."?ptype=save&mode=addfile_del&upfile=".$tmp_value[$ii]."&no=".$no."\"><font color=\"red\">[삭제]</font></a> ";
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

         		$finput .= "<input type=\"text\" id=\"".$fname."_0\" name=\"".$fname."_post1\" onClick=postSearch(\"".$fname."_\"); class=\"input\" size=\"6\" readonly value=\"".$tmp_zip[0]."\"> - ";
         		$finput .= "<input type=\"text\" id=\"".$fname."_1\" name=\"".$fname."_post2\" onClick=postSearch(\"".$fname."_\"); class=\"input\" size=\"6\" readonly value=\"".$tmp_zip[1]."\"> ";
         		$finput .= "<input type=\"button\" value=\"주소찾기\" onClick=postSearch(\"".$fname."_\"); class=\"button\"><br>";
         		$finput .= "<input type=\"text\" id=\"".$fname."_2\" name=\"".$fname."_address1\" class=\"input\" size=\"".$size."\" value=\"".$tmp_value[1]."\"><br>";
         		$finput .= "<input type=\"text\" id=\"".$fname."_3\" name=\"".$fname."_address2\" class=\"input\" size=\"".$size."\" value=\"".$tmp_value[2]."\"><br>";

         }else if($type == "pdate"){

         		$tmp_value = explode("~", $value);

         		$finput .= "<input type=\"text\" id=\"".$fname."_".$ii."\" name=\"fname[".$no."][]\" class=\"input\" size=\"".$size."\" onClick=Calendar5(\"document.myinfoFrm\",\"".$fname."_".$ii."\"); readonly value=\"".$tmp_value[$ii]."\"> ";
            $finput .= "<input type=\"button\" value=\"달력\" onClick=Calendar5(\"document.myinfoFrm\",\"".$fname."_".$ii."\"); class=\"button\">".$tmp_flist[$ii];

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

function checkObject($no,$name,$essen,$type,$flist){
   
   $fname = "f".$no;
   if($flist == "") $flist = " ";
   
   if($essen == "Y"){

      if($type == "text" || $type == "textarea" || $type == "pdate"){
         
         $flist_list = explode("|",$flist);
         for($ii=0;$ii<count($flist_list);$ii++){

            $checkObj .=   "var obj = document.getElementById(\"".$fname."_".$ii."\");\n";
            $checkObj .=   "if(obj.value == \"\"){\n";
            $checkObj .=   "   alert(\"".$name."을 입력하세요\");\n";
            $checkObj .=   "   obj.focus();\n";
            $checkObj .=   "   return false;\n";
            $checkObj .=   "}\n";

         }
         
      }else if($type == "file") {
      	
         $flist_list = explode("|",$flist);
         for($ii=0;$ii<count($flist_list);$ii++){

            $checkObj .=   "var obj = document.getElementById(\"".$fname."_".$ii."\");\n";
            $checkObj .=   "var tmp_obj = document.getElementById(\"tmp_".$fname."_".$ii."\");\n";
            $checkObj .=   "if(obj.value == \"\" && tmp_obj.value == \"\" ){\n";
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
	
	${addinfo.$no._input} = createObject($no,$row[ftype],$row[fsize],$row[flist], ${"addinfo".$no});
	${addinfo.$no._check} = checkObject($no,${addname.$no},"Y",$row[ftype],$row[flist]);
}

?>

<script language="JavaScript" src="/admin2/js/lib.js"></script>
<script language="JavaScript" src="/admin2/js/calendar.js"></script>
<script language="JavaScript">
<!--

// 입력값 체크
function myinfoCheck(frm){

	if(frm.passwd1.value != ""){
      
      if(frm.passwd1.value != frm.passwd2.value){alert("비밀번호가 일치하지 않습니다");frm.passwd1.focus();return false;}
      if(frm.passwd1.value.length < 4 || frm.passwd1.value.length > 12){ alert("비밀번호는 4 ~ 12자리입니다"); frm.passwd1.focus(); return false;  }
      if(frm.passwd2.value.length < 4 || frm.passwd2.value.length > 12){ alert("비밀번호는 4 ~ 12자리입니다"); frm.passwd2.focus(); return false; }
   
   }

<? if($info_use[nick]=="true" && $info_ess[nick]=="true"){ ?>

   if(frm.nick.value == ""){alert("닉네임을 입력하세요.");frm.nick.focus();return false;}

<? } ?>

<? if($info_use[photo]=="true" && $info_ess[photo]=="true" && empty($photo)){ ?>
	
   if(frm.photo.value == ""){alert("사진을 입력하세요.");frm.photo.focus();return false;}

<? } ?>

<? if($info_use[icon]=="true" && $info_ess[icon]=="true" && empty($icon)){ ?>
	
   if(frm.icon.value == ""){alert("아이콘을 입력하세요.");frm.icon.focus();return false;}

<? } ?>

<? if($info_use[resno]=="true" && $info_ess[resno]=="true"){ ?>

   //if(frm.resno1.value == ""){alert("주민번호를 입력하세요");frm.resno1.focus();return false;}
   //if(frm.resno2.value == ""){alert("주민번호를 입력하세요");frm.resno2.focus();return false;}
   //if(!check_ResidentNO(frm.resno1.value, frm.resno2.value)){alert("주민번호가 올바르지 않습니다");frm.resno1.value == "";frm.resno2.value == "";frm.resno1.focus();return false;}

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
	
}

// 닉네임 중복확인
function nickCheck(){
   var nick = document.myinfoFrm.nick.value;
   var url = "/admin2/member/nick_check.php?nick=" + nick;
   window.open(url, "nickCheck", "width=410, height=280, menubar=no, scrollbars=no, resizable=no, toolbar=no, status=no, left=150, top=150");
}

// 우편번호 찾기
function postSearch(kind){
	if(kind == undefined) kind = "";
   document.myinfoFrm.address1.focus();
   var url = "/admin2/member/post_search.php?kind="+kind;
   window.open(url, "postSearch", "width=427, height=400, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, left=50, top=50");
}
//-->
</script>

<?php
// 이미지 리사이즈를 위해서 처리하는 부분
echo "<table border=0 cellspacing=0 cellpadding=0 style='width:500px;height:0px;' id='wiz_get_table_width'>
				<col width=100%></col>
				<tr>
					<td><img src='' border='0' name='wiz_target_resize' width='0' height='0'></td>
				</tr>
			</table>";
$_ResizeCheck = true;
?>

<? include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/myinfo.php"; ?>

<? view_img_resize() ?>
