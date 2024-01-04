<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?

$param = "code=".$code."&page=".$page."&searchopt=".$searchopt."&searchkey=".$searchkey;

// 설문입력
if($mode == "insert"){

	if(!get_magic_quotes_gpc()) $content = addslashes($content);
	$sql = "insert into wiz_poll(idx,code,polluse,pollmain,sdate,edate,apermi,cpermi,subject,content,wdate,cnt)
			values('','$code','$polluse','$pollmain','$sdate','$edate','$apermi','$cpermi','$subject','$content',now(),0)";
	
	$result = mysql_query($sql) or error(mysql_error());
	
	$sql = "select max(idx) as idx from wiz_poll";
	$result = mysql_query($sql) or error(mysql_error());
	$row = mysql_fetch_array($result);
	$idx = $row[idx];
	
	complete("설문을 추가 하였습니다.","poll_input.php?mode=update&idx=$idx&code=$code");


// 설문수정
}else if($mode == "update"){

	if(!get_magic_quotes_gpc()) $content = addslashes($content);
	
	$sql = "update wiz_poll set polluse='$polluse',pollmain='$pollmain',sdate='$sdate',edate='$edate',apermi='$apermi',cpermi='$cpermi',subject='$subject',content='$content' where idx = '$idx'";
	
	$result = mysql_query($sql) or error(mysql_error());
	
	complete("설문을 수정 하였습니다.","poll_input.php?mode=$mode&idx=$idx&$param");


// 설문삭제
}else if($mode == "delete"){

   $sql = "delete from wiz_poll where idx = '$idx'";
   $result = mysql_query($sql) or error(mysql_error());

   complete("설문을 삭제 하였습니다.","poll_list.php?$param");




}else if($mode == "question"){

	if($smode == "insert"){

		$sql = "insert into wiz_polldata(idx,pidx,question,answer01,count01,answer02,count02,answer03,count03,answer04,count04,answer05,count05,answer06,count06,answer07,count07,answer08,count08,answer09,count09,answer10,count10)
				values('','$pidx','$question','$answer01','$count01','$answer02','$count02','$answer03','$count03','$answer04','$count04','$answer05','$count05','$answer06','$count06','$answer07','$count07','$answer08','$count08','$answer09','$count09','$answer10','$count10')";

   	$result = mysql_query($sql) or error(mysql_error());

   	echo "<script>alert('질문을 추가 하였습니다.');history.go(-1);opener.document.location.reload();</script>";

   	//complete("질문을 추가 하였습니다.","");


	}else if($smode == "update"){

		$sql = "update wiz_polldata set question='$question',
   			answer01='$answer01',count01='$count01',answer02='$answer02',count02='$count02',answer03='$answer03',count03='$count03',answer04='$answer04',count04='$count04',answer05='$answer05',count05='$count05',
   			answer06='$answer06',count06='$count06',answer07='$answer07',count07='$count07',answer08='$answer08',count08='$count08',answer09='$answer09',count09='$count09',answer10='$answer10',count10='$count10' where idx = '$idx'";
		//echo $sql;
		$result = mysql_query($sql) or error(mysql_error());

		echo "<script>alert('설문을 수정 하였습니다.');document.location='poll_question.php?pidx=$pidx&mode=question&smode=update&idx=$idx';opener.document.location.reload();</script>";

	}else if($smode == "delete"){

		$sql = "delete from wiz_polldata where idx = '$idx'";

		$result = mysql_query($sql) or error(mysql_error());

		complete("설문을 삭제 하였습니다.","poll_input.php?mode=update&idx=$pidx");

	}

// 설문 댓글
} else if(!strcmp($mode, "comment")) {

	$ctype = "POLL";
	$memid = $wiz_admin[id];
	if(!get_magic_quotes_gpc()) $content = addslashes($content);
	
	$sql = "insert into wiz_comment (idx,ctype,cidx,star,memid,name,nick,content,passwd,wdate,ip)
					values('','$ctype','$cidx','$star','$memid','$name','$nick','$content','$passwd',now(),'$_SERVER[REMOTE_ADDR]')";

  mysql_query($sql) or error(mysql_error());

	alert("댓글을 작성하였습니다.", "poll_input.php?mode=update&code=$code&idx=$cidx");

// 코멘트 삭제
} else if($mode == "delco"){

	$sql = "delete from wiz_comment where idx='$idx'";
	$result = mysql_query($sql) or error(mysql_error());

	alert("댓글을 삭제하였습니다.", "poll_input.php?mode=update&code=$code&idx=$cidx");

}
?>
