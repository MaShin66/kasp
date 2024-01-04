<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/site_info.php"; ?>
<?
	if($mode == "insert"){
	
	  $resno = $resno."-".$resno2;
	  $post = $post1."-".$post2;
	  $tphone = $tphone."-".$tphone2."-".$tphone3;
	  $hphone = $hphone."-".$hphone2."-".$hphone3;
	
	  for($ii=0; $ii<count($permi); $ii++){
	     $tmp_permi .= $permi[$ii]."/";
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

	  $sql = "insert into wiz_admin(id, passwd, name, icon, resno, email, tphone, hphone, post, address1, address2, part, permi, last, wdate, descript)
	                       values('$id', '$passwd', '$name', '$icon_name', '$resno', '$email', '$tphone', '$hphone', '$post', '$address1', '$address2', '$part', '$tmp_permi', '$last', now(), '$descript')";
	  $result = mysql_query($sql) or error("이미 등록된 아이디 입니다.");
	
	  complete("관리자가 추가되었습니다.","admin_list.php");
	
	}else if($mode == "update"){
	
	  $resno = $resno."-".$resno2;
	  $post = $post1."-".$post2;
	  $tphone = $tphone."-".$tphone2."-".$tphone3;
	  $hphone = $hphone."-".$hphone2."-".$hphone3;
	
	  for($ii=0; $ii<count($permi); $ii++){
	     $tmp_permi .= $permi[$ii]."/";
	  }
	  
		if(!strcmp($delicon, "Y")) {
			
			$sql = "select icon from wiz_admin where id = '$id'";
			$result = mysql_query($sql) or error(mysql_error());
			$row = mysql_fetch_array($result);
			
		 	$upfile_path = "../../data/member";
		 	@unlink($upfile_path."/".$row[icon]);
			
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

	  $sql = "update wiz_admin set
	                 passwd = '$passwd', name = '$name', $icon_sql resno = '$resno', email = '$email', tphone = '$tphone', hphone = '$hphone', post = '$post', address1 = '$address1', address2 = '$address2', part='$part', permi='$tmp_permi', descript = '$descript' where id = '$id'";
	  $result = mysql_query($sql) or error(mysql_error());
	
	  complete("관리자 정보가 수정되었습니다.","admin_input.php?mode=update&id=$id&page=$page");
	
	
	}else if($mode == "delete"){
	
	  $sql = "select id from wiz_admin";
	  $result = mysql_query($sql) or error(mysql_error());
	  $total = mysql_num_rows($result);
	
	  if($total <= 1) error("관리자계정이 하나밖에 없습니다. 삭제할 수 없습니다.");
	
	  $sql = "delete from wiz_admin where id='$admin_id'";
	  $result = mysql_query($sql) or error(mysql_error());
	  
		$upfile_path = "../../data/member";
		@unlink($upfile_path."/".$admin_id."_icon.gif");
		@unlink($upfile_path."/".$admin_id."_icon.jpg");
	
	  complete("관리자가 삭제되었습니다.","admin_list.php?page=$page");
	
	
	}else if($mode == "logdel"){
	
	  $sql = "delete from wiz_adminlog where admin_id='$admin_id'";
	  $result = mysql_query($sql) or error(mysql_error());
	
	  complete("로그가 삭제되었습니다.","admin_input.php?mode=update&admin_id=$admin_id");
	
	}
	
?>
