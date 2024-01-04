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

// 처리상태
if(!strcmp($row[status], "Y")) $status = "<img src='".$skin_dir."/image/bt_end.gif'>";
else $status = "<img src='".$skin_dir."/image/bt_ing.gif'>";
?>
	<tr>
		<td align="center"><?=$checkbox_body?></td>
	  <td align="center" height="28"><?=$no?></td>
	  <td align="left" style="padding-left:10px;"><?=$catname?> <?=$re_space?><?=$re_icon?><?=$subject?> <?=$comment?> <?=$lock_icon?> <?=$new_icon?> <?=$hot_icon?> <?=$file_icon?></td>
	  <td align="center"><?=$name?></td>
	  <td align="center"><?=$wdate?></td>
	  <td align="center"><?=$status?></td>
	  <td align="center"><?=$count?></td>
	  <?=$hide_recom_start?>
	  <td align="center"><?=$recom?></td>
	  <?=$hide_recom_end?>
	</tr>
	<tr>
	  <td colspan="10" height="1" bgcolor="#d7d7d7"></td>
	</tr>
