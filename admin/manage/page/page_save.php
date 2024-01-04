<? include_once "../../common.php"; ?>
<? include_once "../../inc/admin_check.php"; ?>
<?
if(!get_magic_quotes_gpc()) $content= addslashes($content);

// 추가
if($mode == "insert"){

$sql = "insert into wiz_page(idx,code,title,menu,url,level,content,prior,wdate)
								values('','$code', '$title', '$menu', '$url', '$level', '$content', '$prior', now())";

$result = mysql_query($sql) or error("이미등록된 페이지 코드입니다.");

complete("추가되었습니다.","page_list.php");


// 수정
}else if($mode == "update"){

$sql = "update wiz_page set title='$title', menu='$menu', url='$url', level='$level', content='$content', prior='$prior' where idx = '$idx'";

$result = mysql_query($sql) or error(mysql_error());

complete("수정되었습니다.","page_input.php?mode=update&idx=$idx&page=$page");


// 삭제
}else if($mode == "delete"){

$sql = "delete from wiz_page where idx = '$idx'";

$result = mysql_query($sql) or error(mysql_error());

complete("삭제되었습니다.","page_list.php");

}

?>
