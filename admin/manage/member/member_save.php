<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<? include_once "../../inc/mem_info.php"; ?>
<?

$param = "page=".$page."&slevel=".$slevel."&searchopt=".$searchopt."&searchkey=".$searchkey;

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

	    ${"addinfo".$no} = $fvalue;

	    ${"addinfo".$no."_sql"} = " , addinfo".$no." = '".$fvalue."' ";

   } else {

   		$fvalue = "";

	   	for($ii = 1; $ii <= $row[fnum]; $ii++) {

				 // 파일등록

				 	$upfile			 = $_FILES['upfile'.$ii]['tmp_name'];
					$upfile_size = $_FILES['upfile'.$ii]['size'];
					$upfile_name = $_FILES['upfile'.$ii]['name'];

				 if($upfile_size > 0){

					file_check($upfile_name);

					$upfile_path = "../../data/member";
				 	if(!is_dir($upfile_path)) mkdir($upfile_path, 0707);

					if(fileperms($upfile_path) != 16837 && fileperms($upfile_path) != 16839 && fileperms($upfile_path) != 16895){
						error("파일업로드시 문제가 발생하였습니다.\\n\\ndata 디렉토리 이하는 모두 쓰기권한이 있어야합니다.","");
					}

				 	$upfile_name = $id."_".$no."_".$ii.".".substr($upfile_name,-3);

				 	exec("rm -f ".$upfile_path."/".$id."_".$no."_".$ii.".*");
				 	copy($upfile, $upfile_path."/".$upfile_name);
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

// 회원등록
if($mode == "insert"){

   $resno 		= $resno1."-".$resno2;
   $post 			= $post1."-".$post2;
   $tphone 		= $tphone1."-".$tphone2."-".$tphone3;
   $hphone 		= $hphone1."-".$hphone2."-".$hphone3;
   $comtel 		= $comtel1."-".$comtel2."-".$comtel3;

   $birthday 	= $birthday1."-".$birthday2."-".$birthday3;
   $memorial 	= $memorial1."-".$memorial2."-".$memorial3;

   for($ii=0; $ii<count($consph); $ii++){ $tmpconsph .= $consph[$ii].","; }
   for($ii=0; $ii<count($conprd); $ii++){ $tmpconprd .= $conprd[$ii].","; }

	 // 사진등록
	 if($photo[size] > 0){

		file_check($photo[name]);

		$upfile_path = "../../data/member";
	 	if(!is_dir($upfile_path)) mkdir($upfile_path, 0707);
	 	$photo_name = $id.".".substr($photo[name],-3);
	 	copy($photo[tmp_name], $upfile_path."/".$photo_name);
	 	chmod($upfile_path."/".$photo_name, 0606);

	 	$srcimg = $photo_name;
	 	$dstimg = $photo_name;
	 	$photo_width = "120";
	 	img_resize($srcimg, $dstimg, $upfile_path, $photo_width, $photo_height);

	 }

	 // 아이콘등록
	 if($icon[size] > 0){

		file_check($icon[name]);

		$upfile_path = "../../data/member";
	 	if(!is_dir($upfile_path)) mkdir($upfile_path, 0707);
	 	$icon_name = $id."_icon.".substr($icon[name],-3);
	 	copy($icon[tmp_name], $upfile_path."/".$icon_name);
	 	chmod($upfile_path."/".$icon_name, 0606);

	 	$srcimg = $icon_name;
	 	$dstimg = $icon_name;
	 	$icon_width = $icon_size;
	 	img_resize($srcimg, $dstimg, $upfile_path, $icon_width, $icon_height);

	 }

	 $passwd = md5($passwd);

   $sql = "insert into wiz_member(idx, id, passwd, name, photo, icon, nick, resno, email, tphone, hphone, comtel, homepage, post, address1, address2, reemail, resms,
									      birthday, bgubun, marriage, memorial, scholarship, job, income, car, hobby, consph, conprd, level, recom, visit, visit_time, intro, memo, addinfo1, addinfo2, addinfo3, addinfo4, addinfo5, wdate)
                        values('', '$id', '$passwd', '$name', '$photo_name', '$icon_name', '$nick', '$resno', '$email', '$tphone', '$hphone', '$comtel', '$homepage', '$post', '$address1', '$address2', '$reemail', '$resms',
									      '$birthday', '$bgubun', '$marriage', '$memorial', '$scholarship', '$job', '$income', '$car', '$hobby', '$tmpconsph', '$tmpconprd',
									      '$level', '$recom', '$visit', '$visit_time', '$intro', '$memo', '$addinfo1', '$addinfo2', '$addinfo3', '$addinfo4', '$addinfo5', now())";

   mysql_query($sql) or error(mysql_error());

   complete("회원을 등록하였습니다.","member_list.php?$param");

// 회원정보 수정
}else if($mode == "update"){

   $resno = $resno1."-".$resno2;
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

		$sql = "select photo from wiz_member where idx = '$idx'";
		$result = mysql_query($sql) or error(mysql_error());
		$row = mysql_fetch_array($result);

	 	$upfile_path = "../../data/member";
	 	@unlink($upfile_path."/".$row[photo]);

	}

	if(!strcmp($delicon, "Y")) {

		$sql = "select icon from wiz_member where idx = '$idx'";
		$result = mysql_query($sql) or error(mysql_error());
		$row = mysql_fetch_array($result);

	 	$upfile_path = "../../data/member";
	 	@unlink($upfile_path."/".$row[icon]);

	}

   // 사진등록
	 if($photo[size] > 0){

		file_check($photo[name]);

	 	$upfile_path = "../../data/member";
	  if(!is_dir($upfile_path)) mkdir($upfile_path, 0707);
	 	$photo_name = $id.".".substr($photo[name],-3);
	 	@unlink($upfile_path."/".$id.".gif");
		@unlink($upfile_path."/".$id.".jpg");
	 	copy($photo[tmp_name], $upfile_path."/".$photo_name);
	 	chmod($upfile_path."/".$photo_name, 0606);

	 	$srcimg = $photo_name;
	 	$dstimg = $photo_name;
	 	$photo_width = "120";
	 	img_resize($srcimg, $dstimg, $upfile_path, $photo_width, $photo_height);

	 	$photo_sql = " photo = '$photo_name', ";

	 }

   // 아이콘등록
	 if($icon[size] > 0){

		file_check($icon[name]);

	 	$upfile_path = "../../data/member";
	  if(!is_dir($upfile_path)) mkdir($upfile_path, 0707);
	 	$icon_name = $id."_icon.".substr($icon[name],-3);
	 	@unlink($upfile_path."/".$id."_icon.gif");
		@unlink($upfile_path."/".$id."_icon.jpg");
	 	copy($icon[tmp_name], $upfile_path."/".$icon_name);
	 	chmod($upfile_path."/".$icon_name, 0606);

	 	$srcimg = $icon_name;
	 	$dstimg = $icon_name;
	 	$icon_width = $icon_size;
	 	img_resize($srcimg, $dstimg, $upfile_path, $icon_width, $icon_height);

	 	$icon_sql = " icon = '$icon_name', ";

	 }

		if($passwd != "") {
			$passwd = md5($passwd);
			$passwd_sql = " passwd = '$passwd', ";
		}

   $sql = "update wiz_member set
                     $passwd_sql name = '$name', $photo_sql $icon_sql nick = '$nick', resno = '$resno', email = '$email', tphone = '$tphone', hphone = '$hphone', comtel = '$comtel', homepage = '$homepage', post = '$post', address1 = '$address1', address2 = '$address2', reemail = '$reemail', resms = '$resms',
                     birthday = '$birthday', bgubun = '$bgubun', marriage = '$marriage', memorial = '$memorial', scholarship = '$scholarship', job = '$job', income = '$income', car = '$car', hobby = '$hobby', consph = '$tmpconsph', conprd = '$tmpconprd',
                     recom = '$recom', level = '$level', intro='$intro', memo = '$memo' $addinfo1_sql $addinfo2_sql $addinfo3_sql $addinfo4_sql $addinfo5_sql where idx = '$idx'";

   mysql_query($sql) or error(mysql_error());

   complete("회원정보를 수정하였습니다.","member_input.php?mode=$mode&idx=$idx&$param");



// 회원 삭제
}else if($mode == "deluser"){

	$i=0;
	$upfile_path = WIZHOME_PATH."/data/member";
	$array_seluser = explode("|",$seluser);

	while($array_seluser[$i]){

		$id = $array_seluser[$i];

		// 미니홈피 기능 사용 시 미니홈피 관련 데이터 삭제
		if(!strcmp($site_info[mini_use], "Y")) {

			include "../../mini/inc/mini_info.php";

			$sql = "select photo,miniurl from wiz_mini_info where memid = '$id'";
			$result = mysql_query($sql) or error(mysql_error());
			$row = mysql_fetch_array($result);

			$miniurl_path = "$DOCUMENT_ROOT/$mini_dir/$row[miniurl]";

			if(!empty($row[miniurl])) rm_dir("$miniurl_path");

			if(!empty($row[photo])) @unlink(WIZHOME_PATH."/data/mini/".$row[photo]);

			rm_dir(WIZHOME_PATH."/data/minibbs/bbs/".$id);
			rm_dir(WIZHOME_PATH."/data/minibbs/data/".$id);
			rm_dir(WIZHOME_PATH."/data/minibbs/movie/".$id);
			rm_dir(WIZHOME_PATH."/data/minibbs/photo/".$id);
			rm_dir(WIZHOME_PATH."/data/minibbs/visit/".$id);
			rm_dir(WIZHOME_PATH."/data/music/".$id);

			$sql = "delete from wiz_mini_bbs where miniid = '$id'";
			mysql_query($sql) or error(mysql_error());

			$sql = "delete from wiz_mini_data where miniid = '$id'";
			mysql_query($sql) or error(mysql_error());

			$sql = "delete from wiz_mini_photo where miniid = '$id'";
			mysql_query($sql) or error(mysql_error());

			$sql = "delete from wiz_mini_movie where miniid = '$id'";
			mysql_query($sql) or error(mysql_error());

			$sql = "delete from wiz_mini_guest where miniid = '$id'";
			mysql_query($sql) or error(mysql_error());

			$sql = "delete from wiz_mini_bbscat where miniid = '$id'";
			mysql_query($sql) or error(mysql_error());

			$sql = "delete from wiz_mini_comment where miniid = '$id'";
			mysql_query($sql) or error(mysql_error());

			$sql = "delete from wiz_mini_conrefer where miniid = '$id'";
			mysql_query($sql) or error(mysql_error());

			$sql = "delete from wiz_mini_contime where miniid = '$id'";
			mysql_query($sql) or error(mysql_error());

			$sql = "delete from wiz_mini_friend  where myid = '$id' or frdid = '$id'";
			mysql_query($sql) or error(mysql_error());

			$sql = "delete from wiz_mini_info  where memid = '$id'";
			mysql_query($sql) or error(mysql_error());

			$sql = "delete from wiz_mini_music  where miniid = '$id'";
			mysql_query($sql) or error(mysql_error());

			$sql = "delete from wiz_mini_profile  where miniid = '$id'";
			mysql_query($sql) or error(mysql_error());
		}

		// 추가항목이 파일인 경우 업로드 파일 삭제
		$sql = "select addinfo1, addinfo2, addinfo3, addinfo4, addinfo5 from wiz_member where id = '$id'";
		$result = mysql_query($sql) or error(mysql_error());
		$my_info = mysql_fetch_array($result);

		$sql = "select * from wiz_formfield where fidx = 'addinfo' and ftype = 'file' order by fprior asc, idx asc";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)){

			$no = $row[fprior];

			$tmp_array = explode("|", $my_info["addinfo".$no]);

			for($ii = 0; $ii < count($tmp_array); $ii++) {
				@unlink($upfile_path."/".$tmp_array[$ii]);
			}

		}

		// 회원테이블에서 삭제
		$sql = "delete from wiz_member where id = '$id'";
		$result = mysql_query($sql) or error(mysql_error());

		@unlink($upfile_path."/".$id.".gif");
		@unlink($upfile_path."/".$id.".jpg");
		@unlink($upfile_path."/".$id."_icon.gif");
		@unlink($upfile_path."/".$id."_icon.jpg");

		// 회원포인트 삭제
		$sql = "delete from wiz_point where memid = '$id'";
		mysql_query($sql) or error(mysql_error());

		$i++;

	}

	complete("회원을 삭제하였습니다.","member_list.php?$param");


