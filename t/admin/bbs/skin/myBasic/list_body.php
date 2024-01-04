<?
/*
$no					: 글 넘버
$catname		: 카테고리
$re_space		: 답글 깊이
$re_icon		: 답글 아이콘
$subject		: 제목
$lock_icon	: 비밀글 아이콘
$new_icon		: 새글 아이콘
$hot_icon		: 인기글 아이콘
$file_icon	: 첨부파일 아이콘
$name				: 이름
$email			: 이메일
$wdate			: 작성일
$count			: 조회수
$comment		: 댓글수
$recom			: 추천
$content		: 글내용
*/
?>
	<tr>
		<td align="center" style="margin:0px; padding:0px"><?=$checkbox_body?></td>
	  <td align="center" height="28" style="margin:0px; padding:0px"><?=$no?></td>
	  <?=$hide_admin_start?>
	  <td align="center" style="margin:0px; padding:0px"><?=$row[memid]?></td>
	  <?=$hide_admin_end?>
	  <td align="left" style="padding-left:10px; padding-bottom:0px; padding-top:0px"><?=$catname?> <?=$re_space?><?=$re_icon?><?=$subject?> <?=$comment?> <?=$lock_icon?> <?=$new_icon?> <?=$hot_icon?> <?=$file_icon?></td>
	  <td align="center" style="margin:0px; padding:0px"><?=$name?></td>
	  <td align="center" style="margin:0px; padding:0px"><?=$wdate?></td>
	  <td align="center" style="margin:0px; padding:0px"><?=$count?></td>
	  <?=$hide_recom_start?>
	  <td align="center" style="margin:0px; padding:0px"><?=$recom?></td>
	  <?=$hide_recom_end?>
	</tr>   
	<tr>
	  <td colspan="10" height="1" bgcolor="#d7d7d7" style="margin:0px; padding:0px"></td>
	</tr>
