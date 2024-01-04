<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/common.php";
include_once "$_SERVER[DOCUMENT_ROOT]/admin2/inc/site_info.php";
include "$_SERVER[DOCUMENT_ROOT]/admin2/inc/form_info.php";

if(!strcmp($code, $_POST[code])) {

	// 스팸글 차단
	//if(strpos($HTTP_REFERER, $_SERVER[HTTP_HOST]) === false) error("잘못된 경로 입니다.");

	//if(empty($_POST[fidx])) error("잘못된 경로 입니다.");

	$form_content = "";		// 폼에 입력한 실제 데이터 |^| 로 구분

	// 폼에서 넘어온 데이타
	$subject = "[".$form_info[title]."] 가 들어왔습니다.";
	$content = "<html>";
	$content .= "<head>";
	$content .= "<meta http-equiv=Content-Type content=text/html; charset=euc-kr>";
	$content .= "</head>";
	$content .= "<body>";
	$content .= "<table width=100% border=0 cellspacing=1 cellpadding=3 style=\"font-size:12px; border :solid #b8d9e1 1px; border-bottom:none; \">";

	//$content .= "<tr><td width=80 height=25>이름</td><td>: 테스트</td></tr>";
	//$content .= "</table>";

	// 첨부파일
	$file_path = WIZHOME_PATH."/data/form";

	// 업로드 디렉토리 생성
	if(!is_dir($file_path)) mkdir($file_path, 0707);

	if($upfile1[size] > 0 || $upfile2[size] > 0 || $upfile3[size] > 0) {

		if(fileperms($file_path) != 16837 && fileperms($file_path) != 16839 && fileperms($file_path) != 16895){
			error("파일업로드시 문제가 발생하였습니다.\\n\\ndata 디렉토리 이하는 모두 쓰기권한이 있어야합니다.","");
		}

	}

	$upfile_idx = date('ymdhis').rand(1,9);

	if($upfile1[size] > 0){
		file_check($upfile1[name]);
		$upfile1_tmp = $upfile_idx."_1.".substr($upfile1[name],-3);
		copy($upfile1[tmp_name],$file_path."/".$upfile1_tmp);
		chmod($file_path."/".$upfile1_tmp, 0606);
	}
	if($upfile2[size] > 0){
		file_check($upfile2[name]);
		$upfile2_tmp = $upfile_idx."_2.".substr($upfile2[name],-3);
		copy($upfile2[tmp_name],$file_path."/".$upfile2_tmp);
		chmod($file_path."/".$upfile2_tmp, 0606);
	}
	if($upfile3[size] > 0){
		file_check($upfile3[name]);
		$upfile3_tmp = $upfile_idx."_3.".substr($upfile3[name],-3);
		copy($upfile3[tmp_name],$file_path."/".$upfile3_tmp);
		chmod($file_path."/".$upfile3_tmp, 0606);
	}

	$no = 0;
	$upfile_idx = 0;
	$sql = "select * from wiz_formfield where fidx = '$fidx' order by fprior asc, idx asc";
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result)){

      $fvalue = "";

      if($row[ftype] == "address"){

      	$post1 = ${"f".$no."_post1"};
      	$post2 = ${"f".$no."_post2"};
      	$address1 = ${"f".$no."_address1"};
      	$address2 = ${"f".$no."_address2"};

      	if(!empty($post1) || !empty($post2)) $fvalue = $post1."-".$post2;
		$fvalue .= "&nbsp;".$address1."&nbsp;".$address2;

	}else if($row[ftype] == "tdate"){

			$year1 = $fname[$no][0];
			$month1 = $fname[$no][1];
			$day1 = $fname[$no][2];
			$time1 = $fname[$no][3];

			$year2 = $fname[$no][4];
			$month2 = $fname[$no][5];
			$day2 = $fname[$no][6];
			$time2 = $fname[$no][7];

			if(!empty($year1) || !empty($month1) || !empty($day1) || !empty($time1)) $fvalue = $year1."-".$month1."-".$day1."&nbsp;".$time1;
			if(!empty($year2) || !empty($month2) || !empty($day2) || !empty($time2)) $fvalue .= " ~ ".$year2."-".$month2."-".$day2."&nbsp;".$time2;

		}else if(!strcmp($row[ftype], "spamcheck")) {

			  // 자동등록방지 코드 검사
			  if(empty($_POST["tmp_vcode_".$fidx]) || empty($_POST[vcode])) {
			  	error("자동등록방지 코드가 존재하지 않습니다.");
			  	exit;
			  } else if(strcmp($_POST["tmp_vcode_".$fidx], md5($_POST[vcode]))) {
			  	error("자동등록방지 코드가 일치하지 않습니다.");
			  	exit;
			  }

	    }else if(!strcmp($row[ftype], "text")) {

			$flist = explode("|", $row[flist]);

			for($ii=0;$ii<count($fname[$no]);$ii++){
				if(!empty($fname[$no][$ii])) $fvalue .= $fname[$no][$ii]."&nbsp;".$flist[$ii]." ";
	         if($ii<count($fname[$no])-1 && empty($flist[$ii])) $fvalue .= " , ";
	      }

	    }else if(!strcmp($row[ftype], "textarea")) {

			for($ii=0;$ii<count($fname[$no]);$ii++){
				if(!empty($fvalue)) $fvalue .= "<br>";
				if(!empty($fname[$no][$ii])) $fvalue .= nl2br($fname[$no][$ii]);
			}

	    }else if(!strcmp($row[ftype], "email")) {

	      	$email1 = ${"f".$no."_email1"};
	      	$email2 = ${"f".$no."_email2"};

      		if(!empty($email1) || !empty($email2)) $fvalue = $email1."@".$email2;
		   $email = $fvalue;

	    }else if(!strcmp($row[ftype], "file")) {

	    	$upfile_idx++;
	    	$fvalue = "<a href=\"http://".$_http_host."/admin2/data/form/".${"upfile".$upfile_idx."_tmp"}."\" target=\"_blank\">".${"upfile".$upfile_idx}[name]."</a>";

	    }else if($row[ftype] != "radio"){

				$split_char = "-";
				if($row[ftype] == "pdate") $split_char = " ~ ";

				for($ii=0;$ii<count($fname[$no]);$ii++){
	         $fvalue .= $fname[$no][$ii];
	         if($ii<count($fname[$no])-1 && !empty($fname[$no][$ii])) $fvalue .= $split_char;
	      }

	      switch($row[ftype]) {
		      	case "name" : $name = $fvalue; break;
		      	case "tel" : $phone = $fvalue; break;
		      	//case "email" : $email = $fvalue; break;
	      }

	    }else{

	    	$fvalue = $fname[$no];

	    }

		if(strcmp($row[ftype], "spamcheck")) {
      		$content .= "<tr>";
      		$content .= "<td width=80 style=\"color: #11809f; background: #e8f3f7; line-height: 15px; padding-left:10px; height:30px; border-bottom:1px solid #b8d9e1;\">".$row[fname]."</td>";
      		$content .= "<td style=\"color: #555555; background: #ffffff; line-height: 20px; padding-left:10px; border-bottom:1px solid #b8d9e1;\">".$fvalue."&nbsp;</td>";
      		$content .= "</tr>";

      		$form_content .= "|^|".$row[idx]."||".$fvalue;
      }

	   $no++;
	}
	$content .= "</table>";
	$content .= "</body>";
	$content .= "</html>";

	// email 전송
	if($form_info[rece_email] == "Y"){

	   $se_name = $site_info[site_name];
	   $se_email = $site_info[site_email];

	   $email_list = explode(",",$form_info[email_list]);
	   for($ii=0;$ii<count($email_list);$ii++){

	     $re_name = $email_list[$ii];
	     $re_email = $email_list[$ii];
	     send_mail($se_name, $se_email, $re_name, $re_email, $subject, $content);

	   }
	}

	// 게시판 전송
	if($form_info[rece_bbs] == "Y"){

		$sql = "insert into wiz_form(idx,code,name,phone,email,subject,content,upfile1,upfile2,upfile3,upfile1_name,upfile2_name,upfile3_name,wdate,ip,status)
		             values('','$code','$name','$phone','$email','$subject','$form_content','$upfile1_tmp','$upfile2_tmp','$upfile3_tmp','$upfile1[name]','$upfile2[name]','$upfile3[name]',now(),'$REMOTE_ADDR','대기중')";

		mysql_query($sql) or error(mysql_error());


	}

	// sms 전송
	if($site_info[sms_use] == "Y" && $form_info[rece_sms] == "Y"){

	   $se_num = $site_info[site_tel];
	   $message = $subject;

	   $sms_list = explode(",",$form_info[sms_list]);
	   for($ii=0;$ii<count($sms_list);$ii++){

	   	 $re_num = trim($sms_list[$ii]);
		   send_sms($se_num, $re_num, $message);

		 }

	}

	alert("정상적으로 접수 되었습니다.","http://".$_http_host.$_SERVER[PHP_SELF]);

}
?>