// 탈퇴회원 삭제
}else if($mode == "memoutdel"){

	$sql = "delete from wiz_bbs where code = '[memout]' and idx='$idx'";

	mysql_query($sql) or error(mysql_error());

  complete("삭제되었습니다.","out_list.php?page=$page");

// 포인트 저장
} else if($mode == "point") {

	$point = $point_gubun.$point;
	$sql = "insert into wiz_point (idx,bidx,cidx,midx,ptype,mode,memid,point,memo,wdate)
					values('','$bidx','$cidx','$midx','$ptype','$mode','$memid','$point','$memo',now())";
	mysql_query($sql) or error(mysql_error());

  complete("포인트가 적립되었습니다.", "member_point.php?id=$memid&name=$name");

// 포인트 삭제
} else if($mode == "delpoint") {

	$sql = "delete from wiz_point where idx = '$idx'";
	mysql_query($sql) or error(mysql_error());

  complete("포인트가 삭제되었습니다.", "member_point.php?id=$memid&name=$name");

// 가입약관 및 개인정보 보호정책
} else if($mode == "config") {

	$agreement = $_POST["agreement"];
	$safeinfo = $_POST["safeinfo"];
	if(!get_magic_quotes_gpc()) $agreement = addslashes($agreement);
	if(!get_magic_quotes_gpc()) $safeinfo = addslashes($safeinfo);

	$sql = "update wiz_meminfo set agreement='$agreement', safeinfo='$safeinfo'";
	$result = mysql_query($sql) or error(mysql_error());

	complete("수정되었습니다.","member_config.php");

// 추가항목 File 인 경우 파일 삭제
} else if(!strcmp($mode, "addfile_del")) {

	$no 		= $_GET["no"];
	$upfile = $_GET["upfile"];

	$sql = "select addinfo".$no." from wiz_member where idx = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	$row = mysql_fetch_array($result);

	$upfile_path = "../../data/member";
	@unlink($upfile_path."/".$upfile);

	$tmp_value = str_replace("$upfile", "", $row["addinfo".$no]);

	$sql = "update wiz_member set addinfo".$no." = '".$tmp_value."' where idx='$idx'";
	mysql_query($sql) or error(mysql_error());

  complete("회원정보를 수정하였습니다.","member_input.php?mode=update&idx=$idx&$param");

}
?>
