<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?

// 기본정보설정
if($mode == "site_info"){
	
	$com_post = $com_post1."-".$com_post2;
	$com_address = $com_address1;
	if($ftp_pw != "") $ftp_pw_sql = " ftp_pw='$ftp_pw', ";
	
	$sql = "update wiz_siteinfo set site_name='$site_name', site_url='$site_url', site_email='$site_email', site_tel='$site_tel', site_hand='$site_hand', ftp_host='$ftp_host', ftp_id='$ftp_id', $ftp_pw_sql
							com_num='$com_num', com_name='$com_name', com_owner='$com_owner', com_post='$com_post', com_address='$com_address', com_kind='$com_kind', com_class='$com_class', com_tel='$com_tel', com_fax='$com_fax'";

	$result = mysql_query($sql) or error(mysql_error());

	complete("기본정보 설정이 저장되었습니다.","site_info.php");


// 도메인 정보
}else if($mode == "domain"){

   $type = "domain";
   
   if($submode == "insert"){

      $sql = "insert into wiz_otherinfo(idx,type,info01,info02,info03,info04,info05,info06,info07,info08,info09,info10) 
										values('','$type','$info01','$info02','$info03','$info04','$info05','$info06','$info07','$info08','$info09','$info10')";
      mysql_query($sql) or error(mysql_error());
      echo "<script>alert('등록되었습니다.');self.close();opener.document.location.reload();</script>";

   }else if($submode == "update"){

      $sql = "update wiz_otherinfo set info01='$info01',info02='$info02',info03='$info03',info04='$info04',info05='$info05',info06='$info06',info07='$info07',info08='$info08',info09='$info09',info10='$info10' where idx = '$idx'";
      mysql_query($sql) or error(mysql_error());
      echo "<script>alert('수정되었습니다.');self.close();opener.document.location.reload();</script>";

   }else if($submode == "delete"){

      $sql = "delete from wiz_otherinfo where idx = '$idx'";
      mysql_query($sql) or error(mysql_error());
      alert("삭제되었습니다.","site_info.php");

   }

// 이메일 정보
}else if($mode == "email"){

   $type = "email";

   if($submode == "insert"){

      $sql = "insert into wiz_otherinfo(idx,type,info01,info02,info03,info04,info05,info06,info07,info08,info09,info10) 
											values('','$type','$info01','$info02','$info03','$info04','$info05','$info06','$info07','$info08','$info09','$info10')";
      mysql_query($sql) or error(mysql_error());
      echo "<script>alert('등록되었습니다.');self.close();opener.document.location.reload();</script>";

   }else if($submode == "update"){

      $sql = "update wiz_otherinfo set info01='$info01',info02='$info02',info03='$info03',info04='$info04',info05='$info05',info06='$info06',info07='$info07',info08='$info08',info09='$info09',info10='$info10' where idx = '$idx'";
      mysql_query($sql) or error(mysql_error());
      echo "<script>alert('수정되었습니다.');self.close();opener.document.location.reload();</script>";

   }else if($submode == "delete"){

      $sql = "delete from wiz_otherinfo where idx = '$idx'";
      mysql_query($sql) or error(mysql_error());
      alert("삭제되었습니다.","site_info.php");

   }

}

?>
