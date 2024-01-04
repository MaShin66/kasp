<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin2/inc/site_info.php";
include "$_SERVER[DOCUMENT_ROOT]/admin2/inc/form_info.php";

// 자동등록글체크
get_spam_check();

// 스팸글체크기능 사용여부
if(strcmp($form_info[spam_check], "Y")){
	$hide_spam_check_start = "<!--"; $hide_spam_check_end = "-->";
}

// 약관내용
$agreement = $form_info[agree_text];

if($form_info[agree_use] != "Y") {
	$hide_agree_start = "<!--"; $hide_agree_end = "-->";
}

echo "<link href=\"".$skin_dir."/style.css\" rel=\"stylesheet\" type=\"text/css\">";

if(!function_exists("createObject")) {

	function createObject($no,$type,$size,$flist){

		global $upfile_idx;
		global $spam_check;
		global $norobot_key;
		global $form_info;

		$syear = date('Y')-1;		// 시작년도 ( date('Y') 해당년도 , $syear=2011; 처럼 지정가능 )
		$eyear = $syear + 10;		// 끝년도 ( $eyear = 2020; 처럼 지정가능)

		$fname = "f".$no;

		// 반복하지 않는 속성
		$tmp_type = Array("","address","birthday","phone","email");

		for($ii = 0;$ii < count($tmp_type); $ii++) {
			if(!strcmp($type, $tmp_type[$ii])) $flist = " ";
		}

		$tmp_flist = explode("|",$flist);

		if($type == "select") $finput = "<select id='".$form_info[idx]."_".$fname."_0' name='fname[".$no."][]'><option value=''>--</option>";

		for($ii=0;$ii<count($tmp_flist);$ii++){

		  //if($tmp_flist[$ii] != ""){

		     if($type == "text" || $type == "name"){

		        $finput .= "<input type='text' id='".$form_info[idx]."_".$fname."_$ii' name='fname[".$no."][]' class='input' size='".$size."'>".$tmp_flist[$ii];

		     }else if($type == "file"){

		        $upfile_idx++;
		        $finput .= "<input type='file' id='".$form_info[idx]."_".$fname."_$ii' name='upfile".$upfile_idx."' class='input' size='".$size."'>".$tmp_flist[$ii];

		     }else if($type == "radio"){

		        $finput .= "<input type='radio' id='".$form_info[idx]."_".$fname."_$ii' name='fname[".$no."]' value='".$tmp_flist[$ii]."'>".$tmp_flist[$ii]."&nbsp; ";

		     }else if($type == "checkbox"){

		        $finput .= "<input type='checkbox' id='".$form_info[idx]."_".$fname."_$ii' name='fname[".$no."][]' value='".$tmp_flist[$ii]."'>".$tmp_flist[$ii]."&nbsp; ";

		     }else if($type == "textarea"){

		        $finput .= "<textarea id='".$form_info[idx]."_".$fname."_$ii' name='fname[".$no."][]' rows='".$size."' class='input' style='width:99%'></textarea>";

		     }else if($type == "select"){

		        $finput .= "<option value='".$tmp_flist[$ii]."'>".$tmp_flist[$ii]."</option>";

		     }else if($type == "address"){

		     		$finput .= "<input type='text' id='".$form_info[idx]."_".$fname."_0' name='".$fname."_post1' onClick=postSearch('".$fname."_'); class='input' size='6' readonly> - ";
		     		$finput .= "<input type='text' id='".$form_info[idx]."_".$fname."_1' name='".$fname."_post2' onClick=postSearch('".$fname."_'); class='input' size='6' readonly> ";
		     		$finput .= "<input type='button' value='주소찾기' onClick=postSearch('".$fname."_'); class='button'><br>";
		     		$finput .= "<input type='text' id='".$form_info[idx]."_".$fname."_2' name='".$fname."_address1' class='input' size='".$size."'><br>";
		     		$finput .= "<input type='text' id='".$form_info[idx]."_".$fname."_3' name='".$fname."_address2' class='input' size='".$size."'><br>";

		     }else if($type == "pdate"){

		     		$finput .= "<input type='text' id='".$form_info[idx]."_".$fname."_".$ii."' name='fname[".$no."][]' class='input' size='".$size."' onClick=Calendar5('document.formFrm".$form_info[idx]."','".$form_info[idx]."_".$fname."_".$ii."'); readonly> ";
		        $finput .= "<input type='button' value='달력' onClick=Calendar5('document.formFrm".$form_info[idx]."','".$form_info[idx]."_".$fname."_".$ii."'); class='button'>".$tmp_flist[$ii];

		     }else if($type == "tdate"){

		        $finput .= "<select id='".$form_info[idx]."_".$fname."_".$ii."_0' name='fname[".$no."][]'><option value=''>--</option>";
		        for($jj=$syear;$jj<=$eyear;$jj++){
		        	$finput .= "<option value='".$jj."'>".$jj."</option>";
		        }
		        $finput .= "</select>년 ";

						$finput .= "<select id='".$form_info[idx]."_".$fname."_".$ii."_1' name='fname[".$no."][]'><option value=''>--</option>";
		        for($jj=1;$jj<=12;$jj++){
		        	if($jj<10) $jj = "0".$jj;
		        	$finput .= "<option value='".$jj."'>".$jj."</option>";
		        }
		        $finput .= "</select>월 ";

						$finput .= "<select id='".$form_info[idx]."_".$fname."_".$ii."_2' name='fname[".$no."][]'><option value=''>--</option>";
		        for($jj=1;$jj<=31;$jj++){
		        	if($jj<10) $jj = "0".$jj;
		        	$finput .= "<option value='".$jj."'>".$jj."</option>";
		        }
		        $finput .= "</select>일 ";


		        $finput .= "<select id='".$form_info[idx]."_".$fname."_".$ii."_3' name='fname[".$no."][]'><option value=''>--</option>";
		        for($jj=1;$jj<=24;$jj++){
		        	if($jj<10) $jj = "0".$jj;
		        	$finput .= "<option value='".$jj."'>".$jj."</option>";
		        }
		        $finput .= "</select>시 ".$tmp_flist[$ii];

		     }else if($type == "birthday") {

		        $finput .= "<select id='".$form_info[idx]."_".$fname."_".$ii."_0' name='fname[".$no."][]'><option value=''>--</option>";
		        for($jj=1900;$jj<=date('Y');$jj++){
		        	$finput .= "<option value='".$jj."'>".$jj."</option>";
		        }
		        $finput .= "</select>년 ";

						$finput .= "<select id='".$form_info[idx]."_".$fname."_".$ii."_1' name='fname[".$no."][]'><option value=''>--</option>";
		        for($jj=1;$jj<=12;$jj++){
		        	if($jj<10) $jj = "0".$jj;
		        	$finput .= "<option value='".$jj."'>".$jj."</option>";
		        }
		        $finput .= "</select>월 ";

						$finput .= "<select id='".$form_info[idx]."_".$fname."_".$ii."_2' name='fname[".$no."][]'><option value=''>--</option>";
		        for($jj=1;$jj<=31;$jj++){
		        	if($jj<10) $jj = "0".$jj;
		        	$finput .= "<option value='".$jj."'>".$jj."</option>";
		        }
		        $finput .= "</select>일 ";

		     }else if($type == "phone" || $type == "tel") {

		     		$tphone_list = "02,031,032,033,041,042,043,051,052,053,054,055,061,062,063,064";
		     		$hphone_list = "010,011,016,017,018,019";
		     		if(!strcmp($type, "tel")) $num_list = explode(",", $tphone_list);
		     		else if(!strcmp($type, "phone")) $num_list = explode(",", $hphone_list);

		     		$finput .= "<select  id='".$form_info[idx]."_".$fname."_0' name='fname[".$no."][]'>";
		     		for($jj = 0; $jj < count($num_list); $jj++) {
		     			$finput .= "<option value='".$num_list[$jj]."'>".$num_list[$jj]."</option>";
		     		}
		     		$finput .= "</select> - ";

		     		$finput .= "<input type='text' id='".$form_info[idx]."_".$fname."_1' name='fname[".$no."][]' class='input' size='".$size."' maxlength='4'> - ";
		     		$finput .= "<input type='text' id='".$form_info[idx]."_".$fname."_2' name='fname[".$no."][]' class='input' size='".$size."' maxlength='4'>".$tmp_flist[$ii];

		     }else if($type == "email") {

		     		//$finput .= "<input type='text' id='".$form_info[idx]."_".$fname."_$ii' name='fname[".$no."][]' class='input' size='".$size."'>".$tmp_flist[$ii];
		     		$finput .= "<input type='text' id='".$form_info[idx]."_".$fname."_1' name='".$fname."_email1' class='input' size='".$size."'> @ ";
		     		$finput .= "<input type='text' id='".$form_info[idx]."_".$fname."_2' name='".$fname."_email2' class='input' size='".$size."'> ";

		     		$email_str = "naver.com,daum.net,dreamwiz.com,empal.com,hanmail.net,hanmir.com,hanafos.com,hotmail.com,lycos.co.kr,nate.com,paran.com,nate.com,netian.com,yahoo.co.kr,kornet.net,nownuri.net,unitel.co.kr,freechal.com,korea.com,orgio.net,chollian.net,hitel.net";
		     		$email_arr = explode(",", $email_str);

				$finput .= "<select id='".$form_info[idx]."_".$fname."_".$ii."_3' name='fname[".$no."][]' onChange=\"document.getElementById('".$form_info[idx]."_".$fname."_2').value=this.value\"><option value=''>직접입력</option>";
				for($jj=0;$jj<count($email_arr);$jj++){
					$finput .= "<option value='".$email_arr[$jj]."'>".$email_arr[$jj]."</option>";
				}
				$finput .= "</select> ".$tmp_flist[$ii];

		     }else if($type == "spamcheck") {

		     		get_spam_check();
		     		$finput .= "<input type='hidden' name='tmp_vcode_".$form_info[idx]."' value='".md5($norobot_key)."'>".$spam_check;

		     }

		  //}
		}

		if($type == "select") $finput .= "</select>";

		return $finput;

	}

	function checkObject($no,$name,$essen,$type,$flist){

		global $form_info;

	   $fname = "f".$no;
	   if($flist == "") $flist = " ";

	   if($essen == "Y"){

	      if($type == "text" || $type == "textarea" || $type == "file" || $type == "pdate" || $type == "name"){

	         $flist_list = explode("|",$flist);
	         for($ii=0;$ii<count($flist_list);$ii++){

	            echo "var obj = document.getElementById(\"".$form_info[idx]."_".$fname."_".$ii."\");\n";
	            echo "if(obj.value == \"\"){\n";
	            echo "   alert(\"".$name."을 입력하세요\");\n";
	            echo "   obj.focus();\n";
	            echo "   return false;\n";
	            echo "}\n";

	         }

	      }else if($type == "select"){

	      	echo "var obj = document.getElementById(\"".$form_info[idx]."_".$fname."_0\");\n";
	        echo "if(obj.value == \"\"){\n";
	        echo "   alert(\"".$name."을 선택하세요\");\n";
	        echo "   obj.focus();\n";
	        echo "   return false;\n";
	        echo "}\n";

	      }else if($type == "tdate"){

					 $flist_list = explode("|",$flist);
	         for($ii=0;$ii<count($flist_list);$ii++){

						 echo "var obj = document.getElementById(\"".$form_info[idx]."_".$fname."_".$ii."_0\");\n";
						 echo "if(obj.value == \"\"){\n";
		         echo "   alert('년도를 선택하세요');\n";
		         echo "   obj.focus();\n";
		         echo "   return false;\n";
		         echo "}\n";
		         echo "var obj = document.getElementById(\"".$form_info[idx]."_".$fname."_".$ii."_1\");\n";
						 echo "if(obj.value == \"\"){\n";
		         echo "   alert('월을 선택하세요');\n";
		         echo "   obj.focus();\n";
		         echo "   return false;\n";
		         echo "}\n";
		         echo "var obj = document.getElementById(\"".$form_info[idx]."_".$fname."_".$ii."_2\");\n";
						 echo "if(obj.value == \"\"){\n";
		         echo "   alert('일자를 선택하세요');\n";
		         echo "   obj.focus();\n";
		         echo "   return false;\n";
		         echo "}\n";
		         echo "var obj = document.getElementById(\"".$form_info[idx]."_".$fname."_".$ii."_3\");\n";
						 echo "if(obj.value == \"\"){\n";
		         echo "   alert('시간을 선택하세요');\n";
		         echo "   obj.focus();\n";
		         echo "   return false;\n";
		         echo "}\n";

		       }

	      }else if($type == "checkbox" || $type == "radio"){

	         echo "var c_checked = false;";

	         $flist_list = explode("|",$flist);
	         for($ii=0;$ii<count($flist_list);$ii++){

	            echo "var obj = document.getElementById(\"".$form_info[idx]."_".$fname."_".$ii."\");\n";
	            echo "if(obj.checked == true) c_checked = true;\n";

	         }

	         echo "if(c_checked == false){\n";
	         echo "   alert(\"".$name." 을 선택하세요\");\n";
	         echo "   return false;\n";
	         echo "}\n";


	      }else if($type == "address"){

	      	 echo "if(frm.".$fname."_address1.value == ''){\n";
	         echo "   alert('주소를 입력하세요');\n";
	         echo "   return false;\n";
	         echo "}\n";
	         echo "if(frm.".$fname."_address2.value == ''){\n";
	         echo "   alert('주소를 입력하세요');\n";
	         echo "   frm.".$fname."_address2.focus();\n";
	         echo "   return false;\n";
	         echo "}\n";

	      }else if($type == "birthday"){

					 $flist_list = explode("|",$flist);
	         for($ii=0;$ii<count($flist_list);$ii++){

						 echo "var obj = document.getElementById(\"".$form_info[idx]."_".$fname."_".$ii."_0\");\n";
						 echo "if(obj.value == \"\"){\n";
		         echo "   alert('년도를 선택하세요');\n";
		         echo "   obj.focus();\n";
		         echo "   return false;\n";
		         echo "}\n";
		         echo "var obj = document.getElementById(\"".$form_info[idx]."_".$fname."_".$ii."_1\");\n";
						 echo "if(obj.value == \"\"){\n";
		         echo "   alert('월을 선택하세요');\n";
		         echo "   obj.focus();\n";
		         echo "   return false;\n";
		         echo "}\n";
		         echo "var obj = document.getElementById(\"".$form_info[idx]."_".$fname."_".$ii."_2\");\n";
						 echo "if(obj.value == \"\"){\n";
		         echo "   alert('일자를 선택하세요');\n";
		         echo "   obj.focus();\n";
		         echo "   return false;\n";
		         echo "}\n";

		       }

	      }else if($type == "phone" || $type == "tel"){

	          echo "var obj = document.getElementById(\"".$form_info[idx]."_".$fname."_0\");\n";
	          echo "if(obj.value == \"\"){\n";
	          echo "   alert(\"".$name."을 입력하세요\");\n";
	          echo "   obj.focus();\n";
	          echo "   return false;\n";
	          echo "}else if(!check_Num(obj.value)){\n";
	          echo "	alert(\"지역번호는 숫자만 가능합니다.\");\n";
	          echo "   obj.focus();\n";
	          echo "   return false;\n";
	          echo "}\n";

	          echo "var obj = document.getElementById(\"".$form_info[idx]."_".$fname."_1\");\n";
	          echo "if(obj.value == \"\"){\n";
	          echo "   alert(\"".$name."을 입력하세요\");\n";
	          echo "   obj.focus();\n";
	          echo "   return false;\n";
	          echo "}else if(!check_Num(obj.value)){\n";
	          echo "	alert(\"국번은 숫자만 가능합니다.\");\n";
	          echo "   obj.focus();\n";
	          echo "   return false;\n";
	          echo "}\n";
	          echo "var obj = document.getElementById(\"".$form_info[idx]."_".$fname."_2\");\n";
	          echo "if(obj.value == \"\"){\n";
	          echo "   alert(\"".$name."을 입력하세요\");\n";
	          echo "   obj.focus();\n";
	          echo "   return false;\n";
	          echo "}else if(!check_Num(obj.value)){\n";
	          echo "	alert(\"전화번호는 숫자만 가능합니다.\");\n";
	          echo "   obj.focus();\n";
	          echo "   return false;\n";
	          echo "}\n";

	      } else if($type == "email"){

	          echo "var obj = frm.".$fname."_email1;\n";
	          echo "var obj2 = frm.".$fname."_email2;\n";

						echo "if(frm.".$fname."_email1.value == ''){\n";
						echo "   alert(\"".$name."를 입력하세요\");\n";
						echo "   obj.focus();\n";
						echo "   return false;\n";
						echo "} else if(frm.".$fname."_email2.value == ''){\n";
						echo "   alert(\"".$name."를 입력하세요\");\n";
						echo "   obj2.focus();\n";
						echo "   return false;\n";
						echo "} else if(!check_Email(obj.value+'@'+obj2.value)) {\n";
						echo "   obj.focus();\n";
						echo "   return false;\n";
						echo "}\n";

	      } else if($type == "spamcheck"){

	      		//echo "var obj = document.getElementById(\"vcode\");\n";
	      		echo "var obj = document.formFrm".$form_info[idx].".vcode;\n";
	      		echo "if (obj != undefined && (hex_md5(obj.value) != md5_norobot_key".$form_info[idx].")) {\n";
	          echo "   alert(\"".$name."을 정확히 입력해주세요\");\n";
	          echo "   obj.focus();\n";
	          echo "   return false;\n";
	          echo "}\n";

	      }


	   }

	}
}
?>
<script language="JavaScript" src="/admin2/js/lib.js"></script>
<script language="JavaScript" src="/admin2/js/calendar.js"></script>
<script language="javascript">
<!--
function formCheck<?=$form_info[idx]?>(frm){
<?
if($form_info[agree_use] == "Y") {
?>
	var agree = true;
	if(!frm.agree.checked) agree = false;

	if(!agree) {
		alert("약관에 동의해 주시기 바랍니다.");
		frm.agree.focus();
		return false;
	}
<?php
}
$no = 0;
$sql = "select * from wiz_formfield where fidx = '$form_info[idx]' order by fprior asc, idx asc";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)){
   checkObject($no,$row[fname],$row[fessen],$row[ftype],$row[flist]);
   $no++;
}
?>
}

// 우편번호 찾기
function postSearch(kind){
   var url = "/admin2/form/post_search.php?code=<?=$code?>&kind="+kind;
   window.open(url, "postSearch", "width=427, height=400, menubar=no, scrollbars=yes, resizable=no, toolbar=no, status=no, left=50, top=50");
}
-->
</script>


<?
$fidx = $form_info[idx];

// 상단파일
include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/form_head.php";

$no = 0;
$upfile_idx = 0;
$sql = "select * from wiz_formfield where fidx = '$fidx' order by fprior asc, idx asc";
$result = mysql_query($sql) or error(mysql_error());
while($row = mysql_fetch_array($result)){

	$fname = $row[fname];
	if(img_type(WIZHOME_PATH."/data/form/title/".$row[fimg])) { $fname = "<img src='/admin2/data/form/title/$row[fimg]' align='absmiddle'>"; }
	$finput = createObject($no,$row[ftype],$row[fsize],$row[flist]);
	include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/form_body.php";
	$no++;

}

// 하단파일
include "$_SERVER[DOCUMENT_ROOT]/$skin_dir/form_foot.php";

?>
