<?
include_once "$_SERVER[DOCUMENT_ROOT]/admin/common.php";
include "$_SERVER[DOCUMENT_ROOT]/admin/inc/mem_info.php";

if(!strcmp($mode, "addfile_del")) {

	$sql = "select addinfo".$no." from wiz_member where id='$wiz_session[id]'";
	$result = mysql_query($sql) or error(mysql_error());
	$row = mysql_fetch_array($result);

	$upfile_path = WIZHOME_PATH."/data/member";
	@unlink($upfile_path."/".$upfile);

	$tmp_value = str_replace("$upfile", "", $row["addinfo".$no]);

	$sql = "update wiz_member set addinfo".$no." = '".$tmp_value."' where id='$wiz_session[id]'";
	mysql_query($sql) or error(mysql_error());

	alert("삭제하였습니다.",$PHP_SELF);

} else {

	$post 	= $post1."-".$post2;
	$tphone = $tphone1."-".$tphone2."-".$tphone3;
	$hphone = $hphone1."-".$hphone2."-".$hphone3;
	$comtel = $comtel1."-".$comtel2."-".$comtel3;

	$birthday2 = substr("0".$birthday2,-2);
	$birthday3 = substr("0".$birthday3,-2);
	$memorial2 = substr("0".$memorial2,-2);
	$memorial3 = substr("0".$memorial3,-2);

	$birthday = $birthday1."-".$birthday2."-".$birthday3;
	$memorial = $memorial1."-".$memorial2."-".$memorial3;


	for($ii=0; $ii<count($consph); $ii++){
	  $tmpconsph .= $consph[$ii].",";
	}
	for($ii=0; $ii<count($conprd); $ii++){
	  $tmpconprd .= $conprd[$ii].",";
	}

	if(!strcmp($delphoto, "Y")) {

		$sql = "select photo from wiz_member where id = '$wiz_session[id]'";
		$result = mysql_query($sql) or error(mysql_error());
		$row = mysql_fetch_array($result);

		$upfile_path = WIZHOME_PATH."/data/member";
	 	@unlink($upfile_path."/".$row[photo]);

	}

	if(!strcmp($delicon, "Y")) {

		$sql = "select icon from wiz_member where id = '$wiz_session[id]'";
		$result = mysql_query($sql) or error(mysql_error());
		$row = mysql_fetch_array($result);

		$upfile_path = WIZHOME_PATH."/data/member";
	 	@unlink($upfile_path."/".$row[icon]);

	}

	// 사진등록
	if($photo[size] > 0){

		file_check($photo[name]);
		$upfile_path = WIZHOME_PATH."/data/member";
		if(!is_dir($upfile_path)) mkdir($upfile_path, 0707);

		if(fileperms($upfile_path) != 16837 && fileperms($upfile_path) != 16839 && fileperms($upfile_path) != 16895){
			error("파일업로드시 문제가 발생하였습니다.\\n\\ndata 디렉토리 이하는 모두 쓰기권한이 있어야합니다.","");
		}

		$photo_name = $wiz_session[id].".".substr($photo[name],-3);
		@unlink($upfile_path."/".$wiz_session[id].".gif");
		@unlink($upfile_path."/".$wiz_session[id].".jpg");
		copy($photo[tmp_name], $upfile_path."/".$photo_name);

	 	$srcimg = $photo_name;
	 	$dstimg = $photo_name;
	 	$photo_width = "120";
	 	img_resize($srcimg, $dstimg, $upfile_path, $photo_width, $photo_height);

		$photo_sql = " photo = '$photo_name', ";

	}

	// 아이콘등록
	if($icon[size] > 0){

		file_check($icon[name]);
		$upfile_path = WIZHOME_PATH."/data/member";
		if(!is_dir($upfile_path)) mkdir($upfile_path, 0707);

		if(fileperms($upfile_path) != 16837 && fileperms($upfile_path) != 16839 && fileperms($upfile_path) != 16895){
			error("파일업로드시 문제가 발생하였습니다.\\n\\ndata 디렉토리 이하는 모두 쓰기권한이 있어야합니다.","");
		}

		$icon_name = $wiz_session[id]."_icon.".substr($icon[name],-3);
		@unlink($upfile_path."/".$wiz_session[id]."_icon.gif");
		@unlink($upfile_path."/".$wiz_session[id]."_icon.jpg");
		copy($icon[tmp_name], $upfile_path."/".$icon_name);

	 	$srcimg = $icon_name;
	 	$dstimg = $icon_name;
	 	$icon_width = $icon_size;
	 	img_resize($srcimg, $dstimg, $upfile_path, $icon_width, $icon_height);

		$icon_sql = " icon = '$icon_name', ";

	}

	$sql = "select * from wiz_formfield where fidx = 'addinfo' order by fprior asc, idx asc";
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result)){

		$no = $row[fprior];

	   if($row[ftype] != "file"){

	      $fvalue = "";

	      if($row[ftype] == "address"){

	      	$fpost1 = ${"f".$no."_post1"};
	      	$fpost2 = ${"f".$no."_post2"};
	      	$faddress1 = ${"f".$no."_address1"};
	      	$faddress2 = ${"f".$no."_address2"};
					$fvalue = $fpost1."-".$fpost2."|".$faddress1."|".$faddress2;

				}else if($row[ftype] == "tdate"){

					$year1 = $fname[$no][0];
	      	$month1 = $fname[$no][1];
	      	$day1 = $fname[$no][2];
	      	$time1 = $fname[$no][3];

	      	$year2 = $fname[$no][4];
	      	$month2 = $fname[$no][5];
	      	$day2 = $fname[$no][6];
	      	$time2 = $fname[$no][7];

					$fvalue = $year1."-".$month1."-".$day1."&nbsp;".$time1."~";
					$fvalue .= $year2."-".$month2."-".$day2."&nbsp;".$time2;

				}else if($row[ftype] != "radio"){

					$split_char = "|";
					if($row[ftype] == "pdate") $split_char = "~";

					for($ii=0;$ii<count($fname[$no]);$ii++){
		         $fvalue .= $fname[$no][$ii];
		         if($ii<count($fname[$no])-1) $fvalue .= $split_char;
		      }

		    }else{

		    	$fvalue = $fname[$no];

		    }

		    ${"addinfo".$no."_sql"} = " , addinfo".$no." = '".$fvalue."' ";

	   } else {

	   		$fvalue = "";

		   	for($ii = 1; $ii <= $row[fnum]; $ii++) {

					 // 파일등록

					 	$upfile			 = $_FILES['upfile'.$ii]['tmp_name'];
						$upfile_size = $_FILES['upfile'.$ii]['size'];
						$upfile_name = $_FILES['upfile'.$ii]['name'];

					 if($upfile_size > 0){

						file_check($upfile[name]);

						$upfile_path = WIZHOME_PATH."/data/member";
					 	if(!is_dir($upfile_path)) mkdir($upfile_path, 0707);
					 	$upfile_name = $wiz_session[id]."_".$no."_".$ii.".".substr($upfile[name],-3);

					 	exec("rm -f ".$upfile_path."/".$wiz_session[id]."_".$no."_".$ii.".*");
					 	copy($upfile[tmp_name], $upfile_path."/".$upfile_name);
					 	chmod($upfile_path."/".$upfile_name, 0606);


						$split_char = "|";

						$fvalue .= $upfile_name;
						if($ii < $row[fnum]) $fvalue .= $split_char;

					 } else {

						$split_char = "|";

						$fvalue .= ${"tmp_upfile_".$no."_".$ii};
						if($ii < $row[fnum]) $fvalue .= $split_char;

					}
		   	}

		   	if(!empty($fvalue)) {
		   		${"addinfo".$no."_sql"} = " , addinfo".$no." = '".$fvalue."' ";
		   	}

	   }

	}

	if($passwd1 != "") {
		$passwd1 = md5($passwd1);
		$passwd_sql = " passwd = '$passwd1', ";
	}

	$sql = "update wiz_member set
	                 $passwd_sql $photo_sql $icon_sql nick = '$nick', email = '$email', tphone = '$tphone', hphone = '$hphone', comtel = '$comtel', post = '$post', address1 = '$address1', address2 = '$address2', reemail = '$reemail', resms = '$resms',
	                 birthday = '$birthday', bgubun = '$bgubun', marriage = '$marriage', memorial = '$memorial', scholarship = '$scholarship', job = '$job', income = '$income', car = '$car', hobby = '$hobby', consph = '$tmpconsph', conprd = '$tmpconprd',
	                 intro='$intro', memo = '$memo' $addinfo1_sql $addinfo2_sql $addinfo3_sql $addinfo4_sql $addinfo5_sql where id = '$wiz_session[id]'";
  //echo $sql;
  //exit;
	mysql_query($sql) or error(mysql_error());

	if(empty($prev)) $prev = "http://".$_http_host;

	alert("회원정보를 수정하였습니다.",$prev);
}
?>
