<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?

$param = "page=".$page."&searchopt=".$searchopt."&searchkey=".$searchkey;

// 설문입력
if($mode == "insert"){
	
	$mainskin = "	
	<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
	<tr><td><b>{SUBJECT}</b></td></tr>
	<tr><td>{CONTENT}</td></tr>
	[LOOP]
	<tr><td><img src=\"/admin2/bbsmain/image/point.gif\" align=\"absmiddle\"> {QUESTION}</td></tr>
	[LOOP2]
	<tr><td> {ANSWER} </td></tr>
	[/LOOP2]
	[/LOOP]
	<tr><td height=5></td></tr>
	<tr><td align=center>{VOTE_BTN} {VIEW_BTN}</td></tr>
	</table>";
	
   $sql = "insert into wiz_pollinfo (code,title,lpermi,rpermi,apermi,cpermi,skin,permsg,perurl,mainskin,purl,wdate,datetype_list,datetype_view,rows,lists,newc,subject_len,spam_check,comment,abuse,abtxt) 
   				values('$code','$title','$lpermi','$rpermi','$apermi','$cpermi','$skin','$permsg','$perurl','$mainskin','$purl',now(),'$datetype_list','$datetype_view','$rows','$lists','$newc','$subject_len','$spam_check','$comment','$abuse','$abtxt')";
   mysql_query($sql) or die(mysql_error());

   complete("설문을 추가 하였습니다.","pollinfo_input.php?mode=update&code=$code");
   

// 설문수정
}else if($mode == "update"){
	
  $sql = "update wiz_pollinfo set title='$title',lpermi='$lpermi',rpermi='$rpermi',apermi='$apermi',cpermi='$cpermi',skin='$skin', permsg='$permsg',perurl='$perurl',datetype_list='$datetype_list',datetype_view='$datetype_view',rows='$rows',lists='$lists',newc='$newc',subject_len='$subject_len',spam_check='$spam_check',comment='$comment',abuse='$abuse',abtxt='$abtxt' where code = '$code'";
  mysql_query($sql) or error(mysql_error()); 
   
   complete("설문을 수정 하였습니다.","pollinfo_input.php?mode=$mode&code=$code&$param");


// 설문삭제
}else if($mode == "delete"){
   
   $sql = "delete from wiz_pollinfo where code = '$code'";
   $result = mysql_query($sql) or error(mysql_error());
   
   complete("설문을 삭제 하였습니다.","pollinfo_list.php?$param");




}
?>
