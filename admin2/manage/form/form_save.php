<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<? include_once "../../inc/form_info.php"; ?>
<?
$param = "code=".$code."&searchopt=".$searchopt."&searchkey=".$searchkey."&searchstatus=".$searchstatus;

// 폼메일 수정
if($mode == "update"){

	$sql = "select code, reply, content from wiz_form where idx = '$idx'";
	$result = mysql_query($sql) or error(mysql_error());
	$row = mysql_fetch_array($result);
	
	if(!get_magic_quotes_gpc()) $content= addslashes($content);
	$reply = $content;
	
	if($smail == "Y" && $reply != "") {
		
		include_once "$_SERVER[DOCUMENT_ROOT]/admin2/inc/site_info.php";
		
		$sql2 = "select idx from wiz_forminfo where code = '".$row[code]."'";	
		$result2 = mysql_query($sql2) or error(mysql_error());
		$row2 = mysql_fetch_array($result2);
		$fidx = $row2[idx];

		if(strcmp(substr($row[content], 0, 3), "|^|")) $question = $row[content];
		else {

			$form_content = explode("|^|", $row[content]);
			
			for($ii = 0; $ii < count($form_content); $ii++) {
				list($frm_idx, $frm_data) = explode("||", $form_content[$ii]);
				$form_data[$frm_idx] = $frm_data;
			}
			
			$no = 1;
			$question = "<table width=100% border=0 cellspacing=1 cellpadding=3 style=\"font-size:12px; border :solid #b8d9e1 1px; border-bottom:none; \">";
			$sql = "select * from wiz_formfield where fidx = '$fidx' and ftype != 'spamcheck' order by fprior asc, idx asc";
			$result = mysql_query($sql);
			while($row = mysql_fetch_array($result)){		
		  		$question .= "<tr>";
		  		$question .= "<td width=80 style=\"color: #11809f; background: #e8f3f7; line-height: 15px; padding-left:10px; height:30px; border-bottom:1px solid #b8d9e1;\">".$row[fname]."</td>";
		  		$question .= "<td style=\"color: #555555; background: #ffffff; line-height: 20px; padding-left:10px; border-bottom:1px solid #b8d9e1;\">".$form_data[$row[idx]]."&nbsp;</td>";
		  		$question .= "</tr>";
		  		$no++;
			}
			$question .= "</table>";
			
		}
		
		$re_name = $name;
		$re_email = $email;

		$mail_info = get_table("wiz_mailsms", "code = 'form'");
		
		$content = "<table width=100% cellpadding=2>
									<tr><td bgcolor=#efefef>&nbsp; <b>작성내용</b></td></tr>
									<tr><td>".$question."</td></tr>
									<tr><td bgcolor=#efefef>&nbsp; <b>답변내용</b></td></tr>
									<tr><td>".$reply."</td></tr>
								</table>";

		$email_subj = "[".$site_info[site_name]."] 문의하신 내용의 답변입니다.";
		$email_msg = str_replace("{MESSAGE}",$content,$mail_info[email_msg]);
		$email_msg = str_replace("{SITE_URL}", "http://".$HTTP_HOST, $email_msg);
		
		send_mail($site_info[site_name], $site_info[site_email], $re_name, $re_email, $email_subj, $email_msg);

		$send_msg = "<script>alert('답변 메일을 발송하였습니다.');</script>";

	}

	$sql = "update wiz_form set name='$name',phone='$phone',email='$email',subject='$subject',reply='$reply',status='$status' where idx = '$idx'";
	mysql_query($sql) or error(mysql_error());
		
	complete("$send_msg 수정 하였습니다.","form_input.php?".$param."&idx=".$idx."&page=".$page);


// 폼메일 삭제
}else if($mode == "delete"){
  
  if($idx != "") $selform = $idx;
  
  $array_selform = explode("|",$selform);
	for($ii=0;$ii<count($array_selform);$ii++){
		
		$idx = $array_selform[$ii];
		$sql = "select upfile1,upfile2,upfile3 from wiz_form where idx = '$idx'";
		$result = mysql_query($sql) or error(mysql_error());
		$form_row = mysql_fetch_array($result);
		
		$upfile_path = WIZHOME_PATH."/data/form";
		if($form_row[upfile1] != ""){
			@unlink($upfile_path."/".$form_row[upfile1]);
		}
		if($form_row[upfile2] != ""){
			@unlink($upfile_path."/".$form_row[upfile2]);
		}
		if($form_row[upfile3] != ""){
			@unlink($upfile_path."/".$form_row[upfile3]);
		}
		
		$sql = "delete from wiz_form where idx='$idx'";
		mysql_query($sql) or error(mysql_error());

	}

	complete("삭제되었습니다.","form_list.php?".$param."&page=".$page);
   
}
?>
